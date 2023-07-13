<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


//Route::group(
//    [
//        'prefix' => LaravelLocalization::setLocale(),
//        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//    ], function () {

Route::get('/', function () {
    return redirect('admin/login');
});
//});

// sign
Route::get('sign_in', [HomeController::class, 'signIn'])->name('signIn');
Route::get('sign_up', [HomeController::class, 'signUp'])->name('signUp');
Route::get('new_password', [HomeController::class, 'newPassword'])->name('newPassword');
Route::get('forget_password', [HomeController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('verification', [HomeController::class, 'verification'])->name('verification');

// index
Route::get('index', [HomeController::class, 'index'])->name('index');

// Invite 
Route::get('invites', [HomeController::class, 'showInvites'])->name('invites');
Route::get('add_invites', [HomeController::class, 'addInvites'])->name('addInvites');
Route::get('add_guest', [HomeController::class, 'addGuest'])->name('addGuest');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('profile', [HomeController::class, 'profile'])->name('profile');
Route::get('reminder', [HomeController::class, 'reminder'])->name('reminder');
Route::get('show_excel', [HomeController::class, 'showExcel'])->name('showExcel');
Route::get('scans', [HomeController::class, 'scans'])->name('scans');
