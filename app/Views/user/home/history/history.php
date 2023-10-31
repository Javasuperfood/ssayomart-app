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
        <div class="container d-md-blok d-lg-none d-xl-none">
            <div class="row">
                <div class="col">
                    <form action="<?= base_url('history'); ?>" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control border-0 shadow-sm" placeholder="Cari..." name="search" aria-label="search" aria-describedby="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <button class="btn btn-danger border-0" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
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
                                    <div class="card border-0 shadow-sm">
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
                                <div class="col-2"><i class="bi bi-exclamation-diamond-fill text-danger fs-1 position-absolute top-50 start-0 translate-middle-y px-4"></i></div>
                                <div class="col-10 text-secondary" style="font-size: 15px;">Riwayat Transaksi yang Anda cari tidak ditemukan.</div>
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
                        <input type="text" class="form-control form-control-lg border-0 shadow-sm" placeholder="Cari..." name="search" aria-label="search" aria-describedby="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
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
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img" style="width: 50px;">
                                                        <div class="position-absolute bottom-0 start-50 translate-middle-x">
                                                            <a class="link-secondary" href="#" role="button" id="colsId<?= $t->id_checkout; ?>" style="display: none;">
                                                                <i class="bi bi-chevron-bar-down fs-4" style="font-weight: bold;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-10 position-absolute top-50 start-50 translate-middle">
                                                        <h5 class="card-title fs-6"><?= substr($t->nama, 0, 10); ?>...</h5>
                                                        <p class="text-secondary fs-6">Rp. <?= number_format($t->harga, 0, ',', '.'); ?></p>
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
                                    Riwayat Transaksi yang Anda cari tidak ditemukan.
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