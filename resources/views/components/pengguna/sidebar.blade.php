{{-- NexFi Sidebar --}}

<div id="sb-overlay" onclick="closeSidebar()"
     style="display:none;position:fixed;inset:0;background:rgba(8,10,24,0.7);z-index:40;"></div>

<aside id="nexfi-sidebar"
       style="position:fixed;top:0;left:0;bottom:0;width:256px;z-index:45;display:flex;flex-direction:column;background:#10132a;border-right:1px solid rgba(108,99,255,0.15);transform:translateX(-100%);overflow:hidden;font-family:'Plus Jakarta Sans',sans-serif;">

    {{-- ── LOGO ── --}}
    <div style="padding:16px;border-bottom:1px solid rgba(255,255,255,0.05);flex-shrink:0;display:flex;align-items:center;justify-content:center;">
        <img src="{{ asset('assets_public/logo.png') }}"
             alt="NexFi"
             style="height:72px;width:auto;object-fit:contain;display:block;">
    </div>

    {{-- ── NAV ── --}}
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

        <a href="{{ route('pengguna.keuangan.index') }}" class="snav {{ request()->routeIs('pengguna.keuangan*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.keuangan*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10"/>
                    <circle cx="18" cy="16" r="3"/>
                </svg>
            </span>
            <span class="slabel">Kelola Data</span>
            @if(request()->routeIs('pengguna.keuangan*'))<span class="spip"></span>@endif
        </a>

        <a href="{{ route('pengguna.riwayat.index') }}" class="snav {{ request()->routeIs('pengguna.riwayat*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.riwayat*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            <span class="slabel">Riwayat</span>
            @if(request()->routeIs('pengguna.riwayat*'))<span class="spip"></span>@endif
        </a>

        <a href="{{ route('pengguna.kategori.index') }}" class="snav {{ request()->routeIs('pengguna.kategori*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.kategori*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </span>
            <span class="slabel">Kategori</span>
            @if(request()->routeIs('pengguna.kategori*'))<span class="spip"></span>@endif
        </a>

        <a href="{{ route('pengguna.laporan.index') }}" class="snav {{ request()->routeIs('pengguna.laporan.*') ? 'snav-on' : '' }}">
            <span class="sicon {{ request()->routeIs('pengguna.laporan.*') ? 'sicon-on' : '' }}">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </span>
            <span class="slabel">Laporan</span>
            @if(request()->routeIs('pengguna.laporan.*'))<span class="spip"></span>@endif
        </a>

        <a href="javascript:void(0)" onclick="showMaintenanceAlert()" class="snav {{ request()->routeIs('pengguna.ai.*') ? 'snav-on' : '' }}" style="position: relative; overflow: hidden;">
            <div style="position: absolute; inset: 0; background: rgba(16, 19, 42, 0.4); backdrop-filter: blur(1.5px); -webkit-backdrop-filter: blur(1.5px); z-index: 1;"></div>
            <span class="sicon {{ request()->routeIs('pengguna.ai.*') ? 'sicon-on' : '' }}" style="position: relative; z-index: 2;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <rect x="3" y="8" width="18" height="13" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v6M8 2h8"/>
                    <circle cx="9" cy="14" r="1.5" fill="currentColor" stroke="none"/>
                    <circle cx="15" cy="14" r="1.5" fill="currentColor" stroke="none"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13H1M23 13h-2"/>
                </svg>
            </span>

            <span class="slabel" style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; width: 100%;">
                AI Nexfi
                <span style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 99px; border: 1px solid rgba(245, 158, 11, 0.3); text-transform: uppercase; letter-spacing: 0.03em;">Perbaikan</span>
            </span>

            @if(request()->routeIs('pengguna.ai.*'))
                <span class="spip" style="position: relative; z-index: 2;"></span>
            @endif
        </a>
    </nav>

    {{-- ── LOGOUT ── --}}
    <div style="padding:8px;border-top:1px solid rgba(255,255,255,0.05);flex-shrink:0;">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="button" class="sb-logout" onclick="confirmLogout()">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- SweetAlert2 CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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

    /* ── SweetAlert2 Dark Purple Theme ── */
    .nexfi-swal.swal2-popup {
        background: #10132a !important;
        border: 1px solid rgba(108,99,255,0.3) !important;
        border-radius: 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(108,99,255,0.1) !important;
        padding: 2rem !important;
    }
    .nexfi-swal .swal2-title {
        color: #fff !important;
        font-size: 1.1rem !important;
        font-weight: 700 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .nexfi-swal .swal2-html-container {
        color: rgba(255,255,255,0.45) !important;
        font-size: 0.82rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        line-height: 1.6 !important;
    }
    .nexfi-swal .swal2-icon.swal2-warning {
        border-color: rgba(108,99,255,0.4) !important;
        color: #c4b5fd !important;
    }
    .nexfi-swal .swal2-icon.swal2-warning .swal2-icon-content {
        color: #c4b5fd !important;
    }
    .nexfi-swal .swal2-confirm {
        background: linear-gradient(135deg, rgba(239,68,68,0.85), rgba(220,38,38,0.9)) !important;
        border: 1px solid rgba(239,68,68,0.4) !important;
        border-radius: 9999px !important;
        font-weight: 700 !important;
        font-size: 0.78rem !important;
        padding: 9px 22px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: none !important;
        color: #fff !important;
    }
    .nexfi-swal .swal2-confirm:hover {
        background: linear-gradient(135deg, rgba(239,68,68,1), rgba(220,38,38,1)) !important;
    }
    .nexfi-swal .swal2-cancel {
        background: rgba(255,255,255,0.06) !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        border-radius: 9999px !important;
        font-weight: 600 !important;
        font-size: 0.78rem !important;
        padding: 9px 22px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: none !important;
        color: rgba(255,255,255,0.6) !important;
    }
    .nexfi-swal .swal2-cancel:hover {
        background: rgba(255,255,255,0.1) !important;
        color: rgba(255,255,255,0.85) !important;
    }
    .nexfi-swal .swal2-actions {
        gap: 8px !important;
    }

    /* ===== SWEETALERT2 KUSTOM REVISI ===== */
    .swal2-container { z-index: 99999 !important; }
    .swal2-popup.nexfi-alert {
      background: linear-gradient(145deg, #0e0f20, #12132a) !important;
      border: 1px solid rgba(108,99,255,0.35) !important;
      border-radius: 24px !important;
      box-shadow: 0 0 0 1px rgba(108,99,255,0.1), 0 24px 80px rgba(0,0,0,0.6), 0 0 60px rgba(108,99,255,0.12) !important;
      font-family: 'Inter', sans-serif !important;
      padding: 36px 32px 28px !important;
    }
    .swal2-popup.nexfi-alert .swal2-title { color:#fff !important; font-family:'Inter',sans-serif !important; font-weight:800 !important; font-size:1.25rem !important; letter-spacing:-0.02em !important; margin-bottom:4px !important; }
    .swal2-popup.nexfi-alert .swal2-html-container { color:rgba(255,255,255,0.55) !important; font-family:'Inter',sans-serif !important; font-size:0.875rem !important; line-height:1.7 !important; margin-top:8px !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-success { border-color:rgba(108,99,255,0.4) !important; color:#6c63ff !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-success .swal2-success-ring { border-color:rgba(108,99,255,0.2) !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-success [class^='swal2-success-line'] { background-color:#6c63ff !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-warning { border-color:rgba(245,158,11,0.5) !important; color:#f59e0b !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-error { border-color:rgba(239,68,68,0.4) !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-error [class^='swal2-x-mark-line'] { background-color:#ef4444 !important; }
    .swal2-popup.nexfi-alert .swal2-actions { margin-top:24px !important; gap:10px !important; }
    .swal2-popup.nexfi-alert .swal2-confirm { background:linear-gradient(135deg,#6c63ff,#9b59f5) !important; border:none !important; border-radius:9999px !important; font-family:'Inter',sans-serif !important; font-weight:700 !important; font-size:0.875rem !important; padding:11px 28px !important; box-shadow:0 8px 24px rgba(108,99,255,0.4) !important; transition:opacity 0.2s,transform 0.2s !important; color: #fff !important; }
    .swal2-popup.nexfi-alert .swal2-confirm:hover { opacity:0.88 !important; transform:translateY(-1px) !important; }
    .swal2-popup.nexfi-alert .swal2-cancel { background:rgba(255,255,255,0.06) !important; border:1px solid rgba(255,255,255,0.1) !important; border-radius:9999px !important; color:rgba(255,255,255,0.5) !important; font-family:'Inter',sans-serif !important; font-weight:600 !important; font-size:0.875rem !important; padding:11px 28px !important; }
    .swal2-popup.nexfi-alert .swal2-timer-progress-bar { background:linear-gradient(90deg,#6c63ff,#9b59f5) !important; border-radius:0 0 24px 24px !important; }
    .swal2-backdrop-show { background:rgba(0,0,0,0.75) !important; backdrop-filter:blur(6px) !important; }
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

    /* ── Logout Confirmation ── */
    function confirmLogout() {
        Swal.fire({
            customClass: { popup: 'nexfi-swal' },
            title: 'Yakin mau keluar?',
            html: 'Sesi kamu akan diakhiri dan kamu perlu login ulang.',
            iconHtml: '<svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" style="color:#c4b5fd"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>',
            iconColor: '#c4b5fd',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true,
            backdrop: 'rgba(8,10,24,0.75)',
        }).then(function(result) {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    /* ── Maintenance Alert ── */
    function showMaintenanceAlert() {
        Swal.fire({
            customClass: { popup: 'nexfi-alert' },
            title: 'Sistem Sedang Maintenance',
            html: 'Fitur AI Nexfi saat ini sedang dalam pemeliharaan berkala untuk meningkatkan performa sistem. Silakan coba beberapa saat lagi.',
            icon: 'warning',
            confirmButtonText: 'Dimengerti',
            backdrop: 'rgba(0,0,0,0.75)',
            buttonsStyling: false
        });
    }
</script>