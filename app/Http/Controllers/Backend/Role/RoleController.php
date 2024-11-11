<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionMenu;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['roles'] = Role::get();
        return view("Backend.role.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.role.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect()->route('admin.role.index')->with('message','Role Add Successfully');
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
        $data['role'] =Role::find($id);
        return view('Backend.role.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role =  Role::find($id);
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();
        return redirect()->route('admin.role.index')->with('message','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $role = Role::find($request->role);
        $role->delete();
        return redirect()->route('admin.role.index')->with('message','Role Deleted Successfully');

    }
    function statusToggle(string $id){
        $role = Role::find($id);
        if($role->status == 1){
           $role->status = 0;
        }else if($role->status == 0){
           $role->status = 1;
        }
        $role->save();
        return redirect()->route('admin.role.index')->with('message','Role Status Updated Successfully');
    }
    function getrolePermission(string $id){
        $user = auth()->guard('admin')->user();
      //  dd($user->hasPermission('dfdsf'));
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::get();
        $data['role_permissions'] = RolePermission::where('role', $id)->get();
        $data['permission_g'] = Permission::where('is_group',1)->orderBy('order','asc')->get();
        $data['main_menus'] = PermissionMenu::where('parent_id',0)->get();
        return view('Backend.role.permission', $data);
    }
    function setRolePermission(Request $request,string $id){
        //dd($request);
        if($request->g_item){
            foreach($request->g_item as $k=>$item){

                $permission =  RolePermission::where('permission_id',$item)->FirstorNew();
                $permission->role = $id;
                $permission->permission_id = $item;
                $permission->save();
            }

        }
        if($request->p_item){
            foreach($request->p_item as $k=>$item){

                $permission =  RolePermission::where('permission_id',$item)->FirstorNew();
                $permission->role = $id;
                $permission->permission_id = $item;
                $permission->save();
            }

        }
        if($request->item){
            foreach($request->item as $k=>$item){

                $permission = New RolePermission();
                $permission->role = $id;
                $permission->permission_id = $item;
                $permission->save();
            }

        }
        if($request->del_item){
            foreach($request->del_item as $k=>$item){
                $permission =  RolePermission::find($item);
                $permission->delete();
            }
        }

        return back();
    }
}
