<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Degree;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['degrees'] = Degree::orderBy('id', 'desc')->get();
        return view("Backend.courses.degree.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['departments'] = Department::orderBy('id', 'desc')->get();
        return view("Backend.courses.degree.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([

            'name' => 'required',
            // 'link' => 'required',
            // 'image' => 'required',
        ]);

        $degree = new Degree();
        // $degree->department_id = $request->department_id;
        $degree->name = $request->name;
        // $degree->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        // if($request->hasFile('image')){
        //     $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/degree/'),$fileName);
        //     $degree->image = $fileName;
        // }

        $degree->save();
        return redirect()->route('admin.degree.index')->with('success', 'Degree Added Successfully');
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
        $data["degree"] = Degree::find($id);
        // $data['departments'] = Department::orderBy('id', 'desc')->get();
        return view("Backend.courses.degree.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            // 'link' => 'required',
        ]);

        $degree = Degree::find($id);
        $degree->name = $request->name;
        // $degree->department_id = $request->department_id;
        $degree->status = 1;
        // $degree->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        // if($request->hasFile('image')){
        //     @unlink(public_path("upload/degree/".$degree->image));
        //     $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/degree/'),$fileName);
        //     $degree->image = $fileName;
        // }

        $degree->save();
        return redirect()->route('admin.degree.index')->with('success', 'Degree Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $degree = degree::find($request->degree_id);
            // $path = public_path("upload/degree/".$degree->image);
            // @unlink($path);

            $degree->delete();
            return redirect()->route('admin.degree.index')->with('success', 'Degree Deleted Successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.degree.index')->with('error', 'Something Went Wrong!');
        }
    }


    public function status($id)
    {
        try {
            $degree = degree::find($id);
            if ($degree->status == 0) {
                $degree->status = 1;
            } elseif ($degree->status == 1) {
                $degree->status = 0;
            }
            $degree->update();
            return redirect()->route('admin.degree.index')->with('success', 'Degree Status Changed Successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.degree.index')->with('error', 'Something Went Wrong!');
        }
    }
}
