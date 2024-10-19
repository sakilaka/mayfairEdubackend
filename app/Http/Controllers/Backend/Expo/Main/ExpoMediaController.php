<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use Illuminate\Http\Request;

class ExpoMediaController extends Controller
{
    /**
     * manage media -> gallery - page
     */
    public function expo_gallery_page($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'gallery')->first();
        return view('Backend.events.expo.main.media.gallery', $data);
    }

    /**
     * manage media -> gallery - page (update)
     */
    public function expo_gallery_page_update(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            $allGalleries = [];
            $oldGalleries = json_decode($expo->gallery, true);

            if ($request->galleries) {
                $galleries = $request->galleries;

                foreach ($galleries as $galleryKey => $gallery) {
                    $galleryData = [
                        'title' => $gallery['gallery_title'],
                        'description' => $gallery['gallery_description'],
                    ];

                    $galleryImages = [];
                    $galleryImageKeys = array_keys($gallery['gallery_image'] ?? []);

                    foreach ($galleryImageKeys as $imageKey) {
                        if ($request->hasFile("galleries.$galleryKey.gallery_image.$imageKey")) {
                            $file = $request->file("galleries.$galleryKey.gallery_image.$imageKey");
                            $fileName = 'gallery-image_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/expo/gallery'), $fileName);
                            $galleryImages[$imageKey] = url('upload/expo/gallery/' . $fileName);
                        }
                    }

                    $oldGalleryImages = $gallery['old_gallery_image'] ?? [];
                    $mergedGalleryImages = $oldGalleryImages;

                    foreach ($galleryImages as $imageKey => $url) {
                        if (isset($mergedGalleryImages[$imageKey]) && file_exists(public_path('upload/expo/gallery/' . basename($mergedGalleryImages[$imageKey])))) {
                            unlink(public_path('upload/expo/gallery/' . basename($mergedGalleryImages[$imageKey])));
                        }

                        $mergedGalleryImages[$imageKey] = $url;
                    }

                    $galleryData['images'] = $mergedGalleryImages;
                    $galleryData['image_titles'] = $gallery['image_title'] ?? '';

                    $allGalleries[$galleryKey] = $galleryData;
                }

                if (isset($oldGalleries)) {
                    foreach ($oldGalleries as $oldGalleryKey => $oldGallery) {
                        if (isset($allGalleries[$oldGalleryKey])) {
                            $removedImages = array_diff_key($oldGallery['images'], $allGalleries[$oldGalleryKey]['images']);

                            foreach ($removedImages as $imageKey => $imageUrl) {
                                $imagePath = public_path('upload/expo/gallery/' . basename($imageUrl));

                                if (file_exists($imagePath)) {
                                    unlink($imagePath);
                                }
                            }

                            $allGalleries[$oldGalleryKey] = array_merge($oldGallery, $allGalleries[$oldGalleryKey]);
                        } else {
                            $allGalleries[$oldGalleryKey] = $oldGallery;
                        }
                    }
                }
            } else {
                foreach ($oldGalleries as $key => $gallery) {
                    foreach ($gallery['images'] as $key => $image) {
                        if (isset($image) && file_exists(public_path('upload/expo/gallery/' . basename($image)))) {
                            unlink(public_path('upload/expo/gallery/' . basename($image)));
                        }
                    }
                }
            }

            $expo->gallery = json_encode($allGalleries);
            $expo->save();

            return redirect(route('admin.expo.media.gallery', ['expo_id' => $expo->unique_id]))->with('success', 'Gallery Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * manage media -> video - page
     */
    public function expo_video_page($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'video')->first();
        return view('Backend.events.expo.main.media.video', $data);
    }

    /**
     * manage media -> video - page (update)
     */
    public function expo_video_page_update(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            $videoContents = [];
            $videoTypes = $request->input('video_type');
            $youtubeEmbedCodes = $request->input('youtube_embed_code');
            $videoTitles = $request->input('video_title');
            $videoUploads = $request->file('video_upload');
            $oldPhotoGalleryImages = $request->old_photo_gallery_image ?? [];

            foreach ($videoTypes as $key => $type) {
                if ($type === 'youtube') {
                    if (!empty($youtubeEmbedCodes[$key])) {
                        $videoContents[$key] = [
                            'type' => 'youtube',
                            'url' => $youtubeEmbedCodes[$key],
                        ];
                    } elseif (isset($oldPhotoGalleryImages[$key]) && $oldPhotoGalleryImages[$key]) {
                        $videoContents[$key] = [
                            'type' => 'youtube',
                            'url' => $oldPhotoGalleryImages[$key],
                        ];
                    }
                } elseif ($type === 'upload') {
                    if (isset($videoUploads[$key])) {
                        $file = $videoUploads[$key];
                        if ($file) {
                            if (isset($oldPhotoGalleryImages[$key]) && $oldPhotoGalleryImages[$key]) {
                                $oldVideoPath = public_path('upload/expo/video/' . basename($oldPhotoGalleryImages[$key]));
                                if (file_exists($oldVideoPath)) {
                                    unlink($oldVideoPath);
                                }
                            }

                            $fileName = 'expo/video-' . rand() . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/expo/video'), $fileName);
                            $videoContents[$key] = [
                                'type' => 'upload',
                                'url' => url('upload/expo/video/' . $fileName),
                            ];
                        } elseif (isset($oldPhotoGalleryImages[$key]) && $oldPhotoGalleryImages[$key]) {
                            $videoContents[$key] = [
                                'type' => 'upload',
                                'url' => $oldPhotoGalleryImages[$key],
                            ];
                        }
                    } else {
                        if (isset($oldPhotoGalleryImages[$key]) && $oldPhotoGalleryImages[$key]) {
                            $videoContents[$key] = [
                                'type' => 'upload',
                                'url' => $oldPhotoGalleryImages[$key],
                            ];
                        }
                    }
                }

                $videoContents[$key]['title'] = $videoTitles[$key];
            }

            $videoContents = array_filter($videoContents, function ($content) {
                return isset($content['type'], $content['url']) && !empty($content['url']);
            });

            $finalVideoContents = [];
            foreach ($videoContents as $key => $content) {
                $finalVideoContents[$key] = $content;
            }

            $expo->video = json_encode($finalVideoContents);
            $expo->save();

            return redirect(route('admin.expo.media.video', ['expo_id' => $expo->unique_id]))->with('success', 'Video Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
