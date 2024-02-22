<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<?= $this->include('user/home/component/navbarMain') ?>

<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <section class="">
            <div class="container d-md-none">
                <div class="row text-center">
                    <div class="col">
                        <?php foreach ($produk as $k) : ?>
                            <?php if (isset($k['img_2'])) : ?>
                                <div class="mx-auto">
                                    <img src="<?= base_url() ?>assets/img/promo/<?= $k['img_2']; ?>" alt="<?= $k['title']; ?>" class="promo-cuy">
                                </div>
                            <?php else : ?>
                                <div class=" card border-0 text-center font-family-poppins" style="color: #9c2525; background-color: #facaaf;">
                                    <div class="card-danger">
                                        <h3 class="fw-bold mt-2"><?= $k['title']; ?></h3>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <hr class="mt-5" style="border-width: 3px; border-color:#db6327;">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= $this->include('user/home/component/navbarBottom') ?>
<?php else : ?>
    <!-- end mobile -->
    <!-- desktop -->
    <div id="desktopContent" style="margin-top:150px;">
        <section class="py-2">
            <div class="container d-none d-md-block">
                <div class="row text-center">
                    <div class="col">
                        <div class="swiper button-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($produk as $kp) : ?>
                                    <?php if (isset($kp['img_2'])) : ?>
                                        <div class="mx-auto">
                                            <img src="<?= base_url() ?>assets/img/promo/<?= $kp['img_2']; ?>" alt="<?= $kp['title']; ?>" class="promo-cuy">
                                        </div>
                                    <?php else : ?>
                                        <div class="card border-0 text-center font-family-poppins" style="color: #9c2525; background-color: #facaaf;">
                                            <div class="card-danger">
                                                <h3 class="fw-bold mt-2"><?= $kp['title']; ?></h3>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <hr class="mt-4" style="border-width: 3px; border-color:#db6327;">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- end Desktop -->

    <?php
    if ($isMobile) {

        echo '<div id="mobileContent">';

        echo '</div>';
    } else {

        echo '<div id="desktopContent">';

        echo '</div>';
    }
    ?>
    <!-- desktop -->
    <style>
        @media (max-width: 280px) {
            .swiper-slide {
                display: flex;
                justify-content: center;
                align-items: center;
                /* Atur elemen swiper-slide di tengah-tengah tampilan Samsung Galaxy Fold */
            }

            .btn-custom-rounded {
                /* Jika perlu, sesuaikan gaya tombol agar berada di tengah-tengah */
                margin: 0 auto;
                /* Ini akan mengatur margin secara horizontal agar tombol berada di tengah */
            }
        }
    </style>

    <style>
        .coupon-opacity {
            opacity: 0.6;
        }

        /* Ekstra Kecil (xs) */
        @media only screen and (max-width: 575.98px) {

            .promo-cuy {
                width: 130px;
            }
        }

        /* Kecil (sm) */
        @media only screen and (min-width: 576px) and (max-width: 767.98px) {
            .promo-cuy {
                width: 190px;
            }
        }

        /* Menengah (md) */
        @media only screen and (min-width: 768px) and (max-width: 991.98px) {
            .promo-cuy {
                width: 200px;
            }

            .fs-kupon {
                font-size: 50px;
            }
        }

        /* Besar (lg) */
        @media only screen and (min-width: 992px) and (max-width: 1199.98px) {
            .promo-cuy {
                width: 250px;
            }

            .fs-kupon {
                font-size: 65px;
            }
        }

        /* Sangat Besar (xl) */
        @media only screen and (min-width: 1200px) {

            /* Aturan CSS untuk layar sangat besar di sini */
            .promo-cuy {
                width: 290px;
            }

            .fs-kupon {
                font-size: 75px;
            }
        }
    </style>
    <?= $this->include('user/produk/component/cardProduk') ?>
    <?= $this->endSection(); ?>