<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi & Syarat Ketentuan | {{ $appName }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:    #07080f;
            --bg2:   #0c0d1d;
            --bg3:   #10132a;
            --bg4:   #13163a;
            --acc:   #6c63ff;
            --acc2:  #9b59f5;
            --glow:  rgba(108,99,255,0.3);
            --muted: rgba(255,255,255,0.35);
            --text:  rgba(255,255,255,0.82);
            --border: rgba(108,99,255,0.14);
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.7;
        }

        /* ── BACKGROUND ── */
        .bg-grid {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image:
                linear-gradient(rgba(108,99,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .bg-orb1 { position:fixed;width:600px;height:600px;border-radius:50%;top:-250px;left:-200px;background:radial-gradient(circle,rgba(108,99,255,0.13) 0%,transparent 70%);pointer-events:none;z-index:0; }
        .bg-orb2 { position:fixed;width:500px;height:500px;border-radius:50%;bottom:-200px;right:-150px;background:radial-gradient(circle,rgba(155,89,245,0.1) 0%,transparent 70%);pointer-events:none;z-index:0; }

        /* ── LAYOUT ── */
        .wrap {
            position: relative; z-index: 1;
            max-width: 860px;
            margin: 0 auto;
            padding: 40px 20px 80px;
        }

        /* ── BACK BUTTON ── */
        .back-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 7px 14px; border-radius: 9px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(108,99,255,0.18);
            color: rgba(255,255,255,0.4);
            font-size: 12px; font-weight: 600;
            text-decoration: none;
            margin-bottom: 32px;
            transition: all 0.2s;
        }
        .back-btn:hover { background: rgba(108,99,255,0.1); color: #a78bfa; border-color: rgba(108,99,255,0.35); }

        /* ── HERO HEADER ── */
        .hero {
            text-align: center;
            padding: 48px 24px 40px;
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 20px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #6c63ff, #9b59f5, #6c63ff);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

        .hero-icon {
            width: 64px; height: 64px; border-radius: 18px; margin: 0 auto 20px;
            background: linear-gradient(135deg, rgba(108,99,255,0.2), rgba(155,89,245,0.2));
            border: 1px solid rgba(108,99,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 26px;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(22px, 5vw, 34px);
            font-weight: 800; color: #fff;
            letter-spacing: -0.3px;
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 13px; color: rgba(255,255,255,0.3);
            max-width: 480px; margin: 0 auto 18px;
            line-height: 1.7;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 14px; border-radius: 20px;
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.2);
            font-size: 11px; font-weight: 700;
            color: #a78bfa;
        }

        /* ── TAB SWITCHER ── */
        .tab-bar {
            display: flex; gap: 8px;
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 6px;
            margin-bottom: 28px;
        }
        .tab-btn {
            flex: 1; padding: 10px 16px; border-radius: 10px;
            background: transparent; border: none; cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,0.35);
            transition: all 0.2s;
        }
        .tab-btn.active {
            background: linear-gradient(135deg, rgba(108,99,255,0.25), rgba(155,89,245,0.15));
            border: 1px solid rgba(108,99,255,0.3);
            color: #a78bfa;
        }
        .tab-btn:hover:not(.active) { color: rgba(255,255,255,0.6); background: rgba(255,255,255,0.03); }

        .tab-panel { display: none; }
        .tab-panel.active { display: block; }

        /* ── TOC ── */
        .toc-card {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 28px;
        }
        .toc-title {
            font-size: 10px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: rgba(255,255,255,0.25);
            display: flex; align-items: center; gap: 6px;
            margin-bottom: 14px;
        }
        .toc-title i { color: rgba(108,99,255,0.5); }
        .toc-list { display: flex; flex-direction: column; gap: 4px; }
        .toc-item {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 10px; border-radius: 9px;
            text-decoration: none; color: rgba(255,255,255,0.45);
            font-size: 12.5px; font-weight: 600;
            transition: all 0.15s;
        }
        .toc-item:hover { background: rgba(108,99,255,0.1); color: #a78bfa; }
        .toc-num {
            width: 22px; height: 22px; border-radius: 6px; flex-shrink: 0;
            background: rgba(108,99,255,0.1); border: 1px solid rgba(108,99,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 9px; font-weight: 800; color: rgba(108,99,255,0.8);
        }

        /* ── SECTIONS ── */
        .section {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 14px;
            overflow: hidden;
            transition: border-color 0.2s;
        }
        .section:hover { border-color: rgba(108,99,255,0.25); }

        .section-header {
            padding: 18px 22px;
            display: flex; align-items: center; gap: 12px;
            cursor: pointer;
            user-select: none;
        }
        .section-header:hover .section-title { color: #fff; }

        .section-ico {
            width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
            background: rgba(108,99,255,0.1); border: 1px solid rgba(108,99,255,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: #a78bfa;
        }
        .section-meta { flex: 1; min-width: 0; }
        .section-num {
            font-size: 9.5px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.07em; color: rgba(108,99,255,0.6);
            margin-bottom: 2px;
        }
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 700; color: rgba(255,255,255,0.88);
            transition: color 0.15s;
        }
        .section-chevron {
            color: rgba(255,255,255,0.2); font-size: 11px;
            transition: transform 0.25s;
            flex-shrink: 0;
        }
        .section.open .section-chevron { transform: rotate(180deg); }

        .section-body {
            padding: 0 22px 20px 70px;
            display: none;
            animation: fadeIn 0.2s ease;
        }
        .section.open .section-body { display: block; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(-4px)} to{opacity:1;transform:translateY(0)} }

        @media(max-width:480px) {
            .section-body { padding: 0 16px 18px 16px; }
        }

        .section-body p {
            font-size: 13px; color: rgba(255,255,255,0.6);
            line-height: 1.8; margin-bottom: 12px;
        }
        .section-body p:last-child { margin-bottom: 0; }

        .section-body ul, .section-body ol {
            padding-left: 0; list-style: none;
            display: flex; flex-direction: column; gap: 8px;
            margin-bottom: 14px;
        }
        .section-body ul li, .section-body ol li {
            font-size: 13px; color: rgba(255,255,255,0.6);
            line-height: 1.7;
            display: flex; align-items: flex-start; gap: 8px;
        }
        .section-body ul li::before {
            content: '';
            width: 5px; height: 5px; border-radius: 50%;
            background: rgba(108,99,255,0.6);
            flex-shrink: 0; margin-top: 8px;
        }
        .section-body ol { counter-reset: ol-counter; }
        .section-body ol li { counter-increment: ol-counter; }
        .section-body ol li::before {
            content: counter(ol-counter);
            width: 20px; height: 20px; border-radius: 5px; flex-shrink: 0;
            background: rgba(108,99,255,0.1); border: 1px solid rgba(108,99,255,0.2);
            font-size: 9px; font-weight: 800; color: #a78bfa;
            display: flex; align-items: center; justify-content: center;
            margin-top: 2px;
        }

        .highlight-box {
            padding: 14px 16px; border-radius: 11px;
            background: rgba(108,99,255,0.07);
            border: 1px solid rgba(108,99,255,0.18);
            margin: 14px 0;
            font-size: 12.5px; color: rgba(255,255,255,0.55);
            line-height: 1.7;
        }
        .highlight-box.green {
            background: rgba(34,197,94,0.06);
            border-color: rgba(34,197,94,0.18);
            color: rgba(74,222,128,0.8);
        }
        .highlight-box.red {
            background: rgba(239,68,68,0.06);
            border-color: rgba(239,68,68,0.18);
            color: rgba(248,113,113,0.8);
        }
        .highlight-box.yellow {
            background: rgba(234,179,8,0.06);
            border-color: rgba(234,179,8,0.18);
            color: rgba(250,204,21,0.8);
        }
        .highlight-box i { margin-right: 6px; }

        /* ── CONTACT CARD ── */
        .contact-card {
            background: var(--bg3);
            border: 1px solid rgba(108,99,255,0.2);
            border-radius: 16px;
            padding: 24px;
            margin-top: 14px;
            text-align: center;
            position: relative; overflow: hidden;
        }
        .contact-card::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at center top, rgba(108,99,255,0.08) 0%, transparent 60%);
            pointer-events: none;
        }
        .contact-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 6px;
        }
        .contact-card p  { font-size: 12.5px; color: rgba(255,255,255,0.3); margin-bottom: 16px; }
        .contact-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; border-radius: 11px;
            background: linear-gradient(135deg, #6c63ff, #9b59f5);
            color: #fff; font-size: 13px; font-weight: 700;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(108,99,255,0.3);
            transition: opacity 0.2s;
        }
        .contact-btn:hover { opacity: 0.88; }

        /* ── FOOTER ── */
        .page-footer {
            text-align: center; margin-top: 40px;
            font-size: 11.5px; color: rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .page-footer span { color: rgba(108,99,255,0.5); font-weight: 700; }

        /* ── PROGRESS BAR ── */
        .reading-bar {
            position: fixed; top: 0; left: 0; height: 2px; z-index: 100;
            background: linear-gradient(90deg, #6c63ff, #9b59f5);
            width: 0%; transition: width 0.1s linear;
        }

        /* ── PANEL HEADER ── */
        .panel-heading {
            font-family: 'Playfair Display', serif;
            font-size: clamp(18px, 4vw, 26px);
            font-weight: 800; color: #fff;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
        }
        .panel-heading i { color: #a78bfa; font-size: 0.8em; }
    </style>
</head>
<body>

<div class="reading-bar" id="readingBar"></div>
<div class="bg-grid"></div>
<div class="bg-orb1"></div>
<div class="bg-orb2"></div>

<div class="wrap">

    {{-- Back --}}
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>

    {{-- Hero --}}
    <div class="hero">
        <div class="hero-icon">🔐</div>
        <h1>Kebijakan & Ketentuan</h1>
        <p>
            Kami berkomitmen menjaga kepercayaan Anda. Pelajari kebijakan privasi
            dan syarat penggunaan layanan {{ $appName }}.
        </p>
        <div class="hero-badge">
            <i class="fa-solid fa-clock" style="font-size:10px;"></i>
            Terakhir diperbarui: {{ $lastUpdated }}
        </div>
    </div>

    {{-- Tab Bar --}}
    <div class="tab-bar">
        <button class="tab-btn active" onclick="switchTab('privacy', this)">
            <i class="fa-solid fa-shield-halved" style="margin-right:6px;font-size:11px;"></i> Kebijakan Privasi
        </button>
        <button class="tab-btn" onclick="switchTab('terms', this)">
            <i class="fa-solid fa-file-contract" style="margin-right:6px;font-size:11px;"></i> Syarat & Ketentuan
        </button>
    </div>

    {{-- ═══════════════ PRIVACY POLICY PANEL ═══════════════ --}}
    <div class="tab-panel active" id="panel-privacy">

        {{-- Table of Contents --}}
        <div class="toc-card">
            <div class="toc-title"><i class="fa-solid fa-list"></i> Daftar Isi — Kebijakan Privasi</div>
            <div class="toc-list">
                @php
                $tocPrivacy = [
                    ['anchor' => 'p1', 'label' => 'Pendahuluan'],
                    ['anchor' => 'p2', 'label' => 'Definisi'],
                    ['anchor' => 'p3', 'label' => 'Ruang Lingkup'],
                    ['anchor' => 'p4', 'label' => 'Informasi yang Dikumpulkan'],
                    ['anchor' => 'p5', 'label' => 'Cara Penggunaan Data'],
                    ['anchor' => 'p6', 'label' => 'Penyimpanan dan Keamanan Data'],
                    ['anchor' => 'p7', 'label' => 'Pengungkapan kepada Pihak Ketiga'],
                    ['anchor' => 'p8', 'label' => 'Cookies dan Teknologi Serupa'],
                    ['anchor' => 'p9', 'label' => 'Hak Pengguna'],
                    ['anchor' => 'p10', 'label' => 'Retensi Data'],
                    ['anchor' => 'p11', 'label' => 'Perubahan Kebijakan'],
                    ['anchor' => 'p12', 'label' => 'Kontak'],
                ];
                @endphp
                @foreach($tocPrivacy as $i => $item)
                <a href="#{{ $item['anchor'] }}" class="toc-item" onclick="openSection('{{ $item['anchor'] }}')">
                    <div class="toc-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                    {{ $item['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- P1: Pendahuluan --}}
        <div class="section open" id="p1">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-house"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 01</div>
                    <div class="section-title">Pendahuluan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    {{ $appName }} ("Kami") berkomitmen untuk melindungi dan menjaga kerahasiaan data pribadi pengguna ("Anda").
                    Dengan menggunakan layanan {{ $appName }}, Anda dianggap telah membaca, memahami, dan menyetujui Kebijakan Privasi ini.
                </p>
                <div class="highlight-box green">
                    <i class="fa-solid fa-circle-check"></i>
                    Privasi Anda adalah prioritas kami. Kami hanya menggunakan data untuk meningkatkan layanan kepada Anda.
                </div>
            </div>
        </div>

        {{-- P2: Definisi --}}
        <div class="section" id="p2">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-book"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 02</div>
                    <div class="section-title">Definisi</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Layanan</strong> — Website {{ $appName }} beserta seluruh fitur di dalamnya.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Data Pribadi</strong> — Informasi yang dapat mengidentifikasi individu secara langsung atau tidak langsung.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Pengguna</strong> — Individu yang mengakses atau menggunakan {{ $appName }}.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Data Penggunaan</strong> — Data yang dikumpulkan secara otomatis saat menggunakan layanan.</li>
                </ul>
            </div>
        </div>

        {{-- P3: Ruang Lingkup --}}
        <div class="section" id="p3">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-globe"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 03</div>
                    <div class="section-title">Ruang Lingkup</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    Kebijakan ini berlaku untuk seluruh layanan {{ $appName }}, baik melalui website maupun fitur berbasis AI yang disediakan oleh platform kami.
                </p>
            </div>
        </div>

        {{-- P4: Informasi yang Dikumpulkan --}}
        <div class="section" id="p4">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-database"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 04</div>
                    <div class="section-title">Informasi yang Dikumpulkan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Kami dapat mengumpulkan jenis informasi berikut:</p>
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Informasi Akun</strong> — Nama lengkap dan alamat email yang Anda daftarkan.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Data Keuangan</strong> — Catatan pemasukan, pengeluaran, dan catatan finansial yang Anda input.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Data Interaksi AI</strong> — Riwayat percakapan dengan fitur AI untuk meningkatkan akurasi layanan.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Data Teknis</strong> — Alamat IP, jenis perangkat, dan log aktivitas untuk keperluan keamanan.</li>
                </ul>
                <div class="highlight-box green">
                    <i class="fa-solid fa-circle-check"></i>
                    Kami hanya mengumpulkan data yang benar-benar diperlukan. Tidak ada data yang dikumpulkan tanpa tujuan yang jelas.
                </div>
            </div>
        </div>

        {{-- P5: Cara Penggunaan Data --}}
        <div class="section" id="p5">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-gear"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 05</div>
                    <div class="section-title">Cara Penggunaan Data</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Data yang kami kumpulkan digunakan untuk:</p>
                <ol>
                    <li>Menyediakan layanan {{ $appName }} secara optimal.</li>
                    <li>Memberikan analisis dan prediksi keuangan yang akurat.</li>
                    <li>Meningkatkan performa dan kecerdasan fitur AI.</li>
                    <li>Menjaga keamanan akun dan mencegah penyalahgunaan layanan.</li>
                    <li>Memenuhi kewajiban hukum yang berlaku di Indonesia.</li>
                </ol>
                <div class="highlight-box red">
                    <i class="fa-solid fa-ban"></i>
                    Kami tidak menggunakan data Anda untuk keperluan iklan, profiling komersial, atau menjualnya kepada pihak manapun.
                </div>
            </div>
        </div>

        {{-- P6: Penyimpanan & Keamanan --}}
        <div class="section" id="p6">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 06</div>
                    <div class="section-title">Penyimpanan dan Keamanan Data</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Kami menerapkan langkah-langkah keamanan industri untuk melindungi data Anda:</p>
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Enkripsi Data</strong> — Kata sandi dienkripsi dengan bcrypt dan komunikasi menggunakan HTTPS/TLS.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Pembatasan Akses</strong> — Hanya personel teknis berwenang yang dapat mengakses sistem database.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Sistem Keamanan Terkini</strong> — Pemantauan dan audit keamanan dilakukan secara berkala.</li>
                </ul>
                <div class="highlight-box yellow">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Tidak ada sistem yang 100% aman. Pengguna juga bertanggung jawab menjaga keamanan akun masing-masing, termasuk kerahasiaan kata sandi.
                </div>
            </div>
        </div>

        {{-- P7: Pihak Ketiga --}}
        <div class="section" id="p7">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-share-nodes"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 07</div>
                    <div class="section-title">Pengungkapan kepada Pihak Ketiga</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Kami tidak menjual data pengguna. Namun, data dapat dibagikan dalam kondisi berikut:</p>
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Kewajiban Hukum</strong> — Jika diwajibkan oleh peraturan perundang-undangan Indonesia atau perintah pengadilan yang sah.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Mitra Layanan</strong> — Penyedia hosting dan analytics yang membantu operasional, terikat perjanjian kerahasiaan.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Persetujuan Pengguna</strong> — Jika Anda secara eksplisit memberikan izin untuk berbagi data tertentu.</li>
                </ul>
                <div class="highlight-box red">
                    <i class="fa-solid fa-ban"></i>
                    Data Anda tidak pernah dan tidak akan pernah dijual kepada pengiklan, broker data, atau pihak ketiga manapun.
                </div>
            </div>
        </div>

        {{-- P8: Cookies --}}
        <div class="section" id="p8">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-cookie-bite"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 08</div>
                    <div class="section-title">Cookies dan Teknologi Serupa</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>{{ $appName }} menggunakan cookies untuk keperluan berikut:</p>
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Preferensi Pengguna</strong> — Menyimpan pengaturan tampilan dan pilihan bahasa Anda.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Pengalaman Pengguna</strong> — Menjaga sesi login agar tidak perlu masuk ulang setiap saat.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Analisis Penggunaan</strong> — Memahami cara pengguna berinteraksi dengan layanan untuk terus kami tingkatkan.</li>
                </ul>
                <div class="highlight-box">
                    <i class="fa-solid fa-info-circle"></i>
                    Kami tidak menggunakan cookie pelacak pihak ketiga atau cookie iklan. Anda dapat mengatur cookie melalui pengaturan browser Anda.
                </div>
            </div>
        </div>

        {{-- P9: Hak Pengguna --}}
        <div class="section" id="p9">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-user-shield"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 09</div>
                    <div class="section-title">Hak Pengguna</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Anda memiliki hak-hak berikut terhadap data pribadi Anda:</p>
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Hak Akses</strong> — Mengakses dan melihat seluruh data pribadi yang kami simpan.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Hak Koreksi</strong> — Memperbaiki atau memperbarui data yang tidak akurat.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Hak Penghapusan</strong> — Meminta penghapusan akun dan seluruh data terkait secara permanen.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Hak Penarikan Persetujuan</strong> — Menarik izin penggunaan data kapan saja.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Hak Keluhan</strong> — Mengajukan keluhan terkait privasi kepada kami.</li>
                </ul>
                <div class="highlight-box green">
                    <i class="fa-solid fa-circle-check"></i>
                    Untuk menggunakan hak-hak di atas, hubungi kami di <strong>{{ $appEmail }}</strong>. Kami akan merespons dalam 7 hari kerja.
                </div>
            </div>
        </div>

        {{-- P10: Retensi Data --}}
        <div class="section" id="p10">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 10</div>
                    <div class="section-title">Retensi Data</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Data Anda akan disimpan selama:</p>
                <ul>
                    <li>Akun Anda masih dalam status aktif.</li>
                    <li>Data masih dibutuhkan untuk tujuan operasional layanan.</li>
                    <li>Diwajibkan sesuai ketentuan hukum yang berlaku di Indonesia.</li>
                </ul>
                <div class="highlight-box">
                    <i class="fa-solid fa-info-circle"></i>
                    Jika akun dihapus, seluruh data akan dihapus secara permanen dalam waktu 30 hari.
                </div>
            </div>
        </div>

        {{-- P11: Perubahan Kebijakan --}}
        <div class="section" id="p11">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-rotate"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 11</div>
                    <div class="section-title">Perubahan Kebijakan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Kami dapat memperbarui Kebijakan Privasi ini sewaktu-waktu. Perubahan akan diinformasikan melalui:</p>
                <ul>
                    <li>Notifikasi di dalam platform {{ $appName }}.</li>
                    <li>Email ke alamat yang terdaftar di akun Anda (untuk perubahan signifikan).</li>
                    <li>Pembaruan tanggal "Terakhir diperbarui" di bagian atas halaman ini.</li>
                </ul>
                <div class="highlight-box">
                    <i class="fa-solid fa-info-circle"></i>
                    Dengan terus menggunakan {{ $appName }} setelah perubahan diberlakukan, Anda dianggap menyetujui kebijakan yang diperbarui.
                </div>
            </div>
        </div>

        {{-- P12: Kontak --}}
        <div class="section" id="p12">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-envelope"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 12</div>
                    <div class="section-title">Kontak</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Jika Anda memiliki pertanyaan atau permintaan terkait Kebijakan Privasi ini, hubungi kami:</p>
                <div class="contact-card">
                    <h3>Tim Privasi {{ $appName }}</h3>
                    <p>Kami siap membantu dan akan merespons dalam 1–7 hari kerja</p>
                    <a href="mailto:{{ $appEmail }}" class="contact-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        {{ $appEmail }}
                    </a>
                </div>
            </div>
        </div>

    </div>{{-- end privacy panel --}}


    {{-- ═══════════════ TERMS & CONDITIONS PANEL ═══════════════ --}}
    <div class="tab-panel" id="panel-terms">

        {{-- TOC --}}
        <div class="toc-card">
            <div class="toc-title"><i class="fa-solid fa-list"></i> Daftar Isi — Syarat & Ketentuan</div>
            <div class="toc-list">
                @php
                $tocTerms = [
                    ['anchor' => 't1',  'label' => 'Ketentuan Umum'],
                    ['anchor' => 't2',  'label' => 'Penggunaan Layanan'],
                    ['anchor' => 't3',  'label' => 'Akun Pengguna'],
                    ['anchor' => 't4',  'label' => 'Hak dan Kewajiban'],
                    ['anchor' => 't5',  'label' => 'Batasan Tanggung Jawab'],
                    ['anchor' => 't6',  'label' => 'Larangan Penggunaan'],
                    ['anchor' => 't7',  'label' => 'Hak Kekayaan Intelektual'],
                    ['anchor' => 't8',  'label' => 'Penghentian Layanan'],
                    ['anchor' => 't9',  'label' => 'Perubahan Ketentuan'],
                    ['anchor' => 't10', 'label' => 'Hukum yang Berlaku'],
                ];
                @endphp
                @foreach($tocTerms as $i => $item)
                <a href="#{{ $item['anchor'] }}" class="toc-item" onclick="openSection('{{ $item['anchor'] }}')">
                    <div class="toc-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                    {{ $item['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- T1: Ketentuan Umum --}}
        <div class="section open" id="t1">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-file-contract"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 01</div>
                    <div class="section-title">Ketentuan Umum</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    Dengan menggunakan layanan {{ $appName }}, Anda setuju untuk terikat dengan syarat dan ketentuan ini.
                    Harap baca seluruh ketentuan dengan seksama sebelum menggunakan layanan kami.
                </p>
            </div>
        </div>

        {{-- T2: Penggunaan Layanan --}}
        <div class="section" id="t2">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-laptop"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 02</div>
                    <div class="section-title">Penggunaan Layanan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    {{ $appName }} menyediakan layanan berbasis AI untuk membantu pengelolaan keuangan pengguna,
                    termasuk pencatatan transaksi, analisis pengeluaran, dan rekomendasi finansial.
                </p>
                <div class="highlight-box">
                    <i class="fa-solid fa-info-circle"></i>
                    Layanan ini bersifat informatif dan tidak menggantikan nasihat keuangan profesional.
                </div>
            </div>
        </div>

        {{-- T3: Akun Pengguna --}}
        <div class="section" id="t3">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-user-lock"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 03</div>
                    <div class="section-title">Akun Pengguna</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Pengguna sepenuhnya bertanggung jawab atas:</p>
                <ul>
                    <li><strong style="color:rgba(255,255,255,0.8);">Keamanan Akun</strong> — Menjaga agar akun tidak diakses pihak yang tidak berwenang.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Kerahasiaan Data Login</strong> — Tidak membagikan kata sandi kepada siapapun.</li>
                    <li><strong style="color:rgba(255,255,255,0.8);">Semua Aktivitas</strong> — Seluruh aktivitas yang terjadi dalam akun Anda menjadi tanggung jawab Anda.</li>
                </ul>
            </div>
        </div>

        {{-- T4: Hak dan Kewajiban --}}
        <div class="section" id="t4">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-scale-balanced"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 04</div>
                    <div class="section-title">Hak dan Kewajiban</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Pengguna wajib:</p>
                <ul>
                    <li>Memberikan data dan informasi yang akurat saat mendaftar dan menggunakan layanan.</li>
                    <li>Tidak menyalahgunakan layanan untuk tujuan yang melanggar hukum atau merugikan pihak lain.</li>
                    <li>Mematuhi seluruh ketentuan yang berlaku dalam dokumen ini.</li>
                </ul>
            </div>
        </div>

        {{-- T5: Batasan Tanggung Jawab --}}
        <div class="section" id="t5">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 05</div>
                    <div class="section-title">Batasan Tanggung Jawab</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>{{ $appName }}:</p>
                <ul>
                    <li>Tidak menjamin hasil prediksi atau analisis keuangan 100% akurat.</li>
                    <li>Tidak bertanggung jawab atas kerugian finansial yang timbul dari keputusan pengguna berdasarkan layanan ini.</li>
                    <li>Tidak menggantikan nasihat dari konsultan atau perencana keuangan profesional.</li>
                </ul>
                <div class="highlight-box yellow">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Gunakan fitur AI sebagai alat bantu, bukan sebagai satu-satunya dasar keputusan keuangan Anda.
                </div>
            </div>
        </div>

        {{-- T6: Larangan --}}
        <div class="section" id="t6">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-ban"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 06</div>
                    <div class="section-title">Larangan Penggunaan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>Pengguna dilarang melakukan hal-hal berikut:</p>
                <ul>
                    <li>Melakukan aktivitas ilegal atau yang melanggar peraturan perundang-undangan Indonesia.</li>
                    <li>Mengganggu, merusak, atau melakukan serangan siber terhadap sistem {{ $appName }}.</li>
                    <li>Mengakses data milik pengguna lain tanpa izin yang sah.</li>
                    <li>Menyebarkan konten berbahaya, penipuan, atau menyesatkan melalui platform.</li>
                </ul>
                <div class="highlight-box red">
                    <i class="fa-solid fa-ban"></i>
                    Pelanggaran terhadap larangan ini dapat mengakibatkan penangguhan atau penghapusan akun secara permanen.
                </div>
            </div>
        </div>

        {{-- T7: HKI --}}
        <div class="section" id="t7">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-trademark"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 07</div>
                    <div class="section-title">Hak Kekayaan Intelektual</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    Seluruh konten, sistem, teknologi, nama merek, logo, dan desain yang terdapat dalam {{ $appName }}
                    merupakan milik eksklusif {{ $appName }} dan dilindungi oleh hukum kekayaan intelektual yang berlaku.
                </p>
                <p>
                    Pengguna tidak diizinkan untuk menyalin, mendistribusikan, atau menggunakan aset tersebut
                    tanpa izin tertulis dari {{ $appName }}.
                </p>
            </div>
        </div>

        {{-- T8: Penghentian Layanan --}}
        <div class="section" id="t8">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-power-off"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 08</div>
                    <div class="section-title">Penghentian Layanan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>{{ $appName }} berhak untuk:</p>
                <ul>
                    <li>Menangguhkan atau menghapus akun pengguna yang melanggar ketentuan ini.</li>
                    <li>Menghentikan atau mengubah layanan kapan saja tanpa pemberitahuan sebelumnya.</li>
                    <li>Membatasi akses ke fitur tertentu jika dianggap perlu demi keamanan platform.</li>
                </ul>
            </div>
        </div>

        {{-- T9: Perubahan Ketentuan --}}
        <div class="section" id="t9">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-rotate"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 09</div>
                    <div class="section-title">Perubahan Ketentuan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    Ketentuan ini dapat diperbarui sewaktu-waktu. Perubahan akan diinformasikan melalui platform {{ $appName }}.
                    Dengan terus menggunakan layanan setelah perubahan diberlakukan, Anda dianggap menyetujui ketentuan yang diperbarui.
                </p>
            </div>
        </div>

        {{-- T10: Hukum Berlaku --}}
        <div class="section" id="t10">
            <div class="section-header" onclick="toggleSection(this)">
                <div class="section-ico"><i class="fa-solid fa-gavel"></i></div>
                <div class="section-meta">
                    <div class="section-num">Bagian 10</div>
                    <div class="section-title">Hukum yang Berlaku</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron"></i>
            </div>
            <div class="section-body">
                <p>
                    Ketentuan ini tunduk pada dan diatur oleh hukum Republik Indonesia.
                    Setiap sengketa yang timbul akan diselesaikan melalui musyawarah mufakat,
                    dan apabila tidak tercapai kesepakatan, akan diselesaikan melalui pengadilan yang berwenang di Indonesia.
                </p>
            </div>
        </div>

    </div>{{-- end terms panel --}}

    {{-- Footer --}}
    <div class="page-footer">
        &copy; {{ date('Y') }} <span>{{ $appName }}</span> &mdash; Semua hak dilindungi.
    </div>

</div>

<script>
// Tab switcher
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + tab).classList.add('active');
    btn.classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Accordion toggle
function toggleSection(header) {
    const section = header.closest('.section');
    section.classList.toggle('open');
}

// Open section by id
function openSection(id) {
    const el = document.getElementById(id);
    if (el && !el.classList.contains('open')) {
        el.classList.add('open');
    }
}

// Reading progress bar
window.addEventListener('scroll', function () {
    const doc    = document.documentElement;
    const scroll = doc.scrollTop || document.body.scrollTop;
    const height = doc.scrollHeight - doc.clientHeight;
    const pct    = height > 0 ? (scroll / height) * 100 : 0;
    document.getElementById('readingBar').style.width = pct + '%';
});

// Smooth scroll for TOC
document.querySelectorAll('.toc-item').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (!target) return;
        if (!target.classList.contains('open')) {
            target.classList.add('open');
        }
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>

</body>
</html>