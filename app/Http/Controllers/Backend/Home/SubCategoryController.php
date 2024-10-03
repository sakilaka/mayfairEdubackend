<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["sub_categories"] = Category::where('parent_id', '!=', '')->where('is_sub', 0)->where('type', 'home')->orderBy('id', 'desc')->get();
        return view("Backend.home.sub_category.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["categories"] = Category::where('parent_id', '=', 0)->get();
        return view("Backend.home.sub_category.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sub_category = new Category();
        $sub_category->name = $request->name;
        $sub_category->parent_id = $request->categorie_id;
        $sub_category->template = $request->template;
        $sub_category->type = 'home';
        $sub_category->details = $request->details;

        $sub_category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        if ($request->hasFile('image')) {
            $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'), $fileName);
            $sub_category->image = $fileName;
        }
        $sub_category->save();
        return redirect()->route('home-sub-category.index')->with('success', 'Sub Category Added Successfully');
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
    public function edit($id)
    {
        $data["sub_categories"] = Category::find($id);
        $data["categories"] = Category::where('parent_id', '=', 0)->get();
        // $data["categories"] = Category::where('parent_id', '=', 0)->where('type', 'home')->get();
        return view("Backend.home.sub_category.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sub_category = Category::find($id);
        $sub_category->name = $request->name;
        $sub_category->parent_id = $request->categorie_id;
        $sub_category->template = $request->template;
        $sub_category->type = 'home';
        $sub_category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        $sub_category->details = $request->details;

        if ($request->hasFile('image')) {
            @unlink(public_path("upload/category/" . $sub_category->image));
            $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'), $fileName);
            $sub_category->image = $fileName;
        }
        $sub_category->save();

        return redirect()->route('home-sub-category.index')->with('success', 'Sub Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $sub_category = Category::find($request->subcategory_id);
            @unlink(public_path("upload/category/" . $sub_category->image));
            $sub_category->delete();
            return redirect(route('home-sub-category.index'))->with('success', 'Sub Category Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect(route('home-sub-category.index'))->with('error', 'Something Went Wrong!');
        }
    }

    //Status section
    public function status_toggle($id)
    {
        try {
            $sub_category = Category::find($id);
            if ($sub_category->status == 0) {
                $sub_category->status = 1;
            } elseif ($sub_category->status == 1) {
                $sub_category->status = 0;
            }
            $sub_category->update();
            return redirect(route('home-sub-category.index'))->with('success', 'Sub Category Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect(route('home-sub-category.index'))->with('error', 'Something Went Wrong!');
        }
    }
}
