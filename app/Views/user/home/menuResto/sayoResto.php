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
        <div class="container">
            <img src="<?= base_url() ?>assets/img/ssayoresto/restobanner.jpg" class="d-block w-100 rounded-3">
        </div>
        <!-- <div class="container py-5">
            <div class="card">
                <div class="tools">
                    <div class="circle">
                        <span class="red box"></span>
                    </div>
                    <div class="circle">
                        <span class="yellow box"></span>
                    </div>
                    <div class="circle">
                        <span class="green box"></span>
                    </div>
                </div>
                <div class="card__content">
                    <p class="title" style="color: #ce2614; margin-left: 10px; font-size: 25px; text-align: center;"><i class="bi bi-exclamation-triangle"></i></p>
                    <hr>
                    <p class="content text-center">"Mohon maaf barang yang anda cari belum tersedia, Terimakasih."
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="<?= base_url(); ?>menu-resto" class="btn btn-danger"> Lihat Menu <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- <style>
        .card {
            width: 190px;
            height: 254px;
            margin: 0 auto;
            background-color: #f4f4f3;
            border-radius: 8px;
            z-index: 1;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .card::after {
            position: absolute;
            content: '';
            background-color: #ce2614;
            width: 50px;
            height: 100px;
            z-index: -1;
            border-radius: 8px;
        }

        .tools {
            display: flex;
            align-items: center;
            padding: 9px;
            border-radius: 8px;
            background: #ce2614;
            margin-top: -2px;
        }

        .circle {
            padding: 0 4px;
        }

        .card__content {
            height: 100%;
            margin: 0px;
            border-radius: 8px;
            background: #ffff;
            padding: 10px;
        }

        .title {
            font-size: 20px;
        }

        .content {
            margin-top: 10px;
            font-size: 14px;
        }

        .box {
            display: inline-block;
            align-items: center;
            width: 10px;
            height: 10px;
            padding: 1px;
            border-radius: 50%;
        }

        .red {
            background-color: #2ecc71;
        }

        .yellow {
            background-color: #ffbd44;
        }

        .green {
            background-color: #00ca4e;
        }
    </style> -->
<?php else : ?>
    <!-- end mobile view -->

    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container">
            <div class="container">
                <img src="<?= base_url() ?>assets/img/ssayoresto/restobannerlc.jpg" class="d-block w-100 rounded-3">
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