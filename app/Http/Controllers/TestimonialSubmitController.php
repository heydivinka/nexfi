<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialSubmitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:150',
            'rating' => 'required|integer|min:1|max:5',
            'isi'    => 'required|string|max:1000',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('testimonials', 'public');
        }

        Testimonial::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'rating' => $request->rating,
            'isi'    => $request->isi,
            'foto'   => $fotoPath,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Testimoni berhasil dikirim! Menunggu persetujuan admin.']);
    }
}