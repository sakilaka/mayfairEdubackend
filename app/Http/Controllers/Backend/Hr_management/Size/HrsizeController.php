<?php

namespace App\Http\Controllers\Backend\HR_management\Size;

use App\Http\Controllers\Controller;
use App\Models\Hrsize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HrsizeController extends Controller
{
    public function home(){
        $size=Hrsize::latest()->get();
        return view('Backend.pages.Hr_management.Size.Size',compact('size'));
    }
    public function add_size(Request $request){
        $rules =[
            'size_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $size=new Hrsize();
        $size->name = $request->size_name;
        $size->save();
        return redirect()->route('admin.size.home')->with('success', 'Add successfully');
    }
    public function edit_size($id){
        //return $id;
        $size=Hrsize::find($id);
        return view('Backend.pages.Hr_management.Size.Update_Size',compact('size'));
    }
    public function update_size(Request $request){
        $rules =[
            'size_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect()->back()->with('error', $firstError);
        }
        $size = Hrsize::find($request->id);
        $size->name = $request->size_name;
        $size->save();

        return redirect()->route('admin.size.home')->with('success', 'Size updated successfully.');
    }
    public function delete_size(Request $request,$id){
        $size = Hrsize::find($id);
        $size->delete();
        return redirect()->route('admin.size.home')->with('success', 'Delete successfully');
    }
}