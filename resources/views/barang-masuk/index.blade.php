@extends('layouts.app')

@include('barang-masuk.create')

@section('content')
   <div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-truck-loading"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Barang Masuk
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola transaksi barang masuk dari supplier
                        </p>

                    </div>

                </div>

                <div class="modern-table-header-right">

                    <a href="javascript:void(0)"
                       class="btn modern-btn-primary"
                       id="button_tambah_barangMasuk">

                        <i class="fa fa-plus"></i>
                        <span>Tambah Barang Masuk</span>

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
                            <th>Tanggal Masuk</th>
                            <th>Nama Barang</th>
                            <th>Stok Masuk</th>
                            <th>Supplier</th>
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

/* =========================
   RESET FORM (FIXED)
   HANYA JUMLAH MASUK
========================= */
function resetBarangMasukForm() {

    $('#jumlah_masuk').val('');

    // alert tetap dibersihkan saja
    $('.alert')
        .removeClass('d-block')
        .addClass('d-none')
        .html('');
}


/* =========================
   SUPPLIER NAME
========================= */
function getSupplierName(suppliers, supplierId) {
    let supplier = suppliers.find(s => s.id === supplierId);
    return supplier ? supplier.supplier : '-';
}


/* =========================
   LOAD TABLE
========================= */
function loadBarangMasuk() {

    $.ajax({
        url: "/barang-masuk/get-data",
        type: "GET",
        dataType: "JSON",

        success: function (response) {

            let table = $('#table_id').DataTable();
            table.clear();

            let counter = 1;

            $.each(response.data, function (key, value) {

                let supplier = getSupplierName(response.supplier, value.supplier_id);

                let row = `
                    <tr id="index_${value.id}">
                        <td>${counter++}</td>
                        <td>${value.kode_transaksi}</td>
                        <td>${value.tanggal_masuk}</td>
                        <td>${value.nama_barang}</td>
                        <td>${value.jumlah_masuk}</td>
                        <td>${supplier}</td>
                        <td>

                            <a href="javascript:void(0)"
                               id="button_hapus_barangMasuk"
                               data-id="${value.id}"
                               class="modern-action-btn delete">

                                <i class="fas fa-trash"></i>

                            </a>

                        </td>
                    </tr>
                `;

                table.row.add($(row));
            });

            table.draw(false);
        }
    });
}


/* =========================
   INIT
========================= */
$(document).ready(function () {

    $('#table_id').DataTable({
        paging: true
    });

    loadBarangMasuk();

    // set tanggal default
    let today = new Date().toISOString().split('T')[0];
    $('#tanggal_masuk').val(today);
});


/* =========================
   SELECT2 + STOK AUTO
========================= */
$(document).ready(function () {

    setTimeout(function () {

        $('.js-example-basic-single').select2();

        $('#nama_barang').on('change', function () {

            let selected = $(this).find('option:selected');
            let nama_barang = selected.text();

            $.ajax({
                url: '/api/barang-masuk',
                type: 'GET',
                data: { nama_barang: nama_barang },

                success: function (response) {

                    console.log('nama_barang'+nama_barang);
                    
                    $('#stok').val(response.stok ?? 0);
                    console.log(response);
                    
                    if (response.satuan_id) {
                        console.log('satuan_id'+response.satuan_id);
                        
                        $.getJSON('/api/satuan', function (satuans) {

                            let satuan = satuans.find(s => s.id === response.satuan_id);
                            console.log('json'+satuan);
                            
                            $('#satuan_id').val(satuan ? satuan.satuan : '');
                        });
                    }
                }
            });
        });

    }, 300);
});


/* =========================
   GENERATE KODE
========================= */
function generateKode() {

    let tgl = new Date().toISOString().split('T')[0];
    let rand = Math.floor(Math.random() * 10000).toString().padStart(4, '0');

    return `TRX-IN-${tgl}-${rand}`;
}


/* =========================
   OPEN MODAL
========================= */
$('body').on('click', '#button_tambah_barangMasuk', function () {

    $('#modal_tambah_barangMasuk').modal('show');

    $('#kode_transaksi').val(generateKode());
});


/* =========================
   STORE
========================= */
$('#store').click(function (e) {
    e.preventDefault();

    let formData = new FormData();

    formData.append('kode_transaksi', $('#kode_transaksi').val());
    formData.append('tanggal_masuk', $('#tanggal_masuk').val());
    formData.append('nama_barang', $('#nama_barang').val());
    formData.append('jumlah_masuk', $('#jumlah_masuk').val());
    formData.append('supplier_id', $('#supplier_id').val());
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: '/barang-masuk',
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

            loadBarangMasuk();

            resetBarangMasukForm();

            $('#modal_tambah_barangMasuk').modal('hide');
        },

        error: function (error) {

            let res = error.responseJSON;

            if (!res) return;

            Object.keys(res).forEach(function (key) {

                $('#alert-' + key)
                    .removeClass('d-none')
                    .addClass('d-block')
                    .html(res[key][0]);
            });
        }
    });
});


/* =========================
   DELETE
========================= */
$('body').on('click', '#button_hapus_barangMasuk', function () {

    let id = $(this).data('id');

    Swal.fire({
        title: 'Hapus data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'YA',
        cancelButtonText: 'BATAL'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: `/barang-masuk/${id}`,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    loadBarangMasuk();
                }
            });
        }
    });
});


/* =========================
   RESET ON CLOSE MODAL
========================= */
$('#modal_tambah_barangMasuk').on('hidden.bs.modal', function () {
    resetBarangMasukForm();
});

$(document).ready(function () {
    let today = new Date().toISOString().split('T')[0];
    $('#tanggal_masuk').val(today);
});
</script>
@endsection
