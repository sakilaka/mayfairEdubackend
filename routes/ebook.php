<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Ebook\EbookController;
use App\Http\Controllers\Backend\Ebook\EbookAudioController;
use App\Http\Controllers\Backend\Ebook\EbookVideoController;

// Route::middleware(['accessLogin'])->group(function () {

Route::prefix('ebook')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    //Course Create
    Route::get('index/ebook', [EbookController::class, "index"])->name('admin.ebook.index');
    Route::get('create/ebook', [EbookController::class, "create"])->name('admin.ebook.create');
    Route::post('store/ebook', [EbookController::class, "store"])->name('admin.ebook.store');
    Route::get('edit/ebook/{id}', [EbookController::class, "edit"])->name('admin.ebook.edit');
    Route::post('update/ebook/{id}', [EbookController::class, "update"])->name('admin.ebook.update');
    Route::post('delete/ebook', [EbookController::class, "destroy"])->name('admin.ebook.delete');
    Route::get('/status/{id}', [EbookController::class, 'status'])->name('admin.ebook.status');
});

Route::prefix('ebookaudio')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    //Course Create
    Route::get('index/ebook', [EbookAudioController::class, "index"])->name('admin.ebookaudio.index');
    Route::get('create/ebook', [EbookAudioController::class, "create"])->name('admin.ebookaudio.create');
    Route::post('store/ebook', [EbookAudioController::class, "store"])->name('admin.ebookaudio.store');
    Route::get('edit/ebook/{id}', [EbookAudioController::class, "edit"])->name('admin.ebookaudio.edit');
    Route::post('update/ebook/{id}', [EbookAudioController::class, "update"])->name('admin.ebookaudio.update');
    Route::post('delete/ebook', [EbookAudioController::class, "destroy"])->name('admin.ebookaudio.delete');
    Route::get('/status/{id}', [EbookAudioController::class, 'status'])->name('admin.ebookaudio.status');
});

Route::prefix('ebookvideo')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    //Course Create
    Route::get('index/ebook', [EbookVideoController::class, "index"])->name('admin.ebookvideo.index');
    Route::get('create/ebook', [EbookVideoController::class, "create"])->name('admin.ebookvideo.create');
    Route::post('store/ebook', [EbookVideoController::class, "store"])->name('admin.ebookvideo.store');
    Route::get('edit/ebook/{id}', [EbookVideoController::class, "edit"])->name('admin.ebookvideo.edit');
    Route::post('update/ebook/{id}', [EbookVideoController::class, "update"])->name('admin.ebookvideo.update');
    Route::post('delete/ebook', [EbookVideoController::class, "destroy"])->name('admin.ebookvideo.delete');
    Route::get('/status/{id}', [EbookVideoController::class, 'status'])->name('admin.ebookvideo.status');
});

// });
