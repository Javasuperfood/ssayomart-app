<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- cupon view Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-2">
            <?php foreach ($kupon_model as $km) : ?>
                <div class="col pb-3">
                    <div class="card border-0 shadow-sm bg-white">
                        <img src="<?= base_url() ?>assets/img/promo/Clipped.png" class="card-img-top border-0 img-fluid img-thumbnail rounded-4" alt="...">
                        <div class="card-body border-0 bg-white text-center">
                            <p class="fs-5"><?= $km['nama']; ?></p>
                            <p class="text-secondary fs-6"><?= $km['kode']; ?></p>
                            <p class="text-secondary fs-6">Kupon Tersedia : <?= $km['available_kupon']; ?></p>
                        </div>
                        <div class="card-footer bg-light border-0 shadow-sm text-body-secondary d-flex justify-content-center">
                            <a href="<?= base_url() ?>" class="btn border-0 btn-danger">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php else : ?>
    <!-- cupon end view mobile -->

    <!-- view Desktop -->
    <div id="desktopContent" style="margin-top: 100px;">
        <div class="container py-5">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h2 class="mb-0"><?= $title; ?></h2>
                            <hr class="text-danger">
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($kupon_model as $km) : ?>
                    <div class="col pb-3">
                        <div class="card border-0 shadow-sm bg-white">
                            <img src="<?= base_url() ?>assets/img/promo/Clipped.png" class="card-img-top border-0 img-fluid img-thumbnail rounded-4" alt="...">
                            <div class="card-body border-0 bg-white text-center">
                                <p class="fs-5"><?= $km['nama']; ?></p>
                                <p class="text-secondary fs-6"><?= $km['kode']; ?></p>
                                <p class="text-secondary fs-6">Kupon Tersedia : <?= $km['available_kupon']; ?></p>
                            </div>
                            <div class="card-footer bg-light border-0 shadow-sm text-body-secondary d-flex justify-content-center">
                                <a href="<?= base_url() ?>" class="btn border-0 btn-danger">Belanja Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <!-- End Footer Desktop -->

<?php endif; ?>

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>