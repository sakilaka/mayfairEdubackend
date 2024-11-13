<?php

namespace App\Http\Controllers\Backend\All_users;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Continent;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = User::where('role', 'student')->orderBy('id', 'desc')->get();
        $data['all_partners'] = User::where('role', 'partner')->orderBy('name', 'asc')->get();
        
        return view("Backend.all_users.student.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['courses'] = Course::orderBy('id','desc')->get();

        $data['continents'] = Continent::where('status', 1)->get();
        return view("Backend.all_users.student.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'mobile' => ['required'],

        ]);
        try {
            DB::beginTransaction();
            $user = new User;
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
            $user->continent_id = $request->continent_id;

            $user->address = $request->address ?? "";
            $user->description = $request->description ?? "";
            $user->type = 1;
            $user->role = 'student';
            $user->password = Hash::make(12345678);

            if ($request->hasFile('image')) {
                $fileName = rand() . time() . '_image.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $user->image = $fileName;
            }

            // if($request->hasFile('video')){
            //     $fileName = rand().time().'_video.'.request()->video->getClientOriginalExtension();
            //     request()->video->move(public_path('upload/users/'),$fileName);
            //     $user->video = $fileName;
            // }

            $user->save();


            //add certificate file
            if ($request->certificates_file) {
                foreach ($request->certificates_file as $k => $value) {
                    $certificates = new Certificate();
                    $certificates->user_id = $user->id;
                    $certificates->certificates_name = $request->certificates_name[$k];
                    $filename = $request->certificates_name[$k] . '-' . $user->name . '_certificat_file' . '.' . $value->getClientOriginalExtension();
                    $value->move(public_path('upload/certificates/'), $filename);
                    $certificates->certificates_file = $filename;
                    $certificates->extension = $value->getClientOriginalExtension();
                    $certificates->save();
                }
            }

            DB::commit();
            return redirect()->route('admin.student.index')->with('success', 'Student Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error_message', $e->getMessage());
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
        $data["student"] = $student = User::find($id);
        $data['continents'] = Continent::where('status', 1)->get();
        $data['countries'] = Country::where('continent_id', @$student->continent_id)->get();
        return view("Backend.all_users.student.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required'],

        ]);
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->gender = $request->gender;

            $user->qualification = $request->qualification;
            $user->experience = $request->experience;
            $user->language = $request->language;
            $user->country = $request->country;
            $user->continent_id = $request->continent_id;


            $user->dob = $request->dob;
            $user->type = 1;
            $user->role = 'student';
            $user->address = $request->address ?? "";
            $user->description = $request->description ?? "";


            if ($request->hasFile('image')) {
                @unlink(public_path('upload/users/' . $user->image));
                $fileName = rand() . time() . '_student.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $user->image = $fileName;
            }
            $user->save();


            //add certificate file
            if ($request->certificates_file) {
                foreach ($request->certificates_file as $k => $value) {
                    $certificates = new Certificate();
                    $certificates->user_id = $user->id;
                    $certificates->certificates_name = $request->certificates_name[$k];
                    $filename = $request->certificates_name[$k] . '-' . $user->name . '_certificat_file' . '.' . $value->getClientOriginalExtension();
                    $value->move(public_path('upload/certificates/'), $filename);
                    $certificates->certificates_file = $filename;
                    $certificates->extension = $value->getClientOriginalExtension();
                    $certificates->save();
                }
            }

            //Update certificate file
            if ($request->old_certificates_name) {
                foreach ($request->old_certificates_name as $k => $value) {
                    $certificates = Certificate::find($k);
                    $certificates->user_id = $user->id;
                    $certificates->certificates_name = $value;

                    if (isset($request->file('old_certificates_file')[$k])) {
                        @unlink(public_path('upload/certificates/' . $certificates->certificates_file));
                        $filename = $request->old_certificates_name[$k] . '-' . $user->name . '_certificat_file' . '.' . $request->file('old_certificates_file')[$k]->getClientOriginalExtension();
                        $request->file('old_certificates_file')[$k]->move(public_path('upload/certificates/'), $filename);
                        $certificates->certificates_file = $filename;
                        $certificates->extension = $request->file('old_certificates_file')[$k]->getClientOriginalExtension();
                    }

                    $certificates->update();
                }
            }

            //delete certificate file
            if ($request->delete_certificates_file) {
                foreach ($request->delete_certificates_file as $k => $value) {
                    $audio = Certificate::find($value);
                    @unlink(public_path('upload/certificates/' . $audio->certificates_file));
                    $audio->delete();
                }
            }

            DB::commit();
            return redirect()->route('admin.student.index')->with('success', 'Student Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user =  User::find($request->student_id);
            @unlink(public_path('upload/users/' . $user->image));

            $user->delete();
            return back()->with('success', 'Student Profile Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    function changePassword(Request $request)
    {
        try {
            $user =  User::find($request->user_id);
            $user->password = $request->password;
            $user->save();
            return redirect()->back()->with('success', 'Student Profile Password Changed Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function studentDetails($id)
    {
        $data['student'] = User::find($id);
        return view('Backend.all_users.student.details', $data);
    }
}