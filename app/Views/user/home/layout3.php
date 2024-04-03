<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.prod.js"></script>

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- Panggil file CSS dari folder public/assets -->
    <link rel="stylesheet" href="<?= base_url('assets/css/cart2.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/produk.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/checkout2.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sayoCare.css') ?>">
    <?= $this->renderSection('custom_head') ?>
    <?= $this->include('user/home/cart/scriptCart/cartScriptInit'); ?>
</head>

<body>
    <?= $this->include('user/home/component/preloader') ?>
    <!-- navbar atas khusus pada detail produk -->
    <?= $this->include('user/home/component/navbarLayout') ?>
    <?= $this->renderSection('page-content') ?>
    <!-- <div class="pb-5 mt-5"></div> -->

    <div class="footer-search" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
        <!-- navbar bawah khusus pada detail produk -->
        <?= $this->include('user/home/component/navbarBlank') ?>
    </div>
    <!-- Bootstrap JS -->
    <?= $this->include('user/home/component/rajaOngkir/service') ?>
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/script-un-en.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/swiper.js"></script>
    <?= $this->include('user/home/cart/scriptCart/cartScriptMain'); ?>
    <?= $this->include('user/home/component/preloaderMobile'); ?>
</body>

</html>