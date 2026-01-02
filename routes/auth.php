<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
use App\Http\Controllers\Owner\StockManagementController;

Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {

    // --- CRUD Barang / Stok Barang ---
    Route::get('/stok', [StockManagementController::class, 'index'])->name('stok.index');
    Route::get('/stok/create', [StockManagementController::class, 'create'])->name('stok.create');
    Route::post('/stok', [StockManagementController::class, 'store'])->name('stok.store');
    Route::get('/stok/{id}/edit', [StockManagementController::class, 'edit'])->name('stok.edit');
    Route::put('/stok/{id}', [StockManagementController::class, 'update'])->name('stok.update');
    Route::delete('/stok/{id}', [StockManagementController::class, 'destroy'])->name('stok.destroy');

    // --- Stok Masuk dari Supplier ---
    Route::get('/stok-masuk', [StockManagementController::class, 'stokMasukIndex'])->name('stok_masuk.index');
    Route::get('/stok-masuk/create', [StockManagementController::class, 'stokMasukCreate'])->name('stok_masuk.create');
    Route::post('/stok-masuk', [StockManagementController::class, 'stokMasukStore'])->name('stok_masuk.store');

    // --- Mutasi Stok ---
    Route::get('/mutasi-stok', [StockManagementController::class, 'mutasiIndex'])->name('mutasi.index');

    // --- Stok Opname ---
    Route::get('/stok-opname', [StockManagementController::class, 'opnameIndex'])->name('opname.index');
    Route::post('/stok-opname', [StockManagementController::class, 'opnameStore'])->name('opname.store');

    Route::get('/stok/{id}/mutasi', [StockManagementController::class, 'mutasi'])
            ->name('stok.mutasi');

        Route::post('/stok-masuk', [StockManagementController::class, 'stokMasukStore'])
            ->name('stok.stokMasuk.store');

        Route::post('/stok-opname', [StockManagementController::class, 'opnameStore'])
            ->name('stok.opname.store');
});

