<?php

use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\FeedbackController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ImageReportController;
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
    Route::get('/reports/image/{reportId?}', [ImageReportController::class, 'index'])->name('imageReport.index');
    Route::get('/reports/image/show/{imageId?}/{type?}', [ImageReportController::class, 'show'])->name('imageReport.show');
    Route::post('/reports/image/', [ImageReportController::class, 'store'])->name('imageReport.store');
    Route::delete('/reports/image/{id?}', [ImageReportController::class, 'destroy'])->name('imageReport.destroy');

    Route::get('feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('feedbacks/modals/{userId?}', [FeedbackController::class, 'show'])->name('feedbacks.modal');
    Route::post('feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');
    Route::put('feedbacks/{id?}', [FeedbackController::class, 'statusChange'])->name('feedbacks.statusChange');

    Route::resource('users', UserController::class);
    Route::get('reports/create/{reportId?}', [ReportController::class, 'create'])->name('reports.create');
    Route::get('reports/show/{reportId?}', [ReportController::class, 'show'])->name('reports.show');
    Route::resource('reports', ReportController::class)->except('create','show');
});
Auth::routes(['verify' => true]);

