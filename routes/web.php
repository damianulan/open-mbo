<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

/**
 * Users START
 */
Route::resource('users', App\Http\Controllers\UsersController::class)->middleware('auth');
Route::get('users/data', [App\Http\Controllers\UsersController::class, 'data'])->middleware('auth')->name('users.data');

Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('profile.index');

/**
 * Users END
 */

/**
 * Settings START
 */

Route::get('settings', [App\Http\Controllers\Settings\GeneralController::class, 'index'])->name('settings.index');

/**
 * Management START
 */
Route::get('management', [App\Http\Controllers\Management\ManagementController::class, 'index'])->name('management.index');
