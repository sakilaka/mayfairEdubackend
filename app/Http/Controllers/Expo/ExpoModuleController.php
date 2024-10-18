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

class ExpoModuleController extends Controller
{
    /**
     * expo site - home
     */
    public function index(Request $request)
    {
        $data['exhibitors'] = University::where(['is_exhibitor' => true, 'show_in_expo' => true])
            ->orderByRaw('CASE WHEN position_in_expo IS NULL THEN 1 ELSE 0 END')
            ->orderBy('position_in_expo', 'asc')
            ->get();
        return view('Expo.home', $data);
    }

    /**
     * expo details
     */
    public function expoDetails($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->first();

        if (!$data['expo']) {
            abort(404, 'Expo Not Found!');
        }

        $data['exhibitors'] = [];
        foreach (json_decode($data['expo']->universities) ?? [] as $exhibitor_id) {
            $exhibitor = University::find($exhibitor_id);

            if ($exhibitor) {
                $data['exhibitors'][] = $exhibitor;
            }
        }

        $data['exhibitors'] = collect($data['exhibitors']);

        return view('Expo.details', $data);
    }

    /**
     * about us page
     */
    /* public function about_us()
    {
        return view('Expo.pages.about_us');
    } */

    /**
     * contact page
     */
    /* public function contact()
    {
        $data['page'] = ExpoModuleContent::where('key', 'contact')->first();
        return view('Expo.pages.contact', $data);
    } */

    /**
     * exhibitors page
     */
    public function exhibitors($unique_id)
    {
        $data['expo'] = $expo = Expo::where('unique_id', $unique_id)->first();

        if ($expo && !empty($expo->universities)) {
            $universities = json_decode($expo->universities, true);

            $data['exhibitors'] = University::whereIn('id', $universities)
                ->orderByRaw('CASE WHEN position_in_expo IS NULL THEN 1 ELSE 0 END')
                ->orderBy('position_in_expo', 'asc')
                ->get();
        } else {
            $data['exhibitors'] = collect();
        }

        return view('Expo.pages.exhibitors', $data);
    }

    /**
     * schedule page
     */
    public function schedule($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'additional_contents')->first();
        return view('Expo.pages.schedule', $data);
    }

    /**
     * testimonials page
     */
    public function testimonials($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'additional_contents', 'testimonials')->first();
        return view('Expo.pages.testimonials', $data);
    }

    /**
     * delegates page
     */
    public function delegates($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'additional_contents', 'delegates')->first();
        return view('Expo.pages.delegates', $data);
    }

    /**
     * gallery page
     */
    public function gallery($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'additional_contents', 'gallery')->first();
        return view('Expo.pages.gallery', $data);
    }

    /**
     * video page
     */
    public function video($unique_id)
    {
        $data['expo'] = Expo::where('unique_id', $unique_id)->select('unique_id', 'title', 'additional_contents', 'video')->first();
        return view('Expo.pages.video', $data);
    }


    /**
     * gallery page
     */
    /* public function gallery()
    {
        $data['galleries'] = ExpoModuleContent::where('key', 'gallery')->select('contents')->first();
        $data['videos'] = ExpoModuleContent::where('key', 'video')->select('contents')->first();

        return view('Expo.pages.gallery', $data);
    } */

    /**
     * expo form
     */
    public function expo_form($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title')->first();
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
        return $expo_id;
        try {
            $image_url = null;
            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->path()));
                $image_url = 'data:' . $request->file('photo')->getMimeType() . ';base64,' . $image;
            }

            $expoModule = new ExpoUser();
            $expoModule->ticket_no = strtoupper(substr((string) Str::uuid(), 0, 8));
            $expoModule->email = $request->email;
            $expoModule->password = Hash::make($request->password);
            // $expoModule->id_type = $request->id_type;
            // $expoModule->id_no = $request->id_no;
            $expoModule->first_name = $request->first_name;
            $expoModule->last_name = $request->last_name;
            $expoModule->photo = $image_url;
            $expoModule->nationality = $request->nationality;
            $expoModule->sex = $request->sex;
            $expoModule->dob = $request->dob;
            $expoModule->phone = $request->phone;
            $expoModule->profession = $request->profession;
            $expoModule->institution = $request->institution;
            $expoModule->program = $request->program;
            $expoModule->degree = $request->degree;
            $expoModule->save();

            return back()->with(['success' => 'Expo registration has been successful!', 'status' => 'submitted', 'expoData' => $expoModule]);
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with(['error' => 'Something Went Wrong!']);
        }
    }

    /**
     * expo ticket
     */
    public function expo_ticket($ticket_no)
    {
        $data['expoData'] = ExpoUser::find($ticket_no);

        if (!$data['expoData']) {
            return redirect(route('expo_module.expo-form'))->with('error', 'Expo ticket not found! Registration now.');
        }
        return view('Expo.pages.expo_ticket', $data);
    }
}
