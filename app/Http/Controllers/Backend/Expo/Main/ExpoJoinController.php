<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use Illuminate\Http\Request;

class ExpoJoinController extends Controller
{
    /**
     * manage media -> join - page
     */
    public function expo_join_page($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'join_page_contents')->first();
        return view('Backend.events.expo.main.join.index', $data);
    }

    /**
     * manage media -> join - page (update)
     */
    public function expo_join_page_update(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            // Initialize new contents
            $joinPageContents = [];
            $oldJoinPageContents = json_decode($expo->join_page_contents, true) ?? [];

            // Handle step titles and deadline
            $stepTitles = $request->step_title ?? [];
            $deadline = $request->deadline;

            $joinPageContents['steps'] = $stepTitles;
            $joinPageContents['deadline'] = $deadline;

            // Handle join contents
            $joinContents = $request->join_contents ?? [];
            $allJoinContents = [];

            foreach ($joinContents as $joinKey => $joinContent) {
                $joinData = [
                    'name' => $joinContent['name'],
                    'email' => $joinContent['email'],
                    'phone' => $joinContent['phone'],
                ];

                // Process references
                $referenceData = [];
                if (isset($joinContent['reference'])) {
                    foreach ($joinContent['reference'] as $refKey => $reference) {
                        $refData = [
                            'qr_code_type' => $reference['qr_code_type'] ?? '',
                        ];

                        // Handle QR code image upload
                        if ($request->hasFile("join_contents.$joinKey.reference.$refKey.image")) {
                            $qrFile = $request->file("join_contents.$joinKey.reference.$refKey.image");
                            $fileName = 'qr-code_' . rand() . time() . '.' . $qrFile->getClientOriginalExtension();
                            // $qrFile->move(public_path('upload/expo/qr_codes'), $fileName);
                            $refData['image'] = url('upload/expo/qr_codes/' . $fileName);
                        } else {
                            $refData['image'] = $reference['image'] ?? ''; // Retain the old image if not updated
                        }

                        $referenceData[$refKey] = $refData;
                    }
                }
return $referenceData;
                $joinData['reference'] = $referenceData;
                $allJoinContents[$joinKey] = $joinData;
            }

            // Merge old join contents if they exist
            if (isset($oldJoinPageContents['join_contents'])) {
                foreach ($oldJoinPageContents['join_contents'] as $oldJoinKey => $oldJoinContent) {
                    if (isset($allJoinContents[$oldJoinKey])) {
                        // Merge old references with new references
                        $mergedReferences = array_merge($oldJoinContent['reference'], $allJoinContents[$oldJoinKey]['reference']);

                        // Handle removing old images that are no longer present in the new data
                        foreach ($oldJoinContent['reference'] as $refKey => $oldReference) {
                            if (!isset($mergedReferences[$refKey]['image'])) {
                                $imagePath = public_path('upload/expo/qr_codes/' . basename($oldReference['image']));
                                if (file_exists($imagePath)) {
                                    unlink($imagePath);
                                }
                            }
                        }

                        // Merge old content with new
                        $allJoinContents[$oldJoinKey] = array_merge($oldJoinContent, $allJoinContents[$oldJoinKey]);
                    } else {
                        // If no new content exists for this key, retain old content
                        $allJoinContents[$oldJoinKey] = $oldJoinContent;
                    }
                }
            }

            $joinPageContents['join_contents'] = $allJoinContents;

            // Handle general QR code upload
            if ($request->hasFile('qr_code')) {
                $qrCodeFile = $request->file('qr_code');
                $qrFileName = 'general-qr-code_' . rand() . time() . '.' . $qrCodeFile->getClientOriginalExtension();
                // $qrCodeFile->move(public_path('upload/expo/qr_codes'), $qrFileName);
                $joinPageContents['qr_code'] = url('upload/expo/qr_codes/' . $qrFileName);
            } else {
                // Retain old QR code if no new file is uploaded
                $joinPageContents['qr_code'] = $oldJoinPageContents['qr_code'] ?? '';
            }

            return $joinPageContents;
            // Save the updated join page contents
            $expo->join_page_contents = json_encode($joinPageContents);
            $expo->save();

            return redirect(route('admin.expo.media.join', ['expo_id' => $expo->unique_id]))->with('success', 'Join Page Updated!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
