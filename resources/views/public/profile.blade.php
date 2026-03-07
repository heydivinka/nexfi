<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile {{ $user->username }} | NexFi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets_public/nex.png') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { jakarta: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        bg:   '#07080f',
                        bg2:  '#0c0d1d',
                        bg3:  '#10132a',
                        acc:  '#6c63ff',
                        acc2: '#9b59f5',
                    },
                    boxShadow: {
                        card:   '0 24px 60px rgba(0,0,0,0.5)',
                        avatar: '0 0 0 3px rgba(108,99,255,0.5), 0 8px 24px rgba(108,99,255,0.3)',
                        qr:     '0 6px 24px rgba(0,0,0,0.4)',
                        cta:    '0 6px 20px rgba(108,99,255,0.3)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-grid {
            background-image: linear-gradient(rgba(108,99,255,0.07) 1px,transparent 1px), linear-gradient(90deg,rgba(108,99,255,0.07) 1px,transparent 1px);
            background-size: 40px 40px;
        }
        .banner-grad { background: linear-gradient(135deg, #3b2fa0, #6c63ff 50%, #9b59f5); }
        .banner-grad::after { content:''; position:absolute; inset:0; background:repeating-linear-gradient(45deg,rgba(255,255,255,0.04) 0,rgba(255,255,255,0.04) 1px,transparent 1px,transparent 10px); }
        .btn-cta { background: linear-gradient(135deg, #6c63ff, #9b59f5); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-bg text-white/90 overflow-x-hidden min-h-screen">

{{-- Background effects --}}
<div class="bg-grid fixed inset-0 pointer-events-none z-0"></div>
<div class="fixed w-[500px] h-[500px] rounded-full -top-52 -left-36 pointer-events-none z-0" style="background:radial-gradient(circle,rgba(108,99,255,0.18) 0%,transparent 70%)"></div>
<div class="fixed w-[400px] h-[400px] rounded-full -bottom-36 -right-24 pointer-events-none z-0" style="background:radial-gradient(circle,rgba(155,89,245,0.14) 0%,transparent 70%)"></div>

<div class="relative z-10 min-h-screen p-5 flex flex-col gap-4">

    {{-- Card --}}
    <div class="flex-1 bg-bg3 border border-acc/20 rounded-2xl shadow-card overflow-visible">
        <div class="grid md:grid-cols-[320px_1fr] min-h-[calc(100vh-72px)] rounded-2xl overflow-hidden">

            {{-- ══ KIRI ══ --}}
            <div class="border-b md:border-b-0 md:border-r border-acc/10 flex flex-col relative z-[2] overflow-visible">

                {{-- Banner --}}
                <div class="banner-grad h-[100px] flex-shrink-0 relative z-[1]"></div>

                {{-- Hero --}}
                <div class="px-6 pb-5 flex flex-col items-center text-center relative z-[3]">
                    <div class="-mt-12 mb-3 relative z-[4]">
                        @if($user->photo)
                            <img class="w-[92px] h-[92px] rounded-full object-cover border-4 border-bg3 shadow-avatar block"
                                 src="{{ asset('assets_public/' . $user->photo) }}"
                                 alt="{{ $user->name }}">
                        @else
                            <div class="w-[92px] h-[92px] rounded-full border-4 border-bg3 shadow-avatar bg-gray-400 flex items-center justify-center text-[2rem] font-bold text-white">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="text-[19px] font-extrabold text-white mb-1">{{ $user->name }}</div>
                    <div class="text-[12.5px] text-white/35 mb-1">{{ $user->username }}</div>
                    <div class="text-[11.5px] text-white/20">{{ $user->email }}</div>
                </div>

                <div class="h-px bg-acc/10 mx-5"></div>

                {{-- Stats --}}
                <div class="grid grid-cols-3">
                    <div class="py-3.5 px-2 text-center border-r border-acc/10">
                        <div class="text-[13px] font-extrabold text-white break-all">Rp {{ number_format($saldo,0,',','.') }}</div>
                        <div class="text-[9px] font-bold uppercase tracking-widest text-white/35 mt-1">Saldo</div>
                    </div>
                    <div class="py-3.5 px-2 text-center border-r border-acc/10">
                        <div class="text-[13px] font-extrabold text-green-400 break-all">+{{ number_format($pemasukan,0,',','.') }}</div>
                        <div class="text-[9px] font-bold uppercase tracking-widest text-white/35 mt-1">Pemasukan</div>
                    </div>
                    <div class="py-3.5 px-2 text-center">
                        <div class="text-[13px] font-extrabold text-red-400 break-all">-{{ number_format($pengeluaran,0,',','.') }}</div>
                        <div class="text-[9px] font-bold uppercase tracking-widest text-white/35 mt-1">Pengeluaran</div>
                    </div>
                </div>

                <div class="h-px bg-acc/10 mx-5"></div>

                {{-- QR --}}
                <div class="flex-1 p-5 flex flex-col items-center justify-center gap-3">
                    <div class="text-[10px] font-bold uppercase tracking-widest text-white/25 flex items-center gap-1.5 self-start w-full">
                        <i class="fa-solid fa-qrcode"></i> QR Code Profile
                    </div>
                    @php $url = url('/u/'.$user->username); @endphp
                    <div class="p-3 rounded-[14px] bg-white shadow-qr inline-flex">
                        <img class="block w-[120px] h-[120px] rounded-[4px]"
                             src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&color=100162&bgcolor=ffffff&data={{ urlencode($url) }}"
                             alt="QR">
                    </div>
                    <div class="text-[10px] text-white/20 font-mono text-center break-all">{{ $url }}</div>
                </div>

                <div class="h-px bg-acc/10 mx-5"></div>

                {{-- CTA --}}
                <div class="px-5 pt-4 pb-5">
                    <a href="/register" class="btn-cta flex items-center justify-center gap-2 w-full py-3 rounded-[13px] text-[13px] font-extrabold text-white shadow-cta hover:opacity-90 transition-opacity no-underline">
                        <i class="fa-solid fa-rocket"></i> Gabung NexFi Sekarang
                    </a>
                </div>
            </div>

            {{-- ══ KANAN ══ --}}
            <div class="flex flex-col overflow-y-auto scrollbar-hide">
                <div class="px-6 pt-5 pb-3.5 border-b border-acc/10 text-[10px] font-bold uppercase tracking-widest text-white/25 flex items-center gap-1.5">
                    <i class="fa-solid fa-clock-rotate-left text-acc/50"></i> Aktivitas Terakhir
                </div>

                <div class="px-6 py-2 flex-1">
                    @forelse($transactions as $trx)
                    <div class="flex items-center gap-3 py-2.5 border-b border-white/[0.04] last:border-0">
                        <div class="w-9 h-9 rounded-[10px] flex-shrink-0 flex items-center justify-center text-[13px] {{ $trx->tipe=='pemasukan' ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                            <i class="fa-solid {{ $trx->tipe=='pemasukan' ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-[13px] font-semibold text-white/85 truncate">{{ $trx->nama }}</div>
                            <div class="text-[11px] text-white/25 mt-0.5">{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</div>
                        </div>
                        <div class="text-[13.5px] font-extrabold flex-shrink-0 {{ $trx->tipe=='pemasukan' ? 'text-green-400' : 'text-red-400' }}">
                            {{ $trx->tipe=='pemasukan' ? '+' : '-' }}Rp {{ number_format($trx->nominal,0,',','.') }}
                        </div>
                    </div>
                    @empty
                    <div class="text-[12.5px] text-white/20 text-center py-8">
                        <i class="fa-solid fa-inbox text-[2rem] block mb-2 opacity-20"></i>
                        Belum ada transaksi
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <div class="text-center text-[11.5px] text-white/15 flex items-center gap-1.5 justify-center">
        Dibuat dengan <span class="text-acc/50 font-bold">NexFi</span> &mdash; Platform Keuangan #1 Indonesia
    </div>
</div>

</body>
</html>