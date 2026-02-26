@extends('layout_pengguna.pengguna')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .prof-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:14px;
        align-items:start;
    }
    @media(max-width:767px){ .prof-grid { grid-template-columns:1fr; } }

    .p-card {
        background:#10132a;
        border:1px solid rgba(108,99,255,0.14);
        border-radius:16px;
        overflow:hidden;
    }

    /* KIRI */
    .id-banner {
        height:80px;
        background:linear-gradient(135deg,#3b2fa0,#6c63ff,#9b59f5);
        position:relative;
    }
    .id-banner::after {
        content:''; position:absolute; inset:0;
        background:repeating-linear-gradient(45deg,rgba(255,255,255,0.04) 0,rgba(255,255,255,0.04) 1px,transparent 1px,transparent 10px);
    }
    .id-body { padding:0 18px 18px; }
    .id-avatar-row { margin-top:-38px; margin-bottom:12px; }
    .id-avatar {
        width:76px; height:76px; border-radius:50%; object-fit:cover;
        border:3px solid #10132a; box-shadow:0 0 0 3px rgba(108,99,255,0.5);
    }
    .id-avatar-ph {
        width:76px; height:76px; border-radius:50%;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        display:flex; align-items:center; justify-content:center;
        font-size:1.8rem; font-weight:800; color:#fff;
        border:3px solid #10132a; box-shadow:0 0 0 3px rgba(108,99,255,0.5);
    }
    .id-name  { font-size:17px; font-weight:800; color:#fff; margin:0 0 3px; }
    .id-uname { font-size:12px; color:rgba(255,255,255,0.32); margin:0 0 14px; }
    .id-divider { height:1px; background:rgba(108,99,255,0.1); margin-bottom:14px; }

    .id-info-row {
        display:flex; align-items:center; gap:11px;
        padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.04);
    }
    .id-info-row:last-of-type { border-bottom:none; margin-bottom:14px; }
    .id-info-ico {
        width:34px; height:34px; border-radius:9px; flex-shrink:0;
        display:flex; align-items:center; justify-content:center;
        font-size:13px; color:#a78bfa; background:rgba(108,99,255,0.1);
    }
    .id-info-label { font-size:9.5px; font-weight:700; text-transform:uppercase; letter-spacing:0.07em; color:rgba(255,255,255,0.25); }
    .id-info-val   { font-size:13px; font-weight:600; color:rgba(255,255,255,0.88); margin-top:1px; word-break:break-all; }

    .btn-edit-prof {
        display:flex; align-items:center; justify-content:center; gap:8px;
        padding:11px; border-radius:12px; text-decoration:none;
        font-size:13px; font-weight:700; color:#fff;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        box-shadow:0 4px 16px rgba(108,99,255,0.3);
    }
    .btn-edit-prof:hover { opacity:0.85; }

    /* KANAN */
    .right-col { display:flex; flex-direction:column; gap:14px; }

    .sec-head {
        display:flex; align-items:center; gap:9px;
        padding:13px 16px 11px;
        border-bottom:1px solid rgba(108,99,255,0.08);
    }
    .sec-ico {
        width:30px; height:30px; border-radius:8px;
        display:flex; align-items:center; justify-content:center;
        background:rgba(108,99,255,0.12); color:#a78bfa; font-size:12px;
    }
    .sec-title { font-size:12.5px; font-weight:700; color:rgba(255,255,255,0.65); }

    /* SHARE */
    .share-body { padding:14px 16px; display:flex; flex-direction:column; gap:10px; }
    .link-box {
        display:flex; align-items:center; gap:8px;
        background:rgba(255,255,255,0.03); border:1px solid rgba(108,99,255,0.14);
        border-radius:10px; padding:9px 12px;
    }
    .link-url {
        flex:1; font-size:12px; color:#818cf8; font-family:monospace;
        white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    }
    .btn-copy {
        flex-shrink:0; padding:5px 11px; border-radius:7px; border:none; cursor:pointer;
        font-size:11px; font-weight:700; display:flex; align-items:center; gap:5px;
        color:#a78bfa; background:rgba(108,99,255,0.15); transition:all 0.2s;
    }
    .btn-copy:hover  { background:rgba(108,99,255,0.3); }
    .btn-copy.copied { color:#4ade80; background:rgba(34,197,94,0.15); }
    .btn-publik {
        display:flex; align-items:center; justify-content:center; gap:8px;
        padding:10px; border-radius:10px; text-decoration:none;
        font-size:12.5px; font-weight:600; color:rgba(255,255,255,0.5);
        background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07);
        transition:all 0.2s;
    }
    .btn-publik:hover { background:rgba(108,99,255,0.1); border-color:rgba(108,99,255,0.3); color:#fff; }

    /* QR */
    .qr-body {
        padding:20px 16px;
        display:flex; flex-direction:column; align-items:center; gap:12px;
    }
    .qr-frame {
        padding:14px; border-radius:14px; background:#fff;
        box-shadow:0 6px 28px rgba(0,0,0,0.4);
        display:inline-flex; flex-shrink:0;
        max-width:100%;
    }
    .qr-frame svg { display:block; max-width:100%; height:auto; }
    .qr-hint { font-size:11px; color:rgba(255,255,255,0.22); text-align:center; }

    /* ALERT */
    .alert-ok {
        padding:10px 14px; border-radius:11px; margin-bottom:14px;
        background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.2);
        color:#4ade80; font-size:12.5px; font-weight:600;
        display:flex; align-items:center; gap:8px;
    }
</style>

@if(session('success'))
    <div class="alert-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
@endif

<div class="prof-grid">

    {{-- KIRI --}}
    <div class="p-card">
        <div class="id-banner"></div>
        <div class="id-body">
            <div class="id-avatar-row">
                @if($user->photo)
                    <img src="{{ asset('profile/'.$user->photo) }}" class="id-avatar" alt="Foto">
                @else
                    <div class="id-avatar-ph">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                @endif
            </div>
            <p class="id-name">{{ auth()->user()->name }}</p>
            <p class="id-uname">{{ auth()->user()->username }}</p>
            <div class="id-divider"></div>
            <div class="id-info-row">
                <div class="id-info-ico"><i class="fa-solid fa-user"></i></div>
                <div><div class="id-info-label">Nama Lengkap</div><div class="id-info-val">{{ auth()->user()->name }}</div></div>
            </div>
            <div class="id-info-row">
                <div class="id-info-ico"><i class="fa-solid fa-at"></i></div>
                <div><div class="id-info-label">Username</div><div class="id-info-val">{{ auth()->user()->username }}</div></div>
            </div>
            <div class="id-info-row">
                <div class="id-info-ico"><i class="fa-solid fa-envelope"></i></div>
                <div><div class="id-info-label">Email</div><div class="id-info-val">{{ auth()->user()->email }}</div></div>
            </div>
            <div class="id-info-row">
                <div class="id-info-ico"><i class="fa-solid fa-phone"></i></div>
                <div><div class="id-info-label">No Telepon</div><div class="id-info-val">{{ auth()->user()->no_telp ?? '-' }}</div></div>
            </div>
            <a href="{{ route('pengguna.profile.edit') }}" class="btn-edit-prof">
                <i class="fa-solid fa-pen-to-square"></i> Edit Profile
            </a>
        </div>
    </div>

    {{-- KANAN --}}
    <div class="right-col">

        <div class="p-card">
            <div class="sec-head">
                <div class="sec-ico"><i class="fa-solid fa-share-nodes"></i></div>
                <span class="sec-title">Bagikan Profile</span>
            </div>
            <div class="share-body">
                <div class="link-box">
                    <span class="link-url" id="profileUrl">{{ url('/user/'.$user->username) }}</span>
                    <button class="btn-copy" id="copyBtn" onclick="copyLink()">
                        <i class="fa-solid fa-copy"></i> Salin
                    </button>
                </div>
                <a href="{{ route('profile.public', auth()->user()->username) }}" target="_blank" class="btn-publik">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Profile Publik
                </a>
            </div>
        </div>

        <div class="p-card">
            <div class="sec-head">
                <div class="sec-ico"><i class="fa-solid fa-qrcode"></i></div>
                <span class="sec-title">QR Code Profile</span>
            </div>
            <div class="qr-body">
                <div class="qr-frame">
                    {!! QrCode::size(150)->color(16,1,42)->backgroundColor(255,255,255)->generate(url('/user/'.$user->username)) !!}
                </div>
                <p class="qr-hint"><i class="fa-solid fa-circle-info" style="margin-right:4px;"></i>Scan untuk membuka profile publik</p>
            </div>
        </div>

    </div>
</div>

<script>
function copyLink() {
    const url = document.getElementById('profileUrl').textContent.trim();
    const btn = document.getElementById('copyBtn');
    navigator.clipboard.writeText(url).then(() => {
        btn.classList.add('copied');
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Disalin!';
        setTimeout(() => {
            btn.classList.remove('copied');
            btn.innerHTML = '<i class="fa-solid fa-copy"></i> Salin';
        }, 2000);
    });
}
</script>

@endsection