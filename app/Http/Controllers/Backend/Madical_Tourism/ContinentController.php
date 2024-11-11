<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['continents'] = Continent::orderBy('name', 'asc')->get();
        return view('Backend.medical_tourism.continent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.medical_tourism.continent.create');
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

        $continent = new Continent();
        $continent->name = $request->name;
        if ($request->hasFile('image')) {
            $fileName = rand() . time() . '_continent_image.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/continents/'), $fileName);
            $continent->image = $fileName;
        }
        $continent->save();
        return redirect()->route('continent.index')->with('success', 'Continent Created Successfully');
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
        $data['continent'] = Continent::find($id);
        return view('Backend.medical_tourism.continent.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $continent = Continent::find($id);
        $continent->name = $request->name;
        if ($request->hasFile('image')) {
            @unlink(public_path('upload/continent/' . $continent->image));
            $fileName = rand() . time() . '_continent_image.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/continents/'), $fileName);
            $continent->image = $fileName;
        }
        $continent->update();
        return redirect()->route('continent.index')->with('success', 'Continent Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $continent = Continent::find($request->continent_id);
            @unlink(public_path('upload/continents/' . $continent->image));
            $continent->delete();

            return back()->with('success', 'Continent Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function status_toggle($id)
    {
        try {
            $continent = Continent::find($id);
            if ($continent->status == 0) {
                $continent->status = 1;
            } elseif ($continent->status == 1) {
                $continent->status = 0;
            }
            $continent->update();
            return redirect()->back()->with('success', 'Continent Status Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
