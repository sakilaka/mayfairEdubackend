<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sections'] = Section::orderBy('id', 'desc')->get();
        return view("Backend.courses.section.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.courses.section.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $section = new Section();
        $section->name = $request->name;
        $section->year = $request->year;
        $section->save();

        return redirect()->route('admin.section.index')->with('success', 'section Added Successfully');
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
        $data["section"] = Section::find($id);
        return view("Backend.courses.section.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $section = Section::find($id);
        $section->name = $request->name;
        $section->year = $request->year;
        $section->status = 1;
        $section->save();

        return redirect()->route('admin.section.index')->with('success', 'Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $section = Section::find($request->section_id);
            $section->delete();

            return redirect()->route('admin.section.index')->with('success', 'Section Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.section.index')->with('error', 'Something Went Wrong!');
        }
    }


    public function status($id)
    {
        try {
            $section = Section::find($id);
            if ($section->status == 0) {
                $section->status = 1;
            } elseif ($section->status == 1) {
                $section->status = 0;
            }
            $section->update();
            return redirect()->route('admin.section.index')->with('success', 'Section Status Changed Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.section.index')->with('error', 'Something Went Wrong!');
        }
    }
}
