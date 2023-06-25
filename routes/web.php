<?php

use Illuminate\Http\Request;
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
Route::prefix('settings')->middleware(['auth'])->name('settings.')->group(function (){
    Route::get('/', [App\Http\Controllers\Settings\GeneralController::class, 'index'])->name('index');
    Route::post('general/store', [App\Http\Controllers\Settings\GeneralController::class, 'storeGeneral'])->name('general.store');
    Route::get('modules', [App\Http\Controllers\Settings\ModulesController::class, 'index'])->name('modules');
    Route::post('modules/updatestatus', [App\Http\Controllers\Settings\ModulesController::class, 'updateStatus'])->name('modules.updatestatus');
    Route::get('server', [App\Http\Controllers\Settings\ServerController::class, 'index'])->name('server');
    Route::post('server/store/mail', [App\Http\Controllers\Settings\ServerController::class, 'storeMail'])->name('server.mail.store');
    Route::get('server/clearcache', [App\Http\Controllers\Settings\ServerController::class, 'cache'])->name('clearcache');
    Route::post('server/debugging', [App\Http\Controllers\Settings\ServerController::class, 'debugging'])->name('debugging');
    Route::get('server/phpinfo', function (Request $request){
        echo phpinfo();
    })->name('server.phpinfo');
});


/**
 * Management START
 */
Route::get('management', [App\Http\Controllers\Management\ManagementController::class, 'index'])->middleware('auth')->name('management.index');


/**
 * COURSES
 */
Route::middleware(['auth'])->group(function (){
    Route::resource('courses', App\Http\Controllers\Elearning\CourseController::class);
    Route::prefix('courses')->group(function() {
        Route::resource('category', App\Http\Controllers\Elearning\CategoryController::class);
    });
});


