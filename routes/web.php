<?php

use App\Http\Middleware\CheckFamily;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

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
    Route::get('/create-family', [FamilyController::class, 'create'])->name('startFamily');
    Route::post('/create-family', [FamilyController::class, 'store'])->name('createFamily');
});

Route::middleware(['auth', CheckFamily::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/family', [FamilyController::class, 'index'])->name('family.index');

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/cashout', [TransactionController::class, 'cashout'])->name('cashout.index');
    Route::get('/cashin', [TransactionController::class, 'cashin'])->name('cashin.index');
});
