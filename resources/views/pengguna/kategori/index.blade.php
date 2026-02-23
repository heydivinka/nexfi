@extends('layout_pengguna.pengguna')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')
<style>
    .kat-wrap { display:flex; flex-direction:column; gap:14px; }

    .kat-card {
        background:#10132a; border:1px solid rgba(108,99,255,0.15);
        border-radius:14px; padding:16px;
    }

    /* success */
    .alert-success {
        padding:10px 14px; border-radius:10px;
        background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.2);
        color:#4ade80; font-size:12.5px; font-weight:600;
    }

    /* form tambah */
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

    /* section title */
    .kat-title {
        font-size:12px; font-weight:700; text-transform:uppercase;
        letter-spacing:0.07em; color:rgba(255,255,255,0.3); margin-bottom:12px;
    }

    /* list item */
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
        border:1px solid rgba(239,68,68,0.18); cursor:pointer;
    }

    .kat-empty { text-align:center; padding:28px; color:rgba(255,255,255,0.25); font-size:13px; }

    /* modal */
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
    .modal-title {
        font-size:14px; font-weight:700; color:#fff; margin-bottom:16px;
    }
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
</style>

<div class="kat-wrap">

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

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
                        onclick="openEdit({{ $cat->id }}, '{{ $cat->nama }}')">
                    Edit
                </button>
                <form method="POST"
                      action="{{ route('pengguna.kategori.destroy', $cat->id) }}"
                      onsubmit="return confirm('Hapus kategori?')"
                      style="margin:0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-del-kat">Hapus</button>
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
            <input type="text" name="nama" id="editNama" class="kat-input" style="width:100%;box-sizing:border-box;" required>
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
</script>

@endsection