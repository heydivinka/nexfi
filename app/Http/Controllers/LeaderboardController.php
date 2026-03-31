<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\FinancialScore;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Ambil semua user yang opt-in leaderboard
        $users = User::where('show_on_leaderboard', true)->get();

        // Hitung skor tiap user, sort descending
        $ranked = $users->map(function ($user) {
            $skor = FinancialScore::hitungSkor($user->id);
            return [
                'user'   => $user,
                'skor'   => $skor,
            ];
        })
        ->sortByDesc(fn($item) => $item['skor']['total'])
        ->values(); // reset index jadi 0,1,2,...

        // Total semua user (untuk stat strip di view)
        $totalUsers = User::count();

        return view('public.leaderboard', compact('ranked', 'totalUsers'));
    }
}