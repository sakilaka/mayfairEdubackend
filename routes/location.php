<?php

use App\Http\Controllers\Backend\Madical_Tourism\CityController;
use App\Http\Controllers\Backend\Madical_Tourism\ContinentController;
use App\Http\Controllers\Backend\Madical_Tourism\CountryController;
use App\Http\Controllers\Backend\Madical_Tourism\StateController;
use App\Http\Controllers\Backend\Madical_Tourism\HotelPackageController;
use App\Http\Controllers\Backend\Madical_Tourism\MedicalTourismPackageController;
use App\Http\Controllers\Backend\Madical_Tourism\RegionController;
use App\Http\Controllers\Backend\Madical_Tourism\ThanaController;
use App\Http\Controllers\Backend\Madical_Tourism\UnionController;
use App\Http\Controllers\Backend\Madical_Tourism\WordController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'adminCheck:0'])->prefix('location')->group(function () {
    //Region
    Route::resource('/region', RegionController::class);
    Route::post('/delete-region', [RegionController::class, 'delete'])->name('admin.medical_tourism.region.delete');
    Route::get('/region/status_toggle/{id}', [RegionController::class, 'status_toggle'])->name('admin.medical_tourism.region.status');

    //continent
    Route::get('continent', [ContinentController::class, 'index'])->name('continent.index');
    Route::get('continent/create', [ContinentController::class, 'create'])->name('continent.create');
    Route::post('continent/store', [ContinentController::class, 'store'])->name('continent.store');
    Route::get('continent/edit/{id}', [ContinentController::class, 'edit'])->name('continent.edit');
    Route::post('continent/update/{id}', [ContinentController::class, 'update'])->name('continent.update');
    Route::post('continent/delete', [ContinentController::class, 'delete'])->name('continent.delete');
    Route::get('/continent/status_toggle/{id}', [ContinentController::class, 'status_toggle'])->name('continent.toggle_status');

    //country
    Route::get('country', [CountryController::class, 'index'])->name('country.index');
    Route::get('country/create', [CountryController::class, 'create'])->name('country.create');
    Route::post('country/store', [CountryController::class, 'store'])->name('country.store');
    Route::get('country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
    Route::post('country/update/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::post('country/delete', [CountryController::class, 'delete'])->name('country.delete');
    Route::get('/country/status_toggle/{id}', [CountryController::class, 'status_toggle'])->name('country.toggle_status');

    //state
    Route::get('state', [StateController::class, 'index'])->name('state.index');
    Route::get('state/create', [StateController::class, 'create'])->name('state.create');
    Route::post('state/store', [StateController::class, 'store'])->name('state.store');
    Route::get('state/edit/{id}', [StateController::class, 'edit'])->name('state.edit');
    Route::post('state/update/{id}', [StateController::class, 'update'])->name('state.update');
    Route::post('state/delete', [StateController::class, 'delete'])->name('state.delete');
    Route::get('/state/status_toggle/{id}', [StateController::class, 'status_toggle'])->name('state.toggle_status');


    //city
    Route::get('city', [CityController::class, 'index'])->name('city.index');
    Route::get('city/create', [CityController::class, 'create'])->name('city.create');
    Route::post('city/store', [CityController::class, 'store'])->name('city.store');
    Route::get('city/edit/{id}', [CityController::class, 'edit'])->name('city.edit');
    Route::post('city/update/{id}', [CityController::class, 'update'])->name('city.update');
    Route::post('city/delete', [CityController::class, 'delete'])->name('city.delete');
    Route::get('/city/status_toggle/{id}', [CityController::class, 'status_toggle'])->name('city.toggle_status');

    //Thana or Post
    Route::resource('/thana', ThanaController::class);
    Route::post('/delete-thana', [ThanaController::class, 'delete'])->name('admin.medical_tourism.thana.delete');
    Route::get('/thana/status_toggle/{id}', [ThanaController::class, 'status_toggle'])->name('admin.medical_tourism.thana.status');

    //union
    Route::resource('/union', UnionController::class);
    Route::post('/delete-union', [UnionController::class, 'delete'])->name('admin.medical_tourism.union.delete');
    Route::get('/union/status_toggle/{id}', [UnionController::class, 'status_toggle'])->name('admin.medical_tourism.union.status');

    //word
    Route::resource('/word', WordController::class);
    Route::post('/delete-word', [WordController::class, 'delete'])->name('admin.medical_tourism.word.delete');
    Route::get('/word/status_toggle/{id}', [WordController::class, 'status_toggle'])->name('admin.medical_tourism.word.status');


    //Mediacl_turism Package
    Route::resource('/tourism-package', MedicalTourismPackageController::class);
    Route::post('/delete-tourism-package', [MedicalTourismPackageController::class, 'delete'])->name('admin.medical_tourism.package.delete');
    Route::get('/tourism-package/status_toggle/{id}', [MedicalTourismPackageController::class, 'status_toggle'])->name('admin.medical_tourism.package.status');

    //Mediacl_turism Hotel
    Route::resource('/tourism-hotel-package', HotelPackageController::class);
    Route::post('/delete-tourism-hotel-package', [HotelPackageController::class, 'delete'])->name('admin.medical_tourism.hotel_package.delete');
    Route::get('/tourism-hotel-package/status_toggle/{id}', [HotelPackageController::class, 'status_toggle'])->name('admin.medical_tourism.hotel_package.status');
});

//ajax start Continent and Country and Province get
Route::get('/get/country/{id}', [StateController::class, 'getCountry']);
Route::get('/get/state/{id}', [StateController::class, 'getState']);
Route::get('/get/city/{id}', [StateController::class, 'getCity']);
Route::get('/get/thana/{id}', [StateController::class, 'getThana']);
Route::get('/get/union/{id}', [StateController::class, 'getUnion']);
Route::get('/get/word/{id}', [StateController::class, 'getWord']);
Route::get('/get/lab/{id}', [StateController::class, 'getLab']);
//ajax End Continent and Country and Province get
