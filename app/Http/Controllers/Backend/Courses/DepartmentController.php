<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function fetchMajorOverview(Request $request)
    {
        $major = Department::find($request->major_id);
        if ($major) {
            return response([
                'major' => $major,
                'status' => 200
            ], 200);
        } else {
            return response([
                'major' => '',
                'status' => 404
            ], 404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['majors'] = Department::orderBy('id', 'desc')->get();
        return view("Backend.courses.department.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.courses.department.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $major = new Department();
        $major->name = $request->name;
        $major->overview = $request->overview;

        $major->save();
        return redirect()->route('admin.major.index')->with('success', 'Department Added Successfully');
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
        $data["major"] = Department::find($id);
        return view("Backend.courses.department.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $major = Department::find($id);
        $major->name = $request->name;
        $major->overview = $request->overview;
        $major->status = 1;

        $major->save();
        return redirect()->route('admin.major.index')->with('success', 'Major Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $major = Department::find($request->department_id);
            // $path = public_path("upload/department/".$major->image);
            // @unlink($path);

            $major->delete();
            return redirect()->route('admin.major.index')->with('success', 'Major Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.major.index')->with('error', 'Something went wrong!');
        }
    }


    public function status($id)
    {
        try {
            $major = Department::find($id);
            if ($major->status == 0) {
                $major->status = 1;
            } elseif ($major->status == 1) {
                $major->status = 0;
            }
            $major->update();
            return redirect()->route('admin.major.index')->with('success', 'Major Status Changed Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.major.index')->with('error', 'Something went wrong!');
        }
    }
}
