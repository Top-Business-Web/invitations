<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InviteController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ContactsController;
use App\Http\Controllers\Front\ReminderController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Front\GoogleLoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Front\InvitationController as AddInvitationController;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
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

        // Login Google Controller
        Route::get('/login/google', [GoogleLoginController::class, 'redirect'])->name('login.google-redirect');
        Route::get('/login/google/callback', [GoogleLoginController::class, 'callback'])->name('login.google-callback');


        Route::group(['middleware' => ['auth:web']], function () {
            Route::get('invites', [InviteController::class, 'index'])->name('invites');
            Route::get('edit_invites/{id}', [InviteController::class, 'edit'])->name('edit.invite');
            Route::get('/search/invitations', [InviteController::class, 'searchIndex'])->name('searchInvitations');
            Route::get('reminder/{id}', [ReminderController::class, 'index'])->name('reminder');
            Route::post('send_invite_by_whatsapp', [InviteController::class, 'sendInviteByWhatsapp'])->name('sendInviteByWhatsapp');
            Route::get('managScanned/{id}', [InviteController::class, 'showUserScanned'])->name('showUserScanned');


            //add invitation
            Route::get('add_invites', [HomeController::class, 'addInvites'])->name('addInvites');
            Route::delete('/delete-invitation/{id}', [InvitationController::class, 'deleteInvitation']);
            Route::get('/sort_data', [InvitationController::class, 'sort'])->name('sort_data');


            Route::get('add_guest', [HomeController::class, 'addGuest'])->name('addGuest');





            //add invitations
            Route::post('add-invitation-by-client', [AddInvitationController::class, 'addInvitationByClient'])->name('addInvitationByClient');
            Route::post('addDraft', [AddInvitationController::class, 'addDraft'])->name('addDraft');
            Route::get('edit_invitation/{id}', [AddInvitationController::class, 'editInvitation'])->name('editInvitation');
            Route::post('editInvitationByClient', [AddInvitationController::class, 'editInvitationByClient'])->name('editInvitationByClient');
            Route::get('invitation-by-client-step-two/{id}', [AddInvitationController::class, 'InvitationStepTwo'])->name('InvitationStepTwo');
            Route::post('add-invitation-by-client-step-two/', [AddInvitationController::class, 'addInvitationStepTwo'])->name('addInvitationStepTwo');
            Route::post('update-invitation-by-client/{id}', [AddInvitationController::class, 'updateInvitationByClient'])->name('updateInvitationByClient');





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
            Route::get('profile', [ProfileController::class, 'getProfileUserData'])->name('getProfileUserData');
            Route::post('/update-profile',  [ProfileController::class, 'update'])->name('update_profile');



            Route::get('show_excel', [HomeController::class, 'showExcel'])->name('showExcel');
            Route::get('scans', [HomeController::class, 'scans'])->name('scans');
            Route::get('Userlogout', [AuthController::class, 'logout'])->name('user.logout');
        });

        Route::get('/', function () {
            return redirect('/');
        }); // eldapour

        // sign
        Route::get('sign_in', [HomeController::class, 'signIn'])->name('signIn');
        Route::get('sign_up', [HomeController::class, 'signUp'])->name('signUp');
        Route::get('new_password/{code}/{phone}/{token}', [HomeController::class, 'newPassword'])->name('newPassword');
        Route::get('forget_password', [HomeController::class, 'forgetPassword'])->name('forgetPassword');
        Route::get('verification', [HomeController::class, 'verification'])->name('verification');
        Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.reset.submit');


        // index
        Route::get('/', [HomeController::class, 'index'])->name('index');
    }
);







// Route to clear the application cache
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');

    return 'Cache cleared successfully.';
});

Route::view('/500','front.500.500')->name('500');
