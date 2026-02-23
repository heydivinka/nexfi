<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Pengguna\DashboardController as PenggunaDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengguna\KeuanganController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','role:pengguna'])->group(function () {

    Route::get('/pengguna/kelola-data', [KeuanganController::class, 'index'])
        ->name('pengguna.keuangan.index');

    Route::post('/pengguna/kelola-data', [KeuanganController::class, 'store'])
        ->name('pengguna.keuangan.store');

});

// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])
        ->name('admin.dashboard');

});


// ================= PENGGUNA =================
Route::middleware(['auth', 'role:pengguna'])->group(function () {

    Route::get('/pengguna/dashboard', [PenggunaDashboard::class, 'index'])
        ->name('pengguna.dashboard');

});


// ================= PROFILE =================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


require __DIR__.'/auth.php';