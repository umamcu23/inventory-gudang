<div class="modal fade modern-modal" tabindex="-1" role="dialog" id="modal_detail_barang">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER (SAMAIN CREATE/EDIT) -->
            <div class="modal-header modern-modal-header">
                <h5 class="modal-title">
                    Detail Barang
                </h5>

                <button type="button"
                        class="close modern-modal-close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <!-- IMAGE (SAMAIN CREATE/EDIT STYLE) -->
                    <div class="col-md-5">

                        <div class="modern-upload-card">

                            <label class="modern-label">
                                Gambar Barang
                            </label>

                            <div class="modern-upload-area">

                                <img id="detail_gambar_preview"
                                     class="modern-image-preview"
                                     src="">
                            </div>

                        </div>

                    </div>

                    <!-- FORM -->
                    <div class="col-md-7">

                        <div class="form-group">
                            <label class="modern-label">Nama Barang</label>
                            <input type="text"
                                   class="form-control modern-input detail-readonly"
                                   id="detail_nama_barang"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label class="modern-label">Jenis Barang</label>
                            <select class="form-control modern-input detail-readonly"
                                    id="detail_jenis_id"
                                    disabled>
                                @foreach ($jenis_barangs as $jenis)
                                    <option value="{{ $jenis->id }}">
                                        {{ $jenis->jenis_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="modern-label">Satuan Barang</label>
                            <select class="form-control modern-input detail-readonly"
                                    id="detail_satuan_id"
                                    disabled>
                                @foreach ($satuans as $satuan)
                                    <option value="{{ $satuan->id }}">
                                        {{ $satuan->satuan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="modern-label">Stok Saat Ini</label>
                            <input type="text"
                                   class="form-control modern-input detail-readonly"
                                   id="detail_stok"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label class="modern-label">Stok Minimum</label>
                            <input type="number"
                                   class="form-control modern-input detail-readonly"
                                   id="detail_stok_minimum"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label class="modern-label">Deskripsi</label>
                            <textarea class="form-control modern-input detail-readonly"
                                      id="detail_deskripsi"
                                      rows="3"
                                      disabled></textarea>
                        </div>

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

            </div>

        </div>

    </div>

</div>