<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pengguna.kategori.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        Category::create([
            'user_id' => auth()->id(),
            'nama'    => $request->nama,
        ]);

        return redirect()->route('pengguna.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        $category->update(['nama' => $request->nama]);

        return redirect()->route('pengguna.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        $category->delete();

        return redirect()->route('pengguna.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}