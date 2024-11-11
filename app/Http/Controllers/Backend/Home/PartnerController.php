<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Partner;

class PartnerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['partners'] = Partner::orderBy('id', 'desc')->get();
        return view("Backend.home.partner.index",$data);
    }

    /**
     * Show the form for creating a new resource. 
     */
    public function create()
    {
        return view("Backend.home.partner.create");
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

        $partner = new Partner();
        $partner->name = $request->name;
        $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/partner/'),$fileName);
            $partner->image = $fileName;
        }

        $partner->save();
        return redirect()->route('home-partner.index')->with('message','Partner Add Successfully');
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
        $data["partner"]= Partner::find($id);
        return view("Backend.home.partner.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'link' => 'required',
        ]);

        $partner = Partner::find($id);
        $partner->name = $request->name;
        $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        if($request->hasFile('image')){
            @unlink(public_path("upload/partner/".$partner->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/partner/'),$fileName);
            $partner->image = $fileName;
        }

        $partner->save();
        return redirect()->route('home-partner.index')->with('message','Partner Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $partner= Partner::find($request->home_partner_id);
        $path = public_path("upload/partner/".$partner->image);
        @unlink($path);

        $partner->delete();
        return redirect()->route('home-partner.index');

    }

    public function status_toggle($id)
    {
        $partner = Partner::find($id);
        if($partner->status == 0)
        {
            $partner->status = 1;
        }elseif($partner->status == 1)
        {
            $partner->status = 0;
        }
        $partner->update();
        return redirect()->route('home-partner.index');
    }
}
