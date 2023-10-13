<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- NAVBAR Mobile-->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-none">
            <div class="row">
                <nav class="navbar pt-4 rounded-bottom-3" style="background-color : #fff; padding-bottom : 80px;">
                    <div class="container-fluid mx-3">
                        <div class="col-8">
                            <form class="border-0 mt-3" role="search" action="<?= base_url('search'); ?>" method="get">
                                <div class="input-group mb-3">
                                    <span class="input-group-text border-0 rounded-3 bg-danger shadow-sm"><i class="text-white bi bi-search"></span></i>
                                    <input type="text" name="produk" class="mx-2 form-control border-1 border-danger shadow-sm rounded-3" placeholder="<?= lang('Text.cari_produk') ?>" aria-label="search" aria-describedby="basic-addon1">
                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <a href="<?= base_url(); ?>wishlist" class="btn btn-outline-danger rounded-circle ms-3 fs-6 btn-wishlist">
                                <i class="bi bi-heart-fill heart-icon" style="color: #ec2614"></i>
                            </a>
                        </div>

                        <div class="col-2">
                            <!-- bahasa -->
                            <?php
                            $lang = session()->get('lang');
                            $flag = ($lang == 'en') ? 'inggris.png' : (($lang == 'kr') ? 'korea.png' : 'indonesia.png');
                            ?>
                            <div class="dropdown">
                                <button class="btn btn-transparent text-white dropdown-toggle fs-6 d-lg-none border-0" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url() ?>assets/img/bahasa/<?= $flag; ?>" width="40px" alt="" class="flag-icon">
                                </button>
                                <div class="dropdown-menu dropdown-menu-white" aria-labelledby="languageDropdown">
                                    <a href="<?= site_url('lang/id'); ?>" class="dropdown-item <?= ($lang == 'id') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/indonesia.png" width="30px" alt="" class="flag-icon"></a>
                                    <a href="<?= site_url('lang/en'); ?>" class="dropdown-item <?= ($lang == 'en') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="30px" alt="" class="flag-icon"></a>
                                    <a href="<?= site_url('lang/kr'); ?>" class="dropdown-item <?= ($lang == 'kr') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/korea.png" width="30px" alt="" class="flag-icon"></a>
                                </div>
                            </div>
                            <!-- end -->
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- END OF NAVBAR -->

    <!-- navbar Website -->
    <div id="desktopContent">
        <div class="container mb-5 d-none d-md-block">
            <nav class="navbar navbar-expand fixed-top" style="background-color: #ec2614;">
                <div class="container">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/img/logopanjang.png" width="170" height="50" alt="Logo Ssayomart" class="image-fluid">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link text-white" aria-current="page" href="<?= base_url() ?>"><?= lang('Text.beranda'); ?></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= lang('Text.kategori') ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li><a class="dropdown-item" href="<?= base_url('produk/kategori/' . $k['slug']); ?>"><?= $k['nama_kategori']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white" aria-current="page" href="https://download.ssayomart.com"><?= lang('Text.download') ?></a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" action="<?= base_url('search'); ?>" method="get">
                            <input value="<?= (isset($_GET['produk'])) ? $_GET['produk'] : ''; ?>" type="text" name="produk" class="form-control" placeholder="<?= lang('Text.cari_produk') ?>" aria-label="search" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-outline-light text-white mx-2" id="basic-addon1"><i class="bi bi-search"></i></button>
                        </form>
                        <ul class="navbar-nav d-flex flex-row mx-3">
                            <!-- Icons -->
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="<?= base_url() ?>cart">
                                    <i class="bi bi-cart-fill fs-4 text-white position-relative">
                                        <?php if (session()->get('countCart') > 0) : ?>
                                            <i class="bi bi-chat-fill position-absolute top-0 start-100 translate-middle text-white"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle text-danger" style="font-size: 0.75rem;"><?= session()->get('countCart'); ?></span>
                                        <?php endif ?>
                                    </i>
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="<?= base_url() ?>wishlist">
                                    <i class="bi bi-heart-fill fs-4 text-white"></i>
                                    <!-- <span class="badge rounded-pill badge-notification bg-danger">1</span> -->
                                </a>
                            </li>
                            <?php if (auth()->loggedIn()) : ?>
                                <li class="nav-item me-3 me-lg-0 dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle fs-4 text-white"></i>
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
                                        <i class="bi bi-person-fill-lock fs-4 text-white "></i>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                        <!-- bahasa -->
                        <nav class="navbar navbar-expand-lg navbar-danger">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <?php
                                            $lang = session()->get('lang');
                                            $flag = ($lang == 'en') ? 'inggris.png' : (($lang == 'kr') ? 'korea.png' : 'indonesia.png');
                                            ?>
                                            <button class="btn btn-transparent text-white dropdown-toggle fs-6" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?= base_url() ?>assets/img/bahasa/<?= $flag; ?>" width="30px" alt="" class="flag-icon">
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-white">
                                                <a href="<?= site_url('lang/id'); ?>" class="dropdown-item <?= ($lang == 'id') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/indonesia.png" width="30px" alt="" class="flag-icon"> Indonesia</a>
                                                <a href="<?= site_url('lang/en'); ?>" class="dropdown-item <?= ($lang == 'en') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="30px" alt="" class="flag-icon"> English</a>
                                                <a href="<?= site_url('lang/kr'); ?>" class="dropdown-item <?= ($lang == 'kr') ? 'd-none' : ''; ?>"><img src="<?= base_url() ?>assets/img/bahasa/korea.png" width="30px" alt="" class="flag-icon"> Korea</a>
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

<?php endif; ?>

<!-- end Nav Desk -->
<style>
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
        .input-group {
            right: 20px;
            width: 165px;
        }



        /* Mengurangi ukuran dan margin pada ikon bahasa */
        .flag-icon {
            width: 25px;
            /* Atur ukuran ikon bahasa sesuai kebutuhan Anda */
            margin-right: 5px;
            /* Sesuaikan margin kanan sesuai kebutuhan Anda */
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




<!-- end Nav Desk -->