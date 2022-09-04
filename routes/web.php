<?php

use Illuminate\Support\Facades\Route;

// BackEnd
use App\Http\Controllers\CMSDashboardController;
//use App\Http\Controllers\CMSUsersController;

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

Route::get('/', function () {
    return view('welcome');
});

/* CMS */
Route::group(['namespace' => '', 'prefix' => 'cms'], function() {
    Route::get('/',                 [CMSDashboardController::class, 'index']);
    Route::get('dashboard',         [CMSDashboardController::class, 'index']);
    Route::get('notifications',     [CMSDashboardController::class, 'notifications']);
    Route::get('login',             [CMSDashboardController::class, 'login']);
    Route::get('reset-password',    [CMSDashboardController::class, 'resetPassword']);
    Route::get('settings',          [CMSDashboardController::class, 'settings']);

    // Route::group(['namespace' => 'users', 'prefix' => 'users'], function() {
    //     Route::get('/',                             [AdminUsersController::class, 'index']);
    //     Route::get('add',                           [AdminUsersController::class, 'add']);
    //     Route::get('edit/{id}/{name}',              [AdminUsersController::class, 'edit']);
    //     Route::post('process/{name}',               [AdminUsersController::class, 'processModify']);
    //     Route::get('useractive/{id}/{name}',        [AdminUsersController::class, 'activeUser']);
    //     Route::get('sendnewpassword/{id}/{name}',   [AdminUsersController::class, 'changePassword']);
    //     Route::get('profile',                       [AdminUsersController::class, 'indexProfile']);
    //     Route::post('profile/updateinfo',           [AdminUsersController::class, 'processUpdateInfo']);
    // });

});