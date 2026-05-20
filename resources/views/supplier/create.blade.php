<div class="modal fade modern-modal"
     tabindex="-1"
     role="dialog"
     id="modal_tambah_supplier">

    <div class="modal-dialog modal-dialog-centered"
         role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">Tambah Supplier</h5>
                    <small class="text-muted">Tambahkan data supplier baru</small>
                </div>

                <button type="button"
                        class="modern-modal-close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>

            </div>

            <form enctype="multipart/form-data">

                <div class="modal-body">

                    <!-- NAMA PERUSAHAAN -->
                    <div class="form-group">
                        <label>Nama Perusahaan</label>

                        <input type="text"
                               class="form-control modern-input"
                               id="supplier"
                               placeholder="Masukkan nama perusahaan supplier">

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-supplier"></div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="form-group">
                        <label>Alamat</label>

                        <textarea class="form-control modern-input"
                                  id="alamat"
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap supplier"></textarea>

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-alamat"></div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer modern-modal-footer">

                    <button type="button"
                            class="btn btn-light modern-btn"
                            data-dismiss="modal">
                        <i class="fa fa-times"></i> Tutup
                    </button>

                    <button type="button"
                            class="btn btn-primary modern-btn-primary"
                            id="store">
                        <i class="fa fa-save"></i> Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>