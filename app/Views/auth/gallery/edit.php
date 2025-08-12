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
            <?= form_open_multipart('gallery/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="gallery_id" value="<?= $gallery_id ?>" name="gallery_id" readonly>
                <div class="form-group">
                    <label>Nama Gallery</label>
                    <input type="text" class="form-control" id="nama_gallery" value="<?= $nama_gallery ?>" name="nama_gallery">
                    <div class="invalid-feedback errorNama">
                    </div>
                </div>

                <div class="form-group">

                    <div class="custom-file">
                        <label for="sampul">Sampul</label>
                        <div>
                            <img id="preview" src="<?= base_url('img/sampul/thumb/' . 'thumb_' . $sampul) ?>" alt="img" style="max-width: 200px; margin-bottom: 10px;">
                        </div>
                        <input type="file" class="form-control" id="sampul" name="sampul" onchange="previewImage(event)">
                        <small class="form-text text-danger"><?= $error['sampul'] ?? '' ?></small>
                    </div>
                    <div class="invalid-feedback errorSampul">
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
        $('.formedit').submit(function(e) {
            e.preventDefault();
            let title = $('input#nama_gallery').val();
            var user_id = <?= $_SESSION['user_id']; ?>;
            let formData = new FormData(this); // Create a new FormData object
            formData.append('slug_gallery', title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''));
            formData.append('tgl_gallery', date); // Replace with the appropriate value
            formData.append('sampul', $('input#sampul')[0].files[0]); // Get the selected image file
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
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
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

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaledit').modal('hide');
                        listgallery();
                    }
                }
            });
        });
        $('input#sampul').change(function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        });
    });
</script>