<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('konfigurasi/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="user_id" value="<?= $user_id ?>" name="user_id" readonly>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" value="<?= $username ?>" name=" username">
                    <div class="invalid-feedback errorUser">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="<?= $nama ?>" id="nama" name="nama">
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="<?= $email ?>" id="email" name="email">
                    <div class="invalid-feedback errorEmail">
                    </div>
                </div>


                <div class="form-group">
                    <label>Password <br> <small>*Masukkan password baru jika ingin mengganti password.</small></label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <div class="invalid-feedback errorPass">
                </div>




                <div class="form-group">
                    <label>Level</label>
                    <select name="level" id="level" class="form-control">
                        <option value="2" <?php if ($level == '2') echo "selected"; ?>>Admin</option>
                        <option value="1" <?php if ($level == '1') echo "selected"; ?>>Author</option>
                    </select>
                    <div class="invalid-feedback errorLevel">
                    </div>
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <div class="custom-file">
                        <div>
                            <img id="preview" src="<?= base_url('img/user/' . $foto) ?>" alt="foto Sebelumnya" style="max-width: 200px; margin-bottom: 10px;">
                        </div>
                        <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(event)">
                        <small class="form-text text-danger"><?= $error['foto'] ?? '' ?></small>
                    </div>
                    <div class="invalid-feedback errorFoto">
                    </div>
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
        $('.formedit').submit(function(e) {
            e.preventDefault();
            let title = $('input#judul_berita').val();
            var formData = new FormData(this);
            var foto = $('#foto')[0].files[0];
            formData.append('foto', foto);

            var additionalData = {
                username: $('input#username').val(),
                nama: $('input#nama').val(),
                email: $('input#email').val(),
                password: $('input#password').val(),
                level: $('select#level').val(),
                active: '0'
            };

            Object.keys(additionalData).forEach(function(key) {
                formData.append(key, additionalData[key]);
            });
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                enctype: 'multipart/form-data',
                cache: false,
                processData: false,
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
                        $('#modaledit').modal('hide');
                        listuser();
                    }
                }
            });
        });
        $('input#foto').change(function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        });
    });
</script>