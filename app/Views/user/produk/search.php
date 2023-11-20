<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>

<!-- Card -->
<div class="mt-4">
    <?= $this->include('user/produk/component/card') ?>
</div>


<?= $this->include('user/home/component/pagination'); ?>

<button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
<!-- fotter -->
<div class="footer-search" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
    <?= $this->include('user/home/component/navbarBottom') ?>
</div>



<!-- END -->
<?= $this->endSection(); ?>