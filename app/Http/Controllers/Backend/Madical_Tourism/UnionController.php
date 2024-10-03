<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\State;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['unions'] = Union::all();
        return view('Backend.medical_tourism.union.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $data['continents'] = Continent::all();
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        return view('Backend.medical_tourism.union.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $union = new Union();
        $union->continent_id = $request->continent_id;
        $union->country_id = $request->country_id;
        $union->state_id = $request->state_id;
        $union->city_id = $request->city_id;
        $union->thana_id = $request->thana_id;
        $union->name = $request->name;
        if($request->hasFile('image')){
            $fileName = rand().time().'_union_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/unions/'),$fileName);
            $union->image = $fileName;
        }
        $union->save();
        return redirect()->back()->with('message', 'Union Create Successfully, Thank You.');
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
        

        $data['union'] = $union = Union::find($id);
        
        $data['continents'] = Continent::all();
        $data['thanas'] = Thana::where('city_id', $union->city->id)->get();
        $data['cities'] = City::where('state_id', $union->state->id)->get();
        $data['states'] = State::where('country_id', $union->country->id)->get();
        $data['countries'] = Country::where('continent_id', $union->continent->id)->get();
        
        
        return view('Backend.medical_tourism.union.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $union = union::find($id);
        $union->continent_id = $request->continent_id;
        $union->country_id = $request->country_id;
        $union->state_id = $request->state_id;
        $union->city_id = $request->city_id;
        $union->thana_id = $request->thana_id;
        $union->name = $request->name;
        if($request->hasFile('image')){
            @unlink(public_path('upload/unions/'.$union->image));
            $fileName = rand().time().'_union_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/unions/'),$fileName);
            $union->image = $fileName;
        }
        $union->update();
        return redirect()->route('union.index')->with('message', 'Union Update Successfully, Thank You.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $union = Union::find($request->union_id);
        @unlink(public_path('upload/unions/'.$union->image));
        $union->delete();
        return back()->with('message','Union Deleted Successfully');
    }

    public function status_toggle($id)
    {
        $union = union::find($id);
        if($union->status == 0)
        {
            $union->status = 1;
        }elseif($union->status == 1)
        {
            $union->status = 0;
        }
        $union->update();
        return redirect()->back()->with('message', 'Status updated');
    }
}
