<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['brands'] = Brand::orderBy('id', 'desc')->get();
        return view("Backend.home.brand.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.home.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([

            'name' => 'required',
            'link' => 'required',
            'image' => 'required',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/brand/'),$fileName);
            $brand->image = $fileName;
        }

        $brand->save();
        return redirect()->route('home-brands.index')->with('message','Brand Add Successfully');
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
        $data["brand"]= Brand::find($id);
        return view("Backend.home.brand.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        $brand =Brand::find($id);
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        if($request->hasFile('image')){
            @unlink(public_path("upload/brand/".$brand->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/brand/'),$fileName);
            $brand->image = $fileName;
        }

        $brand->save();
        return redirect()->route('home-brands.index')->with('message','Brand Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $brand= Brand::find($request->home_brand_id);
        $path = public_path("upload/brand/".$brand->image);
        @unlink($path);

        $brand->delete();
        return redirect()->route('home-brands.index');
    }


    public function status_toggle($id)
    {
        $brand = Brand::find($id);
        if($brand->status == 0)
        {
            $brand->status = 1;
        }elseif($brand->status == 1)
        {
            $brand->status = 0;
        }
        $brand->update();
        return redirect()->route('home-brands.index');
    }
}
