@extends('layouts.app')

@include('customer.create')
@include('customer.edit')

@section('content')
   <div class="row">

    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER TABLE -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-users"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Data Customer
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola seluruh data customer dengan mudah dan cepat
                        </p>
                    </div>

                </div>

                <div class="modern-table-header-right">


                    <div class="modern-table-chip">
                        Master Data
                    </div>
                    <a href="javascript:void(0)"
                       class="btn modern-btn-primary"
                       id="button_tambah_customer">

                        <i class="fa fa-plus"></i>
                        <span>Tambah Customer</span>

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
                            <th>Nama Customer</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
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
        INIT DATATABLE + LOAD DATA
        ========================== */
        let table = $('#table_id').DataTable({
            paging: true
        });

        loadCustomer();

        function loadCustomer() {
            $.ajax({
                url: "/customer/get-data",
                type: "GET",
                dataType: "JSON",
                success: function (response) {

                    table.clear();

                    let counter = 1;

                    $.each(response.data, function (key, value) {

                        let customer = `
                            <tr id="index_${value.id}">
                                <td>${counter++}</td>
                                <td>${value.customer}</td>
                                <td>${value.alamat}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                    id="button_edit_customer"
                                    data-id="${value.id}"
                                    class="modern-action-btn edit">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)"
                                    id="button_hapus_customer"
                                    data-id="${value.id}"
                                    class="modern-action-btn delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        `;

                        table.row.add($(customer)).draw(false);
                    });
                }
            });
        }

        /* =========================
        OPEN MODAL CREATE
        ========================== */
        $('body').on('click', '#button_tambah_customer', function () {
            $('#modal_tambah_customer').modal('show');
        });

        /* =========================
        STORE CUSTOMER
        ========================== */
        $('#store').on('click', function (e) {

            e.preventDefault();

            clearCustomerForm();

            let customer = $('#customer').val();
            let alamat   = $('#alamat').val();

            let formData = new FormData();
            formData.append('customer', customer);
            formData.append('alamat', alamat);
            formData.append('_token', $("meta[name='csrf-token']").attr("content"));

            $.ajax({
                url: "/customer",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });

                    $('#modal_tambah_customer').modal('hide');
                    clearCustomerForm();
                    loadCustomer();
                },

                error: function (error) {
                    showCustomerError(error);
                }
            });
        });

        /* =========================
        EDIT CUSTOMER
        ========================== */
        $('body').on('click', '#button_edit_customer', function () {

            let id = $(this).data('id');

            $.ajax({
                url: `/customer/${id}/edit`,
                type: "GET",
                success: function (res) {

                    $('#customer_id').val(res.data.id);
                    $('#edit_customer').val(res.data.customer);
                    $('#edit_alamat').val(res.data.alamat);

                    $('#modal_edit_customer').modal('show');
                }
            });

        });

        /* =========================
        UPDATE CUSTOMER
        ========================== */
        $('#update').on('click', function (e) {

            e.preventDefault();

            let id = $('#customer_id').val();

            let formData = new FormData();
            formData.append('customer', $('#edit_customer').val());
            formData.append('alamat', $('#edit_alamat').val());
            formData.append('_token', $("meta[name='csrf-token']").attr("content"));
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/customer/${id}`,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });

                    $('#modal_edit_customer').modal('hide');
                    loadCustomer();
                },

                error: function (error) {
                    showCustomerError(error);
                }
            });

        });

        /* =========================
        DELETE CUSTOMER
        ========================== */
        $('body').on('click', '#button_hapus_customer', function () {

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
                        url: `/customer/${id}`,
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

                            loadCustomer();
                        }
                    });

                }

            });

        });

        /* =========================
        RESET FORM (CREATE)
        ========================== */
        function clearCustomerForm() {

            $('#customer').val('');
            $('#alamat').val('');

            $('.alert').addClass('d-none').text('');
        }

        /* =========================
        RESET ERROR
        ========================== */
        function showCustomerError(error) {

            $('.alert').addClass('d-none');

            if (error.responseJSON?.customer) {
                $('#alert-customer')
                    .removeClass('d-none')
                    .text(error.responseJSON.customer[0]);
            }

            if (error.responseJSON?.alamat) {
                $('#alert-alamat')
                    .removeClass('d-none')
                    .text(error.responseJSON.alamat[0]);
            }
        }

        /* =========================
        RESET ON MODAL CLOSE
        ========================== */
        $('#modal_tambah_customer, #modal_edit_customer').on('hidden.bs.modal', function () {
            clearCustomerForm();
            $('.alert').addClass('d-none').text('');
        });

    });
    </script>
@endsection
