@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-dolly"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Laporan Barang Keluar
                        </h5>

                        <p class="modern-table-subtitle">
                            Monitoring data barang keluar berdasarkan periode
                        </p>
                    </div>

                </div>

                <div class="modern-table-header-right">

                    <div class="modern-table-chip">
                        Inventory
                    </div>

                    <a href="javascript:void(0)"
                       class="btn modern-btn-danger"
                       id="print-barang-keluar">

                        <i class="fa fa-print"></i>
                        <span>Print PDF</span>

                    </a>

                </div>

            </div>

            <!-- FILTER (FULL 1 BARIS) -->
            <div class="px-3 pt-3">

                <form id="filter_form"
                      action="/laporan-barang-keluar/get-data"
                      method="GET">

                    <div class="d-flex align-items-end"
                         style="width: 100%; gap: 20px;">

                        <!-- INPUT WRAPPER -->
                        <div class="d-flex" style="flex: 1; gap: 20px;">

                            <div class="d-flex flex-column" style="flex: 1;">
                                <label class="mb-1">Tanggal Mulai :</label>
                                <input type="date"
                                       class="form-control"
                                       name="tanggal_mulai"
                                       id="tanggal_mulai">
                            </div>

                            <div class="d-flex flex-column" style="flex: 1;">
                                <label class="mb-1">Tanggal Selesai :</label>
                                <input type="date"
                                       class="form-control"
                                       name="tanggal_selesai"
                                       id="tanggal_selesai">
                            </div>

                        </div>

                        <!-- BUTTON WRAPPER -->
                        <div class="d-flex" style="gap: 10px; white-space: nowrap;">

                            <button type="submit"
                                    class="btn modern-btn-primary">

                                <i class="fa fa-filter"></i>
                                Filter

                            </button>

                            <button type="button"
                                    class="btn modern-btn-refresh"
                                    id="refresh_btn">

                                <i class="fa fa-sync"></i>
                                Refresh

                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <!-- TABLE -->
            <div class="table-responsive modern-table-wrapper mt-3">

                <table id="table_id"
                       class="table modern-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>Customer</th>
                        </tr>
                    </thead>

                    <tbody id="tabel-laporan-barang-keluar">
                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>
<!-- Script Get Data -->
<script>
    $(document).ready(function() {
        var table = $('#table_id').DataTable({ paging: true});

        loadData(); // Panggil fungsi loadData saat halaman dimuat

        $('#filter_form').submit(function(event) {
            event.preventDefault();
            loadData(); // Panggil fungsi loadData saat tombol filter ditekan
        });

        $('#refresh_btn').on('click', function() {
            refreshTable();
        });

        //Fungsi load data berdasarkan range tanggal_mulai dan tanggal_selesai
        function loadData() {
            var tanggalMulai = $('#tanggal_mulai').val();
            var tanggalSelesai = $('#tanggal_selesai').val();
            
            $.ajax({
                url: '/laporan-barang-keluar/get-data',
                type: 'GET',
                dataType: 'json',
                data: {
                    tanggal_mulai: tanggalMulai,
                    tanggal_selesai: tanggalSelesai
                },
                success: function(response) {
                    table.clear().draw();

                    if (response.length > 0) {
                        $.each(response, function(index, item) {
                            getCustomerName(item.customer_id, function(customer){
                                var row = [
                                    (index + 1),
                                    item.kode_transaksi,
                                    item.tanggal_keluar,
                                    item.nama_barang,
                                    item.jumlah_keluar,
                                    customer
                                ];
                               table.row.add(row).draw(false);
                            });
                        });
                    } else {
                        var emptyRow = ['','Tidak ada data yang tersedia.', '', '', '', ''];
                        table.row.add(emptyRow).draw(false); // Tambahkan baris kosong ke DataTable
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
            function getCustomerName(customerId, callback){
                $.getJSON('{{ url('api/customer') }}', function(customers){
                    var customer = customers.find(function(s){
                        return Number(s.id) === Number(customerId);
                    });
                    callback(customer ? customer.customer : '');
                });
            }
        }

        //Fungsi Refresh Tabel
        function refreshTable(){
            $('#filter_form')[0].reset();
            loadData();
        }

        //Print barang keluar
        $('#print-barang-keluar').on('click', function(){
            var tanggalMulai    = $('#tanggal_mulai').val();
            var tanggalSelesai  = $('#tanggal_selesai').val();
            
            var url = '/laporan-barang-keluar/print-barang-keluar';

            if(tanggalMulai && tanggalSelesai){
                url += '?tanggal_mulai=' + tanggalMulai + '&tanggal_selesai=' + tanggalSelesai;
            }

            window.location.href = url;
        });

    });
</script>



@endsection