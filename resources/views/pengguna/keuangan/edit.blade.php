@extends('layout_pengguna.pengguna')

@section('title','Edit')
@section('page-title','Edit Transaksi')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
.flatpickr-calendar {
    background: #1a1d3a !important;
    border: 1px solid rgba(108,99,255,0.3) !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5) !important;
}
.flatpickr-month, .flatpickr-weekdays { color: rgba(255,255,255,0.85) !important; }
.flatpickr-day { color: rgba(255,255,255,0.85) !important; }
.flatpickr-day.selected, .flatpickr-day.selected:hover {
    background: #6c63ff !important; border-color: #6c63ff !important;
}
.flatpickr-day:hover { background: rgba(108,99,255,0.2) !important; }
.flatpickr-day.today { border-color: rgba(108,99,255,0.4) !important; }
.flatpickr-months .flatpickr-prev-month svg,
.flatpickr-months .flatpickr-next-month svg { fill: rgba(255,255,255,0.6) !important; }
.flatpickr-current-month select,
.flatpickr-current-month input.cur-year { color: rgba(255,255,255,0.9) !important; }
.flatpickr-weekday { color: rgba(255,255,255,0.4) !important; }
.flatpickr-day.flatpickr-disabled { color: rgba(255,255,255,0.2) !important; }
</style>

<div class="bg-[#10132a] border border-[rgba(108,99,255,0.15)] rounded-2xl p-5 flex flex-col gap-3.5 w-full">

    <form method="POST"
          action="{{ route('pengguna.keuangan.update', $transaction->id) }}"
          enctype="multipart/form-data"
          class="grid grid-cols-2 gap-3.5">

        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="col-span-2">
            <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Nama</label>
            <input type="text" name="nama"
                   value="{{ $transaction->nama }}"
                   class="w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]">
        </div>

        {{-- Nominal --}}
        <div>
            <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Nominal</label>
            <div class="flex rounded-xl overflow-hidden border border-[rgba(108,99,255,0.15)] transition-all focus-within:border-[rgba(108,99,255,0.5)] focus-within:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]">
                <span class="px-3 py-2.5 text-[13px] font-bold text-white/40 bg-[rgba(108,99,255,0.08)] border-r border-[rgba(108,99,255,0.15)] whitespace-nowrap">Rp</span>
                <input type="text" name="nominal"
                       value="{{ number_format($transaction->nominal, 0, ',', '.') }}"
                       class="rupiah flex-1 bg-white/5 px-3 py-2.5 text-[13px] text-white/85 outline-none border-none">
            </div>
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Tanggal</label>
            <div class="relative">
                <input type="text" name="tanggal" id="tanggal-edit"
                       value="{{ $transaction->tanggal }}"
                       class="w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 pr-10 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)] cursor-pointer"
                       placeholder="Pilih tanggal" readonly>
                <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none opacity-40 w-4 h-4"
                     viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="3"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
        </div>

        {{-- Kategori --}}
        <div class="col-span-2">
            <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Kategori</label>
            <select name="category_id"
                    class="w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all appearance-none focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]">
                <option value="" class="bg-[#10132a]">Tidak ada</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" class="bg-[#10132a]"
                        {{ $transaction->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Foto --}}
        <div class="col-span-2">
            <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Foto</label>

            <div class="relative border border-dashed border-[rgba(108,99,255,0.3)] rounded-xl bg-[rgba(108,99,255,0.03)] overflow-hidden transition-all hover:border-[rgba(108,99,255,0.5)] hover:bg-[rgba(108,99,255,0.07)] cursor-pointer"
                 id="fotoWrap">
                <input type="file" name="foto" accept="image/*"
                       class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full"
                       onchange="handleFoto(this)">

                {{-- Placeholder --}}
                <div id="fotoPlaceholder" class="flex flex-col items-center justify-center gap-1.5 p-5 {{ $transaction->foto ? 'hidden' : '' }}">
                    <div class="w-9 h-9 rounded-full bg-[rgba(108,99,255,0.12)] flex items-center justify-center">
                        <svg class="w-4 h-4 opacity-50" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                    <p class="text-[12px] text-white/30 text-center">
                        <span class="text-[#a78bfa] font-semibold">Klik untuk upload</span> atau drag foto ke sini
                    </p>
                    <p class="text-[11px] text-white/20">JPG, PNG, WEBP maks. 5MB</p>
                </div>

                {{-- Preview --}}
                <div id="fotoPreview" class="{{ $transaction->foto ? 'block' : 'hidden' }}">
                    <img id="fotoImg"
                         src="{{ $transaction->foto ? asset('storage/'.$transaction->foto) : '' }}"
                         alt=""
                         class="block mx-auto object-contain max-h-40 max-w-full p-2">
                    <div class="flex items-center justify-between px-3 py-2 bg-[rgba(108,99,255,0.08)] border-t border-[rgba(108,99,255,0.1)]">
                        <span id="fotoName"
                              class="text-[11.5px] text-[#a78bfa] font-semibold truncate max-w-[200px]">
                            {{ $transaction->foto ? basename($transaction->foto) : '' }}
                        </span>
                        <button type="button"
                                onclick="removeFoto(event)"
                                class="relative z-20 text-[11px] text-[#f87171] font-bold bg-[rgba(239,68,68,0.1)] border border-[rgba(239,68,68,0.2)] rounded-md px-2 py-0.5 cursor-pointer whitespace-nowrap">
                            Hapus
                        </button>
                    </div>
                </div>

            </div>

            <input type="hidden" name="hapus_foto" id="hapusFoto" value="0">
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="col-span-2 w-full py-3 rounded-xl border-none cursor-pointer text-[13px] font-bold text-white bg-gradient-to-br from-[#6c63ff] to-[#9b59f5] shadow-[0_4px_18px_rgba(108,99,255,0.35)] hover:opacity-90 transition-opacity">
            Update
        </button>

    </form>
</div>

{{-- Script dipindah ke bawah --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
flatpickr("#tanggal-edit", {
    locale: "id",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d F Y",
    disableMobile: true,
    maxDate: "today"
});

function handleFoto(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('fotoImg').src = e.target.result;
        document.getElementById('fotoName').textContent = file.name;
        document.getElementById('fotoPlaceholder').classList.add('hidden');
        document.getElementById('fotoPreview').classList.remove('hidden');
        document.getElementById('fotoPreview').classList.add('block');
        document.getElementById('hapusFoto').value = '0';
    };
    reader.readAsDataURL(file);
}

function removeFoto(e) {
    e.stopPropagation();
    document.getElementById('fotoWrap').querySelector('input[type=file]').value = '';
    document.getElementById('fotoPreview').classList.add('hidden');
    document.getElementById('fotoPreview').classList.remove('block');
    document.getElementById('fotoPlaceholder').classList.remove('hidden');
    document.getElementById('fotoImg').src = '';
    document.getElementById('fotoName').textContent = '';
    document.getElementById('hapusFoto').value = '1';
}

document.querySelectorAll('.rupiah').forEach(input => {
    input.addEventListener('input', function () {
        let value = this.value.replace(/[^0-9]/g, '');
        this.value = value
            ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value)
            : '';
    });
});
</script>

@endsection