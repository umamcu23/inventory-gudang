@extends('layouts.app')

@include('supplier.create')
@include('supplier.edit')

@section('content')
    <div class="row">

    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER TABLE -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-truck"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Data Supplier
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola data supplier / pemasok barang
                        </p>

                    </div>

                </div>

                <div class="modern-table-header-right">

                    <a href="javascript:void(0)"
                       class="btn modern-btn-primary"
                       id="button_tambah_supplier">

                        <i class="fa fa-plus"></i>
                        <span>Tambah Supplier</span>

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
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
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

            const table = $('#table_id').DataTable({
                paging: true,
                destroy: true
            });

            loadSupplier();

            function loadSupplier() {

                $.ajax({
                    url: "/supplier/get-data",
                    type: "GET",
                    dataType: "JSON",
                    success: function (response) {

                        table.clear();

                        let counter = 1;

                        $.each(response.data, function (key, value) {

                            let row = `
                                <tr id="index_${value.id}">
                                    <td>${counter++}</td>
                                    <td>${value.supplier}</td>
                                    <td>${value.alamat}</td>
                                    <td class="text-center">

                                        <a href="javascript:void(0)"
                                        id="button_edit_supplier"
                                        data-id="${value.id}"
                                        class="modern-action-btn edit">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)"
                                        id="button_hapus_supplier"
                                        data-id="${value.id}"
                                        class="modern-action-btn delete">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                            `;

                            table.row.add($(row));

                        });

                        table.draw();

                    }
                });

            }

            /* =========================
            RESET CREATE FORM
            ========================= */
            function resetCreateSupplier() {

                $('#supplier').val('');
                $('#alamat').val('');

                $('.alert')
                    .removeClass('d-block')
                    .addClass('d-none')
                    .text('');

            }

            /* =========================
            RESET EDIT FORM
            ========================= */
            function resetEditSupplier() {

                $('#supplier_id').val('');
                $('#edit_supplier').val('');
                $('#edit_alamat').val('');

                $('.alert')
                    .removeClass('d-block')
                    .addClass('d-none')
                    .text('');

            }

            /* =========================
            OPEN MODAL CREATE
            ========================= */
            $('body').on('click', '#button_tambah_supplier', function () {

                resetCreateSupplier();

                $('#modal_tambah_supplier').modal('show');

            });

            /* =========================
            STORE
            ========================= */
            $('#store').click(function (e) {

                e.preventDefault();

                let formData = new FormData();
                formData.append('supplier', $('#supplier').val());
                formData.append('alamat', $('#alamat').val());
                formData.append('_token', $("meta[name='csrf-token']").attr("content"));

                $.ajax({
                    url: '/supplier',
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

                        $('#modal_tambah_supplier').modal('hide');

                        resetCreateSupplier();

                        loadSupplier();

                    },

                    error: function (error) {

                        if (error.responseJSON?.supplier?.[0]) {
                            $('#alert-supplier')
                                .removeClass('d-none')
                                .text(error.responseJSON.supplier[0]);
                        }

                        if (error.responseJSON?.alamat?.[0]) {
                            $('#alert-alamat')
                                .removeClass('d-none')
                                .text(error.responseJSON.alamat[0]);
                        }

                    }

                });

            });

            /* =========================
            EDIT
            ========================= */
            $('body').on('click', '#button_edit_supplier', function () {

                let id = $(this).data('id');

                $.get(`/supplier/${id}/edit`, function (res) {

                    resetEditSupplier();

                    $('#supplier_id').val(res.data.id);
                    $('#edit_supplier').val(res.data.supplier);
                    $('#edit_alamat').val(res.data.alamat);

                    $('#modal_edit_supplier').modal('show');

                });

            });

            /* =========================
            UPDATE
            ========================= */
            $('#update').click(function (e) {

                e.preventDefault();

                let id = $('#supplier_id').val();

                let formData = new FormData();
                formData.append('supplier', $('#edit_supplier').val());
                formData.append('alamat', $('#edit_alamat').val());
                formData.append('_token', $("meta[name='csrf-token']").attr("content"));
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/supplier/${id}`,
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

                        $('#modal_edit_supplier').modal('hide');

                        resetEditSupplier();

                        loadSupplier();

                    }

                });

            });

            /* =========================
            DELETE
            ========================= */
            $('body').on('click', '#button_hapus_supplier', function () {

                let id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'YA, HAPUS',
                    cancelButtonText: 'BATAL'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: `/supplier/${id}`,
                            type: "DELETE",
                            data: {
                                _token: $("meta[name='csrf-token']").attr("content")
                            },

                            success: function (response) {

                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                loadSupplier();

                            }

                        });

                    }

                });

            });

        });
        </script>
@endsection
