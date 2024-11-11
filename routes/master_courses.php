<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Courses\CoursesController;
use App\Http\Controllers\Backend\Courses\CourseLanguageController;
use App\Http\Controllers\Backend\Courses\MasterCourseController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\Courses\CategoryController;

// Route::middleware(['accessLogin'])->group(function () {

Route::prefix('master-courses')->group(function () {

        // Route::prefix('courses')->group(function () {
        //Master Course
        Route::get('index', [MasterCourseController::class, "index"])->name('admin.master_course.index');
        Route::get('create', [MasterCourseController::class, "create"])->name('admin.master_course.create');
        Route::post('store', [MasterCourseController::class, "store"])->name('admin.master_course.store');
        Route::get('edit/{id}', [MasterCourseController::class, "edit"])->name('admin.master_course.edit');
        Route::post('update/{id}', [MasterCourseController::class, "update"])->name('admin.master_course.update');
        Route::post('delete', [MasterCourseController::class, "destroy"])->name('admin.master_course.delete');



        //end category

        // Courses language
        // Route::get('index/language', [CourseLanguageController::class,"index"])->name('admin.language.index');
        // Route::get('create/language', [CourseLanguageController::class,"create"])->name('admin.language.create');
        // Route::post('store/language', [CourseLanguageController::class,"store"])->name('admin.language.store');
        // Route::get('edit/language/{id}', [CourseLanguageController::class,"edit"])->name('admin.language.edit');
        // Route::post('update/language/{id}', [CourseLanguageController::class,"update"])->name('admin.language.update');
        // Route::post('delete/language', [CourseLanguageController::class,"destroy"])->name('admin.language.delete');


        // });
});


// });
