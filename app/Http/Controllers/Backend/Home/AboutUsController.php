<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function index()
    {
        $data["about"] = AboutUs::first();
        return view("Backend.about.index", $data);
    }

    public function create()
    {
        return view("Backend.about.create");
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'banner_title' => 'required|string|max:255',
                'banner_image1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'banner_image2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'banner_title.required' => 'The banner title is required.',
                'banner_title.string' => 'The banner title must be a valid string.',
                'banner_title.max' => 'The banner title cannot exceed 255 characters.',
                
                'banner_image1.image' => 'The first banner image must be a valid image file.',
                'banner_image1.mimes' => 'The first banner image must be in jpg, jpeg, png, or webp format.',
                'banner_image1.max' => 'The first banner image must not exceed 2MB in size.',
                
                'banner_image2.image' => 'The second banner image must be a valid image file.',
                'banner_image2.mimes' => 'The second banner image must be in jpg, jpeg, png, or webp format.',
                'banner_image2.max' => 'The second banner image must not exceed 2MB in size.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }        
    
            $validated_data = $validator->validated();
    
            $data = [
                'banner_title' => $validated_data['banner_title']
            ];
    
            if ($request->hasFile('banner_image1')) {
    
                $fileName = uniqid() . '.' . $request->banner_image1->getClientOriginalExtension();
                $request->banner_image1->move(public_path('upload/about_us/'), $fileName);
                $data['banner_image1'] = 'upload/about_us/' . $fileName;
            }
    
            if ($request->hasFile('banner_image2')) {
                $fileName = uniqid() . '.' . $request->banner_image2->getClientOriginalExtension();
                $request->banner_image2->move(public_path('upload/about_us/'), $fileName);
                $data['banner_image2'] = 'upload/about_us/' . $fileName;
            }
    
            $about_us = AboutUs::create($data);
            if ($about_us) {
                return redirect(route('about-us.index'))->with('success', 'About Us content added successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to create about us content.');
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}