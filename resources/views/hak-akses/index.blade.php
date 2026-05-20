@extends('layouts.app')

@include('hak-akses.create')
@include('hak-akses.edit')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="modern-table-card">

                <!-- HEADER -->
                <div class="modern-table-header">

                    <div class="modern-table-header-left">

                        <div class="modern-table-icon">
                            <i class="fa fa-user-shield"></i>
                        </div>

                        <div>
                            <h5 class="modern-table-title">
                                Hak Akses
                            </h5>

                            <p class="modern-table-subtitle">
                                Kelola role dan hak akses pengguna sistem
                            </p>
                        </div>

                    </div>

                    <div class="modern-table-header-right">

                        <div class="modern-table-chip">
                            Security
                        </div>

                        <a href="javascript:void(0)"
                        class="btn modern-btn-primary"
                        id="button_tambah_role">

                            <i class="fa fa-plus"></i>
                            <span>Tambah Role</span>

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
                                <th>Role</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>



    <script>
        $(document).ready(function () {

            /* =========================
            INIT DATATABLE
            ========================== */
            let table = $('#table_id').DataTable({
                paging: true
            });

            loadRole();

            function loadRole() {

                $.ajax({
                    url: "/hak-akses/get-data",
                    type: "GET",
                    dataType: "JSON",
                    success: function (response) {

                        table.clear();

                        let counter = 1;

                        $.each(response.data, function (key, value) {

                            let role = `
                                <tr id="index_${value.id}">
                                    <td>${counter++}</td>
                                    <td>${value.role}</td>
                                    <td>${value.deskripsi ?? '-'}</td>
                                    <td>

                                        <a href="javascript:void(0)"
                                        id="button_edit_role"
                                        data-id="${value.id}"
                                        class="modern-action-btn edit">

                                            <i class="far fa-edit"></i>

                                        </a>

                                        <a href="javascript:void(0)"
                                        id="button_hapus_role"
                                        data-id="${value.id}"
                                        class="modern-action-btn delete">

                                            <i class="fas fa-trash"></i>

                                        </a>

                                    </td>
                                </tr>
                            `;

                            table.row.add($(role)).draw(false);
                        });
                    }
                });
            }

            /* =========================
            OPEN CREATE MODAL
            ========================== */
            $('body').on('click', '#button_tambah_role', function () {
                $('#modal_tambah_role').modal('show');
            });

            /* =========================
            RESET FORM
            ========================== */
            function clearForm() {

                $('#role').val('');
                $('#deskripsi').val('');

                $('#edit_role').val('');
                $('#edit_deskripsi').val('');
                $('#role_id').val('');

                clearError();
            }

            /* =========================
            CLEAR ERROR
            ========================== */
            function clearError() {
                $('.alert').addClass('d-none').text('');
            }

            /* =========================
            STORE ROLE
            ========================== */
            $('#store').on('click', function (e) {

                e.preventDefault();

                let formData = new FormData();
                formData.append('role', $('#role').val());
                formData.append('deskripsi', $('#deskripsi').val());
                formData.append('_token', $("meta[name='csrf-token']").attr("content"));

                $.ajax({
                    url: '/hak-akses',
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

                        $('#modal_tambah_role').modal('hide');

                        clearForm();
                        loadRole();
                    },

                    error: function (error) {
                        showError(error);
                    }
                });
            });

            /* =========================
            EDIT ROLE
            ========================== */
            $('body').on('click', '#button_edit_role', function () {

                let id = $(this).data('id');

                $.ajax({
                    url: `/hak-akses/${id}/edit`,
                    type: "GET",
                    success: function (res) {

                        $('#role_id').val(res.data.id);
                        $('#edit_role').val(res.data.role);
                        $('#edit_deskripsi').val(res.data.deskripsi);

                        $('#modal_edit_role').modal('show');
                    }
                });
            });

            /* =========================
            UPDATE ROLE
            ========================== */
            $('#update').on('click', function (e) {

                e.preventDefault();

                let id = $('#role_id').val();

                let formData = new FormData();
                formData.append('role', $('#edit_role').val());
                formData.append('deskripsi', $('#edit_deskripsi').val());
                formData.append('_token', $("meta[name='csrf-token']").attr("content"));
                formData.append('_method', 'PUT');

                $.ajax({
                    url: `/hak-akses/${id}`,
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

                        $('#modal_edit_role').modal('hide');

                        clearForm();
                        loadRole();
                    },

                    error: function (error) {
                        showError(error);
                    }
                });
            });

            /* =========================
            DELETE ROLE
            ========================== */
            $('body').on('click', '#button_hapus_role', function () {

                let id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'YA, HAPUS!',
                    cancelButtonText: 'TIDAK'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: `/hak-akses/${id}`,
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

                                loadRole();
                            }
                        });
                    }
                });
            });

            /* =========================
            ERROR HANDLER
            ========================== */
            function showError(error) {

                $('.alert').addClass('d-none');

                if (error.responseJSON?.role) {
                    $('#alert-role').removeClass('d-none').text(error.responseJSON.role[0]);
                }

                if (error.responseJSON?.deskripsi) {
                    $('#alert-deskripsi').removeClass('d-none').text(error.responseJSON.deskripsi[0]);
                }
            }

            /* =========================
            RESET MODAL
            ========================== */
            $('#modal_tambah_role, #modal_edit_role').on('hidden.bs.modal', function () {
                clearForm();
                clearError();
            });

        });
    </script>
@endsection
