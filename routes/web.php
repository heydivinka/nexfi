<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pengguna\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Pengguna\DashboardController as PenggunaDashboard;
use App\Http\Controllers\Pengguna\KeuanganController;
use App\Http\Controllers\Pengguna\CategoryController;
use App\Http\Controllers\Pengguna\RiwayatController;
use App\Http\Controllers\Pengguna\LaporanController;

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
| SMART DASHBOARD REDIRECT (BASED ON ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('pengguna.dashboard');

})->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| PENGGUNA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:pengguna'])
    ->prefix('pengguna')
    ->name('pengguna.')
    ->group(function () {

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

        Route::delete('/kategori/{id}', [CategoryController::class, 'destroy']);


        /*
        ================= LAPORAN
        */
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan');

        Route::post('/laporan/filter', [LaporanController::class, 'filter'])
            ->name('laporan.filter');

        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporan.pdf');

        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])
            ->name('laporan.excel');


        /*
        ================= PROFILE
        */
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile');

        Route::get('/profile/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile/update', [ProfileController::class, 'update'])
            ->name('profile.update');

});


/*
|--------------------------------------------------------------------------
| PUBLIC PROFILE
|--------------------------------------------------------------------------
*/
Route::get('/u/{username}', [ProfileController::class, 'show'])
    ->name('profile.public');


require __DIR__.'/auth.php';