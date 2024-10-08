<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeManageController extends Controller
{
    public function index()
    {
        $data['employees'] = User::whereIn('role', ['manager', 'support', 'general_employee'])->orderBy('role', 'asc')->get();
        return view('Backend.all_users.employee.index', $data);
    }

    public function create()
    {
        $uuid = uuid_create();
        $data['employee_id'] = strtoupper(substr($uuid, 0, strpos($uuid, '-')));
        $data['branches'] = Office::all();

        return view('Backend.all_users.employee.create', $data);
    }

    public function store(Request $request)
    {
        return User::where('email', $request->email)->first();
        try {
            $employee = new User();

            $employee->name = $request->name;
            $employee->mobile = $request->mobile;
            $employee->email = $request->email;
            $employee->password = Hash::make($request->password);
            $employee->passport_no = $request->passport_no;
            $employee->employee_id = $request->employee_id;
            $employee->branch = $request->branch;
            $employee->address = $request->address;
            $employee->role = $request->role;
            $employee->status = 1;

            if ($request->hasFile('image')) {
                $fileName = rand() . time() . '_image.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
            }

            $employee->image = $fileName ?? '';
            $employee->save();

            return redirect(route('backend.admin.manage_employee.index'))->with('success', ucwords($request->role) . ' Created Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['employee'] = $employee = User::find($id);
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee Not Found!');
        }

        $data['branches'] = Office::all();
        return view('Backend.all_users.employee.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = User::find($id);

            $employee->name = $request->name;
            $employee->mobile = $request->mobile;
            $employee->email = $request->email;
            $employee->passport_no = $request->passport_no;
            $employee->branch = $request->branch;
            $employee->address = $request->address;
            $employee->role = $request->role;

            if (!empty($request->password)) {
                $employee->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                unlink(public_path('upload/users/' . $employee->image));

                $fileName = rand() . time() . '_image.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $employee->image = $fileName;
            }

            $employee->save();

            return redirect(route('backend.admin.manage_employee.index'))->with('success', ucwords($request->role) . ' Updated Successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $employee =  User::find($request->employee_id);
            unlink(public_path('upload/users/' . $employee->image));

            $employee->delete();
            return back()->with('success', 'Employee Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function get_permissions(Request $request)
    {
        $employee_id = $request->employee_id;
        $employee = User::find($employee_id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $employee_permissions = json_decode($employee->permissions, true);

        return response()->json([
            'data' => $employee_permissions
        ]);
    }

    public function manage_permissions(Request $request)
    {
        try {
            $requestData = $request->all();
            $employee_id = $requestData['employee_id'];

            $employee = User::find($employee_id);

            unset($requestData['_token']);
            unset($requestData['employee_id']);

            $moduleNames = array_keys(array_filter($requestData, function ($value) {
                return $value === 'on';
            }));

            $jsonResponse = json_encode($moduleNames);

            $employee->permissions = $jsonResponse;
            $employee->save();

            return redirect()->back()->with('success', 'Selected module(s) has been assigned to ' . ucwords($employee->role) . ' - ' . $employee->name);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
