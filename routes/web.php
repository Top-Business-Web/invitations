<?php

use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Front\ContactsController;
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

/**
 * Start Register
 */
Route::post('register', [AuthController::class, 'register'])->name('user.register');

/**
 * End Register
 */
/**
 * Start Sign In
 */

Route::group(['prefix' => 'user'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('user');
    Route::POST('login', [AuthController::class, 'login'])->name('user.login');
});

/**
 * End Sign In
 */


Route::group(['middleware' => ['auth:web']], function () {
    Route::get('invites', [InviteController::class, 'index'])->name('invites');
    Route::get('edit_invitation/{id}', [InviteController::class, 'editInvitation'])->name('editInvitation');
    Route::get('edit_invites/{id}', [InviteController::class, 'edit'])->name('edit.invite');
    Route::get('reminder/{id}', [ReminderController::class, 'index'])->name('reminder');
    Route::post('send_invite_by_whatsapp', [InviteController::class, 'sendInviteByWhatsapp'])->name('sendInviteByWhatsapp');
    Route::get('managScanned/{id}', [InviteController::class, 'showUserScanned'])->name('showUserScanned');
    Route::get('add_invites', [HomeController::class, 'addInvites'])->name('addInvites');
    Route::delete('/delete-invitation/{id}', [InvitationController::class, 'deleteInvitation']);
    Route::post('/search-invitations', [InvitationController::class, 'search'])->name('search.invitations');
    Route::get('/sort_data', [InvitationController::class, 'sort'])->name('sort_data');


    Route::get('add_guest', [HomeController::class, 'addGuest'])->name('addGuest');
    Route::get('notfound', [HomeController::class, 'notfound'])->name('notfound');
    /**
     * contacts controller
     */
    Route::resource('contact', ContactsController::class);
    Route::get('contacts/show_excel', [ContactsController::class, 'showExcel'])->name('contacts.showExcel');

    Route::post('contacts/import', [ContactsController::class, 'import'])->name('contacts.import');

    /**
     *  end contacts controller
     */
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');

    Route::get('show_excel', [HomeController::class, 'showExcel'])->name('showExcel');

    Route::get('scans', [HomeController::class, 'scans'])->name('scans');
    Route::get('Userlogout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::get('/', function () {
    return redirect('/');
});

// sign
Route::get('sign_in', [HomeController::class, 'signIn'])->name('signIn');
Route::get('sign_up', [HomeController::class, 'signUp'])->name('signUp');
Route::get('new_password', [HomeController::class, 'newPassword'])->name('newPassword');
Route::get('forget_password', [HomeController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('verification', [HomeController::class, 'verification'])->name('verification');

// index
Route::get('/', [HomeController::class, 'index'])->name('index');
