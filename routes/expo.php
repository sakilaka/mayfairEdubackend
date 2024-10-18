<?php

use App\Http\Controllers\Backend\Expo\ExpoController;
use App\Http\Controllers\Backend\Expo\ExpoDelegatesController;
use App\Http\Controllers\Backend\Expo\ExpoMediaController;
use App\Http\Controllers\Backend\Expo\ExpoModuleContentsController;
use App\Http\Controllers\Backend\Expo\ExpoSiteController;
use App\Http\Controllers\Backend\Expo\ExpoTestimonialsController;
use App\Http\Controllers\Expo\CaptchaController;
use App\Http\Controllers\Expo\ExpoLoginController;
use App\Http\Controllers\Expo\ExpoModuleController;
use App\Http\Controllers\Expo\ExpoUserController;
use App\Http\Controllers\Frontend\UserLoginController;
use Illuminate\Support\Facades\Route;

/**
 * Expo Routes (Admin)
 */
Route::prefix('expo')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    Route::get('list', [ExpoController::class, "index"])->name('admin.expo.index');
    Route::get('create', [ExpoController::class, "create"])->name('admin.expo.create');
    Route::post('store', [ExpoController::class, "store"])->name('admin.expo.store');
    Route::get('edit/{id}', [ExpoController::class, "edit"])->name('admin.expo.edit');
    Route::post('update/{id}', [ExpoController::class, "update"])->name('admin.expo.update');
    Route::post('delete', [ExpoController::class, "destroy"])->name('admin.expo.delete');

    Route::prefix('{expo_id}/testimonials')->group(function () {
        Route::get('list', [ExpoTestimonialsController::class, "expo_testimonial_index"])->name('admin.expo.testimonial.index');
        Route::get('manage/{testimonial_key?}', [ExpoTestimonialsController::class, "expo_testimonial_manage"])->name('admin.expo.testimonial.manage');
        Route::post('update/{testimonial_key?}', [ExpoTestimonialsController::class, "expo_testimonial_update"])->name('admin.expo.testimonial.update');
        Route::get('delete/{testimonial_key?}', [ExpoTestimonialsController::class, "expo_testimonial_destroy"])->name('admin.expo.testimonial.delete');
    });

    Route::prefix('{expo_id}/overseas-delegates')->group(function () {
        Route::get('list', [ExpoDelegatesController::class, "expo_delegate_index"])->name('admin.expo.delegate.index');
        Route::get('manage/{delegate_key?}', [ExpoDelegatesController::class, "expo_delegate_manage"])->name('admin.expo.delegate.manage');
        Route::post('update/{delegate_key?}', [ExpoDelegatesController::class, "expo_delegate_update"])->name('admin.expo.delegate.update');
        Route::get('delete/{delegate_key?}', [ExpoDelegatesController::class, "expo_delegate_destroy"])->name('admin.expo.delegate.delete');
    });

    Route::prefix('{expo_id}/gallery')->group(function () {
        Route::get('/', [ExpoMediaController::class, 'expo_gallery_page'])->name('admin.expo.media.gallery');
        Route::post('update', [ExpoMediaController::class, 'expo_gallery_page_update'])->name('admin.expo.media.gallery.update');
    });

    Route::prefix('{expo_id}/video')->group(function () {
        Route::get('/', [ExpoMediaController::class, 'expo_video_page'])->name('admin.expo.media.video');
        Route::post('update', [ExpoMediaController::class, 'expo_video_page_update'])->name('admin.expo.media.video.update');
    });

    Route::prefix('exhibitors')->group(function () {
        Route::get('list', [ExpoController::class, "exhibitors_index"])->name('admin.expo.exhibitors.index');
        Route::post('store', [ExpoController::class, "exhibitors_store"])->name('admin.expo.exhibitors.store');
        Route::get('edit-exhibitor/{exhibitor_id}', [ExpoController::class, "exhibitor_edit"])->name('admin.expo.exhibitor.edit');
        Route::post('edit-exhibitor/{exhibitor_id}', [ExpoController::class, "exhibitor_update"])->name('admin.expo.exhibitor.update');
        Route::post('delete', [ExpoController::class, "exhibitors_destroy"])->name('admin.expo.exhibitors.delete');
        Route::get('toggle-show-in-expo/{id}', [ExpoController::class, "exhibitors_toggle_show_in_expo"])->name('admin.expo.exhibitors.toggle_show_in_expo');
        Route::post('postion-in-expo', [ExpoController::class, "exhibitors_postion_in_expo"])->name('admin.expo.exhibitors.position_in_expo');
    });

    Route::prefix('manage-ui-contents')->group(function () {
        Route::get('contacts', [ExpoModuleContentsController::class, 'ui_contact_page'])->name('admin.expo.ui.contact');
        Route::post('contacts', [ExpoModuleContentsController::class, 'ui_contact_page_update'])->name('admin.expo.ui.contact.update');

        Route::get('galleries', [ExpoModuleContentsController::class, 'ui_gallery_page'])->name('admin.expo.ui.gallery');
        Route::post('galleries', [ExpoModuleContentsController::class, 'ui_gallery_page_update'])->name('admin.expo.ui.gallery.update');

        Route::get('videos', [ExpoModuleContentsController::class, 'ui_video_page'])->name('admin.expo.ui.video');
        Route::post('videos', [ExpoModuleContentsController::class, 'ui_video_page_update'])->name('admin.expo.ui.video.update');
    });

    Route::prefix('users')->group(function () {
        Route::get('{type}', [ExpoController::class, 'expo_users'])->name('admin.expo.users');
        Route::get('{type}/add-participator', [ExpoController::class, 'expo_add_participator'])->name('admin.expo.add_participator');
        Route::post('{type}/add-participator', [ExpoController::class, 'expo_add_participator_store'])->name('admin.expo.add_participator.store');

        Route::get('view-participant', [ExpoController::class, 'expo_view_participant'])->name('admin.expo.view_participant');
    });

    Route::post('send-mail', [ExpoController::class, 'expo_send_mail'])->name('admin.expo.send_mail');
    Route::post('send-mail-all', [ExpoController::class, 'expo_send_mail_all'])->name('admin.expo.send_mail_all');
    Route::post('start-queue-mail', [ExpoController::class, 'expo_start_queue_mail'])->name('admin.expo.start_queue_mail');
});

/**
 * Expo Routes (User)
 */
Route::prefix('expo')->middleware(['accessLogin'])->group(function () {
    Route::prefix('user')->middleware(['userCheck'])->group(function () {
        Route::get('/dashboard', [ExpoUserController::class, 'dashboard'])->name('expo.user.dashboard');
        Route::get('/profile', [ExpoUserController::class, 'index'])->name('expo.user.profile');
        Route::get('/profile/{id}', [ExpoUserController::class, 'editUserInfo'])->name('expo.user.edit_profile');
        Route::post('/update/profile/{id}', [ExpoUserController::class, 'updateUserInfo'])->name('expo.user.profile_info_update');

        Route::post('/security/{id}', [UserLoginController::class, 'setChangePassword'])->name('expo.user.password_change');
        Route::get('/user-logout', [UserLoginController::class, 'userLogout'])->name('expo.user.logout');

        // tickets
        Route::get('my-tickets', [ExpoUserController::class, 'my_tickets'])->name('expo.user.my_tickets');
    });
});

/**
 * Page Routes (Global)
 */
Route::get('exhibitor/{exhibitor_id}/details', [ExpoController::class, "exhibitor_details"])->name('expo.exhibitor.details');

Route::get('expo/details/{id}', [ExpoModuleController::class, 'expoDetails'])->name('expo.details');
Route::get('expo/{unique_id}/page/exhibitors', [ExpoModuleController::class, 'exhibitors'])->name('expo.exhibitors');
Route::get('expo/{unique_id}/page/schedule', [ExpoModuleController::class, 'schedule'])->name('expo.schedule');
Route::get('expo/{unique_id}/page/testimonials', [ExpoModuleController::class, 'testimonials'])->name('expo.testimonials');
Route::get('expo/{unique_id}/page/delegates', [ExpoModuleController::class, 'delegates'])->name('expo.delegates');
Route::get('expo/{unique_id}/page/gallery', [ExpoModuleController::class, 'gallery'])->name('expo.gallery');
Route::get('expo/{unique_id}/page/video', [ExpoModuleController::class, 'video'])->name('expo.video');

// Route::get('expo/about-us', [ExpoModuleController::class, 'about_us'])->name('expo.about_us');
// Route::get('expo/contact', [ExpoModuleController::class, 'contact'])->name('expo.contact');
// Route::get('expo/gallery', [ExpoModuleController::class, 'gallery'])->name('expo.gallery');

Route::get('expo/{unique_id}/login', [ExpoLoginController::class, 'login_page'])->name('expo.login.page');
Route::post('expo/{unique_id}/login', [ExpoLoginController::class, 'attempt_login'])->name('expo.login.attempt');
Route::get('logout', [ExpoLoginController::class, 'destroy'])->name('logout');

Route::get('expo/{unique_id}/sign-up', [ExpoModuleController::class, 'expo_form'])->name('expo.sign-up');
Route::post('expo/{unique_id}/sign-up', [ExpoModuleController::class, 'expo_form_submit'])->name('expo.sign-up.submit');
Route::get('expo/{unique_id}/ticket/{ticket_no}', [ExpoModuleController::class, 'expo_ticket'])->name('expo.expo-ticket');

/**
 * Captcha Routes
 */
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha']);
Route::post('/verify-captcha', [CaptchaController::class, 'verifyCaptcha']);

Route::post('/send-verification-email', [CaptchaController::class, 'sendVerificationEmail']);
Route::post('/verify-code', [CaptchaController::class, 'verifyCode']);
