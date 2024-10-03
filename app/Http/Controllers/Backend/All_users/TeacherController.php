<?php

namespace App\Http\Controllers\Backend\All_users;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $data['teachers'] = User::where('type','2')->orderBy('id', 'desc')->get();
        return view("Backend.all_users.teacher.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['courses'] = Course::orderBy('id','desc')->get();
        return view("Backend.all_users.teacher.create",$data);
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
            $user->type = 2;
            $user->password = 12345678;

            // Bank Information
            $user->bank_name = $request->bank_name;
            $user->bank_code_ifsc = $request->bank_code_ifsc;
            $user->bank_account_number = $request->bank_account_number;
            $user->bank_ac_holder_name = $request->bank_ac_holder_name;
            $user->paypal_id_num = $request->paypal_id_num;

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


            //add certificate file
        if($request->certificates_file){
            foreach( $request->certificates_file as $k=>$value){
                $certificates = new Certificate();
                $certificates->user_id = $user->id;
                $certificates->certificates_name = $request->certificates_name[$k];
                $filename=$request->certificates_name[$k].'-'.$user->name.'_certificat_file'.'.'.$value->getClientOriginalExtension();
                $value->move(public_path('upload/certificates/'), $filename);
                $certificates->certificates_file=$filename;
                $certificates->extension = $value->getClientOriginalExtension();
                $certificates->save();
            }
        }

        

            DB::commit();
            return redirect()->route('admin.teacher.index')->with('message','Teacher Add Successfully');
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
        $data["teacher"]= User::find($id);
        return view("Backend.all_users.teacher.update",$data);
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

        $user->type = 2;
        $user->address = $request->address ?? "";
        $user->institution = $request->institution ?? "";
        $user->designation = $request->designation ?? "";
        $user->description = $request->description ?? "";

        // Bank Information
        $user->bank_name = $request->bank_name;
        $user->bank_code_ifsc = $request->bank_code_ifsc;
        $user->bank_account_number = $request->bank_account_number;
        $user->bank_ac_holder_name = $request->bank_ac_holder_name;
        $user->paypal_id_num = $request->paypal_id_num;


        if($request->hasFile('image')){
            @unlink(public_path('upload/users/'.$user->image));
            $fileName = rand().time().'_caruser.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/users/'),$fileName);
            $user->image = $fileName;
        }
        $user->save();


        
        //add certificate file
        if($request->certificates_file){
            foreach( $request->certificates_file as $k=>$value){
                $certificates = new Certificate();
                $certificates->user_id = $user->id;
                $certificates->certificates_name = $request->certificates_name[$k];
                $filename=$request->certificates_name[$k].'-'.$user->name.'_certificat_file'.'.'.$value->getClientOriginalExtension();
                $value->move(public_path('upload/certificates/'), $filename);
                $certificates->certificates_file=$filename;
                $certificates->extension = $value->getClientOriginalExtension();
                $certificates->save();
            }
        }

         //Update certificate file

        //  $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        //     'pdf' => 'required|mimes:pdf|max:2048', // Max 2MB
        // ]);

         if($request->old_certificates_name){
            foreach($request->old_certificates_name as $k => $value){
                $certificates = Certificate::find($k);
                $certificates->user_id = $user->id;
                $certificates->certificates_name = $value;

                if(isset($request->file('old_certificates_file')[$k])){
                    @unlink(public_path('upload/certificates/'.$certificates->certificates_file));
                    $filename=$request->old_certificates_name[$k].'-'.$user->name.'_certificat_file'.'.'.$request->file('old_certificates_file')[$k]->getClientOriginalExtension();
                    $request->file('old_certificates_file')[$k]->move(public_path('upload/certificates/'), $filename);
                    $certificates->certificates_file=$filename;
                    $certificates->extension = $request->file('old_certificates_file')[$k]->getClientOriginalExtension();
                }
                

                $certificates->update();
            }
        }

        //delete certificate file
        if($request->delete_certificates_file){
            foreach($request->delete_certificates_file as $k => $value){
                $audio = Certificate::find($value);
                @unlink(public_path('upload/certificates/'.$audio->certificates_file));
                $audio->delete();

            }
        }

        DB::commit();
        return redirect()->route('admin.teacher.index')->with('message','Teacher Update Successfully');
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

        $user =  User::find($request->teacher_id);
        @unlink(public_path('upload/users/'.$user->image));

        $user->delete();
        return back()->with('message','TeacherProfile Deleted Successfully');
    }

    function changePassword(Request $request){
        $user =  User::find($request->user_id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','Teacher Profile Password Changed Successfully');
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
         return redirect()->route('admin.teacher.index');
     }
}
