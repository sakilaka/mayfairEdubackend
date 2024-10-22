<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailsJob;
use App\Mail\SendExpoEmail;
use App\Models\Expo;
use App\Models\ExpoModule;
use App\Models\ExpoUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ExpoParticipantController extends Controller
{
    /**
     * manage expo users
     */
    public function expo_users(Request $request, $type)
    {
        if ($type == 'main') {
            if (($request->has('filter_participant')) && ($request->filter_participant !== 'all') && ($request->filter_participant !== null)) {
                $data['expo_users'] = ExpoUser::where('expo_id', $request->filter_participant)->latest()->paginate(50);
            } else {
                $data['expo_users'] = ExpoUser::latest()->paginate(50);
            }

            $data['filtered_expo'] = $request->filter_participant;
        } elseif ($type == 'site') {
            $data['expo_users'] = ExpoModule::latest()->paginate(50);
        } else {
            abort(404, 'Not Found');
        }

        $data['expos'] = Expo::all();
        return view('Backend.events.expo.users.index', $data);
    }

    /**
     * add expo participator
     */
    public function expo_add_participator()
    {
        $data['expos'] = Expo::all();
        return view('Backend.events.expo.users.add_participator', $data);
    }

    /**
     * store expo participator
     */
    public function expo_add_participator_store(Request $request, $type)
    {
        try {
            $image_url = null;
            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->path()));
                $image_url = 'data:' . $request->file('photo')->getMimeType() . ';base64,' . $image;
            }

            if ($type === 'main') {
                $expoUser = new ExpoUser();
                $expoUser->expo_id = $request->expo_id;
            } elseif ($type === 'site') {
                $expoUser = new ExpoModule();
            } else {
                abort(500, 'Server Error');
            }


            $expoUser->ticket_no = strtoupper(substr((string) Str::uuid(), 0, 8));
            $expoUser->id_type = $request->id_type;
            $expoUser->id_no = $request->id_no;
            $expoUser->first_name = $request->first_name;
            $expoUser->last_name = $request->last_name;
            $expoUser->photo = $image_url;
            $expoUser->nationality = $request->nationality;
            $expoUser->sex = $request->sex;
            $expoUser->dob = $request->dob;
            $expoUser->phone = $request->mobile;
            $expoUser->email = $request->email;
            $expoUser->password = Hash::make($request->password);
            $expoUser->profession = $request->profession;
            $expoUser->institution = $request->institution;
            $expoUser->program = $request->program;
            $expoUser->degree = $request->degree;
            $expoUser->save();

            return redirect(match ($type) {
                'main' => route('admin.expo.users', ['type' => $type]),
                'site' => route('admin.expo-site.users', ['type' => $type]),
                default => back(),
            })->with(['success' => 'Expo registration has been successful!']);
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with(['error' => 'Something Went Wrong!']);
        }
    }

    /**
     * download excel data
     */
    public function expo_download_data_excel(Request $request, $type)
    {
        if ($type === 'main') {
            $expoUser = ExpoUser::select([
                'ticket_no',
                'expo_id',
                'email',
                'first_name',
                'last_name',
                'nationality',
                'sex',
                'dob',
                'phone',
                'profession',
                'institution',
                'program',
                'degree',
            ])->get();
        } elseif ($type === 'site') {
            $expoUser = ExpoModule::select([
                'ticket_no',
                'email',
                'first_name',
                'last_name',
                'nationality',
                'sex',
                'dob',
                'phone',
                'profession',
                'institution',
                'program',
                'degree',
            ])->get();
        } else {
            abort(500, 'Server Error');
        }

        return $expoUser;
    }

    /**
     * view expo participant data
     */
    public function expo_view_participant(Request $request)
    {
        $ticketNo = $request->input('ticket_no');

        $participant = ExpoUser::where('ticket_no', $ticketNo)->first();
        if (!$participant) {
            $participant = ExpoModule::where('ticket_no', $ticketNo)->first();
        }

        if ($participant) {
            return response()->json($participant);
        } else {
            return response()->json(['error' => 'Participant not found'], 404);
        }
    }

    /**
     * send mail to participant
     */
    public function expo_send_mail(Request $request)
    {
        try {
            $data = [
                'subject' => $request->subject,
                'feedback' => $request->body,
            ];

            Mail::to($request->email)->send(new SendExpoEmail($data));

            return back()->with('success', 'Email has been sent!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong! Failed to sent email.');
        }
    }

    /**
     * send mail to all
     */
    public function expo_send_mail_all(Request $request)
    {
        try {
            $subject = $request->subject;
            $body = $request->body;

            SendEmailsJob::dispatch($subject, $body);

            return back()->with(['success' => 'Emails are being queued for sending to all recipients!', 'status' => 'success']);
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong! Failed to send email.');
        }
    }

    public function expo_start_queue_mail()
    {
        Artisan::call('queue:work --timeout=1800 --stop-when-empty');
    }
}
