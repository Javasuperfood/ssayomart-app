<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-5">
            <form action="<?= base_url('store/' . $produk['slug']); ?>" method="post">
                <?= csrf_field(); ?>
                <?php if (!$alamat_list) : ?>
                    <div class="alert alert-danger">
                        Tidak ada alamat yang tersedia. Silakan tambahkan alamat terlebih dahulu. <a href="<?= base_url('setting/create-alamat'); ?>" class="link-dark fw-bold">Disini</a>
                    </div>
                <?php endif ?>
                <div class="row <?= (!$alamat_list) ? 'd-none' : ''; ?>">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control border-0 shadow-sm" id="alamat_list" name="alamat_list">
                                <?php foreach ($alamat_list as $al) : ?>
                                    <option penerima="<?= $al['label']; ?>" value="<?= $al['id_alamat_users']; ?>" class="card-text text-secondary" city="<?= $al['id_city']; ?>"><?= $al['alamat_1']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <label for="alamat_list" id="alamat_list"><span id="perubahan"></span></label>
                        </div>
                    </div>

                    <div class="form-floating mb-2">
                        <select class="form-control border-0 shadow-sm" id="kurir" name="kurir">
                            <option value="" selected>Pilih Kurir</option>
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
                    <input type="hidden" name="serviceText" id="serviceText">
                    <?php if ($kupon) : ?>
                        <div class="form-floating mb-2">
                            <select class="form-control border-0 shadow-sm" id="kupon" name="kupon">
                                <option selected value="" class="card-text text-secondary">
                                    Pilih Kupon
                                </option>
                                <?php foreach ($kupon as $k) : ?>
                                    <?php if ($total >= $k['total_buy']) : ?>
                                        <option value="<?= $k['kode']; ?>">Diskon <?= ($k['discount'] * 100) . '%'; ?> : Minimal Beli Rp. <?= number_format($k['total_buy'], 0, ',', '.'); ?> </option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                            <label for="kupon" id="floatingLabel">Makin Hemat Pakai Kupon</span></label>
                        </div>
                    <?php endif ?>

                    <div class="row pt-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/<?= $produk['img']; ?>" alt="" class="card-img">
                                    </div>
                                    <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                        <h5 class="card-title fs-6"><?= substr($produk['nama'], 0, 10); ?>...</h5>
                                        <p class="card-text text-secondary fs-6"><?= $qty; ?> pcs
                                        </p>
                                        <input type="hidden" name="qty" value="<?= $qty; ?>">
                                        <input type="hidden" name="varian" value="<?= $varian; ?>">
                                    </div>
                                    <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                        <h5 class="text-secondary fs-6">Total</h5>
                                        <p class="fw-bold fs-6">Rp. <?= number_format(($produk['harga_item'] * $qty), 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row py-3 px-3">
                        <table class="table fs-6 lh-1">
                            <thead>
                                <tr>
                                    <th scope="col">Ringkasan Belanja</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Potongan Harga (Kupon)</td>
                                    <td><span id="diskon"></span></td>
                                </tr>
                                <tr>
                                    <td>Total Ongkos Kirim</td>
                                    <td><span id="ongkirText"></span></td>
                                </tr>
                                <tr>
                                    <td>Biaya Jasa Aplikasi</td>
                                    <td><span id="serviceApp"></span></td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="fw-bold"><span id="totalText"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row p-3 px-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded btn-bayar" style="background-color: #ec2614; color: #fff; width: 100%;">Bayar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="pb-5"></div>
<?php else : ?>
    <!-- end mobile -->

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container">
            <div class="text-center">
                <h2>Checkout</h2>
            </div>
            <hr>
            <form action="<?= base_url('store/' . $produk['slug']); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Right Panel -->
                            <span class="badge badge-secondary badge-pill">3</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed border-0 shadow-sm">
                                <table class="table fs-6 lh-1 shadow-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ringkasan Belanja</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Potongan Harga (Kupon)</td>
                                            <td><span id="diskon"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Total Ongkos Kirim</td>
                                            <td><span id="ongkirText"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Pelayanan</td>
                                            <td><span id="serviceApp"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="fw-bold"><span id="totalText"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-lg fw-bold rounded btn-bayar" style="background-color: #ec2614; color: #fff; width: 100%;">Bayar</button>
                            </div>
                        </ul>
                    </div>
                    <!-- Left Panel -->
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Pemesanan</h4>
                        <?php if (!$alamat_list) : ?>
                            <div class="alert alert-danger">
                                Tidak ada alamat yang tersedia. Silakan tambahkan alamat terlebih dahulu. <a href="<?= base_url('setting/create-alamat'); ?>" class="link-dark fw-bold">Disini</a>
                            </div>
                        <?php endif ?>

                        <div class="row <?= (!$alamat_list) ? 'd-none' : ''; ?>">
                            <div class="col-md-6 mb-3">
                                <label for="alamat_list" class="form-label">Pilih Alamat</label>
                                <select class="form-select border-0 shadow-sm" id="alamat_list" name="alamat_list">
                                    <?php foreach ($alamat_list as $al) : ?>
                                        <option penerima="<?= $al['label']; ?>" value="<?= $al['id_alamat_users']; ?>" class="card-text text-secondary" city="<?= $al['id_city']; ?>"><?= $al['alamat_1']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kurir" class="form-label">Pilih Kurir</label>
                                <select class="form-select border-0 shadow-sm" id="kurir" name="kurir">
                                    <option value="" selected>Pilih Kurir</option>
                                    <option value="jne" class="card-text text-secondary">JNE</option>
                                    <option value="tiki" class="card-text text-secondary">TIKI</option>
                                    <option value="pos" class="card-text text-secondary">Pos Indonesia</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="service" class="form-label">Pilih Layanan</label>
                                <select class="form-select border-0 shadow-sm" id="service" name="service">
                                    <option value="" class="card-text text-secondary"></option>
                                </select>
                                <input type="hidden" name="serviceText" id="serviceText">
                                <strong>Estimasi : <span id="estimasi"></span></strong>
                            </div>

                            <?php if ($kupon) : ?>
                                <div class="col-md-6 mb-3">
                                    <label for="kupon" class="form-label">Pilih Kupon</label>
                                    <select class="form-select border-0 shadow-sm" id="kupon" name="kupon">
                                        <option selected value="" class="card-text text-secondary">Pilih Kupon</option>
                                        <?php foreach ($kupon as $k) : ?>
                                            <?php if ($total >= $k['total_buy']) : ?>
                                                <option value="<?= $k['kode']; ?>">Diskon <?= ($k['discount'] * 100) . '%'; ?> : Minimal Beli Rp. <?= number_format($k['total_buy'], 0, ',', '.'); ?> </option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            <?php endif ?>

                            <div class="col-md-12 mt-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="<?= base_url(); ?>assets/img/produk/main/<?= $produk['img']; ?>" alt="Foto Produk" class="card-img">
                                            </div>
                                            <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                                <h5 class="card-title fs-6"><?= substr($produk['nama'], 0, 10); ?>...</h5>
                                                <p class="card-text text-secondary fs-6"><?= $qty; ?> pcs
                                                </p>
                                                <input type="hidden" name="qty" value="<?= $qty; ?>">
                                                <input type="hidden" name="varian" value="<?= $varian; ?>">
                                            </div>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <h5 class="text-secondary fs-6">Total</h5>
                                                <p class="fw-bold fs-6">Rp. <?= number_format(($produk['harga_item'] * $qty), 0, ',', '.'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>
<!-- end desktop -->

<script>
    $('document').ready(function() {
        var selectedOption = $(this).find("option:selected");
        var label = selectedOption.attr('penerima');
        $('#perubahan').text(label);
        $("#alamat_list").on('change', function() {
            selectedOption = $(this).find("option:selected");
            label = selectedOption.attr('penerima');
            $('#perubahan').text(label);
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
<?= $this->include('user/home/component/rajaOngkir/checkout'); ?>
<?= $this->endSection(); ?>