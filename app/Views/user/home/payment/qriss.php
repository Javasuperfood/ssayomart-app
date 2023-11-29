<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <div class="row mx-0 pt-5 d-flex justify-content-center">
                <div class="col-xs-4 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-header card-header-divider text-center pt-4">
                            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin%3A1DonateWffyhwAjskoEwXt83pHZxhLTr8H%3Famount%3D0.15050000" style="max-width: 190px;" alt="">
                        </div>
                        <div class="container mt-2">
                            <div class="alert alert-danger px-0 text-center" style="font-size: 14px;">
                                <p> Scan QR-Code diatas untuk melakukan Pembayarran</p>
                            </div>
                        </div>
                        <div class="card-body px-0 mb-2">
                            <p class="text-muted text-center">Copy link ini</p>
                            <p class="text-center"><small><strong>ssayomartm417c1ng1774nia5l3b3w</strong></small></p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-danger btn-sm mx-2" style="font-size: 14px;">Selesai</button>
                                <button class="btn btn-danger btn-sm mx-2" style="font-size: 14px;">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>
    <!-- tampilan Desktop -->
    <div id="desktopContent">

        <div id="mobileContent">
            <div class="container pt-5">
                <div class="row mx-0 pt-5 d-flex justify-content-center">
                    <div class="col-xs-4 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-header card-header-divider text-center pt-4"><img src="https://apirone.com/static/promo/bitcoin_logo_vector.svg" class="img-fluid" style="max-height: 42px;" width="205" alt=""><br>
                                <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin%3A1DonateWffyhwAjskoEwXt83pHZxhLTr8H%3Famount%3D0.15050000" style="max-width: 190px;" alt="">
                            </div>
                            <div class="container mt-2">
                                <div class="alert alert-danger px-0 text-center" style="font-size: 14px;">
                                    <p> Scan QR-Code diatas untuk melakukan Pembayarran</p>
                                </div>
                            </div>
                            <div class="card-body px-0 mb-2">
                                <p class="text-muted text-center">Copy link ini</p>
                                <p class="text-center"><small><strong>ssayomartm417c1ng1774nia5l3b3w</strong></small></p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger btn-sm mx-2" style="font-size: 14px;">Selesai</button>
                                    <button class="btn btn-danger btn-sm mx-2" style="font-size: 14px;">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php endif; ?>
<!-- tampilan Desktop -->


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