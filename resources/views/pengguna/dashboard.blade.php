@extends('layout_pengguna.pengguna')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .dash { display:flex; flex-direction:column; gap:10px; font-family:'Plus Jakarta Sans',sans-serif; }

    .welcome {
        padding:11px 13px;
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
    }
    .welcome p { font-size:12.5px; font-weight:600; color:rgba(255,255,255,0.7); margin:0 0 2px; }
    .welcome p strong { color:white; }
    .welcome span { font-size:10px; color:rgba(255,255,255,0.25); }

    .stat-grid {
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:8px;
    }
    @media(max-width:560px){
        .stat-grid { grid-template-columns:1fr; gap:8px; }
    }

    .stat {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
        padding:12px 13px;
        position:relative;
        overflow:hidden;
    }
    .stat-bar { position:absolute;top:0;left:0;right:0;height:2px; }
    .stat-head { display:flex;align-items:center;gap:7px;margin-bottom:8px; }
    .stat-ico { width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .stat-lbl { font-size:10.5px;font-weight:600;color:rgba(255,255,255,0.32); }
    .stat-val { font-size:15px;font-weight:800;color:white;letter-spacing:-0.3px; }
    .stat-foot { display:flex;align-items:center;gap:4px;margin-top:3px; }
    .stat-sub  { font-size:9.5px;color:rgba(255,255,255,0.22); }

    .activity {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
        overflow:hidden;
    }
    .act-hdr {
        padding:11px 13px;
        border-bottom:1px solid rgba(108,99,255,0.1);
    }
    .act-hdr p { font-size:12px;font-weight:700;color:white;margin:0; }

    .act-item {
        display:flex;align-items:center;gap:9px;
        padding:10px 13px;
        border-bottom:1px solid rgba(108,99,255,0.07);
    }
    .act-item:last-child { border-bottom:none; }
    .act-ico { width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
    .act-body { flex:1;min-width:0; }
    .act-title { font-size:11.5px;font-weight:600;color:white;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
    .act-sub2  { font-size:10px;color:rgba(255,255,255,0.28);margin:1px 0 0; }
    .act-amt   { font-size:11.5px;font-weight:700;flex-shrink:0;white-space:nowrap; }

    .act-empty {
        padding:28px 13px;
        text-align:center;
        font-size:12px;
        color:rgba(255,255,255,0.2);
    }
    .act-empty i { display:block; font-size:1.8rem; margin-bottom:8px; opacity:0.2; }

    /* Pagination aktivitas */
    .act-pagination {
        display:flex; align-items:center; justify-content:space-between;
        padding:10px 13px;
        border-top:1px solid rgba(108,99,255,0.1);
        gap:8px; flex-wrap:wrap;
    }
    .act-pg-info { font-size:10.5px; color:rgba(255,255,255,0.28); }
    .act-pg-controls { display:flex; align-items:center; gap:5px; }
    .act-pg-btn {
        width:28px; height:28px; border-radius:7px;
        border:1px solid rgba(108,99,255,0.2);
        background:rgba(108,99,255,0.07);
        color:rgba(255,255,255,0.6); font-size:13px;
        cursor:pointer; display:flex; align-items:center; justify-content:center;
        transition:all 0.15s; font-family:inherit; padding:0;
    }
    .act-pg-btn:hover:not(:disabled) {
        background:rgba(108,99,255,0.18);
        border-color:rgba(108,99,255,0.4);
        color:#fff;
    }
    .act-pg-btn:disabled { opacity:0.25; cursor:not-allowed; }
    .act-pg-num {
        min-width:28px; height:28px; border-radius:7px;
        border:1px solid rgba(108,99,255,0.15);
        background:transparent; color:rgba(255,255,255,0.4);
        font-size:11.5px; font-weight:600; cursor:pointer;
        display:flex; align-items:center; justify-content:center;
        transition:all 0.15s; padding:0 5px; font-family:inherit;
    }
    .act-pg-num:hover:not(.active) {
        background:rgba(108,99,255,0.12); color:#fff;
        border-color:rgba(108,99,255,0.3);
    }
    .act-pg-num.active {
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        border-color:transparent; color:#fff; cursor:default;
    }
</style>

<div class="dash">

    <div class="welcome">
        <p>Selamat datang, <strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong> 👋</p>
    </div>

    <div class="stat-grid">

        {{-- Saldo --}}
        <div class="stat">
            <div class="stat-bar" style="background:linear-gradient(90deg,#6c63ff,#9b59f5);"></div>
            <div class="stat-head">
                <div class="stat-ico" style="background:rgba(108,99,255,0.12);">
                    <svg width="12" height="12" fill="none" stroke="#a78bfa" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <span class="stat-lbl">Saldo</span>
            </div>
            <div class="stat-val">
                Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}
            </div>
            <div class="stat-foot"><span class="stat-sub">Total saldo aktif</span></div>
        </div>

        {{-- Pemasukan --}}
        <div class="stat">
            <div class="stat-bar" style="background:linear-gradient(90deg,#16a34a,#22c55e);"></div>
            <div class="stat-head">
                <div class="stat-ico" style="background:rgba(34,197,94,0.1);">
                    <svg width="12" height="12" fill="none" stroke="#22c55e" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                    </svg>
                </div>
                <span class="stat-lbl">Pemasukan</span>
            </div>
            <div class="stat-val">
                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
            </div>
            <div class="stat-foot"><span class="stat-sub">Bulan ini</span></div>
        </div>

        {{-- Pengeluaran --}}
        <div class="stat">
            <div class="stat-bar" style="background:linear-gradient(90deg,#dc2626,#ef4444);"></div>
            <div class="stat-head">
                <div class="stat-ico" style="background:rgba(239,68,68,0.1);">
                    <svg width="12" height="12" fill="none" stroke="#ef4444" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                    </svg>
                </div>
                <span class="stat-lbl">Pengeluaran</span>
            </div>
            <div class="stat-val">
                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
            </div>
            <div class="stat-foot"><span class="stat-sub">Bulan ini</span></div>
        </div>

    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="activity">
        <div class="act-hdr">
            <p>Aktivitas Terbaru</p>
        </div>

        <div id="actList">
            @forelse($recentTransactions as $trx)
            <div class="act-item" data-act-item>
                <div class="act-ico" style="background:{{ $trx->tipe == 'pemasukan' ? 'rgba(34,197,94,0.1)' : 'rgba(239,68,68,0.1)' }};">
                    @if($trx->tipe == 'pemasukan')
                        <svg width="11" height="11" fill="none" stroke="#22c55e" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                        </svg>
                    @else
                        <svg width="11" height="11" fill="none" stroke="#ef4444" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        </svg>
                    @endif
                </div>
                <div class="act-body">
                    <p class="act-title">{{ $trx->nama }}</p>
                    <p class="act-sub2">
                        {{ ucfirst($trx->tipe) }} · {{ \Carbon\Carbon::parse($trx->tanggal)->diffForHumans() }}
                    </p>
                </div>
                <span class="act-amt" style="color:{{ $trx->tipe == 'pemasukan' ? '#22c55e' : '#ef4444' }};">
                    {{ $trx->tipe == 'pemasukan' ? '+' : '−' }}Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                </span>
            </div>
            @empty
            <div class="act-empty">
                <i class="fa-solid fa-inbox"></i>
                Belum ada transaksi
            </div>
            @endforelse
        </div>

        {{-- Pagination aktivitas --}}
        <div id="actPagination" class="act-pagination" style="display:none;">
            <span class="act-pg-info" id="actInfo"></span>
            <div class="act-pg-controls" id="actControls"></div>
        </div>
    </div>

</div>

<script>
(function () {
    const PER_PAGE  = 5;
    const SHOW_PGS  = 5;
    let currentPage = 1;

    const list  = document.getElementById('actList');
    const wrap  = document.getElementById('actPagination');
    const info  = document.getElementById('actInfo');
    const ctrl  = document.getElementById('actControls');

    function allItems() {
        return Array.from(list.querySelectorAll('[data-act-item]'));
    }
    function totalPages() {
        return Math.max(1, Math.ceil(allItems().length / PER_PAGE));
    }

    function render() {
        const items = allItems();
        const total = items.length;
        const pages = totalPages();

        if (total === 0) { wrap.style.display = 'none'; return; }

        items.forEach(function (el, i) {
            const inPage = i >= (currentPage - 1) * PER_PAGE && i < currentPage * PER_PAGE;
            el.style.display = inPage ? '' : 'none';
        });

        wrap.style.display = 'flex';

        const from = (currentPage - 1) * PER_PAGE + 1;
        const to   = Math.min(currentPage * PER_PAGE, total);
        info.textContent = from + '–' + to + ' dari ' + total;

        ctrl.innerHTML = '';
        ctrl.appendChild(makeBtn('&#8249;', currentPage === 1, function () { goTo(currentPage - 1); }));

        if (pages > 1) {
            buildRange(currentPage, pages, SHOW_PGS).forEach(function (p) {
                if (p === '...') {
                    const s = document.createElement('span');
                    s.style.cssText = 'font-size:10px;color:rgba(255,255,255,0.2);padding:0 2px;';
                    s.textContent = '·';
                    ctrl.appendChild(s);
                } else {
                    ctrl.appendChild(makeNum(p, p === currentPage));
                }
            });
        } else {
            ctrl.appendChild(makeNum(1, true));
        }

        ctrl.appendChild(makeBtn('&#8250;', currentPage === pages, function () { goTo(currentPage + 1); }));
    }

    function makeBtn(html, disabled, onClick) {
        const b = document.createElement('button');
        b.className = 'act-pg-btn';
        b.innerHTML = html;
        b.disabled  = disabled;
        b.onclick   = onClick;
        return b;
    }

    function makeNum(p, active) {
        const b = document.createElement('button');
        b.className   = 'act-pg-num' + (active ? ' active' : '');
        b.textContent = p;
        if (!active) b.onclick = function () { goTo(p); };
        return b;
    }

    function goTo(p) {
        const pages = totalPages();
        if (p < 1 || p > pages) return;
        currentPage = p;
        render();
    }

    function buildRange(current, total, show) {
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
</script>

@endsection