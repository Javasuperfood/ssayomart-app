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
        </div>
    </div>

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
    </style>
<?php else : ?>
    <!-- cupon end view mobile -->

    <!-- view Desktop -->
    <div id="desktopContent" style="margin-top: 100px;">
        <div class="container py-5">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h2 class="mb-0 fw-bold"><i class="text-danger bi bi-box2-heart"></i> <?= $title; ?></h2>
                            <hr class="mb-3 border-danger" style="border-width: 5px;">
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($kupon_model as $km) : ?>
                    <div class="col pb-3">
                        <div class="card border-0 shadow-sm bg-white">
                            <img src="<?= base_url() ?>assets/img/promo/Clipped.png" class="card-img-top border-0 img-fluid img-thumbnail rounded-4" alt="...">
                            <div class="card-body border-0 bg-white text-center ">
                                <p class="fs-5"><?= $km['nama']; ?></p>
                                <p class="text-secondary fs-6"><?= $km['kode']; ?></p>
                                <p class="text-secondary fs-6">Kupon Tersedia : <?= $km['available_kupon']; ?></p>
                            </div>
                            <div class="card-footer bg-light border-0 shadow-sm text-body-secondary d-flex justify-content-center">
                                <a href="<?= base_url() ?>" class="btn border-0 btn-danger">Belanja Sekarang</a>
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