<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth'])
    ->group(function () {
        /**
         * Home Dashboard
         */
        Route::get('/', "PlanController@index")->name('admin.index');

        /**
         * Routes Users
         */
        Route::any('/users/search', "UserController@search")->name('users.search');
        Route::resource('/users', UserController::class,);


        /**
         *Plan x Profile
         */
        Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
        Route::get('plans/{id}/profiles/create', 'ACL\PlanProfileController@availableProfiles')->name('plans.profiles.available');
        Route::any('plans/{id}/profiles/create/search', 'ACL\PlanProfileController@availableProfiles')->name('plans.profiles.available.search');
        Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
        Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');

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
        Route::resource('/profiles', ACL\ProfileController::class,);

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

/**
 * Site
 */
Route::namespace('Site')->group(function () {
    Route::get('/plan/{id}', 'SiteController@plan')->name('plan.subscription');
    Route::get('/', 'SiteController@index')->name('site.home');
});

/**
 * Auth routes
 */
Auth::routes();
