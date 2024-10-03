<?php

namespace App\Http\Controllers\Backend\HR_management\Color;

use App\Http\Controllers\Controller;
use App\Models\Hrcolor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class HrcolorController extends Controller
{
    public function home(){
        $color=Hrcolor::latest()->get();
        return view('Backend.pages.Hr_management.Color.Color',compact('color'));
    }
    public function add_color(Request $request){
        $rules =[
            'color_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $size=new Hrcolor();
        $size->name = $request->color_name;
        $size->save();
        return redirect()->route('admin.color.home')->with('success', 'Add successfully');
    }
    public function edit_color($id){
        $color=Hrcolor::find($id);
        return view('Backend.pages.Hr_management.Color.Update_Color',compact('color'));
    }
    public function update_color(Request $request){
        $rules =[
            'color_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $color = Hrcolor::find($request->color_id);
        $color->name = $request->color_name;
        $color->update();
        return redirect()->route('admin.color.home')->with('success', 'Update successfully');
    }
    public function delete_color(Request $request, $id){
        $size = Hrcolor::find($id);
        $size->delete();
        return redirect()->route('admin.color.home')->with('success', 'Delete successfully');
    }
}