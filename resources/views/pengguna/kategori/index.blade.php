@extends('layout_pengguna.pengguna')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')

{{-- SweetAlert2 CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    .kat-wrap { display:flex; flex-direction:column; gap:14px; }
    .kat-card {
        background:#10132a; border:1px solid rgba(108,99,255,0.15);
        border-radius:14px; padding:16px;
    }
    .tambah-row { display:flex; gap:10px; }
    .kat-input {
        flex:1; background:rgba(255,255,255,0.05);
        border:1.5px solid rgba(108,99,255,0.15); border-radius:10px;
        padding:10px 12px; font-size:13px; color:rgba(255,255,255,0.85);
        outline:none; transition:all 0.2s; box-sizing:border-box;
    }
    .kat-input::placeholder { color:rgba(255,255,255,0.2); }
    .kat-input:focus {
        border-color:rgba(108,99,255,0.5);
        background:rgba(108,99,255,0.07);
        box-shadow:0 0 0 3px rgba(108,99,255,0.1);
    }
    .btn-tambah {
        padding:10px 18px; border-radius:10px; border:none; cursor:pointer;
        font-size:13px; font-weight:700; color:#fff; white-space:nowrap;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        box-shadow:0 4px 14px rgba(108,99,255,0.3);
    }
    .kat-title {
        font-size:12px; font-weight:700; text-transform:uppercase;
        letter-spacing:0.07em; color:rgba(255,255,255,0.3); margin-bottom:12px;
    }
    .kat-item {
        display:flex; align-items:center; justify-content:space-between; gap:10px;
        padding:11px 12px; border-radius:10px;
        border:1px solid rgba(108,99,255,0.08);
        background:rgba(255,255,255,0.02);
        transition:border-color 0.15s;
    }
    .kat-item:hover { border-color:rgba(108,99,255,0.22); }
    .kat-item + .kat-item { margin-top:6px; }
    .kat-nama { font-size:13px; font-weight:600; color:rgba(255,255,255,0.85); }
    .kat-btns { display:flex; gap:6px; flex-shrink:0; }
    .btn-edit-kat {
        padding:5px 12px; border-radius:8px; font-size:11.5px; font-weight:600;
        color:#fbbf24; background:rgba(251,191,36,0.1);
        border:1px solid rgba(251,191,36,0.2); cursor:pointer;
    }
    .btn-del-kat {
        padding:5px 12px; border-radius:8px; font-size:11.5px; font-weight:600;
        color:#f87171; background:rgba(239,68,68,0.08);
        border:1px solid rgba(239,68,68,0.18); cursor:pointer; font-family:inherit;
    }
    .kat-empty { text-align:center; padding:28px; color:rgba(255,255,255,0.25); font-size:13px; }

    /* Modal Edit */
    #editModal {
        display:none; position:fixed; inset:0;
        background:rgba(4,5,12,0.88); z-index:999;
        align-items:center; justify-content:center;
        backdrop-filter:blur(8px); padding:16px;
    }
    #editModal.open { display:flex; }
    .modal-box {
        background:#10132a; border:1px solid rgba(108,99,255,0.2);
        border-radius:16px; padding:24px; width:100%; max-width:400px;
        box-shadow:0 24px 60px rgba(0,0,0,0.6);
    }
    .modal-title { font-size:14px; font-weight:700; color:#fff; margin-bottom:16px; }
    .modal-actions { display:flex; justify-content:flex-end; gap:8px; margin-top:16px; }
    .btn-batal {
        padding:8px 16px; border-radius:9px; font-size:12.5px; font-weight:600;
        color:rgba(255,255,255,0.45); background:rgba(255,255,255,0.06);
        border:1px solid rgba(255,255,255,0.1); cursor:pointer;
    }
    .btn-update {
        padding:8px 16px; border-radius:9px; font-size:12.5px; font-weight:700;
        color:#fff; border:none; cursor:pointer;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        box-shadow:0 4px 14px rgba(108,99,255,0.3);
    }

    /* SweetAlert2 NexFi Dark Theme */
    .nexfi-swal.swal2-popup {
        background: #10132a !important;
        border: 1px solid rgba(108,99,255,0.3) !important;
        border-radius: 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(108,99,255,0.1) !important;
        padding: 2rem !important;
    }
    .nexfi-swal .swal2-title {
        color: #fff !important; font-size: 1.05rem !important;
        font-weight: 700 !important; font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .nexfi-swal .swal2-html-container {
        color: rgba(255,255,255,0.4) !important; font-size: 0.8rem !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important; line-height: 1.6 !important;
    }
    .nexfi-swal .swal2-icon.swal2-warning { border-color: rgba(239,68,68,0.35) !important; color: #f87171 !important; }
    .nexfi-swal .swal2-icon.swal2-warning .swal2-icon-content { color: #f87171 !important; }
    .nexfi-swal .swal2-icon.swal2-success { border-color: rgba(74,222,128,0.35) !important; }
    .nexfi-swal .swal2-icon.swal2-success .swal2-success-ring { border-color: rgba(74,222,128,0.25) !important; }
    .nexfi-swal .swal2-icon.swal2-success [class^=swal2-success-line] { background: #4ade80 !important; }
    .nexfi-swal .swal2-confirm {
        background: linear-gradient(135deg,rgba(239,68,68,0.85),rgba(220,38,38,0.9)) !important;
        border: 1px solid rgba(239,68,68,0.35) !important; border-radius: 9999px !important;
        font-weight: 700 !important; font-size: 0.76rem !important; padding: 8px 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: none !important; color: #fff !important;
    }
    .nexfi-swal .swal2-confirm:hover { background: linear-gradient(135deg,#ef4444,#dc2626) !important; }
    .nexfi-swal .swal2-confirm.success-btn {
        background: linear-gradient(135deg,rgba(34,197,94,0.85),rgba(22,163,74,0.9)) !important;
        border-color: rgba(34,197,94,0.35) !important;
    }
    .nexfi-swal .swal2-confirm.success-btn:hover { background: linear-gradient(135deg,#22c55e,#16a34a) !important; }
    .nexfi-swal .swal2-cancel {
        background: rgba(255,255,255,0.05) !important;
        border: 1px solid rgba(255,255,255,0.1) !important; border-radius: 9999px !important;
        font-weight: 600 !important; font-size: 0.76rem !important; padding: 8px 20px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        box-shadow: none !important; color: rgba(255,255,255,0.55) !important;
    }
    .nexfi-swal .swal2-cancel:hover { background: rgba(255,255,255,0.09) !important; color: rgba(255,255,255,0.8) !important; }
    .nexfi-swal .swal2-actions { gap: 8px !important; }
    .nexfi-swal .swal2-timer-progress-bar { background: rgba(108,99,255,0.6) !important; }
</style>

<div class="kat-wrap">

    {{-- FORM TAMBAH --}}
    <div class="kat-card">
        <div class="kat-title">Tambah Kategori</div>
        <form method="POST" action="{{ route('pengguna.kategori.store') }}">
            @csrf
            <div class="tambah-row">
                <input type="text" name="nama" placeholder="Nama kategori" class="kat-input" required>
                <button type="submit" class="btn-tambah">Tambah</button>
            </div>
        </form>
    </div>

    {{-- LIST --}}
    <div class="kat-card">
        <div class="kat-title">Daftar Kategori</div>

        @forelse($categories as $cat)
        <div class="kat-item">
            <span class="kat-nama">{{ $cat->nama }}</span>
            <div class="kat-btns">
                <button class="btn-edit-kat"
                        onclick="openEdit({{ $cat->id }}, '{{ addslashes($cat->nama) }}')">
                    Edit
                </button>
                <form method="POST"
                      action="{{ route('pengguna.kategori.destroy', $cat->id) }}"
                      style="margin:0;">
                    @csrf @method('DELETE')
                    <button type="button" class="btn-del-kat"
                            onclick="confirmHapusKat(this, '{{ addslashes($cat->nama) }}')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="kat-empty">Belum ada kategori</div>
        @endforelse

    </div>

</div>

{{-- MODAL EDIT --}}
<div id="editModal">
    <div class="modal-box">
        <div class="modal-title">Edit Kategori</div>
        <form method="POST" id="editForm">
            @csrf @method('PUT')
            <input type="text" name="nama" id="editNama" class="kat-input"
                   style="width:100%;box-sizing:border-box;" required>
            <div class="modal-actions">
                <button type="button" class="btn-batal" onclick="closeEdit()">Batal</button>
                <button type="submit" class="btn-update">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEdit(id, nama) {
    document.getElementById('editNama').value = nama;
    document.getElementById('editForm').action = "/pengguna/kategori/" + id;
    document.getElementById('editModal').classList.add('open');
}
function closeEdit() {
    document.getElementById('editModal').classList.remove('open');
}
document.getElementById('editModal').addEventListener('click', function(e) {
    if(e.target === this) closeEdit();
});
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeEdit(); });

function confirmHapusKat(btn, nama) {
    Swal.fire({
        customClass: { popup: 'nexfi-swal' },
        title: 'Hapus Kategori?',
        html: 'Kategori <strong style="color:#fff;">' + nama + '</strong> akan dihapus permanen.',
        icon: 'warning',
        iconColor: '#f87171',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        focusCancel: true,
        backdrop: 'rgba(4,5,12,0.85)',
    }).then(function(result) {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
}
</script>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        customClass: { popup: 'nexfi-swal', confirmButton: 'success-btn' },
        title: 'Berhasil!',
        html: '{{ session("success") }}',
        icon: 'success',
        iconColor: '#4ade80',
        confirmButtonText: 'Oke',
        backdrop: 'rgba(4,5,12,0.85)',
        timer: 2500,
        timerProgressBar: true,
    });
});
</script>
@endif

@endsection