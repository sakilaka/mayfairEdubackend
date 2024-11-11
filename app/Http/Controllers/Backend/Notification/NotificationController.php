<?php

namespace App\Http\Controllers\Backend\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data['notifications'] = Notification::get();
        return view("Backend.notification.index", $data);
    }

    public function destroy(Request $request)
    {
        try {
            $notification = Notification::find($request->notification_id);
            $notification->delete();
            return redirect()->route('admin.all.notification.index')->with('success', 'Notification Deleted Successfull!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.all.notification.index')->with('error', 'Something Went Wrong!');
        }
    }

    public function allNotification(Request $request)
    {
        $data['notifications'] = Notification::where('user_id', auth()->guard('admin')->user()->id)->orderBy('id', 'desc')->paginate(12);
        return view("Backend.notification.all-notification", $data);
    }

    //ajax get notification
    public function getBackendNotification()
    {
        $data['notifications'] = Notification::where('user_id', auth()->guard('admin')->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('Backend.notification.ajaxseemorenotification', $data);
    }
}
