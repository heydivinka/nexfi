<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    public function collection()
    {
        return Transaction::where('user_id', Auth::id())->get();
    }
}