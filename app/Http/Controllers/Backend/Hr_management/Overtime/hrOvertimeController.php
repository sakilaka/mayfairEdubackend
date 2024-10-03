<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Backend\Hr_management\Overtime;
use App\Http\Controllers\Controller;
use App\Models\Overtime;
use Illuminate\Http\Request;

class hrOvertimeController extends Controller
{
    public function home(){
        $overtime=Overtime::latest()->get();
        return view('Backend.Hr_management.Overtime.overtime',compact('overtime'));
    }

    public function edit_overtime($id)
    {
        $overtime = Overtime::find($id);
        return view('Backend.Hr_management.Overtime.Update_overtime', compact('overtime'));
    }


    public function update_overtime(Request $request)
    {
        $request->validate([
            'overtime_id' => 'required',
            'overtime_hour' => 'required',
            'overtime_amount' => 'required'
        ]);

        $overtime = Overtime::find($request->overtime_id);
        $overtime->hour = $request->overtime_hour;
        $overtime->amount = $request->overtime_amount;
        $overtime->update();
        return redirect()->route('admin.overtime.home')->with('success', 'Update Success');
    }

    public function add_overtime(Request $request)
    {
        $request->validate([
            'hour' => 'required',
            'amount' => 'required'
        ]);
        $overtime = new Overtime();
        $overtime->hour = $request->hour;
        $overtime->amount = $request->amount;
        $overtime->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function delete_overtime($id)
    {
        $designation = Overtime::find($id);
        $designation->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
