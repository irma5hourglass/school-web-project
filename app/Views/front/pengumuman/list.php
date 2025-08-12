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

<section id="pengumuman" class="news">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Pengumuman</h2>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            $count = 0; // Add a counter variable
            foreach ($pengumuman as $data) :
                if ($count >= 3) { // Limit the number of displayed items to 3
                    break;
                }
            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <div class="default-image"></div>
                        <div class="course-content">
                            <h4><a href="<?= base_url('home/detail_pengumuman/' . $data['pengumuman_id']) ?>"><?= $data['judul_pengumuman'] ?></a></h4>
                            <h6><?= $data['tanggal'] ?></h6>
                            <p><?= substr(strip_tags($data['isi_pengumuman']), 0, 150) ?>...</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <span><?= date_indo($data['tanggal']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</section>
<?= $this->endSection('isi') ?>