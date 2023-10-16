<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InviteeController;
use Illuminate\Support\Facades\Route;


Route::get('/updateapp', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('key:generate');
    \Artisan::call('jwt:secret');
    \Artisan::call('config:clear');
    \Artisan::call('optimize:clear');
    echo 'composer dump-autoload complete';
});

Route::get('/change-language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('lang', $locale);
    return back();
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('admin');
    Route::POST('login', [AuthController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', function () {
        return view('Admin/index');
    })->name('adminHome');

    #### Admins ####
    Route::resource('admins', AdminController::class);
    Route::POST('delete_admin', [AdminController::class, 'delete'])->name('delete_admin');
    Route::get('my_profile', [AdminController::class, 'myProfile'])->name('myProfile');

    #### Users ####
    Route::resource('users', UserController::class);
    Route::get('users/update_points_form/{id}', [UserController::class, 'update_point_form'])->name('users.update_point_form');
    Route::post('users/update_points/{id}', [UserController::class, 'update_points'])->name('users.update_points');
    Route::POST('delete_user', [UserController::class, 'delete'])->name('usersDelete');
    Route::get('invitations_users/{id}', [InvitationController::class, 'showInvitationsUsers'])->name('invitationsUsers');

    ################### Setting ###################
    Route::resource('settings', SettingController::class);

    ###################### Contact Us #############################
    Route::resource('contact_us', ContactUsController::class);

    ###################### Invitation #############################
    Route::resource('Invitations', InvitationController::class);
    Route::post('/update-status/', [InvitationController::class, 'updateStatus'])->name('updateStatus');


    ###################### invitees #############################
    Route::resource('invitees', InviteeController::class);
    Route::post('/send-message-all-user/', [InviteeController::class, 'sendMessageToAllUser'])->name('sendMessageToAllUser');
    Route::post('/send-message-user/', [InviteeController::class, 'sendMessageToUser'])->name('sendMessageToUser');
    Route::get('show-users-invite/{id}', [InviteeController::class, 'showInvitees'])->name('showInvitees');


    #### Auth ####
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});
