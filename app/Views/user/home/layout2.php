<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.prod.js"></script>

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Panggil file CSS dari folder public/assets -->
    <link rel="stylesheet" href="<?= base_url('assets/css/produk.css') ?>">
</head>

<body>
    <?= $this->include('user/home/component/preloader') ?>
    <?= $this->include('user/home/component/navbarMain') ?>
    <?= $this->renderSection('page-content') ?>
    <!-- Bootstrap JS -->
    <?= $this->include('user/home/component/rajaOngkir/service') ?>
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/swiper.js"></script>
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
</body>

</html>