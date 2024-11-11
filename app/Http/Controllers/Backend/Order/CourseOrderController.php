<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Revenue;
use App\Models\SiteSetting;

class CourseOrderController extends Controller
{
    public function CourseOrderManage()
     {
        $data['orders'] = Order::where('order_type','courseorder')->orderBy('id','desc')->get();
        return view('Backend.order.courseorder.index', $data);
     }

     public function CourseOrderDetails($id)
     {
        $data['orderdetails'] = Order::find($id);
        $data['site_setting'] = SiteSetting::first();
        return view('Backend.order.courseorder.details', $data);
     }
     function OrderPrint($id){
        $data['orderdetails'] = Order::find($id);
        $data['site_setting'] = SiteSetting::first();
        return view('Backend.order.courseorder.print', $data);
     }

     public function CourseStatusChange(Request $request ,$id)
     {

         $order = Order::find($id);
        

         if($request->status != "delivered"){
            if($order->status == "delivered"){
               //remove previous data
               foreach($order->carts as $cart){
                  if($cart->ebook_id){
                     $e_book=Ebook::find($cart->ebook_id);
                     $revenue  = Revenue::where('user_id',$e_book->user_id)->where('cart_id',$cart->id)->first();
                     if($revenue){
                        $user = $e_book->user;
                        $user->current_balance=$user->current_balance - $revenue->seller_amount;
                        $user->save();
                     
                        $revenue->delete();
                     }
                     
                  

                  }else{
                     $course=Course::find($cart->course_id);
                     $revenue  = Revenue::where('user_id',$course->teacher_id)->where('cart_id',$cart->id)->first();
                     // dd($revenue);
                     if($revenue){
                        $user = $course->teacher;
                        $user->current_balance=$user->current_balance - $revenue->seller_amount;
                        $user->save();
                     
                        $revenue->delete();
                     }
                     
                  }
               }
               $order->seller_amount =0;
               $order->admin_amount =0;
               $order->save();
            }
         }else{
            if($order->status != "delivered"){
               //inser data
               $total_seller_amount=0;
               $commit_conf= \App\Models\Tp_option::where('option_name', 'commission')->first();
               //   dd($commit_conf);
               $seller_percent = 0;
               if($commit_conf->seller_commission){
                     $seller_percent =$commit_conf->seller_commission;
                     // dd($seller_percent);
               }
               
               $commit_conf_t= \App\Models\Tp_option::where('option_name', 'commission')->first();
               $teacher_percent = 0;
               if($commit_conf_t->teacher_commission){
                     $teacher_percent =$commit_conf_t->teacher_commission;
                     // dd($teacher_percent);
               }
               foreach($order->carts as $cart){
                  if($cart->ebook_id){
                     $e_book=Ebook::find($cart->ebook_id);

                     if( $seller_percent == 0 ){
                        $seller_amount = 0;
                     }else{
                        $seller_amount = ($cart->amount - $cart->discount) * $seller_percent/100;
                     }
                     $revenue  = New Revenue();
                     $revenue->user_id= $e_book->user_id;
                     $revenue->cart_id= $cart->id;
                     $revenue->seller_amount =  $seller_amount;
                     $revenue->admin_amount = ($cart->amount - $cart->discount) - $seller_amount;
                     $revenue->save();
                     $user = $e_book->user;
                     $user->current_balance=$user->current_balance + $seller_amount;
                     $user->save();

                  }else{
                     $course=Course::find($cart->course_id);
                     if( $teacher_percent == 0 ){
                           $seller_amount = 0;
                     }else{
                           $seller_amount = ($cart->amount - $cart->discount) * $teacher_percent/100;
                     }
                     $revenue  = New Revenue;
                     $revenue->cart_id= $cart->id;
                     $revenue->user_id= $course->teacher_id;
                     $revenue->seller_amount =  $seller_amount;
                     $revenue->admin_amount =  ($cart->amount - $cart->discount) - $seller_amount;
                     $revenue->save();
                     $user = $course->teacher;
                     // dd($user);
                     $user->current_balance=$user->current_balance + $seller_amount;
                     $user->save();
                  }
                  $total_seller_amount +=  $seller_amount;
               }
               $order->seller_amount = $total_seller_amount;
               $order->admin_amount =$order->total_amount - $total_seller_amount;
               $order->save();
            }
         }

         $order->status=$request->status;
         $order->update();   
        return redirect()->back();
     }

     public function CourseStatusChangeIndex(Request $request)
     {
        $status = Order::find($request->paymentstatus_id);
        $status->status=$request->status;
        $status->update();
        return redirect()->back();

     }



}
