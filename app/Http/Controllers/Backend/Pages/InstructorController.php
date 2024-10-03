<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstructorPageSetup;
use App\Models\InstructorPageContent;


class InstructorController extends Controller
{
    public function instructorPage()
    {

        $data['instructor'] = InstructorPageSetup::first();
        return view('Backend.setting.page.instructor', $data);
    }

    public function instructorPageSetup(Request $request)
    {
        $instructor = InstructorPageSetup::first();
        if ($instructor == null) {
            $instructor = new InstructorPageSetup();
        }

        $instructor->top_title = $request->top_title;
        $instructor->description1 = $request->description1;
        $instructor->button1 = $request->button1;

        if ($request->hasFile('image1')) {
            @unlink(public_path('upload/instructor/' . $instructor->image1));
            $fileName = time() . '_image.' . $request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('upload/instructor'), $fileName);
            $instructor->image1 = $fileName;
        }

        $instructor->videolink1 = $request->videolink1;

        $instructor->text1 = $request->text1;
        $instructor->text2 = $request->text2;

        $instructor->text3 = $request->text3;

        $instructor->ptext1 = $request->ptext1;
        $instructor->ptext2 = $request->ptext2;
        $instructor->ptext3 = $request->ptext3;
        $instructor->ptext4 = $request->ptext4;

        $instructor->text4 = $request->text4;
        $instructor->email = $request->email;
        $instructor->button2 = $request->button2;

        // Handling gallery images
        $photoGalleryImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $key => $file) {
                $fileName = 'instructor_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/instructor'), $fileName);
                $photoGalleryImages[$key] = url('upload/instructor/' . $fileName);
            }
        }

        $oldPhotoGalleryImages = $request->old_image ?? [];
        $mergedPhotoGalleryImages = $oldPhotoGalleryImages;

        foreach ($photoGalleryImages as $key => $url) {
            if (isset($mergedPhotoGalleryImages[$key]) && file_exists(public_path('upload/instructor/' . basename($mergedPhotoGalleryImages[$key])))) {
                unlink(public_path('upload/instructor/' . basename($mergedPhotoGalleryImages[$key])));
            }

            $mergedPhotoGalleryImages[$key] = $url;
        }
        $data['images'] = $mergedPhotoGalleryImages;
        $data['image_titles'] = $request->image_title;
        $instructor->contents = json_encode($data);
        $instructor->save();

        if ($request->delete_instructor) {
            foreach ($request->delete_instructor as $key => $value) {
                $instructorconten = InstructorPageContent::find($value);
                $instructorconten->delete();
            }
        }

        return back()->with("success", "Update Successfully!");
    }
}
