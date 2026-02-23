<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $totalPemasukan = Transaction::where('user_id', $userId)
            ->where('tipe', 'pemasukan')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('nominal');

        $totalPengeluaran = Transaction::where('user_id', $userId)
            ->where('tipe', 'pengeluaran')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('nominal');

        return view('pengguna.dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran'
        ));
    }
}