<?php

namespace App\Http\Controllers\Backend\Hr_management\Rank;
use App\Http\Controllers\Controller;
use App\Models\Hrrank;
use Illuminate\Http\Request;

class HrrankController extends Controller
{
    public function home()
    {
        $rank=Hrrank::latest()->get();
        return view('Backend.Hr_management.Rank.Rank',compact('rank'));
    }

    public function add_rank(Request $request)
    {
        $request->validate([
            'rank_title' => 'required'
        ]);
        $rank = new Hrrank();
        $rank->hrrank_title = $request->rank_title;
        $rank->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function edit_rank($id)
    {
        $rank = Hrrank::find($id);
        return view('Backend.Hr_management.Rank.Update_rank', compact('rank'));
    }

    public function update_rank(Request $request)
    {
        $request->validate([
            'rank_id' => 'required',
            'rank_title' => 'required'
        ]);

        $rank = Hrrank::find($request->rank_id);
        $rank->hrrank_title = $request->rank_title;
        $rank->update();
        return redirect()->route('admin.rank.home')->with('success', 'Update Success');
    }

    public function delete_rank($id)
    {
        $rank = Hrrank::find($id);
        $rank->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
