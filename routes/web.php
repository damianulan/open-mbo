<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

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

Route::middleware(['web', 'auth', 'maintenance'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    /**
     * Users START
     */
    Route::prefix('users')->name('users.')->group(function () {
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

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('index');
        Route::get('/activity', [App\Http\Controllers\Settings\LogController::class, 'myLogs'])->name('logs');
    });

    /**
     * Users END
     */

    /**
     * Settings START
     */
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::prefix('general')->name('general.')->middleware('route.gate:settings-general')->group(function () {
            Route::get('/', [App\Http\Controllers\Settings\GeneralController::class, 'index'])->name('index');
            Route::post('general/store', [App\Http\Controllers\Settings\GeneralController::class, 'storeGeneral'])->name('store');
        });

        Route::prefix('server')->name('server.')->middleware('route.gate:settings-server')->group(function () {
            Route::get('/', [App\Http\Controllers\Settings\ServerController::class, 'index'])->name('index');
            Route::post('store/mail', [App\Http\Controllers\Settings\ServerController::class, 'storeMail'])->name('mail.store');
            Route::get('clearcache', [App\Http\Controllers\Settings\ServerController::class, 'cache'])->name('clearcache');
            Route::post('debugging', [App\Http\Controllers\Settings\ServerController::class, 'debugging'])->name('debugging');
            Route::post('debugbar-enable', [App\Http\Controllers\Settings\ServerController::class, 'debugbar'])->name('debugbar');
            Route::get('phpinfo', function () {
                echo phpinfo();
            })->name('phpinfo');
        });
        Route::prefix('logs')->name('logs.')->middleware('route.gate:settings-logs')->group(function () {
            Route::get('/', [App\Http\Controllers\Settings\LogController::class, 'index'])->name('index');
        });
        Route::prefix('modules')->name('modules.')->middleware('route.gate:settings-modules')->group(function () {
            Route::get('/{module?}', [App\Http\Controllers\Settings\ModuleController::class, 'index'])->name('index');
            Route::post('/mbo/store', [App\Http\Controllers\Settings\ModuleController::class, 'storeMbo'])->name('mbo.store');
        });

        Route::prefix('organization')->name('organization.')->group(function () {
            Route::get('/', [App\Http\Controllers\Settings\Organization\OrganizationController::class, 'index'])->name('index');
            Route::prefix('company')->name('company.')->group(function () {
                Route::get('/', [App\Http\Controllers\Settings\Organization\CompanyController::class, 'index'])->name('index');
                Route::post('/', [App\Http\Controllers\Settings\Organization\CompanyController::class, 'store'])->name('store');
                Route::get('create', [App\Http\Controllers\Settings\Organization\CompanyController::class, 'create'])->name('create');
                Route::get('edit/{company}', [App\Http\Controllers\Settings\Organization\CompanyController::class, 'edit'])->name('edit');
                Route::put('{company}', [App\Http\Controllers\Settings\Organization\CompanyController::class, 'update'])->name('update');
            });
        });
    });


    /**
     * Management START
     */
    Route::prefix('mbo')->name('mbo.')->group(function () {
        Route::prefix('templates')->name('templates.')->middleware('module:mbo')->group(function () {
            Route::get('/', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'store'])->name('store');
            Route::get('create', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'create'])->name('create');
            Route::get('edit/{objective}', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'edit'])->name('edit');
            Route::get('{objective}', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'show'])->name('show');
            Route::put('{objective}', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'update'])->name('update');
            Route::get('/delete/{objective}', [App\Http\Controllers\Objectives\ObjectiveTemplateController::class, 'delete'])->name('delete');
        });
        Route::prefix('categories')->name('categories.')->middleware('module:mbo')->group(function () {
            Route::get('/', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'store'])->name('store');
            Route::get('create', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'create'])->name('create');
            Route::get('edit/{objective}', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'edit'])->name('edit');
            Route::get('{objective}', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'show'])->name('show');
            Route::put('{objective}', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{objective}', [App\Http\Controllers\Objectives\ObjectiveCategoryController::class, 'delete'])->name('delete');
        });

        Route::prefix('objectives')->name('objectives.')->middleware('module:mbo')->group(function () {
            Route::get('/', [App\Http\Controllers\Objectives\ObjectiveController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Objectives\ObjectiveController::class, 'store'])->name('store');
            Route::get('create', [App\Http\Controllers\Objectives\ObjectiveController::class, 'create'])->name('create');
            Route::get('edit/{objective}', [App\Http\Controllers\Objectives\ObjectiveController::class, 'edit'])->name('edit');
            Route::get('{user}', [App\Http\Controllers\Objectives\ObjectiveController::class, 'show'])->name('show');
            Route::put('{objective}', [App\Http\Controllers\Objectives\ObjectiveController::class, 'update'])->name('update');
            Route::get('/delete/{objective}', [App\Http\Controllers\Objectives\ObjectiveController::class, 'delete'])->name('delete');

            Route::prefix('assignment')->name('assignment.')->group(function () {
                Route::get('/{id}', [App\Http\Controllers\Objectives\UserObjectiveController::class, 'show'])->name('show');
                Route::post('{objective}', [App\Http\Controllers\Objectives\UserObjectiveController::class, 'update'])->name('update');
            });
        });
    });

    Route::prefix('campaigns')->name('campaigns.')->middleware('module:mbo')->group(function () {
        Route::get('/', [App\Http\Controllers\Campaigns\CampaignsController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Campaigns\CampaignsController::class, 'store'])->name('store');
        Route::get('create', [App\Http\Controllers\Campaigns\CampaignsController::class, 'create'])->name('create');
        Route::get('edit/{campaign}', [App\Http\Controllers\Campaigns\CampaignsController::class, 'edit'])->name('edit');
        Route::get('{campaign}', [App\Http\Controllers\Campaigns\CampaignsController::class, 'show'])->name('show');
        Route::put('{campaign}', [App\Http\Controllers\Campaigns\CampaignsController::class, 'update'])->name('update');

        Route::prefix('objective')->name('objective.')->group(function () {
            Route::post('/', [App\Http\Controllers\Campaigns\CampaignObjectiveController::class, 'store'])->name('store');
            Route::put('/{objective}', [App\Http\Controllers\Campaigns\CampaignObjectiveController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [App\Http\Controllers\Campaigns\CampaignObjectiveController::class, 'delete'])->name('delete');
        });
        Route::prefix('users')->name('users.')->group(function () {
            Route::post('/{campaign}', [App\Http\Controllers\Campaigns\CampaignUserController::class, 'update'])->name('update');
            Route::get('/toggle-manual/{id}', [App\Http\Controllers\Campaigns\CampaignUserController::class, 'toggleManual'])->name('toggle_manual');
            Route::get('/next-stage/{id}', [App\Http\Controllers\Campaigns\CampaignUserController::class, 'moveStageUp'])->name('next_stage');
            Route::get('/prev-stage/{id}', [App\Http\Controllers\Campaigns\CampaignUserController::class, 'moveStageDown'])->name('prev_stage');
            Route::delete('/delete/{id}', [App\Http\Controllers\Campaigns\CampaignUserController::class, 'delete'])->name('delete');
        });
    });



    Route::name('general.')->group(function () {
        Route::get('/get_modal', [App\Http\Controllers\GeneralController::class, 'getModal'])->name('get_modal');
    });

    Route::prefix('datatables')->name('datatables.')->group(function () {
        Route::post('/save_columns', [App\Support\DataTables\CustomDataTable::class, 'saveColumns'])->name('save_columns');
        Route::get('/excel/{class}', [App\Support\DataTables\DataTableController::class, 'toExcel'])->name('excel');
        Route::get('/csv/{class}', [App\Support\DataTables\DataTableController::class, 'toCsv'])->name('csv');
    });

    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('/get_model_instance', [App\Http\Controllers\AjaxController::class, 'getModelInstance'])->name('get_model_instance');
    });

    Route::fallback(function () {
        return redirect()->route('dashboard')->with('error', 'Nie znaleziono strony');
    })->name('fallback');
});
