<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarTop') ?>
<?= $this->include('user/home/component/slider') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <section class="mt-1" id="unggul">
            <div class="container pt-2">
                <h2>Spesial di Ssayomart!</h2>
                <div class="row">
                    <div class="col">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex">
                                <?php foreach ($promo as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                        <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                            <div class="card-body">
                                                <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                                    <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container py-2">
            <h2>Semua Kategori</h2>
            <div class="row text-center row-cols-3">
                <?php foreach ($kategori as $k) : ?>
                    <div class="col-4 col-md-4 col-lg-2">
                        <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                            <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                <div class="card-body">
                                    <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" width="60px" alt="" class="card-img-top">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col pb-5">

                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile View -->
<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:50px;">
        <section id="unggul">
            <div class="container">
                <h2>Spesial di Ssayomart!</h2>
                <div class="row">
                    <div class="col">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex">
                                <?php foreach ($promo as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                        <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                            <div class="card-body">
                                                <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                                    <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- swipper card tampilan web -->
        <section class="mt-1 " id="unggul">
            <div class="container py-3 d-none d-lg-block">
                <div class="row">
                    <div class="col">
                        <h2 class="mb-4">Produk Unggul</h2>
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex">
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">
                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                    <div class="card border-0 shadow-sm">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h4>Rp. 25.000</h4>
                                            </div>
                                            <p>Jahe Bubuk</p>
                                            <p class="text-center">

                                                <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container py-3">
                    <h2>Semua Kategori</h2>
                    <div class="row text-center row-cols-3 py-3">
                        <?php foreach ($kategori as $k) : ?>
                            <div class="col-4 col-md-4 col-lg-2">
                                <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                                    <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                        <div class="card-body">
                                            <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" width="60px" alt="" class="card-img-top">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- swipper card  tampilan web-->
    </div>
<?php endif; ?>
<!-- End Desktop View -->

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<?= $this->endSection(); ?>