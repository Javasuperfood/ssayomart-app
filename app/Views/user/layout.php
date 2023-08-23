<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/component/header') ?>
</head>

<body>
    <?= $this->renderSection('page-content') ?>

    <?= $this->include('user/component/navbarBottom') ?>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>