<?php

namespace App\Http\Controllers\Backend\HR_Management\Leave;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Hrleave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HrleaveController extends Controller
{
    public function home(){
        $employees = Employee::latest()->get();
        $leave=Hrleave::latest()->get();
        return view('Backend.Hr_management.Leave.Leave',compact('leave','employees'));
    }
    public function add_leave(Request $request){
        //return $request->all();
        $rules =[
            'employee_name' => 'required',
            'leave_type' => 'required',
            'leave_reason' => 'required',
            'leave_status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $leave=new Hrleave();
        $leave->employee_id  = $request->employee_name;
        $leave->leave_type = $request->leave_type;
        $leave->reason = $request->leave_reason;
        $leave->status = $request->leave_status;
        $leave->save();
        return redirect()->route('admin.leave.home')->with('success', 'Added successfully');
    }
    public function edit_leave($id){
        $leave=Hrleave::find($id);
        $employees = Employee::latest()->get();
        return view('Backend.Hr_management.Leave.Update_Leave',compact('leave','employees'));
    }
    public function update_leave(Request $request){
        // Validate the incoming request data
        $request->validate([
            'leave_id' => 'required',
            'employee_name' => 'required',
            'leave_type' => 'required',
            'leave_reason' => 'required',
            'leave_status' => 'required',
        ]);

        try {
            // Find the Leave_application model by ID
            $leave = Hrleave::find($request->leave_id);

            // Update the model with the new data from the form
            $leave->employee_id = $request->employee_name;
            $leave->leave_type = $request->leave_type;
            $leave->reason = $request->leave_reason;
            $leave->status = $request->leave_status;

            // Save the updated model
            $leave->save();

            // Redirect back to the leave list page with success message
            return redirect()->route('admin.leave.home')->with('success', 'Leave application updated successfully.');
        } catch (\Exception $e) {
            // If any error occurs during the update process, redirect back with error message
            return redirect()->route('admin.leave.home')->with('error', 'Failed to update leave application. Please try again.');
        }
    }
    public function leave_delete($id){
        $leave = Hrleave::findOrFail($id);
        $leave->delete();

        return redirect()->route('admin.leave.home')->with('success', 'deleted successfully');
    }

}
