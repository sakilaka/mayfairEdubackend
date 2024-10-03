<?php

namespace App\Http\Controllers\Backend\HR_management\Shift;

use App\Http\Controllers\Controller;
use App\Models\Hrshift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HrshiftController extends Controller
{
    public function home(){
        $shift=Hrshift::latest()->get();
        return view('Backend.Hr_management.Shift.Shift',compact('shift'));
    }
    public function edit_shift($id){
        $shift=Hrshift::find($id);
        return view('Backend.Hr_management.Shift.Update_Shift',compact('shift'));
    }
    public function update_shift(Request $request){
        $rules =[
            'shift_id' => 'required|integer',
            'shift_name' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $shift=Hrshift::find($request->shift_id);
        $shift->name = $request->shift_name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->update();
        return redirect()->route('admin.shift.home')->with('success', 'Shift updated successfully');
    }
    public function shift_delete($id){
        $shift=Hrshift::find($id);
        $shift->delete();
        return redirect()->route('admin.shift.home')->with('success', 'Delete successfully');
    }
    public function add_shift(Request $request){
        $rules =[
            'shift_name' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $shift=new Hrshift();
        $shift->name = $request->shift_name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->save();
        return redirect()->route('admin.shift.home')->with('success', 'Added successfully');
    }
}
