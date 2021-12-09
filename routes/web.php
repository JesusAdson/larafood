<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Admin')->group(function () {
    /**
     * Home Dashboard
     */
    Route::get('/', "PlanController@index")->name('admin.index');

    /**
     * Routes Details Plans
     */
    Route::resource('/plans/{id}/details', DetailPlanController::class);

    /**
     * Routes Plans
     */
    Route::any('/plans/search', "PlanController@search")->name('plans.search');
    Route::resource('/plans', PlanController::class);
});
Route::get('/', function () {
    return view('welcome');
});
