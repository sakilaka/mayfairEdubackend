<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['countrys'] = Country::orderBy('id', 'desc')->get();
        return view("Backend.home.country.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.home.country.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([

            'name' => 'required',

        ]);

        $country = new Country();
        $country->name = $request->name;

        // $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        $country->save();
        return redirect()->route('admin.country.index')->with('message','Language Add Successfully');
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
        $data["country"]=Country::find($id);
        return view("Backend.home.country.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',

        ]);

        $country = Country::find($id);
        $country->name = $request->name;
        $country->status = $request->status;
        // $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);


        $country->save();
        return redirect()->route('admin.country.index')->with('message','country  Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $country= Country::find($request->country_id);

        $country->delete();
        return redirect()->route('admin.country.index')->with('message','country  Delete Successfully');

    }
}
