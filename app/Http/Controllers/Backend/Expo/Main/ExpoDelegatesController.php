<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use Illuminate\Http\Request;

class ExpoDelegatesController extends Controller
{
    /**
     * index of respective expo delegates
     */
    public function expo_delegate_index($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('title', 'unique_id', 'delegates')->first();

        if (!$data['expo']) {
            return back()->with('error', 'Expo not found!');
        }

        return view('Backend.events.expo.main.delegates.index', $data);
    }

    /**
     * create or update page for respective expo delegate
     */
    public function expo_delegate_manage($expo_id, $delegate_key = null)
    {
        $data['expo'] = $expo = Expo::where('unique_id', $expo_id)->first();

        if (!$data['expo']) {
            return back()->with('error', 'Expo not found!');
        }

        $data['delegate_key'] = explode('-', uuid_create())[0];
        if ($delegate_key) {
            $data['delegate_key'] = $delegate_key;
        }

        return view('Backend.events.expo.main.delegates.manage', $data);
    }

    /**
     * update or create respective expo delegate
     */
    public function expo_delegate_update(Request $request, $expo_id, $delegate_key = null)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            $existingDelegates = json_decode($expo->delegates, true) ?? [];
            $finalData = [];
            $delegatePrefix = 'delegate';
            $delegatePath = 'expo/delegate/';

            foreach ($request->all() as $key => $delegateData) {
                if (strpos($key, $delegatePrefix) === 0) {
                    $uuidPart = explode('_', $key)[1];

                    $delegate = [
                        'name' => $delegateData['name'] ?? null,
                        'designation' => $delegateData['designation'] ?? null,
                        'organization_name' => $delegateData['organization_name'] ?? null,
                        'country' => $delegateData['country'] ?? null,
                        'photo' => null,
                    ];

                    $existingPhoto = null;
                    $existingPhotoPath = '';

                    if ($delegate_key && isset($existingDelegates[$delegate_key])) {
                        $existingPhoto = $existingDelegates[$delegate_key]['photo'] ?? null;

                        if ($existingPhoto) {
                            $existingPhotoPath = parse_url($existingPhoto, PHP_URL_PATH);
                            $existingPhotoPath = public_path($existingPhotoPath);
                        }
                    }

                    if ($request->hasFile("{$key}.photo")) {
                        if ($existingPhotoPath && file_exists($existingPhotoPath)) {
                            unlink($existingPhotoPath);
                        }

                        $photoFile = $request->file("{$key}.photo");
                        $photoName = 'user_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
                        $photoFile->move(public_path($delegatePath), $photoName);
                        $delegate['photo'] = asset($delegatePath . $photoName);
                    } else {
                        $delegate['photo'] = $existingPhoto;
                    }

                    if ($delegate_key && $uuidPart === $delegate_key) {
                        $existingDelegates[$uuidPart] = array_merge($existingDelegates[$uuidPart] ?? [], $delegate);
                    } else {
                        $finalData[$uuidPart] = $delegate;
                    }
                }
            }

            $finalData = array_merge($existingDelegates, $finalData);
            $expo->delegates = json_encode($finalData);
            $expo->save();

            return redirect(route('admin.expo.delegate.index', ['expo_id' => $expo->unique_id]))->with('success', 'Delegate has beed added successfully!');
        } catch (\Exception $e) {
            return redirect(route('admin.expo.delegate.index', ['expo_id' => $expo->unique_id]))->with('error', 'Something went wrong! Failed to add delegate.');
        }
    }

    /**
     * delete delegate of respective expo
     */
    public function expo_delegate_destroy($expo_id, $delegate_key)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();
            if (!$expo) {
                return redirect()->back()->with('error', 'Expo not found.');
            }

            $existingDelegates = json_decode($expo->delegates, true) ?? [];

            if (isset($existingDelegates[$delegate_key])) {
                $existingPhoto = $existingDelegates[$delegate_key]['photo'] ?? null;
                if ($existingPhoto) {
                    $existingPhotoPath = parse_url($existingPhoto, PHP_URL_PATH);
                    $existingPhotoPath = public_path($existingPhotoPath);

                    if (file_exists($existingPhotoPath)) {
                        unlink($existingPhotoPath);
                    }
                }

                unset($existingDelegates[$delegate_key]);

                $expo->delegates = json_encode($existingDelegates);
                $expo->save();

                return redirect()->back()->with('success', 'Delegate has been deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Delegate not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Failed to delete delegate.');
        }
    }
}
