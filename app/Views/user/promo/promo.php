<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>


<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>
<!-- Button Kategori -->
<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <section class="mt-2 ">
            <div class="container d-md-none">
                <div class="row text-center">
                    <div class="col">
                        <div class="swiper button-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($kategori_promo as $k) : ?>
                                    <div class="swiper-slide">
                                        <a href="<?= base_url('promo/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded">
                                            <?= $k['title']; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <!-- end mobile -->
        <!-- desktoop -->
        <div id="desktopContent" style="margin-top:100px;">
            <section class="py-2">
                <div class="container d-none d-md-block">
                    <div class="row text-center">
                        <div class="col">
                            <div class="swiper button-swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($kategori_promo as $k) : ?>
                                        <div class="swiper-slide">
                                            <a href="<?= base_url('promo/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded">
                                                <?= $k['title']; ?>
                                            </a>
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
        <?= $this->include('user/produk/component/card') ?>
        <?= $this->endSection(); ?>