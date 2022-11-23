<?php

use Illuminate\Support\Facades\Route;

// BackEnd
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CMSDashboardController;
use App\Http\Controllers\CMSMasterController;
use App\Http\Controllers\CMSUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',                     [CMSDashboardController::class, 'index']);

// Sign in | Sign up | About register
Route::get('login',                 [RegisterController::class, 'signin']);
Route::get('signin',                [RegisterController::class, 'signin']);
Route::get('signup',                [RegisterController::class, 'signup']);
Route::get('reset-password',        [RegisterController::class, 'resetPassword']);

/* frontend process */
Route::group(['namespace' => 'process', 'prefix' => 'process'], function() {
    Route::post('/checkUsername',    [ProcessController::class, 'checkUsername']);
    Route::post('/login',            [ProcessController::class, 'login']);
});


/* CMS */
Route::group(['namespace' => '', 'prefix' => 'cms'], function() {
    Route::get('/',                 [CMSDashboardController::class, 'index']);
    Route::get('dashboard',         [CMSDashboardController::class, 'index']);
    Route::get('notifications',     [CMSDashboardController::class, 'notifications']);
    Route::get('settings',          [CMSDashboardController::class, 'settings']);
    Route::get('profile',           [CMSUserController::class, 'profileUser']);
    
    Route::group(['namespace' => 'master', 'prefix' => 'master'], function() {
        Route::group(['namespace' => 'company', 'prefix' => 'company'], function() {
            Route::get('/',                     [CMSMasterController::class, 'indexCompany']);
            Route::get('add',                   [CMSMasterController::class, 'modifyCompany']);
            Route::get('edit/{id}',             [CMSMasterController::class, 'modifyCompany']);
            Route::post('process/{name}',       [CMSMasterController::class, 'processCompany']);
        });

        Route::group(['namespace' => 'services-groups', 'prefix' => 'services-groups'], function() {
            Route::get('/',                     [CMSMasterController::class, 'indexSGroups']);
            Route::get('add',                   [CMSMasterController::class, 'modifySGroups']);
            Route::get('edit/{id}',             [CMSMasterController::class, 'modifySGroups']);
            Route::post('process/{name}',       [CMSMasterController::class, 'processSGroups']);
        });

        Route::group(['namespace' => 'services', 'prefix' => 'services'], function() {
            Route::get('/',                     [CMSMasterController::class, 'indexServices']);
            Route::get('add',                   [CMSMasterController::class, 'modifyServices']);
            Route::get('edit/{id}',             [CMSMasterController::class, 'modifyServices']);
            Route::post('process/{name}',       [CMSMasterController::class, 'processService']);
        });
    });

    Route::group(['namespace' => 'users', 'prefix' => 'users'], function() {
        Route::get('/',                     [CMSUserController::class, 'indexUsers']);
        Route::get('add',                   [CMSUserController::class, 'modifyUser']);
        Route::get('edit/{id}',             [CMSUserController::class, 'modifyUser']);
        Route::post('process/{name}',       [CMSUserController::class, 'processUser']);

        Route::group(['namespace' => 'roles', 'prefix' => 'roles'], function() {
            Route::get('/',                 [CMSUserController::class, 'indexUserRole']);
            Route::get('add',               [CMSUserController::class, 'modifyUserRole']);
            Route::get('edit/{id}',         [CMSUserController::class, 'modifyUserRole']);
            Route::post('process/{name}',   [CMSUserController::class, 'processUserRole']);
        });
    });

});