<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard · NexFi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:     #07080f;
            --panel:  #0e1128;
            --border: rgba(108,99,255,0.18);
            --acc:    #6c63ff;
            --gold:   #fbbf24;
            --silver: #94a3b8;
            --bronze: #c2845a;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: rgba(255,255,255,0.9);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .bg-glow {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 700px 450px at 10% -10%, rgba(108,99,255,0.13) 0%, transparent 65%),
                radial-gradient(ellipse 500px 400px at 92% 105%, rgba(155,89,245,0.1) 0%, transparent 65%);
        }

        .page {
            position: relative; z-index: 10;
            max-width: 700px; margin: 0 auto; padding: 24px 14px 52px;
        }

        /* ── BACK NAV ── */
        .back-nav {
            display: inline-flex; align-items: center; gap: 7px;
            font-family: 'JetBrains Mono', monospace; font-size: 11px;
            color: rgba(255,255,255,0.22); text-decoration: none;
            padding: 5px 12px; border-radius: 6px;
            border: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.02);
            transition: all .18s; margin-bottom: 22px;
        }
        .back-nav:hover { color: rgba(255,255,255,0.5); border-color: rgba(108,99,255,0.3); background: rgba(108,99,255,0.06); }

        /* ── HEADER ── */
        .live-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.22);
            color: #34d399; border-radius: 6px;
            padding: 3px 10px; font-size: 10px; font-weight: 700;
            font-family: 'JetBrains Mono', monospace; letter-spacing: 0.1em;
            margin-bottom: 10px;
        }
        .live-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: #34d399; display: inline-block;
            animation: blink 1s ease-in-out infinite;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.15} }

        .page-title {
            font-size: clamp(30px,6vw,44px); font-weight: 900;
            letter-spacing: -0.03em; line-height: 1; color: #fff; margin-bottom: 6px;
        }
        .page-title em {
            font-style: normal;
            background: linear-gradient(130deg, #6c63ff, #c084fc);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .page-sub {
            font-size: 12px; color: rgba(255,255,255,0.28);
            max-width: 380px; line-height: 1.5; margin-bottom: 20px;
        }

        /* ── STAT STRIP ── */
        .stat-strip { display: flex; gap: 8px; margin-bottom: 22px; flex-wrap: wrap; }
        .stat-pill {
            padding: 8px 16px; border-radius: 8px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
        }
        .stat-pill-val {
            font-family: 'JetBrains Mono', monospace;
            font-size: 16px; font-weight: 700; color: #fff; line-height: 1;
        }
        .stat-pill-lbl { font-size: 10px; color: rgba(255,255,255,0.3); font-weight: 600; margin-top: 2px; }

        /* ── PODIUM ── */
        .podium-lbl {
            font-size: 10px; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: rgba(255,255,255,0.18);
            font-family: 'JetBrains Mono', monospace; margin-bottom: 10px;
        }
        .podium {
            display: grid; grid-template-columns: 1fr 1.12fr 1fr;
            gap: 8px; align-items: end; margin-bottom: 18px;
        }

        .p-card {
            border-radius: 16px; overflow: hidden;
            text-decoration: none; color: inherit;
            display: block; cursor: pointer;
            transition: transform .2s cubic-bezier(0.34,1.56,0.64,1);
        }
        .p-card:hover { transform: translateY(-5px); }
        .p-card.g {
            background: linear-gradient(170deg, rgba(251,191,36,0.18), rgba(251,191,36,0.06));
            border: 1px solid rgba(251,191,36,0.35);
            box-shadow: 0 0 30px rgba(251,191,36,0.08);
        }
        .p-card.s {
            background: linear-gradient(170deg, rgba(148,163,184,0.12), rgba(148,163,184,0.04));
            border: 1px solid rgba(148,163,184,0.22);
        }
        .p-card.b {
            background: linear-gradient(170deg, rgba(194,132,90,0.12), rgba(194,132,90,0.04));
            border: 1px solid rgba(194,132,90,0.22);
        }

        .p-body {
            padding: 16px 12px 0;
            display: flex; flex-direction: column; align-items: center; gap: 6px;
            position: relative;
        }

        .p-rank {
            position: absolute; top: 8px; right: 8px;
            width: 22px; height: 22px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 800; font-family: 'JetBrains Mono', monospace;
        }
        .p-card.g .p-rank { background: rgba(251,191,36,0.2); color: #fbbf24; border: 1px solid rgba(251,191,36,0.3); }
        .p-card.s .p-rank { background: rgba(148,163,184,0.15); color: #94a3b8; border: 1px solid rgba(148,163,184,0.25); }
        .p-card.b .p-rank { background: rgba(194,132,90,0.15); color: #c2845a; border: 1px solid rgba(194,132,90,0.25); }

        .p-av-wrap { position: relative; margin-top: 4px; }
        .p-crown {
            position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
            font-size: 16px; line-height: 1;
        }

        .p-av {
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 900; color: #fff; object-fit: cover;
        }
        .p-card.g .p-av { width: 60px; height: 60px; font-size: 1.5rem; border: 3px solid rgba(251,191,36,0.6); }
        .p-card.s .p-av { width: 48px; height: 48px; font-size: 1.2rem; border: 2px solid rgba(148,163,184,0.4); }
        .p-card.b .p-av { width: 44px; height: 44px; font-size: 1.1rem; border: 2px solid rgba(194,132,90,0.35); }

        .p-card.g .p-av-init { background: linear-gradient(135deg,#f59e0b,#fbbf24); }
        .p-card.s .p-av-init { background: linear-gradient(135deg,#6c63ff,#9b59f5); }
        .p-card.b .p-av-init { background: linear-gradient(135deg,#b4783c,#92400e); }

        .p-name {
            font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.7);
            text-align: center; max-width: 100px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .p-card.g .p-name { color: #fff; font-size: 13px; }

        .p-score { font-family: 'JetBrains Mono', monospace; font-weight: 700; }
        .p-card.g .p-score { font-size: 24px; color: #fbbf24; }
        .p-card.s .p-score { font-size: 18px; color: #94a3b8; }
        .p-card.b .p-score { font-size: 16px; color: #c2845a; }
        .p-score-unit { font-size: 10px; opacity: .4; }

        .p-badge {
            font-size: 9px; padding: 3px 8px; border-radius: 5px;
            font-family: 'JetBrains Mono', monospace; font-weight: 700;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.38);
            display: flex; align-items: center; gap: 4px;
        }
        .p-card.g .p-badge { color: rgba(251,191,36,0.7); border-color: rgba(251,191,36,0.22); background: rgba(251,191,36,0.08); }

        .p-base {
            width: 100%; display: flex; align-items: center; justify-content: center;
            margin-top: 12px; border-radius: 0 0 14px 14px;
        }
        .p-card.g .p-base { height: 42px; background: linear-gradient(180deg,rgba(251,191,36,0.2),rgba(251,191,36,0.05)); border-top: 1px solid rgba(251,191,36,0.28); }
        .p-card.s .p-base { height: 32px; background: linear-gradient(180deg,rgba(148,163,184,0.12),rgba(148,163,184,0.03)); border-top: 1px solid rgba(148,163,184,0.2); }
        .p-card.b .p-base { height: 26px; background: linear-gradient(180deg,rgba(194,132,90,0.12),rgba(194,132,90,0.03)); border-top: 1px solid rgba(194,132,90,0.18); }
        .p-base-lbl {
            font-size: 9px; font-family: 'JetBrains Mono', monospace;
            font-weight: 700; letter-spacing: 0.12em; color: rgba(255,255,255,0.2);
        }

        /* ── LIST CARD ── */
        .list-wrap {
            background: #0e1128;
            border: 1px solid rgba(108,99,255,0.2);
            border-radius: 16px; overflow: hidden;
        }
        .list-hdr {
            padding: 11px 16px;
            border-bottom: 1px solid rgba(108,99,255,0.12);
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,255,255,0.01);
        }
        .list-hdr-lbl {
            display: flex; align-items: center; gap: 7px;
            font-size: 10px; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: rgba(255,255,255,0.25);
            font-family: 'JetBrains Mono', monospace;
        }
        .lbl-dot {
            width: 5px; height: 5px; border-radius: 50%;
            background: rgba(108,99,255,0.7); display: inline-block;
        }
        .list-count-chip {
            font-size: 10px; padding: 2px 9px; border-radius: 5px;
            background: rgba(108,99,255,0.12); color: rgba(108,99,255,0.6);
            border: 1px solid rgba(108,99,255,0.18);
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── ROW ── */
        .lb-row {
            display: flex; align-items: center; gap: 11px;
            padding: 11px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.025);
            text-decoration: none; color: inherit;
            transition: background .12s;
            position: relative;
        }
        .lb-row:last-child { border-bottom: none; }
        .lb-row:hover { background: rgba(108,99,255,0.07); }
        .lb-row::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 2px; background: var(--acc); opacity: 0; transition: opacity .12s;
        }
        .lb-row:hover::before { opacity: 1; }
        .lb-row.top1 { background: rgba(251,191,36,0.035); }
        .lb-row.top1::before { background: #fbbf24; opacity: 0.55; }

        .rank-c { width: 26px; flex-shrink: 0; text-align: center; }
        .medal { font-size: 18px; line-height: 1; }
        .rank-n {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.2);
        }

        .row-av {
            width: 38px; height: 38px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 800; color: #fff;
            object-fit: cover;
        }
        .row-av.sq  { border-radius: 10px; }
        .row-av.cir { border-radius: 50%; }

        .row-info { flex: 1; min-width: 0; }

        .name-row { display: flex; align-items: center; gap: 7px; margin-bottom: 5px; }
        .uname {
            font-size: 13px; font-weight: 700; color: rgba(255,255,255,0.85);
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .lvl-chip {
            font-size: 9px; font-weight: 700; padding: 2px 7px; border-radius: 4px;
            font-family: 'JetBrains Mono', monospace; flex-shrink: 0;
            border: 1px solid; display: flex; align-items: center; gap: 3px;
        }

        .bar-row { display: flex; align-items: center; gap: 7px; margin-bottom: 4px; }
        .bar-track {
            flex: 1; height: 3px; border-radius: 99px;
            background: rgba(255,255,255,0.05); overflow: hidden;
        }
        .bar-fill { height: 100%; border-radius: 99px; }
        .bar-pct {
            font-size: 9px; font-family: 'JetBrains Mono', monospace;
            color: rgba(255,255,255,0.18); white-space: nowrap;
        }

        .stats-row { display: flex; gap: 10px; }
        .stat-it {
            font-size: 10px; font-family: 'JetBrains Mono', monospace;
            color: rgba(255,255,255,0.25); display: flex; align-items: center; gap: 4px;
        }
        .dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .dot-fire { background: #fb923c; }
        .dot-rec  { background: #34d399; }

        .score-c { flex-shrink: 0; text-align: right; min-width: 48px; }
        .sc-val {
            font-family: 'JetBrains Mono', monospace;
            font-size: 20px; font-weight: 700; line-height: 1; letter-spacing: -0.02em;
        }
        .sc-lbl {
            font-size: 9px; font-family: 'JetBrains Mono', monospace;
            color: rgba(255,255,255,0.2); margin-top: 2px; letter-spacing: 0.08em;
        }

        .arr {
            flex-shrink: 0; font-size: 9px; color: rgba(108,99,255,0.45);
            margin-left: 2px; opacity: 0; transition: opacity .12s;
        }
        .lb-row:hover .arr { opacity: 1; }

        /* ── EMPTY ── */
        .empty-state { padding: 52px 20px; text-align: center; color: rgba(255,255,255,0.15); }

        /* ── FOOTER ── */
        .disclaimer {
            text-align: center; margin-top: 18px;
            font-size: 10px; font-family: 'JetBrains Mono', monospace;
            color: rgba(255,255,255,0.12); line-height: 1.8;
        }
        .page-footer {
            text-align: center; margin-top: 8px;
            font-size: 11px; font-family: 'JetBrains Mono', monospace;
            color: rgba(255,255,255,0.1);
            display: flex; align-items: center; gap: 5px; justify-content: center;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
        .anim { animation: fadeUp .45s cubic-bezier(0.16,1,0.3,1) both; }
        .d1{animation-delay:.06s} .d2{animation-delay:.12s} .d3{animation-delay:.18s}
        @keyframes rowIn { from{opacity:0;transform:translateX(-10px)} to{opacity:1;transform:translateX(0)} }
        .row-anim { animation: rowIn .35s cubic-bezier(0.16,1,0.3,1) both; }
    </style>
</head>
<body>
<div class="bg-glow"></div>
<div class="page">

    {{-- BACK --}}
    <a href="/" class="back-nav anim">
        <i class="fa-solid fa-arrow-left" style="font-size:9px"></i> nexfi.app
    </a>

    {{-- HEADER --}}
    <div class="anim d1">
        <div class="live-pill"><span class="live-dot"></span>LIVE · UPDATE HARIAN</div>
        <h1 class="page-title">Top <em>Players</em></h1>
        <p class="page-sub">Ranking dari konsistensi & kebiasaan keuangan — bukan seberapa banyak duitnya.</p>

        <div class="stat-strip">
            <div class="stat-pill">
                <div class="stat-pill-val">{{ $ranked->count() }}</div>
                <div class="stat-pill-lbl">On Leaderboard</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill-val">{{ $totalUsers }}</div>
                <div class="stat-pill-lbl">Total Users</div>
            </div>
            @if($ranked->count() > 0)
            <div class="stat-pill">
                <div class="stat-pill-val" style="color:#fbbf24">{{ $ranked->first()['skor']['total'] }}</div>
                <div class="stat-pill-lbl">Top Score</div>
            </div>
            <div class="stat-pill">
                <div class="stat-pill-val" style="color:#fb923c">{{ $ranked->max(fn($r) => $r['skor']['streak']) }}d</div>
                <div class="stat-pill-lbl">Streak Terpanjang</div>
            </div>
            @endif
        </div>
    </div>

    {{-- PODIUM --}}
    @if($ranked->count() >= 3)
    @php $p1=$ranked[0]; $p2=$ranked[1]; $p3=$ranked[2]; @endphp
    <div class="anim d2">
        <div class="podium-lbl">// podium</div>
        <div class="podium">

            {{-- 2nd --}}
            <a href="/user/{{ $p2['user']->username }}" class="p-card s">
                <div class="p-body">
                    <span class="p-rank">2</span>
                    <div class="p-av-wrap">
                        @if($p2['user']->photo)
                            <img class="p-av" style="width:48px;height:48px;border:2px solid rgba(148,163,184,0.4)" src="{{ asset('assets_public/'.$p2['user']->photo) }}" alt="">
                        @else
                            <div class="p-av p-av-init" style="width:48px;height:48px;font-size:1.2rem;border:2px solid rgba(148,163,184,0.4);background:linear-gradient(135deg,#6c63ff,#9b59f5)">{{ strtoupper(substr($p2['user']->name,0,1)) }}</div>
                        @endif
                    </div>
                    <div class="p-name">{{ $p2['user']->name }}</div>
                    <div class="p-score">{{ $p2['skor']['total'] }}<span class="p-score-unit">pt</span></div>
                    <div class="p-badge">{{ $p2['skor']['badge'] }} {{ $p2['skor']['level'] }}</div>
                </div>
                <div class="p-base"><span class="p-base-lbl">SILVER</span></div>
            </a>

            {{-- 1st --}}
            <a href="/user/{{ $p1['user']->username }}" class="p-card g">
                <div class="p-body">
                    <span class="p-rank">1</span>
                    <div class="p-av-wrap">
                        <span class="p-crown">👑</span>
                        @if($p1['user']->photo)
                            <img class="p-av" style="width:60px;height:60px;border:3px solid rgba(251,191,36,0.6)" src="{{ asset('assets_public/'.$p1['user']->photo) }}" alt="">
                        @else
                            <div class="p-av p-av-init" style="width:60px;height:60px;font-size:1.5rem;border:3px solid rgba(251,191,36,0.6);background:linear-gradient(135deg,#f59e0b,#fbbf24)">{{ strtoupper(substr($p1['user']->name,0,1)) }}</div>
                        @endif
                    </div>
                    <div class="p-name">{{ $p1['user']->name }}</div>
                    <div class="p-score">{{ $p1['skor']['total'] }}<span class="p-score-unit">pt</span></div>
                    <div class="p-badge">{{ $p1['skor']['badge'] }} {{ $p1['skor']['level'] }}</div>
                </div>
                <div class="p-base"><span class="p-base-lbl">GOLD</span></div>
            </a>

            {{-- 3rd --}}
            <a href="/user/{{ $p3['user']->username }}" class="p-card b">
                <div class="p-body">
                    <span class="p-rank">3</span>
                    <div class="p-av-wrap">
                        @if($p3['user']->photo)
                            <img class="p-av" style="width:44px;height:44px;border:2px solid rgba(194,132,90,0.35)" src="{{ asset('assets_public/'.$p3['user']->photo) }}" alt="">
                        @else
                            <div class="p-av p-av-init" style="width:44px;height:44px;font-size:1.1rem;border:2px solid rgba(194,132,90,0.35);background:linear-gradient(135deg,#b4783c,#92400e)">{{ strtoupper(substr($p3['user']->name,0,1)) }}</div>
                        @endif
                    </div>
                    <div class="p-name">{{ $p3['user']->name }}</div>
                    <div class="p-score">{{ $p3['skor']['total'] }}<span class="p-score-unit">pt</span></div>
                    <div class="p-badge">{{ $p3['skor']['badge'] }} {{ $p3['skor']['level'] }}</div>
                </div>
                <div class="p-base"><span class="p-base-lbl">BRONZE</span></div>
            </a>

        </div>
    </div>
    @endif

    {{-- FULL LIST --}}
    <div class="list-wrap anim d3">
        <div class="list-hdr">
            <div class="list-hdr-lbl"><span class="lbl-dot"></span>All Players</div>
            <span class="list-count-chip">{{ $ranked->count() }} users</span>
        </div>

        @forelse($ranked as $i => $item)
        @php
            $u      = $item['user'];
            $sk     = $item['skor'];
            $rank   = $i + 1;
            $medals = [1=>'🥇', 2=>'🥈', 3=>'🥉'];
            $isTop3 = $rank <= 3;
        @endphp
        <a href="/user/{{ $u->username }}"
           class="lb-row {{ $rank===1 ? 'top1' : '' }} row-anim"
           style="animation-delay:{{ $i * 0.035 }}s">

            <div class="rank-c">
                @if(isset($medals[$rank]))
                    <span class="medal">{{ $medals[$rank] }}</span>
                @else
                    <span class="rank-n">#{{ $rank }}</span>
                @endif
            </div>

            @if($u->photo)
                <img class="row-av {{ $isTop3 ? 'cir' : 'sq' }}"
                     src="{{ asset('assets_public/'.$u->photo) }}" alt=""
                     style="background:linear-gradient(135deg,#6c63ff,#9b59f5)">
            @else
                <div class="row-av {{ $isTop3 ? 'cir' : 'sq' }}"
                     style="background:linear-gradient(135deg,#6c63ff,#9b59f5)">
                    {{ strtoupper(substr($u->name,0,1)) }}
                </div>
            @endif

            <div class="row-info">
                <div class="name-row">
                    <span class="uname">{{ $u->name }}</span>
                    <span class="lvl-chip" style="color:{{ $sk['color'] }};border-color:{{ $sk['color'] }}30;background:{{ $sk['color'] }}0d">
                        {{ $sk['badge'] }} {{ $sk['level'] }}
                    </span>
                </div>
                <div class="bar-row">
                    <div class="bar-track">
                        <div class="bar-fill" style="width:{{ $sk['total'] }}%;background:{{ $sk['color'] }}"></div>
                    </div>
                    <span class="bar-pct">{{ $sk['total'] }}/100</span>
                </div>
                <div class="stats-row">
                    <span class="stat-it">
                        <span class="dot dot-fire"></span>{{ $sk['streak'] }}d streak
                    </span>
                    <span class="stat-it">
                        <span class="dot dot-rec"></span>{{ $sk['totalTrx'] }} records
                    </span>
                </div>
            </div>

            <div class="score-c">
                <div class="sc-val" style="color:{{ $sk['color'] }}">{{ $sk['total'] }}</div>
                <div class="sc-lbl">PTS</div>
            </div>

            <i class="fa-solid fa-chevron-right arr"></i>
        </a>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-ghost" style="font-size:2rem;display:block;margin-bottom:10px;opacity:.1"></i>
            <p style="font-size:12px;font-family:'JetBrains Mono',monospace">no players yet...</p>
        </div>
        @endforelse
    </div>

    <div class="disclaimer">
        // ranking dari konsistensi & kebiasaan — bukan nominal uang<br>
        // opt-out kapan aja di pengaturan profil
    </div>
    <div class="page-footer">
        <span style="color:rgba(108,99,255,0.45);font-weight:700">NexFi</span> &mdash; Platform Keuangan #1 Indonesia
    </div>

</div>
</body>
</html>