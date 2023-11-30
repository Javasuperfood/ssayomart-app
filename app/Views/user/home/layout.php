<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
    <!-- Panggil file CSS dari folder public/assets -->
    <link rel="stylesheet" href="<?= base_url('assets/css/produk.css') ?>">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Panggil file CSS dari folder public/assets -->
    <link rel="stylesheet" href="<?= base_url('assets/css/produk.css') ?>">
    <?= $this->renderSection('custom_head') ?>
    <?= $this->include('user/home/cart/scriptCart/cartScriptInit'); ?>
</head>

<body>
    <?= $this->include('user/home/component/preloader') ?>
    <?= $this->renderSection('page-content') ?>
    <div class="pb-5"></div>
    <?= $this->include('user/home/component/navbarBottom') ?>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/js/script-un-en.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/swiper.js"></script>
    <?= $this->include('user/home/cart/scriptCart/cartScriptMain'); ?>
    <script>
        // $('a').click(function() {
        //     var preloader = document.getElementById('preloader');
        //     if (preloader) {
        //         preloader.style.position = 'fixed';
        //         preloader.style.top = '0';
        //         preloader.style.left = '0';
        //         preloader.style.width = '100%';
        //         preloader.style.height = '100%';
        //         preloader.style.display = 'flex';
        //         preloader.style.justifyContent = 'center';
        //         preloader.style.alignItems = 'center';
        //         preloader.style.zIndex = '9999';
        //     }
        // })
    </script>
</body>

</html>