<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <form action="<?= base_url('checkout/' . $id . '/bayar'); ?>" method="post">
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
            <?php foreach ($produk as $p) : ?>
                <div class="row pt-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p['img']; ?>" alt="" class="card-img">
                                </div>
                                <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                    <h5 class="card-title fs-6"><?= substr($p['nama'], 0, 10); ?>...</h5>
                                    <p class="card-text text-secondary fs-6"><?= $p['qty']; ?> pcs
                                    </p>
                                </div>
                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                    <h5 class="text-secondary fs-6">Total</h5>
                                    <p class="fw-bold fs-6">Rp. <?= number_format(($p['harga'] * $p['qty']), 0, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
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
<div class="pb-5"></div>

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