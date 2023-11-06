<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="<?= base_url('history'); ?>" method="get">
                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control border-0 shadow-sm" placeholder="Search... (by product name or sku)" name="search" aria-label="search" aria-describedby="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <button class="btn btn-danger border-0" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <div class="row text-center">
                    <div class="col position-relative">
                        <div class="my-3 position-absolute start-0 translate-middle-y button-prev rounded-circle d-flex align-items-center" style="z-index: 2; width: 20px; height: 20px;">
                            <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button"><i class="bi bi-arrow-left"></i></button>
                        </div>
                        <div class="my-3 position-absolute end-0 translate-middle-y button-next rounded-circle d-flex align-items-center" style="z-index: 2; width: 20px; height: 20px;">
                            <button class="shadow-sm btn btn-light btn-sm rounded-circle w-100 h-100 p-0 d-flex align-items-center justify-content-center" type="button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>


                        <div class="col">
                            <div class="swiper btn-sub text-center" style="position: relative; z-index: 1;">
                                <div class="swiper-wrapper">

                                    <div class="swiper-slide mb-2">
                                        <div class="card border-0 shadow-sm text-uppercase mx-auto d-flex justify-content-center" style="height: 30px;">
                                            <a href="#" class="my-1 text-decoration-none" style="font-size:8px; color:#000;">
                                                Sedang Diproses
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide mb-2">
                                        <div class="card border-0 shadow-sm text-uppercase mx-auto d-flex justify-content-center" style="height: 30px;">
                                            <a href="#" class="my-1 text-decoration-none" style="font-size:8px; color:#000;">
                                                Sedang Dikirim
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide mb-2">
                                        <div class="card border-0 shadow-sm text-uppercase mx-auto d-flex justify-content-center" style="height: 30px;">
                                            <a href="#" class="my-1 text-decoration-none" style="font-size:8px; color:#000;">
                                                Barang Sudah diterima
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>





                    </div>
                </div>
            </div>
            <?php
            $idTransaksi = null;
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $foundProducts = false;

            foreach ($transaksi as $t) :
                if ($searchTerm != '' && (strpos(strtolower($t->nama), strtolower($searchTerm)) === false) && (strpos(strtolower($t->sku), strtolower($searchTerm)) === false)) {
                    continue;
                }
                $foundProducts = true;
            ?>
                <?php if ($idTransaksi != $t->id_checkout) : ?>
                    <div class="row pt-3" onclick="toggleHistory(<?= $t->id_checkout; ?>)">
                        <div class="col">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="row" id="colsId<?= $t->id_checkout; ?>" data-bs-target="#history<?= $t->id_checkout; ?>" data-bs-toggle="collapse">
                                        <div class="col-3">
                                            <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img">
                                            <div class="position-absolute bottom-0 start-50 translate-middle-x">
                                                <a class="link-secondary" href="#" role="button" id="arowDown<?= $t->id_checkout; ?>" style="display: none;">
                                                    <i class="bi bi-chevron-bar-down fs-4" style="font-weight: bold;"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="deskripsi col-5 position-absolute top-50 start-50 translate-middle">
                                            <h5 class="card-title fs-6"><?= substr($t->nama, 0, 10); ?>...</h5>
                                            <p class="text-secondary fs-6">Rp. <?= number_format($t->harga, 0, ',', '.'); ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if ($t->snap_token != null) : ?>
                                            <?php if ($t->id_status_pesan == 1) : ?>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger custom-btn">
                                                        <?= lang('Text.transaksi_1') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 2) : ?>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-warning custom-btn">
                                                        <?= lang('Text.transaksi_2') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 3) : ?>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-success custom-btn">
                                                        <?= lang('Text.transaksi_3') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 4) : ?>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-success custom-btn">
                                                        <?= lang('Text.transaksi_4') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 5) : ?>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-danger custom-btn">
                                                        <?= lang('Text.transaksi_5') ?>
                                                    </a>
                                                </div>
                                            <?php else : ?>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-success custom-btn">Detail</a>
                                                </div>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-primary custom-btn"> <?= lang('Text.transaksi_6') ?></a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($t->id_checkout == $idTransaksi) : ?>
                    <script>
                        $("#arowDown" + <?= $t->id_checkout; ?>).show()
                    </script>
                    <?php foreach ($transaksi as $c) : ?>
                        <?php if ($t->id_checkout_produk == $c->id_checkout_produk) : ?>
                            <div class="row pt-3 collapse" id="history<?= $t->id_checkout; ?>">
                                <div class="col">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="<?= base_url(); ?>assets/img/produk/main/<?= $c->img; ?>" alt="Foto Produk" class="card-img">
                                                </div>
                                                <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                                    <h5 class="card-title fs-6"><?= substr($c->nama, 0, 10); ?>...</h5>
                                                    <p class="text-secondary fs-6">Rp. <?= number_format($c->harga, 0, ',', '.'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
                <?php $idTransaksi = $t->id_checkout ?>
            <?php endforeach; ?>
            <?php if (!$foundProducts) : // Tampilkan alert jika tidak ditemukan produk 
            ?>
                <div class="row pt-3">
                    <div class="col">
                        <div class="alert alert-danger rounded border-0" role="alert">
                            <div class="row">
                                <div class="col-2">
                                    <i class="bi bi-exclamation-diamond-fill text-danger fs-1 position-absolute top-50 start-0 translate-middle-y px-4"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-secondary" style="font-size: 15px;"><?= lang('Text.alert_history') ?>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            <?php endif ?>

            <div class="row pb-5">
                <div class="col"></div>
            </div>
        </div>

    </div>
    <style>
        @media screen and (max-width: 820px) {
            .btn.custom-btn {
                font-size: 14px !important;
                /* Ukuran font untuk iPad */
            }

        }

        @media screen and (max-width: 280px) {
            .btn.custom-btn {
                font-size: 5px !important;
                /* Ukuran font untuk iPad */
            }
        }

        @media screen and (max-width: 414px) {
            .btn.custom-btn {
                font-size: 10px !important;
                /* Ukuran font untuk iPad */
            }
        }
    </style>

    <style>
        /* Default styles for larger screens */

        /* Your default styles for larger screens go here */

        @media (max-width: 280px) {

            /* Styles for screens with a width of 280px or less */
            .d-flex i {
                font-size: 10px;
            }

            i.bi-exclamation-diamond-fill {
                display: none;
                /* Sembunyikan elemen <i> pada tampilan Galaxy Fold */
            }

            .row {
                flex-direction: column;
                /* Stack columns vertically */
            }

            .col-3 {
                width: 30%;
                /* Full width for image column */
                text-align: center;
                /* Center the image */
                margin-bottom: 10px;
                /* Add some spacing between columns */
            }

            .col-2 {
                text-align: center;
                /* Pusatkan ikon */
                margin-bottom: 10px;
                /* Tambahkan jarak antara ikon dan teks */
            }

            .col-10 {
                text-align: center;
                /* Pusatkan teks */
            }



            .deskripsi {
                width: 100%;
                /* Full width for description column */
                text-align: center;
                /* Center the description */
            }

            .position-absolute {
                position: relative;
                /* Change position to relative for nested elements */
                transform: none;
                /* Remove transformation */
            }

            .link-secondary {
                display: block;
                /* Display the link as a block element for stacking */
                text-align: center;
                /* Center the link */
            }

            /* Additional styles for smaller screens as needed */
        }
    </style>

<?php else : ?>
    <!-- End Tampilan mobile dan Ipad -->

    <!-- Tampilan Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 d-none d-lg-block">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <h2><i class="bi bi-clock-history"></i> <?= lang('Text.title_history') ?></h2>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col">
                <form action="<?= base_url('history'); ?>" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg border-0 shadow-sm" placeholder="Search... (by product name or sku)" name="search" aria-label="search" aria-describedby="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button class="btn btn-lg btn-danger border-0" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <?php
            $idTransaksi = null;
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $foundProducts = false;

            foreach ($transaksi as $t) :
                if ($searchTerm != '' && (strpos(strtolower($t->nama), strtolower($searchTerm)) === false) && (strpos(strtolower($t->sku), strtolower($searchTerm)) === false)) {
                    continue;
                }
                $foundProducts = true;
            ?>
                <?php if ($idTransaksi != $t->id_checkout) : ?>
                    <div class="row">
                        <div class="col mx-auto">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="row" id="colsId<?= $t->id_checkout; ?>" data-bs-target="#history<?= $t->id_checkout; ?>" data-bs-toggle="collapse">
                                        <div class="col-4">
                                            <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img" style="width: 150px;">
                                            <div class="position-absolute bottom-0 start-50 translate-middle-x">
                                                <a class="link-secondary" href="#" role="button" id="arowDown<?= $t->id_checkout; ?>" style="display: none;">
                                                    <i class="bi bi-chevron-bar-down fs-4" style="font-weight: bold;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 position-absolute top-50 start-50 translate-middle" id="colsId<?= $t->id_checkout; ?>" data-bs-target="#history<?= $t->id_checkout; ?>" data-bs-toggle="collapse">
                                            <h5 class="card-title fs-4"><?= substr($t->nama, 0, 10); ?>...</h5>
                                            <p class="text-secondary fs-5">Rp. <?= number_format($t->harga, 0, ',', '.'); ?></p>
                                        </div>
                                        <?php if ($t->snap_token != null) : ?>
                                            <?php if ($t->id_status_pesan == 1) : ?>
                                                <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger">
                                                        <?= lang('Text.transaksi_1') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 2) : ?>
                                                <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-warning">
                                                        <?= lang('Text.transaksi_2') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 3) : ?>
                                                <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-success">
                                                        <?= lang('Text.transaksi_3') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 4) : ?>
                                                <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-success">
                                                        <?= lang('Text.transaksi_4') ?>
                                                    </a>
                                                </div>
                                            <?php elseif ($t->id_status_pesan == 5) : ?>
                                                <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-danger">
                                                        <?= lang('Text.transaksi_5') ?>
                                                    </a>
                                                </div>
                                            <?php else : ?>
                                                <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                    <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-success">Detail</a>
                                                </div>
                                            <?php endif ?>
                                        <?php else : ?>
                                            <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-primary"> <?= lang('Text.transaksi_6') ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($t->id_checkout == $idTransaksi) : ?>
                    <script>
                        $("#arowDown" + <?= $t->id_checkout; ?>).show()
                    </script>
                    <?php foreach ($transaksi as $c) : ?>
                        <?php if ($t->id_checkout_produk == $c->id_checkout_produk) : ?>
                            <!-- perbaiki colspe -->
                            <div class="collapse" id="history<?= $t->id_checkout; ?>">
                                <div class="row">
                                    <div class="col mx-auto">
                                        <div class="card border-0 mb-4 bg-light">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img" style="width: 150px;">
                                                        <div class="position-absolute bottom-0 start-50 translate-middle-x">
                                                            <a class="link-secondary" href="#" role="button" id="colsId<?= $t->id_checkout; ?>" style="display: none;">
                                                                <i class="bi bi-chevron-bar-down fs-4" style="font-weight: bold;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-8 position-absolute top-50 start-50 translate-middle">
                                                        <h5 class="card-title fs-4"><?= substr($t->nama, 0, 10); ?>...</h5>
                                                        <p class="text-secondary fs-5">Rp. <?= number_format($t->harga, 0, ',', '.'); ?></p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endif ?>
                <?php $idTransaksi = $t->id_checkout ?>
            <?php endforeach ?>
            <?php if (!$foundProducts) : // Tampilkan alert jika tidak ditemukan produk 
            ?>
                <div class="row pt-3">
                    <div class="col">
                        <div class="alert alert-danger rounded border-0 py-4 text-center" role="alert">
                            <div class="row">
                                <div class="col-1 text-center"> <!-- Mengatur alignment teks ke tengah -->
                                    <i class="bi bi-exclamation-diamond-fill text-danger fs-1 px-4"></i>
                                </div>
                                <div class="col-10 text-secondary position-absolute top-50 start-50 translate-middle" style="font-size: 20px;">
                                    <?= lang('Text.alert_history') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->
<?= $this->endSection(); ?>