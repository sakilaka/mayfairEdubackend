<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventParticipant;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\EventCart;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Mail\EventOrderNotificationAdmin;
use App\Mail\EventOrderNotificationStudent;

class EventCartController extends Controller
{
    public function eventCart($id)
    {
        $event = Event::findOrFail($id);
        $eventcart = session()->get('eventcart', []);
            $eventcart[$id] = [
                "name" => $event->name,
                "event_id" => $event->id,
                "fee" => $event->fee,
                "image" => $event->host->image_show ?? '',
            ];

        session()->put('eventcart', $eventcart);
        return redirect()->route('eventchackout');

    }


    public function eventCheckOut()
    {
        return view('Frontend.eventcheckout');
    }


    public function eventcartremove($id)
    {
        if($id) {
            $eventcart = session()->get('eventcart');
            if(isset($eventcart[$id])) {
                unset($eventcart[$id]);
                session()->put('eventcart', $eventcart);
            }
            session()->flash('success', 'Event removed successfully');

            return view('Frontend.eventcheckout');
        }
    }


    public function eventCartStore(Request $request)
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
            //dd(session()->has('order_id'));
            // if(session()->has('order_id')){
            //     $order= EventParticipant::find(session()->get('order_id'));
            //     foreach($order->eventcart as $eventcart){
            //         $eventcart->delete();
            //     }
            // }else{
                $order=new EventParticipant();
            // }

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


            $order->sub_total=$request->sub_total;
            $order->total_amount=$request->total_amount;
            $order->status="new";

            $order->payment_status='paid';
            $order->save();
            $total=0;

            // if(isset($request->user_save_data)){
            //     $user = User::find(auth()->user()->id);
            //     $user->name=$request->name;
            //     $user->second_name=$request->second_name;
            //     $user->address=$request->address;
            //     $user->city=$request->city;
            //     $user->post_code=$request->post_code;
            //     $user->province=$request->province;
            //     $user->country=$request->country;
            //     $user->save();
            // }


            foreach(session('eventcart') as $id => $details){
                $cart = new EventCart;
                $cart->order_id= $order->id;
                $cart->user_id = auth()->user()->id;
                $cart->event_id= $details['event_id'];
                $cart->amount= $details['fee'];
                $cart->save();

                $notification=New Notification();
                $notification->relation_id = $cart->id;
                $notification->text = 'Event Participant Successfully';
                $notification->user_id = auth()->user()->id;
                $notification->type = 'event';
                $notification->save();

                $admins = User::where('type', 0)->get();
                foreach($admins as $admin){
                    $notification=New Notification();
                    $notification->relation_id = $cart->id;
                    $notification->text = 'Event Participant';
                    $notification->user_id = $admin->id;
                    $notification->type = 'event';
                    $notification->save();

                }
            }


            $admins = User::where('type', 0)->get();
            foreach($admins as $admin){
            $send_mail =$admin->email;
            $details['email'] =  $send_mail;
           $details['send_item']=new EventOrderNotificationAdmin($order);
           dispatch(new \App\Jobs\SendEmailJob($details));
            }

            $send_mail =auth()->user()->email;
            $details['email'] =  $send_mail;
            $details['send_item']=new EventOrderNotificationStudent($order);
            dispatch(new \App\Jobs\SendEmailJob($details));

            session()->pull('eventcart');
            // session()->put('order_id', $order->id);
            DB::commit();
            // return redirect()->route('order.payment');
            return redirect()->route('user.my_event')->with('success','Your Event Add successfully.');
            // all good
        }catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return back();
            // something went wrong
        }
    }





}
