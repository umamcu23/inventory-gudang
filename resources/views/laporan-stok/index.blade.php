@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER TABLE -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-boxes"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Laporan Stok
                        </h5>

                        <p class="modern-table-subtitle">
                            Monitoring dan filter data stok barang
                        </p>
                    </div>

                </div>

                <div class="modern-table-header-right">

                    <div class="modern-table-chip">
                        Inventory
                    </div>

                    <a href="javascript:void(0)"
                    class="btn modern-btn-danger"
                    id="print-stok">

                        <i class="fa fa-print"></i>
                        <span>Print PDF</span>

                    </a>

                </div>

            </div>

            <!-- FILTER (SEJAJAR) -->
            <div class="px-3 pt-3">

                <div class="d-flex align-items-center gap-3 flex-wrap">

                    <label for="opsi-laporan-stok" class="mb-0 font-weight-bold">
                        Filter Stok Berdasarkan :
                    </label>

                    <select class="form-control w-auto"
                            name="opsi-laporan-stok"
                            id="opsi-laporan-stok">

                        <option value="semua" selected>Semua</option>
                        <option value="minimum">Batas Minimum</option>
                        <option value="stok-habis">Stok Habis</option>

                    </select>

                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive modern-table-wrapper mt-3">

                <table id="table_id"
                       class="table modern-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody id="tabel-laporan-stok">
                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>


<!-- Dropdown -->
<script>
    $(document).ready(function() {
        var table = $('#table_id').DataTable({
            paging: true
        });

        loadData('semua');

        $('#opsi-laporan-stok').on('change', function(){
            var selectedOption = $(this).val();
            loadData(selectedOption);
        });

        function loadData(selectedOption) {
            $.ajax({
                url: '/laporan-stok/get-data',
                type: 'GET',
                data: { opsi: selectedOption },
                success: function(response){
                    table.clear().draw();

                    let counter = 1;
                    $.each(response, function(index, item) {
                        var row = [
                            counter++,
                            item.kode_barang,
                            item.nama_barang,
                            item.stok
                        ];
                        table.row.add(row); // Menambahkan baris data ke DataTables
                    });
                    table.draw();
                }
            });

        }

        $('#print-stok').on('click', function(){
            var selectedOption = $('#opsi-laporan-stok').val();
            window.location.href = '/laporan-stok/print-stok?opsi=' + selectedOption;
        });
    });
</script>

@endsection