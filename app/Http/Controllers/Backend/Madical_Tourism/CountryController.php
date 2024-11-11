<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['countries'] = Country::orderBy('name', 'asc')->get();
        return view('Backend.medical_tourism.country.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['continents'] = Continent::all();
        return view('Backend.medical_tourism.country.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        $country = new Country();
        $country->continent_id = $request->continent_id;
        $country->name = $request->name;
        // $country->code = $request->code;
        if ($request->hasFile('image')) {
            $fileName = rand() . time() . '_country_image.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/countries/'), $fileName);
            $country->image = $fileName;
        }
        $country->save();
        return redirect()->route('country.index')->with('success', 'Country Created Successfully');
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
        $data['country'] = Country::find($id);
        $data['continents'] = Continent::all();
        return view('Backend.medical_tourism.country.update', $data);
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

        $country = Country::find($id);
        $country->continent_id = $request->continent_id;
        $country->name = $request->name;
        //  $country->code = $request->code;
        if ($request->hasFile('image')) {
            @unlink(public_path('upload/countries/' . $country->image));
            $fileName = rand() . time() . '_country_image.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/countries/'), $fileName);
            $country->image = $fileName;
        }
        $country->update();
        return redirect()->route('country.index')->with('success', 'Country Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $country = Country::find($request->country_id);
            @unlink(public_path('upload/countries/' . $country->image));
            $country->delete();
            return back()->with('success', 'Country Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function status_toggle($id)
    {
        try {
            $country = Country::find($id);
            if ($country->status == 0) {
                $country->status = 1;
            } elseif ($country->status == 1) {
                $country->status = 0;
            }
            $country->update();
            return redirect()->back()->with('success', 'Country Status Changed Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
