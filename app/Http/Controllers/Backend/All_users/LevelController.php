<?php

namespace App\Http\Controllers\Backend\All_users;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $data['levels'] = Level::all();
        // $data['consultants'] = User::where('type', '7')->orderBy('id', 'desc')->get();
        return view("Backend.all_users.level.index", $data);
    }
    
    public function create()
    {
        return view("Backend.all_users.level.create");
    }
    
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $level = new Level;
            $level->star_value = $request->star_value;
            $level->eligibility_range_min = $request->eligibility_range_min;
            $level->eligibility_range_max = $request->eligibility_range_max;
            $level->save();
            
            DB::commit();
            return redirect()->route('admin.level.index')->with('success', 'Level Add Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data["level"] = $level = Level::find($id);
        return view("Backend.all_users.level.edit", $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            $level = Level::findOrFail($id);
            
            $level->star_value = $request->star_value;
            $level->eligibility_range_min = $request->eligibility_range_min;
            $level->eligibility_range_max = $request->eligibility_range_max;
            $level->save();
            
            DB::commit();
            return redirect()->route('admin.level.index')->with('success', 'Level Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $level =  Level::find($request->level_id);
            $level->delete();
            return back()->with('success', 'Level Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

}