<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleSocialiteController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// TODO - Notes Good to make file admin.php for routes admin
Route::group(['prefix'=>'admin', 'middleware' => 'admin'], function(){
    Route::resource('users', UserController::class);
    Route::get('users-datatable', [UserController::class, 'dataTables'])->name('users.datatable');
    Route::get('toggle-users-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggle_status');
});

// TODO rename controller TO ADD ALL with {provider} - facebook twitter ... etc
Route::get('auth/{provider}', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/{provider}', [GoogleSocialiteController::class, 'handleCallback']);

//Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
//Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

