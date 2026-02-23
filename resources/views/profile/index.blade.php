@extends('layout_pengguna.pengguna')

@section('title','Riwayat')
@section('page-title','Riwayat Transaksi')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">My Profile</h1>

    @if(session('success'))
        <div class="bg-green-100 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/100' }}"
                 class="w-24 h-24 rounded-full mb-2">
            <input type="file" name="photo">
        </div>

        <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2 rounded" placeholder="Nama Lengkap">

        <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2 rounded" placeholder="Email">

        <input type="text" name="phone" value="{{ $user->phone }}" class="w-full border p-2 rounded" placeholder="Nomor Telepon">

        <input type="text" name="username" value="{{ $user->username }}" class="w-full border p-2 rounded" placeholder="Username">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update Profile
        </button>

    </form>

    <hr class="my-6">

    <h2 class="text-xl font-bold mb-3">Share Profile</h2>

    <div class="flex items-center gap-6">

        {!! QrCode::size(120)->generate(route('profile.public', $user->username)) !!}

        <div>
            <input type="text"
                   value="{{ route('profile.public', $user->username) }}"
                   id="linkProfile"
                   class="border p-2 rounded w-full mb-2">

            <button onclick="copyLink()" class="bg-gray-800 text-white px-4 py-2 rounded">
                Copy Link
            </button>
        </div>

    </div>

</div>

<script>
function copyLink() {
    let copyText = document.getElementById("linkProfile");
    copyText.select();
    document.execCommand("copy");
    alert("Link copied!");
}
</script>

@endsection