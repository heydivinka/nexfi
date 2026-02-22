<!DOCTYPE html>
<html lang="id" style="overflow-x:hidden;">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NexFi — Your Next Future in Finance</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
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

    .gradient-text { background:linear-gradient(135deg,var(--accent),var(--accent2)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .btn-login-nav { -webkit-text-fill-color:#fff !important; }

    @keyframes pulse2  { 0%,100%{ transform:scale(1);opacity:.7 } 50%{ transform:scale(1.1);opacity:1 } }
    @keyframes floatY  { 0%,100%{ transform:translateY(0) } 50%{ transform:translateY(-14px) } }
    .anim-pulse  { animation:pulse2 3s ease-in-out infinite; }
    .anim-floatY { animation:floatY 4s ease-in-out infinite; }

    .bg-grid-overlay {
      position:fixed; inset:0; pointer-events:none; z-index:0;
      background-image:
        linear-gradient(rgba(108,99,255,0.12) 1px, transparent 1px),
        linear-gradient(90deg, rgba(108,99,255,0.12) 1px, transparent 1px);
      background-size:40px 40px;
    }

    .card-dark { background:#0c0d1d; border:1px solid var(--border); border-radius:18px; }
    .card-dark:hover { box-shadow:0 8px 32px rgba(108,99,255,0.15); }

    .inp-dark {
      width:100%; background:rgba(255,255,255,0.05); border:1.5px solid rgba(255,255,255,0.09);
      border-radius:12px; padding:12px 16px; font-size:14px; font-family:'Inter',sans-serif;
      font-weight:500; color:#fff; outline:none; transition:all 0.2s;
    }
    .inp-dark::placeholder { color:rgba(255,255,255,0.2); }
    .inp-dark:focus { background:rgba(108,99,255,0.08); border-color:var(--accent); box-shadow:0 0 0 4px rgba(108,99,255,0.12); }
    .form-label { font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.07em; color:rgba(255,255,255,0.35); display:block; margin-bottom:6px; }

    .feature-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    @media(min-width:768px){ .feature-grid { grid-template-columns:1fr; gap:16px; } }

    #mobileMenu {
      display:none; position:fixed; top:66px; left:0; right:0;
      padding:24px 6% 32px; z-index:40; flex-direction:column; gap:20px;
      background:rgba(7,8,15,0.97); backdrop-filter:blur(20px);
      border-top:1px solid rgba(108,99,255,0.15); box-shadow:0 20px 60px rgba(0,0,0,0.6);
    }

    .testi-track { display:flex; gap:24px; transition:transform 0.42s cubic-bezier(0.4,0,0.2,1); align-items:stretch; }
    .testi-slide { flex:0 0 calc((100% - 48px) / 3); min-width:0; }
    @media(max-width:767px){ .testi-track { gap:16px; } .testi-slide { flex:0 0 100%; } }
    .testi-dots { display:flex; justify-content:center; gap:8px; margin-top:28px; }
    .testi-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.15); cursor:pointer; border:none; padding:0; transition:all 0.25s; }
    .testi-dot.active { width:24px; border-radius:4px; background:linear-gradient(90deg,var(--accent),var(--accent2)); }
    .section-divider { height:1px; background:linear-gradient(90deg,transparent,rgba(108,99,255,0.3),transparent); }
  </style>
</head>

<body style="background:#07080f !important; color:rgba(255,255,255,0.9) !important;">

<div class="bg-grid-overlay"></div>
<div style="position:fixed;width:600px;height:600px;background:radial-gradient(circle,rgba(108,99,255,0.22) 0%,transparent 70%);top:-180px;left:-140px;border-radius:50%;pointer-events:none;z-index:0;"></div>
<div style="position:fixed;width:500px;height:500px;background:radial-gradient(circle,rgba(155,89,245,0.16) 0%,transparent 70%);bottom:-120px;right:-100px;border-radius:50%;pointer-events:none;z-index:0;"></div>

<!-- NAVBAR -->
<nav id="navbar" style="position:fixed;top:0;left:0;right:0;z-index:50;height:66px;padding:0 5%;display:flex;align-items:center;justify-content:space-between;background:rgba(7,8,15,0.95);backdrop-filter:blur(20px);border-bottom:1px solid rgba(108,99,255,0.15);">
  <a href="#home" style="display:flex;align-items:center;gap:8px;font-size:1.3rem;font-weight:800;text-decoration:none;" class="gradient-text">
    <i class="fa-solid fa-circle-nodes"></i> NexFi
  </a>
  <ul style="display:none;gap:32px;list-style:none;margin:0;padding:0;align-items:center;" id="navLinks">
    <li><a href="#home"   style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-house"></i> Home</a></li>
    <li><a href="#about"  style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-circle-info"></i> About</a></li>
    <li><a href="#testi"  style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-star"></i> Testi</a></li>
    <li><a href="#kontak" style="display:flex;align-items:center;gap:6px;font-weight:600;font-size:0.875rem;color:var(--muted2);text-decoration:none;" onmouseover="this.style.color='#6c63ff'" onmouseout="this.style.color='rgba(255,255,255,0.55)'"><i class="fa-solid fa-envelope"></i> Kontak</a></li>
  </ul>
  <div id="navAuthDesktop" style="display:none;">
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
  <button id="hamburger" onclick="toggleMenu()" style="display:flex;flex-direction:column;gap:5px;cursor:pointer;background:transparent;border:none;padding:4px;z-index:51;">
    <span style="display:block;width:24px;height:2.5px;border-radius:2px;background:var(--accent);"></span>
    <span style="display:block;width:24px;height:2.5px;border-radius:2px;background:var(--accent);"></span>
    <span style="display:block;width:24px;height:2.5px;border-radius:2px;background:var(--accent);"></span>
  </button>
</nav>

<!-- Mobile menu -->
<div id="mobileMenu">
  <a href="#home"   style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-house"></i> Home</a>
  <a href="#about"  style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-circle-info"></i> About</a>
  <a href="#testi"  style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-star"></i> Testi</a>
  <a href="#kontak" style="display:flex;align-items:center;gap:8px;font-weight:600;padding-bottom:14px;border-bottom:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.8);text-decoration:none;"><i class="fa-solid fa-envelope"></i> Kontak</a>
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
  <div style="position:absolute;top:-180px;right:-180px;width:700px;height:700px;border-radius:50%;background:radial-gradient(circle,rgba(108,99,255,0.1) 0%,transparent 70%);pointer-events:none;"></div>
  <div style="position:absolute;bottom:-100px;left:-100px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(155,89,245,0.08) 0%,transparent 70%);pointer-events:none;"></div>
  <div style="max-width:700px;width:100%;position:relative;z-index:2;">
    <div style="display:inline-flex;align-items:center;gap:6px;border-radius:9999px;padding:6px 16px;font-size:0.8rem;font-weight:700;margin-bottom:24px;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent);">
      <i class="fa-solid fa-bolt"></i> Platform Keuangan #1 Indonesia
    </div>
    <h1 style="font-size:clamp(2.2rem,7vw,3.6rem);font-weight:800;line-height:1.15;letter-spacing:-0.02em;color:#fff;margin:0 0 16px;">
      Your <span class="gradient-text">Next Future</span><br>in Finance<br>Starts Here
    </h1>
    <p style="font-size:1rem;line-height:1.7;color:var(--muted2);margin:0 auto 32px;max-width:520px;">Kelola keuanganmu dengan fitur pintar, cepat, dan aman bersama NexFi.</p>
    <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;">
      <button style="display:flex;align-items:center;gap:8px;color:#fff;font-weight:700;padding:12px 24px;border-radius:9999px;border:none;cursor:pointer;font-size:0.875rem;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 8px 25px var(--glow);">
        <i class="fa-solid fa-rocket"></i> Get Started
      </button>
      <button style="display:flex;align-items:center;gap:8px;font-weight:700;padding:12px 24px;border-radius:9999px;border:2px solid rgba(108,99,255,0.4);cursor:pointer;font-size:0.875rem;background:transparent;color:var(--accent);"
              onmouseover="this.style.background='rgba(108,99,255,0.15)'" onmouseout="this.style.background='transparent'">
        <i class="fa-solid fa-download"></i> Download App
      </button>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="about" style="padding:80px 5%;position:relative;overflow:hidden;background:linear-gradient(180deg,#07080f 0%,#0c0d1d 100%);z-index:1;">
  <div class="section-divider" style="position:absolute;top:0;left:0;right:0;"></div>
  <div style="max-width:1200px;margin:0 auto;width:100%;display:grid;grid-template-columns:1fr;gap:48px;align-items:start;" id="aboutGrid">
    <div>
      <div style="display:inline-flex;align-items:center;gap:6px;border-radius:9999px;padding:6px 16px;font-size:0.8rem;font-weight:700;margin-bottom:16px;background:rgba(108,99,255,0.12);border:1px solid rgba(108,99,255,0.25);color:var(--accent);">
        <i class="fa-solid fa-circle-question"></i> Tentang Kami
      </div>
      <h2 style="font-size:clamp(1.7rem,3.5vw,2.6rem);font-weight:800;letter-spacing:-0.02em;line-height:1.2;color:#fff;margin:0 0 12px;">
        Apa Itu <span class="gradient-text">NexFi?</span>
      </h2>
      <p style="line-height:1.7;font-size:0.95rem;color:var(--muted2);margin:0 0 24px;">Kelola finansialmu tanpa ribet dengan fitur pintar dari NexFi — solusi keuangan modern untuk kehidupan yang lebih terencana.</p>
      <div class="feature-grid">
        <div class="card-dark" style="display:flex;flex-direction:column;gap:8px;padding:16px;cursor:default;">
          <div style="width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow);">
            <i class="fa-solid fa-chart-line" style="font-size:0.875rem;"></i>
          </div>
          <div><div style="font-weight:700;font-size:0.92rem;color:#fff;">Pantau cashflow real-time</div>
          <div style="font-size:0.83rem;color:var(--muted2);margin-top:4px;line-height:1.5;">Monitor penghasilan dan pengeluaran dalam satu dashboard.</div></div>
        </div>
        <div class="card-dark" style="display:flex;flex-direction:column;gap:8px;padding:16px;cursor:default;">
          <div style="width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow);">
            <i class="fa-solid fa-magnifying-glass-chart" style="font-size:0.875rem;"></i>
          </div>
          <div><div style="font-weight:700;font-size:0.92rem;color:#fff;">Analisa finansial mudah</div>
          <div style="font-size:0.83rem;color:var(--muted2);margin-top:4px;line-height:1.5;">Insight mendalam dan laporan otomatis setiap saat.</div></div>
        </div>
        <div class="card-dark" style="display:flex;flex-direction:column;gap:8px;padding:16px;cursor:default;">
          <div style="width:38px;height:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 4px 12px var(--glow);">
            <i class="fa-solid fa-shield-halved" style="font-size:0.875rem;"></i>
          </div>
          <div><div style="font-weight:700;font-size:0.92rem;color:#fff;">Keamanan terjamin</div>
          <div style="font-size:0.83rem;color:var(--muted2);margin-top:4px;line-height:1.5;">Enkripsi data & proteksi berlapis untuk akun kamu.</div></div>
        </div>
      </div>
      <button style="display:inline-flex;align-items:center;gap:8px;margin-top:24px;color:#fff;font-weight:700;padding:12px 24px;border-radius:9999px;border:none;cursor:pointer;font-size:0.875rem;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 8px 25px var(--glow);">
        Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>
    <div style="border-radius:22px;overflow:hidden;border:1px solid var(--border);box-shadow:0 16px 60px rgba(108,99,255,0.15);background:#0c0d1d;">
      <a href="https://youtu.be/fbBMjWc8Usk" target="_blank" rel="noopener" style="display:block;position:relative;width:100%;overflow:hidden;aspect-ratio:16/9;">
        <img src="https://img.youtube.com/vi/fbBMjWc8Usk/maxresdefault.jpg" onerror="this.src='https://img.youtube.com/vi/fbBMjWc8Usk/hqdefault.jpg'" alt="Demo NexFi" style="width:100%;height:100%;object-fit:cover;" />
        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
          <div style="width:68px;height:68px;border-radius:50%;background:#dc2626;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;box-shadow:0 8px 30px rgba(0,0,0,0.5);">
            <i class="fa-solid fa-play" style="margin-left:4px;"></i>
          </div>
        </div>
        <div style="position:absolute;bottom:12px;right:12px;background:rgba(0,0,0,0.75);color:#fff;font-size:0.72rem;font-weight:700;padding:2px 8px;border-radius:4px;">5:32</div>
      </a>
      <div style="padding:20px 24px 24px;">
        <p style="font-size:0.88rem;line-height:1.6;color:var(--muted2);margin:0 0 16px;">Lihat langsung bagaimana NexFi membantu kamu mengelola keuangan dengan lebih cerdas dan efisien.</p>
        <a href="https://youtu.be/fbBMjWc8Usk" target="_blank" rel="noopener" style="display:flex;align-items:center;justify-content:center;gap:8px;color:#fff;text-decoration:none;padding:12px;border-radius:9999px;font-weight:700;font-size:0.9rem;background:#dc2626;">
          <i class="fa-brands fa-youtube"></i> Tonton Video Demo
        </a>
      </div>
    </div>
  </div>
</section>

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
        <div class="testi-slide"><div class="card-dark" style="padding:20px 24px;display:flex;flex-direction:column;height:100%;min-height:210px;"><div style="color:#f59e0b;margin-bottom:12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p style="font-size:0.88rem;line-height:1.6;font-style:italic;color:var(--muted2);flex:1;margin:0 0 20px;">"NexFi sangat membantu saya mengatur keuangan dengan mudah dan cepat. Fitur analitik-nya luar biasa!"</p><div style="display:flex;align-items:center;gap:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.07);"><div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;background:linear-gradient(135deg,var(--accent),var(--accent2));"><i class="fa-solid fa-user" style="font-size:0.875rem;"></i></div><div><div style="font-weight:700;font-size:0.9rem;color:#fff;">Andi Setiawan</div><div style="font-size:0.75rem;color:var(--muted);">Pengusaha, Jakarta</div></div></div></div></div>
        <div class="testi-slide"><div class="card-dark" style="padding:20px 24px;display:flex;flex-direction:column;height:100%;min-height:210px;"><div style="color:#f59e0b;margin-bottom:12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p style="font-size:0.88rem;line-height:1.6;font-style:italic;color:var(--muted2);flex:1;margin:0 0 20px;">"Aplikasi yang sangat user-friendly! Sekarang nabung dan investasi jadi lebih terencana. Recommend banget!"</p><div style="display:flex;align-items:center;gap:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.07);"><div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;background:linear-gradient(135deg,#EC4899,#F472B6);"><i class="fa-solid fa-user" style="font-size:0.875rem;"></i></div><div><div style="font-weight:700;font-size:0.9rem;color:#fff;">Maria Tan</div><div style="font-size:0.75rem;color:var(--muted);">Mahasiswi, Surabaya</div></div></div></div></div>
        <div class="testi-slide"><div class="card-dark" style="padding:20px 24px;display:flex;flex-direction:column;height:100%;min-height:210px;"><div style="color:#f59e0b;margin-bottom:12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star" style="color:rgba(255,255,255,0.18);"></i></div><p style="font-size:0.88rem;line-height:1.6;font-style:italic;color:var(--muted2);flex:1;margin:0 0 20px;">"Keamanan tinggi dan proses cepat. NexFi bikin hidup saya jauh lebih teratur. Highly recommended!"</p><div style="display:flex;align-items:center;gap:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.07);"><div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;background:linear-gradient(135deg,#10B981,#34D399);"><i class="fa-solid fa-user" style="font-size:0.875rem;"></i></div><div><div style="font-weight:700;font-size:0.9rem;color:#fff;">Rahmat H.</div><div style="font-size:0.75rem;color:var(--muted);">Karyawan, Bandung</div></div></div></div></div>
        <div class="testi-slide"><div class="card-dark" style="padding:20px 24px;display:flex;flex-direction:column;height:100%;min-height:210px;"><div style="color:#f59e0b;margin-bottom:12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p style="font-size:0.88rem;line-height:1.6;font-style:italic;color:var(--muted2);flex:1;margin:0 0 20px;">"Dashboard-nya bersih dan mudah dipahami. Semua laporan keuangan kelihatan jelas. Top banget!"</p><div style="display:flex;align-items:center;gap:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.07);"><div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;background:linear-gradient(135deg,#f59e0b,#fbbf24);"><i class="fa-solid fa-user" style="font-size:0.875rem;"></i></div><div><div style="font-weight:700;font-size:0.9rem;color:#fff;">Dian Pratiwi</div><div style="font-size:0.75rem;color:var(--muted);">Ibu Rumah Tangga, Yogyakarta</div></div></div></div></div>
        <div class="testi-slide"><div class="card-dark" style="padding:20px 24px;display:flex;flex-direction:column;height:100%;min-height:210px;"><div style="color:#f59e0b;margin-bottom:12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div><p style="font-size:0.88rem;line-height:1.6;font-style:italic;color:var(--muted2);flex:1;margin:0 0 20px;">"Notifikasi real-time-nya keren! Setiap ada transaksi langsung muncul. Nggak ada yang kelewat."</p><div style="display:flex;align-items:center;gap:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.07);"><div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;background:linear-gradient(135deg,#6366f1,#818cf8);"><i class="fa-solid fa-user" style="font-size:0.875rem;"></i></div><div><div style="font-weight:700;font-size:0.9rem;color:#fff;">Budi Santoso</div><div style="font-size:0.75rem;color:var(--muted);">Freelancer, Bali</div></div></div></div></div>
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
      <h2 style="font-size:clamp(1.6rem,4vw,2.5rem);font-weight:800;color:#fff;margin:0 0 16px;">Ada Pertanyaan atau Saran?<br><span class="gradient-text">Kami Siap Membantu</span></h2>
      <p style="color:var(--muted2);font-size:0.9rem;max-width:480px;margin:0 auto;">Pilih menu di bawah untuk mengirim pesan atau testimoni.</p>
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
    </div>
    <div style="border-radius:24px;padding:32px;background:#0c0d1d;border:1px solid var(--border);box-shadow:0 10px 45px rgba(108,99,255,0.12);">
      <form id="formTesti" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <div><label class="form-label">Nama Lengkap</label><input type="text" placeholder="Nama kamu" class="inp-dark"></div>
        <div><label class="form-label">Email</label><input type="email" placeholder="nama@email.com" class="inp-dark"></div>
        <div style="grid-column:1/-1;">
          <label class="form-label">Foto Profil</label>
          <div style="display:flex;align-items:center;gap:16px;">
            <div style="width:56px;height:56px;border-radius:50%;overflow:hidden;display:flex;align-items:center;justify-content:center;border:1px solid rgba(108,99,255,0.3);background:rgba(108,99,255,0.1);flex-shrink:0;">
              <img id="avatarPreview" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
              <i id="avatarIcon" class="fa-solid fa-user" style="color:rgba(108,99,255,0.5);font-size:1.1rem;"></i>
            </div>
            <label style="flex:1;display:flex;align-items:center;gap:12px;cursor:pointer;border-radius:12px;padding:16px;background:rgba(255,255,255,0.04);border:1.5px dashed rgba(108,99,255,0.3);">
              <i class="fa-solid fa-cloud-arrow-up" style="color:var(--accent);"></i>
              <div><div style="font-weight:600;font-size:0.875rem;color:rgba(255,255,255,0.7);">Klik untuk upload foto</div><div style="font-size:0.75rem;color:var(--muted);">PNG / JPG (max 2MB)</div></div>
              <input type="file" id="fotoInput" accept="image/*" style="display:none;">
            </label>
          </div>
        </div>
        <div style="grid-column:1/-1;">
          <label class="form-label">Rating</label>
          <div id="ratingStars" style="display:flex;gap:8px;font-size:1.7rem;cursor:pointer;color:rgba(255,255,255,0.15);">
            <i class="fa-solid fa-star" data-value="1"></i><i class="fa-solid fa-star" data-value="2"></i><i class="fa-solid fa-star" data-value="3"></i><i class="fa-solid fa-star" data-value="4"></i><i class="fa-solid fa-star" data-value="5"></i>
          </div>
        </div>
        <div style="grid-column:1/-1;"><label class="form-label">Testimoni</label><textarea rows="4" placeholder="Ceritakan pengalamanmu..." class="inp-dark" style="resize:none;"></textarea></div>
        <button type="button" onclick="handleFakeSubmit(this)" style="grid-column:1/-1;display:flex;align-items:center;justify-content:center;gap:8px;color:#fff;font-weight:700;padding:14px;border-radius:16px;border:none;cursor:pointer;font-family:'Inter',sans-serif;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 10px 30px var(--glow);">
          <i class="fa-solid fa-paper-plane"></i> Kirim Testimoni
        </button>
      </form>
      <form id="formKoran" style="display:none;grid-template-columns:1fr 1fr;gap:20px;">
        <div><label class="form-label">Nama Lengkap</label><input type="text" placeholder="Nama kamu" class="inp-dark"></div>
        <div><label class="form-label">Email</label><input type="email" placeholder="nama@email.com" class="inp-dark"></div>
        <div style="grid-column:1/-1;"><label class="form-label">Subjek</label><input type="text" placeholder="Topik pesan" class="inp-dark"></div>
        <div style="grid-column:1/-1;"><label class="form-label">Pesan</label><textarea rows="5" placeholder="Tulis pesan kamu..." class="inp-dark" style="resize:none;"></textarea></div>
        <button type="button" onclick="handleFakeSubmit(this)" style="grid-column:1/-1;display:flex;align-items:center;justify-content:center;gap:8px;color:#fff;font-weight:700;padding:14px;border-radius:16px;border:none;cursor:pointer;font-family:'Inter',sans-serif;background:linear-gradient(135deg,var(--accent),var(--accent2));box-shadow:0 10px 30px var(--glow);">
          <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
        </button>
      </form>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer style="padding:48px 6% 24px;background:#04050c;border-top:1px solid rgba(108,99,255,0.2);position:relative;z-index:1;">
  <div style="max-width:1200px;margin:0 auto;">
    <div style="display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:32px;padding-bottom:32px;border-bottom:1px solid rgba(255,255,255,0.07);">
      <div>
        <div style="display:flex;align-items:center;gap:8px;font-size:1.3rem;font-weight:800;margin-bottom:8px;" class="gradient-text">
          <i class="fa-solid fa-circle-nodes"></i> NexFi
        </div>
        <p style="font-size:0.83rem;color:var(--muted);max-width:220px;margin:0;">Your Next Future in Finance. Kelola keuanganmu lebih cerdas.</p>
      </div>
      <div>
        <div style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.3);margin-bottom:12px;">Ikuti Kami</div>
        <div style="display:flex;align-items:center;gap:12px;">
          <a href="#" style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4);text-decoration:none;" onmouseover="this.style.background='rgba(108,99,255,0.5)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'"><i class="fa-brands fa-instagram" style="font-size:0.875rem;"></i></a>
          <a href="#" style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4);text-decoration:none;" onmouseover="this.style.background='rgba(108,99,255,0.5)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'"><i class="fa-brands fa-tiktok" style="font-size:0.875rem;"></i></a>
          <a href="#" target="_blank" style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4);text-decoration:none;" onmouseover="this.style.background='#dc2626';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'"><i class="fa-brands fa-youtube" style="font-size:0.875rem;"></i></a>
          <a href="#" style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4);text-decoration:none;" onmouseover="this.style.background='rgba(108,99,255,0.5)';this.style.color='#fff'" onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.4)'"><i class="fa-brands fa-twitter" style="font-size:0.875rem;"></i></a>
        </div>
      </div>
      <div>
        <div style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.3);margin-bottom:12px;">Kontak</div>
        <div style="display:flex;flex-direction:column;gap:8px;">
          <a href="mailto:support@nexfi.id" style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:rgba(255,255,255,0.4);text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'"><i class="fa-solid fa-envelope" style="font-size:0.75rem;"></i> support@nexfi.id</a>
          <a href="https://wa.me/6281234567890" target="_blank" style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:rgba(255,255,255,0.4);text-decoration:none;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.4)'"><i class="fa-brands fa-whatsapp" style="font-size:0.75rem;"></i> +62 812-3456-7890</a>
          <span style="display:flex;align-items:center;gap:8px;font-size:0.85rem;color:rgba(255,255,255,0.4);"><i class="fa-solid fa-location-dot" style="font-size:0.75rem;"></i> Jakarta, Indonesia</span>
        </div>
      </div>
    </div>
    <div style="padding-top:20px;text-align:center;font-size:0.82rem;color:rgba(255,255,255,0.2);">
      © 2025 <strong style="color:rgba(255,255,255,0.35);">NexFi</strong>. All rights reserved.
    </div>
  </div>
</footer>

<script>
function applyLayout() {
  const d = window.innerWidth >= 768;
  document.getElementById('navLinks').style.display = d ? 'flex' : 'none';
  document.getElementById('navAuthDesktop').style.display = d ? 'block' : 'none';
  document.getElementById('hamburger').style.display = d ? 'none' : 'flex';
  document.getElementById('aboutGrid').style.gridTemplateColumns = d ? '1fr 1fr' : '1fr';
  document.querySelectorAll('#formTesti, #formKoran').forEach(f => {
    f.style.gridTemplateColumns = d ? '1fr 1fr' : '1fr';
  });
}
applyLayout();
window.addEventListener('resize', applyLayout);

let menuOpen = false;
function toggleMenu() {
  menuOpen = !menuOpen;
  document.getElementById('mobileMenu').style.display = menuOpen ? 'flex' : 'none';
}
document.querySelectorAll('#mobileMenu a').forEach(a => {
  a.addEventListener('click', () => { menuOpen = false; document.getElementById('mobileMenu').style.display = 'none'; });
});

window.addEventListener('scroll', () => {
  document.getElementById('navbar').style.boxShadow = window.scrollY > 20 ? '0 4px 30px rgba(0,0,0,0.5)' : 'none';
});

function activateTesti() {
  document.getElementById('formTesti').style.display = 'grid';
  document.getElementById('formKoran').style.display = 'none';
  document.getElementById('btnTesti').style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:#fff;border:none;cursor:pointer;font-family:Inter,sans-serif;background:linear-gradient(135deg,#6c63ff,#9b59f5);box-shadow:0 4px 14px rgba(108,99,255,0.4);';
  document.getElementById('btnKoran').style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:rgba(255,255,255,0.45);border:none;cursor:pointer;font-family:Inter,sans-serif;background:transparent;';
}
function activateKoran() {
  document.getElementById('formKoran').style.display = window.innerWidth >= 768 ? 'grid' : 'block';
  document.getElementById('formTesti').style.display = 'none';
  document.getElementById('btnKoran').style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:#fff;border:none;cursor:pointer;font-family:Inter,sans-serif;background:linear-gradient(135deg,#6c63ff,#9b59f5);box-shadow:0 4px 14px rgba(108,99,255,0.4);';
  document.getElementById('btnTesti').style.cssText = 'padding:10px 24px;border-radius:9999px;font-size:0.875rem;font-weight:700;color:rgba(255,255,255,0.45);border:none;cursor:pointer;font-family:Inter,sans-serif;background:transparent;';
}

document.querySelectorAll('#ratingStars i').forEach(star => {
  star.addEventListener('click', function() {
    const val = this.getAttribute('data-value');
    document.querySelectorAll('#ratingStars i').forEach(s => {
      s.style.color = s.getAttribute('data-value') <= val ? '#F59E0B' : 'rgba(255,255,255,0.15)';
    });
  });
});

const fotoInput = document.getElementById('fotoInput');
if (fotoInput) {
  fotoInput.addEventListener('change', () => {
    if (fotoInput.files.length > 0) {
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById('avatarPreview').src = e.target.result;
        document.getElementById('avatarPreview').style.display = 'block';
        document.getElementById('avatarIcon').style.display = 'none';
      };
      reader.readAsDataURL(fotoInput.files[0]);
    }
  });
}

function handleFakeSubmit(btn) {
  const orig = btn.innerHTML;
  btn.innerHTML = '<i class="fa-solid fa-check"></i> Terkirim!';
  btn.disabled = true;
  setTimeout(() => {
    btn.innerHTML = orig; btn.disabled = false;
    document.querySelectorAll('#ratingStars i').forEach(s => s.style.color = 'rgba(255,255,255,0.15)');
    const ap = document.getElementById('avatarPreview');
    const ai = document.getElementById('avatarIcon');
    if (ap) { ap.src = ''; ap.style.display = 'none'; }
    if (ai) ai.style.display = '';
  }, 2500);
}

(function() {
  const track = document.getElementById('testiTrack');
  const dotsWrap = document.getElementById('testiDots');
  if (!track || !dotsWrap) return;
  const slides = track.querySelectorAll('.testi-slide');
  const total = slides.length;
  let current = 0, startX = 0, isDragging = false, dragDelta = 0;

  function isMobile()  { return window.innerWidth < 768; }
  function perPage()   { return isMobile() ? 1 : 3; }
  function pageCount() { return Math.ceil(total / perPage()); }
  function slideW()    { return slides[0].offsetWidth + (isMobile() ? 16 : 24); }

  function buildDots() {
    dotsWrap.innerHTML = '';
    for (let i = 0; i < pageCount(); i++) {
      const d = document.createElement('button');
      d.className = 'testi-dot' + (i === current ? ' active' : '');
      d.addEventListener('click', () => goTo(i));
      dotsWrap.appendChild(d);
    }
  }
  function updateDots() { dotsWrap.querySelectorAll('.testi-dot').forEach((d,i) => d.classList.toggle('active', i===current)); }
  function goTo(idx) {
    current = Math.max(0, Math.min(pageCount()-1, idx));
    track.style.transform = 'translateX(-' + (current * perPage() * slideW()) + 'px)';
    updateDots();
  }

  track.addEventListener('touchstart', e => { startX=e.touches[0].clientX; isDragging=true; dragDelta=0; }, {passive:true});
  track.addEventListener('touchmove',  e => { if(isDragging) dragDelta=e.touches[0].clientX-startX; }, {passive:true});
  track.addEventListener('touchend',   () => { if(!isDragging)return; isDragging=false; if(dragDelta<-60) goTo(current+1); else if(dragDelta>60) goTo(current-1); });
  track.addEventListener('mousedown',  e => { startX=e.clientX; isDragging=true; dragDelta=0; track.style.cursor='grabbing'; });
  window.addEventListener('mousemove', e => { if(isDragging) dragDelta=e.clientX-startX; });
  window.addEventListener('mouseup',   () => { if(!isDragging)return; isDragging=false; track.style.cursor='grab'; if(dragDelta<-60) goTo(current+1); else if(dragDelta>60) goTo(current-1); dragDelta=0; });
  window.addEventListener('resize',    () => { current=0; track.style.transform='translateX(0)'; buildDots(); });

  track.style.cursor = 'grab';
  buildDots();
})();
</script>
</body>
</html>