<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\SiteSetting;
use App\Models\EventParticipant;

class EventOrderController extends Controller
{
    public function EventOrderManage()
    {
       $data['events'] = EventParticipant::orderBy('id','desc')->get();
       return view('Backend.order.eventorder.index', $data);
    }

    public function EventOrderDetails($id)
    {
       // dd('h1');
       $data['eventdetails'] = EventParticipant::find($id);
       $data['site_setting'] = SiteSetting::first();
       return view('Backend.order.eventorder.details', $data);
    }
    function EventOrderPrint($id){
       $data['eventdetails'] = EventParticipant::find($id);
       $data['site_setting'] = SiteSetting::first();
       return view('Backend.order.eventorder.print', $data);
    }

    public function EventStatusChange(Request $request ,$id)
    {

       $status = EventParticipant::find($id);
       $status->status=$request->status;
       $status->update();
       return redirect()->back();
    }

    public function EventStatusChangeIndex(Request $request)
    {
       $status = EventParticipant::find($request->eventstatus_id);
       $status->status=$request->status;
       $status->update();
       return redirect()->back();

    }
}
