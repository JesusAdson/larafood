<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Admin')->group(function () {
    /**
     * Home Dashboard
     */
    Route::get('/', "PlanController@index")->name('admin.index');

    /**
     *Permission x Profile
     */
    Route::get('permissions/{permissionID}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');
    Route::get('profiles/{id}/permissions/{permissionID}/detach', 'ACL\PermissionProfileController@detachPermissions')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions/store', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::get('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@availablePermissions')->name('profiles.permissions.available');
    Route::any('profiles/{id}/permissions/create/search', 'ACL\PermissionProfileController@filterAvailablePermissions')->name('profiles.permissions.available.search');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    /**
     * Routes Permissions
     */
    Route::any('/permissions/search', "ACL\\PermissionController@search")->name('permissions.search');
     Route::resource('/permissions', ACL\PermissionController::class);
    /**
     * Routes Profiles
     */
    Route::any('/profiles/search', "ACL\\ProfileController@search")->name('profiles.search');
     Route::resource('/profiles', ACL\ProfileController::class, );

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
