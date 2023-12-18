<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>

<!-- tampilan Mobile dan Ipad -->
<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>
<?php if ($isMobile) : ?>
    <div class="container">
        <!-- Button Kategori -->
        <?= $this->include('user/produk/component/kategori') ?>
        <!-- Button Sub Kategori -->
        <?= $this->include('user/produk/component/subkategori') ?>
        <!-- Card -->
        <div class="mb-5 pb-5">
            <?= $this->include('user/produk/component/card2') ?>
            <?= $this->include('user/home/component/pagination2'); ?>
        </div>
        <!-- button Scroll Up -->
        <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
        <!-- Navbar Bottom -->
        <?= $this->include('user/home/component/navbarBottom') ?>
    </div>
    <!-- end tampilan mobile -->

<?php else : ?>
    <!-- tampilan Desktop -->
    <div class="container">
        <!-- Button Kategori -->
        <?= $this->include('user/produk/component/kategori') ?>
        <!-- button Scroll Up -->
        <button class="btn btn-danger d-flex justify-content-center align-items-center" id="scrollUpButton" title="Scroll to top"><i class="bi bi-chevron-up"></i></button>
    </div>
    <!-- end tampilan Desktop -->
<?php endif ?>
<?= $this->include('user/home/component/pagination'); ?>
<!-- END -->
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
<?= $this->endSection(); ?>