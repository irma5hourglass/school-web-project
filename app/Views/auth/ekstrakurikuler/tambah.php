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
            <?= form_open('ekstrakurikuler/simpan', ['class' => 'formtambah', 'enctype' => 'multipart/form-data']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-8 col-form-label">Nama Ekstrakurikuler</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama_ekstra" name="nama_ekstra">
                        <div class="invalid-feedback errorNamaekstra">

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control-file" id="gbr" name="gbr" required>
                    <div class="invalid-feedback errorGbr">Pilih Gambar.</div>
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
            let form = this;
            let formData = new FormData(form);
            let title = $('input#nama_ekstra').val();



            $.ajax({
                type: "post",
                url: $(form).attr('action'),
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
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
                        if (response.error.nama_ekstra) {
                            $('#nama_ekstra').addClass('is-invalid');
                            $('.errorNamaekstra').html(response.error.nama_ekstra);
                        } else {
                            $('#nama_ekstra').removeClass('is-invalid');
                            $('.errorNamaekstra').html('');
                        }
                        if (response.error.gbr) {
                            $('#gbr').addClass('is-invalid');
                            $('.errorGbr').html(response.error.gbr);
                        } else {
                            $('#gbr').removeClass('is-invalid');
                            $('.errorGbr').html('');
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
                        listekstra();
                    }
                }
            });
        })
    });
</script>