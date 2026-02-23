<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Pengguna\DashboardController as PenggunaDashboard;
use App\Http\Controllers\Pengguna\KeuanganController;
use App\Http\Controllers\Pengguna\CategoryController;
use App\Http\Controllers\Pengguna\RiwayatController;



/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('pengguna')->name('pengguna.')->group(function () {

    /*
    ================= DASHBOARD
    */
    Route::get('/dashboard', [PenggunaDashboard::class, 'index'])
        ->name('dashboard');


    /*
    ================= KEUANGAN
    */
    Route::get('/keuangan', [KeuanganController::class, 'index'])
        ->name('keuangan.index');

    Route::post('/keuangan', [KeuanganController::class, 'store'])
        ->name('keuangan.store');

    Route::post('/keuangan/saldo', [KeuanganController::class, 'updateSaldo'])
        ->name('keuangan.saldo');

    Route::get('/keuangan/{id}/edit', [KeuanganController::class, 'edit'])
        ->name('keuangan.edit');

    Route::put('/keuangan/{id}', [KeuanganController::class, 'update'])
        ->name('keuangan.update');


    /*
    ================= RIWAYAT
    */
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat.index');

    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])
        ->name('riwayat.destroy');


    /*
    ================= KATEGORI
    */
    Route::get('/kategori', [CategoryController::class, 'index'])
        ->name('kategori.index');

    Route::post('/kategori', [CategoryController::class, 'store'])
        ->name('kategori.store');

    Route::put('/kategori/{id}', [CategoryController::class, 'update'])
        ->name('kategori.update');

    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])
        ->name('kategori.destroy');

});

/*
|--------------------------------------------------------------------------
| PROFILE NEXFI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

});

Route::get('/u/{username}', [ProfileController::class, 'show'])
    ->name('profile.public');

require __DIR__.'/auth.php';