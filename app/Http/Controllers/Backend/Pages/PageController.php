<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Models\AboutPageSetup;
use App\Models\AdditionalPage;
use App\Models\Category;
use App\Models\Faq;
use App\Models\HomeContentItem;
use App\Models\HomeContentSetup;
use App\Models\Library;
use App\Models\MaestroClassSetup;
use App\Models\PackageDetails;
use App\Models\PackageTagLine;
use App\Models\Page;
use App\Models\PageControl;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('Backend.setting.page.index', compact('pages'));
    }
    public function categoryIndex()
    {
        $page_categories = Category::where('type', 'page')->get();
        return view('Backend.setting.page_category.index', compact('page_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::where('type', 'page')->get();
        return view('Backend.setting.page.create', $data);
    }
    public function categoryCreate()
    {

        return view('Backend.setting.page_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->description = $request->description;
        $page->slug = Str::slug($request->title);;
        $page->save();
        return redirect()->route('all-pages.index')->with('success', 'Page Added Successfully');
    }
    public function categoryStore(Request $request)
    {
        $page = new Category();
        $page->name = $request->title;
        $page->type = 'page';

        $page->save();
        return redirect()->route("admin.page_category.index")->with('success', 'Category Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['page'] = Page::find($id);
        $data['categories'] = Category::where('type', 'page')->get();
        return view('Backend.setting.page.update', $data);
    }
    public function categoryEdit(string $id)
    {
        $page_category =  Category::find($id);
        return view('Backend.setting.page_category.update', compact('page_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::find($id);
        $page->slug = Str::slug($request->title);
        $page->title = $request->title;
        $page->description = $request->description;
        $page->update();

        return redirect()->route('all-pages.index')->with('success', 'Page Updated Successfully');
    }
    public function categoryUpdate(Request $request, $id)
    {
        $page =  Category::find($id);
        $page->name = $request->title;
        $page->type = 'page';
        $page->status = $request->status;
        $page->save();
        return redirect()->route("admin.page_category.index")->with('success', 'Category Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function pageDelete(Request $request)
    {
        try {
            $page = Page::find($request->page_id);
            $page->delete();
            return redirect()->route('all-pages.index')->with('success', 'Page Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
    public function pageCattegoryDelete($id)
    {
        $page =  Category::find($id);
        $page->delete();
        return redirect()->route('admin.page_category.index');
    }
    public function category_status_toggle($id)
    {
        try {
            $page =  Category::find($id);
            if ($page->status == 0) {
                $page->status = 1;
            } elseif ($page->status == 1) {
                $page->status = 0;
            }
            $page->update();
            return redirect()->route('admin.page_category.index')->with('success', 'Status Updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    //Status section
    public function status_toggle($id)
    {
        try {
            $page = Page::find($id);
            if ($page->status == 0) {
                $page->status = 1;
            } elseif ($page->status == 1) {
                $page->status = 0;
            }
            $page->update();
            return redirect()->route('all-pages.index')->with('success', 'Status Updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function footerPages()
    {
        return view('Backend.setting.page.footer_pages');
    }

    // company details page
    public function companyDetailsPage()
    {
        $data['page'] = AdditionalPage::where('page', 'company-details')->first();
        return view('Backend.setting.page.companyDetails_page', $data);
    }

    public function companyDetailsPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'company-details')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = 'Company Details';
            $page->page = 'company-details';
            $data['since_year'] = $request->since_year;
            $data['title'] = $request->title;
            $data['description'] = $request->description;

            // Handling gallery images
            $photoGalleryImages = [];
            if ($request->hasFile('photo_gallery_image')) {
                foreach ($request->file('photo_gallery_image') as $key => $file) {
                    $fileName = 'company_details_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/additional-pages'), $fileName);
                    $photoGalleryImages[$key] = url('upload/additional-pages/' . $fileName);
                }
            }

            $oldPhotoGalleryImages = $request->old_photo_gallery_image ?? [];
            $mergedPhotoGalleryImages = $oldPhotoGalleryImages;

            foreach ($photoGalleryImages as $key => $url) {
                if (isset($mergedPhotoGalleryImages[$key]) && file_exists(public_path('upload/additional-pages/' . basename($mergedPhotoGalleryImages[$key])))) {
                    unlink(public_path('upload/additional-pages/' . basename($mergedPhotoGalleryImages[$key])));
                }

                $mergedPhotoGalleryImages[$key] = $url;
            }
            $data['images'] = $mergedPhotoGalleryImages;

            // Handling media partner images
            $mediaPartnerImages = [];
            if ($request->hasFile('media_partner_image')) {
                foreach ($request->file('media_partner_image') as $key => $file) {
                    $fileName = 'media-partner_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/additional-pages'), $fileName);
                    $mediaPartnerImages[$key] = url('upload/additional-pages/' . $fileName);
                }
            }

            $oldMediaPartnerImages = $request->old_media_partner_image ?? [];
            $mergedMediaPartnerImages = $oldMediaPartnerImages;

            foreach ($mediaPartnerImages as $key => $url) {
                if (isset($mergedMediaPartnerImages[$key]) && file_exists(public_path('upload/additional-pages/' . basename($mergedMediaPartnerImages[$key])))) {
                    unlink(public_path('upload/additional-pages/' . basename($mergedMediaPartnerImages[$key])));
                }

                $mergedMediaPartnerImages[$key] = $url;
            }

            $data['mediaPartners']['title'] = $request->media_partner_title;
            $data['mediaPartners']['partners'] = $mergedMediaPartnerImages;

            $page->contents = json_encode($data);
            $page->save();

            return redirect()->back()->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // founders page
    public function foundersCoFoundersPage()
    {
        $data['page'] = AdditionalPage::where('page', 'founders')->first();
        return view('Backend.setting.page.founders_page', $data);
    }
    public function foundersCoFoundersPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'founders')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = 'Founders & Co-Founders';
            $page->page = 'founders';
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $page->contents = json_encode($data);
            $page->save();

            return redirect()->back()->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // gallery page
    public function galleryPage()
    {
        $data['page'] = AdditionalPage::where('page', 'gallery')->first();
        return view('Backend.setting.page.gallery_page', $data);
    }

    public function galleryPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'gallery')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = 'Gallery';
            $page->page = 'gallery';

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
                            $file->move(public_path('upload/additional-pages'), $fileName);
                            $galleryImages[$imageKey] = url('upload/additional-pages/' . $fileName);
                        }
                    }

                    $oldGalleryImages = $gallery['old_gallery_image'] ?? [];
                    $mergedGalleryImages = $oldGalleryImages;

                    foreach ($galleryImages as $imageKey => $url) {
                        if (isset($mergedGalleryImages[$imageKey]) && file_exists(public_path('upload/additional-pages/' . basename($mergedGalleryImages[$imageKey])))) {
                            unlink(public_path('upload/additional-pages/' . basename($mergedGalleryImages[$imageKey])));
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
                                $imagePath = public_path('upload/additional-pages/' . basename($imageUrl));

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
                        if (isset($image) && file_exists(public_path('upload/additional-pages/' . basename($image)))) {
                            unlink(public_path('upload/additional-pages/' . basename($image)));
                        }
                    }
                }
            }

            $page->contents = json_encode($allGalleries);
            $page->save();

            return redirect(route('admin.gallery_page'))->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // authorization letters page
    public function authorizationLettersPage()
    {
        $data['page'] = AdditionalPage::where('page', 'authorization-letters')->first();
        return view('Backend.setting.page.authorizationLetters_page', $data);
    }

    public function authorizationLettersPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'authorization-letters')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = 'Authorization Letters';
            $page->page = 'authorization-letters';

            $allAuthorizationLetters = [];
            $oldAuthorizationLetters = json_decode($page->contents, true);

            if ($request->authorization_letters) {
                $authorization_letters = $request->authorization_letters;

                foreach ($authorization_letters as $authorizationLetterKey => $authorizationLetter) {
                    $authorizationLetterData = [
                        'title' => $authorizationLetter['authorization_letter_title'] ?? '',
                        'description' => $authorizationLetter['authorization_letter_description'] ?? '',
                    ];

                    $authorizationLetterImages = [];
                    $authorizationLetterImageKeys = array_keys($authorizationLetter['authorization_letter_image'] ?? []);

                    foreach ($authorizationLetterImageKeys as $imageKey) {
                        if ($request->hasFile("authorization_letters.$authorizationLetterKey.authorization_letter_image.$imageKey")) {
                            $file = $request->file("authorization_letters.$authorizationLetterKey.authorization_letter_image.$imageKey");
                            $fileName = 'authorization-letter_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/additional-pages'), $fileName);
                            $authorizationLetterImages[$imageKey] = url('upload/additional-pages/' . $fileName);
                        }
                    }

                    $oldAuthorizationLetterImages = $authorizationLetter['old_authorization_letter_image'] ?? [];
                    $mergedAuthorizationLetterImages = $oldAuthorizationLetterImages;

                    foreach ($authorizationLetterImages as $imageKey => $url) {
                        if (isset($mergedAuthorizationLetterImages[$imageKey]) && file_exists(public_path('upload/additional-pages/' . basename($mergedAuthorizationLetterImages[$imageKey])))) {
                            unlink(public_path('upload/additional-pages/' . basename($mergedAuthorizationLetterImages[$imageKey])));
                        }

                        $mergedAuthorizationLetterImages[$imageKey] = $url;
                    }

                    $authorizationLetterData['images'] = $mergedAuthorizationLetterImages;
                    $authorizationLetterData['image_titles'] = $authorizationLetter['image_title'] ?? '';
                    $allAuthorizationLetters[$authorizationLetterKey] = $authorizationLetterData;
                }

                if (isset($oldAuthorizationLetters)) {
                    foreach ($oldAuthorizationLetters as $oldAuthorizationLetterKey => $oldAuthorizationLetter) {
                        if (isset($allAuthorizationLetters[$oldAuthorizationLetterKey])) {
                            $removedImages = array_diff_key($oldAuthorizationLetter['images'], $allAuthorizationLetters[$oldAuthorizationLetterKey]['images']);

                            foreach ($removedImages as $imageKey => $imageUrl) {
                                $imagePath = public_path('upload/additional-pages/' . basename($imageUrl));

                                if (file_exists($imagePath)) {
                                    unlink($imagePath);
                                }
                            }

                            $allAuthorizationLetters[$oldAuthorizationLetterKey] = array_merge($oldAuthorizationLetter, $allAuthorizationLetters[$oldAuthorizationLetterKey]);
                        } else {
                            $allAuthorizationLetters[$oldAuthorizationLetterKey] = $oldAuthorizationLetter;
                        }
                    }
                }
            } else {
                foreach ($oldAuthorizationLetters as $key => $authorizationLetter) {
                    foreach ($authorizationLetter['images'] as $key => $image) {
                        if (isset($image) && file_exists(public_path('upload/additional-pages/' . basename($image)))) {
                            unlink(public_path('upload/additional-pages/' . basename($image)));
                        }
                    }
                }
            }

            $page->contents = json_encode($allAuthorizationLetters);
            $page->save();

            return redirect(route('admin.authorizationLetters_page'))->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // activities page
    public function activitiesPage()
    {
        $data['page'] = AdditionalPage::where('page', 'activities')->first();
        return view('Backend.setting.page.activities_page', $data);
    }

    public function activitiesPageAdd()
    {
        return view('Backend.setting.page.activities_page_add');
    }

    public function activitiesPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'activities')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = 'Activities';
            $page->page = 'activities';

            $allActivities = [];
            $oldActivities = json_decode($page->contents, true);

            if ($request->activities) {
                $activities = $request->activities;

                foreach ($activities as $activityKey => $activity) {
                    $activityData = [
                        'date' => $activity['activity_date'],
                        'title' => $activity['activity_title'],
                        'description' => $activity['activity_description'],
                    ];

                    $activityImages = [];
                    $activityImageKeys = array_keys($activity['activity_image'] ?? []);

                    foreach ($activityImageKeys as $imageKey) {
                        if ($request->hasFile("activities.$activityKey.activity_image.$imageKey")) {
                            $file = $request->file("activities.$activityKey.activity_image.$imageKey");
                            $fileName = 'activity-image_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('upload/additional-pages'), $fileName);
                            $activityImages[$imageKey] = url('upload/additional-pages/' . $fileName);
                        }
                    }

                    $oldActivityImages = $activity['old_activity_image'] ?? [];
                    $mergedActivityImages = $oldActivityImages;

                    foreach ($activityImages as $imageKey => $url) {
                        if (isset($mergedActivityImages[$imageKey]) && file_exists(public_path('upload/additional-pages/' . basename($mergedActivityImages[$imageKey])))) {
                            unlink(public_path('upload/additional-pages/' . basename($mergedActivityImages[$imageKey])));
                        }

                        $mergedActivityImages[$imageKey] = $url;
                    }

                    $activityData['images'] = $mergedActivityImages;
                    // $activityData['image_titles'] = $activity['image_title'];
                    $allActivities[$activityKey] = $activityData;
                }
            }

            if (isset($oldActivities)) {
                foreach ($oldActivities as $oldActivityKey => $oldActivity) {
                    if (isset($allActivities[$oldActivityKey])) {
                        $allActivities[$oldActivityKey] = array_merge($oldActivity, $allActivities[$oldActivityKey]);
                    } else {
                        $allActivities[$oldActivityKey] = $oldActivity;
                    }
                }
            }

            $page->contents = json_encode($allActivities);
            $page->save();

            return redirect(route('admin.activities_page'))->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // our services page
    public function ourServicesPage()
    {
        $data['page'] = AdditionalPage::where('page', 'our-services')->first();
        // dd($data['page']);
        // dd(json_decode($data['page']['contents'], true));
        return view('Backend.setting.page.ourServices_page', $data);
    }

    public function ourServicesPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'our-services')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = $request->title ?? 'Our Services';
            $page->page = 'our-services';


            // Handling services large
            
            $servicesLarge = [];
            if ($request->service_large_description) {
                $serviceLargeImages = [];
                $imageKeys = [];
                $serviceLargeKeys = [];

                $existingServicesLarge = json_decode($page->contents, true)['servicesLarge'] ?? [];
                foreach ($existingServicesLarge as $key => $guest) {
                    $serviceLargeKeys[] = $key;
                }

                if ($request->hasFile('services_large_image')) {
                    foreach ($request->file('services_large_image') as $key => $file) {
                        $fileName = 'service-large_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('upload/our-services'), $fileName);
                        $serviceLargeImages[$key] = url('upload/our-services/' . $fileName);
                        $imageKeys[] = $key;
                    }
                }

                $oldServiceLargeImages = $request->old_services_large_image ?? [];
                $mergedServiceLargeImages = $oldServiceLargeImages;

                foreach ($serviceLargeImages as $key => $url) {
                    if (isset($mergedServiceLargeImages[$key]) && file_exists(public_path('upload/our-services/' . basename($mergedServiceLargeImages[$key])))) {
                        unlink(public_path('upload/our-services/' . basename($mergedServiceLargeImages[$key])));
                    }

                    $mergedServiceLargeImages[$key] = $url;
                }

                $totalServicesLarge = count($request->service_large_title);

                for ($i = 0; $i < $totalServicesLarge; $i++) {
                    $key = $serviceLargeKeys[$i] ?? null;

                    $servicesLarge[$key ?? rand(10000, 99999)] = [
                        'title' => $request->service_large_title[$i],
                        'description' => $request->service_large_description[$i],
                        'long_description' => $request->service_large_long_description[$i],
                        'image' => $mergedServiceLargeImages[$key] ?? null
                    ];
                }
            }
            $servicesData['servicesLarge'] = $servicesLarge;

            $page->contents = json_encode($servicesData);
            $page->save();

            return redirect()->back()->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    // why china page
    public function whyChinaPage()
    {
        $data['page'] = AdditionalPage::where('page', 'why-china')->first();
        return view('Backend.setting.page.whyChina_page', $data);
    }

    public function whyChinaPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'why-china')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = $request->title ?? 'Why China';
            $page->page = 'why-china';
            $data['descriptions'] = $request->contents;

            if ($request->hasFile('banner')) {
                if (json_decode($page->contents, true)['banner']) {
                    $oldBannerPath = str_replace(url('/'), public_path(), json_decode($page->contents, true)['banner']);
                    if (file_exists($oldBannerPath)) {
                        unlink($oldBannerPath);
                    }
                }

                $fileName = time() . '_whyChina-banner.' . $request->banner->getClientOriginalExtension();
                $request->banner->move(public_path('upload/additional-pages'), $fileName);
                $banner_url = url('upload/additional-pages/' . $fileName);

                $data['banner'] = $banner_url;
            }

            $page->contents = json_encode($data);
            $page->save();
            return redirect()->back()->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!')->withErrors($e->getMessage());
        }
    }

    // about china page
    public function aboutChinaPage()
    {
        $data['page'] = AdditionalPage::where('page', 'about-china')->first();
        return view('Backend.setting.page.aboutChina_page', $data);
    }

    public function aboutChinaPageSetup(Request $request)
    {
        try {
            $page = AdditionalPage::where('page', 'about-china')->first();

            if (!$page) {
                $page = new AdditionalPage();
            }

            $page->title = $request->title ?? 'About China';
            $page->page = 'about-china';
            $data['descriptions'] = $request->contents;

            if ($request->hasFile('banner')) {
                if (json_decode($page->contents, true)['banner']) {
                    $oldBannerPath = str_replace(url('/'), public_path(), json_decode($page->contents, true)['banner']);
                    if (file_exists($oldBannerPath)) {
                        unlink($oldBannerPath);
                    }
                }

                $fileName = time() . '_aboutChina-banner.' . $request->banner->getClientOriginalExtension();
                $request->banner->move(public_path('upload/additional-pages'), $fileName);
                $banner_url = url('upload/additional-pages/' . $fileName);

                $data['banner'] = $banner_url;
            }

            $page->contents = json_encode($data);
            $page->save();
            return redirect()->back()->with('success', 'Page Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!')->withErrors($e->getMessage());
        }
    }

    //libraryPage
    public function libraryPage()
    {
        $data['library'] = Library::first();
        return view('Backend.setting.page.library', $data);
    }
    public function libraryPageSetup(Request $request)
    {
        try {
            $library = Library::first();
            if ($library == null) {
                $library = new Library();
            }

            $library->description = $request->description;
            $library->timer = $request->timer;
            $library->title1 = $request->title1;
            $library->title2 = $request->title2;

            if ($request->hasFile('image')) {
                @unlink(public_path('upload/library/' . $library->image));
                $fileName = time() . '_image.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('upload/library'), $fileName);
                $library->image = $fileName;
            }
            $library->save();
            return back()->with("success", "Updated Successfully!");
        } catch (\Exception $e) {
            return back()->with("error", "Something Went Wrong!");
        }
    }


    public function maestorClass()
    {
        $data['home_content'] = MaestroClassSetup::FirstorNew();
        $data['faqs'] =  Faq::where('type', "maestroclass")->get();
        return view('Backend.setting.page.maestor_class', $data);
    }
    function maestorClassSetup(Request $request)
    {
        // if($request->home_content_old_ques){
        //     foreach($request->home_content_old_ques as $key => $value){
        //         $faq= Faq::find($key);
        //         $faq->question= $value;
        //         $faq->answer= $request->home_content_old_ans[$key];
        //         $faq->type="maestroclass";
        //         $faq->save();

        //     }
        // }
        // if($request->old_delete_faq_data){
        //     foreach($request->old_delete_faq_data as $value){
        //         $faq= Faq::find($value);
        //         $faq->delete();
        //     }
        // }
        // if($request->home_content_ques){
        //     foreach($request->home_content_ques as $key => $value){
        //         $faq= New Faq;
        //         $faq->question= $value;
        //         $faq->answer= $request->home_content_ans[$key];
        //         $faq->type="maestroclass";
        //         $faq->save();

        //     }
        // }



        $maestro_content = MaestroClassSetup::first();
        if ($maestro_content == null) {
            $maestro_content = new MaestroClassSetup;
        }
        $maestro_content->banner_title = $request->banner_title;
        $maestro_content->title2 = $request->title2;
        $maestro_content->title3 = $request->title3;


        if ($request->hasFile('banner_image')) {
            @unlink(public_path('upload/maestor-class/' . $maestro_content->banner_image));
            $fileName = time() . '_banner-image.' . $request->banner_image->getClientOriginalExtension();
            $request->banner_image->move(public_path('upload/maestor-class'), $fileName);

            $maestro_content->banner_image = $fileName;
        }
        if ($request->hasFile('banner_video')) {
            @unlink(public_path('upload/maestor-class/' . $maestro_content->banner_video));
            $fileName = time() . '_banner_video.' . $request->banner_video->getClientOriginalExtension();
            $request->banner_video->move(public_path('upload/maestor-class'), $fileName);

            $maestro_content->banner_video = $fileName;
        }
        $maestro_content->save();
        return back()->with("success", "Update Successfully!");
    }

    ///FAQ
    public function manageFaq()
    {
        $data['faq_content'] = Faq::where('type', 'faq_content')->first();
        $data['faqs'] =  Faq::where('type', "faq")->get();
        return view('Backend.setting.page.faq', $data);
    }
    public function faqSetup(Request $request)
    {
        try {
            if ($request->home_content_old_ques) {
                foreach ($request->home_content_old_ques as $key => $value) {
                    $faq = Faq::find($key);
                    $faq->question = $value;
                    $faq->answer = $request->home_content_old_ans[$key];
                    $faq->type = "faq";
                    $faq->save();
                }
            }
            if ($request->old_delete_faq_data) {
                foreach ($request->old_delete_faq_data as $value) {
                    $faq = Faq::find($value);
                    $faq->delete();
                }
            }

            if ($request->home_content_ques) {
                foreach ($request->home_content_ques as $key => $value) {
                    $faq = new Faq;
                    $faq->question = $value;
                    $faq->answer = $request->home_content_ans[$key];
                    $faq->type = "faq";
                    $faq->save();
                }
            }

            $faq_content = Faq::where('type', 'faq_content')->first();
            if ($faq_content == null) {
                $faq_content = new Faq();
            }
            $faq_content->title1 = $request->title1;
            $faq_content->title2 = $request->title2;
            $faq_content->description1 = $request->description1;
            $faq_content->description2 = $request->description2;
            $faq_content->type = "faq_content";


            if ($request->hasFile('banner_image')) {
                @unlink(public_path('upload/faq/' . $faq_content->banner_image));
                $fileName = time() . '_banner-image.' . $request->banner_image->getClientOriginalExtension();
                $request->banner_image->move(public_path('upload/faq'), $fileName);
                $faq_content->banner_image = $fileName;
            }

            $faq_content->save();
            return back()->with("success", "Updated Successfully!");
        } catch (\Exception $e) {
            return back()->with("success", "Something Went Wrong!");
        }
    }


    public function page_control_index()
    {
        $data['page_controls'] = PageControl::all()->select('id', 'page', 'url', 'section');
        return view('Backend.setting.page_control.index', $data);
    }

    public function page_control_create()
    {
        // $data['pages'] = Page::where('status', 1)->select(['slug', 'title'])->orderBy('title', 'asc')->get();
        return view('Backend.setting.page_control.create'/* , $data */);
    }

    public function page_control_store(Request $request)
    {
        try {
            /* $pageParts = explode('|', $request['page']);

            $pageName = $pageParts[0];
            $pageSlug = $pageParts[1]; */

            $data = [
                'page' => $request['page'],
                'url' => $request['url'],
                'section' => $request['section'],
            ];

            PageControl::create($data);
            return redirect(route('admin.page_control.index'))->with('success', 'Page Section Updated!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function page_control_edit($id)
    {
        $data['page_control'] = PageControl::find($id);
        // $data['pages'] = Page::where('status', 1)->select(['slug', 'title'])->orderBy('title', 'asc')->get();
        return view('Backend.setting.page_control.update', $data);
    }

    public function page_control_update(Request $request, $id)
    {
        try {
            $page_control = PageControl::find($id);
            /* $pageParts = explode('|', $request['page']);

            $pageName = $pageParts[0];
            $pageSlug = $pageParts[1]; */

            $data = [
                'page' => $request['page'],
                'url' => $request['url'],
                'section' => $request['section'],
            ];

            $page_control->update($data);
            return redirect(route('admin.page_control.index'))->with('success', 'Page Section Updated!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function page_control_delete(Request $request)
    {
        $page_control = PageControl::find($request->page_control_id);
        $page_control->delete();
        return redirect(route('admin.page_control.index'))->with('success', 'Page Control Deleted!');
    }
}