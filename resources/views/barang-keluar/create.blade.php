<div class="modal fade modern-modal"
     tabindex="-1"
     role="dialog"
     id="modal_tambah_barangKeluar">

    <div class="modal-dialog modal-lg modal-dialog-centered"
         role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">Tambah Barang Keluar</h5>
                    <small class="text-muted">Input data barang keluar</small>
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

                            <label class="modern-label">Tanggal Keluar</label>
                            <input type="date"
                                   class="form-control modern-input"
                                   name="tanggal_keluar"
                                   id="tanggal_keluar"
                                   placeholder="Pilih tanggal keluar">

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-tanggal_keluar"></div>


                            <label class="modern-label mt-3">Kode Transaksi</label>
                            <input type="text"
                                   class="form-control modern-input"
                                   name="kode_transaksi"
                                   id="kode_transaksi"
                                   readonly
                                   placeholder="Auto generate kode">

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
                            <select class="form-control modern-input js-example-basic-single"
                                    name="nama_barang"
                                    id="nama_barang"
                                    style="width:100%">

                                <option value="">Pilih Barang</option>

                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->nama_barang }}">
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach

                            </select>

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-nama_barang"></div>


                            <label class="modern-label mt-3">Customer</label>
                            <select class="form-control modern-input"
                                    name="customer_id"
                                    id="customer_id">

                                <option value="">Pilih Customer</option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->customer }}
                                    </option>
                                @endforeach

                            </select>

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-customer_id"></div>


                            <label class="modern-label mt-3">Jumlah Keluar</label>
                            <div class="input-group">

                                <input type="number"
                                       class="form-control modern-input"
                                       name="jumlah_keluar"
                                       id="jumlah_keluar"
                                       min="0"
                                       placeholder="Jumlah barang">

                                <input type="text"
                                       class="form-control modern-input"
                                       id="satuan_id"
                                       disabled
                                       placeholder="Satuan">

                            </div>

                            <div class="alert alert-danger mt-2 d-none"
                                 id="alert-jumlah_keluar"></div>

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