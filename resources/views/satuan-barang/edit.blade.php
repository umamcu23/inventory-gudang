<div class="modal fade modern-modal" id="modal_edit_satuan">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modern-modal-content">

            <!-- HEADER -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">
                        Edit Satuan Barang
                    </h5>

                    <small class="text-muted">
                        Perbarui data satuan barang
                    </small>
                </div>

                <button type="button"
                        class="modern-modal-close"
                        data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <input type="hidden" id="satuan_id">

                <label class="modern-label">
                    Nama Satuan
                </label>

                <input type="text"
                       class="form-control modern-input"
                       id="edit_satuan"
                       placeholder="Contoh: PCS, BOX, KG">

                <!-- helper text -->
                <small class="text-muted d-block mt-2">
                    Ubah nama satuan jika diperlukan
                </small>

                <div class="alert alert-danger d-none mt-2"
                     id="alert-satuan"></div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer modern-modal-footer">

                <button type="button"
                          class="btn btn-light modern-btn"
                          data-dismiss="modal">
                          <i class="fa fa-times mr-2"></i>
                          Tutup
                        </button>
                        
                <button type="button"
                        class="btn modern-btn-primary"
                        id="update">
                        <i class="fa fa-save mr-2"></i>
                    Simpan Perubahan
                </button>

            </div>

        </div>

    </div>

</div>