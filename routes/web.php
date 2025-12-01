<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BrandingController;
use App\Http\Controllers\Campaigns\CampaignObjectiveController;
use App\Http\Controllers\Campaigns\CampaignsController;
use App\Http\Controllers\Campaigns\CampaignUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\Objectives\ObjectiveCategoryController;
use App\Http\Controllers\Objectives\ObjectiveController;
use App\Http\Controllers\Objectives\ObjectiveTemplateController;
use App\Http\Controllers\Objectives\UserObjectiveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\GeneralController;
use App\Http\Controllers\Settings\LogController;
use App\Http\Controllers\Settings\ModuleController;
use App\Http\Controllers\Settings\NotificationsController;
use App\Http\Controllers\Settings\Organization\CompanyController;
use App\Http\Controllers\Settings\Organization\OrganizationController;
use App\Http\Controllers\Settings\ServerController;
use App\Http\Controllers\UsersController;
use App\Support\DataTables\CustomDataTable;
use App\Support\DataTables\DataTableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laraverse\Config\Laraverse;
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

Route::middleware('web')->group(function (): void {
    Auth::routes();
});

Route::middleware(array('web', 'auth', 'maintenance'))->group(function (): void {
    Route::get('/', array(HomeController::class, 'index'))->name('dashboard');
    Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));

    Laraverse::routes();

    /**
     * Users START
     */
    Route::prefix('users')->name('users.')->group(function (): void {
        Route::get('/', array(UsersController::class, 'index'))->name('index');
        Route::post('/', array(UsersController::class, 'store'))->name('store');
        Route::get('create', array(UsersController::class, 'create'))->name('create');
        Route::get('edit/{user}', array(UsersController::class, 'edit'))->name('edit');
        Route::get('{user}', array(UsersController::class, 'show'))->name('show');
        Route::get('{user}/block', array(UsersController::class, 'block'))->name('block');
        Route::get('{user}/favourite', array(UsersController::class, 'favourite'))->name('favourite');
        Route::get('{user}/delete', array(UsersController::class, 'delete'))->name('delete');
        Route::put('{user}', array(UsersController::class, 'update'))->name('update');
        Route::get('/{user}/impersonate', array(UsersController::class, 'impersonate'))->name('impersonate');
        Route::get('/impersonate/leave', array(UsersController::class, 'impersonateLeave'))->name('impersonate.leave');
    });

    Route::prefix('employments')->name('employments.')->group(function (): void {
        Route::post('/', array(UsersController::class, 'storeEmployment'))->name('store');
        Route::get('{user}/delete', array(UsersController::class, 'deleteEmployment'))->name('delete');
        Route::put('{user}', array(UsersController::class, 'updateEmployment'))->name('update');
    });

    Route::prefix('profile')->name('profile.')->group(function (): void {
        Route::get('/', array(ProfileController::class, 'index'))->name('index');
        Route::get('/activity', array(LogController::class, 'myLogs'))->name('logs');
    });

    /**
     * Users END
     */

    /**
     * Settings START
     */
    Route::prefix('settings')->name('settings.')->group(function (): void {
        Route::prefix('general')->name('general.')->group(function (): void {
            Route::get('/', array(GeneralController::class, 'index'))->name('index');
            Route::post('general/store', array(GeneralController::class, 'storeGeneral'))->name('store');
        });
        Route::prefix('branding')->name('branding.')->group(function (): void {
            Route::post('store', array(BrandingController::class, 'store'))->name('store');
        });
        Route::prefix('server')->name('server.')->group(function (): void {
            Route::get('/', array(ServerController::class, 'index'))->name('index');
            Route::post('store/mail', array(ServerController::class, 'storeMail'))->name('mail.store');
            Route::get('clearcache', array(ServerController::class, 'cache'))->name('clearcache');
            Route::post('debugging', array(ServerController::class, 'debugging'))->name('debugging');
            Route::post('debugbar-enable', array(ServerController::class, 'debugbar'))->name('debugbar');
            Route::get('phpinfo', function (): void {
                echo phpinfo();
            })->name('phpinfo');
        });
        Route::prefix('logs')->name('logs.')->middleware('route.gate:settings-logs')->group(function (): void {
            Route::get('/', array(LogController::class, 'index'))->name('index');
        });
        Route::prefix('notifications')->name('notifications.')->middleware('route.gate:settings-notifications')->group(function (): void {
            Route::get('/', array(NotificationsController::class, 'index'))->name('index');
        });
        Route::prefix('modules')->name('modules.')->middleware('route.gate:settings-modules')->group(function (): void {
            Route::get('/{module?}', array(ModuleController::class, 'index'))->name('index');
            Route::post('/users/store', array(ModuleController::class, 'storeUsers'))->name('users.store');
            Route::post('/notifications/store', array(ModuleController::class, 'storeNotifications'))->name('notifications.store');
            Route::post('/mbo/store', array(ModuleController::class, 'storeMbo'))->name('mbo.store');
        });

        Route::prefix('organization')->name('organization.')->group(function (): void {
            Route::get('/', array(OrganizationController::class, 'index'))->name('index');
            Route::prefix('company')->name('company.')->group(function (): void {
                Route::get('/', array(CompanyController::class, 'index'))->name('index');
                Route::post('/', array(CompanyController::class, 'store'))->name('store');
                Route::get('create', array(CompanyController::class, 'create'))->name('create');
                Route::get('edit/{company}', array(CompanyController::class, 'edit'))->name('edit');
                Route::put('{company}', array(CompanyController::class, 'update'))->name('update');
            });
        });
    });

    /**
     * Management START
     */
    Route::prefix('mbo')->middleware('module:mbo')->group(function (): void {
        Route::prefix('templates')->name('templates.')->group(function (): void {
            Route::get('/', array(ObjectiveTemplateController::class, 'index'))->name('index');
            Route::post('/', array(ObjectiveTemplateController::class, 'store'))->name('store');
            Route::get('create', array(ObjectiveTemplateController::class, 'create'))->name('create');
            Route::get('edit/{objective}', array(ObjectiveTemplateController::class, 'edit'))->name('edit');
            Route::get('{objective}', array(ObjectiveTemplateController::class, 'show'))->name('show');
            Route::put('{objective}', array(ObjectiveTemplateController::class, 'update'))->name('update');
            Route::get('/delete/{objective}', array(ObjectiveTemplateController::class, 'delete'))->name('delete');
        });
        Route::prefix('categories')->name('categories.')->group(function (): void {
            Route::get('/', array(ObjectiveCategoryController::class, 'index'))->name('index');
            Route::post('/', array(ObjectiveCategoryController::class, 'store'))->name('store');
            Route::get('create', array(ObjectiveCategoryController::class, 'create'))->name('create');
            Route::get('edit/{objective}', array(ObjectiveCategoryController::class, 'edit'))->name('edit');
            Route::get('{objective}', array(ObjectiveCategoryController::class, 'show'))->name('show');
            Route::put('{objective}', array(ObjectiveCategoryController::class, 'update'))->name('update');
            Route::get('/delete/{objective}', array(ObjectiveCategoryController::class, 'delete'))->name('delete');
        });

        Route::prefix('objectives')->name('objectives.')->group(function (): void {
            Route::get('/', array(ObjectiveController::class, 'index'))->name('index');
            Route::post('/', array(ObjectiveController::class, 'store'))->name('store');
            Route::get('create', array(ObjectiveController::class, 'create'))->name('create');
            Route::get('edit/{objective}', array(ObjectiveController::class, 'edit'))->name('edit');
            Route::get('{user}', array(ObjectiveController::class, 'show'))->name('show');
            Route::put('{objective}', array(ObjectiveController::class, 'update'))->name('update');
            Route::get('/delete/{objective}', array(ObjectiveController::class, 'delete'))->name('delete');

            Route::prefix('assignment')->name('assignment.')->group(function (): void {
                Route::get('/{id}', array(UserObjectiveController::class, 'show'))->name('show');
                Route::post('{objective}', array(UserObjectiveController::class, 'update'))->name('update');
                Route::post('evaluation/{id}', array(UserObjectiveController::class, 'updateEvaluation'))->name('update_evaluation');
                Route::get('pass/{id}', array(UserObjectiveController::class, 'pass'))->name('pass');
                Route::get('fail/{id}', array(UserObjectiveController::class, 'fail'))->name('fail');
            });
        });

        Route::prefix('campaigns')->name('campaigns.')->group(function (): void {
            Route::get('/', array(CampaignsController::class, 'index'))->name('index');
            Route::post('/', array(CampaignsController::class, 'store'))->name('store');
            Route::get('create', array(CampaignsController::class, 'create'))->name('create');
            Route::get('edit/{campaign}', array(CampaignsController::class, 'edit'))->name('edit');
            Route::get('{campaign}', array(CampaignsController::class, 'show'))->name('show');
            Route::put('{campaign}', array(CampaignsController::class, 'update'))->name('update');
            Route::post('/terminate/{id}', array(CampaignsController::class, 'terminate'))->name('terminate');
            Route::post('/resume/{id}', array(CampaignsController::class, 'resume'))->name('resume');
            Route::post('/cancel/{id}', array(CampaignsController::class, 'cancel'))->name('cancel');

            Route::prefix('objective')->name('objective.')->group(function (): void {
                Route::post('/', array(CampaignObjectiveController::class, 'store'))->name('store');
                Route::put('/{objective}', array(CampaignObjectiveController::class, 'update'))->name('update');
                Route::delete('/delete/{id}', array(CampaignObjectiveController::class, 'delete'))->name('delete');
            });
            Route::prefix('users')->name('users.')->group(function (): void {
                Route::get('{userCampaign}', array(CampaignUserController::class, 'show'))->name('show');
                Route::post('/{campaign}', array(CampaignUserController::class, 'update'))->name('update');
                Route::get('/toggle-manual/{id}', array(CampaignUserController::class, 'toggleManual'))->name('toggle_manual');
                Route::get('/next-stage/{id}', array(CampaignUserController::class, 'moveStageUp'))->name('next_stage');
                Route::get('/prev-stage/{id}', array(CampaignUserController::class, 'moveStageDown'))->name('prev_stage');
                Route::delete('/delete/{id}', array(CampaignUserController::class, 'delete'))->name('delete');
            });
        });
    });

    Route::name('general.')->group(function (): void {
        Route::get('/get_modal', array(ModalController::class, 'getModal'))->name('get_modal');
    });

    Route::prefix('datatables')->name('datatables.')->group(function (): void {
        Route::post('/save_columns', array(CustomDataTable::class, 'saveColumns'))->name('save_columns');
        Route::get('/excel/{class}', array(DataTableController::class, 'toExcel'))->name('excel');
        Route::get('/csv/{class}', array(DataTableController::class, 'toCsv'))->name('csv');
        Route::get('/pdf/{class}', array(DataTableController::class, 'toPdf'))->name('pdf');
        Route::get('/json/{class}', array(DataTableController::class, 'toJson'))->name('json');
        Route::get('/print/{class}', array(DataTableController::class, 'print'))->name('print');
    });

    Route::prefix('ajax')->name('ajax.')->group(function (): void {
        Route::get('/get_model_instance', array(AjaxController::class, 'getModelInstance'))->name('get_model_instance');
    });

    // Route::fallback(function () {
    //     return redirect()->route('dashboard')->with('error', 'Nie znaleziono strony');
    // })->name('fallback');
});
