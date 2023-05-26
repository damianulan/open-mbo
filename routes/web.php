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

Route::get('settings', [App\Http\Controllers\Settings\GeneralController::class, 'index'])->middleware('auth')->name('settings.index');
Route::get('settings/server', [App\Http\Controllers\Settings\ServerController::class, 'index'])->middleware('auth')->name('settings.server');
Route::get('settings/server/clearcache', [App\Http\Controllers\Settings\ServerController::class, 'cache'])->middleware('auth')->name('settings.clearcache');
Route::get('settings/server/pull', [App\Http\Controllers\Settings\ServerController::class, 'pull'])->middleware('auth')->name('settings.pull');

/**
 * Management START
 */
Route::get('management', [App\Http\Controllers\Management\ManagementController::class, 'index'])->middleware('auth')->name('management.index');


/**
 * COURSES
 */
Route::get('course/view/{id?}', [App\Http\Controllers\CourseController::class, 'view'])->middleware('auth')->name('course.view');
Route::get('course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->middleware('auth')->name('course.edit');

