<?= $this->extend('front/layout/main') ?>
<?= $this->section('navbar') ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li class="active"><a href="<?= base_url('') ?>#daruliman">Home</a></li>
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
        <li><a href="<?= base_url('home/kumpulanpengumuman') ?>">Pengumuman</a></li> <!-- Added menu item for "Pengumuman" -->
    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>

<section id="berita" class="courses">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Berita</h2>
        </div><br><br>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            $count = 0; // Add a counter variable
            foreach ($berita as $data) :
                if ($count >= 3) { // Limit the number of displayed items to 3
                    break;
                }
            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <img src="<?= base_url('img/berita/thumb/' . "thumb_" .  $data['gambar']) ?>" width="200%" height="200%" class="img-thumbnail" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4><?= $data['nama_kategori'] ?></h4>
                            </div>
                            <h6><?= date_indo($data['tgl_berita']) ?></h6>
                            <h3><a href="<?= base_url('home/detail_berita/' . $data['slug_berita']) ?>"><?= $data['judul_berita'] ?></a></h3>
                            <p> <?= substr(strip_tags($data['isi']), 0, 150) ?>...</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="<?= base_url('img/user/' . $data['foto']) ?>" class="img-fluid" alt="">
                                    <span><?= $data['nama'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->
            <?php
                $count++; // Increment the counter variable
            endforeach;
            ?>
        </div>
        <br>
        <br>
        <br>
        <div class="center-btn">
            <a href="<?= base_url('home/kumpulanberita') ?>" class="btn green-btn btn-lg">Lihat Semua Berita</a>
        </div>

    </div>
</section>


<!-- ======= Events Section ======= -->

<section id="gallery" class="events">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Gallery</h2>
        </div>
        <br><br>
        <div class="row">
            <?php
            $count = 0; // Add a counter variable
            foreach ($gallery as $data) :
                if ($count >= 3) { // Limit the number of displayed items to 3
                    break;
                }
            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
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
            <?php
                $count++; // Increment the counter variable
            endforeach;
            ?>
        </div>

        <div class="center-btn">
            <a href="<?= base_url('home/kumpulangallery') ?>" class="btn green-btn btn-lg">Lihat Semua Gallery</a>
        </div>
    </div>
</section><!-- End Events Section -->




<section id="ekstrakurikuler" class="ekstra">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Ekstrakurikuler</h2>
        </div>
        <br><br>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            $i = 0;
            foreach ($ekstrakurikuler as $data) :
                $thumb_image = base_url('img/ekstrakurikuler/thumb/thumb_' . $data['gbr']);
            ?>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" class="carousel slide" data-ride="carousel" data-interval="false" data-touch="true">
                    <div class="card">
                        <div class="card-heading" style="background-image: url('<?= $thumb_image ?>'); background-size: cover; background-position: center; width: 250px; height: 250px;">
                            <div class="font-16" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                <h4><?= $data['nama_ekstra'] ?></h4>
                            </div>
                        </div>
                    </div>

                </div>

            <?php
                $i++;
            endforeach;
            ?>

        </div>
        <a class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>




<section id="staf" class="trainers">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Tenaga Kependidik dan Pendidik</h2>
        </div>
        <br><br>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            $count = 0; // Add a counter variable
            foreach ($list_staf as $data) :
                if ($count >= 3) { // Limit the number of displayed items to 3
                    break;
                }
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

            <?php $count++;
            endforeach; ?>
        </div>

    </div>

    <div class="container" data-aos="fade-up">


        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            $count = 0; // Add a counter variable
            foreach ($list_guru as $data) :
                if ($count >= 3) { // Limit the number of displayed items to 3
                    break;
                }
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

            <?php $count++;
            endforeach; ?>
        </div>
        <br>
        <br>
        <br>
        <div class="center-btn">
            <a href="<?= base_url('home/kumpulanstaf') ?>" class="btn green-btn btn-lg">Lihat Semua Tenaga Kependidikan</a>
        </div>
    </div>
</section>

<section id="pengumuman" class="news">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Pengumuman</h2>
        </div>
        <br><br>
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
                        <div class="default-image">
                        </div>
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
                $count++; // Increment the counter variable
            endforeach;
            ?>
        </div>
        <br>
        <br>
        <br>
        <div class="center-btn">
            <a href="<?= base_url('home/kumpulanpengumuman') ?>" class="btn green-btn btn-lg">Lihat Semua Pengumuman</a>
        </div>
    </div>


</section>
<!-- ======= Counts Section ======= -->
<section id="counts" class="counts section-bg">
    <div class="container">

        <div class="row counters">

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $staf['staf_id'] ?></span>
                <p>Tenaga Kependidikan</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $guru['guru_id'] ?></span>
                <p>Guru</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $kelas['kelas_id'] ?></span>
                <p>Kelas</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $siswa['siswa_id'] ?></span>
                <p>Siswa</p>
            </div>

        </div>

    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const itemsPerPage = 3; // Menampilkan 3 data per halaman
        const $items = $('.ekstra .card');
        const totalItems = $items.length;
        let currentPage = 0;
        const maxPage = Math.ceil(totalItems / itemsPerPage);

        // Insert a class to identify carousel items
        $items.addClass('carousel-item');

        // Function to handle carousel navigation
        function showCarouselItems() {
            const startIndex = currentPage * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            $items.hide(); // Hide all items
            $items.slice(startIndex, endIndex).show(); // Show the specified range of items
        }

        // Show the first page
        showCarouselItems();

        // Handle "Next" button click
        $('.carousel-control-next').click(function() {
            if (currentPage < maxPage - 1) {
                currentPage++;
            } else {
                currentPage = 0; // Kembali ke halaman pertama jika di halaman terakhir
            }
            showCarouselItems();
        });

        // Handle "Previous" button click
        $('.carousel-control-prev').click(function() {
            if (currentPage > 0) {
                currentPage--;
            } else {
                currentPage = maxPage - 1; // Kembali ke halaman terakhir jika di halaman pertama
            }
            showCarouselItems();
        });
    });
</script>



<?= $this->endSection('isi') ?>