<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi & Syarat Ketentuan | {{ $appName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        playfair: ['"Playfair Display"', 'serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        bg:     '#07080f',
                        bg2:    '#0c0d1d',
                        bg3:    '#10132a',
                        bg4:    '#13163a',
                        acc:    '#6c63ff',
                        acc2:   '#9b59f5',
                    },
                    keyframes: {
                        shimmer: {
                            '0%':   { backgroundPosition: '200% 0' },
                            '100%': { backgroundPosition: '-200% 0' },
                        },
                        fadeIn: {
                            from: { opacity: '0', transform: 'translateY(-4px)' },
                            to:   { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                    animation: {
                        shimmer: 'shimmer 3s linear infinite',
                        fadeIn:  'fadeIn 0.2s ease',
                    },
                },
            },
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        /* Reading bar */
        #readingBar {
            position: fixed; top: 0; left: 0; height: 2px; z-index: 100;
            background: linear-gradient(90deg, #6c63ff, #9b59f5);
            width: 0%; transition: width 0.1s linear;
        }

        /* BG grid */
        .bg-grid {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image:
                linear-gradient(rgba(108,99,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Hero shimmer bar */
        .hero-shimmer::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #6c63ff, #9b59f5, #6c63ff);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

        /* Section body animation */
        .section-body { animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(-4px)} to{opacity:1;transform:translateY(0)} }

        /* Accordion chevron */
        .section.open .section-chevron { transform: rotate(180deg); }

        /* Custom list bullets */
        .custom-ul li { display: flex; align-items: flex-start; gap: 8px; font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.7; }
        .custom-ul li::before {
            content: ''; width: 5px; height: 5px; border-radius: 50%;
            background: rgba(108,99,255,0.6); flex-shrink: 0; margin-top: 8px;
        }
        .custom-ol { counter-reset: ol-counter; }
        .custom-ol li { counter-increment: ol-counter; display: flex; align-items: flex-start; gap: 8px; font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.7; }
        .custom-ol li::before {
            content: counter(ol-counter);
            width: 20px; height: 20px; border-radius: 5px; flex-shrink: 0;
            background: rgba(108,99,255,0.1); border: 1px solid rgba(108,99,255,0.2);
            font-size: 9px; font-weight: 800; color: #a78bfa;
            display: flex; align-items: center; justify-content: center; margin-top: 2px;
        }

        /* Mobile: reset deep padding on section body */
        @media (max-width: 480px) {
            .section-body-inner { padding-left: 0 !important; }
            .tab-btn { font-size: 11px; padding: 8px 8px; }
            .tab-btn i { display: none; }
        }

        /* Contact card radial */
        .contact-card::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at center top, rgba(108,99,255,0.08) 0%, transparent 60%);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-bg text-white/80 min-h-screen overflow-x-hidden leading-relaxed">

<div id="readingBar"></div>
<div class="bg-grid"></div>

{{-- BG Orbs --}}
<div class="fixed w-[600px] h-[600px] rounded-full -top-64 -left-48 pointer-events-none z-0"
     style="background: radial-gradient(circle, rgba(108,99,255,0.13) 0%, transparent 70%)"></div>
<div class="fixed w-[500px] h-[500px] rounded-full -bottom-48 -right-36 pointer-events-none z-0"
     style="background: radial-gradient(circle, rgba(155,89,245,0.1) 0%, transparent 70%)"></div>

<div class="relative z-10 max-w-3xl mx-auto px-3 sm:px-5 pt-8 sm:pt-10 pb-20">

    {{-- Back Button --}}
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg mb-8 text-xs font-semibold
              bg-white/[0.04] border border-acc/20 text-white/40
              hover:bg-acc/10 hover:text-violet-400 hover:border-acc/35 transition-all duration-200">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>

    {{-- Hero --}}
    <div class="hero-shimmer relative text-center px-4 sm:px-6 pt-8 sm:pt-12 pb-8 sm:pb-10 bg-bg3 border border-acc/[0.14] rounded-2xl mb-7 overflow-hidden">
        <div class="w-16 h-16 rounded-[18px] mx-auto mb-5 flex items-center justify-center text-[26px]
                    bg-gradient-to-br from-acc/20 to-acc2/20 border border-acc/30">🔐</div>
        <h1 class="font-playfair text-[clamp(22px,5vw,34px)] font-extrabold text-white tracking-tight mb-2.5">
            Kebijakan & Ketentuan
        </h1>
        <p class="text-[13px] text-white/30 max-w-sm mx-auto leading-relaxed mb-4">
            Kami berkomitmen menjaga kepercayaan Anda. Pelajari kebijakan privasi
            dan syarat penggunaan layanan {{ $appName }}.
        </p>
        <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full
                    bg-acc/10 border border-acc/20 text-[11px] font-bold text-violet-400">
            <i class="fa-solid fa-clock text-[10px]"></i>
            Terakhir diperbarui: 1 April 2026
        </div>
    </div>

    {{-- Tab Bar --}}
    <div class="flex gap-2 bg-bg3 border border-acc/[0.14] rounded-2xl p-1.5 mb-7">
        <button onclick="switchTab('privacy', this)"
                class="tab-btn flex-1 min-w-0 px-2 sm:px-4 py-2.5 rounded-xl text-[11px] sm:text-[13px] font-bold transition-all duration-200
                       bg-gradient-to-br from-acc/25 to-acc2/15 border border-acc/30 text-violet-400"
                data-active="true">
            <i class="fa-solid fa-shield-halved mr-1 text-[11px]"></i> Kebijakan Privasi
        </button>
        <button onclick="switchTab('terms', this)"
                class="tab-btn flex-1 min-w-0 px-2 sm:px-4 py-2.5 rounded-xl text-[11px] sm:text-[13px] font-bold transition-all duration-200
                       text-white/35 hover:text-white/60 hover:bg-white/[0.03]">
            <i class="fa-solid fa-file-contract mr-1 text-[11px]"></i> Syarat & Ketentuan
        </button>
    </div>

    {{-- ══════════ PRIVACY PANEL ══════════ --}}
    <div class="tab-panel" id="panel-privacy">

        {{-- TOC --}}
        <div class="bg-bg3 border border-acc/[0.14] rounded-2xl px-6 py-5 mb-7">
            <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-white/25 mb-3.5">
                <i class="fa-solid fa-list text-acc/50"></i> Daftar Isi — Kebijakan Privasi
            </div>
            <div class="flex flex-col gap-1">
                @php
                $tocPrivacy = [
                    ['anchor'=>'p1','label'=>'Pendahuluan'],['anchor'=>'p2','label'=>'Definisi'],
                    ['anchor'=>'p3','label'=>'Ruang Lingkup'],['anchor'=>'p4','label'=>'Informasi yang Dikumpulkan'],
                    ['anchor'=>'p5','label'=>'Cara Penggunaan Data'],['anchor'=>'p6','label'=>'Penyimpanan dan Keamanan Data'],
                    ['anchor'=>'p7','label'=>'Pengungkapan kepada Pihak Ketiga'],['anchor'=>'p8','label'=>'Cookies dan Teknologi Serupa'],
                    ['anchor'=>'p9','label'=>'Hak Pengguna'],['anchor'=>'p10','label'=>'Retensi Data'],
                    ['anchor'=>'p11','label'=>'Perubahan Kebijakan'],['anchor'=>'p12','label'=>'Kontak'],
                ];
                @endphp
                @foreach($tocPrivacy as $i => $item)
                <a href="#{{ $item['anchor'] }}" onclick="openSection('{{ $item['anchor'] }}')"
                   class="flex items-center gap-2.5 px-2.5 py-2 rounded-[9px] no-underline
                          text-white/45 text-[12.5px] font-semibold
                          hover:bg-acc/10 hover:text-violet-400 transition-all duration-150">
                    <div class="w-[22px] h-[22px] rounded-[6px] flex-shrink-0 flex items-center justify-center
                                text-[9px] font-extrabold bg-acc/10 border border-acc/20 text-acc/80">
                        {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                    {{ $item['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- P1 --}}
        <div class="section open bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p1">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-house"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 01</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Pendahuluan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">
                    {{ $appName }} ("Kami") berkomitmen untuk melindungi dan menjaga kerahasiaan data pribadi pengguna ("Anda").
                    Dengan menggunakan layanan {{ $appName }}, Anda dianggap telah membaca, memahami, dan menyetujui Kebijakan Privasi ini.
                </p>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed my-3.5
                            bg-green-500/[0.06] border border-green-500/[0.18] text-green-400/80">
                    <i class="fa-solid fa-circle-check mr-1.5"></i>
                    Privasi Anda adalah prioritas kami. Kami hanya menggunakan data untuk meningkatkan layanan kepada Anda.
                </div>
            </div>
        </div>

        {{-- P2 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p2">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 02</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Definisi</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <ul class="custom-ul flex flex-col gap-2">
                    <li><strong class="text-white/80">Layanan</strong> — Website {{ $appName }} beserta seluruh fitur di dalamnya.</li>
                    <li><strong class="text-white/80">Data Pribadi</strong> — Informasi yang dapat mengidentifikasi individu secara langsung atau tidak langsung.</li>
                    <li><strong class="text-white/80">Pengguna</strong> — Individu yang mengakses atau menggunakan {{ $appName }}.</li>
                    <li><strong class="text-white/80">Data Penggunaan</strong> — Data yang dikumpulkan secara otomatis saat menggunakan layanan.</li>
                </ul>
            </div>
        </div>

        {{-- P3 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p3">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 03</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Ruang Lingkup</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed">
                    Kebijakan ini berlaku untuk seluruh layanan {{ $appName }}, baik melalui website maupun fitur berbasis AI yang disediakan oleh platform kami.
                </p>
            </div>
        </div>

        {{-- P4 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p4">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-database"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 04</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Informasi yang Dikumpulkan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Kami dapat mengumpulkan jenis informasi berikut:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li><strong class="text-white/80">Informasi Akun</strong> — Nama lengkap dan alamat email yang Anda daftarkan.</li>
                    <li><strong class="text-white/80">Data Keuangan</strong> — Catatan pemasukan, pengeluaran, dan catatan finansial yang Anda input.</li>
                    <li><strong class="text-white/80">Data Interaksi AI</strong> — Riwayat percakapan dengan fitur AI untuk meningkatkan akurasi layanan.</li>
                    <li><strong class="text-white/80">Data Teknis</strong> — Alamat IP, jenis perangkat, dan log aktivitas untuk keperluan keamanan.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-green-500/[0.06] border border-green-500/[0.18] text-green-400/80">
                    <i class="fa-solid fa-circle-check mr-1.5"></i>
                    Kami hanya mengumpulkan data yang benar-benar diperlukan. Tidak ada data yang dikumpulkan tanpa tujuan yang jelas.
                </div>
            </div>
        </div>

        {{-- P5 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p5">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-gear"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 05</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Cara Penggunaan Data</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Data yang kami kumpulkan digunakan untuk:</p>
                <ol class="custom-ol flex flex-col gap-2 mb-3.5">
                    <li>Menyediakan layanan {{ $appName }} secara optimal.</li>
                    <li>Memberikan analisis dan prediksi keuangan yang akurat.</li>
                    <li>Meningkatkan performa dan kecerdasan fitur AI.</li>
                    <li>Menjaga keamanan akun dan mencegah penyalahgunaan layanan.</li>
                    <li>Memenuhi kewajiban hukum yang berlaku di Indonesia.</li>
                </ol>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-red-500/[0.06] border border-red-500/[0.18] text-red-400/80">
                    <i class="fa-solid fa-ban mr-1.5"></i>
                    Kami tidak menggunakan data Anda untuk keperluan iklan, profiling komersial, atau menjualnya kepada pihak manapun.
                </div>
            </div>
        </div>

        {{-- P6 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p6">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 06</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Penyimpanan dan Keamanan Data</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Kami menerapkan langkah-langkah keamanan industri untuk melindungi data Anda:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li><strong class="text-white/80">Enkripsi Data</strong> — Kata sandi dienkripsi dengan bcrypt dan komunikasi menggunakan HTTPS/TLS.</li>
                    <li><strong class="text-white/80">Pembatasan Akses</strong> — Hanya personel teknis berwenang yang dapat mengakses sistem database.</li>
                    <li><strong class="text-white/80">Sistem Keamanan Terkini</strong> — Pemantauan dan audit keamanan dilakukan secara berkala.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-yellow-500/[0.06] border border-yellow-500/[0.18] text-yellow-400/80">
                    <i class="fa-solid fa-triangle-exclamation mr-1.5"></i>
                    Tidak ada sistem yang 100% aman. Pengguna juga bertanggung jawab menjaga keamanan akun masing-masing, termasuk kerahasiaan kata sandi.
                </div>
            </div>
        </div>

        {{-- P7 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p7">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 07</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Pengungkapan kepada Pihak Ketiga</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Kami tidak menjual data pengguna. Namun, data dapat dibagikan dalam kondisi berikut:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li><strong class="text-white/80">Kewajiban Hukum</strong> — Jika diwajibkan oleh peraturan perundang-undangan Indonesia atau perintah pengadilan yang sah.</li>
                    <li><strong class="text-white/80">Mitra Layanan</strong> — Penyedia hosting dan analytics yang membantu operasional, terikat perjanjian kerahasiaan.</li>
                    <li><strong class="text-white/80">Persetujuan Pengguna</strong> — Jika Anda secara eksplisit memberikan izin untuk berbagi data tertentu.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-red-500/[0.06] border border-red-500/[0.18] text-red-400/80">
                    <i class="fa-solid fa-ban mr-1.5"></i>
                    Data Anda tidak pernah dan tidak akan pernah dijual kepada pengiklan, broker data, atau pihak ketiga manapun.
                </div>
            </div>
        </div>

        {{-- P8 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p8">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 08</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Cookies dan Teknologi Serupa</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">{{ $appName }} menggunakan cookies untuk keperluan berikut:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li><strong class="text-white/80">Preferensi Pengguna</strong> — Menyimpan pengaturan tampilan dan pilihan bahasa Anda.</li>
                    <li><strong class="text-white/80">Pengalaman Pengguna</strong> — Menjaga sesi login agar tidak perlu masuk ulang setiap saat.</li>
                    <li><strong class="text-white/80">Analisis Penggunaan</strong> — Memahami cara pengguna berinteraksi dengan layanan untuk terus kami tingkatkan.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-acc/[0.07] border border-acc/[0.18] text-white/55">
                    <i class="fa-solid fa-info-circle mr-1.5"></i>
                    Kami tidak menggunakan cookie pelacak pihak ketiga atau cookie iklan. Anda dapat mengatur cookie melalui pengaturan browser Anda.
                </div>
            </div>
        </div>

        {{-- P9 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p9">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 09</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Hak Pengguna</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Anda memiliki hak-hak berikut terhadap data pribadi Anda:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li><strong class="text-white/80">Hak Akses</strong> — Mengakses dan melihat seluruh data pribadi yang kami simpan.</li>
                    <li><strong class="text-white/80">Hak Koreksi</strong> — Memperbaiki atau memperbarui data yang tidak akurat.</li>
                    <li><strong class="text-white/80">Hak Penghapusan</strong> — Meminta penghapusan akun dan seluruh data terkait secara permanen.</li>
                    <li><strong class="text-white/80">Hak Penarikan Persetujuan</strong> — Menarik izin penggunaan data kapan saja.</li>
                    <li><strong class="text-white/80">Hak Keluhan</strong> — Mengajukan keluhan terkait privasi kepada kami.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-green-500/[0.06] border border-green-500/[0.18] text-green-400/80">
                    <i class="fa-solid fa-circle-check mr-1.5"></i>
                    Untuk menggunakan hak-hak di atas, hubungi kami di <strong>{{ $appEmail }}</strong>. Kami akan merespons dalam 7 hari kerja.
                </div>
            </div>
        </div>

        {{-- P10 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p10">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 10</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Retensi Data</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Data Anda akan disimpan selama:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li>Akun Anda masih dalam status aktif.</li>
                    <li>Data masih dibutuhkan untuk tujuan operasional layanan.</li>
                    <li>Diwajibkan sesuai ketentuan hukum yang berlaku di Indonesia.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-acc/[0.07] border border-acc/[0.18] text-white/55">
                    <i class="fa-solid fa-info-circle mr-1.5"></i>
                    Jika akun dihapus, seluruh data akan dihapus secara permanen dalam waktu 30 hari.
                </div>
            </div>
        </div>

        {{-- P11 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p11">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-rotate"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 11</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Perubahan Kebijakan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Kami dapat memperbarui Kebijakan Privasi ini sewaktu-waktu. Perubahan akan diinformasikan melalui:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li>Notifikasi di dalam platform {{ $appName }}.</li>
                    <li>Email ke alamat yang terdaftar di akun Anda (untuk perubahan signifikan).</li>
                    <li>Pembaruan tanggal "Terakhir diperbarui" di bagian atas halaman ini.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-acc/[0.07] border border-acc/[0.18] text-white/55">
                    <i class="fa-solid fa-info-circle mr-1.5"></i>
                    Dengan terus menggunakan {{ $appName }} setelah perubahan diberlakukan, Anda dianggap menyetujui kebijakan yang diperbarui.
                </div>
            </div>
        </div>

        {{-- P12 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="p12">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 12</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Kontak</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Jika Anda memiliki pertanyaan atau permintaan terkait Kebijakan Privasi ini, hubungi kami:</p>
                <div class="contact-card relative bg-bg3 border border-acc/20 rounded-2xl p-6 mt-3.5 text-center overflow-hidden">
                    <h3 class="font-playfair text-base font-bold text-white mb-1.5">Tim Privasi {{ $appName }}</h3>
                    <p class="text-[12.5px] text-white/30 mb-4">Kami siap membantu dan akan merespons dalam 1–7 hari kerja</p>
                    <a href="/cdn-cgi/l/email-protection#d1aaaaf1f5b0a1a194bcb0b8bdf1acac" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-[11px] text-[13px] font-bold text-white no-underline
                              bg-gradient-to-br from-acc to-acc2 shadow-[0_6px_20px_rgba(108,99,255,0.3)]
                              hover:opacity-90 transition-opacity duration-200">
                        <i class="fa-solid fa-paper-plane"></i>
                        {{ $appEmail }}
                    </a>
                </div>
            </div>
        </div>

    </div>{{-- end privacy panel --}}


    {{-- ══════════ TERMS PANEL ══════════ --}}
    <div class="tab-panel hidden" id="panel-terms">

        {{-- TOC --}}
        <div class="bg-bg3 border border-acc/[0.14] rounded-2xl px-6 py-5 mb-7">
            <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-white/25 mb-3.5">
                <i class="fa-solid fa-list text-acc/50"></i> Daftar Isi — Syarat & Ketentuan
            </div>
            <div class="flex flex-col gap-1">
                @php
                $tocTerms = [
                    ['anchor'=>'t1','label'=>'Ketentuan Umum'],['anchor'=>'t2','label'=>'Penggunaan Layanan'],
                    ['anchor'=>'t3','label'=>'Akun Pengguna'],['anchor'=>'t4','label'=>'Hak dan Kewajiban'],
                    ['anchor'=>'t5','label'=>'Batasan Tanggung Jawab'],['anchor'=>'t6','label'=>'Larangan Penggunaan'],
                    ['anchor'=>'t7','label'=>'Hak Kekayaan Intelektual'],['anchor'=>'t8','label'=>'Penghentian Layanan'],
                    ['anchor'=>'t9','label'=>'Perubahan Ketentuan'],['anchor'=>'t10','label'=>'Hukum yang Berlaku'],
                ];
                @endphp
                @foreach($tocTerms as $i => $item)
                <a href="#{{ $item['anchor'] }}" onclick="openSection('{{ $item['anchor'] }}')"
                   class="flex items-center gap-2.5 px-2.5 py-2 rounded-[9px] no-underline
                          text-white/45 text-[12.5px] font-semibold
                          hover:bg-acc/10 hover:text-violet-400 transition-all duration-150">
                    <div class="w-[22px] h-[22px] rounded-[6px] flex-shrink-0 flex items-center justify-center
                                text-[9px] font-extrabold bg-acc/10 border border-acc/20 text-acc/80">
                        {{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                    {{ $item['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- T1 --}}
        <div class="section open bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t1">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 01</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Ketentuan Umum</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed">
                    Dengan menggunakan layanan {{ $appName }}, Anda setuju untuk terikat dengan syarat dan ketentuan ini.
                    Harap baca seluruh ketentuan dengan seksama sebelum menggunakan layanan kami.
                </p>
            </div>
        </div>

        {{-- T2 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t2">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-laptop"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 02</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Penggunaan Layanan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">
                    {{ $appName }} menyediakan layanan berbasis AI untuk membantu pengelolaan keuangan pengguna,
                    termasuk pencatatan transaksi, analisis pengeluaran, dan rekomendasi finansial.
                </p>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-acc/[0.07] border border-acc/[0.18] text-white/55">
                    <i class="fa-solid fa-info-circle mr-1.5"></i>
                    Layanan ini bersifat informatif dan tidak menggantikan nasihat keuangan profesional.
                </div>
            </div>
        </div>

        {{-- T3 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t3">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-user-lock"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 03</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Akun Pengguna</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Pengguna sepenuhnya bertanggung jawab atas:</p>
                <ul class="custom-ul flex flex-col gap-2">
                    <li><strong class="text-white/80">Keamanan Akun</strong> — Menjaga agar akun tidak diakses pihak yang tidak berwenang.</li>
                    <li><strong class="text-white/80">Kerahasiaan Data Login</strong> — Tidak membagikan kata sandi kepada siapapun.</li>
                    <li><strong class="text-white/80">Semua Aktivitas</strong> — Seluruh aktivitas yang terjadi dalam akun Anda menjadi tanggung jawab Anda.</li>
                </ul>
            </div>
        </div>

        {{-- T4 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t4">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 04</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Hak dan Kewajiban</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Pengguna wajib:</p>
                <ul class="custom-ul flex flex-col gap-2">
                    <li>Memberikan data dan informasi yang akurat saat mendaftar dan menggunakan layanan.</li>
                    <li>Tidak menyalahgunakan layanan untuk tujuan yang melanggar hukum atau merugikan pihak lain.</li>
                    <li>Mematuhi seluruh ketentuan yang berlaku dalam dokumen ini.</li>
                </ul>
            </div>
        </div>

        {{-- T5 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t5">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 05</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Batasan Tanggung Jawab</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">{{ $appName }}:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li>Tidak menjamin hasil prediksi atau analisis keuangan 100% akurat.</li>
                    <li>Tidak bertanggung jawab atas kerugian finansial yang timbul dari keputusan pengguna berdasarkan layanan ini.</li>
                    <li>Tidak menggantikan nasihat dari konsultan atau perencana keuangan profesional.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-yellow-500/[0.06] border border-yellow-500/[0.18] text-yellow-400/80">
                    <i class="fa-solid fa-triangle-exclamation mr-1.5"></i>
                    Gunakan fitur AI sebagai alat bantu, bukan sebagai satu-satunya dasar keputusan keuangan Anda.
                </div>
            </div>
        </div>

        {{-- T6 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t6">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 06</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Larangan Penggunaan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">Pengguna dilarang melakukan hal-hal berikut:</p>
                <ul class="custom-ul flex flex-col gap-2 mb-3.5">
                    <li>Melakukan aktivitas ilegal atau yang melanggar peraturan perundang-undangan Indonesia.</li>
                    <li>Mengganggu, merusak, atau melakukan serangan siber terhadap sistem {{ $appName }}.</li>
                    <li>Mengakses data milik pengguna lain tanpa izin yang sah.</li>
                    <li>Menyebarkan konten berbahaya, penipuan, atau menyesatkan melalui platform.</li>
                </ul>
                <div class="px-4 py-3.5 rounded-[11px] text-[12.5px] leading-relaxed
                            bg-red-500/[0.06] border border-red-500/[0.18] text-red-400/80">
                    <i class="fa-solid fa-ban mr-1.5"></i>
                    Pelanggaran terhadap larangan ini dapat mengakibatkan penangguhan atau penghapusan akun secara permanen.
                </div>
            </div>
        </div>

        {{-- T7 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t7">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-trademark"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 07</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Hak Kekayaan Intelektual</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">
                    Seluruh konten, sistem, teknologi, nama merek, logo, dan desain yang terdapat dalam {{ $appName }}
                    merupakan milik eksklusif {{ $appName }} dan dilindungi oleh hukum kekayaan intelektual yang berlaku.
                </p>
                <p class="text-[13px] text-white/60 leading-relaxed">
                    Pengguna tidak diizinkan untuk menyalin, mendistribusikan, atau menggunakan aset tersebut
                    tanpa izin tertulis dari {{ $appName }}.
                </p>
            </div>
        </div>

        {{-- T8 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t8">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-power-off"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 08</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Penghentian Layanan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed mb-3">{{ $appName }} berhak untuk:</p>
                <ul class="custom-ul flex flex-col gap-2">
                    <li>Menangguhkan atau menghapus akun pengguna yang melanggar ketentuan ini.</li>
                    <li>Menghentikan atau mengubah layanan kapan saja tanpa pemberitahuan sebelumnya.</li>
                    <li>Membatasi akses ke fitur tertentu jika dianggap perlu demi keamanan platform.</li>
                </ul>
            </div>
        </div>

        {{-- T9 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t9">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-rotate"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 09</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Perubahan Ketentuan</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed">
                    Ketentuan ini dapat diperbarui sewaktu-waktu. Perubahan akan diinformasikan melalui platform {{ $appName }}.
                    Dengan terus menggunakan layanan setelah perubahan diberlakukan, Anda dianggap menyetujui ketentuan yang diperbarui.
                </p>
            </div>
        </div>

        {{-- T10 --}}
        <div class="section bg-bg3 border border-acc/[0.14] rounded-2xl mb-3.5 overflow-hidden hover:border-acc/25 transition-colors" id="t10">
            <div class="section-header flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-3 sm:py-4 cursor-pointer select-none" onclick="toggleSection(this)">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-xs sm:text-sm text-violet-400 bg-acc/10 border border-acc/20">
                    <i class="fa-solid fa-gavel"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[9.5px] font-bold uppercase tracking-[0.07em] text-acc/60 mb-0.5">Bagian 10</div>
                    <div class="font-playfair text-[15px] font-bold text-white/88 transition-colors">Hukum yang Berlaku</div>
                </div>
                <i class="fa-solid fa-chevron-down section-chevron text-white/20 text-[11px] flex-shrink-0 transition-transform duration-250"></i>
            </div>
            <div class="section-body hidden px-3 sm:px-5 pb-5 sm:pl-[62px]">
                <p class="text-[13px] text-white/60 leading-relaxed">
                    Ketentuan ini tunduk pada dan diatur oleh hukum Republik Indonesia.
                    Setiap sengketa yang timbul akan diselesaikan melalui musyawarah mufakat,
                    dan apabila tidak tercapai kesepakatan, akan diselesaikan melalui pengadilan yang berwenang di Indonesia.
                </p>
            </div>
        </div>

    </div>{{-- end terms panel --}}

    {{-- Footer --}}
    <div class="flex items-center justify-center gap-1.5 mt-10 text-[11.5px] text-white/15">
        &copy; {{ date('Y') }} <span class="text-acc/50 font-bold">{{ $appName }}</span> &mdash; Semua hak dilindungi.
    </div>

</div>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('bg-gradient-to-br', 'from-acc/25', 'to-acc2/15', 'border', 'border-acc/30', 'text-violet-400');
        b.classList.add('text-white/35');
    });
    document.getElementById('panel-' + tab).classList.remove('hidden');
    btn.classList.add('bg-gradient-to-br', 'from-acc/25', 'to-acc2/15', 'border', 'border-acc/30', 'text-violet-400');
    btn.classList.remove('text-white/35');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleSection(header) {
    const section = header.closest('.section');
    const body    = section.querySelector('.section-body');
    section.classList.toggle('open');
    body.classList.toggle('hidden');
}

function openSection(id) {
    const el   = document.getElementById(id);
    if (!el) return;
    const body = el.querySelector('.section-body');
    if (!el.classList.contains('open')) {
        el.classList.add('open');
        body.classList.remove('hidden');
    }
}

window.addEventListener('scroll', function () {
    const doc    = document.documentElement;
    const scroll = doc.scrollTop || document.body.scrollTop;
    const height = doc.scrollHeight - doc.clientHeight;
    const pct    = height > 0 ? (scroll / height) * 100 : 0;
    document.getElementById('readingBar').style.width = pct + '%';
});

document.querySelectorAll('.toc-item').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (!target) return;
        openSection(target.id);
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    link.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            this.click();
        }
    });

    link.setAttribute('tabindex', '0');
});
</script>