<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\RoomAccessibility;
use App\Models\RoomFacility;
use Illuminate\Http\Request;

class HotelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['hotels'] = Hotel::all();
        return view('Backend.medical_tourism.hotel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.medical_tourism.hotel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->m_guest = $request->m_guest;
        $hotel->number = $request->number;
        $hotel->email = $request->email;
        $hotel->address = $request->address;
        $hotel->facilities = $request->facilities;
        $hotel->description = $request->description;

        if($request->hasFile('image')){
            $fileName = rand().time().'_tourism_hotel_package.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/hotels/'),$fileName);
            $hotel->image = $fileName;
        }
        $hotel->save();
        if($request->room_facilities){
            foreach( $request->room_facilities as $room_facilities){

                $room_facility = new RoomFacility();
                $room_facility->hotel_id = $hotel->id;
                $room_facility->room_facilities = $room_facilities;
                $room_facility->save();
            }
        }
        
        if($request->room_accessibility){
            foreach( $request->room_accessibility as $room_accessibility){

                $room_facility = new RoomAccessibility();
                $room_facility->hotel_id = $hotel->id;
                $room_facility->room_accessibility = $room_accessibility;
                $room_facility->save();
            }
        }
       
        return redirect()->back()->with('message', 'Hotel Create Successfully, Thank you.');
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
        $data['hotel'] = Hotel::find($id);
        return view('Backend.medical_tourism.hotel.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotel = Hotel::find($id);
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->m_guest = $request->m_guest;
        $hotel->number = $request->number;
        $hotel->email = $request->email;
        $hotel->address = $request->address;
        $hotel->facilities = $request->facilities;
        $hotel->description = $request->description;

        if($request->hasFile('image')){
            @unlink(public_path("upload/hotels/".$hotel->image));
            $fileName = rand().time().'_tourism_hotel_package.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/hotels/'),$fileName);
            $hotel->image = $fileName;
        }
        $hotel->update();

        RoomFacility::where('hotel_id',$id)->get()->each->delete();
        if($request->room_facilities){
            foreach( $request->room_facilities as $room_facilities){
                $room_facility = new RoomFacility();
                $room_facility->hotel_id = $hotel->id;
                $room_facility->room_facilities = $room_facilities;
                $room_facility->save();
            }
        }

        RoomAccessibility::where('hotel_id',$id)->get()->each->delete();
        if($request->room_accessibility){
            foreach( $request->room_accessibility as $room_accessibility){
                $room_facility = new RoomAccessibility();
                $room_facility->hotel_id = $hotel->id;
                $room_facility->room_accessibility = $room_accessibility;
                $room_facility->save();
            }
        }

        return redirect()->back()->with('message', 'Hotel Update Successfully, Thank You.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete(Request $request)
    {
        $hotel = Hotel::find($request->hotel_id);
        @unlink(public_path('upload/hotels/'.$hotel->image));
        foreach($hotel->roomFacilities as $item)
        {
            $item->delete();
        }
        foreach($hotel->roomAccessibilities as $item)
        {
            $item->delete();
        }
        $hotel->delete();
        return back()->with('message','Hotel Info Deleted Successfully');
    }

    public function status_toggle($id)
    {
        $hotel = Hotel::find($id);
        if($hotel->status == 0)
        {
            $hotel->status = 1;
        }elseif($hotel->status == 1)
        {
            $hotel->status = 0;
        }
        $hotel->update();
        return redirect()->back()->with('message', 'Status updated');
    }
}
