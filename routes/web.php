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


/**
 * Users END
 */