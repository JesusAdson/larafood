<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\PlanController@index')->name('admin.index');
    Route::any('/plans/search', "Admin\PlanController@search")->name('plans.search');
    Route::resource('/plans', Admin\PlanController::class);
});
Route::get('/', function () {
    return view('welcome');
});
