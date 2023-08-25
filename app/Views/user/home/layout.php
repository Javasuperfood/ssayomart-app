<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('user/home/component/header') ?>
</head>

<body>
    <?= $this->renderSection('page-content') ?>
    <div class="pb-4"></div>
    <?= $this->include('user/home/component/navbarBottom') ?>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>