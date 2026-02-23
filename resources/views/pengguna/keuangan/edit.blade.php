@extends('layout_pengguna.pengguna')

@section('title','Edit')
@section('page-title','Edit Transaksi')

@section('content')
<style>
    .edit-card {
        background:#10132a; border:1px solid rgba(108,99,255,0.15);
        border-radius:14px; padding:20px;
        display:flex; flex-direction:column; gap:14px;
        max-width:100%; width:100%;
    }
    .e-label {
        font-size:11px; font-weight:700; text-transform:uppercase;
        letter-spacing:0.07em; color:rgba(255,255,255,0.3); display:block; margin-bottom:6px;
    }
    .e-input {
        width:100%; background:rgba(255,255,255,0.05);
        border:1.5px solid rgba(108,99,255,0.15); border-radius:10px;
        padding:10px 12px; font-size:13px; color:rgba(255,255,255,0.85);
        outline:none; transition:all 0.2s; appearance:none; -webkit-appearance:none;
        box-sizing:border-box;
    }
    .e-input::placeholder { color:rgba(255,255,255,0.2); }
    .e-input:focus {
        border-color:rgba(108,99,255,0.5);
        background:rgba(108,99,255,0.07);
        box-shadow:0 0 0 3px rgba(108,99,255,0.1);
    }
    .e-input option { background:#10132a; color:#fff; }

    /* nominal dengan prefix Rp */
    .nominal-wrap { display:flex; border-radius:10px; overflow:hidden; border:1.5px solid rgba(108,99,255,0.15); transition:all 0.2s; }
    .nominal-wrap:focus-within { border-color:rgba(108,99,255,0.5); box-shadow:0 0 0 3px rgba(108,99,255,0.1); }
    .nominal-prefix {
        padding:10px 12px; font-size:13px; font-weight:700;
        color:rgba(255,255,255,0.4); background:rgba(108,99,255,0.08);
        border-right:1px solid rgba(108,99,255,0.15); white-space:nowrap;
    }
    .nominal-wrap .e-input { border:none; border-radius:0; }
    .nominal-wrap .e-input:focus { box-shadow:none; }

    /* file input */
    .e-file-wrap {
        border:1.5px dashed rgba(108,99,255,0.25); border-radius:10px;
        padding:12px; text-align:center; cursor:pointer;
        background:rgba(108,99,255,0.04); transition:all 0.2s;
    }
    .e-file-wrap:hover { border-color:rgba(108,99,255,0.5); background:rgba(108,99,255,0.08); }
    .e-file-wrap input[type=file] { display:none; }
    .e-file-text { font-size:12px; color:rgba(255,255,255,0.35); }
    .e-file-name { font-size:12px; color:#a78bfa; margin-top:4px; }

    /* foto preview existing */
    .existing-foto {
        display:flex; align-items:center; gap:10px;
        padding:8px 10px; border-radius:9px;
        background:rgba(108,99,255,0.06); border:1px solid rgba(108,99,255,0.15);
        font-size:12px; color:rgba(255,255,255,0.5);
    }

    .btn-update {
        width:100%; padding:12px; border-radius:10px; border:none;
        cursor:pointer; font-size:13px; font-weight:700; color:#fff;
        background:linear-gradient(135deg,#6c63ff,#9b59f5);
        box-shadow:0 4px 18px rgba(108,99,255,0.35);
    }
    .btn-update:hover { opacity:0.88; }
</style>

<div class="edit-card">
    <form method="POST"
          action="{{ route('pengguna.keuangan.update',$transaction->id) }}"
          enctype="multipart/form-data"
          style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">

        @csrf
        @method('PUT')

        <div style="grid-column:1/-1;">
            <label class="e-label">Nama</label>
            <input type="text" name="nama"
                   value="{{ $transaction->nama }}"
                   class="e-input">
        </div>

        <div>
            <label class="e-label">Nominal</label>
            <div class="nominal-wrap">
                <span class="nominal-prefix">Rp</span>
                <input type="text" name="nominal"
                       value="{{ $transaction->nominal }}"
                       class="e-input">
            </div>
        </div>

        <div>
            <label class="e-label">Tanggal</label>
            <input type="date" name="tanggal"
                   value="{{ $transaction->tanggal }}"
                   class="e-input">
        </div>

        <div>
            <label class="e-label">Kategori</label>
            <select name="category_id" class="e-input">
                <option value="">Tidak ada</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $transaction->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="grid-column:1/-1;">
            <label class="e-label">Foto</label>
            @if($transaction->foto)
                <div class="existing-foto" style="margin-bottom:8px;">
                    🖼 Foto saat ini:
                    <a href="{{ asset('storage/'.$transaction->foto) }}"
                       target="_blank"
                       style="color:#a78bfa;text-decoration:underline;">
                        Lihat foto
                    </a>
                </div>
            @endif
            <label class="e-file-wrap">
                <input type="file" name="foto" accept="image/*"
                       onchange="showFotoName(this)">
                <div class="e-file-text">📎 Klik untuk ganti foto</div>
                <div class="e-file-name" id="fotoName"></div>
            </label>
        </div>

        <button type="submit" class="btn-update" style="grid-column:1/-1;">Update</button>

    </form>
</div>

<script>
function showFotoName(input) {
    document.getElementById('fotoName').textContent =
        input.files.length ? input.files[0].name : '';
}
</script>

@endsection