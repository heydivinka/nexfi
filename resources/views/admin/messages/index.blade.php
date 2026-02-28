@extends('layout_admin.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')

@section('content')

<style>
    /* ===== BASE ===== */
    .msg-page { font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; }

    /* ===== TOP BAR ===== */
    .msg-topbar {
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
    .msg-topbar::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .msg-topbar::after {
        content: '';
        position: absolute;
        bottom: -30px; right: 80px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .msg-topbar-left { position: relative; z-index: 1; }
    .msg-topbar-left h2 {
        margin: 0;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        letter-spacing: -0.02em;
    }
    .msg-topbar-left p {
        margin: 2px 0 0;
        color: rgba(255,255,255,0.7);
        font-size: 0.8rem;
    }
    .msg-topbar-right { position: relative; z-index: 1; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .msg-count-badge {
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(10px);
        color: #fff;
        border-radius: 12px;
        padding: 6px 14px;
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .msg-count-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: #4ade80; flex-shrink: 0; animation: pulse-dot 1.8s infinite; }
    @keyframes pulse-dot { 0%,100%{ opacity:1; transform:scale(1); } 50%{ opacity:0.5; transform:scale(1.3); } }

    /* ===== ALERT ===== */
    .msg-alert-success {
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

    /* ===== EMPTY STATE ===== */
    .msg-empty {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
    }
    .msg-empty i { font-size: 3rem; margin-bottom: 12px; color: #cbd5e1; }
    .msg-empty p { font-size: 0.9rem; margin: 0; }

    /* ===== CHAT ROOM LAYOUT ===== */
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
    .chat-header-icon {
        width: 40px; height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1rem;
        flex-shrink: 0;
    }
    .chat-header-info h3 { margin: 0; font-size: 0.95rem; font-weight: 800; color: #1e293b; }
    .chat-header-info p  { margin: 0; font-size: 0.75rem; color: #64748b; }
    .chat-header-actions { margin-left: auto; display: flex; gap: 8px; }

    /* SCROLL WRAPPER — hanya ini yang punya scroll, bukan chat-body */
    .chat-body-scroll {
        max-height: 480px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #bfdbfe #f8faff;
    }
    .chat-body-scroll::-webkit-scrollbar { width: 5px; }
    .chat-body-scroll::-webkit-scrollbar-track { background: #f8faff; }
    .chat-body-scroll::-webkit-scrollbar-thumb { background: #bfdbfe; border-radius: 10px; }

    /* CHAT BODY — hanya layout, tidak ada overflow */
    .chat-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* MESSAGE CARD */
    .msg-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 0;
        overflow: hidden;
        transition: box-shadow 0.2s, transform 0.2s;
        animation: fadeSlideIn 0.35s ease both;
    }
    .msg-card:hover {
        box-shadow: 0 8px 30px rgba(37,99,235,0.12);
        transform: translateY(-2px);
    }
    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Stagger animation delays */
    .msg-card:nth-child(1) { animation-delay: 0.05s; }
    .msg-card:nth-child(2) { animation-delay: 0.1s; }
    .msg-card:nth-child(3) { animation-delay: 0.15s; }
    .msg-card:nth-child(4) { animation-delay: 0.2s; }
    .msg-card:nth-child(5) { animation-delay: 0.25s; }

    /* CARD HEAD */
    .msg-card-head {
        padding: 14px 16px 10px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .msg-avatar {
        width: 44px; height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1rem; font-weight: 800;
        flex-shrink: 0;
        position: relative;
    }
    .msg-avatar-ring {
        position: absolute;
        inset: -2px;
        border-radius: 16px;
        border: 2px solid rgba(37,99,235,0.2);
    }
    .msg-meta { flex: 1; min-width: 0; }
    .msg-meta-name {
        font-size: 0.88rem;
        font-weight: 800;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }
    .msg-meta-name .subject-badge {
        font-size: 0.7rem;
        font-weight: 700;
        background: #eff6ff;
        color: #2563eb;
        padding: 2px 8px;
        border-radius: 999px;
        border: 1px solid #bfdbfe;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }
    .msg-meta-email {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .msg-timestamp {
        font-size: 0.7rem;
        color: #94a3b8;
        flex-shrink: 0;
        white-space: nowrap;
    }

    /* CHAT BUBBLE */
    .msg-bubble-wrap {
        padding: 0 16px 12px 72px;
    }
    .msg-bubble {
        background: #f1f5f9;
        border-radius: 0 14px 14px 14px;
        padding: 10px 14px;
        font-size: 0.85rem;
        color: #334155;
        line-height: 1.55;
        position: relative;
        word-break: break-word;
    }
    .msg-bubble::before {
        content: '';
        position: absolute;
        top: 0; left: -8px;
        width: 0; height: 0;
        border-top: 8px solid #f1f5f9;
        border-left: 8px solid transparent;
    }

    /* CARD ACTIONS */
    .msg-card-actions {
        padding: 10px 16px 14px 72px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        border-top: 1px solid #f1f5f9;
        margin-top: 4px;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: opacity 0.18s, transform 0.18s;
        font-family: inherit;
        white-space: nowrap;
    }
    .action-btn:hover { opacity: 0.85; transform: translateY(-1px); }
    .action-btn:active { transform: translateY(0); }

    .btn-show-msg {
        background: linear-gradient(135deg, #4f46e5, #8b5cf6);
        color: #fff;
    }
    .btn-reply-msg {
        background: linear-gradient(135deg, #0891b2, #06b6d4);
        color: #fff;
    }
    .btn-delete-msg {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: #fff;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 600px) {
        .msg-topbar { padding: 16px; border-radius: 16px; }
        .msg-topbar-left h2 { font-size: 1.1rem; }
        .chat-body-scroll { max-height: 380px; }
        .chat-body { padding: 14px; }
        .msg-card-head { padding: 12px 12px 8px; gap: 10px; }
        .msg-avatar { width: 38px; height: 38px; font-size: 0.875rem; }
        .msg-bubble-wrap { padding: 0 12px 10px 60px; }
        .msg-card-actions { padding: 8px 12px 12px 60px; gap: 6px; }
        .action-btn { padding: 6px 11px; font-size: 0.74rem; }
        .msg-meta-name .subject-badge { max-width: 110px; }
    }

    @media (max-width: 400px) {
        .msg-card-actions { padding-left: 12px; }
        .msg-bubble-wrap { padding-left: 12px; }
        .msg-bubble::before { display: none; }
    }
</style>

<div class="msg-page">

    {{-- TOP BAR --}}
    <div class="msg-topbar">
        <div class="msg-topbar-left">
            <h2><i class="fa-solid fa-inbox" style="margin-right:8px;"></i>Pesan Masuk</h2>
            <p>Semua pesan yang dikirim melalui formulir kontak</p>
        </div>
        <div class="msg-topbar-right">
            <div class="msg-count-badge">
                <span class="dot"></span>
                {{ $messages->count() ?? count($messages) }} Pesan
            </div>
        </div>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
    <div class="msg-alert-success">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- CHAT ROOM --}}
    <div class="chat-room">

        {{-- CHAT HEADER --}}
        <div class="chat-header">
            <div class="chat-header-icon">
                <i class="fa-solid fa-comments"></i>
            </div>
            <div class="chat-header-info">
                <h3>Kotak Pesan</h3>
                <p>Inbox pesan dari pengguna NexFi</p>
            </div>
            <div class="chat-header-actions">
                <div style="display:flex;align-items:center;gap:5px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:5px 12px;font-size:0.75rem;font-weight:700;color:#2563eb;">
                    <i class="fa-solid fa-envelope-open-text" style="font-size:0.7rem;"></i>
                    Semua Pesan
                </div>
            </div>
        </div>

        {{-- CHAT BODY --}}
        <div class="chat-body-scroll">
        <div class="chat-body" id="chatBody">

            @forelse($messages as $msg)

            @php
                $initial = strtoupper(substr($msg->name, 0, 1));
                $colors = [
                    'background: linear-gradient(135deg, #2563eb, #60a5fa)',
                    'background: linear-gradient(135deg, #7c3aed, #a78bfa)',
                    'background: linear-gradient(135deg, #0891b2, #22d3ee)',
                    'background: linear-gradient(135deg, #059669, #34d399)',
                    'background: linear-gradient(135deg, #dc2626, #f87171)',
                    'background: linear-gradient(135deg, #d97706, #fbbf24)',
                ];
                $colorStyle = $colors[$loop->index % count($colors)];
            @endphp

            <div class="msg-card">

                {{-- CARD HEAD --}}
                <div class="msg-card-head">
                    <div class="msg-avatar" style="{{ $colorStyle }}">
                        <span>{{ $initial }}</span>
                        <div class="msg-avatar-ring"></div>
                    </div>

                    <div class="msg-meta">
                        <div class="msg-meta-name">
                            {{ $msg->name }}
                            <span class="subject-badge" title="{{ $msg->subject }}">
                                {{ $msg->subject }}
                            </span>
                        </div>
                        <div class="msg-meta-email">
                            <i class="fa-solid fa-at" style="font-size:0.65rem;color:#94a3b8;"></i>
                            {{ $msg->email }}
                        </div>
                    </div>

                    <div class="msg-timestamp">
                        <i class="fa-regular fa-clock" style="margin-right:3px;"></i>
                        {{ $msg->created_at ? $msg->created_at->diffForHumans() : '' }}
                    </div>
                </div>

                {{-- CHAT BUBBLE --}}
                <div class="msg-bubble-wrap">
                    <div class="msg-bubble">
                        {{ $msg->message }}
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="msg-card-actions">
                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="action-btn btn-show-msg">
                        <i class="fa-solid fa-eye"></i> Lihat
                    </a>
                    <a href="{{ route('admin.messages.replyForm', $msg->id) }}" class="action-btn btn-reply-msg">
                        <i class="fa-solid fa-reply"></i> Balas
                    </a>
                    <form action="{{ route('admin.messages.destroy', $msg->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin mau hapus pesan ini?')"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete-msg">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>

            @empty
            <div class="msg-empty">
                <i class="fa-regular fa-comment-dots"></i>
                <p>Belum ada pesan masuk.</p>
            </div>
            @endforelse

        </div>
        {{-- end chat-body --}}
        </div>
        {{-- end chat-body-scroll --}}

    </div>
    {{-- end chat-room --}}

</div>

<script>
    // Auto-scroll to bottom of chat on load
    document.addEventListener('DOMContentLoaded', function () {
        const scrollWrap = document.querySelector('.chat-body-scroll');
        if (scrollWrap) {
            scrollWrap.scrollTop = scrollWrap.scrollHeight;
        }
        }
    });
</script>

@endsection