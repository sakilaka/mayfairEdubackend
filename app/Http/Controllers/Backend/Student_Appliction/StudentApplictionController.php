<?php

namespace App\Http\Controllers\Backend\Student_Appliction;

use App\Http\Controllers\Controller;
use App\Mail\SendApplicationFeedback;
use App\Models\ApplicationDocument;
use App\Models\ApplicationEducation;
use App\Models\ApplicationWork;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseLanguage;
use App\Models\Degree;
use App\Models\Department;
use App\Models\StudentApplication;
use App\Models\Notification;
use App\Models\Section;
use App\Models\StudentApplicationTableModify;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Mpdf\Mpdf;
use ZipArchive;

class StudentApplictionController extends Controller
{
    public function index(Request $request)
    {
        $page_route = Route::currentRouteName();
        if ($page_route == 'admin.student_appliction_list.filter') {
            $page_route = 'admin.student_appliction_list';
        }

        $data['applications'] = StudentApplication::orderBy('id', 'desc')->get();
        $data['assigned_applications'] = StudentApplication::where(function ($query) {
            $userId = auth()->user()->id;
            $query->where('partner_ref_id', 'like', '%"partner":' . $userId . '%')
                ->orWhere('partner_ref_id', 'like', '%"manager":' . $userId . '%')
                ->orWhere('partner_ref_id', 'like', '%"support":' . $userId . '%');
        })
            ->orderBy('id', 'desc')
            ->get();

        if ($request->study_fund && $request->study_fund != 'all') {
            $data['applications'] = StudentApplication::orderBy('id', 'desc')
                ->where('study_fund', $request->study_fund)
                ->get();
        } elseif ($request->filter_parent && $request->filter_parent != 'all') {

            $filterParent = $request->filter_parent;
            $filterChild = $request->filter_child;

            $filteredApplications = [];

            foreach ($data['applications'] as $application) {
                $show_application = false;

                foreach ($application->carts as $cart_item) {
                    if (
                        ($filterParent == 'degree' && $cart_item->course->degree_id == $filterChild) ||
                        ($filterParent == 'department' && $cart_item->course->department_id == $filterChild) ||
                        ($filterParent == 'intake' && $cart_item->course->section_id == $filterChild) ||
                        ($filterParent == 'language' && $cart_item->course->language_id == $filterChild) ||
                        ($filterParent == 'university' && $cart_item->course->university_id == $filterChild)
                    ) {
                        $show_application = true;
                        break;
                    } elseif ($filterParent == 'partner' && $application->partner_ref_id == $filterChild) {
                        $show_application = true;
                        break;
                    }
                }

                if ($show_application) {
                    $filteredApplications[] = $application;
                }
            }

            $data['applications'] = $filteredApplications;
        }

        $data['study_fund_type'] = $request->study_fund ?? '';
        $data['requested_filter_parent'] = $request->filter_parent ?? '';
        $data['requested_filter_child'] = $request->filter_child ?? '';

        $data['all_partners'] = User::where('role', 'partner')->orderBy('name', 'asc')->get();
        $data['all_managers'] = User::where('role', 'manager')->orderBy('name', 'asc')->get();
        $data['all_supports'] = User::where('role', 'support')->orderBy('name', 'asc')->get();

        $table_manipulation_fields = StudentApplicationTableModify::where(['user_id' => auth()->user()->id, 'page_route' => $page_route])->value('fields');
        if (!$table_manipulation_fields) {
            $table_record = [
                'fields' => json_encode([
                    "application_code" => "on",
                    "program_name" => "on",
                    "university_name" => "on",
                    "application_status" => "on",
                    "action" => "on"
                ])
            ];

            $record = StudentApplicationTableModify::updateOrCreate(
                ['user_id' => auth()->user()->id, 'page_route' => $page_route],
                $table_record
            );

            $table_manipulation_fields = $record->fields;
        }
        $data['table_manipulate_data'] = json_decode($table_manipulation_fields, true);
        
        $table_manipulation_filters = StudentApplicationTableModify::where(['user_id' => auth()->user()->id, 'page_route' => $page_route])->value('filter');
        $data['table_manipulate_filter_data'] = json_decode($table_manipulation_filters, true);

        // pass assigned applications or all application
        $permissions = json_decode(auth()->user()->permissions, true);
        $hasApplicationModuleAccess = in_array('program_applications_module', $permissions ?? []);

        if (!$hasApplicationModuleAccess || $request->type == 'assigned' || Route::is('admin.student_appliction_list_assigned')) {
            $data['applications'] = $data['assigned_applications'];
            return view('Backend.student_appliction.assigned_application_filterable', $data);
        }

        return view('Backend.student_appliction.index', $data);
    }

    public function applicationTableManipulate(Request $request)
    {
        $user = auth('admin')->user();
        if (!$user) {
            $user = auth()->user();
        }

        try {
            $record =
                StudentApplicationTableModify::where([
                    'user_id' => $user->id,
                    'page_route' => $request->page_route
                ])->first();

            $requestData = $request->all();

            unset($requestData['_token'], $requestData['page_route']);
            $jsonResponse = json_encode($requestData);

            $data = [
                'user_id' => $user->id,
                'page_route' => $request->page_route,
                'fields' => $jsonResponse
            ];

            if ($record) {
                unset($data['user_id'], $data['page_route']);
                $record->update($data);
            } else {
                StudentApplicationTableModify::create($data);
            }

            return redirect()->back()->with('success', 'Table Manipulate Successful!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Table Manipulation Failed!');
        }
    }

    public function applicationTableManipulateFilter(Request $request)
    {
        try {
            $user = auth('admin')->user();
            if (!$user) {
                $user = auth()->user();
            }

            if ($request->data_filter_type == 'add_filter') {
                $studentApplicationTable = StudentApplicationTableModify::where([
                    'user_id' => $user->id,
                    'page_route' => $request->page_route
                ])->first();

                if (!$studentApplicationTable) {
                    $studentApplicationTable = new StudentApplicationTableModify();
                }

                $filterData = json_decode($studentApplicationTable->filter, true) ?? [];

                $newFilter = [
                    'id' => uuid_create(),
                    'filter_name' => $request->filter_name,
                    'filter_parent' => $request->filter_parent,
                    'filter_child' => $request->filter_child,
                    'is_selected' => false
                ];
                $filterData[] = $newFilter;

                $studentApplicationTable->user_id = auth()->user()->id;
                $studentApplicationTable->page_route = $request->page_route;
                $studentApplicationTable->filter = json_encode($filterData);
                $studentApplicationTable->save();

                return redirect()->back()->with('success', $request->input('filter_name') . ' filter added successfully!');
            } elseif ($request->data_filter_type == 'manage_filter') {

                $studentApplicationTable = StudentApplicationTableModify::where('user_id', auth()->user()->id)->first();

                if (!$studentApplicationTable) {
                    $studentApplicationTable = new StudentApplicationTableModify();
                }

                $filterData = json_decode($studentApplicationTable->filter, true) ?? [];
                $filterIds = $request->input('filter_id', []);

                $noneSelected = in_array('none', $filterIds);

                foreach ($filterData as &$filter) {
                    if ($noneSelected) {
                        $filter['is_selected'] = false;
                    } else {
                        $filter['is_selected'] = in_array($filter['id'], $filterIds);
                    }
                }

                $studentApplicationTable->filter = json_encode($filterData);
                $studentApplicationTable->save();

                return redirect()->back()->with('success', 'Filter updated successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function deleteFilterItem($id)
    {
        try {
            $studentApplicationTable = StudentApplicationTableModify::first();

            $filterData = json_decode($studentApplicationTable->filter, true) ?? [];

            $filterData = array_filter($filterData, function ($filter) use ($id) {
                return $filter['id'] !== $id;
            });

            $filterData = array_values($filterData);

            $studentApplicationTable->filter = json_encode($filterData);
            $studentApplicationTable->save();

            return redirect()->back()->with('success', 'Filter item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function getFilterItems(Request $request)
    {
        $filter = $request->get('filter');

        $items = [];
        if ($filter == 'partner') {
            $response = User::where(['type' => 7])->orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $partner) {
                $items[] = ['id' => $partner->id, 'name' => $partner->name];
            }
        } elseif ($filter == 'degree') {
            $response = Degree::where('status', 1)->orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $degree) {
                $items[] = ['id' => $degree->id, 'name' => $degree->name];
            }
        } elseif ($filter == 'department') {
            $response = Department::orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $department) {
                $items[] = ['id' => $department->id, 'name' => $department->name];
            }
        } elseif ($filter == 'university') {
            $response = University::orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $university) {
                $items[] = ['id' => $university->id, 'name' => $university->name];
            }
        } elseif ($filter == 'intake') {
            $response = Section::orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $intake) {
                $items[] = ['id' => $intake->id, 'name' => $intake->name];
            }
        } elseif ($filter == 'language') {
            $response = CourseLanguage::orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $language) {
                $items[] = ['id' => $language->id, 'name' => $language->name];
            }
        }

        return response()->json($items);
    }

    public function fetchApplication($application_id)
    {
        try {
            $application = StudentApplication::findOrFail($application_id);
            $partner_ref_data = json_decode($application->partner_ref_id, true) ?? [];

            $partner_id = $partner_ref_data['partner'] ?? null;
            $manager_id = $partner_ref_data['manager'] ?? null;
            $support_id = $partner_ref_data['support'] ?? null;

            return response()->json([
                'success' => true,
                'data' => [
                    'partner_id' => $partner_id,
                    'manager_id' => $manager_id,
                    'support_id' => $support_id,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch application data.',
            ]);
        }
    }

    public function fetchApplicationSupports($application_id)
    {
        try {
            $application = StudentApplication::findOrFail($application_id);

            $partner_ref_data = json_decode($application->partner_ref_id, true) ?? [];
            $partner_id = $partner_ref_data['partner'] ?? null;
            $manager_id = $partner_ref_data['manager'] ?? null;
            $support_id = $partner_ref_data['support'] ?? null;

            $getUserData = function ($user) {
                $countryName = null;
                $continentName = null;

                if ($user) {
                    if ($user->country_id) {
                        $countryId = (int) $user->country;
                        $countryName = Country::find($countryId)?->name;
                    }

                    if ($user->continent_id) {
                        $continentId = (int) $user->continent_id;
                        $continentName = Continent::find($continentId)?->name;
                    }
                }

                return $user ? [
                    'name' => $user->name,
                    'role' => ucwords(str_replace('_', ' ', $user->role)),
                    'address' => $user->address,
                    'country' => $countryName,
                    'continent' => $continentName,
                    'phone' => $user->mobile,
                    'email' => $user->email,
                    'photo' => $user->image_show,
                ] : null;
            };

            $partnerData = $getUserData(User::find($partner_id));
            $managerData = $getUserData(User::find($manager_id));
            $supportData = $getUserData(User::find($support_id));

            return response()->json([
                'success' => true,
                'data' => [
                    'partner' => $partnerData,
                    'manager' => $managerData,
                    'support' => $supportData,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch application data.',
            ]);
        }
    }

    public function partnerWiseStudentsApplications()
    {
        $data = [];

        $partners = User::where('role', 'partner')->get();

        foreach ($partners as $partner) {
            $total_students = User::where('partner_ref_id', $partner->id)
                ->where('role', 'student')
                ->count();

            $total_applications = StudentApplication::where(function ($query) use ($partner) {
                $query->where('partner_ref_id', 'like', '%"partner":' . $partner->id . '%')
                    ->orWhere('partner_ref_id', 'like', '%"manager":' . $partner->id . '%')
                    ->orWhere('partner_ref_id', 'like', '%"support":' . $partner->id . '%');
            })->count();

            $total_approved_applications = StudentApplication::where(function ($query) use ($partner) {
                $query->where('partner_ref_id', 'like', '%"partner":' . $partner->id . '%')
                    ->orWhere('partner_ref_id', 'like', '%"manager":' . $partner->id . '%')
                    ->orWhere('partner_ref_id', 'like', '%"support":' . $partner->id . '%');
            })->whereIn('status', [2, 14])
                ->count();

            $success_rate = $total_applications > 0 ? ($total_approved_applications / $total_applications) * 100 : 0;

            $data[] = [
                'partner' => $partner,
                'total_students' => $total_students,
                'total_applications' => $total_applications,
                'success_rate' => $success_rate,
            ];
        }

        return view('Backend.student_appliction.partner_wise_student_application', compact('data'));
    }

    public function partnerWiseStudents($partner_id)
    {
        if ($partner_id) {
            $data['partner'] = User::find($partner_id);

            $data['students'] = User::orderBy('id', 'desc')
                ->where([
                    'partner_ref_id' => $data['partner']->id,
                    'role' => 'student',
                ])
                ->where('id', '!=', $data['partner']->id)
                ->where('status', '!=', 0)
                ->get();

            return view('Backend.student_appliction.partner_wise_student', $data);
        } else {
            return redirect()->back()->with('error', 'Partner Not Found!');
        }
    }

    public function partnerWiseApplications(Request $request, $partner_id)
    {
        if ($request->has('detach-application')) {
            $applicationId = $request->input('detach-application');
            $application = StudentApplication::find($applicationId);

            if ($application) {
                $partnerRefData = json_decode($application->partner_ref_id, true) ?? [];

                foreach (['partner', 'manager', 'support'] as $role) {
                    if (isset($partnerRefData[$role]) && $partnerRefData[$role] == $partner_id) {
                        $partnerRefData[$role] = null;
                    }
                }

                $partnerRefData = array_filter($partnerRefData);
                $application->partner_ref_id = json_encode($partnerRefData);
                $application->save();

                return redirect()->back()->with('success', 'Partner has been detached from the application!');
            } else {
                return redirect()->back()->with('error', 'Application Not Found!');
            }
        }

        $partner = User::find($partner_id);

        if ($partner) {
            $data['partner'] = $partner;

            $data['applications'] = StudentApplication::where(function ($query) use ($partner_id) {
                $query->where('partner_ref_id', 'like', '%"partner":' . $partner_id . '%')
                    ->orWhere('partner_ref_id', 'like', '%"manager":' . $partner_id . '%')
                    ->orWhere('partner_ref_id', 'like', '%"support":' . $partner_id . '%');
            })->get();

            return view('Backend.student_appliction.partner_wise_application', $data);
        } else {
            return redirect()->back()->with('error', 'User Not Found!');
        }
    }

    public function assignStudentToEmployee(Request $request)
    {
        try {
            $student = User::find($request->student_id);
            $partner = User::find($request->partner_id);

            $notification = new Notification();
            $notification->partner_id = $partner->id;
            $notification->text = $student->name . ' Has been assigned to Partner ' . $partner->name;
            $notification->user_id = $student->id;
            $notification->save();

            if ($student && $partner) {
                User::where('id', $request->student_id)->update(['partner_ref_id' => $partner->id]);
                return redirect()->back()->with('success', 'Student Assigned to Partner - ' . $partner->name . ' Successfully!');
            } else {
                return redirect()->back()->with('error', 'Student or Partner Not Found!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function assignApplicationToEmployee(Request $request)
    {
        try {
            $application = StudentApplication::findOrFail($request->application_id);

            $partnerId = isset($request->partner_id) ? (int) $request->partner_id : null;
            $managerId = isset($request->manager_id) ? (int) $request->manager_id : null;
            $supportId = isset($request->support_id) ? (int) $request->support_id : null;

            $newPartnerRefId = array_filter([
                'partner' => $partnerId,
                'manager' => $managerId,
                'support' => $supportId,
            ]);

            $application->partner_ref_id = !empty($newPartnerRefId) ? json_encode($newPartnerRefId) : null;
            $application->save();

            foreach ($newPartnerRefId as $role => $id) {
                if ($id) {
                    $user = User::find($id);
                    if ($user) {
                        $notification = new Notification();
                        $notification->partner_id = $user->id;
                        $notification->user_id = $user->id;
                        $notification->text = 'Application ' . $application->application_code . ' has been assigned to ' . ucwords($role) . ' - ' . $user->name;
                        $notification->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Application assigned to selected roles successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }


    public function edit($id)
    {
        $data['s_appliction'] = StudentApplication::find($id);
        $data['countries'] = Country::all();

        return view('Backend.student_appliction.edit_personal_info', $data);
    }

    public function update(Request $request, $id)
    {
        $edit_app = StudentApplication::find($id);
        $edit_app->first_name = $request->first_name;
        $edit_app->middle_name = $request->middle_name;
        $edit_app->last_name = $request->last_name;
        $edit_app->chinese_name = $request->chinese_name;
        $edit_app->contact_id = $request->contact_id;
        $edit_app->phone = $request->phone;
        $edit_app->email = $request->email;
        $edit_app->dob = $request->dob;
        $edit_app->birth_place = $request->birth_place;
        $edit_app->passport_number = $request->passport_number;
        $edit_app->passport_exipre_date = $request->passport_exipre_date;
        $edit_app->nationality = $request->nationality;
        $edit_app->religion = $request->religion;
        $edit_app->gender = $request->gender;
        $edit_app->maritial_status = $request->maritial_status;
        $edit_app->in_chaina = $request->in_chaina;
        $edit_app->in_alcoholic = $request->in_alcoholic;
        $edit_app->hobby = $request->hobby;
        $edit_app->native_language = $request->native_language;
        $edit_app->english_level = $request->english_level;
        $edit_app->chinese_level = $request->chinese_level;
        $edit_app->home_country = $request->home_country;
        $edit_app->home_city = $request->home_city;
        $edit_app->home_district = $request->home_district;
        $edit_app->home_street = $request->home_street;
        $edit_app->home_zipcode = $request->home_zipcode;
        $edit_app->home_contact_name = $request->home_contact_name;
        $edit_app->home_contact_phone = $request->home_contact_phone;
        $edit_app->current_country = $request->current_country;
        $edit_app->current_city = $request->current_city;
        $edit_app->current_district = $request->current_district;
        $edit_app->current_street = $request->current_street;
        $edit_app->current_zipcode = $request->current_zipcode;
        $edit_app->current_contact_name = $request->current_contact_name;
        $edit_app->current_contact_phone = $request->current_contact_phone;
        $edit_app->update();

        if ($request->old_school != null) {
            foreach ($request->old_school as $k => $value) {
                // dd($k);
                $education = ApplicationEducation::find($k);
                // dd($education);
                if ($education) {
                    $education->application_id = $edit_app->id;
                    $education->school = $value;
                    $education->major = $request->old_major[$k];
                    $education->start_date = $request->old_start_date[$k];
                    $education->end_date = $request->old_end_date[$k];
                    $education->gpa_type = $request->old_gpa_type[$k];
                    // dd($education);
                    $education->update();
                }
            }
        }

        if ($request->company != null) {
            foreach ($request->company as $k => $value) {
                // dd($k);
                $work_experience = ApplicationWork::find($k);
                // dd($education);
                if ($work_experience) {
                    $work_experience->application_id = $edit_app->id;
                    $work_experience->company = $value;
                    $work_experience->job_title = $request->job_title[$k];
                    $work_experience->start_date = $request->start_date[$k];
                    $work_experience->end_date = $request->end_date[$k];
                    // dd($work_experience);
                    $work_experience->update();
                }
            }
        }

        return redirect()->back()->with('success', 'Information update successfully, Thank You.');
    }

    public function editFamily($id)
    {
        $data['s_appliction'] = StudentApplication::find($id);
        return view('Backend.student_appliction.edit_family_info', $data);
    }

    public function familyUpdate(Request $request, $id)
    {
        $edit_app = StudentApplication::find($id);
        $edit_app->father_name = $request->father_name;
        $edit_app->father_nationlity = $request->father_nationlity;
        $edit_app->father_phone = $request->father_phone;
        $edit_app->father_email = $request->father_email;
        $edit_app->father_workplace = $request->father_workplace;
        $edit_app->father_position = $request->father_position;
        $edit_app->mother_name = $request->mother_name;
        $edit_app->mother_nationlity = $request->mother_nationlity;
        $edit_app->mother_phone = $request->mother_phone;
        $edit_app->mother_email = $request->mother_email;
        $edit_app->mother_workplace = $request->mother_workplace;
        $edit_app->mother_position = $request->mother_position;
        $edit_app->guarantor_relationship = $request->guarantor_relationship;
        $edit_app->guarantor_name = $request->guarantor_name;
        $edit_app->guarantor_address = $request->guarantor_address;
        $edit_app->guarantor_phone = $request->guarantor_phone;
        $edit_app->guarantor_email = $request->guarantor_email;
        $edit_app->guarantor_workplace = $request->guarantor_workplace;
        $edit_app->guarantor_work_address = $request->guarantor_work_address;
        $edit_app->study_fund = $request->study_fund;
        $edit_app->emergency_contact_name = $request->emergency_contact_name;
        $edit_app->emergency_contact_phone = $request->emergency_contact_phone;
        $edit_app->emergency_contact_email = $request->emergency_contact_email;
        $edit_app->emergency_contact_address = $request->emergency_contact_address;
        $edit_app->update();
        return redirect()->back()->with('success', 'Information update successfully, Thank You.');
    }

    public function editProgramInfo($id)
    {
        $data['s_appliction'] = StudentApplication::find($id);
        $data['managers'] = User::where('role', 'manager')->get();
        $data['supports'] = User::where('role', 'support')->get();
        $data['programs'] = Course::all();

        return view('Backend.student_appliction.edit_program_info', $data);
    }

    public function updateProgramInfo(Request $request, $id)
    {
        try {
            $s_appliction = StudentApplication::find($id);

            if ($s_appliction && $request->has('feedback') && ($request->feedback != null)) {
                $feedbackText = $request->input('feedback');

                $student = User::find($s_appliction->user_id);
                $partnerRefId = json_decode($s_appliction->partner_ref_id, true);

                $recipients = [];

                if ($student) {
                    $recipients[] = $student->email;
                }

                if (is_array($partnerRefId)) {
                    foreach ($partnerRefId as $role => $userId) {
                        $user = User::find($userId);
                        if ($user) {
                            $recipients[] = $user->email;
                        }
                    }
                }

                $data = [
                    'subject' => 'Feedback For Application (' . $s_appliction->application_code . ')',
                    'feedback' => $feedbackText,
                ];

                foreach ($recipients as $recipientEmail) {
                    Mail::to($recipientEmail)->send(new SendApplicationFeedback($data));
                }
            }

            $newProgramIds = isset($request->program_id) ? array_map('intval', $request->program_id) : [];

            $s_appliction->service_charge = 0;
            $s_appliction->application_fee = 0;
            $s_appliction->total_fee = 0;

            foreach ($newProgramIds as $program_id) {
                $program = Course::find($program_id);

                if ($program) {
                    $s_appliction->service_charge += (float) $program->service_charge;
                    $s_appliction->application_fee += (float) $program->application_charge;
                    $s_appliction->total_fee += (float) $program->service_charge + (float) $program->application_charge;
                }
            }

            $s_appliction->programs = json_encode($newProgramIds);

            $s_appliction->service_charge = $request->service_charge;
            $s_appliction->total_fee = $request->total_fee;
            $s_appliction->status = $request->status;
            $s_appliction->payment_status = $request->payment_status;
            $s_appliction->save();

            $status = ['Not Complete', 'Processing', 'Approved', 'Cancel', 'Not Submitted', 'Submitted', 'Pending', 'E-documents Qualified', 'Waiting Processing', 'Processing', 'More Documents Needed', 'Re-Submitted', 'Rejected', 'Transferred', 'Accepted', 'E-offer Delivered', 'Offer Delivered'];

            $notification = new Notification();
            $notification->relation_id = $s_appliction->id;
            $notification->text = 'Application Status Has Changed To \'' . $status[$request->status - 1] . '\'.';
            $notification->user_id = auth()->user()->id;
            $notification->type = 'university';
            $notification->save();

            return redirect()->back()->with('success', 'Status Changed Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function updatePaidAmount(Request $request, $id)
    {
        $request->validate([
            'paid_amount' => 'required|numeric|min:0',
        ]);
    
        $s_appliction = StudentApplication::find($id);
        if ($s_appliction) {
            // Add the new amount to the existing paid amount
            $s_appliction->paid_amount += $request->paid_amount;
            $s_appliction->save();

    
            // Set payment status based on the total paid amount
           
            if ($s_appliction->paid_amount >= $s_appliction->service_charge) {
                $s_appliction->payment_status = 1;  // Paid
            } else {
                $s_appliction->payment_status = 0;  // Unpaid
            }
            $s_appliction->save();

    
            // Save the changes
    
            return response()->json([
                'success' => true,
                'message' => 'Amount updated successfully.',
                'total_paid' => $s_appliction->paid_amount,
                'payment_status' => $s_appliction->payment_status
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
        }
    }
    
    


    public function editDocument($id)
    {
        $data['s_appliction'] = StudentApplication::find($id);
        return view('Backend.student_appliction.edit_document_info', $data);
    }

    public function updateDocument(Request $request, $id)
    {
        $s_appliction = StudentApplication::find($id);

        if ($request->old_document_file) {
            foreach ($request->file('old_document_file') as $k => $value) {
                $document = ApplicationDocument::find($k);
                @unlink(public_path('upload/application/' . $s_appliction->id . $document->document_file));
                $document->application_id = $s_appliction->id;
                $filename = time() . $k . '_document_file' . '.' . $value->getClientOriginalExtension();
                $value->move(public_path('upload/application/' . $s_appliction->id), $filename);
                $document->document_file = $filename;
                $document->extensions = $value->getClientOriginalExtension();

                $document->save();
            }
        }
        return redirect()->back()->with('success', 'Documents update successfully, Thank you.');
    }

    public function details($id)
    {
        $data['s_appliction'] = StudentApplication::find($id);
        return view('Backend.student_appliction.application_details', $data);
    }

    public function applicationInvoice($id)
    {
        $data['orderdetails'] = StudentApplication::find($id);
        return view('Backend.student_appliction.invoice', $data);
    }

    public function delete(Request $request)
    {
        try {
            $s_applictions = StudentApplication::find($request->s_appliction_id);

            foreach ($s_applictions->carts as $cart) {
                $cart->delete();
            }
            foreach ($s_applictions->educations as $education) {
                $education->delete();
            }
            foreach ($s_applictions->work_experiences as $work_experience) {
                $work_experience->delete();
            }
            foreach ($s_applictions->documents as $document) {
                @unlink(public_path('upload/application/{$request->s_appliction_id}/' . $document->document_file));
                $document->delete();
            }
            foreach ($s_applictions->notifications as $notification) {
                $notification->delete();
            }
            $s_applictions->delete();
            return redirect()->back()->with('success', 'Student Appliction Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function applicationFileDownload($id)
    {
        $file = ApplicationDocument::find($id);

        if (!$file) {
            abort(404, 'File not found');
        }

        $filePath = public_path("upload/application/{$file->application_id}/{$file->document_file}");

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath);
    }

    public function allDocumentDownload($application_id)
    {
        try {
            $data['s_appliction'] = $s_application = StudentApplication::find($application_id);
            $html = view('Backend.student_appliction.download_application', $data);

            $mpdf = new Mpdf([
                'mode' => 'UTF-8',
                'margin_left' => 5,
                'margin_right' => 5,
                'margin_top' => 5,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]);

            $mpdf->autoScriptToLang = true;
            $mpdf->baseScript = 1;
            $mpdf->autoLangToFont = true;
            $mpdf->autoVietnamese = true;
            $mpdf->autoArabic = true;
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->setAutoBottomMargin = 'stretch';

            $mpdf->WriteHTML($html);

            $tempPdfFilePath = tempnam(sys_get_temp_dir(), 'application_form_');
            $mpdf->Output($tempPdfFilePath, 'F');

            $zipFileName = 'Application_' . $s_application->application_code . '.zip';
            $zip = new ZipArchive;
            $zip->open(public_path($zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

            $zip->addFile($tempPdfFilePath, 'Application_Form.pdf');

            foreach ($s_application->documents as $document) {
                $filePath = public_path("upload/application/{$document->application_id}/{$document->document_file}");
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, $document->document_name . '.' . $document->extensions);
                }
            }

            $zip->close();

            unlink($tempPdfFilePath);

            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    function applicationOrderPrint($id)
    {
        $data['orderdetails'] = StudentApplication::find($id);
        return view('Backend.student_appliction.print', $data);
    }

    public function applicationFormDownload($id)
    {
        $data['s_appliction'] = StudentApplication::find($id);
        $html = view('Backend.student_appliction.download_application', $data);

        $mpdf = new Mpdf([
            'mode' => 'UTF-8',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 5,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);

        //For Multilanguage Start
        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        $mpdf->autoLangToFont = true;
        $mpdf->autoVietnamese = true;
        $mpdf->autoArabic = true;

        //For Multilanguage End
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';

        $mpdf->writeHTML($html);
        $name = 'Student_Application_Form_ ' . date('Y-m-d i:h:s');
        $mpdf->Output($name . '.pdf', 'D');
    }

    public function applicationStatus(Request $request, $id)
    {
        $a_status = StudentApplication::find($id);
        $a_status->status = $request->status;
        $a_status->save();

        //Notification Start
        if ($request->status == '1') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Processing';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Processing';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Application #' . $a_status->id . ' is Processing';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '2') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Approved';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Approved';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Approved';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '3') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Cancel';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Cancel';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Cancel';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '4') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Not Submitted';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Not Submitted';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Not Submitted';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '5') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Submitted';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Submitted';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Submitted';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '6') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Pending';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Pending';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Pending';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '7') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is E-documents Qualified';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is E-documents Qualified';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is E-documents Qualified';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '8') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Waiting Processing';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Waiting Processing';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application#' . $a_status->id . ' is Waiting Processing';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '9') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Processing';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Processing';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Processing';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '10') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is More Documents Needed';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is More Documents Needed';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is More Documents Needed';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '11') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Re-Submitted';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Re-Submitted';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Re-Submitted';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '12') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Rejected';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Rejected';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Rejected';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '13') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Transferred';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Transferred';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Transferred';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '14') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Accepted';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Accepted';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Accepted';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '15') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is E-offer Delivered';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is E-offer Delivered';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is E-offer Delivered';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        } elseif ($request->status == '16') {
            $admins = User::where('type', 0)->get();
            foreach ($admins as $admin) {
                $notification = new Notification();
                $notification->relation_id = $a_status->id;
                $notification->text = 'Application #' . $a_status->id . ' is Offer Delivered';
                $notification->user_id = $admin->id;
                $notification->type = 'university';
                $notification->save();
            }

            // $consultant = auth()->user();
            // $notification=New Notification();
            // $notification->relation_id = $a_status->id;
            // $notification->text = 'Application #'.$a_status->id .' is Offer Delivered';
            // $notification->user_id = $consultant->id;
            // $notification->type = 'university';
            // $notification->save();


            $notification = new Notification();
            $notification->relation_id = $a_status->id;
            $notification->text = 'Your Application #' . $a_status->id . ' is Offer Delivered';
            $notification->user_id = $a_status->user_id;
            $notification->type = 'university';
            $notification->save();
        }
        //Notification  End
        return redirect()->back()->with('success', 'Application status update successfully');
    }
}