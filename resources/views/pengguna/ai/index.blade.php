@extends('layout_pengguna.pengguna')

@section('title', 'AI NexFi')
@section('page-title', 'AI NexFi')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
  :root {
    --bg:       #07080f;
    --bg2:      #0c0d1d;
    --bg3:      #10132a;
    --accent:   #6c63ff;
    --accent2:  #9b59f5;
    --border:   rgba(108,99,255,0.18);
    --glow:     rgba(108,99,255,0.2);
    --muted:    rgba(255,255,255,0.3);
    --muted2:   rgba(255,255,255,0.5);
    --text:     rgba(255,255,255,0.88);
    --font:     'Plus Jakarta Sans', sans-serif;
  }

  *, *::before, *::after { box-sizing: border-box; }

  #ai-wrap {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 80px);
    max-width: 960px;
    margin: 0 auto;
    font-family: var(--font);
  }

  /* ── HEADER ── */
  #ai-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: linear-gradient(135deg, #0d0e22, #10122b);
    border: 1px solid var(--border);
    border-radius: 18px 18px 0 0;
    position: relative;
    overflow: hidden;
  }
  #ai-header::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at top left, rgba(108,99,255,0.08) 0%, transparent 60%);
    pointer-events: none;
  }

  .ai-avatar {
    width: 44px; height: 44px;
    border-radius: 13px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 18px rgba(108,99,255,0.35);
    position: relative;
  }
  .ai-avatar::after {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
    pointer-events: none;
  }
  .ai-avatar i { font-size: 1.15rem; color: #fff; position: relative; z-index: 1; }

  .ai-header-info { flex: 1; }
  .ai-header-info h3 {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -0.02em;
  }
  .ai-online {
    display: flex; align-items: center; gap: 5px;
    font-size: 0.71rem; color: var(--muted2); margin-top: 2px;
  }
  .online-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: #4ade80;
    box-shadow: 0 0 8px rgba(74,222,128,0.6);
    animation: blink 2s infinite;
    flex-shrink: 0;
  }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

  .header-actions { display: flex; gap: 6px; }
  .ai-header-btn {
    width: 34px; height: 34px;
    border-radius: 9px;
    border: 1px solid var(--border);
    background: rgba(255,255,255,0.03);
    color: var(--muted2);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 0.78rem;
    transition: all 0.18s;
  }
  .ai-header-btn:hover {
    background: rgba(239,68,68,0.1);
    color: #f87171;
    border-color: rgba(239,68,68,0.25);
  }

  #ai-greeting { display: none !important; }

  /* ── CHAT BOX ── */
  #chat-box {
    flex: 1;
    overflow-y: auto;
    padding: 20px 18px;
    background: #07080f;
    border-left: 1px solid var(--border);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    gap: 10px;
    scroll-behavior: smooth;
    will-change: scroll-position;
    -webkit-overflow-scrolling: touch;
  }
  #chat-box::-webkit-scrollbar { width: 4px; }
  #chat-box::-webkit-scrollbar-track { background: transparent; }
  #chat-box::-webkit-scrollbar-thumb { background: rgba(108,99,255,0.2); border-radius: 4px; }
  #chat-box::-webkit-scrollbar-thumb:hover { background: rgba(108,99,255,0.4); }

  /* ── MESSAGES ── */
  .msg-row {
    display: flex; gap: 9px; align-items: flex-end;
    animation: msgIn .22s cubic-bezier(.34,1.56,.64,1);
    contain: layout style;
  }
  @keyframes msgIn {
    from { opacity:0; transform:translateY(10px) scale(0.97); }
    to   { opacity:1; transform:translateY(0) scale(1); }
  }
  .msg-row.user { flex-direction: row-reverse; }

  .msg-icon {
    width: 30px; height: 30px;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 0.73rem;
    align-self: flex-end;
  }
  .msg-icon.ai-ic {
    background: linear-gradient(135deg, #5b54e8, #8644d8);
    color: #fff;
    box-shadow: 0 2px 8px rgba(108,99,255,0.25);
  }
  .msg-icon.user-ic {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    color: var(--muted2);
  }

  .msg-col {
    display: flex; flex-direction: column;
    flex: 1; min-width: 0;
  }
  .msg-row.user .msg-col { align-items: flex-end; }
  .msg-row.ai  .msg-col { align-items: flex-start; }

  .msg-bubble {
    max-width: min(88%, 720px);
    width: fit-content;
    padding: 11px 15px;
    border-radius: 16px;
    font-size: 0.86rem;
    line-height: 1.7;
    word-break: break-word;
    white-space: pre-wrap;
  }
  .msg-row.ai .msg-bubble {
    background: #0e1028;
    border: 1px solid rgba(108,99,255,0.14);
    color: var(--text);
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.3);
  }
  .msg-row.user .msg-bubble {
    background: linear-gradient(135deg, #5b54e8, #8645d9);
    color: #fff;
    border-bottom-right-radius: 4px;
    box-shadow: 0 4px 16px rgba(108,99,255,0.25);
  }
  .msg-time { font-size: 0.63rem; color: var(--muted); margin-top: 4px; padding: 0 3px; }

  /* ── DATE SEP ── */
  .date-sep {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.65rem; color: var(--muted);
    text-transform: uppercase; letter-spacing: 0.08em;
    margin: 4px 0; user-select: none;
  }
  .date-sep::before, .date-sep::after {
    content:''; flex:1; height:1px;
    background: rgba(255,255,255,0.05);
  }

  /* ── TYPING ── */
  .typing-row {
    display: flex; gap: 9px; align-items: flex-end;
    animation: msgIn .22s ease;
  }
  .typing-bubble {
    display: flex; align-items: center; gap: 5px;
    padding: 13px 16px;
    background: #0e1028;
    border: 1px solid rgba(108,99,255,0.14);
    border-radius: 16px; border-bottom-left-radius: 4px;
  }
  .t-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--accent);
    animation: tdot 1.2s infinite ease-in-out;
  }
  .t-dot:nth-child(2){ animation-delay:.15s; }
  .t-dot:nth-child(3){ animation-delay:.30s; }
  @keyframes tdot {
    0%,60%,100%{ transform:translateY(0); opacity:.3; }
    30%        { transform:translateY(-6px); opacity:1; }
  }

  /* ── EMPTY STATE ── */
  #empty-state {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    flex: 1; text-align: center;
    gap: 0; padding: 20px 20px 30px;
    pointer-events: none;
  }
  .es-greeting {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 18px; margin-bottom: 28px;
    background: rgba(108,99,255,0.07);
    border: 1px solid rgba(108,99,255,0.16);
    border-radius: 12px;
    font-size: 0.82rem; color: var(--muted2);
    pointer-events: none;
    animation: msgIn .35s ease;
  }
  .es-greeting .g-icon {
    width: 28px; height: 28px; border-radius: 8px;
    background: rgba(108,99,255,0.14);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .es-greeting .g-icon i { font-size: 0.72rem; color: #a78bfa; }
  .es-greeting strong { color: rgba(255,255,255,0.85); }

  .empty-icon {
    width: 68px; height: 68px; border-radius: 20px;
    background: rgba(108,99,255,0.09);
    border: 1px solid rgba(108,99,255,0.2);
    display: flex; align-items: center; justify-content: center;
    animation: floatIt 3.5s ease-in-out infinite;
    margin-bottom: 14px;
  }
  .empty-icon i { font-size: 1.7rem; color: #8b7ff5; }
  @keyframes floatIt {
    0%,100%{ transform:translateY(0); }
    50%    { transform:translateY(-7px); }
  }
  #empty-state h4 { margin:0 0 6px; font-size:.97rem; font-weight:700; color:rgba(255,255,255,0.75); }
  #empty-state p  { margin:0 0 18px; font-size:.8rem; color:var(--muted2); max-width:280px; line-height:1.65; }

  .chips { display: flex; flex-wrap: wrap; gap: 7px; justify-content: center; pointer-events: all; }
  .chip {
    display: flex; align-items: center; gap: 6px;
    padding: 7px 14px; border-radius: 9999px;
    background: rgba(108,99,255,0.07);
    border: 1px solid rgba(108,99,255,0.18);
    color: rgba(255,255,255,0.55);
    font-size: 0.75rem; font-weight: 600;
    cursor: pointer; transition: all 0.17s ease;
    font-family: var(--font);
  }
  .chip:hover {
    background: rgba(108,99,255,0.2);
    color: rgba(255,255,255,0.9);
    border-color: rgba(108,99,255,0.4);
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(108,99,255,0.15);
  }
  .chip:active { transform: translateY(0); }
  .chip i { font-size: 0.67rem; color: #9580ff; }

  /* ── INPUT ── */
  #ai-input-wrap {
    background: #0c0d1d;
    border: 1px solid var(--border);
    border-top: none;
    border-radius: 0 0 18px 18px;
  }
  #ai-input-area {
    display: flex; align-items: flex-end;
    gap: 9px; padding: 12px 14px;
    border-top: 1px solid rgba(108,99,255,0.08);
  }
  #pesan {
    flex: 1;
    background: rgba(255,255,255,0.04);
    border: 1.5px solid rgba(255,255,255,0.07);
    border-radius: 12px;
    padding: 10px 14px;
    color: #fff; font-size: 0.855rem;
    font-family: var(--font);
    outline: none; resize: none;
    max-height: 180px; min-height: 42px;
    overflow-y: auto; line-height: 1.6;
    transition: border-color .2s, background .2s, box-shadow .2s;
  }
  #pesan::placeholder { color: rgba(255,255,255,0.18); }
  #pesan:focus {
    border-color: rgba(108,99,255,0.5);
    background: rgba(108,99,255,0.05);
    box-shadow: 0 0 0 3px rgba(108,99,255,0.09);
  }
  #pesan::-webkit-scrollbar { width: 3px; }
  #pesan::-webkit-scrollbar-thumb { background: rgba(108,99,255,0.25); border-radius: 3px; }

  #send-btn {
    width: 42px; height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: none; color: #fff; font-size: 0.84rem;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(108,99,255,0.32);
    transition: opacity .18s, transform .15s, box-shadow .15s;
    position: relative; overflow: hidden;
  }
  #send-btn::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
    pointer-events: none;
  }
  #send-btn:hover  { opacity:.88; transform:translateY(-2px); box-shadow: 0 6px 20px rgba(108,99,255,0.4); }
  #send-btn:active { transform:translateY(0); box-shadow: 0 2px 8px rgba(108,99,255,0.2); }
  #send-btn:disabled { opacity:.28; cursor:not-allowed; transform:none; box-shadow:none; }

  #ai-disclaimer {
    padding: 7px 16px 10px;
    text-align: center;
    font-size: 0.66rem;
    color: rgba(255,255,255,0.18);
    line-height: 1.55;
  }
  #ai-disclaimer i { font-size: 0.6rem; margin-right: 3px; opacity: .65; }

  /* ── CUSTOM MODAL ALERT ── */
  #modal-overlay {
    display: none;
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    align-items: center; justify-content: center;
  }
  #modal-overlay.show { display: flex; }

  #modal-box {
    background: #10132a;
    border: 1px solid rgba(108,99,255,0.25);
    border-radius: 18px;
    padding: 28px 24px 22px;
    width: 90%; max-width: 320px;
    display: flex; flex-direction: column; align-items: center;
    gap: 10px;
    animation: modalIn .2s cubic-bezier(.34,1.56,.64,1);
    box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(108,99,255,0.1);
  }
  @keyframes modalIn {
    from { opacity:0; transform:scale(0.88) translateY(12px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
  }

  .modal-icon-wrap {
    width: 52px; height: 52px; border-radius: 15px;
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.2);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 4px;
  }
  .modal-icon-wrap i { font-size: 1.3rem; color: #f87171; }

  #modal-title {
    font-size: 0.97rem; font-weight: 800;
    color: rgba(255,255,255,0.9);
    margin: 0; text-align: center;
  }
  #modal-desc {
    font-size: 0.78rem; color: rgba(255,255,255,0.4);
    text-align: center; margin: 0; line-height: 1.6;
  }

  .modal-actions {
    display: flex; gap: 8px; width: 100%; margin-top: 6px;
  }
  .modal-btn {
    flex: 1; padding: 10px;
    border-radius: 11px; border: none;
    font-size: 0.82rem; font-weight: 700;
    cursor: pointer; font-family: var(--font);
    transition: all 0.17s;
  }
  .modal-btn.cancel {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.5);
  }
  .modal-btn.cancel:hover {
    background: rgba(255,255,255,0.09);
    color: rgba(255,255,255,0.8);
  }
  .modal-btn.confirm {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: #fff;
    box-shadow: 0 4px 14px rgba(239,68,68,0.25);
  }
  .modal-btn.confirm:hover { opacity: 0.88; transform: translateY(-1px); }
  .modal-btn.confirm:active { transform: translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width: 640px) {
    #ai-wrap { height: calc(100vh - 60px); }
    .msg-bubble { max-width: 90%; font-size: .84rem; }
    #ai-header { padding: 12px 13px; border-radius: 13px 13px 0 0; }
    #ai-input-wrap { border-radius: 0 0 13px 13px; }
    .chip { font-size: .71rem; padding: 5px 10px; }
    #pesan { font-size: 0.82rem; }
  }
</style>

{{-- CUSTOM MODAL --}}
<div id="modal-overlay">
  <div id="modal-box">
    <div class="modal-icon-wrap">
      <i class="fa-solid fa-trash-can"></i>
    </div>
    <p id="modal-title">Hapus Riwayat Chat?</p>
    <p id="modal-desc">Semua percakapan akan dihapus permanen dan tidak bisa dikembalikan.</p>
    <div class="modal-actions">
      <button class="modal-btn cancel" onclick="closeModal()">Batal</button>
      <button class="modal-btn confirm" onclick="confirmClear()">Hapus</button>
    </div>
  </div>
</div>

<div id="ai-wrap">

  {{-- HEADER --}}
  <div id="ai-header">
    <div class="ai-avatar">
      <i class="fa-solid fa-robot"></i>
    </div>
    <div class="ai-header-info">
      <h3>AI NexFi</h3>
      <div class="ai-online">
        <span class="online-dot"></span>
        Online &bull; Asisten Keuanganmu
      </div>
    </div>
    <div class="header-actions">
      <button class="ai-header-btn" onclick="clearChat()" title="Hapus riwayat chat">
        <i class="fa-solid fa-trash-can"></i>
      </button>
    </div>
  </div>

  <div id="ai-greeting" data-name="{{ $user->name }}" style="display:none"></div>

  {{-- CHAT BODY --}}
  <div id="chat-box">
    <div id="empty-state">
      <div class="es-greeting">
        <div class="g-icon"><i class="fa-solid fa-hand-point-right"></i></div>
        <div>Halo, <strong>{{ $user->name }}</strong>! Tanya apa saja seputar keuangan dan Nexfi.</div>
      </div>
      <div class="empty-icon"><i class="fa-solid fa-robot"></i></div>
      <h4>Mulai percakapan</h4>
      <p>Tanyakan apa saja tentang keuangan atau cara menggunakan NexFi.</p>
      <div class="chips">
        <button class="chip" onclick="kirimChip('Berapa saldo saya saat ini?')">
          <i class="fa-solid fa-wallet"></i> Saldo saya
        </button>
        <button class="chip" onclick="kirimChip('Analisa kondisi keuangan saya')">
          <i class="fa-solid fa-chart-pie"></i> Analisa keuangan
        </button>
        <button class="chip" onclick="kirimChip('Berikan tips hemat uang')">
          <i class="fa-solid fa-lightbulb"></i> Tips hemat
        </button>
        <button class="chip" onclick="kirimChip('Cara mencatat pengeluaran di Nexfi')">
          <i class="fa-solid fa-book-open"></i> Cara pakai Nexfi
        </button>
      </div>
    </div>
  </div>

  {{-- INPUT + DISCLAIMER --}}
  <div id="ai-input-wrap">
    <div id="ai-input-area">
      <textarea
        id="pesan" rows="1"
        placeholder="Tanya tentang keuangan atau Nexfi..."
        onkeydown="handleKey(event)"
        oninput="autoResize(this)"
      ></textarea>
      <button id="send-btn" onclick="kirimAI()" title="Kirim (Enter)">
        <i class="fa-solid fa-paper-plane"></i>
      </button>
    </div>
    <div id="ai-disclaimer">
      <i class="fa-solid fa-triangle-exclamation"></i>
      AI NexFi bisa saja membuat kesalahan. Selalu verifikasi informasi keuangan penting.
      Riwayat chat otomatis dihapus setelah 24 jam.
    </div>
  </div>

</div>

<script>
/* ===== STORAGE ===== */
const STORAGE_KEY = 'nexfi_chat_{{ Auth::id() }}';
const TTL_MS      = 24 * 60 * 60 * 1000;

function loadHistory() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (!raw) return [];
    const obj = JSON.parse(raw);
    if (Date.now() - obj.ts > TTL_MS) { localStorage.removeItem(STORAGE_KEY); return []; }
    return obj.msgs || [];
  } catch(e) { return []; }
}
function saveHistory(msgs) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify({ ts: Date.now(), msgs }));
}

/* ===== STATE ===== */
let chatMsgs  = loadHistory();
let isLoading = false;

/* ===== MODAL ===== */
function clearChat() {
  if (chatMsgs.length === 0) return;
  document.getElementById('modal-overlay').classList.add('show');
}
function closeModal() {
  document.getElementById('modal-overlay').classList.remove('show');
}
function confirmClear() {
  closeModal();
  chatMsgs = [];
  localStorage.removeItem(STORAGE_KEY);
  renderAll();
}
// Klik di luar modal = tutup
document.getElementById('modal-overlay').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});

/* ===== GREETING ===== */
function updateGreeting() {
  const el = document.getElementById('ai-greeting');
  if (!el) return;
  chatMsgs.length > 0 ? el.classList.add('hidden') : el.classList.remove('hidden');
}

/* ===== HELPERS ===== */
function escHtml(s) {
  return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
function fmtTime(ts) {
  return new Date(ts).toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});
}
function fmtDate(ts) {
  return new Date(ts).toLocaleDateString('id-ID',{weekday:'long',day:'numeric',month:'long'});
}

/* ===== RENDER BUBBLE ===== */
function renderBubble(role, text, ts) {
  const isUser = role === 'user';
  const safe   = escHtml(text).replace(/\n/g,'<br>');
  const icon   = isUser
    ? `<div class="msg-icon user-ic"><i class="fa-solid fa-user"></i></div>`
    : `<div class="msg-icon ai-ic"><i class="fa-solid fa-robot"></i></div>`;
  return `
    <div class="msg-row ${isUser?'user':'ai'}">
      ${!isUser ? icon : ''}
      <div class="msg-col">
        <div class="msg-bubble">${safe}</div>
        <div class="msg-time">${fmtTime(ts)}</div>
      </div>
      ${isUser ? icon : ''}
    </div>`;
}

/* ===== EMPTY HTML ===== */
function emptyHtml() {
  const namaEl = document.querySelector('#ai-greeting[data-name]');
  const nama   = namaEl ? namaEl.dataset.name : '';
  const greetHtml = nama
    ? `<div class="es-greeting">
        <div class="g-icon"><i class="fa-solid fa-hand-point-right"></i></div>
        <div>Halo, <strong>${escHtml(nama)}</strong>! Tanya apa saja seputar keuangan dan Nexfi.</div>
       </div>`
    : '';
  return `
    <div id="empty-state">
      ${greetHtml}
      <div class="empty-icon"><i class="fa-solid fa-robot"></i></div>
      <h4>Mulai percakapan</h4>
      <p>Tanyakan apa saja tentang keuangan atau cara menggunakan NexFi.</p>
      <div class="chips">
        <button class="chip" onclick="kirimChip('Berapa saldo saya saat ini?')">
          <i class="fa-solid fa-wallet"></i> Saldo saya
        </button>
        <button class="chip" onclick="kirimChip('Analisa kondisi keuangan saya')">
          <i class="fa-solid fa-chart-pie"></i> Analisa keuangan
        </button>
        <button class="chip" onclick="kirimChip('Berikan tips hemat uang')">
          <i class="fa-solid fa-lightbulb"></i> Tips hemat
        </button>
        <button class="chip" onclick="kirimChip('Cara mencatat pengeluaran di Nexfi')">
          <i class="fa-solid fa-book-open"></i> Cara pakai Nexfi
        </button>
      </div>
    </div>`;
}

/* ===== RENDER ALL ===== */
function renderAll() {
  const box = document.getElementById('chat-box');
  if (chatMsgs.length === 0) { box.innerHTML = emptyHtml(); updateGreeting(); return; }

  let html = '', lastDate = '';
  chatMsgs.forEach(function(m) {
    const dl = fmtDate(m.ts);
    if (dl !== lastDate) { html += `<div class="date-sep">${dl}</div>`; lastDate = dl; }
    html += renderBubble(m.role, m.text, m.ts);
  });
  box.innerHTML = html;
  scrollBottom();
  updateGreeting();
}

/* ===== APPEND ===== */
function appendBubble(role, text, ts) {
  const box = document.getElementById('chat-box');
  const emp = document.getElementById('empty-state');
  if (emp) emp.remove();
  box.insertAdjacentHTML('beforeend', renderBubble(role, text, ts));
  scrollBottom();
}

/* ===== TYPING ===== */
function showTyping() {
  document.getElementById('chat-box').insertAdjacentHTML('beforeend', `
    <div class="typing-row" id="typing-row">
      <div class="msg-icon ai-ic"><i class="fa-solid fa-robot"></i></div>
      <div class="typing-bubble">
        <div class="t-dot"></div><div class="t-dot"></div><div class="t-dot"></div>
      </div>
    </div>`);
  scrollBottom();
}
function hideTyping() { const t=document.getElementById('typing-row'); if(t) t.remove(); }

function scrollBottom() {
  const b = document.getElementById('chat-box');
  requestAnimationFrame(function() { b.scrollTop = b.scrollHeight; });
}

/* ===== CHIP ===== */
function kirimChip(text) {
  document.getElementById('pesan').value = text;
  kirimAI();
}

/* ===== KEY / RESIZE ===== */
function handleKey(e) {
  if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); kirimAI(); }
}
function autoResize(el) {
  el.style.height = 'auto';
  el.style.height = Math.min(el.scrollHeight, 180) + 'px';
}

/* ===== SEND ===== */
async function kirimAI() {
  if (isLoading) return;
  const input = document.getElementById('pesan');
  const pesan = input.value.trim();
  if (!pesan) return;

  isLoading = true;
  document.getElementById('send-btn').disabled = true;
  input.value = ''; input.style.height = 'auto';

  const ts = Date.now();
  chatMsgs.push({ role:'user', text:pesan, ts });
  appendBubble('user', pesan, ts);
  updateGreeting();
  showTyping();

  try {
    const res = await fetch('/ai-nexfi', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ message: pesan })
    });
    const data = await res.json();
    hideTyping();

    const jawaban = data?.choices?.[0]?.message?.content || 'Maaf, tidak ada respons dari AI.';
    const ats = Date.now();
    chatMsgs.push({ role:'ai', text:jawaban, ts:ats });
    appendBubble('ai', jawaban, ats);
    saveHistory(chatMsgs);

  } catch(err) {
    hideTyping();
    const ets = Date.now();
    const etx = 'Maaf, terjadi kesalahan saat menghubungi AI. Coba lagi ya!';
    chatMsgs.push({ role:'ai', text:etx, ts:ets });
    appendBubble('ai', etx, ets);
    saveHistory(chatMsgs);
  }

  isLoading = false;
  document.getElementById('send-btn').disabled = false;
  input.focus();
}

/* ===== INIT ===== */
(function(){
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (raw) {
      const obj = JSON.parse(raw);
      if (Date.now() - obj.ts > TTL_MS) { localStorage.removeItem(STORAGE_KEY); chatMsgs = []; }
    }
  } catch(e) {}
  renderAll();
})();
</script>

@endsection