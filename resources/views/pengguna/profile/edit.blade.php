@extends('layout_pengguna.pengguna')

@section('title','Edit Profile')
@section('page-title','Edit Profile')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .ep-wrap {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .ep-alert {
        padding: 12px 16px; border-radius: 12px;
        background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25);
        color: #4ade80; font-size: 13px; font-weight: 600;
        display: flex; align-items: center; gap: 9px;
    }

    /* CARD */
    .ep-card {
        background: #10132a;
        border: 1px solid rgba(108,99,255,0.14);
        border-radius: 18px;
        overflow: hidden;
    }

    /* SECTION HEADER */
    .ep-sec {
        display: flex; align-items: center; gap: 10px;
        padding: 14px 20px 12px;
        border-bottom: 1px solid rgba(108,99,255,0.08);
    }
    .ep-sec-ico {
        width: 32px; height: 32px; border-radius: 9px;
        background: rgba(108,99,255,0.12); color: #a78bfa;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; flex-shrink: 0;
    }
    .ep-sec-title {
        font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.08em;
        color: rgba(255,255,255,0.35);
    }

    /* ── CARD 1: FOTO — full width, horizontal layout ── */
    .ep-foto-body {
        padding: 24px 28px;
        display: flex;
        align-items: center;
        gap: 28px;
    }
    .ep-avatar-preview { position: relative; flex-shrink: 0; }
    .ep-avatar-img {
        width: 96px; height: 96px; border-radius: 50%; object-fit: cover;
        border: 3px solid #10132a;
        box-shadow: 0 0 0 3px rgba(108,99,255,0.5), 0 8px 28px rgba(108,99,255,0.3);
        display: block;
    }
    .ep-avatar-ph {
        width: 96px; height: 96px; border-radius: 50%;
        background: linear-gradient(135deg,#6c63ff,#9b59f5);
        display: flex; align-items: center; justify-content: center;
        font-size: 2.2rem; font-weight: 800; color: #fff;
        border: 3px solid #10132a;
        box-shadow: 0 0 0 3px rgba(108,99,255,0.5), 0 8px 28px rgba(108,99,255,0.3);
    }
    .ep-avatar-badge {
        position: absolute; bottom: 3px; right: 3px;
        width: 26px; height: 26px; border-radius: 50%;
        background: linear-gradient(135deg,#6c63ff,#9b59f5);
        border: 2px solid #10132a;
        display: flex; align-items: center; justify-content: center;
        font-size: 10px; color: #fff; pointer-events: none;
        cursor: pointer;
    }
    .ep-foto-info { flex: 1; }
    .ep-foto-info-title { font-size: 14px; font-weight: 800; color: rgba(255,255,255,0.9); margin-bottom: 4px; }
    .ep-foto-info-hint  { font-size: 12px; color: rgba(255,255,255,0.25); margin-bottom: 14px; line-height: 1.6; }
    .ep-foto-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .ep-file-label {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 18px; border-radius: 10px;
        background: rgba(108,99,255,0.14); border: 1px solid rgba(108,99,255,0.3);
        color: #a78bfa; font-size: 12.5px; font-weight: 700;
        cursor: pointer; transition: all 0.2s; user-select: none;
    }
    .ep-file-label:hover { background: rgba(108,99,255,0.25); border-color: rgba(108,99,255,0.5); color: #c4b5fd; }
    .ep-file-input { display: none; }
    .ep-file-name {
        font-size: 11.5px; color: rgba(255,255,255,0.2);
        font-family: monospace; word-break: break-all;
    }

    /* ── ROW BAWAH: 2 kolom sama tinggi ── */
    .ep-bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        align-items: stretch;
    }

    /* card dalam bottom grid = flex column agar footer bisa margin-top auto */
    .ep-bottom-grid .ep-card {
        display: flex;
        flex-direction: column;
    }

    /* FORM BODY */
    .ep-form-body {
        padding: 18px 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        flex: 1; /* isi ruang tersisa dalam card */
    }

    /* FIELD */
    .ep-field { display: flex; flex-direction: column; gap: 6px; }
    .ep-label {
        font-size: 10.5px; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.07em; color: rgba(255,255,255,0.3);
        display: flex; align-items: center; gap: 6px;
    }
    .ep-label i { color: rgba(108,99,255,0.6); font-size: 10px; }
    .ep-input {
        width: 100%; padding: 11px 14px; border-radius: 11px;
        border: 1px solid rgba(108,99,255,0.15);
        background: rgba(255,255,255,0.03);
        color: rgba(255,255,255,0.88); font-size: 13.5px; font-family: inherit;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        outline: none; -webkit-appearance: none;
    }
    .ep-input::placeholder { color: rgba(255,255,255,0.15); }
    .ep-input:focus {
        border-color: rgba(108,99,255,0.5); background: rgba(108,99,255,0.06);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
    }
    .ep-input.ep-input-error { border-color: rgba(239,68,68,0.5); box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }
    .ep-err { font-size: 11px; color: #f87171; display: flex; align-items: center; gap: 5px; }
    .ep-hint { font-size: 12px; color: rgba(255,255,255,0.22); line-height: 1.6; }

    /* PASSWORD TOGGLE */
    .ep-pw-wrap { position: relative; }
    .ep-pw-wrap .ep-input { padding-right: 42px; }
    .ep-pw-toggle {
        position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer;
        color: rgba(255,255,255,0.25); font-size: 13px; padding: 4px;
        transition: color 0.2s; line-height: 1;
    }
    .ep-pw-toggle:hover { color: rgba(255,255,255,0.55); }

    /* FOOTER */
    .ep-footer {
        padding: 14px 20px 18px;
        border-top: 1px solid rgba(108,99,255,0.08);
        display: flex; align-items: center; justify-content: flex-end;
        gap: 10px; flex-wrap: wrap;
        margin-top: auto;
    }
    .btn-cancel {
        padding: 11px 20px; border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.04);
        color: rgba(255,255,255,0.4); font-size: 13px; font-weight: 700;
        text-decoration: none; cursor: pointer; transition: all 0.2s;
        font-family: inherit; display: flex; align-items: center; gap: 7px;
    }
    .btn-cancel:hover { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); border-color: rgba(255,255,255,0.15); }
    .btn-save {
        padding: 11px 24px; border-radius: 12px; border: none;
        background: linear-gradient(135deg,#6c63ff,#9b59f5); color: #fff;
        font-size: 13px; font-weight: 800; cursor: pointer;
        box-shadow: 0 4px 18px rgba(108,99,255,0.35);
        font-family: inherit; display: flex; align-items: center; gap: 8px;
        transition: opacity 0.2s, transform 0.15s;
    }
    .btn-save:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn-save:active { transform: translateY(0); }

    /* ── RESPONSIVE ── */
    @media (max-width: 700px) {
        .ep-bottom-grid { grid-template-columns: 1fr; }
        .ep-bottom-grid .ep-card { display: block; }
        .ep-form-body { flex: none; }
    }
    @media (max-width: 480px) {
        .ep-card { border-radius: 14px; }
        .ep-foto-body { flex-direction: column; align-items: flex-start; padding: 18px; gap: 16px; }
        .ep-avatar-img, .ep-avatar-ph { width: 76px; height: 76px; font-size: 1.7rem; }
        .ep-form-body { padding: 14px 16px; gap: 12px; }
        .ep-sec { padding: 12px 16px 10px; }
        .ep-footer { justify-content: stretch; }
        .btn-cancel, .btn-save { flex: 1; justify-content: center; }
    }
    @media (max-width: 360px) {
        .ep-footer { flex-direction: column; }
        .btn-cancel, .btn-save { width: 100%; }
    }
</style>

<div class="ep-wrap">

    @if(session('success'))
        <div class="ep-alert">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengguna.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ══ CARD 1: FOTO — full width ══ --}}
        <div class="ep-card">
            <div class="ep-sec">
                <div class="ep-sec-ico">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <span class="ep-sec-title">Foto Profile</span>
            </div>

            <div class="ep-foto-body">

                <div class="ep-avatar-preview">

                    {{-- FOTO --}}
                    <img id="avatarPreview"
                        class="ep-avatar-img"
                        src="{{ $user->photo ? asset('profile/' . $user->photo) : asset('default.png') }}"
                        alt="Foto Profile"
                        onerror="this.src='{{ asset('default.png') }}'">

                    {{-- PLACEHOLDER --}}
                    <div class="ep-avatar-ph"
                        id="avatarPlaceholder"
                        style="{{ $user->photo ? 'display:none;' : '' }}">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    {{-- BUTTON EDIT --}}
                    <div class="ep-avatar-badge"
                        onclick="document.getElementById('photoInput').click()">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                    
                </div>

                <div class="ep-foto-info">

                    <div class="ep-foto-info-title">
                        {{ $user->photo ? 'Ganti Foto Profile' : 'Upload Foto Profile' }}
                    </div>

                    <div class="ep-foto-info-hint">
                        Format JPG, PNG, atau GIF. Ukuran maks. 2MB.
                    </div>

                    <div class="ep-foto-actions">

                        <label class="ep-file-label" for="photoInput">
                            <i class="fa-solid fa-upload"></i>
                            {{ $user->photo ? 'Ganti Foto' : 'Pilih Foto' }}
                        </label>

                        <input class="ep-file-input"
                            type="file"
                            id="photoInput"
                            name="photo"
                            accept="image/*">

                        <span class="ep-file-name" id="fileName">
                            {{ $user->photo ? basename($user->photo) : 'Belum ada file dipilih' }}
                        </span>

                    </div>

                </div>

            </div>
        </div>

        {{-- ══ ROW BAWAH: Info Pribadi | Keamanan ══ --}}
        <div class="ep-bottom-grid">

            {{-- Info Pribadi --}}
            <div class="ep-card">
                <div class="ep-sec">
                    <div class="ep-sec-ico"><i class="fa-solid fa-user"></i></div>
                    <span class="ep-sec-title">Informasi Pribadi</span>
                </div>
                <div class="ep-form-body">
                    <div class="ep-field">
                        <label class="ep-label" for="name"><i class="fa-solid fa-id-card"></i> Nama Lengkap</label>
                        <input class="ep-input {{ $errors->has('name') ? 'ep-input-error' : '' }}"
                               type="text" id="name" name="name"
                               value="{{ old('name', $user->name) }}" placeholder="Nama lengkap kamu">
                        @error('name')<span class="ep-err"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="ep-field">
                        <label class="ep-label" for="username"><i class="fa-solid fa-at"></i> Username</label>
                        <input class="ep-input {{ $errors->has('username') ? 'ep-input-error' : '' }}"
                               type="text" id="username" name="username"
                               value="{{ old('username', $user->username) }}" placeholder="username_kamu">
                        @error('username')<span class="ep-err"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="ep-field">
                        <label class="ep-label" for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                        <input class="ep-input {{ $errors->has('email') ? 'ep-input-error' : '' }}"
                               type="email" id="email" name="email"
                               value="{{ old('email', $user->email) }}" placeholder="email@kamu.com">
                        @error('email')<span class="ep-err"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="ep-field">
                        <label class="ep-label" for="no_telp"><i class="fa-solid fa-phone"></i> No. Telepon</label>
                        <input class="ep-input {{ $errors->has('no_telp') ? 'ep-input-error' : '' }}"
                               type="text" id="no_telp" name="no_telp"
                               value="{{ old('no_telp', $user->no_telp) }}" placeholder="08xxxxxxxxxx">
                        @error('no_telp')<span class="ep-err"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Keamanan --}}
            <div class="ep-card">
                <div class="ep-sec">
                    <div class="ep-sec-ico"><i class="fa-solid fa-lock"></i></div>
                    <span class="ep-sec-title">Keamanan & Password</span>
                </div>
                <div class="ep-form-body">
                    <p class="ep-hint">Kosongkan jika tidak ingin mengubah password.</p>
                    <div class="ep-field">
                        <label class="ep-label" for="password"><i class="fa-solid fa-key"></i> Password Baru</label>
                        <div class="ep-pw-wrap">
                            <input class="ep-input {{ $errors->has('password') ? 'ep-input-error' : '' }}"
                                   type="password" id="password" name="password"
                                   placeholder="Min. 8 karakter" autocomplete="new-password">
                            <button type="button" class="ep-pw-toggle" onclick="togglePw('password','eye1')">
                                <i class="fa-solid fa-eye" id="eye1"></i>
                            </button>
                        </div>
                        @error('password')<span class="ep-err"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="ep-field">
                        <label class="ep-label" for="password_confirmation"><i class="fa-solid fa-shield-halved"></i> Konfirmasi Password</label>
                        <div class="ep-pw-wrap">
                            <input class="ep-input"
                                   type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="Ulangi password baru" autocomplete="new-password">
                            <button type="button" class="ep-pw-toggle" onclick="togglePw('password_confirmation','eye2')">
                                <i class="fa-solid fa-eye" id="eye2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="ep-footer">
                    <a href="{{ route('pengguna.profile') }}" class="btn-cancel">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

        </div>{{-- /ep-bottom-grid --}}

    </form>
</div>

<script>
// Preview foto langsung saat pilih file baru
document.getElementById('photoInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    document.getElementById('fileName').textContent = file.name;

    const reader = new FileReader();
    reader.onload = e => {
        const preview     = document.getElementById('avatarPreview');
        const placeholder = document.getElementById('avatarPlaceholder');
        preview.src           = e.target.result;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

// Toggle show/hide password
function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

@endsection