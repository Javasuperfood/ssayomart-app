<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?= csrf_hash() ?>">
<title><?= $title; ?></title>
<link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logo.png" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    .carousel-item img {
        border-radius: 5%;
    }
</style>
<script src="<?= base_url(); ?>assets/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Link ke Popper.js (sesuaikan versi jika diperlukan) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
<!-- Link ke jQuery (diperlukan untuk Bootstrap) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>