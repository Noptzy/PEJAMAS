<?php

use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::post('contact', [ContactController::class, 'create'])->name('contact.user');

Route::group(['middleware' => ['auth','verified'], 'as' => 'dashboard.', 'prefix' => 'dashboard'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profiles', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profiles', [HomeController::class, 'updateProfile'])->name('profile.update');

    Route::get('/users/verify/{id?}', [UserController::class, 'verifyUser'])->name('users.verify');
    Route::post('/users/verify/{id?}', [UserController::class, 'verifyUserAction'])->name('users.verifyAction');
    Route::post('/users/decline/{id?}', [UserController::class, 'declineUserAction'])->name('users.declineAction');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contact');
    Route::delete('/contacts/{id?}', [ContactController::class, 'destroy'])->name('contact.destroy');

    Route::resource('users', UserController::class);
});
Auth::routes(['verify' => true]);

