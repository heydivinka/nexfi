<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // User kirim testimoni
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'foto' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'isi' => 'required'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimonials', 'public');
        }

        $data['status'] = 'pending';

        Testimonial::create($data);

        return response()->json([
            'success' => true
        ]);
    }

    // Ambil hanya yang approved untuk landing
    public function approved()
    {
        $data = Testimonial::where('status', 'published')
                    ->latest()
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}