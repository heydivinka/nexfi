<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;


class ProfileController extends Controller
{
    // PROFILE SENDIRI
    public function index()
    {
        $user = Auth::user();
        return view('pengguna.profile.index', compact('user'));
    }

    // PROFILE PUBLIC
    
public function show($username)
{
    $user = User::where('username', $username)->firstOrFail();

    $transactions = Transaction::where('user_id', $user->id)
        ->latest()
        ->take(10)
        ->get();

    $saldo = $user->saldo ?? 0;

    $pemasukan = Transaction::where('user_id', $user->id)
        ->where('tipe', 'pemasukan')
        ->sum('nominal');

    $pengeluaran = Transaction::where('user_id', $user->id)
        ->where('tipe', 'pengeluaran')
        ->sum('nominal');

    return view('public.profile', compact(
        'user',
        'transactions',
        'saldo',
        'pemasukan',
        'pengeluaran'
    ));
}
}