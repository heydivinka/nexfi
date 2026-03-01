<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!',
            'data' => $message
        ]);
    }

    public function index()
    {
        $messages = Message::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $messages
        ]);
    }
}