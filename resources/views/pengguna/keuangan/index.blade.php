@extends('layout_pengguna.pengguna')

@section('title', 'Kelola Data')
@section('page-title', 'Kelola Data')

@section('content')

{{-- Flatpickr --}}
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

<div class="flex flex-col gap-3.5">

    {{-- SALDO --}}
    <div class="bg-[#10132a] border border-[rgba(108,99,255,0.15)] rounded-2xl p-4">
        <form method="POST" action="{{ route('pengguna.keuangan.saldo') }}">
            @csrf
            <label class="block text-[11.5px] font-bold uppercase tracking-widest text-white/35 mb-2">
                Uang yang anda miliki
            </label>
            <input type="text" name="saldo"
                   value="Rp {{ number_format(auth()->user()->saldo,0,',','.') }}"
                   class="rupiah w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3.5 py-2.5 text-sm font-semibold text-white/90 outline-none transition-all focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]">
            <br>
            <button type="submit"
                    class="mt-2.5 px-5 py-2 rounded-xl border-none cursor-pointer text-sm font-bold text-white bg-gradient-to-br from-[#6c63ff] to-[#9b59f5] shadow-[0_4px_14px_rgba(108,99,255,0.3)]">
                Simpan Saldo
            </button>
        </form>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="px-3.5 py-2.5 rounded-xl bg-[rgba(34,197,94,0.1)] border border-[rgba(34,197,94,0.2)] text-[#4ade80] text-[12.5px] font-semibold">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-[#10132a] border border-[rgba(108,99,255,0.15)] rounded-2xl overflow-hidden">

        {{-- TABS --}}
        <div class="flex border-b border-[rgba(108,99,255,0.12)]">
            <button id="tab-pemasukan"
                    class="tab-btn flex-1 py-3 text-[13px] font-bold border-none cursor-pointer bg-transparent text-[#4ade80] border-b-2 border-b-[#4ade80] -mb-px transition-all"
                    onclick="showTab('pemasukan', this)">
                ↑ Pemasukan
            </button>
            <button id="tab-pengeluaran"
                    class="tab-btn flex-1 py-3 text-[13px] font-bold border-none cursor-pointer bg-transparent text-white/30 border-b-2 border-b-transparent -mb-px transition-all"
                    onclick="showTab('pengeluaran', this)">
                ↓ Pengeluaran
            </button>
        </div>

        {{-- PEMASUKAN --}}
        <div id="pemasukan" class="tab-content flex flex-col gap-2.5 p-4">
            <form method="POST" action="{{ route('pengguna.keuangan.store') }}" enctype="multipart/form-data"
                  class="flex flex-col gap-2.5">
                @csrf
                <input type="hidden" name="tipe" value="pemasukan">

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Nama Pemasukan</label>
                    <input type="text" name="nama" placeholder="Nama pemasukan"
                           class="f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]"
                           required>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Kategori</label>
                    <select name="category_id"
                            class="f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all appearance-none focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]">
                        <option value="" class="bg-[#10132a]">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" class="bg-[#10132a]">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Nominal</label>
                    <input type="text" name="nominal" placeholder="Rp 0"
                           class="rupiah f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]"
                           required>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Tanggal</label>
                    <div class="relative">
                        {{-- hidden input yang dikirim ke server --}}
                        <input type="hidden" name="tanggal" id="tanggal-in-val">
                        {{-- input display untuk flatpickr --}}
                        <input type="text" id="tanggal-in"
                               class="f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 pr-10 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)] cursor-pointer"
                               placeholder="Pilih tanggal" readonly required>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none opacity-40 w-4 h-4"
                             viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="3"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Foto (opsional)</label>
                    <div class="relative border border-dashed border-[rgba(108,99,255,0.3)] rounded-xl bg-[rgba(108,99,255,0.03)] overflow-hidden transition-all hover:border-[rgba(108,99,255,0.5)] hover:bg-[rgba(108,99,255,0.07)] cursor-pointer"
                         id="fotoWrap-in">
                        <input type="file" name="foto" accept="image/*"
                               class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full"
                               onchange="handleFoto(this,'in')">
                        <div id="fotoPlaceholder-in" class="flex flex-col items-center justify-center gap-1.5 p-5">
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
                        <div id="fotoPreview-in" class="hidden">
                            <img id="fotoImg-in" src="" alt=""
                                class="block mx-auto object-contain max-h-40 max-w-full p-2">
                            <div class="flex items-center justify-between px-3 py-2 bg-[rgba(108,99,255,0.08)] border-t border-[rgba(108,99,255,0.1)]">
                                <span id="fotoName-in" class="text-[11.5px] text-[#a78bfa] font-semibold truncate max-w-[200px]"></span>
                                <button type="button" onclick="removeFoto(event,'in')"
                                        class="relative z-20 text-[11px] text-[#f87171] font-bold bg-[rgba(239,68,68,0.1)] border border-[rgba(239,68,68,0.2)] rounded-md px-2 py-0.5 cursor-pointer whitespace-nowrap">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-2.5 rounded-xl border-none cursor-pointer text-[13px] font-bold text-white mt-1 bg-gradient-to-br from-[#16a34a] to-[#22c55e] shadow-[0_4px_14px_rgba(34,197,94,0.25)]">
                    Simpan Pemasukan
                </button>
            </form>
        </div>

        {{-- PENGELUARAN --}}
        <div id="pengeluaran" class="tab-content hidden flex flex-col gap-2.5 p-4">
            <form method="POST" action="{{ route('pengguna.keuangan.store') }}" enctype="multipart/form-data"
                  class="flex flex-col gap-2.5">
                @csrf
                <input type="hidden" name="tipe" value="pengeluaran">

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Nama Pengeluaran</label>
                    <input type="text" name="nama" placeholder="Nama pengeluaran"
                           class="f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]"
                           required>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Kategori</label>
                    <select name="category_id"
                            class="f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all appearance-none focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]">
                        <option value="" class="bg-[#10132a]">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" class="bg-[#10132a]">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Nominal</label>
                    <input type="text" name="nominal" placeholder="Rp 0"
                           class="rupiah f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)]"
                           required>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Tanggal</label>
                    <div class="relative">
                        {{-- hidden input yang dikirim ke server --}}
                        <input type="hidden" name="tanggal" id="tanggal-out-val">
                        {{-- input display untuk flatpickr --}}
                        <input type="text" id="tanggal-out"
                               class="f-input w-full bg-white/5 border border-[rgba(108,99,255,0.15)] rounded-xl px-3 py-2.5 pr-10 text-[13px] text-white/85 outline-none transition-all placeholder:text-white/20 focus:border-[rgba(108,99,255,0.5)] focus:bg-[rgba(108,99,255,0.07)] focus:shadow-[0_0_0_3px_rgba(108,99,255,0.1)] cursor-pointer"
                               placeholder="Pilih tanggal" readonly required>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none opacity-40 w-4 h-4"
                             viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="3"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-white/30 mb-1.5">Foto (opsional)</label>
                    <div class="relative border border-dashed border-[rgba(108,99,255,0.3)] rounded-xl bg-[rgba(108,99,255,0.03)] overflow-hidden transition-all hover:border-[rgba(108,99,255,0.5)] hover:bg-[rgba(108,99,255,0.07)] cursor-pointer"
                         id="fotoWrap-out">
                        <input type="file" name="foto" accept="image/*"
                               class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full"
                               onchange="handleFoto(this,'out')">
                        <div id="fotoPlaceholder-out" class="flex flex-col items-center justify-center gap-1.5 p-5">
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
                        <div id="fotoPreview-out" class="hidden">
                            <img id="fotoImg-out" src="" alt=""
                                class="block mx-auto object-contain max-h-40 max-w-full p-2">
                            <div class="flex items-center justify-between px-3 py-2 bg-[rgba(108,99,255,0.08)] border-t border-[rgba(108,99,255,0.1)]">
                                <span id="fotoName-out" class="text-[11.5px] text-[#a78bfa] font-semibold truncate max-w-[200px]"></span>
                                <button type="button" onclick="removeFoto(event,'out')"
                                        class="relative z-20 text-[11px] text-[#f87171] font-bold bg-[rgba(239,68,68,0.1)] border border-[rgba(239,68,68,0.2)] rounded-md px-2 py-0.5 cursor-pointer whitespace-nowrap">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full py-2.5 rounded-xl border-none cursor-pointer text-[13px] font-bold text-white mt-1 bg-gradient-to-br from-[#dc2626] to-[#ef4444] shadow-[0_4px_14px_rgba(239,68,68,0.25)]">
                    Simpan Pengeluaran
                </button>
            </form>
        </div>

    </div>
</div>

{{-- Script CDN di bawah --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
// Flatpickr — pakai hidden input terpisah untuk nilai Y-m-d yang dikirim ke server
// Display input hanya untuk tampilan, tidak punya name
flatpickr("#tanggal-in", {
    locale: "id",
    dateFormat: "d F Y",
    maxDate: "today",
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        // Isi hidden input dengan format Y-m-d untuk server
        const d = selectedDates[0];
        if (d) {
            const ymd = d.getFullYear() + '-'
                + String(d.getMonth()+1).padStart(2,'0') + '-'
                + String(d.getDate()).padStart(2,'0');
            document.getElementById('tanggal-in-val').value = ymd;
        }
    }
});

flatpickr("#tanggal-out", {
    locale: "id",
    dateFormat: "d F Y",
    maxDate: "today",
    disableMobile: true,
    onChange: function(selectedDates, dateStr, instance) {
        const d = selectedDates[0];
        if (d) {
            const ymd = d.getFullYear() + '-'
                + String(d.getMonth()+1).padStart(2,'0') + '-'
                + String(d.getDate()).padStart(2,'0');
            document.getElementById('tanggal-out-val').value = ymd;
        }
    }
});

// Tab switching
function showTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById(tab).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('text-[#4ade80]', 'border-b-[#4ade80]', 'text-[#f87171]', 'border-b-[#f87171]');
        b.classList.add('text-white/30', 'border-b-transparent');
    });

    if (tab === 'pemasukan') {
        btn.classList.remove('text-white/30', 'border-b-transparent');
        btn.classList.add('text-[#4ade80]', 'border-b-[#4ade80]');
    } else {
        btn.classList.remove('text-white/30', 'border-b-transparent');
        btn.classList.add('text-[#f87171]', 'border-b-[#f87171]');
    }
}

// Upload foto preview
function handleFoto(input, id) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('fotoImg-' + id).src = e.target.result;
        document.getElementById('fotoName-' + id).textContent = file.name;
        document.getElementById('fotoPlaceholder-' + id).classList.add('hidden');
        document.getElementById('fotoPreview-' + id).classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

function removeFoto(e, id) {
    e.stopPropagation();
    const wrap = document.getElementById('fotoWrap-' + id);
    wrap.querySelector('input[type=file]').value = '';
    document.getElementById('fotoPreview-' + id).classList.add('hidden');
    document.getElementById('fotoPlaceholder-' + id).classList.remove('hidden');
    document.getElementById('fotoImg-' + id).src = '';
}

// Rupiah formatter
document.querySelectorAll('.rupiah').forEach(input => {
    input.addEventListener('input', function () {
        let value = this.value.replace(/[^0-9]/g, '');
        this.value = value
            ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value)
            : '';
    });
});

// Networking call ke REST API (Checklist Wajib)
fetch('/api/transactions')
    .then(response => response.json())
    .then(data => console.log('Data dari API:', data))
    .catch(error => console.error('Error fetch API:', error));
</script>

@endsection