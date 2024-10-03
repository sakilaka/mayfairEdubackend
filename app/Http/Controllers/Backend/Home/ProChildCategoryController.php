<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class ProChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["pro_child_categorys"] = Category::where('type',"home")->where('parent_id', '!=' ,'')->where('is_sub',2)->get();
        return view("Backend.home.pro_child_category.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["child_categorys"] = Category::where('type',"home")->where('parent_id', '!=' ,'')->where('is_sub',1)->get();
        return view("Backend.home.pro_child_category.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $request->validate([
            'child_category_id' => 'required',
            'name' => 'required',
        ]);

        $pro_child_category = new Category();
        $pro_child_category->name = $request->name;
        $pro_child_category->parent_id = $request->child_category_id;
        $pro_child_category->is_sub = 2;
        // $sub_category->position = $request->position;
        $pro_child_category->details = $request->details;
        $pro_child_category->type = 'home';
        $pro_child_category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'),$fileName);
            $pro_child_category->image = $fileName;
        }

        $pro_child_category->save();
        return redirect()->route('home-pro-child-category.index')->with('message','Pro Child Category Add Successfully');
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
        $data["pro_child_category"]=Category::find($id);
        $data["child_categorys"] = Category::where('type',"home")->where('parent_id', '!=' ,'')->where('is_sub',1)->get();
        return view("Backend.home.pro_child_category.update",$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'child_category_id' => 'required',
            'name' => 'required',
        ]);

        $pro_child_category = Category::find($id);
        $pro_child_category->name = $request->name;
        $pro_child_category->parent_id = $request->child_category_id;
        $pro_child_category->is_sub = 2;
        // $sub_category->position = $request->position;
        $pro_child_category->type = 'home';
        $pro_child_category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        $pro_child_category->details = $request->details;
        if($request->hasFile('image')){
            @unlink(public_path("upload/category/".$pro_child_category->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'),$fileName);
            $pro_child_category->image = $fileName;
        }

        $pro_child_category->save();
        return redirect()->route('home-pro-child-category.index')->with('message','Pro Child Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $pro_child_category= Category::find($request->pro_child_category_id);
        @unlink(public_path("upload/category/".$pro_child_category->image));
        $pro_child_category->delete();
        return redirect()->route('home-pro-child-category.index');
    }

    //Status section
    public function status_toggle($id)
    {
        $pro_child_category = Category::find($id);
        if($pro_child_category->status == 0)
        {
            $pro_child_category->status = 1;
        }elseif($pro_child_category->status == 1)
        {
            $pro_child_category->status = 0;
        }
        $pro_child_category->update();
        return redirect()->route('home-pro-child-category.index');
    }
}
