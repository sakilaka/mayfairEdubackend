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
    /* public function expo_join_page_update(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            $joinPageContents = [];
            $oldJoinPageContents = json_decode($expo->join_page_contents, true) ?? [];

            $stepTitles = $request->step_title ?? [];
            $deadline = $request->deadline;

            $joinPageContents['steps'] = $stepTitles;
            $joinPageContents['deadline'] = $deadline;

            if ($request->hasFile('qr_code')) {
                $qrCodeFile = $request->file('qr_code');
                $qrFileName = 'general-qr-code_' . rand() . time() . '.' . $qrCodeFile->getClientOriginalExtension();
                $qrCodeFile->move(public_path('upload/expo/qr_codes'), $qrFileName);
                $joinPageContents['qr_code'] = url('upload/expo/qr_codes/' . $qrFileName);
            } else {
                $joinPageContents['qr_code'] = $oldJoinPageContents['qr_code'] ?? '';
            }

            $joinContents = $request->join_contents ?? [];
            $allJoinContents = [];

            foreach ($joinContents as $joinKey => $joinContent) {
                $joinData = [
                    'name' => $joinContent['name'],
                    'email' => $joinContent['email'],
                    'phone' => $joinContent['phone'],
                ];

                $referenceData = [];
                if (isset($joinContent['reference'])) {
                    foreach ($joinContent['reference'] as $refKey => $reference) {
                        $refData = [
                            'qr_code_type' => $reference['qr_code_type'] ?? '',
                        ];

                        if ($request->hasFile("join_contents.$joinKey.reference.$refKey.image")) {
                            $qrFile = $request->file("join_contents.$joinKey.reference.$refKey.image");
                            $fileName = 'qr-code_' . rand() . time() . '.' . $qrFile->getClientOriginalExtension();
                            $qrFile->move(public_path('upload/expo/qr_codes'), $fileName);
                            $refData['image'] = url('upload/expo/qr_codes/' . $fileName);
                        } else {
                            if (isset($oldJoinPageContents['join_contents'][$joinKey]['reference'][$refKey]['image'])) {
                                $refData['image'] = $oldJoinPageContents['join_contents'][$joinKey]['reference'][$refKey]['image'];
                            } else {
                                $refData['image'] = '';
                            }
                        }

                        $referenceData[$refKey] = $refData;
                    }
                }

                $joinData['reference'] = $referenceData;
                $allJoinContents[$joinKey] = $joinData;
            }

            if (isset($oldJoinPageContents['join_contents'])) {
                foreach ($oldJoinPageContents['join_contents'] as $oldJoinKey => $oldJoinContent) {
                    if (isset($allJoinContents[$oldJoinKey])) {
                        foreach ($oldJoinContent['reference'] as $refKey => $oldReference) {
                            if (!isset($allJoinContents[$oldJoinKey]['reference'][$refKey]['image']) || empty($allJoinContents[$oldJoinKey]['reference'][$refKey]['image'])) {
                                $allJoinContents[$oldJoinKey]['reference'][$refKey]['image'] = $oldReference['image'];
                            }
                        }
                        $allJoinContents[$oldJoinKey] = array_merge($oldJoinContent, $allJoinContents[$oldJoinKey]);
                    } else {
                        $allJoinContents[$oldJoinKey] = $oldJoinContent;
                    }
                }
            }

            $joinPageContents['join_contents'] = $allJoinContents;
            $expo->update(['join_page_contents' => json_encode($joinPageContents)]);

            return redirect(route('admin.expo.join.index', ['expo_id' => $expo->unique_id]))->with('success', 'Join Page Updated!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } */

    public function expo_join_page_update(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();
            $joinPageContents = [];
            $oldJoinPageContents = json_decode($expo->join_page_contents, true) ?? [];

            // Initialize join page contents with steps and deadline
            $stepTitles = $request->step_title ?? [];
            $deadline = $request->deadline;

            $joinPageContents['steps'] = $stepTitles;
            $joinPageContents['deadline'] = $deadline;

            // Handle QR code file
            if ($request->hasFile('qr_code')) {
                // Delete old QR code if it exists
                if (!empty($oldJoinPageContents['qr_code'])) {
                    $this->deleteFile($oldJoinPageContents['qr_code']);
                }

                $qrCodeFile = $request->file('qr_code');
                $qrFileName = 'general-qr-code_' . rand() . time() . '.' . $qrCodeFile->getClientOriginalExtension();
                // $qrCodeFile->move(public_path('upload/expo/qr_codes'), $qrFileName);
                $joinPageContents['qr_code'] = url('upload/expo/qr_codes/' . $qrFileName);
            } else {
                $joinPageContents['qr_code'] = $oldJoinPageContents['qr_code'] ?? '';
            }

            // Check if there are any join contents in the request
            $joinContents = $request->join_contents ?? [];

            if (!empty($joinContents)) {
                // Process existing and new join contents
                $allJoinContents = [];

                foreach ($oldJoinPageContents['join_contents'] ?? [] as $oldJoinKey => $oldJoinContent) {
                    // Check if there's a corresponding new entry
                    if (isset($joinContents[$oldJoinKey])) {
                        $joinContent = $joinContents[$oldJoinKey];

                        // Update join content with new data
                        $allJoinContents[$oldJoinKey] = [
                            'name' => $joinContent['name'],
                            'email' => $joinContent['email'],
                            'phone' => $joinContent['phone'],
                            'reference' => []
                        ];

                        // Process references
                        foreach ($joinContent['reference'] ?? [] as $refKey => $reference) {
                            $refData = [
                                'qr_code_type' => $reference['qr_code_type'] ?? '',
                            ];

                            // Handle new image upload for reference
                            if ($request->hasFile("join_contents.$oldJoinKey.reference.$refKey.image")) {
                                // Delete old image if it exists
                                if (!empty($oldJoinContent['reference'][$refKey]['image'])) {
                                    $this->deleteFile($oldJoinContent['reference'][$refKey]['image']);
                                }

                                $qrFile = $request->file("join_contents.$oldJoinKey.reference.$refKey.image");
                                $fileName = 'qr-code_' . rand() . time() . '.' . $qrFile->getClientOriginalExtension();
                                // $qrFile->move(public_path('upload/expo/qr_codes'), $fileName);
                                $refData['image'] = url('upload/expo/qr_codes/' . $fileName);
                            } else {
                                // Use the old image if no new image is uploaded
                                $refData['image'] = $oldJoinContent['reference'][$refKey]['image'] ?? '';
                            }

                            $allJoinContents[$oldJoinKey]['reference'][$refKey] = $refData;
                        }
                    } else {
                        // If no new content, delete old content and its images
                        $this->deleteContentAndImages($oldJoinKey, $oldJoinContent);
                    }
                }

                // Handle new join contents that are not in old contents
                foreach ($joinContents as $joinKey => $joinContent) {
                    if (!isset($oldJoinPageContents['join_contents'][$joinKey])) {
                        $allJoinContents[$joinKey] = [
                            'name' => $joinContent['name'],
                            'email' => $joinContent['email'],
                            'phone' => $joinContent['phone'],
                            'reference' => []
                        ];

                        // Process references
                        foreach ($joinContent['reference'] ?? [] as $refKey => $reference) {
                            $refData = [
                                'qr_code_type' => $reference['qr_code_type'] ?? '',
                                'image' => ''
                            ];

                            // Handle new image upload for reference
                            if ($request->hasFile("join_contents.$joinKey.reference.$refKey.image")) {
                                $qrFile = $request->file("join_contents.$joinKey.reference.$refKey.image");
                                $fileName = 'qr-code_' . rand() . time() . '.' . $qrFile->getClientOriginalExtension();
                                // $qrFile->move(public_path('upload/expo/qr_codes'), $fileName);
                                $refData['image'] = url('upload/expo/qr_codes/' . $fileName);
                            }

                            $allJoinContents[$joinKey]['reference'][$refKey] = $refData;
                        }
                    }
                }

                $joinPageContents['join_contents'] = $allJoinContents;
            } else {
                // No join contents in the request, delete all old contents and images
                $this->deleteAllContentsAndImages($oldJoinPageContents);
            }

            return $joinPageContents;
            $expo->update(['join_page_contents' => json_encode($joinPageContents)]);

            return redirect(route('admin.expo.join.index', ['expo_id' => $expo->unique_id]))->with('success', 'Join Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }

    // Helper method to delete files
    private function deleteFile($filePath)
    {
        if (file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
        }
    }

    // Helper method to delete content and its images
    private function deleteContentAndImages($joinKey, $oldJoinContent)
    {
        foreach ($oldJoinContent['reference'] as $refKey => $oldReference) {
            // Delete old images for each reference
            if (!empty($oldReference['image'])) {
                $this->deleteFile($oldReference['image']);
            }
        }
    }

    // Helper method to delete all contents and their images
    private function deleteAllContentsAndImages($oldJoinPageContents)
    {
        foreach ($oldJoinPageContents['join_contents'] ?? [] as $oldJoinKey => $oldJoinContent) {
            $this->deleteContentAndImages($oldJoinKey, $oldJoinContent);
        }

        // Also delete the old QR code if it exists
        if (!empty($oldJoinPageContents['qr_code'])) {
            $this->deleteFile($oldJoinPageContents['qr_code']);
        }
    }
}
