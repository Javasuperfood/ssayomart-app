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
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container mb-5 d-none d-md-block">
            <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #ec2614;">
                <div class="container-fluid">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/img/logopanjang.png" width="170" height="50" alt="Logo Ssayomart" class="image-fluid">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link text-white" aria-current="page" href="<?= base_url() ?>">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Kategori
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($kategori as $k) : ?>
                                        <li><a class="dropdown-item" href="<?= base_url('produk/kategori/' . $k['slug']); ?>"><?= $k['nama_kategori']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white" aria-current="page" href="https://download.ssayomart.com">Download Aplikasi Ssayomart</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search" action="<?= base_url('search'); ?>" method="get">
                            <input class="form-control me-2 border-0" name="produk" value="<?= isset($_GET['produk']); ?>" type="search" placeholder="Cari sesuatu disini..." aria-label="Search">
                            <button class="btn btn-outline-light text-white" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav d-flex flex-row mx-3">
                            <!-- Icons -->
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="<?= base_url() ?>cart">
                                    <i class="bi bi-cart-fill fs-4 text-white"></i>
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0">
                                <a class="nav-link" href="<?= base_url() ?>wishlist">
                                    <i class="bi bi-heart-fill fs-4 text-white"></i>
                                </a>
                            </li>
                            <li class="nav-item me-3 me-lg-0 dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle fs-4 text-white"></i>
                                </a>
                                <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>setting">Setting</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>setting/alamat-list">Alamat</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url(); ?>logout">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
<!-- navbar Website -->