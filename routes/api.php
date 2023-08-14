<?php

//use App\Http\Controllers\Api\Auth\Provider\AuthController;
use App\Http\Controllers\Api\Auth\AuthScannerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\Auth\AuthProviderController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\InvitationController;
use App\Http\Controllers\Api\ResetPassword\CodeCheckController;
use App\Http\Controllers\Api\ResetPassword\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPassword\ResetPasswordController;
use App\Http\Controllers\Api\ScannerInvitation\ScannerInvitationController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('send_invite_by_whatsapp', [\App\Http\Controllers\Front\InviteController::class, 'sendInviteByWhatsapp'])->name('sendInviteByWhatsapp');

Route::group(['prefix' => 'provider/auth'],function (){

    Route::post('forget-password',  ForgotPasswordController::class);
    Route::post('check-code', CodeCheckController::class);
    Route::post('password-reset', ResetPasswordController::class);


    Route::post('login',[AuthProviderController::class, 'login']);
    Route::POST('register',[AuthProviderController::class, 'register']);
    Route::POST('login-with-google',[AuthProviderController::class, 'loginWithGoogle']);
    Route::POST('update-profile',[AuthProviderController::class, 'update_profile']);
    Route::POST('delete-account',[AuthProviderController::class, 'deleteAccount']);
    Route::get('my-profile',[AuthProviderController::class, 'me']);
    Route::get('profile-by-phone',[AuthProviderController::class, 'profileWithPhone']);
//    Route::post('insert-token',[NotificationController::class, 'insert_token']);
});

Route::post('scanner/auth/login',[AuthScannerController::class, 'login']);
Route::post('scanner-invitation',[ScannerInvitationController::class, 'scannerInvitation'])->middleware('api');


Route::group(['middleware' => 'auth_jwt','prefix' => 'invitations'],function (){
    Route::get('home', [HomeController::class, 'index']);

    Route::post('store', [InvitationController::class, 'store']);
    Route::post('sendReminder', [InvitationController::class, 'sendReminder']);
    Route::post('addInvitees', [InvitationController::class, 'addInvitees']);
    Route::post('update/{id}', [InvitationController::class, 'update']);
    Route::get('delete/{id}', [InvitationController::class, 'destroy']);

    Route::get('all-invitees/{id}', [InvitationController::class, 'allInvitees']);
    Route::get('scanned-invitees/{id}', [InvitationController::class, 'scannedInvitees']);
    Route::get('invitees/messages/{id}', [InvitationController::class, 'messages']);
    Route::get('contacts', [HomeController::class, 'contacts']);

});

Route::get('cities', [GeneralController::class, 'cities']);
Route::get('notifications', [HomeController::class, 'notifications']);

Orion::resource('products-api', ProductsController::class);


Route::group([ 'middleware' => 'api','namespace' => 'Api'], function () {
    Route::get('setting',[SettingController::class, 'index']);
    Route::POST('contact-us',[ContactController::class, 'store']);
//
//    Route::get('/paytap/store',[PaytapsPaymentController::class,'store'])->name('paytap');
//    Route::get('/callback_paytabs',[PaytapsPaymentController::class,'callback_paytabs']);
//    Route::post('/return_paytabs',[PaytapsPaymentController::class,'return_paytabs']);
    Route::get('/search', [SearchController::class, 'index']);
});


//end route api -------------------------------------

Route::get('integrated-whatsapp',[\App\Http\Controllers\Api\TestIntegratedController::class, 'index']);
