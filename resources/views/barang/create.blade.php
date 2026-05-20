<!-- =========================================
     MODAL TAMBAH BARANG - PREMIUM MODERN
========================================= -->

<div class="modal fade modern-modal" tabindex="-1" role="dialog" id="modal_tambah_barang">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content modern-modal-content">

            <!-- =========================================
                 HEADER
            ========================================= -->

            <div class="modal-header modern-modal-header">

                <div>

                    <h5 class="modern-modal-title">
                        <i class="fa fa-box-open mr-2"></i>
                        Tambah Barang
                    </h5>

                    <div class="modern-modal-subtitle">
                        Tambahkan data barang baru ke dalam sistem inventory
                    </div>

                </div>

                <button type="button"
                  class="modern-modal-close"
                  data-dismiss="modal"
                  aria-label="Close"
                  tabindex="-1">

                    <i class="fa fa-times"></i>

                </button>

            </div>

            <!-- =========================================
                 FORM
            ========================================= -->

            <form enctype="multipart/form-data">

                <div class="modal-body modern-modal-body">

                    <div class="row">

                        <!-- =========================================
                             LEFT SIDE
                        ========================================= -->

                        <div class="col-lg-5">

                            <div class="modern-upload-card">

                                <label class="modern-label">
                                    Upload Gambar
                                </label>

                                <div class="modern-upload-area">

                                    <input type="file"
                                        class="modern-input-file"
                                        name="gambar"
                                        id="gambar"
                                        onchange="previewImage(event)">

                                    <div class="modern-upload-placeholder">

                                        <i class="fa fa-cloud-upload-alt"></i>

                                        <span>
                                            Pilih gambar barang
                                        </span>

                                        <small>
                                            PNG, JPG, JPEG
                                        </small>

                                    </div>

                                    <img src="" class="modern-image-preview d-none" id="preview">
                                </div>

                                <div class="alert alert-danger modern-alert d-none"
                                    role="alert"
                                    id="alert-gambar">

                                </div>

                            </div>

                        </div>

                        <!-- =========================================
                             RIGHT SIDE
                        ========================================= -->

                        <div class="col-lg-7">

                            <!-- Nama Barang -->

                            <div class="form-group modern-form-group">

                                <label class="modern-label">
                                    Nama Barang
                                </label>

                                <input type="text"
                                    class="form-control modern-input"
                                    name="nama_barang"
                                    id="nama_barang"
                                    placeholder="Masukkan nama barang">

                                <div class="alert alert-danger modern-alert d-none"
                                    role="alert"
                                    id="alert-nama_barang">

                                </div>

                            </div>

                            <!-- Jenis Barang -->

                            <div class="form-group modern-form-group">

                                <label class="modern-label">
                                    Jenis Barang
                                </label>

                                <select class="form-control modern-select"
                                    name="jenis_id"
                                    id="jenis_id">

                                    @foreach ($jenis_barangs as $jenis)

                                        <option value="{{ $jenis->id }}">
                                            {{ $jenis->jenis_barang }}
                                        </option>

                                    @endforeach

                                </select>

                                <div class="alert alert-danger modern-alert d-none"
                                    role="alert"
                                    id="alert-jenis_id">

                                </div>

                            </div>

                            <!-- Satuan -->

                            <div class="form-group modern-form-group">

                                <label class="modern-label">
                                    Satuan Barang
                                </label>

                                <select class="form-control modern-select"
                                    name="satuan_id"
                                    id="satuan_id">

                                    @foreach ($satuans as $satuan)

                                        <option value="{{ $satuan->id }}">
                                            {{ $satuan->satuan }}
                                        </option>

                                    @endforeach

                                </select>

                                <div class="alert alert-danger modern-alert d-none"
                                    role="alert"
                                    id="alert-satuan_id">

                                </div>

                            </div>

                            <!-- Stok Minimum -->

                            <div class="form-group modern-form-group">

                                <label class="modern-label">
                                    Stok Minimum
                                </label>

                                <input type="number"
                                    class="form-control modern-input"
                                    name="stok_minimum"
                                    id="stok_minimum"
                                    placeholder="Masukkan stok minimum">

                                <div class="alert alert-danger modern-alert d-none"
                                    role="alert"
                                    id="alert-stok_minimum">

                                </div>

                            </div>

                            <!-- Deskripsi -->

                            <div class="form-group modern-form-group">

                                <label class="modern-label">
                                    Deskripsi
                                </label>

                                <textarea class="form-control modern-textarea"
                                    name="deskripsi"
                                    id="deskripsi"
                                    rows="5"
                                    placeholder="Masukkan deskripsi barang"></textarea>

                                <div class="alert alert-danger modern-alert d-none"
                                    role="alert"
                                    id="alert-deskripsi">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- =========================================
                     FOOTER
                ========================================= -->

                <div class="modal-footer modern-modal-footer">

                    <button type="button"
                        class="modern-btn modern-btn-secondary"
                        data-dismiss="modal">

                        <i class="fa fa-times mr-2"></i>
                        Tutup

                    </button>

                    <button type="button"
                        class="modern-btn modern-btn-primary"
                        id="store">

                        <i class="fa fa-save mr-2"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>