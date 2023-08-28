<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
</head>

<body>
    <?= $this->include('user/home/component/preloader') ?>
    <?= $this->include('user/home/component/navbarMain') ?>
    <?= $this->renderSection('page-content') ?>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/js/jquery/jquery.min.prod.js"></script>
    <?= $this->include('user/home/component/rajaOngkir/service') ?>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>