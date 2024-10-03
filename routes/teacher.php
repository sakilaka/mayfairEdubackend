<?php

use App\Http\Controllers\Backend\All_users\AffiliateConteoller;
use App\Http\Controllers\Backend\All_users\ConsultantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\All_users\TeacherController;
use App\Http\Controllers\Backend\All_users\InstructorController;
use App\Http\Controllers\Backend\All_users\HostController;
use App\Http\Controllers\Backend\All_users\SeleryController;

// Route::middleware(['accessLogin'])->group(function () {
Route::middleware(['auth:admin', 'adminCheck:0'])->group(function () {

    Route::prefix('teacher')->group(function () {
        //Teacher
        Route::get('index', [TeacherController::class, "index"])->name('admin.teacher.index');
        Route::get('create', [TeacherController::class, "create"])->name('admin.teacher.create');
        Route::post('store', [TeacherController::class, "store"])->name('admin.teacher.store');
        Route::get('edit/{id}', [TeacherController::class, "edit"])->name('admin.teacher.edit');
        Route::post('update/{id}', [TeacherController::class, "update"])->name('admin.teacher.update');
        Route::post('delete', [TeacherController::class, "destroy"])->name('admin.teacher.delete');
        Route::post('teacher-change-password', [TeacherController::class, "changePassword"])->name('admin.teacher_change_password');
        Route::get('/status/{id}', [TeacherController::class, 'status'])->name('admin.teacher.status');
    });



    Route::prefix('instrutor')->group(function () {
        // instrutor
        Route::get('index/instrutor', [InstructorController::class, "index"])->name('admin.instrutor.index');
        Route::get('create/instrutor', [InstructorController::class, "create"])->name('admin.instrutor.create');
        Route::post('store/instrutor', [InstructorController::class, "store"])->name('admin.instrutor.store');
        Route::get('edit/instrutor/{id}', [InstructorController::class, "edit"])->name('admin.instrutor.edit');
        Route::post('update/instrutor/{id}', [InstructorController::class, "update"])->name('admin.instrutor.update');
        Route::post('delete/instrutor', [InstructorController::class, "destroy"])->name('admin.instrutor.delete');
        Route::post('instrutor-change-password', [InstructorController::class, "changePassword"])->name('admin.instrutor_change_password');
        Route::get('/status/{id}', [InstructorController::class, 'status'])->name('admin.instrutor.status');
    });

    Route::prefix('host')->group(function () {
        // instrutor
        Route::get('index/host', [HostController::class, "index"])->name('admin.host.index');
        Route::get('create/host', [HostController::class, "create"])->name('admin.host.create');
        Route::post('store/host', [HostController::class, "store"])->name('admin.host.store');
        Route::get('edit/host/{id}', [HostController::class, "edit"])->name('admin.host.edit');
        Route::post('update/host/{id}', [HostController::class, "update"])->name('admin.host.update');
        Route::post('delete/host', [HostController::class, "destroy"])->name('admin.host.delete');
        Route::post('host-change-password', [HostController::class, "changePassword"])->name('admin.host_change_password');
        Route::get('/status/{id}', [HostController::class, 'status'])->name('admin.host.status');
    });


    Route::prefix('selery')->group(function () {
        // instrutor
        Route::get('index/selery', [SeleryController::class, "index"])->name('admin.selery.index');
        Route::get('create/selery', [SeleryController::class, "create"])->name('admin.selery.create');
        Route::post('store/selery', [SeleryController::class, "store"])->name('admin.selery.store');
        Route::get('edit/selery/{id}', [SeleryController::class, "edit"])->name('admin.selery.edit');
        Route::post('update/selery/{id}', [SeleryController::class, "update"])->name('admin.selery.update');
        Route::post('delete/selery', [SeleryController::class, "destroy"])->name('admin.selery.delete');
        Route::post('seller-change-password', [SeleryController::class, "changePassword"])->name('admin.seller_change_password');
    });

    Route::prefix('consultant')->group(function () {
        // instrutor
        Route::get('index/consultant', [ConsultantController::class, "index"])->name('admin.consultant.index');
        Route::post('index/consultant/ajax', [ConsultantController::class, "indexAjax"])->name('admin.consultant.ajax.index');
        Route::get('create/consultant', [ConsultantController::class, "create"])->name('admin.consultant.create');
        Route::post('store/consultant', [ConsultantController::class, "store"])->name('admin.consultant.store');
        Route::get('edit/consultant/{id}', [ConsultantController::class, "edit"])->name('admin.consultant.edit');
        Route::post('update/consultant/{id}', [ConsultantController::class, "update"])->name('admin.consultant.update');
        Route::post('delete/consultant', [ConsultantController::class, "destroy"])->name('admin.consultant.delete');
        Route::get('status/consultant/{id}', [ConsultantController::class, "status"])->name('admin.consultant.status');
        Route::post('consultant-change-password', [ConsultantController::class, "changePassword"])->name('admin.consultant_change_password');
    });
});

Route::prefix('affiliate')->group(function () {
    // instrutor
    Route::get('index/affiliate', [AffiliateConteoller::class, "index"])->name('admin.affiliate.index');
    Route::get('create/affiliate', [AffiliateConteoller::class, "create"])->name('admin.affiliate.create');
    Route::post('store/affiliate', [AffiliateConteoller::class, "store"])->name('admin.affiliate.store');
    Route::get('edit/affiliate/{id}', [AffiliateConteoller::class, "edit"])->name('admin.affiliate.edit');
    Route::post('update/affiliate/{id}', [AffiliateConteoller::class, "update"])->name('admin.affiliate.update');
    Route::post('delete/affiliate', [AffiliateConteoller::class, "destroy"])->name('admin.affiliate.delete');
    Route::post('affiliate-change-password', [AffiliateConteoller::class, "changePassword"])->name('admin.affiliate_change_password');
});

//op start
Route::get('/consultants-forgot-password-mail/{id}', [ConsultantController::class, 'consultantsForgetPasswordMail']);
// Route::post('consultants-forgot-password/{id}', [ConsultantController::class, 'resetForgotPasswordConsultants'])->name('consultants.forgot.password');
//op end 