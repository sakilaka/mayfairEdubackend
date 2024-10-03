<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data["categories"] = Category::where('type',"blog")->where('parent_id',0)->orderBy('position','asc')->get();
       return view("Backend.blog.category.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view("Backend.blog.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
         $request->validate([
            'name' => 'required',
            // 'position' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->position = $request->position;
        $category->color_code = $request->color_code;
        $category->type = 'blog';
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        if($request->hasFile('image')){
            $fileName = rand().time().'_blog_category.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'),$fileName);
            $category->icon = $fileName;
        }
        $category->save();
        return redirect()->route('phar-category.index')->with('message','Category Add Successfully');
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
        $data["categorie"] = Category::find($id);
        return view("Backend.blog.category.update",$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // $request->validate([
        //     'name' => 'required',
        //     'position' => 'required',
        // ]);

        $category= Category::find($id);
        $category->name = $request->name;
        $category->position = $request->position;
        $category->color_code = $request->color_code;
        $category->status = $request->status;
        $category->type = 'blog';
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        if($request->hasFile('image')){
            @unlink(public_path('upload/category/'.$category->icon));
            $fileName = rand().time().'_blog_category.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'),$fileName);
            $category->icon = $fileName;
        }
        $category->save();
        return redirect()->route('phar-category.index')->with('message','Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $category= Category::find($request->category_id);
         @unlink(public_path('upload/category/'.$category->icon));
        $category->delete();
        return back()->with('message','Category Delete Successfully');
    }
}
