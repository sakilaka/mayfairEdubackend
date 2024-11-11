<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseCareerOutcome;
use App\Models\CourseConten;
use App\Models\CourseLanguage;
use App\Models\CourseLearn;
use App\Models\CourseLesson;
use App\Models\CourseLessonVideo;
use App\Models\CourseRequisite;
use App\Models\CourseSkill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['courses'] = Course::where('is_master', 1)->orderBy('id','desc')->get();
        return view("Backend.courses.master_course.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['teachers'] = User::where('type','2')->orderBy('id', 'desc')->get();
        $data["categorys"] = Category::where('parent_id', '=' ,0)->where('type','master_course')->get();
        // $data["sub_categories"] = Category::where('parent_id', '!=' ,0)->where('type','master_class')->where('is_sub',0)->orderBy('id', 'desc')->get();
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->where('status',1)->get();
        return view("Backend.courses.master_course.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
         $request->validate([
            // 'product_name' => 'required',
        ]);

        try{
            DB::beginTransaction();

        $course = New Course();
        $course->category_id = $request->category_id ?? 0;
        $course->teacher_id = $request->teacher_id ?? 0;
        $course->name = $request->name ?? "";
        $course->trailer_video_url = $request->trailer_video_url ?? "";
        $course->about = $request->about ?? "";
        $course->is_master = 1;

        // if($request->hasFile('image')){
        //     $fileName = rand().time().'_course_image.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/course/'),$fileName);
        //     $course->image = $fileName;
        // }

      $course->save();

        //CourseConten Start
        if($request->conten_name){
        // $conten_image=[];

        // foreach($request->file('conten_image') as $k=>$image){
        //     $filename=time().$k.'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('upload/conten_image/'), $filename);
        //     $conten_image[]=$filename;
        // }

        foreach( $request->conten_name as $k=>$value){
            $courseconten = new CourseConten();
            $courseconten->course_id = $course->id;
            $courseconten->name = $value;
            $courseconten->conten_url = $request->conten_url[$k];
            // $courseconten->conten_image = $conten_image[$k];
            $courseconten->save();
        }
    }
        //CourseConten End

        DB::commit();
        return redirect()->route('admin.master_course.index')->with('message','Course Create Successfully');
            }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            return back()->with ('error_message', $e->getMessage());
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
       // dd('hi');
        $data['course']=Course::find($id);
        $data['teachers'] = User::where('type','2')->orderBy('id', 'desc')->get();
        $data["categories"] = Category::where('parent_id', '=' ,0)->where('type','master_course')->get();
        // $data["sub_categories"] = Category::where('parent_id', '!=' ,0)->where('type','home')->where('is_sub',0)->orderBy('id', 'desc')->get();
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->where('status',1)->get();
        return view("Backend.courses.master_course.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            // 'product_name' => 'required',
        ]);

        try{
            DB::beginTransaction();

        $course = Course::find($id);
        // $car->slug = SlugService::createSlug(Car::class, 'slug', $request->name);
        $course->category_id = $request->category_id ?? 0;
        $course->teacher_id = $request->teacher_id ?? 0;
        $course->name = $request->name ?? "";
        $course->trailer_video_url = $request->trailer_video_url ?? "";
        $course->about = $request->about ?? "";
        $course->is_master = 1;

        // if($request->hasFile('image')){
        //     @unlink(public_path('upload/course/'.$course->image));
        //     $fileName = rand().time().'_course_image.'.request()->image->getClientOriginalExtension();
        //     request()->image->move(public_path('upload/course/'),$fileName);
        //     $course->image = $fileName;
        // }

      $course->save();



         //CourseConten Start

         if($request->conten_name){
            // $conten_image=[];
    
            // foreach($request->file('conten_image') as $k=>$image){
            //     $filename=time().$k.'.'.$image->getClientOriginalExtension();
            //     $image->move(public_path('upload/conten_image/'), $filename);
            //     $conten_image[]=$filename;
            // }
    
            foreach( $request->conten_name as $k=>$value){
                $courseconten = new CourseConten();
                $courseconten->course_id = $course->id;
                $courseconten->name = $value;
                $courseconten->conten_url = $request->conten_url[$k];
                // $courseconten->conten_image = $conten_image[$k];
                $courseconten->save();
            }
        }
        if($request->old_conten_name){
            foreach($request->old_conten_name as $k => $value){
                $courseconten = CourseConten::find($k);
                $courseconten->course_id = $course->id;
                $courseconten->name = $value;
                $courseconten->conten_url = $request->old_conten_url[$k];

                // if(isset($request->file('old_conten_image')[$k])){
                //     @unlink(public_path('upload/conten_image/'.$courseconten->conten_image));
                //     $filename=time().$k.'.'.$request->file('old_conten_image')[$k]->getClientOriginalExtension();
                //     $request->file('old_conten_image')[$k]->move(public_path('upload/conten_image/'), $filename);
                //     $courseconten->conten_image=$filename;
                // }

                $courseconten->save();
            }
        }

        if($request->delete_conten){
            foreach($request->delete_conten as $key => $value){
                $courseconten = CourseConten::find($value);
                $courseconten->delete();

            }
        }

         //CourseConten  End

        DB::commit();
        return redirect()->route('admin.master_course.index')->with('message','Course Update Successfully');
         }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            return back()->with ('error_message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
        $course = Course::find($request->course_id);
        // @unlink(public_path('upload/car/'.$car->image));

        foreach($course->course_content as $item){
            $item->delete();
        }

       


        $course->delete();
        return back()->with('message','Course Deleted Successfully');
    }
}
