<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function index()
    {
        return view('pengguna.keuangan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nominal' => 'required',
            'tipe' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:2048',
        ]);

        $nominal = preg_replace('/[^0-9]/', '', $request->nominal);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('transaksi', 'public');
        }

        Transaction::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'nominal' => $nominal,
            'tipe' => $request->tipe,
            'category_id' => null, // karena belum ada fitur kategori
            'tanggal' => $request->tanggal,
            'foto' => $fotoPath,
        ]);

        return back()->with('success', 'Data berhasil disimpan!');
    }
}
