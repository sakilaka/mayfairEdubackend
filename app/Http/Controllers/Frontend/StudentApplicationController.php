<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationDocument;
use App\Models\ApplicationEducation;
use App\Models\ApplicationWork;
use App\Models\Country;
use App\Models\Course;
use App\Models\FamilyMember;
use App\Models\FamilyMemberUni;
use App\Models\Notification;
use App\Models\Page;
use App\Models\StudentApplication;
use App\Models\University;
use App\Models\UniversityApplication;
use App\Models\UniversityDocument;
use App\Models\UniversityEducation;
use App\Models\UniversityWork;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentApplicationController extends Controller
{


    public function applications()
    {
        $applications = StudentApplication::where('user_id', auth()->user()->id)->has('carts')->get();
        return view('Frontend.university.applications');
    }

    public function successApplication()
    {
        // $applications = StudentApplication::where('user_id', auth()->user()->id)->has('carts')->get();
        return view('Frontend.success');
    }

    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    /* function applyCart(Request $request, $id, $partner_ref_id = null, $is_applied_partner = null)
    {
    return $request->all();
    if (!Auth::check() && !$request->query('partner_ref_id')) {
    return redirect()->route('frontend.signin')->with('error', 'Please sign in or provide a partner reference ID.');
    }

    if (session('partner_ref_id') || $request->query('partner_ref_id')) {
    $partner_ref_id = session('partner_ref_id') ?? $request->query('partner_ref_id');
    }

    if (session('is_applied_partner') || $request->query('is_applied_partner') || ($request->query('is_anonymous') == 'true')) {
    $is_anonymous = $request->query('is_anonymous') == 'true' ? 1 : 0;
    $is_applied_partner = session('is_applied_partner') ?? $request->query('is_applied_partner') ?? $is_anonymous;
    }

    $course = Course::find($id);
    $application = null;

    if (Auth::check()) {
    $application = StudentApplication::where('status', 0)->where('user_id', auth()->user()->id)->where('partner_ref_id', $partner_ref_id)->has('carts')->first();
    }

    if ($application == null) {
    $application = new StudentApplication;
    $application->user_id = auth()->user()->id ?? null;
    $application->application_code = 'M-EDU-' . strtoupper($this->generateRandomString(6));
    $application->service_charge = (float) $course->service_charge ?? 0;
    $application->application_fee = (float) $course->application_charge ?? 0;
    $application->total_fee = (float) $course->application_charge + (float) $course->service_charge;
    $application->partner_ref_id = base64_decode($partner_ref_id);
    $application->is_applied_partner = $is_applied_partner;

    $application->save();
    } else {
    $application->service_charge = (float) $course->service_charge;
    $application->application_fee +=  (float) $course->application_charge;
    $application->total_fee += (float) $course->application_charge + (float) $course->service_charge;

    $application->save();
    }

    $cart = Cart::where('application_id', $application->id)->where('course_id', $course->id)->first();

    if ($cart) {
    $application->service_charge = (float) $course->service_charge;
    $application->application_fee +=  (float) $course->application_charge;
    $application->total_fee += (float) $course->application_charge + (float) $course->service_charge;

    $application->save();
    return back()->with('error', 'Sorry, This program already added');
    }

    $cart = new Cart;
    $cart->application_id = $application->id;
    $cart->course_id = $course->id;
    $cart->amount =
    (empty($course->application_charge) ? 0 : $course->application_charge) +
    (empty($course->service_charge) ? 0 : $course->service_charge);

    $cart->save();

    $params = ['id' => $application->id];

    if (session('partner_ref_id') && !empty(session('partner_ref_id'))) {
    $params['partner_ref_id'] = session('partner_ref_id');
    }

    if (session('is_applied_partner')) {
    $params['is_applied_partner'] = true;
    }

    return redirect()->route('apply_admission', $params);
    } */
   
    public function applyCart(Request $request, $id, $partner_ref_id = null, $applied_by = null)
    {
        $auth_user = auth('admin')->user() ?? auth()->user();

        if (!$auth_user && !$request->query('partner_ref_id')) {
            return redirect()->route('frontend.signin')->with('error', 'Please sign in or provide a partner reference ID.');
        }

        // Retrieve and format partner_ref_id and applied_by
        $partner_ref_id = session('partner_ref_id') ?? $request->query('partner_ref_id');
        $applied_by     = session('applied_by') ?? $request->query('applied_by');
        $is_anonymous   = $request->query('is_anonymous') == 'true' ? 1 : 0;

        if ($partner_ref_id) {
            $partner_ref_id = json_decode($partner_ref_id, true);
            if (is_array($partner_ref_id)) {
                $partner_ref_id = array_merge(...array_map(fn($id, $role) => [$role => $id], $partner_ref_id, array_keys($partner_ref_id)));
            } elseif ($applied_by) {
                $partner_ref_id = [$applied_by => $partner_ref_id];
            }
        }

        if (is_string($applied_by)) {
            $applied_by = $partner_ref_id;
        } elseif (is_array($applied_by)) {
            $applied_by = array_merge(...array_map(fn($id, $role) => [$role => $id], $applied_by, array_keys($applied_by)));
        }

        // Prepare redirect URL parameters
        $params = [];
        if ($partner_ref_id) {
            $params['partner_ref_id'] = is_array($partner_ref_id) && count($partner_ref_id) === 1
            ? reset($partner_ref_id)
            : $partner_ref_id;
        }
        if ($applied_by) {
            $params['applied_by'] = is_array($applied_by) && count($applied_by) === 1
            ? array_key_first($applied_by)
            : $applied_by;
        }
        if ($is_anonymous) {
            $params['is_anonymous'] = $is_anonymous;
        }

        // Find course and application
        $course      = Course::find($id);
        $application = null;

        if ($auth_user->role == 'student') {
            $query       = StudentApplication::where(['status' => 0, 'user_id' => $auth_user->id]);
            $application = $query->first();

            if ($application) {
                $existingPrograms = json_decode($application->programs, true) ?? [];
                if (!in_array($course->id, $existingPrograms)) {
                    $application = null;
                }
            }
        } else {
            $roleKey     = $auth_user->role;
            $application = StudentApplication::where(function ($query) use ($auth_user, $roleKey) {
                $query->where('applied_by', 'like', '%"' . $roleKey . '":' . $auth_user->id . '%')
                    ->where('status', 0);
            })->first();

            /* foreach ($applications as $app) {
        $existingPrograms = json_decode($app->programs, true) ?? [];
        if (in_array($course->id, $existingPrograms)) {
        $application = $app;
        break;
        }
        } */
        }

        if ($application == null) {
            $application                   = new StudentApplication();
            $application->user_id          = $auth_user->id;
            $randomNumber                  = random_int(100000, 999999); // Generates a 6-digit random number
            $application->application_code = date('ymd') . $randomNumber;
            // $application->application_code = date('ymd') . strtoupper($this->generateRandomString(6));

            // $application->service_charge = (float) $course->service_charge ?? 0;
            $application->application_fee = (float) $course->application_charge ?? 0;
            $application->total_fee       = /* $application->service_charge + */$application->application_fee;
            $application->applied_by      = !empty($applied_by) ? json_encode($applied_by) : null;
            $application->is_anonymous    = $is_anonymous;
            $application->programs        = json_encode([$course->id]);

            $application->save();
        } else {
            $existingPrograms = json_decode($application->programs, true) ?? [];

            if (in_array($course->id, $existingPrograms)) {
                $params['id'] = $application->id;
                return redirect()->route('apply_admission', $params)->with('error', 'Sorry, This program is already added.');
            }

            // $application->service_charge += (float) $course->service_charge;
            $application->application_fee += (float) $course->application_charge;
            $application->total_fee += /* $course->service_charge + */$course->application_charge;
            $application->applied_by = !empty($applied_by) ? json_encode($applied_by) : $application->applied_by;
            $existingPrograms[]      = $course->id;
            // $application->programs = json_encode($existingPrograms);
            $application->programs = '';

            $application->save();
        }

        $params['id'] = $application->id;
        return redirect()->route('apply_admission', $params);
    }

    public function applyAdmission($id)
    {
        $data['countries']   = Country::all();
        $data['application'] = StudentApplication::find($id);

        // If application is null, redirect or handle gracefully
        if (!$data['application']) {
            return redirect(env('FRONTEND_URL', 'https://mayfaireducation.global/') . '/course?message=Application%20not%20found');
        }


        // Use optional chaining and null coalescing to avoid errors
        $programs = json_decode($data['application']?->programs ?? '[]', true) ?? [];

        // Fetch all programs related to the application
        $data['programs'] = Course::whereIn('id', $programs)->get();

        $data['is_contain_masters_or_phd'] = false;
        foreach ($data['programs'] as $program) {
            if (in_array($program->degree?->name ?? '', ['Masters', 'PhD'])) {
                $data['is_contain_masters_or_phd'] = true;
            }
        }

        $data['terms']   = Page::where('title', 'Terms And Conditions')->first();
        $data['refund']  = Page::where('title', 'Refund Policy')->first();
        $data['privacy'] = Page::where('title', 'Privacy Policy')->first();
        $data['payment'] = Page::where('title', 'Payment Process')->first();

        // Handle cases where the user might not be authenticated
        $data['user'] = User::find(auth()->id() ?? 1);

        // Determine the total service charge based on the user's star level
        $userStarLevel      = $data['user']?->star ?? null;
        $totalServiceCharge = 0;

        foreach ($data['programs'] as $program) {
            $serviceChargeField = 'service_charge_' . ($userStarLevel ?? 'beginner');
            $totalServiceCharge += $program->$serviceChargeField ?? 0;
        }

        $data['service_charge'] = $totalServiceCharge;

        return view('Frontend.university.apply', $data);
    }


    public function applyAdmissionUniversity()
    {
        $data['countries'] = Country::all();
        // $data['application'] = StudentApplication::find($id);

        // if ($data['application'] == null) {
        //     return redirect()->route('frontend.university_course_list');
        // }

        // $programs = json_decode($data['application']->programs, true) ?? [];

        // Fetch all programs related to the application

        // $data['programs'] = Course::whereIn('id', $programs)->get();

        // $data['is_contain_masters_or_phd'] = false;
        // foreach ($data['programs'] as $program) {
        //     if (in_array($program->degree?->name, ['Masters', 'PhD'])) {
        //         $data['is_contain_masters_or_phd'] = true;
        //     }
        // }

        // $data['terms']   = Page::where('title', 'Terms And Conditions')->first();
        // $data['refund']  = Page::where('title', 'Refund Policy')->first();
        // $data['privacy'] = Page::where('title', 'Privacy Policy')->first();
        // $data['payment'] = Page::where('title', 'Payment Process')->first();

        // $data['user'] = User::find(auth()->user()->id ?? 1);

        // Determine the total service charge based on the user's star level
        // $userStarLevel      = $data['user']->star;
        // $totalServiceCharge = 0;

        // foreach ($data['programs'] as $program) {
        //     if ($userStarLevel === null) {
        //         $totalServiceCharge += $program->service_charge_beginner;
        //     } else {
        //         $serviceChargeField = 'service_charge_' . $userStarLevel;
        //         $totalServiceCharge += $program->$serviceChargeField;
        //     }
        // }

        // $data['service_charge'] = $totalServiceCharge;

        return view('Frontend.university.applyUniversity', $data);
    }

    public function applyCartDelete(Request $request)
    {
        $programId = $request->input('program_id');

        if (!$programId) {
            return redirect()->back()->with('error', 'Invalid program ID.');
        }

        $application = StudentApplication::find($request->input('application_id'));

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        $existingPrograms = json_decode($application->programs, true) ?? [];

        if (($key = array_search($programId, $existingPrograms)) !== false) {
            unset($existingPrograms[$key]);
            $application->programs = json_encode(array_values($existingPrograms));
            $application->save();

            return redirect()->back()->with('success', 'Program removed successfully.');
        }

        return redirect()->back()->with('error', 'Program not found in application.');
    }

    public function applicationDetails($id)
    {
        $application = StudentApplication::find($id);

        if ($application) {
            $data['programs'] = [];

            foreach ($application->carts as $cart) {
                $program                      = [];
                $program['id']                = $cart->id;
                $program['logo']              = $cart->course->university->image_show;
                $program['url']               = url('courses/details/' . $cart->course?->id);
                $program['user_program_name'] = $cart->course?->name;
                $program['deadline']          = date('M d, Y', strtotime($cart->course->application_deadline));
                $to                           = \Carbon\Carbon::now();
                $from                         = \Carbon\Carbon::parse($cart->course->application_deadline);
                $program['days_to_deadline']  = $days  = $to->diffInDays($from);
                $program['start_date']        = date('M d, Y', strtotime($cart->course->next_start_date));
                $data['programs'][]           = $program;
            }
            $data['code']      = 0;
            $data['msg']       = "program is not found";
            $data['status']    = "Application Started";
            $data['waits_for'] = "no";

            $data['application_fee'] = $application->application_fee;
            $data['total_fee']       = $application->total_fee;

            return response()->json($data);
        } else {
            $data['code'] = -1;
            $data['msg']  = "program is not found";
            return response()->json($data);
        }
    }

    public function applicationPersonalInfoUni(Request $request)
    {
        // dd($request->all());
        $application = new UniversityApplication();

        $application->university      = implode(', ', $request->university);
        $application->email           = $request->email;
        $application->phone           = $request->phone;
        $application->contact_id      = $request->contact_id;
        $application->first_name      = $request->first_name;
        $application->middle_name     = $request->middle_name;
        $application->last_name       = $request->last_name;
        $application->last_name       = $request->last_name;
        $application->chinese_name    = $request->chinese_name;
        $application->dob             = $request->date_of_birth;
        $application->gender          = $request->gender;
        $application->hobby           = $request->hobbies_interests;
        $application->in_chaina       = $request->is_in_china == false ? 0 : 1;
        $application->in_alcoholic    = $request->addict_to_alcohol_drugs == false ? 0 : 1;
        $application->native_language = $request->language_native;
        $application->english_level   = $request->language_proficiency_english;

        $application->english_proficiency_certificate = $request->certificate_english_proficiency;
        $application->certificate_issue_date          = $request->certificate_issue_date;
        $application->english_score                   = $request->english_score;

        $application->chinese_level = $request->language_proficiency_chinese;
        $application->HSK_level     = $request->HSK_level;
        $application->HSK_score     = $request->HSK_score;
        $application->HSK_report_no = $request->report_no;
        $application->HSKK_score    = $request->HSKK_level;
        $application->HSKK_score    = $request->HSKK_score;

        $application->maritial_status      = $request->marital_status;
        $application->nationality          = $request->applicants_nationality;
        $application->passport_exipre_date = $request->passport_expiration_date;
        $application->passport_number      = $request->passport_no;
        $application->birth_place          = $request->place_of_birth;
        $application->religion             = $request->religion;

        // Home address
        $application->home_country       = $request->country;
        $application->home_city          = $request->city;
        $application->home_district      = $request->district;
        $application->home_contact_name  = $request->contact;
        $application->home_contact_phone = $request->phone;
        $application->home_street        = $request->street;
        $application->home_zipcode       = $request->zipcode;

        // post address
        $application->current_country       = $request->country;
        $application->current_city          = $request->city;
        $application->current_district      = $request->district;
        $application->current_contact_name  = $request->contact;
        $application->current_contact_phone = $request->phone;
        $application->current_street        = $request->street;
        $application->current_zipcode       = $request->zipcode;


        $application->guarantor_name            = $request->supporter_name;
        $application->guarantor_email           = $request->supporter_email;
        $application->guarantor_phone           = $request->supporter_phone;
        $application->guarantor_address         = $request->supporter_address;
        $application->guarantor_workplace       = $request->supporter_company;
        $application->guarantor_work_address    = $request->supporter_company_address;
        $application->guarantor_relationship    = $request->supporter_relationship;
        $application->guarantor_inter_relation  = $request->inlineRadioOptions;
        $application->study_fund                = $request->fund;
        $application->scholarship               = $request->scholarship;
        $application->emergency_contact_name    = $request->emergency_contact_name;
        $application->emergency_contact_phone   = $request->emergency_contact_phone;
        $application->emergency_contact_email   = $request->emergency_contact_email;
        $application->emergency_contact_address = $request->emergency_contact_address;

        $application->save();


        $educationData = $request->input('education');

        foreach ($educationData as $field) {
            $studentEducation = new UniversityEducation;
            $studentEducation->application_id = $application->id;
            $studentEducation->country = $field['country'] ?? null;
            $studentEducation->gpa_type = $field['gpa'] ?? null;
            $studentEducation->major = $field['major'] ?? null;
            $studentEducation->end_date = $field['month_finished'] ?? null;
            $studentEducation->start_date = $field['month_started'] ?? null;
            $studentEducation->school = $field['school'] ?? null;
            $studentEducation->save();
        }


        // $workExperienceData = $request->input('work');

        // foreach ($workExperienceData as $field) {
        //     $workExperience = new UniversityWork;
        //     $workExperience->application_id = $application->id;
        //     $workExperience->company = $field['employer'] ?? null;
        //     $workExperience->job_title = $field['job_title'] ?? null;
        //     $workExperience->start_date = $field['month_started'] ?? null;
        //     $workExperience->end_date = $field['month_finished'] ?? null;
        //     $workExperience->save();
        // }

        foreach ($request->family_member_name as $index => $name) {
            FamilyMemberUni::create([
                'open_application_id'    => $application->id,
                'name'                   => $name,
                'email'                  => $request->family_member_email[$index] ?? null,
                'phone'                  => $request->family_member_phone[$index] ?? null,
                'nationality'            => $request->family_member_nationality[$index] ?? null,
                'workplace'              => $request->family_member_work_employer[$index] ?? null,
                'position'               => $request->family_member_work_position[$index] ?? null,
                'relationship'           => $request->family_member_work_relationship[$index] ?? null,
            ]);
        }

        if ($request->hasFile('documents')) {
            Log::info('Files received for upload: ', $request->file('documents'));

            foreach ($request->file('documents') as $index => $file) {
                // Log details for each file being processed
                Log::info("Processing file at index {$index}", [
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_extension' => $file->getClientOriginalExtension(),
                ]);

                if ($file->isValid()) {
                    // Log success information before saving the file
                    $filename = time() . '_' . $file->getClientOriginalName();
                    Log::info("Saving file: {$filename} to upload/application directory");

                    $file->move(public_path('upload/application'), $filename);

                    $title = $request->input("titles.$index", 'Unknown Document');

                    Log::info("Saving document details to the database: ", [
                        'document_name' => $title,
                        'document_type' => 'fixed',
                        'document_file' => $filename,
                        'extension' => $file->getClientOriginalExtension(),
                    ]);

                    UniversityDocument::create([
                        'application_id' => $application->id,
                        'document_name'  => $title,
                        'document_type'  => 'fixed',
                        'document_file'  => $filename,
                        'extensions'     => $file->getClientOriginalExtension(),
                    ]);
                } else {
                    Log::error("File upload failed for index {$index}, file is not valid", [
                        'file_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                        'file_extension' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
        } else {
            Log::warning('No files found in the request');
        }




        $data['code'] = 0;
        $data['msg']  = "Personal information Update Successfully";
        // return response()->json($data);
        return redirect()->route('success.application')->with('success','Application Submitted Successfully');
    }

    public function applicationPersonalInfo(Request $request, $id)
    {
        $application = StudentApplication::find($id);
        if ($application) {
            $application->email           = $request->email;
            $application->phone           = $request->phone;
            $application->contact_id      = $request->contact_id;
            $application->first_name      = $request->first_name;
            $application->middle_name     = $request->middle_name;
            $application->last_name       = $request->last_name;
            $application->last_name       = $request->last_name;
            $application->chinese_name    = $request->chinese_name;
            $application->dob             = $request->date_of_birth;
            $application->gender          = $request->gender;
            $application->hobby           = $request->hobbies_interests;
            $application->in_chaina       = $request->is_in_china == false ? 0 : 1;
            $application->in_alcoholic    = $request->addict_to_alcohol_drugs == false ? 0 : 1;
            $application->native_language = $request->language_native;
            $application->english_level   = $request->language_proficiency_english;

            $application->english_proficiency_certificate = $request->certificate_english_proficiency;
            $application->certificate_issue_date          = $request->certificate_issue_date;
            $application->english_score                   = $request->english_score;

            $application->chinese_level = $request->language_proficiency_chinese;
            $application->HSK_level     = $request->HSK_level;
            $application->HSK_score     = $request->HSK_score;
            $application->HSK_report_no = $request->report_no;
            $application->HSKK_score    = $request->HSKK_level;
            $application->HSKK_score    = $request->HSKK_score;

            $application->maritial_status      = $request->marital_status;
            $application->nationality          = $request->applicants_nationality;
            $application->passport_exipre_date = $request->passport_expiration_date;
            $application->passport_number      = $request->passport_no;
            $application->birth_place          = $request->place_of_birth;
            $application->religion             = $request->religion;
            $application->save();
        }

        $data['code'] = 0;
        $data['msg']  = "Personal information Update Successfully";
        return response()->json($data);
    }

    public function applicationHomeAddress(Request $request, $id)
    {
        // return $request;
        $application = StudentApplication::find($id);
        if ($application) {
            $application->home_country       = $request->country;
            $application->home_city          = $request->city;
            $application->home_district      = $request->district;
            $application->home_contact_name  = $request->contact;
            $application->home_contact_phone = $request->phone;
            $application->home_street        = $request->street;
            $application->home_zipcode       = $request->zipcode;
            $application->save();
        }
        $data['code'] = 0;
        $data['msg']  = "Personal information Update Successfully";
        return response()->json($data);
    }

    public function applicationPostAddress(Request $request, $id)
    {
        // return $request;
        $application = StudentApplication::find($id);
        if ($application) {
            $application->current_country       = $request->country;
            $application->current_city          = $request->city;
            $application->current_district      = $request->district;
            $application->current_contact_name  = $request->contact;
            $application->current_contact_phone = $request->phone;
            $application->current_street        = $request->street;
            $application->current_zipcode       = $request->zipcode;
            $application->save();
        }
        $data['code'] = 0;
        $data['msg']  = "Personal information Update Successfully";
        return response()->json($data);
    }

    public function applicationEducation(Request $request, $id)
    {
        // return $request;
        $application = StudentApplication::find($id);
        if ($request->education_data) {
            $old_ids = [];
            foreach ($request->education_data as $k => $education_data_field) {
                if (isset($education_data_field['education_fields']) == false) {
                    $old_ids[] = $education_data_field['id'];
                }
            }
            if (count($old_ids) > 0) {
                ApplicationEducation::whereNotIn('id', $old_ids)->delete();
            }
            foreach ($request->education_data as $k => $education_data_field) {
                if (isset($education_data_field['education_fields'])) {
                    //return $education_data_field['education_fields'][$k];
                    $field                            = $education_data_field['education_fields'][$k];
                    $studentEducation                 = new ApplicationEducation;
                    $studentEducation->application_id = $application->id;
                    $studentEducation->user_id        = $application->user_id;
                    $studentEducation->country        = $field['country'];
                    $studentEducation->gpa_type       = $field['gpa'];
                    $studentEducation->major          = $field['major'];
                    $studentEducation->end_date       = $field['month_finished'];
                    $studentEducation->start_date     = $field['month_started'];
                    $studentEducation->school         = $field['school'];
                    $studentEducation->save();
                } else {
                    $field            = $education_data_field;
                    $studentEducation = ApplicationEducation::find($field['id']);

                    $studentEducation->country    = $field['country'];
                    $studentEducation->gpa_type   = $field['gpa'];
                    $studentEducation->major      = $field['major'];
                    $studentEducation->end_date   = $field['month_finished'];
                    $studentEducation->start_date = $field['month_started'];
                    $studentEducation->school     = $field['school'];
                    $studentEducation->save();
                }
            }
        }
        $data['code'] = 0;
        $data['msg']  = "Education information Update Successfully";
        return response()->json($data);
    }

    public function applicationWorkExperience(Request $request, $id)
    {
        // return $request;
        $application = StudentApplication::find($id);
        if ($request->work_data) {
            $old_ids = [];
            foreach ($request->work_data as $k => $work_data_field) {
                if (isset($work_data_field['work_data']) == false) {
                    $old_ids[] = $work_data_field['id'];
                }
            }
            if (count($old_ids) > 0) {
                ApplicationWork::whereNotIn('id', $old_ids)->delete();
            }
            foreach ($request->work_data as $k => $work_data_field) {
                if (isset($work_data_field['work_data'])) {
                    $field                       = $work_data_field['work_data'][$k];
                    $studentwork                 = new ApplicationWork;
                    $studentwork->application_id = $application->id;
                    $studentwork->user_id        = $application->user_id;
                    $studentwork->company        = $field['employer'];
                    $studentwork->job_title      = $field['job_title'];
                    $studentwork->end_date       = $field['month_finished'];
                    $studentwork->start_date     = $field['month_started'];
                    $studentwork->save();
                } else {
                    $field       = $work_data_field;
                    $studentwork = ApplicationWork::find($field['id']);

                    $studentwork->company    = $field['employer'];
                    $studentwork->job_title  = $field['job_title'];
                    $studentwork->end_date   = $field['month_finished'];
                    $studentwork->start_date = $field['month_started'];
                    $studentwork->save();
                }
            }
        }
        $data['code'] = 0;
        $data['msg']  = "Work Experience information Update Successfully";
        return response()->json($data);
    }

    public function applicationFamilyFinance(Request $request, $id)
    {
        //  return $request;
        $application = StudentApplication::find($id);
        if ($application) {

            // $application->father_name = $request->family_member_name;
            // $application->father_email = $request->family_member_email;
            // $application->father_phone = $request->family_member_phone;
            // $application->father_nationlity = $request->family_member_nationality;
            // $application->father_workplace = $request->family_member_work_employer;
            // $application->father_position = $request->family_member_work_position;

            // foreach ($request->family_member_name as $index => $name) {
            //     $application->father_name = $name;
            //     $application->father_email = $request->family_member_email[$index] ?? null;
            //     $application->father_phone = $request->family_member_phone[$index] ?? null;
            //     $application->father_nationlity = $request->family_member_nationality[$index] ?? null;
            //     $application->father_workplace = $request->family_member_work_employer[$index] ?? null;
            //     $application->father_position = $request->family_member_work_position[$index] ?? null;
            //     $application->father_relationship  = $request->family_member_work_relationship[$index] ?? null;

            // }

            foreach ($request->family_member_name as $index => $name) {
                FamilyMember::create([
                    'student_application_id' => $application->id,
                    'name'                   => $name,
                    'email'                  => $request->family_member_email[$index] ?? null,
                    'phone'                  => $request->family_member_phone[$index] ?? null,
                    'nationality'            => $request->family_member_nationality[$index] ?? null,
                    'workplace'              => $request->family_member_work_employer[$index] ?? null,
                    'position'               => $request->family_member_work_position[$index] ?? null,
                    'relationship'           => $request->family_member_work_relationship[$index] ?? null,
                ]);
            }

            $application->guarantor_name            = $request->supporter_name;
            $application->guarantor_email           = $request->supporter_email;
            $application->guarantor_phone           = $request->supporter_phone;
            $application->guarantor_address         = $request->supporter_address;
            $application->guarantor_workplace       = $request->supporter_company;
            $application->guarantor_work_address    = $request->supporter_company_address;
            $application->guarantor_relationship    = $request->supporter_relationship;
            $application->guarantor_inter_relation  = $request->inlineRadioOptions;
            $application->study_fund                = $request->fund;
            $application->scholarship               = $request->scholarship;
            $application->emergency_contact_name    = $request->emergency_contact_name;
            $application->emergency_contact_phone   = $request->emergency_contact_phone;
            $application->emergency_contact_email   = $request->emergency_contact_email;
            $application->emergency_contact_address = $request->emergency_contact_address;

            $application->save();
        }
        $data['code'] = 0;
        $data['msg']  = "Family information Update Successfully";
        return response()->json($data);
    }

    public function applicationOptionalService(Request $request, $id)
    {
        $application = StudentApplication::find($id);
        if ($application) {
            $application->service_id = $request->optional_service;
            $application->save();
        }
        $data['code'] = 0;
        $data['msg']  = "Option Service Update Successfully";
        return response()->json($data);
    }
    // function applicationAttachmentUpload(Request $request, $id)
    // {

    //     try {
    //         DB::beginTransaction();
    //         $application = StudentApplication::find($id);

    //         $filename = time() . 'application_file' . '.' . $request->file->getClientOriginalName();
    //         $request->file->move(public_path('upload/application/' . $application->id), $filename);
    //         $document = new ApplicationDocument;
    //         $document->application_id = $application->id;
    //         $document->user_id = $application->user_id;
    //         $document->document_name = $request->title;
    //         $document->document_type = 'fixed';
    //         $document->document_file = $filename;
    //         $document->extensions = $request->file->getClientOriginalExtension();
    //         $document->save();
    //         $order = $request->order;
    //         DB::commit();
    //         $data['code'] = 0;
    //         $data['msg'] = "Image Upload Successfully!";
    //         $data["doc_view"] = view('Backend.student_appliction.ajax_document_load', compact('document', 'order'))->render();
    //         return response()->json($data);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         $data['code'] = -1;
    //         $data['err'] = $e->getMessage();
    //         $data['msg'] = "Something went wrong";
    //         return response()->json($data);
    //     }

    // }

    public function applicationAttachmentUpload(Request $request, $id)
    {
        Log::info('Request Data:', $request->all());

        try {
            DB::beginTransaction();

            $application = StudentApplication::find($id);
            if (!$application) {
                return response()->json(['code' => -1, 'msg' => 'Application not found.']);
            }

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('upload/application/' . $application->id), $filename);

                    // Retrieve corresponding title by index
                    $title = $request->titles[$index] ?? 'Unknown Document';

                    ApplicationDocument::create([
                        'application_id' => $application->id,
                        'user_id'        => $application->user_id,
                        'document_name'  => $title,
                        'document_type'  => 'fixed',
                        'document_file'  => $filename,
                        'extensions'     => $file->getClientOriginalExtension(),
                    ]);
                }
            }

            DB::commit();
            return response()->json(['code' => 0, 'msg' => 'Documents uploaded successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error uploading document: " . $e->getMessage());
            return response()->json(['code' => -1, 'err' => $e->getMessage(), 'msg' => 'Something went wrong!']);
        }
    }

    public function applicationGetAttachments(Request $request, $id)
    {
        $application       = StudentApplication::find($id);
        $documents         = ApplicationDocument::where("application_id", $application->id)->get();
        $data['code']      = 0;
        $data['documents'] = $documents;
        $data['msg']       = "Load Successfully!";
        return response()->json($data);
    }
    public function attachmentDownload(Request $request, $id)
    {
        // return $request->all();
        $document = ApplicationDocument::find($request->attachment_code);
        $path     = asset('upload/application/' . $id . '/' . $document->document_file);
        // $mimeType = File::mimeType($path);
        $extension = File::extension($path);

        // $source = file_get_contents($path);
        // $base64 = base64_encode($source);
        // $blob = 'data:'.$mimeType.';base64,'.$base64;

        $data['code']     = 0;
        $data['file_url'] = $path;
        $data['filename'] = $document->document_name . '.' . $extension;
        // $data['blob'] = $blob;
        // $data['type'] = $mimeType;
        $data['msg'] = "Load Successfully!";
        return response()->json($data);
    }
    public function attachmentDelete(Request $request, $id)
    {
        $document = ApplicationDocument::find($request->attachment_code);
        $document->delete();
        $data['code'] = 0;

        $data['msg'] = "Delete Successfully!";
        return response()->json($data);
    }

    public function submitAppliction(Request $request, $id)
    {
        $partner_ref_id = session('partner_ref_id') ?? '';
        $application    = StudentApplication::find($id);

        if ($application) {
            $application->status         = 1;
            $application->payment_method = $request->payment_method;

            if ($request->hasFile('wechat_payment_receipt')) {
                $file     = $request->file('wechat_payment_receipt');
                $filename = time() . '_wechat_' . $file->getClientOriginalName();
                $path     = 'upload/application/' . $application->id;
                $file->move(public_path($path), $filename);
                $application->payment_proof = $path . '/' . $filename;
            }
            if ($request->hasFile('alipay_payment_receipt')) {
                $file     = $request->file('alipay_payment_receipt');
                $filename = time() . '_alipay_' . $file->getClientOriginalName();
                $path     = 'upload/application/' . $application->id;
                $file->move(public_path($path), $filename);
                $application->payment_proof = $path . '/' . $filename;
            }
            if ($request->hasFile('paypal_payment_receipt')) {
                $file     = $request->file('paypal_payment_receipt');
                $filename = time() . '_paypal_' . $file->getClientOriginalName();
                $path     = 'upload/application/' . $application->id;
                $file->move(public_path($path), $filename);
                $application->payment_proof = $path . '/' . $filename;
            }
            if ($request->hasFile('bank_payment_receipt')) {
                $file     = $request->file('bank_payment_receipt');
                $filename = time() . '_bank_' . $file->getClientOriginalName();
                $path     = 'upload/application/' . $application->id;
                $file->move(public_path($path), $filename);
                $application->payment_proof = $path . '/' . $filename;
            }

            $new_student = '';
            if (empty($application->user_id)) {
                try {
                    $new_student           = new User();
                    $new_student->email    = $application->email;
                    $new_student->name     = $application->first_name . ' ' . $application->last_name;
                    $new_student->password = Hash::make($application->application_code);
                    // $new_student->type = 1;
                    $new_student->role    = 'student';
                    $new_student->status  = 1;
                    $new_student->country = $application->nationality;
                    $new_student->mobile  = $application->phone;
                    $new_student->address = $application->current_street . ', ' . $application->current_city . ', ' . $application->current_district . ', ' . $application->current_country;

                    $new_student->save();
                    $application->user_id = $new_student->id;
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }

            $application->save();

            //Notification Start
            $admins = User::where('type', 0)->get();

            foreach ($admins as $admin) {
                $notification              = new Notification();
                $notification->relation_id = $application->id;
                $notification->text        = 'New Application Submitted';
                $notification->user_id     = $admin->id;
                $notification->type        = 'university';
                $notification->save();
            }

            $student = auth()->user() ?? $new_student ?? '';

            if ($student) {
                $consultant = User::where('continent_id', $student->continent_id)
                    ->where('role', 'partner')
                    ->where('id', '!=', $student->id)
                    ->first();

                // if not found as partner, then search for admin
                if (!$consultant) {
                    $consultant = User::where('continent_id', $student->continent_id)
                        ->where('role', 'admin')
                        ->where('id', '!=', $student->id)
                        ->first();
                }
            } elseif (session('partner_ref_id') || $request->query('partner_ref_id')) {
                $partner_ref_id = session('partner_ref_id') ?? $request->query('partner_ref_id');

                $consultant = User::where('id', $partner_ref_id)
                    ->where('role', 'partner')
                    ->first();

                // if not found as partner, then search for admin
                if (!$consultant) {
                    $consultant = User::where('id', $partner_ref_id)
                        ->where('role', 'admin')
                        ->first();
                }
            } else {
                $consultant = null;
            }

            if ($consultant) {
                $notification              = new Notification();
                $notification->relation_id = $application->id;
                $notification->text        = 'New Application Submitted';
                $notification->user_id     = $consultant ? $consultant->id : '';
                $notification->type        = 'university';
                $notification->save();
            } else {
                $data['consultant'] = null;
            }

            $notification              = new Notification();
            $notification->relation_id = $application->id;
            $notification->text        = 'Applied successfully';
            $notification->user_id     = auth()->user()->id ?? null;
            $notification->type        = 'university';
            $notification->save();
            //Notification  End

            $message = 'You have successfully submitted the application form, please wait, we will respond as soon as possible. Thank you.';

            if ($partner_ref_id && !auth()->check()) {
                return redirect()->route('frontend.my_application_list', ['application' => $application->id, 'partner_ref_id' => $partner_ref_id])->with('success', $message);
            } else {
                return redirect()->route('user.order_list', $partner_ref_id ? ['partner_ref_id' => $partner_ref_id] : [])->with('success', $message);
            }
        }

        $data['code'] = 0;
        $data['msg']  = "Appliction Submitted Successfully";
        return response()->json($data);
    }

    public function myOrderedApplication(Request $request)
    {
        $data['application'] = StudentApplication::find($request->application);
        $data['partner']     = User::find(base64_decode($request->partner_ref_id));

        return view('Frontend.university.application_success', $data);
    }

    public function indexAjax(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'application_code',
            2 => 'user_name',
            3 => 'email',
            4 => 'phone',
            5 => 'created_at',
            6 => 'payment_status',
            6 => 'status',
            6 => 'action',
        );
        $totalData = StudentApplication::count();

        $limit  = $request->input('length');
        $start  = $request->input('start');
        $order  = $columns[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        //====DataTale Default Filtering=====
        if (empty($search)) {
            $users = StudentApplication::query();
            if ($request->input('application_status') != '') {
                $users = $users->where('status', $request->input('application_status'));
            }
            if ($request->input('payment_status') != '') {
                $users = $users->where('payment_status', $request->input('payment_status'));
            }
            $totalFiltered = $users->count();
            $users         = $users->offset($start)->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {

            $users = StudentApplication::where(function ($query) use ($search) {
                // $q->where("vendor_name","LIKE","%{$search}%");
                $query->where("application_code", "LIKE", "%{$search}%")
                    ->OrWhere("created_at", "LIKE", "%{$search}%")
                    ->orWhereHas('carts.course', function ($q) use ($search) {
                        $q->where("name", "LIKE", "%{$search}%")
                            ->orwhereHas('university', function ($query2) use ($search) {
                                $query2->where("name", "LIKE", "%{$search}%");
                            });
                    })
                    ->orwhereHas('student', function ($query3) use ($search) {
                        $query3->where("name", "LIKE", "%{$search}%");
                    });
            });
            // return json_encode(DB::getQueryLog());

            if (!empty($request->input('application_status'))) {
                $users = $users->where('status', $request->input('application_status'));
            }
            if (!empty($request->input('payment_status'))) {

                $users = $users->where('payment_status', $request->input('payment_status'));
            }
            $totalFiltered = $users->count();
            $users         = $users->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }
        //======================

        $data = array();
        if (!empty($users)) {
            $i = $start == 0 ? 1 : $start + 1;
            foreach ($users as $user) {
                // $nestedData['id'] = $i++;
                $nestedData['application_code'] = $user->application_code;
                $nestedData['user_name']        = $user->student?->name;
                // $nestedData['email'] = $user->student?->email;
                $nestedData['phone'] = $user->student?->mobile;

                $nestedData['apply_date'] = $user->created_at->format('Y-m-d');
                if ($user->payment_status == 1) {
                    $nestedData['paid_status'] = 'Paid';
                } else {
                    $nestedData['paid_status'] = 'Not PAid';
                }
                if ($user->status == 0) {
                    $nestedData['status'] = 'Not Complete';
                } else if ($user->status == 1) {
                    $nestedData['status'] = 'Processing';
                } else if ($user->status == 2) {
                    $nestedData['status'] = 'Approved';
                } else if ($user->status == 3) {
                    $nestedData['status'] = 'Cancel';
                } else if ($user->status == 4) {
                    $nestedData['status'] = 'Not Submitted';
                } else if ($user->status == 5) {
                    $nestedData['status'] = 'Submitted';
                } else if ($user->status == 6) {
                    $nestedData['status'] = 'Pending';
                } else if ($user->status == 7) {
                    $nestedData['status'] = 'E-documents Qualified';
                } else if ($user->status == 8) {
                    $nestedData['status'] = 'Waiting Processing';
                } else if ($user->status == 9) {
                    $nestedData['status'] = 'Processing';
                } else if ($user->status == 10) {
                    $nestedData['status'] = 'More Documents Needed';
                } else if ($user->status == 11) {
                    $nestedData['status'] = 'Re-Submitted';
                } else if ($user->status == 12) {
                    $nestedData['status'] = 'Rejected';
                } else if ($user->status == 13) {
                    $nestedData['status'] = 'Transferred';
                } else if ($user->status == 14) {
                    $nestedData['status'] = 'Accepted';
                } else if ($user->status == 15) {
                    $nestedData['status'] = 'E-offer Delivered';
                } else if ($user->status == 15) {
                    $nestedData['status'] = 'Offer Delivered';
                } else {
                    $nestedData['status'] = '--';
                }
                $nestedData['action'] = "";
                $nestedData['action'] .= '<button style="margin-bottom: 2px; background-color: #448bff; color: #fff; margin: 1px" type="button" data-toggle="modal" data-target="#certificateModal' . $user->id . '" class="btn"><i class="fa-solid fa-edit"></i> </button>';
                $nestedData['action'] .= '<a style="margin-bottom: 2px; background-color: #448bff; color: #fff; margin: 1px" href="' . route('frontend.application-details', $user->id) . '" class="btn"><i class="fa-duotone fa fa-eye"></i> </a>';

                $nestedData['action'] .= '<button  class="btn delete-button" style="background-color: #448bff; color: #fff; margin: 1px" courseId="' . $user->id . '"><i class="icon fa fa-trash tx-28"></i></button>';
                $nestedData['action'] .= '<a class="btn" style="background-color: #448bff; color: #fff; margin: 1px" href="' . route('consultent.application-form-download', $user->id) . '"><i class="fa fa-solid fa-download"></i></a>';
                $nestedData['action'] .= '<a class="btn" style="background-color: #448bff; color: #fff; margin: 1px" href="' . route('consultent.student_appliction_edit', $user->id) . '"><i class="fa-solid fa-file-pen"></i></a>';
                $nestedData['action'] .= view('user.consultants.student_appliction.modal_certificate_ajax', ['application' => $user])->render();

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        );

        return json_encode($json_data);
    }
}
