<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarTop') ?>
<?= $this->include('user/home/component/slider') ?>



<!-- ITEM -->
<div class="container py-3 d-none d-lg-block d-md-block">
    <h2>Spesial di Ssayomart</h2>
    <div class="row text-center py-3">
        <div class="col-4 col-md-4 col-lg-2">

            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width="60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>


        </div>
        <div class="col-4 col-md-4 col-lg-2">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width="60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-lg-2">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-lg-2">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-lg-2">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-lg-2">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>


        <div class="col-lg-2 d-none d-lg-block mb-4">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block mb-4">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block mb-4">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block mb-4">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block mb-4">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 d-none d-lg-block mb-4">
            <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                <div class="card-body">
                    <a href="<?= base_url() ?>produk">
                        <img src="<?= base_url() ?>assets/img/logo.png" width=" 60px" alt="" class="card-img-top">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tampilan Mobile -->
<div class="container py-3 d-md-none d-lg-none d-xl-none">
    <h2>Spesial di Ssayomart!</h2>
    <div class="row text-center row-cols-3">
        <?php foreach ($promo as $p) : ?>
            <div class="col">
                <div class="card text-bg-light mb-3 bg-white border-0 shadow">
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
<!-- tampilan Mobile -->


<!-- swiper tampilan monile  -->
<section class="mt-1 " id="unggul">
    <div class="container py-3 d-md-none d-lg-none d-xl-none">
        <h2>Spesial di Ssayomart!</h2>
        <div class="row">
            <div class="col">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper d-flex">
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card text-bg-light mb-3 bg-white border-0  shadow-sm">
                                <div class="card-body">
                                    <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                        <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card text-bg-light mb-3 bg-white border-0 ">
                                <div class="card-body">
                                    <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                        <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card text-bg-light mb-3 bg-white border-0 ">
                                <div class="card-body">
                                    <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                        <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card text-bg-light mb-3 bg-white border-0 ">
                                <div class="card-body">
                                    <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                        <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- swiper tampilan monile  -->






<!-- produk card 6 baris tampilan web-->
<div class="container py-3 d-none d-lg-block" id="product">
    <div class="row mt-4 ">
        <h2 class="text-merah"> Product Terlaris </h2>

        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                <div class=" card-body">
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
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                <div class=" card-body">
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
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
                <div class=" card-body">
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

    <div class="row mt-3">
        <h2 class="text-merah"> Product Terbaru </h2>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
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
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
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
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
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
<!-- akhir card 6 baris tampilan web -->



<!-- swipper card tampilan web -->
<section class="mt-5 " id="unggul">
    <div class="container py-3 d-none d-lg-block">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-4">Produk Unggul</h2>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper d-flex">
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
                            <div class="card">
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
    </div>
</section>
<!-- swipper card  tampilan web-->





<div class="container py-2">
    <h2>Semua Kategori</h2>
    <div class="row text-center row-cols-3 py-3">
        <?php foreach ($kategori as $k) : ?>
            <div class="col-4 col-md-4 col-lg-2">
                <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                    <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" width="60px" alt="" class="card-img-top">
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="row pb-5">
        <div class="col"></div>
    </div>
</div>


<?= $this->endSection(); ?>