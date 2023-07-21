<?php

use App\Http\Controllers\Front\ContactsController;
use App\Http\Controllers\Front\InvitationController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InviteController;
use App\Http\Controllers\Front\ReminderController;
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


Route::group(['middleware' => ['auth:web']], function () {
    Route::get('invites', [InviteController::class, 'index'])->name('invites');
    Route::get('edit_invites/{id}', [InviteController::class, 'edit'])->name('edit.invite');
    Route::post('send_invite_by_whatsapp', [InviteController::class, 'sendInviteByWhatsapp'])->name('sendInviteByWhatsapp');
    Route::get('managScanned/{id}', [InviteController::class, 'showUserScanned'])->name('showUserScanned');

    Route::get('add_invites', [HomeController::class, 'addInvites'])->name('addInvites');
    Route::get('add_guest', [HomeController::class, 'addGuest'])->name('addGuest');


    //add invitations
    Route::post('add-invitation-by-client', [InvitationController::class, 'addInvitationByClient'])->name('addInvitationByClient');


    /**
     * contacts controller
     */
    Route::resource('contact', ContactsController::class);
//    Route::get('contact', [ContactsController::class, 'index'])->name('contact');
    Route::get('contacts/show_excel', [ContactsController::class, 'showExcel'])->name('contacts.showExcel');

    Route::post('contacts/import', [ContactsController::class, 'import'])->name('contacts.import');

    /**
     *  end contacts controller
     */
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');

    Route::get('reminder/{id}', [ReminderController::class, 'index'])->name('reminder');
    Route::get('show_excel', [HomeController::class, 'showExcel'])->name('showExcel');

    Route::get('reminder', [HomeController::class, 'reminder'])->name('reminder');
    Route::get('scans', [HomeController::class, 'scans'])->name('scans');
    Route::get('Userlogout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::get('/', function () {
    return redirect('/');
});


Route::group(['prefix' => 'user'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('user');
    Route::POST('login', [AuthController::class, 'login'])->name('user.login');
});

Route::post('register', [AuthController::class, 'register'])->name('user.register');

// sign
Route::get('sign_in', [HomeController::class, 'signIn'])->name('signIn');
Route::get('sign_up', [HomeController::class, 'signUp'])->name('signUp');
Route::get('new_password', [HomeController::class, 'newPassword'])->name('newPassword');
Route::get('forget_password', [HomeController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('verification', [HomeController::class, 'verification'])->name('verification');

// index
Route::get('/', [HomeController::class, 'index'])->name('index');

