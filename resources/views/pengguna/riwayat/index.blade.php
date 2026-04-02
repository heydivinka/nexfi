@extends('layout_pengguna.pengguna')

@section('title','Riwayat')
@section('page-title','Riwayat Transaksi')

@section('content')

{{-- SweetAlert2 CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    /* Input/select custom appearance — tidak bisa murni Tailwind */
    .filter-input {
        background: rgba(255,255,255,0.05) !important;
        border: 1.5px solid rgba(108,99,255,0.15) !important;
        appearance: none; -webkit-appearance: none;
    }
    .filter-input:focus {
        border-color: rgba(108,99,255,0.5) !important;
        background: rgba(108,99,255,0.07) !important;
        box-shadow: 0 0 0 3px rgba(108,99,255,0.1) !important;
        outline: none;
    }
    .filter-input option { background: #10132a; color: #fff; }

    /* Card hover */
    .trx-card { transition: border-color 0.15s, box-shadow 0.15s; }
    .trx-card:hover {
        border-color: rgba(108,99,255,0.3) !important;
        box-shadow: 0 4px 20px rgba(108,99,255,0.1);
    }

    /* Pagination button states */
    .pg-btn:hover:not(:disabled) {
        background: rgba(108,99,255,0.18);
        border-color: rgba(108,99,255,0.4);
        color: #fff;
    }
    .pg-btn:disabled { opacity: 0.28; cursor: not-allowed; }
    .pg-num:hover:not(.pg-active) {
        background: rgba(108,99,255,0.12);
        color: #fff;
        border-color: rgba(108,99,255,0.3);
    }

    /* SweetAlert2 NexFi Dark Theme */
    .nexfi-swal.swal2-popup {
        background: #10132a !important;
        border: 1px solid rgba(108,99,255,0.3) !important;
        border-radius: 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(108,99,255,0.1) !important;
        padding: 2rem !important;
    }
    .nexfi-swal .swal2-title { color: #fff !important; font-size: 1.05rem !important; font-weight: 700 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
    .nexfi-swal .swal2-html-container { color: rgba(255,255,255,0.4) !important; font-size: 0.8rem !important; font-family: 'Plus Jakarta Sans', sans-serif !important; line-height: 1.6 !important; }
    .nexfi-swal .swal2-icon.swal2-warning { border-color: rgba(239,68,68,0.35) !important; color: #f87171 !important; }
    .nexfi-swal .swal2-icon.swal2-warning .swal2-icon-content { color: #f87171 !important; }
    .nexfi-swal .swal2-icon.swal2-success { border-color: rgba(74,222,128,0.35) !important; }
    .nexfi-swal .swal2-icon.swal2-success .swal2-success-ring { border-color: rgba(74,222,128,0.25) !important; }
    .nexfi-swal .swal2-icon.swal2-success [class^=swal2-success-line] { background: #4ade80 !important; }
    .nexfi-swal .swal2-confirm {
        background: linear-gradient(135deg,rgba(239,68,68,0.85),rgba(220,38,38,0.9)) !important;
        border: 1px solid rgba(239,68,68,0.35) !important; border-radius: 9999px !important;
        font-weight: 700 !important; font-size: 0.76rem !important; padding: 8px 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important; box-shadow: none !important; color: #fff !important;
    }
    .nexfi-swal .swal2-confirm:hover { background: linear-gradient(135deg,#ef4444,#dc2626) !important; }
    .nexfi-swal .swal2-confirm.success-btn {
        background: linear-gradient(135deg,rgba(34,197,94,0.85),rgba(22,163,74,0.9)) !important;
        border-color: rgba(34,197,94,0.35) !important;
    }
    .nexfi-swal .swal2-confirm.success-btn:hover { background: linear-gradient(135deg,#22c55e,#16a34a) !important; }
    .nexfi-swal .swal2-cancel {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.1) !important; border-radius: 9999px !important;
        font-weight: 600 !important; font-size: 0.76rem !important; padding: 8px 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important; box-shadow: none !important; color: rgba(255,255,255,0.55) !important;
    }
    .nexfi-swal .swal2-cancel:hover { background: rgba(255,255,255,0.09) !important; color: rgba(255,255,255,0.8) !important; }
    .nexfi-swal .swal2-actions { gap: 8px !important; }
    .nexfi-swal .swal2-timer-progress-bar { background: rgba(108,99,255,0.6) !important; }
</style>

<div class="flex flex-col gap-3.5">

    {{-- ===== FILTER ===== --}}
    <div class="rounded-[14px] border border-[rgba(108,99,255,0.15)] bg-[#10132a] p-3.5">
        <form method="GET" class="grid grid-cols-2 gap-2.5 md:grid-cols-[1fr_1fr_1fr_1fr_auto]">
            <select name="tipe"
                class="filter-input w-full rounded-[10px] px-3 py-2.5 text-[12.5px] text-white/85">
                <option value="">Semua Tipe</option>
                <option value="pemasukan"   {{ request('tipe')=='pemasukan'   ?'selected':'' }}>Pemasukan</option>
                <option value="pengeluaran" {{ request('tipe')=='pengeluaran' ?'selected':'' }}>Pengeluaran</option>
            </select>

            <select name="category_id"
                class="filter-input w-full rounded-[10px] px-3 py-2.5 text-[12.5px] text-white/85">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id ?'selected':'' }}>
                        {{ $cat->nama }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="filter-input w-full rounded-[10px] px-3 py-2.5 text-[12.5px] text-white/85">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama transaksi..."
                class="filter-input w-full rounded-[10px] px-3 py-2.5 text-[12.5px] text-white/85">

            <button type="submit"
                class="col-span-2 md:col-auto cursor-pointer rounded-[10px] bg-gradient-to-br from-[#6c63ff] to-[#9b59f5] px-[18px] py-2.5 text-[12.5px] font-bold text-white border-0">
                Filter
            </button>
        </form>
    </div>

    {{-- ===== CARD GRID ===== --}}
    <div id="trxGrid" class="grid grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($transactions as $trx)
        <div class="trx-card flex flex-col gap-2 rounded-[13px] border border-[rgba(108,99,255,0.13)] bg-[#10132a] p-3.5" data-trx-item>

            {{-- header --}}
            <div class="flex items-start justify-between gap-2">
                <div class="text-[13.5px] font-bold text-white">{{ $trx->nama }}</div>
                <span class="shrink-0 whitespace-nowrap rounded-[6px] px-2 py-0.5 text-[10px] font-bold
                    {{ $trx->tipe === 'pemasukan'
                        ? 'border border-green-500/20 bg-green-500/10 text-green-400'
                        : 'border border-red-500/20 bg-red-500/10 text-red-400' }}">
                    {{ ucfirst($trx->tipe) }}
                </span>
            </div>

            <div class="text-[11.5px] text-white/35">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</div>
            <div class="text-[11.5px] text-white/35">Kategori: {{ $trx->category->nama ?? '-' }}</div>

            <div class="text-lg font-extrabold {{ $trx->tipe === 'pemasukan' ? 'text-green-400' : 'text-red-400' }}">
                Rp {{ number_format($trx->nominal, 0, ',', '.') }}
            </div>

            {{-- foto --}}
            @if($trx->foto)
                <button onclick="openModal('{{ Storage::url($trx->foto) }}')"
                    class="inline-flex w-fit cursor-pointer items-center gap-1.5 rounded-[8px] border border-[rgba(108,99,255,0.2)] bg-[rgba(108,99,255,0.1)] px-3 py-1.5 text-[11.5px] font-semibold text-violet-400">
                    🖼 Lihat Foto
                </button>
            @else
                <span class="text-[11.5px] italic text-white/20">Tidak ada foto</span>
            @endif

            {{-- aksi --}}
            <div class="mt-1 flex gap-2">
                <a href="{{ route('pengguna.keuangan.edit', $trx->id) }}"
                    class="rounded-[8px] border border-yellow-400/20 bg-yellow-400/10 px-3 py-1.5 text-[11.5px] font-semibold text-yellow-400 no-underline">
                    Edit
                </a>
                <form method="POST" action="{{ route('pengguna.riwayat.destroy', $trx->id) }}" class="m-0">
                    @csrf @method('DELETE')
                    <button type="button"
                        class="cursor-pointer rounded-[8px] border border-red-500/20 bg-red-500/10 px-3 py-1.5 text-[11.5px] font-semibold text-red-400"
                        onclick="confirmHapusTrx(this, '{{ addslashes($trx->nama) }}')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full rounded-[14px] border border-[rgba(108,99,255,0.1)] bg-[#10132a] p-12 text-center text-[13px] text-white/30">
            Tidak ada data transaksi
        </div>
        @endforelse
    </div>

    {{-- ===== PAGINATION (latar sama kayak filter) ===== --}}
    <div id="paginationWrapper"
        class="hidden flex-wrap items-center justify-between gap-2.5 rounded-[14px] border border-[rgba(108,99,255,0.15)] bg-[#10132a] px-4 py-3">
        <div id="paginationInfo" class="text-[12px] text-white/35"></div>
        <div id="paginationControls" class="flex flex-wrap items-center gap-1.5"></div>
    </div>

</div>

{{-- ===== MODAL FOTO ===== --}}
<div id="modalFoto"
    class="fixed inset-0 z-[999] hidden items-center justify-center backdrop-blur-sm"
    style="background:rgba(4,5,12,0.92);"
    onclick="closeModal()">

    {{-- tombol close --}}
    <button
        class="absolute right-4 top-4 z-10 flex h-9 w-9 cursor-pointer items-center justify-center rounded-full border border-white/15 bg-white/10 text-base text-white"
        onclick="event.stopPropagation(); closeModal()">✕</button>

    {{-- wrapper tengah --}}
    <div class="flex h-full w-full items-center justify-center p-4" onclick="closeModal()">
        <img id="modalImg" src="" alt=""
            class="block max-h-[85vh] max-w-full rounded-[14px] object-contain"
            style="width:auto; height:auto;"
            onclick="event.stopPropagation()">
    </div>
</div>

<script>
/* ===== MODAL ===== */
function openModal(src) {
    const modal = document.getElementById('modalFoto');
    document.getElementById('modalImg').src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeModal() {
    const modal = document.getElementById('modalFoto');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.getElementById('modalImg').src = '';
}
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });

/* ===== PAGINATION ENGINE ===== */
(function () {
    const PER_PAGE   = 10;
    const SHOW_PAGES = 5;
    let currentPage  = 1;

    const grid    = document.getElementById('trxGrid');
    const wrapper = document.getElementById('paginationWrapper');
    const info    = document.getElementById('paginationInfo');
    const ctrl    = document.getElementById('paginationControls');

    function allItems() {
        return Array.from(grid.querySelectorAll('[data-trx-item]'));
    }
    function totalPages() {
        return Math.max(1, Math.ceil(allItems().length / PER_PAGE));
    }

    function render() {
        const items = allItems();
        const total = items.length;
        const pages = totalPages();

        if (total === 0) { wrapper.classList.add('hidden'); wrapper.classList.remove('flex'); return; }

        /* show/hide cards */
        items.forEach(function (el, i) {
            const inPage = i >= (currentPage - 1) * PER_PAGE && i < currentPage * PER_PAGE;
            el.style.display = inPage ? '' : 'none';
        });

        /* selalu tampilkan pagination */
        wrapper.classList.remove('hidden');
        wrapper.classList.add('flex');

        /* info */
        const from = (currentPage - 1) * PER_PAGE + 1;
        const to   = Math.min(currentPage * PER_PAGE, total);
        info.textContent = 'Menampilkan ' + from + '–' + to + ' dari ' + total + ' transaksi';

        /* controls */
        ctrl.innerHTML = '';
        ctrl.appendChild(makePgBtn('&#8249;', 'Sebelumnya', currentPage === 1, function () { goTo(currentPage - 1); }));

        if (pages > 1) {
            buildPageRange(currentPage, pages, SHOW_PAGES).forEach(function (p) {
                if (p === '...') {
                    const dot = document.createElement('span');
                    dot.className   = 'text-xs text-white/25 px-0.5';
                    dot.textContent = '···';
                    ctrl.appendChild(dot);
                } else {
                    ctrl.appendChild(makePgNum(p, p === currentPage));
                }
            });
        } else {
            ctrl.appendChild(makePgNum(1, true));
        }

        ctrl.appendChild(makePgBtn('&#8250;', 'Berikutnya', currentPage === pages, function () { goTo(currentPage + 1); }));
    }

    function makePgBtn(html, title, disabled, onClick) {
        const b = document.createElement('button');
        b.className = 'pg-btn flex h-[34px] w-[34px] cursor-pointer items-center justify-center rounded-[9px] border border-[rgba(108,99,255,0.2)] bg-[rgba(108,99,255,0.07)] text-sm text-white/70 transition-all';
        b.innerHTML  = html;
        b.title      = title;
        b.disabled   = disabled;
        b.onclick    = onClick;
        return b;
    }

    function makePgNum(p, active) {
        const b = document.createElement('button');
        b.className = active
            ? 'pg-num pg-active flex h-[34px] min-w-[34px] cursor-default items-center justify-center rounded-[9px] border-0 bg-gradient-to-br from-[#6c63ff] to-[#9b59f5] px-1.5 text-[12.5px] font-semibold text-white transition-all'
            : 'pg-num flex h-[34px] min-w-[34px] cursor-pointer items-center justify-center rounded-[9px] border border-[rgba(108,99,255,0.15)] bg-transparent px-1.5 text-[12.5px] font-semibold text-white/45 transition-all';
        b.textContent = p;
        if (!active) b.onclick = function () { goTo(p); };
        return b;
    }

    function goTo(p) {
        const pages = totalPages();
        if (p < 1 || p > pages) return;
        currentPage = p;
        render();
        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function buildPageRange(current, total, show) {
        if (total <= show) {
            const a = [];
            for (let i = 1; i <= total; i++) a.push(i);
            return a;
        }
        let half  = Math.floor(show / 2);
        let start = Math.max(2, current - half);
        let end   = Math.min(total - 1, current + half);
        if (current - half < 2)        end   = Math.min(total - 1, show - 1);
        if (current + half > total - 1) start = Math.max(2, total - show + 2);
        const range = [1];
        if (start > 2) range.push('...');
        for (let i = start; i <= end; i++) range.push(i);
        if (end < total - 1) range.push('...');
        range.push(total);
        return range;
    }

    render();
})();
/* ===== END PAGINATION ENGINE ===== */

/* ===== HAPUS TRANSAKSI ===== */
function confirmHapusTrx(btn, nama) {
    Swal.fire({
        customClass: { popup: 'nexfi-swal' },
        title: 'Hapus Transaksi?',
        html: 'Data <strong style="color:#fff;">' + nama + '</strong> akan dihapus permanen.',
        icon: 'warning', iconColor: '#f87171',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal',
        reverseButtons: true, focusCancel: true,
        backdrop: 'rgba(4,5,12,0.85)',
    }).then(function (result) {
        if (result.isConfirmed) btn.closest('form').submit();
    });
}
</script>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        customClass: { popup: 'nexfi-swal', confirmButton: 'success-btn' },
        title: 'Berhasil!',
        html: '{{ session("success") }}',
        icon: 'success', iconColor: '#4ade80',
        confirmButtonText: 'Oke',
        backdrop: 'rgba(4,5,12,0.85)',
        timer: 2500, timerProgressBar: true,
    });
});
</script>
@endif

@endsection