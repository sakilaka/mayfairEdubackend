<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SiteSetting;

class UserSubscriptionOrderController extends Controller
{
    public function PackageOrderManage()
     {
        $data['orders'] = Order::where('order_type','coursepackage')->orderBy('id','desc')->get();
        return view('Backend.order.coursepackage.index', $data);
     }

     public function PackageOrderDetails($id)
     {
        //dd('hi');
        $data['orderdetails'] = Order::find($id);
        $data['site_setting'] = SiteSetting::first();
        return view('Backend.order.coursepackage.details', $data);
     }
     function packageOrderPrint($id){
        $data['orderdetails'] = Order::find($id);
        $data['site_setting'] = SiteSetting::first();
        return view('Backend.order.coursepackage.print', $data);
     }

     public function PackageStatusChange(Request $request ,$id)
     {

        $status = Order::find($id);
        $status->status=$request->status;
        $status->update();
        return redirect()->back();
     }

     public function PackageStatusChangeIndex(Request $request)
     {
        $status = Order::find($request->paymentstatus_id);
        $status->status=$request->status;
        $status->update();
        return redirect()->back();

     }
}
