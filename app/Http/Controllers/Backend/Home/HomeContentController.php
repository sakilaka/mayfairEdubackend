<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\HomeContentItem;
use App\Models\HomeContentSetup;
use App\Models\HomeContentLocation;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Event;
use App\Models\Expo;
use App\Models\FooterImage;
use App\Models\State;

use function PHPUnit\Framework\isNull;

class HomeContentController extends Controller
{
    function getHomeContect()
    {
        $data['home_content'] = HomeContentSetup::FirstorNew();
        $data['faqs'] =  Faq::where('type', "homepage")->get();
        $data['learn_texts'] =  HomeContentItem::where('type', "homepage")->get();
        $data['home_content_locations'] =  HomeContentLocation::get();
        $data['continents'] = Continent::get();
        $data['countrys'] = Country::get();
        $data['states']  = State::get();
        $data['citys']  = City::get();
        $data['footer_gallery'] = FooterImage::first() ?? [];

        $data['blogItems'] = Blog::all();
        $data['eventItems'] = Event::all();
        $data['expoItems'] = Expo::all();

        return view("Backend.home.content_setup.index", $data);
    }


    public function setBannerSection(Request $request)
    {
        try {
            if ($request->home_content_old_ques) {
                foreach ($request->home_content_old_ques as $key => $value) {
                    $faq = Faq::find($key);
                    $faq->question = $value;
                    $faq->answer = $request->home_content_old_ans[$key];
                    $faq->type = "homepage";
                    $faq->save();
                }
            }

            if ($request->home_content_ques) {
                foreach ($request->home_content_ques as $key => $value) {
                    $faq = new Faq;
                    $faq->question = $value;
                    $faq->answer = $request->home_content_ans[$key];
                    $faq->type = "homepage";
                    $faq->save();
                }
            }

            $home_content = HomeContentSetup::first();

            if ($home_content == null) {
                $home_content = new HomeContentSetup;
            }

            $home_content->banner_text = $request->banner_text;
            $home_content->banner_type = $request->banner_type;

            // Handling banner video
            if ($request->file('banner_video')) {
                $videos = [];

                foreach ($request->file('banner_video') as $file) {
                    $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/home_content/banner/'), $fileName);
                    $videos[] = url('upload/home_content/banner/' . $fileName);
                }

                $oldVideos = json_decode($home_content->banner_video, true) ?? [];

                foreach ($oldVideos as $video) {
                    $oldVideoPath = public_path(parse_url($video, PHP_URL_PATH));
                    if (file_exists($oldVideoPath)) {
                        unlink($oldVideoPath);
                    }
                }

                $home_content->banner_video = json_encode($videos);
            }

            // Handling banner images
            $bannerImages = [];
            if ($request->hasFile('banner_image')) {
                foreach ($request->file('banner_image') as $key => $file) {
                    $fileName = 'gallery_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/home_content/banner'), $fileName);
                    $bannerImages[$key] = url('upload/home_content/banner/' . $fileName);
                }
            }

            $oldBannerImages = $request->old_banner_image ?? [];
            $mergedBannerImages = $oldBannerImages;

            foreach ($bannerImages as $key => $url) {
                if (isset($mergedBannerImages[$key]) && file_exists(public_path('upload/home_content/banner/' . basename($mergedBannerImages[$key])))) {
                    unlink(public_path('upload/home_content/banner/' . basename($mergedBannerImages[$key])));
                }

                $mergedBannerImages[$key] = $url;
            }
            $banner_data['images'] = $mergedBannerImages;
            $banner_data['image_url'] = $request->image_url;

            $home_content->banner_image = json_encode($banner_data);
            $home_content->save();
            return redirect()->back()->with('success', 'Banner Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function setSubBannerSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }

        $home_content->sub_banner_title = $request->sub_banner_title;
        $home_content->sub_banner_video = $request->sub_banner_video; //video URL

        if ($request->hasFile('sub_banner_image')) {
            @unlink(public_path('upload/home_content/' . $home_content->sub_banner_image));
            $fileName = time() . '_sub_banner_image.' . $request->sub_banner_image->getClientOriginalExtension();
            $request->sub_banner_image->move(public_path('upload/home_content'), $fileName);
            $home_content->sub_banner_image = $fileName;
        }
        if ($request->hasFile('sub_banner_thumbnail')) {
            @unlink(public_path('upload/home_content/' . $home_content->sub_banner_thumbnail));
            $fileName = time() . '_sub_banner_thumbnail-logo.' . $request->sub_banner_thumbnail->getClientOriginalExtension();
            $request->sub_banner_thumbnail->move(public_path('upload/home_content'), $fileName);
            $home_content->sub_banner_thumbnail = $fileName;
        }
        $home_content->save();
        return redirect()->back()->with('success', 'Sub Banner Section Update Successfully');
    }

    public function setUniversitySection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }

        $home_content->university_title = $request->sub_banner_title;

        if ($request->hasFile('university_image')) {
            @unlink(public_path('upload/home_content/' . $home_content->university_image));
            $fileName = time() . '_university_image.' . $request->university_image->getClientOriginalExtension();
            $request->university_image->move(public_path('upload/home_content'), $fileName);
            $home_content->university_image = $fileName;
        }
        $home_content->save();


        return redirect()->back()->with('success', 'University Section Update Successfully');
    }

    public function setHomeLocationSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->university_location_title = $request->university_location_title;
        $home_content->save();


        if ($request->type_loction_id) {
            foreach ($request->type_loction_id as $key => $value) {
                $homecontentlocation = new HomeContentLocation;
                $homecontentlocation->type_loction_id = $value;
                $homecontentlocation->location_id = $request->location_id[$key];
                $homecontentlocation->save();
            }
        }

        if (isset($request->old_type_loction_id)) {
            if ($request->old_type_loction_id) {
                foreach ($request->old_type_loction_id as $k => $value) {
                    $homecontentlocation = HomeContentLocation::find($k);
                    $homecontentlocation->type_loction_id = $value;
                    $homecontentlocation->location_id = $request->old_location_id[$k];
                    $homecontentlocation->save();
                }
            }
        }
        if ($request->delete_home_content_location) {
            foreach ($request->delete_home_content_location as $value) {
                $homecontentlocation = HomeContentLocation::find($value);
                $homecontentlocation->delete();
            }
        }
        return redirect()->back()->with('success', 'Location Section Update Successfully');
    }


    public function getLocationU($id)
    {
        if ($id == 1) {
            $location = Continent::get();
        } elseif ($id == 2) {
            $location = Country::get();
        } elseif ($id == 3) {
            $location  = State::get();
        } elseif ($id == 4) {
            $location  = City::get();
        }

        return $location;
    }


    public function setCourseSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->course_title = $request->course_title;
        $home_content->save();
        return redirect()->back()->with('success', 'Course Section Update Successfully');
    }

    public function setPartnerSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->partner_title = $request->partner_title;
        $home_content->save();
        return redirect()->back()->with('success', 'Partner Section Update Successfully');
    }

    public function setLearnSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->learn_title = $request->learn_title;
        if ($request->hasFile('learn_image')) {
            @unlink(public_path('upload/home_content/' . $home_content->learn_image));
            $fileName = time() . '_learn_image.' . $request->learn_image->getClientOriginalExtension();
            $request->learn_image->move(public_path('upload/home_content'), $fileName);
            $home_content->learn_image = $fileName;
        }

        if ($request->title_old) {
            foreach ($request->title_old as $key => $value) {
                $learn_text = HomeContentItem::find($key);
                $learn_text->title = $value;
                $learn_text->url = $request->url_old[$key];
                $learn_text->description = $request->description_old[$key];
                $learn_text->type = "homepage";
                $learn_text->save();
            }
        }

        if ($request->old_delete_learn_data) {
            foreach ($request->old_delete_learn_data as $value) {
                $learn_text = HomeContentItem::find($value);
                $learn_text->delete();
            }
        }

        if ($request->title) {
            foreach ($request->title as $key => $value) {
                $learn_text = new HomeContentItem();
                $learn_text->title = $value;
                $learn_text->url = $request->url[$key];
                $learn_text->description = $request->description[$key];
                $learn_text->type = "homepage";
                $learn_text->save();
            }
        }

        $home_content->save();
        return redirect()->back()->with('success', 'Learn Anything Section Update Successfully');
    }

    public function setMediaPartnerSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->client_title = $request->client_title;
        $home_content->save();
        return redirect()->back()->with('success', 'Media Partner Section Update Successfully');
    }

    public function setCountingSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->counting_title = $request->counting_title;

        $home_content->count_text_1 = $request->count_text_1;
        $home_content->count_text_2 = $request->count_text_2;
        $home_content->count_text_3 = $request->count_text_3;
        $home_content->count_text_4 = $request->count_text_4;

        $home_content->count_num_1 = $request->count_num_1;
        $home_content->count_num_2 = $request->count_num_2;
        $home_content->count_num_3 = $request->count_num_3;
        $home_content->count_num_4 = $request->count_num_4;
        $home_content->save();
        return redirect()->back()->with('success', 'Counting Section Update Successfully');
    }

    public function setTestimonialsSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->review_title1 = $request->review_title1;
        $home_content->review_title2 = $request->review_title2;
        $home_content->save();
        return redirect()->back()->with('success', 'Testimonials Section Update Successfully');
    }

    public function setPackageSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->package_title = $request->package_title;
        $home_content->package_text = $request->package_text;
        $home_content->package_btn = $request->package_btn;
        $home_content->package_btn_url = $request->package_btn_url;
        $home_content->save();
        return redirect()->back()->with('success', 'Package Section Update Successfully');
    }

    public function setQuestionSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->question_title = $request->question_title;
        $home_content->ques_short_des = $request->ques_short_des;
        $home_content->question_button_text = $request->question_button_text;
        $home_content->question_button_url = $request->question_button_url;
        if ($request->hasFile('question_image')) {
            @unlink(public_path('upload/home_content/' . $home_content->question_image));
            $fileName = time() . '_question_image.' . $request->question_image->getClientOriginalExtension();
            $request->question_image->move(public_path('upload/home_content'), $fileName);
            $home_content->question_image = $fileName;
        }
        $home_content->save();
        return redirect()->back()->with('success', 'Question Section Update Successfully');
    }

    public function setRegisterSection(Request $request)
    {
        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }
        $home_content->register_title = $request->register_title;
        $home_content->register_des = $request->register_des;
        if ($request->hasFile('register_image')) {
            @unlink(public_path('upload/home_content/' . $home_content->register_image));
            $fileName = time() . '_banner-image.' . $request->register_image->getClientOriginalExtension();
            $request->register_image->move(public_path('upload/home_content'), $fileName);

            $home_content->register_image = $fileName;
        }
        $home_content->save();
        return redirect()->back()->with('success', 'Register Section Update Successfully');
    }

    public function getBlogItems(Request $request)
    {
        $category = $request->category;
        $items = [];

        if ($category == 'blog') {
            $items = Blog::select('id', 'title')->get();
        } elseif ($category == 'event') {
            $items = Event::select('id', 'name')->get();
        } elseif ($category == 'expo') {
            $items = Expo::select('id', 'title')->get();
        }

        return response()->json(['items' => $items]);
    }

    public function setLatestUpdates(Request $request)
    {
        $categories = $request->input('latest_updates_category');
        $items = $request->input('latest_updates_item');

        $categoryItemPairs = [];

        if ($categories) {
            foreach ($categories as $index => $category) {
                $categoryItemPairs[] = [$category => $items[$index]];
            }
        }

        $home_content = HomeContentSetup::first();
        if ($home_content == null) {
            $home_content = new HomeContentSetup;
        }

        $home_content->latest_updates = json_encode($categoryItemPairs);
        $home_content->save();

        return redirect()->back()->with('success', 'Latest Updates section has been updated!');
    }


    public function footerActivityGallery(Request $request)
    {
        try {
            $footerImage = FooterImage::first();

            if (!$footerImage) {
                $footerImage = new FooterImage();
            }

            // Handling gallery images
            $photoGalleryImages = [];
            if ($request->hasFile('photo_gallery_image')) {
                foreach ($request->file('photo_gallery_image') as $key => $file) {
                    $fileName = 'gallery_' . rand() . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/footer_image'), $fileName);
                    $photoGalleryImages[$key] = url('upload/footer_image/' . $fileName);
                }
            }

            $oldPhotoGalleryImages = $request->old_photo_gallery_image ?? [];
            $mergedPhotoGalleryImages = $oldPhotoGalleryImages;

            foreach ($photoGalleryImages as $key => $url) {
                if (isset($mergedPhotoGalleryImages[$key]) && file_exists(public_path('upload/footer_image/' . basename($mergedPhotoGalleryImages[$key])))) {
                    unlink(public_path('upload/footer_image/' . basename($mergedPhotoGalleryImages[$key])));
                }

                $mergedPhotoGalleryImages[$key] = $url;
            }
            $data['images'] = $mergedPhotoGalleryImages;
            $data['image_titles'] = $request->image_title;
            $data['image_positions'] = $request->image_position;

            $footerImage->footer_image = json_encode($data);
            $footerImage->save();

            return redirect()->back()->with('success', 'Footer Activity Image Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}