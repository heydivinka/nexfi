<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengguna\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Pengguna\DashboardController as PenggunaDashboard;
use App\Http\Controllers\Pengguna\KeuanganController;
use App\Http\Controllers\Pengguna\CategoryController;
use App\Http\Controllers\Pengguna\RiwayatController;
use App\Http\Controllers\Pengguna\LaporanController;

// laporan
Route::middleware(['auth'])->prefix('pengguna')->group(function () {

    Route::get('/laporan', [LaporanController::class, 'index'])->name('pengguna.laporan');
    Route::post('/laporan/filter', [LaporanController::class, 'filter'])->name('pengguna.laporan.filter');

    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('pengguna.laporan.pdf');
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('pengguna.laporan.excel');

});

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

    Route::get('/pengguna/profile', [ProfileController::class, 'index'])
        ->name('pengguna.profile'); // ganti jadi index

    Route::get('/pengguna/profile/edit', [ProfileController::class, 'edit'])
        ->name('pengguna.profile.edit');

    Route::put('/pengguna/profile/update', [ProfileController::class, 'update'])
        ->name('pengguna.profile.update');

});

Route::get('/u/{username}', [ProfileController::class, 'show'])
    ->name('profile.public');

require __DIR__.'/auth.php';