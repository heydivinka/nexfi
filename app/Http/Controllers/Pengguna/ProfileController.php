<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Transaction;
use App\Traits\FinancialScore;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pengguna.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('pengguna.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'                 => 'required|string|max:255',
            'username'             => ['required','string','max:255', Rule::unique('users')->ignore($user->id)],
            'email'                => ['required','email','max:255', Rule::unique('users')->ignore($user->id)],
            'no_telp'              => 'nullable|string|max:20',
            'photo'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'             => 'nullable|string|min:8|confirmed',
            'show_on_leaderboard'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $photo     = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('assets_public'), $photoName);
            if ($user->photo && file_exists(public_path('assets_public/' . $user->photo))) {
                unlink(public_path('assets_public/' . $user->photo));
            }
            $user->photo = $photoName;
        }

        $user->name                = $request->name;
        $user->username            = $request->username;
        $user->email               = $request->email;
        $user->no_telp             = $request->no_telp;
        $user->show_on_leaderboard = $request->boolean('show_on_leaderboard');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pengguna.profile')->with('success', 'Profile berhasil diperbarui!');
    }

    // PUBLIC PROFILE
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        // Skor user yang dilihat
        $skor = FinancialScore::hitungSkor($user->id);

        // Semua user yang ikut leaderboard
        $allOptIn = User::where('show_on_leaderboard', true)->get();

        // Hitung skor semua, sort desc
        $allRanked = $allOptIn
            ->map(fn($u) => [
                'user' => $u,
                'skor' => FinancialScore::hitungSkor($u->id),
            ])
            ->sortByDesc(fn($item) => $item['skor']['total'])
            ->values();

        // Top 10 untuk ditampilkan di profile
        $leaderboard = $allRanked->take(10);

        // Posisi user ini: hitung berapa user yang skornya LEBIH TINGGI
        // +1 karena rank dimulai dari 1
        $rankPosition = null;
        if ($user->show_on_leaderboard) {
            $higherCount  = $allRanked->filter(fn($item) => $item['user']->id !== $user->id && $item['skor']['total'] > $skor['total'])->count();
            $rankPosition = $higherCount + 1;
        }

        // Total semua user terdaftar
        $totalUsers = User::count();

        return view('public.profile', compact(
            'user',
            'skor',
            'leaderboard',
            'rankPosition',
            'totalUsers'
        ));
    }
}