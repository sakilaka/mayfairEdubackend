<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Courses\CoursesController;

use App\Http\Controllers\Frontend\FrontendController;



// Route::prefix('courses')->group(function () {
Route::prefix('courses')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
      //Course Create
      Route::get('index', [CoursesController::class, "index"])->name('admin.course.index');
      Route::get('create', [CoursesController::class, "create"])->name('admin.course.create');
      Route::post('store', [CoursesController::class, "store"])->name('admin.course.store');
      Route::get('edit/{id}', [CoursesController::class, "edit"])->name('admin.course.edit');
      Route::post('update/{id}', [CoursesController::class, "update"])->name('admin.course.update');
      Route::post('delete', [CoursesController::class, "destroy"])->name('admin.course.delete');
      Route::get('/status/{id}', [CoursesController::class, 'status'])->name('admin.course.status');
});

Route::post('add-new-select2-language', [CoursesController::class, "addSelect2Language"]);

Route::middleware(['accessLogin'])->group(function () {

      Route::get('all/courses-show', [FrontendController::class, 'allCourseShow'])->name('frontend.all.course.show');

      Route::get('{cat_id}/coursese', [FrontendController::class, 'catCourseAll'])->name('courses.category');
      Route::get('{subcat_id}/subcoursese', [FrontendController::class, 'subcatCourseAll'])->name('courses.subcategory');
      //op
      Route::get('courses/details/{id}', [FrontendController::class, 'courseDetails'])->name('frontend.course.details');

      Route::get('course_resource_files_download/{id}', [FrontendController::class, 'courseResourceFilesDownload'])->name('frontend.course_resource_files_download');
      Route::get('course_lesson_files_download/{id}', [FrontendController::class, 'courseLessonFilesDownload'])->name('frontend.course_lesson_files_download');
      Route::get('course_quiz_files_download/{id}', [FrontendController::class, 'courseQuizFilesDownload'])->name('frontend.course_quiz_files_download');
      Route::get('course_project_files_download/{id}', [FrontendController::class, 'courseProjectFilesDownload'])->name('frontend.course_project_files_download');




      //Route::post('add-new-select2-car', [CarsController::class,"addSelect2"]);
      Route::get('/course-category-show-ajax/{id}', [FrontendController::class, 'courseByCatAjax']);
      Route::get('/course-subcategory-show-ajax/{id}', [FrontendController::class, 'courseBySubCatAjax']);
      Route::get('/home_course-subcategory-show-ajax/{id}', [FrontendController::class, 'homecourseBySubCatAjax']);
      Route::get('/get-course-all', [FrontendController::class, 'getCourse']);

      //course type
      Route::get('/get-course-by-show-type/{id}', [FrontendController::class, "getCourseTypeByCat"]);
      Route::get('/get-course-by-published/{id}', [FrontendController::class, 'getCoursePublished']);
      // Route::get('/get-course-by-show-type/{cat}',[FrontendController::class,"getCourseTypeByCat"]);
      Route::get('add-to-save/{id}', [FrontendController::class, "addToSave"])->name('add_to_save');
});



Route::get('/home_course-type-ajax/{id}', [FrontendController::class, 'homecourseByTypeAjax']);
// Route::get('/home_course-top-pickes/{id}', [FrontendController::class, 'homecourseByTopPicksAjax']);
// Route::get('/home_course-fastest-ad/{id}', [FrontendController::class, 'homecourseByFastestAdmissionsAjax']);
// Route::get('/home_course-high-rating/{id}', [FrontendController::class, 'homecourseByHighestRatingAjax']);
// Route::get('/home_course-top-rank/{id}', [FrontendController::class, 'homecourseByTopRankedAjax']);