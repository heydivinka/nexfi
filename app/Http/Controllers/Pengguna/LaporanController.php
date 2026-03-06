<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $categories = Category::where('user_id', $user->id)->get();

        // Query transaksi dengan filter (untuk tabel)
        $query = Transaction::with('category')
            ->where('user_id', $user->id);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        if ($request->kategori) {
            $query->where('category_id', $request->kategori);
        }

        if ($request->tipe) {
            $query->where('tipe', $request->tipe);
        }

        $transactions = $query->latest()->get();

        // Hitung summary dari SEMUA transaksi (tanpa filter tipe)
        // supaya totalPemasukan & totalPengeluaran selalu tampil benar
        $summaryQuery = Transaction::where('user_id', $user->id);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $summaryQuery->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        if ($request->kategori) {
            $summaryQuery->where('category_id', $request->kategori);
        }

        $allTransactions  = $summaryQuery->get();
        $totalPemasukan   = $allTransactions->where('tipe', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $allTransactions->where('tipe', 'pengeluaran')->sum('nominal');
        $saldo            = $user->saldo ?? 0;

        return view('pengguna.laporan.index', [
            'transactions'     => $transactions,
            'categories'       => $categories,
            'totalPemasukan'   => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo'            => $saldo,
            'user'             => $user
        ]);
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        // Query transaksi dengan filter (untuk tabel PDF)
        $query = Transaction::with('category')
            ->where('user_id', $user->id);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        if ($request->kategori) {
            $query->where('category_id', $request->kategori);
        }

        if ($request->tipe) {
            $query->where('tipe', $request->tipe);
        }

        $transactions = $query->latest()->get();

        // Hitung summary dari SEMUA transaksi (tanpa filter tipe)
        // supaya card pemasukan & pengeluaran di PDF selalu tampil benar
        $summaryQuery = Transaction::where('user_id', $user->id);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $summaryQuery->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        if ($request->kategori) {
            $summaryQuery->where('category_id', $request->kategori);
        }

        $allTransactions  = $summaryQuery->get();
        $totalPemasukan   = $allTransactions->where('tipe', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $allTransactions->where('tipe', 'pengeluaran')->sum('nominal');
        $saldo            = $user->saldo ?? 0;

        // Nama file dinamis sesuai filter aktif
        $namaFile = 'Laporan-Nexfi';
        if ($request->tipe) {
            $namaFile .= '-' . ucfirst($request->tipe);
        }
        if ($request->kategori) {
            $kategori = Category::find($request->kategori);
            if ($kategori) {
                $namaFile .= '-' . str_replace(' ', '_', $kategori->nama);
            }
        }
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $namaFile .= '-' . $request->tanggal_awal . '_sd_' . $request->tanggal_akhir;
        }

        $data = [
            'transactions'     => $transactions,
            'totalPemasukan'   => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo'            => $saldo,
            'user'             => $user
        ];

        $pdf = Pdf::loadView('pengguna.laporan.pdf', $data)
            ->setPaper('A4', 'portrait');

        return $pdf->download($namaFile . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $user = Auth::user();

        $query = Transaction::with('category')
            ->where('user_id', $user->id);

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        if ($request->kategori) {
            $query->where('category_id', $request->kategori);
        }

        if ($request->tipe) {
            $query->where('tipe', $request->tipe);
        }

        $transactions = $query->latest()->get();

        //  Nama file dinamis sesuai filter aktif
        $namaFile = 'Laporan-Nexfi';
        if ($request->tipe) {
            $namaFile .= '-' . ucfirst($request->tipe);
        }
        if ($request->kategori) {
            $kategori = Category::find($request->kategori);
            if ($kategori) {
                $namaFile .= '-' . str_replace(' ', '_', $kategori->nama);
            }
        }
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $namaFile .= '-' . $request->tanggal_awal . '_sd_' . $request->tanggal_akhir;
        }

        // return Excel::download(new TransactionsExport($transactions), $namaFile . '.xlsx');

        return response()->json([
            'message' => 'Implementasikan sesuai package Excel yang digunakan',
            'total'   => $transactions->count(),
        ]);
    }
}