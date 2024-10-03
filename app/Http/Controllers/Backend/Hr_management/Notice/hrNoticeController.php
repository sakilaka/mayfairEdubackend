<?php
namespace App\Http\Controllers\Backend\Hr_management\Notice;
use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class hrNoticeController extends Controller
{
    public function home(){
        $notice=Notice::latest()->get();
        return view('Backend.Hr_management.Notice.notice',compact('notice'));
    }


    public function add_notice(Request $request)
    {
        $request->validate([
            'notice_type' => 'required',
            'notice_name' => 'required',
            'notice_status' => 'required',
            'notice_description' => 'required'
        ]);
        $notice = new Notice();
        $notice->notice_type = $request->notice_type;
        $notice->notice_name = $request->notice_name;
        $notice->notice_status = $request->notice_status;
        $notice->notice_description = $request->notice_description;
        $notice->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function edit_notice($id)
    {
        $notice = Notice::find($id);
        return view('Backend.Hr_management.Notice.Update_notice', compact('notice'));
    }

    public function update_notice(Request $request)
    {
        $request->validate([
            'notice_type' => 'required',
            'notice_name' => 'required',
            'notice_status' => 'required',
            'notice_description' => 'required'
        ]);

        $notice = Notice::find($request->notice_id);
        $notice->notice_type = $request->notice_type;
        $notice->notice_name = $request->notice_name;
        $notice->notice_status = $request->notice_status;
        $notice->notice_description = $request->notice_description;
        $notice->update();
        return redirect()->route('admin.notice.home')->with('success', 'Update Success');
    }


    public function delete_notice($id)
    {
        $designation = Notice::find($id);
        $designation->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
