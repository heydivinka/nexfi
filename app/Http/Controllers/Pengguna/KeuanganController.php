<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{

    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('pengguna.keuangan.index', compact('categories'));
    }


    /*
    ================= UPDATE SALDO MANUAL
    */
    public function updateSaldo(Request $request)
    {
        $saldo = preg_replace('/[^0-9]/', '', $request->saldo);

        $user = auth()->user();
        $user->saldo = $saldo;
        $user->save();

        return back()->with('success', 'Saldo diperbarui');
    }


    /*
    ================= STORE TRANSAKSI
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'nominal' => 'required',
            'tipe' => 'required',
            'tanggal' => 'required',
            'category_id' => 'nullable',
            'foto' => 'nullable|image|max:2048'
        ]);

        $user = Auth::user();

        $nominal = preg_replace('/[^0-9]/', '', $data['nominal']);
        $data['nominal'] = $nominal;
        $data['user_id'] = $user->id;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('transaksi', 'public');
        }

        Transaction::create($data);


        // UPDATE SALDO OTOMATIS
        if ($data['tipe'] == 'pemasukan') {
            $user->saldo += $nominal;
        } else {
            $user->saldo -= $nominal;
        }

        $user->save();

        return redirect()
            ->route('pengguna.riwayat.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }


    /*
    ================= EDIT
    */
    public function edit($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->findOrFail($id);

        $categories = Category::where('user_id', Auth::id())->get();

        return view('pengguna.keuangan.edit', compact(
            'transaction',
            'categories'
        ));
    }


    /*
    ================= UPDATE TRANSAKSI
    */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->findOrFail($id);

        $user = Auth::user();

        $oldNominal = $transaction->nominal;
        $oldTipe = $transaction->tipe;

        $data = $request->validate([
            'nama' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
            'category_id' => 'nullable',
            'foto' => 'nullable|image|max:2048'
        ]);

        $nominal = preg_replace('/[^0-9]/', '', $data['nominal']);
        $data['nominal'] = $nominal;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('transaksi', 'public');
        }

        $transaction->update($data);


        // BALIKIN SALDO LAMA
        if ($oldTipe == 'pemasukan') {
            $user->saldo -= $oldNominal;
        } else {
            $user->saldo += $oldNominal;
        }

        // MASUKIN SALDO BARU
        if ($transaction->tipe == 'pemasukan') {
            $user->saldo += $nominal;
        } else {
            $user->saldo -= $nominal;
        }

        $user->save();

        return redirect()
            ->route('pengguna.riwayat.index')
            ->with('success', 'Transaksi berhasil diupdate');
    }
}