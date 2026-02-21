<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        // 🔥 Generate Username
        $nama = strtolower(str_replace(' ', '', $request->name));
        $nama6 = substr($nama, 0, 6);

        $noTelp = preg_replace('/\D/', '', $request->no_telp);
        $last2 = substr($noTelp, -2);

        $username = $nama6 . $last2;

        // Cegah duplikat
        $counter = 1;
        $original = $username;
        while (\App\Models\User::where('username', $username)->exists()) {
            $username = $original . $counter;
            $counter++;
        }

        \App\Models\User::create([
            'name' => $request->name,
            'username' => $username,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'pengguna'
        ]);

        // ❌ HAPUS AUTO LOGIN
        // Auth::login($user);

        // ✅ Redirect ke login + pesan sukses
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }
}