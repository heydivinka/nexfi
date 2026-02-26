<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Method index untuk halaman laporan utama
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalPemasukan = $transactions
            ->where('tipe', 'pemasukan')
            ->sum('nominal');

        $totalPengeluaran = $transactions
            ->where('tipe', 'pengeluaran')
            ->sum('nominal');

        $saldo = $user->saldo ?? 0;

        return view('pengguna.laporan.index', [
            'transactions' => $transactions,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'user' => $user
        ]);
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $totalPemasukan = $transactions
            ->where('tipe', 'pemasukan')
            ->sum('nominal');

        $totalPengeluaran = $transactions
            ->where('tipe', 'pengeluaran')
            ->sum('nominal');

        $saldo = $user->saldo ?? 0;

        $data = [
            'transactions' => $transactions,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'user' => $user
        ];

        $pdf = Pdf::loadView('pengguna.laporan.pdf', $data)
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true
            ]);

        return $pdf->download('Laporan-Nexfi.pdf');
    }
}