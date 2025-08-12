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
<section id="berita" class="courses">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Berita</h2>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php foreach ($berita as $data) : ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <img src="<?= base_url('img/berita/thumb/' . "thumb_"  . $data['gambar']) ?>" width="200%" height="200%" class="img-thumbnail" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4><?= $data['nama_kategori'] ?></h4>
                            </div>
                            <h6><?= date_indo($data['tgl_berita']) ?></h6>
                            <h3><a href="<?= base_url('home/detail_berita/' . $data['slug_berita']) ?>"><?= $data['judul_berita'] ?></a></h3>
                            <p><?= substr(strip_tags($data['isi']), 0, 150) ?>...</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="<?= base_url('public/img/user/' . $data['foto']) ?>" class="img-fluid" alt="">
                                    <span><?= $data['nama'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?= $this->endSection('isi') ?>