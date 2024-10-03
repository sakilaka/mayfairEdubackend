<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Hrleave;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Session;

use Redirect;

use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function applyLeave(){

        $employee = DB::table('employee_info')->get();
        // $category = DB::table('category')->get(['cat_id','categoryName']);

        return view('backend.hr.leave.apply_leave',compact('employee'));
    }
    public function storeLeaveApplication(Request $request){

        DB::table('leave')->insert([
            'empId' => $request->empId,
            'type'  => $request->type,
            'part'  => $request->part,
            'reason' => $request->reason,
            'address' => $request->address,
            'department'=>$request->department,
            'designation'=>$request->designation,
            // 'status' => $request->status,
            'from' => $request->from,
            'to' => $request->to,
            'day' => $request->day
        ]);

        return redirect('/manageLeaveApplications');
    }

    public function manageLeaveApplications(){
        $viewAll = DB::table('leave')->get();
        $employee = DB::table('employee_info')->get();
        return view('backend.hr.leave.manage',compact('viewAll','employee'));
    }

    public function manageAttendance(){
       // $viewAll =Hrleave::get();
        $employees = Employee::get();
        $attendances = Attendance::get();
        $departments = Department::where('type',2)->get();
        $shifts = DB::table('shift')->get();
        return view('backend.hr.attendance.manage',compact('departments','employees','attendances','shifts'));
    }

    public function attendanceStoreIn(Request $request){
        $this->validate($request,[
            'empID'=>'required',
            'shiftID'=>'required',
            'dutyDate'=>'required',
            'inTime'=>'required'
        ]);
         $hascheck=Attendance::where('dutyDate', date("Y-m-d", strtotime($request->dutyDate)))->where('empID',$request->empID)->first();


        if(!$hascheck){
            $data=new Attendance();
            $data->empID=$request->empID;
            $data->shiftID=$request->shiftID;
            $data->dutyDate=$request->dutyDate;
            $data->inTime=$request->inTime;
            $data->workingMiniute=0;
            $data->lateMiniute=0;
            $data->overtimeMiniute=0;
            $data->status="none";
            $data->save();
        }

        return redirect('/manageAttendance');
    }
    public function attendanceStoreOut(Request $request){
        $this->validate($request,[
            'empID'=>'required',
            'dutyDate'=>'required',
            'outTime'=>'required'
        ]);

         $hascheck=Attendance::where('dutyDate', date("Y-m-d", strtotime($request->dutyDate)))->where('empID',$request->empID)->first();


            if($hascheck){

                // start find working minutes, late, overTime etc
                $startTime = Carbon::parse($hascheck->inTime);
                $endTime = Carbon::parse($request->outTime);
                // $totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S')." Minutes";

                $hour=$startTime->diff($endTime)->format('%H');
                $min=$startTime->diff($endTime)->format('%I');

                $totalWorkingMinnute=($hour*60)+$min;
                // find has half leave
                // $hasLeaveCheck=LeaveApplication::where('fromDate',$request->dutyDate)->where('empID',$request->empID)->where('leaveDay','.5')->where('status',1)->first();

                // if($hasLeaveCheck){
                //     $hasToWorkMinutes=4*60;
                // }else{
                //     $hasToWorkMinutes=8*60;
                // }
                // $checkWorkMiniutes=$totalWorkingMinnute-$hasToWorkMinutes;

                $checkWorkMiniutes=$totalWorkingMinnute;
                //find working minutes, late, overTime etc
                $data=  Attendance::find($hascheck->id);
                $data->empID=$request->empID;
                $data->dutyDate=$request->dutyDate;
                $data->outTime=$request->outTime;
                $data->workingMiniute=$totalWorkingMinnute;

                if($checkWorkMiniutes>=0){
                    $data->overtimeMiniute=$checkWorkMiniutes;
                    $data->status="ok";
                }
                else{
                    $data->lateMiniute=$totalWorkingMinnute;
                    // $data->lateMiniute=$hasToWorkMinutes-$totalWorkingMinnute;
                    $data->status="late";
                }

                $data->save();


            }

        return redirect('/manageAttendance');
    }


    public function deleteAttendance($id){
      Attendance::where('id',$id)->delete();
        return redirect('/manageAttendance');

    }

    public function getDesigName(Request $request)
    {
        $desigName =Designation::where("department_id",$request->deptID)->select('name', 'id')->get();
        return response()->json($desigName);
    }

    public function getEmployeeId(Request $request)
    {
        $empId = Employee::where("designation_id",$request->desigID)->select('employee_id', 'id')->get();
        return response()->json($empId);
    }

    public function manageShift(){
        // $employee = DB::table('employee_info')->get();
        $shift = DB::table('shift')->get();
        return view('backend.hr.shift.manage',compact('shift'));
    }

    public function shiftManageStore(Request $request){
        DB::table('shift')->insert([
            'shiftName' =>$request->shiftName,
            'startTime'=>$request->startTime,
            'endTime'=>$request->endTime,
        ]);

        return redirect('/manageShift');
    }

     public function DeleteShift($id){
        DB::table('shift')->where('id',$id)->delete();
        return redirect('/manageShift');

    }

    public function editShift(Request $request, $id)
{
    $shift = DB::table('shift')->where('id', $id)->first();
    return response()->json($shift);

}

    public function updateShift(Request $request, $id){
    $id = $request->input('id');
    $shiftName = $request->input('shiftName');
    $startTime = $request->input('startTime');
    $endTime = $request->input('endTime');

    DB::table('shift')
        ->where('id', $id)
        ->update(['shiftName' => $shiftName, 'startTime' => $startTime, 'endTime' => $endTime]);

        return redirect ('/manageShift')
            ->with('msg', 'Employee Info updated Successfully');
}


    public function viewAbsentRollSetup()
    {
        $absent = DB::table('absent')->get();

        return view('backend.hr.absentRollSetup.viewAbsentRollSetup',compact('absent'));
    }


    public function storeAbsentRollData(Request $request)
    {
        DB::table('absent')->insert([
            'firstAbsentAmount' =>$request->firstAbsentAmount,
            'otherAbsentAmount' =>$request->otherAbsentAmount,
        ]);

        return redirect('/viewAbsentRollSetup');
    }



    public function editAbsentRoll(Request $request, $id)
    {
    $absent = DB::table('absent')->where('id', $id)->first();
    return response()->json($absent);
    }

    public function updateAbsentRoll(Request $request, $id){
    $id = $request->input('id');
    $firstAbsentAmount = $request->input('firstAbsentAmount');
    $otherAbsentAmount = $request->input('otherAbsentAmount');

    DB::table('absent')
        ->where('id', $id)
        ->update(['firstAbsentAmount' => $firstAbsentAmount, 'otherAbsentAmount' => $otherAbsentAmount]);

        return redirect ('/viewAbsentRollSetup')
            ->with('msg', 'Absent Roll updated Successfully');
}

    public function manageAttendanceSorting(Request $req){
        $viewAll = DB::table('leave')->get();
        $employee = DB::table('employee_info')->get();
        $in = DB::table('attendanceIn')->whereBetween('dutyDate', [$req->min , $req->max])->get();
        $out = DB::table('attendanceOut')->get();

        return view('backend.hr.attendance.loadManageAttendance',compact('viewAll','employee','in','out'));
    }


}
