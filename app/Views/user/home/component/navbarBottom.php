<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Footer Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <nav class="navbar navbar-expand d-md-blok d-lg-none d-xl-none fixed-bottom" style="margin-top: 6%; height: 55px; background-color:#ec2614">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link link-light"><i class="bi bi-house-door-fill fw-bold fs-4"></i></a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>cart" class="nav-link link-light">
                        <i class="bi bi-cart-fill fw-bold fs-2 position-relative">
                            <?php if (session()->get('countCart') > 0) : ?>
                                <i class="bi bi-chat position-absolute top-0 start-100 translate-middle text-white"></i>
                                <span class="position-absolute top-0 start-100 translate-middle text-warning fw-bold" style="font-size: 0.75rem;"><?= session()->get('countCart'); ?></span>
                            <?php endif ?>
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>history" class="nav-link link-light"><i class="bi bi-file-text-fill fw-bold fs-2"></i></a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>setting" class="nav-link link-light"><i class="bi bi-person-fill fw-bold fs-2"></i></a>
                </li>
            </ul>
        </nav>
    </div>
<?php else : ?>

    <!-- Footer Desktop -->
    <div id="desktopContent">
        <footer id="footer" class="footer" style="background-color: #ce2614">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-lg-3 col-md-6 d-flex">
                        <i class="bi bi-geo-alt-fill icon"></i>
                        <div>
                            <h4>Alamat</h4>
                            <p>
                                Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165<br>
                                RT.001/RW.009, Panunggangan Barat,
                                Kec. Cibodas, Kota Tangerang, Banten - 15139
                            </p>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-links d-flex">
                        <i class="bi bi-telephone-fill icon"></i>
                        <div>
                            <h4>Hubungi Kami</h4>
                            <p>
                                <strong>Phone:</strong> +62 1234 5678 89<br>
                                <strong>Email:</strong> ssayomart@gmail.com<br>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links d-flex">
                        <i class="bi bi-headset icon"></i>
                        <div>
                            <h4>Layanan Pelanggan</h4>
                            <p>
                                Senin-Sabtu: 08.00 - 23.00<br>
                                Minggu: Tutup
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Ikuti Kami</h4>
                        <div class="social-links d-flex">
                            <a href="#" class="youtube"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="tiktok"><i class="bi bi-tiktok"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    2023 &copy; Copyright <strong><span>Ssayomart Supermarket</span></strong>. All Rights Reserved
                </div>
            </div>
        </footer>
        <style>
            .footer {
                font-size: 14px;
                background-color: #1f1f24;
                padding: 50px 0;
                color: rgba(255, 255, 255, 0.7);
            }

            .footer .icon {
                margin-right: 15px;
                font-size: 24px;
                line-height: 0;
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