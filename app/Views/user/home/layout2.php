<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.prod.js"></script>
</head>

<body>
    <?= $this->include('user/home/component/preloader') ?>
    <?= $this->include('user/home/component/navbarMain') ?>
    <?= $this->renderSection('page-content') ?>
    <!-- Bootstrap JS -->
    <?= $this->include('user/home/component/rajaOngkir/service') ?>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
</body>

</html>