<?php

namespace App\Http\Controllers\Backend\Hr_management\Brand;
use App\Http\Controllers\Controller;
use App\Models\Hrbrand;
use Illuminate\Http\Request;

class HrbrandController extends Controller
{
    public function home()
    {
        $brand=Hrbrand::latest()->get();
        return view('Backend.pages.Hr_management.Brand.Brand',compact('brand'));
    }

    public function add_brand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required'
        ]);
        $brand = new Hrbrand();
        $brand->brand = $request->brand_name;
        $brand->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function edit_brand($id)
    {
        $brand = Hrbrand::find($id);
        return view('Backend.pages.Hr_management.Brand.Update_brand', compact('brand'));
    }

    public function update_brand(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'brand_name' => 'required',
        ]);

        $overtime = Hrbrand::find($request->brand_id);
        $overtime->brand = $request->brand_name;
        $overtime->update();
        return redirect()->route('admin.brand.home')->with('success', 'Update Success');
    }

    public function delete_brand($id)
    {
        $brand = Hrbrand::find($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
    
}