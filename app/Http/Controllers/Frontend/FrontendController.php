<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdditionalPage;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseLanguage;
use App\Models\CourseLessonFile;
use App\Models\CourseQuizFile;
use App\Models\CourseResourceFile;
use App\Models\CourseSave;
use App\Models\CoursezprojectFile;
use App\Models\Currency;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Dormitory;
use App\Models\Ebook;
use App\Models\EbookAudioContent;
use App\Models\EbookVideoContent;
use App\Models\Event;
use App\Models\Expo;
use App\Models\Faq;
use App\Models\FooterImage;
use App\Models\HomeContentItem;
use App\Models\HomeContentLocation;
use App\Models\HomeContentSetup;
use App\Models\InstructorPageSetup;
use App\Models\learnerPageSetup;
use App\Models\Library;
use App\Models\MaestroClassSetup;
use App\Models\Office;
use App\Models\Page;
use App\Models\Partner;
use App\Models\RelatedCourse;
use App\Models\Review;
use App\Models\Scholarship;
use App\Models\Section;
use App\Models\State;
use App\Models\Testimonial;
use App\Models\Topic;
use App\Models\Tp_option;
use App\Models\University;
use App\Models\User;
use App\Models\UserContact;
use App\Models\VisitorModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Mpdf\Mpdf;
use ZipArchive;

class FrontendController extends Controller
{


    
    
    public function getCountries($continent)
    {
        $countries = Country::where('continent_id', $continent)->where('status', 1)->orderBy('name', 'asc')->get();

        return response([
            'response' => $countries,
        ], 200);
    }

    public function getStates($country)
    {
        $states = State::where('country_id', $country)->where('status', 1)->orderBy('name', 'asc')->get();

        return response([
            'response' => $states,
        ], 200);
    }

    public function getCities($state)
    {
        $cities = City::where('state_id', $state)->where('status', 1)->orderBy('name', 'asc')->get();

        return response([
            'response' => $cities,
        ], 200);
    }

    public function changeCurrency($name)
    {
        $currency = Currency::where('currency_name', $name)->first();
        if ($currency) {
            setApplicationCurrency($currency);
        }
        return back();
    }

    public function index(Request $request)
    {
        $data['home_content'] = HomeContentSetup::first();
        $data['partners'] = Partner::all();

        $footerImageRecord = FooterImage::first() ?? [];
        if ($footerImageRecord) {
            $data['footer_image'] = json_decode($footerImageRecord['footer_image'], true) ?? [];
        } else {
            $data['footer_image'] = [];
        }

        $data['buttons'] = Faq::where('type', 'homepage')->get();
        $data['continents'] = Continent::where('status', 1)->orderBy('id', 'desc')->get();
        $data['learn_texts'] = HomeContentItem::where('type', "homepage")->get();
        $data['clients'] = Client::all();

        $data['universities'] = University::where('status', 1)->orderBy('id', 'desc')->get();
        $data['degrees'] = Degree::get();
        $data['provinces'] = State::all();
        $data['cities'] = City::all();
        $data['majors'] = Department::all();

        $data['homecontentlocations'] = HomeContentLocation::orderBy('id', 'desc')->get();
        $data['services'] = AdditionalPage::where('page', 'our-services')->first();

        // fetch selected programs for 'all programs' tab
        
        $selected_programs = Course::where(['status' => 1, 'type' => 'university', 'show_on_home' => 1])->orderBy('updated_at', 'desc')->limit(8)->get();
        if (count($selected_programs) > 0) {
            $data['courses_all'] = $selected_programs;
        } else {
            $data['courses_all'] = Course::where(['status' => 1, 'type' => 'university'])->inRandomOrder()->limit(8)->get();
        }

        $data['courses_our_top_pics'] = Course::where(['status' => 1, 'type' => 'university', 'coursetype' => 1])->orderBy('id', 'desc')->limit(8)->get();
        $data['courses_most_popular'] = Course::where(['status' => 1, 'type' => 'university', 'coursetype' => 2])->orderBy('id', 'desc')->limit(8)->get();
        $data['courses_fastest_admissions'] = Course::where(['status' => 1, 'type' => 'university', 'coursetype' => 3])->orderBy('id', 'desc')->limit(8)->get();
        $data['courses_highest_rating'] = Course::where(['status' => 1, 'type' => 'university', 'coursetype' => 4])->orderBy('id', 'desc')->limit(8)->get();
        $data['courses_top_ranked'] = Course::where(['status' => 1, 'type' => 'university', 'coursetype' => 5])->orderBy('id', 'desc')->limit(8)->get();

        $data["categories"] = Category::where('parent_id', 0)->where('type', 'home')->get();
        $data["sub_categorys"] = Category::where('type', "home")->where('parent_id', '!=', '')->where('is_sub', 0)->get();
        $data["testimonials_learner"] = Testimonial::where(['status' => 1, 'type' => 'learner'])->get();
        $data["testimonials_partner"] = Testimonial::where(['status' => 1, 'type' => 'partner'])->get();

        ///visitor count with ip address
        $UserIP = $_SERVER['REMOTE_ADDR'];

        //date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("Y-m-d h:i:sa");
        VisitorModel::insert([
            'ip_address' => $UserIP,
            'visit_time' => $timeDate,
            'created_at' => Carbon::now(),
            'updated_at' => now(),
        ]);

        return view('Frontend.index', $data);
    }

    public function typeaHeadSearch(Request $request)
    {
        $search = $request->input('search');
        $data['courses'] = Course::where('status', 1)->where('name', 'like', '%' . $search . '%')->get();
        return view('Frontend.typeahead_search', $data);
    }

    public function allCourseShow(Request $request)
    {
        $data['name'] = $name = $request->input('name');
        if (isset(request()->name)) {
            $data['top_category'] = null;
            $data['banner'] = Banner::where('type', 'course')->where('status', 1)->orderBy('id', 'desc')->first();
            $data["courses"] = Course::where('status', 1)->where('is_master', '0')->where('name', 'like', '%' . request()->name . '%')->paginate(9);
        } else {
            $data['top_category'] = null;
            $data['banner'] = Banner::where('type', 'course')->where('status', 1)->orderBy('id', 'desc')->first();
            $data['courses'] = Course::where('status', 1)->where('is_master', '0')->orderBy('id', 'desc')->paginate(9);
        }

        return view('Frontend.course.allcourse', $data);
    }

    //home cat show
    public function catCourseAll(Request $request, $cat_id)
    {
        $data['name'] = $name = $request->input('name');
        $data['top_category'] = $category = Category::find($cat_id);
        // dd($category);
        $data['courses'] = Course::where('status', 1)->where('category_id', $cat_id)->orderBy('id', 'desc')->paginate(9);
        return view('Frontend.course.allcourse', $data);
    }
    //home sub cat show
    public function subcatCourseAll(Request $request, $subcat_id)
    {
        $data['name'] = $name = $request->input('name');
        $data['top_category'] = $category = Category::find($subcat_id);
        // dd($category);
        $data['courses'] = Course::where('status', 1)->where('sub_category_id', $subcat_id)->orderBy('id', 'desc')->paginate(3);
        return view('Frontend.course.allcourse', $data);
    }

    //ajax get Course
    public function getCourse()
    {
        $data['courses'] = Course::where('status', 1)->where('is_master', '0')->orderBy('id', 'desc')->paginate(4);
        return view('Frontend.course.ajaxseecourse', $data);
    }

    //course By CatAjax
    public function courseByCatAjax(Request $request, $id)
    {
        $data['name'] = $name = $request->input('name');
        $data['top_category'] = $category = Category::find($id);
        $data['courses'] = Course::where('status', 1)->where('category_id', $id)->orderBy('id', 'desc')->get();
        return view('Frontend.course.catajax', $data);
    }
    //Master course By CatAjax
    public function masterCourseByCatAjax(Request $request, $id)
    {
        $data['master_courses'] = Course::where('status', 1)->where('category_id', $id)->where('is_master', 1)->orderBy('id', 'desc')->get();
        return view('Frontend.pages.master_course_ajax', $data);
    }

    //course By Sub CatAjax
    public function courseBySubCatAjax(Request $request, $id)
    {
        $data['name'] = $name = $request->input('name');
        $data['top_category'] = $category = Category::find($id);
        $data['courses'] = Course::where('status', 1)->where('sub_category_id', $id)->orderBy('id', 'desc')->get();
        return view('Frontend.course.subcatajax', $data);
    }

    //get Course Type By Cat
    // public function getCourseTypeByCat($cat){
    //     $data['courses'] = Course::where('type_id',$cat)->paginate(4);
    //     return view('Frontend.course.coursetypeajax',$data);
    // }

    public function getCourseTypeByCat($id)
    {

        if ($id == "") {
            $data['courses'] = Course::where('status', 1)->get();
        } else {
            $data['courses'] = Course::where('status', 1)->where('coursetype', $id)->get();
            // $data['events'] = Event::where('category_id',$id)->get();
        }
        return view('Frontend.course.coursetypeajax', $data);
    }

    //getCoursePublished
    public function getCoursePublished($id)
    {
        if ($id == '1') {
            $data['courses'] = Course::where('status', 1)->whereBetween('created_at', [(new Carbon)->subDays(7)->startOfDay(), (new Carbon)->now()->endOfDay()])->get();
        } else if ($id == '2') {
            $data['courses'] = Course::where('status', 1)->whereBetween('created_at', [(new Carbon)->subDays(30)->startOfDay(), (new Carbon)->now()->endOfDay()])->get();
        }
        return view('Frontend.course.publishedajaxcourse', $data);
    }

    public function addToSave(Request $request, $id)
    {
        try {
            if (auth()->check()) {

                $save = CourseSave::where('course_id', $id)->where('user_id', auth()->user()->id)->first();
                if ($save == null) {
                    $save = new CourseSave;
                    $save->course_id = $id;
                    $save->user_id = auth()->user()->id;
                    $save->save();
                    return "ok";
                } else {
                    $save->delete();
                    return "del";
                }
            } else {
                return "no";
            }
        } catch (\Exception $e) {
            return "no";
        }
    }

    //home course By Sub CatAjax
    public function homecourseByTypeAjax($id)
    {
        if ($id == "1") {
            $data['courses'] = Course::where('status', 1)->where('type', 'university')->where('coursetype', '1')->orderBy('id', 'desc')->get();
        } else if ($id == "2") {
            $data['courses'] = Course::where('status', 1)->where('type', 'university')->where('coursetype', '2')->orderBy('id', 'desc')->get();
        } else if ($id == "3") {
            $data['courses'] = Course::where('status', 1)->where('type', 'university')->where('coursetype', '3')->orderBy('id', 'desc')->get();
        } else if ($id == "4") {
            $data['courses'] = Course::where('status', 1)->where('type', 'university')->where('coursetype', '4')->orderBy('id', 'desc')->get();
        } else if ($id == "6") {
            $data['courses'] = Course::where('status', 1)->where('type', 'university')->orderBy('id', 'desc')->get();
        } else {
            $data['courses'] = Course::where('status', 1)->where('type', 'university')->where('coursetype', '5')->orderBy('id', 'desc')->get();
        }

        return view('Frontend.course.homepopularcourse-ajax', $data);
    }

    public function courseDetails($id)
    {
        $data['course'] = $course = Course::find($id);

        if ($course) {
            $course->views += 1;
            $course->save();
        }

        $data['reviews'] = Review::where('course_id', $course->id)->get();

        $continent = $course->university->continent_id;
        $data['consultant'] = $consultant = User::where('continent_id', $continent)
            ->where('type', 7)
            ->where('status', 1)
            ->first();

        $data['user'] = $user = User::where('id', Auth::id())->first();

        $star = $user->star ?? 0;
        // dd($user->star);
        $data['university'] = $course->university;
        // dd($data['university']);

        switch ($star) {
            case 0:
                $data['service_charge'] = $course->service_charge_beginner;
                break;
            case 1:
                $data['service_charge'] = $course->service_charge_1;
                break;
            case 2:
                $data['service_charge'] = $course->service_charge_2;
                break;
            case 3:
                $data['service_charge'] = $course->service_charge_3;
                break;
            case 4:
                $data['service_charge'] = $course->service_charge_4;
                break;
            case 5:
                $data['service_charge'] = $course->service_charge_5;
                break;
            case 6:
                $data['service_charge'] = $course->service_charge_6;
                break;
            case 7:
                $data['service_charge'] = $course->service_charge_7;
                break;

        }

        $data['related_courses'] = RelatedCourse::where('course_id', $id)->get();
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['dormitories'] = Dormitory::all();

        return view('Frontend.course.coursedetails', $data);
    }
    

    public function signin()
    {
        // dd(url()->previous());
        session()->put('login_pre_url', url()->previous());
        return view('Frontend.auth.login');
    }

    public function register()
    {
        $data['continents'] = Continent::where('status', 1)->get();
        return view('Frontend.auth.register', $data);
    }
    // public function instructorRegister()
    // {
    //     return view('Frontend.auth.register_instructor');
    // }
    // public function instructorSignin()
    // {
    //     return view('Frontend.auth.login_instructor');
    // }
    public function sellerRegister()
    {
        return view('Frontend.auth.register_seller');
    }
    public function sellerSignin()
    {
        return view('Frontend.auth.login_seller');
    }
    public function teacherSignin()
    {
        return view('Frontend.auth.login_teacher');
    }
    public function teacherRegister()
    {
        return view('Frontend.auth.register_teacher');
    }
    public function affiliateSignin()
    {
        return view('Frontend.auth.login_affiliate');
    }
    public function affiliateRegister()
    {
        return view('Frontend.auth.register_affiliate');
    }
    public function consultantSignin()
    {
        return view('Frontend.auth.login_consultant');
    }
    public function consultantRegister()
    {
        $data['continents'] = Continent::where('status', 1)->get();
        return view('Frontend.auth.register_consultant', $data);
    }

    //pages
    public function founders_co_founders()
    {
        $data['page'] = AdditionalPage::where('page', 'founders')->first();

        if (!$data['page']) {
            abort(404, 'Page Not Found!');
        }

        return view('Frontend.pages.founders_page', $data);
    }

    public function our_services()
    {
        $data['page'] = AdditionalPage::where('page', 'our-services')->first();

        if (!$data['page']) {
            abort(404, 'Page Not Found!');
        }

        return view('Frontend.pages.our_services', $data);
    }

    public function single_services($title)
    {
        $service = AdditionalPage::where('page', 'our-services')
            ->where('contents', 'LIKE', '%' . $title . '%')
            ->first();

        if (!$service) {
            abort(404, 'Service not found');
        }

        $decoded_contents = json_decode($service->contents, true);
        $servicesLarge = $decoded_contents['servicesLarge'] ?? [];

        $serviceDetails = collect($servicesLarge)->firstWhere('title', $title);

        if (!$serviceDetails) {
            abort(404, 'Service details not found');
        }

        return view('Frontend.pages.single_services', compact('serviceDetails'));
    }

    public function why_china()
    {
        $data['page'] = AdditionalPage::where('page', 'why-china')->first();

        if (!$data['page']) {
            abort(404, 'Page Not Found!');
        }

        return view('Frontend.pages.common-page-2', $data);
    }

    public function about_china()
    {
        $data['page'] = AdditionalPage::where('page', 'about-china')->first();

        if (!$data['page']) {
            abort(404, 'Page Not Found!');
        }

        return view('Frontend.pages.common-page-2', $data);
    }

    public function scholarship()
    {
        $data['scholarship_courses'] = Course::where('scholarship_id', '!=', null)->where('status',1)->get();

        $data['univerties'] = $univerties = University::withCount('courses')->get();
        $data['degrees'] = $degrees = Degree::withCount('courses')->get();
        $data['countries'] = $countries = Country::withCount('universities')->get();
        $data['states'] = $states = State::withCount('universities')->get();
        $data['cities'] = $cities = City::withCount('universities')->get();
        $data['languages'] = $language = CourseLanguage::withCount('courses')->get();
        $data['departments'] = $departments = Department::withCount('courses')->get();
        $data['sections'] = $sections = Section::withCount('courses')->orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->get();
        $data['scholarships'] = Scholarship::all();

        return view('Frontend.pages.scholarship', $data);
    }

    public function ajaxScholarshipProgramFilter(Request $request)
    {
        $courses = Course::query();

        $data['univerties'] = $univerties = University::get();
        $data['degrees'] = $degrees = Degree::get();
        $data['languages'] = $language = CourseLanguage::get();
        $data['departments'] = $departments = Department::get();
        $data['sections'] = $sections = Section::orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->where('status', 1)->get();
        $univerties = University::where('status', 1);

        /* if (request()->input('name')) {
        $courses->where('name', 'like', '%' . request()->name . '%');
        } */
        if (request()->input('scholarship')) {
            $courses->where('scholarship_id', request()->scholarship);
        }
        if (request()->input('course_type')) {
            $courses->where('coursetype', request()->course_type);
        }
        if (request()->input('tuition_fees')) {
            $courses->where('year_fee', '<=', request()->input('tuition_fees'));
        }
        if (request()->input('accommodation_fees')) {
            $courses->where('accommodation_fee', '<=', request()->input('accommodation_fees'));
        }
        if (request()->input('service_charge')) {
            $courses->where('service_charge', '<=', request()->input('service_charge'));
        }

        if (request()->input('continent')) {
            $univerties = $univerties->where('continent_id', request()->input('continent'));
            $select_continent = request()->input('continent');
        } else {
            $select_continent = 0;
        }

        if (request()->input('country')) {
            $univerties = $univerties->where('country_id', request()->input('country'));
            $select_country = Country::find(request()->input('country'));
            if ($select_continent == 0) {
                $select_continent = $select_country->continent->id;
                $select_country = $select_country->id;
            } else {
                $select_country = $select_country->id;
            }
        } else {
            $select_country = 0;
        }
        $data['countries'] = $countries = Country::withCount('university')->where('continent_id', $select_continent)->where('status', 1)->get();

        if (request()->input('state')) {
            $univerties = $univerties->where('state_id', request()->input('state'));

            $select_state = State::find(request()->input('state'));
            if ($select_country == 0) {
                $select_country = $select_state->country->id;
                $select_state = $select_state->id;
            } else {
                $select_state = $select_state->id;
            }
        } else {
            $select_state = 0;
        }
        $data['states'] = $states = State::withCount('universities')->where('country_id', $select_country)->where('status', 1)->get();

        if (request()->input('city')) {
            $univerties = $univerties->where('city_id', request()->input('city'));

            $select_city = City::find(request()->input('city'));
            if ($select_state == 0) {
                $select_state = $select_city->state->id;
                $select_city = $select_city->id;
            } else {
                $select_city = $select_city->id;
            }
        } else {
            $select_city = 0;
        }

        $data['cities'] = $cities = City::withCount('universities')->where('state_id', $select_state)->where('status', 1)->get();

        $data['select_continent'] = $select_continent;
        $data['select_country'] = $select_country;
        $data['select_state'] = $select_state;
        $data['select_city'] = $select_city;
        $data['universities'] = $univerties->get();

        $selected_university = 0;
        $selected_degree = 0;
        $selected_language = 0;
        $selected_section = 0;
        $selected_subject = 0;

        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
        } else {
            $courses = $courses->whereIn('university_id', $univerties->pluck('id'));
        }

        // op st
        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
            $selected_university = $request->university;
        }
        //op end

        if ($request->degree) {
            $courses = $courses->where('degree_id', $request->degree);
            $selected_degree = $request->degree;
        }

        if ($request->language) {
            $courses = $courses->where('language_id', $request->language);
            $selected_language = $request->language;
        }
        if ($request->section) {
            $courses = $courses->where('section_id', $request->section);
            $selected_section = $request->section;
        }
        if ($request->subject) {
            $courses = $courses->where('department_id', $request->subject);
            $selected_subject = $request->subject;
        }

        if ($request->sortBy) {
            if ($request->sortBy == 'top_pick') {
                $courses = $courses->orderBy('views', 'desc');
            }
        } else {
            $courses = $courses->orderBy('views', 'desc');
        }

        $data['selected_degree'] = $selected_degree;
        $data['selected_language'] = $selected_language;
        $data['selected_section'] = $selected_section;
        $data['selected_subject'] = $selected_subject;
        $data['selected_university'] = $selected_university;

        $fetchedCourses = [];

        if ($request->input('scholarship_type')) {
            $scholarshipIds = Scholarship::where('type', $request->input('scholarship_type'))->pluck('id');

            if ($scholarshipIds) {
                foreach ($scholarshipIds as $id) {
                    $course = Course::where('scholarship_id', $id)->whereNotNull('scholarship_id')->first();
                    if ($course != null) {
                        $fetchedCourses[] = $course;
                    }
                }
            }
        }

        $courses = $courses->where('scholarship_id', '!=', null)->get();
        if (!empty($courses) && !$request->input('scholarship_type')) {
            $fetchedCourses = $courses;
        }

        $data['scholarship_courses'] = $fetchedCourses;
        return view('Frontend.pages.scholarship_ajax_filter', $data);
    }

    public function gallery()
    {
        $data['page'] = AdditionalPage::where('page', 'gallery')->first();

        if (!$data['page']) {
            abort(404);
        }

        return view('Frontend.pages.gallery', $data);
    }

    public function authorization_letters()
    {
        $data['page'] = AdditionalPage::where('page', 'authorization-letters')->first();

        if (!$data['page']) {
            abort(404);
        }

        return view('Frontend.pages.authorization_letters', $data);
    }

    public function activities()
    {
        $data['page'] = AdditionalPage::where('page', 'activities')->first();

        if (!$data['page']) {
            abort(404);
        }

        return view('Frontend.pages.activities', $data);
    }

    public function activity_details($activity_key)
    {
        $page = AdditionalPage::where('page', 'activities')->first();
        $contents = json_decode($page['contents'], true) ?? [];

        foreach ($contents as $key => $content) {
            if ($key == $activity_key) {
                foreach ($content['images'] as $key => $image) {
                    $content['banner'] = $image;
                }
                $data['activity'] = $content;

                return view('Frontend.pages.activity-details', $data);
            }
        }

        return redirect()->back()->with('error', 'Something Went Wrong!');
    }

    public function company_details()
    {
        $data['home_content'] = HomeContentSetup::first();
        $data['page'] = AdditionalPage::where('page', 'company-details')->first();

        if (!$data['page']) {
            abort(404);
        }

        return view('Frontend.pages.company_details', $data);
    }

    public function about()
    {
        $data['content'] = Page::where('template', 'about')->first();

        if (!$data['page']) {
            abort(404);
        }
        $data['page_title'] = 'About';

        return view('Frontend.pages.common-page', $data);
    }
    public function learner()
    {
        $data['home_content'] = HomeContentSetup::first();
        $data['learner'] = learnerPageSetup::first();
        $data['clients'] = Client::all();
        $data['partners'] = Partner::all();
        return view('Frontend.pages.learner', $data);
    }
    public function instructor()
    {
        $data['instructor'] = InstructorPageSetup::first();
        return view('Frontend.pages.instructor', $data);
    }
    public function office_details($office_id)
    {
        $data['office'] = Office::find($office_id);
        return view('Frontend.pages.office_details', $data);
    }
    public function contact()
    {
        // $data['site_setting'] = SiteSetting::first();
        $data['banner'] = Banner::where('type', 'contact')->where('status', 1)->orderBy('id', 'desc')->first();
        $data['contact_info'] = Tp_option::where('option_name', 'theme_option_footer')->first();
        return view('Frontend.pages.contact', $data); // enterprise
    }

    public function userContactStore(Request $request)
    {
        // dd();
        $request->validate([

            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        $contact = new UserContact();
        $contact->name = $request->name;
        $contact->mobile = $request->mobile;
        $contact->email = $request->email;
        $contact->type = $request->type;
        $contact->contact_type = 'contact';
        $contact->organization = $request->organization;
        $contact->date = $request->date;
        $contact->details = $request->details;
        $contact->save();
        // return redirect()->back(); // contactStore
        return redirect()->route('frontend.contact')->with('success', 'Your Contact Add Successfully');
    }

    public function library()
    {
        $data['library'] = Library::first();
        return view('Frontend.pages.library', $data);
    }

    public function eventList(Request $request)
    {
        $data['name'] = $name = $request->input('name');
        if (isset(request()->name)) {
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'event')->get();
            $data['banner'] = Banner::where('type', 'event')->where('status', 1)->orderBy('id', 'desc')->first();
            $data["events"] = Event::where('status', 1)->where('name', 'like', '%' . request()->name . '%')->paginate(9);
        } else {
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'event')->get();
            $data['banner'] = Banner::where('type', 'event')->where('status', 1)->orderBy('id', 'desc')->first();
            $data['events'] = Event::where('status', 1)->orderBy('id', 'desc')->paginate(9);
        }

        return view('Frontend.pages.eventlist', $data);
    }

    public function eventDetails($id)
    {
        $data['event'] = Event::find($id);

        return view('Frontend.pages.eventdetails', $data);
    }

    public function expoList(Request $request)
    {
        $data['expos'] = Expo::latest()->paginate(10);
        $data['banner'] = Banner::where('type', 'event')->where('status', 1)->orderBy('id', 'desc')->first();

        return view('Frontend.pages.expolist', $data);
    }

    public function expoDetails($id)
    {
        $data['expo'] = Expo::find($id);
        // return view('Frontend.pages.expodetails', $data);
        return view('Expo.home', $data);
    }

    //ajax get Event
    public function getEvents()
    {
        $data['events'] = Event::where('status', 1)->orderBy('id', 'desc')->paginate(3);
        return view('Frontend.pages.eventajaxsee', $data);
    }

    public function eventMassage(Request $request)
    {
        //dd($request->all());
        $contact = new UserContact();
        $contact->user_id = auth()->user()->id;
        $contact->event_id = $request->event_id;
        $contact->details = $request->details;
        $contact->contact_type = 'event';
        $contact->save();
        return redirect()->back()->with('success', 'Massage Add Successfully');
    }
    //Event Cat Show
    public function getEventByCat(Request $request, $id)
    {
        $data['name'] = $name = $request->input('name');
        if ($id == 0) {
            $data['events'] = Event::where('status', 1)->get();
        } else {
            $data['events'] = Event::where('status', 1)->where('category_id', $id)->get();
        }

        return view('Frontend.pages.eventcatajax', $data);
    }
    //Event Relese Show
    public function getEventRelese(Request $request, $id)
    {
        $data['name'] = $name = $request->input('name');
        $event = Event::query();
        if ($id != 'allevent') {
            $event = $event->where('release_id', $id);
        }
        if ($request->cat_id != 0) {
            $event = $event->where('category_id', $id);
        }
        if ($request->search != "") {
            $event = $event->where('name', 'like', '%' . request()->search . '%');
        }
        $data['events'] = $event->get();
        return view('Frontend.pages.eventreleaseajax', $data);
    }

    public function blog(Request $request)
    {

        $category = "";

        $data['search'] = $search = $request->input('search');
        if (isset(request()->search)) {
            $data["blogs"] = Blog::where('title', 'like', '%' . request()->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%')
                ->get();
            $data["categories"] = Category::where('parent_id', '=', 0)->where('type', 'blog')->get();
            $data['banner'] = Banner::where('type', 'blog')->where('status', 1)->orderBy('id', 'desc')->first();
        }
        // else if(isset($request->category)){
        //     $data['blogs'] = Blog::leftJoin('categories','categories.id','blogs.category_id')
        //     ->where('blogs.category_id','like','%'.$request->category.'%')
        //     ->get();
        //     $data["categories"] = Category::where('parent_id', '=' ,0)->where('type', 'blog')->get();

        // }
        else {
            $data['blogs'] = Blog::where('status', 1)->get();
            $data["categories"] = Category::where('parent_id', '=', 0)->where('type', 'blog')->get();
            $data['banner'] = Banner::where('type', 'blog')->where('status', 1)->orderBy('id', 'desc')->first();
        }

        $data['category'] = $category;
        $data['topics'] = Topic::where('type', 'blog')->where('status', 1)->get();
        $data['banner'] = Banner::where('type', 'blog')->where('status', 1)->orderBy('id', 'desc')->first();
        return view('Frontend.pages.blog', $data);
    }
    public function blogDetails($id)
    {
        $blog = Blog::find($id);
        $blog->views = $blog->views + 1;
        $blog->save();
        $data['blog'] = $blog;
        $data['blogs'] = Blog::where('status', 1)->get();
        return view('Frontend.pages.blog_details', $data);
    }

    ///Blog search by category
    public function getBlogByCat(Request $request, $id)
    {
        if ($id == 0) {
            $data['blogs'] = Blog::get();
        } else {
            $category = Category::find($id);

            if ($category->sub->count() > 0) {
                $cat_ids[] = $id;
                foreach ($category->sub as $sub_cate) {
                    $cat_ids[] = $sub_cate->id;
                }
                $data['blogs'] = Blog::whereIn('category_id', $cat_ids)->get();
            } else {
                $data['blogs'] = Blog::where('category_id', $id)->get();
            }
        }
        return view('Frontend.pages.blogcatajax', $data);
    }
    ///Blog search by sort by
    public function getBlogSortBy(Request $request, $id)
    {
        if ($id == 'like') {
            $data['blogs'] = Blog::withCount('likes')->orderByDesc('likes_count', 'id')->get();
        } else {
            $data['blogs'] = Blog::latest()->get();
        }
        return view('Frontend.pages.blog_sort_by_ajax', $data);
    }

    public function paymentProcess()
    {
        $data['content'] = Page::where('template', 'payment-process')->first();
        $data['page_title'] = 'Payment Process';

        return view('Frontend.pages.common-page', $data);
    }
    public function privacyPolicy()
    {
        $data['content'] = Page::where('template', 'privacy-policy')->first();
        $data['page_title'] = 'Privacy Policy';

        return view('Frontend.pages.common-page', $data);
    }
    public function refundPolicy()
    {
        $data['content'] = Page::where('template', 'refund-policy')->first();
        $data['page_title'] = 'Refund Policy';

        return view('Frontend.pages.common-page', $data);
    }
    public function termsConditions()
    {
        $data['content'] = Page::where('template', 'terms-conditions')->first();
        $data['page_title'] = 'Terms & Conditions';

        return view('Frontend.pages.common-page', $data);
    }
    public function maestroClass()
    {
        $data['content'] = MaestroClassSetup::first();
        $data['categories'] = Category::where('parent_id', '=', 0)->where('type', 'master_course')->get();
        $data['master_courses'] = Course::where('status', 1)->where('is_master', 1)->get();
        return view('Frontend.pages.maestro_class', $data);
    }
    public function maestroClassDetails($id)
    {
        $data['master_course'] = Course::find($id);
        $data['master_courses'] = Course::where('status', 1)->where('is_master', 1)->get();
        return view('Frontend.pages.maestro_class_details', $data);
    }
    public function faq()
    {
        $data['faq_content'] = Faq::where('type', 'faq_content')->first();
        $data['faqs'] = Faq::where('type', "faq")->get();
        $data['blogs'] = Blog::where('status', 1)->orderBy('id', 'desc')->get();
        return view('Frontend.pages.faq', $data);
    }

    public function subscribeDetails()
    {
        //dd('hi');
        // $data['course'] = Course::find($id);
        $data['home_content'] = HomeContentSetup::first();
        return view('Frontend.pages.subscribe_details', $data);
    }

    // -------------------------------==============
    public function eBook(Request $request)
    {

        $data['title'] = $title = $request->input('title');
        if (isset(request()->title)) {
            // $data['banner']= Banner::where('type','ebook')->where('status',1)->orderBy('id','desc')->first();
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'ebook')->get();
            $data["ebooks"] = Ebook::where('type', 'ebook')->where('status', 1)->where('title', 'like', '%' . request()->title . '%')->get();
            $data['banner'] = Banner::where('type', 'ebook')->where('status', 1)->orderBy('id', 'desc')->first();
        } else {
            // $data['banner']= Banner::where('type','ebook')->where('status',1)->orderBy('id','desc')->first();
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'ebook')->get();
            $data['ebooks'] = Ebook::where('type', 'ebook')->where('status', 1)->get();
            $data['banner'] = Banner::where('type', 'ebook')->where('status', 1)->orderBy('id', 'desc')->first();
        }
        return view('Frontend.ebook.ebook_list', $data);
    }

    public function eBookDetails($id)
    {
        $data['ebook'] = Ebook::find($id);
        return view('Frontend.ebook.ebook_details', $data);
    }

    public function getEbookByCat(Request $request, $id)
    {
        $data['title'] = $name = $request->input('title');
        if ($id == 0) {
            $data['ebooks'] = Ebook::where('status', 1)->get();
        } else {
            $data['ebooks'] = Ebook::where('status', 1)->where('category_id', $id)->get();
        }

        return view('Frontend.ebook.ebookcatajax', $data);
    }

    public function eBookDownload($id)
    {
        $data['ebook'] = Ebook::find($id);
        // return view('Frontend.ebook.ebook_pdf_download', $data);
        $html = view('Frontend.ebook.ebook_pdf_download', $data);
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
        $name = 'Purchase E-Book_ ' . date('Y-m-d i:h:s');
        $mpdf->Output($name . '.pdf', 'D');
    }

    public function eBookVideoDownload($id)
    {

        $ebook = Ebook::findOrFail($id);
        $files = EbookVideoContent::where('ebook_id', $ebook->id)->get();

        $zipFileName = $ebook->title . '_eBook_videos.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/ebook/video/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $videoPath = public_path('upload/ebook/video/' . $file->video_file);
            // dd($videoPath);
            if (File::exists($videoPath)) {
                $zip->addFile($videoPath, $file->video_file);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/ebook/video/' . $zipFileName))->deleteFileAfterSend(true);
    }
    public function eBookAudioDownload($id)
    {

        $ebook = Ebook::findOrFail($id);
        $files = EbookAudioContent::where('ebook_id', $ebook->id)->get();

        $zipFileName = $ebook->title . '_eBook_audio.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/ebook/audio/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $audioPath = public_path('upload/ebook/audio/' . $file->audio_file);
            // dd($audioPath);
            if (File::exists($audioPath)) {
                $zip->addFile($audioPath, $file->audio_file);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/ebook/audio/' . $zipFileName))->deleteFileAfterSend(true);
    }

    //ebook audio start
    public function eBookAudio(Request $request)
    {

        $data['title'] = $title = $request->input('title');
        if (isset(request()->title)) {
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'ebook')->get();
            $data["ebooks"] = Ebook::where('type', 'ebookaudio')->where('status', 1)->where('title', 'like', '%' . request()->title . '%')->paginate(9);
            $data['banner'] = Banner::where('type', 'e-audio')->where('status', 1)->orderBy('id', 'desc')->first();
        } else {
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'ebook')->get();
            $data['ebooks'] = Ebook::where('type', 'ebookaudio')->where('status', 1)->paginate(9);
            $data['banner'] = Banner::where('type', 'e-audio')->where('status', 1)->orderBy('id', 'desc')->first();
        }
        return view('Frontend.ebookaudio.ebook_audio_list', $data);
    }

    public function eBookAudioDetails($id)
    {
        //dd('hi');
        $data['ebook'] = Ebook::find($id);
        return view('Frontend.ebookaudio.ebook_audio_details', $data);
    }

    public function getEbookAudioByCat(Request $request, $id)
    {
        $data['title'] = $name = $request->input('title');
        if ($id == 0) {
            $data['ebooks'] = Ebook::where('type', 'ebookaudio')->where('status', 1)->get();
        } else {
            $data['ebooks'] = Ebook::where('type', 'ebookaudio')->where('status', 1)->where('category_id', $id)->get();
        }

        return view('Frontend.ebookaudio.ebookaudiocatajax', $data);
    }

    public function eAudioDownload($id)
    {

        $ebook = Ebook::findOrFail($id);
        $files = EbookAudioContent::where('ebook_id', $ebook->id)->get();

        $zipFileName = $ebook->title . '_eBook_audio.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/ebook/audio/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $audioPath = public_path('upload/ebook/audio/' . $file->audio_file);
            // dd($audioPath);
            if (File::exists($audioPath)) {
                $zip->addFile($audioPath, $file->audio_file);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/ebook/audio/' . $zipFileName))->deleteFileAfterSend(true);
    }
    //ebook audio end

    //ebook Video start
    public function eBookVideo(Request $request)
    {

        $data['title'] = $title = $request->input('title');
        if (isset(request()->title)) {
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'ebook')->get();
            $data["ebooks"] = Ebook::where('type', 'ebookvideo')->where('status', 1)->where('title', 'like', '%' . request()->title . '%')->paginate(9);
            $data['banner'] = Banner::where('type', 'e-video')->where('status', 1)->orderBy('id', 'desc')->first();
        } else {
            $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'ebook')->get();
            $data['ebooks'] = Ebook::where('type', 'ebookvideo')->where('status', 1)->paginate(9);
            $data['banner'] = Banner::where('type', 'e-video')->where('status', 1)->orderBy('id', 'desc')->first();
        }
        return view('Frontend.ebookvideo.ebook_video_list', $data);
    }

    public function eBookVideoDetails($id)
    {
        //dd('hi');
        $data['ebook'] = Ebook::find($id);
        return view('Frontend.ebookvideo.ebook_video_details', $data);
    }

    public function getEbookVideoByCat(Request $request, $id)
    {
        $data['title'] = $name = $request->input('title');
        if ($id == 0) {
            $data['ebooks'] = Ebook::where('type', 'ebookvideo')->where('status', 1)->get();
        } else {
            $data['ebooks'] = Ebook::where('type', 'ebookvideo')->where('status', 1)->where('category_id', $id)->get();
        }

        return view('Frontend.ebookvideo.ebook_video_catajax', $data);
    }

    public function eVideoDownload($id)
    {

        $ebook = Ebook::findOrFail($id);
        $files = EbookAudioContent::where('ebook_id', $ebook->id)->get();

        $zipFileName = $ebook->title . '_eBook_audio.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/ebook/audio/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $audioPath = public_path('upload/ebook/audio/' . $file->audio_file);
            // dd($audioPath);
            if (File::exists($audioPath)) {
                $zip->addFile($audioPath, $file->audio_file);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/ebook/audio/' . $zipFileName))->deleteFileAfterSend(true);
    }
    //ebook audio end

    public function courseResourceFilesDownload($id)
    {

        $course = Course::findOrFail($id);
        $files = CourseResourceFile::where('course_id', $course->id)->get();

        $zipFileName = $course->name . '_CourseResourceFile.zip';
        $zip = new ZipArchive();
        $zip->open(public_path('upload/course/file/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $filepath = public_path('upload/course/file/' . $file->name);
            // dd($videoPath);
            if (File::exists($filepath)) {
                $zip->addFile($filepath, $file->name);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/course/file/' . $zipFileName))->deleteFileAfterSend(true);
    }

    public function courseLessonFilesDownload($id)
    {

        $course = Course::findOrFail($id);
        $files = CourseLessonFile::where('course_id', $course->id)->get();

        $zipFileName = $course->name . '_CourseLessonFile.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/course/file/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $filepath = public_path('upload/course/file/' . $file->name);
            // dd($videoPath);
            if (File::exists($filepath)) {
                $zip->addFile($filepath, $file->name);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/course/file/' . $zipFileName))->deleteFileAfterSend(true);
    }

    public function courseQuizFilesDownload($id)
    {

        $course = Course::findOrFail($id);
        $files = CourseQuizFile::where('course_id', $course->id)->get();

        $zipFileName = $course->name . '_CourseQuizFile.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/course/file/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $filepath = public_path('upload/course/file/' . $file->name);
            // dd($videoPath);
            if (File::exists($filepath)) {
                $zip->addFile($filepath, $file->name);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/course/file/' . $zipFileName))->deleteFileAfterSend(true);
    }

    public function courseProjectFilesDownload($id)
    {

        $course = Course::findOrFail($id);
        $files = CoursezprojectFile::where('course_id', $course->id)->get();

        $zipFileName = $course->name . '_CoursezprojectFile.zip';
        $zip = new ZipArchive();

        $zip->open(public_path('upload/course/file/' . $zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $filepath = public_path('upload/course/file/' . $file->name);
            // dd($videoPath);
            if (File::exists($filepath)) {
                $zip->addFile($filepath, $file->name);
            } else {
                return redirect()->back();
            }
        }

        $zip->close();

        return response()->download(public_path('upload/course/file/' . $zipFileName))->deleteFileAfterSend(true);
    }

    public function admissionApply()
    {
        $data['degrees'] = Degree::get();
        $data['departments'] = Department::get();

        return view('Frontend.university.admission_apply_degree_filter', $data);
    }

    public function universityCourseList(Request $request)
    {
        $courses = Course::query();

        $data['univerties'] = $universities = University::withCount('courses')->get();
        $data['degrees'] = $degrees = Degree::withCount('courses')->get();
        $data['states'] = $states = State::withCount('universities')->get();
        $data['cities'] = $cities = City::withCount('universities')->get();
        $data['departments'] = $departments = Department::withCount('courses')->get();
        $data['countries'] = $countries = Country::withCount('universities')->get();
        $data['languages'] = $language = CourseLanguage::withCount('courses')->get();
        $data['sections'] = $sections = Section::withCount('courses')->orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->get();

        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
        }
        if ($request->degree) {
            $courses = $courses->where('degree_id', $request->degree);
        }
        if ($request->department) {
            $courses = $courses->where('department_id', $request->department);
        }
        if ($request->intake) {
            $courses = $courses->where('section_id', $request->intake);
        }

        if ($request->state) {
            $universities = $universities->where('state_id', $request->state)->pluck('id');
            $courses->whereIn('university_id', $universities);
        }

        if ($request->sortBy) {
            if ($request->sortBy == 'top_pick') {
                $courses = $courses->orderBy('views', 'desc');
            }
        } else {
            $courses = $courses->orderBy('views', 'desc');
        }

        if ($request->search) {
            $search = $request->search;

            $degreeIds = [];
            $departmentIds = [];
            $universityIds = [];
            $cityIds = [];
            $stateIds = [];
            $scholarshipIds = [];

            $degrees = Degree::where('name', 'like', '%' . $search . '%')->get();
            foreach ($degrees as $degree) {
                $degreeIds[] = $degree->id;
            }

            $departments = Department::where('name', 'like', '%' . $search . '%')->get();
            foreach ($departments as $department) {
                $departmentIds[] = $department->id;
            }

            $universities = University::where('name', 'like', '%' . $search . '%')->get();
            foreach ($universities as $university) {
                $universityIds[] = $university->id;
            }

            $cities = City::where('name', 'like', '%' . $search . '%')->get();
            foreach ($cities as $city) {
                $cityIds[] = $city->id;
            }

            $states = State::where('name', 'like', '%' . $search . '%')->get();
            foreach ($states as $state) {
                $stateIds[] = $state->id;
            }

            $scholarships = Scholarship::where('title', 'like', '%' . $search . '%')->get();
            foreach ($scholarships as $scholarship) {
                $scholarshipIds[] = $scholarship->id;
            }

            $languages = CourseLanguage::where('name', 'like', '%' . $search . '%')->get();
            foreach ($languages as $language) {
                $languageIds[] = $language->id;
            }

            if (!empty($cityIds)) {
                $cityUniversities = University::whereIn('city_id', $cityIds)->get();
                foreach ($cityUniversities as $university) {
                    $universityIds[] = $university->id;
                }
            }

            if (!empty($stateIds)) {
                $stateUniversities = University::whereIn('state_id', $stateIds)->get();
                foreach ($stateUniversities as $university) {
                    $universityIds[] = $university->id;
                }
            }

            if (!empty($degreeIds)) {
                $courses->orWhereIn('degree_id', $degreeIds);
            }

            if (!empty($departmentIds)) {
                $courses->orWhereIn('department_id', $departmentIds);
            }

            if (!empty($universityIds)) {
                $courses->orWhereIn('university_id', $universityIds);
            }

            if (!empty($scholarshipIds)) {
                $courses->orWhereIn('scholarship_id', $scholarshipIds)
                    ->orWhere(function ($query) use ($scholarshipIds) {
                        foreach ($scholarshipIds as $id) {
                            $query->orWhereJsonContains('additional_scholarships', $id);
                        }
                    });
            }

            if (!empty($languageIds)) {
                $courses->orWhereIn('language_id', $languageIds);
            }

            $courses = $courses->distinct();
        }

        $data['courses'] = $courses->where('status', 1)->paginate(10);
        return view('Frontend.university.university_course_list', $data);
    }

    public function singleCourse(Request $request, $id)
    {
        $courses = Course::query();

        $data['univerties'] = $universities = University::withCount('courses')->get();
        $data['degrees'] = $degrees = Degree::withCount('courses')->get();
        $data['states'] = $states = State::withCount('universities')->get();
        $data['cities'] = $cities = City::withCount('universities')->get();
        $data['departments'] = $departments = Department::withCount('courses')->get();
        $data['countries'] = $countries = Country::withCount('universities')->get();
        $data['languages'] = $language = CourseLanguage::withCount('courses')->get();
        $data['sections'] = $sections = Section::withCount('courses')->orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->get();

        $data['courses'] = Course::where('university_id', $id)->paginate(10);
        return view('Frontend.university.single_uni_course_list', $data);
    }

    public function applyNow(Request $request)
    {
        $courses = Course::query();

        $data['univerties'] = $univerties = University::withCount('courses')->get();
        $data['degrees'] = $degrees = Degree::withCount('courses')->get();
        $data['countries'] = $countries = Country::withCount('universities')->get();
        $data['states'] = $states = State::withCount('universities')->get();
        $data['cities'] = $cities = City::withCount('universities')->get();
        $data['languages'] = $language = CourseLanguage::withCount('courses')->get();
        $data['departments'] = $departments = Department::withCount('courses')->get();
        $data['sections'] = $sections = Section::withCount('courses')->orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->get();

        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
        }
        if ($request->degree) {
            $courses = $courses->where('degree_id', $request->degree);
        }
        if ($request->department) {
            $courses = $courses->where('department_id', $request->department);
        }

        if ($request->sortBy) {
            if ($request->sortBy == 'top_pick') {
                $courses = $courses->orderBy('views', 'desc');
            }
        } else {
            $courses = $courses->orderBy('views', 'desc');
        }

        if ($request->search) {
            $search = $request->search;
            $courses->where('name', 'like', '%' . $search . '%');
        }

        $data['courses'] = $courses = $courses->where('type', 'university')->paginate(10);

        // if there is partner reference id
        if (!empty($request->query('partner_ref_id'))) {
            $partner_ref_id = $request->query('partner_ref_id');
            $partner = User::find($partner_ref_id);

            if ($partner) {
                // if applied by partner
                if ($request->query('is_applied_partner') && $request->query('is_applied_partner') == true) {
                    session()->put('is_applied_partner', true);
                }

                session()->put('partner_ref_id', $partner_ref_id);
                session()->put('is_anonymous', 'true');

                return view('Frontend.university.university_course_list', $data);
            }
        }

        return redirect(route('frontend.university_course_list'));
    }

    public function ajaxFilterCourse(Request $request)
    {
        $courses = Course::query();

        $data['univerties'] = $univerties = University::get();
        $data['degrees'] = $degrees = Degree::get();
        $data['languages'] = $language = CourseLanguage::get();
        $data['departments'] = $departments = Department::get();
        $data['sections'] = $sections = Section::orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->where('status', 1)->get();
        $univerties = University::where('status', 1);

        if (request()->input('continent')) {
            $univerties = $univerties->where('continent_id', request()->input('continent'));
            $select_continent = request()->input('continent');
        } else {
            $select_continent = 0;
        }

        if (request()->input('country')) {
            $univerties = $univerties->where('country_id', request()->input('country'));
            $select_country = Country::find(request()->input('country'));
            if ($select_continent == 0) {
                $select_continent = $select_country->continent->id;
                $select_country = $select_country->id;
            } else {
                $select_country = $select_country->id;
            }
        } else {
            $select_country = 0;
        }
        $data['countries'] = $countries = Country::withCount('university')->where('continent_id', $select_continent)->where('status', 1)->get();

        if (request()->input('state')) {
            $univerties = $univerties->where('state_id', request()->input('state'));

            $select_state = State::find(request()->input('state'));
            if ($select_country == 0) {
                $select_country = $select_state->country->id;
                $select_state = $select_state->id;
            } else {
                $select_state = $select_state->id;
            }
        } else {
            $select_state = 0;
        }
        $data['states'] = $states = State::withCount('universities')->where('country_id', $select_country)->where('status', 1)->get();

        if (request()->input('city')) {
            $univerties = $univerties->where('city_id', request()->input('city'));

            $select_city = City::find(request()->input('city'));
            if ($select_state == 0) {
                $select_state = $select_city->state->id;
                $select_city = $select_city->id;
            } else {
                $select_city = $select_city->id;
            }
        } else {
            $select_city = 0;
        }

        $data['cities'] = $cities = City::withCount('universities')->where('state_id', $select_state)->where('status', 1)->get();

        $data['select_continent'] = $select_continent;
        $data['select_country'] = $select_country;
        $data['select_state'] = $select_state;
        $data['select_city'] = $select_city;
        $data['universities'] = $univerties->get();

        $selected_university = 0;
        $selected_degree = 0;
        $selected_language = 0;
        $selected_section = 0;
        $selected_subject = 0;

        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
        } else {
            $courses = $courses->whereIn('university_id', $univerties->pluck('id'));
        }

        // op st
        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
            $selected_university = $request->university;
        }
        //op end

        if ($request->degree) {
            $courses = $courses->where('degree_id', $request->degree);
            $selected_degree = $request->degree;
        }

        if ($request->language) {
            $courses = $courses->where('language_id', $request->language);
            $selected_language = $request->language;
        }
        if ($request->section) {
            $courses = $courses->where('section_id', $request->section);
            $selected_section = $request->section;
        }
        if ($request->subject) {
            $courses = $courses->where('department_id', $request->subject);
            $selected_subject = $request->subject;
        }

        if ($request->sortBy) {
            if ($request->sortBy == 'top_pick') {
                $courses = $courses->orderBy('views', 'desc');
            }
        } else {
            $courses = $courses->orderBy('views', 'desc');
        }

        if (($request->tuition_fees_min != '') && ($request->tuition_fees_max != '')) {
            $tuition_fees_min = convertToDefaultCurrency(request()->input('tuition_fees_min'));
            $tuition_fees_max = convertToDefaultCurrency(request()->input('tuition_fees_max'));

            $courses->whereBetween('year_fee', [$tuition_fees_min, $tuition_fees_max]);
        }

        if (($request->accommodation_fees_min != '') && ($request->accommodation_fees_max != '')) {
            $accommodation_fees_min = convertToDefaultCurrency(request()->input('accommodation_fees_min'));
            $accommodation_fees_max = convertToDefaultCurrency(request()->input('accommodation_fees_max'));

            $courses->whereBetween('accommodation_fee', [$accommodation_fees_min, $accommodation_fees_max]);
        }

        if (($request->service_charge_min != '') && ($request->service_charge_max != '')) {
            $service_charge_min = convertToDefaultCurrency(request()->input('service_charge_min'));
            $service_charge_max = convertToDefaultCurrency(request()->input('service_charge_max'));

            $courses->whereBetween('service_charge', [$service_charge_min, $service_charge_max]);
        }

        $data['selected_degree'] = $selected_degree;
        $data['selected_language'] = $selected_language;
        $data['selected_section'] = $selected_section;
        $data['selected_subject'] = $selected_subject;
        $data['selected_university'] = $selected_university;
        $data['courses'] = $courses = $courses->where('type', 'university')->paginate(10);

        return view('Frontend.university.ajax-course-filter', $data);
    }

    //ajax get Sort Category Course
    public function getAjaxCourseList(Request $request, $cat)
    {
        $courses = Course::query();

        $data['univerties'] = $univerties = University::get();
        $data['degrees'] = $degrees = Degree::get();
        $data['languages'] = $language = CourseLanguage::get();
        $data['departments'] = $departments = Department::get();
        $data['sections'] = $sections = Section::orderBy('id', 'desc')->get();
        $data['continents'] = $continents = Continent::withCount('universities')->where('status', 1)->get();
        $univerties = University::where('status', 1);

        if (request()->input('continent')) {
            $univerties = $univerties->where('continent_id', request()->input('continent'));
            $select_continent = request()->input('continent');
        } else {
            $select_continent = 0;
        }

        if (request()->input('country')) {
            $univerties = $univerties->where('country_id', request()->input('country'));
            $select_country = Country::find(request()->input('country'));
            if ($select_continent == 0) {
                $select_continent = $select_country->continent->id;
                $select_country = $select_country->id;
            } else {
                $select_country = $select_country->id;
            }
        } else {
            $select_country = 0;
        }
        $data['countries'] = $countries = Country::withCount('university')->where('continent_id', $select_continent)->where('status', 1)->get();

        if (request()->input('state')) {
            $univerties = $univerties->where('state_id', request()->input('state'));

            $select_state = State::find(request()->input('state'));
            if ($select_country == 0) {
                $select_country = $select_state->country->id;
                $select_state = $select_state->id;
            } else {
                $select_state = $select_state->id;
            }
        } else {
            $select_state = 0;
        }
        $data['states'] = $states = State::withCount('universities')->where('country_id', $select_country)->where('status', 1)->get();

        if (request()->input('city')) {
            $univerties = $univerties->where('city_id', request()->input('city'));

            $select_city = City::find(request()->input('city'));
            if ($select_state == 0) {
                $select_state = $select_city->state->id;
                $select_city = $select_city->id;
            } else {
                $select_city = $select_city->id;
            }
        } else {
            $select_city = 0;
        }

        $data['cities'] = $cities = City::withCount('universities')->where('state_id', $select_state)->where('status', 1)->get();

        $data['select_continent'] = $select_continent;
        $data['select_country'] = $select_country;
        $data['select_state'] = $select_state;
        $data['select_city'] = $select_city;
        $data['universities'] = $univerties->get();

        $selected_university = 0;
        $selected_degree = 0;
        $selected_language = 0;
        $selected_section = 0;
        $selected_subject = 0;

        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
        } else {
            $courses = $courses->whereIn('university_id', $univerties->pluck('id'));
        }

        // op st
        if ($request->university) {
            $courses = $courses->where('university_id', $request->university);
            $selected_university = $request->university;
        }
        //op end

        if ($request->degree) {
            $courses = $courses->where('degree_id', $request->degree);
            $selected_degree = $request->degree;
        }

        if ($request->language) {
            $courses = $courses->where('language_id', $request->language);
            $selected_language = $request->language;
        }
        if ($request->section) {
            $courses = $courses->where('section_id', $request->section);
            $selected_section = $request->section;
        }
        if ($request->subject) {
            $courses = $courses->where('department_id', $request->subject);
            $selected_subject = $request->subject;
        }

        if ($request->sortBy) {
            if ($request->sortBy == 'top_pick') {
                $courses = $courses->orderBy('views', 'desc');
            }
        } else {
            $courses = $courses->orderBy('views', 'desc');
        }

        $data['selected_degree'] = $selected_degree;
        $data['selected_language'] = $selected_language;
        $data['selected_section'] = $selected_section;
        $data['selected_subject'] = $selected_subject;
        $data['selected_university'] = $selected_university;
        $data['course_category'] = $cat;

        $data['courses'] = $courses = $courses->where('coursetype', $cat)
            ->where('type', 'university')->paginate(10);
        return view('Frontend.university.course_list_ajax', $data);
    }

    public function apply()
    {
        return view('Frontend.university.apply');
    }
}