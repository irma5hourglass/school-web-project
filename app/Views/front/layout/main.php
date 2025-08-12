<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?> </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('img/konfigurasi/icon/' . $konfigurasi['icon']) ?>" rel="icon">


    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/assets/front/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/front/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/assets/front/assets/css/style.css" rel="stylesheet">
    <!-- =======================================================
  * Template Name: Mentor - v2.2.0
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto">
                <a href="/">
                    <img src="<?= base_url('img/konfigurasi/logo/' . $konfigurasi['logo']) ?>">
                </a>
            </h1>


            <!-- Uncomment below if you prefer to use an image logo -->

            <?= $this->renderSection('navbar') ?>

        </div>
    </header><!-- End Header -->

    <!-- ======= daruliman Section ======= -->
    <section id="daruliman" class="d-flex justify-content-center align-items-center">
        <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">

            <h2> <img src="<?= base_url('img/konfigurasi/logo/' . $konfigurasi['logo']) ?>"></h2>
            <h1><?= $konfigurasi['nama_web'] ?></h1>
            <div id="map"></div>
        </div>
    </section><!-- End daruliman -->

    <main id="main">
        <?= $this->renderSection('isi') ?>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact</h4>
                        <p>
                            <?= $konfigurasi['alamat'] ?><br>
                            <strong>Phone:</strong> <?= $konfigurasi['whatsapp'] ?><br>
                            <strong>Email:</strong> <?= $konfigurasi['email'] ?><br>
                            <strong>Instagram:</strong> <?= $konfigurasi['instagram'] ?><br>
                            <strong>facebook:</strong> <?= $konfigurasi['facebook'] ?><br>
                        </p>
                        <br>
                        <p class="social-links">
                            <a href="https://www.facebook.com/<?= $konfigurasi['facebook'] ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="https://www.instagram.com/<?= $konfigurasi['instagram'] ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="https://wa.me/<?= $konfigurasi['whatsapp'] ?>" class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
                        </p>

                    </div>


                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Pintasan</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url() ?>#berita">Berita</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url() ?>#gallery">Gallery</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url() ?>#pengumuman">pengumuman</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url() ?>#ekstrakurikuler">Ekstrakurikuler</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 footer-newsletter">
                        <div class="card-body">
                            <iframe src="<?= $konfigurasi['maps'] ?>" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="mr-md-auto text-center text-md-left">
                <div class="copyright">
                    &copy;<strong><span style="color: white;"><?= $konfigurasi['nama_web'] ?>. All Rights Reserved</span></strong>
                </div>
            </div>






        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/assets/front/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/counterup/counterup.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/assets/front/assets/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/assets/front/assets/js/main.js"></script>
    <script>
        function numberOnly(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
    </script>
    <script>
        // Add an event listener to detect scrolling
        window.addEventListener('scroll', function() {
            var header = document.getElementById('header');
            // Check if the user has scrolled beyond a certain point (e.g., 50 pixels from the top)
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>