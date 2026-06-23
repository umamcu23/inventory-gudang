<!DOCTYPE html>

<html>
<head>
    <style>
        @page {
            margin: 20mm;
        }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #333;
    }

    /* =========================
        KOP SURAT
    ========================= */

    .kop-surat {
        display: table;
        width: 100%;
        border-bottom: 3px solid #111827;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }

    .kop-logo {
        position: absolute;
        left: 0;
        top: 0;
        width: 90px;
    }

    

    .kop-logo img {
        width: 75px;
        height: auto;
    }

    .kop-content {
        text-align: center;
    }

    .kop-title {
        font-size: 24px;
        font-weight: bold;
        letter-spacing: 1px;
        color: #111827;
    }

    .kop-subtitle {
        font-size: 13px;
        font-weight: bold;
        margin-top: 4px;
        color: #374151;
    }

    .kop-address {
        font-size: 11px;
        margin-top: 8px;
        line-height: 1.5;
        color: #4b5563;
    }

    .kop-contact {
        font-size: 11px;
        margin-top: 4px;
        color: #4b5563;
    }


    /* =========================
        JUDUL LAPORAN
    ========================= */

    .report-title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 6px;
        color: #111827;
    }

    .report-subtitle {
        text-align: center;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .report-period {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 20px;
    }


    /* =========================
       TABLE
    ========================= */

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .data-table thead th {
        background: #1f2937;
        color: white;
        padding: 10px;
        font-size: 11px;
        text-transform: uppercase;
        border: 1px solid #374151;
    }

    .data-table tbody td {
        padding: 8px;
        border: 1px solid #e5e7eb;
        text-align: center;
    }

    .data-table tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    /* =========================
       FOOTER
    ========================= */

    .footer {
        position: fixed;
        bottom: 10px;
        left: 0;
        right: 0;
        border-top: 1px solid #d1d5db;
        padding-top: 6px;
        font-size: 11px;
        color: #666;
    }

    .footer-left {
        float: left;
    }

    .footer-right {
        float: right;
    }
</style>

</head>

<body>
    @php
        $logo = 'data:image/png;base64,' .
        base64_encode(file_get_contents(public_path('assets/img/logo-skp.png')));
    @endphp

    <!-- KOP SURAT -->
    <div class="kop-surat">
        <div class="kop-logo">
            <img src="{{ $logo }}">
        </div>

        <div class="kop-content">

            <div class="kop-title">
                PT SUN KERTAS PRIMA
            </div>

            <div class="kop-subtitle">
                SISTEM INVENTORY GUDANG
            </div>

            <div class="kop-address">
                Jl. Air Hitam Gg. Aurelia No. 2, RT.004/RW.004,
                Kel. Bina Mulya, Kec. Bina Mulya, Kota Pekanbaru
            </div>

            <div class="kop-contact">
                Email: admin@skpindonesia.com
                &nbsp;&nbsp;|&nbsp;&nbsp;
                Telp/WA: 0823 9101 1356
            </div>

        </div>

    </div>

<div class="kop-line"></div>

<!-- JUDUL LAPORAN -->
<div class="report-title">
    LAPORAN BARANG KELUAR
</div>

<div class="report-period">
    @if ($tanggalMulai && $tanggalSelesai)
        Periode : {{ $tanggalMulai }} s/d {{ $tanggalSelesai }}
    @else
        Periode : Semua Data
    @endif
</div>

<!-- TABEL -->
<table class="data-table">
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th>Kode Transaksi</th>
            <th>Tanggal Keluar</th>
            <th>Nama Barang</th>
            <th>Jumlah Keluar</th>
            <th>Customer</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d-m-Y') }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ number_format($item->jumlah_keluar, 0, ',', '.') }}</td>
            <td>{{ $item->customer->customer ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- FOOTER -->
<div class="footer">

    <div class="footer-left">
        Dicetak oleh :
        <strong>{{ auth()->user()->name }}</strong>
    </div>

    <div class="footer-right">
        Tanggal Cetak :
        <strong>{{ date('d-m-Y H:i') }}</strong>
    </div>

</div>

</body>
</html>
