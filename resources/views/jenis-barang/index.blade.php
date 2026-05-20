@extends('layouts.app')

@include('jenis-barang.create')
@include('jenis-barang.edit')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="modern-table-card">

                <!-- HEADER -->
                <div class="modern-table-header">

                    <div class="modern-table-header-left">

                        <div class="modern-table-icon">
                            <i class="fa fa-tags"></i>
                        </div>

                        <div>
                            <h5 class="modern-table-title">
                                Data Jenis Barang
                            </h5>

                            <p class="modern-table-subtitle">
                                Kelola seluruh jenis / kategori barang
                            </p>

                        </div>

                    </div>

                    <div class="modern-table-header-right">

                        <div class="modern-table-chip mr-2">
                            Master Data
                        </div>

                        <a href="javascript:void(0)"
                        class="btn modern-btn-primary"
                        id="button_tambah_jenis_barang">

                            <i class="fa fa-plus mr-1"></i>
                            Tambah Jenis

                        </a>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="table-responsive modern-table-wrapper">

                    <table id="table_id" class="table modern-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th width="80">No</th>
                                <th>Jenis Barang</th>
                                <th width="140" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
    <!-- Datatables Jquery -->
<script>
    $(document).ready(function () {

        function resetModalJenisBarang() {

            $('#modal_tambah_jenis_barang').find('form')[0].reset();

            $('#modal_tambah_jenis_barang .alert')
                .removeClass('d-block')
                .addClass('d-none');
        }

        $('#modal_tambah_jenis_barang').on('hidden.bs.modal', function () {
            resetModalJenisBarang();
        });

        $('.modern-modal-close').on('click', function () {
            if ($('#modal_tambah_jenis_barang').hasClass('show')) {
                resetModalJenisBarang();
            }
        });

        $('#modal_tambah_jenis_barang .modern-modal-close').on('click', function () {
            resetModalJenisBarang();
        });

        let table = $('#table_id').DataTable({
            paging: true
        });

        $.ajax({
            url: "/jenis-barang/get-data",
            type: "GET",
            dataType: 'JSON',
            success: function (response) {

                table.clear();

                let counter = 1;

                $.each(response.data, function (key, value) {

                    let jenisBarang = `
                        <tr class="jenis-row" id="index_${value.id}">
                            <td>${counter++}</td>
                            <td>${value.jenis_barang}</td>
                            <td>
                                <a href="javascript:void(0)"
                                id="button_edit_jenis_barang"
                                data-id="${value.id}"
                                class="modern-action-btn edit">

                                    <i class="far fa-edit"></i>
                                </a>

                                <a href="javascript:void(0)"
                                id="button_hapus_jenis_barang"
                                data-id="${value.id}"
                                class="modern-action-btn delete">

                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    `;

                    table.row.add($(jenisBarang));

                });

                table.draw(false);

            }
        });

    });
</script>

<!-- Show Modal Tambah Jenis Barang -->
<script>
    $('body').on('click', '#button_tambah_jenis_barang', function () {
        $('#modal_tambah_jenis_barang').modal('show');
    });

    $('#store').click(function (e) {

        e.preventDefault();

        let jenis_barang = $('#jenis_barang').val();
        let token = $("meta[name='csrf-token']").attr("content");

        let formData = new FormData();
        formData.append('jenis_barang', jenis_barang);
        formData.append('_token', token);

        $.ajax({
            url: '/jenis-barang',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#modal_tambah_jenis_barang').modal('hide');
                $('#jenis_barang').val('');

                // reload data (clean)
                $('#table_id').DataTable().destroy();
                location.reload();

            },

            error: function (error) {

                if (error.responseJSON?.jenis_barang?.[0]) {

                    $('#alert-jenis_barang')
                        .removeClass('d-none')
                        .addClass('d-block')
                        .html(error.responseJSON.jenis_barang[0]);

                }

            }

        });

    });
</script>

<!-- Edit Data Jenis Barang -->
<script>
    $('body').on('click', '#button_edit_jenis_barang', function () {

        let jenis_id = $(this).data('id');

        $.ajax({
            url: `/jenis-barang/${jenis_id}/edit`,
            type: "GET",
            success: function (response) {

                $('#jenis_id').val(response.data.id);
                $('#edit_jenis_barang').val(response.data.jenis_barang);

                $('#modal_edit_jenis_barang').modal('show');

            }
        });

    });

    // UPDATE
    $('#update').click(function (e) {

        e.preventDefault();

        let jenis_id = $('#jenis_id').val();
        let jenis_barang = $('#edit_jenis_barang').val();
        let token = $("meta[name='csrf-token']").attr('content');

        let formData = new FormData();
        formData.append('jenis_barang', jenis_barang);
        formData.append('_token', token);
        formData.append('_method', 'PUT');

        $.ajax({

            url: `/jenis-barang/${jenis_id}`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#modal_edit_jenis_barang').modal('hide');

                // update 1 row saja (tanpa reload)
                let row = $(`#index_${response.data.id}`);
                row.find('td').eq(1).text(response.data.jenis_barang);

            },

            error: function (error) {

                if (error.responseJSON?.jenis_barang?.[0]) {

                    $('#alert-jenis_barang')
                        .removeClass('d-none')
                        .addClass('d-block')
                        .html(error.responseJSON.jenis_barang[0]);

                }

            }

        });

    });
</script>

<!-- Hapus Data Jenis Barang -->
<script>
    $('body').on('click', '#button_hapus_jenis_barang', function () {

        let jenis_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS!',
            cancelButtonText: 'BATAL'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: `/jenis-barang/${jenis_id}`,
                    type: "DELETE",
                    data: {
                        _token: token
                    },

                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // remove row tanpa reload
                        $(`#index_${jenis_id}`).remove();

                        // re-number table biar rapi
                        let no = 1;
                        $('#table_id tbody tr').each(function () {
                            $(this).find('td').eq(0).text(no++);
                        });

                    }

                });

            }

        });

    });
</script>
@endsection
