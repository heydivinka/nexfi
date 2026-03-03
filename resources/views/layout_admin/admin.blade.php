{{-- resources/views/layout_admin/admin.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXFI Admin — @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    @vite('resources/css/app.css')

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    {{-- Alpine JS --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .nexfi-logo {
            background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 60%, #60A5FA 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar link states */
        .sidebar-link { position: relative; }
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px; height: 55%;
            border-radius: 0 4px 4px 0;
            background: #1D4ED8;
            transition: transform 0.2s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-link:hover::before,
        .sidebar-link.active::before { transform: translateY(-50%) scaleY(1); }

        .sidebar-link.active {
            background: #EFF6FF;
            color: #1D4ED8 !important;
        }
        .sidebar-link:hover:not(.active) { background: #F8FAFF; color: #1D4ED8; }

        .sidebar-link.active .sidebar-icon { background: rgba(59,130,246,0.15); color: #1D4ED8; }
        .sidebar-link:hover .sidebar-icon { background: rgba(59,130,246,0.1); color: #1D4ED8; }

        /* Logout */
        .sidebar-logout:hover { background: #FFF5F5; color: #DC2626; }
        .sidebar-logout:hover .sidebar-icon { background: rgba(220,38,38,0.1); color: #DC2626; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 99px; }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 antialiased">

<div x-data="{ open: false }" class="flex h-screen overflow-hidden">

    {{-- Overlay mobile --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-20 md:hidden"
        style="display:none;"
    ></div>

    {{-- Sidebar --}}
    <x-admin.sidebar />

    {{-- Main area --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">

        {{-- Navbar --}}
        <x-admin.navbar />

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-4 md:p-6">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')
</body>
</html>