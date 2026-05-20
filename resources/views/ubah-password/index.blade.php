@extends('layouts.app')

@section('content')
<div class="row">

    <!-- HEADER -->
    <div class="col-12">
        <div class="modern-table-card mb-3">

            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon warning">
                        <i class="fa fa-lock"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">Ubah Password</h5>
                        <p class="modern-table-subtitle">
                            Pastikan menggunakan password yang kuat dan mudah diingat
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- FORM -->
    <div class="col-lg-6 col-md-8 col-12 mx-auto">

        <div class="modern-table-card">

            <div class="card-body p-4">

                <form action="/ubah-password" method="POST" id="ubahPassword">

                    @method('put')
                    @csrf

                    <!-- PASSWORD LAMA -->
                    <div class="form-group mb-3">
                        <label>Password Lama</label>
                        <input type="password"
                               class="form-control modern-input"
                               id="current_password"
                               name="current_password"
                               placeholder="Masukkan password lama"
                               required>

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-current_password"></div>
                    </div>

                    <!-- PASSWORD BARU -->
                    <div class="form-group mb-3">
                        <label>Password Baru</label>
                        <input type="password"
                               class="form-control modern-input"
                               id="passwordNew"
                               name="passwordNew"
                               placeholder="Masukkan password baru"
                               required>

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-passwordNew"></div>
                    </div>

                    <!-- KONFIRMASI -->
                    <div class="form-group mb-4">
                        <label>Konfirmasi Password</label>
                        <input type="password"
                               class="form-control modern-input"
                               id="konfirmasiPassword"
                               name="konfirmasiPassword"
                               placeholder="Ulangi password baru"
                               required>

                        <div class="alert alert-danger mt-2 d-none"
                             id="alert-konfirmasiPassword"></div>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn modern-btn-primary">
                            <i class="fa fa-key"></i> Reset Password
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('#ubahPassword').submit(function(e){
        e.preventDefault();

        let current_password    = $('#current_password').val();            
        let passwordNew         = $('#passwordNew').val();            
        let konfirmasiPassword  = $('#konfirmasiPassword').val();
        let token               = $("meta[name='csrf-token']").attr("content");

        let formData = new FormData();
        formData.append('current_password', current_password);
        formData.append('passwordNew', passwordNew);
        formData.append('konfirmasiPassword', konfirmasiPassword);
        formData.append('_token', token);

        $.ajax({
            url: '/ubah-password',
            type: "POST",
            cache: false,
            data: formData,
            contentType: false,
            processData: false,

            success:function(response){
                $('#current_password').val('');
                $('#passwordNew').val('');
                $('#konfirmasiPassword').val('');

                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: true,
                    timer: 3000
                });
            },
            error:function(error){
                if (error.responseJSON && error.responseJSON.current_password) {
                    $('#alert-current_password').removeClass('d-none');
                    $('#alert-current_password').addClass('d-block');

                    $('#alert-current_password').text(error.responseJSON.current_password);
                }

                if (error.responseJSON && error.responseJSON.passwordNew) {
                    $('#alert-passwordNew').removeClass('d-none');
                    $('#alert-passwordNew').addClass('d-block');

                    $('#alert-passwordNew').text(error.responseJSON.passwordNew);
                }

                if (error.responseJSON && error.responseJSON.konfirmasiPassword) {
                    $('#alert-konfirmasiPassword').removeClass('d-none');
                    $('#alert-konfirmasiPassword').addClass('d-block');

                    $('#alert-konfirmasiPassword').text(error.responseJSON.konfirmasiPassword);
                }
            }
        });
    });
});
</script>

@endpush