<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    public function index()
    {
        return response()->json(Transaction::with('category')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'nama' => 'required|string',
            'nominal' => 'required|numeric',
            'tipe' => 'required|string',
            'category_id' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|string'
        ]);

        $transaction = Transaction::create($validated);

        return response()->json($transaction, 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json($transaction->load('category'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());
        return response()->json($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}