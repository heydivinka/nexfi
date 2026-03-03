{{-- NexFi Navbar --}}

<header id="nexfi-navbar"
        style="position:sticky;top:0;z-index:30;flex-shrink:0;background:#10132a;border-bottom:1px solid rgba(108,99,255,0.15);padding:0 14px;height:54px;display:flex;align-items:center;justify-content:space-between;font-family:'Plus Jakarta Sans',sans-serif;">
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


        {{-- User chip --}}
        <div style="position:relative;">
    <button id="user-trigger" onclick="toggleDropdown()"
            style="display:flex;align-items:center;gap:6px;padding:4px 8px 4px 4px;border-radius:9px;background:rgba(255,255,255,0.05);border:1px solid rgba(108,99,255,0.15);cursor:pointer;">

        @auth

        @if(auth()->user()->photo)
            <img src="{{ asset('assets_public/' . auth()->user()->photo) }}"
                style="width:24px;height:24px;border-radius:50%;object-fit:cover;">
        @else
            <div style="width:24px;height:24px;border-radius:50%;background:linear-gradient(135deg,#6c63ff,#9b59f5);display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:700;color:white;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        @endif

            <span id="nav-uname" style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.85);white-space:nowrap;">
                {{ auth()->user()->name }}
            </span>

        @endauth


        @guest

            <div style="width:24px;height:24px;border-radius:50%;background:#444;display:flex;align-items:center;justify-content:center;font-size:9px;color:white;">
                ?
            </div>

            <span style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.85);">
                Guest
            </span>

        @endguest


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
                    <a href="{{ route('pengguna.profile') }}"
                    style="display:flex;align-items:center;gap:8px;padding:8px 9px;border-radius:8px;color:rgba(255,255,255,0.55);font-size:12px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(108,99,255,0.12)';this.style.color='white';"
                    onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.55)';">

                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>

                        Profil Saya
                    </a>
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