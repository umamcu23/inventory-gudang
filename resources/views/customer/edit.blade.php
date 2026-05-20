<div class="modal fade modern-modal"
     tabindex="-1"
     role="dialog"
     id="modal_edit_customer">

    <div class="modal-dialog modal-dialog-centered"
         role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">Edit Customer</h5>
                    <small class="text-muted">Perbarui data customer yang sudah ada</small>
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

                    <input type="hidden" id="customer_id">

                    <!-- CUSTOMER -->
                    <div class="form-group">
                        <label>Nama Customer</label>
                        <input type="text"
                               class="form-control modern-input"
                               id="edit_customer"
                               placeholder="Masukkan nama customer">

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-customer"></div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control modern-input"
                                  id="edit_alamat"
                                  rows="3"
                                  placeholder="Masukkan alamat customer"></textarea>

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
                            id="update">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>