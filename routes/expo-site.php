<?php

use App\Http\Controllers\Backend\Expo\ExpoController;
use App\Http\Controllers\Backend\Expo\ExpoModuleContentsController;
use App\Http\Controllers\Expo\CaptchaController;
use App\Http\Controllers\Expo\ExpoLoginController;
use App\Http\Controllers\Expo\ExpoModuleController;
use App\Http\Controllers\Expo\ExpoUserController;
use App\Http\Controllers\Frontend\UserLoginController;
use Illuminate\Support\Facades\Route;

/**
 * Expo Routes (Admin)
 */
Route::prefix('expo-site')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
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
