<?php

namespace App\Http\Controllers\Backend\Office;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['offices'] = Office::latest()->get();
        return view('Backend.office.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.office.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'map_link' => $request->map_link,
                'others' => $request->others,
            ];

            $contact_no = [];
            if ($request->contact_no) {
                foreach ($request->contact_no as $number) {
                    if ($number != null) {
                        $contact_no[] = $number;
                    }
                }
            }
            $data['contact_no'] = json_encode($contact_no);

            // Handling video uploads
            if ($request->hasFile('video')) {
                $videos = [];
                foreach ($request->file('video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/office/video'), $fileName);
                    $videos[] = url('upload/office/video/' . $fileName);
                }
                $data['video'] = json_encode($videos);
            }

            // Handling gallery images
            if ($request->hasFile('gallery_image')) {
                $galleryImages = [];
                foreach ($request->file('gallery_image') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/office/gallery'), $fileName);
                    $galleryImages[] = url('upload/office/gallery/' . $fileName);
                }
                $data['photos'] = json_encode($galleryImages);
            }

            Office::create($data);
            return redirect(route('backend.admin.office.index'))->with('success', 'Office Created Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['office'] = $office = Office::find($id);

        if (!$office) {
            return redirect()->back()->with('error', 'Office Not Found!');
        }

        return view("Backend.office.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $office = Office::find($id);

        if (!$office) {
            return redirect()->back()->with('error', 'Office not found!');
        }

        DB::beginTransaction();

        try {
            $data = [
                'name' => $request->name,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'map_link' => $request->map_link,
                'others' => $request->others,
            ];

            $contact_no = [];
            if ($request->contact_no) {
                foreach ($request->contact_no as $number) {
                    if ($number != null) {
                        $contact_no[] = $number;
                    }
                }
            }
            $data['contact_no'] = json_encode($contact_no);

            // Handling video uploads
            if ($request->hasFile('video')) {
                // Remove old videos
                $oldVideos = json_decode($office->videos, true) ?? [];
                foreach ($oldVideos as $video) {
                    $oldVideoPath = public_path(parse_url($video, PHP_URL_PATH));
                    if (file_exists($oldVideoPath)) {
                        unlink($oldVideoPath);
                    }
                }

                $videos = [];
                foreach ($request->file('video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/video'), $fileName);
                    $videos[] = url('upload/expo/video/' . $fileName);
                }
                $data['video'] = json_encode($videos);
            } else {
                $data['video'] = $office->video;
            }

            // Handling gallery images
            if ($request->hasFile('gallery_image')) {
                // Remove old gallery images
                $oldGalleryImages = json_decode($office->photos, true) ?? [];
                foreach ($oldGalleryImages as $image) {
                    $oldImagePath = public_path(parse_url($image, PHP_URL_PATH));
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $galleryImages = [];
                foreach ($request->file('gallery_image') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/gallery'), $fileName);
                    $galleryImages[] = url('upload/expo/gallery/' . $fileName);
                }
                $data['photos'] = json_encode($galleryImages);
            } else {
                $data['photos'] = $office->photos;
            }

            $office->update($data);
            DB::commit();

            return redirect(route('backend.admin.office.index'))->with('success', 'Office Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $office = Office::find($request->office_id);

            if (!$office) {
                return back()->with('error', 'Office not found!');
            }

            // Delete video files
            $videos = json_decode($office->video, true) ?? [];
            foreach ($videos as $video) {
                $oldVideoPath = public_path(parse_url($video, PHP_URL_PATH));
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            // Delete gallery images
            $galleryImages = json_decode($office->photos, true) ?? [];
            foreach ($galleryImages as $image) {
                $oldImagePath = public_path(parse_url($image, PHP_URL_PATH));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Delete the office record
            $office->delete();

            return back()->with('success', 'Office Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
