<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UniversityController as FrontendniversityController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Backend\CKEditorUploadController;
use App\Http\Controllers\Backend\GetConsultation\GetConsultationController;
use App\Http\Controllers\Backend\Landing\LandingPageController;
use App\Http\Controllers\Backend\Student_Appliction\StudentApplictionController;
use App\Http\Controllers\Backend\subscriber\SubscriberController;
use App\Http\Controllers\Backend\University\UniversityController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\Frontend\UserLoginController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\EventCartController;
use App\Http\Controllers\Frontend\CourseUserSubscriptionsController;
use App\Http\Controllers\Frontend\EbookCartController;
use App\Http\Controllers\Frontend\InstructorCourseController;
use App\Http\Controllers\Frontend\StudentApplicationController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ebook\EbookAudioController;
use App\Http\Controllers\User\ebook\EbookVideoController;
use App\Http\Controllers\User\ebook\EbookController;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/user', function (Request $request) {
    // return auth()->check();
    if (!auth()->check()) {
        return response()->json([
            'message' => 'No user found'
        ], 401);
    }

    $user = auth()->user();
    return response()->json([
        'user' => $user
    ]);
});

// Route::middleware(['auth:sanctum', 'provide.user.data'])->get('/user', function (Request $request) {
//     // This route will now always include user data in the response
//     return response()->json([
//         'message' => 'User data retrieved successfully',
//     ]);
// });


Route::middleware(['accessLogin'])->group(function () {

    Route::get('change-currency/{name}', [FrontendController::class, 'changeCurrency'])->name('frontend.change_currency');
    //Home Route
    Route::get('/home', [FrontendController::class, 'index'])->name('home');
    Route::get('/typeahead-search', [FrontendController::class, 'typeaHeadSearch'])->name('home.head_search');

    // Route::group(['middleware' => 'redirectIfAuthenticated'], function () {
    //     Route::get('/sign-in', [FrontendController::class, 'signin'])->name('frontend.signin');
    //     Route::get('/partner-sign-in', [FrontendController::class, 'consultantSignin'])->name('frontend.consultant_signin');
    //     Route::get('/register', [FrontendController::class, 'register'])->name('frontend.register');
    //     Route::get('/partner-register', [FrontendController::class, 'consultantRegister'])->name('frontend.consultant_register');
    // });

    
    Route::post('/sign-in', [UserLoginController::class, 'userSignin'])->name('frontend.sign_in');
    Route::post('/partner-sign-in', [UserLoginController::class, 'consultentSignin'])->name('frontend.consultent_sign_in');
    Route::post('/register', [UserLoginController::class, 'userRegister'])->name('frontend.set_register');
    Route::post('/verify', [UserLoginController::class, 'userVerify'])->name('frontend.set_verify');
    Route::post('/partner-register', [UserLoginController::class, 'partnerRegister'])->name('frontend.set_register_partner');
    
    Route::get('/send-verification-email', [UserLoginController::class, 'sendVerificationEmail'])->name('frontend.send_verification_email');

    

    //Subscription Route
    Route::post('/subscription', [SubscriberController::class, 'add_subscription'])->name('frontend.subscription');

    //Page Route
    Route::get('/founders-co-founders', [FrontendController::class, 'founders_co_founders'])->name('frontend.founders_co_founders');
    Route::get('/our-services', [FrontendController::class, 'our_services'])->name('frontend.our_services');
    Route::get('/single-services/{title}', [FrontendController::class, 'single_services'])->name('frontend.single_service');
    Route::get('/why-china', [FrontendController::class, 'why_china'])->name('frontend.why_china');
    Route::get('/about-china', [FrontendController::class, 'about_china'])->name('frontend.about_china');
    Route::get('/company-details', [FrontendController::class, 'company_details'])->name('frontend.company_details');
    Route::get('/gallery', [FrontendController::class, 'gallery'])->name('frontend.gallery');
    Route::get('/authorization-letters', [FrontendController::class, 'authorization_letters'])->name('frontend.authorization_letters');
    Route::get('/activities', [FrontendController::class, 'activities'])->name('frontend.activities');
    Route::get('/activity-details/{key}', [FrontendController::class, 'activity_details'])->name('frontend.activity_details');
    Route::get('/learner', [FrontendController::class, 'learner'])->name('frontend.learner');
    Route::get('/instructor', [FrontendController::class, 'instructor'])->name('frontend.instructor');
    
    Route::get('/scholarship', [FrontendController::class, 'scholarship'])->name('frontend.scholarship');
    Route::get('/scholarship-program-filter', [FrontendController::class, 'ajaxScholarshipProgramFilter'])->name('frontend.scholarship.program_filter');
    
    //office details Route
    Route::get('/office/{office_id}', [FrontendController::class, 'office_details'])->name('frontend.office_details');

    //Enterprise or Contact Page Route
    Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
    Route::middleware(['userCheck:1'])->group(function () {
        Route::post('/frontend/user/contact/store', [FrontendController::class, 'userContactStore'])->name('frontend.user.contact.store');
    });
    //admin Contact Show
    Route::post('/user/contact/index', [FrontendController::class, 'contactIndex'])->name('user.contact.index.post');
    //Library Page Route
    Route::get('/library', [FrontendController::class, 'library'])->name('frontend.library');

    //Event List Page Route
    Route::get('/event-list', [FrontendController::class, 'eventList'])->name('frontend.event_list');
    Route::get('/event-details/{id}', [FrontendController::class, 'eventDetails'])->name('frontend.event.details');
    
    //Expo List Page Route
    Route::get('/expo-list', [FrontendController::class, 'expoList'])->name('frontend.expo_list');
    // Route::get('/expo-details/{id}', [FrontendController::class, 'expoDetails'])->name('frontend.expo.details');

    Route::middleware(['userCheck'])->group(function () {
        Route::post('/event-massage', [FrontendController::class, 'eventMassage'])->name('event.details.massage');
    });
    //ajax event lode
    Route::get('/get-events-all', [FrontendController::class, 'getEvents']);

    //subscribe_details
    Route::get('/subscribe-details', [FrontendController::class, 'subscribeDetails'])->name('frontend.subscribe_details');

    //Event Ajax
    Route::get('/event-category-show-ajax/{id}', [FrontendController::class, "getEventByCat"]);
    Route::get('/event-relese-show-ajax/{id}', [FrontendController::class, "getEventRelese"]);

    //blog Ajax
    Route::get('/blog-category-show-ajax/{id}', [FrontendController::class, "getBlogByCat"]);
    Route::get('/blog-sort-by-show-ajax/{id}', [FrontendController::class, "getBlogSortBy"]);


    //Privacy Policy Page Route
    Route::get('/payment-process', [FrontendController::class, 'paymentProcess'])->name('frontend.payment_process');
    Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('frontend.privacy_policy');
    Route::get('/refund-policy', [FrontendController::class, 'refundPolicy'])->name('frontend.refund_policy');
    Route::get('/terms-conditions', [FrontendController::class, 'termsConditions'])->name('frontend.terms_conditions');
    Route::get('/maestro-class', [FrontendController::class, 'maestroClass'])->name('frontend.maestro_class');
    Route::get('/maestro-class-details/{id}', [FrontendController::class, 'maestroClassDetails'])->name('frontend.maestro_class_details');
    Route::get('/faqs', [FrontendController::class, 'faq'])->name('frontend.faq');
    Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');


    //Blog Page Route
    Route::get('/blogs', [FrontendController::class, 'blog'])->name('frontend.blog');
    Route::get('/blog_details/{id}', [FrontendController::class, 'blogDetails'])->name('frontend.blog_details');

    Route::middleware(['userCheck'])->group(function () {
        Route::post('/blog_like/{id}/toggle-like', [LikeController::class, 'toggleLike'])->name('frontend.blog_like');
        Route::post('/blog_commet', [CommentController::class, 'blogComment'])->name('frontend.blog_comment');
    });

    //Forget password and reset password route start
    Route::get('forgot-password', [UserLoginController::class, 'forgotPassword'])->name('forget.password');
    Route::post('forgot-password', [UserLoginController::class, 'sentMailforgotPassword'])->name('forget.send_mail_f_password');

    Route::get('forgot-password/{id}', [UserLoginController::class, 'emailForgotPassword']);
    Route::post('forgot-password/{id}', [UserLoginController::class, 'resetForgotPassword'])->name('reset.forgot_password');
    //Forget password and reset password route end

    //Admin password and reset password route start
    Route::get('admin-forgot-password', [UserLoginController::class, 'adminForgotPassword'])->name('admin.forget.password');
    Route::get('admin-forgot-password/{id}', [UserLoginController::class, 'emailAdminForgotPassword']);
    Route::post('admin-forgot-password/{id}', [UserLoginController::class, 'resetAdminForgotPassword'])->name('admin-reset.forgot_password');
    //Admin password and reset password route end

    //Social Login Start Here
    Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
    //facebook
    Route::get('auth/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);

    //Social Login End Here
    Route::get('/master-course-category-show-ajax/{id}', [FrontendController::class, 'masterCourseByCatAjax']);

    //Course cart routes hetre-----------
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');

    // Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::get('/remove-from-cart/{id}', [CartController::class, 'remove'])->name('remove.from.cart');


    // Route::get('ebookcart', [EbookCartController::class, 'cartEbook'])->name('cart');
    Route::get('add-to-ebook-cart/{id}', [EbookCartController::class, 'addToEbookCart'])->name('add.to.ebook.cart');


    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order');

    //PayPal
    Route::get('/checkout-payment', [OrderController::class, 'checkoutPayment'])->name('frontend.checkout_payment');
    Route::get('/cancel-payment', [OrderController::class, 'paymentCancel'])->name('cancel.payment');
    Route::get('/payment-success', [OrderController::class, 'paymentSuccess'])->name('success.payment');
    Route::get('/stripe-cancel-payment', [OrderController::class, 'stripePaymentCancel'])->name('stripe.cancel.payment');
    Route::get('/stripe-payment-success', [OrderController::class, 'stripePaymentSuccess'])->name('stripe.success.payment');
    Route::post('/get_coupon_amount_by_code/{code}', [OrderController::class, 'getCouponByCode']);

    Route::middleware('auth')->group(function () {
        Route::get('/order-payment', [OrderController::class, 'orderPayment'])->name('order.payment');
        Route::get('/package-payment/{type}/{id}', [OrderController::class, 'orderPackagePayment'])->name('package.payment');
        Route::post('/order-payment-confirm', [OrderController::class, 'orderPaymentConfirm'])->name('order.payment.confirm');
        Route::get('/order-success/{order_number}', [OrderController::class, 'orderComplete'])->name('order.success');
    });
    //Course cart routes End-----------

    //Course subscriptions cart routes hetre-----------
    Route::get('course/use/subscriptions/{id}', [CourseUserSubscriptionsController::class, 'CourseUseSubscriptions'])->name('course.use.subscriptions');
    Route::get('course/use/subscriptions_checkout', [CourseUserSubscriptionsController::class, 'CourseUseSubscriptionsCheck'])->name('user.subscriptions_checkout');
    Route::get('/remove-from-cart-subscriptions/{id}', [CourseUserSubscriptionsController::class, 'subscriptionsCartRemove'])->name('remove-from-cart-subscriptions');

    Route::middleware(['userCheck:1'])->group(function () {
        Route::post('/package/subscription/order', [CourseUserSubscriptionsController::class, 'packageSubscriptionOrder'])->name('package.subscription.order');
    });
    //Course subscriptions cart routes End-----------

    //event cart routes hetre-----------
    Route::get('/eventcart/{id}', [EventCartController::class, 'eventCart'])->name('eventcart');
    Route::get('/event-chack-out', [EventCartController::class, 'eventCheckOut'])->name('eventchackout');
    Route::get('/remove-from-cart-event/{id}', [EventCartController::class, 'eventcartremove'])->name('remove-from-cart-event');

    Route::middleware(['userCheck:1'])->group(function () {
        Route::post('/order-event', [EventCartController::class, 'eventCartStore'])->name('eventorder');
    });
    //event cart routes End-----------

    // E-book
    Route::get('/e-book-list', [FrontendController::class, 'eBook'])->name('frontend.ebook_list');
    Route::get('/e-book-details/{id}', [FrontendController::class, 'eBookDetails'])->name('frontend.ebook_details');
    Route::get('/e-book/download/{id}', [FrontendController::class, 'eBookDownload'])->name('frontend.ebook_download');

    Route::get('/e-book/video/download/{id}', [FrontendController::class, 'eBookVideoDownload'])->name('frontend.ebook_video_download');
    Route::get('/e-book/audio/download/{id}', [FrontendController::class, 'eBookAudioDownload'])->name('frontend.ebook_audio_download');

    Route::get('/ebook-category-show-ajax/{id}', [FrontendController::class, "getEbookByCat"]);


    // E-book-audio
    Route::get('/e-book-audio-list', [FrontendController::class, 'eBookAudio'])->name('frontend.ebook_audio_list');
    Route::get('/e-book-details-audio/{id}', [FrontendController::class, 'eBookAudioDetails'])->name('frontend.ebook_audio_details');
    //Route::get('/e-book/download/{id}', [FrontendController::class, 'eBookDownload'])->name('frontend.ebook_download');
    Route::get('/e-/e-audio/download/{id}', [FrontendController::class, 'eAudioDownload'])->name('frontend.e_audio_download');

    Route::get('/ebook-category-audio-show-ajax/{id}', [FrontendController::class, "getEbookAudioByCat"]);


    // E-book-video
    Route::get('/e-book-video-list', [FrontendController::class, 'eBookVideo'])->name('frontend.ebook_video_list');
    Route::get('/e-book-details-video/{id}', [FrontendController::class, 'eBookVideoDetails'])->name('frontend.ebook_video_details');
    Route::get('/e-book/e-video/download/{id}', [FrontendController::class, 'eVideoDownload'])->name('frontend.e_video_download');
    Route::get('/ebook-category-video-show-ajax/{id}', [FrontendController::class, "getEbookVideoByCat"]);


    //university
    Route::get('continent/university/course_list/{id}', [FrontendController::class, 'continentUniversityCourseList'])->name('frontend.continent.university_course_list');
    Route::get('/get-course-degree/{id}', [FrontendController::class, "getCourseDegree"]);
    Route::get('country/university/course_list/{id}', [FrontendController::class, 'countryUniversityCourseList'])->name('frontend.country.university_course_list');
    Route::get('state/university/course_list/{id}', [FrontendController::class, 'stateUniversityCourseList'])->name('frontend.state.university_course_list');
    Route::get('city/university/course_list/{id}', [FrontendController::class, 'cityUniversityCourseList'])->name('frontend.city.university_course_list');
    Route::get('applications', [StudentApplicationController::class, 'applications'])->name('frontend.applications')->middleware(['userCheck']);


    Route::post('consultants-student-appliction-list-ajax', [StudentApplicationController::class, "indexAjax"])->name('consultants.student_appliction_list_ajax');

    Route::get('/get-document_on_change/{id}', [FrontendController::class, "getContinentCourse"]);

    //university  Course list
    Route::get('admission-apply', [FrontendController::class, 'admissionApply'])->name('frontend.university_admission_apply');
    Route::get('course_list', [FrontendController::class, 'universityCourseList'])->name('frontend.university_course_list');
    Route::get('single_course/{id}', [FrontendController::class, 'singleCourse'])->name('frontend.single_course');
    Route::get('/get-sort-course-list/{cat}', [FrontendController::class, "getAjaxCourseList"]);
    Route::get('ajax-course-filter', [FrontendController::class, "ajaxFilterCourse"])->name('frontend.ajax_course_filter');
});

Route::get('apply-now', [FrontendController::class, 'applyNow'])->name('frontend.apply_now');

//get ajax get-sort-category-course
Route::get('/apply-cart/{id}/', [StudentApplicationController::class, "applyCart"])->name('apply_cart');
// Route::get('/apply-admission/{id}/', [StudentApplicationController::class, "applyAdmission"])->name('apply_admission');


Route::get('/application/detail/{id}', [StudentApplicationController::class, "applicationDetails"])->name('application.details');
Route::post('/application/program/delete', [StudentApplicationController::class, "applyCartDelete"])->name('application.program.delete');

// university application 
Route::post('application/personalUni', [StudentApplicationController::class, 'applicationPersonalInfoUni'])->name('application.personalUni');


Route::post('application/personal/{id}', [StudentApplicationController::class, 'applicationPersonalInfo'])->name('application.personal');
Route::post('application/home_address/{id}', [StudentApplicationController::class, 'applicationHomeAddress'])->name('application.home_address');
Route::post('application/post_address/{id}', [StudentApplicationController::class, 'applicationPostAddress'])->name('application.post_address');
Route::post('application/education/{id}', [StudentApplicationController::class, 'applicationEducation'])->name('application.education');
Route::post('application/work_experience/{id}', [StudentApplicationController::class, 'applicationWorkExperience'])->name('application.work_experience');
Route::post('application/family_finance/{id}', [StudentApplicationController::class, 'applicationFamilyFinance'])->name('application.family_finance');
Route::post('application/optional_service/{id}', [StudentApplicationController::class, 'applicationOptionalService'])->name('application.optional_service');
Route::post('add-attachment/upload/{id?}', [StudentApplicationController::class, 'applicationAttachmentUpload'])->name('application.add-attachment.upload');

Route::get('get-attachments/{id}', [StudentApplicationController::class, 'applicationGetAttachments'])->name('application.get-attachments');
Route::post('attachment/download/{id}', [StudentApplicationController::class, 'attachmentDownload'])->name('application.attachments.download');
Route::post('attachment/delete/{id}', [StudentApplicationController::class, 'attachmentDelete'])->name('application.attachment.delete');
Route::post('application/submit/{id}', [StudentApplicationController::class, 'submitAppliction'])->name('application.submit_appliction');


Route::get('/my-applications', [StudentApplicationController::class, 'myOrderedApplication'])->name('frontend.my_application_list');
Route::get('/my-applications/doc/all-download/{application_id}', [StudentApplictionController::class, 'allDocumentDownload'])->name('frontend.application-all-document-download');
Route::get('/my-applications/form/download/{id}', [StudentApplictionController::class, 'applicationFormDownload'])->name('frontend.application-form-download');


Route::get('get-country/{continent_id}', [FrontendController::class, 'getCountries'])->name('get_country_list');
Route::get('get-state/{country_id}', [FrontendController::class, 'getStates'])->name('get_state_list');
Route::get('get-city/{state_id}', [FrontendController::class, 'getCities'])->name('get_city_list');

Route::get('notices', [LandingPageController::class, 'all_notice'])->name('landing_page.all_notice');
Route::get('notice/{slug}', [LandingPageController::class, 'show_page'])->name('landing_page.show_page');

Route::get('get-free-consultation', [GetConsultationController::class, 'get_consultation'])->name('frontend.get_consultation');
Route::post('get-free-consultation', [GetConsultationController::class, 'get_consultation_store'])->name('frontend.get_consultation_store');

Route::post('/ckeditor/upload', [CKEditorUploadController::class, 'uploadImage'])->name('ckeditor.upload');


Route::get('/validate-email', function (Request $request) {
    $email = $request->query('email');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response()->json(['isValid' => false, 'message' => 'Invalid email format.']);
    }

    $domain = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($domain, 'MX')) {
        return response()->json(['isValid' => false, 'message' => 'Invalid domain.']);
    }

    return response()->json(['isValid' => true, 'message' => 'Valid email address.']);
});

/**
 * Sitemap
 */
Route::get('/sitemap.xml', function () {
    return response()->file(public_path('sitemap.xml'));
});


Route::get('/apply-admission-university', [StudentApplicationController::class, "applyAdmissionUniversity"])->name('apply_admission_university');

Route::get('/success', [StudentApplicationController::class, "successApplication"])->name('success.application');



// University 
Route::prefix('list')->group(function () {
    Route::get('all-universities', [FrontendniversityController::class, "index"])->name('frontend.all_universities_list_new');
    Route::get('all-universities/{id}', [FrontendniversityController::class, "single"])->name('frontend.all_universities_list');
    Route::get('university-details/{id}', [FrontendniversityController::class, "universityDetails"])->name('frontend.university_details');
    Route::post('question', [FrontendniversityController::class, "question"])->name('frontend.question');
});

Route::get('/testimonial', [FrontendController::class, "testimonial"])->name('frontend.testimonial');