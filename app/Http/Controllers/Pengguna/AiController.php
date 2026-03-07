<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;

class AiController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('pengguna.ai.index', compact('user'));
    }

    public function chat(Request $request)
    {
        $user = Auth::user();

        $transaksi = Transaction::where('user_id', $user->id)->get();

        $totalPemasukan   = $transaksi->where('tipe', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksi->where('tipe', 'pengeluaran')->sum('nominal');

        $dataUser = "
        Nama pengguna: {$user->name}
        Saldo saat ini: {$user->saldo}
        Total pemasukan: {$totalPemasukan}
        Total pengeluaran: {$totalPengeluaran}
        ";

        $promptSystem = "
        Kamu adalah AI Nexfi, asisten keuangan dalam aplikasi Nexfi.

        Nexfi adalah aplikasi untuk membantu pengguna mengelola keuangan pribadi seperti:
        - mencatat pemasukan
        - mencatat pengeluaran
        - melihat laporan keuangan
        - menganalisis kebiasaan keuangan

        Kamu boleh membantu pengguna dalam hal:

        1. Menjelaskan aplikasi Nexfi
        2. Menjelaskan fitur Nexfi
        3. Memberikan fakta atau informasi tentang Nexfi
        4. Menjawab pertanyaan tentang keuangan pribadi
        5. Memberikan tips mengatur uang
        6. Membantu memahami transaksi atau laporan keuangan

        Jika pertanyaan masih berkaitan dengan:
        - Nexfi
        - aplikasi ini
        - keuangan
        - uang
        - pengeluaran
        - pemasukan
        - budgeting

        Maka jawab dengan normal dan membantu.

        Hanya jika pertanyaan benar-benar tidak berhubungan sama sekali
        dengan Nexfi atau keuangan (misalnya tentang game, artis, politik, dll),
        baru jawab dengan:

        'Maaf, saya hanya bisa membantu terkait Nexfi dan keuangan.'

        Gunakan bahasa santai, jelas, dan ramah seperti asisten keuangan pribadi.

        Data pengguna:
        {$dataUser}
        ";

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . env('OPENROUTER_API_KEY'),
            "HTTP-Referer"  => "https://nexfi.pplgsmkn1ciomas.my.id",
            "X-Title"       => "NEXFI"
        ])->post("https://openrouter.ai/api/v1/chat/completions", [
            "model"    => "openai/gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => $promptSystem],
                ["role" => "user",   "content" => $request->message]
            ]
        ]);

        return response()->json($response->json());
    }
}