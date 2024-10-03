<?php

namespace App\Http\Controllers\Backend\Hr_management\Quality;
use App\Http\Controllers\Controller;
use App\Models\Hrquality;
use Illuminate\Http\Request;

class HrqualityController extends Controller
{
    public function home()
    {
        $quality=Hrquality::latest()->get();
        return view('Backend.pages.Hr_management.Quality.Quality',compact('quality'));
    }

    public function add_quality(Request $request)
    {
        $request->validate([
            'quality_name' => 'required'
        ]);
        $quality = new Hrquality();
        $quality->name = $request->quality_name;
        $quality->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function edit_quality($id)
    {
        $quality = Hrquality::find($id);
        return view('Backend.pages.Hr_management.Quality.Update_quality', compact('quality'));
    }

    public function update_quality(Request $request)
    {
        $request->validate([
            'quality_id' => 'required',
            'quality_name' => 'required',
        ]);

        $quality = Hrquality::find($request->quality_id);
        $quality->name = $request->quality_name;
        $quality->update();
        return redirect()->route('admin.quality.home')->with('success', 'Update Success');
    }

    public function delete_quality($id)
    {
        $quality = Hrquality::find($id);
        $quality->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
    
}