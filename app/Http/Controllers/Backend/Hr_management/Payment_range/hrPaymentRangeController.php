<?php

namespace App\Http\Controllers\Backend\Hr_management\Payment_range;
use App\Http\Controllers\Controller;
use App\Models\Payment_range;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Models\Designation;
use App\Models\Hrrank;
use Illuminate\Http\Request;

class hrPaymentRangeController extends Controller
{
    public function home(){
        $department=Department::where('type',2)->latest()->get();
        $designation=Designation::latest()->get();
        $rank=Hrrank::latest()->get();
        $payment_range=Payment_range::latest()
        ->get();
        return view('Backend.Hr_management.Payment_range.payment_range',compact('payment_range','department','designation','rank'));
    }

    public function add_payment_range(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'designation_id' => 'required',
            'rank_id' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required'
        ]);
        $payment_range = new Payment_range();
        $payment_range->department_id = $request->department_id;
        $payment_range->designation_id = $request->designation_id;
        $payment_range->hrrank_id = $request->rank_id;
        $payment_range->minimum_amount = $request->minimum_amount;
        $payment_range->maximum_amount = $request->maximum_amount;
        $payment_range->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function get_designation_data($id)
    {
        $designation_data= DB::table("designations")
        ->where("department_id",$id)
        ->get();

        return json_encode($designation_data);
    }
    public function edit_payment_range($id)
    {
        $department=Department::where('type',2)->latest()->get();
        $designation=Designation::latest()->get();
        $rank=Hrrank::latest()->get();
        $payment_range = Payment_range::find($id);
        return view('Backend.Hr_management.Payment_range.Update_payment_range', compact('payment_range','department','designation','rank'));
    }

    public function update_payment_range(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'designation_id' => 'required',
            'rank_id' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required'
        ]);
        $payment_range = Payment_range::find($request->payment_range_id);
        $payment_range->department_id = $request->department_id;
        $payment_range->designation_id = $request->designation_id;
        $payment_range->hrrank_id = $request->rank_id;
        $payment_range->minimum_amount = $request->minimum_amount;
        $payment_range->maximum_amount = $request->maximum_amount;
        $payment_range->update();
        return redirect()->route('admin.payment_range.home')->with('success', 'Update Success');
    }
    public function delete_payment_range($id)
    {
        $designation = Payment_range::find($id);
        $designation->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
