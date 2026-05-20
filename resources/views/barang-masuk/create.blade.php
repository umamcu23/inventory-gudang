<div class="modal fade modern-modal"
     tabindex="-1"
     role="dialog"
     id="modal_tambah_barangMasuk">

    <div class="modal-dialog modal-lg modal-dialog-centered"
         role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">Tambah Barang Masuk</h5>
                    <small class="text-muted">Tambahkan transaksi barang masuk baru</small>
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

                    <div class="row">

                        <!-- LEFT -->
                        <div class="col-md-6">

                            <label class="modern-label">Tanggal Masuk</label>
                            <input type="date"
                                   class="form-control modern-input"
                                   name="tanggal_masuk"
                                   id="tanggal_masuk"
                                   placeholder="Pilih tanggal masuk">

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-tanggal_masuk"></div>


                            <label class="modern-label mt-3">Kode Transaksi</label>
                            <input type="text"
                                   class="form-control modern-input"
                                   name="kode_transaksi"
                                   id="kode_transaksi"
                                   readonly
                                   placeholder="Kode otomatis">

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-kode_transaksi"></div>


                            <label class="modern-label mt-3">Stok Saat Ini</label>
                            <input type="number"
                                   class="form-control modern-input"
                                   name="stok"
                                   id="stok"
                                   disabled
                                   placeholder="Stok barang">

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-stok"></div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-6">

                            <label class="modern-label">Pilih Barang</label>
                            <select class="js-example-basic-single form-control"
                                    name="nama_barang"
                                    id="nama_barang"
                                    style="width: 100%">

                                <option selected disabled>Pilih Barang</option>

                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->nama_barang }}">
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach

                            </select>

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-nama_barang"></div>


                            <label class="modern-label mt-3">Supplier</label>
                            <select class="form-control"
                                    name="supplier_id"
                                    id="supplier_id">

                                <option selected disabled>Pilih Supplier</option>

                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">
                                        {{ $supplier->supplier }}
                                    </option>
                                @endforeach

                            </select>

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-supplier_id"></div>


                            <label class="modern-label mt-3">Jumlah Masuk</label>
                            <div class="input-group">

                                <input type="number"
                                       class="form-control modern-input"
                                       name="jumlah_masuk"
                                       id="jumlah_masuk"
                                       min="0"
                                       placeholder="Masukkan jumlah masuk">

                                <input type="text"
                                       class="form-control"
                                       name="satuan"
                                       id="satuan_id"
                                       disabled
                                       placeholder="Satuan">

                            </div>

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-jumlah_masuk"></div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer modern-modal-footer">

                    <button type="button"
                            class="btn btn-light modern-btn"
                            data-dismiss="modal">

                        <i class="fa fa-times"></i>
                        Tutup

                    </button>

                    <button type="button"
                            class="btn btn-primary modern-btn-primary"
                            id="store">

                        <i class="fa fa-save"></i>
                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>