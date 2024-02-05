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
                                    <div class="swiper-slide">
                                        <a href="<?= base_url('promo/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded">
                                            <div class=" card border-0 text-center font-family-poppins" style="color: #9c2525; background-color: #facaaf;">
                                                <div class="card-danger">
                                                    <h3 class="fw-bold mt-2"><?= $k['title']; ?></h3>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="mt-4" style="border-width: 3px; border-color:#db6327;">
                                    </div>
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
                                    <div class="swiper-slide">
                                        <a href="<?= base_url('promo/' . $kp['slug']); ?>" class="btn border-0 btn-custom-rounded">
                                            <div class="card border-0 text-center font-family-poppins" style="color: #9c2525; background-color: #facaaf;">
                                                <div class="card-danger">
                                                    <h3 class="fw-bold mt-2"><?= $kp['title']; ?></h3>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="mt-4" style="border-width: 3px; border-color:#db6327;">
                                    </div>
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