<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarMain'); ?>
<div class="container">
    <div class="row pt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img">
                        </div>
                        <div class="col-5 position-absolute top-50 start-50 translate-middle">
                            <h5 class="card-title"><?= substr("Ottogi Mie Kering - 500gr", 0, 10); ?>...</h5>
                            <p class="fw-bold text-secondary">Rp. 2000.</p>
                        </div>
                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                            <a href="#" class="btn btn-outline-danger">Beli Lagi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img">
                        </div>
                        <div class="col-5 position-absolute top-50 start-50 translate-middle">
                            <h5 class="card-title"><?= substr("Ottogi Mie Kering - 500gr", 0, 10); ?>...</h5>
                            <p class="fw-bold text-secondary">Rp. 2000.</p>
                        </div>
                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                            <a href="#" class="btn btn-outline-danger">Beli Lagi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img">
                        </div>
                        <div class="col-5 position-absolute top-50 start-50 translate-middle">
                            <h5 class="card-title"><?= substr("Ottogi Mie Kering - 500gr", 0, 10); ?>...</h5>
                            <p class="fw-bold text-secondary">Rp. 2000.</p>
                        </div>
                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                            <a href="#" class="btn btn-outline-danger">Beli Lagi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>