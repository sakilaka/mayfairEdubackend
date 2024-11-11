<?php

use App\Http\Controllers\Backend\Review\ReviewController as ReviewReviewController;
use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Route;



// Route::middleware("userCheck:1")->group( function () {
//     Route::post('store', [ReviewController::class,"store"])->name('frontend.review.store');

// });


Route::middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    //service review
    Route::get('index/review', [ReviewReviewController::class, "index"])->name('admin.review.index');
    Route::get('edit/review/{id}', [ReviewReviewController::class, "editReview"])->name('admin.review.edit');
    Route::post('update/review/{id}', [ReviewReviewController::class, "updateReview"])->name('admin.review.update');
    Route::post('delete/review', [ReviewReviewController::class, "destroy"])->name('admin.review.delete');
});


Route::middleware(['accessLogin'])->group(function () {
    //review
    Route::middleware(['userCheck:1'])->group(function () {
        Route::post('store', [ReviewReviewController::class, "courseReviewStore"])->name('frontend.review.store');
    });
});
