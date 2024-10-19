<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use Illuminate\Http\Request;

class ExpoJoinController extends Controller
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
}
