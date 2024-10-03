<?php
namespace App\Http\Controllers\Backend\Hr_management\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Hrshift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    public function home()
    {
        $designation=Designation::latest()->get();
        $department=Department::where('type',2)->latest()->get();
        $employees = Employee::latest()->get();
        $shifts = Hrshift::latest()->get();
        return view('Backend.Hr_management.Employee.Employee', compact('employees','department','designation','shifts'));
    }
    public function add_employee(Request $request)
    {
        $rules = [
            'employee_name' => 'required|string|max:255',
            'employee_image' => 'required',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone_number' => 'required|unique:employees',
            'date_of_birth' => 'required|date',
            'gander' => 'required',
            'country' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'nid_number' => 'required',
            'qualification' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'join_date' => 'required|date',
            'shift_name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required_with:password|same:password|min:8'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $employee =new Employee();
        $employee->employee_name = $request->input('employee_name');
        $employee->department_id = $request->input('department_id');
        $employee->employee_id = rand(50,1000);
        $employee->designation_id = $request->input('designation_id');
        $employee->email = $request->input('email');
        $employee->phone_number = $request->input('phone_number');
        $employee->date_of_birth = $request->input('date_of_birth');
        $employee->country = ucfirst($request->input('country'));
        $employee->city = ucfirst($request->input('city'));
        $employee->post_code = $request->input('post_code');
        $employee->nid_number = $request->input('nid_number');
        $employee->qualification = $request->input('qualification');
        $employee->address = ucfirst($request->input('address'));
        $employee->gander = $request->input('gander');
        $employee->salary = $request->input('salary');
        $employee->join_date = $request->input('join_date');
        $employee->shift_name = $request->input('shift_name');
        $employee->password = md5($request->input('password'));
        if($request->hasFile('employee_image')){
            $extension=$request->file('employee_image')->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $request->file('employee_image')->move(public_path('upload/Employee_Image/'),$filename);
            $employee->employee_image = $filename;
        }
        $employee->save();
        return redirect()->route('admin.employee.home')->with('success', 'Employee created successfully');
    }

    public function edit_employee($id)
    {
        $department=Department::where('type',2)->latest()->get();
        $designation=Designation::latest()->get();
        $shift=Hrshift::latest()->get();
         $employee = Employee::findOrFail($id);
       return view('Backend.Hr_management.Employee.Update_Employee', compact('employee','department','designation','shift'));
    }

    public function update_employee(Request $request)
    {
        $rules = [
            'employee_name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required',
            'date_of_birth' => 'required|date',
            'gander' => 'required',
            'country' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'nid_number' => 'required',
            'qualification' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'join_date' => 'required|date',
            'shift_name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            dd($firstError);
            return redirect()->back()->with('error', $firstError);
        }

        $employee = Employee::find($request->employee_id);
        $employee->employee_name = $request->input('employee_name');
        $employee->department_id = $request->input('department_id');
        $employee->designation_id = $request->input('designation_id');
        $employee->email = $request->input('email');
        $employee->phone_number = $request->input('phone_number');
        $employee->date_of_birth = $request->input('date_of_birth');
        $employee->country = $request->input('country');
        $employee->city = $request->input('city');
        $employee->post_code = $request->input('post_code');
        $employee->nid_number = $request->input('nid_number');
        $employee->qualification = $request->input('qualification');
        $employee->address = $request->input('address');
        $employee->gander = $request->input('gander');
        $employee->salary = $request->input('salary');
        $employee->join_date = $request->input('join_date');
        $employee->shift_name = $request->input('shift_name');
        if($request->hasFile('employee_image')){
             $image_path = public_path('upload/Employee_Image/'.$request->old_employee_image);
            @unlink($image_path);
            $extension=$request->file('employee_image')->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $request->file('employee_image')->move(public_path('upload/Employee_Image/'),$filename);
            $employee->employee_image = $filename;

        }
        $employee->update();

        return redirect()->route('admin.employee.home')->with('success', 'Employee updated successfully');
    }

    public function delete_employee($id)
    {
        $employee = Employee::findOrFail($id);
        $image_path = public_path('upload/Employee_Image/'.$employee->employee_image);
        if(file_exists($image_path)) {
          @unlink($image_path);
        }

        $employee->delete();

        return redirect()->route('admin.employee.home')->with('success', 'Employee deleted successfully');
    }
}
