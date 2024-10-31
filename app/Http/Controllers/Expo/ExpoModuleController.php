<?php

namespace App\Http\Controllers\Expo;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Models\ExpoUser;
use App\Models\ExpoModuleContent;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ExpoModuleController extends Controller
{
    /**
     * expo details
     */
    public function expoDetails($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->first();

        if (!$data['expo']) {
            abort(404, 'Expo Not Found!');
        }

        $exhibitor_data = json_decode($data['expo']->exhibitors, true) ?? [];
        $exhibitor_ids = array_column($exhibitor_data, 'exhibitor');

        $universities = University::whereIn('id', $exhibitor_ids)->get();

        $data['exhibitors'] = $universities->map(function ($university) use ($exhibitor_data) {
            $exhibitor_info = collect($exhibitor_data)->firstWhere('exhibitor', $university->id);
            $university->show_in_expo = $exhibitor_info['show_on_home'] ?? false;
            $university->position_in_expo = $exhibitor_info['position_in_expo'] ?? null;
            return $university;
        })->filter(function ($university) {
            return $university->show_in_expo;
        })->sortBy(function ($university) {
            return $university->position_in_expo ?? PHP_INT_MAX;
        })->values();

        return view('Expo.details', $data);
    }

    /**
     * exhibitors page
     */
    public function exhibitors($unique_id)
    {
        $data['expo'] = $expo = Expo::where('unique_id', $unique_id)->first();

        if ($expo && !empty($expo->exhibitors)) {
            $exhibitors = json_decode($expo->exhibitors, true);
            $exhibitor_ids = array_column($exhibitors, 'exhibitor');

            $data['exhibitors'] = University::whereIn('id', $exhibitor_ids)
                ->get()
                ->map(function ($university) use ($exhibitors) {
                    $exhibitor_info = collect($exhibitors)->firstWhere('exhibitor', $university->id);
                    $university->show_in_expo = $exhibitor_info['show_in_expo'] ?? false;
                    $university->position_in_expo = $exhibitor_info['position_in_expo'] ?? null;
                    return $university;
                })
                ->sortBy(function ($university) {
                    return $university->position_in_expo ?? PHP_INT_MAX;
                })
                ->values();
        } else {
            $data['exhibitors'] = collect();
        }

        return view('Expo.pages.exhibitors', $data);
    }


    /**
     * exhibitor details
     */
    public function exhibitor_details($type, $exhibitor_id)
    {
        $data['exhibitor'] = University::find($exhibitor_id);
        $data['type'] = $type;

        if (!$data['exhibitor']) {
            return back()->with('error', 'Exhibitor Not Found!');
        }

        if ($type === 'main') {
            if ($data['exhibitor']['exhibitor_desc'] === null) {
                return redirect(route('frontend.university_details', ['id' => $data['exhibitor']->id]));
            }
        } elseif ($type === 'site') {
            if ($data['exhibitor']['exhibitor_site_desc'] === null) {
                return redirect(route('frontend.university_details', ['id' => $data['exhibitor']->id]));
            }
        }

        return view('Frontend.pages.exhibitor_details', $data);
    }

    /**
     * schedule page
     */
    public function schedule($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents')->first();
        return view('Expo.pages.schedule', $data);
    }

    /**
     * testimonials page
     */
    public function testimonials($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents', 'testimonials')->first();
        return view('Expo.pages.testimonials', $data);
    }

    /**
     * delegates page
     */
    public function delegates($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents', 'delegates')->first();
        return view('Expo.pages.delegates', $data);
    }

    /**
     * gallery page
     */
    public function gallery($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents', 'gallery')->first();
        return view('Expo.pages.gallery', $data);
    }

    /**
     * video page
     */
    public function video($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents', 'video')->first();
        return view('Expo.pages.video', $data);
    }

    /**
     * video page
     */
    public function join($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents', 'join_page_contents')->first();
        return view('Expo.pages.join', $data);
    }


    /**
     * expo form
     */
    public function expo_form($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'theme_colors', 'additional_contents', 'footer_contents')->first();
        if (!$data['expo']) {
            return back()->with('error', 'Expo Not Found!');
        }
        return view('Expo.pages.expo_registration', $data);
    }

    /**
     * expo form submit
     */
    public function expo_form_submit(Request $request, $expo_id)
    {
        $request->validate([
            'email' => 'unique:expo_users,email'
        ]);

        try {
            $image_url = null;
            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->path()));
                $image_url = 'data:' . $request->file('photo')->getMimeType() . ';base64,' . $image;
            }

            $expoUser = new ExpoUser();
            $expoUser->ticket_no = strtoupper(substr((string) Str::uuid(), 0, 8));
            $expoUser->expo_id = $expo_id;
            $expoUser->email = $request->email;
            $expoUser->password = Hash::make($request->password);
            // $expoUser->id_type = $request->id_type;
            // $expoUser->id_no = $request->id_no;
            $expoUser->first_name = $request->first_name;
            $expoUser->last_name = $request->last_name;
            $expoUser->photo = $image_url;
            $expoUser->nationality = $request->nationality;
            $expoUser->sex = $request->sex;
            $expoUser->dob = $request->dob;
            $expoUser->phone = $request->phone;
            $expoUser->profession = $request->profession;
            // $expoUser->institution = $request->institution;
            // $expoUser->program = $request->program;
            $expoUser->degree = $request->degree;
            $expoUser->save();

            return back()->with(['success' => 'Expo registration has been successful!', 'status' => 'submitted', 'expoData' => $expoUser]);
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with(['error' => 'Something Went Wrong!']);
        }
    }

    /**
     * expo ticket
     */
    public function expo_ticket($expo_id, $ticket_no)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'additional_contents', 'footer_contents')->first();
        if (!$data['expo']) {
            return back()->with('error', 'Expo Not Found!');
        }

        $data['expoData'] = ExpoUser::find($ticket_no);

        if (!$data['expoData']) {
            return redirect(route('expo_module.expo-form'))->with('error', 'Expo ticket not found! Registration now.');
        }
        return view('Expo.pages.expo_ticket', $data);
    }
}
