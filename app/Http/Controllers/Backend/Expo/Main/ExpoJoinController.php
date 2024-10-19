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
            $joinPageContents = [];
            $oldJoinPageContents = json_decode($expo->join_page_contents, true) ?? [];

            $stepTitles = $request->step_title ?? [];
            $deadline = $request->deadline;

            $joinPageContents['steps'] = $stepTitles;
            $joinPageContents['deadline'] = $deadline;

            if ($request->hasFile('qr_code')) {
                if (!empty($oldJoinPageContents['qr_code'])) {
                    $this->deleteFile($oldJoinPageContents['qr_code']);
                }

                $qrCodeFile = $request->file('qr_code');
                $qrFileName = 'general-qr-code_' . rand() . time() . '.' . $qrCodeFile->getClientOriginalExtension();
                $qrCodeFile->move(public_path('upload/expo/qr_codes'), $qrFileName);
                $joinPageContents['qr_code'] = url('upload/expo/qr_codes/' . $qrFileName);
            } else {
                $joinPageContents['qr_code'] = $oldJoinPageContents['qr_code'] ?? '';
            }

            $joinContents = $request->join_contents ?? [];

            if (!empty($joinContents)) {
                $allJoinContents = [];

                foreach ($oldJoinPageContents['join_contents'] ?? [] as $oldJoinKey => $oldJoinContent) {
                    if (isset($joinContents[$oldJoinKey])) {
                        $joinContent = $joinContents[$oldJoinKey];

                        $allJoinContents[$oldJoinKey] = [
                            'name' => $joinContent['name'],
                            'email' => $joinContent['email'],
                            'phone' => $joinContent['phone'],
                            'reference' => []
                        ];

                        foreach ($joinContent['reference'] ?? [] as $refKey => $reference) {
                            $refData = [
                                'qr_code_type' => $reference['qr_code_type'] ?? '',
                            ];

                            if ($request->hasFile("join_contents.$oldJoinKey.reference.$refKey.image")) {
                                if (!empty($oldJoinContent['reference'][$refKey]['image'])) {
                                    $this->deleteFile($oldJoinContent['reference'][$refKey]['image']);
                                }

                                $qrFile = $request->file("join_contents.$oldJoinKey.reference.$refKey.image");
                                $fileName = 'qr-code_' . rand() . time() . '.' . $qrFile->getClientOriginalExtension();
                                $qrFile->move(public_path('upload/expo/qr_codes'), $fileName);
                                $refData['image'] = url('upload/expo/qr_codes/' . $fileName);
                            } else {
                                $refData['image'] = $oldJoinContent['reference'][$refKey]['image'] ?? '';
                            }

                            $allJoinContents[$oldJoinKey]['reference'][$refKey] = $refData;
                        }
                    } else {
                        $this->deleteContentAndImages($oldJoinKey, $oldJoinContent);
                    }
                }

                foreach ($joinContents as $joinKey => $joinContent) {
                    if (!isset($oldJoinPageContents['join_contents'][$joinKey])) {
                        $allJoinContents[$joinKey] = [
                            'name' => $joinContent['name'],
                            'email' => $joinContent['email'],
                            'phone' => $joinContent['phone'],
                            'reference' => []
                        ];

                        foreach ($joinContent['reference'] ?? [] as $refKey => $reference) {
                            $refData = [
                                'qr_code_type' => $reference['qr_code_type'] ?? '',
                                'image' => ''
                            ];

                            if ($request->hasFile("join_contents.$joinKey.reference.$refKey.image")) {
                                $qrFile = $request->file("join_contents.$joinKey.reference.$refKey.image");
                                $fileName = 'qr-code_' . rand() . time() . '.' . $qrFile->getClientOriginalExtension();
                                $qrFile->move(public_path('upload/expo/qr_codes'), $fileName);
                                $refData['image'] = url('upload/expo/qr_codes/' . $fileName);
                            }

                            $allJoinContents[$joinKey]['reference'][$refKey] = $refData;
                        }
                    }
                }

                $joinPageContents['join_contents'] = $allJoinContents;
            } else {
                $this->deleteAllContentsAndImages($oldJoinPageContents);
            }

            $expo->update(['join_page_contents' => json_encode($joinPageContents)]);
            return redirect(route('admin.expo.join.index', ['expo_id' => $expo->unique_id]))->with('success', 'Join Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong! ' . $e->getMessage());
        }
    }

    private function deleteFile($filePath)
    {
        $relativePath = parse_url($filePath, PHP_URL_PATH);
        if (file_exists(public_path($relativePath))) {
            unlink(public_path($relativePath));
        }
    }

    private function deleteContentAndImages($joinKey, $oldJoinContent)
    {
        foreach ($oldJoinContent['reference'] as $refKey => $oldReference) {
            if (!empty($oldReference['image'])) {
                $this->deleteFile($oldReference['image']);
            }
        }
    }

    private function deleteAllContentsAndImages($oldJoinPageContents)
    {
        foreach ($oldJoinPageContents['join_contents'] ?? [] as $oldJoinKey => $oldJoinContent) {
            $this->deleteContentAndImages($oldJoinKey, $oldJoinContent);
        }

        if (!empty($oldJoinPageContents['qr_code'])) {
            $this->deleteFile($oldJoinPageContents['qr_code']);
        }
    }
}
