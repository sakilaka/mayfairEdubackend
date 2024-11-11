<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["child_categorys"] = Category::where('type',"home")->where('parent_id', '!=' ,'')->where('is_sub',1)->orderBy('position','asc')->get();
        return view("Backend.home.child_category.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["sub_categorys"] = Category::where('type',"home")->where('parent_id', '!=' ,'')->where('is_sub',0)->orderBy('position','asc')->get();
        return view("Backend.home.child_category.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'sub_category_id' => 'required',
            'name' => 'required',
        ]);

        $sub_category = new Category();
        $sub_category->name = $request->name;
        $sub_category->parent_id = $request->sub_category_id;
        $sub_category->is_sub = 1;
        // $sub_category->position = $request->position;
        $sub_category->details = $request->details;
        $sub_category->type = 'home';
        $sub_category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'),$fileName);
            $sub_category->image = $fileName;
        }

        $sub_category->save();
        return redirect()->route('home-child-category.index')->with('message','Child Category Add Successfully');
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
        $data["child_category"]=Category::find($id);
        $data["sub_categorys"] = Category::where('type',"home")->where('parent_id', '!=' ,'')->where('is_sub',0)->orderBy('position','asc')->get();
        return view("Backend.home.child_category.update",$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'sub_category_id' => 'required',
            'name' => 'required',
        ]);

        $sub_category = Category::find($id);
        $sub_category->name = $request->name;
        $sub_category->parent_id = $request->sub_category_id;
        $sub_category->is_sub = 1;
        // $sub_category->position = $request->position;
        $sub_category->type = 'home';
        $sub_category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        $sub_category->details = $request->details;
        if($request->hasFile('image')){
            @unlink(public_path("upload/category/".$sub_category->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'),$fileName);
            $sub_category->image = $fileName;
        }

        $sub_category->save();
        return redirect()->route('home-child-category.index')->with('message','Child Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $child_category= Category::find($request->child_category_id);
        @unlink(public_path("upload/category/".$child_category->image));
        $child_category->delete();
        return redirect()->route('home-child-category.index');
    }

    //Status section
    public function status_toggle($id)
    {
        $child_category = Category::find($id);
        if($child_category->status == 0)
        {
            $child_category->status = 1;
        }elseif($child_category->status == 1)
        {
            $child_category->status = 0;
        }
        $child_category->update();
        return redirect()->route('home-child-category.index');
    }
}
