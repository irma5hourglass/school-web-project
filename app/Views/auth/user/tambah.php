<!DOCTYPE html>
<html>

<head>
    <!-- Tambahkan tautan ke font awesome CSS di sini -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                    <div class="invalid-feedback errorUser">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                    <div class="invalid-feedback errorEmail">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password </label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="password" name="password">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword" onclick="togglePasswordVisibility()"></i>
                            </span>
                        </div>
                    </div>
                    <div class="invalid-feedback errorPass">
                    </div>
                </div>


                <div class="form-group">
                    <label>Level</label>
                    <select name="level" id="level" class="form-control" required>
                        <option Disabled=true Selected=true>Pilih</option>
                        <option value="2">Admin</option>
                        <option value="1">Author</option>
                    </select>
                    <div class="invalid-feedback errorLevel">
                    </div>
                </div>
                <div class="form-group">
                    <label>Foto</label>

                    <input type="file" class="form-control-file" id="foto" name="foto" required>
                    <div class="invalid-feedback errorFoto">Pilih foto.</div>
                </div>
                <div class="invalid-feedback errorFoto">
                </div>
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            var data = new FormData(this);
            var foto = $('#foto')[0].files[0];
            data.append('foto', foto);
            //  data.append('foto', foto);

            var additionalData = {
                username: $('input#username').val(),
                nama: $('input#nama').val(),
                email: $('input#email').val(),
                password: $('input#password').val(),
                level: $('select#level').val(),
                active: '0'
            };

            Object.keys(additionalData).forEach(function(key) {
                data.append(key, additionalData[key]);
            });
            $.ajax({
                type: "post",
                url: '<?= site_url('konfigurasi/simpanuser') ?>',
                data: data,
                enctype: 'multipart/form-data',
                dataType: "json",
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('.errorUser').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('.errorUser').html('');
                        }

                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }

                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.errorEmail').html('');
                        }

                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('.errorPass').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('.errorPass').html('');
                        }

                        if (response.error.level) {
                            $('#level').addClass('is-invalid');
                            $('.errorLevel').html(response.error.level);
                        } else {
                            $('#level').removeClass('is-invalid');
                            $('.errorLevel').html('');
                        }
                        if (response.error.foto) {
                            $('#foto').addClass('is-invalid');
                            $('.errorFoto').html(response.error.foto);
                        } else {
                            $('#foto').removeClass('is-invalid');
                            $('.errorFoto').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaltambah').modal('hide');
                        listuser();
                    }
                }
            });
        })
    });
</script>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>