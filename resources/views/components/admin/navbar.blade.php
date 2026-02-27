{{-- resources/views/components/admin/navbar.blade.php --}}

<header class="h-16 bg-white border-b border-slate-100 flex items-center justify-between px-4 md:px-6 gap-4 flex-shrink-0"
    style="box-shadow: 0 1px 12px rgba(0,0,0,0.04);">

    {{-- Hamburger (mobile) --}}
    <button
        @click="open = !open"
        class="md:hidden w-9 h-9 flex flex-col gap-[5px] items-center justify-center rounded-xl hover:bg-blue-50 transition-colors duration-200 flex-shrink-0"
        aria-label="Toggle menu"
    >
        <span class="block w-5 h-0.5 bg-slate-600 rounded-full transition-all duration-300"
              :class="open ? 'translate-y-[7px] rotate-45' : ''"></span>
        <span class="block w-5 h-0.5 bg-slate-600 rounded-full transition-all duration-300"
              :class="open ? 'opacity-0 scale-x-0' : ''"></span>
        <span class="block w-5 h-0.5 bg-slate-600 rounded-full transition-all duration-300"
              :class="open ? '-translate-y-[7px] -rotate-45' : ''"></span>
    </button>

    {{-- Page Title --}}
    <div class="flex-1">
        <h2 class="text-slate-800 font-bold text-sm md:text-base leading-tight">
            @yield('page-title', 'Dashboard')
        </h2>
        <p class="text-slate-400 text-xs hidden sm:block">
            @yield('page-subtitle', 'Selamat datang di panel admin INVEX')
        </p>
    </div>

    {{-- Right Actions --}}
    <div class="flex items-center gap-2">

        {{-- Notification Bell --}}
        <button class="relative w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-200 transition-all duration-200">
            <i class="fa-solid fa-bell text-slate-500 text-sm"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-600 rounded-full border-2 border-white"></span>
        </button>

        {{-- Admin Avatar --}}
        <div class="flex items-center gap-2.5 pl-2 border-l border-slate-100">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-semibold text-slate-700 leading-tight">Admin</p>
                <p class="text-[10px] text-slate-400">admin@invex.com</p>
            </div>
            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow shadow-blue-200 flex-shrink-0">
                A
            </div>
        </div>

    </div>

</header>