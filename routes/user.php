<?php

use App\Http\Controllers\Backend\Student_Appliction\StudentApplictionController;
use App\Http\Controllers\Frontend\InstructorCourseController;
use App\Http\Controllers\Frontend\UserLoginController;
use App\Http\Controllers\User\ebook\EbookController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ebook\EbookAudioController;
use App\Http\Controllers\User\ebook\EbookVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['accessLogin'])->group(function () {
        Route::prefix('user')->middleware(['userCheck'])->group(function () {
                Route::get('/profile', [UserController::class, 'index'])->name('user.profile');
                Route::post('/profile/pic/{id}', [UserController::class, 'updateUserPic'])->name('update.user.profile.pic');
                Route::get('/profile/{id}', [UserController::class, 'editUserInfo'])->name('user.edit_profile');
                Route::post('/update/profile/{id}', [UserController::class, 'updateUserInfo'])->name('user.profile_info_update');

                Route::get('/security/{id}', [UserLoginController::class, 'getUserChangePassword'])->name('user.password');
                Route::post('/security/{id}', [UserLoginController::class, 'setChangePassword'])->name('user.password_change');
                Route::get('/security/confirm-code/{id}', [UserLoginController::class, 'getConfirmPassword'])->name('user.password_confirm');
                Route::post('/security/confirm-code/{id}', [UserLoginController::class, 'confirmChangePassword'])->name('user.password_confirm.post');

                Route::get('my-notifications', [UserController::class, 'myNotifications'])->name('user.notifications');

                Route::get('/wishlist', [UserController::class, 'wishlist'])->name('user.wishlist');
                Route::get('/notification', [UserController::class, 'notification'])->name('user.notification');
                Route::get('/privacy', [UserController::class, 'privacy'])->name('privacy');
                Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
                Route::get('/my-course', [UserController::class, 'myCourseList'])->name('user.my_course');
                Route::get('/my-course-list', [UserController::class, 'myOrderList'])->name('user.my_order');

                Route::get('/my-applications', [UserController::class, 'myOrder'])->name('user.order_list');
                Route::post('/my-applications', [UserController::class, 'myOrder'])->name('user.order_list_filter');

                Route::get('/my-order-invoice/{id}', [UserController::class, 'myOrderInvoice'])->name('user.order_invoice');
                Route::get('/my-order-details/{id}', [UserController::class, 'myOrderDetails'])->name('user.order_details');
                Route::post('my-order/delete', [UserController::class, "destroy"])->name('user.order_delete');

                Route::get('/my-order-print/{id}', [UserController::class, 'myOrderPrint'])->name('user.order_print');
                Route::get('/my-event', [UserController::class, 'myEventList'])->name('user.my_event');
                Route::get('/my-package', [UserController::class, 'myPackageList'])->name('user.my_package');


                //Teacher course Create
                Route::get('/manage-course', [InstructorCourseController::class, 'manageCourse'])->name('instructor.manage_course');
                Route::get('/add-course', [InstructorCourseController::class, 'addCourse'])->name('instructor.add_course');
                Route::post('/stor-course', [InstructorCourseController::class, 'storCourse'])->name('instructor.stor_course');
                Route::get('/edit-course/{id}', [InstructorCourseController::class, 'editCourse'])->name('instructor.edit_course');
                Route::post('/update-course/{id}', [InstructorCourseController::class, 'updateCourse'])->name('instructor.update_course');
                Route::post('/delete-course', [InstructorCourseController::class, 'deleteCourse'])->name('instructor.delete_course');


                //E-book Route
                Route::get('/manage-e-book', [EbookController::class, 'manageEbook'])->name('frontend.manage_ebook');
                Route::get('/add-e-book', [EbookController::class, 'addEbook'])->name('frontend.add_ebook');
                Route::post('/stor-e-book', [EbookController::class, 'storEbook'])->name('frontend.stor_ebook');
                Route::get('/edit-e-book/{id}', [EbookController::class, 'editEbook'])->name('frontend.edit_ebook');
                Route::post('/update-e-book/{id}', [EbookController::class, 'updateEbook'])->name('frontend.update_ebook');
                Route::post('/delete-e-book', [EbookController::class, 'deleteEbook'])->name('frontend.delete_ebook');

                //E-book Route
                Route::get('/manage-e-audio-book', [EbookAudioController::class, 'manageEbookAudio'])->name('frontend.manage_ebook_audio');
                Route::get('/add-e-audio-book', [EbookAudioController::class, 'addEbookAudio'])->name('frontend.add_ebook_audio');
                Route::post('/stor-e-audio-book', [EbookAudioController::class, 'storEbookAudio'])->name('frontend.stor_ebook_audio');
                Route::get('/edit-e-audio-book/{id}', [EbookAudioController::class, 'editEbookAudio'])->name('frontend.edit_ebook_audio');
                Route::post('/update-audio-e-book/{id}', [EbookAudioController::class, 'updateEbookAudio'])->name('frontend.update_ebook_audio');
                Route::post('/delete-audio-e-book', [EbookAudioController::class, 'deleteEbookAudio'])->name('frontend.delete_ebook_audio');

                //E-book Route
                Route::get('/manage-e-video-book', [EbookVideoController::class, 'manageEbookVideo'])->name('frontend.manage_ebook_video');
                Route::get('/add-e-video-book', [EbookVideoController::class, 'addEbookVideo'])->name('frontend.add_ebook_video');
                Route::post('/stor-e-video-book', [EbookVideoController::class, 'storEbookVideo'])->name('frontend.stor_ebook_video');
                Route::get('/edit-e-video-book/{id}', [EbookVideoController::class, 'editEbookVideo'])->name('frontend.edit_ebook_video');
                Route::post('/update-e-video-book/{id}', [EbookVideoController::class, 'updateEbookVideo'])->name('frontend.update_ebook_video');
                Route::post('/delete-e-video-book', [EbookVideoController::class, 'deleteEbookVideo'])->name('frontend.delete_ebook_video');



                //withdrawal Route
                Route::get('/manage-withdrawal', [UserController::class, 'manageWithdrawal'])->name('frontend.manage_withdrawal');
                Route::get('/create-withdrawal', [UserController::class, 'createWithdrawal'])->name('frontend.create_withdrawal');
                Route::post('/stor-withdrawal', [UserController::class, 'storWithdrawal'])->name('frontend.stor_withdrawal');
                Route::get('/edit-withdrawal/{id}', [UserController::class, 'editWithdrawal'])->name('frontend.edit_withdrawal');
                Route::post('/stor-withdrawal/{id}', [UserController::class, 'updateWithdrawal'])->name('frontend.update_withdrawal');

                //Partner Student manage
                Route::get('/partner-manage-application', [UserController::class, 'manageApplication'])->name('frontend.manage_consultant_application');
                Route::post('/partner-manage-application', [UserController::class, 'manageApplication'])->name('frontend.manage_consultant_application_filter');
                Route::get('/partner-manage-student', [UserController::class, 'manageStudent'])->name('frontend.manage_consultant_student');
                Route::get('/partner-manage-application-invoice/{id}', [UserController::class, 'manageApplicationInvoice'])->name('frontend.manage_consultant_application_invoice');
                Route::get('/partner-manage-application-invoice-print/{id}', [UserController::class, 'manageApplicationInvoicePrint'])->name('frontend.manage_consultant_application_invoice_print');
                Route::get('/partner-application-details/{id}', [UserController::class, 'applicationDetails'])->name('frontend.application-details');
                Route::post('/partner-application-Status/{id}', [UserController::class, 'applicationStatus'])->name('frontend.application-status');
                Route::get('/download/{id}', [UserController::class, 'applicationFileDownload'])->name('frontend.application-file-download');
                Route::get('/partner-student-details/{id}', [UserController::class, 'studentDetails'])->name('frontend.consultant_student_details');
                Route::get('/partner-student-edit/{id}', [UserController::class, 'studentEdit'])->name('frontend.consultant_student_edit');
                Route::post('/partner-student-update/{id}', [UserController::class, 'studentUpdate'])->name('frontend.consultant_student_update');
                Route::get('/partner-student-details-blank/{id}', [UserController::class, 'studentDetailsBlank'])->name('frontend.consultant_student_details_blank');

                Route::get('/application/doc/all-download/{application_id}', [StudentApplictionController::class, 'allDocumentDownload'])->name('frontend.consultant_application-all-document-download');
                Route::get('/student/application/form/download/{id}', [StudentApplictionController::class, 'applicationFormDownload'])->name('consultent.application-form-download');

                Route::get('student-appliction-program-edit/{id}', [UserController::class, "editProgramInfo"])->name('consultent.student_appliction_program_edit');
                Route::post('student-appliction-program-update/{id}', [UserController::class, "updateProgramInfo"])->name('consultent.student_appliction_program_update');
                Route::get('partner-students-appliction-edit/{id}', [UserController::class, "edit"])->name('consultent.student_appliction_edit');
                Route::post('partner-students-appliction-update/{id}', [UserController::class, "update"])->name('consultent.student_appliction_update');
                Route::post('partner-student-appliction-delete', [UserController::class, "delete"])->name('consultent.student_appliction_delete');
                Route::get('partner-student-appliction-family-info-edit/{id}', [UserController::class, "editFamily"])->name('consultent.student_appliction_edit_family');
                Route::post('partner-student-appliction-family-info-update/{id}', [UserController::class, "familyUpdate"])->name('consultent.student_appliction_update_family');
                Route::get('partner-student-appliction-document/{id}', [UserController::class, "editDocument"])->name('consultent.student_appliction_document');
                Route::post('partner-student-appliction-document-update/{id}', [UserController::class, "updateDocument"])->name('consultent.student_appliction_document-update');


                Route::get('/user-logout', [UserLoginController::class, 'userLogout'])->name('user.logout');
        });



        // Route::get('/user-logout', [UserLoginController::class, 'userLogout'])->name('user.logout');
        // Route::post('/profile/pic/{id}',[UserController::class, 'updateUserPic'])->name('update.user.profile.pic');




        // Route::middleware(['userCheck:3'])->group(function () {

        //         Route::get('/instructor/profile',[UserController::class, 'index'])->name('instructor.profile');
        //         // Route::post('/instructor/profile/pic/{id}',[UserController::class, 'updateUserPic'])->name('update.user.profile.pic');
        //         Route::get('/instructor/profile/{id}',[UserController::class, 'editUserInfo'])->name('instructor.edit_profile');
        //         Route::post('/instructor/update/profile/{id}',[UserController::class, 'updateUserInfo'])->name('instructor.profile_info_update');

        //         Route::get('/instructor/security/{id}', [UserLoginController::class, 'getUserChangePassword'])->name('instructor.password');
        //         Route::post('/instructor/security/{id}', [UserLoginController::class, 'setChangePassword'])->name('user.password_change');
        //         Route::get('/instructor/security/confirm-code/{id}', [UserLoginController::class, 'getConfirmPassword'])->name('user.password_confirm');
        //         Route::post('/instructor/security/confirm-code/{id}', [UserLoginController::class, 'confirmChangePassword'])->name('user.password_confirm');

        //         Route::get('/instructor/wishlist', [UserController::class, 'wishlist'])->name('instructor.wishlist');
        //         Route::get('/instructor/notification', [UserController::class, 'notification'])->name('instructor.notification');
        //         Route::get('/instructor/privacy', [UserController::class, 'privacy'])->name('instructor.privacy');
        //         Route::get('/instructor/dashboard', [UserController::class, 'dashboard'])->name('instructor.dashboard');

        //         // Route::get('/user-logout', [UserLoginController::class, 'userLogout'])->name('user.logout');

        // });


});
