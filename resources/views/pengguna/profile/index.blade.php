@extends('layout_pengguna.pengguna')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white shadow-xl rounded-2xl p-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Profile Saya
    </h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- FOTO --}}
    <div class="flex justify-center mb-6">
        @if($user->photo)
    <img src="{{ asset('profile/'.$user->photo) }}"
         width="120"
         style="border-radius:50%;">
@endif
    </div>

    <div class="space-y-4">

        <div>
            <label class="text-gray-500 text-sm">Nama</label>
            <p class="font-semibold">{{ auth()->user()->name }}</p>
        </div>

        <div>
            <label class="text-gray-500 text-sm">Username</label>
            <p class="font-semibold">{{ auth()->user()->username }}</p>
        </div>

        <div>
            <label class="text-gray-500 text-sm">Email</label>
            <p class="font-semibold">{{ auth()->user()->email }}</p>
        </div>

        <div>
            <label class="text-gray-500 text-sm">No Telepon</label>
            <p class="font-semibold">{{ auth()->user()->no_telp }}</p>
        </div>

    </div>

    <a href="{{ route('pengguna.profile.edit') }}"
        class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
        Edit Profile
    </a>

    {{-- LINK PROFILE --}}
<div class="mt-8 text-center">

    <label class="text-gray-500 text-sm">Link Profile</label>

    <p class="font-semibold text-blue-600 break-all">
        {{ url('/user/'.$user->username) }}
    </p>

</div>

{{-- QR CODE --}}
<div class="flex justify-center mt-4">

    {!! QrCode::size(150)->generate(url('/user/'.$user->username)) !!}

</div>

<a href="{{ route('profile.public', auth()->user()->username) }}"
   target="_blank">
   Lihat Profile Publik
</a>

</div>

@endsection