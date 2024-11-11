<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['cities'] = City::orderBy('name', 'asc')->get();
        return view('Backend.medical_tourism.city.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['continents'] = Continent::all();
        return view('Backend.medical_tourism.city.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'image' => 'required',
        ]);

        $city = new City();
        $city->continent_id = $request->continent_id;
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        $city->name = $request->name;
        if ($request->hasFile('image')) {
            $fileName = rand() . time() . '_city_image.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/cities/'), $fileName);
            $city->image = $fileName;
        }
        $city->save();
        return redirect()->route('city.index')->with('success', 'City Created Successfully');
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
        $data['city'] = $city = City::find($id);
        $data['continents'] = Continent::all();
        $data['states'] = State::where('country_id', $city->country->id)->get();
        $data['countries'] = Country::where('continent_id', $city->continent->id)->get();


        return view('Backend.medical_tourism.city.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            // 'image' => 'required',
        ]);

        $city = City::find($id);
        $city->continent_id = $request->continent_id;
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        $city->name = $request->name;
        if ($request->hasFile('image')) {
            @unlink(public_path('upload/citys/' . $city->image));
            $fileName = rand() . time() . '_city_image.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/cities/'), $fileName);
            $city->image = $fileName;
        }
        $city->update();
        return redirect()->route('city.index')->with('success', 'City Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $city = City::find($request->city_id);
            @unlink(public_path('upload/cities/' . $city->image));
            $city->delete();
            return back()->with('success', 'City Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function status_toggle($id)
    {
        try {
            $city = City::find($id);
            if ($city->status == 0) {
                $city->status = 1;
            } elseif ($city->status == 1) {
                $city->status = 0;
            }
            $city->update();
            return redirect()->back()->with('success', 'Status Updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
