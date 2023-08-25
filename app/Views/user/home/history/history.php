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
                            <span class="text-secondary fw-bold">Total</span><br>
                            <span class="fw-bold">Rp. 2000</span>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Nama Produk</h5>
                            <p class="card-text text-secondary">jumblah barang</p>
                            <p class="text-end"> <a href="#" class="btn btn-outline-danger">Beli Lagi</a></p>
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
                            <span class="text-secondary fw-bold">Total</span><br>
                            <span class="fw-bold">Rp. 2000</span>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Nama Produk</h5>
                            <p class="card-text">jumblah barang</p>
                            <p class="text-end"> <a href="#" class="btn btn-outline-danger">Beli Lagi</a></p>
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
                            <span class="text-secondary fw-bold">Total</span><br>
                            <span class="fw-bold">Rp. 2000</span>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Nama Produk</h5>
                            <p class="card-text">jumblah barang</p>
                            <p class="text-end"> <a href="#" class="btn btn-outline-danger">Beli Lagi</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>