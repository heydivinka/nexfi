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
    .stat-pct  { font-size:9.5px;font-weight:700; }

    .activity {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.15);
        border-radius:11px;
        overflow:hidden;
    }
    .act-hdr {
        padding:11px 13px;
        border-bottom:1px solid rgba(108,99,255,0.1);
        display:flex;align-items:center;justify-content:space-between;
    }
    .act-hdr p { font-size:12px;font-weight:700;color:white;margin:0; }
    .act-hdr a { font-size:10.5px;font-weight:600;color:#6c63ff;text-decoration:none;white-space:nowrap; }

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
</style>

<div class="dash">

    <div class="welcome">
        <p>Selamat datang, <strong>{{ auth()->user()->name ?? 'Pengguna' }}</strong> 👋</p>
        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
    </div>

    <div class="stat-grid">
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
            <div class="stat-val">Rp 4.250.000</div>
            <div class="stat-foot"><span class="stat-sub">Total saldo aktif</span></div>
        </div>

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
            <div class="stat-val">Rp 6.800.000</div>
            <div class="stat-foot">
                <span class="stat-sub">Bulan ini</span>
                <span class="stat-pct" style="color:#22c55e;">↑ 12.5%</span>
            </div>
        </div>

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
            <div class="stat-val">Rp 2.550.000</div>
            <div class="stat-foot">
                <span class="stat-sub">Bulan ini</span>
                <span class="stat-pct" style="color:#ef4444;">↓ 3.2%</span>
            </div>
        </div>
    </div>

    <div class="activity">
        <div class="act-hdr">
            <p>Aktivitas Terbaru</p>
            <a href="#">Lihat Semua →</a>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(34,197,94,0.1);">
                <svg width="11" height="11" fill="none" stroke="#22c55e" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
            </div>
            <div class="act-body">
                <p class="act-title">Gaji Bulanan</p>
                <p class="act-sub2">Gaji · 2 jam lalu</p>
            </div>
            <span class="act-amt" style="color:#22c55e;">+Rp 5.000.000</span>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(239,68,68,0.1);">
                <svg width="11" height="11" fill="none" stroke="#ef4444" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6"/></svg>
            </div>
            <div class="act-body">
                <p class="act-title">Belanja Bulanan</p>
                <p class="act-sub2">Kebutuhan · 5 jam lalu</p>
            </div>
            <span class="act-amt" style="color:#ef4444;">−Rp 850.000</span>
        </div>
        <div class="act-item">
            <div class="act-ico" style="background:rgba(249,115,22,0.1);">
                <svg width="11" height="11" fill="none" stroke="#f97316" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6"/></svg>
            </div>
            <div class="act-body">
                <p class="act-title">Makan & Minum</p>
                <p class="act-sub2">Konsumsi · Kemarin</p>
            </div>
            <span class="act-amt" style="color:#f97316;">−Rp 120.000</span>
        </div>
    </div>

</div>

@endsection