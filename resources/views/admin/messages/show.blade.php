@extends('layout_admin.admin')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')

@section('content')

<style>
    .show-page { font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; }

    /* ===== TOP BAR ===== */
    .show-topbar {
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
    .show-topbar::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .show-topbar::after {
        content: '';
        position: absolute;
        bottom: -30px; right: 80px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .show-topbar-left { position: relative; z-index: 1; }
    .show-topbar-left h2 {
        margin: 0;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .show-topbar-left p {
        margin: 4px 0 0;
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
    }
    .show-topbar-right { position: relative; z-index: 1; }
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
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-height: 200px;
    }

    /* INFO ROW (sender metadata) */
    .info-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .info-row-line {
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }
    .info-row-text {
        font-size: 0.72rem;
        color: #94a3b8;
        font-weight: 600;
        white-space: nowrap;
        background: #f8faff;
        padding: 0 8px;
    }

    /* MESSAGE BUBBLE (incoming — kiri) */
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
    .msg-incoming-body { display: flex; flex-direction: column; gap: 4px; }
    .msg-sender-name {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748b;
        margin-left: 4px;
    }
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

    /* META CARDS */
    .meta-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
        padding: 0 20px 20px;
    }
    .meta-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .meta-card-icon {
        width: 34px; height: 34px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
        flex-shrink: 0;
    }
    .meta-card-icon.blue  { background: #eff6ff; color: #2563eb; }
    .meta-card-icon.green { background: #f0fdf4; color: #16a34a; }
    .meta-card-icon.violet{ background: #f5f3ff; color: #7c3aed; }
    .meta-card-text { min-width: 0; }
    .meta-card-label { font-size: 0.68rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .meta-card-value { font-size: 0.82rem; font-weight: 700; color: #1e293b; margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* CHAT FOOTER (actions) */
    .chat-footer {
        background: #fff;
        border-top: 1px solid #e2e8f0;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .chat-footer p {
        margin: 0;
        font-size: 0.78rem;
        color: #94a3b8;
        flex: 1;
        min-width: 120px;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 12px;
        font-size: 0.8rem;
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
    .btn-reply-msg { background: linear-gradient(135deg, #2563eb, #3b82f6); color: #fff; }
    .btn-back-list { background: #f1f5f9; color: #475569; }
    .btn-back-list:hover { opacity:1; background: #e2e8f0; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .show-topbar { padding: 16px; border-radius: 16px; }
        .show-topbar-left h2 { font-size: 1.05rem; }
        .meta-grid { grid-template-columns: 1fr 1fr; }
        .msg-incoming { max-width: 95%; }
        .chat-body { padding: 16px; }
        .subject-pill { display: none; }
    }

    @media (max-width: 420px) {
        .meta-grid { grid-template-columns: 1fr; }
        .chat-footer { flex-direction: column; align-items: stretch; }
        .action-btn { justify-content: center; }
        .chat-footer p { display: none; }
    }
</style>

<div class="show-page">

    {{-- TOP BAR --}}
    <div class="show-topbar">
        <div class="show-topbar-left">
            <h2>
                <i class="fa-solid fa-message"></i>
                Detail Pesan
            </h2>
            <p>Membaca pesan dari {{ $message->name }}</p>
        </div>
        <div class="show-topbar-right">
            <a href="{{ route('admin.messages.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

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

        {{-- META CARDS --}}
        <div class="meta-grid" style="padding-top:16px;">
            <div class="meta-card">
                <div class="meta-card-icon blue"><i class="fa-solid fa-user"></i></div>
                <div class="meta-card-text">
                    <div class="meta-card-label">Pengirim</div>
                    <div class="meta-card-value">{{ $message->name }}</div>
                </div>
            </div>
            <div class="meta-card">
                <div class="meta-card-icon green"><i class="fa-solid fa-envelope"></i></div>
                <div class="meta-card-text">
                    <div class="meta-card-label">Email</div>
                    <div class="meta-card-value">{{ $message->email }}</div>
                </div>
            </div>
            <div class="meta-card">
                <div class="meta-card-icon violet"><i class="fa-solid fa-tag"></i></div>
                <div class="meta-card-text">
                    <div class="meta-card-label">Subjek</div>
                    <div class="meta-card-value">{{ $message->subject }}</div>
                </div>
            </div>
        </div>

        {{-- DIVIDER --}}
        <div style="padding: 0 20px 4px;">
            <div class="info-row">
                <div class="info-row-line"></div>
                <div class="info-row-text">
                    <i class="fa-regular fa-clock" style="margin-right:3px;"></i>
                    {{ $message->created_at ? $message->created_at->isoFormat('dddd, D MMMM Y • HH:mm') : '' }} WIB
                </div>
                <div class="info-row-line"></div>
            </div>
        </div>

        {{-- CHAT BODY — BUBBLE --}}
        <div class="chat-body">
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
                        {{ $message->created_at ? $message->created_at->diffForHumans() : '' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- CHAT FOOTER --}}
        <div class="chat-footer">
            <p><i class="fa-solid fa-circle-info" style="margin-right:4px;color:#bfdbfe;"></i>Balas langsung ke email pengirim</p>
            <a href="{{ route('admin.messages.index') }}" class="action-btn btn-back-list">
                <i class="fa-solid fa-list"></i> Semua Pesan
            </a>
            <a href="{{ route('admin.messages.replyForm', $message->id) }}" class="action-btn btn-reply-msg">
                <i class="fa-solid fa-reply"></i> Balas Pesan
            </a>
        </div>

    </div>
    {{-- end chat-room --}}

</div>

@endsection