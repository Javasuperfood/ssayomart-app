<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- cupon view Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-2">
            <div class="row">
                <?php foreach ($kupon_model as $km) : ?>
                    <div class="col-sm-6 mb-3">
                        <div class="coupon bg-white rounded d-flex justify-content-between shadow-sm">
                            <div class="kiri p-2">
                                <div class="icon-container">
                                    <img src="<?= base_url() ?>assets/img/promo/default.png" alt="..." width="75" class=" rounded" />
                                </div>
                            </div>
                            <div class="tengah py-1 me-5">
                                <span class="badge text-bg-success" style="font-size: 10px;"><?= $km['kode']; ?></span>
                                <h3 class="lead mt-2" style="font-size: 12px;"><?= $km['nama']; ?></h3>
                                <p class="text-secondary mb-0" style="font-size: 10px;">Kupon Tersedia : <?= $km['available_kupon']; ?></p>
                            </div>
                            <div class="kanan">
                                <div class="info m-3 d-flex flex-column justify-content-between">
                                    <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-danger btn-block mt-3" style="font-size: 12px;">Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php if ($kupon_model == null) : ?>
                <div class="row ">
                    <div class="col">
                        <div class="d-flex justify-content-center flex-column align-items-center" style="height: 70vh;">
                            <img src="assets/img/coupon.png" class="img-coupon coupon-opacity" alt="...">
                            <h5 class="coupon-opacity fs-kupon">Kupon Belum Tersedia</h5>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <style>
        .coupon-opacity {
            opacity: 0.6;
        }

        /* Ekstra Kecil (xs) */
        @media only screen and (max-width: 575.98px) {

            .img-coupon {
                width: 130px;
            }
        }

        /* Kecil (sm) */
        @media only screen and (min-width: 576px) and (max-width: 767.98px) {
            .img-coupon {
                width: 190px;
            }
        }

        /* Menengah (md) */
        @media only screen and (min-width: 768px) and (max-width: 991.98px) {
            .img-coupon {
                width: 200px;
            }

            .fs-kupon {
                font-size: 50px;
            }
        }

        /* Besar (lg) */
        @media only screen and (min-width: 992px) and (max-width: 1199.98px) {
            .img-coupon {
                width: 250px;
            }

            .fs-kupon {
                font-size: 65px;
            }
        }

        /* Sangat Besar (xl) */
        @media only screen and (min-width: 1200px) {

            /* Aturan CSS untuk layar sangat besar di sini */
            .img-coupon {
                width: 290px;
            }

            .fs-kupon {
                font-size: 75px;
            }
        }
    </style>

    <style>
        /* Untuk layar yang lebih kecil, seperti Samsung Galaxy Fold (lebar 280px) */
        @media (max-width: 280px) {
            .coupon {
                flex-direction: column;
                /* Mengatur tampilan vertikal */
            }

            .kiri {
                text-align: center !important;
                justify-content: center !important;
                display: flex !important;
            }

            .tengah,
            .kanan {
                width: 100%;
                text-align: center;

                /* Lebar elemen menjadi penuh */
            }
        }

        @media (min-width: 717px) and (max-width: 717px) {
            .coupon {
                flex-direction: column;
                /* Mengatur tampilan vertikal */
            }

            .tengah {
                margin-left: 50px !important;
                text-align: center;
                justify-content: center !important;
                /* Mengatur teks menjadi pusat */
            }

            .coupon .kiri {
                text-align: center !important;
                justify-content: center !important;
                display: flex !important;
                margin-bottom: 1rem;
                /* Menambahkan jarak antara bagian kiri dengan bagian tengah */
            }

            .coupon .info {
                margin-top: 1rem;
                /* Menambahkan jarak di atas tombol "Show" */
            }
        }

        @media (min-width: 690px) and (max-width: 690px) {
            .coupon {
                flex-direction: column;
                /* Mengatur tampilan vertikal */
            }

            .tengah {
                margin-left: 50px !important;
                text-align: center;
                justify-content: center !important;
                /* Mengatur teks menjadi pusat */
            }

            .coupon .kiri {
                text-align: center !important;
                justify-content: center !important;
                display: flex !important;
                margin-bottom: 1rem;
                /* Menambahkan jarak antara bagian kiri dengan bagian tengah */
            }

            .coupon .info {
                margin-top: 1rem;
                /* Menambahkan jarak di atas tombol "Show" */
            }
        }
    </style>
<?php else : ?>
    <!-- cupon end view mobile -->

    <!-- view Desktop -->
    <div id="desktopContent" style="margin-top: 150px;">
        <div class="container justify-content-center align-items-center py-5">
            <div class="row">
                <?php foreach ($kupon_model as $km) : ?>
                    <div class="col-sm-6 mb-3">
                        <div class="coupon bg-white rounded d-flex justify-content-between shadow-sm">
                            <div class="kiri p-2">
                                <div class="icon-container">
                                    <img src="<?= base_url() ?>assets/img/promo/default.png" alt="..." width="75" class="rounded" />
                                </div>
                            </div>
                            <div class="deskripsi" style="width: 100%; margin-left:20px; text-align:start;">
                                <div class="tengah py-1 me-5">
                                    <span class="badge text-bg-success" style="font-size: 10px;"><?= $km['kode']; ?></span>
                                    <h3 class="lead mt-2 d-grid" style="font-size: 9px;"><?= $km['nama']; ?></h3>
                                    <p class="text-secondary mb-0" style="font-size: 10px;">Kupon Tersedia : <?= $km['available_kupon']; ?></p>
                                </div>
                            </div>
                            <div class="kanan">
                                <div class="info m-3 d-flex flex-column justify-content-between">
                                    <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-danger btn-block mt-3" style="font-size: 12px;">Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <!-- End Footer Desktop -->

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>