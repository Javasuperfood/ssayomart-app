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
                        <div class="swiper button-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($produk as $k) : ?>
                                        <?php if (isset($k['img_2'])): ?>
                                            <div class="mx-auto">
                                                <img src="<?= base_url() ?>assets/img/promo/<?= $k['img_2']; ?>" alt="<?= $k['title']; ?>" class="img-fluid" width="250">
                                            </div>
                                        <?php else: ?>
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
                                    <?php if (isset($kp['img_2'])): ?>
                                        <div class="mx-auto">
                                            <img src="<?= base_url() ?>assets/img/promo/<?= $kp['img_2']; ?>" alt="<?= $kp['title']; ?>" width="300">
                                        </div>
                                    <?php else: ?>
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
    <?= $this->include('user/produk/component/cardProduk') ?>
    <?= $this->endSection(); ?>