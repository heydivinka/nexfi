{{-- resources/views/components/admin/navbar.blade.php --}}

@php
    // Ambil 3 notif terbaru: gabungan Message & Testimonial
    $notifMessages = \App\Models\Message::latest()->take(3)->get()->map(function($item) {
        return [
            'type'  => 'koran',
            'label' => 'Data Koran masuk',
            'name'  => $item->nama ?? 'Anonim',
            'time'  => $item->created_at->diffForHumans(),
            'icon'  => 'fa-newspaper',
            'color' => 'bg-blue-50 text-blue-600',
        ];
    });

    $notifTestimoni = \App\Models\Testimonial::latest()->take(3)->get()->map(function($item) {
        return [
            'type'  => 'testimoni',
            'label' => 'Testimoni masuk',
            'name'  => $item->nama ?? 'Anonim',
            'time'  => $item->created_at->diffForHumans(),
            'icon'  => 'fa-comments',
            'color' => 'bg-orange-50 text-orange-500',
        ];
    });

    // Gabung, sort by waktu terbaru, ambil 3 saja
    $notifs = $notifMessages->concat($notifTestimoni)
        ->sortByDesc(fn($n) => $n['time'])
        ->take(3)
        ->values();

    $notifCount = $notifs->count();
@endphp

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
            @yield('page-subtitle', 'Selamat datang di panel admin NEXFI')
        </p>
    </div>

    {{-- Right Actions --}}
    <div class="flex items-center gap-2">

        {{-- Notification Bell --}}
        <div class="relative" id="notif-wrap">
            <button
                id="notif-btn"
                onclick="toggleNotif()"
                class="relative w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-200 transition-all duration-200">
                <i class="fa-solid fa-bell text-slate-500 text-sm"></i>
                @if($notifCount > 0)
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-600 rounded-full border-2 border-white"></span>
                @endif
            </button>

            {{-- Dropdown --}}
            <div id="notif-dropdown"
                 class="hidden absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-slate-100 z-50 overflow-hidden"
                 style="box-shadow:0 8px 32px rgba(0,0,0,0.10);">

                {{-- Header --}}
                <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                    <span class="text-sm font-bold text-slate-700">Notifikasi</span>
                    <span class="text-[10px] font-bold bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full">
                        {{ $notifCount }} terbaru
                    </span>
                </div>

                {{-- List --}}
                @if($notifCount > 0)
                    @foreach($notifs as $notif)
                    <div class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                        <div class="w-8 h-8 rounded-xl {{ $notif['color'] }} flex items-center justify-center flex-shrink-0 text-xs">
                            <i class="fa-solid {{ $notif['icon'] }}"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-slate-700 leading-tight">{{ $notif['label'] }}</p>
                            <p class="text-[11px] text-slate-400 truncate">dari {{ $notif['name'] }}</p>
                        </div>
                        <span class="text-[10px] text-slate-300 whitespace-nowrap flex-shrink-0 mt-0.5">{{ $notif['time'] }}</span>
                    </div>
                    @endforeach
                @else
                    <div class="px-4 py-6 text-center text-slate-400 text-xs">
                        <i class="fa-solid fa-bell-slash text-xl mb-2 block opacity-30"></i>
                        Belum ada notifikasi
                    </div>
                @endif

            </div>
        </div>

        {{-- Admin Avatar --}}
        <div class="flex items-center gap-2.5 pl-2 border-l border-slate-100">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-semibold text-slate-700 leading-tight">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-400">{{ Auth::user()->email }}</p>
            </div>
            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow shadow-blue-200 flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>

    </div>

</header>

<script>
function toggleNotif() {
    const dd = document.getElementById('notif-dropdown');
    dd.classList.toggle('hidden');
}

// Tutup dropdown kalau klik di luar
document.addEventListener('click', function(e) {
    const wrap = document.getElementById('notif-wrap');
    if (wrap && !wrap.contains(e.target)) {
        document.getElementById('notif-dropdown').classList.add('hidden');
    }
});
</script>