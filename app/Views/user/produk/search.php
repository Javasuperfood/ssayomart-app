<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>
<!-- Button Kategori -->
<br>
<!-- Card -->
<?= $this->include('user/produk/component/card') ?>

<?= $this->include('user/home/component/pagination'); ?>
<!-- fotter -->
<div class="footer-search" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
    <?= $this->include('user/home/component/navbarBottom') ?>
</div>



<!-- END -->
<?= $this->endSection(); ?>