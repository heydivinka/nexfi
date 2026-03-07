<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi | {{ $appName }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
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
            font-family: 'Plus Jakarta Sans', sans-serif;
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
            font-family: 'Syne', sans-serif;
            font-size: clamp(22px, 5vw, 32px);
            font-weight: 800; color: #fff;
            letter-spacing: -0.5px;
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
            font-size: 14px; font-weight: 800; color: rgba(255,255,255,0.88);
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
        .contact-card h3 { font-size: 15px; font-weight: 800; color: #fff; margin-bottom: 6px; }
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
        <h1>Kebijakan Privasi</h1>
        <p>
            Kami berkomitmen menjaga kepercayaan Anda. Pelajari bagaimana kami mengumpulkan,
            menggunakan, dan melindungi data pribadi Anda di {{ $appName }}.
        </p>
        <div class="hero-badge">
            <i class="fa-solid fa-clock" style="font-size:10px;"></i>
            Terakhir diperbarui: {{ $lastUpdated }}
        </div>
    </div>

    {{-- Table of Contents --}}
    <div class="toc-card">
        <div class="toc-title"><i class="fa-solid fa-list"></i> Daftar Isi</div>
        <div class="toc-list">
            @php
            $toc = [
                ['anchor' => 'sec-1', 'label' => 'Informasi yang Kami Kumpulkan'],
                ['anchor' => 'sec-2', 'label' => 'Cara Kami Menggunakan Data'],
                ['anchor' => 'sec-3', 'label' => 'Penyimpanan & Keamanan Data'],
                ['anchor' => 'sec-4', 'label' => 'Berbagi Data dengan Pihak Ketiga'],
                ['anchor' => 'sec-5', 'label' => 'Hak-Hak Pengguna'],
                ['anchor' => 'sec-6', 'label' => 'Cookie & Teknologi Pelacak'],
                ['anchor' => 'sec-7', 'label' => 'Kebijakan Anak-Anak'],
                ['anchor' => 'sec-8', 'label' => 'Perubahan Kebijakan'],
                ['anchor' => 'sec-9', 'label' => 'Hubungi Kami'],
            ];
            @endphp
            @foreach($toc as $i => $item)
            <a href="#{{ $item['anchor'] }}" class="toc-item">
                <div class="toc-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- SECTION 1 --}}
    <div class="section open" id="sec-1">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-database"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 01</div>
                <div class="section-title">Informasi yang Kami Kumpulkan</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>Untuk memberikan layanan keuangan terbaik, {{ $appName }} mengumpulkan beberapa jenis informasi berikut:</p>
            <ul>
                <li><strong style="color:rgba(255,255,255,0.8);">Data Identitas</strong> — Nama lengkap, username, alamat email, dan nomor telepon yang Anda daftarkan.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Data Keuangan</strong> — Catatan transaksi pemasukan dan pengeluaran, saldo, serta kategori keuangan yang Anda buat.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Data Teknis</strong> — Alamat IP, jenis perangkat, browser, dan waktu akses untuk keperluan keamanan.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Data Foto</strong> — Foto profil dan bukti transaksi yang Anda unggah secara sukarela.</li>
            </ul>
            <div class="highlight-box green">
                <i class="fa-solid fa-circle-check"></i>
                Kami hanya mengumpulkan data yang benar-benar diperlukan untuk menjalankan layanan. Kami tidak meminta data yang tidak relevan.
            </div>
        </div>
    </div>

    {{-- SECTION 2 --}}
    <div class="section" id="sec-2">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-gear"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 02</div>
                <div class="section-title">Cara Kami Menggunakan Data</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>Data yang kami kumpulkan digunakan semata-mata untuk tujuan berikut:</p>
            <ol>
                <li>Menyediakan, mengoperasikan, dan meningkatkan layanan pencatatan keuangan {{ $appName }}.</li>
                <li>Memverifikasi identitas dan menjaga keamanan akun Anda.</li>
                <li>Mengirimkan notifikasi penting terkait akun, seperti perubahan keamanan.</li>
                <li>Menganalisis tren penggunaan secara anonim untuk meningkatkan performa aplikasi.</li>
                <li>Memenuhi kewajiban hukum yang berlaku di Indonesia.</li>
            </ol>
            <div class="highlight-box red">
                <i class="fa-solid fa-ban"></i>
                Kami tidak menggunakan data Anda untuk keperluan iklan, profiling komersial, atau menjualnya kepada pihak manapun.
            </div>
        </div>
    </div>

    {{-- SECTION 3 --}}
    <div class="section" id="sec-3">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-shield-halved"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 03</div>
                <div class="section-title">Penyimpanan & Keamanan Data</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>Keamanan data Anda adalah prioritas utama kami. Berikut langkah-langkah yang kami terapkan:</p>
            <ul>
                <li>Kata sandi disimpan menggunakan enkripsi <strong style="color:rgba(255,255,255,0.8);">bcrypt</strong> — tidak dapat dibaca bahkan oleh tim kami.</li>
                <li>Seluruh komunikasi antara aplikasi dan server menggunakan protokol <strong style="color:rgba(255,255,255,0.8);">HTTPS/TLS</strong>.</li>
                <li>Data disimpan di server yang berlokasi di wilayah dengan standar keamanan tinggi.</li>
                <li>Akses ke database dibatasi hanya untuk personel teknis yang berwenang.</li>
                <li>Pemantauan keamanan dilakukan secara berkala untuk mendeteksi ancaman.</li>
            </ul>
            <div class="highlight-box">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Data akun aktif disimpan selama akun Anda masih aktif. Jika akun dihapus, data akan dihapus permanen dalam waktu 30 hari.
            </div>
        </div>
    </div>

    {{-- SECTION 4 --}}
    <div class="section" id="sec-4">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-share-nodes"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 04</div>
                <div class="section-title">Berbagi Data dengan Pihak Ketiga</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>{{ $appName }} berkomitmen untuk tidak menjual atau menyewakan data pribadi Anda. Data Anda hanya dapat dibagikan dalam kondisi terbatas berikut:</p>
            <ul>
                <li><strong style="color:rgba(255,255,255,0.8);">Penyedia Layanan</strong> — Mitra teknis seperti penyedia server dan layanan email yang membantu operasional, terikat perjanjian kerahasiaan.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Kewajiban Hukum</strong> — Jika diwajibkan oleh peraturan perundang-undangan Indonesia atau perintah pengadilan yang sah.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Persetujuan Anda</strong> — Jika Anda secara eksplisit memberikan izin untuk berbagi data tertentu.</li>
            </ul>
            <div class="highlight-box red">
                <i class="fa-solid fa-ban"></i>
                Data Anda tidak pernah dan tidak akan pernah dijual kepada pengiklan, broker data, atau pihak ketiga manapun untuk kepentingan komersial.
            </div>
        </div>
    </div>

    {{-- SECTION 5 --}}
    <div class="section" id="sec-5">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-user-shield"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 05</div>
                <div class="section-title">Hak-Hak Pengguna</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>Sesuai dengan prinsip perlindungan data, Anda memiliki hak-hak berikut terhadap data pribadi Anda:</p>
            <ul>
                <li><strong style="color:rgba(255,255,255,0.8);">Hak Akses</strong> — Melihat seluruh data pribadi yang kami simpan tentang Anda melalui halaman profil.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Hak Koreksi</strong> — Memperbarui atau memperbaiki data yang tidak akurat kapan saja melalui pengaturan akun.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Hak Penghapusan</strong> — Meminta penghapusan akun dan seluruh data terkait secara permanen.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Hak Portabilitas</strong> — Mengekspor data transaksi Anda dalam format yang dapat dibaca (PDF/Excel).</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Hak Keberatan</strong> — Mengajukan keberatan atas pemrosesan data tertentu.</li>
            </ul>
            <div class="highlight-box green">
                <i class="fa-solid fa-circle-check"></i>
                Untuk menggunakan hak-hak di atas, hubungi kami di <strong>{{ $appEmail }}</strong>. Kami akan merespons dalam 7 hari kerja.
            </div>
        </div>
    </div>

    {{-- SECTION 6 --}}
    <div class="section" id="sec-6">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-cookie-bite"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 06</div>
                <div class="section-title">Cookie & Teknologi Pelacak</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>{{ $appName }} menggunakan cookie dan teknologi serupa yang bersifat fungsional:</p>
            <ul>
                <li><strong style="color:rgba(255,255,255,0.8);">Cookie Sesi</strong> — Menjaga status login Anda agar tidak perlu masuk ulang setiap saat. Dihapus otomatis saat browser ditutup.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Cookie CSRF</strong> — Melindungi akun Anda dari serangan Cross-Site Request Forgery.</li>
                <li><strong style="color:rgba(255,255,255,0.8);">Cookie Preferensi</strong> — Menyimpan pengaturan tampilan atau pilihan bahasa Anda.</li>
            </ul>
            <div class="highlight-box">
                <i class="fa-solid fa-info-circle"></i>
                Kami tidak menggunakan cookie pelacak pihak ketiga atau cookie iklan. Anda dapat mengatur cookie melalui pengaturan browser Anda.
            </div>
        </div>
    </div>

    {{-- SECTION 7 --}}
    <div class="section" id="sec-7">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-child"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 07</div>
                <div class="section-title">Kebijakan Anak-Anak</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>
                Layanan {{ $appName }} ditujukan untuk pengguna berusia <strong style="color:rgba(255,255,255,0.8);">17 tahun ke atas</strong>.
                Kami tidak secara sadar mengumpulkan data pribadi dari anak-anak di bawah usia tersebut.
            </p>
            <p>
                Jika Anda adalah orang tua atau wali dan mengetahui bahwa anak Anda telah memberikan data pribadi
                kepada kami tanpa izin Anda, segera hubungi kami di <strong style="color:#a78bfa;">{{ $appEmail }}</strong>.
                Kami akan segera menghapus data tersebut.
            </p>
        </div>
    </div>

    {{-- SECTION 8 --}}
    <div class="section" id="sec-8">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-rotate"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 08</div>
                <div class="section-title">Perubahan Kebijakan</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>
                Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu untuk mencerminkan perubahan
                layanan atau peraturan yang berlaku. Setiap perubahan yang signifikan akan kami komunikasikan
                melalui:
            </p>
            <ul>
                <li>Notifikasi di dalam aplikasi saat Anda login berikutnya.</li>
                <li>Email ke alamat yang terdaftar di akun Anda.</li>
                <li>Pembaruan tanggal "Terakhir diperbarui" di bagian atas halaman ini.</li>
            </ul>
            <div class="highlight-box">
                <i class="fa-solid fa-info-circle"></i>
                Dengan terus menggunakan {{ $appName }} setelah perubahan diberlakukan, Anda dianggap menyetujui kebijakan yang diperbarui.
            </div>
        </div>
    </div>

    {{-- SECTION 9: Hubungi Kami --}}
    <div class="section" id="sec-9">
        <div class="section-header" onclick="toggleSection(this)">
            <div class="section-ico"><i class="fa-solid fa-envelope"></i></div>
            <div class="section-meta">
                <div class="section-num">Bagian 09</div>
                <div class="section-title">Hubungi Kami</div>
            </div>
            <i class="fa-solid fa-chevron-down section-chevron"></i>
        </div>
        <div class="section-body">
            <p>
                Jika Anda memiliki pertanyaan, kekhawatiran, atau permintaan terkait Kebijakan Privasi ini
                atau data pribadi Anda, jangan ragu untuk menghubungi tim kami:
            </p>
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

    {{-- Footer --}}
    <div class="page-footer">
        &copy; {{ date('Y') }} <span>{{ $appName }}</span> &mdash; Semua hak dilindungi. Platform Keuangan #1 Indonesia.
    </div>

</div>

<script>
// Accordion toggle
function toggleSection(header) {
    const section = header.closest('.section');
    section.classList.toggle('open');
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
        // Open the section if closed
        if (!target.classList.contains('open')) {
            target.classList.add('open');
        }
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>

</body>
</html>