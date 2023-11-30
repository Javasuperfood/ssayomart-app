<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/produk/component/header') ?>
    <?= $this->include('user/home/cart/scriptCart/cartScriptInit'); ?>
</head>

<body>
    <?= $this->renderSection('page-content') ?>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/swiper.js"></script>
    <script src="<?= base_url() ?>assets/js/button.js"></script>
    <?= $this->include('user/home/cart/scriptCart/cartScriptMain'); ?>
</body>

</html>