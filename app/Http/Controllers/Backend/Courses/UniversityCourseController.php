<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Course;
use App\Models\CourseLanguage;
use App\Models\CourseRequisite;
use App\Models\CourseLearn;
use App\Models\CourseCareerOutcome;
use App\Models\CourseSkill;
use App\Models\CourseConten;
use App\Models\CourseLesson;
use App\Models\CourseLessonVideo;
use App\Models\Category;
use App\Models\CourseResourceFile;
use App\Models\CourseLessonFile;
use App\Models\CourseQuizFile;
use App\Models\CoursezprojectFile;
use App\Models\RelatedCourse;

use App\Models\Department;
use App\Models\University;
use App\Models\User;
use App\Models\Degree;
use App\Models\Dormitory;
use App\Models\Scholarship;
use App\Models\Section;

use App\Models\Semester;
use App\Models\SemesterDetails;
use Illuminate\Support\Facades\DB;

class UniversityCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['courses'] = Course::where('type', 'university')->orderBy('id', 'desc')->get();
        return view("Backend.courses.u_course.index", $data);
    }

    public function show_on_home_toggle($course_id)
    {
        $course = Course::find($course_id);
        if ($course) {
            $current_status = $course->show_on_home;

            if ($current_status != 1) {
                $course->show_on_home = 1;
            } else {
                $course->show_on_home = 0;
            }

            $course->save();
            return redirect()->back()->with('success', 'Program is showing on home!');
        } else {
            return redirect()->back()->with('error', 'Something wrong with this program!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["categories"] = Category::where('parent_id', 0)->where('type', 'home')->get();
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->where('status', 1)->get();
        $data['courses'] = Course::where('type', 'university')->orderBy('id', 'desc')->get();
        $data['departments'] = Department::orderBy('id', 'desc')->where('status', 1)->get();
        $data['degrees'] = Degree::orderBy('id', 'desc')->where('status', 1)->get();
        $data['universities'] = University::orderBy('id', 'desc')->get();
        $data['sections'] = Section::orderBy('id', 'desc')->get();
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['dormitories'] = Dormitory::all();

        return view("Backend.courses.u_course.create", $data);
    }


    //ajax getDegree
    public function getDegree($id)
    {
        if ($id == 0) {
            return [];
        }
        $degree = Degree::where("department_id", $id)->get();
        return $degree;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $universityIds = is_array($request->university_id) ? $request->university_id : [$request->university_id];

            foreach ($universityIds as $universityId) {
                $course = new Course();

                $course->type = 'university';
                $course->department_id = $request->department_id ?? "";
                $course->degree_id = $request->degree_id;
                $course->university_id = $universityId; 
                $course->language_id = $request->language_id ?? 0;
                $course->section_id = $request->section_id ?? 0;

                $course->name = $request->course_name ?? "";
                $course->scholarship_id = $request->scholarship_id ?? null;
                $course->additional_scholarships = json_encode($request->optional_scholarship_id) ?? null;
                $course->dormitories = json_encode($request->dormitory_id);
                $course->coursetype = $request->course_type;

                $course->course_duration = $request->course_duration;
                $course->application_deadline = $request->application_deadline;

                $course->requisites = $request->requisites ?? "";
                $course->admission_process = $request->admission_process ?? "";
                $course->accommodation = $request->accommodation ?? "";
                $course->about = $request->about ?? "";

                $course->service_charge_beginner = $request->service_charge_beginner ?? "";
                $course->service_charge_1 = $request->service_charge_1 ?? null;
                $course->service_charge_2 = $request->service_charge_2 ?? null;
                $course->service_charge_3 = $request->service_charge_3 ?? null;
                $course->service_charge_4 = $request->service_charge_4 ?? null;
                $course->service_charge_5 = $request->service_charge_5 ?? null;
                $course->service_charge_6 = $request->service_charge_6 ?? null;
                $course->service_charge_7 = $request->service_charge_7 ?? null;
                $course->application_charge = $request->application_charge ?? null;

                $course->year_fee = $request->year_fee;
                $course->accommodation_fee = $request->accommodation_fee ?? null;
                $course->insurance_fee = $request->insurance_fee ?? null;
                $course->visa_extension_fee = $request->visa_extension_fee ?? null;
                $course->medical_in_china_fee = $request->medical_in_china_fee ?? null;
                $course->others_fee = $request->others_fee ?? null;

                $yearly_original_fee = ($request->year_fee ?? 0) +
                    ($request->accommodation_fee ?? 0) +
                    ($request->insurance_fee ?? 0) +
                    ($request->visa_extension_fee ?? 0) +
                    ($request->medical_in_china_fee ?? 0);

                $course->yearly_original_fee = $yearly_original_fee;

                $course->save();

                // Related courses
                if ($request->relatedcourse_id) {
                    foreach ($request->relatedcourse_id as $value) {
                        $relatedcourse = new RelatedCourse();
                        $relatedcourse->course_id = $course->id;
                        $relatedcourse->relatedcourse_id = $value;
                        $relatedcourse->save();
                    }
                }
            }

            DB::commit();
            return redirect(route('admin.u_course.index'))->with('success', 'University Programs Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['course'] = $course = Course::find($id);
        $data["categories"] = Category::where('parent_id', 0)->where('type', 'home')->get();
        $data["sub_categories"] = Category::where('parent_id', $course->category_id)->orderBy('id', 'desc')->get();
        $data["child_categories"] = Category::where('parent_id', $course->sub_category_id)->orderBy('id', 'desc')->get();
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->where('status', 1)->get();

        $data['courses'] = Course::where('type', 'university')->orderBy('id', 'desc')->get();
        $data['departments'] = Department::orderBy('id', 'desc')->get();
        $data['universities'] = University::orderBy('id', 'desc')->get();
        $data['degrees'] = Degree::orderBy('id', 'desc')->get();
        $data['sections'] = Section::orderBy('id', 'desc')->get();
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['dormitories'] = Dormitory::all();

        return view("Backend.courses.u_course.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $course = Course::find($id);

            $course->type = 'university';
            $course->department_id = $request->department_id ?? "";
            $course->degree_id = $request->degree_id;
            $course->university_id = $request->university_id ?? "";
            // $course->university_id = is_array($request->university_id) ? implode(',', $request->university_id) : $request->university_id;
            $course->language_id = $request->language_id ?? 0;
            $course->section_id = $request->section_id ?? 0;

            $course->name = $request->course_name ?? "";
            $course->scholarship_id = $request->scholarship_id ?? null;
            $course->additional_scholarships = json_encode($request->optional_scholarship_id) ?? null;
            $course->dormitories = json_encode($request->dormitory_id);

            $course->coursetype = $request->course_type;
            $course->course_duration = $request->course_duration;
            $course->application_deadline = $request->application_deadline;

            $course->requisites = $request->requisites ?? "";
            $course->admission_process = $request->admission_process ?? "";
            $course->accommodation = $request->accommodation ?? "";
            $course->about = $request->about ?? "";

            $course->service_charge_beginner = $request->service_charge_beginner ?? "";
            $course->service_charge_1 = $request->service_charge_1 ?? null;
            $course->service_charge_2 = $request->service_charge_2 ?? null;
            $course->service_charge_3 = $request->service_charge_3 ?? null;
            $course->service_charge_4 = $request->service_charge_4 ?? null;
            $course->service_charge_5 = $request->service_charge_5 ?? null;
            $course->service_charge_6 = $request->service_charge_6 ?? null;
            $course->service_charge_7 = $request->service_charge_7 ?? null;
            $course->application_charge = $request->application_charge ?? null;

            $course->year_fee = $request->year_fee;
            $course->accommodation_fee = $request->accommodation_fee ?? null;
            $course->insurance_fee = $request->insurance_fee ?? null;
            $course->visa_extension_fee = $request->visa_extension_fee ?? null;
            $course->medical_in_china_fee = $request->medical_in_china_fee ?? null;
            $course->others_fee = $request->others_fee ?? null;

            $yearly_original_fee = $request->year_fee +
                $request->accommodation_fee +
                $request->insurance_fee +
                $request->visa_extension_fee +
                $request->medical_in_china_fee;

            $course->yearly_original_fee = $yearly_original_fee;

            $course->save();

            RelatedCourse::where('course_id', $id)->get()->each->delete();
            if ($request->relatedcourse_id) {
                foreach ($request->relatedcourse_id as $value) {
                    $relatedcourse = new RelatedCourse();
                    $relatedcourse->course_id = $course->id;
                    $relatedcourse->relatedcourse_id = $value;
                    $relatedcourse->save();
                }
            }

            DB::commit();
            return redirect(route('admin.u_course.index'))->with('success', 'University Program Updated Successfully');
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
            $course = Course::find($request->ucourse_id);
            @unlink(public_path('upload/course/' . $course->image));

            foreach ($course->courserequisites as $courserequisite) {
                $courserequisite->delete();
            }

            foreach ($course->courselearns as $courselearn) {
                $courselearn->delete();
            }

            foreach ($course->courselanguages as $item) {
                $item->delete();
            }

            foreach ($course->coursecareeroutcomes as $coursecareeroutcome) {
                $coursecareeroutcome->delete();
            }

            foreach ($course->courseskills as $courseskill) {
                $courseskill->delete();
            }
            foreach ($course->course_content as $item) {
                $item->delete();
            }

            foreach ($course->courselessonfiles as $courselessonfile) {
                @unlink(public_path('upload/course/file/' . $courselessonfile->name));
                $courselessonfile->delete();
            }

            foreach ($course->courseresourcefiles as $courseresourcefile) {
                @unlink(public_path('upload/course/file/' . $courseresourcefile->name));
                $courseresourcefile->delete();
            }


            foreach ($course->relatedcourses as $relatedcourse) {
                $relatedcourse->delete();
            }

            foreach ($course->courselessons as $courselesson) {
                foreach ($courselesson->courselessonvideos as $courselessonvideo) {
                    @unlink(public_path('upload/coursevideo/' . $courselessonvideo->lesson_video));
                    $courselessonvideo->delete();
                }
                $courselesson->delete();
            }


            foreach ($course->semesters as $semester) {
                foreach ($semester->semesterdetailss as $semesterdetails) {
                    $semesterdetails->delete();
                }
                $semester->delete();
            }

            // foreach($course->capterquestions as $capterquestion){
            //     foreach($capterquestion->questions as $question){
            //         $question->delete();
            //     }
            //     $capterquestion->delete();
            // }

            $course->delete();
            return back()->with('success', 'University Program Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }


    ///add new tag
    public function addSelect2Language(Request $request)
    {
        // return $request->all();
        if ($request->type == "course") {
            $tag = new CourseLanguage();
            $tag->name = $request->val;
            $tag->type = 'course';
            $tag->save();
            return response()->json(['status' => 'ok', 'res_data' => $tag]);
        }
    }

    public function status($id)
    {
        $course = Course::find($id);
        if ($course->status == 0) {
            $course->status = 1;
        } elseif ($course->status == 1) {
            $course->status = 0;
        }
        $course->update();
        return redirect()->back()->with('message', 'Status Update Successfully. Thank you.');
    }

    // public function addSelect2(Request $request){
    //     // return $request->all();
    //      if($request->type == "brand"){
    //          $generic = new Brand();
    //          $generic->name = $request->val;
    //          $generic->type = 6;
    //          $generic->save();
    //          return response()->json(['status'=>'ok','res_data'=>$generic]);
    //      }else if($request->type == "color"){
    //          $generic = new Color();
    //          $generic->name = $request->val;
    //          $generic->type = 6;
    //          $generic->save();
    //          return response()->json(['status'=>'ok','res_data'=>$generic]);
    //      }
    //      else if($request->type == "model"){
    //          $brand = new Modeles();
    //          $brand->name = $request->val;
    //          $brand->type = 6;
    //          $brand->save();
    //          return response()->json(['status'=>'ok','res_data'=>$brand]);
    //      }

    //  }
}
