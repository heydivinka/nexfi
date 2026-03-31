<!DOCTYPE html>
<html lang="id" style="overflow-x:hidden;">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NexFi — Your Next Future in Finance</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    html, body { margin:0; padding:0; overflow-x:hidden !important; max-width:100%; font-family:'Inter',sans-serif; }
    body { background:#07080f !important; color:rgba(255,255,255,0.9) !important; }

    :root {
      --bg:      #07080f;
      --bg2:     #0c0d1d;
      --bg3:     #10132a;
      --accent:  #6c63ff;
      --accent2: #9b59f5;
      --border:  rgba(108,99,255,0.2);
      --glow:    rgba(108,99,255,0.3);
      --muted:   rgba(255,255,255,0.38);
      --muted2:  rgba(255,255,255,0.55);
    }

    /* ===== SWEETALERT2 ===== */
    .swal2-container { z-index: 99999 !important; }
    .swal2-popup.nexfi-alert {
      background: linear-gradient(145deg, #0e0f20, #12132a) !important;
      border: 1px solid rgba(108,99,255,0.35) !important;
      border-radius: 24px !important;
      box-shadow: 0 0 0 1px rgba(108,99,255,0.1), 0 24px 80px rgba(0,0,0,0.6), 0 0 60px rgba(108,99,255,0.12) !important;
      font-family: 'Inter', sans-serif !important;
      padding: 36px 32px 28px !important;
    }
    .swal2-popup.nexfi-alert .swal2-title { color:#fff !important; font-family:'Inter',sans-serif !important; font-weight:800 !important; font-size:1.25rem !important; letter-spacing:-0.02em !important; margin-bottom:4px !important; }
    .swal2-popup.nexfi-alert .swal2-html-container { color:rgba(255,255,255,0.55) !important; font-family:'Inter',sans-serif !important; font-size:0.875rem !important; line-height:1.7 !important; margin-top:8px !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-success { border-color:rgba(108,99,255,0.4) !important; color:#6c63ff !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-success .swal2-success-ring { border-color:rgba(108,99,255,0.2) !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-success [class^='swal2-success-line'] { background-color:#6c63ff !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-warning { border-color:rgba(245,158,11,0.5) !important; color:#f59e0b !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-error { border-color:rgba(239,68,68,0.4) !important; }
    .swal2-popup.nexfi-alert .swal2-icon.swal2-error [class^='swal2-x-mark-line'] { background-color:#ef4444 !important; }
    .swal2-popup.nexfi-alert .swal2-actions { margin-top:24px !important; gap:10px !important; }
    .swal2-popup.nexfi-alert .swal2-confirm { background:linear-gradient(135deg,#6c63ff,#9b59f5) !important; border:none !important; border-radius:9999px !important; font-family:'Inter',sans-serif !important; font-weight:700 !important; font-size:0.875rem !important; padding:11px 28px !important; box-shadow:0 8px 24px rgba(108,99,255,0.4) !important; transition:opacity 0.2s,transform 0.2s !important; }
    .swal2-popup.nexfi-alert .swal2-confirm:hover { opacity:0.88 !important; transform:translateY(-1px) !important; }
    .swal2-popup.nexfi-alert .swal2-cancel { background:rgba(255,255,255,0.06) !important; border:1px solid rgba(255,255,255,0.1) !important; border-radius:9999px !important; color:rgba(255,255,255,0.5) !important; font-family:'Inter',sans-serif !important; font-weight:600 !important; font-size:0.875rem !important; padding:11px 28px !important; }
    .swal2-popup.nexfi-alert .swal2-timer-progress-bar { background:linear-gradient(90deg,#6c63ff,#9b59f5) !important; border-radius:0 0 24px 24px !important; }
    .swal2-backdrop-show { background:rgba(0,0,0,0.75) !important; backdrop-filter:blur(6px) !important; }

    /* ===== YOUTUBE THUMB ===== */
    .yt-thumb { position:relative; cursor:pointer; display:block; width:100%; overflow:hidden; aspect-ratio:16/9; }
    .yt-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
    .yt-play { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; }
    .yt-play div { width:68px; height:68px; border-radius:50%; background:#dc2626; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.5rem; box-shadow:0 8px 30px rgba(0,0,0,0.5); transition:transform 0.2s,box-shadow 0.2s; }
    .yt-thumb:hover .yt-play div { transform:scale(1.08); box-shadow:0 12px 40px rgba(220,38,38,0.5); }

    /* ===== VIDEO MODAL — always flexbox centered ===== */
    .vmodal {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: rgba(0,0,0,0.88);
      backdrop-filter: blur(8px);
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .vmodal.open { display: flex; }
    .vmodal-inner {
      position: relative;
      width: 100%;
      max-width: 800px;
      background: #0e0f20;
      border-radius: 18px;
      border: 1px solid rgba(108,99,255,0.25);
      padding: 12px;
      box-shadow: 0 24px 80px rgba(0,0,0,0.7);
    }
    .vmodal-inner iframe { width:100%; aspect-ratio:16/9; border:none; border-radius:10px; display:block; }
    .vmodal-close {
      position: absolute; top:-14px; right:-14px;
      width:34px; height:34px; border-radius:50%;
      background:#1a1b2e; border:1px solid rgba(255,255,255,0.15);
      color:#fff; font-size:18px; cursor:pointer;
      display:flex; align-items:center; justify-content:center;
      transition:background 0.2s; z-index:10;
    }
    .vmodal-close:hover { background:rgba(239,68,68,0.4); }

    /* ===== UTILS ===== */
    .gradient-text { background:linear-gradient(135deg,var(--accent),var(--accent2)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .btn-login-nav { -webkit-text-fill-color:#fff !important; }
    .bg-grid-overlay { position:fixed; top:0; left:0; width:100vw; height:100vh; pointer-events:none; z-index:0; background-image:linear-gradient(rgba(108,99,255,0.12) 1px,transparent 1px),linear-gradient(90deg,rgba(108,99,255,0.12) 1px,transparent 1px); background-size:40px 40px; }
    .card-dark { background:#0c0d1d; border:1px solid var(--border); border-radius:18px; }
    .card-dark:hover { box-shadow:0 8px 32px rgba(108,99,255,0.15); }
    .inp-dark { width:100%; background:rgba(255,255,255,0.05); border:1.5px solid rgba(255,255,255,0.09); border-radius:12px; padding:12px 16px; font-size:14px; font-family:'Inter',sans-serif; font-weight:500; color:#fff; outline:none; transition:all 0.2s; }
    .inp-dark::placeholder { color:rgba(255,255,255,0.2); }
    .inp-dark:focus { background:rgba(108,99,255,0.08); border-color:var(--accent); box-shadow:0 0 0 4px rgba(108,99,255,0.12); }
    .inp-dark[readonly] { opacity:0.65; cursor:not-allowed; }
    .inp-dark[readonly]:focus { background:rgba(255,255,255,0.05); border-color:rgba(255,255,255,0.09); box-shadow:none; }
    .form-label { font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.07em; color:rgba(255,255,255,0.35); display:block; margin-bottom:6px; }
    .section-divider { height:1px; background:linear-gradient(90deg,transparent,rgba(108,99,255,0.3),transparent); }

    /* ===== NAVBAR ===== */
    #navbar { position:fixed; top:0; left:0; right:0; z-index:50; height:66px; padding:0 5%; display:flex; align-items:center; justify-content:space-between; background:rgba(7,8,15,0.95); backdrop-filter:blur(20px); border-bottom:1px solid rgba(108,99,255,0.15); }
    #navLinks { display:none; gap:32px; list-style:none; margin:0; padding:0; align-items:center; }
    #navAuthDesktop { display:none; }
    #hamburger { display:flex; flex-direction:column; gap:5px; cursor:pointer; background:transparent; border:none; padding:4px; z-index:51; }

    /* ===== MOBILE MENU ===== */
    #mobileMenu { display:none; position:fixed; top:66px; left:0; right:0; padding:24px 6% 32px; z-index:40; flex-direction:column; gap:20px; background:rgba(7,8,15,0.97); backdrop-filter:blur(20px); border-top:1px solid rgba(108,99,255,0.15); box-shadow:0 20px 60px rgba(0,0,0,0.6); }

    /* ===== ABOUT ===== */
    #aboutSection { padding:80px 5%; position:relative; overflow:hidden; background:linear-gradient(180deg,#07080f 0%,#0c0d1d 100%); z-index:1; }
    #aboutInner { max-width:1200px; margin:0 auto; width:100%; }
    #aboutHeader { margin-bottom:24px; }
    #aboutBottom { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
    #featureGrid { display:flex; flex-direction:column; gap:12px; }

    /* YouTube card — centered wrapper */
    #ytCardWrap { display:flex; justify-content:center; align-items:flex-start; }
    #youtubeCard { width:100%; border-radius:22px; overflow:hidden; border:1px solid var(--border); box-shadow:0 16px 60px rgba(108,99,255,0.15); background:#0c0d1d; }
    #youtubeCard .yt-body { padding:20px 24px 24px; }
    #youtubeCard .yt-body p { font-size:0.88rem; line-height:1.6; color:var(--muted2); margin:0 0 16px; }
    #youtubeCard .yt-body button.yt-btn { display:flex; align-items:center; justify-content:center; gap:8px; color:#fff; padding:12px; border-radius:9999px; font-weight:700; font-size:0.9rem; background:#dc2626; transition:opacity 0.2s; border:none; cursor:pointer; width:100%; font-family:'Inter',sans-serif; }
    #youtubeCard .yt-body button.yt-btn:hover { opacity:0.88; }

    /* ===== TESTI ===== */
    .testi-track { display:flex; gap:24px; transition:transform 0.42s cubic-bezier(0.4,0,0.2,1); align-items:stretch; }
    .testi-slide { flex:0 0 calc((100% - 48px) / 3); min-width:0; }
    .testi-dots { display:flex; justify-content:center; gap:8px; margin-top:28px; }
    .testi-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.15); cursor:pointer; border:none; padding:0; transition:all 0.25s; }
    .testi-dot.active { width:24px; border-radius:4px; background:linear-gradient(90deg,var(--accent),var(--accent2)); }

    /* ===== FORM ===== */
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
    .btn-kirim { grid-column:1/-1; display:flex; align-items:center; justify-content:center; gap:8px; color:#fff; font-weight:700; padding:14px; border-radius:16px; border:none; cursor:pointer; font-size:0.875rem; font-family:'Inter',sans-serif; background:linear-gradient(135deg,var(--accent),var(--accent2)); box-shadow:0 10px 30px var(--glow); transition:opacity 0.2s,transform 0.2s; width:100%; }
    .btn-kirim:hover { opacity:0.9; transform:translateY(-1px); }
    .btn-kirim:active { transform:translateY(0); }
    .btn-kirim:disabled { opacity:0.6; cursor:not-allowed; transform:none; }

    /* ===== AUTH GATE ===== */
    .auth-gate { text-align:center; padding:52px 24px; display:flex; flex-direction:column; align-items:center; gap:14px; }
    .auth-gate-icon { width:72px; height:72px; border-radius:50%; background:rgba(108,99,255,0.12); border:1px solid rgba(108,99,255,0.3); display:flex; align-items:center; justify-content:center; margin-bottom:4px; }

    /* ===== FOOTER ===== */
    .footer-grid { display:flex; flex-wrap:wrap; align-items:flex-start; justify-content:space-between; gap:32px; padding-bottom:32px; border-bottom:1px solid rgba(255,255,255,0.07); }

    /* ===== HERO BUTTONS ===== */
    .hero-btns { display:flex; flex-wrap:wrap; gap:12px; justify-content:center; }

    /* ===== RESPONSIVE ===== */
    @media (min-width:768px) {
      #navLinks       { display:flex !important; }
      #navAuthDesktop { display:block !important; }
      #hamburger      { display:none !important; }
    }

    @media (max-width:767px) {
      /* About: stack vertically */
      #aboutBottom { grid-template-columns:1fr; gap:24px; }

      /* YouTube card centered + max-width */
      #ytCardWrap  { justify-content:center; }
      #youtubeCard { max-width:460px; }

      /* Smaller play button */
      .yt-play div { width:52px; height:52px; font-size:1.2rem; }

      /* Testi: 1 per page on mobile */
      .testi-track { gap:16px; }
      .testi-slide { flex:0 0 100%; }

      /* Form: 1 column */
      .form-grid     { grid-template-columns:1fr !important; }
      .form-grid > * { grid-column:1 !important; }
      .btn-kirim     { grid-column:1 !important; }

      /* Footer: stacked */
      .footer-grid { flex-direction:column; gap:24px; }

      /* Hero buttons: full width stacked */
      .hero-btns   { flex-direction:column; align-items:stretch; }
      .hero-btns a { justify-content:center !important; }

      /* Section padding */
      #aboutSection { padding:60px 4%; }
      #testi        { padding:60px 4% !important; }
      #kontak       { padding:60px 4% !important; }
      footer        { padding:36px 4% 20px !important; }

      /* Modal */
      .vmodal       { padding:12px; }
      .vmodal-inner { max-width:100%; }
    }
  </style>
</head>
<body>

<div class="bg-grid-overlay"></div>
<div style="position:fixed;width:600px;height:600px;background:radial-gradient(circle,rgba(108,99,255,0.22) 0%,transparent 70%);top:-180px;left:-140px;border-radius:50%;pointer-events:none;z-index:0;"></div>
<div style="position:fixed;width:500px;height:500px;background:radial-gradient(circle,rgba(155,89,245,0.16) 0%,transparent 70%);bottom:-120px;right:-100px;border-radius:50%;pointer-events:none;z-index:0;"></div>

<!-- NAVBAR -->
<nav id="navbar">
  <a href="#home" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
    <img src="{{ asset('assets_public/logo.png') }}" alt="NexFi" style="height:52px;width:auto;object-fit:contain;">
  </a>
  <ul id="navLinks">
    <li><a href="#home"         style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-house"></i> Beranda</a></li>
    <li><a href="#aboutSection" style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-circle-info"></i> Tentang</a></li>
    <li><a href="#testi"        style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-star"></i> Testimoni</a></li>
    <li><a href="#kontak"       style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-envelope"></i> Nara Hubung</a></li>
  </ul>
  <div id="navAuthDesktop">
    @auth
    <a href="{{ route('pengguna.dashboard') }}" class="btn-login-nav" style="display:flex;align-items:center;gap:6px;color:#fff;font-weight:700;font-size:0.875rem;padding:8px 20px;border-radius:9999px;text-decoration:none;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 16px var(--glow);">
      <i class="fa-solid fa-gauge"></i> Dashboard
    </a>
    @else
    <a href="{{ route('login') }}" class="btn-login-nav" style="display:flex;align-items:center;gap:6px;color:#fff;font-weight:700;font-size:0.875rem;padding:8px 20px;border-radius:9999px;text-decoration:none;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 16px var(--glow);">
      <i class="fa-solid fa-right-to-bracket"></i> Login
    </a>
    @endauth
  </div>
  <button id="hamburger" onclick="toggleMenu()">
    <span style="display:block;width:24px;height:2.5px;border-radius:2px;background:var(--accent);"></span>
    <span style="display:block;width:24px;height:2.5px;border-radius:2px;background:var(--accent);"></span>
    <span style="display:block;width:24px;height:2.5px;border-radius:2px;background:var(--accent);"></span>
  </button>
</nav>

<!-- MOBILE MENU -->
<div id="mobileMenu">
  <a href="#home"         style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-house"></i> Berada</a>
  <a href="#aboutSection" style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-circle-info"></i> Tentang</a>
  <a href="#testi"        style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-star"></i> Testimoni</a>
  <a href="#kontak"       style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-envelope"></i> Nara Hubung</a>
  @auth
  <a href="{{ route('pengguna.dashboard') }}" class="btn-login-nav" style="display:flex;justify-content:center;align-items:center;gap:8px;color:#fff;font-weight:700;padding:10px 20px;border-radius:9999px;text-decoration:none;background:linear-gradient(135deg,var(--accent),var(--accent2));margin-top:4px;">
    <i class="fa-solid fa-gauge"></i> Dashboard
  </a>
  @else
  <a href="{{ route('login') }}" class="btn-login-nav" style="display:flex;justify-content:center;align-items:center;gap:8px;color:#fff;font-weight:700;padding:10px 20px;border-radius:9999px;text-decoration:none;background:linear-gradient(135deg,var(--accent),var(--accent2));margin-top:4px;">
    <i class="fa-solid fa-right-to-bracket"></i> Login
  </a>
  @endauth
</div>

<!-- HERO -->
<section id="home" style="min-height:100svh;display:flex;align-items:center;justify-content:center;padding:100px 5% 64px;position:relative;overflow:hidden;z-index:1;text-align:center;">
  
  <!-- Background -->
  <div style="position:absolute;top:-180px;right:-180px;width:700px;height:700px;border-radius:50%;background:radial-gradient(circle,rgba(108,99,255,0.1) 0%,transparent 70%);pointer-events:none;"></div>
  <div style="position:absolute;bottom:-100px;left:-100px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(155,89,245,0.08) 0%,transparent 70%);pointer-events:none;"></div>

  <div style="max-width:700px;width:100%;position:relative;z-index:2;">
    
    <!-- Badge -->
    <div style="display:inline-flex;align-items:center;gap:6px;border-radius:9999px;padding:6px 16px;font-size:0.8rem;font-weight:700;margin-bottom:24px;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent);">
      <i class="fa-solid fa-bolt"></i> Platform Keuangan Digital
    </div>

    <!-- Headline -->
    <h1 style="font-size:clamp(2rem,7vw,3.6rem);font-weight:800;line-height:1.15;letter-spacing:-0.02em;color:#fff;margin:0 0 16px;">
      Atur Keuanganmu, <span class="gradient-text">Kuasai Masa Depanmu</span>
    </h1>

    <!-- Subheadline -->
    <p style="font-size:1rem;line-height:1.7;color:var(--muted2);margin:0 auto 32px;max-width:520px;">
      Solusi cerdas untuk mengelola keuangan secara mudah dan aman.
    </p>

    <!-- Buttons -->
    <div class="hero-btns">
      <a href="{{ route('login') }}"
        style="display:flex;align-items:center;justify-content:center;gap:8px;color:#fff;font-weight:700;padding:12px 24px;min-width:180px;border-radius:9999px;border:none;cursor:pointer;font-size:0.875rem;font-family:'Inter',sans-serif;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 8px 25px var(--glow);text-decoration:none;">
        <i class="fa-solid fa-rocket"></i> Mulai Sekarang
      </a>

      <a href="{{ route('kebijakan.index') }}"
        style="display:flex;align-items:center;justify-content:center;gap:8px;font-weight:700;padding:12px 24px;min-width:180px;border-radius:9999px;border:2px solid rgba(108,99,255,0.4);cursor:pointer;font-size:0.875rem;font-family:'Inter',sans-serif;background:transparent;color:var(--accent);text-decoration:none;"
        onmouseover="this.style.background='rgba(108,99,255,0.15)'" 
        onmouseout="this.style.background='transparent'">
        <i class="fa-solid fa-shield-halved"></i> Kebijakan Privasi
      </a>
    </div>

  </div>
</section>

<!-- ABOUT -->
<section id="aboutSection">
  <div id="aboutInner">
    <div id="aboutHeader">
      <div style="display:inline-flex;align-items:center;gap:6px;border-radius:9999px;padding:6px 16px;font-size:0.8rem;font-weight:700;margin-bottom:16px;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent);">
        <i class="fa-solid fa-circle-question"></i> Tentang Kami
      </div>
      <h2 style="font-size:clamp(1.7rem,3.5vw,2.6rem);font-weight:800;letter-spacing:-0.02em;line-height:1.2;color:#fff;margin:0 0 12px;">
        Apa Itu <span class="gradient-text">NexFi?</span>
      </h2>
      <p style="line-height:1.7;font-size:0.95rem;color:var(--muted2);margin:0;">
        Kelola finansialmu tanpa ribet dengan fitur pintar dari NexFi — solusi keuangan modern untuk kehidupan yang lebih terencana.
      </p>
    </div>
    <div id="aboutBottom">
      <!-- Features -->
      <div>
        <div id="featureGrid">
          <div class="card-dark" style="display:flex;flex-direction:column;gap:8px;padding:16px;cursor:default;">
            <div style="width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow);">
              <i class="fa-solid fa-chart-line" style="font-size:0.875rem;"></i>
            </div>
            <div>
              <div style="font-weight:700;font-size:0.92rem;color:#fff;">Pantau cashflow real-time</div>
              <div style="font-size:0.83rem;color:var(--muted2);margin-top:4px;line-height:1.5;">Monitor penghasilan dan pengeluaran dalam satu dashboard.</div>
            </div>
          </div>
          <div class="card-dark" style="display:flex;flex-direction:column;gap:8px;padding:16px;cursor:default;">
            <div style="width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow);">
              <i class="fa-solid fa-magnifying-glass-chart" style="font-size:0.875rem;"></i>
            </div>
            <div>
              <div style="font-weight:700;font-size:0.92rem;color:#fff;">Analisa finansial mudah</div>
              <div style="font-size:0.83rem;color:var(--muted2);margin-top:4px;line-height:1.5;">Insight mendalam dan laporan otomatis setiap saat.</div>
            </div>
          </div>
          <div class="card-dark" style="display:flex;flex-direction:column;gap:8px;padding:16px;cursor:default;">
            <div style="width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow);">
              <i class="fa-solid fa-shield-halved" style="font-size:0.875rem;"></i>
            </div>
            <div>
              <div style="font-weight:700;font-size:0.92rem;color:#fff;">Keamanan terjamin</div>
              <div style="font-size:0.83rem;color:var(--muted2);margin-top:4px;line-height:1.5;">Enkripsi data & proteksi berlapis untuk akun kamu.</div>
            </div>
          </div>
        </div>
        <button style="display:inline-flex;align-items:center;gap:8px;margin-top:24px;color:#fff;font-weight:700;padding:12px 24px;border-radius:9999px;border:none;cursor:pointer;font-size:0.875rem;font-family:'Inter',sans-serif;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 8px 25px var(--glow);">
          Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>

      <!-- PDF Card -->
<div id="ytCardWrap">
  <div id="youtubeCard">
    <div class="yt-thumb" id="openVideo">
      <img 
        src="https://drive.google.com/thumbnail?id=1tkIY1Y_NwjYn5eFM_idOaP_M9RJtSIYD&sz=w800" 
        alt="Guidebook NexFi"
      >
      <div class="yt-play">
        <div><i class="fa-solid fa-book-open" style="margin-left:2px;"></i></div>
      </div>
    </div>
    <div class="yt-body">
      <p>Lihat langsung bagaimana NexFi membantu kamu mengelola keuangan dengan lebih cerdas dan efisien.</p>
      <button class="yt-btn" id="openVideoBtn">
        <i class="fa-solid fa-file-pdf"></i> Buka Guidebook PDF
      </button>
    </div>
  </div>
</div>
    </div>
  </div>
</section>

<!-- PDF MODAL -->
<div id="videoModal" class="vmodal">
  <div class="vmodal-inner">
    <button class="vmodal-close" id="closeModal">&times;</button>
    <iframe 
      id="youtubeFrame" 
      src="" 
      allow="autoplay" 
      allowfullscreen
    ></iframe>
  </div>
</div>

<!-- TESTI -->
<section id="testi" style="padding:80px 5%;position:relative;overflow:hidden;background:#10132a;z-index:1;">
  <div class="section-divider" style="position:absolute;top:0;left:0;right:0;"></div>
  <div class="section-divider" style="position:absolute;bottom:0;left:0;right:0;"></div>
  <div style="max-width:1200px;margin:0 auto;width:100%;">
    <div style="text-align:center;margin-bottom:40px;">
      <div style="display:inline-flex;align-items:center;gap:6px;border-radius:9999px;padding:6px 16px;font-size:0.8rem;font-weight:700;margin-bottom:16px;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent);">
        <i class="fa-solid fa-comments"></i> Testimoni
      </div>
      <h2 style="font-size:clamp(1.7rem,3.5vw,2.6rem);font-weight:800;letter-spacing:-0.02em;color:#fff;margin:0 0 8px;">Apa Kata <span class="gradient-text">Mereka?</span></h2>
      <p style="color:var(--muted2);font-size:0.95rem;max-width:480px;margin:0 auto;line-height:1.6;">Ribuan pengguna sudah merasakan manfaat NexFi.</p>
    </div>
    <div style="overflow:hidden;">
      <div class="testi-track" id="testiTrack">
        @php $publishedTestis = \App\Models\Testimonial::where('status','published')->latest()->get(); @endphp
        @forelse($publishedTestis as $testi)
        <div class="testi-slide">
          <div class="card-dark" style="padding:20px 24px;display:flex;flex-direction:column;height:100%;min-height:210px;">
            <div style="color:#f59e0b;margin-bottom:12px;">
              @for($i=1;$i<=5;$i++)
                @if($i <= $testi->rating)
                  <i class="fa-solid fa-star"></i>
                @else
                  <i class="fa-regular fa-star" style="color:rgba(255,255,255,0.18);"></i>
                @endif
              @endfor
            </div>
            <p style="font-size:0.88rem;line-height:1.6;font-style:italic;color:var(--muted2);flex:1;margin:0 0 20px;">"{{ $testi->isi }}"</p>
            <div style="display:flex;align-items:center;gap:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.07);">
              @if($testi->foto)
                <img src="{{ asset('storage/'.$testi->foto) }}" alt="{{ $testi->nama }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;flex-shrink:0;border:1.5px solid rgba(108,99,255,0.3);">
              @else
                <img src="{{ asset('images/anon.png') }}" alt="anon" style="width:40px;height:40px;border-radius:50%;object-fit:cover;flex-shrink:0;border:1.5px solid rgba(108,99,255,0.3);">
              @endif
              <div>
                <div style="font-weight:700;font-size:0.9rem;color:#fff;">{{ $testi->nama }}</div>
                <div style="font-size:0.75rem;color:var(--muted);">{{ $testi->created_at->format('M Y') }}</div>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="testi-slide">
          <div class="card-dark" style="padding:20px 24px;min-height:210px;display:flex;align-items:center;justify-content:center;">
            <p style="color:var(--muted);font-style:italic;text-align:center;">Belum ada testimoni. Jadilah yang pertama!</p>
          </div>
        </div>
        @endforelse
      </div>
      <div class="testi-dots" id="testiDots"></div>
    </div>
  </div>
</section>

<!-- KONTAK -->
<section id="kontak" style="padding:80px 5%;position:relative;overflow:hidden;background:#07080f;z-index:1;">
  <div class="section-divider" style="position:absolute;top:0;left:0;right:0;"></div>
  <div style="position:absolute;top:-96px;left:-80px;width:420px;height:420px;border-radius:50%;background:radial-gradient(circle,rgba(108,99,255,0.1),transparent 70%);pointer-events:none;"></div>
  <div style="position:absolute;bottom:-96px;right:-80px;width:380px;height:380px;border-radius:50%;background:radial-gradient(circle,rgba(155,89,245,0.1),transparent 70%);pointer-events:none;"></div>
  <div style="max-width:960px;margin:0 auto;width:100%;position:relative;z-index:10;">
    <div style="text-align:center;margin-bottom:40px;">
      <div style="display:inline-flex;align-items:center;gap:8px;border-radius:9999px;padding:6px 16px;font-size:0.8rem;font-weight:700;margin-bottom:20px;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent);">
        <i class="fa-solid fa-headset"></i> Hubungi Kami
      </div>
      <h2 style="font-size:clamp(1.4rem,4vw,2.5rem);font-weight:800;color:#fff;margin:0 0 16px;">Ada Pertanyaan atau Saran?<br><span class="gradient-text">Kami Siap Membantu</span></h2>
      <p style="color:var(--muted2);font-size:0.9rem;max-width:480px;margin:0 auto;">Pilih menu di bawah untuk mengirim pesan atau testimoni.</p>

      {{-- Tab switcher hanya tampil kalau sudah login --}}
      @auth
      <div style="display:flex;justify-content:center;margin-top:32px;">
        <div style="display:flex;padding:4px;border-radius:9999px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.08);">
          <button id="btnTesti" onclick="activateTesti()" style="padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:#fff;border:none;cursor:pointer;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 14px var(--glow);font-family:'Inter',sans-serif;">
            <i class="fa-solid fa-star" style="margin-right:6px;"></i>Testimoni
          </button>
          <button id="btnKoran" onclick="activateKoran()" style="padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:var(--muted2);border:none;cursor:pointer;background:transparent;font-family:'Inter',sans-serif;">
            <i class="fa-solid fa-envelope" style="margin-right:6px;"></i>Kontak
          </button>
        </div>
      </div>
      @endauth
    </div>

    <div style="border-radius:24px;padding:24px;background:#0c0d1d;border:1px solid var(--border);box-shadow:0 10px 45px rgba(108,99,255,0.12);">

      @auth
        {{-- ====================================================== --}}
        {{-- SUDAH LOGIN — tampilkan form                            --}}
        {{-- Nama & email otomatis dari akun (readonly)              --}}
        {{-- ====================================================== --}}

        <!-- Form Testi -->
        <form id="formTesti" class="form-grid">
          <div>
            <label class="form-label">Nama Lengkap</label>
            <div style="position:relative;">
              <input type="text" name="nama" value="{{ auth()->user()->name }}" class="inp-dark" readonly style="padding-right:40px;">
              <i class="fa-solid fa-lock" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:rgba(108,99,255,0.45);font-size:0.72rem;pointer-events:none;"></i>
            </div>
            <div style="font-size:0.7rem;color:rgba(108,99,255,0.6);margin-top:5px;"><i class="fa-solid fa-circle-info" style="margin-right:3px;"></i>Diambil otomatis dari akun kamu</div>
          </div>
          <div>
            <label class="form-label">Email</label>
            <div style="position:relative;">
              <input type="email" name="email" value="{{ auth()->user()->email }}" class="inp-dark" readonly style="padding-right:40px;">
              <i class="fa-solid fa-lock" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:rgba(108,99,255,0.45);font-size:0.72rem;pointer-events:none;"></i>
            </div>
            <div style="font-size:0.7rem;color:rgba(108,99,255,0.6);margin-top:5px;"><i class="fa-solid fa-circle-info" style="margin-right:3px;"></i>Diambil otomatis dari akun kamu</div>
          </div>
          <div style="grid-column:1/-1;">
            <label class="form-label">Foto Profil</label>
            <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
              <div style="width:56px;height:56px;border-radius:50%;overflow:hidden;display:flex;align-items:center;justify-content:center;border:1px solid rgba(108,99,255,0.3);background:rgba(108,99,255,0.1);flex-shrink:0;">
                <img id="avatarPreview" src="" style="display:none;width:100%;height:100%;object-fit:cover;">
                <i id="avatarIcon" class="fa-solid fa-user" style="color:rgba(108,99,255,0.5);font-size:1.1rem;"></i>
              </div>
              <label style="flex:1;min-width:160px;display:flex;align-items:center;gap:12px;cursor:pointer;border-radius:12px;padding:16px;background:rgba(255,255,255,0.04);border:1.5px dashed rgba(108,99,255,0.3);">
                <i class="fa-solid fa-cloud-arrow-up" style="color:var(--accent);flex-shrink:0;"></i>
                <div>
                  <div style="font-weight:600;font-size:0.875rem;color:rgba(255,255,255,0.7);">Klik untuk upload foto</div>
                  <div style="font-size:0.75rem;color:var(--muted);">PNG / JPG (max 2MB)</div>
                </div>
                <input type="file" name="foto" id="fotoInput" accept="image/*" style="display:none;">
              </label>
            </div>
          </div>
          <div style="grid-column:1/-1;">
            <label class="form-label">Rating</label>
            <div id="ratingStars" style="display:flex;gap:8px;font-size:1.7rem;cursor:pointer;">
              <i class="fa-solid fa-star" data-value="1" style="color:rgba(255,255,255,0.15);transition:color 0.15s,transform 0.15s;"></i>
              <i class="fa-solid fa-star" data-value="2" style="color:rgba(255,255,255,0.15);transition:color 0.15s,transform 0.15s;"></i>
              <i class="fa-solid fa-star" data-value="3" style="color:rgba(255,255,255,0.15);transition:color 0.15s,transform 0.15s;"></i>
              <i class="fa-solid fa-star" data-value="4" style="color:rgba(255,255,255,0.15);transition:color 0.15s,transform 0.15s;"></i>
              <i class="fa-solid fa-star" data-value="5" style="color:rgba(255,255,255,0.15);transition:color 0.15s,transform 0.15s;"></i>
            </div>
            <input type="hidden" name="rating" id="ratingInput">
          </div>
          <div style="grid-column:1/-1;">
            <label class="form-label">Testimoni</label>
            <textarea name="isi" rows="4" placeholder="Ceritakan pengalamanmu..." class="inp-dark" style="resize:none;" required></textarea>
          </div>
          <button type="button" onclick="submitTesti(this)" class="btn-kirim">
            <i class="fa-solid fa-paper-plane"></i> Kirim Testimoni
          </button>
        </form>

        <!-- Form Kontak -->
        <form id="formKoran" class="form-grid" style="display:none;">
          <div>
            <label class="form-label">Nama Lengkap</label>
            <div style="position:relative;">
              <input type="text" name="name" value="{{ auth()->user()->name }}" class="inp-dark" readonly style="padding-right:40px;">
              <i class="fa-solid fa-lock" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:rgba(108,99,255,0.45);font-size:0.72rem;pointer-events:none;"></i>
            </div>
            <div style="font-size:0.7rem;color:rgba(108,99,255,0.6);margin-top:5px;"><i class="fa-solid fa-circle-info" style="margin-right:3px;"></i>Diambil otomatis dari akun kamu</div>
          </div>
          <div>
            <label class="form-label">Email</label>
            <div style="position:relative;">
              <input type="email" name="email" value="{{ auth()->user()->email }}" class="inp-dark" readonly style="padding-right:40px;">
              <i class="fa-solid fa-lock" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);color:rgba(108,99,255,0.45);font-size:0.72rem;pointer-events:none;"></i>
            </div>
            <div style="font-size:0.7rem;color:rgba(108,99,255,0.6);margin-top:5px;"><i class="fa-solid fa-circle-info" style="margin-right:3px;"></i>Diambil otomatis dari akun kamu</div>
          </div>
          <div style="grid-column:1/-1;"><label class="form-label">Subjek</label><input type="text" name="subject" placeholder="Topik pesan" class="inp-dark"></div>
          <div style="grid-column:1/-1;"><label class="form-label">Pesan</label><textarea rows="5" name="message" placeholder="Tulis pesan kamu..." class="inp-dark" style="resize:none;"></textarea></div>
          <button type="button" onclick="handleSubmitKoran(this)" class="btn-kirim">
            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
          </button>
        </form>

      @else
        {{-- ====================================================== --}}
        {{-- BELUM LOGIN — tampilkan auth gate, form hidden total    --}}
        {{-- ====================================================== --}}
        <div class="auth-gate">
          <div class="auth-gate-icon">
            <i class="fa-solid fa-lock" style="font-size:1.75rem;color:var(--accent);"></i>
          </div>
          <h3 style="font-size:1.15rem;font-weight:800;color:#fff;margin:0;">Login dulu, ya!</h3>
          <p style="color:var(--muted2);font-size:0.9rem;margin:0;max-width:340px;line-height:1.6;">Kamu harus login untuk bisa mengirim testimoni atau pesan kepada kami.</p>
          <div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center;margin-top:8px;">
            <a href="{{ route('login') }}" style="display:inline-flex;align-items:center;gap:8px;color:#fff;font-weight:700;padding:12px 28px;border-radius:9999px;background:linear-gradient(135deg,var(--accent),var(--accent2));text-decoration:none;box-shadow:0 8px 25px var(--glow);font-size:0.875rem;">
              <i class="fa-solid fa-right-to-bracket"></i> Login Sekarang
            </a>
            <a href="{{ route('register') }}" style="display:inline-flex;align-items:center;gap:8px;color:var(--accent);font-weight:700;padding:12px 28px;border-radius:9999px;border:2px solid rgba(108,99,255,0.4);text-decoration:none;font-size:0.875rem;background:transparent;" onmouseover="this.style.background='rgba(108,99,255,0.1)'" onmouseout="this.style.background='transparent'">
              <i class="fa-solid fa-user-plus"></i> Daftar Gratis
            </a>
          </div>
        </div>
      @endauth

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer style="padding:48px 6% 24px;background:#04050c;border-top:1px solid rgba(108,99,255,0.2);position:relative;z-index:1;">
  <div style="max-width:1200px;margin:0 auto;">
    
    <div class="footer-grid">
      
      <!-- Brand -->
      <div>
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
          <img src="{{ asset('assets_public/logo.png') }}" alt="NexFi" style="height:52px;width:auto;object-fit:contain;">
        </div>
        <p style="font-size:0.83rem;color:var(--muted);max-width:220px;margin:0;">
          Atur keuanganmu dengan lebih cerdas bersama NexFi.
        </p>
      </div>

      <!-- Sosial -->
      <div>
        <div style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.3);margin-bottom:12px;">
          Ikuti Kami
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
          <a href="https://youtu.be/p8Ho0LaeNuo?si=GHu4zQvr9mlXiG3W" target="_blank"
            style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4);text-decoration:none;"
            onmouseover="this.style.background='#dc2626';this.style.color='#fff'"
            onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-youtube" style="font-size:0.875rem;"></i>
          </a>
        </div>
      </div>

      <!-- Kontak -->
      <div>
        <div style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.3);margin-bottom:12px;">
          Kontak
        </div>
        <div style="display:flex;flex-direction:column;gap:8px;">
          
          <a href="mailto:support@nexfi.id"
            style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:rgba(255,255,255,0.4);text-decoration:none;"
            onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-solid fa-envelope" style="font-size:0.75rem;"></i> support@nexfi.id
          </a>

          <a href="https://wa.me/62895404171275" target="_blank"
            style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:rgba(255,255,255,0.4);text-decoration:none;"
            onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-whatsapp" style="font-size:0.75rem;"></i> +62 895-4041-7275
          </a>

          <span style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:rgba(255,255,255,0.4);">
            <i class="fa-solid fa-location-dot" style="font-size:0.75rem;"></i> Indonesia
          </span>

        </div>
      </div>

    </div>

    <!-- Copyright -->
    <div style="padding-top:20px;text-align:center;font-size:0.82rem;color:rgba(255,255,255,0.2);">
      &copy; 2026 <strong style="color:rgba(255,255,255,0.35);">NexFi</strong>. Seluruh hak dilindungi.
    </div>

  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
/* ===== SWEETALERT2 ===== */
const NexSwal = Swal.mixin({
  customClass: { popup: 'nexfi-alert' },
  background: '#0e0f20', color: '#ffffff',
  timerProgressBar: true, showClass: { popup: '' }, hideClass: { popup: '' }
});
function nexIcon(type) {
  const map = {
    success: { bg:'rgba(108,99,255,0.15)', color:'#a78bfa', icon:'fa-circle-check' },
    error:   { bg:'rgba(239,68,68,0.12)',  color:'#f87171', icon:'fa-circle-xmark' },
    warning: { bg:'rgba(245,158,11,0.12)', color:'#fbbf24', icon:'fa-triangle-exclamation' },
    info:    { bg:'rgba(56,189,248,0.12)', color:'#38bdf8', icon:'fa-circle-info' },
  };
  const m = map[type] || map.info;
  return `<div style="width:64px;height:64px;border-radius:50%;background:${m.bg};display:flex;align-items:center;justify-content:center;margin:0 auto 4px;"><i class="fa-solid ${m.icon}" style="font-size:1.75rem;color:${m.color};"></i></div>`;
}
function showAlert({ type, title, html, confirmText = 'Oke!', timer = 0 }) {
  return NexSwal.fire({
    html: `${nexIcon(type)}<div style="font-size:1.1rem;font-weight:800;color:#fff;margin:12px 0 6px;letter-spacing:-0.01em;">${title}</div><div style="font-size:0.85rem;color:rgba(255,255,255,0.5);line-height:1.7;">${html}</div>`,
    showConfirmButton: true, confirmButtonText: confirmText, confirmButtonColor: '#6c63ff',
    timer: timer || undefined, padding: '32px 28px 24px', width: 420, buttonsStyling: true,
  });
}

/* ===== NAVBAR ===== */
function applyNavLayout() {
  var d = window.innerWidth >= 768;
  document.getElementById('navLinks').style.display       = d ? 'flex'  : 'none';
  document.getElementById('navAuthDesktop').style.display = d ? 'block' : 'none';
  document.getElementById('hamburger').style.display      = d ? 'none'  : 'flex';
}
applyNavLayout();
window.addEventListener('resize', applyNavLayout);

var menuOpen = false;
function toggleMenu() {
  menuOpen = !menuOpen;
  document.getElementById('mobileMenu').style.display = menuOpen ? 'flex' : 'none';
}
document.querySelectorAll('#mobileMenu a').forEach(function(a) {
  a.addEventListener('click', function() { menuOpen = false; document.getElementById('mobileMenu').style.display = 'none'; });
});
window.addEventListener('scroll', function() {
  document.getElementById('navbar').style.boxShadow = window.scrollY > 20 ? '0 4px 30px rgba(0,0,0,0.5)' : 'none';
});

/* ===== KONTAK TABS ===== */
function activateTesti() {
  var fT = document.getElementById('formTesti');
  var fK = document.getElementById('formKoran');
  var bT = document.getElementById('btnTesti');
  var bK = document.getElementById('btnKoran');
  if (!fT || !fK) return;
  fT.style.display = 'grid';
  fK.style.display = 'none';
  bT.style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:#fff;border:none;cursor:pointer;font-family:Inter,sans-serif;background:linear-gradient(135deg,#6c63ff,#9b59f5);box-shadow:0 4px 14px rgba(108,99,255,0.4);';
  bK.style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:rgba(255,255,255,0.45);border:none;cursor:pointer;font-family:Inter,sans-serif;background:transparent;';
}
function activateKoran() {
  var fT = document.getElementById('formTesti');
  var fK = document.getElementById('formKoran');
  var bT = document.getElementById('btnTesti');
  var bK = document.getElementById('btnKoran');
  if (!fT || !fK) return;
  fK.style.display = 'grid';
  fT.style.display = 'none';
  bK.style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:#fff;border:none;cursor:pointer;font-family:Inter,sans-serif;background:linear-gradient(135deg,#6c63ff,#9b59f5);box-shadow:0 4px 14px rgba(108,99,255,0.4);';
  bT.style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:rgba(255,255,255,0.45);border:none;cursor:pointer;font-family:Inter,sans-serif;background:transparent;';
}

/* ===== RATING STARS ===== */
var selectedRating = 0;
var starEls = document.querySelectorAll('#ratingStars i');
function paintStars(val) {
  starEls.forEach(function(s) {
    var v = parseInt(s.getAttribute('data-value'));
    s.style.color = v <= val ? '#F59E0B' : 'rgba(255,255,255,0.15)';
    s.style.transform = v <= val ? 'scale(1.15)' : 'scale(1)';
  });
}
starEls.forEach(function(star) {
  star.addEventListener('click', function() { selectedRating = parseInt(this.getAttribute('data-value')); paintStars(selectedRating); });
  star.addEventListener('mouseover', function() { paintStars(parseInt(this.getAttribute('data-value'))); });
  star.addEventListener('mouseout', function() { paintStars(selectedRating); });
});

/* ===== AVATAR UPLOAD ===== */
var fotoInput = document.getElementById('fotoInput');
if (fotoInput) {
  fotoInput.addEventListener('change', function() {
    if (!fotoInput.files.length) return;
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('avatarPreview').src = e.target.result;
      document.getElementById('avatarPreview').style.display = 'block';
      document.getElementById('avatarIcon').style.display = 'none';
    };
    reader.readAsDataURL(fotoInput.files[0]);
  });
}

/* ===== SUBMIT TESTIMONI ===== */
/* nama & email diambil dari server (readonly) — JS hanya kirim rating, isi, foto */
function submitTesti(btn) {
  var form = document.getElementById('formTesti');
  var isi  = form.querySelector('textarea[name="isi"]').value.trim();
  if (!isi || selectedRating === 0) {
    showAlert({ type:'warning', title:'Form belum lengkap!', html:'Mohon tulis testimoni kamu dan pilih <strong style="color:#fbbf24;">rating bintang</strong> terlebih dahulu ya.', confirmText:'Siap, isi dulu! ✍️' });
    return;
  }
  btn.disabled = true;
  var orig = btn.innerHTML;
  btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
  var data = new FormData();
  data.append('_token', '{{ csrf_token() }}');
  data.append('rating', selectedRating);
  data.append('isi', isi);
  var fotoFile = document.getElementById('fotoInput').files[0];
  if (fotoFile) data.append('foto', fotoFile);
  fetch('{{ route("testimonial.store") }}', { method:'POST', body:data })
    .then(function(r) { return r.json(); })
    .then(function(res) {
      if (res.success) {
        showAlert({ type:'success', title:'Terima Kasih! 🎉', html:'Terima kasih atas testimoni Anda.<br><br><span style="color:rgba(255,255,255,0.4);font-size:0.82rem;">Kami akan menyaring konten sebelum mempublish. Tunggu sebentar ya!</span>', confirmText:'Oke, siap! 👍', timer:7000 });
        form.querySelector('textarea[name="isi"]').value = '';
        selectedRating = 0; paintStars(0);
        document.getElementById('avatarPreview').style.display = 'none';
        document.getElementById('avatarIcon').style.display = '';
        document.getElementById('fotoInput').value = '';
      } else {
        showAlert({ type:'error', title:'Gagal Mengirim', html:'Maaf, testimoni kamu gagal terkirim.', confirmText:'Coba Lagi' });
      }
      btn.disabled = false; btn.innerHTML = orig;
    })
    .catch(function() {
      showAlert({ type:'error', title:'Server Error', html:'Terjadi kesalahan pada server.', confirmText:'Tutup' });
      btn.disabled = false; btn.innerHTML = orig;
    });
}

/* ===== SUBMIT KONTAK ===== */
/* nama & email diambil dari server (readonly) — JS hanya validasi subject & message */
function handleSubmitKoran(btn) {
  var form    = document.getElementById('formKoran');
  var subject = form.querySelector('input[name="subject"]').value.trim();
  var message = form.querySelector('textarea[name="message"]').value.trim();
  if (!subject || !message) {
    showAlert({ type:'warning', title:'Form belum lengkap!', html:'Mohon isi <strong style="color:#fbbf24;">subjek</strong> dan <strong style="color:#fbbf24;">pesan</strong> kamu ya.', confirmText:'Oke, lengkapi dulu!' });
    return;
  }
  btn.disabled = true;
  var btnText = btn.innerHTML;
  btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
  fetch('{{ route("kontak.store") }}', { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new FormData(form) })
    .then(function(res) { return res.json(); })
    .then(function(res) {
      if (res.success) {
        showAlert({ type:'success', title:'Pesan Terkirim! ✉️', html:'Terima kasih! Tim kami akan segera menghubungi kamu.', confirmText:'Siap, terima kasih! 🙌', timer:7000 });
        form.querySelector('input[name="subject"]').value = '';
        form.querySelector('textarea[name="message"]').value = '';
      } else {
        showAlert({ type:'error', title:'Gagal Mengirim', html:'Pesan gagal terkirim.', confirmText:'Coba Lagi' });
      }
      btn.disabled = false; btn.innerHTML = btnText;
    })
    .catch(function() {
      showAlert({ type:'error', title:'Server Error', html:'Terjadi kesalahan.', confirmText:'Tutup' });
      btn.disabled = false; btn.innerHTML = btnText;
    });
}

/* ===== TESTIMONIAL SLIDER ===== */
(function() {
  var track    = document.getElementById('testiTrack');
  var dotsWrap = document.getElementById('testiDots');
  if (!track || !dotsWrap) return;
  var slides   = track.querySelectorAll('.testi-slide');
  var total    = slides.length, current = 0, startX = 0, isDragging = false, dragDelta = 0;
  function isMobile()  { return window.innerWidth < 768; }
  function perPage()   { return isMobile() ? 1 : 3; }
  function pageCount() { return Math.ceil(total / perPage()); }
  function slideW()    { return slides[0].offsetWidth + (isMobile() ? 16 : 24); }
  function buildDots() {
    dotsWrap.innerHTML = '';
    for (var i = 0; i < pageCount(); i++) {
      (function(idx) {
        var d = document.createElement('button');
        d.className = 'testi-dot' + (idx === current ? ' active' : '');
        d.addEventListener('click', function() { goTo(idx); });
        dotsWrap.appendChild(d);
      })(i);
    }
  }
  function updateDots() { dotsWrap.querySelectorAll('.testi-dot').forEach(function(d,i){ d.classList.toggle('active', i===current); }); }
  function goTo(idx) {
    current = Math.max(0, Math.min(pageCount()-1, idx));
    track.style.transform = 'translateX(-' + (current * perPage() * slideW()) + 'px)';
    updateDots();
  }
  track.addEventListener('touchstart', function(e){ startX=e.touches[0].clientX; isDragging=true; dragDelta=0; },{passive:true});
  track.addEventListener('touchmove',  function(e){ if(isDragging) dragDelta=e.touches[0].clientX-startX; },{passive:true});
  track.addEventListener('touchend',   function(){ if(!isDragging)return; isDragging=false; if(dragDelta<-60) goTo(current+1); else if(dragDelta>60) goTo(current-1); });
  track.addEventListener('mousedown',  function(e){ startX=e.clientX; isDragging=true; dragDelta=0; track.style.cursor='grabbing'; });
  window.addEventListener('mousemove', function(e){ if(isDragging) dragDelta=e.clientX-startX; });
  window.addEventListener('mouseup',   function(){ if(!isDragging)return; isDragging=false; track.style.cursor='grab'; if(dragDelta<-60) goTo(current+1); else if(dragDelta>60) goTo(current-1); dragDelta=0; });
  window.addEventListener('resize',    function(){ current=0; track.style.transform='translateX(0)'; buildDots(); });
  track.style.cursor = 'grab';
  buildDots();
})();

/* ===== PDF MODAL ===== */
var vmodal = document.getElementById('videoModal');
var vframe = document.getElementById('youtubeFrame');

var PDF_EMBED_URL = 'https://drive.google.com/file/d/1tkIY1Y_NwjYn5eFM_idOaP_M9RJtSIYD/preview';

function openVideo() {
  vmodal.classList.add('open');
  vframe.src = PDF_EMBED_URL;
  document.body.style.overflow = 'hidden';
}
function closeVideo() {
  vmodal.classList.remove('open');
  vframe.src = '';
  document.body.style.overflow = '';
}

document.getElementById('openVideo').addEventListener('click', openVideo);
document.getElementById('openVideoBtn').addEventListener('click', openVideo);
document.getElementById('closeModal').addEventListener('click', closeVideo);
vmodal.addEventListener('click', function(e) { if (e.target === vmodal) closeVideo(); });
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeVideo(); });
</script>
</body>
</html>