<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use App\Jobs\SendBatchEmailsJob;
use App\Jobs\SendEmailsJob;
use App\Mail\SendExpoEmail;
use App\Mail\SendExpoEmailAll;
use App\Models\Expo;
use App\Models\ExpoModule;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ExpoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['expos'] = Expo::latest()->get();
        return view("Backend.events.expo.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['universities'] = University::where('status', 1)->get();
        return view("Backend.events.expo.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'place' => 'required',
            'location[]' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'date.required' => 'Please provide the date of the expo.',
            'time.required' => 'The expo time is required.',
            'place.required' => 'Please specify the place.',
            'location[].required' => 'You need to select a location.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please fix the issue(s) first.')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'title' => $request->title,
                'datetime' => date('d M, Y', strtotime($request->date)) . ' ' . date('h:i A', strtotime($request->time)),
                'place' => $request->place ?? '',
                'universities' => json_encode($request->universities) ?? '',
                'description' => $request->description,
                'location' => json_encode($request->location) ?? ''
            ];

            if ($request->hasFile('banner')) {
                $fileName = rand() . time() . '.' . $request->banner->getClientOriginalExtension();
                $request->banner->move(public_path('upload/expo/'), $fileName);
                $data['banner'] = url('upload/expo/' . $fileName);
            }

            // Handling guest information
            $guests = [];
            if ($request->guestName && $request->guestDesignation && $request->guestOrganization) {
                $guestImages = [];
                $imageKeys = [];

                if ($request->hasFile('guestImage')) {
                    foreach ($request->file('guestImage') as $key => $file) {
                        $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('upload/expo/guest'), $fileName);
                        $guestImages[$key] = url('upload/expo/guest/' . $fileName);
                        $imageKeys[] = $key;
                    }
                }

                $totalGuests = count($request->guestName);

                for ($i = 0; $i < $totalGuests; $i++) {
                    $key = $imageKeys[$i] ?? null;
                    $guests[$key ?? rand(10000, 99999)] = [
                        'name' => $request->guestName[$i],
                        'designation' => $request->guestDesignation[$i],
                        'organization' => $request->guestOrganization[$i],
                        'image' => $guestImages[$key] ?? null
                    ];
                }
            }
            $data['guests'] = json_encode($guests);

            // Handling media partner logo
            if ($request->hasFile('media_partner_logo')) {
                $mediaPartnerLogo = [];
                foreach ($request->file('media_partner_logo') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/media_partner'), $fileName);
                    $mediaPartnerLogo[$key] = url('upload/expo/media_partner/' . $fileName);
                }
                $data['media_partner'] = json_encode($mediaPartnerLogo);
            }

            // Handling video uploads
            if ($request->hasFile('video')) {
                $videos = [];
                foreach ($request->file('video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/video'), $fileName);
                    $videos[] = url('upload/expo/video/' . $fileName);
                }
                $data['videos'] = json_encode($videos);
            }

            // Handling gallery images
            if ($request->hasFile('gallery_image')) {
                $galleryImages = [];
                foreach ($request->file('gallery_image') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/gallery'), $fileName);
                    $galleryImages[$key] = url('upload/expo/gallery/' . $fileName);
                }
                $data['photos'] = json_encode($galleryImages);
            }

            // Expo::create($data);
            return redirect(route('admin.expo.index'))->with('success', 'Expo Created Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['expo'] = Expo::find($id);

        if (!$data['expo']) {
            return redirect()->back()->with('error', 'Expo Not Found!');
        }

        $data['universities'] = University::where('status', 1)->get();

        return view("Backend.events.expo.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'place' => 'required',
            'location[]' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'date.required' => 'Please provide the date of the expo.',
            'time.required' => 'The expo time is required.',
            'place.required' => 'Please specify the place.',
            'location[].required' => 'You need to select a location.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please fix the issue(s) first.')
                ->withErrors($validator)
                ->withInput();
        }

        $expo = Expo::find($id);

        if (!$expo) {
            return redirect()->back()->with('error', 'Expo not found!');
        }

        try {
            $data = [
                'title' => $request->title,
                'datetime' => date('d M, Y', strtotime($request->date)) . ' ' . date('h:i A', strtotime($request->time)),
                'place' => $request->place ?? '',
                'universities' => json_encode($request->universities) ?? '',
                'description' => $request->description,
                'location' => json_encode($request->location) ?? ''
            ];

            if ($request->hasFile('banner')) {
                $fileName = rand() . time() . '.' . $request->banner->getClientOriginalExtension();
                $request->banner->move(public_path('upload/expo/'), $fileName);
                $data['banner'] = url('upload/expo/' . $fileName);
            }

            // Handle guest information
            $guests = [];
            if ($request->guestName && $request->guestDesignation && $request->guestOrganization) {
                $guestImages = [];
                $imageKeys = [];
                $guestKeys = [];

                foreach (json_decode($expo->guests, true) as $key => $guest) {
                    $guestKeys[] = $key;
                }

                if ($request->hasFile('guestImage')) {
                    foreach ($request->file('guestImage') as $key => $file) {
                        $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('upload/expo/guest'), $fileName);
                        $guestImages[$key] = url('upload/expo/guest/' . $fileName);
                        $imageKeys[] = $key;
                    }
                }

                $oldGuestImages = $request->oldGuestImage ?? [];
                $mergedGuestImages = $oldGuestImages;

                foreach ($guestImages as $key => $url) {
                    $mergedGuestImages[$key] = $url;
                }

                $totalGuests = count($request->guestName);

                for ($i = 0; $i < $totalGuests; $i++) {
                    $key = $guestKeys[$i] ?? null;

                    $guests[$key ?? rand(10000, 99999)] = [
                        'name' => $request->guestName[$i],
                        'designation' => $request->guestDesignation[$i],
                        'organization' => $request->guestOrganization[$i],
                        'image' => $mergedGuestImages[$key] ?? null
                    ];
                }
            }
            $data['guests'] = json_encode($guests);

            // Handle new media partner logos from the request
            $mediaPartnerLogos = [];
            if ($request->hasFile('media_partner_logo')) {
                foreach ($request->file('media_partner_logo') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/media_partner'), $fileName);
                    $mediaPartnerLogos[$key] = url('upload/expo/media_partner/' . $fileName);
                }
            }

            $oldMediaPartnerLogos = $request->old_media_partner_logo ?? [];
            $mergedMediaPartnerLogos = $oldMediaPartnerLogos;

            foreach ($mediaPartnerLogos as $key => $url) {
                $mergedMediaPartnerLogos[$key] = $url;
            }
            $data['media_partner'] = json_encode($mergedMediaPartnerLogos);

            // Handling video uploads
            if ($request->hasFile('video')) {
                $videos = [];
                foreach ($request->file('video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/video'), $fileName);
                    $videos[] = url('upload/expo/video/' . $fileName);
                }
                $data['videos'] = json_encode($videos);
            }

            // Handle new gallery images from the request
            $galleryImages = [];
            if ($request->hasFile('gallery_image')) {
                foreach ($request->file('gallery_image') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/gallery'), $fileName);
                    $galleryImages[$key] = url('upload/expo/gallery/' . $fileName);
                }
            }

            $oldGalleryImages = $request->old_gallery_image ?? [];
            $mergedGalleryImages = $oldGalleryImages;

            foreach ($galleryImages as $key => $url) {
                $mergedGalleryImages[$key] = $url;
            }
            $data['photos'] = json_encode($mergedGalleryImages);

            $expo->update($data);
            return redirect(route('admin.expo.index'))->with('success', 'Expo Updated Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $expo = Expo::find($request->expo_id);

            if (!$expo) {
                return back()->with('error', 'Expo not found!');
            }

            // Delete associated files
            if ($expo->banner) {
                $oldBannerPath = public_path(parse_url($expo->banner, PHP_URL_PATH));
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }

            // Delete guest images
            $guests = json_decode($expo->guests, true) ?? [];
            foreach ($guests as $guest) {
                if (isset($guest['image'])) {
                    $oldGuestImagePath = public_path(parse_url($guest['image'], PHP_URL_PATH));
                    if (file_exists($oldGuestImagePath)) {
                        unlink($oldGuestImagePath);
                    }
                }
            }

            // Delete media partner logo
            $mediaPartnerLogo = json_decode($expo->media_partner, true) ?? [];
            foreach ($mediaPartnerLogo as $image) {
                $oldImagePath = public_path(parse_url($image, PHP_URL_PATH));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Delete video files
            $videos = json_decode($expo->videos, true) ?? [];
            foreach ($videos as $video) {
                $oldVideoPath = public_path(parse_url($video, PHP_URL_PATH));
                if (file_exists($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            // Delete gallery images
            $galleryImages = json_decode($expo->photos, true) ?? [];
            foreach ($galleryImages as $image) {
                $oldImagePath = public_path(parse_url($image, PHP_URL_PATH));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Delete the expo record
            $expo->delete();

            return back()->with('success', 'Expo Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * index of exhibitors
     */
    public function exhibitors_index()
    {
        $universities = University::all();

        $data['available_universities'] = $universities->where('is_exhibitor', false)->sortByDesc('created_at');
        $data['exhibitors'] = $universities->where('is_exhibitor', true)->sortByDesc('created_at');

        return view('Backend.events.expo.exhibitor.index', $data);
    }

    /**
     * add exhibitor
     */
    public function exhibitors_store(Request $request)
    {
        try {
            foreach ($request->university_id as $university_id) {
                $university = University::find($university_id);

                if ($university) {
                    $university->is_exhibitor = true;
                    $university->save();
                }
            }

            return back()->with('success', 'Selected universities have been marked as exhibitors!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * delete exhibitor
     */
    public function exhibitors_destroy(Request $request)
    {
        try {
            $university = University::find($request->exhibitor_id);

            if ($university) {
                $university->is_exhibitor = null;
                $university->save();

                return back()->with('success', $university->name . ' has been removed from exhibitors list!');
            } else {
                return back()->with('error', 'University not found!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * toggle show in expo
     */
    public function exhibitors_toggle_show_in_expo($exhibitor_id)
    {
        $exhibitor = University::find($exhibitor_id);

        if ($exhibitor) {
            $current_status = $exhibitor->show_in_expo;

            if ($current_status != 1) {
                $exhibitor->show_in_expo = 1;
                $message = $exhibitor->name . ' is now being shown in the expo.';
            } else {
                $exhibitor->show_in_expo = 0;
                $message = $exhibitor->name . ' is no longer being shown in the expo.';
            }

            $exhibitor->save();

            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Exhibitor not found or something went wrong!');
        }
    }

    /**
     * change exhibitor position in expo
     */
    public function exhibitors_postion_in_expo(Request $request)
    {
        try {
            $exhibitor = University::where(['id' => $request->exhibitor_id, 'is_exhibitor' => true])->first();
            $exhibitor->position_in_expo = $request->current_position;
            $exhibitor->save();

            return redirect()->back()->with('success', 'Exhibitor position has changed!');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }


    /**
     * manage expo users
     */
    public function expo_users()
    {
        $data['expo_users'] = ExpoModule::latest()->paginate(50);
        return view('Backend.events.expo.users.index', $data);
    }

    /**
     * add expo participator
     */
    public function expo_add_participator()
    {
        return view('Backend.events.expo.users.add_participator');
    }

    /**
     * store expo participator
     */
    public function expo_add_participator_store(Request $request)
    {
        try {
            // Create an user account
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile' => $request->mobile,
            ]);

            $image_url = null;
            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->path()));
                $image_url = 'data:' . $request->file('photo')->getMimeType() . ';base64,' . $image;
            }

            $expoModule = new ExpoModule();
            $expoModule->ticket_no = strtoupper(substr((string) Str::uuid(), 0, 8));
            $expoModule->user_id = $user->id;
            $expoModule->id_type = $request->id_type;
            $expoModule->id_no = $request->id_no;
            $expoModule->first_name = $request->first_name;
            $expoModule->last_name = $request->last_name;
            $expoModule->photo = $image_url;
            $expoModule->nationality = $request->nationality;
            $expoModule->sex = $request->sex;
            $expoModule->dob = $request->dob;
            $expoModule->phone = $request->mobile;
            $expoModule->email = $request->email;
            $expoModule->profession = $request->profession;
            $expoModule->institution = $request->institution;
            $expoModule->program = $request->program;
            $expoModule->degree = $request->degree;
            $expoModule->save();

            return redirect(route('admin.expo.users'))->with(['success' => 'Expo registration has been successful!']);
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with(['error' => 'Something Went Wrong!']);
        }
    }

    /**
     * view expo participant data
     */
    public function expo_view_participant(Request $request)
    {
        $ticketNo = $request->input('ticket_no');

        $participant = ExpoModule::where('ticket_no', $ticketNo)->first();

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
