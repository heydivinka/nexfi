{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layout_admin.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data & aktivitas terkini')

@section('content')

{{-- Welcome Banner --}}
@php
    use Illuminate\Support\Facades\Auth;
    \Carbon\Carbon::setLocale('id');
@endphp

{{-- Welcome Banner --}}
<div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-700 via-blue-600 to-blue-500 p-6 mb-6 shadow-lg shadow-blue-200">
    
    {{-- Decorative circles --}}
    <div class="absolute -top-8 -right-8 w-40 h-40 rounded-full bg-white/10"></div>
    <div class="absolute top-4 -right-4 w-24 h-24 rounded-full bg-white/5"></div>

    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        <div>
            <p class="text-blue-200 text-sm font-medium mb-1">
                Selamat datang kembali 👋
            </p>

            <h1 class="text-white text-2xl font-extrabold tracking-tight">
                Halo, {{ Auth::user()->name }}
            </h1>

            <p class="text-blue-200 text-sm mt-1">
                {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>

        <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-2.5 text-center">
            <p id="liveClock" class="text-white text-xl font-extrabold leading-none">
                00:00:00
            </p>
            <p class="text-blue-200 text-[10px] font-medium mt-0.5 uppercase tracking-wider">
                WIB
            </p>
        </div>

    </div>
</div>



{{-- Stats Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

    {{-- Koran --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fa-solid fa-newspaper text-blue-600 text-sm"></i>
            </div>
            <span class="text-green-500 text-[10px] font-bold bg-green-50 px-2 py-0.5 rounded-full">+4 hari ini</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-800 leading-none">143</p>
        <p class="text-slate-400 text-xs mt-1 font-medium">Total Artikel Koran</p>
    </div>

    {{-- Testimoni --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                <i class="fa-solid fa-comments text-orange-500 text-sm"></i>
            </div>
            <span class="text-orange-500 text-[10px] font-bold bg-orange-50 px-2 py-0.5 rounded-full">5 belum dibaca</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-800 leading-none">391</p>
        <p class="text-slate-400 text-xs mt-1 font-medium">Total Testimoni</p>
    </div>

    {{-- Users (optional card, bisa dihapus) --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-200 col-span-2 lg:col-span-1">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                <i class="fa-solid fa-users text-indigo-600 text-sm"></i>
            </div>
            <span class="text-green-500 text-[10px] font-bold bg-green-50 px-2 py-0.5 rounded-full">+12%</span>
        </div>
        <p class="text-2xl font-extrabold text-slate-800 leading-none">2.847</p>
        <p class="text-slate-400 text-xs mt-1 font-medium">Total Pengguna</p>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    function updateClock() {
        const now = new Date();

        const jakartaTime = new Intl.DateTimeFormat('id-ID', {
            timeZone: 'Asia/Jakarta',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        }).format(now);

        const clockElement = document.getElementById("liveClock");
        if (clockElement) {
            clockElement.innerText = jakartaTime;
        }
    }

    updateClock();
    setInterval(updateClock, 1000);
});
</script>

@endsection