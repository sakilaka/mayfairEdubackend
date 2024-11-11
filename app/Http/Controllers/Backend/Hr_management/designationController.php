<?php

namespace App\Http\Controllers\Backend\Hr_management;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Department;
use Illuminate\Http\Request;

class designationController extends Controller
{
    public function home(){
        $designation=Designation::latest()->get();
        $department=Department::where('type',2)->latest()->get();
        return view('Backend.Hr_management.Designation.Designation',compact('designation','department'));
    }
    public function edit_designation($id)
    {
        $department=Department::where('type',2)->latest()->get();
        $designation = Designation::find($id);
        return view('Backend.Hr_management.Designation.Update_designation', compact('designation','department'));
    }

    public function update_designation(Request $request)
    {
        $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'designation_name' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);

        $designation = Designation::find($request->designation_id);
        $designation->name = $request->designation_name;
        $designation->department_id = $request->department_id;
        $designation->update();
        return redirect()->route('admin.designation.home')->with('success', 'Update Success');
    }

    public function add_designation(Request $request)
    {
        $request->validate([
            'designation_name' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);
        $designation = new Designation();
        $designation->name = $request->designation_name;
        $designation->department_id = $request->department_id;
        $designation->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function delete_designation($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
