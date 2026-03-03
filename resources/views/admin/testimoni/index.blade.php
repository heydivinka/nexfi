@extends('layout_admin.admin')

@section('title', 'Manajemen Testimoni')
@section('page-title', 'Testimoni')

@section('content')

{{-- SweetAlert2 CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
/* ===== RESET SCOPE ===== */
.testi-admin * { box-sizing: border-box; }

/* ===== CSS VARIABLES ===== */
.testi-admin {
  --ta-accent:   #2563eb;
  --ta-accent2:  #3b82f6;
  --ta-accent-s: #eff6ff;
  --ta-success:  #10b981;
  --ta-success-s:#ecfdf5;
  --ta-danger:   #ef4444;
  --ta-danger-s: #fef2f2;
  --ta-warning:  #f59e0b;
  --ta-warning-s:#fffbeb;
  --ta-gray:     #6b7280;
  --ta-border:   #e5e7eb;
  --ta-bg:       #f0f4ff;
  --ta-card:     #ffffff;
  --ta-text:     #111827;
  --ta-sub:      #6b7280;
}

/* ===== WRAPPER ===== */
.testi-admin {
  padding: 28px 28px 40px;
  background: transparent;
  min-height: 100vh;
}

/* ===== PAGE HEADER ===== */
.ta-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 24px;
}
.ta-header-left h2 {
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--ta-text);
  letter-spacing: -0.02em;
  margin: 0;
}
.ta-header-left p {
  font-size: 0.82rem;
  color: var(--ta-sub);
  margin: 3px 0 0;
}
.ta-btn-view {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 9px 18px;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 600;
  background: var(--ta-accent);
  color: #fff;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: background .2s;
  white-space: nowrap;
}
.ta-btn-view:hover { background: #1d4ed8; }

/* ===== ALERT ===== */
.ta-alert {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 13px 16px;
  border-radius: 12px;
  font-size: 0.85rem;
  font-weight: 500;
  margin-bottom: 20px;
  background: var(--ta-success-s);
  border: 1px solid #6ee7b7;
  color: var(--ta-success);
}

/* ===== STATS GRID ===== */
.ta-stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-bottom: 24px;
}
.ta-stat-card {
  background: var(--ta-card);
  border: 1px solid var(--ta-border);
  border-radius: 16px;
  padding: 18px 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.05);
  transition: box-shadow .2s, transform .2s;
}
.ta-stat-card:hover { box-shadow: 0 4px 16px rgba(37,99,235,0.1); transform: translateY(-1px); }
.ta-stat-icon {
  width: 46px;
  height: 46px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  flex-shrink: 0;
}
.ta-stat-icon.blue   { background: var(--ta-accent-s);  color: var(--ta-accent);  }
.ta-stat-icon.yellow { background: var(--ta-warning-s); color: var(--ta-warning); }
.ta-stat-icon.green  { background: var(--ta-success-s); color: var(--ta-success); }
.ta-stat-icon.red    { background: var(--ta-danger-s);  color: var(--ta-danger);  }
.ta-stat-val {
  font-size: 1.65rem;
  font-weight: 800;
  color: var(--ta-text);
  letter-spacing: -0.03em;
  line-height: 1;
}
.ta-stat-label {
  font-size: 0.75rem;
  color: var(--ta-sub);
  margin-top: 3px;
}

/* ===== FILTER TABS ===== */
.ta-filter-wrap {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 16px;
}
.ta-filter-tabs {
  display: flex;
  gap: 4px;
  background: var(--ta-card);
  border: 1px solid var(--ta-border);
  border-radius: 12px;
  padding: 5px;
  flex-wrap: wrap;
}
.ta-filter-tab {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 15px;
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--ta-sub);
  text-decoration: none;
  transition: all .18s;
  white-space: nowrap;
}
.ta-filter-tab:hover { background: var(--ta-accent-s); color: var(--ta-accent); }
.ta-filter-tab.active { background: var(--ta-accent); color: #fff; }
.ta-tab-count {
  background: rgba(255,255,255,0.25);
  border-radius: 9999px;
  padding: 1px 7px;
  font-size: 0.68rem;
}
.ta-filter-tab:not(.active) .ta-tab-count {
  background: #e5e7eb;
  color: var(--ta-text);
}
.ta-total-info {
  font-size: 0.8rem;
  color: var(--ta-sub);
  white-space: nowrap;
}

/* ===== CARD WRAPPER ===== */
.ta-card {
  background: var(--ta-card);
  border: 1px solid var(--ta-border);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

/* ===== TABLE ===== */
.ta-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.ta-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 680px;
}
.ta-table thead tr {
  background: #f8faff;
  border-bottom: 1px solid var(--ta-border);
}
.ta-table th {
  padding: 13px 16px;
  text-align: left;
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--ta-sub);
  text-transform: uppercase;
  letter-spacing: 0.07em;
  white-space: nowrap;
}
.ta-table td {
  padding: 14px 16px;
  border-bottom: 1px solid #f3f4f6;
  vertical-align: middle;
}
.ta-table tbody tr:last-child td { border-bottom: none; }
.ta-table tbody tr:hover td { background: #f8faff; }

/* ===== USER CELL ===== */
.ta-user-cell { display: flex; align-items: center; gap: 11px; }
.ta-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid var(--ta-border);
  flex-shrink: 0;
}
.ta-user-name { font-size: 0.875rem; font-weight: 700; color: var(--ta-text); }
.ta-user-email { font-size: 0.72rem; color: var(--ta-sub); margin-top: 1px; }

/* ===== STARS ===== */
.ta-stars { display: flex; gap: 2px; align-items: center; }
.ta-stars i { font-size: 0.78rem; color: var(--ta-warning); }
.ta-stars i.empty { color: #d1d5db; }
.ta-rating-num {
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--ta-sub);
  margin-left: 4px;
}

/* ===== TESTI TEXT ===== */
.ta-testi-text {
  font-size: 0.8rem;
  color: var(--ta-sub);
  font-style: italic;
  max-width: 260px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.ta-btn-preview {
  margin-top: 5px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: 0.7rem;
  font-weight: 600;
  color: var(--ta-accent);
  cursor: pointer;
  background: var(--ta-accent-s);
  border: none;
  border-radius: 6px;
  padding: 3px 9px;
  transition: background .15s;
  font-family: inherit;
}
.ta-btn-preview:hover { background: #dbeafe; }

/* ===== BADGE ===== */
.ta-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 11px;
  border-radius: 9999px;
  font-size: 0.72rem;
  font-weight: 700;
  white-space: nowrap;
}
.ta-badge.pending   { background: var(--ta-warning-s); color: #b45309; border: 1px solid #fde68a; }
.ta-badge.published { background: var(--ta-success-s); color: #065f46; border: 1px solid #6ee7b7; }
.ta-badge.rejected  { background: var(--ta-danger-s);  color: #991b1b; border: 1px solid #fca5a5; }

/* ===== DATE ===== */
.ta-date { font-size: 0.78rem; color: var(--ta-text); font-weight: 500; }
.ta-date-sub { font-size: 0.7rem; color: var(--ta-sub); margin-top: 2px; }

/* ===== ACTION BTNS ===== */
.ta-actions { display: flex; gap: 5px; flex-wrap: wrap; align-items: center; }
.ta-btn {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 6px 12px;
  border-radius: 8px;
  font-size: 0.74rem;
  font-weight: 600;
  cursor: pointer;
  border: 1px solid transparent;
  font-family: inherit;
  transition: all .15s;
  white-space: nowrap;
}
.ta-btn.publish { background: var(--ta-success-s); color: #065f46; border-color: #6ee7b7; }
.ta-btn.publish:hover { background: #d1fae5; }
.ta-btn.reject  { background: var(--ta-danger-s); color: #991b1b; border-color: #fca5a5; }
.ta-btn.reject:hover  { background: #fee2e2; }
.ta-btn.del     { background: #f9fafb; color: var(--ta-sub); border-color: var(--ta-border); }
.ta-btn.del:hover { background: var(--ta-danger-s); color: var(--ta-danger); border-color: #fca5a5; }

/* ===== EMPTY STATE ===== */
.ta-empty {
  text-align: center;
  padding: 56px 20px;
}
.ta-empty i { font-size: 2.8rem; color: #d1d5db; margin-bottom: 14px; display: block; }
.ta-empty p { color: var(--ta-sub); font-size: 0.88rem; }
.ta-empty span { color: var(--ta-accent); font-weight: 600; }

/* ===== PAGINATION ===== */
.ta-pagination {
  padding: 14px 16px;
  border-top: 1px solid #f3f4f6;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 8px;
}
.ta-pagination-info { font-size: 0.78rem; color: var(--ta-sub); }
/* Override Laravel pagination */
.ta-pagination nav { display: flex; }
.ta-pagination nav .flex { flex-wrap: wrap; gap: 3px; }
.ta-pagination nav span,
.ta-pagination nav a {
  display: inline-flex !important;
  align-items: center;
  justify-content: center;
  min-width: 34px;
  height: 34px;
  padding: 0 8px;
  border-radius: 8px;
  font-size: 0.8rem;
  font-weight: 600;
  text-decoration: none;
  transition: all .15s;
  border: 1px solid var(--ta-border);
  background: #fff;
  color: var(--ta-sub);
}
.ta-pagination nav a:hover { background: var(--ta-accent-s); color: var(--ta-accent); border-color: #bfdbfe; }
.ta-pagination nav span[aria-current] { background: var(--ta-accent); color: #fff; border-color: var(--ta-accent); }
.ta-pagination nav span.cursor-default { opacity: .4; cursor: not-allowed; }

/* ===== MODAL ===== */
.ta-modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: rgba(15,23,42,0.45);
  align-items: center;
  justify-content: center;
  padding: 16px;
  backdrop-filter: blur(4px);
}
.ta-modal-overlay.show { display: flex; }
.ta-modal-box {
  background: var(--ta-card);
  border: 1px solid var(--ta-border);
  border-radius: 20px;
  padding: 28px;
  max-width: 460px;
  width: 100%;
  position: relative;
  animation: taModalIn .22s ease;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}
@keyframes taModalIn {
  from { opacity: 0; transform: scale(.95) translateY(8px); }
  to   { opacity: 1; transform: scale(1) translateY(0); }
}
.ta-modal-close {
  position: absolute;
  top: 14px; right: 14px;
  background: #f3f4f6;
  border: none;
  color: var(--ta-sub);
  width: 32px; height: 32px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.95rem;
  display: flex; align-items: center; justify-content: center;
  transition: all .15s;
}
.ta-modal-close:hover { background: var(--ta-danger-s); color: var(--ta-danger); }
.ta-modal-head { display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
.ta-modal-body {
  background: #f8faff;
  border: 1px solid #e0e7ff;
  border-radius: 12px;
  padding: 16px 18px;
}
.ta-modal-body p {
  font-size: 0.88rem;
  line-height: 1.75;
  font-style: italic;
  color: #374151;
}

/* ===== MOBILE CARDS (< 640px) ===== */
@media (max-width: 639px) {
  .testi-admin { padding: 16px 14px 32px; }
  .ta-stats { grid-template-columns: repeat(2,1fr); gap: 10px; }
  .ta-stat-card { padding: 14px 14px; gap: 10px; }
  .ta-stat-icon { width: 38px; height: 38px; font-size: 0.9rem; }
  .ta-stat-val { font-size: 1.35rem; }
  .ta-filter-tabs { width: 100%; }
  .ta-filter-tab { flex: 1; justify-content: center; padding: 7px 8px; }
  .ta-header-left h2 { font-size: 1.2rem; }

  /* Hide table, show mobile cards */
  .ta-table-wrap { display: none; }
  .ta-mobile-list { display: flex; flex-direction: column; gap: 0; }
}
@media (min-width: 640px) {
  .ta-mobile-list { display: none; }
}

/* ===== TABLET ===== */
@media (max-width: 900px) and (min-width: 640px) {
  .ta-stats { grid-template-columns: repeat(2,1fr); }
  .testi-admin { padding: 20px 18px 36px; }
}

/* ===== MOBILE CARD ITEM ===== */
.ta-m-item {
  padding: 16px;
  border-bottom: 1px solid #f3f4f6;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.ta-m-item:last-child { border-bottom: none; }
.ta-m-top { display: flex; align-items: center; gap: 10px; }
.ta-m-meta { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 6px; }
.ta-m-isi {
  font-size: 0.82rem;
  color: #4b5563;
  font-style: italic;
  line-height: 1.6;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.ta-m-actions { display: flex; gap: 6px; flex-wrap: wrap; }

/* ===== SWEETALERT2 CUSTOM THEME ===== */
.swal2-popup.ta-swal {
  border-radius: 20px !important;
  padding: 2rem !important;
  font-family: inherit !important;
  border: 1px solid #fca5a5 !important;
}
.swal2-popup.ta-swal .swal2-title {
  font-size: 1.15rem !important;
  font-weight: 800 !important;
  color: #111827 !important;
}
.swal2-popup.ta-swal .swal2-html-container {
  font-size: 0.85rem !important;
  color: #6b7280 !important;
}
.swal2-popup.ta-swal .swal2-confirm {
  background: #ef4444 !important;
  border-radius: 9999px !important;
  font-weight: 700 !important;
  font-size: 0.82rem !important;
  padding: 9px 22px !important;
  box-shadow: none !important;
}
.swal2-popup.ta-swal .swal2-cancel {
  background: #f3f4f6 !important;
  color: #374151 !important;
  border-radius: 9999px !important;
  font-weight: 700 !important;
  font-size: 0.82rem !important;
  padding: 9px 22px !important;
  box-shadow: none !important;
}
.swal2-popup.ta-swal .swal2-cancel:hover {
  background: #e5e7eb !important;
}
</style>

<div class="testi-admin">

  {{-- ===== HEADER ===== --}}
  <div class="ta-header">
    <div class="ta-header-left">
      <h2><i class="fa-solid fa-comments" style="color:#2563eb;margin-right:8px;"></i>Manajemen Testimoni</h2>
      <p>Review dan kelola testimoni yang masuk dari pengguna</p>
    </div>
    <a href="/" class="ta-btn-view" target="_blank">
      <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Landing Page
    </a>
  </div>

  {{-- ===== ALERT ===== --}}
  @if(session('success'))
  <div class="ta-alert">
    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
  </div>
  @endif

  {{-- ===== STATS ===== --}}
  <div class="ta-stats">
    <div class="ta-stat-card">
      <div class="ta-stat-icon blue"><i class="fa-solid fa-comments"></i></div>
      <div>
        <div class="ta-stat-val">{{ $counts['all'] }}</div>
        <div class="ta-stat-label">Total Testimoni</div>
      </div>
    </div>
    <div class="ta-stat-card">
      <div class="ta-stat-icon yellow"><i class="fa-solid fa-clock"></i></div>
      <div>
        <div class="ta-stat-val" style="color:#b45309;">{{ $counts['pending'] }}</div>
        <div class="ta-stat-label">Menunggu Review</div>
      </div>
    </div>
    <div class="ta-stat-card">
      <div class="ta-stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
      <div>
        <div class="ta-stat-val" style="color:#065f46;">{{ $counts['published'] }}</div>
        <div class="ta-stat-label">Dipublish</div>
      </div>
    </div>
    <div class="ta-stat-card">
      <div class="ta-stat-icon red"><i class="fa-solid fa-ban"></i></div>
      <div>
        <div class="ta-stat-val" style="color:#991b1b;">{{ $counts['rejected'] }}</div>
        <div class="ta-stat-label">Ditolak</div>
      </div>
    </div>
  </div>

  {{-- ===== FILTER TABS ===== --}}
  <div class="ta-filter-wrap">
    <div class="ta-filter-tabs">
      <a href="{{ route('admin.testimoni.index', ['status'=>'all']) }}"
         class="ta-filter-tab {{ $filter==='all' ? 'active' : '' }}">
        <i class="fa-solid fa-list"></i> Semua
        <span class="ta-tab-count">{{ $counts['all'] }}</span>
      </a>
      <a href="{{ route('admin.testimoni.index', ['status'=>'pending']) }}"
         class="ta-filter-tab {{ $filter==='pending' ? 'active' : '' }}">
        <i class="fa-solid fa-clock"></i> Pending
        <span class="ta-tab-count">{{ $counts['pending'] }}</span>
      </a>
      <a href="{{ route('admin.testimoni.index', ['status'=>'published']) }}"
         class="ta-filter-tab {{ $filter==='published' ? 'active' : '' }}">
        <i class="fa-solid fa-check"></i> Published
        <span class="ta-tab-count">{{ $counts['published'] }}</span>
      </a>
      <a href="{{ route('admin.testimoni.index', ['status'=>'rejected']) }}"
         class="ta-filter-tab {{ $filter==='rejected' ? 'active' : '' }}">
        <i class="fa-solid fa-ban"></i> Ditolak
        <span class="ta-tab-count">{{ $counts['rejected'] }}</span>
      </a>
    </div>
    <span class="ta-total-info">
      Menampilkan <strong>{{ $testimonis->count() }}</strong> dari <strong>{{ $testimonis->total() }}</strong> data
    </span>
  </div>

  {{-- ===== TABLE / CARDS ===== --}}
  <div class="ta-card">

    {{-- ===== DESKTOP TABLE ===== --}}
    <div class="ta-table-wrap">
      <table class="ta-table">
        <thead>
          <tr>
            <th>Pengguna</th>
            <th>Rating</th>
            <th>Testimoni</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($testimonis as $t)
          <tr>
            {{-- USER --}}
            <td>
              <div class="ta-user-cell">
                <img
                  src="{{ $t->foto ? asset('storage/'.$t->foto) : asset('images/anon.png') }}"
                  alt="{{ $t->nama }}"
                  class="ta-avatar"
                >
                <div>
                  <div class="ta-user-name">{{ $t->nama }}</div>
                  <div class="ta-user-email">{{ $t->email }}</div>
                </div>
              </div>
            </td>
            {{-- RATING --}}
            <td>
              <div class="ta-stars">
                @for($i=1;$i<=5;$i++)
                  <i class="fa-solid fa-star {{ $i > $t->rating ? 'empty' : '' }}"></i>
                @endfor
                <span class="ta-rating-num">{{ $t->rating }}/5</span>
              </div>
            </td>
            {{-- ISI --}}
            <td>
              <div class="ta-testi-text">"{{ $t->isi }}"</div>
              <button class="ta-btn-preview" onclick="taPreview(
                '{{ addslashes($t->nama) }}',
                {{ $t->rating }},
                '{{ addslashes($t->isi) }}',
                '{{ $t->foto ? asset('storage/'.$t->foto) : asset('images/anon.png') }}'
              )">
                <i class="fa-solid fa-eye"></i> Lihat Lengkap
              </button>
            </td>
            {{-- STATUS --}}
            <td>
              <span class="ta-badge {{ $t->status }}">
                @if($t->status==='pending')
                  <i class="fa-solid fa-clock"></i> Pending
                @elseif($t->status==='published')
                  <i class="fa-solid fa-check"></i> Published
                @else
                  <i class="fa-solid fa-ban"></i> Ditolak
                @endif
              </span>
            </td>
            {{-- TANGGAL --}}
            <td>
              <div class="ta-date">{{ $t->created_at->format('d M Y') }}</div>
              <div class="ta-date-sub">{{ $t->created_at->format('H:i') }} WIB</div>
            </td>
            {{-- AKSI --}}
            <td>
              <div class="ta-actions">
                @if($t->status !== 'published')
                <form method="POST" action="{{ route('admin.testimoni.publish', $t) }}">
                  @csrf @method('PATCH')
                  <button type="submit" class="ta-btn publish">
                    <i class="fa-solid fa-check"></i> Publish
                  </button>
                </form>
                @endif
                @if($t->status !== 'rejected')
                <form method="POST" action="{{ route('admin.testimoni.reject', $t) }}">
                  @csrf @method('PATCH')
                  <button type="submit" class="ta-btn reject">
                    <i class="fa-solid fa-ban"></i> Reject
                  </button>
                </form>
                @endif
                {{-- HAPUS dengan SweetAlert --}}
                <form method="POST" action="{{ route('admin.testimoni.destroy', $t) }}"
                      class="ta-delete-form">
                  @csrf @method('DELETE')
                  <button type="button" class="ta-btn del"
                          onclick="taConfirmDelete(this, '{{ addslashes($t->nama) }}')">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6">
              <div class="ta-empty">
                <i class="fa-solid fa-comments"></i>
                <p>
                  Belum ada testimoni
                  @if($filter !== 'all')
                    dengan status <span>"{{ $filter }}"</span>
                  @endif
                </p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- ===== MOBILE LIST CARDS ===== --}}
    <div class="ta-mobile-list">
      @forelse($testimonis as $t)
      <div class="ta-m-item">
        <div class="ta-m-top">
          <img
            src="{{ $t->foto ? asset('storage/'.$t->foto) : asset('images/anon.png') }}"
            alt="{{ $t->nama }}"
            class="ta-avatar"
          >
          <div style="flex:1;min-width:0;">
            <div class="ta-user-name">{{ $t->nama }}</div>
            <div class="ta-user-email">{{ $t->email }}</div>
          </div>
          <span class="ta-badge {{ $t->status }}">
            @if($t->status==='pending')   <i class="fa-solid fa-clock"></i> Pending
            @elseif($t->status==='published') <i class="fa-solid fa-check"></i> Live
            @else <i class="fa-solid fa-ban"></i> Ditolak
            @endif
          </span>
        </div>

        <div class="ta-m-meta">
          <div class="ta-stars">
            @for($i=1;$i<=5;$i++)
              <i class="fa-solid fa-star {{ $i > $t->rating ? 'empty' : '' }}"></i>
            @endfor
            <span class="ta-rating-num">{{ $t->rating }}/5</span>
          </div>
          <div class="ta-date-sub">{{ $t->created_at->format('d M Y, H:i') }}</div>
        </div>

        <div class="ta-m-isi">"{{ $t->isi }}"</div>

        <div class="ta-m-actions">
          @if($t->status !== 'published')
          <form method="POST" action="{{ route('admin.testimoni.publish', $t) }}">
            @csrf @method('PATCH')
            <button type="submit" class="ta-btn publish">
              <i class="fa-solid fa-check"></i> Publish
            </button>
          </form>
          @endif
          @if($t->status !== 'rejected')
          <form method="POST" action="{{ route('admin.testimoni.reject', $t) }}">
            @csrf @method('PATCH')
            <button type="submit" class="ta-btn reject">
              <i class="fa-solid fa-ban"></i> Reject
            </button>
          </form>
          @endif
          {{-- HAPUS dengan SweetAlert (mobile) --}}
          <form method="POST" action="{{ route('admin.testimoni.destroy', $t) }}"
                class="ta-delete-form">
            @csrf @method('DELETE')
            <button type="button" class="ta-btn del"
                    onclick="taConfirmDelete(this, '{{ addslashes($t->nama) }}')">
              <i class="fa-solid fa-trash"></i> Hapus
            </button>
          </form>
          <button class="ta-btn-preview" onclick="taPreview(
            '{{ addslashes($t->nama) }}',
            {{ $t->rating }},
            '{{ addslashes($t->isi) }}',
            '{{ $t->foto ? asset('storage/'.$t->foto) : asset('images/anon.png') }}'
          )">
            <i class="fa-solid fa-eye"></i> Lihat Lengkap
          </button>
        </div>
      </div>
      @empty
      <div class="ta-empty">
        <i class="fa-solid fa-comments"></i>
        <p>
          Belum ada testimoni
          @if($filter !== 'all')
            dengan status <span>"{{ $filter }}"</span>
          @endif
        </p>
      </div>
      @endforelse
    </div>

    {{-- ===== PAGINATION ===== --}}
    @if($testimonis->hasPages())
    <div class="ta-pagination">
      <span class="ta-pagination-info">
        Halaman {{ $testimonis->currentPage() }} dari {{ $testimonis->lastPage() }}
      </span>
      {{ $testimonis->links() }}
    </div>
    @endif

  </div>{{-- end ta-card --}}

</div>{{-- end testi-admin --}}

{{-- ===== PREVIEW MODAL ===== --}}
<div class="ta-modal-overlay" id="taModal">
  <div class="ta-modal-box">
    <button class="ta-modal-close" onclick="taCloseModal()">
      <i class="fa-solid fa-xmark"></i>
    </button>
    <div class="ta-modal-head">
      <img id="taModalAvatar" src="" alt=""
           style="width:50px;height:50px;border-radius:50%;object-fit:cover;border:2px solid #e5e7eb;flex-shrink:0;">
      <div>
        <div id="taModalName" style="font-weight:700;font-size:1rem;color:#111827;"></div>
        <div id="taModalStars" style="margin-top:5px;display:flex;gap:3px;align-items:center;"></div>
      </div>
    </div>
    <div class="ta-modal-body">
      <p id="taModalIsi"></p>
    </div>
  </div>
</div>

<script>
/* ===== PREVIEW MODAL ===== */
function taPreview(nama, rating, isi, foto) {
  document.getElementById('taModalName').textContent = nama;
  document.getElementById('taModalAvatar').src = foto;
  document.getElementById('taModalIsi').textContent = '\u201c' + isi + '\u201d';
  var html = '';
  for (var i = 1; i <= 5; i++) {
    html += i <= rating
      ? '<i class="fa-solid fa-star" style="color:#f59e0b;font-size:.85rem;"></i>'
      : '<i class="fa-regular fa-star" style="color:#d1d5db;font-size:.85rem;"></i>';
  }
  html += '<span style="font-size:.75rem;color:#6b7280;font-weight:700;margin-left:5px;">' + rating + '/5</span>';
  document.getElementById('taModalStars').innerHTML = html;
  document.getElementById('taModal').classList.add('show');
}
function taCloseModal() {
  document.getElementById('taModal').classList.remove('show');
}
document.getElementById('taModal').addEventListener('click', function(e) {
  if (e.target === this) taCloseModal();
});
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') taCloseModal();
});

/* ===== SWEETALERT2 HAPUS ===== */
function taConfirmDelete(btn, nama) {
  Swal.fire({
    customClass: { popup: 'ta-swal' },
    title: 'Hapus Testimoni?',
    html: 'Testimoni dari <strong>' + nama + '</strong> akan dihapus permanen dan tidak bisa dikembalikan.',
    icon: 'warning',
    iconColor: '#ef4444',
    showCancelButton: true,
    confirmButtonText: '<i class="fa-solid fa-trash" style="margin-right:6px;"></i>Ya, Hapus',
    cancelButtonText: 'Batal',
    reverseButtons: true,
    focusCancel: true,
  }).then(function(result) {
    if (result.isConfirmed) {
      btn.closest('form').submit();
    }
  });
}
</script>

@endsection