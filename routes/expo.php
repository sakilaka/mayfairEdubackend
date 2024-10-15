<?php

use App\Http\Controllers\Backend\Expo\ExpoController;
use App\Http\Controllers\Backend\Expo\ExpoModuleContentsController;
use App\Http\Controllers\Expo\ExpoModuleController;
use Illuminate\Support\Facades\Route;

Route::prefix('expo')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    Route::get('/', [ExpoController::class, "index"])->name('admin.expo.index');
    Route::get('create', [ExpoController::class, "create"])->name('admin.expo.create');
    Route::post('store', [ExpoController::class, "store"])->name('admin.expo.store');
    Route::get('edit/{id}', [ExpoController::class, "edit"])->name('admin.expo.edit');
    Route::post('update/{id}', [ExpoController::class, "update"])->name('admin.expo.update');
    Route::post('delete', [ExpoController::class, "destroy"])->name('admin.expo.delete');

    Route::prefix('exhibitors')->group(function () {
        Route::get('/', [ExpoController::class, "exhibitors_index"])->name('admin.expo.exhibitors.index');
        Route::post('store', [ExpoController::class, "exhibitors_store"])->name('admin.expo.exhibitors.store');
        Route::post('delete', [ExpoController::class, "exhibitors_destroy"])->name('admin.expo.exhibitors.delete');
        Route::get('toggle-show-in-expo/{id}', [ExpoController::class, "exhibitors_toggle_show_in_expo"])->name('admin.expo.exhibitors.toggle_show_in_expo');
        Route::post('postion-in-expo', [ExpoController::class, "exhibitors_postion_in_expo"])->name('admin.expo.exhibitors.position_in_expo');
    });

    Route::prefix('manage-ui-contents')->group(function () {
        Route::get('contacts', [ExpoModuleContentsController::class, 'ui_contact_page'])->name('admin.expo.ui.contact');
        Route::post('contacts', [ExpoModuleContentsController::class, 'ui_contact_page_update'])->name('admin.expo.ui.contact.update');

        Route::get('gallery', [ExpoModuleContentsController::class, 'ui_gallery_page'])->name('admin.expo.ui.gallery');
        Route::post('gallery', [ExpoModuleContentsController::class, 'ui_gallery_page_update'])->name('admin.expo.ui.gallery.update');

        Route::get('video', [ExpoModuleContentsController::class, 'ui_video_page'])->name('admin.expo.ui.video');
        Route::post('video', [ExpoModuleContentsController::class, 'ui_video_page_update'])->name('admin.expo.ui.video.update');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [ExpoController::class, 'expo_users'])->name('admin.expo.users');
        Route::get('add-participator', [ExpoController::class, 'expo_add_participator'])->name('admin.expo.add_participator');
        Route::post('add-participator', [ExpoController::class, 'expo_add_participator_store'])->name('admin.expo.add_participator.store');

        Route::get('view-participant', [ExpoController::class, 'expo_view_participant'])->name('admin.expo.view_participant');
    });

    Route::post('send-mail', [ExpoController::class, 'expo_send_mail'])->name('admin.expo.send_mail');
    Route::post('send-mail-all', [ExpoController::class, 'expo_send_mail_all'])->name('admin.expo.send_mail_all');
    Route::post('start-queue-mail', [ExpoController::class, 'expo_start_queue_mail'])->name('admin.expo.start_queue_mail');
});

Route::get('/expo-details/{id}', [ExpoModuleController::class, 'expoDetails'])->name('expo.details');

// pages
Route::get('expo/about-us', [ExpoModuleController::class, 'about_us'])->name('expo.about_us');
Route::get('expo/contact', [ExpoModuleController::class, 'contact'])->name('expo.contact');
Route::get('expo/exhibitors', [ExpoModuleController::class, 'exhibitors'])->name('expo.exhibitors');
Route::get('expo/gallery', [ExpoModuleController::class, 'gallery'])->name('expo.gallery');
