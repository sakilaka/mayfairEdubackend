<?php

namespace App\Http\Controllers\Expo;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Models\ExpoModule;
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
        return view('Frontend.home', $data);
    }

    /**
     * expo details
     */
    public function expoDetails($id)
    {
        $data['expo'] = Expo::find($id);
        return view('Frontend.pages.expodetails', $data);
    }

    /**
     * about us page
     */
    public function about_us()
    {
        return view('Frontend.pages.about_us');
    }

    /**
     * contact page
     */
    public function contact()
    {
        $data['page'] = ExpoModuleContent::where('key', 'contact')->first();
        return view('Frontend.pages.contact', $data);
    }

    /**
     * exhibitors page
     */
    public function exhibitors()
    {
        $data['exhibitors'] = University::where('is_exhibitor', true)
            ->orderByRaw('CASE WHEN position_in_expo IS NULL THEN 1 ELSE 0 END')
            ->orderBy('position_in_expo', 'asc')
            ->get();

        return view('Frontend.pages.exhibitors', $data);
    }

    /**
     * gallery page
     */
    public function gallery()
    {
        $data['galleries'] = ExpoModuleContent::where('key', 'gallery')->select('contents')->first();
        $data['videos'] = ExpoModuleContent::where('key', 'video')->select('contents')->first();

        return view('Frontend.pages.gallery', $data);
    }

    /**
     * expo form
     */
    public function expo_form()
    {
        return view('Frontend.pages.expo_registration');
    }

    /**
     * expo form submit
     */
    public function expo_form_submit(Request $request)
    {
        try {
            $image_url = null;
            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->path()));
                $image_url = 'data:' . $request->file('photo')->getMimeType() . ';base64,' . $image;
            }

            $expoModule = new ExpoModule();
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
        $data['expoData'] = ExpoModule::find($ticket_no);

        if (!$data['expoData']) {
            return redirect(route('expo_module.expo-form'))->with('error', 'Expo ticket not found! Registration now.');
        }
        return view('Frontend.pages.expo_ticket', $data);
    }
}
