<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- ITEM WISHLIST -->
<div class="container pt-5">
    <div class="row">
        <div class="col">
            <div class="form-floating mb-2">
                <select class="form-control border-0 shadow-sm" id="floatingSelect" aria-label="Floating label select example">
                    <?php foreach ($alamat_list as $au) : ?>
                        <option bebas="<?= $au['label']; ?>" value="<?= $au['id_alamat_users']; ?>" class="card-text text-secondary"><?= $au['alamat_1']; ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <label for="floatingSelect" id="floatingLabel"><span id="perubahan"><?= $au['label']; ?></span></label>
            </div>
        </div>

        <div class="form-floating mb-2">
            <select class="form-control border-0 shadow-sm" id="floatingSelect" aria-label="Floating label select example">
                <?php foreach ($alamat_list as $au) : ?>
                    <option bebas="<?= $au['label']; ?>" value="<?= $au['id_alamat_users']; ?>" class="card-text text-secondary"><?= $au['alamat_1']; ?>
                    </option>
                <?php endforeach ?>
            </select>
            <label for="floatingSelect" id="floatingLabel">Pilih Pengiriman</span></label>
        </div>

        <div class="form-floating mb-2">
            <select class="form-control border-0 shadow-sm" id="floatingSelect" aria-label="Floating label select example">
                <?php foreach ($alamat_list as $au) : ?>
                    <option bebas="<?= $au['label']; ?>" value="<?= $au['id_alamat_users']; ?>" class="card-text text-secondary"><?= $au['alamat_1']; ?>
                    </option>
                <?php endforeach ?>
            </select>
            <label for="floatingSelect" id="floatingLabel">Makin Hemat Pakai Kupon</span></label>
        </div>

        <div class="row pt-3">
            <div class="col">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img">
                            </div>
                            <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                <h5 class="card-title"><?= substr("Ottogi Mie Kering - 500gr", 0, 10); ?>...</h5>
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
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img">
                            </div>
                            <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                <h5 class="card-title"><?= substr("Ottogi Mie Kering - 500gr", 0, 10); ?>...</h5>
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
            <p class="text-secondary text-center"><a href="<?= base_url() ?>produk/status" class="link-underline link-underline-opacity-0 link-secondary">Detail Pesanan >></p></a>
        </div>

        <div class="row p-3 px-4">
            <a href="<?= base_url() ?>checkout" type="button" class="btn btn-lg fw-bold rounded" style="background-color: #ec2614; color: #fff;">Bayar</a>
        </div>
    </div>
</div>
<div class="pb-5"></div>
<!-- END OF WISHLIST -->

<script>
    $('document').ready(function() {
        $("#floatingSelect").on('change', function() {
            var selectedOption = $(this).find("option:selected");
            var label = selectedOption.attr('bebas');
            $('#perubahan').text(label);
            console.log(label);
        });
    });
</script>

<?= $this->endSection(); ?>