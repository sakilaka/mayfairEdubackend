<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceGroup;
use Illuminate\Http\Request;
use App\Models\Therapy;
use App\Models\TherapyService;
use Illuminate\Support\Facades\DB;

class TherapyServiceController extends Controller
{
    public function index()
    {
        $data['therapy_services'] = TherapyService::orderBy('id', 'desc')->get();
        return view("Backend.services.therapy_service.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['therapists'] = Therapy::all();
        return view("Backend.services.therapy_service.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'loction' => 'required',
        //     'experience' => 'required',
        //     'type_gender' => 'required',
        //     'nmc_no' => 'required',
        // ]);


        $therapyservice = new TherapyService();
        $therapyservice->therapist_id = $request->therapist_id;
        $therapyservice->therapy_name = $request->therapy_name;
        $therapyservice->loction = $request->loction;
        $therapyservice->address = $request->address;
        $therapyservice->experience_year = $request->experience_year;
        $therapyservice->price = $request->price;
        $therapyservice->details = $request->details;
        // if($request->hasFile('image')){
        //     $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/service/therapy/'),$fileName);
        //     $therapy->image = $fileName;
        // }
        $therapyservice->save();
        return redirect()->route('admin.therapy_service.index')->with('message','Therapy Service Add Successfully');

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
        $data['therapists'] = Therapy::all();
        $data['therapyservice'] = TherapyService::find($id);
        return view("Backend.services.therapy_service.update",$data);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          // $request->validate([
        //     'name' => 'required',
        //     'loction' => 'required',
        //     'experience' => 'required',
        //     'type_gender' => 'required',
        //     'nmc_no' => 'required',
        // ]);


        $therapyservice =TherapyService::find($id);
        $therapyservice->therapist_id = $request->therapist_id;
        $therapyservice->therapy_name = $request->therapy_name;
        $therapyservice->loction = $request->loction;
        $therapyservice->address = $request->address;
        $therapyservice->experience_year = $request->experience_year;
        $therapyservice->price = $request->price;
        $therapyservice->details = $request->details;
        // if($request->hasFile('image')){
        //     $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/service/therapy/'),$fileName);
        //     $therapy->image = $fileName;
        // }
        $therapyservice->save();
        return redirect()->route('admin.therapy_service.index')->with('message','Therapy Service Update Successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $therapyservice= TherapyService::find($request->therapy_service_id);
        //@unlink(public_path('upload/service/therapy/'.$therapy->image));

        $therapyservice->delete();
        return redirect()->route('admin.therapy_service.index')->with('message','Therapy Deleted Successfully');
    }
    public function status_toggle($id)
    {
        $therapy = Therapy::find($id);
        if($therapy->status == 0)
        {
            $therapy->status = 1;
        }elseif($therapy->status == 1)
        {
            $therapy->status = 0;
        }
        $therapy->update();
        return redirect()->route('admin.therapy.index');
    }
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     $data['groups'] = ServiceGroup::get();
    //    return view("Backend.services.therapy_service.create",$data);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
