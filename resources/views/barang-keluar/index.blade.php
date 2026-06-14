@extends('layouts.app')

@include('barang-keluar.create')

@section('content')
    <div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-truck"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Barang Keluar
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola transaksi barang keluar ke customer
                        </p>

                    </div>

                </div>

                <div class="modern-table-header-right">

                    <a href="javascript:void(0)"
                       class="btn modern-btn-primary"
                       id="button_tambah_barangKeluar">

                        <i class="fa fa-plus"></i>
                        <span>Tambah Barang Keluar</span>

                    </a>

                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive modern-table-wrapper">

                <table id="table_id"
                       class="table modern-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Barang</th>
                            <th>Stok Keluar</th>
                            <th>Customer</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>
</div>
    <script>
    /* =========================================================
    SELECT2 + AUTO STOK + SATUAN
    ========================================================= */
    $(document).ready(function () {

        setTimeout(function () {
            $('.js-example-basic-single').select2();

            $('#nama_barang').on('change', function () {

                let selectedOption = $(this).find('option:selected');
                let nama_barang = selectedOption.text();

                $.ajax({
                    url: '/api/barang-keluar',
                    type: 'GET',
                    data: { nama_barang: nama_barang },
                    success: function (response) {

                        if (response && (response.stok || response.stok === 0) && response.satuan_id) {

                            $('#stok').val(response.stok);

                            getSatuanName(response.satuan_id, function (satuan) {
                                $('#satuan_id').val(satuan);
                            });

                        } else {
                            $('#stok').val(0);
                            $('#satuan_id').val('');
                        }
                    }
                });

                function getSatuanName(satuanId, callback) {
                    $.getJSON("{{ url('api/satuan') }}", function (data) {
                        let satuan = data.find(
                            s => Number(s.id) === Number(satuanId)
                        );
                        callback(satuan ? satuan.satuan : '');
                    });
                }

            });

        }, 500);

    });


    /* =========================================================
    DATATABLE INIT
    ========================================================= */
    function getCustomerName(customers, customerId) {
        let customer = customers.find(c => c.id === customerId);
        return customer ? customer.customer : '';
    }

    function loadTable() {

        $.ajax({
            url: "/barang-keluar/get-data",
            type: "GET",
            dataType: "JSON",
            success: function (response) {

                let counter = 1;

                let table = $('#table_id').DataTable();
                table.clear();

                $.each(response.data, function (key, value) {

                    let customer = getCustomerName(response.customer, value.customer_id);

                    let row = `
                        <tr id="index_${value.id}">
                            <td>${counter++}</td>
                            <td>${value.kode_transaksi}</td>
                            <td>${value.tanggal_keluar}</td>
                            <td>${value.nama_barang}</td>
                            <td>${value.jumlah_keluar}</td>
                            <td>${customer}</td>

                            <td class="text-center">

                                <a href="javascript:void(0)"
                                id="button_hapus_barangKeluar"
                                data-id="${value.id}"
                                class="modern-action-btn delete">

                                    <i class="fas fa-trash"></i>

                                </a>

                            </td>
                        </tr>
                        `;

                    table.row.add($(row)).draw(false);
                });

            }
        });
    }

    $(document).ready(function () {

        $('#table_id').DataTable({
            paging: true
        });

        loadTable();

    });


    /* =========================================================
    GENERATE KODE TRANSAKSI
    ========================================================= */
    function generateKodeTransaksi() {

        let tanggal = new Date()
            .toLocaleDateString('id-ID')
            .split('/')
            .reverse()
            .join('-');

        let randomNumber = Math.floor(Math.random() * 10000)
            .toString()
            .padStart(4, '0');

        let kode = 'TRX-OUT-' + tanggal + '-' + randomNumber;

        $('#kode_transaksi').val(kode);

        return kode;
    }


    /* =========================================================
    OPEN MODAL
    ========================================================= */
    $('body').on('click', '#button_tambah_barangKeluar', function () {

        $('#modal_tambah_barangKeluar').modal('show');

        generateKodeTransaksi();

    });


    /* =========================================================
    STORE DATA
    ========================================================= */
    $('body').on('click', '#store', function (e) {

        e.preventDefault();

        let data = new FormData();

        data.append('kode_transaksi', $('#kode_transaksi').val());
        data.append('tanggal_keluar', $('#tanggal_keluar').val());
        data.append('nama_barang', $('#nama_barang').val());
        data.append('jumlah_keluar', $('#jumlah_keluar').val());
        data.append('customer_id', $('#customer_id').val());
        data.append('_token', $("meta[name='csrf-token']").attr('content'));

        $.ajax({
            url: '/barang-keluar',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                // RESET (yang penting saja)
                $('#jumlah_keluar').val('');
                $('#stok').val('');
                $('#nama_barang').val('').trigger('change');
                $('#customer_id').val('');
                $('#modal_tambah_barangKeluar').modal('hide');

                loadTable();
            },

            error: function (error) {

                $('.alert').removeClass('d-block').addClass('d-none');

                let res = error.responseJSON;

                if (res?.kode_transaksi) {
                    $('#alert-kode_transaksi').text(res.kode_transaksi[0]).addClass('d-block');
                }

                if (res?.tanggal_keluar) {
                    $('#alert-tanggal_keluar').text(res.tanggal_keluar[0]).addClass('d-block');
                }

                if (res?.nama_barang) {
                    $('#alert-nama_barang').text(res.nama_barang[0]).addClass('d-block');
                }

                if (res?.jumlah_keluar) {
                    $('#alert-jumlah_keluar').text(res.jumlah_keluar[0]).addClass('d-block');
                }

                if (res?.customer_id) {
                    $('#alert-customer_id').text(res.customer_id[0]).addClass('d-block');
                }
            }
        });

    });


    /* =========================================================
    DELETE DATA (MODERN ICON)
    ========================================================= */
    $('body').on('click', '#button_hapus_barangKeluar', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus data ini?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: `/barang-keluar/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $("meta[name='csrf-token']").attr('content')
                    },

                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $(`#index_${id}`).remove();

                        loadTable();
                    }
                });

            }

        });

    });


    /* =========================================================
    SET TANGGAL DEFAULT
    ========================================================= */
    $(document).ready(function () {

        let today = new Date();
        let formattedDate =
            today.getFullYear() + '-' +
            String(today.getMonth() + 1).padStart(2, '0') + '-' +
            String(today.getDate()).padStart(2, '0');

        $('#tanggal_keluar').val(formattedDate);

    });
    </script>
@endsection
