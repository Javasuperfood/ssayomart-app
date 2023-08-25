<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
</head>

<body>
    <?= $this->include('user/home/component/preloader') ?>
    <?= $this->renderSection('page-content') ?>

    <?= $this->include('user/home/component/navbarBottom') ?>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>