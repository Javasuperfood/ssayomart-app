<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>
<!-- Button Kategori -->
<?= $this->include('user/produk/component/kategori') ?>
<!-- Button Sub Kategori -->
<?= $this->include('user/produk/component/subkategori') ?>
<!-- Card -->
<?= $this->include('user/produk/component/card') ?>
<!-- fotter -->
<div id="navbarBottom" style="position: fixed; bottom: 0; width: 100%;">
    <?= $this->include('user/home/component/navbarBottom') ?>
</div>



<!-- END -->
<?= $this->endSection(); ?>