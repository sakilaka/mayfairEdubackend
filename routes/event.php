<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Event\EventController;


use App\Http\Controllers\Backend\Contact\ContactController;

Route::prefix('event')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
    Route::get('contact/index', [ContactController::class, "eventIndex"])->name('admin.event.contact.index');
    Route::get('contact/edit/{id}', [ContactController::class, "eventContactEdit"])->name('admin.event.contact.edit');
    Route::post('contact/update/{id}', [ContactController::class, "eventContactUpdate"])->name('admin.event.contact.update');

    Route::get('index/event', [EventController::class, "index"])->name('admin.event.index');
    Route::get('create/event', [EventController::class, "create"])->name('admin.event.create');
    Route::post('store/event', [EventController::class, "store"])->name('admin.event.store');
    Route::get('edit/event/{id}', [EventController::class, "edit"])->name('admin.event.edit');
    Route::post('update/event/{id}', [EventController::class, "update"])->name('admin.event.update');
    Route::post('delete/event', [EventController::class, "destroy"])->name('admin.event.delete');
    Route::get('/status/{id}', [EventController::class, 'status'])->name('admin.event.status');
});