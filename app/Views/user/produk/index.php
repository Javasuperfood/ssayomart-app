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
            <?= $this->include('user/produk/component/card') ?>
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
        <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
    </div>
    <!-- end tampilan Desktop -->
<?php endif ?>
<?= $this->include('user/home/component/pagination'); ?>
<!-- END -->
<?= $this->endSection(); ?>