<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilkan Peta</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


</head>

<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Konfigurasi</a></li>
        <li class="breadcrumb-item active">Website</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>
<?= $this->section('isi') ?>
<div class="viewmodal">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <?= form_open_multipart('konfigurasi/submit', ['class' => 'formtambah']) ?>
                <div class="card-body">
                    <i class="mdi mdi-circle-edit-outline"></i> Konfigurasi Website
                    <hr>
                    <input type="hidden" class="form-control" id="konfigurasi_id" value="<?= $konfigurasi_id ?>" name="konfigurasi_id" readonly>
                    <div class="form-group">
                        <label> <i class="mdi mdi-text-shadow"></i>
                            Judul Halaman Website
                        </label>
                        <input type="text" id="nama_web" value="<?= esc($nama_web) ?>" name="nama_web" class="form-control">
                        <div class="invalid-feedback errorNama">
                        </div>
                    </div>

                    <div class="form-group">
                        <label> <i class=" mdi mdi-playlist-star"></i>
                            Deskripsi
                        </label>
                        <textarea type="text" id="deskripsi" name="deskripsi" class="summernote-editor"><?= esc($deskripsi) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label> <i class="mdi mdi-chevron-triple-up"></i>
                            Visi
                        </label>
                        <textarea type="text" id="visi" name="visi" class="summernote-editor"> <?= esc($visi) ?></textarea>

                    </div>

                    <div class="form-group">
                        <label> <i class="mdi mdi-chevron-triple-up"></i>
                            Misi
                        </label>
                        <textarea type="text" id="misi" name="misi" class="summernote-editor"> <?= esc($misi) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label> <i class=" mdi mdi-playlist-star"></i>
                            Tujuan
                        </label>
                        <textarea type="text" id="tujuan" name="tujuan" class="summernote-editor"><?= esc($tujuan) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label> <i class=" mdi mdi-playlist-star"></i>
                            Keunggulan Sekolah
                        </label>
                        <textarea type="text" id="keunggulan" name="keunggulan" class="summernote-editor"><?= esc($keunggulan) ?></textarea>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label> <i class="mdi mdi-instagram"></i>
                                Instagram
                            </label>
                            <input type="text" id="instagram" name="instagram" value="<?= esc($instagram) ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label> <i class="mdi mdi-facebook"></i>
                                Facebook
                            </label>
                            <input type="text" id="facebook" name="facebook" value="<?= esc($facebook) ?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label> <i class="mdi mdi-whatsapp"></i>
                                Whatsapp
                            </label>
                            <input type="text" id="whatsapp" name="whatsapp" value="<?= esc($whatsapp) ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <label> <i class="mdi mdi-email"></i>
                                Email
                            </label>
                            <input type="text" id="email" name="email" value="<?= esc($email) ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label> <i class="mdi mdi-office-building"></i>
                            Alamat
                        </label>
                        <input type="text" id="alamat" name="alamat" value="<?= esc($alamat) ?>" class="form-control">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <!-- Logo Website -->
                            <br>
                            <i class="mdi mdi-image-filter-hdr"></i> Logo Website <br>
                            <div class="custom-file">
                                <div>
                                    <img id="preview" src="<?= base_url('img/konfigurasi/logo/' . $logo) ?>" alt="Gambar Sebelumnya" style="max-width: 200px; margin-bottom: 10px;">
                                </div>
                                <input type="file" class="form-control" id="logo" name="logo" onchange="previewImage(event)">
                                <small class="form-text text-danger"><?= $error['logo'] ?? '' ?></small>
                            </div> <br>
                            <div class="invalid-feedback errorLogo"></div>
                        </div>

                        <!-- Icon Website -->
                        <div class="form-group col-md-6 col-12">
                            <br>
                            <i class="mdi mdi-image-filter-hdr"></i> Icon Website <br>
                            <div class="custom-file">
                                <div>
                                    <img id="preview" src="<?= base_url('img/konfigurasi/icon/' . $icon) ?>" alt="Gambar Sebelumnya" style="max-width: 200px; margin-bottom: 10px;">
                                </div>
                                <input type="file" class="form-control" id="icon" name=" icon" onchange="previewImage(event)">
                                <small class="form-text text-danger"><?= $error['icon'] ?? '' ?></small>
                            </div>
                            <div class="invalid-feedback errorIcon"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> <i class="mdi mdi-office-building"></i>
                            Maps
                        </label>
                        <input type="text" id="maps" name="maps" value="<?= esc($maps) ?>" class="form-control">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <button class="btn btn-primary btnsimpan"><i class="fa fa-paper-plane"></i> Update</button>
                        </div>
                    </div>
                </div>

                <?= form_close() ?>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass('selected').html(fileName);
            });
            $(document).ready(function() {
                $('.summernote-editor').summernote({
                    height: 100,
                    minHeight: null,
                    maxHeight: null,
                    focus: true
                });
            });

            $('.formtambah').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var formData = new FormData(this);

                // Append logo and icon files if selected
                var logoFile = $('#logo')[0].files[0];
                if (logoFile) {
                    formData.append('logo', logoFile);
                }

                var iconFile = $('#icon')[0].files[0];
                if (iconFile) {
                    formData.append('icon', iconFile);
                }

                var additionalData = {
                    konfigurasi_id: $('input#konfigurasi_id').val(),
                    nama_web: $('input#nama_web').val(),
                    deskripsi: $('textarea#deskripsi').val(),
                    visi: $('textarea#visi').val(),
                    misi: $('textarea#misi').val(),
                    keunggulan: $('textarea#keunggulan').val(),
                    tujuan: $('textarea#tujuan').val(),
                    instagram: $('input#instagram').val(),
                    facebook: $('input#facebook').val(),
                    whatsapp: $('input#whatsapp').val(),
                    email: $('input#email').val(),
                    alamat: $('input#alamat').val(),
                    maps: $('input#maps').val(),

                };

                // Merge additionalData into formData
                Object.keys(additionalData).forEach(function(key) {
                    formData.append(key, additionalData[key]);
                });

                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    dataType: "json",
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.btnsimpan').attr('disable', 'disable');
                        $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                    },
                    complete: function() {
                        $('.btnsimpan').removeAttr('disable', 'disable');
                        $('.btnsimpan').html('<i class="fa fa-paper-plane"></i> Update');
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
            $('input#icon').change(function(event) {
                var output = document.getElementById('preview');
                output.src = URL.createObjectURL(event.target.files[0]);
            });
            $('input#logo').change(function(event) {
                var output = document.getElementById('preview');
                output.src = URL.createObjectURL(event.target.files[0]);
            });
        });
    </script>

    <?= $this->endSection('isi') ?>