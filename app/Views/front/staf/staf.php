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
        <li class="active"><a href="<?= base_url('home/kumpulanstaf') ?>">Tenaga Kependidikan</a></li>
        <li><a href="<?= base_url('home/kumpulanberita') ?>">Berita</a></li>
        <li><a href="<?= base_url('home/kumpulangallery') ?>">Gallery</a></li>
        <li><a href="<?= base_url() ?>#ekstrakurikuler">Ekstrakurikuler</a></li>
        <li><a href="<?= base_url('') ?>#footer">Contact</a></li>
        <li><a href="<?= base_url('home/kumpulangallery') ?>">Pengumuman</a></li> <!-- Added menu item for "Pengumuman" -->
    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>

<section id="staf" class="trainers">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Tenaga Kependidik</h2>
        </div>
        <br><br>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            foreach ($list_staf as $data) :
            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="<?= base_url('img/staf/thumb/' . 'thumb_' . $data['foto']) ?>" width="250px" height="90px" class="img-thumbnail" alt="">
                        <div class="member-content">
                            <p>
                            <h4><?= $data['nama'] ?></h4>
                            <h6><?= $data['nip'] ?></h6>
                            <span><?= $data['jabatan'] ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <br>
    <br>
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Tenaga Pendidik</h2>
        </div>
        <br><br>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php

            foreach ($list_guru as $data) :

            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="<?= base_url('img/guru/thumb/' . 'thumb_' . $data['foto']) ?>" width="250px" height="90px" class="img-thumbnail" alt="">
                        <div class="member-content">
                            <p>
                            <h4><?= $data['nama'] ?></h4>
                            <h6><?= $data['nip'] ?></h6>
                            <span><?= $data['nama_mapel'] ?></span>

                            </p>
                        </div>
                    </div>
                </div>

            <?php
            endforeach; ?>
        </div>

    </div>
</section>

<?= $this->endSection('isi') ?>