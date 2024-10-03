<?php

namespace App\Http\Controllers\Backend\All_users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AffiliateConteoller extends Controller
{
    public function index()
    {
        $data['affiliates'] = User::where('type','6')->orderBy('id', 'desc')->get();
        return view("Backend.all_users.affiliate.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view("Backend.all_users.affiliate.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255','unique:'.User::class],
            'mobile' => ['required'],

        ]);
        try{
            DB::beginTransaction();
            $user = New User;
            // $user->course_id = $request->course_id;
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->gender = $request->gender;
            $user->dob = $request->dob;

            $user->qualification = $request->qualification;
            $user->experience = $request->experience;
            $user->language = $request->language;
            $user->country = $request->country;

            $user->address = $request->address ?? "";
            $user->institution = $request->institution ?? "";
            $user->designation = $request->designation ?? "";
            $user->description = $request->description ?? "";
            $user->type = 6;
            $user->password = 12345678;

            if($request->hasFile('image')){
                $fileName = rand().time().'_image.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'),$fileName);
                $user->image = $fileName;
            }

            // if($request->hasFile('video')){
            //     $fileName = rand().time().'_video.'.request()->video->getClientOriginalExtension();
            //     request()->video->move(public_path('upload/users/'),$fileName);
            //     $user->video = $fileName;
            // }

            $user->save();

            DB::commit();
            return redirect()->route('admin.affiliate.index')->with('message','Affiliate Add Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            return back()->with ('error_message', $e->getMessage());
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
       // dd('hi');
        $data["affiliate"]= User::find($id);
        return view("Backend.all_users.affiliate.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
       $request->validate([
        'name' => 'required',
        'email' => ['required', 'string', 'email', 'max:255'],
        'mobile' => ['required'],

    ]);
    try{
        DB::beginTransaction();
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->nid = $request->nid;
        $user->dob = $request->dob;

        $user->gender = $request->gender;
        $user->qualification = $request->qualification;
        $user->experience = $request->experience;
        $user->language = $request->language;
        $user->country = $request->country;
        $user->status = $request->status;

        $user->type = 6;
        $user->address = $request->address ?? "";
        $user->institution = $request->institution ?? "";
        $user->designation = $request->designation ?? "";
        $user->description = $request->description ?? "";


        if($request->hasFile('image')){
            @unlink(public_path('upload/users/'.$user->image));
            $fileName = rand().time().'_affiliate.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/users/'),$fileName);
            $user->image = $fileName;
        }
        $user->save();

        DB::commit();
        return redirect()->route('admin.affiliate.index')->with('message','Affiliate Update Successfully');
    }catch(\Exception $e){
        DB::rollBack();
       // dd($e);
        return back()->with ('error_message', $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $user =  User::find($request->affiliate_id);
        @unlink(public_path('upload/users/'.$user->image));

        $user->delete();
        return back()->with('message','Affiliate Profile Deleted Successfully');
    }

    function changePassword(Request $request){
        $user =  User::find($request->user_id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','Affiliate Profile Password Changed Successfully');
    }

    public function status($id)
     {
         $user = User::find($id);
         if($user->status == 0)
         {
             $user->status = 1;
         }elseif($user->status == 1)
         {
             $user->status = 0;
         }
         $user->update();
         return redirect()->route('admin.affiliate.index');
     }
}
