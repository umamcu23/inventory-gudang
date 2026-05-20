<div class="modal fade modern-modal" tabindex="-1" role="dialog" id="modal_edit_barang">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content modern-modal-content">

            <div class="modal-header modern-modal-header">

    <div class="d-flex flex-column">
        <h5 class="modal-title mb-0">Edit Barang</h5>
        <small class="text-muted">Perbarui data barang yang sudah ada</small>
    </div>

    <button type="button"
            class="modern-modal-close"
            data-dismiss="modal"
            aria-label="Close">

        <i class="fa fa-times"></i>

    </button>

</div>

            <form enctype="multipart/form-data">
<input type="hidden" id="barang_id">
                <div class="modal-body">

                    <div class="row">

                        <!-- LEFT IMAGE -->
                        <div class="col-lg-5">

    <div class="modern-upload-card">

        <label class="modern-label">
            Upload Gambar
        </label>

        <div class="modern-upload-area" id="edit_upload_area">
            <!-- INPUT -->
            <input type="file"
                   class="modern-input-file"
                   name="edit_gambar"
                   id="edit_gambar"
                   accept="image/*"
                   onchange="previewImageEdit(event)">

            <!-- PLACEHOLDER -->
            <div class="modern-upload-placeholder"
                 id="edit_placeholder">

                <i class="fa fa-cloud-upload-alt"></i>

                <span>Klik untuk ganti gambar</span>

                <small>PNG, JPG, JPEG</small>

            </div>

            <!-- IMAGE PREVIEW -->
            <img src=""
                 class="modern-image-preview d-none"
                 id="edit_preview">

        </div>

    </div>

</div>

                        <!-- RIGHT FORM -->
                        <div class="col-md-6">

                            <label class="modern-label">Nama Barang</label>
                            <input type="text"
                                   class="form-control modern-input"
                                   id="edit_nama_barang">

                            <label class="modern-label mt-2">Jenis</label>
                            <select class="form-control" name="jenis_id" id="edit_jenis_id">

                                @foreach ($jenis_barangs as $jenis)

                                    <option value="{{ $jenis->id }}">
                                        {{ $jenis->jenis_barang }}
                                    </option>

                                @endforeach

                            </select>

                            <label class="modern-label mt-2">Satuan</label>
                            <select class="form-control" name="satuan_id" id="edit_satuan_id">

                              @foreach ($satuans as $satuan)

                                  <option value="{{ $satuan->id }}">
                                      {{ $satuan->satuan }}
                                  </option>

                              @endforeach

                          </select>

                            <label class="modern-label mt-2">Stok Minimum</label>
                            <input type="number"
                                   class="form-control modern-input"
                                   id="edit_stok_minimum">

                            <label class="modern-label mt-2">Deskripsi</label>
                            <textarea class="form-control modern-input"
                                      id="edit_deskripsi"></textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer modern-modal-footer">

                    <button type="button"
                            class="btn btn-light modern-btn"
                            data-dismiss="modal">
                        <i class="fa fa-times mr-2"></i>
                        Tutup
                    </button>

                    <button type="button"
                            class="btn btn-primary modern-btn-primary"
                            id="update">
                        <i class="fa fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>