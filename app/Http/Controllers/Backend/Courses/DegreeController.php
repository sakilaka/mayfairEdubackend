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
        $request->validate([
            'name' => 'required',
            'degree' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $degree = new Degree();
        $degree->name = $request->name;
    
        if ($request->hasFile('degree')) {
            $fileName = rand().time().'.'.$request->degree->getClientOriginalExtension();
            $request->degree->move(public_path('upload/degree/'), $fileName);
            $degree->image = $fileName;
        }
    
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'degree' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $degree = Degree::findOrFail($id);
        $degree->name = $request->name;
    
        if ($request->hasFile('degree')) {
            // Delete old image if exists
            if ($degree->image && file_exists(public_path('upload/degree/' . $degree->image))) {
                unlink(public_path('upload/degree/' . $degree->image));
            }
    
            // Store new image
            $fileName = rand().time().'.'.$request->degree->getClientOriginalExtension();
            $request->degree->move(public_path('upload/degree/'), $fileName);
            $degree->image = $fileName;
        }
    
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