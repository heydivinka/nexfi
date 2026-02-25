@extends('layout_pengguna.pengguna')

@section('title','Edit Profile')
@section('page-title','Edit Profile')

@section('content')

<div style="max-width:800px;margin:auto;">

    <form action="{{ route('pengguna.profile.update') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')   {{-- INI WAJIB BANGET --}}

        {{-- FOTO --}}
        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">Foto Profile</label><br>

            <input type="file" name="photo" style="color:white;">
        </div>

        {{-- NAMA --}}
        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   style="width:100%;padding:8px;border-radius:6px;">
        </div>

        {{-- USERNAME --}}
        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">Username</label>
            <input type="text" name="username" value="{{ $user->username }}"
                   style="width:100%;padding:8px;border-radius:6px;">
        </div>

        {{-- EMAIL --}}
        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                   style="width:100%;padding:8px;border-radius:6px;">
        </div>

        {{-- PHONE --}}
        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">No Telepon</label>
            <input type="text" name="no_telp" value="{{ $user->no_telp }}"
                   style="width:100%;padding:8px;border-radius:6px;">
        </div>

        <hr style="border-color:#ffffff10;margin:20px 0;">

        {{-- PASSWORD --}}
        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">Password Baru</label>
            <input type="password" name="password"
                   style="width:100%;padding:8px;border-radius:6px;">
        </div>

        <div style="margin-bottom:15px;">
            <label style="color:#aaa;">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   style="width:100%;padding:8px;border-radius:6px;">
        </div>

        <button style="background:#6c63ff;color:white;padding:10px 18px;
                       border:none;border-radius:8px;">
            Simpan Perubahan
        </button>

    </form>

</div>

@endsection