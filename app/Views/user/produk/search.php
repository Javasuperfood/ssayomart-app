<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>
<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <!-- Card -->

        <div class="mt-4">
            <?= $this->include('user/produk/component/card2') ?>
        </div>

        <?= $this->include('user/home/component/pagination2'); ?>

        <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
        <!-- fotter -->
        <div class="footer-search" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
            <?= $this->include('user/home/component/navbarBottom') ?>
        </div>
    </div>
<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:50px;">
        <!-- Card -->
        <br>
        <div class="mt-5">
            <?= $this->include('user/produk/component/card') ?>
        </div>


        <?= $this->include('user/home/component/pagination'); ?>

        <button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>
        <!-- fotter -->
        <div class="footer-search" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
            <?= $this->include('user/home/component/navbarBottom') ?>
        </div>
    </div>
<?php endif; ?>
<!-- End Desktop View -->
<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<!-- END -->
<?= $this->endSection(); ?>