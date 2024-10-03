<?php

namespace App\Http\Controllers\Backend\ServiceTab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ServiceTab;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceTabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['servicetabs'] = ServiceTab::orderBy('position', 'asc')->get();
        return view("Backend.home.servicetab.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["categorys"] = Category::where('type',"home")->where('parent_id', '=' ,0)->get();
        $data["sub_categories"] = Category::where('type',"home")->where('parent_id', '!=' ,0)->where('is_sub',0)->orderBy('position','asc')->get();
        return view("Backend.home.servicetab.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([
            'template' => 'required',
            'title' => 'required',
            'position' => 'required',
            'image' => 'required',
        ]);

        $servicetab = new ServiceTab();

        // if($request->child_category_id){
        //     $servicetab->category_id = $request->child_category_id;
        // }else{

        //     if($request->sub_category_id){
        //         $servicetab->category_id = $request->sub_category_id;
        //     }else{
        //         $servicetab->category_id = $request->category_id;
        //     }
        // }

        $servicetab->template = $request->template;
        $servicetab->title = $request->title;
        $servicetab->position = $request->position;

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/servicetab/'),$fileName);
            $servicetab->image = $fileName;
        }

        $servicetab->save();
        return redirect()->route('home-servicetab.index')->with('message','servicetab Add Successfully');
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
        $servicetab = ServiceTab::find($id);
        // if($servicetab->b_category->parent_id == 0){
        //     $data["cat_id"]=$servicetab->b_category->id;
        //     $data["sub_cat_id"]=0;
        //     $data["child_cat_id"]=0;
        //     $data["sub_categories"] = $servicetab->b_category->sub;
        //     $data["child_categories"] = [];
        // }else {
        //     if($servicetab->b_category->is_sub == 0){
        //         $data["cat_id"]=$servicetab->b_category->parent->id;
        //         $data["sub_cat_id"]=$servicetab->b_category->id;
        //         $data["child_cat_id"]=0;
        //         $data["sub_categories"] = $servicetab->b_category->parent->sub;
        //         $data["child_categories"] = $servicetab->b_category->sub;
        //     }else{

        //         $data["cat_id"]=$servicetab->b_category->parent->parent->id;
        //         $data["sub_cat_id"]=$servicetab->b_category->parent->id;
        //         $data["child_cat_id"]=$servicetab->b_category->id;
        //         $data["sub_categories"] = $servicetab->b_category->parent->parent->sub;
        //         //dd( $banner->category);
        //         $data["child_categories"] = $servicetab->b_category->parent->sub;

        //     }
        // }


        $data["servicetab"]=$servicetab;
        $data["categories"] = Category::where('type',"home")->where('parent_id',0)->get();

        return view("Backend.home.servicetab.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //dd($request->all());
         $request->validate([
            'template' => 'required',
            'title' => 'required',
            'position' => 'required',
            //'image' => 'required',
        ]);

        $servicetab = ServiceTab::find($id);
        // if($request->child_category_id){
        //     $servicetab->category_id = $request->child_category_id;
        // }else{

        //     if($request->sub_category_id){
        //         $servicetab->category_id = $request->sub_category_id;
        //     }else{
        //         $servicetab->category_id = $request->category_id;
        //     }
        // }

        $servicetab->title = $request->title;
        $servicetab->position = $request->position;
        $servicetab->template = $request->template;
        if($request->hasFile('image')){
            @unlink(public_path("upload/servicetab/".$servicetab->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/servicetab/'),$fileName);
            $servicetab->image = $fileName;
        }

        $servicetab->save();
        return redirect()->route('home-servicetab.index')->with('message','servicetab Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $servicetab= ServiceTab::find($request->servicetab_id);
        $path = public_path("upload/servicetab/".$servicetab->image);
        @unlink($path);

        $servicetab->delete();
        return redirect()->route('home-servicetab.index');

    }

    public function status_toggle($id)
    {
        $servicetab = ServiceTab::find($id);
        if($servicetab->status == 0)
        {
            $servicetab->status = 1;
        }elseif($servicetab->status == 1)
        {
            $servicetab->status = 0;
        }
        $servicetab->update();
        return redirect()->route('home-servicetab.index');
    }
}
