<div class="modal fade modern-modal"
     tabindex="-1"
     role="dialog"
     id="modal_tambah_pengguna">

    <div class="modal-dialog modal-dialog-centered"
         role="document">

        <div class="modal-content modern-modal-content">

            <!-- HEADER -->
            <div class="modal-header modern-modal-header">

                <div class="d-flex flex-column">
                    <h5 class="modal-title mb-0">Tambah Pengguna</h5>
                    <small class="text-muted">Tambahkan data pengguna baru</small>
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

                    <!-- NAMA -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text"
                               class="form-control modern-input"
                               name="name"
                               id="name"
                               placeholder="Masukkan nama pengguna">

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-name"></div>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email"
                               class="form-control modern-input"
                               name="email"
                               id="email"
                               placeholder="Masukkan email pengguna">

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-email"></div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                               class="form-control modern-input"
                               name="password"
                               id="password"
                               placeholder="Masukkan password">

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-password"></div>
                    </div>

                    <!-- ROLE -->
                    <div class="form-group">
                        <label>Pilih Role</label>

                        <select class="form-control modern-input"
                                name="role_id"
                                id="role_id"
                                style="width: 100%">

                            <option value="">Pilih Role</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->role }}
                                </option>
                            @endforeach

                        </select>

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-role_id"></div>
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
                        <i class="fa fa-save"></i> Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>