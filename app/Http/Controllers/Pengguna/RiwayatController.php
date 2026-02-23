<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', Auth::id());

        if ($request->tipe) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $transactions = $query->latest()->get();

        $categories = Category::where('user_id', Auth::id())->get();

        return view('pengguna.riwayat.index', compact(
            'transactions',
            'categories'
        ));
    }

    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->findOrFail($id);

        /** @var User $user */
        $user = Auth::user();

        // BALIKIN SALDO
        if ($transaction->tipe == 'pemasukan') {
            $user->saldo -= $transaction->nominal;
        } else {
            $user->saldo += $transaction->nominal;
        }

        $user->save();

        $transaction->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}