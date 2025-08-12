<?= $this->extend('front/layout/footer') ?>
<?= $this->section('navbar') ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="<?= base_url('') ?>#daruliman">Home</a></li>
        <li class="drop-down active"><a href="#">Profil Sekolah</a>
            <ul>
                <li><a href="<?= base_url('home/profil') ?>#deskripsi">Deskripsi Sekolah</a></li>
                <li><a href="<?= base_url('home/profil') ?>#visimisi">Visi Misi</a></li>
                <li><a href="<?= base_url('home/profil') ?>#keunggulan">Keunggulan Sekolah</a></li>
                <li><a href="<?= base_url('home/profil') ?>#tujuan">Tujuan Sekolah</a></li>
            </ul>
        </li>
        <li><a href="<?= base_url('home/kumpulanstaf') ?>">Tenaga Kependidikan</a></li>
        <li><a href="<?= base_url('home/kumpulanberita') ?>">Berita</a></li>
        <li><a href="<?= base_url('home/kumpulangallery') ?>">Gallery</a></li>
        <li><a href="<?= base_url() ?>#ekstrakurikuler">Ekstrakurikuler</a></li>
        <li><a href="<?= base_url('') ?>#footer">Contact</a></li>
        <li><a href="<?= base_url('home/kumpulanpengumuman') ?>">Pengumuman</a></li> <!-- Added menu item for "Pengumuman" -->
    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>
<div class="container">
    <div class="row">
        <!-- Card Section -->
        <div class="col-lg-3 mt-4">
            <div class="cards m-40px-b">
                <h4>Profil</h4>
                <ul>
                    <li><i class="bx bx-chevron-right"></i> <a href="#deskripsi">Deskripsi</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#visimisi">Visi & Misi</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#keunggulan">Keunggulan Sekolah</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#tujuan">Tujuan Sekolah</a></li>
                </ul>
            </div>
        </div>


        <div class="container col-lg-8">
            <section id="deskripsi" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Deskripsi Singkat</h2>
                    </div>

                    <div class="row">
                        <h5>Deskripsi Singkat</h5><br>
                    </div>

                    <p>
                        <?= $konfigurasi['deskripsi'] ?>

                    </p>




                </div>
            </section><!-- End About Section -->

            <section id="visimisi" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Visi & Misi</h2>
                    </div>

                    <div class="row">

                        <h5>Visi</h5><br>
                    </div>
                    <p>
                        <?= $konfigurasi['visi'] ?>

                    </p><br>

                    <div class="row">
                        <h5>Misi</h5><br>
                    </div>
                    <p>
                        <?= $konfigurasi['misi'] ?>

                    </p>

                </div>

            </section><!-- End About Section -->

            <section id="keunggulan" class="about ">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Keunggulan</h2>
                    </div>

                    <div class="row">


                        <h5>Keunggulan Sekolah</h5><br>
                    </div>
                    <p>
                        <?= $konfigurasi['keunggulan'] ?>

                    </p>

                </div>

            </section><!-- End About Section -->

            <section id="tujuan" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Tujuan Sekolah</h2>
                    </div>

                    <div class="row">


                        <h5>Tujuan Sekolah</h5><br>
                    </div>
                    <p>
                        <?= $konfigurasi['tujuan'] ?>

                    </p>

                </div>


            </section><!-- End About Section -->
            </section>
        </div>
    </div>
</div>


<?= $this->endSection('isi') ?>