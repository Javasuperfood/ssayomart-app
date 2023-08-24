<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
</head>

<body>
    <?= $this->include('user/home/component/navbarMain') ?>
    <?= $this->renderSection('page-content') ?>

    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>