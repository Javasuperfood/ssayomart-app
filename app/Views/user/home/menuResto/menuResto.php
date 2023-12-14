<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobile view -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container mt-2">
            <div class="card border-0 text-center font-family-poppins" style="background-color: #dcf7d0;">
                <div class="card-warning">
                    <span class="card-title text-dark fw-medium fs-5 text-capitalize" style="font-family: 'Noto Sans KR', sans-serif;"><strong>DAFTAR MENU RESTO</strong></h2>
                    </span>
                </div>
            </div>

            <div class="row text-center row-cols-3 mt-3">
                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-01.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-02.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-03.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-04.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-05.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-06.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php else : ?>
    <!-- end mobile view -->

    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-3">
            <div class="card border-0 text-center text-bold mb-3 font-family-poppins d-flex justify-content-center align-items-center" style="background-color: #C1E1C1;">
                <div class="card-success">
                    <span class="card-title text-dark fw-bold fs-2 text-capitalize">DAFTAR MENU RESTO</span>
                </div>
            </div>
            
            <div class="row text-center row-cols-3 py-3">
                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0 shadow-sm">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-01.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0 shadow-sm">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-02.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0 shadow-sm">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-03.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0 shadow-sm">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-04.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0 shadow-sm">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-05.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

                <div class="col-4 col-md-4 col-lg-2">
                    <div class="text-bg-light mb-3 bg-white border-0 shadow-sm">
                        <div class="px-0 py-0 mx-0 my-0">
                            <img src="assets/img/kategori/ICON CATEGORY-06.png" alt="Kategori" class="card-img-top">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php endif; ?>
<!-- End Desktop View -->
<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<?= $this->endSection(); ?>