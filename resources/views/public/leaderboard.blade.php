@extends('layouts.public')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
    {{-- USERNAME --}}
    <div style="font-size:11px;color:rgba(148,163,184,0.5);font-family:'JetBrains Mono',monospace;margin-bottom:4px">
        {{ '@' . $u->username }}
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