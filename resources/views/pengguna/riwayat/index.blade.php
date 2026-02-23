@extends('layout_pengguna.pengguna')

@section('title','Riwayat')
@section('page-title','Riwayat Transaksi')

@section('content')
<style>
    /* ── FILTER ── */
    .filter-box {
        background:#10132a; border:1px solid rgba(108,99,255,0.15);
        border-radius:14px; padding:14px; margin-bottom:14px;
    }
    .filter-box form {
        display:grid; grid-template-columns:1fr 1fr; gap:10px;
    }
    @media(min-width:768px){
        .filter-box form { grid-template-columns:repeat(4,1fr) auto; }
    }
    .filter-box select,
    .filter-box input[type=date],
    .filter-box input[type=text] {
        background:rgba(255,255,255,0.05) !important;
        border:1.5px solid rgba(108,99,255,0.15) !important;
        border-radius:10px !important; padding:9px 12px !important;
        font-size:12.5px !important; color:rgba(255,255,255,0.85) !important;
        outline:none; appearance:none; -webkit-appearance:none;
        width:100%;
    }
    .filter-box select option { background:#10132a; color:#fff; }
    .filter-box select:focus,
    .filter-box input:focus {
        border-color:rgba(108,99,255,0.5) !important;
        background:rgba(108,99,255,0.07) !important;
        box-shadow:0 0 0 3px rgba(108,99,255,0.1) !important;
    }
    .filter-box button {
        grid-column:1/-1;
        background:linear-gradient(135deg,#6c63ff,#9b59f5) !important;
        color:#fff !important; border:none !important;
        border-radius:10px !important; padding:9px 18px !important;
        font-size:12.5px !important; font-weight:700 !important; cursor:pointer;
    }
    @media(min-width:768px){ .filter-box button { grid-column:auto; } }

    /* ── CARD GRID ── */
    .trx-grid {
        display:grid; grid-template-columns:1fr; gap:10px;
    }
    @media(min-width:640px)  { .trx-grid { grid-template-columns:1fr 1fr; } }
    @media(min-width:1024px) { .trx-grid { grid-template-columns:1fr 1fr 1fr; } }

    .trx-card {
        background:#10132a; border:1px solid rgba(108,99,255,0.13);
        border-radius:13px; padding:14px; display:flex; flex-direction:column; gap:8px;
        transition:border-color 0.15s,box-shadow 0.15s;
    }
    .trx-card:hover { border-color:rgba(108,99,255,0.3); box-shadow:0 4px 20px rgba(108,99,255,0.1); }

    /* header row */
    .trx-header { display:flex; justify-content:space-between; align-items:flex-start; gap:8px; }
    .trx-nama { font-size:13.5px; font-weight:700; color:#fff; }

    /* badge tipe */
    .trx-badge {
        font-size:10px; font-weight:700; padding:3px 8px; border-radius:6px;
        flex-shrink:0; white-space:nowrap;
    }
    .trx-badge.pemasukan  { background:rgba(34,197,94,0.12); color:#4ade80; border:1px solid rgba(34,197,94,0.2); }
    .trx-badge.pengeluaran{ background:rgba(239,68,68,0.1);  color:#f87171; border:1px solid rgba(239,68,68,0.2);  }

    /* detail rows */
    .trx-detail { font-size:11.5px; color:rgba(255,255,255,0.35); }

    /* nominal */
    .trx-nominal { font-size:18px; font-weight:800; }
    .trx-nominal.pemasukan  { color:#4ade80; }
    .trx-nominal.pengeluaran{ color:#f87171; }

    /* foto */
    .trx-foto {
        width:100%; height:110px; object-fit:cover;
        border-radius:9px; border:1px solid rgba(108,99,255,0.15);
        cursor:pointer; margin-top:2px;
    }

    /* aksi */
    .trx-aksi { display:flex; gap:7px; margin-top:4px; }
    .btn-edit-trx {
        padding:5px 12px; border-radius:8px; font-size:11.5px; font-weight:600;
        background:rgba(251,191,36,0.1); color:#fbbf24;
        border:1px solid rgba(251,191,36,0.2); text-decoration:none;
    }
    .btn-del-trx {
        padding:5px 12px; border-radius:8px; font-size:11.5px; font-weight:600;
        background:rgba(239,68,68,0.08); color:#f87171;
        border:1px solid rgba(239,68,68,0.18); cursor:pointer;
    }

    /* empty */
    .trx-empty {
        grid-column:1/-1; text-align:center; padding:48px;
        background:#10132a; border:1px solid rgba(108,99,255,0.1);
        border-radius:14px; color:rgba(255,255,255,0.3); font-size:13px;
    }

    /* modal */
    #modalFoto {
        display:none; position:fixed; inset:0;
        background:rgba(4,5,12,0.92); z-index:999;
        align-items:center; justify-content:center; backdrop-filter:blur(8px);
    }
    #modalFoto.open { display:flex; }
    #modalImg { max-width:90vw; max-height:80vh; border-radius:14px; }
    #modalFoto .close-btn {
        position:fixed; top:20px; right:20px;
        width:36px; height:36px; border-radius:50%;
        background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15);
        color:#fff; font-size:16px; cursor:pointer;
        display:flex; align-items:center; justify-content:center;
    }
</style>

<div>
    {{-- FILTER --}}
    <div class="filter-box">
        <form method="GET">
            <select name="tipe">
                <option value="">Semua Tipe</option>
                <option value="pemasukan"   {{ request('tipe')=='pemasukan'   ?'selected':'' }}>Pemasukan</option>
                <option value="pengeluaran" {{ request('tipe')=='pengeluaran' ?'selected':'' }}>Pengeluaran</option>
            </select>

            <select name="category_id">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id ?'selected':'' }}>
                        {{ $cat->nama }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="tanggal" value="{{ request('tanggal') }}">

            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama transaksi...">

            <button type="submit">Filter</button>
        </form>
    </div>

    {{-- CARD LIST --}}
    <div class="trx-grid">
        @forelse($transactions as $trx)
        <div class="trx-card">

            <div class="trx-header">
                <div class="trx-nama">{{ $trx->nama }}</div>
                <span class="trx-badge {{ $trx->tipe }}">{{ ucfirst($trx->tipe) }}</span>
            </div>

            <div class="trx-detail">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</div>

            <div class="trx-detail">Kategori: {{ $trx->category->nama ?? '-' }}</div>

            <div class="trx-nominal {{ $trx->tipe }}">
                Rp {{ number_format($trx->nominal,0,',','.') }}
            </div>

            @if($trx->foto)
                <button onclick="openModal('{{ asset('storage/'.$trx->foto) }}')"
                        style="display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:8px;font-size:11.5px;font-weight:600;color:#a78bfa;background:rgba(108,99,255,0.1);border:1px solid rgba(108,99,255,0.2);cursor:pointer;">
                    🖼 Lihat Foto
                </button>
            @else
                <span style="font-size:11.5px;color:rgba(255,255,255,0.2);font-style:italic;">Tidak ada foto</span>
            @endif

            <div class="trx-aksi">
                <a href="{{ route('pengguna.keuangan.edit',$trx->id) }}" class="btn-edit-trx">Edit</a>

                <form method="POST" action="{{ route('pengguna.riwayat.destroy',$trx->id) }}" style="margin:0;">
                    @csrf @method('DELETE')
                    <button class="btn-del-trx" onclick="return confirm('Hapus data?')">Hapus</button>
                </form>
            </div>

        </div>
        @empty
        <div class="trx-empty">Tidak ada data</div>
        @endforelse
    </div>
</div>

{{-- MODAL FOTO --}}
<div id="modalFoto" onclick="closeModal()">
    <button class="close-btn" onclick="closeModal()">✕</button>
    <img id="modalImg" src="" alt="">
</div>

<script>
function openModal(src){
    document.getElementById('modalImg').src = src;
    document.getElementById('modalFoto').classList.add('open');
}
function closeModal(){
    document.getElementById('modalFoto').classList.remove('open');
}
document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal(); });
</script>

@endsection