@extends('layout_pengguna.pengguna')

@section('title','Laporan Keuangan')
@section('page-title','Laporan')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .lap { display:flex; flex-direction:column; gap:12px; font-family:'Plus Jakarta Sans',sans-serif; }

    /* ── PAGE HEADER ── */
    .lap-header {
        padding:13px 15px;
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
        display:flex; align-items:center; justify-content:space-between; gap:10px;
        flex-wrap:wrap;
    }
    .lap-header-left h2 { font-size:14px; font-weight:800; color:#fff; margin:0 0 2px; }
    .lap-header-left p  { font-size:10px; color:rgba(255,255,255,0.25); margin:0; }

    .export-btns { display:flex; gap:7px; flex-wrap:wrap; }
    .btn-exp {
        display:inline-flex; align-items:center; gap:6px;
        padding:7px 13px; border-radius:8px; font-size:11px; font-weight:700;
        text-decoration:none; transition:opacity .15s;
    }
    .btn-exp:hover { opacity:.82; }
    .btn-pdf   { background:rgba(239,68,68,0.15); color:#f87171; border:1px solid rgba(239,68,68,0.25); }
    .btn-excel { background:rgba(34,197,94,0.12); color:#4ade80; border:1px solid rgba(34,197,94,0.22); }

    /* ── FILTER ── */
    .filter-card {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
        padding:14px 15px;
    }
    .filter-label {
        font-size:9.5px; font-weight:700; text-transform:uppercase;
        letter-spacing:.07em; color:rgba(255,255,255,0.25);
        display:flex; align-items:center; gap:5px; margin-bottom:12px;
    }
    .filter-label i { color:rgba(108,99,255,.5); }

    .filter-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:10px;
        align-items:end;
    }
    @media(min-width:640px) { .filter-grid { grid-template-columns:1fr 1fr 1fr; } }
    @media(min-width:900px) { .filter-grid { grid-template-columns:1fr 1fr 1fr 1fr auto; } }

    .f-group { display:flex; flex-direction:column; gap:5px; }
    .f-label {
        font-size:9.5px; font-weight:700; color:rgba(255,255,255,0.3);
        display:flex; align-items:center; gap:5px;
        text-transform:uppercase; letter-spacing:.05em;
    }
    .f-label i { color:rgba(108,99,255,0.6); font-size:9px; }
    .f-input {
        width:100%; padding:8px 10px; border-radius:8px;
        background:rgba(255,255,255,0.04);
        border:1px solid rgba(108,99,255,0.18);
        color:rgba(255,255,255,0.85); font-size:11.5px;
        font-family:'Plus Jakarta Sans',sans-serif;
        outline:none; transition:border-color .15s;
        -webkit-appearance:none; appearance:none;
    }
    .f-input:focus { border-color:rgba(108,99,255,.55); background:rgba(108,99,255,.06); }
    .f-input option { background:#10132a; color:#fff; }
    .f-input[type="date"]::-webkit-calendar-picker-indicator { filter:invert(0.4); cursor:pointer; }

    .filter-actions { display:flex; gap:6px; align-items:center; }
    .btn-filter {
        flex:1; display:inline-flex; align-items:center; justify-content:center; gap:6px;
        padding:8px 16px; border-radius:8px; border:none; cursor:pointer;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        color:#fff; font-size:11.5px; font-weight:700;
        font-family:'Plus Jakarta Sans',sans-serif;
        box-shadow:0 4px 14px rgba(108,99,255,0.3);
        transition:opacity .15s; white-space:nowrap;
    }
    .btn-filter:hover { opacity:.86; }
    .btn-reset {
        display:inline-flex; align-items:center; justify-content:center; gap:5px;
        padding:8px 12px; border-radius:8px;
        border:1px solid rgba(255,255,255,0.08);
        background:rgba(255,255,255,0.04);
        color:rgba(255,255,255,0.35); font-size:11px; font-weight:700;
        text-decoration:none; white-space:nowrap; transition:all .15s;
        font-family:'Plus Jakarta Sans',sans-serif;
    }
    .btn-reset:hover { background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.65); }

    /* active filter tags */
    .filter-tags { display:flex; flex-wrap:wrap; gap:6px; margin-top:10px; }
    .filter-tag {
        display:inline-flex; align-items:center; gap:5px;
        padding:3px 10px; border-radius:20px; font-size:10px; font-weight:700;
        background:rgba(108,99,255,0.12); color:#a78bfa;
        border:1px solid rgba(108,99,255,0.2);
    }
    .filter-tag i { font-size:8px; opacity:.7; }

    /* ── SUMMARY STRIP ── */
    .summary-strip {
        display:grid; grid-template-columns:repeat(3,1fr); gap:8px;
    }
    @media(max-width:480px){ .summary-strip { grid-template-columns:1fr; } }

    .sum-item {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.12);
        border-radius:11px; padding:11px 13px;
        position:relative; overflow:hidden;
    }
    .sum-bar { position:absolute;top:0;left:0;right:0;height:2px; }
    .sum-lbl { font-size:9.5px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:rgba(255,255,255,0.25); margin-bottom:4px; }
    .sum-val { font-size:14px; font-weight:800; }

    /* ── TABLE CARD ── */
    .table-card {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
        overflow:hidden;
    }
    .table-head {
        padding:11px 15px;
        border-bottom:1px solid rgba(108,99,255,0.1);
        display:flex; align-items:center; justify-content:space-between; gap:8px; flex-wrap:wrap;
    }
    .table-head-left { display:flex; align-items:center; gap:7px; }
    .table-head-left p { font-size:12px; font-weight:700; color:#fff; margin:0; }
    .table-head-left span { font-size:10px; color:rgba(255,255,255,0.2); }

    .tbl-search {
        padding:6px 10px; border-radius:7px;
        background:rgba(255,255,255,0.04);
        border:1px solid rgba(108,99,255,0.15);
        color:rgba(255,255,255,0.8); font-size:11px;
        font-family:'Plus Jakarta Sans',sans-serif;
        outline:none; width:160px;
        transition:border-color .15s;
    }
    .tbl-search:focus { border-color:rgba(108,99,255,.4); }
    @media(max-width:480px){ .tbl-search { width:100%; } }

    .tbl-wrap { overflow-x:auto; -webkit-overflow-scrolling:touch; }

    table.lap-table {
        width:100%; border-collapse:collapse; min-width:520px;
    }
    .lap-table thead tr { background:rgba(108,99,255,0.07); }
    .lap-table th {
        padding:9px 14px; text-align:left;
        font-size:9.5px; font-weight:700; text-transform:uppercase;
        letter-spacing:.07em; color:rgba(255,255,255,0.28);
        white-space:nowrap; border-bottom:1px solid rgba(108,99,255,0.1);
    }
    .lap-table td {
        padding:9px 14px;
        font-size:11.5px; color:rgba(255,255,255,0.78);
        border-bottom:1px solid rgba(255,255,255,0.04);
        white-space:nowrap;
    }
    .lap-table tbody tr:last-child td { border-bottom:none; }
    .lap-table tbody tr { transition:background .12s; }
    .lap-table tbody tr:hover { background:rgba(108,99,255,0.06); }

    .badge {
        display:inline-flex; align-items:center; gap:4px;
        padding:3px 8px; border-radius:20px; font-size:10px; font-weight:700;
    }
    .badge.in  { background:rgba(34,197,94,0.12);  color:#4ade80; }
    .badge.out { background:rgba(239,68,68,0.1);   color:#f87171; }
    .badge .dot { width:5px;height:5px;border-radius:50%;display:inline-block; }
    .badge.in  .dot { background:#4ade80; }
    .badge.out .dot { background:#f87171; }

    .amt-in  { color:#4ade80; font-weight:800; }
    .amt-out { color:#f87171; font-weight:800; }

    .cat-chip {
        display:inline-block; padding:2px 8px; border-radius:6px; font-size:10px; font-weight:600;
        background:rgba(108,99,255,0.1); color:rgba(155,89,245,0.9);
    }

    .tbl-empty {
        padding:40px 20px; text-align:center;
        font-size:12px; color:rgba(255,255,255,0.2);
    }
    .tbl-empty i { display:block; font-size:2rem; margin-bottom:10px; opacity:.18; }

    /* ── PAGINATION ── */
    .pagination-wrap {
        padding:11px 15px;
        border-top:1px solid rgba(108,99,255,0.08);
        display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;
    }
    .pag-info { font-size:10px; color:rgba(255,255,255,0.22); }

    .pag-btns { display:flex; align-items:center; gap:4px; flex-wrap:wrap; }
    .pag-btn {
        min-width:30px; height:30px; border-radius:7px; border:none; cursor:pointer;
        font-size:11px; font-weight:700; font-family:'Plus Jakarta Sans',sans-serif;
        background:rgba(255,255,255,0.04);
        color:rgba(255,255,255,0.5);
        transition:all .15s; padding:0 8px;
        display:inline-flex; align-items:center; justify-content:center; gap:3px;
    }
    .pag-btn:hover:not(:disabled) { background:rgba(108,99,255,0.15); color:#a78bfa; }
    .pag-btn.active { background:linear-gradient(135deg,#6c63ff,#9b59f5); color:#fff; box-shadow:0 3px 10px rgba(108,99,255,0.35); }
    .pag-btn:disabled { opacity:.3; cursor:default; }

    .per-page-wrap { display:flex; align-items:center; gap:6px; }
    .per-page-wrap label { font-size:10px; color:rgba(255,255,255,0.22); }
    .per-page-sel {
        padding:4px 6px; border-radius:6px;
        background:rgba(255,255,255,0.04);
        border:1px solid rgba(108,99,255,0.15);
        color:rgba(255,255,255,0.7); font-size:11px;
        font-family:'Plus Jakarta Sans',sans-serif;
        outline:none; cursor:pointer;
    }
    .per-page-sel option { background:#10132a; }
</style>

<div class="lap">

    {{-- ══ PAGE HEADER ══ --}}
    <div class="lap-header">
        <div class="lap-header-left">
            <h2><i class="fa-solid fa-chart-bar" style="color:#6c63ff;margin-right:6px;"></i>Laporan Keuangan</h2>
            <p>Data transaksi lengkap dengan filter & export</p>
        </div>
        <div class="export-btns">
            <a href="{{ route('pengguna.laporan.pdf', request()->query()) }}" class="btn-exp btn-pdf">
                <i class="fa-solid fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('pengguna.laporan.excel', request()->query()) }}" class="btn-exp btn-excel">
                <i class="fa-solid fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>

    {{-- ══ FILTER ══ --}}
    <div class="filter-card">
        <div class="filter-label">
            <i class="fa-solid fa-sliders"></i> Filter Transaksi
        </div>

        <form action="{{ route('pengguna.laporan.index') }}" method="GET">
            <div class="filter-grid">

                <div class="f-group">
                    <label class="f-label"><i class="fa-solid fa-calendar-days"></i> Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="f-input" value="{{ request('tanggal_awal') }}">
                </div>

                <div class="f-group">
                    <label class="f-label"><i class="fa-solid fa-calendar-check"></i> Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="f-input" value="{{ request('tanggal_akhir') }}">
                </div>

                <div class="f-group">
                    <label class="f-label"><i class="fa-solid fa-tag"></i> Kategori</label>
                    <select name="kategori" class="f-input">
                        <option value="">— Semua Kategori —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="f-group">
                    <label class="f-label"><i class="fa-solid fa-arrow-right-arrow-left"></i> Tipe Transaksi</label>
                    <select name="tipe" class="f-input">
                        <option value="">— Semua Tipe —</option>
                        <option value="pemasukan"   {{ request('tipe') == 'pemasukan'   ? 'selected' : '' }}>💚 Pemasukan</option>
                        <option value="pengeluaran" {{ request('tipe') == 'pengeluaran' ? 'selected' : '' }}>🔴 Pengeluaran</option>
                    </select>
                </div>

                <div class="f-group">
                    <label class="f-label" style="visibility:hidden;">Aksi</label>
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <i class="fa-solid fa-magnifying-glass"></i> Filter
                        </button>
                        @if(request()->anyFilled(['tanggal_awal','tanggal_akhir','kategori','tipe']))
                        <a href="{{ route('pengguna.laporan.index') }}" class="btn-reset">
                            <i class="fa-solid fa-xmark"></i> Reset
                        </a>
                        @endif
                    </div>
                </div>

            </div>
        </form>

        {{-- Active filter tags --}}
        @if(request()->anyFilled(['tanggal_awal','tanggal_akhir','kategori','tipe']))
        <div class="filter-tags">
            @if(request('tanggal_awal'))
                <span class="filter-tag"><i class="fa-solid fa-calendar-days"></i> Dari: {{ request('tanggal_awal') }}</span>
            @endif
            @if(request('tanggal_akhir'))
                <span class="filter-tag"><i class="fa-solid fa-calendar-check"></i> Sampai: {{ request('tanggal_akhir') }}</span>
            @endif
            @if(request('kategori'))
                @php $activeCat = $categories->firstWhere('id', request('kategori')); @endphp
                <span class="filter-tag"><i class="fa-solid fa-tag"></i> {{ $activeCat->nama ?? 'Kategori' }}</span>
            @endif
            @if(request('tipe'))
                <span class="filter-tag"><i class="fa-solid fa-circle-dot"></i> {{ ucfirst(request('tipe')) }}</span>
            @endif
        </div>
        @endif
    </div>

    {{-- ══ TABLE ══ --}}
    <div class="table-card">
        <div class="table-head">
            <div class="table-head-left">
                <p>Data Transaksi</p>
                <span id="rowCount">— data</span>
            </div>
            <input type="text" class="tbl-search" id="tableSearch" placeholder="🔍 Cari transaksi...">
        </div>

        <div class="tbl-wrap">
            <table class="lap-table" id="lapTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th style="text-align:right;">Nominal</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @isset($transactions)
                        @forelse($transactions as $i => $trx)
                        <tr data-search="{{ strtolower($trx->nama.' '.($trx->category->nama ?? '')) }}">
                            <td style="color:rgba(255,255,255,0.25); font-size:10px;">{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                            <td style="font-weight:600; color:#fff; max-width:160px; overflow:hidden; text-overflow:ellipsis;">
                                {{ $trx->nama }}
                            </td>
                            <td>
                                <span class="cat-chip">{{ $trx->category->nama ?? '—' }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $trx->tipe == 'pemasukan' ? 'in' : 'out' }}">
                                    <span class="dot"></span>
                                    {{ ucfirst($trx->tipe) }}
                                </span>
                            </td>
                            <td style="text-align:right;" class="{{ $trx->tipe == 'pemasukan' ? 'amt-in' : 'amt-out' }}">
                                {{ $trx->tipe == 'pemasukan' ? '+' : '−' }}Rp {{ number_format($trx->nominal,0,',','.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="tbl-empty">
                                    <i class="fa-solid fa-inbox"></i>
                                    Belum ada data transaksi
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    @else
                    <tr>
                        <td colspan="6">
                            <div class="tbl-empty">
                                <i class="fa-solid fa-filter"></i>
                                Gunakan filter di atas untuk menampilkan data
                            </div>
                        </td>
                    </tr>
                    @endisset
                </tbody>
            </table>
        </div>

        {{-- ── PAGINATION ── --}}
        <div class="pagination-wrap">
            <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
                <span class="pag-info" id="pagInfo">Menampilkan 0 dari 0 data</span>
                <div class="per-page-wrap">
                    <label>Tampilkan</label>
                    <select class="per-page-sel" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="pag-btns" id="pagBtns"></div>
        </div>
    </div>

</div>

<script>
(function(){
    const tbody     = document.getElementById('tableBody');
    const searchEl  = document.getElementById('tableSearch');
    const perPageEl = document.getElementById('perPage');
    const pagInfo   = document.getElementById('pagInfo');
    const pagBtns   = document.getElementById('pagBtns');
    const rowCount  = document.getElementById('rowCount');

    let allRows     = Array.from(tbody.querySelectorAll('tr[data-search]'));
    let filtered    = [...allRows];
    let currentPage = 1;
    let perPage     = 10;

    function update() {
        const q = searchEl.value.toLowerCase().trim();
        filtered = allRows.filter(r => !q || r.dataset.search.includes(q));
        currentPage = 1;
        render();
    }

    function render() {
        const total   = filtered.length;
        const pages   = Math.max(1, Math.ceil(total / perPage));
        currentPage   = Math.min(currentPage, pages);
        const start   = (currentPage - 1) * perPage;
        const end     = Math.min(start + perPage, total);

        allRows.forEach(r => r.style.display = 'none');
        filtered.forEach((r, i) => {
            r.style.display = (i >= start && i < end) ? '' : 'none';
        });

        filtered.slice(start, end).forEach((r, i) => {
            const numCell = r.querySelector('td:first-child');
            if (numCell) numCell.textContent = start + i + 1;
        });

        rowCount.textContent = total + ' data';
        pagInfo.textContent  = total
            ? `Menampilkan ${start + 1}–${end} dari ${total} data`
            : 'Tidak ada data';

        pagBtns.innerHTML = '';

        function makeBtn(label, page, disabled, active) {
            const b = document.createElement('button');
            b.className = 'pag-btn' + (active ? ' active' : '');
            b.innerHTML = label;
            b.disabled  = disabled;
            b.onclick   = () => { currentPage = page; render(); };
            return b;
        }

        pagBtns.appendChild(makeBtn('<i class="fa-solid fa-angles-left"></i>', 1, currentPage === 1, false));
        pagBtns.appendChild(makeBtn('<i class="fa-solid fa-angle-left"></i>', currentPage - 1, currentPage === 1, false));

        let rangeStart = Math.max(1, currentPage - 2);
        let rangeEnd   = Math.min(pages, rangeStart + 4);
        if (rangeEnd - rangeStart < 4) rangeStart = Math.max(1, rangeEnd - 4);

        for (let p = rangeStart; p <= rangeEnd; p++) {
            pagBtns.appendChild(makeBtn(p, p, false, p === currentPage));
        }

        pagBtns.appendChild(makeBtn('<i class="fa-solid fa-angle-right"></i>', currentPage + 1, currentPage === pages, false));
        pagBtns.appendChild(makeBtn('<i class="fa-solid fa-angles-right"></i>', pages, currentPage === pages, false));
    }

    searchEl.addEventListener('input', update);
    perPageEl.addEventListener('change', () => { perPage = parseInt(perPageEl.value); currentPage = 1; render(); });

    if (allRows.length) render();
    else {
        rowCount.textContent = '0 data';
        pagInfo.textContent  = 'Tidak ada data';
    }
})();
</script>

@endsection