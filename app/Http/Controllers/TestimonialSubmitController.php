<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialSubmitController extends Controller
{
    public function store(Request $request)
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'isi'    => 'required|string|max:1000',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('testimonials', 'public');
        }

        Testimonial::create([
            'nama'   => $user->name,   // dari akun login, bukan input form
            'email'  => $user->email,  // dari akun login, tidak bisa dimanipulasi
            'rating' => $request->rating,
            'isi'    => $request->isi,
            'foto'   => $fotoPath,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Testimoni berhasil dikirim! Menunggu persetujuan admin.']);
    }
}