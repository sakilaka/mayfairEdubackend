<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\State;
use App\Models\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['thanas'] = Thana::all();
        return view('Backend.medical_tourism.thana.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $data['continents'] = Continent::all();
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        return view('Backend.medical_tourism.thana.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $thana = new Thana();
        $thana->continent_id = $request->continent_id;
        $thana->country_id = $request->country_id;
        $thana->state_id = $request->state_id;
        $thana->city_id = $request->city_id;
        $thana->name = $request->name;
        if($request->hasFile('image')){
            $fileName = rand().time().'_thana_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/thanas/'),$fileName);
            $thana->image = $fileName;
        }
        $thana->save();
        return redirect()->back()->with('message', 'Thana Create Successfully, Thank You.');
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
        

        $data['thana'] = $thana = Thana::find($id);
        
        $data['continents'] = Continent::all();
        $data['cities'] = City::where('state_id', $thana->state->id)->get();
        $data['states'] = State::where('country_id', $thana->country->id)->get();
        $data['countries'] = Country::where('continent_id', $thana->continent->id)->get();
        
        
        return view('Backend.medical_tourism.thana.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $thana = Thana::find($id);
        $thana->continent_id = $request->continent_id;
        $thana->country_id = $request->country_id;
        $thana->state_id = $request->state_id;
        $thana->city_id = $request->city_id;
        $thana->name = $request->name;
        if($request->hasFile('image')){
            @unlink(public_path('upload/thanas/'.$thana->image));
            $fileName = rand().time().'_thana_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/thanas/'),$fileName);
            $thana->image = $fileName;
        }
        $thana->update();
        return redirect()->route('thana.index')->with('message', 'Thana Update Successfully, Thank You.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $thana = Thana::find($request->thana_id);
        @unlink(public_path('upload/thanas/'.$thana->image));
        $thana->delete();
        return back()->with('message','Thana Deleted Successfully');
    }

    public function status_toggle($id)
    {
        $thana = Thana::find($id);
        if($thana->status == 0)
        {
            $thana->status = 1;
        }elseif($thana->status == 1)
        {
            $thana->status = 0;
        }
        $thana->update();
        return redirect()->back()->with('message', 'Status updated');
    }
}
