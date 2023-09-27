<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-blok d-lg-none d-xl-none">
            <?php
            $idTransaksi = null;
            foreach ($transaksi as $t) : ?>
                <?php if ($idTransaksi != $t->id_checkout) : ?>
                    <div class="row pt-3">
                        <div class="col">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img">
                                            <div class="position-absolute bottom-0 start-50 translate-middle-x">
                                                <a class="link-secondary" href="#" role="button" id="colsId<?= $t->id_checkout; ?>" style="display: none;">
                                                    <i class="bi bi-chevron-bar-down fs-4" style="font-weight: bold;"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                            <h5 class="card-title fs-6"><?= substr($t->nama, 0, 10); ?>...</h5>
                                            <p class="text-secondary fs-6">Rp. <?= number_format($t->harga, 0, ',', '.'); ?></p>
                                        </div>
                                        <?php if ($t->id_status_pesan == 1) : ?>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger">Transaksi Tertunda</a>
                                            </div>
                                        <?php elseif ($t->id_status_pesan == 2) : ?>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-warning">Dalam Proses</a>
                                            </div>
                                        <?php elseif ($t->id_status_pesan == 3) : ?>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('status?order_id=' . $t->invoice); ?>" class="btn btn-outline-warning">Sedang dikirim</a>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="#" class="btn btn-outline-success">Beli Lagi</a>
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
                        $("#colsId" + <?= $t->id_checkout; ?>).show()
                        $("#colsId" + <?= $t->id_checkout; ?>).attr('data-bs-toggle', 'collapse');
                        $("#colsId" + <?= $t->id_checkout; ?>).attr('href', '#history' + <?= $t->id_checkout; ?>);
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
            <div class="row pb-5">
                <div class="col"></div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- End Tampilan mobile dan Ipad -->

    <!-- Tampilan Destop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 d-none d-lg-block">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <h2><i class="bi bi-clock-history"></i> History</h2>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <?php
            $idTransaksi = null;
            foreach ($transaksi as $t) : ?>
                <?php if ($idTransaksi != $t->id_checkout) : ?>
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
                                        <?php if ($t->id_status_pesan == 1) : ?>
                                            <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger">Transaksi Tertunda</a>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($t->id_status_pesan == 2) : ?>
                                            <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="<?= base_url('status/' . $t->invoice); ?>" class="btn btn-outline-warning">Dalam Proses</a>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($t->id_status_pesan == 3) : ?>
                                            <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                <a href="#" class="btn btn-outline-success">Beli Lagi</a>
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
                        $("#colsId" + <?= $t->id_checkout; ?>).show()
                        $("#colsId" + <?= $t->id_checkout; ?>).attr('data-bs-toggle', 'collapse');
                        $("#colsId" + <?= $t->id_checkout; ?>).attr('href', '#history' + <?= $t->id_checkout; ?>);
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
                                                    <?php if ($t->id_status_pesan == 1) : ?>
                                                        <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                            <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger">Transaksi Tertunda</a>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if ($t->id_status_pesan == 2) : ?>
                                                        <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                            <a href="<?= base_url('status/' . $t->invoice); ?>" class="btn btn-outline-warning">Dalam Proses</a>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if ($t->id_status_pesan == 3) : ?>
                                                        <div class="col-2 position-absolute top-50 end-0 translate-middle-y">
                                                            <a href="#" class="btn btn-outline-success">Beli Lagi</a>
                                                        </div>
                                                    <?php endif ?>
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
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->


<?= $this->endSection(); ?>