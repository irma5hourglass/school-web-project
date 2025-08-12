<?= $this->extend('front/layout/footer') ?>
<?= $this->section('navbar') ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="<?= base_url('') ?>#daruliman">Home</a></li>
        <li class="drop-down"><a href="#">Profil Sekolah</a>
            <ul>
                <li><a href="<?= base_url('home/profil/#deskripsi') ?>">Deskripsi Sekolah</a></li>
                <li><a href="<?= base_url('home/profil/#visimisi') ?>">Visi Misi</a></li>
                <li><a href="<?= base_url('home/profil/#keunggulan') ?>">Keunggulan Sekolah</a></li>
                <li><a href="<?= base_url('home/profil/#tujuan') ?>">Tujuan Sekolah</a></li>
            </ul>
        </li>
        <li><a href="<?= base_url('home/kumpulanstaf') ?>">Tenaga Kependidikan</a></li>
        <li class="active"><a href="<?= base_url('home/kumpulanberita') ?>">Berita</a></li>
        <li><a href="<?= base_url('home/kumpulangallery') ?>">Gallery</a></li>
        <li><a href="<?= base_url() ?>#ekstrakurikuler">Ekstrakurikuler</a></li>
        <li><a href="<?= base_url('') ?>#footer">Contact</a></li>
        <li><a href="<?= base_url('home/kumpulanpengumuman') ?>">Pengumuman</a></li> <!-- Added menu item for "Pengumuman" -->
    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>
<!-- ======= Cource Details Section ======= -->
<section id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">

        <div class="row ">
            <div class="col-lg-12 text-center">
                <img src="<?= base_url('img/berita/' . $berita->gambar) ?>" width="50%" class="img-fluid" alt="">
                <h3><?= $berita->judul_berita ?></h3>
                <p>
                    <?= $berita->isi ?>
                </p>
            </div>

        </div>

        <div class="col-lg-4 mx-auto">

            <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Tanggal</h5>
                <a href="#"> <?= date_indo($berita->tgl_berita) ?></a>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Kategori</h5>
                <p> <?= $berita->nama_kategori ?></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
                <h5>Post By</h5>
                <p> <?= $berita->nama ?></p>
            </div>


        </div>

        <div class="col-lg-12 text-center">
            <h5>Bagikan Berita</h5>
            <a href="http://www.facebook.com/sharer.php?u=<?= base_url('home/detail_berita/' . $berita->slug_berita) ?>" target="_blank" class="btn btn-primary"><i class="mdi mdi-facebook"></i> Facebook</a>
            <a href="http://twitter.com/share?url=<?= base_url('home/detail_berita/' . $berita->slug_berita) ?>" target="_blank" class="btn btn-info"><i class="mdi mdi-twitter"></i> Twitter</a>
            <a href="whatsapp://send?text=<?= base_url('home/detail_berita/' . $berita->slug_berita) ?>" target="_blank" data-action="share/whatsapp/share" class="btn btn-success"><i class="mdi mdi-whatsapp"></i> Whatsapp</a>
        </div>
    </div>
</section><!-- End Cource Details Section -->


<?= $this->endSection('isi') ?>