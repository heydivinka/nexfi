{{-- NexFi Sidebar --}}

<div id="sb-overlay" onclick="closeSidebar()"
     style="display:none;position:fixed;inset:0;background:rgba(8,10,24,0.7);z-index:40;"></div>

<aside id="nexfi-sidebar"
       style="position:fixed;top:0;left:0;bottom:0;width:256px;z-index:45;display:flex;flex-direction:column;background:#10132a;border-right:1px solid rgba(108,99,255,0.15);transform:translateX(-100%);overflow:hidden;font-family:'Plus Jakarta Sans',sans-serif;">

    <div style="padding:18px 16px 14px;border-bottom:1px solid rgba(255,255,255,0.05);flex-shrink:0;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:32px;height:32px;border-radius:10px;background:linear-gradient(135deg,#6c63ff,#9b59f5);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <div style="font-size:17px;font-weight:800;color:white;letter-spacing:-0.5px;line-height:1;">
                    Nex<span style="background:linear-gradient(135deg,#a78bfa,#9b59f5);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Fi</span>
                </div>
                <div style="font-size:9.5px;color:rgba(255,255,255,0.22);margin-top:1px;">Management System</div>
            </div>
        </div>
    </div>

    <nav style="flex:1;padding:10px 8px;display:flex;flex-direction:column;gap:2px;overflow-y:auto;">
        <a href="{{ route('pengguna.dashboard') }}" class="snav {{ request()->routeIs('pengguna.dashboard') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.dashboard') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>
                </svg>
            </span>
            <span class="slabel">Dashboard</span>
            @if(request()->routeIs('pengguna.dashboard'))<span class="spip"></span>@endif
        </a>
        <a href="#" class="snav {{ request()->routeIs('pengguna.kelola*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.kelola*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10"/>
                    <circle cx="18" cy="16" r="3"/>
                </svg>
            </span>
            <span class="slabel">Kelola Data</span>
            @if(request()->routeIs('pengguna.kelola*'))<span class="spip"></span>@endif
        </a>
        <a href="#" class="snav {{ request()->routeIs('pengguna.riwayat*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.riwayat*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            <span class="slabel">Riwayat</span>
            @if(request()->routeIs('pengguna.riwayat*'))<span class="spip"></span>@endif
        </a>
        <a href="#" class="snav {{ request()->routeIs('pengguna.kategori*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.kategori*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </span>
            <span class="slabel">Kategori</span>
            @if(request()->routeIs('pengguna.kategori*'))<span class="spip"></span>@endif
        </a>
        <a href="#" class="snav {{ request()->routeIs('pengguna.laporan*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.laporan*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </span>
            <span class="slabel">Laporan</span>
            @if(request()->routeIs('pengguna.laporan*'))<span class="spip"></span>@endif
        </a>
    </nav>

    <div style="padding:8px;border-top:1px solid rgba(255,255,255,0.05);flex-shrink:0;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sb-logout">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    .snav{display:flex;align-items:center;gap:8px;padding:8px 10px;border-radius:10px;color:rgba(255,255,255,0.38);font-size:12.5px;font-weight:500;text-decoration:none;border:1px solid transparent;font-family:'Plus Jakarta Sans',sans-serif;}
    .snav:hover{color:rgba(255,255,255,0.75);background:rgba(255,255,255,0.05);}
    .snav-on{color:#fff;background:linear-gradient(135deg,rgba(108,99,255,0.2),rgba(155,89,245,0.12));border-color:rgba(108,99,255,0.25);}
    .sicon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:rgba(255,255,255,0.04);color:rgba(255,255,255,0.35);}
    .sicon-on{background:linear-gradient(135deg,rgba(108,99,255,0.35),rgba(155,89,245,0.25));color:#c4b5fd;}
    .slabel{flex:1;}
    .spip{width:5px;height:5px;border-radius:50%;background:#6c63ff;flex-shrink:0;}
    .sb-logout{width:100%;display:flex;align-items:center;justify-content:center;gap:7px;padding:8px;border-radius:10px;font-size:12px;font-weight:600;color:rgba(252,129,129,0.9);background:rgba(239,68,68,0.07);border:1px solid rgba(239,68,68,0.18);cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;}
    .sb-logout:hover{background:rgba(239,68,68,0.13);border-color:rgba(239,68,68,0.3);}
</style>

<script>
    const sidebar = document.getElementById('nexfi-sidebar');
    const overlay = document.getElementById('sb-overlay');
    let isOpen = false;

    function setDesktop(){
        sidebar.style.top='16px'; sidebar.style.left='16px'; sidebar.style.bottom='16px';
        sidebar.style.borderRadius='18px'; sidebar.style.border='1px solid rgba(108,99,255,0.15)';
        sidebar.style.borderRight='1px solid rgba(108,99,255,0.15)';
        sidebar.style.transform='translateX(0)';
        overlay.style.display='none';
    }
    function setMobileHide(){
        sidebar.style.top='0'; sidebar.style.left='0'; sidebar.style.bottom='0';
        sidebar.style.borderRadius='0'; sidebar.style.border='none';
        sidebar.style.borderRight='1px solid rgba(108,99,255,0.15)';
        sidebar.style.transform='translateX(-100%)';
    }
    function openSidebar(){
        isOpen=true;
        sidebar.style.top='0'; sidebar.style.left='0'; sidebar.style.bottom='0';
        sidebar.style.borderRadius='0'; sidebar.style.border='none';
        sidebar.style.borderRight='1px solid rgba(108,99,255,0.15)';
        sidebar.style.transform='translateX(0)';
        overlay.style.display='block';
        document.getElementById('ico-open').style.display='none';
        document.getElementById('ico-close').style.display='block';
    }
    function closeSidebar(){
        isOpen=false; setMobileHide(); overlay.style.display='none';
        document.getElementById('ico-open').style.display='block';
        document.getElementById('ico-close').style.display='none';
    }
    function toggleSidebar(){ isOpen ? closeSidebar() : openSidebar(); }
    function checkBp(){ window.innerWidth>=1024 ? setDesktop() : (!isOpen && setMobileHide()); }
    checkBp();
    window.addEventListener('resize', checkBp);
</script>