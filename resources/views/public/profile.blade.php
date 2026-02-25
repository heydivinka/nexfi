<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile {{ $user->username }} | Nexfi</title>

    <style>
        body{
            background:#020617;
            color:white;
            font-family:Arial, Helvetica, sans-serif;
            display:flex;
            justify-content:center;
            padding:40px;
        }

        .card{
            width:420px;
            background:#0f172a;
            border-radius:20px;
            padding:25px;
            box-shadow:0 0 40px rgba(99,102,241,0.25);
        }

        .center{text-align:center;}

        img.avatar{
            width:90px;
            height:90px;
            border-radius:20px;
            object-fit:cover;
            margin-bottom:10px;
        }

        .btn{
            display:inline-block;
            margin-top:20px;
            padding:10px 18px;
            background:#6366f1;
            border-radius:10px;
            color:white;
            text-decoration:none;
            font-weight:600;
        }

        .stat{
            display:flex;
            justify-content:space-between;
            margin-top:15px;
            background:#020617;
            padding:12px;
            border-radius:10px;
        }

        .trx{
            margin-top:15px;
            background:#020617;
            padding:10px;
            border-radius:10px;
        }

        .trx-item{
            display:flex;
            justify-content:space-between;
            margin-bottom:6px;
            font-size:13px;
        }

        .income{color:#22c55e;}
        .expense{color:#ef4444;}
    </style>
</head>
<body>

<div class="card">

    <div class="center">

        <img class="avatar"
             src="{{ $user->photo ? asset('profile/'.$user->photo) : asset('default.png') }}">

        <h2>{{ $user->name }}</h2>
        <div style="color:#94a3b8">@ {{ $user->username }}</div>

        <p style="font-size:13px;color:#94a3b8">
            {{ $user->email }}
        </p>

    </div>


    {{-- ================= SALDO --}}
    <div class="stat">
        <div>Saldo</div>
        <div><b>Rp {{ number_format($saldo) }}</b></div>
    </div>

    <div class="stat">
        <div>Pemasukan</div>
        <div class="income">+ Rp {{ number_format($pemasukan) }}</div>
    </div>

    <div class="stat">
        <div>Pengeluaran</div>
        <div class="expense">- Rp {{ number_format($pengeluaran) }}</div>
    </div>


    {{-- ================= AKTIVITAS --}}
    <div class="trx">

        <div style="margin-bottom:8px;font-weight:bold">
            Aktivitas Terakhir
        </div>

        @forelse($transactions as $trx)
            <div class="trx-item">

                <div>
                    {{ $trx->nama }}
                </div>

                <div class="{{ $trx->tipe == 'pemasukan' ? 'income' : 'expense' }}">
                    {{ $trx->tipe == 'pemasukan' ? '+' : '-' }}
                    Rp {{ number_format($trx->nominal) }}
                </div>

            </div>
        @empty
            <div style="font-size:12px;color:#94a3b8">
                Belum ada transaksi
            </div>
        @endforelse

    </div>


    {{-- ================= QR --}}
    @php
        $url = url('/u/'.$user->username);
    @endphp

    <div class="center" style="margin-top:20px">

        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $url }}">

        <div style="font-size:12px;color:#94a3b8;margin-top:10px;">
            {{ $url }}
        </div>

        <a href="/register" class="btn">
            Gabung Nexfi 🚀
        </a>

    </div>

</div>

</body>
</html>