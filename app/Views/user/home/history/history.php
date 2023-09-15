<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarMain'); ?>
<!-- Tampilan mobile & ipad -->
<div class="container d-md-blok d-lg-none d-xl-none">
    <?php foreach ($transaksi as $t) : ?>
        <div class="row pt-3">
            <div class="col">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img">
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
    <?php endforeach; ?>
    <div class="row pb-5">
        <div class="col"></div>
    </div>
</div>
<!-- End Tampilan mobile dan Ipad -->

<!-- Tampilan Destop -->
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
    <?php foreach ($transaksi as $t) : ?>
        <div class="row">
            <div class="col mx-auto">
                <div class="card border-0 mb-4">
                    <div class="card-body">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="Foto Produk" class="card-img">
                                    </div>
                                    <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                        <h5 class="card-title fs-3"><?= substr($t->nama, 0, 10); ?>...</h5>
                                        <p class="text-secondary fs-4">Rp. <?= number_format($t->harga, 0, ',', '.'); ?></p>
                                    </div>


                                    <?php if ($t->id_status_pesan == 1) : ?>
                                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                            <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger">Transaksi Tertunda</a>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($t->id_status_pesan == 2) : ?>
                                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                            <a href="<?= base_url('status/' . $t->invoice); ?>" class="btn btn-outline-warning">Dalam Proses</a>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($t->id_status_pesan == 3) : ?>
                                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                            <a href="#" class="btn btn-outline-success">Beli Lagi</a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- End tampilan Destop -->

<?= $this->endSection(); ?>