<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Gabungkan data dari akun login + input form
        Message::create([
            'name'    => $user->name,   // dari akun login
            'email'   => $user->email,  // dari akun login
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return response()->json(['success' => true, 'message' => 'Pesan berhasil dikirim']);
    }
}