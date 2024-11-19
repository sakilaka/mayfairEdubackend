<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["categories"] = Category::where('parent_id', '=', 0)->orderBy('id', 'desc')->get();
        return view("Backend.home.category.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.home.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->type = $request->type;
        $category->details = $request->details;
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        if ($request->hasFile('image')) {
            $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'), $fileName);
            $category->image = $fileName;
        }
        $category->save();

        return redirect()->route('home-category.index')->with('success', 'Category Added Successfully');
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
        $data["categorie"] = Category::find($id);
        return view("Backend.home.category.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->type = $request->type;
        $category->status = $request->status;
        $category->details = $request->details;
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        if ($request->hasFile('image')) {
            @unlink(public_path("upload/category/" . $category->image));
            $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/category/'), $fileName);
            $category->image = $fileName;
        }
        $category->save();

        return redirect()->route('home-category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $category = Category::find($request->category_id);
            @unlink(public_path("upload/category/" . $category->image));
            $category->delete();

            return redirect(route('home-category.index'))->with('success', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            return redirect(route('home-category.index'))->with('error', 'Something went wrong!');
        }
    }

    /**
     * Toggle status change
     */
    public function status_toggle($id)
    {
        try {
            $category = Category::find($id);
            if ($category->status == 0) {
                $category->status = 1;
            } elseif ($category->status == 1) {
                $category->status = 0;
            }
            $category->update();
            return redirect(route('home-category.index'))->with('success', 'Status Changed Successfully');
        } catch (\Exception $e) {
            return redirect(route('home-category.index'))->with('error', 'Something went wrong!');
        }
    }
}
