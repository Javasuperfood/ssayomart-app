<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- ITEM WISHLIST -->
<div class="container pt-5">
    <div class="row">
        <div class="col clearfix">
            <ul class="list-group list-group-flush">
                <a href="<?= base_url() ?>setting/alamat-list" class="list-group-item pb-2">
                    <span class="fw-bold"><?= $label; ?></span>
                    <p class="card-text text-secondary"><?= substr($alamat, 0, 40); ?>...</p> <i class="bi bi-pencil-fill fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
            </ul>
        </div>
    </div>
    <form role="search">
        <div class="input-group my-2">
            <span class="input-group-text border-0 rounded-circle" id="basic-addon1"><i class="bi bi-pencil-fill"></i></span>
            <input type="text" class="form-control border-0 rounded" placeholder="Tambah Catatan" aria-label="search" aria-describedby="basic-addon1">
        </div>
    </form>

    <ul class="list-group list-group-flush">
        <a href="<?= base_url(); ?>" class="list-group-item py-3 fw-bold">
            <i class="bi bi-truck pe-2 text-secondary"></i> Pilih Pengiriman <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
        </a>
        <a href="<?= base_url(); ?>" class="list-group-item py-3 fw-bold">
            <i class="bi bi-patch-check-fill pe-2 text-secondary"></i> Makin Hemat Pakai Promo <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
        </a>
    </ul>

    <div class="row pt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img">
                        </div>
                        <div class="col-5 position-absolute top-50 start-50 translate-middle">
                            <h5 class="card-title">Nama Produk</h5>
                            <p class="card-text text-secondary">jumlah barang
                            </p>
                        </div>
                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                            <h5 class="text-secondary fw-bold">Total</h5>
                            <p class="fw-bold">Rp. 2000</p>
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
                            <h5 class="card-title">Nama Produk</h5>
                            <p class="card-text text-secondary">jumlah barang
                            </p>
                        </div>
                        <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                            <h5 class="text-secondary fw-bold">Total</h5>
                            <p class="fw-bold">Rp. 2000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-3 px-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Ringkasan Belanja</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Harga</td>
                    <td>Rp. 100.000</td>
                </tr>
                <tr>
                    <td>Total Ongkos Kirim</td>
                    <td>Rp. 16.000</td>
                </tr>
                <tr>
                    <td>Biaya Jasa Aplikasi</td>
                    <td>Rp. 1.000</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td>Rp. 117.000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row p-3 px-4">
        <a href="<?= base_url() ?>checkout" type="button" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Bayar</a>
    </div>

</div>
<div class="pb-5"></div>
</div>
<!-- END OF WISHLIST -->

<?= $this->endSection(); ?>