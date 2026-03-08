<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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

    // EDIT PROFILE
    public function edit()
    {
        $user = Auth::user();
        return view('pengguna.profile.edit', compact('user'));
    }

    // UPDATE PROFILE
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_telp'  => 'nullable|string|max:20',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update foto
        if ($request->hasFile('photo')) {
            $photo     = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('assets_public'), $photoName);

            if ($user->photo && file_exists(public_path('assets_public/' . $user->photo))) {
                unlink(public_path('assets_public/' . $user->photo));
            }

            $user->photo = $photoName;
        }

        // Update data profil
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->no_telp  = $request->no_telp;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pengguna.profile')->with('success', 'Profile berhasil diperbarui!');
    }

    // PROFILE PUBLIC
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        $saldo       = $user->saldo ?? 0;
        $pemasukan   = Transaction::where('user_id', $user->id)->where('tipe', 'pemasukan')->sum('nominal');
        $pengeluaran = Transaction::where('user_id', $user->id)->where('tipe', 'pengeluaran')->sum('nominal');

        return view('public.profile', compact(
            'user',
            'transactions',
            'saldo',
            'pemasukan',
            'pengeluaran'
        ));
    }
}