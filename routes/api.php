<?php

//use App\Http\Controllers\Api\Auth\Provider\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\GeneralController;

use App\Http\Controllers\Api\Auth\AuthProviderController;
use App\Http\Controllers\Api\Auth\CodeCheckController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\InvitationController;
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

Route::group(['prefix' => 'provider/auth'],function (){
    Route::post('password/email',  ForgotPasswordController::class);
    Route::post('password/code/check', CodeCheckController::class);
    Route::post('password/reset', ResetPasswordController::class);
    Route::post('login',[AuthProviderController::class, 'login']);
    Route::POST('register',[AuthProviderController::class, 'register']);
    Route::POST('update-profile',[AuthProviderController::class, 'update_profile']);
    Route::POST('delete-account',[AuthProviderController::class, 'deleteAccount']);
    Route::get('my-profile',[AuthProviderController::class, 'me']);
    Route::get('profile-by-phone',[AuthProviderController::class, 'profileWithPhone']);
//    Route::post('insert-token',[NotificationController::class, 'insert_token']);
});


Route::group(['middleware' => 'auth_jwt','prefix' => 'invitations'],function (){
    Route::get('home', [HomeController::class, 'index']);

    Route::post('store', [InvitationController::class, 'store']);

});

Route::get('cities', [GeneralController::class, 'cities']);
Route::get('sliders', [GeneralController::class, 'sliders']);
Route::get('translation_types', [GeneralController::class, 'translation_types']);

Orion::resource('products-api', ProductsController::class);


Route::group([ 'middleware' => 'api','namespace' => 'Api'], function () {
    Route::get('setting',[SettingController::class, 'index']);
    Route::POST('contact-us',[ContactController::class, 'store']);

    Route::get('/paytap/store',[PaytapsPaymentController::class,'store'])->name('paytap');
    Route::get('/callback_paytabs',[PaytapsPaymentController::class,'callback_paytabs']);
    Route::post('/return_paytabs',[PaytapsPaymentController::class,'return_paytabs']);
    Route::get('/search', [SearchController::class, 'index']);
});



