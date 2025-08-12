<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('gallery/simpan', ['class' => 'formtambah', 'enctype' => 'multipart/form-data']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Gallery</label>
                    <input type="text" class="form-control" id="nama_gallery" name="nama_gallery">
                    <div class="invalid-feedback errorNama"></div>
                </div>

                <div class="form-group">
                    <label>Upload Sampul</label>
                    <input type="file" class="form-control-file" id="sampul" name="sampul" required>
                    <div class="invalid-feedback errorSampul">Pilih Gambar</div>
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
            let title = $('input#nama_gallery').val();
            e.preventDefault();
            var user_id = <?= $_SESSION['user_id']; ?>;
            let formData = new FormData(this); // Create a new FormData object
            formData.append('slug_gallery', title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''));
            formData.append('tgl_gallery', date); // Replace with the appropriate value
            formData.append('sampul', $('#sampul')[0].files[0]); // Get the selected image file
            formData.append('user_id', user_id); // Replace with the appropriate value

            $.ajax({
                type: "post",

                url: $(this).attr('action'),
                data: formData, // Use the FormData object for data
                enctype: "multipart/form-data",
                dataType: "json",
                processData: false, // Prevent jQuery from processing the data
                cache: false, // Prevent jQuery from setting content type
                contentType: false, // Prevent jQuery from setting content type
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
                        if (response.error.nama_gallery) {
                            $('#nama_gallery').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama_gallery);
                        } else {
                            $('#nama_gallery').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.sampul) {
                            $('#sampul').addClass('is-invalid');
                            $('.errorSampul').html(response.error.sampul);
                        } else {
                            $('#sampul').removeClass('is-invalid');
                            $('.errorSampul').html('');
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
                        listgallery();
                    }
                }
            });
        })
    });
</script>