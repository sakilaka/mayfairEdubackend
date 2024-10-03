<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\BusinessPackages;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Notification;
use App\Models\CourseParticipant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\PackageOrderNotificationAdmin;
use App\Mail\PackageOrderNotificationStudent;

class CourseUserSubscriptionsController extends Controller
{
    public function CourseUseSubscriptions($id)
    {
       // dd($id);
        $subscription = BusinessPackages::findOrFail($id);
        $subscriptionscart = session()->get('subscriptionscart', []);

        if($subscription->discount > 0){
            $new_price = $subscription->price - $subscription->discount;

        }else{
            $new_price = $subscription->price;
        }

       // dd($new_price);

              $subscriptionscart[$id] = [
                "name" => $subscription->name,
                "packageprice" => $new_price,
                "preprice"=>$subscription->price,
                "package_id"=>$subscription->id,
                "discount" => $subscription->discount,

            ];

        session()->put('subscriptionscart', $subscriptionscart);
       // session()->pull('subscriptionscart');
        return redirect()->route('user.subscriptions_checkout');
        // return redirect()->route('user.subscriptions_checkout');

    }


    public function CourseUseSubscriptionsCheck()
    {
        return view('Frontend.usersubscriptionscheck');
    }


    public function subscriptionsCartRemove($id)
    {
        if($id) {
            $subscriptionscart = session()->get('subscriptionscart');
            if(isset($subscriptionscart[$id])) {
                unset($subscriptionscart[$id]);
                session()->put('subscriptionscart', $subscriptionscart);
            }
            session()->flash('success', 'Package Cart removed successfully');

            return view('Frontend.usersubscriptionscheck');
        }
    }


    public function packageSubscriptionOrder(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'name'=>'string|required',
            'email'=>'string|required',
            'address'=>'string|required',
            'mobile'=>'string|required',
            'city'=>'string|required',
            'state'=>'required',
            'postcode'=>'required',
            'country_id'=>'required',
        ]);
        DB::beginTransaction();
        try{

            $order=new Order();
            $order->order_number='ORD-'.strtoupper(Str::random(10));
            $order->user_id=auth()->user()->id;
            //$order->order_type=2;

            $order->name=$request->name;
            $order->email=$request->email;
            $order->address=$request->address;
            $order->mobile=$request->mobile;
            $order->country_id=$request->country_id;
            $order->city=$request->city;
            $order->state=$request->state;
            $order->postcode=$request->postcode;
            $order->order_type='coursepackage';
            $order->sub_total=$request->sub_total;
            $order->total_amount=$request->total_amount;

            $order->status="new";
            $order->payment_status='paid';
            $order->save();
            $total=0;



            foreach(session('subscriptionscart') as $id => $details){
                $cart = new Cart;
                $cart->order_id= $order->id;
                $cart->user_id = auth()->user()->id;
                $cart->amount= $details['packageprice'];
                $cart->discount=$details['discount'];
                $cart->package_id=$details['package_id'];
                $cart->cart_type='packagecart';
                $cart->save();

                $admins = User::where('type', 0)->get();
                foreach($admins as $admin){
                    $notification=New Notification();
                    $notification->relation_id = $cart->id;
                    $notification->text = 'Package Orderd';
                    $notification->user_id = $admin->id;
                    $notification->type = 'package';
                    $notification->save();

                }

                $notification=New Notification();
                $notification->relation_id = $cart->id;
                $notification->text = 'Package order successfully';
                $notification->user_id = auth()->user()->id;
                $notification->type = 'package';
                $notification->save();

            }

            $admins = User::where('type', 0)->get();
            foreach($admins as $admin){
            $send_mail =$admin->email;
            $details['email'] =  $send_mail;
           $details['send_item']=new PackageOrderNotificationAdmin($order);
           dispatch(new \App\Jobs\SendEmailJob($details));
            }

            $send_mail =auth()->user()->email;
            $details['email'] =  $send_mail;
            $details['send_item']=new PackageOrderNotificationStudent($order);
            dispatch(new \App\Jobs\SendEmailJob($details));


            session()->pull('subscriptionscart');
            // session()->put('order_id', $order->id);
            DB::commit();
            // return redirect()->route('order.payment');
            return redirect()->route('user.my_package')->with('success','Your Package Order Add successfully.');
            // all good
        }catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return back();
            // something went wrong
        }
    }





}
