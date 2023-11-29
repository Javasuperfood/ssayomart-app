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
        <div class="container mt-5">
            <div class="row">
                <div class="col">

                    <p class="fs-3 text-center">Recomendasi E-Wallet</p>
                    <hr class="border-darker mt-0 mb-3">


                    <div style="height:80px;" class="card border-0 shadow-sm d-flex justify-content-center align-items-start">
                        <div class="icons">
                            <input type="radio" name="emoney" value="dana" class="mx-2">
                            <img src="<?= base_url() ?>assets/img/payment/dana.png" class="my-2 mx-2" width="50">
                            <span class="text-secondary">saldo Rp.1.000.000</span>
                        </div>
                    </div>
                    <div style="height:80px;" class="mt-2 card border-0 shadow-sm d-flex justify-content-center align-items-start">
                        <div class="icons">
                            <input type="radio" name="emoney" value="dana" class="mx-2">
                            <img src="<?= base_url() ?>assets/img/payment/ovo.png" class="my-2 mx-2" width="30">
                            <span class="text-secondary">saldo Rp.1.000.000</span>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <p class="fs-3 text-center">E-Wallet lainnya</p>
                    <hr class="border-darker mt-0 mb-3">

                    <div style="height:80px;" class="card border-0 shadow-sm d-flex justify-content-center align-items-start">
                        <div class="icons">
                            <input type="radio" name="emoney" value="dana" class="mx-2">
                            <img src="<?= base_url() ?>assets/img/payment/Gopay.png" class="my-2 mx-2" width="80">
                            <span class="text-secondary">saldo Rp.1.000.000</span>
                        </div>
                    </div>
                    <div style="height:80px;" class="mt-2 card border-0 shadow-sm d-flex justify-content-center align-items-start">
                        <div class="icons">
                            <input type="radio" name="emoney" value="dana" class="mx-2">
                            <img src="<?= base_url() ?>assets/img/payment/ShopeePay.png" class="my-2 mx-2" width="80">
                            <span class="text-secondary">saldo Rp.1.000.000</span>
                        </div>
                    </div>
                    <div style="height:80px;" class="mt-2 card border-0 shadow-sm d-flex justify-content-center align-items-start">
                        <div class="icons">
                            <input type="radio" name="emoney" value="dana" class="mx-2">
                            <img src="<?= base_url() ?>assets/img/payment/linkaja.png" class="my-2 mx-2" width="30">
                            <span class="text-secondary">saldo Rp.1.000.000</span>
                        </div>
                    </div>
                    <div class="btn btn-danger d-block mt-4">PAY <span class="fas fa-dollar-sign ms-2"></span>Rp 15.000.000<span class="ms-3 fas fa-arrow-right"></span></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <style>
        .border-darker {
            border-color: red;
            border-width: 2px;
            font-weight: bold;
        }
    </style>

<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:50px;">
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