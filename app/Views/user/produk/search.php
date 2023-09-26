<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>
<!-- Button Kategori -->
<br>
<!-- Card -->
<?= $this->include('user/produk/component/card') ?>
<!-- fotter -->
<div class="mt-5" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
    <?= $this->include('user/home/component/navbarBottom') ?>
</div>



<!-- END -->
<?= $this->endSection(); ?>