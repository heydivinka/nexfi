@extends('layout_pengguna.pengguna')

@section('title','Riwayat')
@section('page-title','laporan')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Laporan Keuangan</h1>

    <form action="{{ route('pengguna.laporan.filter') }}" method="POST"
        class="grid md:grid-cols-4 gap-4 mb-6">
        @csrf

        <input type="date" name="tanggal_awal"
            class="border p-2 rounded-lg">

        <input type="date" name="tanggal_akhir"
            class="border p-2 rounded-lg">

        <select name="kategori" class="border p-2 rounded-lg">
            <option value="">Semua Kategori</option>
        </select>

        <button class="bg-blue-600 text-white rounded-lg px-4">
            Filter
        </button>

    </form>

    <div class="flex gap-3 mb-4">

        <a href="{{ route('pengguna.laporan.pdf') }}"
            class="bg-red-500 text-white px-4 py-2 rounded-lg">
            Export PDF
        </a>

        <a href="{{ route('pengguna.laporan.excel') }}"
            class="bg-green-600 text-white px-4 py-2 rounded-lg">
            Export Excel
        </a>

    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Tanggal</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Tipe</th>
                    <th>Nominal</th>
                </tr>
            </thead>

            <tbody>
                @isset($transactions)
                    @foreach($transactions as $trx)
                    <tr class="border-t">
                        <td class="p-2">{{ $trx->tanggal }}</td>
                        <td>{{ $trx->nama }}</td>
                        <td>{{ $trx->category->nama ?? '-' }}</td>
                        <td>{{ $trx->tipe }}</td>
                        <td>Rp {{ number_format($trx->nominal) }}</td>
                    </tr>
                    @endforeach
                @endisset
            </tbody>

        </table>

    </div>

</div>

@endsection