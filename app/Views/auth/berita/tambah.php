<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('berita/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Berita</label>
                    <input type="text" class="form-control" id="judul_berita" name="judul_berita">
                    <div class="invalid-feedback errorJudul"></div>
                </div>

                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="js-example-basic-single" required>
                        <option disabled selected value="">Pilih</option>
                        <?php foreach ($kategori as $key => $data) { ?>
                            <option value="<?= $data['kategori_id'] ?>"><?= $data['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback errorKategori">
                        Pilih opsi kategori yang valid.
                    </div>
                </div>


                <div class="form-group">
                    <label>Isi</label>
                    <textarea type="text" class="form-control" id="isi" name="isi"></textarea>
                    <div class="invalid-feedback errorIsi"></div>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option disabled selected value="">Pilih</option>
                        <option value="published">Publish</option>
                        <option value="archived">Archive</option>
                    </select>
                    <div class="invalid-feedback errorStatus">
                        Pilih opsi status yang valid.
                    </div>
                </div>



                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" required>
                    <div class="invalid-feedback errorGambar">Pilih Gambar.</div>
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
        $('.formtambah').submit(function(e) {
            e.preventDefault();

            // Retrieve the necessary form values
            var title = $('input#judul_berita').val();
            var date = new Date().toISOString();
            var user_id = <?= $_SESSION['user_id']; ?>; // Replace with the actual user ID or fetch dynamically

            // Create a FormData object
            var formData = new FormData();

            // Append the image file to the FormData object
            formData.append('gambar', $('#gambar')[0].files[0]);

            // Append other form data to the FormData object
            formData.append('judul_berita', $('input#judul_berita').val());
            formData.append('slug_berita', title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''));
            formData.append('kategori_id', $('select#kategori_id').val());
            formData.append('isi', $('textarea#isi').val());
            formData.append('status', $('select#status').val());
            formData.append('tgl_berita', date);
            formData.append('user_id', user_id);

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                enctype: "multipart/form-data",
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.btnsimpan').attr('disabled', 'disabled');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disabled', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i> Simpan');
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
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaltambah').modal('hide');
                        listberita();
                    }
                }
            });

        })
    });
</script>