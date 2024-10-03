<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['coupons'] = Coupon::orderBy('id', 'desc')->get();
        return view("Backend.home.coupon.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.home.coupon.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([

            'code' => 'required',
            'type' => 'required',
            'amount' => 'required',

        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->save();
        return redirect()->route('admin.coupon.index')->with('message','Coupon Add Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["coupon"]=Coupon::find($id);
        return view("Backend.home.coupon.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'amount' => 'required',

        ]);

        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->status = $request->status;
        // $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);


        $coupon->save();
        return redirect()->route('admin.coupon.index')->with('message','coupon  Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $coupon= Coupon::find($request->coupon_id);
        $coupon->delete();
        return redirect()->route('admin.coupon.index')->with('message','coupon  Delete Successfully');

    }
}
