<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container pt-3">
    <div class="row row-cols-1">
        <div class="col">
            <ul class="list-group list-group-flush">
                <a href="<?= base_url(); ?>setting/pembayaran" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-credit-card-2-back pe-2 text-secondary"></i> Gopay <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
                <a href="<?= base_url(); ?>setting/pembayaran" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-credit-card-2-back pe-2 text-secondary"></i> Kartu Kredit <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
                <a href="<?= base_url(); ?>setting/pembayaran" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-credit-card-2-back pe-2 text-secondary"></i> OVO <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>