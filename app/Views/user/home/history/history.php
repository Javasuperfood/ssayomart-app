<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarMain'); ?>
<div class="container">
    <?php foreach ($transaksi as $t) : ?>
        <div class="row pt-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url(); ?>assets/img/produk/main/<?= $t->img; ?>" alt="" class="card-img">
                            </div>
                            <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                <h5 class="card-title"><?= substr($t->nama, 0, 10); ?>...</h5>
                                <p class="fw-bold text-secondary">Rp. <?= number_format($t->total, 2, ',', '.'); ?></p>
                            </div>
                            <?php if ($t->id_status_pesan == 1) : ?>
                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                    <a href="<?= base_url('checkout/' . $t->id_checkout); ?>" class="btn btn-outline-danger">Lanjutkan Transaksi</a>
                                </div>
                            <?php endif ?>
                            <?php if ($t->id_status_pesan != 1 & $t->id_status_kirim = 1) : ?>
                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                    <a href="#" class="btn btn-outline-danger">Produk sedang dikirm</a>
                                </div>
                            <?php endif ?>
                            <?php if ($t->id_status_pesan != 1) : ?>
                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                    <a href="#" class="btn btn-outline-danger">Beli Lagi</a>
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

<?= $this->endSection(); ?>