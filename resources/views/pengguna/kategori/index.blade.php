@extends('layout_pengguna.pengguna')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')

{{-- SweetAlert2 CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    .kat-input {
        background: rgba(255,255,255,0.05);
        border: 1.5px solid rgba(108,99,255,0.15);
        transition: all 0.2s;
    }
    .kat-input::placeholder { color: rgba(255,255,255,0.2); }
    .kat-input:focus {
        border-color: rgba(108,99,255,0.5) !important;
        background: rgba(108,99,255,0.07) !important;
        box-shadow: 0 0 0 3px rgba(108,99,255,0.1) !important;
        outline: none;
    }
    .kat-item { transition: border-color 0.15s; }
    .kat-item:hover { border-color: rgba(108,99,255,0.22) !important; }

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

    #editModal {
        display: none; position: fixed; inset: 0;
        background: rgba(4,5,12,0.88); z-index: 999;
        align-items: center; justify-content: center;
        backdrop-filter: blur(8px); padding: 16px;
    }
    #editModal.open { display: flex; }

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

    {{-- ===== FORM TAMBAH ===== --}}
    <div class="rounded-[14px] border border-[rgba(108,99,255,0.15)] bg-[#10132a] p-4">
        <div class="mb-3 text-[11px] font-bold uppercase tracking-widest text-white/30">Tambah Kategori</div>
        <form method="POST" action="{{ route('pengguna.kategori.store') }}">
            @csrf
            <div class="flex gap-2.5">
                <input type="text" name="nama" placeholder="Nama kategori"
                    class="kat-input flex-1 rounded-[10px] px-3 py-2.5 text-[13px] text-white/85" required>
                <button type="submit"
                    class="cursor-pointer whitespace-nowrap rounded-[10px] border-0 bg-gradient-to-br from-[#6c63ff] to-[#9b59f5] px-[18px] py-2.5 text-[13px] font-bold text-white shadow-[0_4px_14px_rgba(108,99,255,0.3)]">
                    Tambah
                </button>
            </div>
        </form>
    </div>

    {{-- ===== LIST KATEGORI ===== --}}
    <div class="rounded-[14px] border border-[rgba(108,99,255,0.15)] bg-[#10132a] p-4">
        <div class="mb-3 text-[11px] font-bold uppercase tracking-widest text-white/30">Daftar Kategori</div>

        <div id="katList" class="flex flex-col gap-1.5">
            @forelse($categories as $cat)
            <div class="kat-item flex items-center justify-between gap-2.5 rounded-[10px] border border-[rgba(108,99,255,0.08)] bg-white/[0.02] px-3 py-[11px]" data-kat-item>
                <span class="flex-1 text-[13px] font-semibold text-white/85">{{ $cat->nama }}</span>
                <div class="flex shrink-0 gap-1.5">
                    <button
                        class="cursor-pointer rounded-[8px] border border-yellow-400/20 bg-yellow-400/10 px-3 py-1.5 text-[11.5px] font-semibold text-yellow-400"
                        onclick="openEdit({{ $cat->id }}, '{{ addslashes($cat->nama) }}')">
                        Edit
                    </button>
                    <form method="POST" action="{{ route('pengguna.kategori.destroy', $cat->id) }}" class="m-0">
                        @csrf @method('DELETE')
                        <button type="button"
                            class="cursor-pointer rounded-[8px] border border-red-500/20 bg-red-500/10 px-3 py-1.5 text-[11.5px] font-semibold text-red-400"
                            onclick="confirmHapusKat(this, '{{ addslashes($cat->nama) }}')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="py-7 text-center text-[13px] text-white/25">Belum ada kategori</div>
            @endforelse
        </div>
    </div>

    {{-- ===== PAGINATION (box terpisah) ===== --}}
    <div id="paginationWrapper"
        class="hidden flex-wrap items-center justify-between gap-2.5 rounded-[14px] border border-[rgba(108,99,255,0.15)] bg-[#10132a] px-4 py-3">
        <div id="paginationInfo" class="text-[12px] text-white/35"></div>
        <div id="paginationControls" class="flex flex-wrap items-center gap-1.5"></div>
    </div>

</div>

{{-- ===== MODAL EDIT ===== --}}
<div id="editModal">
    <div class="w-full max-w-[400px] rounded-[16px] border border-[rgba(108,99,255,0.2)] bg-[#10132a] p-6 shadow-[0_24px_60px_rgba(0,0,0,0.6)]">
        <div class="mb-4 text-[14px] font-bold text-white">Edit Kategori</div>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <input type="text" name="nama" id="editNama"
                class="kat-input w-full rounded-[10px] px-3 py-2.5 text-[13px] text-white/85" required>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button"
                    class="cursor-pointer rounded-[9px] border border-white/10 bg-white/[0.06] px-4 py-2 text-[12.5px] font-semibold text-white/45"
                    onclick="closeEdit()">Batal</button>
                <button type="submit"
                    class="cursor-pointer rounded-[9px] border-0 bg-gradient-to-br from-[#6c63ff] to-[#9b59f5] px-4 py-2 text-[12.5px] font-bold text-white shadow-[0_4px_14px_rgba(108,99,255,0.3)]">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
/* ===== MODAL EDIT ===== */
function openEdit(id, nama) {
    document.getElementById('editNama').value = nama;
    document.getElementById('editForm').action = '/pengguna/kategori/' + id;
    document.getElementById('editModal').classList.add('open');
}
function closeEdit() {
    document.getElementById('editModal').classList.remove('open');
}
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEdit();
});
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeEdit(); });

/* ===== PAGINATION ENGINE ===== */
(function () {
    const PER_PAGE   = 10;
    const SHOW_PAGES = 5;
    let currentPage  = 1;

    const list    = document.getElementById('katList');
    const wrapper = document.getElementById('paginationWrapper');
    const info    = document.getElementById('paginationInfo');
    const ctrl    = document.getElementById('paginationControls');

    function allItems() {
        return Array.from(list.querySelectorAll('[data-kat-item]'));
    }
    function totalPages() {
        return Math.max(1, Math.ceil(allItems().length / PER_PAGE));
    }

    function render() {
        const items = allItems();
        const total = items.length;
        const pages = totalPages();

        if (total === 0) { wrapper.classList.add('hidden'); wrapper.classList.remove('flex'); return; }

        items.forEach(function (el, i) {
            const inPage = i >= (currentPage - 1) * PER_PAGE && i < currentPage * PER_PAGE;
            el.style.display = inPage ? '' : 'none';
        });

        wrapper.classList.remove('hidden');
        wrapper.classList.add('flex');

        const from = (currentPage - 1) * PER_PAGE + 1;
        const to   = Math.min(currentPage * PER_PAGE, total);
        info.textContent = 'Menampilkan ' + from + '–' + to + ' dari ' + total + ' kategori';

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
        b.innerHTML = html;
        b.title     = title;
        b.disabled  = disabled;
        b.onclick   = onClick;
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
        list.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
        if (current - half < 2)         end   = Math.min(total - 1, show - 1);
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

/* ===== HAPUS KATEGORI ===== */
function confirmHapusKat(btn, nama) {
    Swal.fire({
        customClass: { popup: 'nexfi-swal' },
        title: 'Hapus Kategori?',
        html: 'Kategori <strong style="color:#fff;">' + nama + '</strong> akan dihapus permanen.',
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