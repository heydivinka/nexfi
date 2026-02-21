<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NexFi — Your Next Future in Finance</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { inter: ['Inter', 'sans-serif'] },
        }
      }
    }
  </script>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; }

    :root {
      --bg:       #07080f;
      --bg2:      #0c0d1d;
      --bg3:      #10132a;
      --accent:   #6c63ff;
      --accent2:  #9b59f5;
      --border:   rgba(108,99,255,0.2);
      --glow:     rgba(108,99,255,0.3);
      --text:     rgba(255,255,255,0.9);
      --muted:    rgba(255,255,255,0.38);
      --muted2:   rgba(255,255,255,0.55);
    }

    /* ── GLOBAL GRADIENT TEXT ── */
    .gradient-text        { background: linear-gradient(135deg, var(--accent), var(--accent2)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .gradient-text-green  { background: linear-gradient(135deg, #10B981, #34D399); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .gradient-text-purple { background: linear-gradient(135deg, var(--accent), var(--accent2)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .btn-login-nav { -webkit-text-fill-color: #fff !important; }

    .fade-up { opacity: 0; transform: translateY(28px); transition: opacity .65s ease, transform .65s ease; }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    @keyframes pulse2 { 0%,100%{ transform:scale(1); opacity:.7 } 50%{ transform:scale(1.1); opacity:1 } }
    @keyframes floatY  { 0%,100%{ transform:translateY(0) } 50%{ transform:translateY(-14px) } }
    .anim-pulse  { animation: pulse2 3s ease-in-out infinite; }
    .anim-floatY { animation: floatY 4s ease-in-out infinite; }

    /* Grid bg pattern — same as login */
    .bg-grid-overlay {
      position: fixed; inset: 0; pointer-events: none; z-index: 0;
      background-image:
        linear-gradient(rgba(108,99,255,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(108,99,255,0.06) 1px, transparent 1px);
      background-size: 40px 40px;
    }

    /* ── FEATURE GRID ── */
    .feature-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .testi-grid   { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    @media (min-width: 768px) {
      .feature-grid { grid-template-columns: 1fr; gap: 16px; }
      .testi-grid   { grid-template-columns: repeat(3, 1fr); gap: 24px; }
    }
    @media (max-width: 360px) {
      .feature-card-title { font-size: 0.78rem; }
      .feature-card-desc  { font-size: 0.72rem; }
      .testi-text         { font-size: 0.75rem; }
      .testi-name         { font-size: 0.78rem; }
    }
    @media (max-width: 640px) {
      .kontak-header-info { flex-direction: column; align-items: flex-start; }
    }

    /* Input dark theme */
    .inp-dark {
      width: 100%;
      background: rgba(255,255,255,0.05);
      border: 1.5px solid rgba(255,255,255,0.09);
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 14px;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      color: #fff;
      outline: none;
      transition: all 0.2s;
    }
    .inp-dark::placeholder { color: rgba(255,255,255,0.2); }
    .inp-dark:focus {
      background: rgba(108,99,255,0.08);
      border-color: var(--accent);
      box-shadow: 0 0 0 4px rgba(108,99,255,0.12);
    }

    /* Card style */
    .card-dark {
      background: var(--bg2);
      border: 1px solid var(--border);
      border-radius: 18px;
    }
    .card-dark:hover { box-shadow: 0 8px 32px rgba(108,99,255,0.15); }

    /* Top accent line on sections */
    .section-line::before {
      content: '';
      display: block;
      height: 2px;
      background: linear-gradient(90deg, transparent 5%, var(--accent) 35%, var(--accent2) 65%, transparent 95%);
      margin-bottom: 0;
    }
  </style>
</head>

<!-- BG same as login -->
<body class="overflow-x-hidden" style="background: var(--bg); color: var(--text);">

<div class="bg-grid-overlay"></div>
<!-- Orb top-left -->
<div style="position:fixed;width:600px;height:600px;background:radial-gradient(circle,rgba(108,99,255,0.18) 0%,transparent 70%);top:-180px;left:-140px;border-radius:50%;pointer-events:none;z-index:0"></div>
<!-- Orb bottom-right -->
<div style="position:fixed;width:500px;height:500px;background:radial-gradient(circle,rgba(155,89,245,0.14) 0%,transparent 70%);bottom:-120px;right:-100px;border-radius:50%;pointer-events:none;z-index:0"></div>

<!-- ══════════════════ NAVBAR ══════════════════ -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 px-[5%] h-[66px] flex items-center justify-between transition-shadow duration-300"
     style="background:rgba(7,8,15,0.85);backdrop-filter:blur(20px);border-bottom:1px solid rgba(108,99,255,0.15);">

  <a href="#home" class="flex items-center gap-2 text-[1.3rem] font-extrabold gradient-text no-underline">
    <i class="fa-solid fa-circle-nodes"></i> NexFi
  </a>

  <ul class="hidden md:flex gap-8 list-none items-center m-0 p-0">
    <li><a href="#home"   class="flex items-center gap-1.5 font-semibold text-sm no-underline transition-colors" style="color:var(--muted2)" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-house"></i> Home</a></li>
    <li><a href="#about"  class="flex items-center gap-1.5 font-semibold text-sm no-underline transition-colors" style="color:var(--muted2)" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-circle-info"></i> About</a></li>
    <li><a href="#testi"  class="flex items-center gap-1.5 font-semibold text-sm no-underline transition-colors" style="color:var(--muted2)" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-star"></i> Testi</a></li>
    <li><a href="#kontak" class="flex items-center gap-1.5 font-semibold text-sm no-underline transition-colors" style="color:var(--muted2)" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-envelope"></i> Kontak</a></li>
  </ul>

  <a href="{{ route('login') }}"
     class="hidden md:flex btn-login-nav items-center gap-1.5 text-white font-bold text-sm px-5 py-2 rounded-full no-underline transition hover:opacity-85 hover:-translate-y-px"
     style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 16px var(--glow)">
    <i class="fa-solid fa-right-to-bracket"></i> Login
  </a>

  <button id="hamburger" class="flex md:hidden flex-col gap-[5px] cursor-pointer bg-transparent border-none p-1" aria-label="Menu">
    <span class="block w-6 h-[2.5px] rounded-sm" style="background:var(--accent)"></span>
    <span class="block w-6 h-[2.5px] rounded-sm" style="background:var(--accent)"></span>
    <span class="block w-6 h-[2.5px] rounded-sm" style="background:var(--accent)"></span>
  </button>
</nav>

<!-- Mobile menu -->
<div id="mobileMenu" class="hidden fixed top-[66px] left-0 right-0 px-[6%] pt-6 pb-8 z-40 flex-col gap-5"
     style="background:rgba(7,8,15,0.97);backdrop-filter:blur(20px);border-top:1px solid rgba(108,99,255,0.15);box-shadow:0 20px 60px rgba(0,0,0,0.6)">
  <a href="#home"   class="flex items-center gap-2 font-semibold border-b pb-3.5 no-underline" style="color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.07)"><i class="fa-solid fa-house"></i> Home</a>
  <a href="#about"  class="flex items-center gap-2 font-semibold border-b pb-3.5 no-underline" style="color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.07)"><i class="fa-solid fa-circle-info"></i> About</a>
  <a href="#testi"  class="flex items-center gap-2 font-semibold border-b pb-3.5 no-underline" style="color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.07)"><i class="fa-solid fa-star"></i> Testi</a>
  <a href="#kontak" class="flex items-center gap-2 font-semibold border-b pb-3.5 no-underline" style="color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.07)"><i class="fa-solid fa-envelope"></i> Kontak</a>
  <a href="{{ route('login') }}" class="btn-login-nav flex justify-center items-center gap-2 text-white font-bold px-5 py-2.5 rounded-full no-underline mt-1"
     style="background:linear-gradient(135deg,var(--accent),var(--accent2))">
    <i class="fa-solid fa-right-to-bracket"></i> Login
  </a>
</div>

<!-- ══════════════════ HERO ══════════════════ -->
<section id="home" class="min-h-screen flex items-center pt-[100px] pb-16 px-[5%] relative overflow-hidden" style="z-index:1">
  <!-- section orbs -->
  <div class="absolute -top-[180px] -right-[180px] w-[700px] h-[700px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(108,99,255,0.1) 0%,transparent 70%)"></div>
  <div class="absolute -bottom-[100px] -left-[100px] w-[500px] h-[500px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(155,89,245,0.08) 0%,transparent 70%)"></div>

  <div class="max-w-[1200px] mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

    <div class="fade-up text-center md:text-left">
      <div class="inline-flex items-center gap-1.5 rounded-full px-4 py-1.5 text-[0.8rem] font-bold mb-5"
           style="background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent)">
        <i class="fa-solid fa-bolt"></i> Platform Keuangan #1 Indonesia
      </div>
      <h1 class="text-[clamp(2.2rem,5vw,3.6rem)] font-extrabold leading-[1.15] tracking-tight" style="color:#fff">
        Your <span class="gradient-text">Next Future</span><br>
        in Finance<br>
        Starts Here
      </h1>
      <p class="mt-4 text-base leading-relaxed" style="color:var(--muted2)">Kelola keuanganmu dengan fitur pintar,<br class="hidden sm:block"> cepat, dan aman bersama NexFi.</p>

      <div class="flex flex-wrap gap-3 mt-8 justify-center md:justify-start">
        <button class="flex items-center gap-2 text-white font-bold px-6 py-3 rounded-full border-none cursor-pointer transition hover:-translate-y-0.5 text-sm"
                style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 8px 25px var(--glow)">
          <i class="fa-solid fa-rocket"></i> Get Started
        </button>
        <button class="flex items-center gap-2 font-bold px-6 py-3 rounded-full border-2 cursor-pointer transition text-sm"
                style="background:transparent;color:var(--accent);border-color:rgba(108,99,255,0.4)"
                onmouseover="this.style.background='rgba(108,99,255,0.15)'" onmouseout="this.style.background='transparent'">
          <i class="fa-solid fa-download"></i> Download App
        </button>
      </div>

      <div class="flex flex-wrap gap-3 mt-5 justify-center md:justify-start">
        <span class="flex items-center gap-1.5 rounded-full px-4 py-1.5 text-[0.82rem] font-bold"
              style="background:rgba(16,185,129,0.12);border:1px solid rgba(16,185,129,0.25);color:#34D399">
          <i class="fa-solid fa-star text-amber-400"></i> 10K+ Users
        </span>
        <span class="flex items-center gap-1.5 rounded-full px-4 py-1.5 text-[0.82rem] font-bold"
              style="background:rgba(16,185,129,0.12);border:1px solid rgba(16,185,129,0.25);color:#34D399">
          <i class="fa-solid fa-shield-halved"></i> Secure &amp; Trusted
        </span>
      </div>
    </div>

    <!-- Logo -->
    <div class="hidden md:flex justify-center items-center relative min-h-[420px] fade-up" style="transition-delay:.2s">
      <div class="absolute w-[550px] h-[550px] rounded-full anim-pulse" style="background:radial-gradient(circle,rgba(108,99,255,0.22) 0%,transparent 65%)"></div>
      <img src="{{ asset('assets_public/icon.png') }}" alt="NexFi Logo"
           class="w-[min(460px,90%)] h-auto relative anim-floatY"
           style="z-index:2;filter:drop-shadow(0 30px 70px rgba(108,99,255,0.35))" />
    </div>

  </div>
</section>

<!-- ══════════════════ ABOUT ══════════════════ -->
<section id="about" class="py-[80px] px-[5%] relative" style="background:linear-gradient(180deg,var(--bg) 0%,var(--bg2) 100%);z-index:1">
  <!-- Section top line -->
  <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(108,99,255,0.3),transparent)"></div>

  <div class="max-w-[1200px] mx-auto w-full">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-start">

      <!-- Fitur -->
      <div class="fade-up">
        <div class="inline-flex items-center gap-1.5 rounded-full px-4 py-1.5 text-[0.8rem] font-bold mb-4"
             style="background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent)">
          <i class="fa-solid fa-circle-question"></i> Tentang Kami
        </div>
        <h2 class="text-[clamp(1.7rem,3.5vw,2.6rem)] font-extrabold tracking-tight leading-tight" style="color:#fff">
          Apa Itu <span class="gradient-text-purple">NexFi?</span>
        </h2>
        <p class="mt-3 leading-relaxed text-sm md:text-base" style="color:var(--muted2)">Kelola finansialmu tanpa ribet dengan fitur pintar dari NexFi — solusi keuangan modern untuk kehidupan yang lebih terencana.</p>

        <!-- FEATURE CARDS -->
        <div class="feature-grid mt-6">

          <div class="card-dark flex flex-col gap-2 p-4 transition hover:-translate-y-0.5" style="cursor:default">
            <div class="w-[38px] h-[38px] rounded-xl flex items-center justify-center text-white shrink-0"
                 style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow)">
              <i class="fa-solid fa-chart-line text-sm"></i>
            </div>
            <div>
              <div class="font-bold feature-card-title" style="font-size:clamp(0.78rem,2.5vw,0.97rem);color:#fff">Pantau cashflow real-time</div>
              <div class="feature-card-desc mt-1 leading-relaxed" style="font-size:clamp(0.72rem,2vw,0.85rem);color:var(--muted2)">Monitor penghasilan dan pengeluaran dalam satu dashboard.</div>
            </div>
          </div>

          <div class="card-dark flex flex-col gap-2 p-4 transition hover:-translate-y-0.5" style="cursor:default">
            <div class="w-[38px] h-[38px] rounded-xl flex items-center justify-center text-white shrink-0"
                 style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow)">
              <i class="fa-solid fa-magnifying-glass-chart text-sm"></i>
            </div>
            <div>
              <div class="font-bold feature-card-title" style="font-size:clamp(0.78rem,2.5vw,0.97rem);color:#fff">Analisa finansial mudah</div>
              <div class="feature-card-desc mt-1 leading-relaxed" style="font-size:clamp(0.72rem,2vw,0.85rem);color:var(--muted2)">Insight mendalam dan laporan otomatis setiap saat.</div>
            </div>
          </div>

          <div class="card-dark flex flex-col gap-2 p-4 transition hover:-translate-y-0.5" style="cursor:default">
            <div class="w-[38px] h-[38px] rounded-xl flex items-center justify-center text-white shrink-0"
                 style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow)">
              <i class="fa-solid fa-shield-halved text-sm"></i>
            </div>
            <div>
              <div class="font-bold feature-card-title" style="font-size:clamp(0.78rem,2.5vw,0.97rem);color:#fff">Keamanan terjamin</div>
              <div class="feature-card-desc mt-1 leading-relaxed" style="font-size:clamp(0.72rem,2vw,0.85rem);color:var(--muted2)">Enkripsi data & proteksi berlapis untuk akun kamu.</div>
            </div>
          </div>

        </div>

        <button class="inline-flex items-center gap-2 mt-6 text-white font-bold px-6 py-3 rounded-full border-none cursor-pointer transition hover:-translate-y-0.5 text-sm"
                style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 8px 25px var(--glow)">
          Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>

      <!-- YouTube Card -->
      <div class="fade-up rounded-[22px] overflow-hidden" style="border:1px solid var(--border);box-shadow:0 16px 60px rgba(108,99,255,0.15);transition-delay:.2s;background:var(--bg2)">
        <a href="https://youtu.be/fbBMjWc8Usk" target="_blank" rel="noopener" class="block relative w-full overflow-hidden group" style="aspect-ratio:16/9">
          <img
            src="https://img.youtube.com/vi/fbBMjWc8Usk/maxresdefault.jpg"
            onerror="this.src='https://img.youtube.com/vi/fbBMjWc8Usk/hqdefault.jpg'"
            alt="Demo Video NexFi"
            class="w-full h-full object-cover transition duration-300 group-hover:scale-105"
          />
          <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-[64px] h-[64px] md:w-[72px] md:h-[72px] rounded-full bg-red-600 flex items-center justify-center text-white text-xl md:text-2xl shadow-2xl transition duration-300 group-hover:scale-110 group-hover:bg-red-700">
              <i class="fa-solid fa-play ml-1"></i>
            </div>
          </div>
          <div class="absolute bottom-3 right-3 bg-black/75 text-white text-[0.72rem] font-bold px-2 py-0.5 rounded">5:32</div>
        </a>
        <div class="p-5 md:p-6 pb-6 md:pb-7">
          <p class="text-[0.88rem] leading-relaxed mb-4" style="color:var(--muted2)">Lihat langsung bagaimana NexFi membantu kamu mengelola keuangan dengan lebih cerdas dan efisien.</p>
          <a href="https://youtu.be/fbBMjWc8Usk" target="_blank" rel="noopener"
             class="flex items-center justify-center gap-2 text-white no-underline px-6 py-3 rounded-full font-bold text-[0.9rem] w-full transition hover:bg-red-700 hover:-translate-y-px"
             style="background:#dc2626">
            <i class="fa-brands fa-youtube"></i> Tonton Video Demo
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════ TESTI ══════════════════ -->
<section id="testi" class="py-[80px] px-[5%] relative" style="background:var(--bg3);z-index:1">
  <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(108,99,255,0.3),transparent)"></div>
  <div style="position:absolute;bottom:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(108,99,255,0.3),transparent)"></div>

  <style>
    .testi-carousel-wrap { position: relative; overflow: hidden; }
    /* Both mobile & desktop: flex carousel, show 3 at once on desktop, 1 on mobile */
    .testi-track {
      display: flex;
      gap: 24px;
      transition: transform 0.42s cubic-bezier(0.4,0,0.2,1);
      will-change: transform;
      align-items: stretch;
    }
    /* Desktop: each slide = (100% - 2*24px) / 3 */
    .testi-slide { flex: 0 0 calc((100% - 48px) / 3); min-width: 0; }
    /* Mobile: full width, smaller gap */
    @media (max-width: 767px) {
      .testi-track { gap: 16px; }
      .testi-slide { flex: 0 0 100%; }
    }
    /* Dots - always visible */
    .testi-dots { display: flex; justify-content: center; gap: 8px; margin-top: 28px; }
    .testi-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.15); cursor:pointer; border:none; padding:0; transition: all 0.25s; }
    .testi-dot.active { width:24px; border-radius:4px; background:linear-gradient(90deg,var(--accent),var(--accent2)); }
  </style>

  <div class="max-w-[1200px] mx-auto w-full">

    <div class="text-center mb-10 fade-up">
      <div class="inline-flex items-center gap-1.5 rounded-full px-4 py-1.5 text-[0.8rem] font-bold mb-4"
           style="background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent)">
        <i class="fa-solid fa-comments"></i> Testimoni
      </div>
      <h2 class="text-[clamp(1.7rem,3.5vw,2.6rem)] font-extrabold tracking-tight" style="color:#fff">
        Apa Kata <span class="gradient-text-purple">Mereka?</span>
      </h2>
      <p class="mt-2 max-w-[480px] mx-auto leading-relaxed text-sm md:text-base" style="color:var(--muted2)">Ribuan pengguna sudah merasakan manfaat NexFi. Ini cerita mereka.</p>
    </div>

    <div class="testi-carousel-wrap fade-up">
      <div class="testi-track" id="testiTrack">

        <div class="testi-slide"><div class="card-dark p-5 md:p-6 flex flex-col" style="height:100%;min-height:210px">
          <div class="text-amber-400 mb-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="leading-relaxed italic mb-5 flex-1" style="font-size:0.88rem;color:var(--muted2)">"NexFi sangat membantu saya mengatur keuangan dengan mudah dan cepat. Fitur analitik-nya luar biasa!"</p>
          <div class="flex items-center gap-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.07)">
            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center text-white shrink-0" style="background:linear-gradient(135deg,var(--accent),var(--accent2))"><i class="fa-solid fa-user text-sm"></i></div>
            <div><div class="font-bold" style="font-size:0.9rem;color:#fff">Andi Setiawan</div><div style="font-size:0.75rem;color:var(--muted)">Pengusaha, Jakarta</div></div>
          </div>
        </div></div>

        <div class="testi-slide"><div class="card-dark p-5 md:p-6 flex flex-col" style="height:100%;min-height:210px">
          <div class="text-amber-400 mb-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="leading-relaxed italic mb-5 flex-1" style="font-size:0.88rem;color:var(--muted2)">"Aplikasi yang sangat user-friendly! Sekarang nabung dan investasi jadi lebih terencana. Recommend banget!"</p>
          <div class="flex items-center gap-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.07)">
            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center text-white shrink-0" style="background:linear-gradient(135deg,#EC4899,#F472B6)"><i class="fa-solid fa-user text-sm"></i></div>
            <div><div class="font-bold" style="font-size:0.9rem;color:#fff">Maria Tan</div><div style="font-size:0.75rem;color:var(--muted)">Mahasiswi, Surabaya</div></div>
          </div>
        </div></div>

        <div class="testi-slide"><div class="card-dark p-5 md:p-6 flex flex-col" style="height:100%;min-height:210px">
          <div class="text-amber-400 mb-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star" style="color:rgba(255,255,255,0.18)"></i></div>
          <p class="leading-relaxed italic mb-5 flex-1" style="font-size:0.88rem;color:var(--muted2)">"Keamanan tinggi dan proses cepat. NexFi bikin hidup saya jauh lebih teratur dalam mengelola keuangan. Highly recommended!"</p>
          <div class="flex items-center gap-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.07)">
            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center text-white shrink-0" style="background:linear-gradient(135deg,#10B981,#34D399)"><i class="fa-solid fa-user text-sm"></i></div>
            <div><div class="font-bold" style="font-size:0.9rem;color:#fff">Rahmat H.</div><div style="font-size:0.75rem;color:var(--muted)">Karyawan, Bandung</div></div>
          </div>
        </div></div>

        <div class="testi-slide"><div class="card-dark p-5 md:p-6 flex flex-col" style="height:100%;min-height:210px">
          <div class="text-amber-400 mb-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="leading-relaxed italic mb-5 flex-1" style="font-size:0.88rem;color:var(--muted2)">"Dashboard-nya bersih dan mudah dipahami. Semua laporan keuangan kelihatan jelas. Top banget!"</p>
          <div class="flex items-center gap-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.07)">
            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center text-white shrink-0" style="background:linear-gradient(135deg,#f59e0b,#fbbf24)"><i class="fa-solid fa-user text-sm"></i></div>
            <div><div class="font-bold" style="font-size:0.9rem;color:#fff">Dian Pratiwi</div><div style="font-size:0.75rem;color:var(--muted)">Ibu Rumah Tangga, Yogyakarta</div></div>
          </div>
        </div></div>

        <div class="testi-slide"><div class="card-dark p-5 md:p-6 flex flex-col" style="height:100%;min-height:210px">
          <div class="text-amber-400 mb-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
          <p class="leading-relaxed italic mb-5 flex-1" style="font-size:0.88rem;color:var(--muted2)">"Notifikasi real-time-nya keren! Setiap ada transaksi langsung muncul. Nggak ada yang kelewat sama sekali."</p>
          <div class="flex items-center gap-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.07)">
            <div class="w-[40px] h-[40px] rounded-full flex items-center justify-center text-white shrink-0" style="background:linear-gradient(135deg,#6366f1,#818cf8)"><i class="fa-solid fa-user text-sm"></i></div>
            <div><div class="font-bold" style="font-size:0.9rem;color:#fff">Budi Santoso</div><div style="font-size:0.75rem;color:var(--muted)">Freelancer, Bali</div></div>
          </div>
        </div></div>

      </div><!-- /track -->
      <div class="testi-dots" id="testiDots"></div>
    </div>

  </div>
</section>

<!-- ══════════════════ KONTAK ══════════════════ -->
<section id="kontak" class="py-[80px] px-[5%] relative overflow-hidden" style="background:var(--bg);z-index:1">
  <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(108,99,255,0.3),transparent)"></div>

  <div class="absolute -top-24 -left-20 w-[420px] h-[420px] rounded-full pointer-events-none"
       style="background:radial-gradient(circle,rgba(108,99,255,0.1),transparent 70%)"></div>
  <div class="absolute -bottom-24 -right-20 w-[380px] h-[380px] rounded-full pointer-events-none"
       style="background:radial-gradient(circle,rgba(155,89,245,0.1),transparent 70%)"></div>

  <div class="max-w-6xl mx-auto w-full relative fade-up" style="z-index:10">

    <div class="text-center mb-10">
      <div class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-[0.8rem] font-bold mb-5"
           style="background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent)">
        <i class="fa-solid fa-headset"></i> Hubungi Kami
      </div>

      <h2 class="text-[clamp(1.6rem,4vw,2.5rem)] font-extrabold" style="color:#fff">
        Ada Pertanyaan atau Saran?<br>
        <span class="gradient-text">Kami Siap Membantu</span>
      </h2>

      <p class="mt-4 text-[0.9rem] max-w-xl mx-auto" style="color:var(--muted2)">
        Pilih menu di bawah untuk mengirim pesan atau testimoni tentang pengalamanmu.
      </p>

      <div class="flex justify-center mt-8">
        <div class="flex p-1 rounded-full" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.08)">
          <button id="btnTesti"
            class="px-6 py-2.5 rounded-full text-sm font-bold text-white transition-all"
            style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 14px var(--glow)">
            <i class="fa-solid fa-star mr-1.5"></i> Testimoni
          </button>
          <button id="btnKoran"
            class="px-6 py-2.5 rounded-full text-sm font-bold transition-all"
            style="background:transparent;color:var(--muted2)">
            <i class="fa-solid fa-envelope mr-1.5"></i> Kontak
          </button>
        </div>
      </div>
    </div>

    <!-- Form wrapper -->
    <div class="rounded-3xl p-6 sm:p-8 lg:p-12"
         style="background:var(--bg2);border:1px solid var(--border);box-shadow:0 10px 45px rgba(108,99,255,0.12)">

      <!-- Label helper -->
      <style>
        .form-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em; color: rgba(255,255,255,0.35); display: block; margin-bottom: 6px; }
      </style>

      <!-- TESTIMONI FORM -->
      <form id="formTesti" class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        <div>
          <label class="form-label">Nama Lengkap</label>
          <input type="text" placeholder="Nama kamu" class="inp-dark">
        </div>
        <div>
          <label class="form-label">Email</label>
          <input type="email" placeholder="nama@email.com" class="inp-dark">
        </div>

        <div class="sm:col-span-2">
          <label class="form-label">Foto Profil</label>
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full overflow-hidden flex items-center justify-center shrink-0"
                 style="border:1px solid rgba(108,99,255,0.3);background:rgba(108,99,255,0.1)">
              <img id="avatarPreview" src="" alt="" class="hidden w-full h-full object-cover">
              <i id="avatarIcon" class="fa-solid fa-user" style="color:rgba(108,99,255,0.5);font-size:1.1rem"></i>
            </div>
            <label class="flex-1 flex items-center gap-3 cursor-pointer rounded-xl px-4 py-4 transition"
                   style="background:rgba(255,255,255,0.04);border:1.5px dashed rgba(108,99,255,0.3)"
                   onmouseover="this.style.borderColor='rgba(108,99,255,0.6)'" onmouseout="this.style.borderColor='rgba(108,99,255,0.3)'">
              <i class="fa-solid fa-cloud-arrow-up" style="color:var(--accent)"></i>
              <div>
                <div class="font-semibold text-sm" style="color:rgba(255,255,255,0.7)">Klik untuk upload foto</div>
                <div class="text-xs" style="color:var(--muted)">PNG / JPG (max 2MB)</div>
              </div>
              <input type="file" id="fotoInput" accept="image/*" hidden>
            </label>
          </div>
          <div id="fileName" class="text-xs font-semibold mt-2 hidden" style="color:var(--accent)"></div>
        </div>

        <div class="sm:col-span-2">
          <label class="form-label">Rating Kamu</label>
          <div class="flex gap-2 text-[1.7rem] cursor-pointer" id="ratingStars" style="color:rgba(255,255,255,0.15)">
            <i class="fa-solid fa-star" data-value="1"></i>
            <i class="fa-solid fa-star" data-value="2"></i>
            <i class="fa-solid fa-star" data-value="3"></i>
            <i class="fa-solid fa-star" data-value="4"></i>
            <i class="fa-solid fa-star" data-value="5"></i>
          </div>
        </div>

        <div class="sm:col-span-2">
          <label class="form-label">Testimoni</label>
          <textarea rows="4" placeholder="Ceritakan pengalamanmu..." class="inp-dark" style="resize:none"></textarea>
        </div>

        <button type="button" onclick="handleFakeSubmit(this)"
          class="sm:col-span-2 mt-2 w-full flex items-center justify-center gap-2 text-white font-bold py-3.5 rounded-2xl transition hover:-translate-y-0.5"
          style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 10px 30px var(--glow)">
          <i class="fa-solid fa-paper-plane"></i> Kirim Testimoni
        </button>
      </form>

      <!-- KONTAK FORM -->
      <form id="formKoran" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-5">

        <div>
          <label class="form-label">Nama Lengkap</label>
          <input type="text" placeholder="Nama kamu" class="inp-dark">
        </div>
        <div>
          <label class="form-label">Email</label>
          <input type="email" placeholder="nama@email.com" class="inp-dark">
        </div>

        <div class="sm:col-span-2">
          <label class="form-label">Subjek</label>
          <input type="text" placeholder="Topik pesan" class="inp-dark">
        </div>

        <div class="sm:col-span-2">
          <label class="form-label">Pesan</label>
          <textarea rows="5" placeholder="Tulis pesan kamu..." class="inp-dark" style="resize:none"></textarea>
        </div>

        <button type="button" onclick="handleFakeSubmit(this)"
          class="sm:col-span-2 w-full flex items-center justify-center gap-2 text-white font-bold py-3.5 rounded-2xl transition hover:-translate-y-0.5"
          style="background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 10px 30px var(--glow)">
          <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
        </button>
      </form>

    </div>
  </div>
</section>

<!-- ══════════════════ FOOTER ══════════════════ -->
<footer class="px-[6%] pt-12 pb-6 relative" style="background:#04050c;border-top:1px solid rgba(108,99,255,0.2);z-index:1">
  <div class="max-w-[1200px] mx-auto">

    <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between gap-8 pb-8"
         style="border-bottom:1px solid rgba(255,255,255,0.07)">

      <!-- Brand -->
      <div class="text-center sm:text-left">
        <div class="flex items-center justify-center sm:justify-start mb-2 h-12 overflow-visible">
          <img
            src="{{ asset('assets_public/logo.png') }}"
            alt="NexFi"
            class="h-12 w-auto scale-[2.2] sm:scale-[2.6] origin-center sm:origin-left"
            style="filter: drop-shadow(0 8px 24px rgba(108,99,255,0.4));"
          />
        </div>
        <p class="text-[0.83rem] max-w-[220px]" style="color:var(--muted)">
          Your Next Future in Finance. Kelola keuanganmu lebih cerdas.
        </p>
      </div>

      <!-- Sosial Media -->
      <div class="text-center sm:text-left">
        <div class="text-[0.78rem] font-bold uppercase tracking-widest mb-3" style="color:rgba(255,255,255,0.3)">Ikuti Kami</div>
        <div class="flex items-center gap-3 justify-center sm:justify-start">
          <a href="#" class="w-9 h-9 rounded-full flex items-center justify-center transition"
             style="background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4)"
             onmouseover="this.style.background='rgba(108,99,255,0.5)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-instagram text-sm"></i>
          </a>
          <a href="#" class="w-9 h-9 rounded-full flex items-center justify-center transition"
             style="background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4)"
             onmouseover="this.style.background='rgba(108,99,255,0.5)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-tiktok text-sm"></i>
          </a>
          <a href="https://www.youtube.com/@NexFi" target="_blank"
             class="w-9 h-9 rounded-full flex items-center justify-center transition"
             style="background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4)"
             onmouseover="this.style.background='#dc2626';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-youtube text-sm"></i>
          </a>
          <a href="#" class="w-9 h-9 rounded-full flex items-center justify-center transition"
             style="background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4)"
             onmouseover="this.style.background='rgba(108,99,255,0.5)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-twitter text-sm"></i>
          </a>
        </div>
      </div>

      <!-- Kontak -->
      <div class="text-center sm:text-left">
        <div class="text-[0.78rem] font-bold uppercase tracking-widest mb-3" style="color:rgba(255,255,255,0.3)">Kontak</div>
        <div class="flex flex-col gap-2">
          <a href="/cdn-cgi/l/email-protection#157d7079797a557b706d737c3b7c71" class="flex items-center gap-2 text-[0.85rem] no-underline transition" style="color:rgba(255,255,255,0.4)" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-solid fa-envelope text-xs"></i> <span class="__cf_email__" data-cfemail="a8c0cdc4c4c7e8c6cdd0cec186c1cc">[email&#160;protected]</span>
          </a>
          <a href="https://wa.me/6281234567890" target="_blank"
             class="flex items-center gap-2 text-[0.85rem] no-underline transition"
             style="color:rgba(255,255,255,0.4)"
             onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
            <i class="fa-brands fa-whatsapp text-xs"></i> +62 812-3456-7890
          </a>
          <span class="flex items-center gap-2 text-[0.85rem]" style="color:rgba(255,255,255,0.4)">
            <i class="fa-solid fa-location-dot text-xs"></i> Jakarta, Indonesia
          </span>
        </div>
      </div>

    </div>

    <div class="pt-5 text-center text-[0.82rem]" style="color:rgba(255,255,255,0.2)">
      © 2025 <strong style="color:rgba(255,255,255,0.35)">NexFi</strong>. All rights reserved.
    </div>

  </div>
</footer>

<script>
  // ================= TAB SWITCH =================
  const btnTesti = document.getElementById('btnTesti');
  const btnKoran = document.getElementById('btnKoran');
  const formTesti = document.getElementById('formTesti');
  const formKoran = document.getElementById('formKoran');

  function activateTesti() {
    formTesti.classList.remove('hidden');
    formKoran.classList.add('hidden');
    btnTesti.style.background = "linear-gradient(135deg,#6c63ff,#9b59f5)";
    btnTesti.style.boxShadow = "0 4px 14px rgba(108,99,255,0.4)";
    btnTesti.style.color = "#fff";
    btnKoran.style.background = "transparent";
    btnKoran.style.boxShadow = "none";
    btnKoran.style.color = "rgba(255,255,255,0.45)";
  }
  function activateKoran() {
    formKoran.classList.remove('hidden');
    formTesti.classList.add('hidden');
    btnKoran.style.background = "linear-gradient(135deg,#6c63ff,#9b59f5)";
    btnKoran.style.boxShadow = "0 4px 14px rgba(108,99,255,0.4)";
    btnKoran.style.color = "#fff";
    btnTesti.style.background = "transparent";
    btnTesti.style.boxShadow = "none";
    btnTesti.style.color = "rgba(255,255,255,0.45)";
  }
  btnTesti.addEventListener('click', activateTesti);
  btnKoran.addEventListener('click', activateKoran);

  // ================= RATING STARS =================
  const stars = document.querySelectorAll("#ratingStars i");
  stars.forEach(star => {
    star.addEventListener("click", function () {
      const value = this.getAttribute("data-value");
      stars.forEach(s => {
        s.style.color = s.getAttribute("data-value") <= value ? "#F59E0B" : "rgba(255,255,255,0.15)";
      });
    });
  });

  // ================= FILE UPLOAD =================
  const fotoInput = document.getElementById('fotoInput');
  const fileName = document.getElementById('fileName');
  const avatarPreview = document.getElementById('avatarPreview');
  const avatarIcon = document.getElementById('avatarIcon');

  if (fotoInput) {
    fotoInput.addEventListener('change', () => {
      if (fotoInput.files.length > 0) {
        const file = fotoInput.files[0];
        if (fileName) { fileName.textContent = "\uD83D\uDCCE " + file.name; fileName.classList.remove('hidden'); }
        if (avatarPreview && avatarIcon) {
          const reader = new FileReader();
          reader.onload = e => {
            avatarPreview.src = e.target.result;
            avatarPreview.classList.remove('hidden');
            avatarIcon.classList.add('hidden');
          };
          reader.readAsDataURL(file);
        }
      }
    });
  }

  // ================= NAVBAR SHADOW =================
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.style.boxShadow = window.scrollY > 20 ? '0 4px 30px rgba(0,0,0,0.5)' : 'none';
  });

  // ================= HAMBURGER =================
  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobileMenu');
  hamburger.addEventListener('click', () => {
    const isOpen = mobileMenu.classList.contains('flex');
    mobileMenu.classList.toggle('hidden', isOpen);
    mobileMenu.classList.toggle('flex', !isOpen);
  });
  document.querySelectorAll('#mobileMenu a').forEach(a => {
    a.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
      mobileMenu.classList.remove('flex');
    });
  });

  // ================= FADE UP =================
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
  }, { threshold: 0.08 });
  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  // ================= FAKE SUBMIT =================
  function handleFakeSubmit(btn) {
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fa-solid fa-check"></i> Terkirim!';
    btn.disabled = true;
    setTimeout(() => {
      btn.innerHTML = originalHTML;
      btn.disabled = false;
      stars.forEach(s => s.style.color = "rgba(255,255,255,0.15)");
      if (avatarPreview) { avatarPreview.src = ""; avatarPreview.classList.add('hidden'); }
      if (avatarIcon) avatarIcon.classList.remove('hidden');
      if (fileName) { fileName.textContent = ""; fileName.classList.add('hidden'); }
    }, 2500);
  }

  // ================= TESTI CAROUSEL =================
  (function() {
    const track = document.getElementById('testiTrack');
    const dotsWrap = document.getElementById('testiDots');
    if (!track || !dotsWrap) return;

    const slides = track.querySelectorAll('.testi-slide');
    const total = slides.length;
    let current = 0; // current "page" index
    let startX = 0, isDragging = false, dragDelta = 0;

    function isMobile() { return window.innerWidth < 768; }
    function perPage()  { return isMobile() ? 1 : 3; }
    function pageCount(){ return Math.ceil(total / perPage()); }

    function getSlideWidth() {
      // width of one slide + gap
      const gap = isMobile() ? 16 : 24;
      return slides[0].offsetWidth + gap;
    }

    function buildDots() {
      dotsWrap.innerHTML = '';
      const pages = pageCount();
      for (let i = 0; i < pages; i++) {
        const d = document.createElement('button');
        d.className = 'testi-dot' + (i === current ? ' active' : '');
        d.setAttribute('aria-label', 'Halaman ' + (i + 1));
        d.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(d);
      }
    }

    function updateDots() {
      dotsWrap.querySelectorAll('.testi-dot').forEach((d, i) => {
        d.classList.toggle('active', i === current);
      });
    }

    function goTo(pageIdx) {
      const pages = pageCount();
      current = Math.max(0, Math.min(pages - 1, pageIdx));
      const slideIdx = current * perPage();
      const offset = slideIdx * getSlideWidth();
      track.style.transform = 'translateX(-' + offset + 'px)';
      updateDots();
    }

    // Touch swipe
    track.addEventListener('touchstart', e => {
      startX = e.touches[0].clientX;
      isDragging = true;
      dragDelta = 0;
    }, { passive: true });

    track.addEventListener('touchmove', e => {
      if (!isDragging) return;
      dragDelta = e.touches[0].clientX - startX;
    }, { passive: true });

    track.addEventListener('touchend', () => {
      if (!isDragging) return;
      isDragging = false;
      if (dragDelta < -60) goTo(current + 1);
      else if (dragDelta > 60) goTo(current - 1);
      dragDelta = 0;
    });

    // Mouse drag
    track.addEventListener('mousedown', e => {
      startX = e.clientX; isDragging = true; dragDelta = 0;
      track.style.cursor = 'grabbing';
    });
    window.addEventListener('mousemove', e => {
      if (!isDragging) return;
      dragDelta = e.clientX - startX;
    });
    window.addEventListener('mouseup', () => {
      if (!isDragging) return;
      isDragging = false;
      track.style.cursor = 'grab';
      if (dragDelta < -60) goTo(current + 1);
      else if (dragDelta > 60) goTo(current - 1);
      dragDelta = 0;
    });

    // Resize: reset to page 0 and rebuild
    window.addEventListener('resize', () => {
      current = 0;
      track.style.transform = 'translateX(0)';
      buildDots();
    });

    // Init
    track.style.cursor = 'grab';
    buildDots();
  })();
</script>
</body>
</html>