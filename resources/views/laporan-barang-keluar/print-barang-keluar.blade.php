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

        /* HEADER */
        .report-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .report-subtitle {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
            color: #666;
        }

        .report-period {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead th {
            background: #1f2937;
            color: white;
            padding: 10px;
            font-size: 12px;
            text-transform: uppercase;
        }

        tbody td {
            padding: 8px;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: 15px;
            left: 20px;
            right: 20px;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
        }

        .footer strong {
            color: #111;
        }
    </style>
</head>

<body>

    <!-- TITLE -->
    <div class="report-title">
        LAPORAN BARANG KELUAR
    </div>

    <div class="report-subtitle">
        Sistem Inventory Management
    </div>

    <!-- PERIOD -->
    <div class="report-period">
        @if ($tanggalMulai && $tanggalSelesai)
            Rentang Tanggal: {{ $tanggalMulai }} s/d {{ $tanggalSelesai }}
        @else
            Rentang Tanggal: Semua Data
        @endif
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
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
                <td>{{ $item->jumlah_keluar }}</td>
                <td>{{ $item->customer->customer ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div>
            Dicetak oleh: <strong>{{ auth()->user()->name }}</strong>
        </div>
        <div>
            Tanggal Cetak: <strong>{{ date('d-m-Y') }}</strong>
        </div>
    </div>

</body>
</html>