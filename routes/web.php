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
    Route::get('/{user}/impersonate', [App\Http\Controllers\UsersController::class, 'impersonate'])->name('impersonate');
    Route::get('/impersonate/leave', [App\Http\Controllers\UsersController::class, 'impersonateLeave'])->name('impersonate.leave');
});

Route::prefix('profile')->middleware(['auth'])->name('profile.')->group(function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('index');
    Route::get('/activity', [App\Http\Controllers\Settings\LogController::class, 'myLogs'])->name('logs');
});

/**
 * Users END
 */

/**
 * Settings START
 */
Route::prefix('settings')->middleware(['auth'])->name('settings.')->group(function (){
    Route::get('/', [App\Http\Controllers\Settings\GeneralController::class, 'index'])->name('general.index');
    Route::post('general/store', [App\Http\Controllers\Settings\GeneralController::class, 'storeGeneral'])->name('general.store');
    Route::get('server', [App\Http\Controllers\Settings\ServerController::class, 'index'])->name('server.index');
    Route::post('server/store/mail', [App\Http\Controllers\Settings\ServerController::class, 'storeMail'])->name('server.mail.store');
    Route::get('server/clearcache', [App\Http\Controllers\Settings\ServerController::class, 'cache'])->name('server.clearcache');
    Route::post('server/debugging', [App\Http\Controllers\Settings\ServerController::class, 'debugging'])->name('server.debugging');
    Route::get('server/phpinfo', function (){
        echo phpinfo();
    })->name('server.phpinfo');
    Route::get('/logs', [App\Http\Controllers\Settings\LogController::class, 'index'])->name('logs.index');
});


/**
 * Management START
 */
Route::prefix('management')->middleware(['auth'])->name('management.')->group(function (){
    Route::prefix('objectives')->name('objectives.')->group(function () {
        Route::get('/', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'store'])->name('store');
        Route::get('create', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'create'])->name('create');
        Route::get('edit/{objective}', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'edit'])->name('edit');
        Route::get('{objective}', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'show'])->name('show');
        Route::put('{objective}', [App\Http\Controllers\Management\ObjectiveTemplateController::class, 'update'])->name('update');
        Route::prefix('categories')->name('categories.')->group(function () {

        });
    });
    Route::prefix('organization')->name('organization.')->group(function () {
        Route::get('/', [App\Http\Controllers\Management\Organization\OrganizationController::class, 'index'])->name('index');
        Route::prefix('company')->name('company.')->group(function () {
            Route::get('/', [App\Http\Controllers\Management\Organization\CompanyController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Management\Organization\CompanyController::class, 'store'])->name('store');
            Route::get('create', [App\Http\Controllers\Management\Organization\CompanyController::class, 'create'])->name('create');
            Route::get('edit/{company}', [App\Http\Controllers\Management\Organization\CompanyController::class, 'edit'])->name('edit');
            Route::put('{company}', [App\Http\Controllers\Management\Organization\CompanyController::class, 'update'])->name('update');
        });
    });

});


Route::prefix('campaigns')->middleware(['auth'])->name('campaigns.')->group(function (){
    Route::get('/', [App\Http\Controllers\Campaigns\CampaignsController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\Campaigns\CampaignsController::class, 'store'])->name('store');
    Route::get('create', [App\Http\Controllers\Campaigns\CampaignsController::class, 'create'])->name('create');
    Route::get('edit/{campaign}', [App\Http\Controllers\Campaigns\CampaignsController::class, 'edit'])->name('edit');
    Route::get('{campaign}', [App\Http\Controllers\Campaigns\CampaignsController::class, 'show'])->name('show');
    Route::put('{campaign}', [App\Http\Controllers\Campaigns\CampaignsController::class, 'update'])->name('update');

    Route::prefix('objective')->name('objective.')->group(function (){
        Route::post('/', [App\Http\Controllers\Campaigns\CampaignObjectiveController::class, 'store'])->name('store');
        Route::put('/{objective}', [App\Http\Controllers\Campaigns\CampaignObjectiveController::class, 'update'])->name('update');

    });
});

Route::middleware(['auth'])->name('general.')->group(function () {
    Route::get('/get_modal', [App\Http\Controllers\GeneralController::class, 'getModal'])->name('get_modal');
});

Route::prefix('datatables')->middleware(['auth'])->name('datatables.')->group(function () {
    Route::post('/save_columns', [App\Facades\DataTables\CustomDataTable::class, 'saveColumns'])->name('save_columns');
});

Route::prefix('ajax')->middleware(['auth'])->name('ajax.')->group(function () {
    Route::get('/get_model_instance', [App\Http\Controllers\AjaxController::class, 'getModelInstance'])->name('get_model_instance');
});
