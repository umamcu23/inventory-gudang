@extends('layouts.app')

@include('satuan-barang.create')
@include('satuan-barang.edit')

@section('content')
    <div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-balance-scale"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Satuan Barang
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola satuan barang (pcs, box, kg, dll)
                        </p>
                    </div>

                </div>

                <div class="modern-table-header-right">
                    <div class="modern-table-chip">
                        Master Data
                    </div>

                    <button class="btn modern-btn-primary"
                            id="button_tambah_satuan">

                        <i class="fa fa-plus"></i>
                        Tambah Satuan
                    </button>

                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive modern-table-wrapper">

                <table id="table_id"
                       class="table modern-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Satuan Barang</th>
                            <th width="160" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>
</div>
    <script>
        $(document).ready(function () {

            loadSatuan();

            /* =========================
            LOAD DATA TABLE
            ========================= */
            function loadSatuan() {

                if ($.fn.DataTable.isDataTable('#table_id')) {
                    $('#table_id').DataTable().clear().destroy();
                }

                let table = $('#table_id').DataTable({
                    paging: true
                });

                $.ajax({
                    url: "/satuan-barang/get-data",
                    type: "GET",
                    dataType: "JSON",
                    success: function (response) {

                        let counter = 1;

                        $.each(response.data, function (key, value) {

                            let row = `
                                <tr id="index_${value.id}">
                                    <td>${counter++}</td>
                                    <td>${value.satuan}</td>
                                    <td class="text-center">

                                        <a href="javascript:void(0)"
                                        id="button_edit_satuan"
                                        data-id="${value.id}"
                                        class="modern-action-btn edit">

                                            <i class="far fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)"
                                        id="button_hapus_satuan"
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

            /* =========================
            OPEN MODAL TAMBAH
            ========================= */
            $('body').on('click', '#button_tambah_satuan', function () {
                $('#modal_tambah_satuan').modal('show');
            });

            /* =========================
            RESET MODAL TAMBAH
            ========================= */
            function resetModalSatuan() {

                $('#satuan').val('');

                $('#alert-satuan')
                    .removeClass('d-block')
                    .addClass('d-none')
                    .text('');

            }

            $('#modal_tambah_satuan').on('hidden.bs.modal', function () {
                resetModalSatuan();
            });

            /* =========================
            CREATE (STORE)
            ========================= */
            $('#store').click(function (e) {

                e.preventDefault();

                let formData = new FormData();
                formData.append('satuan', $('#satuan').val());
                formData.append('_token', $("meta[name='csrf-token']").attr("content"));

                $.ajax({
                    url: '/satuan-barang',
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function (res) {

                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#modal_tambah_satuan').modal('hide');
                        resetModalSatuan();

                        loadSatuan();

                    },

                    error: function (err) {

                        $('#alert-satuan')
                            .removeClass('d-none')
                            .addClass('d-block')
                            .text(err.responseJSON.satuan[0]);

                    }

                });

            });

            /* =========================
            EDIT (GET DATA)
            ========================= */
            $('body').on('click', '#button_edit_satuan', function () {

                let id = $(this).data('id');

                $.ajax({
                    url: `/satuan-barang/${id}/edit`,
                    type: "GET",
                    success: function (res) {

                        $('#satuan_id').val(res.data.id);
                        $('#edit_satuan').val(res.data.satuan);

                        $('#modal_edit_satuan').modal('show');

                    }

                });

            });

            /* =========================
            RESET MODAL EDIT
            ========================= */
            function resetModalEditSatuan() {

                $('#satuan_id').val('');
                $('#edit_satuan').val('');

                $('#alert-edit-satuan')
                    .removeClass('d-block')
                    .addClass('d-none')
                    .text('');

            }

            $('#modal_edit_satuan').on('hidden.bs.modal', function () {
                resetModalEditSatuan();
            });

            /* =========================
            UPDATE DATA
            ========================= */
            $('#update').click(function (e) {

                e.preventDefault();

                let id = $('#satuan_id').val();

                let formData = new FormData();
                formData.append('satuan', $('#edit_satuan').val());
                formData.append('_token', $("meta[name='csrf-token']").attr("content"));
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/satuan-barang/${id}`,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function (res) {

                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#modal_edit_satuan').modal('hide');

                        loadSatuan();

                    },

                    error: function (err) {

                        $('#alert-edit-satuan')
                            .removeClass('d-none')
                            .addClass('d-block')
                            .text(err.responseJSON.satuan[0]);

                    }

                });

            });

            /* =========================
            DELETE DATA
            ========================= */
            $('body').on('click', '#button_hapus_satuan', function () {

                let id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: `/satuan-barang/${id}`,
                            type: "DELETE",
                            data: {
                                _token: $("meta[name='csrf-token']").attr("content")
                            },

                            success: function (res) {

                                Swal.fire({
                                    icon: 'success',
                                    title: res.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                $(`#index_${id}`).remove();

                            }

                        });

                    }

                });

            });

        });
    </script>
@endsection
