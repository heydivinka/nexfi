<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} · NexFi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #07080f;
            --panel:   #0d0f20;
            --border:  rgba(108,99,255,0.15);
            --border2: rgba(255,255,255,0.05);
            --acc:     #6c63ff;
            --text:    rgba(255,255,255,0.88);
            --muted:   rgba(255,255,255,0.38);
            --faint:   rgba(255,255,255,0.14);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .bg-fx {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 800px 500px at 5% -15%, rgba(108,99,255,0.11) 0%, transparent 60%),
                radial-gradient(ellipse 600px 500px at 95% 110%, rgba(155,89,245,0.09) 0%, transparent 60%);
        }
        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(108,99,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.035) 1px, transparent 1px);
            background-size: 52px 52px;
        }

        .page {
            position: relative; z-index: 10;
            max-width: 980px; margin: 0 auto;
            padding: 16px 14px 48px;
        }

        /* TOPBAR */
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 0 14px;
        }
        .topbar-brand {
            font-size: 14px; font-weight: 800; letter-spacing: 0.04em;
            color: var(--faint); text-decoration: none;
            transition: color .15s;
        }
        .topbar-brand:hover { color: var(--muted); }
        .topbar-brand em { font-style: normal; color: rgba(108,99,255,0.6); }
        .topbar-url {
            font-size: 10px; font-family: 'JetBrains Mono', monospace;
            color: var(--faint);
        }
        @media(max-width:480px) { .topbar-url { display: none; } }

        /* CARD */
        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        /* BANNER */
        .banner {
            height: 88px; position: relative; overflow: hidden;
            background: linear-gradient(130deg, #12105a 0%, #3730a3 40%, #6c63ff 72%, #a855f7 100%);
        }
        .banner::before {
            content: ''; position: absolute; inset: 0;
            background: repeating-linear-gradient(
                -50deg,
                rgba(255,255,255,0.025) 0, rgba(255,255,255,0.025) 1px,
                transparent 1px, transparent 16px
            );
        }
        .banner-label {
            position: absolute; top: 12px; right: 16px;
            font-size: 9px; font-family: 'JetBrains Mono', monospace;
            font-weight: 700; letter-spacing: 0.14em;
            color: rgba(255,255,255,0.3); text-transform: uppercase;
        }

        /* LAYOUT */
        .layout {
            display: grid;
            grid-template-columns: 280px 1fr;
        }
        @media(max-width:680px) {
            .layout { grid-template-columns: 1fr; }
            .col-right { border-left: none !important; border-top: 1px solid var(--border); }
        }

        .col-left  { border-right: 1px solid var(--border); display: flex; flex-direction: column; }
        .col-right { display: flex; flex-direction: column; }

        /* PROFILE HEAD */
        .profile-head { padding: 0 18px 16px; border-bottom: 1px solid var(--border); }
        .av-wrap { margin-top: -36px; margin-bottom: 10px; position: relative; width: fit-content; }
        .av, .av-init {
            width: 72px; height: 72px; border-radius: 50%;
            border: 3px solid var(--panel);
            box-shadow: 0 0 0 2px var(--acc), 0 4px 18px rgba(108,99,255,0.35);
        }
        .av { object-fit: cover; display: block; }
        .av-init {
            background: linear-gradient(135deg, #6c63ff, #9b59f5);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem; font-weight: 900; color: #fff;
        }
        .lv-badge {
            position: absolute; bottom: -3px; right: -8px;
            padding: 2px 8px; border-radius: 99px;
            font-size: 9px; font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            border: 1.5px solid currentColor; letter-spacing: 0.03em; white-space: nowrap;
        }

        .uname   { font-size: 17px; font-weight: 800; color: #fff; line-height: 1.15; }
        .uhandle { font-size: 11px; font-family: 'JetBrains Mono', monospace; color: var(--muted); margin-top: 2px; }

        .rank-pill {
            display: inline-flex; align-items: center; gap: 5px;
            margin-top: 8px; padding: 4px 10px; border-radius: 7px;
            font-size: 10px; font-weight: 700; font-family: 'JetBrains Mono', monospace;
        }
        .rank-pill.gold {
            background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.28);
            color: rgba(251,191,36,0.9);
        }
        .rank-pill.hidden {
            background: rgba(255,255,255,0.03); border: 1px solid var(--border2);
            color: var(--faint);
        }

        /* STATS */
        .stats-strip {
            display: grid; grid-template-columns: repeat(3,1fr);
            border-bottom: 1px solid var(--border);
        }
        .stat-cell { padding: 11px 6px; text-align: center; border-right: 1px solid var(--border); }
        .stat-cell:last-child { border-right: none; }
        .stat-val { font-size: 16px; font-weight: 800; font-family: 'JetBrains Mono', monospace; line-height: 1; }
        .stat-lbl { font-size: 8px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--faint); margin-top: 3px; }

        /* SCORE */
        .score-sec { padding: 16px 18px; border-bottom: 1px solid var(--border); }
        .sec-ttl {
            font-size: 9px; font-weight: 700; letter-spacing: 0.13em; text-transform: uppercase;
            color: var(--faint); font-family: 'JetBrains Mono', monospace;
            display: flex; align-items: center; gap: 5px; margin-bottom: 12px;
        }
        .sec-ttl::before { content: '//'; color: rgba(108,99,255,0.45); }

        .ring-row { display: flex; align-items: center; gap: 14px; margin-bottom: 14px; }
        .ring-wrap { position: relative; width: 76px; height: 76px; flex-shrink: 0; }
        .ring-wrap svg { transform: rotate(-90deg); }
        .ring-center {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        .ring-num { font-size: 20px; font-weight: 900; font-family: 'JetBrains Mono', monospace; line-height: 1; }
        .ring-den { font-size: 8px; font-family: 'JetBrains Mono', monospace; color: var(--faint); }
        .ring-lv  { font-size: 16px; font-weight: 800; line-height: 1.1; }
        .ring-nxt { font-size: 10px; color: var(--muted); margin-top: 3px; font-family: 'JetBrains Mono', monospace; }

        .bar { margin-bottom: 9px; }
        .bar:last-child { margin-bottom: 0; }
        .bar-hdr { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .bar-lbl { font-size: 10px; font-weight: 600; color: var(--muted); display: flex; align-items: center; gap: 5px; }
        .bar-val { font-size: 10px; font-family: 'JetBrains Mono', monospace; color: var(--faint); }
        .bar-track { height: 5px; border-radius: 99px; background: rgba(255,255,255,0.06); overflow: hidden; }
        .bar-fill { height: 100%; border-radius: 99px; position: relative; }
        .bar-fill::after {
            content: ''; position: absolute; top: 1px; left: 4px; right: 6px; height: 2px;
            border-radius: 99px; background: rgba(255,255,255,0.2);
        }

        /* QR */
        .qr-sec { padding: 14px 18px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; }
        .qr-box { padding: 7px; background: #fff; border-radius: 8px; flex-shrink: 0; }
        .qr-label { font-size: 9px; font-family: 'JetBrains Mono', monospace; color: var(--faint); word-break: break-all; line-height: 1.5; }

        /* CTA */
        .cta-sec { padding: 14px 18px; margin-top: auto; }
        .cta-btn {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 11px 16px; border-radius: 11px;
            font-family: 'Outfit', sans-serif; font-size: 13px; font-weight: 800; color: #fff;
            background: linear-gradient(135deg, #6c63ff, #9b59f5);
            box-shadow: 0 5px 18px rgba(108,99,255,0.38);
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .15s, transform .15s;
        }
        .cta-btn:hover { opacity: .87; transform: translateY(-1px); }

        /* LEADERBOARD RIGHT */
        .lb-head {
            padding: 13px 18px 11px; border-bottom: 1px solid var(--border);
            display: flex; align-items: flex-start; justify-content: space-between; gap: 10px;
        }
        .live-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 2px 9px; border-radius: 5px;
            background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.2);
            color: #34d399; font-size: 9px; font-weight: 700;
            font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em; margin-bottom: 4px;
        }
        .live-dot { width: 5px; height: 5px; border-radius: 50%; background: #34d399; animation: blink 1.2s ease-in-out infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.12} }
        .lb-title { font-size: 15px; font-weight: 800; color: #fff; }
        .lb-sub   { font-size: 10px; color: var(--muted); margin-top: 1px; }
        .lb-chip  {
            flex-shrink: 0; padding: 3px 10px; border-radius: 6px;
            background: rgba(108,99,255,0.1); border: 1px solid rgba(108,99,255,0.2);
            font-size: 10px; font-family: 'JetBrains Mono', monospace;
            color: rgba(108,99,255,0.7); white-space: nowrap;
        }

        /* YOU bar */
        .you-bar {
            margin: 10px 14px 0; padding: 8px 14px; border-radius: 9px;
            background: rgba(108,99,255,0.08); border: 1px solid rgba(108,99,255,0.22);
            display: flex; align-items: center; justify-content: space-between; gap: 10px;
        }
        .you-bar-l { font-size: 11px; color: var(--muted); display: flex; align-items: center; gap: 7px; }
        .you-bar-l strong { color: #fff; font-weight: 700; }
        .you-r-chip {
            font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 700;
            padding: 2px 10px; border-radius: 5px; flex-shrink: 0; white-space: nowrap;
            background: rgba(108,99,255,0.15); color: rgba(108,99,255,0.9);
            border: 1px solid rgba(108,99,255,0.3);
        }

        /* LB ROWS */
        .lb-list { flex: 1; }
        .lb-row {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 16px; border-bottom: 1px solid var(--border2);
            position: relative; transition: background .12s;
        }
        .lb-row:last-child { border-bottom: none; }
        .lb-row:hover { background: rgba(108,99,255,0.05); }
        .lb-row.is-you { background: rgba(108,99,255,0.07); }
        .lb-row.is-you::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 2px; background: var(--acc);
        }
        .lb-row.top1 { background: rgba(251,191,36,0.035); }
        .you-tag {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            font-size: 8px; font-family: 'JetBrains Mono', monospace; font-weight: 700;
            color: rgba(108,99,255,0.65); letter-spacing: 0.1em;
            background: rgba(108,99,255,0.1); padding: 2px 6px; border-radius: 4px;
        }

        .r-rank { width: 22px; flex-shrink: 0; text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 11px; font-weight: 700; color: var(--faint); }
        .r-medal { font-size: 15px; line-height: 1; }
        .r-av {
            width: 34px; height: 34px; flex-shrink: 0; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 800; color: #fff; object-fit: cover;
            background: linear-gradient(135deg, #6c63ff, #9b59f5);
        }
        .r-av.circle { border-radius: 50%; }
        .r-info { flex: 1; min-width: 0; }
        .r-name-row { display: flex; align-items: center; gap: 6px; margin-bottom: 4px; }
        .r-name { font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.82); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .r-chip {
            font-size: 8px; font-family: 'JetBrains Mono', monospace; font-weight: 700;
            padding: 1px 6px; border-radius: 4px; flex-shrink: 0;
            border: 1px solid; display: flex; align-items: center; gap: 2px;
        }
        .r-bar-wrap { display: flex; align-items: center; gap: 6px; margin-bottom: 3px; }
        .r-bar-track { flex: 1; height: 3px; border-radius: 99px; background: rgba(255,255,255,0.05); overflow: hidden; }
        .r-bar-fill  { height: 100%; border-radius: 99px; }
        .r-minis { display: flex; gap: 8px; }
        .r-mini { font-size: 9px; font-family: 'JetBrains Mono', monospace; color: var(--faint); display: flex; align-items: center; gap: 3px; }
        .dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
        .r-score { flex-shrink: 0; text-align: right; min-width: 38px; }
        .r-score-val { font-family: 'JetBrains Mono', monospace; font-size: 16px; font-weight: 700; line-height: 1; }
        .r-score-lbl { font-size: 8px; font-family: 'JetBrains Mono', monospace; color: var(--faint); margin-top: 1px; }

        .lb-empty { padding: 40px 20px; text-align: center; color: var(--faint); font-size: 12px; font-family: 'JetBrains Mono', monospace; }

        .lb-more { padding: 10px 16px; border-top: 1px solid var(--border); text-align: center; }
        .lb-more a {
            font-size: 11px; font-family: 'JetBrains Mono', monospace;
            color: rgba(108,99,255,0.65); text-decoration: none; font-weight: 700;
            display: inline-flex; align-items: center; gap: 5px; transition: color .15s;
        }
        .lb-more a:hover { color: rgba(108,99,255,1); }

        /* FOOTER */
        .footer {
            text-align: center; padding: 14px 0 0;
            font-size: 10px; font-family: 'JetBrains Mono', monospace; color: var(--faint);
            display: flex; align-items: center; gap: 4px; justify-content: center;
        }

        /* ANIM */
        @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        .fade { animation: fadeUp .4s cubic-bezier(0.16,1,0.3,1) both; }
        .d1 { animation-delay:.06s; } .d2 { animation-delay:.12s; }
        @keyframes rowIn { from{opacity:0;transform:translateX(-6px)} to{opacity:1;transform:translateX(0)} }
        .row-in { animation: rowIn .28s cubic-bezier(0.16,1,0.3,1) both; }
    </style>
</head>
<body>
<div class="bg-fx"></div>
<div class="bg-grid"></div>

<div class="page">

    <div class="topbar fade">
        <a href="/" class="topbar-brand"><em>NexFi</em> · Profile</a>
        <div class="topbar-url">nexfi.app/user/{{ $user->username }}</div>
    </div>

    <div class="card fade d1">

        <div class="banner">
            <span class="banner-label">NexFi · Player Card</span>
        </div>

        <div class="layout">

            {{-- ── KIRI ── --}}
            <div class="col-left">
                <div class="profile-head">
                    <div class="av-wrap">
                        @if($user->photo)
                            <img class="av" src="{{ asset('assets_public/'.$user->photo) }}" alt="{{ $user->name }}">
                        @else
                            <div class="av-init">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        @endif
                        <span class="lv-badge" style="color:{{ $skor['color'] }};border-color:{{ $skor['color'] }}55;background:{{ $skor['color'] }}18">
                            {{ $skor['badge'] }} {{ $skor['level'] }}
                        </span>
                    </div>
                    <div class="uname">{{ $user->name }}</div>
                    <div class="uhandle">@{{ $user->username }}</div>

                    @if($user->show_on_leaderboard && $rankPosition)
                        <div class="rank-pill gold">
                            <i class="fa-solid fa-trophy" style="font-size:9px"></i>
                            Rank #{{ $rankPosition }} dari {{ $totalUsers }} user
                        </div>
                    @elseif(!$user->show_on_leaderboard)
                        <div class="rank-pill hidden">
                            <i class="fa-solid fa-eye-slash" style="font-size:9px"></i>
                            Tidak ikut leaderboard
                        </div>
                    @endif
                </div>

                <div class="stats-strip">
                    <div class="stat-cell">
                        <div class="stat-val" style="color:{{ $skor['color'] }}">{{ $skor['total'] }}</div>
                        <div class="stat-lbl">Skor</div>
                    </div>
                    <div class="stat-cell">
                        <div class="stat-val" style="color:#fb923c">{{ $skor['streak'] }}</div>
                        <div class="stat-lbl">Streak</div>
                    </div>
                    <div class="stat-cell">
                        <div class="stat-val" style="color:#34d399">{{ $skor['totalTrx'] }}</div>
                        <div class="stat-lbl">Catatan</div>
                    </div>
                </div>

                <div class="score-sec">
                    <div class="sec-ttl">Financial Health Score</div>
                    @php
                        $r    = 30;
                        $circ = 2 * M_PI * $r;
                        $off  = $circ * (1 - $skor['total'] / 100);
                    @endphp
                    <div class="ring-row">
                        <div class="ring-wrap">
                            <svg width="76" height="76" viewBox="0 0 76 76">
                                <circle cx="38" cy="38" r="{{ $r }}" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="8"/>
                                <circle cx="38" cy="38" r="{{ $r }}" fill="none"
                                    stroke="{{ $skor['color'] }}" stroke-width="8" stroke-linecap="round"
                                    stroke-dasharray="{{ $circ }}" stroke-dashoffset="{{ $off }}"
                                    style="filter:drop-shadow(0 0 4px {{ $skor['color'] }}88)"/>
                            </svg>
                            <div class="ring-center">
                                <span class="ring-num" style="color:{{ $skor['color'] }}">{{ $skor['total'] }}</span>
                                <span class="ring-den">/100</span>
                            </div>
                        </div>
                        <div>
                            <div class="ring-lv" style="color:{{ $skor['color'] }}">{{ $skor['badge'] }} {{ $skor['level'] }}</div>
                            <div class="ring-nxt">
                                @if($skor['total'] >= 90) 🏆 Tier tertinggi!
                                @elseif($skor['total'] >= 75) {{ 90 - $skor['total'] }}pt lagi → Legend
                                @elseif($skor['total'] >= 55) {{ 75 - $skor['total'] }}pt lagi → Expert
                                @elseif($skor['total'] >= 35) {{ 55 - $skor['total'] }}pt lagi → Pro
                                @elseif($skor['total'] >= 15) {{ 35 - $skor['total'] }}pt lagi → Rising
                                @else {{ 15 - $skor['total'] }}pt lagi → Rookie
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="bar">
                        <div class="bar-hdr">
                            <span class="bar-lbl"><i class="fa-solid fa-fire" style="color:#fb923c;font-size:9px"></i> Streak</span>
                            <span class="bar-val">{{ $skor['streak'] }}d · {{ $skor['streakScore'] }}/30</span>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ ($skor['streakScore']/30)*100 }}%;background:linear-gradient(90deg,#f97316,#fb923c)"></div></div>
                    </div>
                    <div class="bar">
                        <div class="bar-hdr">
                            <span class="bar-lbl"><i class="fa-solid fa-calendar-check" style="color:#818cf8;font-size:9px"></i> Konsistensi</span>
                            <span class="bar-val">{{ $skor['konsistensiScore'] }}/40</span>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ ($skor['konsistensiScore']/40)*100 }}%;background:linear-gradient(90deg,#6c63ff,#9b59f5)"></div></div>
                    </div>
                    <div class="bar">
                        <div class="bar-hdr">
                            <span class="bar-lbl"><i class="fa-solid fa-receipt" style="color:#34d399;font-size:9px"></i> Catatan</span>
                            <span class="bar-val">{{ $skor['totalTrx'] }} trx · {{ $skor['trxScore'] }}/30</span>
                        </div>
                        <div class="bar-track"><div class="bar-fill" style="width:{{ ($skor['trxScore']/30)*100 }}%;background:linear-gradient(90deg,#10b981,#34d399)"></div></div>
                    </div>
                </div>

                <div class="qr-sec">
                    @php $url = url('/user/'.$user->username); @endphp
                    <div class="qr-box">
                        <img style="display:block;width:64px;height:64px;border-radius:3px"
                             src="https://api.qrserver.com/v1/create-qr-code/?size=64x64&color=100162&bgcolor=ffffff&data={{ urlencode($url) }}"
                             alt="QR">
                    </div>
                    <div>
                        <div class="sec-ttl" style="margin-bottom:4px">QR Code</div>
                        <div class="qr-label">{{ $url }}</div>
                    </div>
                </div>

                <div class="cta-sec">
                    <a href="/register" class="cta-btn">
                        <i class="fa-solid fa-rocket"></i> Gabung NexFi Sekarang
                    </a>
                </div>
            </div>

            {{-- ── KANAN: LEADERBOARD ── --}}
            <div class="col-right">
                <div class="lb-head">
                    <div>
                        <div class="live-badge"><span class="live-dot"></span> LIVE</div>
                        <div class="lb-title">Top Players</div>
                        <div class="lb-sub">Ranking konsistensi & kebiasaan keuangan</div>
                    </div>
                    <span class="lb-chip">{{ $leaderboard->count() }} players</span>
                </div>

                @if($user->show_on_leaderboard && $rankPosition)
                <div class="you-bar">
                    <div class="you-bar-l">
                        <i class="fa-solid fa-location-crosshairs" style="color:rgba(108,99,255,0.55);font-size:11px"></i>
                        Posisi <strong>{{ $user->name }}</strong>
                    </div>
                    <span class="you-r-chip">#{{ $rankPosition }} / {{ $totalUsers }}</span>
                </div>
                @endif

                <div class="lb-list">
                    @php $medals = [1=>'🥇', 2=>'🥈', 3=>'🥉']; @endphp
                    @forelse($leaderboard as $i => $item)
                    @php
                        $lu    = $item['user'];
                        $lsk   = $item['skor'];
                        $lrank = $i + 1;
                        $isYou = $lu->id === $user->id;
                    @endphp
                    <div class="lb-row row-in {{ $lrank===1?'top1':'' }} {{ $isYou?'is-you':'' }}"
                         style="animation-delay:{{ $i*0.028 }}s">
                        <div class="r-rank">
                            @if(isset($medals[$lrank]))<span class="r-medal">{{ $medals[$lrank] }}</span>
                            @else #{{ $lrank }}
                            @endif
                        </div>
                        @if($lu->photo)
                            <img class="r-av {{ $lrank<=3?'circle':'' }}" src="{{ asset('assets_public/'.$lu->photo) }}" alt="">
                        @else
                            <div class="r-av {{ $lrank<=3?'circle':'' }}">{{ strtoupper(substr($lu->name,0,1)) }}</div>
                        @endif
                        <div class="r-info">
                            <div class="r-name-row">
                                <span class="r-name">{{ $lu->name }}</span>
                                <span class="r-chip" style="color:{{ $lsk['color'] }};border-color:{{ $lsk['color'] }}30;background:{{ $lsk['color'] }}0d">
                                    {{ $lsk['badge'] }} {{ $lsk['level'] }}
                                </span>
                            </div>
                            <div class="r-bar-wrap">
                                <div class="r-bar-track"><div class="r-bar-fill" style="width:{{ $lsk['total'] }}%;background:{{ $lsk['color'] }}"></div></div>
                            </div>
                            <div class="r-minis">
                                <span class="r-mini"><span class="dot" style="background:#fb923c"></span>{{ $lsk['streak'] }}d</span>
                                <span class="r-mini"><span class="dot" style="background:#34d399"></span>{{ $lsk['totalTrx'] }} records</span>
                            </div>
                        </div>
                        <div class="r-score" style="{{ $isYou?'margin-right:44px':'' }}">
                            <div class="r-score-val" style="color:{{ $lsk['color'] }}">{{ $lsk['total'] }}</div>
                            <div class="r-score-lbl">PTS</div>
                        </div>
                        @if($isYou)<span class="you-tag">YOU</span>@endif
                    </div>
                    @empty
                    <div class="lb-empty">
                        <i class="fa-solid fa-ghost" style="font-size:2rem;display:block;margin-bottom:10px;opacity:.1"></i>
                        belum ada player...
                    </div>
                    @endforelse
                </div>

                <div class="lb-more">
                    <a href="{{ route('leaderboard') }}">
                        Lihat Full Leaderboard <i class="fa-solid fa-arrow-right" style="font-size:9px"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="footer fade d2">
        <span style="color:rgba(108,99,255,0.45);font-weight:700">NexFi</span>
        &mdash; Platform Keuangan #1 Indonesia
    </div>
</div>
</body>
</html>