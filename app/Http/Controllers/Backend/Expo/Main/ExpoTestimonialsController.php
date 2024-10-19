<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use Illuminate\Http\Request;

class ExpoTestimonialsController extends Controller
{
    /**
     * index of respective expo testimonials
     */
    public function expo_testimonial_index($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('title', 'unique_id', 'testimonials')->first();

        if (!$data['expo']) {
            return back()->with('error', 'Expo not found!');
        }

        return view('Backend.events.expo.main.testimonials.index', $data);
    }

    /**
     * create or update page for respective expo testimonial
     */
    public function expo_testimonial_manage($expo_id, $testimonial_key = null)
    {
        $data['expo'] = $expo = Expo::where('unique_id', $expo_id)->first();

        if (!$data['expo']) {
            return back()->with('error', 'Expo not found!');
        }

        $data['testimonial_key'] = explode('-', uuid_create())[0];
        if ($testimonial_key) {
            $data['testimonial_key'] = $testimonial_key;
        }

        return view('Backend.events.expo.main.testimonials.manage', $data);
    }

    /**
     * update or create respective expo testimonial
     */
    public function expo_testimonial_update(Request $request, $expo_id, $testimonial_key = null)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            $existingTestimonials = json_decode($expo->testimonials, true) ?? [];
            $finalData = [];
            $testimonialPrefix = 'testimonial_';
            $testimonialPath = 'expo/testimonial/';

            foreach ($request->all() as $key => $testimonialData) {
                if (strpos($key, $testimonialPrefix) === 0) {
                    $uuidPart = explode('_', $key)[1];

                    $testimonial = [
                        'name' => $testimonialData['name'] ?? null,
                        'designation' => $testimonialData['designation'] ?? null,
                        'description' => $testimonialData['description'] ?? null,
                        'photo' => null,
                    ];

                    $existingPhoto = null;
                    $existingPhotoPath = '';

                    if ($testimonial_key && isset($existingTestimonials[$testimonial_key])) {
                        $existingPhoto = $existingTestimonials[$testimonial_key]['photo'] ?? null;

                        if ($existingPhoto) {
                            $existingPhotoPath = parse_url($existingPhoto, PHP_URL_PATH);
                            $existingPhotoPath = public_path($existingPhotoPath);
                        }
                    }

                    if ($request->hasFile("{$key}.photo")) {
                        if ($existingPhotoPath && file_exists($existingPhotoPath)) {
                            unlink($existingPhotoPath);
                        }

                        $photoFile = $request->file("{$key}.photo");
                        $photoName = 'user_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                        $photoFile->move(public_path($testimonialPath), $photoName);
                        $testimonial['photo'] = asset($testimonialPath . $photoName);
                    } else {
                        $testimonial['photo'] = $existingPhoto;
                    }

                    if ($testimonial_key && $uuidPart === $testimonial_key) {
                        $existingTestimonials[$uuidPart] = array_merge($existingTestimonials[$uuidPart] ?? [], $testimonial);
                    } else {
                        $finalData[$uuidPart] = $testimonial;
                    }
                }
            }

            $finalData = array_merge($existingTestimonials, $finalData);
            $expo->testimonials = json_encode($finalData);
            $expo->save();

            return redirect(route('admin.expo.testimonial.index', ['expo_id' => $expo->unique_id]))->with('success', 'Testimonial has beed added successfully!');
        } catch (\Exception $e) {
            return redirect(route('admin.expo.testimonial.index', ['expo_id' => $expo->unique_id]))->with('error', 'Something went wrong! Failed to add testimonial.');
        }
    }

    /**
     * delete testimonial of respective expo
     */
    public function expo_testimonial_destroy($expo_id, $testimonial_key)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();
            if (!$expo) {
                return redirect()->back()->with('error', 'Expo not found.');
            }

            $existingTestimonials = json_decode($expo->testimonials, true) ?? [];

            if (isset($existingTestimonials[$testimonial_key])) {
                $existingPhoto = $existingTestimonials[$testimonial_key]['photo'] ?? null;
                if ($existingPhoto) {
                    $existingPhotoPath = parse_url($existingPhoto, PHP_URL_PATH);
                    $existingPhotoPath = public_path($existingPhotoPath);

                    if (file_exists($existingPhotoPath)) {
                        unlink($existingPhotoPath);
                    }
                }

                unset($existingTestimonials[$testimonial_key]);

                $expo->testimonials = json_encode($existingTestimonials);
                $expo->save();

                return redirect()->back()->with('success', 'Testimonial has been deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Testimonial not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Failed to delete testimonial.');
        }
    }
}
