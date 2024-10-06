<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use App\Models\ExpoModuleContent;
use Illuminate\Http\Request;

class ExpoModuleContentsController extends Controller
{
    /**
     * manage ui -> contact - page
     */
    public function ui_contact_page()
    {
        $data['contents'] = ExpoModuleContent::where('key', 'contact')->first();
        return view('Backend.events.expo.ui-contents.contact', $data);
    }

    /**
     * manage ui -> contact - page (update)
     */
    public function ui_contact_page_update(Request $request)
    {
        try {
            $data = [
                'key' => 'contact',
                'contents' => json_encode($request->contents)
            ];

            ExpoModuleContent::updateOrCreate(['key' => 'contact'], $data);

            return back()->with('success', 'Contents have been updated!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * manage ui -> gallery - page
     */
    public function ui_gallery_page()
    {
        $data['page'] = ExpoModuleContent::where('key', 'gallery')->first();
        return view('Backend.events.expo.ui-contents.gallery', $data);
    }

    /**
     * manage ui -> gallery - page (update)
     */
    public function ui_gallery_page_update(Request $request)
    {
        try {
            $page = ExpoModuleContent::where('key', 'gallery')->first();

            if (!$page) {
                $page = new ExpoModuleContent();
            }

            $page->key = 'gallery';

            $allGalleries = [];
            $oldGalleries = json_decode($page->contents, true);

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
                            $file->move(public_path('upload/expo-gallery'), $fileName);
                            $galleryImages[$imageKey] = url('upload/expo-gallery/' . $fileName);
                        }
                    }

                    $oldGalleryImages = $gallery['old_gallery_image'] ?? [];
                    $mergedGalleryImages = $oldGalleryImages;

                    foreach ($galleryImages as $imageKey => $url) {
                        if (isset($mergedGalleryImages[$imageKey]) && file_exists(public_path('upload/expo-gallery/' . basename($mergedGalleryImages[$imageKey])))) {
                            unlink(public_path('upload/expo-gallery/' . basename($mergedGalleryImages[$imageKey])));
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
                                $imagePath = public_path('upload/expo-gallery/' . basename($imageUrl));

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
                        if (isset($image) && file_exists(public_path('upload/expo-gallery/' . basename($image)))) {
                            unlink(public_path('upload/expo-gallery/' . basename($image)));
                        }
                    }
                }
            }

            $page->contents = json_encode($allGalleries);
            $page->save();

            return redirect(route('admin.expo.ui.gallery'))->with('success', 'Gallery Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * manage ui -> video - page
     */
    public function ui_video_page()
    {
        $data['page'] = ExpoModuleContent::where('key', 'video')->first();
        return $data['page'];
        return view('Backend.events.expo.ui-contents.video', $data);
    }

    /**
     * manage ui -> video - page (update)
     */
    public function ui_video_page_update(Request $request)
    {
        try {
            $page = ExpoModuleContent::where('key', 'video')->first();

            if (!$page) {
                $page = new ExpoModuleContent();
            }

            $page->key = 'video';

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
                            // Delete the old video file if it exists
                            if (isset($oldPhotoGalleryImages[$key]) && $oldPhotoGalleryImages[$key]) {
                                $oldVideoPath = public_path('upload/expo-video/' . basename($oldPhotoGalleryImages[$key]));
                                if (file_exists($oldVideoPath)) {
                                    unlink($oldVideoPath);
                                }
                            }

                            // Move the new video upload
                            $fileName = 'expo-video-' . rand() . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/expo-video'), $fileName);
                            $videoContents[$key] = [
                                'type' => 'upload',
                                'url' => url('upload/expo-video/' . $fileName),
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

            $page->contents = json_encode($finalVideoContents);
            $page->save();

            return redirect(route('admin.expo.ui.video'))->with('success', 'Video Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
