<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sliders'] = Slider::where('type','home')->orderBy('id', 'desc')->get();
        return view("Backend.home.slider.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["categorys"] = Category::where('type',"home")->where('parent_id', '=' ,0)->get();
        $data["sub_categories"] = Category::where('type',"home")->where('parent_id', '!=' ,0)->where('is_sub',0)->orderBy('position','asc')->get();
        return view("Backend.home.slider.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'category_id' => 'required',
            // 'title' => 'required',
            'image' => 'required',
        ]);

        $slider = new Slider();

        if($request->child_category_id){
            $slider->category_id = $request->child_category_id;
        }else{

            if($request->sub_category_id){
                $slider->category_id = $request->sub_category_id;
            }else{
                $slider->category_id = $request->category_id;
            }
        }

        // $slider->title = $request->title ?? "";
        $slider->type = 'home';

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/slider/'),$fileName);
            $slider->image = $fileName;
        }

        $slider->save();
        return redirect()->route('home-slider.index')->with('message','slider Add Successfully');
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
        $slider = Slider::find($id);
        if($slider->b_category->parent_id == 0){
            $data["cat_id"]=$slider->b_category->id;
            $data["sub_cat_id"]=0;
            $data["child_cat_id"]=0;
            $data["sub_categories"] = $slider->b_category->sub;
            $data["child_categories"] = [];
        }else {
            if($slider->b_category->is_sub == 0){
                $data["cat_id"]=$slider->b_category->parent->id;
                $data["sub_cat_id"]=$slider->b_category->id;
                $data["child_cat_id"]=0;
                $data["sub_categories"] = $slider->b_category->parent->sub;
                $data["child_categories"] = $slider->b_category->sub;
            }else{

                $data["cat_id"]=$slider->b_category->parent->parent->id;
                $data["sub_cat_id"]=$slider->b_category->parent->id;
                $data["child_cat_id"]=$slider->b_category->id;
                $data["sub_categories"] = $slider->b_category->parent->parent->sub;
                //dd( $slider->category);
                $data["child_categories"] = $slider->b_category->parent->sub;

            }
        }


        $data["slider"]=$slider;
        $data["categories"] = Category::where('type',"home")->where('parent_id',0)->get();

        return view("Backend.home.slider.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          //dd($request->all());
        $request->validate([
            'category_id' => 'required',
            // 'title' => 'required',
            //'image' => 'required',
        ]);

        $slider = Slider::find($id);

        if($request->child_category_id){
            $slider->category_id = $request->child_category_id;
        }else{

            if($request->sub_category_id){
                $slider->category_id = $request->sub_category_id;
            }else{
                $slider->category_id = $request->category_id;
            }
        }

        // $slider->title = $request->title ?? '';
        $slider->type = 'home';

        if($request->hasFile('image')){
            @unlink(public_path("upload/slider/".$slider->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/slider/'),$fileName);
            $slider->image = $fileName;
        }

        $slider->save();
        return redirect()->route('home-slider.index')->with('message','slider Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slider= Slider::find($request->slider_id);
        $path = public_path("upload/slider/".$slider->image);
        @unlink($path);

        $slider->delete();
        return redirect()->route('home-slider.index');
    }

    public function status_toggle($id)
    {
        $slider = Slider::find($id);
        if($slider->status == 0)
        {
            $slider->status = 1;
        }elseif($slider->status == 1)
        {
            $slider->status = 0;
        }
        $slider->update();
        return redirect()->route('home-slider.index');
    }
}
