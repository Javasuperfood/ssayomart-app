<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent" style="margin-bottom:75px;">
        <div class="container">
            <div class="row">
                <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
                <nav class="navbar navbar-main fixed-top top-0 rounded-bottom-4 shadow-sm" style="background-color:#ffff; position: fixed;
                    top: 0;
                    width: 100%;
                    z-index: 1000;">
                    <div class="container-fluid mt-4">
                        <div class="col text-center position-relative d-flex justify-content-center align-items-center">
                            <?php if (isset($back)) : ?>
                                <?php $displayTitle = strlen($title) > 40 ? substr($title, 0, 40) . '...' : $title; ?>
                                <span onclick="location.href='<?= base_url(); ?><?= $back; ?>'" class="position-absolute top-50 start-0 translate-middle-y"><i class="bi bi-chevron-left navbar-brand"></i></span>
                                <span class="navbar-brand fw-bold" style="font-size: 12px; margin-left:30px;"><?= $displayTitle; ?></span>
                            <?php elseif (!isset($back)) : ?>
                                <?php $displayTitle = strlen($title) > 40 ? substr($title, 0, 40) . '...' : $title; ?>
                                <span onclick="history.back()" class="position-absolute top-50 start-0 translate-middle-y"><i class="bi bi-chevron-left navbar-brand"></i></span>
                                <span class="navbar-brand fw-bold" style="font-size: 12px; margin-left:30px;"><?= $displayTitle; ?></span>
                            <?php endif ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- navbar Website -->
    <div id="desktopContent">
        <div class="container mb-5">
            <nav class="navbar navbar-expand fixed-top shadow-sm" style="background-color: #ffff;">
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
                                <a class="nav-link text-secondary" aria-current="page" href="<?= base_url() ?>"><?= lang('Text.beranda'); ?></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= lang('Text.kategori'); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li><a class="dropdown-item" href="<?= base_url('produk/kategori/' . $k['slug']); ?>"><?= $k['nama_kategori']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-secondary" aria-current="page" href="https://download.ssayomart.com"><?= lang('Text.download'); ?></a>
                            </li>
                        </ul>
                        <form class="d-flex" onsubmit="searchValidate()" role="search" action="<?= base_url('search'); ?>" method="get">
                            <input id="search" value="<?= (isset($_GET['produk'])) ? $_GET['produk'] : ''; ?>" type="text" name="produk" class="form-control border-danger" placeholder="<?= lang('Text.cari_produk') ?>" aria-label="search" aria-describedby="basic-addon1">
                            <button type="submit" class="btn btn-danger text-white mx-2" id="basic-addon1"><i class="bi bi-search text-white"></i></button>
                        </form>
                        <ul class="navbar-nav d-flex flex-row mx-3">
                            <!-- Icons -->
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="<?= base_url() ?>cart">
                                    <i class="bi bi-cart-fill fs-4 text-danger position-relative">
                                        <?php if (session()->get('countCart') > 0) : ?>
                                            <i class="bi bi-app-indicator position-absolute top-0 start-100 translate-middle border-danger"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle text-danger" style="font-size: 0.75rem;"><?= session()->get('countCart'); ?></span>
                                        <?php endif ?>
                                    </i>
                                </a>
                            </li>

                            <?php if (auth()->loggedIn()) : ?>
                                <li class="nav-item me-3 me-lg-0 dropdown">
                                    <a class="nav-link dropdown-toggle text-danger" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle fs-4 text-danger"></i>
                                    </a>
                                    <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                        <?php if (auth()->user()->inGroup('superadmin', 'admin')) : ?>
                                            <li>
                                                <a class="dropdown-item" href="<?= base_url(); ?>dashboard"><?= lang('Text.dashboard') ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url(); ?>setting"><?= lang('Text.setting'); ?></a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url(); ?>setting/alamat-list"><?= lang('Text.alamat'); ?></a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url(); ?>logout"><?= lang('Text.logout'); ?></a>
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

<!-- navbar dekstop -->

<style>
    nav.navbar-main {
        border-radius: 0 !important;
        border-bottom-left-radius: 15px !important;
        border-bottom-right-radius: 15px !important;
        border-top: 0 !important;
    }

    /* CSS untuk tampilan seluler standar */
    @media (max-width: 280px) {
        .col.text-center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            /* Mengatur elemen .col agar berada di tengah-tengah dan dapat memanfaatkan space dengan baik */
        }

        .navbar-brand {
            font-size: 12px !important;
            /* Mengurangi ukuran font untuk judul agar sesuai dengan layar kecil */
        }

        .position-absolute.top-50.start-0.translate-middle-y {
            position: static;
            transform: none;
            /* Menghilangkan properti yang menggeser tombol kembali ke tengah */
        }
    }
</style>

<!-- End Desktop View -->