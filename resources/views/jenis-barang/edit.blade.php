<div class="modal fade modern-modal" tabindex="-1" role="dialog" id="modal_edit_jenis_barang">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER (SAMA KAYAK EDIT BARANG) -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">Edit Jenis Barang</h5>
                    <small class="text-muted">Perbarui data jenis barang</small>
                </div>

                <button type="button"
                        class="modern-modal-close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <i class="fa fa-times"></i>

                </button>

            </div>

            <form>

                <div class="modal-body">

                    <input type="hidden" id="jenis_id">

                    <div class="row">

                        <div class="col-lg-12">

                            <label class="modern-label">
                                Nama Jenis Barang
                            </label>

                            <input type="text"
                                   class="form-control modern-input"
                                   id="edit_jenis_barang"
                                   placeholder="Masukkan nama jenis barang">

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-jenis_barang">
                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER (SAMA KAYAK EDIT BARANG) -->
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

            </form>

        </div>

    </div>

</div>