<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<div class="card border-0 text-center bg-light mb-4 px-2 py-2">
    <h1 class="h3 mb-2 text-danger">Detail Pesanan - <?= $inv; ?></h1>
</div>
<!-- DataTales Example -->
<div class="card border-0 mb-4">
    <!-- contoh -->
    <div class="container py-5">
        <div class="row">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="m-0 font-weight-bold text-danger">Pesanan Produk</h6>
            </div>
            <?php foreach ($orders as $o) : ?>
                <div class="col-lg-4">
                    <div class="card mb-4 border-left-danger">
                        <div class="card-body text-center">
                            <img src="<?= base_url('assets/img/produk/main/' . $o['img']); ?>" class="img-fluid rounded-start" alt="avatar" style="width: 150px;">
                            <div class="justify-content-center mt-4">
                                <h5 class="card-title"><?= $o['nama']; ?></h5>
                                <p class="card-text">Qty: <span class="font-weight-bold"><?= $o['qty']; ?></span></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>

                    <div class="card-body p-0">
                        <h6 class="m-0 font-weight-bold text-danger mb-3">Detail Pesanan Produk</h6>
                        <?php $i = 1; ?>
                        <?php foreach ($orders as $o) : ?>
                            <div class="card border-0 border-left-danger mb-4 px-2 pt-2 shadow-sm">
                                <div class="col font-weight-bold" style="color: #000;">
                                    <?= $i++; ?>. <?= $o['nama']; ?>
                                </div>
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($o['harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Qty</td>
                                            <td>:</td>
                                            <td><?= $o['qty']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                    <div class="card-body p-0">
                        <h6 class="m-0 font-weight-bold text-danger mb-3">Total Transaksi</h6>
                        <table class="table table-borderless border-left-danger shadow-sm">
                            <tr>
                                <td>Potongan Harga (Diskon)</td>
                                <td>:</td>
                                <td><?= ($order['discount'] != '') ? ($order['discount'] * 100) . '%' : ''; ?></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td class="fw-bold">Rp. <?= number_format($order['total_2'], 0, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 border-left-danger shadow-2">
                        <div class="card-header bg-white border-0 py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Keterangan Transaksi User</h6>
                        </div>
                        <div class="card-body bg-light">
                            <?php if ($order['id_status_pesan'] != 1) : ?>
                                <form action="<?= base_url('dashboard/order/in-proccess/update-resi/' . $o['id_checkout']); ?>" onsubmit="return validasiUpdateResi()" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="status" class="text-danger fw-bold">Status</label>
                                        <select class="form-control border-0" id="status" name="status">
                                            <?php foreach ($statusPesan as $s) : ?>
                                                <option value="<?= $s['id_status_pesan']; ?>" <?= ($s['id_status_pesan'] == $order['id_status_pesan']) ? 'selected' : ''; ?>><?= $s['status']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <span id="statusError" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="resi" class="text-danger fw-bold">Nomor Resi</label>
                                        <textarea class="form-control border-0 " placeholder="Nomor Resi" name="resi" id="resi" style="height: 100px"><?= old('resi'); ?></textarea>
                                        <span id="resiError" class="text-danger"></span>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <div class="alert alert-warning border-0 shadow text-center" role="alert">
                                    <h4 class="alert-heading">Menunggu Pembayaran</h4>
                                    <hr class="fw-bold">
                                    <p>Pelanggan belum membayar tagihan transaksi.</p>
                                    <p class="mb-0">Silakan hubungi Super Admin.</p>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- end -->

<script>
    //Validasi Form
    function validasiUpdateResi() {
        var isValid = true;

        var statusField = document.getElementById('status');
        var deskripsiField = document.getElementById('deskripsi');

        var statusError = document.getElementById('statusError');
        var deskripsiError = document.getElementById('deskripsiError');

        statusError.textContent = '';
        deskripsiError.textContent = '';


        if (statusField.value.trim() === '') {
            statusField.classList.add('invalid-field');
            statusError.textContent = 'Status Pengiriman harus diisi';
            isValid = false;
        } else {
            statusField.classList.remove('invalid-field');
        }

        if (deskripsiField.value.trim() === '') {
            deskripsiField.classList.add('invalid-field');
            deskripsiError.textContent = 'Nomor Resi harus diisi';
            isValid = false;
        } else {
            deskripsiField.classList.remove('invalid-field');
        }
        return isValid;
    }
</script>
<?= $this->endSection(); ?>