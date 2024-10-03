<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::where('type',0)->get();
        return view("Backend.user.index", $data);
    }
    // public function customerList(){
    //      $data['users'] = User::where('type',1)->get();
    //     return view("Backend.user.customer_list", $data);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::where('status',1)->get();
        return view('Backend.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        $user = New User;
        $user->fname = $request->fname ?? '';
        $user->lname = $request->lname ?? '';
        $user->email = $request->email ?? '';
        $user->mobile = $request->phone ?? '';
        $user->role = $request->role ?? 0;
        $user->password = 12345678;
        $user->save();
        return redirect()->route('admin.user.index')->with('message','User Created Successfully');
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
        $data['user']= User::find($id);
        $data['roles'] = Role::where('status',1)->get();
        return view('Backend.user.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $user =  User::find($id);
        $user->fname = $request->fname ?? '';
        $user->lname = $request->lname ?? '';
        $user->email = $request->email ?? '';
        $user->mobile = $request->phone ?? '';
        $user->role = $request->role ?? 0;
        $user->save();
        return redirect()->route('admin.user.index')->with('message','User Updated Successfully');
    }
    function changePassword(Request $request){
        $user =  User::find($request->user_id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','User Password Changed Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
