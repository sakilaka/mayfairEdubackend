<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;

class noticeController extends Controller
{
    public function addNotice(){
        return view('backend.notice.addNotice');
    }

    public function storeNotice(Request $request){
        $notice = DB::table('notice')->insert(array([
            'notice'        => $request->notice,
            'name'          => $request->name,
            'description'   => $request->description,
            'status'        => $request->status,
            'created_at' => now(),
        ]));
        // dd($notice);
        return redirect()->route('viewNotice');
    }

    public function viewNotice(){

        $notice = DB::table('notice')->get();

        return view('backend.notice.manageNotice',compact('notice'));

    }

    public function editNotice($id){

        $editNotice = DB::table('notice')->where('id', $id)->get();


        return view('backend.notice.editNotice', compact('editNotice'));
    }

    public function updateNotice(Request $request,$id){



        $notice = DB::table('notice')
        ->where('id', $id)
        ->update(array(
            'notice' => $request->notice,
            'name' => $request->name,
            'description' => $request->description,
            'status'        => $request->status,
            'created_at' => now(),

        ));

        // echo $course;
        // // dd($course);

        return redirect()->route('viewNotice');

}

    public function deleteNotice($id){
        DB::table('notice')->where('id',$id)->delete();
        return redirect()->route('viewNotice');

    }

    public function updateNoticeStatus($id){
        $status = DB::table('notice')->where('id', $id)->first();

        if ($status->status == 'active') {

            DB::table('notice')->where('id', $id)->update(['status' => 'deactive']);

            return redirect('/viewNotice')->with('success', 'Status update Successfully');
        } else {

            DB::table('notice')->where('id', $id)->update(['status' => "active"]);

            return redirect('/viewNotice')->with('success', 'Status update Successfully');
        }
    }
}
