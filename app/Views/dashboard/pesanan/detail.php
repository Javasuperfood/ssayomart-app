<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<div class="card border-0 text-center bg-light mb-4 px-2 py-2">
    <h1 class="h3 mb-2 text-danger">Detail Pesanan - <?= $inv; ?></h1>
</div>
<!-- DataTales Example -->
<div class="card border-0 mb-4">
    <a href="#produk" class="d-block card-header bg-white shadow-sm  border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="produk">
        <h6 class="m-0 font-weight-bold text-danger">Pesanan Produk</h6>
    </a>
    <div class="collapse show" id="produk">
        <div class="card-body bg-light">
            <div class="row row-cols-2 row-cols-md-4">
                <?php foreach ($orders as $o) : ?>
                    <div class="col text-dark mb-3">
                        <div class="card shadow-sm border-0 mb-3" style="height: 100%;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/produk/main/' . $o['img']); ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $o['nama']; ?></h5>
                                        <table>
                                            <tr>
                                                <td>Qty</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $o['qty']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<div class="card border-0 mb-4">
    <a href="#detail" class="d-block card-header bg-white shadow-sm  border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detail">
        <h6 class="m-0 font-weight-bold text-danger">Detail Pesanan Produk</h6>
    </a>
    <div class="collapse show" id="detail">
        <div class="card-body bg-light">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                    <div class="row row-cols-1 row-cols-md-2">
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
                    <div class="row">
                        <div class="card border-0 border-left-danger px-2 pt-2 shadow-sm">
                            <div class="col font-weight-bold">
                                <p class="fw-bold fs-5">TOTAL TRANSAKSI</p>
                            </div>
                            <div class="col">
                                <table class="table table-borderless">
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
                    </div>
                </div>

                <div class="col">
                    <div class="card border-0" style="height: 100%;">
                        <div class="d-block card-header bg-white shadow-sm border-0 py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Keterangan Transaksi User</h6>
                        </div>
                        <div class="card-body bg-light">
                            <?php if ($order['id_status_pesan'] != 1) : ?>
                                <form action="<?= base_url('dashboard/order/in-proccess/update-resi/' . $o['id_checkout']); ?>" onsubmit="return validasiUpdateResi()" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-group text-center">
                                        <label for="status"><span class="text-danger fw-bold">Status</span></label>
                                        <select class="form-control border-0 shadow-sm" id="status" name="status">
                                            <?php foreach ($statusPesan as $s) : ?>
                                                <option value="<?= $s['id_status_pesan']; ?>" <?= ($s['id_status_pesan'] == $order['id_status_pesan']) ? 'selected' : ''; ?>><?= $s['status']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <span id="statusError" class="text-danger"></span>
                                    </div>
                                    <textarea class="form-control border-0 shadow-sm" placeholder="Nomor Resi" name="resi" id="deskripsi" style="height: 100px"><?= old('deskripsi'); ?></textarea>
                                    <span id="deskripsiError" class="text-danger"></span>
                                    <div class="pt-4" align="center">
                                        <button type="submit" class="btn btn-outline-danger">Update</button>
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
</div>

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