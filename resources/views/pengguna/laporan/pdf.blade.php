<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nexfi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* ── TOP ACCENT BAR ── */
        .accent-bar {
            height: 5px;
            background: linear-gradient(90deg, #1a1a2e 0%, #4f46e5 50%, #06b6d4 100%);
            width: 100%;
        }

        /* ── PAGE WRAPPER ── */
        .page {
            padding: 18px 44px 100px 44px;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            height: 80px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .logo-placeholder {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            color: #4f46e5;
        }

        .logo-text-wrap .brand {
            font-size: 17px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .logo-text-wrap .tagline {
            font-size: 9px;
            color: #94a3b8;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .header-right {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
        }

        .report-label {
            display: inline-block;
            background: #f0f4ff;
            color: #4f46e5;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 6px;
        }

        .report-date {
            font-size: 10px;
            color: #94a3b8;
        }

        /* ── DIVIDER ── */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, #e2e8f0 0%, #c7d2fe 50%, #e2e8f0 100%);
            margin: 0 0 18px 0;
        }

        /* ── BALANCE CARD ── */
        .balance-section {
            display: flex;
            gap: 16px;
            margin-bottom: 28px;
        }

        .balance-card {
            flex: 2;
            background: #1a1a2e;
            border-radius: 16px;
            padding: 24px 28px;
            position: relative;
            overflow: hidden;
        }

        /* decorative circles */
        .balance-card::before {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            background: rgba(79, 70, 229, 0.25);
            border-radius: 50%;
            top: -40px;
            right: -30px;
        }

        .balance-card::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(6, 182, 212, 0.2);
            border-radius: 50%;
            bottom: -20px;
            right: 60px;
        }

        .balance-card .label {
            font-size: 10px;
            font-weight: 500;
            color: #94a3b8;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .balance-card .amount {
            font-size: 32px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -1px;
            line-height: 1;
        }

        .balance-card .amount span {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.7;
            margin-right: 4px;
        }

        .balance-card .balance-note {
            margin-top: 10px;
            font-size: 9px;
            color: #64748b;
            letter-spacing: 0.3px;
        }

        /* ── SUMMARY CARDS ── */
        .summary-cards {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .summary-card {
            flex: 1;
            border-radius: 12px;
            padding: 14px 18px;
            position: relative;
            overflow: hidden;
        }

        .summary-card.income {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .summary-card.expense {
            background: #fff1f2;
            border: 1px solid #fecdd3;
        }

        .summary-card .s-label {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .summary-card.income .s-label { color: #16a34a; }
        .summary-card.expense .s-label { color: #e11d48; }

        .summary-card .s-amount {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .summary-card.income .s-amount { color: #15803d; }
        .summary-card.expense .s-amount { color: #be123c; }

        .summary-card .s-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 22px;
            opacity: 0.15;
        }

        /* ── SECTION HEADER ── */
        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .section-dot {
            width: 8px;
            height: 8px;
            background: #4f46e5;
            border-radius: 50%;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .section-line {
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* ── TABLE ── */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #1a1a2e;
        }

        thead th {
            padding: 11px 14px;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #94a3b8;
            text-align: left;
        }

        thead th:first-child { border-radius: 8px 0 0 0; }
        thead th:last-child  { border-radius: 0 8px 0 0; text-align: right; }

        tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.1s;
        }

        tbody tr:nth-child(even) {
            background: #fafbff;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody td {
            padding: 12px 14px;
            font-size: 11px;
            color: #374151;
            vertical-align: middle;
        }

        tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        /* Date cell */
        .date-cell {
            font-size: 10px;
            color: #6b7280;
            font-weight: 500;
        }

        /* Name cell */
        .name-cell {
            font-weight: 600;
            color: #1a1a2e;
        }

        /* Category badge */
        .badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            background: #f0f4ff;
            color: #4f46e5;
        }

        /* Type badge */
        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .type-badge.pemasukan {
            background: #dcfce7;
            color: #16a34a;
        }

        .type-badge.pengeluaran {
            background: #ffe4e6;
            color: #e11d48;
        }

        .type-badge::before {
            content: '';
            display: inline-block;
            width: 5px;
            height: 5px;
            border-radius: 50%;
        }

        .type-badge.pemasukan::before { background: #16a34a; }
        .type-badge.pengeluaran::before { background: #e11d48; }

        /* Nominal color */
        .nominal-income { color: #15803d; }
        .nominal-expense { color: #be123c; }

        /* Table wrapper with border */
        .table-wrap {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 6px rgba(0,0,0,0.05);
        }

        /* ── FOOTER ── */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px 44px;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .footer-brand-dot {
            width: 14px;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #06b6d4);
            border-radius: 2px;
        }

        .footer-brand-name {
            font-size: 9px;
            font-weight: 700;
            color: #1a1a2e;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .footer-meta {
            font-size: 9px;
            color: #94a3b8;
        }

        .footer-copy {
            font-size: 9px;
            color: #cbd5e1;
        }
    </style>
</head>
<body>

<div class="accent-bar"></div>

<div class="page">

    {{-- ── HEADER ── --}}
    <div class="header">
        <div class="logo-wrap">
            @php
                $logoPath = public_path('assets_public/logo.png');
            @endphp
            @if(file_exists($logoPath))
                <img class="logo-img" src="data:image/png;base64,{{ base64_encode(file_get_contents($logoPath)) }}">
            @else
                <div class="logo-placeholder">N</div>
            @endif
            <div class="logo-text-wrap">
                <div class="tagline">Sistem Manajemen Keuangan Pribadi</div>
            </div>
        </div>
        <div class="header-right">
            <div class="report-label">Laporan Keuangan</div>
            <div class="report-date">Dicetak: {{ date('d M Y, H:i') }}</div>
        </div>
    </div>

    <div class="divider"></div>

    {{-- ── BALANCE + SUMMARY ── --}}
    <div class="balance-section">
        <div class="balance-card">
            <div class="label">Saldo Saat Ini</div>
            <div class="amount">
                <span>Rp</span>{{ number_format($saldo) }}
            </div>
            <div class="balance-note">Dicetak oleh: {{ $user->name ?? 'User' }}</div>
        </div>

        <div class="summary-cards">
            <div class="summary-card income">
                <div class="s-label">Total Pemasukan</div>
                <div class="s-amount">Rp {{ number_format($totalPemasukan) }}</div>
                <div class="s-icon">↑</div>
            </div>
            <div class="summary-card expense">
                <div class="s-label">Total Pengeluaran</div>
                <div class="s-amount">Rp {{ number_format($totalPengeluaran) }}</div>
                <div class="s-icon">↓</div>
            </div>
        </div>
    </div>

    {{-- ── TRANSACTION TABLE ── --}}
    <div class="section-header">
        <div class="section-dot"></div>
        <div class="section-title">Riwayat Transaksi</div>
        <div class="section-line"></div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Tipe</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trx)
                <tr>
                    <td><span class="date-cell">{{ $trx->tanggal }}</span></td>
                    <td><span class="name-cell">{{ $trx->nama }}</span></td>
                    <td><span class="badge">{{ $trx->category->nama ?? '-' }}</span></td>
                    <td>
                        <span class="type-badge {{ strtolower($trx->tipe) }}">
                            {{ ucfirst($trx->tipe) }}
                        </span>
                    </td>
                    <td>
                        <span class="{{ strtolower($trx->tipe) === 'pemasukan' ? 'nominal-income' : 'nominal-expense' }}">
                            Rp {{ number_format($trx->nominal) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- ── FOOTER ── --}}
<div class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <div class="footer-brand-dot"></div>
            <span class="footer-brand-name">NexFi</span>
        </div>
        <div class="footer-meta">
            Dicetak oleh: {{ $user->name ?? 'User' }} &nbsp;•&nbsp; {{ date('d M Y H:i') }}
        </div>
        <div class="footer-copy">© {{ date('Y') }} Nexfi App — Financial Management System</div>
    </div>
</div>

</body>
</html>