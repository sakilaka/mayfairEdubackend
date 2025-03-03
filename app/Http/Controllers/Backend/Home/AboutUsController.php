<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function index()
    {
        $data["about"] = AboutUs::first();
        return view("Backend.about.index", $data);
    }

    public function indexAbout()
    {
        $data["about"] = AboutUs::first();
        return response()->json([
            'data' => $data
        ]);
    }

    public function indexAboutCard()
    {
        $data["cards"] = AboutUsCard::all();
        return response()->json([
            'data' => $data
        ]);
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
                'about'   => 'required|string',
                'mission' => 'required|string',
                'vision'  => 'required|string',
                'banner_image1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'banner_image2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'banner_title.required' => 'The banner title is required.',
                'about.required' => 'The about section is required.',
                'mission.required' => 'The mission field is required.',
                'vision.required' => 'The vision field is required.',
                'banner_image1.image' => 'The first banner image must be a valid image file.',
                'banner_image2.image' => 'The second banner image must be a valid image file.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated_data = $validator->validated();

            // Debug: Check validated data before storing
            \Log::info('Validated Data:', $validated_data);

            $data = [
                'banner_title' => $validated_data['banner_title'],
                'about' => $validated_data['about'],
                'mission' => $validated_data['mission'],
                'vision' => $validated_data['vision']
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
            \Log::error($e->getMessage());
            return back()->with('error', 'Something Went Wrong: ' . $e->getMessage());
        }
    }

    public function indexCard()
    {
        $data["cards"] = AboutUsCard::all();
        return view("Backend.about_card.index", $data);
    }

    public function createCard()
    {
        return view("Backend.about_card.create");
    }
    public function editCard($id)
    {
        $data['card'] = AboutUsCard::where('id',$id)->first();
        // dd($data['card']);
        return view("Backend.about_card.update", $data);
    }

    public function storeCard(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'card_title'   => 'required|string',
                'card_des'     => 'required|string',
                'card_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'card_title.required' => 'The Card title is required.',
                'card_des.required' => 'The Description section is required.',
                'card_image.image' => 'The card image must be a valid image file.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated_data = $validator->validated();

            // Debug: Check validated data before storing
            \Log::info('Validated Data:', $validated_data);

            $data = [
                'card_title' => $validated_data['card_title'],
                'card_des' => $validated_data['card_des'],
            ];

            if ($request->hasFile('card_image')) {
                $fileName = uniqid() . '.' . $request->card_image->getClientOriginalExtension();
                $request->card_image->move(public_path('upload/about_us/card/'), $fileName);
                $data['card_image'] = 'upload/about_us/card/' . $fileName;
            }


            $about_us = AboutUsCard::create($data);

            if ($about_us) {
                return redirect(route('about-us-card.index'))->with('success', 'About Us content added successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to create about us content.');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something Went Wrong: ' . $e->getMessage());
        }
    }

    public function updateCard(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'card_title'   => 'required|string',
                'card_des'     => 'required|string',
                'card_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'card_title.required' => 'The Card title is required.',
                'card_des.required'   => 'The Description section is required.',
                'card_image.image'    => 'The card image must be a valid image file.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated_data = $validator->validated();
            $card = AboutUsCard::findOrFail($id);

            // Prepare update data
            $data = [
                'card_title' => $validated_data['card_title'],
                'card_des'   => $validated_data['card_des'],
            ];

            // Handle image upload
            if ($request->hasFile('card_image')) {
                // Delete the old image if exists
                if ($card->card_image && file_exists(public_path($card->card_image))) {
                    unlink(public_path($card->card_image));
                }

                $fileName = uniqid() . '.' . $request->card_image->getClientOriginalExtension();
                $request->card_image->move(public_path('upload/about_us/card/'), $fileName);
                $data['card_image'] = 'upload/about_us/card/' . $fileName;
            }

            $card->update($data);

            return redirect(route('about-us-card.index'))->with('success', 'About Us card updated successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something Went Wrong: ' . $e->getMessage());
        }
    }


    public function destroyCard(Request $request)
    {
        try {
            $card = AboutUsCard::find($request->card_id);

            $card->delete();
            return redirect()->route('about-us-card.index')->with('success', 'Degree Deleted Successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('about-us-card.index')->with('error', 'Something Went Wrong!');
        }
    }




}
