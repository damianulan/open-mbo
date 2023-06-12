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
Route::post('settings/general/store', [App\Http\Controllers\Settings\GeneralController::class, 'storeGeneral'])->middleware('auth')->name('settings.general.store');
Route::get('settings/modules', [App\Http\Controllers\Settings\ModulesController::class, 'index'])->middleware('auth')->name('settings.modules');
Route::post('settings/modules/updatestatus', [App\Http\Controllers\Settings\ModulesController::class, 'updateStatus'])->middleware('auth')->name('settings.modules.updatestatus');
Route::get('settings/server', [App\Http\Controllers\Settings\ServerController::class, 'index'])->middleware('auth')->name('settings.server');
Route::post('settings/server/store/mail', [App\Http\Controllers\Settings\ServerController::class, 'storeMail'])->middleware('auth')->name('settings.server.mail.store');
Route::get('settings/server/clearcache', [App\Http\Controllers\Settings\ServerController::class, 'cache'])->middleware('auth')->name('settings.clearcache');
Route::post('settings/server/debugging', [App\Http\Controllers\Settings\ServerController::class, 'debugging'])->middleware('auth')->name('settings.debugging');

/**
 * Management START
 */
Route::get('management', [App\Http\Controllers\Management\ManagementController::class, 'index'])->middleware('auth')->name('management.index');


/**
 * COURSES
 */
Route::resource('courses', App\Http\Controllers\CourseController::class)->middleware('auth');


