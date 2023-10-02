<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>

<!-- tampilan Mobile dan Ipad -->
<div class="container d-lg-none mb-4">
    <!-- Button Kategori -->
    <?= $this->include('user/produk/component/kategori') ?>
    <!-- Button Sub Kategori -->
    <?= $this->include('user/produk/component/subkategori') ?>
    <!-- Card -->
    <?= $this->include('user/produk/component/card') ?>
    <!-- button Scroll Up -->
    <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
</div>
<!-- end tampilan mobile -->

<!-- tampilan Desktop -->
<div class="container d-none d-lg-block">
    <!-- Button Kategori -->
    <?= $this->include('user/produk/component/kategori') ?>
    <!-- button Scroll Up -->
    <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
</div>
<!-- end tampilan Desktop -->
<?= $this->include('user/home/component/pagination'); ?>
<!-- END -->
<?= $this->endSection(); ?>