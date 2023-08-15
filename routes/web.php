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
Route::prefix('users')->middleware(['auth'])->name('users.')->group(function (){
    Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\UsersController::class, 'store'])->name('store');
    Route::get('create', [App\Http\Controllers\UsersController::class, 'create'])->name('create');
    Route::get('edit/{user}', [App\Http\Controllers\UsersController::class, 'edit'])->name('edit');
    Route::get('{user}', [App\Http\Controllers\UsersController::class, 'show'])->name('show');
    Route::get('{user}/block', [App\Http\Controllers\UsersController::class, 'block'])->name('block');
    Route::get('{user}/delete', [App\Http\Controllers\UsersController::class, 'delete'])->name('delete');
    Route::put('{user}', [App\Http\Controllers\UsersController::class, 'update'])->name('update');

});

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
    Route::get('server', [App\Http\Controllers\Settings\ServerController::class, 'index'])->name('server');
    Route::post('server/store/mail', [App\Http\Controllers\Settings\ServerController::class, 'storeMail'])->name('server.mail.store');
    Route::get('server/clearcache', [App\Http\Controllers\Settings\ServerController::class, 'cache'])->name('clearcache');
    Route::post('server/debugging', [App\Http\Controllers\Settings\ServerController::class, 'debugging'])->name('debugging');
    Route::get('server/phpinfo', function (){
        echo phpinfo();
    })->name('server.phpinfo');
});


/**
 * Management START
 */
Route::prefix('management')->middleware(['auth'])->name('management.')->group(function (){
    Route::prefix('objectives')->group(function () {
        Route::get('/', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\ObjectiveTemplateController::class, 'store'])->name('objectives.store');
        Route::get('create', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'create'])->name('objectives.create');
    });


});


Route::prefix('campaigns')->middleware(['auth'])->name('campaigns.')->group(function (){
    Route::get('/', [App\Http\Controllers\CampaignsController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\CampaignsController::class, 'store'])->name('store');
    Route::get('create', [App\Http\Controllers\CampaignsController::class, 'create'])->name('create');
    Route::get('edit/{user}', [App\Http\Controllers\CampaignsController::class, 'edit'])->name('edit');
    Route::get('{user}', [App\Http\Controllers\CampaignsController::class, 'show'])->name('show');
    Route::put('{user}', [App\Http\Controllers\CampaignsController::class, 'update'])->name('update');

});
