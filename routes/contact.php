<?php


use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Contact\ContactController;



// Route::middleware("userCheck:1")->group( function () {
//     Route::post('store', [ReviewController::class,"store"])->name('frontend.review.store');

// });

// Route::middleware(['accessLogin'])->group(function () {

Route::middleware(['auth:admin', 'adminCheck:0'])->group(function () {

    //service contact
    Route::get('index', [ContactController::class, "index"])->name('user.contact.index');
    Route::post('delete', [ContactController::class, "destroy"])->name('user.contact.delete');
});

// });
