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
use App\Http\Controllers\Owner\LaporanController;
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

Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

    // === CRUD Barang ===
    Route::get('/stok', [StockManagementController::class, 'index'])->name('stok.index');
    Route::get('/stok/create', [StockManagementController::class, 'create'])->name('stok.create');
    Route::post('/stok', [StockManagementController::class, 'store'])->name('stok.store');
    Route::get('/stok/{id}/edit', [StockManagementController::class, 'edit'])->name('stok.edit');
    Route::put('/stok/{id}', [StockManagementController::class, 'update'])->name('stok.update');
    Route::delete('/stok/{id}', [StockManagementController::class, 'destroy'])->name('stok.destroy');

    // === Stok Masuk (MODAL DI INDEX) ===
    Route::post('/stok-masuk', [StockManagementController::class, 'stokMasukStore'])
        ->name('stok.masuk');

    // === Stok Opname (MODAL DI INDEX) ===
    Route::post('/stok-opname', [StockManagementController::class, 'opnameStore'])
        ->name('stok.opname');

    // === Mutasi ===
    Route::get('/stok/{id}/mutasi', [StockManagementController::class, 'mutasi'])
        ->name('stok.mutasi');

   Route::prefix('laporan')
        ->name('laporan.')
        ->group(function () {

        Route::get('/penjualan', [LaporanController::class, 'penjualan'])
            ->name('penjualan');

        Route::get('/pembelian', [LaporanController::class, 'pembelian'])
            ->name('pembelian');

        Route::get('/keuntungan', [LaporanController::class, 'keuntungan'])
            ->name('keuntungan');

        Route::get('/produk', [LaporanController::class, 'produk'])
            ->name('produk');

        Route::get('/penjualan/excel', [LaporanController::class, 'exportPenjualanExcel'])
            ->name('penjualan.excel');

        Route::get('/penjualan/pdf', [LaporanController::class, 'exportPenjualanPdf'])
            ->name('penjualan.pdf');
         Route::get('/pembelian/pdf', [LaporanController::class, 'exportPembelianPdf'])
    ->name('pembelian.pdf');

Route::get('/produk/pdf', [LaporanController::class, 'exportProdukPdf'])
    ->name('produk.pdf');


    });

});


use App\Http\Controllers\AdminKasir\StockController;
use App\Http\Controllers\AdminKasir\PenjualanController;
Route::middleware(['auth', 'role:admin_kasir'])
    ->prefix('admin_kasir')
    ->name('admin_kasir.')
    ->group(function () {
        Route::get('/stok', [StockController::class, 'index'])->name('stok.index');
        Route::get('/stok/create', [StockController::class, 'create'])->name('stok.create');
        Route::post('/stok', [StockController::class, 'store'])->name('stok.store');
        Route::get('penjualan', 
        [PenjualanController::class, 'index'])
        ->name('penjualan.index');

    Route::get('penjualan/cari-barang', 
        [PenjualanController::class, 'cariBarang'])
        ->name('penjualan.cari');

    Route::post('penjualan', 
        [PenjualanController::class, 'store'])
        ->name('penjualan.store');

    Route::get('penjualan/{id}/struk', 
        [PenjualanController::class, 'struk'])
        ->name('penjualan.struk');
        Route::get('penjualan/riwayat',
    [PenjualanController::class, 'riwayat'])
    ->name('penjualan.riwayat');

Route::get('penjualan/{id}/detail',
    [PenjualanController::class, 'detail'])
    ->name('penjualan.detail');
Route::post(
    'penjualan/{id}/batal',
    [PenjualanController::class, 'batal']
)->name('penjualan.batal');
Route::post(
    'penjualan/{id}/retur',
    [PenjualanController::class, 'returItem']
)->name('penjualan.retur');

    });


