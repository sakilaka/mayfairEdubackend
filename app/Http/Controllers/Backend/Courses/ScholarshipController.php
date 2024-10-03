<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /**
     * scholarship - index
     */
    public function index()
    {
        $data['scholarships'] = Scholarship::orderBy('title', 'asc')->get();
        return view('Backend.courses.scholarship.index', $data);
    }

    /**
     * scholarship - create
     */
    public function create()
    {
        return view('Backend.courses.scholarship.create');
    }

    /**
     * scholarship - store
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            // 'scholarship_amount' => 'required',
            'tuition_fee' => 'required',
            'accommodation_fee' => 'required',
            'insurance_fee' => 'required',
            'stipend_monthly' => 'required',
            'stipend_yearly' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            // 'scholarship_amount' => $request->scholarship_amount ?? 0,
            'tuition_fee' => $request->tuition_fee,
            'accommodation_fee' => $request->accommodation_fee,
            'insurance_fee' => $request->insurance_fee,
            'stipend_monthly' => $request->stipend_monthly ?? '',
            'stipend_yearly' => $request->stipend_yearly ?? '',
            'status' => 1
        ];

        Scholarship::create($data);
        return redirect(route('admin.scholarship.index'))->with('success', 'Scholarship created successfully!');
    }

    /**
     * scholarship - edit
     */
    public function edit($id)
    {
        $data['scholarship'] = Scholarship::find($id);
        return view('Backend.courses.scholarship.update', $data);
    }

    /**
     * scholarship - update
     */
    public function update(Request $request, $id)
    {
        try {
            $scholarship = Scholarship::find($id);

            $request->validate([
                'title' => 'required|string',
                // 'scholarship_amount' => 'required',
                'tuition_fee' => 'required',
                'accommodation_fee' => 'required',
                'insurance_fee' => 'required',
                'stipend_monthly' => 'required',
                'stipend_yearly' => 'required',
            ]);

            $data = [
                'title' => $request->title ?? $scholarship->title,
                'type' => $request->type ?? $scholarship->type,
                // 'scholarship_amount' => $request->scholarship_amount ?? $scholarship->scholarship_amount ?? 0,
                'tuition_fee' => $request->tuition_fee ?? $scholarship->tuition_fee,
                'accommodation_fee' => $request->accommodation_fee ?? $scholarship->accommodation_fee,
                'insurance_fee' => $request->insurance_fee ?? $scholarship->insurance_fee,
                'stipend_monthly' => $request->stipend_monthly ?? $scholarship->stipend_monthly ?? '',
                'stipend_yearly' => $request->stipend_yearly ?? $scholarship->stipend_yearly ?? '',
                'status' => 1
            ];

            $scholarship->update($data);
            return redirect(route('admin.scholarship.index'))->with('success', 'Scholarship updated successfully!');
        } catch (\Exception $e) {
            return redirect(route('admin.scholarship.index'))->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * scholarship - delete
     */
    public function destroy(Request $request)
    {
        try {
            $scholarship = Scholarship::find($request->scholarship_id);
            $scholarship->delete();
            return redirect()->route('admin.scholarship.index')->with('success', 'Scholarship Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.scholarship.index')->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * scholarship - status change
     */
    public function status($id)
    {
        try {
            $scholarship = Scholarship::find($id);
            if ($scholarship->status == 0) {
                $scholarship->status = 1;
            } elseif ($scholarship->status == 1) {
                $scholarship->status = 0;
            }
            $scholarship->update();
            return redirect()->route('admin.scholarship.index')->with('success', 'Scholarship Status Changed Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.scholarship.index')->with('error', 'Something Went Wrong!');
        }
    }
}
