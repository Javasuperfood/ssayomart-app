<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarMain') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-blok d-lg-none d-xl-none">
            <div class="row">
                <div class="col">
                    <div class="row row-cols-1">
                        <div class="col">
                            <a href="<?= base_url(); ?>setting/alamat-list" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= (!$alamat) ? lang('Text.btn_tambah') : $alamat['label']; ?> <i class="bi bi-chevron-down"></i></a>
                        </div>
                        <div class="col pt-3">
                            <a role="button" data-bs-toggle="modal" data-bs-target="#selectMarket" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= $marketSelected; ?> <i class="bi bi-chevron-down"></i></a>
                        </div>
                    </div>

                    <div class="row pb-4">
                        <div class="col-9">
                            <h3 class="fw-bold py-3 fs-5"><?= lang('Text.welcome_setting') ?><?= $user['username']; ?></h3>
                        </div>
                        <div class="col-3">
                            <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>">
                                <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 80px; height: 80px;" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col">
                    <div class="alert alert-danger rounded border-0" role="alert">
                        <div class="row">
                            <div class="col-1"><i class="bi bi-heart-pulse-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i></div>
                            <div class="col-9 text-secondary fs-6"><?= lang('Text.alert') ?></div>
                            <div class="col-2 text-end"><a href="#" class="link-primary link-underline link-underline-opacity-0 text-dark"><?= lang('Text.alert_btn') ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-1">
                <div class="col">
                    <div class="card text-bg-light mb-3 shadow border-0 rounded">
                        <div class="card-body">
                            <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                <div class="row">
                                    <div class="col-3"><img src="<?= base_url(); ?>assets/img/coupon.png" alt="" class="card-img"></div>
                                    <div class="col">
                                        <h5 class="card-title text-dark"><?= lang('Text.judul_kupon') ?></h5>
                                        <p class="card-text text-secondary"><?= lang('Text.isi_kupon') ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1">
                <div class="col">
                    <h3><?= lang('Text.setting') ?></h3>
                    <ul class="list-group list-group-flush">
                        <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-person-circle pe-2 text-secondary"></i> <?= lang('Text.detail_akun') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-heart pe-2 text-secondary"></i> <?= lang('Text.favorit') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting/alamat-list" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-cursor pe-2 text-secondary"></i> <?= lang('Text.alamat_tersimpan') ?>n <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                    </ul>

                </div>
            </div>
            <div class="row row-cols-1 pb-5">
                <div class="col">
                    <h3><?= lang('Text.bantuan') ?></h3>
                    <ul class="list-group list-group-flush">
                        <a href="<?= base_url(); ?>/setting/sayoCare" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-question-circle pe-2 text-secondary"></i> <?= lang('Text.tentang') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-headset pe-2 text-secondary"></i> <?= lang('Text.ssayomart_care') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-lock pe-2 text-secondary"></i> <?= lang('Text.kebijakan_privasi') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a role="button" data-bs-toggle="modal" data-bs-target="#modalLogout" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i> <?= lang('Text.logout') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <div class="container mb-3">
                            <div class="row justify-content-center mt-4">
                                <div class="text-center"> <!-- Tambahkan class text-center untuk membuatnya berada di tengah horizontal -->
                                    <p class="mb-3 fw-bold"><?= lang('Text.ikuti_kami') ?> :</p>
                                    <div class="social-links d-flex justify-content-center">
                                        <a href="#" class="youtube btn btn-danger mx-2 rounded-circle"><i class="bi bi-youtube"></i></a>
                                        <a href="#" class="facebook btn btn-danger mx-2 rounded-circle"><i class="bi bi-facebook"></i></a>
                                        <a href="#" class="instagram btn btn-danger mx-2 rounded-circle"><i class="bi bi-instagram"></i></a>
                                        <a href="#" class="tiktok btn btn-danger mx-2 rounded-circle"><i class="bi bi-tiktok"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- end mobile&ipad -->

    <!-- Tampilan Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 d-none d-lg-block">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center" style="height: 325px;">
                            <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" alt="profile" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                            <h3 class="fw-bold  fs-5"><?= lang('Text.welcome_setting') ?><?= $user['username']; ?></h3>
                            <a href="<?= base_url(); ?>setting/alamat-list" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= (!$alamat) ? lang('Text.btn_tambah') : $alamat['label']; ?> <i class="bi bi-chevron-down"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger rounded border-0" role="alert">
                                        <div class="row">
                                            <div class="col-1"><i class="bi bi-heart-pulse-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i></div>
                                            <div class="col-9 text-secondary fs-6"><?= lang('Text.alert') ?></div>
                                            <div class="col-2 text-end"><a href="#" class="link-primary link-underline link-underline-opacity-0 text-dark"><?= lang('Text.alert_btn') ?></a></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card text-bg-light mb-3 shadow-sm border-0 rounded">
                                            <div class="card-body">
                                                <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                                    <div class="row">
                                                        <div class="col-3"><img src="<?= base_url(); ?>assets/img/coupon.png" alt="" class="card-img"></div>
                                                        <div class="col">
                                                            <h5 class="card-title text-dark"><?= lang('Text.judul_kupon') ?></h5>
                                                            <p class="card-text text-secondary"><?= lang('Text.isi_kupon') ?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3><?= lang('Text.setting') ?>
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-person-circle pe-2 text-secondary"></i> <?= lang('Text.detail_akun') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-heart pe-2 text-secondary"></i> <?= lang('Text.favorit') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting/alamat-list" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-cursor pe-2 text-secondary"></i> <?= lang('Text.alamat_tersimpan') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>logout" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i> <?= lang('Text.logout') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3><?= lang('Text.bantuan') ?></h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>history" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-clock-history pe-2 text-secondary"></i> <?= lang('Text.riwayat') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>/setting/sayoCare" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-question-circle pe-2 text-secondary"></i> <?= lang('Text.tentang') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-headset pe-2 text-secondary"></i> <?= lang('Text.ssayomart_care') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-lock pe-2 text-secondary"></i> <?= lang('Text.kebijakan_privasi') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->

<!-- Modal setting  -->
<?= $this->include('user/component/modalSetting'); ?>

<?php if (session()->getFlashdata('success')) : ?>
    <script type="module">
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: ' <?= session()->getFlashdata('success') ?>',
        })
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('failed')) : ?>
    <script type="module">
        Swal.fire({
            icon: 'failed',
            title: 'Error',
            text: ' <?= session()->getFlashdata('failed') ?>',
        })
    </script>
<?php endif; ?>
<?= $this->endSection(); ?>