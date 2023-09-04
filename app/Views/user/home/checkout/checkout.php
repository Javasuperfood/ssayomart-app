<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- ITEM WISHLIST -->
<div class="container pt-5">
    <div class="row">
        <div class="col">
            <div class="form-floating mb-2">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <select class="form-control border-0 shadow-sm" id="floatingSelect" name="alamat_list">
                    <?php foreach ($alamat_list as $al) : ?>
                        <option bebas="<?= $al['label']; ?>" value="<?= $al['id_alamat_users']; ?>" class="card-text text-secondary"><?= $al['alamat_1']; ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (isset($al)) : ?>
                    <label for="floatingSelect" id="floatingLabel"><span id="perubahan"><?= $al['label']; ?></span></label>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-floating mb-2">
            <select class="form-control border-0 shadow-sm" id="kurir" name="kurir">
                <option selected>Pilih Kurir</option>
                <option value="jne" class="card-text text-secondary">JNE</option>
                <option value="tiki" class="card-text text-secondary">TIKI</option>
                <option value="pos" class="card-text text-secondary">Pos Indonesia</option>
            </select>
            <label for="kurir" id="floatingLabel">Pilih Kurir</label>
        </div>

        <div class="form-floating mb-2">
            <select class="form-control border-0 shadow-sm" id="service" name="service">
                <option value="" class="card-text text-secondary"></option>
            </select>
            <label for="service" id="serviceLabel">Pilih Layanan</label>
            <strong>Estimasi : <span id="estimasi"></span></strong>
        </div>

        <div class="form-floating mb-2">
            <select class="form-control border-0 shadow-sm" id="floatingSelect">
                <option bebas="" value="" class="card-text text-secondary">
                </option>
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
                        <td>Rp. <span id="ongkirText"></span></td>
                    </tr>
                    <tr>
                        <td>Biaya Jasa Aplikasi</td>
                        <td>Rp. 1.000</td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>Rp. <span id="totalText"></span></td>
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

<script>
    $(document).ready(function() {
        // Cek jika alamat kosong
        <?php if (isset($error) && !empty($error)) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Alamat Kosong',
                text: 'Anda harus mengisi alamat terlebih dahulu.',
                showConfirmButton: true
            });
        <?php endif; ?>
    });
</script>
<?= $this->include('user/home/component/rajaOngkir/chekout'); ?>
<?= $this->endSection(); ?>