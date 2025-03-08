<?php

namespace App\Http\Controllers\Backend\subscriber;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribedMail;

class SubscriberController extends Controller
{
    public $emailData = [];

    public function index()
    {
        return view('Backend.subscriber.index', ['subscribers' => Subscriber::all()]);
    }

    public function add_subscription(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:subscribers,email',
            ]);

            // Save new subscriber
            $subscription = new Subscriber();
            $subscription->email = $request->email;
            $subscription->save();

            // Send confirmation email
            Mail::to($subscription->email)->send(new SubscribedMail([
                'message' => 'You are Subscribed Successfully, Thank You.',
            ]));

            return response()->json(['message' => 'Subscribed Successfully, Thank you.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Subscription failed. Please try again.'], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            Subscriber::find($request->subscriber_id)->delete();
            return back()->with('success', 'Subscriber Deleted Successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
