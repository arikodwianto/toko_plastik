<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\UserManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;


// REDIRECT KE LOGIN
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/owner/users/{id}/edit', [UserManagementController::class, 'edit'])->name('owner.users.edit');
Route::put('/owner/users/{id}', [UserManagementController::class, 'update'])->name('owner.users.update');

// DASHBOARD DEFAULT (opsional)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

    });


// DASHBOARD KASIR (role admin_kasir)
Route::get('/kasir/dashboard', function () {
    return view('admin_kasir.dashboard');
})->middleware(['auth', 'role:admin_kasir'])->name('kasir.dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// OWNER ROUTES
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::resource('users', UserManagementController::class)->except(['show']);
    });

require __DIR__.'/auth.php';




