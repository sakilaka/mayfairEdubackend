<?php

namespace App\Http\Controllers\Backend\All_users;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data['admins'] = User::where('role', 'admin')->orderBy('id', 'desc')->get();
        return view("Backend.all_users.admin.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::where('status', 1)->get();
        return view("Backend.all_users.admin.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'min:8',
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->role = $request->role ?? 0;
            $user->type = 0;
            $user->password = Hash::make($request->password);

            if ($request->hasFile('image')) {
                $fileName = rand() . time() . '_image.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            return redirect()->route('backend.manage_admin')->with('success', 'Admin Added Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
        $data["admin"] = User::find($id);
        $data['roles'] = Role::where('status', 1)->get();
        return view("Backend.all_users.admin.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8'
            ]);
        }

        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->role = $request->role ?? 0;
            $user->type = 0;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            if ($request->hasFile('image')) {
                @unlink(public_path('upload/users/' . $user->image));
                $fileName = rand() . time() . '_admin.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            return redirect()->route('backend.manage_admin')->with('success', 'Admin Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user =  User::find($request->admin_id);

            if ($user->id == Auth::user()->id) {
                return redirect()->back()->with('error', 'You Cannot Delete This Admin!');
            }

            @unlink(public_path('upload/users/' . $user->image));
            $user->delete();
            
            return back()->with('success', 'Admin Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    function changePassword(Request $request)
    {
        try {
            $user =  User::find($request->user_id);
            $user->password = $request->password;
            $user->save();
            return redirect()->back()->with('success', 'Admin Profile Password Changed Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
