<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Therapy;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Schedule;
use App\Models\DoctorChamber;
use App\Models\Service;
use App\Models\ServiceGroup;
use App\Models\ServiceItem;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TherapyController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['therapies'] = Therapy::orderBy('id', 'desc')->get();
        return view("Backend.services.therapy.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['departments'] = Department::orderBy('id', 'desc')->get();
        // dd( $data);
        return view("Backend.services.therapy.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'fname' => 'required',
            'email' => ['required', 'string', 'email', 'max:255','unique:'.User::class],
           'mobile' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','numeric'],

            //'image' => 'required',
        ]);
        try{
            DB::beginTransaction();
        $user = New User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->type = 3;
        $user->mobile = $request->mobile;
        $user->address = $request->address ?? "";
        $user->password = Hash::make(123456);
        $user->save();

        $therapy = new Therapy();
        $therapy->fname = $request->fname;
        $therapy->lname = $request->lname;
        $therapy->email = $request->email;
        $therapy->mobile = $request->mobile;
        $therapy->address = $request->address;
        $therapy->therapy_category = $request->therapy_category;
        $therapy->education = $request->education;
        $therapy->experience_year = $request->experience_year;
        $therapy->gender = $request->gender;
        $therapy->details = $request->details;
        $therapy->education = $request->education;
        $therapy->nid = $request->nid;
        $therapy->hospital_name = $request->hospital_name;
        $therapy->speciality = $request->speciality;
        $therapy->experience = $request->experience;
        $therapy->video = "https://" . preg_replace('#^https?://#', '',$request->video_file);
        $therapy->department_id = $request->department_id;
        $therapy->bmdc_number = $request->bmdc_number;
        $therapy->pre_fee = $request->pre_fee;
        $therapy->fee = $request->fee;
        $therapy->user_id = $user->id;

        if($request->hasFile('image')){
            $fileName = rand().time().'_therapist_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/service/therapists/'),$fileName);
            $therapy->image = $fileName;
        }
        if($request->hasFile('video_thumbnail')){
            $fileName = rand().time().'_therapist_video_thumbnail.'.request()->video_thumbnail->getClientOriginalExtension();
            request()->video_thumbnail->move(public_path('upload/service/therapists/'),$fileName);
            $therapy->video_thumbnail = $fileName;
        }
        // if($request->hasFile('video_file')){
        //     $fileName = rand().time().'video_file.'.request()->video_file->getClientOriginalExtension();
        //     request()->video_file->move(public_path('upload/service/therapists/'),$fileName);
        //     $therapy->video = $fileName;
        // }
        $therapy->save();



        DB::commit();
        return redirect()->route('admin.therapy.index')->with('message','Therapist Add Successfully');
        }catch(\Exception $e){
            DB::rollBack();
           // dd($e);
            return back()->with ('error_message', $e->getMessage())->withInput();
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
        $data["therapy"]= Therapy::find($id);
        return view("Backend.services.therapy.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       // dd($id);
        $therapy = Therapy::find($id);
        if($therapy->user){
            $request->validate([
                'fname' => 'required',
                'email' => ['required', 'string', 'email', 'max:255','unique:'.User::class.',email,'.$therapy->user->id],
                'mobile' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','numeric'],
            ]);
        }
        else{
             $request->validate([
                'fname' => 'required',
                'email' => ['required', 'string', 'email', 'max:255','unique:'.User::class],
                'mobile' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','numeric'],
            ]);
        }

    try{
        DB::beginTransaction();
        if($therapy->user){
            $user = User::find($therapy->user->id);
            $user->fname = $request->fname;
            $user->lname = $request->lname;
             $user->type = 3;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address ?? "";
            $user->save();
        }else{
            $user = New User;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
             $user->type = 3;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address ?? "";
            $user->password = 123456;
            $user->save();
        }



    $therapy->fname = $request->fname;
    $therapy->lname = $request->lname;
    $therapy->email = $request->email;
    $therapy->mobile = $request->mobile;
    $therapy->address = $request->address;
    $therapy->gender = $request->gender;
    $therapy->details = $request->details;
    $therapy->therapy_category = $request->therapy_category;
    $therapy->experience_year = $request->experience_year;
    $therapy->education = $request->education;
    $therapy->nid = $request->nid;
    $therapy->hospital_name = $request->hospital_name;
    $therapy->speciality = $request->speciality;
    $therapy->experience = $request->experience;
    $therapy->department_id = $request->department_id;
    $therapy->bmdc_number = $request->bmdc_number;
    $therapy->video = "https://" . preg_replace('#^https?://#', '',$request->video_file);
    $therapy->pre_fee = $request->pre_fee;
    $therapy->fee = $request->fee;
    $therapy->user_id = $user->id;
    if($request->hasFile('image')){
        @unlink(public_path("upload/service/therapists/".$therapy->image));
        $fileName = rand().time().'_therapist_image.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('upload/service/therapists/'),$fileName);
        $therapy->image = $fileName;
    }

    if($request->hasFile('video_thumbnail')){
        @unlink(public_path("upload/service/therapists/".$therapy->video_thumbnail));
        $fileName = rand().time().'_therapist_video_thumbnail.'.request()->video_thumbnail->getClientOriginalExtension();
        request()->video_thumbnail->move(public_path('upload/service/therapists/'),$fileName);
        $therapy->video_thumbnail = $fileName;
    }
    // if($request->hasFile('video_file')){
    //     @unlink(public_path("upload/service/doctor/".$therapy->video_file));
    //     $fileName = rand().time().'video_file.'.request()->video_file->getClientOriginalExtension();
    //     request()->video_file->move(public_path('upload/service/therapists/'),$fileName);
    //     $therapy->video = $fileName;
    // }
    $therapy->save();


        DB::commit();
        return redirect()->route('admin.therapy.index')->with('message','therapy Update Successfully');
        }catch(\Exception $e){
        DB::rollBack();
        return back()->with ('error', $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $therapy= Therapy::find($request->therapy_id);

        foreach($therapy->schedules as $schedules){
            $schedules->delete();
        }
        foreach($therapy->doctorchambers as $doctorchamber){
            $doctorchamber->delete();
        }

        $therapy->user->delete();
        @unlink(public_path("upload/service/therapists/".$therapy->image));
        @unlink(public_path("upload/service/therapists/".$therapy->video_thumbnail));
        // @unlink(public_path("upload/service/therapists/".$therapy->video_file));
        $therapy->delete();
        return redirect()->route('admin.therapy.index');

    }

    public function statusToggle($id)
    {
        $doctor = Therapy::find($id);
        if($doctor->status == 0)
        {
            $doctor->status = 1;
        }elseif($doctor->status == 1)
        {
            $doctor->status = 0;
        }
        $doctor->update();
        return redirect()->route('admin.therapy.index');
    }
    function changePassword(Request $request){
        $user =  User::find($request->user_id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','Therapist Password Changed Successfully');
    }

    //Therapist Package start here



    public function packageIndex()
    {
        $service = Service::where('template',"therapist-package")->firstorNew();
        // $data['services_types'] = ServiceType::where('service_id',$service->id)->get();
       // dd($service);
        // return view("Backend.services.nany_service.index2",$data);
        $data['service_packages'] = ServiceItem::where('service_id',$service->id)->get();
        return view("Backend.services.therapy.therapist_package.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getBanner()
    {
         $data['service']= $service =  Service::where('template',"therapist-package")->FirstOrNew();

         $data['serviceType'] =  ServiceType::where('name','2')->where('service_id',$service->id)->FirstOrNew();
        // dd($data);
        return view("Backend.services.therapy.therapist_package.banner",$data);
    }
    function setBanner(Request $request){
        $service =  Service::where('template',"therapist-package")->FirstOrNew();
        $service->name = "Terapist Package";
        $service->template = "therapist-package";

        if($request->hasFile('image')){
            @unlink(public_path('upload/service/'.$service->image));
            $fileName = rand().time().'_therapist_package.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/service/'),$fileName);
            $service->image = $fileName;
        }
        $service->save();
        $serviceType =  ServiceType::where('name','2')->where('service_id',$service->id)->FirstOrNew();
        //
        $serviceType->name = '2';
        if($request->hasFile('banner1')){
            @unlink(public_path('upload/service/'.$service->banner1));
            $fileName = rand().time().'_therapist_package_banner1.'.request()->banner1->getClientOriginalExtension();
            request()->banner1->move(public_path('upload/service/'),$fileName);
            $serviceType->banner1 = $fileName;
        }
        if($request->hasFile('banner2')){
            @unlink(public_path('upload/service/'.$service->banner2));
            $fileName = rand().time().'_therapist_package_banner2.'.request()->banner2->getClientOriginalExtension();
            request()->banner2->move(public_path('upload/service/'),$fileName);
            $serviceType->banner2 = $fileName;
        }
        $serviceType->banner_text1 = $request->banner_text1;
        $serviceType->banner_text2 = $request->banner_text2;
        $serviceType->service_id = $service->id;
        $serviceType->save();
        return back()->with('success','Updated Successfully');
    }
    public function packageCreate()
    {
        $data['service']= $service =  Service::where('template',"therapist-package")->FirstOrNew();
        $data['groups'] = ServiceGroup::where('service_id',$service->id)->get();
        return view("Backend.services.therapy.therapist_package.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function packageStore(Request $request)
    {
    // dd($request->all());
         $request->validate([

            'type' => 'required',
        ]);
       // dd($request->all());
        $service =  Service::where('template',"therapist-package")->FirstOrNew();
        $service->name = "Terapist Package";
        $service->template = "therapist-package";
        $service->save();
        $serviceType =  ServiceType::where('name',$request->type)->where('service_id',$service->id)->FirstOrNew();
        //
        $serviceType->name = $request->type;
        $serviceType->service_id = $service->id;
        $serviceType->save();
        //dd($request);
        if($request->type == "1"){
            foreach ($request->no_group_package as $key => $value) {
                $serviceItem = new ServiceItem();
                $serviceItem->name = $value;
                $serviceItem->type_id =  $serviceType->id;
                $serviceItem->pre_price = $request->no_group_pre_price[$key] ?? 0;
                $serviceItem->service_id =$service->id;
                $serviceItem->price = $request->no_group_price[$key] ?? 0;


                $serviceItem->save();
            }
        }else{
            foreach ($request->group as $key => $group){
                $serviceGroup= ServiceGroup::find($group);
                $serviceGroup->type_id =  $serviceType->id;
                $serviceGroup->service_id =$service->id;
                $serviceGroup->save();

                foreach ($request->group_package[$key] as $k => $pack) {
                    $serviceItem = new ServiceItem();
                    $serviceItem->name = $pack ;
                    $serviceItem->group_id = $group;
                   $serviceItem->type_id =  $serviceType->id;
                    $serviceItem->pre_price = $request->group_pre_price[$key][$k] ?? 0;
                    $serviceItem->service_id =$service->id;
                    $serviceItem->price = $request->group_price[$key][$k] ?? 0;


                    $serviceItem->save();
                }
            }
        }
        return redirect()->route('admin.therapist_package.index')->with('message','Package Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function packageShow(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function packageEdit(string $id)
    {
        $data['service']= $service =  Service::where('template',"therapist-package")->FirstOrNew();
        $data['service_item']= $item =  ServiceItem::find($id);
       // dd($item);
        $data['groups'] = ServiceGroup::where('service_id',$service->id)->get();
        return view("Backend.services.therapy.therapist_package.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function packageUpdate(Request $request, string $id)
    {
        //dd($request->all());
       $request->validate([
            'group' => 'required',
            'group_package' => 'required',
        ]);

        $serviceItem =  ServiceItem::find($id);
        $serviceGroup= ServiceGroup::find($request->group);
        $serviceGroup->type_id =  $serviceItem->type_id;
        $serviceGroup->service_id =$serviceItem->service_id;
        $serviceGroup->save();
        $serviceItem->name = $request->group_package;
        $serviceItem->group_id = $request->group;
        $serviceItem->pre_price = $request->group_price;
        $serviceItem->price = $request->group_pre_price;
        $serviceItem->status = $request->status;
        $serviceItem->save();
        return redirect()->route('admin.therapist_package.index')->with('message','Service Updated Successfully');
    }


}
