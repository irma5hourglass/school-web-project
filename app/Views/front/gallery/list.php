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
        <li class="active"><a href="<?= base_url('home/kumpulangallery') ?>">Gallery</a></li>
        <li><a href="<?= base_url() ?>#ekstrakurikuler">Ekstrakurikuler</a></li>
        <li><a href="<?= base_url('') ?>#footer">Contact</a></li>
        <li><a href="<?= base_url('home/kumpulanpengumuman') ?>">Pengumuman</a></li> <!-- Added menu item for "Pengumuman" -->
    </ul>
</nav><!-- .nav-menu -->

<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>



<!-- ======= Events Section ======= -->

<section id="gallery" class="events">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Gallery</h2>
        </div>
        <div class="row">
            <?php
            foreach ($gallery as $data) :
            ?>
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= base_url('img/sampul/thumb/' . 'thumb_' . $data['sampul']) ?>" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?= base_url('home/detail_gallery/' . $data['gallery_id']) ?>"><?= $data['nama_gallery'] ?></a></h5>
                            <p class="font-italic text-center"><?= date_indo($data['tgl_gallery']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



    </div>
</section><!-- End Events Section -->


<?= $this->endSection('isi') ?>