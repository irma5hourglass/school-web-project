<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('berita/update', ['class' => 'formberita']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="berita_id" value="<?= $berita_id ?>" name="berita_id" readonly>
                    <label>Judul Berita</label>
                    <input type="text" class="form-control" id="judul_berita" value="<?= $judul_berita ?>" name="judul_berita">
                    <div class="invalid-feedback errorJudul">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="js-example-basic-single">
                        <option Disabled=true Selected=true></option>
                        <?php foreach ($kategori as $key => $data) { ?>
                            <option value="<?= $data['kategori_id'] ?>" <?php if ($data['kategori_id'] == $kategori_id) echo "selected"; ?>><?= $data['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback errorKategori">
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi</label>
                    <textarea type="text" class="form-control" id="isi" name="isi"> <?= $isi ?></textarea>
                    <div class="invalid-feedback errorIsi">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="published" <?php if ($status == 'published') echo "selected"; ?>>Published</option>
                        <option value="archived" <?php if ($status == 'archived') echo "selected"; ?>>Archived</option>
                    </select>
                    <div class="invalid-feedback errorStatus">
                    </div>
                </div>

                <div class="form-group">
                    <label>Foto</label>
                    <div class="custom-file">
                        <label for="gambar">Gambar</label>
                        <div>
                            <img id="preview" src="<?= base_url('img/berita/thumb/' . 'thumb_' . $gambar) ?>" alt="img" style="max-width: 200px; margin-bottom: 10px;">
                        </div>
                        <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage(event)">
                        <small class="form-text text-danger"><?= $error['gambar'] ?? '' ?></small>
                    </div>
                    <div class="invalid-feedback errorGambar">
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
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('textarea#isi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.formberita').submit(function(e) {
            e.preventDefault();
            let title = $('input#judul_berita').val();
            var formData = new FormData(this);
            var gambar = $('input#gambar')[0].files[0];
            formData.append('gambar', gambar);

            // Additional data to be sent
            var additionalData = {
                berita_id: $('input#berita_id').val(),
                judul_berita: $('input#judul_berita').val(),
                slug_berita: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
                kategori_id: $('select#kategori_id').val(),
                isi: $('textarea#isi').val(),
                status: $('select#status').val(),
                tgl_berita: date,
                user_id: user_id
            };

            // Merge additional data with formData
            Object.keys(additionalData).forEach(function(key) {
                formData.append(key, additionalData[key]);
            });

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.btnsimpan').attr('disabled', 'disabled');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disabled');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.judul_berita) {
                            $('#judul_berita').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_berita);
                        } else {
                            $('#judul_berita').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                        if (response.error.kategori_id) {
                            $('#kategori_id').addClass('is-invalid');
                            $('.errorKategori').html(response.error.kategori_id);
                        } else {
                            $('#kategori_id').removeClass('is-invalid');
                            $('.errorKategori').html('');
                        }

                        if (response.error.isi) {
                            $('#isi').addClass('is-invalid');
                            $('.errorIsi').html(response.error.isi);
                        } else {
                            $('#isi').removeClass('is-invalid');
                            $('.errorIsi').html('');
                        }

                        if (response.error.status) {
                            $('#status').addClass('is-invalid');
                            $('.errorStatus').html(response.error.status);
                        } else {
                            $('#status').removeClass('is-invalid');
                            $('.errorStatus').html('');
                        }

                        if (response.error.gambar) {
                            $('#gambar').addClass('is-invalid');
                            $('.errorGambar').html(response.error.gambar);
                        } else {
                            $('#gambar').removeClass('is-invalid');
                            $('.errorGambar').html('');
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.success,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaledit').modal('hide');
                        listberita();
                    }
                }
            });
        });

        $('input#gambar').change(function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        });
    });
</script>