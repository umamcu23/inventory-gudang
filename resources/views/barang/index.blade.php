@extends('layouts.app')

@include('barang.create')
@include('barang.edit')
@include('barang.show')

@section('content')
 <div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- TABLE HEADER (SUDAH TERMASUK BUTTON) -->
            <div class="modern-table-header">

                <!-- LEFT -->
                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-box"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Data Barang
                        </h5>

                        <p class="modern-table-subtitle">
                            Kelola seluruh data barang dengan mudah dan cepat
                        </p>

                    </div>

                </div>

                <!-- RIGHT ACTION -->
                <div class="modern-table-header-right d-flex align-items-center gap-2">

                    <div class="modern-table-chip mr-2">
                        Master Data
                    </div>

                    <a href="javascript:void(0)"
                        class="btn modern-btn-primary"
                        id="button_tambah_barang">

                        <i class="fa fa-plus mr-1"></i>
                        <span>Tambah Barang</span>

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
                            <th>Gambar</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
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

    let table;

    /* =========================================
       DOCUMENT READY
    ========================================= */

    $(document).ready(function () {

        initDataTable();

        loadDataBarang();

    });

    /* =========================================
       INIT DATATABLE
    ========================================= */

    function initDataTable() {

        table = $('#table_id').DataTable({

            paging: true,
            searching: true,
            responsive: true,
            autoWidth: false,
            pageLength: 10,

            language: {
                search: "",
                searchPlaceholder: "Cari data barang...",
            }

        });

    }

    /* =========================================
       LOAD DATA BARANG
    ========================================= */

    function loadDataBarang() {

        $.ajax({

            url: "/barang/get-data",
            type: "GET",
            dataType: "JSON",

            beforeSend: function () {

                table.clear().draw();

            },

            success: function (response) {

                let counter = 1;

                $.each(response.data, function (key, value) {

                    table.row.add([
                        renderNumber(counter++),
                        renderImage(value),
                        renderKode(value),
                        renderNama(value),
                        renderStock(value),
                        renderAction(value)
                    ]).draw(false);

                });

            },

            error: function (error) {

                console.log(error);

            }

        });

    }

    /* =========================================
       RENDER NUMBER
    ========================================= */

    function renderNumber(number) {

        return `
            <div class="modern-row-number">
                ${number}
            </div>
        `;

    }

    /* =========================================
       RENDER IMAGE
    ========================================= */

    function renderImage(value) {

        if (value.gambar) {

            return `
                <div class="modern-product-image">
                    <img src="/storage/${value.gambar}" alt="${value.nama_barang}">
                </div>
            `;

        }

        return `
            <div class="modern-product-image empty">
                <i class="fa fa-image"></i>
            </div>
        `;

    }

    /* =========================================
       RENDER KODE
    ========================================= */

    function renderKode(value) {

        return `
            <div class="modern-kode-barang">
                ${value.kode_barang}
            </div>
        `;

    }

    /* =========================================
       RENDER NAMA
    ========================================= */

    function renderNama(value) {

        return `
            <div class="modern-nama-barang">
                ${value.nama_barang}
            </div>
        `;

    }

    /* =========================================
       RENDER STOCK
    ========================================= */

    function renderStock(value) {

        let stok = value.stok != null
            ? value.stok
            : "Stok Kosong";

        return `
            <div class="modern-stock-badge">
                ${stok}
            </div>
        `;

    }

    /* =========================================
       RENDER ACTION
    ========================================= */

    function renderAction(value) {

        return `

            <div class="modern-action-group">

                <a href="javascript:void(0)"
                    id="button_detail_barang"
                    data-id="${value.id}"
                    class="modern-action-btn detail">

                    <i class="far fa-eye"></i>
                </a>

                <a href="javascript:void(0)"
                    id="button_edit_barang"
                    data-id="${value.id}"
                    class="modern-action-btn edit">

                    <i class="far fa-edit"></i>
                </a>

                <a href="javascript:void(0)"
                    id="button_hapus_barang"
                    data-id="${value.id}"
                    class="modern-action-btn delete">

                    <i class="fas fa-trash"></i>
                </a>

            </div>

        `;

    }

    /* =========================================
       RESET FORM
    ========================================= */

    let previewImageUrl = null;

    /* =========================================
       RESET FORM
    ========================================= */

    function resetFormTambah() {

        /* Reset Input */

        $('#gambar').val('');

        $('#nama_barang').val('');

        $('#stok_minimum').val('');

        $('#deskripsi').val('');

        $('#jenis_id').prop('selectedIndex', 0);

        $('#satuan_id').prop('selectedIndex', 0);

        /* Reset Preview */

        const preview =
            document.getElementById('preview');

        /* Hapus blob URL */

        if (previewImageUrl) {

            URL.revokeObjectURL(previewImageUrl);

            previewImageUrl = null;

        }

        preview.removeAttribute('src');

        preview.style.display = 'none';

        /* Show Placeholder */

        $('.modern-upload-placeholder').show();

        /* Clear Validation */

        clearValidation();

    }


    /* =========================================
       CLEAR VALIDATION
    ========================================= */

    function clearValidation() {

        $('.alert').removeClass('d-block').addClass('d-none');

    }

    /* =========================================
       SHOW VALIDATION
    ========================================= */

    function showValidationError(error) {

        let fields = [
            'gambar',
            'nama_barang',
            'stok_minimum',
            'jenis_id',
            'satuan_id',
            'deskripsi'
        ];

        $.each(fields, function (index, field) {

            if (
                error.responseJSON &&
                error.responseJSON[field] &&
                error.responseJSON[field][0]
            ) {

                $(`#alert-${field}`)
                    .removeClass('d-none')
                    .addClass('d-block')
                    .html(error.responseJSON[field][0]);

            }

        });

    }

    /* =========================================
       SHOW MODAL TAMBAH
    ========================================= */

    $('body').on('click', '#button_tambah_barang', function () {

        clearValidation();

        $('#modal_tambah_barang').modal('show');

    });

    /* =========================================
       STORE DATA
    ========================================= */

    $('#store').click(function (e) {

        e.preventDefault();

        clearValidation();

        let formData = new FormData();

        formData.append('gambar', $('#gambar')[0].files[0]);
        formData.append('nama_barang', $('#nama_barang').val());
        formData.append('stok_minimum', $('#stok_minimum').val());
        formData.append('jenis_id', $('#jenis_id').val());
        formData.append('satuan_id', $('#satuan_id').val());
        formData.append('deskripsi', $('#deskripsi').val());

        formData.append(
            '_token',
            $("meta[name='csrf-token']").attr("content")
        );

        $.ajax({

            url: '/barang',
            type: "POST",

            cache: false,

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

                loadDataBarang();

                resetFormTambah();

                $('#modal_tambah_barang').modal('hide');

            },

            error: function (error) {

                showValidationError(error);

            }

        });

    });

    /* =========================================
       DETAIL BARANG
    ========================================= */

   $('body').on('click', '#button_detail_barang', function () {

    let id = $(this).data('id');

    $.ajax({
        url: `/barang/${id}`,
        type: "GET",
        success: function (res) {

            let data = res.data;

            $('#detail_gambar_preview')
                .attr('src', '/storage/' + data.gambar);

            $('#detail_nama_barang').val(data.nama_barang);

            $('#detail_jenis_id').val(data.jenis_id);

            $('#detail_satuan_id').val(data.satuan_id);

            $('#detail_stok').val(data.stok ?? 'Stok Kosong');

            $('#detail_stok_minimum').val(data.stok_minimum);

            $('#detail_deskripsi').val(data.deskripsi);

            $('#modal_detail_barang').modal('show');

        }
    });

});

    /* =========================================
       SHOW EDIT
    ========================================= */

   $('body').on('click', '#button_edit_barang', function () {

    let id = $(this).data('id');

    if (!id) return;

    $.ajax({
        url: `/barang/${id}/edit`,
        type: "GET",
        success: function (res) {

            if (!res || !res.data) return;

            let data = res.data;

            $('#barang_id').val(data.id);

            $('#edit_nama_barang').val(data.nama_barang);

            $('#edit_jenis_id').val(data.jenis_id).trigger('change');

            $('#edit_satuan_id').val(data.satuan_id).trigger('change');

            $('#edit_stok_minimum').val(data.stok_minimum);

            $('#edit_deskripsi').val(data.deskripsi);

            /* =========================
               IMAGE (TIDAK DIUBAH LOGICNYA)
            ========================= */

            let imgPath = '/storage/' + data.gambar;

            $('#edit_gambar_preview')
                .attr('src', imgPath)
                .removeClass('d-none');

            $('#edit_placeholder').hide();

            // JANGAN RESET FILE INPUT (INI YANG BIKIN BUG)
            // $('#edit_gambar').val('');

            // kalau user tidak upload baru, biarkan tetap pakai lama
            $('#edit_gambar').data('existing-image', imgPath);

            // optional: kalau kamu masih pakai function ini
            if (typeof setEditImage === 'function') {
                setEditImage(imgPath);
            }

            /* SHOW MODAL */
            $('#modal_edit_barang').modal('show');

        },
        error: function (xhr) {
            console.error('Edit fetch error:', xhr.responseText);
        }
    });

});
    /* =========================================
       UPDATE DATA
    ========================================= */

  $('#update').on('click', function (e) {

    e.preventDefault();

    clearValidation();

    let barang_id = $('#barang_id').val();

    if (!barang_id) {
        Swal.fire({
            icon: 'error',
            title: 'ID barang tidak ditemukan'
        });
        return;
    }

    let formData = new FormData();

    let fileInput = $('#edit_gambar')[0].files[0];

    // hanya kirim kalau ada file baru
    if (fileInput) {
        formData.append('gambar', fileInput);
    }

    formData.append('nama_barang', $('#edit_nama_barang').val());
    formData.append('stok_minimum', $('#edit_stok_minimum').val());
    formData.append('deskripsi', $('#edit_deskripsi').val());
    formData.append('jenis_id', $('#edit_jenis_id').val());
    formData.append('satuan_id', $('#edit_satuan_id').val());

    formData.append('_token', $("meta[name='csrf-token']").attr("content"));
    formData.append('_method', 'PUT');

    $.ajax({
        url: `/barang/${encodeURIComponent(barang_id)}`,
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

            loadDataBarang();

            $('#modal_edit_barang').modal('hide');
        },

        error: function (error) {
            showValidationError(error);
        }
    });

});

    /* =========================================
       DELETE DATA
    ========================================= */

    $('body').on('click', '#button_hapus_barang', function () {

        let barang_id = $(this).data('id');

        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({

            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',

            showCancelButton: true,

            cancelButtonText: 'TIDAK',

            confirmButtonText: 'YA, HAPUS!'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: `/barang/${barang_id}`,

                    type: "DELETE",

                    cache: false,

                    data: {
                        "_token": token
                    },

                    success: function (response) {

                        Swal.fire({

                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000

                        });

                        loadDataBarang();

                    }

                });

            }

        });

    });

    function previewImageEdit(event) {

        const file = event.target.files[0];

        if (!file) return;

        const preview = document.getElementById('edit_preview');

        preview.src = URL.createObjectURL(file);

        preview.classList.remove('d-none');

        $('#edit_placeholder').hide();

    }
</script>
<script>

    function previewImage(event) {

        const file =
            event.target.files[0];

        if (!file) return;

        const preview =
            document.getElementById('preview');

        preview.src =
            URL.createObjectURL(file);

        preview.classList.remove('d-none');

        $('.modern-upload-placeholder').hide();

    }

</script>
<script>
    $('.modern-modal-close, #button_tambah_barang').on('click', function () {

        resetModalBarang();

    });
    $('#modal_tambah_barang').on('hidden.bs.modal', function () {

        resetModalBarang();

    });

    function resetModalBarang() {

        $('#gambar').val('');

        $('#preview')
            .attr('src', '')
            .addClass('d-none');

        $('.modern-upload-placeholder').show();

        $('form')[0].reset();

        $('.alert')
            .removeClass('d-block')
            .addClass('d-none');

    }
    $('#modal_edit_barang').on('hidden.bs.modal', function () {

        $('#edit_gambar').val('');

        $('#edit_preview')
            .attr('src', '')
            .addClass('d-none');

        $('#edit_placeholder').show();

    });

function setEditImage(url) {

    const preview = $('#edit_preview');
    const placeholder = $('#edit_placeholder');

    if (url) {

        preview.attr('src', url)
               .removeClass('d-none');

        placeholder.hide();

    } else {

        preview.attr('src', '')
               .addClass('d-none');

        placeholder.show();

    }

}

$('#edit_upload_area').on('click', function (e) {

    // pastikan tidak trigger dari input sendiri
    if ($(e.target).is('input')) return;

    $('#edit_gambar')[0].click();

});

$('#edit_gambar').on('click', function (e) {
    e.stopPropagation();
});

let isOpeningFile = false;

$('#edit_upload_area').on('click', function (e) {

    if (isOpeningFile) return;

    isOpeningFile = true;

    $('#edit_gambar')[0].click();

    setTimeout(() => {
        isOpeningFile = false;
    }, 500);

});
</script>
@endsection


