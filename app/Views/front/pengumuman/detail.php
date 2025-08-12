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
        <li><a href="<?= base_url('home/kumpulanberita') ?>">Berita</a></li>
        <li><a href="<?= base_url('home/kumpulangallery') ?>">Gallery</a></li>
        <li><a href="<?= base_url() ?>#ekstrakurikuler">Ekstrakurikuler</a></li>
        <li><a href="<?= base_url('') ?>#footer">Contact</a></li>
        <li class="active"><a href="<?= base_url('home/kumpulanpengumuman') ?>">Pengumuman</a></li> <!-- Added menu item for "Pengumuman" -->
    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>
<!-- ======= Detail Pengumuman Section ======= -->
<section id="detail-pengumuman" class="detail-pengumuman">
    <div class="container" data-aos="fade-up">
        <div class="row">

            <div class="col-lg-8">

                <div class="default-image"></div>
                <h3><?= $pengumuman['judul_pengumuman'] ?></h3>
                <p>
                    <?= $pengumuman['isi_pengumuman'] ?>
                </p>
            </div>
            <div class="col-lg-4">
                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Tanggal</h5>
                    <p><a href="#"> <?= date_indo($pengumuman['tanggal']) ?></a></p>
                </div>

                <div class="text-center">
                    <h5>Bagikan Pengumuman</h5>
                    <a href="http://www.facebook.com/sharer.php?u=<?= base_url('home/detail_pengumuman/' . $pengumuman['pengumuman_id']) ?>" target="_blank" class="btn btn-primary"><i class="mdi mdi-facebook"></i> Facebook</a>
                    <a href="http://twitter.com/share?url=<?= base_url('home/detail_pengumuman/' . $pengumuman['pengumuman_id']) ?>" target="_blank" class="btn btn-info"><i class="mdi mdi-twitter"></i> Twitter</a>
                    <a href="whatsapp://send?text=<?= base_url('home/detail_pengumuman/' . $pengumuman['pengumuman_id']) ?>" target="_blank" data-action="share/whatsapp/share" class="btn btn-success"><i class="mdi mdi-whatsapp"></i> Whatsapp</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Detail Pengumuman Section -->
<?= $this->endSection('isi') ?>