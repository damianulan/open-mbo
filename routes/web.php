<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\ResetPasswordController;
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
use App\Providers\RouteServiceProvider;
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

Route::middleware(['web', 'auth.base'])->group(function (): void {
    Route::get('/password/change', [ResetPasswordController::class, 'showForceResetForm'])->name('password.change.index');
    Route::post('/password/change/update', [ResetPasswordController::class, 'forceReset'])->name('password.change.update');
});

Route::middleware(['web', 'auth', 'maintenance'])->group(function (): void {
    Route::get(RouteServiceProvider::HOME, [HomeController::class, 'index'])->name('dashboard');
    Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));
    Route::get('health', Spatie\Health\Http\Controllers\HealthCheckResultsController::class);

    Laraverse::routes();

    /**
     * Users START
     */
    Route::prefix('users')->name('users.')->group(function (): void {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::post('/', [UsersController::class, 'store'])->name('store');
        Route::get('create', [UsersController::class, 'create'])->name('create');
        Route::get('edit/{user}', [UsersController::class, 'edit'])->name('edit');
        Route::get('{user}', [UsersController::class, 'show'])->name('show');
        Route::get('{user}/block', [UsersController::class, 'block'])->name('block');
        Route::get('{user}/favourite', [UsersController::class, 'favourite'])->name('favourite');
        Route::get('{user}/delete', [UsersController::class, 'delete'])->name('delete');
        Route::get('{user}/reset/password', [UsersController::class, 'resetPassword'])->name('reset_password');
        Route::put('{user}', [UsersController::class, 'update'])->name('update');
        Route::get('/{user}/impersonate', [UsersController::class, 'impersonate'])->name('impersonate');
        Route::get('/impersonate/leave', [UsersController::class, 'impersonateLeave'])->name('impersonate.leave');
    });

    Route::prefix('employments')->name('employments.')->group(function (): void {
        Route::post('/', [UsersController::class, 'storeEmployment'])->name('store');
        Route::get('{user}/delete', [UsersController::class, 'deleteEmployment'])->name('delete');
        Route::put('{user}', [UsersController::class, 'updateEmployment'])->name('update');
    });

    Route::prefix('profile')->name('profile.')->group(function (): void {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/activity', [LogController::class, 'myLogs'])->name('logs');
    });

    /**
     * Users END
     */

    /**
     * Settings START
     */
    Route::prefix('settings')->name('settings.')->group(function (): void {
        Route::prefix('general')->name('general.')->group(function (): void {
            Route::get('/', [GeneralController::class, 'index'])->name('index');
            Route::post('general/store', [GeneralController::class, 'storeGeneral'])->name('store');
        });
        Route::prefix('branding')->name('branding.')->group(function (): void {
            Route::post('store', [BrandingController::class, 'store'])->name('store');
        });
        Route::prefix('server')->name('server.')->group(function (): void {
            Route::get('/', [ServerController::class, 'index'])->name('index');
            Route::post('store/mail', [ServerController::class, 'storeMail'])->name('mail.store');
            Route::get('clearcache', [ServerController::class, 'cache'])->name('clearcache');
            Route::post('debugging', [ServerController::class, 'debugging'])->name('debugging');
            Route::post('debugbar-enable', [ServerController::class, 'debugbar'])->name('debugbar');
            Route::get('phpinfo', function (): void {
                echo phpinfo();
            })->name('phpinfo');
        });
        Route::prefix('logs')->name('logs.')->middleware('route.gate:settings-logs')->group(function (): void {
            Route::get('/', [LogController::class, 'index'])->name('index');
        });
        Route::prefix('notifications')->name('notifications.')->middleware('route.gate:settings-notifications')->group(function (): void {
            Route::get('/', [NotificationsController::class, 'index'])->name('index');
        });
        Route::prefix('modules')->name('modules.')->middleware('route.gate:settings-modules')->group(function (): void {
            Route::get('/{module?}', [ModuleController::class, 'index'])->name('index');
            Route::post('/users/store', [ModuleController::class, 'storeUsers'])->name('users.store');
            Route::post('/notifications/store', [ModuleController::class, 'storeNotifications'])->name('notifications.store');
            Route::post('/mbo/store', [ModuleController::class, 'storeMbo'])->name('mbo.store');
        });

        Route::prefix('organization')->name('organization.')->group(function (): void {
            Route::get('/', [OrganizationController::class, 'index'])->name('index');
            Route::prefix('company')->name('company.')->group(function (): void {
                Route::get('/', [CompanyController::class, 'index'])->name('index');
                Route::post('/', [CompanyController::class, 'store'])->name('store');
                Route::get('create', [CompanyController::class, 'create'])->name('create');
                Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('edit');
                Route::put('{company}', [CompanyController::class, 'update'])->name('update');
            });
        });
    });

    /**
     * Management START
     */
    Route::prefix('mbo')->middleware('module:mbo')->group(function (): void {
        Route::prefix('templates')->name('templates.')->group(function (): void {
            Route::get('/', [ObjectiveTemplateController::class, 'index'])->name('index');
            Route::post('/', [ObjectiveTemplateController::class, 'store'])->name('store');
            Route::get('create', [ObjectiveTemplateController::class, 'create'])->name('create');
            Route::get('edit/{objective}', [ObjectiveTemplateController::class, 'edit'])->name('edit');
            Route::get('{objective}', [ObjectiveTemplateController::class, 'show'])->name('show');
            Route::put('{objective}', [ObjectiveTemplateController::class, 'update'])->name('update');
            Route::get('/delete/{objective}', [ObjectiveTemplateController::class, 'delete'])->name('delete');
        });
        Route::prefix('categories')->name('categories.')->group(function (): void {
            Route::get('/', [ObjectiveCategoryController::class, 'index'])->name('index');
            Route::post('/', [ObjectiveCategoryController::class, 'store'])->name('store');
            Route::get('create', [ObjectiveCategoryController::class, 'create'])->name('create');
            Route::get('edit/{objective}', [ObjectiveCategoryController::class, 'edit'])->name('edit');
            Route::get('{objective}', [ObjectiveCategoryController::class, 'show'])->name('show');
            Route::put('{objective}', [ObjectiveCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{objective}', [ObjectiveCategoryController::class, 'delete'])->name('delete');
        });

        Route::prefix('objectives')->name('objectives.')->group(function (): void {
            Route::get('/', [ObjectiveController::class, 'index'])->name('index');
            Route::post('/', [ObjectiveController::class, 'store'])->name('store');
            Route::get('create', [ObjectiveController::class, 'create'])->name('create');
            Route::get('edit/{objective}', [ObjectiveController::class, 'edit'])->name('edit');
            Route::get('{user}', [ObjectiveController::class, 'show'])->name('show');
            Route::put('{objective}', [ObjectiveController::class, 'update'])->name('update');
            Route::get('/delete/{objective}', [ObjectiveController::class, 'delete'])->name('delete');

            Route::prefix('assignment')->name('assignment.')->group(function (): void {
                Route::get('/{id}', [UserObjectiveController::class, 'show'])->name('show');
                Route::post('{objective}', [UserObjectiveController::class, 'update'])->name('update');
                Route::post('evaluation/{id}', [UserObjectiveController::class, 'updateEvaluation'])->name('update_evaluation');
                Route::get('pass/{id}', [UserObjectiveController::class, 'pass'])->name('pass');
                Route::get('fail/{id}', [UserObjectiveController::class, 'fail'])->name('fail');
            });
        });

        Route::prefix('campaigns')->name('campaigns.')->group(function (): void {
            Route::get('/', [CampaignsController::class, 'index'])->name('index');
            Route::post('/', [CampaignsController::class, 'store'])->name('store');
            Route::get('create', [CampaignsController::class, 'create'])->name('create');
            Route::get('edit/{campaign}', [CampaignsController::class, 'edit'])->name('edit');
            Route::get('{campaign}', [CampaignsController::class, 'show'])->name('show');
            Route::put('{campaign}', [CampaignsController::class, 'update'])->name('update');
            Route::post('/terminate/{id}', [CampaignsController::class, 'terminate'])->name('terminate');
            Route::post('/resume/{id}', [CampaignsController::class, 'resume'])->name('resume');
            Route::post('/cancel/{id}', [CampaignsController::class, 'cancel'])->name('cancel');

            Route::prefix('objective')->name('objective.')->group(function (): void {
                Route::post('/', [CampaignObjectiveController::class, 'store'])->name('store');
                Route::put('/{objective}', [CampaignObjectiveController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [CampaignObjectiveController::class, 'delete'])->name('delete');
            });
            Route::prefix('users')->name('users.')->group(function (): void {
                Route::get('{userCampaign}', [CampaignUserController::class, 'show'])->name('show');
                Route::post('/{campaign}', [CampaignUserController::class, 'update'])->name('update');
                Route::get('/toggle-manual/{id}', [CampaignUserController::class, 'toggleManual'])->name('toggle_manual');
                Route::get('/next-stage/{id}', [CampaignUserController::class, 'moveStageUp'])->name('next_stage');
                Route::get('/prev-stage/{id}', [CampaignUserController::class, 'moveStageDown'])->name('prev_stage');
                Route::delete('/delete/{id}', [CampaignUserController::class, 'delete'])->name('delete');
            });
        });
    });

    Route::name('general.')->group(function (): void {
        Route::get('/get_modal', [ModalController::class, 'getModal'])->name('get_modal');
    });

    Route::prefix('datatables')->name('datatables.')->group(function (): void {
        Route::post('/save_columns', [CustomDataTable::class, 'saveColumns'])->name('save_columns');
        Route::get('/excel/{class}', [DataTableController::class, 'toExcel'])->name('excel');
        Route::get('/csv/{class}', [DataTableController::class, 'toCsv'])->name('csv');
        Route::get('/pdf/{class}', [DataTableController::class, 'toPdf'])->name('pdf');
        Route::get('/json/{class}', [DataTableController::class, 'toJson'])->name('json');
        Route::get('/print/{class}', [DataTableController::class, 'print'])->name('print');
    });

    Route::prefix('ajax')->name('ajax.')->group(function (): void {
        Route::get('/get_model_instance', [AjaxController::class, 'getModelInstance'])->name('get_model_instance');
    });

    // Route::fallback(function () {
    //     return redirect()->route('dashboard')->with('error', 'Nie znaleziono strony');
    // })->name('fallback');
});
