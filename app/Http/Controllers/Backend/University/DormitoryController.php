<?php

namespace App\Http\Controllers\Backend\University;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use Illuminate\Http\Request;

class DormitoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dormitories'] = Dormitory::latest()->get();
        return view("Backend.university.dormitory.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.university.dormitory.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dormitory = new Dormitory();
            $dormitory->name = $request->name;
            $dormitory->persons_in_room = $request->persons_in_room;
            $dormitory->rent = $request->rent;
            $dormitory->introduction = $request->introduction;
            $dormitory->video_url = $request->video_url;
            $dormitory->off_campus_facility = $request->off_campus_facility;

            // Handling gallery images
            if ($request->hasFile('gallery_image')) {
                $galleryImages = [];
                foreach ($request->file('gallery_image') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/dormitory'), $fileName);
                    $galleryImages[$key] = url('upload/dormitory/' . $fileName);
                }
                $dormitory->photos = json_encode($galleryImages);
            }

            $dormitory->save();

            return redirect()->route('admin.dormitory.index')->with('success', 'Dormitory Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
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
        $data["dormitory"] = $dormitory = Dormitory::find($id);

        if (!$dormitory) {
            return redirect()->route('admin.dormitory.index')->with('error', 'Dormitory Not Found!');
        }

        return view("Backend.university.dormitory.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dormitory = Dormitory::find($id);

            $dormitory->name = $request->name;
            $dormitory->persons_in_room = $request->persons_in_room;
            $dormitory->rent = $request->rent;
            $dormitory->introduction = $request->introduction;
            $dormitory->video_url = $request->video_url;
            $dormitory->off_campus_facility = $request->off_campus_facility;

            // Handle new gallery images from the request
            $galleryImages = [];
            if ($request->hasFile('gallery_image')) {
                foreach ($request->file('gallery_image') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/dormitory'), $fileName);
                    $galleryImages[$key] = url('upload/dormitory/' . $fileName);
                }
            }

            $oldGalleryImages = $request->old_gallery_image ?? [];
            $mergedGalleryImages = $oldGalleryImages;

            foreach ($galleryImages as $key => $url) {
                $mergedGalleryImages[$key] = $url;
            }
            $dormitory->photos = json_encode($mergedGalleryImages);

            $dormitory->save();

            return redirect()->route('admin.dormitory.index')->with('success', 'Dormitory Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $dormitory = Dormitory::find($request->dormitory_id);
            $dormitory->delete();

            return redirect()->route('admin.dormitory.index')->with('success', 'Dormitory Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.dormitory.index')->with('error', 'Something Went Wrong!');
        }
    }


    public function status($id)
    {
        try {
            $dormitory = Dormitory::find($id);
            if ($dormitory->status == 0) {
                $dormitory->status = 1;
            } elseif ($dormitory->status == 1) {
                $dormitory->status = 0;
            }
            $dormitory->update();
            return redirect()->route('admin.dormitory.index')->with('success', 'Dormitory Status Changed Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.dormitory.index')->with('error', 'Something Went Wrong!');
        }
    }
}
