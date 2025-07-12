<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

Route::get('/', function () {
    return view('pages.dashboard');
})->middleware('auth');

Route::get('/login', function () {
    return view('pages.login');
})->name('login')->middleware('guest');

Route::prefix('auth')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('google/redirect', [SocialiteController::class, 'redirect'])
            ->name('auth.redirect');
        Route::get('google/callback', [SocialiteController::class, 'callback'])
            ->name('auth.callback');
    });

    Route::middleware(['auth'])->group(function () {
        Route::post('logout', [SocialiteController::class, 'logout'])
            ->name('auth.logout');
    });
});
