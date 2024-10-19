<?php

use App\Http\Controllers\Expo\ExpoModuleController;
use App\Http\Controllers\Backend\Expo\ExpoAuthController;
use App\Http\Controllers\Backend\Expo\ExpoCaptchaController;
use App\Http\Controllers\Backend\Expo\ExpoController;
use App\Http\Controllers\Backend\Expo\ExpoParticipantController;
use App\Http\Controllers\Backend\Expo\ExpoUserPanelController;

use App\Http\Controllers\Backend\Expo\Main\ExpoTestimonialsController;
use App\Http\Controllers\Backend\Expo\Main\ExpoDelegatesController;
use App\Http\Controllers\Backend\Expo\Main\ExpoMediaController;

use App\Http\Controllers\Backend\Expo\External\ExpoExternalModuleContentsController;
use App\Http\Controllers\Backend\Expo\External\ExpoExternalExhibitorController;
use App\Http\Controllers\Backend\Expo\Main\ExpoMainExhibitorController;
use App\Http\Controllers\Frontend\UserLoginController;
use Illuminate\Support\Facades\Route;

/**
 * Expo Routes (Admin) - start --------------------------
 */
Route::prefix('expo')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    Route::get('list', [ExpoController::class, "index"])->name('admin.expo.index');
    Route::get('create', [ExpoController::class, "create"])->name('admin.expo.create');
    Route::post('store', [ExpoController::class, "store"])->name('admin.expo.store');
    Route::get('edit/{id}', [ExpoController::class, "edit"])->name('admin.expo.edit');
    Route::post('update/{id}', [ExpoController::class, "update"])->name('admin.expo.update');
    Route::post('delete', [ExpoController::class, "destroy"])->name('admin.expo.delete');

    Route::prefix('{expo_id}/exhibitors')->group(function () {
        Route::get('list', [ExpoMainExhibitorController::class, "exhibitors_index"])->name('admin.expo.exhibitors.index');
        Route::post('store', [ExpoMainExhibitorController::class, "exhibitors_store"])->name('admin.expo.exhibitors.store');
        Route::get('edit-exhibitor/{exhibitor_id}', [ExpoMainExhibitorController::class, "exhibitor_edit"])->name('admin.expo.exhibitor.edit');
        Route::post('edit-exhibitor/{exhibitor_id}', [ExpoMainExhibitorController::class, "exhibitor_update"])->name('admin.expo.exhibitor.update');
        Route::post('delete', [ExpoMainExhibitorController::class, "exhibitors_destroy"])->name('admin.expo.exhibitors.delete');

        Route::get('toggle-show-in-expo/{id}', [ExpoMainExhibitorController::class, "exhibitors_toggle_show_in_expo"])->name('admin.expo.exhibitors.toggle_show_in_expo');
        Route::post('postion-in-expo', [ExpoMainExhibitorController::class, "exhibitors_postion_in_expo"])->name('admin.expo.exhibitors.position_in_expo');
    });

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

    Route::prefix('{expo_id}/join')->group(function () {
        Route::get('/', [ExpoMediaController::class, 'expo_join_page'])->name('admin.expo.media.join');
        Route::post('update', [ExpoMediaController::class, 'expo_join_page_update'])->name('admin.expo.media.join.update');
    });

    Route::prefix('users')->group(function () {
        Route::get('{type}', [ExpoParticipantController::class, 'expo_users'])->name('admin.expo.users');
        Route::post('{type}', [ExpoParticipantController::class, 'expo_users'])->name('admin.expo.users.filter');

        Route::get('{type}/add-participator', [ExpoParticipantController::class, 'expo_add_participator'])->name('admin.expo.add_participator');
        Route::post('{type}/add-participator', [ExpoParticipantController::class, 'expo_add_participator_store'])->name('admin.expo.add_participator.store');

        Route::get('{type}/show-participant', [ExpoParticipantController::class, 'expo_view_participant'])->name('admin.expo.show_participant');
    });
});
/**
 * Expo Routes (Admin) - end --------------------------
 */


/**
 * Expo-Site (External) Routes (Admin) - start --------------------------
 */
Route::prefix('expo-site')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    Route::prefix('exhibitors')->group(function () {
        Route::get('list', [ExpoExternalExhibitorController::class, "exhibitors_index"])->name('admin.expo-site.exhibitors.index');
        Route::post('store', [ExpoExternalExhibitorController::class, "exhibitors_store"])->name('admin.expo-site.exhibitors.store');
        Route::get('edit-exhibitor/{exhibitor_id}', [ExpoExternalExhibitorController::class, "exhibitor_edit"])->name('admin.expo-site.exhibitor.edit');
        Route::post('edit-exhibitor/{exhibitor_id}', [ExpoExternalExhibitorController::class, "exhibitor_update"])->name('admin.expo-site.exhibitor.update');
        Route::post('delete', [ExpoExternalExhibitorController::class, "exhibitors_destroy"])->name('admin.expo-site.exhibitors.delete');
        Route::get('toggle-show-in-expo/{id}', [ExpoExternalExhibitorController::class, "exhibitors_toggle_show_in_expo"])->name('admin.expo-site.exhibitors.toggle_show_in_expo');
        Route::post('postion-in-expo', [ExpoExternalExhibitorController::class, "exhibitors_postion_in_expo"])->name('admin.expo-site.exhibitors.position_in_expo');
    });

    Route::prefix('manage-ui-contents')->group(function () {
        Route::get('contacts', [ExpoExternalModuleContentsController::class, 'ui_contact_page'])->name('admin.expo-site.ui.contact');
        Route::post('contacts', [ExpoExternalModuleContentsController::class, 'ui_contact_page_update'])->name('admin.expo-site.ui.contact.update');

        Route::get('galleries', [ExpoExternalModuleContentsController::class, 'ui_gallery_page'])->name('admin.expo-site.ui.gallery');
        Route::post('galleries', [ExpoExternalModuleContentsController::class, 'ui_gallery_page_update'])->name('admin.expo-site.ui.gallery.update');

        Route::get('videos', [ExpoExternalModuleContentsController::class, 'ui_video_page'])->name('admin.expo-site.ui.video');
        Route::post('videos', [ExpoExternalModuleContentsController::class, 'ui_video_page_update'])->name('admin.expo-site.ui.video.update');
    });

    Route::prefix('users')->group(function () {
        Route::get('{type}', [ExpoParticipantController::class, 'expo_users'])->name('admin.expo-site.users');
        Route::post('{type}', [ExpoParticipantController::class, 'expo_users'])->name('admin.expo-site.users.filter');

        Route::get('{type}/add-participator', [ExpoParticipantController::class, 'expo_add_participator'])->name('admin.expo-site.add_participator');
        Route::post('{type}/add-participator', [ExpoParticipantController::class, 'expo_add_participator_store'])->name('admin.expo-site.add_participator.store');

        Route::get('{type}/show-participant', [ExpoParticipantController::class, 'expo_view_participant'])->name('admin.expo-site.show_participant');
    });
});
/**
 * Expo-Site (External) Routes (Admin) - end --------------------------
 */

/**
 * Expo Routes (User)
 */
Route::prefix('expo-user')->middleware(['accessLogin', 'userCheck'])->group(function () {
    Route::get('/dashboard', [ExpoUserPanelController::class, 'dashboard'])->name('expo.user.dashboard');
    Route::get('/profile', [ExpoUserPanelController::class, 'index'])->name('expo.user.profile');
    Route::get('/profile/{id}', [ExpoUserPanelController::class, 'editUserInfo'])->name('expo.user.edit_profile');
    Route::post('/update/profile/{id}', [ExpoUserPanelController::class, 'updateUserInfo'])->name('expo.user.profile_info_update');

    Route::post('/security/{id}', [UserLoginController::class, 'setChangePassword'])->name('expo.user.password_change');
    Route::get('/user-logout', [UserLoginController::class, 'userLogout'])->name('expo.user.logout');

    // tickets
    Route::get('my-tickets', [ExpoUserPanelController::class, 'my_tickets'])->name('expo.user.my_tickets');
});

/**
 * Page Routes (Global)
 */
Route::prefix('expo')->group(function () {
    Route::get('details/{id}', [ExpoModuleController::class, 'expoDetails'])->name('expo.details');
    Route::get('exhibitor/{exhibitor_id}/details', [ExpoModuleController::class, "exhibitor_details"])->name('expo.exhibitor.details');

    Route::get('{unique_id}/page/exhibitors', [ExpoModuleController::class, 'exhibitors'])->name('expo.exhibitors');
    Route::get('{unique_id}/page/schedule', [ExpoModuleController::class, 'schedule'])->name('expo.schedule');
    Route::get('{unique_id}/page/testimonials', [ExpoModuleController::class, 'testimonials'])->name('expo.testimonials');
    Route::get('{unique_id}/page/delegates', [ExpoModuleController::class, 'delegates'])->name('expo.delegates');
    Route::get('{unique_id}/page/gallery', [ExpoModuleController::class, 'gallery'])->name('expo.gallery');
    Route::get('{unique_id}/page/video', [ExpoModuleController::class, 'video'])->name('expo.video');

    // Route::get('about-us', [ExpoModuleController::class, 'about_us'])->name('expo.about_us');
    // Route::get('contact', [ExpoModuleController::class, 'contact'])->name('expo.contact');
    // Route::get('gallery', [ExpoModuleController::class, 'gallery'])->name('expo.gallery');

    Route::get('{unique_id}/login', [ExpoAuthController::class, 'login_page'])->name('expo.login.page');
    Route::post('{unique_id}/login', [ExpoAuthController::class, 'attempt_login'])->name('expo.login.attempt');
    Route::get('logout', [ExpoAuthController::class, 'destroy'])->name('logout');

    Route::get('{unique_id}/sign-up', [ExpoModuleController::class, 'expo_form'])->name('expo.sign-up');
    Route::post('{unique_id}/sign-up', [ExpoModuleController::class, 'expo_form_submit'])->name('expo.sign-up.submit');
    Route::get('{unique_id}/ticket/{ticket_no}', [ExpoModuleController::class, 'expo_ticket'])->name('expo.expo-ticket');
});

/**
 * Captcha Routes
 */
Route::get('/captcha', [ExpoCaptchaController::class, 'generateCaptcha']);
Route::post('/verify-captcha', [ExpoCaptchaController::class, 'verifyCaptcha']);

Route::post('/send-verification-email', [ExpoCaptchaController::class, 'sendVerificationEmail']);
Route::post('/verify-code', [ExpoCaptchaController::class, 'verifyCode']);

Route::post('{type}/send-mail', [ExpoParticipantController::class, 'expo_send_mail'])->name('admin.expo.send_mail');
Route::post('{type}/send-mail-all', [ExpoParticipantController::class, 'expo_send_mail_all'])->name('admin.expo.send_mail_all');
Route::post('start-queue-mail', [ExpoParticipantController::class, 'expo_start_queue_mail'])->name('admin.expo.start_queue_mail');
