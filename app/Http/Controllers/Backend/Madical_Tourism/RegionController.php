<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $data['regions'] = Region::all();
        return view('Backend.medical_tourism.region.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.medical_tourism.region.create');
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

        $region = new Region();
        $region->name = $request->name;
        // if($request->hasFile('image')){
        //     $fileName = rand().time().'_region_image.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/regions/'),$fileName);
        //     $region->image = $fileName;
        // }
        $region->save();
        return redirect()->back()->with('message', 'Region Create Successfully, Thank You.');
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
        $data['region'] = Region::find($id);
        return view('Backend.medical_tourism.region.update', $data);
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

        $region = Region::find($id);
        $region->name = $request->name;
        // if($request->hasFile('image')){
        //     @unlink(public_path('upload/regions/'.$region->image));
        //     $fileName = rand().time().'_region_image.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/regions/'),$fileName);
        //     $region->image = $fileName;
        // }
        $region->update();
        return redirect()->route('region.index')->with('message', 'Region Update Successfully, Thank You.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $region = Region::find($request->region_id);
        @unlink(public_path('upload/regions/'.$region->image));
        $region->delete();
        return back()->with('message','Region Deleted Successfully');
    }

    public function status_toggle($id)
    {
        $region = Region::find($id);
        if($region->status == 0)
        {
            $region->status = 1;
        }elseif($region->status == 1)
        {
            $region->status = 0;
        }
        $region->update();
        return redirect()->back()->with('message', 'Status updated');
    }
}
