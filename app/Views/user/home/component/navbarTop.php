<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- NAVBAR Mobile-->
<?php if ($isMobile) : ?>
    <div id="mobileContent" style="margin-bottom: 25px;">
        <div class="container">
            <div class="row">
                <nav class="navbar px-md-1 navbar-top mx-md-1 top-0 rounded-bottom-4 shadow-sm" style="background-color : #ffff;">
                    <div class="container-fluid mx-1">
                        <div class="col-9 col-md-10">
                            <form class="border-0 mt-3" role="search" action="<?= base_url('search'); ?>" method="get">
                                <div class="input-group mb-3">
                                    <button type="submit" class="input-group-text border-0 rounded-3 bg-danger shadow-sm mx-0"><i class="text-white bi bi-search"></i></button>
                                    <input type="text" name="produk" class="mx-2 form-control border-1 border-danger rounded-3" placeholder="<?= lang('Text.cari_produk') ?>" aria-label="search" aria-describedby="basic-addon1">
                                </div>
                            </form>
                        </div>

                        <div class="col-3 col-md-2" style="flex: 0 0 0 !important;">
                            <!-- bahasa -->
                            <?php
                            $lang = session()->get('lang');
                            $flag = ($lang == 'en') ? 'inggris.png' : (($lang == 'kr') ? 'korea.png' : 'korin.png');
                            ?>
                            <div class="dropdown mx-md-3">
                                <button class="btn btn-transparent text-danger dropdown-toggle fs-6 border-0" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url() ?>assets/img/bahasa/<?= $flag; ?>" width="40px" alt="" class="flag-icon">
                                </button>
                                <div class="dropdown-menu dropdown-menu-white" aria-labelledby="languageDropdown">
                                    <a href="<?= site_url('lang/id'); ?>" class="dropdown-item <?= ($lang == 'id') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/korin.png" width="30px" alt="" class="flag-icon"></a>
                                    <a href="<?= site_url('lang/en'); ?>" class="dropdown-item <?= ($lang == 'en') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="30px" alt="" class="flag-icon"></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <style>
        /* style navbar */
        .navbar-top {
            border-radius: 0 !important;
            border-bottom-left-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
            border-top: 0 !important;
        }

        /* CSS untuk mengatur panel dropdown */
        .dropdown-menu {
            padding: 0;
            /* Menghapus padding bawaan */
            min-width: auto;
            /* Menghapus lebar minimum */

        }

        /* CSS untuk mengatur tampilan mobile */
        @media (max-width: 992px) {
            .dropdown-menu {
                right: 0;
                /* Mengatur posisi menu ke kanan */
                left: auto;
                top: 100%;
                /* Menempatkan menu di bawah ikon */
                border: none;
                /* Menghapus border */
                box-shadow: none;
                /* Menghapus shadow */
                position: absolute;
            }
        }

        @media (max-width: 280px) {

            .input-group>.form-control,
            .input-group>.form-floating,
            .input-group>.form-select {
                font-size: 12px;
                position: relative;
                flex: 1 1 auto;
                width: 1%;
                min-width: 0
            }

            .input-group {
                right: 5px;
                width: 200px;
            }

            /* Mengurangi ukuran dan margin pada ikon bahasa */
            .flag-icon {
                width: 40px;
                /* Atur ukuran ikon bahasa sesuai kebutuhan Anda */
            }

            .dropdown-toggle {
                padding: 0.1rem 0.5rem;
                /* Reduce padding for smaller screens */
            }

            .btn-wishlist {

                padding: 3px;
                /* Atur padding tombol sesuai kebutuhan Anda */
                width: 25px;
                /* Atur lebar tombol sesuai kebutuhan Anda */
                height: 25px;
                /* Atur tinggi tombol sesuai kebutuhan Anda */
                text-align: center;
                /* Tengahkan teks di dalam tombol */
            }

            /* Untuk mengurangkan ukuran ikon hati (wishlist) */
            .heart-icon {
                font-size: 16px;
                /* Atur ukuran ikon sesuai kebutuhan Anda */
            }

        }
    </style>
<?php else : ?>
    <!-- END OF NAVBAR -->

    <!-- navbar Website -->
    <div id="desktopContent">
        <div class="container-fluid fixed-top gx-0 mb-5">
            <div class="w-100">
                <div class="headerc" style="display: flex; justify-content: flex-end; padding: .4em 32px; margin-bottom: 0px; background: rgb(243, 244, 245);">
                    <div class="headerc__left" style="display: flex; float: left; align-items: center; margin-right: auto; font-size: 12px; margin-left: 30px;">
                        <a href="javascript:void(0);" class="headerc__label label--hover text-decoration-none text-dark">
                            <i class="bi bi-google-play mx-2"></i>Download Ssayomart Playstore
                        </a>
                        <div class="barcode-popup">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <img src="<?= base_url('assets/img/qr/play-store.png'); ?>" class="" width="120px" alt="" srcset="">
                                        </div>
                                        <div class="col">
                                            <p class="text-dark">Download Ssayomart di Play Store</p>
                                            <a href="https://play.google.com/store/apps/details?id=com.ssayomart" target="__blank">
                                                <img src="<?= base_url('assets/img/plays.png'); ?>" class="" width="120px" alt="" srcset="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="javascript:void(0);" class="headerc__label label--hover text-decoration-none text-dark mx-4">
                            <i class="bi bi-apple mx-2"></i>Download Ssayomart App Store
                        </a>
                        <div class="barcode-apps">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <img src="<?= base_url('assets/img/qr/apps-store.png'); ?>" class="" width="120px" alt="" srcset="">
                                        </div>
                                        <div class="col">
                                            <p class="text-dark">Download Ssayomart di App Store</p>
                                            <a href="https://apps.apple.com/id/app/ssayomart/id6447356667" target="__blank">
                                                <img src="<?= base_url('assets/img/Apps.png'); ?>" class="" width="120px" alt="" srcset="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="headerc__right" style="display: flex; justify-content: space-around; font-size: 12px;">
                        <a href="https://www.tiktok.com/@ssayomart.id" class="headerc__label label--hover text-decoration-none text-dark"><i class="bi bi-tiktok"></i></i></a>
                        <a href="https://www.instagram.com/ssayomart.id/" class="headerc__label label--hover text-decoration-none text-dark"><i class="bi bi-instagram"></i></i></a>
                        <a href="https://www.facebook.com/profile.php?id=61553754412116&locale=id_ID" class="headerc__label label--hover text-decoration-none text-dark mx-2"><i class="bi bi-facebook"></i></a>
                        <a href="<?= base_url(); ?>/pusat-bantuan" class="headerc__label label--hover text-decoration-none text-dark"><i class="bi bi-question-circle"></i> Pusat Bantuan</a>
                        <a href="<?= base_url(); ?>setting/sayo-care" class="headerc__label label--hover text-decoration-none text-dark">Tentang Ssayomart</a>
                        <a href="<?= base_url(); ?>setting/kebijakan-privasi" class="headerc__label label--hover text-decoration-none text-dark">Kebijakan Kami</a>
                        <a href="https://ssayomart.com/" class="headerc__label label--hover text-decoration-none text-dark" target="_blank">Company Profile</a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand rounded-bottom-4 shadow-sm" style="background-color: #ffff;">

                <div class="container">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/img/logo.png" width="50" height="50" alt="Logo Ssayomart" class="image-fluid">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link " aria-current="page" href="<?= base_url() ?>"><?= lang('Text.beranda'); ?></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= lang('Text.kategori') ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li><a class="dropdown-item" href="<?= base_url('produk/kategori/' . $k['slug']); ?>"><?= $k['nama_kategori']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" aria-current="page" href="https://download.ssayomart.com"><?= lang('Text.download') ?></a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" action="<?= base_url('search'); ?>" method="get">
                            <input value="<?= (isset($_GET['produk'])) ? $_GET['produk'] : ''; ?>" type="text" name="produk" class="form-control border-danger" placeholder="<?= lang('Text.cari_produk') ?>" aria-label="search" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-danger text-white mx-2" id="basic-addon1"><i class="bi bi-search text-white"></i></button>
                        </form>
                        <ul class="navbar-nav d-flex flex-row mx-3" data-toggle="tooltip" data-placement="bottom" title="cart">
                            <!-- Icons -->
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="<?= base_url() ?>cart">
                                    <i class="bi bi-cart-fill fs-4 text-danger position-relative">

                                        <div id="cartItem_0">
                                            <i class="bi bi-app-indicator position-absolute top-0 start-100 translate-middle text-danger"></i>
                                            <span id="cartItem_1" class="position-absolute top-0 start-100 translate-middle text-danger" style="font-size: 0.75rem;"><?= session()->get('countCart'); ?></span>
                                        </div>

                                    </i>
                                </a>
                            </li>

                            <?php if (auth()->loggedIn()) : ?>
                                <li class="nav-item me-3 me-lg-0 dropdown">
                                    <a class="nav-link dropdown-toggle text-danger" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Profil">
                                        <i class="bi bi-person-circle fs-4 text-danger"></i>
                                    </a>
                                    <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                        <?php if (auth()->user()->inGroup('superadmin', 'admin')) : ?>
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url(); ?>dashboard"><?= lang('Text.dashboard') ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url(); ?>setting"><?= lang('Text.setting') ?></a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url(); ?>setting/alamat-list"><?= lang('Text.alamat_tersimpan') ?></a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url(); ?>logout"><?= lang('Text.logout') ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php else : ?>
                                <li class="nav-item me-3 me-lg-0">
                                    <a class="nav-link" href="<?= base_url() ?>login">
                                        <i class="bi bi-person-fill-lock fs-4 text-danger"></i>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                        <!-- bahasa -->
                        <nav class="navbar navbar-expand-lg navbar-danger" data-toggle="tooltip" data-placement="bottom" title="Language">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <?php
                                            $lang = session()->get('lang');
                                            $flag = ($lang == 'en') ? 'inggris.png' : (($lang == 'kr') ? 'korea.png' : 'korin.png');
                                            ?>
                                            <button class="btn btn-transparent text-danger dropdown-toggle fs-6" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?= base_url() ?>assets/img/bahasa/<?= $flag; ?>" width="30px" alt="" class="flag-icon">
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-white">
                                                <a href="<?= site_url('lang/id'); ?>" class="dropdown-item <?= ($lang == 'id') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/korin.png" width="30px" alt="" class="flag-icon"> ID/KR</a>
                                                <a href="<?= site_url('lang/en'); ?>" class="dropdown-item <?= ($lang == 'en') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="30px" alt="" class="flag-icon"> EN</a>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!-- end -->
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Style navbar header -->
    <style>
        /* Mengubah warna ikon saat dihover */
        .headerc__label i:hover {
            color: #ce2614;
        }

        .headerc__right a:not(:first-child) {
            margin-left: 10px
        }

        .label--hover:hover {
            color: #ce2614;
            cursor: pointer;
        }

        .headerc__label {
            margin-bottom: 0;
        }
    </style>
    <!-- end navbar header -->

    <!-- pop up navhead -->
    <style>
        /* playstore */
        .barcode-popup {
            display: none;
            position: absolute;
            top: 25px;
            left: 10px;
            padding: 10px;
            z-index: 999;
        }

        .headerc__label:hover+.barcode-popup {
            display: block;
        }

        /* ios */
        .barcode-apps {
            display: none;
            position: absolute;
            top: 25px;
            left: 240px;
            padding: 10px;
            z-index: 999;
        }

        .headerc__label:hover+.barcode-apps {
            display: block;
        }
    </style>
    <!-- end -->

    <!-- efek garis bawah menu navbar dan hover -->
    <style>
        .navbar-nav .nav-item .nav-link {
            position: relative;
            transition: all 0.3s ease;

        }

        .navbar-nav .nav-item .nav-link::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #ce2614;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out 0s;

        }

        .navbar-nav .nav-item .nav-link:hover::before {
            visibility: visible;
            transform: scaleX(1);
        }
    </style>

    <script>
        function handleHover(element, popup) {
            element.addEventListener('mouseenter', function() {
                popup.style.display = 'block';
            });

            element.addEventListener('mouseleave', function() {
                popup.style.display = 'none';
            });

            popup.addEventListener('mouseenter', function() {
                popup.style.display = 'block';
            });

            popup.addEventListener('mouseleave', function() {
                popup.style.display = 'none';
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            var playstoreLabel = document.querySelector('.headerc__label:nth-child(1)');
            var appStoreLabel = document.querySelector('.headerc__label:nth-child(3)');
            var playstorePopup = document.querySelector('.barcode-popup');
            var appStorePopup = document.querySelector('.barcode-apps');

            handleHover(playstoreLabel, playstorePopup);
            handleHover(appStoreLabel, appStorePopup);
        });
    </script>
<?php endif; ?>
<!-- end Nav Desk -->