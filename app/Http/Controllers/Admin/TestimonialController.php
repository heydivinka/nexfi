<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('status', 'all');

        $query = Testimonial::latest();

        if ($filter !== 'all') {
            $query->where('status', $filter);
        }

        $testimonis = $query->paginate(10)->withQueryString();
        $counts = [
            'all'       => Testimonial::count(),
            'pending'   => Testimonial::where('status', 'pending')->count(),
            'published' => Testimonial::where('status', 'published')->count(),
            'rejected'  => Testimonial::where('status', 'rejected')->count(),
        ];

        return view('admin.testimoni.index', compact('testimonis', 'filter', 'counts'));
    }

    public function publish(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'published']);
        return back()->with('success', 'Testimoni berhasil dipublish!');
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'rejected']);
        return back()->with('success', 'Testimoni ditolak.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->foto) {
            \Storage::disk('public')->delete($testimonial->foto);
        }
        $testimonial->delete();
        return back()->with('success', 'Testimoni dihapus.');
    }
}