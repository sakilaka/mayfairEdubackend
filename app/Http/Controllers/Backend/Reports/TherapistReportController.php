<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\BookingItem;
use App\Models\Service;
use App\Models\ServiceBooking;
use Illuminate\Http\Request;

class TherapistReportController extends Controller
{
    function report(Request $request)
    {
       return view("Backend.reports.therapist");
    }
    function getTherapistData(Request $request){
        $service =  Service::where('template',"therapist-package")->first();
        $totalData = ServiceBooking::where('service_id',$service->id)->count();
        $columns = array(
            0 =>'service_bookings.id',
            1 =>'start_date',
            2=> 'end_date',
            3=> 'invoice_code',
            4=> 'therapies.fname',
            5=> 'therapies.mobile',
            6=> 'therapies.email',
            7=> 'users.fname',
            8=> 'users.mobile',
            9=> 'users.email',
            8=> 'booking_fee',
            9=> 'status',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $start_date = $request->input('columns.1.search.value');
        $end_date = $request->input('columns.2.search.value');
       // $totalFiltered = ServiceBooking::where('service_id',$service->id)->count();
        if($search){
            $datas = ServiceBooking::where('service_id',$service->id)
                ->leftJoin('therapies','therapies.id','service_bookings.relation_id')
                ->leftJoin('users','users.id','service_bookings.user_id')
                ->where(function($q) use ($search) {
                    $q->where('invoice_code','like','%'.$search.'%')
                    ->orWhere('therapies.fname','like','%'.$search.'%')
                    ->orWhere('therapies.mobile','like','%'.$search.'%')
                    ->orWhere('therapies.email','like','%'.$search.'%')
                    ->orWhere('users.fname','like','%'.$search.'%')
                    ->orWhere('users.mobile','like','%'.$search.'%')
                    ->orWhere('users.email','like','%'.$search.'%')
                    ->orWhere('booking_fee','like','%'.$search.'%');
                })
                ->Select('service_bookings.*')
                // ->offset($start)
                // ->limit($limit)
                ->orderBy($order,$dir);


        }else{
            $datas = ServiceBooking::where('service_id',$service->id)
            // ->offset($start)
            // ->limit($limit)
            ->Select('service_bookings.*')
            ->leftJoin('therapies','therapies.id','service_bookings.relation_id')
            ->leftJoin('users','users.id','service_bookings.user_id')
            ->orderBy($order,$dir);

        }
        $filter_total = $datas->count();
        if($limit != '-1'){
            $datas = $datas->offset($start)
                ->limit($limit)
                ->get();
        }else{
              $datas = $datas->get();
        }

        $i=0;
        $data = array();
        foreach ($datas as $n_data)
        {
            $i++;
            $nestedData['sl'] = $i;
                // $nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
            $nestedData['package_buy_date'] = date('j M Y',strtotime($n_data->created_at));
            $nestedData['start_date'] = date('j M Y',strtotime($n_data->start_date));
            $nestedData['end_date'] = date('j M Y',strtotime($n_data->end_date));
            $nestedData['invoice'] = $n_data->invoice_code;
            $nestedData['therapist_name'] = $n_data->therapist->fname.' '. $n_data->therapist->lname;
            $nestedData['therapist_mobile'] = $n_data->therapist->mobile;
            $nestedData['therapist_email'] = $n_data->therapist->email;
            $nestedData['cus_name'] = $n_data->user->fname.' '. $n_data->user->lname;
            $nestedData['cus_mobile'] = $n_data->user->mobile;
            $nestedData['cus_email'] = $n_data->user->email;
            $nestedData['fee'] = $n_data->booking_fee;
            $nestedData['status'] = $n_data->status;
            $data[] = $nestedData;

        }
        $json_data = array(
            "request" =>$limit,
        "draw"            => intval($request->input('draw')),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($filter_total),
        "data"            => $data
        );

        echo json_encode($json_data);
    }
    function reportPackage(Request $request)
    {

       return view("Backend.reports.therapist_item");
    }
    function getTherapistPackageData(Request $request){
        $service =  Service::where('template',"therapist-package")->first();
        $totalData = BookingItem::where('service_id',$service->id)->count();
        $columns = array(
            0 =>'booking_items.id',
            1 =>'booking_items.created_at',
            2=> 'service_bookings.invoice_code',
            3=> 'therapies.fname',
            4=> 'booking_items.item_price',
            5=> 'booking_items.item_discount',
        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
         if($search){
            $datas = BookingItem::where('booking_items.service_id',$service->id)
                ->leftJoin('service_bookings','service_bookings.id','booking_items.booking_id')
                ->leftJoin('therapies','therapies.id','service_bookings.relation_id')
                ->where(function($q) use ($search) {
                    $q->where('service_bookings.invoice_code','like','%'.$search.'%')
                    ->orWhere('therapies.fname','like','%'.$search.'%')
                    ->orWhere('booking_items.item_price','like','%'.$search.'%');
                })
                ->Select('booking_items.*')
                ->orderBy($order,$dir);


        }else{
            $datas = BookingItem::where('booking_items.service_id',$service->id)
                ->leftJoin('service_bookings','service_bookings.id','booking_items.booking_id')
                ->leftJoin('therapies','therapies.id','service_bookings.relation_id')
            ->Select('booking_items.*')
            ->orderBy($order,$dir);

        }
        $filter_total = $datas->count();
        if($limit != '-1'){
            $datas = $datas->offset($start)
                ->limit($limit)
                ->get();
        }else{
              $datas = $datas->get();
        }

        $i=0;
        $data = array();
        foreach ($datas as $n_data)
        {
            $i++;
            $nestedData['sl'] = $i;
                // $nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
            $nestedData['package_buy_date'] = date('j M Y',strtotime($n_data->created_at));
            $nestedData['invoice'] = $n_data->servicebooking->invoice_code;
            $nestedData['therapist_name'] = $n_data->servicebooking->therapist->fname.' '. $n_data->therapist->lname;
            $nestedData['package_name'] = $n_data->serviceItem->name;
            $nestedData['fee'] = $n_data->item_price;
            $nestedData['discount'] = $n_data->item_discount;
            $data[] = $nestedData;

        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($filter_total),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
