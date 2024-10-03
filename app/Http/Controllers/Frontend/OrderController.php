<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Notification;
use App\Models\CourseParticipant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\CourseOrderNotificationAdmin;
use App\Mail\CourseOrderNotificationStudent;
use App\Models\Course;
use App\Models\Ebook;
use App\Models\EbookParticipant;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    public function store(Request $request)
    {

        if (auth()->check()) {


            $validator = Validator::make($request->all(),[
                'name'=>'string|required',
                'email'=>'string|required',
                'address'=>'string|required',
                'mobile'=>'string|required',
                'city'=>'string|required',
                'state'=>'required',
                'postcode'=>'required',
                'country_id'=>'required',
                'payment_method'=>'required',
            ]);
            if(!$validator->passes()){
                $res['msgType'] = 'error';
                $res['msg'] = $validator->errors()->toArray();
                return response()->json($res);
            }


            try{
                DB::beginTransaction();
                // dd(session()->has('order_id'));
                // if(session()->has('order_id')){
                //     $order= Order::find(session()->get('order_id'));
                //     foreach($order->cart as $cart){
                //         $cart->delete();
                //     }
                // }else{
                $payment_method_id = $request->payment_method;
                $order=new Order();
                //}
                // $order=new Order();

                $order->order_number='ORD-'.strtoupper(Str::random(10));
                $order->user_id=auth()->user()->id;
                $order->order_type=1;
                $order->name=$request->name;
                $order->email=$request->email;
                $order->address=$request->address;
                $order->mobile=$request->mobile;
                $order->country_id=$request->country_id;
                $order->city=$request->city;
                $order->state=$request->state;
                $order->postcode=$request->postcode;
                $order->order_type='courseorder';
                $order->sub_total=$request->sub_total;
                $order->total_amount=$request->total_amount;
                $order->status="processing";
                $order->payment_status='unpaid';
                $order->payment_method = $payment_method_id;
                $order->order_note = $request->order_note;

                // $payment_method_id
                $order->agree = isset($request-> agree) ? 1 : 0;
                $order->save();
                session()->put("pay_order_id",$order->id);

                $total=0;

                foreach(session('cart') as $id => $details){
                    $cart = new Cart;
                    $cart->order_id= $order->id;
                    if($details['order_type'] == "ebook"){
                        $cart->ebook_id= $details['ebook_id'];


                    }else{

                        $cart->course_id= $details['course_id'];

                    }


                    $cart->user_id = auth()->user()->id;
                    $cart->amount= $details['fee'];
                    $cart->discount=$details['discount'];
                    // $cart->cart_type='coursecart';
                    $cart->cart_type=$details['order_type'];
                    $cart->save();
                }

                $intent=route('user.my_order');
                $payment_gateway= \App\Models\Tp_option::where('option_name', 'payment_gateway')->first();
                $payment_gateway = json_decode($payment_gateway->option_value);
                $description =' Order No:'. $order->order_number;


                if($payment_method_id == "stripe"){
                    if($payment_gateway->stripe_status=='1'){
                        $stripe_secret =$payment_gateway->stripe_secret_key;

                        // Enter Your Stripe Secret
                        \Stripe\Stripe::setApiKey($stripe_secret);

                        $amount = $request->total_amount;

                        $amount = (float)$amount * 100;
                        $amount = (int) $amount;
                        //dd($amount);
                        if($payment_gateway->stripe_currency !=''){
                            $currency = $payment_gateway->stripe_currency;
                        }else{
                            $currency = 'usd';
                        }

                        $payment_intent = \Stripe\PaymentIntent::create([
                            'amount' => $amount,
                            'currency' => $currency,

                            'description' => $description,
                            'payment_method_types' => ['card']
                        ]);
                        $intent = $payment_intent->client_secret;
                    }

                }
                //Paypal
                elseif($payment_method_id == "paypal"){
                    $base_url = url('/');
                    if($payment_gateway->paypal_status=='1'){

                        if($payment_gateway->sand_box_mode=='1'){
                            $config = [
                                'mode'    => 'sandbox',
                                'sandbox' => [
                                    'client_id'         => $payment_gateway->paypal_client_id,
                                    'client_secret'     => $payment_gateway->paypal_secret_key,
                                    'app_id'            => 'APP-80W284485P519543T',
                                ],
                                'payment_action' => 'Sale',
                                'currency'       => $payment_gateway->paypal_currency,
                                'notify_url'     => $base_url.'/paypal/notify',
                                'locale'         => 'en_US',
                                'validate_ssl'   => true,
                            ];
                        }else{
                            $config = [
                                'mode'    => 'live',
                                'live' => [
                                    'client_id'         => $payment_gateway->paypal_client_id,
                                    'client_secret'     => $payment_gateway->paypal_secret_key,
                                    'app_id'            => 'APP-80W284485P519543T',
                                ],
                                'payment_action' => 'Sale',
                                'currency'       =>$payment_gateway->paypal_currency,
                                'notify_url'     => $base_url.'/paypal/notify',
                                'locale'         => 'en_US',
                                'validate_ssl'   => true,
                            ];
                        }

                        $provider = new PayPalClient;
                        $provider->setApiCredentials($config);
                        $paypalToken = $provider->getAccessToken();

                        $PayPalData = [
                            "intent" => "CAPTURE",
                            "application_context" => [
                                "return_url" => route('success.payment'),
                                "cancel_url" => route('cancel.payment'),
                            ],
                        "purchase_units" => [
                                0 => [
                                    "amount" => [
                                        "currency_code" => $payment_gateway->paypal_currency,
                                        "value" =>$request->total_amount
                                    ],
                                    "description" => $description
                                ]
                            ]
                        ];

                        $PayPalResponse = $provider->createOrder($PayPalData);

                        if (isset($PayPalResponse['id']) && $PayPalResponse['id'] != null){
                            foreach ($PayPalResponse['links'] as $links) {
                                if ($links['rel'] == 'approve') {
                                    $redirect_url = $links['href'];
                                    break;
                                }
                            }

                            if(isset($redirect_url)) {
                                $intent = $redirect_url;
                            }
                        }else{



                            $res['msgType'] = 'error_single';
                            $res['msg'] = __('Unknown error occurred.');
                            return response()->json($res);
                            // return redirect()
                            // ->to(route("frontend.checkout"))
                            // ->with('error_msg' , __('Unknown error occurred.'))
                            // ->withInput();
                        }
                    }


                }elseif($payment_method_id == "cod"){
                    session()->pull('cart');
                    $order->payment_status='paid';
                    $order->save();
                    self::orderNotify($order);
                }




                DB::commit();

                $res['msgType'] = 'success';
                $res['intent'] = $intent;
                $res['msg'] = "Your Order successfully.";
                return response()->json($res);
                // return redirect()->to($intent)->with('success','Your Order successfully.');
                // all good
            }catch (\Exception $e) {
                DB::rollback();
                $res['exta'] = $e->getMessage();
                $res['msgType'] = 'error_single';
                $res['msg'] = "somethig went worng";
                return response()->json($res);
                // return back();
                // something went wrong
            }






        }//auth check end

        else{
            $validator = Validator::make($request->all(),[
                'name'=>'string|required',
                'email'=>'string|required',
                'address'=>'string|required',
                'mobile'=>'string|required',
                'city'=>'string|required',
                'state'=>'required',
                'postcode'=>'required',
                'country_id'=>'required',
                'payment_method'=>'required',
            ]);
            if(!$validator->passes()){
                $res['msgType'] = 'error';
                $res['msg'] = $validator->errors()->toArray();
                return response()->json($res);
            }

            try{
                DB::beginTransaction();
                // dd(session()->has('order_id'));
                // if(session()->has('order_id')){
                //     $order= Order::find(session()->get('order_id'));
                //     foreach($order->cart as $cart){
                //         $cart->delete();
                //     }
                // }else{

                    $user = new User();
                    $user->name = $request->name ?? '';
                    $user->mobile = $request->mobile;
                    $user->email = $request->email;
                    $user->address = $request->address;
                    $user->type = 1;
                    $user->password =12345678;
                    $user->save();
                    auth()->login($user);

                $payment_method_id = $request->payment_method;
                $order=new Order();
                //}
               // $order=new Order();

                $order->order_number='ORD-'.strtoupper(Str::random(10));
                $order->user_id=$user->id;
                $order->order_type=1;
                $order->name=$request->name;
                $order->email=$request->email;
                $order->address=$request->address;
                $order->mobile=$request->mobile;
                $order->country_id=$request->country_id;
                $order->city=$request->city;
                $order->state=$request->state;
                $order->postcode=$request->postcode;
                $order->order_type='courseorder';
                $order->sub_total=$request->sub_total;
                $order->total_amount=$request->total_amount;
                $order->status="processing";
                $order->payment_status='unpaid';
                $order->payment_method = $payment_method_id;
                $order->order_note = $request->order_note;



                // $order->seller_amount = $request->order_note;
                // $order->teacher_amount = $request->order_note;



                // $payment_method_id
                $order->agree = isset($request-> agree) ? 1 : 0;
                $order->save();
                session()->put("pay_order_id",$order->id);

                $total=0;
                foreach(session('cart') as $id => $details){
                    $cart = new Cart;
                    $cart->order_id= $order->id;
                    if($details['order_type'] == "ebook"){
                       // dd(session('cart'));
                        $cart->ebook_id= $details['ebook_id'];
                    }else{

                        $cart->course_id= $details['course_id'];
                    }


                    $cart->user_id = $user->id;
                    $cart->amount= $details['fee'];
                    $cart->discount=$details['discount'];
                    // $cart->cart_type='coursecart';
                    $cart->cart_type=$details['order_type'];
                    $cart->save();
                }

                $intent=route('user.my_order');
                $payment_gateway= \App\Models\Tp_option::where('option_name', 'payment_gateway')->first();
                $payment_gateway = json_decode($payment_gateway->option_value);
                $description =' Order No:'. $order->order_number;


                if($payment_method_id == "stripe"){
                    if($payment_gateway->stripe_status=='1'){
                        $stripe_secret =$payment_gateway->stripe_secret_key;

                        // Enter Your Stripe Secret
                        \Stripe\Stripe::setApiKey($stripe_secret);

                        $amount = $request->total_amount;

                        $amount = (float)$amount * 100;
                        $amount = (int) $amount;
                        //dd($amount);
                        if($payment_gateway->stripe_currency !=''){
                            $currency = $payment_gateway->stripe_currency;
                        }else{
                            $currency = 'usd';
                        }

                        $payment_intent = \Stripe\PaymentIntent::create([
                            'amount' => $amount,
                            'currency' => $currency,

                            'description' => $description,
                            'payment_method_types' => ['card']
                        ]);
                        $intent = $payment_intent->client_secret;
                    }

                }
                //Paypal
                elseif($payment_method_id == "paypal"){
                    $base_url = url('/');
                    if($payment_gateway->paypal_status=='1'){

                        if($payment_gateway->sand_box_mode=='1'){
                            $config = [
                                'mode'    => 'sandbox',
                                'sandbox' => [
                                    'client_id'         => $payment_gateway->paypal_client_id,
                                    'client_secret'     => $payment_gateway->paypal_secret_key,
                                    'app_id'            => 'APP-80W284485P519543T',
                                ],
                                'payment_action' => 'Sale',
                                'currency'       => $payment_gateway->paypal_currency,
                                'notify_url'     => $base_url.'/paypal/notify',
                                'locale'         => 'en_US',
                                'validate_ssl'   => true,
                            ];
                        }else{
                            $config = [
                                'mode'    => 'live',
                                'live' => [
                                    'client_id'         => $payment_gateway->paypal_client_id,
                                    'client_secret'     => $payment_gateway->paypal_secret_key,
                                    'app_id'            => 'APP-80W284485P519543T',
                                ],
                                'payment_action' => 'Sale',
                                'currency'       =>$payment_gateway->paypal_currency,
                                'notify_url'     => $base_url.'/paypal/notify',
                                'locale'         => 'en_US',
                                'validate_ssl'   => true,
                            ];
                        }

                        $provider = new PayPalClient;
                        $provider->setApiCredentials($config);
                        $paypalToken = $provider->getAccessToken();

                        $PayPalData = [
                            "intent" => "CAPTURE",
                            "application_context" => [
                                "return_url" => route('success.payment'),
                                "cancel_url" => route('cancel.payment'),
                            ],
                           "purchase_units" => [
                                0 => [
                                    "amount" => [
                                        "currency_code" => $payment_gateway->paypal_currency,
                                        "value" =>$request->total_amount
                                    ],
                                    "description" => $description
                                ]
                            ]
                        ];

                        $PayPalResponse = $provider->createOrder($PayPalData);

                        if (isset($PayPalResponse['id']) && $PayPalResponse['id'] != null){
                            foreach ($PayPalResponse['links'] as $links) {
                                if ($links['rel'] == 'approve') {
                                    $redirect_url = $links['href'];
                                    break;
                                }
                            }

                            if(isset($redirect_url)) {
                                $intent = $redirect_url;
                            }
                        }else{



                            $res['msgType'] = 'error_single';
                            $res['msg'] = __('Unknown error occurred.');
                            return response()->json($res);
                            // return redirect()
                            // ->to(route("frontend.checkout"))
                            // ->with('error_msg' , __('Unknown error occurred.'))
                            // ->withInput();
                        }
                    }


                }elseif($payment_method_id == "cod"){
                    session()->pull('cart');
                    $order->payment_status='paid';
                    $order->save();
                    self::orderNotify($order);
                }


                DB::commit();

                // return redirect()->route('user.my_order');

                $res['msgType'] = 'success';
                $res['intent'] = $intent;
                $res['msg'] = "Your Order successfully.";

                return response()->json($res);
                // return redirect()->to($intent)->with('success','Your Order successfully.');
                // all good
            }catch (\Exception $e) {
                DB::rollback();
                $res['exta'] = $e->getMessage();
                $res['msgType'] = 'error_single';
                $res['msg'] = "somethig went worng";
                return response()->json($res);
                // return back();
                // something went wrong
            }
        }
    }
    public function paymentCancel(){
		$order_master_id = session()->get('pay_order_id');

        session()->forget('pay_order_id');

		Order::whereIn('order_master_id', $order_master_id)->delete();
		Cart::whereIn('order_id', $order_master_id)->delete();

		return redirect()->route('frontend.checkout_payment')->with('pt_payment_error', __('You have canceled the transaction'));
    }
    public function stripePaymentCancel(){
		$order_master_id = session()->get('pay_order_id');

        session()->forget('pay_order_id');

		Order::whereIn('order_master_id', $order_master_id)->delete();
		Cart::whereIn('order_id', $order_master_id)->delete();

		return redirect()->route('frontend.checkout_payment')->with('pt_payment_error', __('Your Stripe canceled the transaction'));
    }
    public function stripePaymentSuccess(){
		$order_master_id = session()->get('pay_order_id');

        session()->forget('add_coupon_code');
        session()->forget('add_coupon_amount');
        session()->forget('pay_order_id');

		session()->forget('cart');

        $order=Order::find($order_master_id);
        self::orderNotify($order);


        return redirect()->to("/")->with('message','Order is Successfully.');
    }

    public function paymentSuccess(Request $request){
		$payment_gateway= \App\Models\Tp_option::where('option_name', 'payment_gateway')->first();
        $payment_gateway = json_decode($payment_gateway->option_value);
		$order_master_id = session()->get('pay_order_id');

        session()->forget('pay_order_id');
        $base_url = url('/');
		if($payment_gateway->sand_box_mode==1){
			$config = [
				'mode'    => 'sandbox',
				'sandbox' => [
					'client_id'         => $payment_gateway->paypal_client_id,
                    'client_secret'     => $payment_gateway->paypal_secret_key,
					'app_id'            => 'APP-80W284485P519543T',
				],
				'payment_action' => 'Sale',
				'currency'       => $payment_gateway->paypal_currency,
                'notify_url'     => $base_url.'/paypal/notify',
				'locale'         => 'en_US',
				'validate_ssl'   => true,
			];
		}else{
			$config = [
				'mode'    => 'live',
				'live' => [
                    'client_id'         => $payment_gateway->paypal_client_id,
                    'client_secret'     => $payment_gateway->paypal_secret_key,
					'app_id'            => 'APP-80W284485P519543T',
				],
				'payment_action' => 'Sale',
				'currency'       => $payment_gateway->paypal_currency,
                'notify_url'     => $base_url.'/paypal/notify',
				'locale'         => 'en_US',
				'validate_ssl'   => true,
			];
		}

        $provider = new PayPalClient;
        $provider->setApiCredentials($config);
        $provider->getAccessToken();
        $PayPalResponse = $provider->capturePaymentOrder($request['token']);
        if (isset($PayPalResponse['status']) && $PayPalResponse['status'] == 'COMPLETED') {

			session()->forget('cart');
            session()->forget('add_coupon_code');
            session()->forget('add_coupon_amount');
			$order=Order::find($order_master_id);
			self::orderNotify($order);


            return redirect()->to("/")->with('message','Order is Successfully.');
        } else {

			Order::whereIn('order_master_id', $order_master_id)->delete();
		    Cart::whereIn('order_id', $order_master_id)->delete();

			return redirect()->route('frontend.checkout_payment')->with('pt_payment_error', __('You have canceled the transaction'));
        }
    }
    function checkoutPayment(){
        return view('frontend.checkout-payment');
    }

    function orderNotify($order){
        foreach($order->carts as $cart){
            if($cart->ebook_id){
                $ebookparticipant=New EbookParticipant();
                $ebookparticipant->ebook_id= $cart->ebook_id;
                // dd(auth()->user()->id);
                $ebookparticipant->user_id = $order->user_id;
                $ebookparticipant->save();
                $admins = User::where('type', 0)->get();
                foreach($admins as $admin){
                    $notification=New Notification();
                    $notification->relation_id = $cart->id;
                    $notification->text = 'Ebook Order';
                    $notification->user_id = $admin->id;
                    $notification->type = 'ebook';
                    $notification->save();
                }
                $notification=New Notification();
                $notification->relation_id = $cart->id;
                $notification->text = 'Ebook Order successfully';
                $notification->user_id = $order->user_id;
                $notification->type = 'ebook';
                $notification->save();
            }else{
                $courseparticipant=New CourseParticipant();
                $courseparticipant->course_id= $cart->course_id;
                $courseparticipant->user_id = $order->user_id;
                $courseparticipant->save();
                $admins = User::where('type', 0)->get();
                foreach($admins as $admin){
                    $notification=New Notification();
                    $notification->relation_id = $cart->id;
                    $notification->text = 'Course Order';
                    $notification->user_id = $admin->id;
                    $notification->type = 'course';
                    $notification->save();
                }

                $notification=New Notification();
                $notification->relation_id = $cart->id;
                $notification->text = 'Course Order successfully';
                $notification->user_id = $order->user_id;
                $notification->type = 'course';
                $notification->save();

                $course = Course::find($cart->course_id);
                $notification=New Notification();
                $notification->relation_id = $cart->id;
                $notification->text = 'Course Order';
                $notification->user_id = $course->teacher_id;
                $notification->type = 'course';
                $notification->save();
            }
        }



        $admins = User::where('type', 0)->get();
        foreach($admins as $admin){
            $send_mail =$admin->email;
            $details['email'] =  $send_mail;
            $details['send_item']=new CourseOrderNotificationAdmin($order);
            dispatch(new \App\Jobs\SendEmailJob($details));
        }

        $send_mail =$order->user->email;
        $details['email'] =  $send_mail;
        $details['send_item']=new CourseOrderNotificationStudent($order);
        dispatch(new \App\Jobs\SendEmailJob($details));

        // $admins = User::where('type', 0)->get();
        // foreach($admins as $admin){
        //     $send_mail =$admin->email;
        //     $details['email'] =  $send_mail;
        //     $details['send_item']=new CourseOrderNotificationAdmin($order);
        //     dispatch(new \App\Jobs\SendEmailJob($details));
        // }

        // $send_mail =auth()->user()->email;
        // $details['email'] =  $send_mail;
        // $details['send_item']=new CourseOrderNotificationStudent($order);
        // dispatch(new \App\Jobs\SendEmailJob($details));
    }
    function getCouponByCode(Request $request,$code){
        $coupon = Coupon::where('code',$code)->first();
        $amount = 0;
        if($coupon){
            session()->put("add_coupon_code",$code);
            if($coupon->type == 0){
                $amount = (float)$request->total * ((float)$coupon->amount/100);
            }else{
                $amount =  $coupon->amount;
            }
            session()->put("add_coupon_amount",$amount);
            return response()->json(['status'=>'yes','amount'=>$amount]);
        }
        return response()->json(['status'=>'no']);

    }


}
