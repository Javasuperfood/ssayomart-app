<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarMain') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/setting.css') ?>">

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <h3 class="fw-bold fs-5">
                                    <?= lang('Text.welcome_setting') ?>
                                    <br>
                                    <?= $user['fullname']; ?>
                                </h3>
                                <div class="" style="flex: 0 0 0 !important;">
                                    <!-- bahasa -->
                                    <?php
                                    $lang = session()->get('lang');
                                    $flag = ($lang == 'en') ? 'inggris.png' : (($lang == 'kr') ? 'korea.png' : 'indonesia.png');
                                    ?>
                                    <div class="dropdown mx-md-3" style="margin-top: -10px;">
                                        <button class="btn btn-transparent text-danger dropdown-toggle fs-6 border-0" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="<?= base_url() ?>assets/img/bahasa/<?= $flag; ?>" width="40px" alt="" class="flag-icon">
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-white border-0" style="background-color: transparent;" aria-labelledby="languageDropdown">
                                            <a href="<?= site_url('lang/id'); ?>" class="d-flex justify-content-end align-items-end dropdown-item <?= ($lang == 'id') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/indonesia.png" width="40px" alt="" class="flag-icon"></a>
                                            <a href="<?= site_url('lang/kr'); ?>" class="d-flex justify-content-end align-items-end dropdown-item <?= ($lang == 'kr') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/korea.png" width="40px" alt="" class="flag-icon"></a>
                                            <a href="<?= site_url('lang/en'); ?>" class="d-flex justify-content-end align-items-end dropdown-item <?= ($lang == 'en') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="40px" alt="" class="flag-icon"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2 mt-3">
                <div class="col">
                    <div class="card text-bg-light mb-4 shadow border-0 rounded">
                        <div class="card-body">
                            <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                        <img src="<?= base_url(); ?>assets/img/coupon.png" alt="Kupon" class="card-img img-fluid" style="width: 20; height: 50;">
                                    </div>
                                    <div class="col d-flex justify-content-center align-items-center">
                                        <p class="fw-bold card-title text-dark teks-kupon" style="font-size: 14px;"><?= lang('Text.judul_kupon') ?>
                                            <br><?= lang('Text.isi_kupon') ?>
                                        </p>
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
                        <a href="<?= base_url(); ?>setting/detail-user" class="list-group-item pb-3 fw-bold mb-2 shadow-sm rounded-3">
                            <i class="bi bi-person-circle pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.detail_akun') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting/alamat-list" class="list-group-item mb-3 fw-bold shadow-sm rounded-3">
                            <i class="bi bi-cursor pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"> <?= lang('Text.alamat_tersimpan') ?> </span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                    </ul>

                </div>
            </div>
            <div class="row row-cols-1 pb-3">
                <div class="col">
                    <h3><?= lang('Text.bantuan') ?></h3>
                    <ul class="list-group list-group-flush">
                        <a href="<?= base_url(); ?>setting/sayo-care" class="list-group-item pb-3 fw-bold mb-2 shadow-sm rounded-3">
                            <i class="bi bi-question-circle pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.tentang') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>/pusat-bantuan" class="list-group-item pb-3 fw-bold mb-2 shadow-sm rounded-3">
                            <i class="bi bi-universal-access-circle pe-2 text-secondary"></i> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.pusat_bantuan') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>

                        <a href="<?= base_url(); ?>setting/kebijakan-privasi" class="list-group-item pb-3 fw-bold mb-2 shadow-sm rounded-3">
                            <i class="bi bi-lock pe-2 text-secondary"></i> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.kebijakan_privasi') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>

                        <span data-bs-toggle="modal" data-bs-target="#modalLogout" class="list-group-item pb-3 fw-bold mb-2 shadow-sm rounded-3">
                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.logout') ?> </span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </span>

                        <div class="container mb-3">
                            <div class="row justify-content-center mt-4">
                                <div class="text-center"> <!-- Tambahkan class text-center untuk membuatnya berada di tengah horizontal -->
                                    <p class="mb-3 fw-bold"><?= lang('Text.ikuti_kami') ?> :</p>
                                    <div class="social-links d-flex justify-content-center ">
                                        <a href="https://www.youtube.com/channel/UCiaJvoHqRRlxxHERP7q11Bw" target="__blank" class="youtube btn btn-outline-danger mx-2 social-icon"><i class="bi bi-youtube"></i></a>
                                        <a href="https://www.facebook.com/profile.php?id=61553754412116&locale=id_ID" target="__blank" class="facebook btn btn-outline-danger mx-2 social-icon"><i class="bi bi-facebook"></i></a>
                                        <a href="https://www.instagram.com/ssayomart.id/" target="__blank" class="instagram btn btn-outline-danger mx-2 social-icon"><i class="bi bi-instagram"></i></a>
                                        <a href="https://www.tiktok.com/@ssayomart.id" target="__blank" class="tiktok btn btn-outline-danger mx-2 social-icon"><i class="bi bi-tiktok"></i></a>
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
    <div id="desktopContent" style="margin-top:130px;">
        <div class="container py-5 ">
            <div class="row ">
                <div class="col mb-5">
                    <h3 class="fw-bold text-center"><i class="fs-1 text-danger fw-bold bi bi-gear"></i>
                        <?= lang('Text.title_setting') ?>
                    </h3>
                    <hr class="mb-3 border-danger" style="border-width: 3px;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body text-center" style="height: 325px;">
                            <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" alt="profile" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                            <h3 class="fw-bold  fs-5"><?= lang('Text.welcome_setting') ?><?= $user['username']; ?></h3>
                            <div class="row row-cols-1">
                                <div class="col">
                                    <a href="<?= base_url(); ?>setting/alamat-list" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= $alamat ?> <i class="bi bi-chevron-down"></i></a>
                                </div>
                                <div class="col pt-3">
                                    <a role="button" data-bs-toggle="modal" data-bs-target="#selectMarket" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= $marketSelected; ?> <i class="bi bi-chevron-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- <div class="alert alert-danger rounded border-0" role="alert">
                                        <div class="row">
                                            <div class="col-1"><i class="bi bi-heart-pulse-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-4"></i></div>
                                            <div class="col-9 text-secondary fs-6"><?= lang('Text.alert') ?></div>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 border-0 rounded">
                                            <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="<?= base_url(); ?>assets/img/coupon.png" alt="" class="card-img">
                                                    </div>
                                                    <div class="col-9 mt-5 text-center">
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
                    <div class=" row">
                        <div class="col-md-6">
                            <div class="card border-0 shadow mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3><?= lang('Text.setting') ?>
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>setting/detail-user" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-person-circle pe-2 text-secondary"></i> <?= lang('Text.detail_akun') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
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
                            <div class="card border-0 shadow mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3><?= lang('Text.bantuan') ?></h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>history" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-clock-history pe-2 text-secondary"></i> <?= lang('Text.riwayat') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting/sayo-care" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-question-circle pe-2 text-secondary"></i> <?= lang('Text.tentang') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting/kebijakan-privasi" class="list-group-item pb-3 fw-bold">
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