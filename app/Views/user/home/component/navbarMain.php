<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <nav class="navbar pt-3">
            <div class="container-fluid">
                <div class="col text-center position-relative">
                    <?php if (isset($back)) : ?>
                        <span onclick="location.href='<?= base_url(); ?><?= $back; ?>'" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></span>
                        <span class="navbar-brand"><?= $title; ?></span>
                    <?php elseif (!isset($back)) : ?>
                        <span onclick="history.back()" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></span>
                        <span class="navbar-brand"><?= $title; ?></span>
                    <?php endif ?>
                </div>
            </div>
        </nav>
    </div>
<?php else : ?>
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
                                    <?= lang('Text.kategori'); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li><a class="dropdown-item" href="<?= base_url('produk/kategori/' . $k['slug']); ?>"><?= $k['nama_kategori']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white" aria-current="page" href="https://download.ssayomart.com"><?= lang('Text.download'); ?></a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" action="<?= base_url('search'); ?>" method="get">
                            <input value="<?= (isset($_GET['produk'])) ? $_GET['produk'] : ''; ?>" type="text" name="produk" class="form-control-main" placeholder="<?= lang('Text.cari_produk'); ?>" aria-label="search" aria-describedby="basic-addon1">
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
                                        <i class="bi bi-box-arrow-in-right fs-4 text-white"> Login</i>

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
                                                <a href="<?= site_url('lang/id'); ?>" class="dropdown-item <?= ($lang == 'id') ? 'd-none' : ''; ?>" href="javascript:void(0);" onclick="changeFlag('indonesia')"><img src="<?= base_url() ?>assets/img/bahasa/indonesia.png" width="30px" alt="" class="flag-icon"> Indonesia</a>
                                                <a href="<?= site_url('lang/en'); ?>" class="dropdown-item <?= ($lang == 'en') ? 'd-none' : ''; ?>" href="javascript:void(0);" onclick="changeFlag('inggris')"><img src="<?= base_url() ?>assets/img/bahasa/inggris.png" width="30px" alt="" class="flag-icon"> English</a>
                                                <a href="<?= site_url('lang/kr'); ?>" class="dropdown-item <?= ($lang == 'kr') ? 'd-none' : ''; ?>" href="javascript:void(0);" onclick="changeFlag('korea')"><img src="<?= base_url() ?>assets/img/bahasa/korea.png" width="30px" alt="" class="flag-icon"> Korea</a>
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

<!-- navbar Website -->