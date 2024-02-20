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
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h3 class="fw-bold py-3 fs-5"><?= lang('Text.welcome_setting') ?><?= $user['fullname']; ?></h3>
                        </div>
                        <!-- <div class="col-3 text-center">
                            <a href="<?= base_url(); ?>setting/detail-user">
                                <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 80px; height: 80px;" alt="...">
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <div class="row ">
                <div class="col">
                    <div class="alert alert-danger rounded border-0" role="alert">
                        <div class="row">
                            <div class="col-2"><i class="bi bi-heart-pulse-fill text-danger fs-1 position-absolute top-50 start-0 translate-middle-y px-4"></i></div>
                            <div class="col-10 text-secondary" style="font-size: 14px;"><?= lang('Text.alert') ?></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row mb-2 mt-3">
                <div class="col">
                    <div class="card text-bg-light mb-4 shadow-sm border-0 rounded">
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
                        <a href="<?= base_url(); ?>setting/detail-user" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-person-circle pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.detail_akun') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <!-- <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-heart pe-2 text-secondary"></i> <?= lang('Text.favorit') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a> -->
                        <a href="<?= base_url(); ?>setting/alamat-list" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-cursor pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"> <?= lang('Text.alamat_tersimpan') ?> </span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                    </ul>

                </div>
            </div>
            <div class="row row-cols-1 pb-5">
                <div class="col">
                    <h3><?= lang('Text.bantuan') ?></h3>
                    <ul class="list-group list-group-flush">
                        <a href="<?= base_url(); ?>setting/sayo-care" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-question-circle pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.tentang') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <!-- <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-headset pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.ssayomart_care') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a> -->

                        <a href="<?= base_url(); ?>/pusat-bantuan" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-universal-access-circle pe-2 text-secondary"></i> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.pusat_bantuan') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>

                        <a href="<?= base_url(); ?>setting/kebijakan-privasi" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-lock pe-2 text-secondary"></i> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.kebijakan_privasi') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>

                        <span data-bs-toggle="modal" data-bs-target="#modalLogout" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.logout') ?> </span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </span>
                        <div class="container mb-3">
                            <div class="row justify-content-center mt-4">
                                <div class="text-center"> <!-- Tambahkan class text-center untuk membuatnya berada di tengah horizontal -->
                                    <p class="mb-3 fw-bold"><?= lang('Text.ikuti_kami') ?> :</p>
                                    <div class="social-links d-flex justify-content-center ">
                                        <a href="https://www.youtube.com/channel/UCiaJvoHqRRlxxHERP7q11Bw" target="__blank" class="youtube btn btn-danger mx-2 social-icon"><i class="bi bi-youtube"></i></a>
                                        <a href="https://www.facebook.com/profile.php?id=61553754412116&locale=id_ID" target="__blank" class="facebook btn btn-danger mx-2 social-icon"><i class="bi bi-facebook"></i></a>
                                        <a href="https://www.instagram.com/ssayomart.id/" target="__blank" class="instagram btn btn-danger mx-2 social-icon"><i class="bi bi-instagram"></i></a>
                                        <a href="https://www.tiktok.com/@ssayomart.id" target="__blank" class="tiktok btn btn-danger mx-2 social-icon"><i class="bi bi-tiktok"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <button class="chat-btn border-0" data-bs-toggle="modal" data-bs-target="#modalFormEmail">
                <i class="bi bi-chat-dots fs-6"></i>
            </button>

            <div class="modal fade" id="modalFormEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold-sm" style="font-size: 14px;">Welcome, Contact me!</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle" style="position: absolute; top:7px; right:10px; cursor:pointer; z-index:999; color:#fff; font-size:20px; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; transition: all 0.3s ease;"></i></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('contact/send/email/v1'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="<?= $user['fullname']; ?>" style="font-size: 12px;">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email" placeholder="Email" style="font-size: 12px;">
                                </div>
                                <div class="mb-3">
                                    <input list="subjectList" type="text" name="subject" class="form-control" placeholder="Subject" style="font-size: 12px;">
                                    <datalist id="subjectList">
                                        <option value="[Ask × <?= $user['username']; ?>]"></option>
                                        <option value="[Help × <?= $user['username']; ?>]"></option>
                                        <option value="[Report × <?= $user['username']; ?>]"></option>
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="message" placeholder="Your Text Message" style="font-size: 12px;"></textarea>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button onclick="clickSubmitEvent(this)" type="submit" class="btn btn-block text-white border-0 d-flex justify-content-center" style="width: 100%; background-color: #ec2614; font-size: 12px;">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                    <div class="card border-0 shadow-sm mb-4">
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
                    <div class="card border-0 shadow-sm mb-4">
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
                            <div class="card border-0 shadow-sm mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3><?= lang('Text.setting') ?>
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>setting/detail-user" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-person-circle pe-2 text-secondary"></i> <?= lang('Text.detail_akun') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <!-- <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-heart pe-2 text-secondary"></i> <?= lang('Text.favorit') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a> -->
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

        <div class="container">
            <button class="chat-btn border-0" data-bs-toggle="modal" data-bs-target="#modalFormEmail">
                <i class="bi bi-chat-dots"></i>
            </button>

            <div class="modal fade" id="modalFormEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold-sm" style="font-size: 14px;">Welcome, Chat me!</h5>
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle" style="position: absolute; top:7px; right:10px; cursor:pointer; z-index:999; color:#fff; font-size:20px; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; transition: all 0.3s ease;"></i></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('contact/send/email/v1'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Name" style="font-size: 12px;">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" style="font-size: 12px;">
                                </div>
                                <div class="mb-3">
                                    <input list="subjectList" type="text" class="form-control" placeholder="Subject" style="font-size: 12px;">
                                    <datalist id="subjectList">
                                        <option value="[Ask × <?= $user['username']; ?>]"></option>
                                        <option value="[Help × <?= $user['username']; ?>]"></option>
                                        <option value="[Report × <?= $user['username']; ?>]"></option>
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" placeholder="Your Text Message" style="font-size: 12px;"></textarea>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" onclick="clickSubmitEvent(this)" class="btn btn-danger btn-block border-0" style="width: 100%; background-color: #ec2614; font-size: 12px;">Submit</button>
                                </div>
                            </form>
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