<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $data['exhibitors'] = University::where(['status' => 1, 'is_exhibitor' => true])->get();
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
            'time_from' => 'required',
            'time_to' => 'required',
            'place' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'date.required' => 'Please provide the date of the expo.',
            'time_from.required' => 'The expo start time is required.',
            'time_to.required' => 'The expo end time is required.',
            'place.required' => 'Please specify the place.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please fix the issue(s) first.')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'unique_id' => explode('-', uuid_create())[0],
                'title' => $request->title,
                'place' => $request->place ?? '',
                // 'universities' => json_encode($request->exhibitors) ?? '',
                // 'description' => $request->description,
                'location' => json_encode($request->location) ?? ''
            ];

            $dateTime = [
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
            ];
            $data['datetime'] = json_encode($dateTime);

            if ($request->additional_contents['pre_title']) {
                $data['additional_contents']['pre_title'] = $request->additional_contents['pre_title'];
            }

            if ($request->hasFile('banner')) {
                $fileName = rand() . time() . '.' . $request->banner->getClientOriginalExtension();
                $request->banner->move(public_path('upload/expo/'), $fileName);
                $data['banner'] = url('upload/expo/' . $fileName);
            }

            // Handling guest information
            /* $guests = [];
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
            $data['guests'] = json_encode($guests); */

            // Handling media partner logo
            /* if ($request->hasFile('media_partner_logo')) {
                $mediaPartnerLogo = [];
                foreach ($request->file('media_partner_logo') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/media_partner'), $fileName);
                    $mediaPartnerLogo[$key] = url('upload/expo/media_partner/' . $fileName);
                }
                $data['media_partner'] = json_encode($mediaPartnerLogo);
            } */

            // Handling video uploads
            /* if ($request->hasFile('video')) {
                $videos = [];
                foreach ($request->file('video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/video'), $fileName);
                    $videos[] = url('upload/expo/video/' . $fileName);
                }
                $data['videos'] = json_encode($videos);
            } */

            // Handling gallery images
            /* if ($request->hasFile('gallery_image')) {
                $galleryImages = [];
                foreach ($request->file('gallery_image') as $key => $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/gallery'), $fileName);
                    $galleryImages[$key] = url('upload/expo/gallery/' . $fileName);
                }
                $data['photos'] = json_encode($galleryImages);
            } */

            // Handling additional images
            if ($request->hasFile('additional_contents.nav_logo')) {
                $fileName = rand() . time() . '.' . $request->file('additional_contents.nav_logo')->getClientOriginalExtension();
                $request->file('additional_contents.nav_logo')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['nav_logo'] = url('upload/expo/' . $fileName);
            }

            if ($request->hasFile('additional_contents.hero_bg')) {
                $fileName = rand() . time() . '.' . $request->file('additional_contents.hero_bg')->getClientOriginalExtension();
                $request->file('additional_contents.hero_bg')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['hero_bg'] = url('upload/expo/' . $fileName);
            }

            if ($request->hasFile('additional_contents.why_should_attend')) {
                $fileName = rand() . time() . '.' . $request->file('additional_contents.why_should_attend')->getClientOriginalExtension();
                $request->file('additional_contents.why_should_attend')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['why_should_attend'] = url('upload/expo/' . $fileName);
            }

            if ($request->hasFile('additional_contents.organizerDetails.logo')) {
                $fileName = rand() . time() . '.' . $request->file('additional_contents.organizerDetails.logo')->getClientOriginalExtension();
                $request->file('additional_contents.organizerDetails.logo')->move(public_path('upload/expo/'), $fileName);
                $additionalContents['organizerDetails']['logo'] = url('upload/expo/' . $fileName);
            }

            if ($request->hasFile('additional_contents.co_organizerDetails.logo')) {
                $fileName = rand() . time() . '.' . $request->file('additional_contents.co_organizerDetails.logo')->getClientOriginalExtension();
                $request->file('additional_contents.co_organizerDetails.logo')->move(public_path('upload/expo/'), $fileName);
                $additionalContents['co_organizerDetails']['logo'] = url('upload/expo/' . $fileName);
            }

            $data['additional_contents']['organizerDetails']['name'] = $request['additional_contents']['organizerDetails']['name'];
            $data['additional_contents']['organizerDetails']['redirect_url'] = $request['additional_contents']['organizerDetails']['redirect_url'];
            $data['additional_contents']['organizerDetails']['details'] = $request['additional_contents']['organizerDetails']['details'];

            $data['additional_contents']['co_organizerDetails']['name'] = $request['additional_contents']['co_organizerDetails']['name'];
            $data['additional_contents']['co_organizerDetails']['redirect_url'] = $request['additional_contents']['co_organizerDetails']['redirect_url'];
            $data['additional_contents']['co_organizerDetails']['details'] = $request['additional_contents']['co_organizerDetails']['details'];

            $data['additional_contents']['why_should_attend']['contents'] = $request['additional_contents']['why_should_attend']['contents'];
            $data['additional_contents']['schedule'] = $request['additional_contents']['schedule'];

            $data['additional_contents'] = json_encode($data['additional_contents']);

            // Organizer, co-organizer, and supported_by fields
            $footerContents = [];
            $footerContents['organizer_name'] = $request->input('footer_contents.organizer_name');
            $footerContents['co_organizer_name'] = $request->input('footer_contents.co_organizer_name');
            $footerContents['supported_by'] = $request->input('footer_contents.supported_by');

            $socialTypes = $request->input('footer_contents.social.type');
            $socialTitles = $request->input('footer_contents.social.title');
            $socialUrls = $request->input('footer_contents.social.url');

            $footerContents['social'] = [
                'type' => $socialTypes,
                'title' => $socialTitles,
                'url' => $socialUrls
            ];

            if ($request->hasFile('footer_contents.organizerLogo')) {
                $fileName = rand() . '_organizer.' . $request->file('footer_contents.organizerLogo')->getClientOriginalExtension();
                $request->file('footer_contents.organizerLogo')->move(public_path('upload/expo/'), $fileName);
                $footerContents['organizerLogo'] = url('upload/expo/' . $fileName);
            }

            if ($request->hasFile('footer_contents.co_organizerLogo')) {
                $fileName = rand() . '_co_organizer.' . $request->file('footer_contents.co_organizerLogo')->getClientOriginalExtension();
                $request->file('footer_contents.co_organizerLogo')->move(public_path('upload/expo/'), $fileName);
                $footerContents['co_organizerLogo'] = url('upload/expo/' . $fileName);
            }

            $data['footer_contents'] = json_encode($footerContents);

            Expo::create($data);
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
        // return json_decode($data['expo']['additional_contents'], true);

        if (!$data['expo']) {
            return redirect()->back()->with('error', 'Expo Not Found!');
        }

        $data['exhibitors'] = University::where(['status' => 1, 'is_exhibitor' => true])->get();
        return view("Backend.events.expo.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'venue' => 'required',
            'address' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'date.required' => 'Please provide the date of the expo.',
            'time_from.required' => 'The expo start time is required.',
            'time_to.required' => 'The expo end time is required.',
            'venue.required' => 'Please specify the venue.',
            'address.required' => 'Please specify the venue location.',
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
                // 'universities' => json_encode($request->universities) ?? '',
                // 'description' => $request->description,
                'location' => json_encode($request->location) ?? ''
            ];

            $dateTime = [
                'date' => $request->date,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
            ];
            $data['datetime'] = json_encode($dateTime);

            $place = [
                'venue' => $request->venue,
                'address' => $request->address,
            ];
            $data['place'] = json_encode($place);

            if ($request->additional_contents['pre_title']) {
                $data['additional_contents']['pre_title'] = $request->additional_contents['pre_title'];
            }

            if ($request->hasFile('banner')) {
                if (!empty($expo->banner)) {
                    $oldBannerPath = parse_url($expo->banner, PHP_URL_PATH);
                    $oldBannerFullPath = public_path($oldBannerPath);

                    if (file_exists($oldBannerFullPath)) {
                        unlink($oldBannerFullPath);
                    }
                }

                $fileName = rand() . time() . '.' . $request->banner->getClientOriginalExtension();
                $request->banner->move(public_path('upload/expo/'), $fileName);
                $data['banner'] = url('upload/expo/' . $fileName);
            }

            // Handle guest information
            /* $guests = [];
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
            $data['guests'] = json_encode($guests); */

            // Handle new media partner logos from the request
            /* $mediaPartnerLogos = [];
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
            $data['media_partner'] = json_encode($mergedMediaPartnerLogos); */

            // Handling video uploads
            /* if ($request->hasFile('video')) {
                $videos = [];
                foreach ($request->file('video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/expo/video'), $fileName);
                    $videos[] = url('upload/expo/video/' . $fileName);
                }
                $data['videos'] = json_encode($videos);
            } */

            // Handle new gallery images from the request
            /* $galleryImages = [];
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
            $data['photos'] = json_encode($mergedGalleryImages); */

            // Handling additional contents
            $old_additional_contents = json_decode($expo['additional_contents'], true);

            if ($request->hasFile('additional_contents.nav_logo')) {
                if (!empty($old_additional_contents['nav_logo'])) {
                    $oldFilePath = parse_url($old_additional_contents['nav_logo'], PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . time() . '.' . $request->file('additional_contents.nav_logo')->getClientOriginalExtension();
                $request->file('additional_contents.nav_logo')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['nav_logo'] = url('upload/expo/' . $fileName);
            } else {
                $data['additional_contents']['nav_logo'] = $old_additional_contents['nav_logo'];
            }

            if ($request->hasFile('additional_contents.hero_bg')) {
                if (!empty($old_additional_contents['hero_bg'])) {
                    $oldFilePath = parse_url($old_additional_contents['hero_bg'], PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . time() . '.' . $request->file('additional_contents.hero_bg')->getClientOriginalExtension();
                $request->file('additional_contents.hero_bg')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['hero_bg'] = url('upload/expo/' . $fileName);
            } else {
                $data['additional_contents']['hero_bg'] = $old_additional_contents['hero_bg'];
            }

            if ($request->hasFile('additional_contents.why_should_attend.image')) {
                if (!empty($old_additional_contents['why_should_attend']['image'])) {
                    $oldFilePath = parse_url($old_additional_contents['why_should_attend']['image'], PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . time() . '.' . $request->file('additional_contents.why_should_attend.image')->getClientOriginalExtension();
                $request->file('additional_contents.why_should_attend.image')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['why_should_attend']['image'] = url('upload/expo/' . $fileName);
            } else {
                $data['additional_contents']['why_should_attend']['image'] = $old_additional_contents['why_should_attend']['image'];
            }

            if ($request->hasFile('additional_contents.organizerDetails.logo')) {
                if (!empty($old_additional_contents['organizerDetails']['logo'])) {
                    $oldFilePath = parse_url($old_additional_contents['organizerDetails']['logo'], PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . time() . '.' . $request->file('additional_contents.organizerDetails.logo')->getClientOriginalExtension();
                $request->file('additional_contents.organizerDetails.logo')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['organizerDetails']['logo'] = url('upload/expo/' . $fileName);
            } else {
                $data['additional_contents']['organizerDetails']['logo'] = $old_additional_contents['organizerDetails']['logo'] ?? '';
            }

            if ($request->hasFile('additional_contents.co_organizerDetails.logo')) {
                if (!empty($old_additional_contents['co_organizerDetails']['logo'])) {
                    $oldFilePath = parse_url($old_additional_contents['co_organizerDetails']['logo'], PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . time() . '.' . $request->file('additional_contents.co_organizerDetails.logo')->getClientOriginalExtension();
                $request->file('additional_contents.co_organizerDetails.logo')->move(public_path('upload/expo/'), $fileName);
                $data['additional_contents']['co_organizerDetails']['logo'] = url('upload/expo/' . $fileName);
            } else {
                $data['additional_contents']['co_organizerDetails']['logo'] = $old_additional_contents['co_organizerDetails']['logo'] ?? asset('frontend/images/No-image.jpg');
            }

            $data['additional_contents']['organizerDetails']['name'] = $request['additional_contents']['organizerDetails']['name'];
            $data['additional_contents']['organizerDetails']['redirect_url'] = $request['additional_contents']['organizerDetails']['redirect_url'];
            $data['additional_contents']['organizerDetails']['details'] = $request['additional_contents']['organizerDetails']['details'];

            $data['additional_contents']['co_organizerDetails']['name'] = $request['additional_contents']['co_organizerDetails']['name'];
            $data['additional_contents']['co_organizerDetails']['redirect_url'] = $request['additional_contents']['co_organizerDetails']['redirect_url'];
            $data['additional_contents']['co_organizerDetails']['details'] = $request['additional_contents']['co_organizerDetails']['details'];

            $data['additional_contents']['why_should_attend']['contents'] = $request['additional_contents']['why_should_attend']['contents'];
            $data['additional_contents']['schedule'] = $request['additional_contents']['schedule'];

            $data['additional_contents'] = json_encode($data['additional_contents'] ?? asset('frontend/images/No-image.jpg'));

            // Organizer, co-organizer, and supported_by fields
            $footerContents = [];
            $footerContents['organizer_name'] = $request->input('footer_contents.organizer_name');
            $footerContents['co_organizer_name'] = $request->input('footer_contents.co_organizer_name');
            $footerContents['supported_by'] = $request->input('footer_contents.supported_by');

            $socialTypes = $request->input('footer_contents.social.type');
            $socialTitles = $request->input('footer_contents.social.title');
            $socialUrls = $request->input('footer_contents.social.url');

            $footerContents['social'] = [
                'type' => $socialTypes,
                'title' => $socialTitles,
                'url' => $socialUrls
            ];

            $existing_footer_organizer_logo = json_decode($expo->footer_contents, true)['organizerLogo'] ?? '';
            if ($request->hasFile('footer_contents.organizerLogo')) {
                if (!empty($existing_footer_organizer_logo)) {
                    $oldFilePath = parse_url($existing_footer_organizer_logo, PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . '_organizer.' . $request->file('footer_contents.organizerLogo')->getClientOriginalExtension();
                $request->file('footer_contents.organizerLogo')->move(public_path('upload/expo/'), $fileName);
                $footerContents['organizerLogo'] = url('upload/expo/' . $fileName);
            } else {
                $footerContents['organizerLogo'] = $existing_footer_organizer_logo ?? asset('frontend/images/No-image.jpg');
            }

            $existing_footer_co_organizer_logo = json_decode($expo->footer_contents, true)['co_organizerLogo'] ?? '';
            if ($request->hasFile('footer_contents.co_organizerLogo')) {
                if (!empty($existing_footer_co_organizer_logo)) {
                    $oldFilePath = parse_url($existing_footer_co_organizer_logo, PHP_URL_PATH);
                    $oldFileFullPath = public_path($oldFilePath);
                    if (file_exists($oldFileFullPath)) {
                        unlink($oldFileFullPath);
                    }
                }

                $fileName = rand() . '_co_organizer.' . $request->file('footer_contents.co_organizerLogo')->getClientOriginalExtension();
                $request->file('footer_contents.co_organizerLogo')->move(public_path('upload/expo/'), $fileName);
                $footerContents['co_organizerLogo'] = url('upload/expo/' . $fileName);
            } else {
                $footerContents['co_organizerLogo'] = $existing_footer_co_organizer_logo ?? asset('frontend/images/No-image.jpg');
            }

            $data['footer_contents'] = json_encode($footerContents);

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

            // Delete additional contents images
            $additionalContents = json_decode($expo->additional_contents, true) ?? [];
            $keysToDelete = ['nav_logo', 'hero_bg', 'why_should_attend'];

            foreach ($keysToDelete as $key) {
                if (isset($additionalContents[$key]) && is_string($additionalContents[$key])) {
                    $oldImagePath = public_path(parse_url($additionalContents[$key], PHP_URL_PATH));
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            // Delete organizer and co-organizer logos
            if (isset($additionalContents['organizerDetails']['logo'])) {
                $oldOrganizerLogoPath = public_path(parse_url($additionalContents['organizerDetails']['logo'], PHP_URL_PATH));
                if (file_exists($oldOrganizerLogoPath)) {
                    unlink($oldOrganizerLogoPath);
                }
            }

            if (isset($additionalContents['co_organizerDetails']['logo'])) {
                $oldCoOrganizerLogoPath = public_path(parse_url($additionalContents['co_organizerDetails']['logo'], PHP_URL_PATH));
                if (file_exists($oldCoOrganizerLogoPath)) {
                    unlink($oldCoOrganizerLogoPath);
                }
            }

            // Delete the expo record
            $expo->delete();

            return back()->with('success', 'Expo Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
