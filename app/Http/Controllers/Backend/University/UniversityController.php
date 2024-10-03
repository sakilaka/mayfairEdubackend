<?php

namespace App\Http\Controllers\Backend\University;

use App\Http\Controllers\Controller;
use App\Models\AskQuestion;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Department;
use App\Models\Dormitory;
use App\Models\Scholarship;
use App\Models\State;
use App\Models\University;
use App\Models\UniversityTableFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    public function getChargesData(Request $request)
    {
        $university = University::select([
            'year_fee',
            'service_charge_1',
            'service_charge_2',
            'application_charge',
            'accommodation_fee',
            'insurance_fee',
            'visa_extension_fee',
            'medical_in_china_fee',
            'scholarships',
            'additional_scholarships',
            'major_id'
        ])->find($request->university_id);

        if ($university) {
            $selectedScholarships = json_decode($university->scholarships, true) ?? [];
            $scholarships = Scholarship::where('status', 1)->whereIn('id', $selectedScholarships)->get(['id', 'title']);
            $university_scholarships = $scholarships->toArray();

            $selectedAdditionalScholarships = json_decode($university->additional_scholarships, true) ?? [];
            $additional_scholarships = Scholarship::where('status', 1)->whereIn('id', $selectedAdditionalScholarships)->get(['id', 'title']);
            $university_additional_scholarships = $additional_scholarships->toArray();

            $selectedMajors = json_decode($university->major_id, true) ?? [];
            $major = Department::whereIn('id', $selectedMajors)->get(['id', 'name']);
            $university_majors = $major->toArray();

            return response()->json([
                'university' => $university,
                'scholarships' => $university_scholarships,
                'additional_scholarships' => $university_additional_scholarships,
                'university_majors' => $university_majors,
            ]);
        } else {
            return response()->json(['error' => 'University not found'], 404);
        }
    }

    public function index(Request $request)
    {
        $data['universities'] = University::orderBy('id', 'desc')->get();

        if ($request->filter_parent && $request->filter_parent != 'all') {
            $filterParent = $request->filter_parent;
            $filterChild = $request->filter_child;

            $filteredUniversities = [];

            foreach ($data['universities'] as $university) {
                $show_university = false;
                $selectedScholarships = json_decode($university->scholarships, true) ?? [];
                $selectedMajors = json_decode($university->major_id, true) ?? [];

                if (
                    ($filterParent == 'major' && in_array($filterChild, $selectedMajors)) ||
                    ($filterParent == 'scholarship' && in_array($filterChild, $selectedScholarships)) ||
                    ($filterParent == 'country' && $university->country_id == $filterChild) ||
                    ($filterParent == 'city' && $university->city_id == $filterChild)
                ) {
                    $show_university = true;
                }

                if ($show_university) {
                    $filteredUniversities[] = $university;
                }
            }

            $data['universities'] = $filteredUniversities;
        }
        // return count($data['universities']);
        $data['requested_filter_parent'] = $request->filter_parent ?? '';
        $data['requested_filter_child'] = $request->filter_child ?? '';

        $data['dormitories'] = Dormitory::all();
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['majors'] = Department::where('status', 1)->get();

        $table_manipulation = UniversityTableFilter::value('fields');
        $data['table_manipulate_data'] = json_decode($table_manipulation, true);

        $table_manipulation_filters = UniversityTableFilter::value('filter');
        $data['table_manipulate_filter_data'] = json_decode($table_manipulation_filters, true);

        return view("Backend.university.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['continents'] = Continent::where('status', 1)->get();
        $data['countries'] = Country::where('status', 1)->get();
        $data['states'] = State::where(['status' => 1])->get();
        $data['majors'] = Department::where('status', 1)->get();
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['dormitories'] = Dormitory::all();

        return view("Backend.university.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {

            DB::beginTransaction();
            $university = new University();
            $university->name = $request->name;
            $university->continent_id = $request->continent_id ?? 1;
            $university->country_id = $request->country_id ?? 1;
            $university->state_id = $request->state_id;
            $university->city_id = $request->city_id;
            $university->address = $request->address;
            $university->about = $request->about;
            $university->admissions_process = $request->admissions_process;
            $university->accommodation = $request->accommodation;

            $university->short_name = $request->short_name;
            $university->major_id = $request->major_id ? json_encode($request->major_id) : '';
            $university->scholarships = json_encode($request->scholarship_id);
            $university->additional_scholarships = json_encode($request->optional_scholarship_id) ?? null;
            $university->dormitories = json_encode($request->dormitory_id);
            $university->tags = $request->tags ? json_encode($request->tags) : '';

            $university->year_fee = $request->year_fee;
            $university->application_charge = $request->application_charge ?? "";
            $university->accommodation_fee = $request->accommodation_fee ?? "";
            $university->insurance_fee = $request->insurance_fee ?? "";
            $university->visa_extension_fee = $request->visa_extension_fee ?? "";
            $university->medical_in_china_fee = $request->medical_in_china_fee ?? "";

            // $university->service_charge = $request->service_charge ?? "";
            $university->service_charge_1 = $request->service_charge_1 ?? "";
            $university->service_charge_2 = $request->service_charge_2 ?? "";

            $yearly_original_fee = $request->year_fee +
                $request->accommodation_fee +
                $request->insurance_fee +
                $request->visa_extension_fee +
                $request->medical_in_china_fee;

            $university->yearly_original_fee = $yearly_original_fee;

            $display_data = [
                'university_subtitle' => $request->university_subtitle,
                'university_type' => $request->university_type,
                'world_rank' => $request->world_rank,
                'national_rank' => $request->national_rank,
                'total_students' => $request->total_students,
                'international_students' => $request->international_students,
                'available_seats' => $request->available_seats,
                'student_enrolled' => $request->student_enrolled,
                'countdown_deadline' => $request->countdown_deadline,
            ];
            $university->display_data = json_encode($display_data);

            $fees_structure = [
                'degrees' => $request->degree,
                'tuition_fees_1' => $request->fs_tuition_fee_1,
                'tuition_fees_2' => $request->fs_tuition_fee_2,
                'accommodation_fees_1' => $request->fs_accommodation_fee_1,
                'accommodation_fees_2' => $request->fs_accommodation_fee_2,
                'insurance_fee' => $request->fs_insurance_fee,
                'visa_extension_fee' => $request->fs_visa_extension_fee,
                'medical_in_china_fee' => $request->fs_medical_in_china_fee,
            ];
            $university->fees_structure = json_encode($fees_structure);

            if ($request->hasFile('image')) {
                $fileName = rand() . time() . '_university_logo.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/university/'), $fileName);
                $university->image = $fileName;
            }
            if ($request->hasFile('banner_image')) {
                $fileName = rand() . time() . '_university_banner_image.' . request()->banner_image->getClientOriginalExtension();
                request()->banner_image->move(public_path('upload/university/'), $fileName);
                $university->banner_image = $fileName;
            }
            $university->save();

            DB::commit();
            return redirect()->route('admin.university.index')->with('success', 'University Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["university"] = $university = University::find($id);
        $data['continents'] = Continent::all();
        $data['countries'] = Country::where('continent_id', @$university->continent->id)->get();
        $data['states'] = State::where(['status' => 1])->get();
        $data['cities'] = City::where('state_id', @$university->state->id)->get();
        $data['majors'] = Department::where('status', 1)->get();
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['dormitories'] = Dormitory::all();

        return view("Backend.university.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',

        ]);

        try {
            DB::beginTransaction();
            $university = University::find($id);
            $university->name = $request->name;
            $university->continent_id = $request->continent_id ?? 1;
            $university->country_id = $request->country_id ?? 1;
            $university->state_id = $request->state_id;
            $university->city_id = $request->city_id;
            $university->address = $request->address;
            $university->about = $request->about;
            $university->admissions_process = $request->admissions_process;
            $university->accommodation = $request->accommodation;

            $university->short_name = $request->short_name;
            $university->major_id = $request->major_id ? json_encode($request->major_id) : '';
            $university->scholarships = json_encode($request->scholarship_id);
            $university->additional_scholarships = json_encode($request->optional_scholarship_id) ?? null;
            $university->dormitories = json_encode($request->dormitory_id);
            $university->tags = $request->tags ? json_encode($request->tags) : '';

            $university->year_fee = $request->year_fee;
            $university->application_charge = $request->application_charge ?? "";
            $university->accommodation_fee = $request->accommodation_fee ?? "";
            $university->insurance_fee = $request->insurance_fee ?? "";
            $university->visa_extension_fee = $request->visa_extension_fee ?? "";
            $university->medical_in_china_fee = $request->medical_in_china_fee ?? "";

            // $university->service_charge = $request->service_charge ?? "";
            $university->service_charge_1 = $request->service_charge_1 ?? "";
            $university->service_charge_2 = $request->service_charge_2 ?? "";

            $yearly_original_fee = $request->year_fee +
                $request->accommodation_fee +
                $request->insurance_fee +
                $request->visa_extension_fee +
                $request->medical_in_china_fee;

            $university->yearly_original_fee = $yearly_original_fee;

            $display_data = [
                'university_subtitle' => $request->university_subtitle,
                'university_type' => $request->university_type,
                'world_rank' => $request->world_rank,
                'national_rank' => $request->national_rank,
                'total_students' => $request->total_students,
                'international_students' => $request->international_students,
                'available_seats' => $request->available_seats,
                'student_enrolled' => $request->student_enrolled,
                'countdown_deadline' => $request->countdown_deadline,
            ];
            $university->display_data = json_encode($display_data);

            $fees_structure = [
                'degrees' => $request->degree,
                'tuition_fees_1' => $request->fs_tuition_fee_1,
                'tuition_fees_2' => $request->fs_tuition_fee_2,
                'accommodation_fees_1' => $request->fs_accommodation_fee_1,
                'accommodation_fees_2' => $request->fs_accommodation_fee_2,
                'insurance_fee' => $request->fs_insurance_fee,
                'visa_extension_fee' => $request->fs_visa_extension_fee,
                'medical_in_china_fee' => $request->fs_medical_in_china_fee,
            ];
            $university->fees_structure = json_encode($fees_structure);

            if ($request->hasFile('image')) {
                @unlink(public_path('upload/university/' . $university->image));
                $fileName = rand() . time() . 'university_logo.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/university/'), $fileName);
                $university->image = $fileName;
            }
            if ($request->hasFile('banner_image')) {
                @unlink(public_path('upload/university/' . $university->banner_image));
                $fileName = rand() . time() . 'university_banner_image.' . request()->banner_image->getClientOriginalExtension();
                request()->banner_image->move(public_path('upload/university/'), $fileName);
                $university->banner_image = $fileName;
            }
            $university->save();

            DB::commit();
            return redirect()->route('admin.university.index')->with('success', 'University Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $university =  University::find($request->university_id);
            @unlink(public_path('upload/university/' . $university->image));
            @unlink(public_path('upload/university/' . $university->banner_image));
            $university->delete();

            return back()->with('success', 'University Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }



    public function status($id)
    {
        try {
            $university = University::find($id);
            if ($university->status == 0) {
                $university->status = 1;
            } elseif ($university->status == 1) {
                $university->status = 0;
            }
            $university->update();
            return redirect()->route('admin.university.index')->with('success', 'University Status Changed Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function universityFAQMAnage()
    {
        $data['faq_questions'] = AskQuestion::where('type', 'university')->orderBy('id', 'desc')->get();
        return view('Backend.university.faq_question', $data);
    }
    public function universityFAQanswer(Request $request, $id)
    {
        try {
            $ans = AskQuestion::find($id);
            $ans->answer = $request->answer;
            $ans->save();

            return redirect()->back()->with('success', 'Answer added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
    public function universityFAQanswerDelete(Request $request)
    {
        try {
            $qus = AskQuestion::find($request->university_faq_answer_id);
            $qus->delete();
            return redirect()->back()->with('success', 'University FAQ deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Toggle hide/show university on homepage
     */
    public function toggle_show_on_home($id, $status)
    {
        $university = University::find($id);
        $university->show_on_home = $status;
        $university->save();

        if ($status) {
            $message = 'University is now shown on the homepage.';
        } else {
            $message = 'University is now hidden from the homepage.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function universityTableManipulate(Request $request)
    {
        try {
            $requestData = $request->all();

            unset($requestData['_token']);
            $jsonResponse = json_encode($requestData);

            $data = [
                'fields' => $jsonResponse
            ];

            $record = UniversityTableFilter::first();

            if ($record) {
                $record->update($data);
            } else {
                UniversityTableFilter::create($data);
            }

            return redirect()->back()->with('success', 'Table Manipulate Successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Table Manipulation Failed!');
        }
    }

    public function universityTableManipulateFilter(Request $request)
    {
        try {
            if ($request->data_filter_type == 'add_filter') {
                $studentApplicationTable = UniversityTableFilter::first();

                $filterData = json_decode($studentApplicationTable->filter, true) ?? [];

                $newFilter = [
                    'id' => uuid_create(),
                    'filter_name' => $request->filter_name,
                    'filter_parent' => $request->filter_parent,
                    'filter_child' => $request->filter_child,
                    'is_selected' => false
                ];
                $filterData[] = $newFilter;

                $studentApplicationTable->filter = json_encode($filterData);
                $studentApplicationTable->save();

                return redirect()->back()->with('success', $request->input('filter_name') . ' filter added successfully!');
            } elseif ($request->data_filter_type == 'manage_filter') {
                $studentApplicationTable = UniversityTableFilter::first();
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
            $studentApplicationTable = UniversityTableFilter::first();

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
        if ($filter == 'major') {
            $response = Department::where(['status' => 1])->orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $major) {
                $items[] = ['id' => $major->id, 'name' => $major->name];
            }
        } elseif ($filter == 'scholarship') {
            $response = Scholarship::where('status', 1)->orderBy('title', 'asc')->get(['id', 'title']);
            foreach ($response as $scholarship) {
                $items[] = ['id' => $scholarship->id, 'name' => $scholarship->title];
            }
        } elseif ($filter == 'country') {
            $response = Country::orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $country) {
                $items[] = ['id' => $country->id, 'name' => $country->name];
            }
        } elseif ($filter == 'city') {
            $response = City::orderBy('name', 'asc')->get(['id', 'name']);
            foreach ($response as $city) {
                $items[] = ['id' => $city->id, 'name' => $city->name];
            }
        }

        return response()->json($items);
    }
}
