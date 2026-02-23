@extends('layouts.public')

@section('title','Guest')
@section('page-title','Guest')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    

    <div class="text-center">

        <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/100' }}"
             class="w-28 h-28 rounded-full mx-auto mb-3">

        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
        <p class="text-gray-500">@{{ $user->username }}</p>

    </div>

    <div class="grid grid-cols-3 gap-4 mt-6 text-center">

        <div class="bg-green-100 p-4 rounded">
            <p class="font-bold">Rp 2.000.000</p>
            <p>Pemasukan</p>
        </div>

        <div class="bg-red-100 p-4 rounded">
            <p class="font-bold">Rp 1.200.000</p>
            <p>Pengeluaran</p>
        </div>

        <div class="bg-blue-100 p-4 rounded">
            <p class="font-bold">Rp 800.000</p>
            <p>Total Saldo</p>
        </div>

    </div>

    <div class="mt-6 text-center">

        @guest
            <a href="{{ route('register') }}"
               class="bg-blue-600 text-white px-6 py-2 rounded">
                Gabung Nexfi 🚀
            </a>
        @endguest

    </div>

</div>

@endsection