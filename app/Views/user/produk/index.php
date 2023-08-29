<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>
<!-- Button Kategori -->
<?= $this->include('user/produk/component/kategori') ?>
<!-- Button Sub Kategori -->
<?= $this->include('user/produk/component/subkategori') ?>
<!-- Banner Slider -->
<?= $this->include('user/produk/component/bannerSlider') ?>
<!-- Card -->
<?= $this->include('user/produk/component/card') ?>
<!-- Card Slider -->
<?= $this->include('user/produk/component/cardSwiper') ?>




<!-- END -->
<?= $this->endSection(); ?>