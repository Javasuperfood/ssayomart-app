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
                    <div class="row row-cols-2 d-md-flex d-flex d-sm-flex justify-content-center align-items-center text-center mt-3 ">
                        <div class="col-6 d-flex justify-content-start align-items-start">
                            <a href="<?= base_url(); ?>setting/alamat-list" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0 me-2" style="font-size: 12px;"><?= $alamat ?> <i class="bi bi-chevron-down"></i></a>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-end">
                            <a role="button" data-bs-toggle="modal" data-bs-target="#selectMarket" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0 ms-2" style="font-size: 12px;"><?= $marketSelected; ?> <i class="bi bi-chevron-down"></i></a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-9">
                            <h3 class="fw-bold py-3 fs-5"><?= lang('Text.welcome_setting') ?><?= $user['username']; ?></h3>
                        </div>
                        <div class="col-3 text-center">
                            <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>">
                                <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 80px; height: 80px;" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <div class="alert alert-danger rounded border-0" role="alert">
                        <div class="row">
                            <div class="col-2"><i class="bi bi-heart-pulse-fill text-danger fs-1 position-absolute top-50 start-0 translate-middle-y px-4"></i></div>
                            <div class="col-10 text-secondary" style="font-size: 14px;"><?= lang('Text.alert') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="card text-bg-light mb-4 shadow-sm border-0 rounded">
                        <div class="card-body">
                            <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= base_url(); ?>assets/img/coupon.png" alt="Kupon" class="card-img img-fluid" style="width: 20; height: 50;">
                                    </div>
                                    <div class="col">
                                        <h5 class="card-title text-dark d-flex text-center justify-content-center align-items-center" style="font-size: 14px;"><?= lang('Text.judul_kupon') ?></h5>
                                        <p class="card-text text-secondary d-flex text-center justify-content-center align-items-center" style="font-size: 14px;"><?= lang('Text.isi_kupon') ?></p>
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
                        <a href="<?= base_url(); ?>/setting/sayoCare" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-question-circle pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.tentang') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <!-- <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-headset pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.ssayomart_care') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a> -->

                        <a href="<?= base_url(); ?>/setting/kebijakanPrivasi" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-lock pe-2 text-secondary"></i> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.kebijakan_privasi') ?></span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>

                        </a>
                        <a role="button" data-bs-toggle="modal" data-bs-target="#modalLogout" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i>
                            <span class="py-0 my-0 text-secondary"><?= lang('Text.logout') ?> </span>
                            <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
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
        <div class="container">
            <input type="checkbox" id="check">
            <label class="chat-btn" for="check"><i class="bi bi-chat-dots"></i></label>
            <div class="wrapper shadow-sm">
                <label class="close-btn" for="check"><i class="bi bi-x"></i></label>
                <div class="header bg-danger">
                    <h6>Welcome, Chat me!</h6>
                </div>
                <div class="text-center p-2" style="font-size: 12px;">
                    <span>Apa masalah anda, laporkan kepada kami</span>
                </div>
                <div class="chat-form">
                    <input type="text" class="form-control" style="font-size: 12px;" placeholder="Name">
                    <input type="text" class="form-control" style="font-size: 12px;" placeholder="Email">
                    <textarea class="form-control" style="font-size: 12px;" placeholder="Your Text Message"></textarea>
                    <button class="btn btn-danger btn-block" style="font-size: 10px;">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <style>
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            z-index: 999;
            color: #ffff;
            font-size: 20px;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }

        .chat-btn {
            position: fixed;
            right: 20px;
            bottom: 67px;
            cursor: pointer;
            z-index: 999;
            border-radius: 50%;
            background-color: #ec2614;
            color: #fff;
            font-size: 22px;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.9s ease;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .chat-btn i {
            font-size: 22px;
            color: #fff !important
        }

        .chat-btn {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            color: #fff;
            font-size: 22px;
            border: none
        }

        .wrapper {
            border: 1px darkgrey;
            position: fixed;
            right: 20px;
            bottom: 127px;
            width: 250px;
            background-color: #fff;
            border-radius: 5px;
            opacity: 0;
            transition: all 0.4s
        }

        #check:checked~.wrapper {
            opacity: 1
        }

        .header {
            padding: 13px;

            border-radius: 5px 5px 0px 0px;
            margin-bottom: 10px;
            color: #fff
        }

        .chat-form {
            padding: 15px
        }

        .chat-form input,
        textarea,
        button {
            margin-bottom: 10px
        }

        .chat-form textarea {
            resize: none
        }

        .form-control:focus,
        .btn:focus {
            box-shadow: none
        }


        #check {
            display: none !important
        }

        /* Media Query untuk Samsung Galaxy Fold */
        @media screen and (max-width: 280px) {

            .close-btn,
            .chat-btn {
                /* Sesuaikan gaya untuk layar kecil di sini */
                right: 10px;
                bottom: 70px;
                font-size: 18px;
                width: 40px;
                height: 40px;
            }

            .wrapper {
                right: 29px;
                bottom: 120px;
                width: 200px;
            }

            .header {
                font-size: 14px;
            }

            .chat-form input,
            .chat-form textarea {
                font-size: 10px;
            }


        }
    </style>

    <style>
        /* Default styling for larger screens */
        .list-group-item {
            padding: 15px;
        }

        /* Responsive styling for smaller screens (Samsung Galaxy Fold) */
        @media screen and (max-width: 280px) {
            .list-group-item {
                padding: 10px 5px !important;
                font-size: 12px !important;
            }

            .social-links {
                margin-top: 10px;
            }

            img.img-thumbnail {
                width: 50px !important;
                height: 50px !important;
                margin-top: 15px !important;
            }
        }

        @media screen and (min-width: 768px) {
            h5.card-title.text-dark.d-flex.text-center.justify-content-center.align-items-center {
                font-size: 20px !important;
                margin-top: 50px !important;
            }
        }

        @media screen and (min-width: 820px) and (max-width: 1024px) {
            h5.card-title.text-dark.d-flex.text-center.justify-content-center.align-items-center {
                font-size: 24px !important;
                margin-top: 80px !important;
            }
        }
    </style>


<?php else : ?>
    <!-- end mobile&ipad -->

    <!-- Tampilan Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 ">
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
                                    <div class="alert alert-danger rounded border-0" role="alert">
                                        <div class="row">
                                            <div class="col-1"><i class="bi bi-heart-pulse-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-4"></i></div>
                                            <div class="col-9 text-secondary fs-6"><?= lang('Text.alert') ?></div>
                                        </div>
                                    </div>
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
                                        <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>" class="list-group-item pb-3 fw-bold">
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
                                        <a href="<?= base_url(); ?>/setting/sayoCare" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-question-circle pe-2 text-secondary"></i> <?= lang('Text.tentang') ?> <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>/setting/kebijakanPrivasi" class="list-group-item pb-3 fw-bold">
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