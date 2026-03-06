{{-- resources/views/components/admin/navbar.blade.php --}}

@php
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

    $notifs = $notifMessages->concat($notifTestimoni)
        ->sortByDesc(fn($n) => $n['time'])
        ->take(3)
        ->values();

    $notifCount = $notifs->count();
@endphp

<header class="h-16 bg-white border-b border-slate-100 flex items-center justify-between px-4 md:px-6 gap-3 flex-shrink-0"
    style="box-shadow: 0 1px 12px rgba(0,0,0,0.04);">

    {{-- ✅ FIX: Hamburger pakai x-on:click supaya Alpine baca scope open dari parent --}}
    <button
        x-on:click="open = !open"
        class="md:hidden w-9 h-9 flex flex-col gap-[5px] items-center justify-center rounded-xl hover:bg-blue-50 transition-colors duration-200 flex-shrink-0"
        aria-label="Toggle menu">
        <span class="block w-5 h-0.5 bg-slate-600 rounded-full transition-all duration-300"
              :class="open ? 'translate-y-[7px] rotate-45' : ''"></span>
        <span class="block w-5 h-0.5 bg-slate-600 rounded-full transition-all duration-300"
              :class="open ? 'opacity-0 scale-x-0' : ''"></span>
        <span class="block w-5 h-0.5 bg-slate-600 rounded-full transition-all duration-300"
              :class="open ? '-translate-y-[7px] -rotate-45' : ''"></span>
    </button>

    {{-- Page Title --}}
    <div class="flex-1 min-w-0">
        <h2 class="text-slate-800 font-bold text-sm md:text-base leading-tight truncate">
            @yield('page-title', 'Dashboard')
        </h2>
        <p class="text-slate-400 text-xs hidden sm:block truncate">
            @yield('page-subtitle', 'Selamat datang di panel admin NEXFI')
        </p>
    </div>

    {{-- Right Actions --}}
    <div class="flex items-center gap-2 flex-shrink-0">

        {{-- Notification Bell --}}
        <div class="relative" id="notif-wrap">

            <button
                id="notif-btn"
                onclick="toggleNotif()"
                class="relative w-9 h-9 flex items-center justify-center rounded-xl border transition-all duration-200"
                aria-label="Notifikasi">
                <i class="fa-solid fa-bell text-sm" id="notif-bell-icon"></i>
                <span id="notif-dot"
                      class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full border-2 border-white {{ $notifCount > 0 ? '' : 'hidden' }}">
                </span>
            </button>

            {{-- Dropdown --}}
            <div id="notif-dropdown"
                 class="hidden absolute right-0 mt-2 bg-white rounded-2xl shadow-xl border border-slate-100 z-50 overflow-hidden
                        w-[calc(100vw-2rem)] max-w-xs sm:w-72"
                 style="box-shadow: 0 8px 32px rgba(0,0,0,0.10);">

                <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between gap-2">
                    <span class="text-sm font-bold text-slate-700">Notifikasi</span>
                    <div class="flex items-center gap-2">
                        <span id="notif-badge" class="text-[10px] font-bold px-2 py-0.5 rounded-full whitespace-nowrap"></span>
                        <button
                            id="mark-read-btn"
                            onclick="markAllRead()"
                            title="Tandai semua sudah dibaca"
                            class="w-6 h-6 flex items-center justify-center rounded-lg bg-slate-100 hover:bg-green-100 hover:text-green-600 text-slate-400 transition-all duration-200 text-xs flex-shrink-0">
                            <i class="fa-solid fa-check-double"></i>
                        </button>
                    </div>
                </div>

                <div id="notif-list">
                    @if($notifCount > 0)
                        @foreach($notifs as $i => $notif)
                        <div class="notif-item flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-all duration-200 border-b border-slate-50 last:border-0 cursor-pointer"
                             data-index="{{ $i }}"
                             onclick="markOneRead({{ $i }})">

                            <div class="w-8 h-8 rounded-xl {{ $notif['color'] }} flex items-center justify-center flex-shrink-0 text-xs mt-0.5">
                                <i class="fa-solid {{ $notif['icon'] }}"></i>
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="notif-title text-xs font-semibold text-slate-700 leading-tight">
                                    {{ $notif['label'] }}
                                </p>
                                <p class="text-[11px] text-slate-400 truncate mt-0.5">dari {{ $notif['name'] }}</p>
                                <p class="text-[10px] text-slate-300 mt-1">{{ $notif['time'] }}</p>
                            </div>

                            <div class="flex-shrink-0 mt-1">
                                <span class="notif-status-dot block w-2 h-2 bg-blue-500 rounded-full"></span>
                                <span class="notif-status-check hidden text-[11px] text-green-500">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>

                        </div>
                        @endforeach
                    @else
                        <div class="px-4 py-8 text-center text-slate-400 text-xs">
                            <i class="fa-solid fa-bell-slash text-2xl mb-2 block opacity-30"></i>
                            Belum ada notifikasi
                        </div>
                    @endif
                </div>

                <div id="notif-all-read" class="hidden px-4 py-6 text-center">
                    <div class="w-10 h-10 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-2">
                        <i class="fa-solid fa-check-double text-green-500 text-base"></i>
                    </div>
                    <p class="text-xs font-semibold text-slate-600">Semua notifikasi sudah dibaca</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Tidak ada yang terlewat 👍</p>
                </div>

            </div>
        </div>

        {{-- Admin Avatar --}}
        <div class="flex items-center gap-2 pl-2 border-l border-slate-100">
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

<style>
    #notif-btn.has-unread {
        background-color: #eff6ff;
        border-color: #93c5fd;
        animation: bell-ring 0.7s ease 0.3s both;
    }
    #notif-btn.has-unread #notif-bell-icon { color: #2563eb; }
    #notif-btn.has-unread #notif-dot { background-color: #2563eb; }
    #notif-btn.all-read { background-color: #f8fafc; border-color: #e2e8f0; }
    #notif-btn.all-read #notif-bell-icon { color: #94a3b8; }

    @keyframes bell-ring {
        0%   { transform: rotate(0deg); }
        15%  { transform: rotate(15deg); }
        30%  { transform: rotate(-12deg); }
        45%  { transform: rotate(9deg); }
        60%  { transform: rotate(-7deg); }
        75%  { transform: rotate(4deg); }
        90%  { transform: rotate(-2deg); }
        100% { transform: rotate(0deg); }
    }

    .notif-item.is-read { opacity: 0.55; }
    .notif-item.is-read .notif-title { color: #94a3b8; font-weight: 500; }
</style>

<script>
    const TOTAL_NOTIFS = {{ $notifCount }};
    const STORAGE_KEY  = 'nexfi_notif_read_v1';
    const SERVER_SIG   = '{{ md5($notifs->pluck("name")->concat($notifs->pluck("time"))->implode("|")) }}';
    const SIG_KEY      = 'nexfi_notif_sig';

    function checkForNewNotifs() {
        const savedSig = sessionStorage.getItem(SIG_KEY);
        if (savedSig !== SERVER_SIG) {
            sessionStorage.removeItem(STORAGE_KEY);
            sessionStorage.setItem(SIG_KEY, SERVER_SIG);
        }
    }

    function getReadSet() {
        try { return new Set(JSON.parse(sessionStorage.getItem(STORAGE_KEY) || '[]')); }
        catch { return new Set(); }
    }
    function saveReadSet(set) {
        sessionStorage.setItem(STORAGE_KEY, JSON.stringify([...set]));
    }

    function initBell() {
        const btn     = document.getElementById('notif-btn');
        const badge   = document.getElementById('notif-badge');
        const dot     = document.getElementById('notif-dot');
        const markBtn = document.getElementById('mark-read-btn');
        const readSet = getReadSet();
        const unread  = Math.max(0, TOTAL_NOTIFS - readSet.size);
        const base    = 'relative w-9 h-9 flex items-center justify-center rounded-xl border transition-all duration-200 ';

        if (unread > 0) {
            btn.className     = base + 'has-unread';
            dot.classList.remove('hidden');
            badge.textContent = unread + ' terbaru';
            badge.className   = 'text-[10px] font-bold px-2 py-0.5 rounded-full whitespace-nowrap bg-blue-50 text-blue-600';
            markBtn.classList.remove('hidden');
        } else {
            btn.className     = base + 'all-read';
            dot.classList.add('hidden');
            badge.textContent = 'Semua dibaca';
            badge.className   = 'text-[10px] font-bold px-2 py-0.5 rounded-full whitespace-nowrap bg-green-50 text-green-600';
            markBtn.classList.add('hidden');
        }

        document.querySelectorAll('.notif-item').forEach(el => {
            if (readSet.has(parseInt(el.dataset.index))) applyRead(el);
        });
    }

    function applyRead(el) {
        if (!el) return;
        el.classList.add('is-read');
        el.querySelector('.notif-status-dot')?.classList.add('hidden');
        el.querySelector('.notif-status-check')?.classList.remove('hidden');
    }

    function markOneRead(index) {
        const readSet = getReadSet();
        if (readSet.has(index)) return;
        readSet.add(index);
        saveReadSet(readSet);
        applyRead(document.querySelector(`.notif-item[data-index="${index}"]`));
        initBell();
        if (readSet.size >= TOTAL_NOTIFS) setTimeout(showAllReadState, 300);
    }

    function markAllRead() {
        saveReadSet(new Set([...Array(TOTAL_NOTIFS).keys()]));
        document.querySelectorAll('.notif-item').forEach(applyRead);
        initBell();
        setTimeout(showAllReadState, 300);
    }

    function showAllReadState() {
        document.getElementById('notif-list').classList.add('hidden');
        document.getElementById('notif-all-read').classList.remove('hidden');
    }

    function toggleNotif() {
        document.getElementById('notif-dropdown').classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const wrap = document.getElementById('notif-wrap');
        if (wrap && !wrap.contains(e.target)) {
            document.getElementById('notif-dropdown').classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        checkForNewNotifs();
        initBell();
    });
</script>