<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function replyForm(Message $message)
    {
        return view('admin.messages.reply', compact('message'));
    }

    public function sendReply(Request $request, Message $message)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        Mail::raw($request->reply_message, function ($mail) use ($message) {
            $mail->to($message->email)
                 ->subject('Balasan: ' . $message->subject)
                 ->replyTo(config('mail.from.address'), config('mail.from.name'));
        });

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Email berhasil dikirim!');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}