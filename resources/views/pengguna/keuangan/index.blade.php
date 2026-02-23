@extends('layout_pengguna.pengguna')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">

        <!-- PEMASUKAN -->
        <div class="border rounded-xl p-5 shadow">
            <h2 class="text-lg font-bold text-green-600 mb-4">
                Form Pemasukan
            </h2>

            <form method="POST" action="{{ route('pengguna.keuangan.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipe" value="pemasukan">

                <input type="text" name="nama"
                    placeholder="Nama pemasukan"
                    class="w-full border rounded px-3 py-2 mb-3" required>

                <input type="text" name="nominal"
                    placeholder="Rp 0"
                    class="w-full border rounded px-3 py-2 mb-3 rupiah" required>

                <input type="date" name="tanggal"
                    class="w-full border rounded px-3 py-2 mb-3" required>

                <label class="text-sm">Foto (opsional)</label>
                <input type="file" name="foto"
                    class="w-full border rounded px-3 py-2 mb-3">

                <button class="bg-green-600 text-white px-4 py-2 rounded w-full">
                    Simpan Pemasukan
                </button>
            </form>
        </div>


        <!-- PENGELUARAN -->
        <div class="border rounded-xl p-5 shadow">
            <h2 class="text-lg font-bold text-red-600 mb-4">
                Form Pengeluaran
            </h2>

            <form method="POST" action="{{ route('pengguna.keuangan.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipe" value="pengeluaran">

                <input type="text" name="nama"
                    placeholder="Nama pengeluaran"
                    class="w-full border rounded px-3 py-2 mb-3" required>

                <input type="text" name="nominal"
                    placeholder="Rp 0"
                    class="w-full border rounded px-3 py-2 mb-3 rupiah" required>

                <input type="date" name="tanggal"
                    class="w-full border rounded px-3 py-2 mb-3" required>

                <label class="text-sm">Foto (opsional)</label>
                <input type="file" name="foto"
                    class="w-full border rounded px-3 py-2 mb-3">

                <button class="bg-red-600 text-white px-4 py-2 rounded w-full">
                    Simpan Pengeluaran
                </button>
            </form>
        </div>

    </div>

</div>


<script>
document.querySelectorAll('.rupiah').forEach(input => {
    input.addEventListener('input', function() {

        let value = this.value.replace(/[^0-9]/g, '');

        this.value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);

    });
});
</script>

@endsection