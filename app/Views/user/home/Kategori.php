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
                <div class="card bg-warning border-0 text-center font-family-poppins">
                    <div class="card-warning">
                        <span class="card-title text-white fw-medium fs-3"><?= lang("Text.spesial") ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex">
                                <?php foreach ($promo as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                        <div class="text-bg-light mb-3 bg-white border-0">
                                            <div class="px-1 py-1 mx-1 my-1">
                                                <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                                    <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" alt="<?= $p['title']; ?>" class="card-img-top">
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
        <!-- rekomendasi -->
        <div class="container">
            <div class="card bg-danger border-0 text-center font-family-poppins">
                <div class="card-danger">
                    <span class="card-title text-white fw-medium fs-3"><?= lang('Text.rekomendasi') ?></h2>
                </div>
            </div>
        </div>
        <!-- end rekomendasi -->

        <!-- card rekomendasi swiper -->
        <div class="container">
            <div class="swiper mySweety">
                <div class="swiper-wrapper d-flex">
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm mx-1">
                            <div class="row g-0">
                                <div class="col-md-6 col-sm-6 col-6 d-flex align-items-center">
                                    <img src="<?= base_url() ?>assets/img/promo/promo-1.png" class="card-img-top img-fluid" alt="">
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="card-body">
                                        <p class="small" style="font-size: 12px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo natus mollitia labore adipisci dignissimos</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm mx-1">
                            <div class="row g-0">
                                <div class="col-md-6 col-sm-6 col-6 d-flex align-items-center">
                                    <img src="<?= base_url() ?>assets/img/promo/promo-2.png" class="card-img-top img-fluid" alt="">
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="card-body">
                                        <p class="small" style="font-size: 12px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo natus mollitia labore adipisci dignissimos</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm mx-1">
                            <div class="row g-0">
                                <div class="col-md-6 col-sm-6 col-6 d-flex align-items-center">
                                    <img src="<?= base_url() ?>assets/img/promo/promo-3.jpg" class="card-img-top img-fluid" alt="">
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="card-body">
                                        <p class="small" style="font-size: 12px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo natus mollitia labore adipisci dignissimos</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm mx-1">
                            <div class="row g-0">
                                <div class="col-md-6 col-sm-6 col-6 d-flex align-items-center">
                                    <img src="<?= base_url() ?>assets/img/promo/promo-4.jpg" class="card-img-top img-fluid" alt="">
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="card-body">
                                        <p class="small" style="font-size: 12px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illo natus mollitia labore adipisci dignissimos</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end rekomendasi -->
        <div class="container py-1">
            <div class="card bg-success border-0 text-center font-family-poppins">
                <div class="card-warning">
                    <span class="card-title text-white fw-medium fs-3 text-capitalize"><?= lang("Text.kategori") ?></h2>
                </div>
            </div>
            <div class="row text-center row-cols-3 mt-3">
                <?php foreach ($kategori as $k) : ?>
                    <div class="col-4 col-md-4 col-lg-2">
                        <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                            <div class="text-bg-light mb-3 bg-white border-0">
                                <div class="px-0 py-0 mx-0 my-0">
                                    <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" alt="Kategori" class="card-img-top">
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
                <div class="card bg-warning border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center">
                    <div class="card-warning">
                        <span class="card-title text-white fw-bold fs-2"><?= lang("Text.spesial") ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex">
                                <?php foreach ($promo as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                        <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                            <div class="card-body">
                                                <a href="<?= base_url('promo/' . $p['slug']) ?>">
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
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex">
                                <?php foreach ($randomProducts as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                                        <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                                            <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 200px; height: 200px;">
                                                </div>
                                            </a>
                                            <div class="fs-3 mt-3" style="padding: 0 10px 0 10px;">
                                                <h1 class="text-secondary" style="font-size: 15px;">
                                                    <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                                        Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                                    <?php else : ?>
                                                        <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                                    <?php endif ?>
                                                </h1>
                                                <p class=" text-secondary" style="font-size: 14px;"><?= substr($p['nama'], 0, 15); ?>...</p>
                                                <div class="container pt-3">
                                                    <div class="row justify-items-center">
                                                        <div class="col">
                                                            <div class="horizontal-counter">
                                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="decreaseCount()"><i class="bi bi-dash"></i></button>
                                                                <input type="text" id="counter" class="form-control form-control-sm border-0" value="0" readonly>
                                                                <button class="btn btn-sm btn-outline-danger" type="button" onclick="increaseCount()"><i class="bi bi-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="text-center custom-button " style="display: flex; justify-content: center;">
                                                    <a href="<?= base_url('produk/' . $p['slug']); ?>?add-to-cart=show" class="btn btn-danger mt-4">
                                                        <i class="bi bi-cart-plus"></i>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger   mx-1 mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalVarianBuy">
                                                        Beli
                                                    </button>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <input type="hidden" id="qty" name="qty" value="1">
                                <?= $this->include('user/component/scriptAddToCart'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- rekomendasi title -->
                <div class="container py-3">
                    <div class="card bg-danger border-0 text-center font-family-poppins">
                        <div class="card-danger">
                            <span class="card-title text-white fw-bold fs-2"><?= lang('Text.rekomendasi') ?></h2>
                        </div>
                    </div>
                </div>
                <!-- end rekomendasi title-->
                <!-- card rekomendasi -->
                <div class="container mb-3 mt-3">
                    <div class="row">
                        <div class="swiper mySwung">
                            <div class="swiper-wrapper d-flex">
                                <div class="swiper-slide">
                                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                        <div class="card-body p-4">
                                            <div class="d-flex text-black">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= base_url() ?>assets/img/promo/promo-2.png" alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="mb-2 pb-1 fw-bold" style="color: #2b2a2a;">Lorem, ipsum.</p>
                                                    <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #f5f5f5;">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid aut sapiente, quibusdam voluptate illo eligendi.
                                                    </div>
                                                    <div class="d-flex pt-1">
                                                        <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                        <div class="card-body p-4">
                                            <div class="d-flex text-black">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= base_url() ?>assets/img/promo/promo-2.png" alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="mb-2 pb-1 fw-bold" style="color: #2b2a2a;">Lorem, ipsum.</p>
                                                    <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #f5f5f5;">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid aut sapiente, quibusdam voluptate illo eligendi.
                                                    </div>
                                                    <div class="d-flex pt-1">
                                                        <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                        <div class="card-body p-4">
                                            <div class="d-flex text-black">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= base_url() ?>assets/img/promo/promo-2.png" alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="mb-2 pb-1 fw-bold" style="color: #2b2a2a;">Lorem, ipsum.</p>
                                                    <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #f5f5f5;">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid aut sapiente, quibusdam voluptate illo eligendi.
                                                    </div>
                                                    <div class="d-flex pt-1">
                                                        <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                        <div class="card-body p-4">
                                            <div class="d-flex text-black">
                                                <div class="flex-shrink-0">
                                                    <img src="<?= base_url() ?>assets/img/promo/promo-2.png" alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="mb-2 pb-1 fw-bold" style="color: #2b2a2a;">Lorem, ipsum.</p>
                                                    <div class="d-flex justify-content-start rounded-3 p-2 mb-2" style="background-color: #f5f5f5;">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid aut sapiente, quibusdam voluptate illo eligendi.
                                                    </div>
                                                    <div class="d-flex pt-1">
                                                        <a href="<?= base_url('blog'); ?>" class="btn btn-danger fw-medium flex-grow-1">Read More <i class="bi bi-arrow-right-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card rekomendasi-->
                <div class="container py-3">
                    <div class="card bg-success border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center">
                        <div class="card-success">
                            <span class="card-title text-white fw-bold fs-2 text-capitalize"><?= lang("Text.kategori") ?></span>
                        </div>
                    </div>
                    <div class="row text-center row-cols-3 py-3">
                        <?php foreach ($kategori as $k) : ?>
                            <div class="col-4 col-md-4 col-lg-2">
                                <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                                    <div class="card text-bg-light mb-3 bg-white border-0 shadow-sm">
                                        <div class="card-body">
                                            <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" alt="" class="py-0 px-0 mx-0 my-0 card-img-top">
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

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">


<style>
    .font-family-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .sizing {
        width: 200px;
        height: 200px;

    }

    .horizontal-counter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .horizontal-counter .btn {
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    .horizontal-counter input {
        width: 40px;
        text-align: center;
    }

    /* Media query for Samsung Galaxy Fold */
    @media (max-width: 280px) {
        .horizontal-counter .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.9rem;
        }

        .horizontal-counter input {
            width: 30px;
            text-align: center;
        }

        .custom-button .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.9rem;

        }


    }
</style>




<?= $this->endSection(); ?>