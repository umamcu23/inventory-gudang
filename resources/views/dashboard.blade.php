@extends('layouts.app')

@section('content')
<div class="row">

    <!-- HEADER -->
    <div class="col-12">
        <div class="modern-table-card mb-3">

            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon primary">
                        <i class="fa fa-tachometer-alt"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">Dashboard</h5>
                        <p class="modern-table-subtitle">
                            Ringkasan data utama sistem inventory
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="col-lg-3 col-md-6 col-12">
        <div class="modern-dashboard-card">
            <div class="modern-dashboard-icon primary">
                <i class="fa fa-cubes"></i>
            </div>
            <div class="modern-dashboard-content">
                <h6>Semua Barang</h6>
                <h3>{{ $barang }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12">
        <div class="modern-dashboard-card">
            <div class="modern-dashboard-icon danger">
                <i class="fa fa-arrow-down"></i>
            </div>
            <div class="modern-dashboard-content">
                <h6>Barang Masuk</h6>
                <h3>{{ $barangMasuk }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12">
        <div class="modern-dashboard-card">
            <div class="modern-dashboard-icon warning">
                <i class="fa fa-arrow-up"></i>
            </div>
            <div class="modern-dashboard-content">
                <h6>Barang Keluar</h6>
                <h3>{{ $barangKeluar }}</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12">
        <div class="modern-dashboard-card">
            <div class="modern-dashboard-icon success">
                <i class="fa fa-users"></i>
            </div>
            <div class="modern-dashboard-content">
                <h6>Pengguna</h6>
                <h3>{{ $user }}</h3>
            </div>
        </div>
    </div>

</div>


<!-- CHART + STOK MINIMUM -->
<div class="row mt-4">

    <!-- CHART -->
    <div class="col-lg-6 col-md-12">

        <div class="modern-table-card h-100">

            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon primary">
                        <i class="fa fa-chart-line"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">Grafik Barang</h5>
                        <p class="modern-table-subtitle">Barang Masuk & Keluar</p>
                    </div>

                </div>

            </div>

            <div class="card-body">
                <canvas id="summaryChart"></canvas>
            </div>

        </div>

    </div>

    <!-- STOK MINIMUM -->
    <div class="col-lg-6 col-md-12">

        <div class="modern-table-card h-100">

            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon warning">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">Stok Minimum</h5>
                        <p class="modern-table-subtitle">Barang yang perlu restock</p>
                    </div>

                </div>

            </div>

            <div class="table-responsive modern-table-wrapper">

                <table class="table modern-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($barangMinimum as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>
                                <span class="badge badge-warning">
                                    <i class="fa fa-exclamation-circle"></i>
                                    {{ $barang->stok }}
                                </span>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('summaryChart').getContext('2d');

/* =========================
   DATA PREP
========================= */
const labels = [
    @foreach($barangMasukData as $data)
        '{{ date("M Y", strtotime($data->date)) }}',
    @endforeach
];

const dataMasuk = [
    @foreach($barangMasukData as $data)
        {{ $data->total }},
    @endforeach
];

const dataKeluar = [
    @foreach($barangKeluarData as $data)
        {{ $data->total }},
    @endforeach
];

/* =========================
   GRADIENT BAR (FIX COLOR)
========================= */
const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 300);
gradientMasuk.addColorStop(0, 'rgba(34, 197, 94, 0.9)'); // 🟢 hijau
gradientMasuk.addColorStop(1, 'rgba(34, 197, 94, 0.2)');

const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 300);
gradientKeluar.addColorStop(0, 'rgba(59, 130, 246, 0.9)'); // 🔵 biru
gradientKeluar.addColorStop(1, 'rgba(59, 130, 246, 0.2)');


/* =========================
   CHART
========================= */
new Chart(ctx, {
    data: {
        labels: labels,
        datasets: [

            /* BAR MASUK (HIJAU) */
            {
                type: 'bar',
                label: 'Barang Masuk',
                data: dataMasuk,
                backgroundColor: gradientMasuk,
                borderRadius: 10,
                barThickness: 18
            },

            /* BAR KELUAR (BIRU) */
            {
                type: 'bar',
                label: 'Barang Keluar',
                data: dataKeluar,
                backgroundColor: gradientKeluar,
                borderRadius: 10,
                barThickness: 18
            },

             /* LINE TREND (OVERLAY) */
            {
                type: 'line',
                label: 'Trend Total',
                data: dataMasuk.map((val, i) => val + (dataKeluar[i] || 0)),
                borderColor: '#111827',
                borderWidth: 2,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: false
            }
        ]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,

        animation: {
            duration: 1400,
            easing: 'easeOutQuart'
        },

        plugins: {
            legend: {
                position: 'top'
            },
            tooltip: {
                backgroundColor: 'rgba(17, 24, 39, 0.95)',
                padding: 12,
                cornerRadius: 10
            }
        },

        scales: {
            x: {
                grid: { display: false }
            },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { precision: 0 }
            }
        }
    }
});
</script>
@endpush