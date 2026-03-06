{{-- resources/views/components/admin/sidebar.blade.php --}}

<aside
    :class="open ? 'translate-x-0' : '-translate-x-full'"
    class="fixed md:static z-30 w-64 bg-white flex flex-col h-screen -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out border-r border-slate-100"
    style="box-shadow: 4px 0 20px rgba(29,78,216,0.07);"
>

    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center px-6 border-b border-slate-100 bg-white">
        <img src="{{ asset('assets_public/logo.png') }}"
             alt="NexFi"
             style="height:40px;width:auto;object-fit:contain;">
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto">

        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-3">Menu</p>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 font-medium text-sm transition-all duration-200 group">
            <span class="sidebar-icon w-8 h-8 flex items-center justify-center rounded-lg transition-all duration-200">
                <i class="fa-solid fa-gauge-high text-sm"></i>
            </span>
            Dashboard
        </a>

        {{-- Koran --}}
        <a href="{{ route('admin.messages.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 font-medium text-sm transition-all duration-200 group">
            <span class="sidebar-icon w-8 h-8 flex items-center justify-center rounded-lg transition-all duration-200">
                <i class="fa-solid fa-newspaper text-sm"></i>
            </span>
            Koran
        </a>

        {{-- Testimoni --}}
        <a href="{{ route('admin.testimoni.index') }}"
            class="sidebar-link {{ request()->routeIs('admin.testi*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 font-medium text-sm transition-all duration-200 group">
            <span class="sidebar-icon w-8 h-8 flex items-center justify-center rounded-lg transition-all duration-200">
                <i class="fa-solid fa-comments text-sm"></i>
            </span>
            Testimoni
        </a>

    </nav>

    {{-- Logout --}}
    <div class="px-3 pb-5">
        <div class="h-px bg-slate-100 mb-3"></div>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="button" onclick="confirmLogout()"
                class="sidebar-logout w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-500 font-medium text-sm transition-all duration-200">
                <span class="sidebar-icon w-8 h-8 flex items-center justify-center rounded-lg transition-all duration-200">
                    <i class="fa-solid fa-right-from-bracket text-sm"></i>
                </span>
                Logout
            </button>
        </form>
    </div>

</aside>

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau logout?',
        text: 'Kamu akan keluar dari sesi ini.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#e2e8f0',
        customClass: { cancelButton: 'swal-cancel-btn' }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
</script>

<style>
.swal-cancel-btn { color: #475569 !important; }
</style>