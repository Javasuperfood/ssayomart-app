<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Footer Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand fixed-bottom shadow-sm navbar-bottom rounded-top-4" style="height: 55px; background-color:#fff; box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;">
                    <ul class="navbar-nav nav-justified w-100 d-flex justify-content-evenly align-items-center">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>" class="nav-link link-light">
                                <i class="bi bi-house-heart-fill fw-bold fs-1 text-secondary"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>cart" class="nav-link link-light position-relative a_cart_link_0">

                                <i class="bi bi-bag-heart-fill fw-bold fs-2 text-secondary"></i>
                                <div id="cartItem_0" class="position-absolute top-0 start-100 mt-3 translate-middle">
                                    <span id="cartItem_1" class="position-absolute badge badge-initial rounded-pill text-danger fw-bold" style="font-size: 0.75rem; top: -10px; right: -10px;">
                                        <?= session()->get('countCart'); ?>
                                    </span>
                                </div>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>history" class="nav-link link-light">
                                <i class="bi bi-journal-text fw-bold fs-2 text-secondary"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>setting" class="nav-link link-light">
                                <i class="bi bi-person-circle fw-bold fs-2 text-secondary"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- styling hover active -->
        <style>
            .nav-justified .nav-item {
                flex-grow: 0;
            }

            .navbar-bottom {
                border-radius: 0 !important;
                border-top-left-radius: 15px !important;
                border-top-right-radius: 15px !important;
                border-top: 0 !important;
            }

            .navbar {
                border-top: 1.7px solid #f2f1ed;
                border-radius: 10px;
            }

            .nav-item a {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }

            .nav-item a:hover {
                background-color: #0000;
                color: #333;
            }

            .nav-item.active a {
                color: #000;
            }

            .nav-item.active a i {
                color: #e31212 !important;
                filter: drop-shadow(2px 2px 3px rgba(0, 0, 0, 0.3));
                /* small shadow following icon shape */
            }



            .badge-initial {
                top: -0.5rem !important;
                right: -0.5rem !important;
            }
        </style>

        <!-- styling hover active -->
        <!-- Script hover active -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var navLinks = document.querySelectorAll(".nav-link");

                // Mengecek URL saat halaman dimuat ulang
                var currentURL = window.location.href;
                navLinks.forEach(function(link) {
                    if (currentURL === link.href) {
                        link.parentElement.classList.add("active");
                    }
                });

                navLinks.forEach(function(link) {
                    link.addEventListener("click", function() {
                        // Menghapus class "active" dari semua elemen dengan class "nav-item"
                        navLinks.forEach(function(navLink) {
                            navLink.parentElement.classList.remove("active");
                        });
                        // Menambahkan class "active" ke elemen yang sedang diklik
                        link.parentElement.classList.add("active");
                    });
                });
            });
        </script>
        <!-- Script hover active -->
    <?php else : ?>

        <!-- Footer Desktop -->
        <div id="desktopContent">
            <footer id="footer" class="rounded-top-5 footer" style="box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;   background-color: #ce2614">
                <div class="container">
                    <div class="row gy-3">
                        <div class="col-lg-3 col-md-6 d-flex">
                            <i class="bi bi-geo-alt-fill icon-footer"></i>
                            <div>
                                <h4><?= lang("Text.alamat") ?></h4>
                                <p>
                                    Blok I No. 20, Karawaci Office Park, Jl. Imam Bonjol, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten - 15139
                                </p>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-6 footer-links d-flex">
                            <i class="bi bi-telephone-fill icon-footer"></i>
                            <div>
                                <h4><?= lang("Text.kontak") ?></h4>
                                <p>
                                    <strong>Telephone:</strong> (021)3529-0000<br>
                                    <strong>Email:</strong> ssayomart@gmail.com<br>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links d-flex">
                            <i class="bi bi-headset icon-footer"></i>
                            <div>
                                <h4><?= lang("Text.layanan") ?></h4>
                                <p>
                                    <?= lang('Text.jadwal_pelayanan') ?><br>
                                    <?= lang('Text.jadwal_pelayanan_2') ?>
                                </p>
                                <p>
                                    <a href="<?= base_url(); ?>/pusat-bantuan" class="text-decoration-none text-white"><strong><i class="bi bi-question-circle"></i> Pusat Bantuan</strong></a>
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links d-flex">
                            <i class="bi bi-bookmark-fill icon-footer"></i>
                            <div>
                                <h4><?= lang("Text.follow") ?></h4>
                                <div class="social-links d-flex">
                                    <a href="https://www.youtube.com/channel/UCiaJvoHqRRlxxHERP7q11Bw" target="__blank" class="youtube"><i class="bi bi-youtube"></i></a>
                                    <a href="https://www.facebook.com/profile.php?id=61553754412116&locale=id_ID" target="__blank" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="https://www.instagram.com/ssayomart.id/" target="__blank" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="https://www.tiktok.com/@ssayomart.id" target="__blank" class="tiktok"><i class="bi bi-tiktok"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="container">
                    <div class="copyright">
                        <span id="currentYear"></span> &copy; Copyright <span class="fw-bold">PT. Ssayo Mart Indonesia</span>. All Rights Reserved
                    </div>
                </div>
            </footer>
            <script>
                document.getElementById("currentYear").innerHTML = new Date().getFullYear();
            </script>
            <style>
                /* navabr bottom */

                .footer {
                    font-size: 14px;
                    background-color: #1f1f24;
                    padding: 50px 0;
                    color: rgba(255, 255, 255, 0.7);
                }

                .footer .icon-footer {
                    margin-right: 15px;
                    font-size: 24px;
                    line-height: 0;
                    color: #fff;
                }

                .footer h4 {
                    font-size: 16px;
                    font-weight: bold;
                    position: relative;
                    padding-bottom: 5px;
                    color: #fff;
                }

                .footer .footer-links {
                    margin-bottom: 30px;
                }

                .footer .footer-links ul {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .footer .footer-links ul li {
                    padding: 10px 0;
                    display: flex;
                    align-items: center;
                }

                .footer .footer-links ul li:first-child {
                    padding-top: 0;
                }

                .footer .footer-links ul a {
                    color: #fff;
                    transition: 0.3s;
                    display: inline-block;
                    line-height: 1;
                }

                .footer .footer-links ul a:hover {
                    color: #fff;
                }

                .footer .social-links a {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    font-size: 16px;
                    color: #fff;
                    margin-right: 10px;
                    transition: 0.3s;
                }

                .footer .social-links a:hover {
                    color: #fff;
                    border-color: #fff;
                }

                .footer .copyright {
                    text-align: center;
                    padding-top: 30px;
                    border-top: 1px solid #fff;
                }
            </style>
        </div>
        <!-- End Footer Desktop -->
    <?php endif; ?>

    <?php
    if ($isMobile) {

        echo '<div id="mobileContent">';

        echo '</div>';
    } else {

        echo '<div id="desktopContent">';

        echo '</div>';
    }
    ?>