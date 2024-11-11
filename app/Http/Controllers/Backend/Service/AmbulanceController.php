<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Ambulance;
use App\Models\BookingDriver;

class AmbulanceController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['ambulances'] = Ambulance::orderBy('id', 'desc')->get();
        return view("Backend.services.ambulance.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['continents'] = Continent::orderBy('id', 'desc')->get();
        return view("Backend.services.ambulance.create");
    }

    public function driverBooking()
    {
        $data['bookingdrivers'] = BookingDriver::where('status',1)->orderBy('id', 'desc')->get();
        return view("Backend.services.ambulance.boockingmanage",$data);
    }
    public function driverBookingDestroy(Request $request)
    {
        $bookingdriver= BookingDriver::find($request->ambulance_booking_id);
        $bookingdriver->delete();
        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
           // 'lname' => 'required',
           'email' => ['required', 'string', 'email', 'max:255','unique:'.User::class],
           'mobile' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','numeric'],
        ]);
        // $request->validate([
        //     'name' => 'required',

        // ]);
          try{
            DB::beginTransaction();
         $user = New User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->type = 2;
        $user->mobile = $request->mobile;
        $user->address = $request->address ?? "";
        $user->password = 123456;
        $user->save();
        $ambulance = new Ambulance();
        $ambulance->user_id = $user->id;

        $ambulance->fname = $request->fname;
        $ambulance->lname = $request->lname;
        $ambulance->mobile = $request->mobile;
        $ambulance->email = $request->email;
        $ambulance->address = $request->address;
        $ambulance->driver_license = $request->driver_license;
        $ambulance->exprience = $request->exprience;
        $ambulance->driver_about = $request->driver_about;

        if($request->hasFile('image')){
            $fileName = rand().time().'_driver_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/ambulance/'),$fileName);
            $ambulance->image = $fileName;
        }


        // if($request->hasFile('ambulance_image')){
        //     $fileName = rand().time().'_ambulance_image.'.request()->ambulance_image->getClientOriginalExtension();
        //     request()->ambulance_image->move(public_path('upload/ambulance/'),$fileName);
        //     $ambulance->ambulance_image = $fileName;
        // }


        // if($request->hasFile('video_thumbnail')){
        //     $fileName = rand().time().'video_thumbnail.'.request()->video_thumbnail->getClientOriginalExtension();
        //     request()->video_thumbnail->move(public_path('upload/ambulance/'),$fileName);
        //     $ambulance->video_thumbnail = $fileName;
        // }


        $ambulance->save();
         DB::commit();
        return redirect()->route('admin.ambulance.index')->with('message','Driver Create Successfully');
         }catch(\Exception $e){
            DB::rollBack();
           // dd($e);
            return back()->with ('error_message', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $data['ambulance'] = $ambulance = Ambulance::find($id);

    //   $data['continents'] = Continent::orderBy('id', 'desc')->get();
    //   $data['unions'] = Union::where('thana_id', $ambulance->thana->id ?? '')->get();
    //   $data['thanas'] = Thana::where('city_id', $ambulance->city->id ?? '')->get();
    //   $data['cities'] = City::where('state_id', $ambulance->state->id ?? '')->get();
    //   $data['states'] = State::where('country_id', $ambulance->country->id ?? '')->get();
    //   $data['countries'] = Country::where('continent_id', $ambulance->continent->id ?? '')->get();
    //   $data['words'] = Word::where('union_id', $ambulance->union_id ?? '')->get();
        return view("Backend.services.ambulance.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ambulance = Ambulance::find($id);
        if($ambulance->user){
            $request->validate([
                'fname' => 'required',
                'email' => ['required', 'string', 'email', 'max:255','unique:'.User::class.',email,'.$ambulance->user->id],
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
        // $request->validate([
        //     'name' => 'required',

        // ]);
        try{
            DB::beginTransaction();
        if($ambulance->user){
            $user = User::find($ambulance->user->id);
            $user->fname = $request->fname;
            $user->lname = $request->lname;
             $user->type = 2;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address ?? "";
            $user->save();
        }else{
            $user = New User;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->type = 2;
            $user->mobile = $request->mobile;
            $user->address = $request->address ?? "";
            $user->password = 123456;
            $user->save();
        }
        $ambulance->user_id = $user->id;

        $ambulance->fname = $request->fname;
        $ambulance->lname = $request->lname;
        $ambulance->mobile = $request->mobile;
        $ambulance->email = $request->email;
        $ambulance->address = $request->address;
        $ambulance->driver_license = $request->driver_license;
        $ambulance->driver_about = $request->driver_about;
        $ambulance->details = $request->details;
        $ambulance->exprience = $request->exprience;
        // $ambulance->status = $request->status;


        if($request->hasFile('image')){
            @unlink(public_path('upload/ambulance/'.$ambulance->image));
            $fileName = rand().time().'_driver_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/ambulance/'),$fileName);
            $ambulance->image = $fileName;
        }


        // if($request->hasFile('ambulance_image')){
        //     @unlink(public_path('upload/ambulance/'.$ambulance->ambulance_image));
        //     $fileName = rand().time().'_ambulance_image.'.request()->ambulance_image->getClientOriginalExtension();
        //     request()->ambulance_image->move(public_path('upload/ambulance/'),$fileName);
        //     $ambulance->ambulance_image = $fileName;
        // }


        // if($request->hasFile('video_thumbnail')){
        //     @unlink(public_path('upload/ambulance/'.$ambulance->video_thumbnail));
        //     $fileName = rand().time().'_video_thumbnail.'.request()->video_thumbnail->getClientOriginalExtension();
        //     request()->video_thumbnail->move(public_path('upload/ambulance/'),$fileName);
        //     $ambulance->video_thumbnail = $fileName;
        // }

// dd($ambulance);
        $ambulance->save();
          DB::commit();
        return redirect()->route('admin.ambulance.index')->with('message','ambulance Update Successfully');
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
        $ambulance = Ambulance::find($request->ambulance_id);
        @unlink(public_path('upload/ambulance/'.$ambulance->image));
        // @unlink(public_path('upload/ambulance/'.$ambulance->video_thumbnail));
        // @unlink(public_path('upload/ambulance/'.$ambulance->ambulance_image));

        $ambulance->delete();

        // $user = User::find($ambulance->id);
        // $user->delete();
        return redirect()->route('admin.ambulance.index');

    }

    public function status_toggle($id)
    {
        $ambulance = Ambulance::find($id);
        if($ambulance->status == 0)
        {
            $ambulance->status = 1;
        }elseif($ambulance->status == 1)
        {
            $ambulance->status = 0;
        }
        $ambulance->update();
        return redirect()->route('admin.ambulance.index');
    }
    function changePassword(Request $request){
        $user =  User::find($request->user_id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','Driver Password Changed Successfully');
    }
}
