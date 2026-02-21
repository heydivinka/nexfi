{{-- NexFi Navbar --}}

<header id="nexfi-navbar"
        style="position:sticky;top:0;z-index:30;background:#10132a;border-bottom:1px solid rgba(108,99,255,0.15);padding:0 14px;height:54px;display:flex;align-items:center;justify-content:space-between;font-family:'Plus Jakarta Sans',sans-serif;flex-shrink:0;">

    <div style="display:flex;align-items:center;gap:10px;min-width:0;">

        {{-- Hamburger: hanya mobile, built-in di navbar --}}
        <button id="sb-hamburger" onclick="toggleSidebar()"
                style="width:34px;height:34px;border-radius:9px;background:rgba(255,255,255,0.06);border:1px solid rgba(108,99,255,0.2);display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;">
            <svg id="ico-open" width="16" height="16" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16"/>
            </svg>
            <svg id="ico-close" width="16" height="16" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="2" style="display:none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div style="min-width:0;">
            <h1 style="font-size:14px;font-weight:700;color:white;letter-spacing:-0.3px;margin:0;line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                @yield('page-title', 'Dashboard')
            </h1>
            <p id="nav-date" style="font-size:10px;color:rgba(255,255,255,0.25);margin:1px 0 0;">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>

    <div style="display:flex;align-items:center;gap:8px;flex-shrink:0;">

        {{-- Bell --}}
        <div style="width:32px;height:32px;border-radius:9px;background:rgba(255,255,255,0.05);border:1px solid rgba(108,99,255,0.15);display:flex;align-items:center;justify-content:center;cursor:pointer;position:relative;">
            <svg width="14" height="14" fill="none" stroke="rgba(255,255,255,0.4)" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span style="position:absolute;top:7px;right:7px;width:5px;height:5px;border-radius:50%;background:#ef4444;border:2px solid #10132a;"></span>
        </div>

        {{-- User chip --}}
        <div style="position:relative;">
            <button id="user-trigger" onclick="toggleDropdown()"
                    style="display:flex;align-items:center;gap:6px;padding:4px 8px 4px 4px;border-radius:9px;background:rgba(255,255,255,0.05);border:1px solid rgba(108,99,255,0.15);cursor:pointer;">
                <div style="width:24px;height:24px;border-radius:6px;background:linear-gradient(135deg,#6c63ff,#9b59f5);display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;color:white;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <span id="nav-uname" style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.85);white-space:nowrap;">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </span>
                <svg id="dd-chevron" width="10" height="10" fill="none" stroke="rgba(255,255,255,0.3)" viewBox="0 0 24 24" stroke-width="2.5" style="transition:transform 0.15s;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="user-dropdown"
                 style="display:none;position:absolute;top:calc(100% + 8px);right:0;width:205px;background:#10132a;border:1px solid rgba(108,99,255,0.15);border-radius:13px;overflow:hidden;z-index:100;">
                <div style="padding:11px 13px;border-bottom:1px solid rgba(108,99,255,0.1);">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#6c63ff,#9b59f5);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:white;flex-shrink:0;">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                        </div>
                        <div style="min-width:0;">
                            <p style="font-size:12px;font-weight:600;color:white;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ auth()->user()->name ?? 'Pengguna' }}</p>
                            <p style="font-size:10px;color:rgba(255,255,255,0.28);margin:1px 0 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div style="padding:5px;">
                    <a href="#" style="display:flex;align-items:center;gap:8px;padding:8px 9px;border-radius:8px;color:rgba(255,255,255,0.55);font-size:12px;font-weight:500;text-decoration:none;"
                       onmouseover="this.style.background='rgba(108,99,255,0.12)';this.style.color='white';"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.55)';">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>
                    <div style="height:1px;background:rgba(108,99,255,0.1);margin:4px 0;"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;display:flex;align-items:center;gap:8px;padding:8px 9px;border-radius:8px;color:rgba(252,129,129,0.8);font-size:12px;font-weight:500;background:transparent;border:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;text-align:left;"
                                onmouseover="this.style.background='rgba(239,68,68,0.1)';" onmouseout="this.style.background='transparent';">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="dd-overlay" onclick="closeDropdown()" style="display:none;position:fixed;inset:0;z-index:29;"></div>

<style>
    /* Desktop: sembunyikan hamburger, navbar rounded */
    @media(min-width:1024px){
        #sb-hamburger { display:none !important; }
        #nexfi-navbar { border-radius:14px; border-bottom:1px solid rgba(108,99,255,0.15) !important; margin:12px 12px 0; }
    }
    /* Mobile: nama user hilang di layar sangat kecil */
    @media(max-width:360px){ #nav-uname { display:none; } }
    @media(max-width:480px){ #nav-date { display:none; } }
</style>

<script>
    const ddEl  = document.getElementById('user-dropdown');
    const ddOvEl= document.getElementById('dd-overlay');
    const chev  = document.getElementById('dd-chevron');
    let ddOpen  = false;
    function openDropdown() { ddOpen=true; ddEl.style.display='block'; ddOvEl.style.display='block'; chev.style.transform='rotate(180deg)'; }
    function closeDropdown(){ ddOpen=false; ddEl.style.display='none';  ddOvEl.style.display='none';  chev.style.transform='rotate(0deg)'; }
    function toggleDropdown(){ ddOpen ? closeDropdown() : openDropdown(); }
</script>