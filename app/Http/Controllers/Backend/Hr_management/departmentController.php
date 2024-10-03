<?php

namespace App\Http\Controllers\Backend\Hr_management;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class departmentController extends Controller
{
    public function home(){
        $departments=Department::where('type',2)->latest()->get();
        return view('backend.hr.department.allDepartment',compact('departments'));
    }

    public function edit_department($id){
        $department = Department::find($id);
        return view('Backend.Hr_management.Department.Update_department',compact('department'));
    }
    public function update_department(Request $request){
        $department = Department::find($request->department_id);
        $department->name=$request->department_name;
        $department->type=2;
        $department->update();
        return redirect()->route('admin.department.home')->with('success','Add Success');
    }
    public function addDepartment(){
        return view('backend.hr.department.adddepartment');
    }

    public function add_department(Request $request){
        $department =new  Department();
        $department->name=$request->department_name;
        $department->type=2;
        $department->save();
        return redirect()->route('admin.department.home')->with('success','Add Success');
    }
    public function delete_department($id){
        $department = Department::find($id);
        $department->delete();
        return redirect()->back()->with('success','Delete Success');
    }
}
