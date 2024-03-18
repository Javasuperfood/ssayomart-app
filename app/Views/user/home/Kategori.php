<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarTop2') ?>
<?= $this->include('user/home/component/slider') ?>

<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="" style="position: relative; top: -15px;">
            <!--  NEW PROMOTION SECTION -->
            <section id="rekomendasi">
                <div class="container">
                    <div class="row px-2">
                        <div class="col-6 px-1">
                            <a href="<?= base_url() ?>all-promo-bundle">
                                <img src="<?= base_url() ?>assets/img/promo/Clipped.png" class="card-img-top rounded-2">
                            </a>
                        </div>
                        <div class="col-6 px-1">
                            <a href="<?= base_url() ?>all-promo-discount">
                                <img src="<?= base_url() ?>assets/img/promo/Clipped.png" class="card-img-top rounded-2">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END NEW PROMOTION SECTION -->

                <div id="ktr" class="container">
                    <div class="row">
                        <div class="col text-white">
                            <p class="px-0 py-0"></p>
                        </div>
                    </div>
                </div>
                <!-- All Kategori -->
                <div class="container">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="fs-4 text-dark text-center">
                            <span class="teks-kategori"><?= lang('Text.kategori'); ?></span>
                        </div>
                        <img src="<?= base_url('assets/img/shopping-cart.png') ?>" class="gambar-anime" alt="Deskripsi Gambar" style="width: 25px; height: auto; margin-left:10px; margin-bottom:5px;">
                    </div>

                    <div class="row text-center row-cols-3 mt-3">
                        <?php foreach ($kategori as $k) : ?>
                            <div class="col-4 col-md-4 col-lg-2">
                                <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                                    <div class="shadow rounded-4 text-bg-light mb-3 bg-white border-0">
                                        <div class="px-0 py-0 mx-0 my-0">
                                            <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" alt="Kategori" class="card-img-top">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col pb-3">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <style>
        @media only screen and (max-width: 280px) {
            .teks-kategori {
                font-size: 14px;
            }
        }
    </style>
    <!-- End Mobile View -->
<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:15px;">
        <section id="unggul">
            <div class="container">
                <div class="card border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center" style="background-color: #d7eff8;">
                    <div class="card-warning">
                        <span class="card-title text-dark fw-bold fs-2"><?= lang('Text.spesial') ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex justify-content-center align-items-center">
                                <?php foreach ($promo as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                                        <div class="text-bg-light mb-3 bg-white">
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
        <section id="unggul">
            <div class="container py-3">
                <div class="row mt-3">
                    <div class="col">
                        <div class="card border-0 text-center font-family-poppins" style="background-color: #ccebbc;">
                            <div class="card-danger">
                                <span class="card-title text-dark fw-bold fs-2"><?= lang('Text.nama_produk') ?></h2>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center align-items-center swiper mySwing">
                            <div class="swiper-wrapper d-flex mb-3">
                                <?php foreach ($randomProducts as $p) : ?>
                                    <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                                        <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                                            <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 200px; height: 200px; object-fit: contain; object-position: 20% 10%;">
                                                </div>
                                            </a>
                                            <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                                <div class="d-flex text-center align-items-center justify-content-center" style="height: 65px;">
                                                    <p class=" text-secondary fw-bold " style=" font-size: 13px; margin: 0;"><?= substr($p['nama'], 0, 40); ?></p>
                                                </div>
                                                <p class="text-secondary text-center" style="font-size: 12px; margin: 0;">
                                                    <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                                </p>

                                                <h1 class="mb-4 text-danger fw-bold mt-1 text-center" style="font-size: 18px; margin: 0;">
                                                    <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                                        Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                                    <?php else : ?>
                                                        <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                                    <?php endif ?>
                                                </h1>
                                                <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                                    <div class="button" onClick="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOver="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOut="changeToCircle(<?= $p['id_produk']; ?>)">
                                                        <i class="bi bi-plus text-danger fw-bold" style="font-size: 16px;"></i>
                                                    </div>
                                                    <div class="button-capsule" onMouseOver="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOut="changeToCircle(<?= $p['id_produk']; ?>)">
                                                        <div class="icon" onClick="decreaseValue(<?= $p['id_produk']; ?>)">-</div>
                                                        <input type="text" id="counter-<?= $p['id_produk']; ?>" class="input" value="1" disabled>
                                                        <div class="icon" onClick="increaseValue(<?= $p['id_produk']; ?>)">+</div>
                                                    </div>
                                                </div>
                                                <!-- akhir button animasi -->
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- rekomendasi title -->
                <div class="container py-3">
                    <div class="card border-0 text-center font-family-poppins" style="background-color: #fce0e4;">
                        <div class="card-danger">
                            <span class="card-title text-dark fw-bold fs-2"><?= lang('Text.saran_masak') ?></h2>
                        </div>
                    </div>
                </div>
                <!-- end rekomendasi title-->
                <!-- card rekomendasi -->
                <div class="container mt-3">
                    <div class="row">
                        <div class="swiper mySwung">
                            <div class="mb-5 swiper-wrapper d-flex">
                                <?php foreach ($blog_detail as $bd) : ?>
                                    <div class="swiper-slide">
                                        <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                            <div class="card-body p-4">
                                                <div class="d-flex text-black">
                                                    <div class="flex-shrink-0">
                                                        <img src="<?= base_url() ?>assets/img/blog/<?= $bd['img_thumbnail']; ?>" alt="Thumbnail Artikel" class="img-fluid rounded-3" style="height: 180px; width: 180px;">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <p class="mb-2 pb-1 fw-bold fs-5 text-dark"><?= substr($bd['judul_blog'], 0, 40); ?>...</p>
                                                        <div class="d-flex justify-content-start rounded-3 p-2 mb-0">
                                                            <p class="text-secondary"><?= lang('Text.selengkapnya') ?></p>
                                                        </div>
                                                        <div class="d-flex pt-0">
                                                            <a href="<?= base_url(); ?>blog/<?= $bd['id_blog']; ?>" class="btn btn-danger fw-medium flex-grow-1">View More <i class="bi bi-arrow-right-circle"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card rekomendasi-->
                <div class="container py-1">
                    <div class="card border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center" style="background-color: #ccebbc;">
                        <div class="card-success">
                            <span class="card-title text-dark fw-bold fs-2 text-capitalize"><?= lang('Text.kategori') ?></span>
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

    <!-- styling button counter animasi -->
    <style>
        .button-container {
            position: absolute;
            top: 7px;
            /* Jarak dari atas */
            left: 7px;
            /* Jarak dari kiri */
            display: flex;
            gap: 5px;
            /* Jarak antar tombol */
        }

        .button {
            width: 30px;
            /* Ukuran tombol yang lebih kecil */
            height: 30px;
            /* Ukuran tombol yang lebih kecil */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: 1px solid #e83b2e;
            background-color: #fff;
        }


        .button-capsule {
            width: 60px;
            /* Ukuran capsule yang lebih kecil */
            height: 30px;
            /* Ukuran capsule yang lebih kecil */
            border-radius: 15px;
            display: none;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding: 0 5px;
            /* Padding yang lebih kecil */
            transition: all 0.3s ease;
            outline: 1px solid #e83b2e;
            background-color: #fff;
        }

        .icon {
            font-size: 16px;
            color: #e83b2e;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .input {
            width: 20px;
            /* Ukuran input yang lebih kecil */
            height: 15px;
            /* Ukuran input yang lebih kecil */
            text-align: center;
            margin: 0 3px;
            /* Margin yang lebih kecil */
            color: #000;
            font-size: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            outline: none;
        }
    </style>
    <!-- akhir styling button counter animasi -->
    <!-- script button counter animasi -->
    <script>
        function changeToCapsule(productId) {
            document.querySelector(`#button-container-${productId} .button`).style.display = 'none';
            document.querySelector(`#button-container-${productId} .button-capsule`).style.display = 'flex';
        }

        function decreaseValue(productId) {
            var counter = document.getElementById(`counter-${productId}`);
            if (parseInt(counter.value) > 0) {
                counter.value = parseInt(counter.value) - 1;
            }
            validateCounter(productId);
        }

        function increaseValue(productId) {
            var counter = document.getElementById(`counter-${productId}`);
            counter.value = parseInt(counter.value) + 1;
            validateCounter(productId);
        }

        function changeToCircle(productId) {
            document.querySelector(`#button-container-${productId} .button`).style.display = 'flex';
            document.querySelector(`#button-container-${productId} .button-capsule`).style.display = 'none';
        }

        function validateCounter(productId) {
            var counter = document.getElementById(`counter-${productId}`);
            if (parseInt(counter.value) <= 1) {
                counter.value = 1;
                changeToCircle(productId);
            }
        }
    </script>
    <!-- akhir script button counter animasi -->
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

    /* Media Iphone XE */
    /* @media (max-width: 375px) {
        .responsive-image {
            width: 280px !important;
        }

    } */

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

        .responsive-image {
            width: 230px !important;
        }


    }

    @media screen and (max-width: 280px) {
        img.card-img-top {
            max-width: 100%;
        }
    }
</style>

<script type="text/javascript">
    function increaseCount(b, id) {
        var input = b.previousElementSibling;
        console.log(input);
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        $('#Cqty' + id).val(value);
        $('#Bqty' + id).val(value);
    }

    function decreaseCount(b, id) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            $('#Cqty' + id).val(value);
            $('#Bqty' + id).val(value);

        }
    }
</script>
<?= $this->endSection(); ?>