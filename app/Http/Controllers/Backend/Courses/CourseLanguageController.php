<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseLanguage;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->get();
        return view("Backend.courses.language.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.courses.language.create");
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

        $language = new CourseLanguage();
        $language->name = $request->name;

        // $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        $language->save();
        return redirect()->route('admin.language.index')->with('success', 'Language Added Successfully');
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
        $data["language"] = CourseLanguage::find($id);
        return view("Backend.courses.language.update", $data);
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

        $language = CourseLanguage::find($id);
        $language->name = $request->name;
        $language->status = 1;
        // $partner->link = "https://" . preg_replace('#^https?://#', '',$request->link);


        $language->save();
        return redirect()->route('admin.language.index')->with('success', 'Language  Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $language = CourseLanguage::find($request->language_id);

            $language->delete();
            return redirect()->route('admin.language.index')->with('success', 'Language Deleted Successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.language.index')->with('error', 'Something Went Wrong!');
        }
    }

    public function status_toggle($id)
    {
        try {
            $language = CourseLanguage::find($id);
            if ($language->status == 0) {
                $language->status = 1;
            } elseif ($language->status == 1) {
                $language->status = 0;
            }
            $language->update();
            return redirect()->route('admin.language.index')->with('success', 'Language Status Changed Successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.language.index')->with('error', 'Something Went Wrong!');
        }
    }
}
