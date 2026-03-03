<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile {{ $user->username }} | NexFi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <style>
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        :root {
            --bg:#07080f; --bg2:#0c0d1d; --bg3:#10132a;
            --acc:#6c63ff; --acc2:#9b59f5; --glow:rgba(108,99,255,0.3);
            --muted:rgba(255,255,255,0.35);
        }
        html, body {
            height:100%; min-height:100vh;
            background:var(--bg); color:rgba(255,255,255,0.88);
            font-family:'Plus Jakarta Sans',sans-serif; overflow-x:hidden;
        }
        .bg-grid {
            position:fixed; inset:0; pointer-events:none; z-index:0;
            background-image:
                linear-gradient(rgba(108,99,255,0.07) 1px,transparent 1px),
                linear-gradient(90deg,rgba(108,99,255,0.07) 1px,transparent 1px);
            background-size:40px 40px;
        }
        .bg-orb1 { position:fixed;width:500px;height:500px;border-radius:50%;top:-200px;left:-150px;background:radial-gradient(circle,rgba(108,99,255,0.18) 0%,transparent 70%);pointer-events:none;z-index:0; }
        .bg-orb2 { position:fixed;width:400px;height:400px;border-radius:50%;bottom:-150px;right:-100px;background:radial-gradient(circle,rgba(155,89,245,0.14) 0%,transparent 70%);pointer-events:none;z-index:0; }

        /* PAGE */
        .page {
            position:relative; z-index:1;
            min-height:100vh; padding:20px;
            display:flex; flex-direction:column; gap:16px;
        }

        /* CARD FULLSCREEN */
        .card {
            flex:1;
            background:var(--bg3);
            border:1px solid rgba(108,99,255,0.16);
            border-radius:20px;
            /* PERBAIKAN: hapus overflow:hidden agar avatar tidak terpotong */
            overflow:visible;
            box-shadow:0 24px 60px rgba(0,0,0,0.5);
        }

        /* 2 KOLOM LANDSCAPE */
        .card-inner {
            display:grid;
            grid-template-columns:320px 1fr;
            min-height:calc(100vh - 72px);
            border-radius:20px;
            overflow:hidden; /* overflow:hidden dipindah ke sini agar card-inner yang clip, bukan card */
        }
        @media(max-width:767px){
            .card-inner { grid-template-columns:1fr; min-height:auto; }
            .col-left { border-right:none !important; border-bottom:1px solid rgba(108,99,255,0.1); }
        }

        /* KIRI */
        .col-left {
            border-right:1px solid rgba(108,99,255,0.1);
            display:flex; flex-direction:column;
            /* PERBAIKAN: overflow visible agar avatar tidak terpotong */
            overflow:visible;
            position:relative;
            z-index:2;
        }
        .banner {
            height:100px; flex-shrink:0;
            background:linear-gradient(135deg,#3b2fa0,#6c63ff 50%,#9b59f5);
            position:relative;
            /* PERBAIKAN: beri z-index rendah agar avatar bisa overlap di atasnya */
            z-index:1;
        }
        .banner::after {
            content:''; position:absolute; inset:0;
            background:repeating-linear-gradient(45deg,rgba(255,255,255,0.04) 0,rgba(255,255,255,0.04) 1px,transparent 1px,transparent 10px);
        }
        .hero {
            padding:0 24px 20px;
            display:flex; flex-direction:column; align-items:center; text-align:center;
            /* PERBAIKAN: z-index lebih tinggi dari banner agar avatar tampil di atas */
            position:relative;
            z-index:3;
        }
        .avatar-wrap { margin-top:-48px; margin-bottom:12px; }
        .avatar {
            width:92px; height:92px; border-radius:50%; object-fit:cover;
            border:4px solid var(--bg3);
            box-shadow:0 0 0 3px rgba(108,99,255,0.5),0 8px 24px rgba(108,99,255,0.3);
            /* PERBAIKAN: pastikan avatar selalu tampil di atas segalanya */
            position:relative;
            z-index:4;
            display:block;
        }
        .hero-name  { font-size:19px; font-weight:800; color:#fff; margin-bottom:3px; }
        .hero-uname { font-size:12.5px; color:var(--muted); margin-bottom:3px; }
        .hero-email { font-size:11.5px; color:rgba(255,255,255,0.2); }

        .hdivider {
            height:1px; background:rgba(108,99,255,0.1); margin:0 20px;
            /* PERBAIKAN: z-index lebih rendah dari hero agar tidak menutupi avatar */
            position:relative;
            z-index:1;
        }

        /* STATS */
        .stats { display:grid; grid-template-columns:1fr 1fr 1fr; }
        .stat-item {
            padding:14px 8px; text-align:center;
            border-right:1px solid rgba(108,99,255,0.08);
        }
        .stat-item:last-child { border-right:none; }
        .stat-val   { font-size:13px; font-weight:800; color:#fff; word-break:break-all; }
        .stat-label { font-size:9px; font-weight:700; text-transform:uppercase; letter-spacing:0.07em; color:var(--muted); margin-top:3px; }
        .stat-val.income  { color:#4ade80; }
        .stat-val.expense { color:#f87171; }

        /* QR area di kiri bawah */
        .qr-area {
            flex:1; padding:20px; display:flex; flex-direction:column;
            align-items:center; justify-content:center; gap:12px;
        }
        .qr-sec-title {
            font-size:10px; font-weight:700; text-transform:uppercase;
            letter-spacing:0.08em; color:rgba(255,255,255,0.25);
            display:flex; align-items:center; gap:6px; align-self:flex-start; width:100%;
        }
        .qr-frame {
            padding:12px; border-radius:14px; background:#fff;
            box-shadow:0 6px 24px rgba(0,0,0,0.4); display:inline-flex;
        }
        .qr-frame img { display:block; width:120px; height:120px; border-radius:4px; }
        .qr-url { font-size:10px; color:rgba(255,255,255,0.18); font-family:monospace; text-align:center; word-break:break-all; }

        /* CTA */
        .cta { padding:16px 20px 20px; }
        .btn-cta {
            display:flex; align-items:center; justify-content:center; gap:8px;
            width:100%; padding:12px; border-radius:13px; text-decoration:none;
            font-size:13px; font-weight:800; color:#fff;
            background:linear-gradient(135deg,var(--acc),var(--acc2));
            box-shadow:0 6px 20px var(--glow);
        }
        .btn-cta:hover { opacity:0.88; }

        /* KANAN */
        .col-right {
            display:flex; flex-direction:column; overflow-y:auto;
        }

        .sec-head {
            padding:20px 24px 14px;
            border-bottom:1px solid rgba(108,99,255,0.08);
            font-size:10px; font-weight:700; text-transform:uppercase;
            letter-spacing:0.08em; color:rgba(255,255,255,0.25);
            display:flex; align-items:center; gap:6px;
        }
        .sec-head i { color:rgba(108,99,255,0.5); }

        .trx-list { padding:8px 24px 16px; flex:1; }
        .trx-item {
            display:flex; align-items:center; gap:12px;
            padding:11px 0; border-bottom:1px solid rgba(255,255,255,0.04);
        }
        .trx-item:last-child { border-bottom:none; }
        .trx-ico {
            width:36px; height:36px; border-radius:10px; flex-shrink:0;
            display:flex; align-items:center; justify-content:center; font-size:13px;
        }
        .trx-ico.in  { background:rgba(34,197,94,0.12);  color:#4ade80; }
        .trx-ico.out { background:rgba(239,68,68,0.1);   color:#f87171; }
        .trx-body { flex:1; min-width:0; }
        .trx-name { font-size:13px; font-weight:600; color:rgba(255,255,255,0.85); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .trx-date { font-size:11px; color:rgba(255,255,255,0.25); margin-top:2px; }
        .trx-amt { font-size:13.5px; font-weight:800; flex-shrink:0; }
        .trx-amt.in  { color:#4ade80; }
        .trx-amt.out { color:#f87171; }
        .trx-empty { font-size:12.5px; color:rgba(255,255,255,0.2); text-align:center; padding:32px 0; }

        /* FOOTER */
        .pub-footer {
            text-align:center; font-size:11.5px;
            color:rgba(255,255,255,0.15);
            display:flex; align-items:center; gap:6px; justify-content:center;
        }
        .pub-footer span { color:rgba(108,99,255,0.5); font-weight:700; }
    </style>
</head>
<body>

<div class="bg-grid"></div>
<div class="bg-orb1"></div>
<div class="bg-orb2"></div>

<div class="page">
    <div class="card">
        <div class="card-inner">

            {{-- ══ KIRI ══ --}}
            <div class="col-left">
                <div class="banner"></div>

                <div class="hero">
                    <div class="avatar-wrap">
                        <img class="avatar"
                             src="{{ $user->photo ? asset('profile/'.$user->photo) : asset('default.png') }}"
                             alt="{{ $user->name }}">
                    </div>
                    <div class="hero-name">{{ $user->name }}</div>
                    <div class="hero-uname">{{ $user->username }}</div>
                    <div class="hero-email">{{ $user->email }}</div>
                </div>

                <div class="hdivider"></div>

                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-val">Rp {{ number_format($saldo,0,',','.') }}</div>
                        <div class="stat-label">Saldo</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-val income">+{{ number_format($pemasukan,0,',','.') }}</div>
                        <div class="stat-label">Pemasukan</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-val expense">-{{ number_format($pengeluaran,0,',','.') }}</div>
                        <div class="stat-label">Pengeluaran</div>
                    </div>
                </div>

                <div class="hdivider"></div>

                <div class="qr-area">
                    <div class="qr-sec-title"><i class="fa-solid fa-qrcode"></i> QR Code Profile</div>
                    @php $url = url('/u/'.$user->username); @endphp
                    <div class="qr-frame">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&color=100162&bgcolor=ffffff&data={{ urlencode($url) }}" alt="QR">
                    </div>
                    <div class="qr-url">{{ $url }}</div>
                </div>

                <div class="hdivider"></div>

                <div class="cta">
                    <a href="/register" class="btn-cta">
                        <i class="fa-solid fa-rocket"></i> Gabung NexFi Sekarang
                    </a>
                </div>
            </div>

            {{-- ══ KANAN ══ --}}
            <div class="col-right">
                <div class="sec-head">
                    <i class="fa-solid fa-clock-rotate-left"></i> Aktivitas Terakhir
                </div>
                <div class="trx-list">
                    @forelse($transactions as $trx)
                    <div class="trx-item">
                        <div class="trx-ico {{ $trx->tipe=='pemasukan' ? 'in' : 'out' }}">
                            <i class="fa-solid {{ $trx->tipe=='pemasukan' ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                        </div>
                        <div class="trx-body">
                            <div class="trx-name">{{ $trx->nama }}</div>
                            <div class="trx-date">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</div>
                        </div>
                        <div class="trx-amt {{ $trx->tipe=='pemasukan' ? 'in' : 'out' }}">
                            {{ $trx->tipe=='pemasukan' ? '+' : '-' }}Rp {{ number_format($trx->nominal,0,',','.') }}
                        </div>
                    </div>
                    @empty
                    <div class="trx-empty"><i class="fa-solid fa-inbox" style="font-size:2rem;display:block;margin-bottom:8px;opacity:0.2;"></i>Belum ada transaksi</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <div class="pub-footer">
        Dibuat dengan <span>NexFi</span> &mdash; Platform Keuangan #1 Indonesia
    </div>
</div>

</body>
</html>