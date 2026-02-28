@extends('layout_admin.admin')

@section('title', 'Balas Pesan')
@section('page-title', 'Balas Pesan')

@section('content')

<style>
    .reply-page { font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; }

    /* ===== TOP BAR ===== */
    .reply-topbar {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 60%, #3b82f6 100%);
        border-radius: 20px;
        padding: 20px 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(37,99,235,0.25);
    }
    .reply-topbar::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .reply-topbar::after {
        content: '';
        position: absolute;
        bottom: -30px; right: 80px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .reply-topbar-left { position: relative; z-index: 1; }
    .reply-topbar-left h2 {
        margin: 0;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .reply-topbar-left p {
        margin: 4px 0 0;
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
    }
    .reply-topbar-right { position: relative; z-index: 1; }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(10px);
        color: #fff;
        text-decoration: none;
        border-radius: 12px;
        padding: 8px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        transition: background 0.2s;
    }
    .btn-back:hover { background: rgba(255,255,255,0.28); color: #fff; }

    /* ===== ALERT SUCCESS ===== */
    .alert-success {
        background: linear-gradient(135deg, #dcfce7, #f0fdf4);
        border: 1px solid #86efac;
        color: #166534;
        padding: 12px 16px;
        border-radius: 14px;
        margin-bottom: 16px;
        font-size: 0.875rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ===== CHAT ROOM ===== */
    .chat-room {
        background: #f8faff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(37,99,235,0.07);
    }

    /* CHAT HEADER */
    .chat-header {
        background: #fff;
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .chat-header-avatar {
        width: 44px; height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem; font-weight: 800;
        flex-shrink: 0;
        position: relative;
    }
    .online-dot {
        position: absolute;
        bottom: -2px; right: -2px;
        width: 12px; height: 12px;
        border-radius: 50%;
        background: #22c55e;
        border: 2px solid #fff;
    }
    .chat-header-info { flex: 1; min-width: 0; }
    .chat-header-info h3 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 800;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .chat-header-info p {
        margin: 2px 0 0;
        font-size: 0.75rem;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .subject-pill {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 999px;
        padding: 4px 12px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* CHAT BODY */
    .chat-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* DIVIDER */
    .info-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-row-line { flex: 1; height: 1px; background: #e2e8f0; }
    .info-row-text {
        font-size: 0.72rem;
        color: #94a3b8;
        font-weight: 600;
        white-space: nowrap;
        background: #f8faff;
        padding: 0 8px;
    }

    /* INCOMING BUBBLE (pesan asli) */
    .msg-incoming {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        max-width: 80%;
    }
    .msg-incoming-avatar {
        width: 36px; height: 36px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 0.85rem; font-weight: 800;
        flex-shrink: 0;
    }
    .msg-incoming-body { display: flex; flex-direction: column; gap: 4px; min-width: 0; }
    .msg-sender-name { font-size: 0.72rem; font-weight: 700; color: #64748b; margin-left: 4px; }
    .bubble-incoming {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 4px 18px 18px 18px;
        padding: 12px 16px;
        font-size: 0.875rem;
        color: #1e293b;
        line-height: 1.6;
        word-break: break-word;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .bubble-time {
        font-size: 0.68rem;
        color: #94a3b8;
        margin-left: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* REPLY AREA (kanan) */
    .msg-outgoing-wrap {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
    }
    .msg-outgoing-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        margin-right: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* TEXTAREA BUBBLE */
    .bubble-reply-wrap {
        width: 100%;
        max-width: 82%;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }
    .bubble-reply-box {
        width: 100%;
        background: #eff6ff;
        border: 1.5px solid #bfdbfe;
        border-radius: 18px 4px 18px 18px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(37,99,235,0.08);
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .bubble-reply-box:focus-within {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
    }
    .bubble-reply-box textarea {
        width: 100%;
        background: transparent;
        border: none;
        outline: none;
        padding: 14px 16px;
        font-size: 0.875rem;
        font-family: inherit;
        color: #1e293b;
        resize: none;
        line-height: 1.6;
        min-height: 110px;
    }
    .bubble-reply-box textarea::placeholder { color: #94a3b8; }
    .bubble-reply-footer {
        background: #dbeafe;
        padding: 8px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: wrap;
    }
    .bubble-reply-footer span {
        font-size: 0.72rem;
        color: #3b82f6;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .char-count { font-size: 0.7rem; color: #64748b; }

    /* ADMIN AVATAR kanan */
    .admin-avatar {
        width: 36px; height: 36px;
        border-radius: 12px;
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 0.75rem; font-weight: 800;
        flex-shrink: 0;
    }

    /* CHAT FOOTER */
    .chat-footer {
        background: #fff;
        border-top: 1px solid #e2e8f0;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .chat-footer-hint {
        flex: 1;
        min-width: 120px;
        font-size: 0.75rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: opacity 0.18s, transform 0.18s;
        font-family: inherit;
        white-space: nowrap;
    }
    .action-btn:hover  { opacity: 0.85; transform: translateY(-1px); }
    .action-btn:active { transform: translateY(0); }
    .action-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

    .btn-send   { background: linear-gradient(135deg, #2563eb, #3b82f6); color: #fff; box-shadow: 0 4px 14px rgba(37,99,235,0.3); }
    .btn-cancel { background: #f1f5f9; color: #475569; }
    .btn-cancel:hover { opacity:1; background: #e2e8f0; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .reply-topbar { padding: 16px; border-radius: 16px; }
        .reply-topbar-left h2 { font-size: 1.05rem; }
        .subject-pill { display: none; }
        .msg-incoming { max-width: 95%; }
        .bubble-reply-wrap { max-width: 95%; }
        .chat-body { padding: 14px; gap: 14px; }
    }
    @media (max-width: 420px) {
        .chat-footer { flex-direction: column; align-items: stretch; }
        .chat-footer-hint { display: none; }
        .action-btn { justify-content: center; }
    }
</style>

<div class="reply-page">

    {{-- TOP BAR --}}
    <div class="reply-topbar">
        <div class="reply-topbar-left">
            <h2>
                <i class="fa-solid fa-reply"></i>
                Balas Pesan
            </h2>
            <p>Membalas pesan dari {{ $message->name }}</p>
        </div>
        <div class="reply-topbar-right">
            <a href="{{ route('admin.messages.show', $message->id) }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- CHAT ROOM --}}
    <div class="chat-room">

        {{-- CHAT HEADER --}}
        <div class="chat-header">
            <div class="chat-header-avatar">
                {{ strtoupper(substr($message->name, 0, 1)) }}
                <div class="online-dot"></div>
            </div>
            <div class="chat-header-info">
                <h3>{{ $message->name }}</h3>
                <p>{{ $message->email }}</p>
            </div>
            <div class="subject-pill">
                <i class="fa-solid fa-tag" style="margin-right:4px;font-size:0.65rem;"></i>
                {{ $message->subject }}
            </div>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.messages.sendReply', $message->id) }}" method="POST">
            @csrf

            <div class="chat-body">

                {{-- DIVIDER: pesan asli --}}
                <div class="info-row">
                    <div class="info-row-line"></div>
                    <div class="info-row-text">
                        <i class="fa-regular fa-clock" style="margin-right:3px;"></i>
                        Pesan masuk {{ $message->created_at ? $message->created_at->diffForHumans() : '' }}
                    </div>
                    <div class="info-row-line"></div>
                </div>

                {{-- INCOMING BUBBLE — pesan asli --}}
                <div class="msg-incoming">
                    <div class="msg-incoming-avatar">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </div>
                    <div class="msg-incoming-body">
                        <div class="msg-sender-name">{{ $message->name }}</div>
                        <div class="bubble-incoming">
                            {{ $message->message }}
                        </div>
                        <div class="bubble-time">
                            <i class="fa-regular fa-clock"></i>
                            {{ $message->created_at ? $message->created_at->isoFormat('D MMM Y, HH:mm') : '' }}
                        </div>
                    </div>
                </div>

                {{-- DIVIDER: tulis balasan --}}
                <div class="info-row">
                    <div class="info-row-line"></div>
                    <div class="info-row-text">
                        <i class="fa-solid fa-pencil" style="margin-right:3px;"></i>
                        Tulis balasan kamu
                    </div>
                    <div class="info-row-line"></div>
                </div>

                {{-- OUTGOING — reply textarea --}}
                <div class="msg-outgoing-wrap">
                    <div class="msg-outgoing-label">
                        <div class="admin-avatar">A</div>
                        Admin &nbsp;·&nbsp; Membalas ke {{ $message->email }}
                    </div>
                    <div class="bubble-reply-wrap">
                        <div class="bubble-reply-box">
                            <textarea
                                name="reply_message"
                                id="replyTextarea"
                                placeholder="Tulis balasan pesan di sini..."
                                required
                                oninput="updateCount(this)"
                            ></textarea>
                            <div class="bubble-reply-footer">
                                <span>
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Akan dikirim ke {{ $message->email }}
                                </span>
                                <span class="char-count" id="charCount">0 karakter</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- end chat-body --}}

            {{-- CHAT FOOTER --}}
            <div class="chat-footer">
                <div class="chat-footer-hint">
                    <i class="fa-solid fa-circle-info" style="color:#bfdbfe;"></i>
                    Balasan akan dikirim via email
                </div>
                <a href="{{ route('admin.messages.show', $message->id) }}" class="action-btn btn-cancel">
                    <i class="fa-solid fa-xmark"></i> Batal
                </a>
                <button type="submit" class="action-btn btn-send" id="sendBtn">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Balasan
                </button>
            </div>

        </form>

    </div>
    {{-- end chat-room --}}

</div>

<script>
    function updateCount(el) {
        const count = el.value.length;
        document.getElementById('charCount').textContent = count + ' karakter';
    }

    // Disable button saat submit biar gak double send
    document.querySelector('form').addEventListener('submit', function () {
        const btn = document.getElementById('sendBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
    });
</script>

@endsection