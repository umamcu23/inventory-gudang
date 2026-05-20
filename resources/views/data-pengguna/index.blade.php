@extends('layouts.app')

@include('data-pengguna.create')
@include('data-pengguna.edit')

@section('content')
   <div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-users-cog"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Data Pengguna
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola akun pengguna sistem dan hak akses
                        </p>
                    </div>

                </div>

                <div class="modern-table-header-right">

                    <div class="modern-table-chip">
                        Master Data
                    </div>

                    <a href="javascript:void(0)"
                       class="btn modern-btn-primary"
                       id="button_tambah_pengguna">

                        <i class="fa fa-plus"></i>
                        <span>Tambah Pengguna</span>

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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
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

        loadPengguna();

        function loadPengguna() {

            $.ajax({
                url: "/data-pengguna/get-data",
                type: "GET",
                dataType: "JSON",
                success: function (response) {

                    table.clear();

                    let counter = 1;

                    $.each(response.data, function (key, value) {

                        let pengguna = `
                            <tr id="index_${value.id}">
                                <td>${counter++}</td>
                                <td>${value.name}</td>
                                <td>${value.email}</td>
                                <td>${value.role?.role ?? '-'}</td>
                                <td>

                                    <a href="javascript:void(0)"
                                    id="button_edit_pengguna"
                                    data-id="${value.id}"
                                    class="modern-action-btn edit">

                                        <i class="far fa-edit"></i>

                                    </a>

                                    <a href="javascript:void(0)"
                                    id="button_hapus_pengguna"
                                    data-id="${value.id}"
                                    class="modern-action-btn delete">

                                        <i class="fas fa-trash"></i>

                                    </a>

                                </td>
                            </tr>
                        `;

                        table.row.add($(pengguna)).draw(false);
                    });
                }
            });
        }

        /* =========================
        OPEN MODAL CREATE
        ========================== */
        $('body').on('click', '#button_tambah_pengguna', function () {
            $('#modal_tambah_pengguna').modal('show');
        });

        /* =========================
        RESET FORM CREATE
        ========================== */
        function clearCreateForm() {

            $('#name').val('');
            $('#email').val('');
            $('#password').val('');
            $('#role_id').val('');

            clearError();
        }

        /* =========================
        RESET FORM EDIT
        ========================== */
        function clearEditForm() {

            $('#edit_name').val('');
            $('#edit_email').val('');
            $('#edit_password').val('');
            $('#edit_role_id').val('');
            $('#pengguna_id').val('');

            clearError();
        }

        /* =========================
        CLEAR ERROR
        ========================== */
        function clearError() {

            $('.alert').addClass('d-none').text('');
        }

        /* =========================
        STORE PENGGUNA
        ========================== */
        $('#store').on('click', function (e) {

            e.preventDefault();

            let formData = new FormData();
            formData.append('name', $('#name').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('role_id', $('#role_id').val());
            formData.append('_token', $("meta[name='csrf-token']").attr("content"));

            $.ajax({
                url: '/data-pengguna',
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

                    $('#modal_tambah_pengguna').modal('hide');

                    clearCreateForm();
                    loadPengguna();
                },

                error: function (error) {
                    showError(error);
                }
            });
        });

        /* =========================
        OPEN EDIT MODAL
        ========================== */
        $('body').on('click', '#button_edit_pengguna', function () {

            let id = $(this).data('id');

            $.ajax({
                url: `/data-pengguna/${id}/edit`,
                type: "GET",
                success: function (res) {

                    $('#pengguna_id').val(res.data.id);
                    $('#edit_name').val(res.data.name);
                    $('#edit_email').val(res.data.email);
                    $('#edit_role_id').val(res.data.role_id);

                    $('#modal_edit_pengguna').modal('show');
                }
            });
        });

        /* =========================
        UPDATE PENGGUNA
        ========================== */
        $('#update').on('click', function (e) {

            e.preventDefault();

            let id = $('#pengguna_id').val();

            let formData = new FormData();
            formData.append('name', $('#edit_name').val());
            formData.append('email', $('#edit_email').val());
            formData.append('role_id', $('#edit_role_id').val());
            formData.append('_token', $("meta[name='csrf-token']").attr("content"));
            formData.append('_method', 'PUT');

            if ($('#edit_password').val() !== '') {
                formData.append('password', $('#edit_password').val());
            }

            $.ajax({
                url: `/data-pengguna/${id}`,
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

                    $('#modal_edit_pengguna').modal('hide');

                    clearEditForm();
                    loadPengguna();
                },

                error: function (error) {
                    showError(error);
                }
            });
        });

        /* =========================
        DELETE PENGGUNA
        ========================== */
        $('body').on('click', '#button_hapus_pengguna', function () {

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
                        url: `/data-pengguna/${id}`,
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

                            loadPengguna();
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

            if (error.responseJSON?.name) {
                $('#alert-name').removeClass('d-none').text(error.responseJSON.name[0]);
            }

            if (error.responseJSON?.email) {
                $('#alert-email').removeClass('d-none').text(error.responseJSON.email[0]);
            }

            if (error.responseJSON?.password) {
                $('#alert-password').removeClass('d-none').text(error.responseJSON.password[0]);
            }

            if (error.responseJSON?.role_id) {
                $('#alert-role_id').removeClass('d-none').text(error.responseJSON.role_id[0]);
            }
        }

        /* =========================
        RESET MODAL
        ========================== */
        $('#modal_tambah_pengguna, #modal_edit_pengguna').on('hidden.bs.modal', function () {
            clearCreateForm();
            clearEditForm();
        });

    });
    </script>
@endsection
