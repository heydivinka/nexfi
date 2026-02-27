@extends('layout_pengguna.pengguna')

@section('title', 'Kelola Data')
@section('page-title', 'Kelola Data')

@section('content')
<style>
    .kd { display:flex; flex-direction:column; gap:14px; }

    /* ── SALDO CARD ── */
    .saldo-card {
        background:#10132a; border:1px solid rgba(108,99,255,0.15);
        border-radius:14px; padding:16px;
    }
    .saldo-label {
        font-size:11.5px; font-weight:700; text-transform:uppercase;
        letter-spacing:0.07em; color:rgba(255,255,255,0.35); margin-bottom:8px; display:block;
    }
    .saldo-input {
        width:100%; background:rgba(255,255,255,0.05);
        border:1.5px solid rgba(108,99,255,0.15); border-radius:10px;
        padding:10px 14px; font-size:14px; font-weight:600;
        color:rgba(255,255,255,0.9); outline:none; transition:all 0.2s;
    }
    .saldo-input:focus {
        border-color:rgba(108,99,255,0.5);
        background:rgba(108,99,255,0.07);
        box-shadow:0 0 0 3px rgba(108,99,255,0.1);
    }
    .btn-saldo {
        margin-top:10px; padding:9px 20px; border-radius:10px; border:none;
        cursor:pointer; font-size:13px; font-weight:700; color:#fff;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        box-shadow:0 4px 14px rgba(108,99,255,0.3);
    }

    /* ── SUCCESS ALERT ── */
    .alert-success {
        padding:10px 14px; border-radius:10px;
        background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.2);
        color:#4ade80; font-size:12.5px; font-weight:600;
    }

    /* ── FORM CARD ── */
    .form-card {
        background:#10132a; border:1px solid rgba(108,99,255,0.15);
        border-radius:14px; overflow:hidden;
    }

    /* ── TABS ── */
    .tab-bar { display:flex; border-bottom:1px solid rgba(108,99,255,0.12); }
    .tab-btn-kd {
        flex:1; padding:12px; font-size:13px; font-weight:700;
        border:none; cursor:pointer; background:transparent;
        color:rgba(255,255,255,0.3); transition:all 0.2s;
        border-bottom:2px solid transparent; margin-bottom:-1px;
    }
    .tab-btn-kd.active-in  { color:#4ade80; border-bottom-color:#4ade80; }
    .tab-btn-kd.active-out { color:#f87171; border-bottom-color:#f87171; }

    /* ── FORM INNER ── */
    .form-inner { padding:16px; display:flex; flex-direction:column; gap:10px; }

    .f-label {
        font-size:11px; font-weight:700; text-transform:uppercase;
        letter-spacing:0.07em; color:rgba(255,255,255,0.3); display:block; margin-bottom:5px;
    }
    .f-input {
        width:100%; background:rgba(255,255,255,0.05);
        border:1.5px solid rgba(108,99,255,0.15); border-radius:10px;
        padding:10px 12px; font-size:13px; color:rgba(255,255,255,0.85);
        outline:none; transition:all 0.2s; appearance:none; -webkit-appearance:none;
        box-sizing:border-box;
    }
    .f-input::placeholder { color:rgba(255,255,255,0.2); }
    .f-input:focus {
        border-color:rgba(108,99,255,0.5);
        background:rgba(108,99,255,0.07);
        box-shadow:0 0 0 3px rgba(108,99,255,0.1);
    }
    .f-input option { background:#10132a; color:#fff; }

    /* file input */
    .f-file-wrap {
        border:1.5px dashed rgba(108,99,255,0.25); border-radius:10px;
        padding:12px; text-align:center; cursor:pointer;
        background:rgba(108,99,255,0.04); transition:all 0.2s;
    }
    .f-file-wrap:hover { border-color:rgba(108,99,255,0.5); background:rgba(108,99,255,0.08); }
    .f-file-wrap input[type=file] { display:none; }
    .f-file-label { font-size:12px; color:rgba(255,255,255,0.35); cursor:pointer; }
    .f-file-name  { font-size:12px; color:#a78bfa; margin-top:4px; }

    /* submit button */
    .btn-in  { background:linear-gradient(135deg,#16a34a,#22c55e); box-shadow:0 4px 14px rgba(34,197,94,0.25); }
    .btn-out { background:linear-gradient(135deg,#dc2626,#ef4444); box-shadow:0 4px 14px rgba(239,68,68,0.25); }
    .btn-submit {
        width:100%; padding:11px; border-radius:10px; border:none;
        cursor:pointer; font-size:13px; font-weight:700; color:#fff;
        margin-top:4px;
    }
</style>

<div class="kd">

    {{-- SALDO --}}
    <div class="saldo-card">
        <form method="POST" action="{{ route('pengguna.keuangan.saldo') }}">
            @csrf
            <label class="saldo-label">Uang yang anda miliki</label>
            <input type="text" name="saldo"
                   value="Rp {{ number_format(auth()->user()->saldo,0,',','.') }}"
                   class="saldo-input rupiah">
            <br>
            <button type="submit" class="btn-saldo">Simpan Saldo</button>
        </form>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- FORM CARD --}}
    <div class="form-card">

        {{-- TABS --}}
        <div class="tab-bar">
            <button id="tab-pemasukan"
                    class="tab-btn-kd active-in"
                    onclick="showTab('pemasukan', event)">
                ↑ Pemasukan
            </button>
            <button id="tab-pengeluaran"
                    class="tab-btn-kd"
                    onclick="showTab('pengeluaran', event)">
                ↓ Pengeluaran
            </button>
        </div>

        {{-- PEMASUKAN --}}
        <div id="pemasukan" class="tab-content form-inner">
            <form method="POST" action="{{ route('pengguna.keuangan.store') }}" enctype="multipart/form-data"
                  style="display:flex;flex-direction:column;gap:10px;">
                @csrf
                <input type="hidden" name="tipe" value="pemasukan">

                <div>
                    <label class="f-label">Nama Pemasukan</label>
                    <input type="text" name="nama" placeholder="Nama pemasukan" class="f-input" required>
                </div>

                <div>
                    <label class="f-label">Kategori</label>
                    <select name="category_id" class="f-input">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="f-label">Nominal</label>
                    <input type="text" name="nominal" placeholder="Rp 0" class="f-input rupiah" required>
                </div>

                <div>
                    <label class="f-label">Tanggal</label>
                    <input type="date" name="tanggal" class="f-input" required>
                </div>

                <div>
                    <label class="f-label">Foto (opsional)</label>
                    <label class="f-file-wrap">
                        <input type="file" name="foto" accept="image/*"
                               onchange="showFileName(this,'nama-foto-in')">
                        <div class="f-file-label">📎 Klik untuk upload foto</div>
                        <div class="f-file-name" id="nama-foto-in"></div>
                    </label>
                </div>

                <button type="submit" class="btn-submit btn-in">Simpan Pemasukan</button>
            </form>
        </div>

        {{-- PENGELUARAN --}}
        <div id="pengeluaran" class="tab-content form-inner" style="display:none;">
            <form method="POST" action="{{ route('pengguna.keuangan.store') }}" enctype="multipart/form-data"
                  style="display:flex;flex-direction:column;gap:10px;">
                @csrf
                <input type="hidden" name="tipe" value="pengeluaran">

                <div>
                    <label class="f-label">Nama Pengeluaran</label>
                    <input type="text" name="nama" placeholder="Nama pengeluaran" class="f-input" required>
                </div>

                <div>
                    <label class="f-label">Kategori</label>
                    <select name="category_id" class="f-input">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="f-label">Nominal</label>
                    <input type="text" name="nominal" placeholder="Rp 0" class="f-input rupiah" required>
                </div>

                <div>
                    <label class="f-label">Tanggal</label>
                    <input type="date" name="tanggal" class="f-input" required>
                </div>

                <div>
                    <label class="f-label">Foto (opsional)</label>
                    <label class="f-file-wrap">
                        <input type="file" name="foto" accept="image/*"
                               onchange="showFileName(this,'nama-foto-out')">
                        <div class="f-file-label">📎 Klik untuk upload foto</div>
                        <div class="f-file-name" id="nama-foto-out"></div>
                    </label>
                </div>

                <button type="submit" class="btn-submit btn-out">Simpan Pengeluaran</button>
            </form>
        </div>

    </div>
</div>

<script>
function showTab(tab, event) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.getElementById(tab).style.display = 'flex';

    document.querySelectorAll('.tab-btn-kd').forEach(btn => {
        btn.classList.remove('active-in','active-out');
    });
    if(tab === 'pemasukan')  event.target.classList.add('active-in');
    if(tab === 'pengeluaran') event.target.classList.add('active-out');
}

function showFileName(input, targetId) {
    const el = document.getElementById(targetId);
    el.textContent = input.files.length ? input.files[0].name : '';
}

document.querySelectorAll('.rupiah').forEach(input => {
    input.addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        this.value = new Intl.NumberFormat('id-ID', {
            style: 'currency', currency: 'IDR', minimumFractionDigits: 0
        }).format(value);
    });
});

// Networking call ke REST API (Checklist Wajib)
fetch('/api/transactions')
    .then(response => response.json())
    .then(data => {
        console.log('Data dari API:', data);
    })
    .catch(error => {
        console.error('Error fetch API:', error);
    });
</script>

@endsection