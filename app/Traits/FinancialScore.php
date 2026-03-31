<?php

namespace App\Traits;

use App\Models\Transaction;
use Carbon\Carbon;

trait FinancialScore
{
    /**
     * Hitung skor keuangan user (0–100)
     * Komponen:
     *   - Streak hari aktif input transaksi (30 poin maks)
     *   - Konsistensi bulanan 3 bulan terakhir (40 poin maks)
     *   - Jumlah total transaksi tercatat (30 poin maks)
     */
    public static function hitungSkor(int $userId): array
    {
        // ── 1. STREAK hari aktif ──────────────────────────────────────────
        // Ambil semua tanggal transaksi user, unik per hari, desc
        $dates = Transaction::where('user_id', $userId)
            ->orderByDesc('tanggal')
            ->pluck('tanggal')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->unique()
            ->values();

        $streak = 0;
        if ($dates->isNotEmpty()) {
            $today = Carbon::today()->toDateString();
            $yesterday = Carbon::yesterday()->toDateString();

            // Streak dimulai dari hari ini atau kemarin
            $checkFrom = ($dates->first() === $today || $dates->first() === $yesterday)
                ? Carbon::parse($dates->first())
                : null;

            if ($checkFrom) {
                $streak = 1;
                for ($i = 1; $i < $dates->count(); $i++) {
                    $expected = $checkFrom->copy()->subDays($i)->toDateString();
                    if ($dates[$i] === $expected) {
                        $streak++;
                    } else {
                        break;
                    }
                }
            }
        }
        // Streak max 30 hari → 30 poin
        $streakScore = min($streak, 30);

        // ── 2. KONSISTENSI 3 BULAN TERAKHIR ──────────────────────────────
        // Tiap bulan ada transaksi = 1 bulan aktif (max 3)
        $konsistensiScore = 0;
        for ($m = 0; $m < 3; $m++) {
            $bulan = Carbon::now()->subMonths($m);
            $ada = Transaction::where('user_id', $userId)
                ->whereYear('tanggal', $bulan->year)
                ->whereMonth('tanggal', $bulan->month)
                ->exists();
            if ($ada) $konsistensiScore += 13; // 3 bulan × 13 ≈ 39, max 40
        }
        $konsistensiScore = min($konsistensiScore, 40);

        // ── 3. JUMLAH TRANSAKSI ───────────────────────────────────────────
        $totalTrx = Transaction::where('user_id', $userId)->count();
        // 0–10 trx → 0–10 poin, 11–50 → 11–25, 51+ → 25–30
        if ($totalTrx <= 10) {
            $trxScore = $totalTrx;
        } elseif ($totalTrx <= 50) {
            $trxScore = 10 + round(($totalTrx - 10) / 40 * 15);
        } else {
            $trxScore = 25 + min(round(($totalTrx - 50) / 50 * 5), 5);
        }
        $trxScore = min($trxScore, 30);

        $total = $streakScore + $konsistensiScore + $trxScore;

        // ── LEVEL & BADGE ─────────────────────────────────────────────────
        [$level, $badge, $color] = match(true) {
            $total >= 90 => ['Legend', '👑', '#f59e0b'],
            $total >= 75 => ['Expert', '💎', '#6c63ff'],
            $total >= 55 => ['Pro',    '🔥', '#10b981'],
            $total >= 35 => ['Rising', '⚡', '#3b82f6'],
            $total >= 15 => ['Rookie', '🌱', '#8b5cf6'],
            default      => ['Newbie', '🐣', '#6b7280'],
        };

        return [
            'total'            => $total,
            'streak'           => $streak,
            'streakScore'      => $streakScore,
            'konsistensiScore' => $konsistensiScore,
            'trxScore'         => $trxScore,
            'totalTrx'         => $totalTrx,
            'level'            => $level,
            'badge'            => $badge,
            'color'            => $color,
        ];
    }
}