<?php

use App\Http\Middleware\CheckFamily;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;

Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('google/redirect', [SocialiteController::class, 'redirect'])
            ->name('auth.redirect');
        Route::get('google/callback', [SocialiteController::class, 'callback'])
            ->name('auth.callback');
    });

    Route::get('/login', function () {
        return view('pages.login');
    })->name('login');
});
Route::middleware(['auth'])->group(function () {
    Route::post('auth/logout', [SocialiteController::class, 'logout'])
        ->name('auth.logout');

    Route::get('/pending-family', [DashboardController::class, 'pendingFamily'])->name('pendingFamily');
    Route::get('/create-family', [DashboardController::class, 'startFamily'])->name('startFamily');
    Route::post('/create-family', [DashboardController::class, 'createFamily'])->name('createFamily');
});

Route::middleware(['auth', CheckFamily::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/family', [FamilyController::class, 'index'])->name('family.index');
});
