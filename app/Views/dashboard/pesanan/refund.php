<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<div class="card border-0 text-center bg-light mb-4 px-2 py-2">
    <h1 class="h3 mb-2 text-danger fw-bold">Refund Pesanan <br> <?= $inv; ?></h1>
</div>

<!-- Pesanan Produk -->
<div class="card border-0 mb-4 shadow-sm">
    <a href="#order" class="d-block card-header bg-white border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="order">
        <h6 class="m-0 font-weight-bold text-danger">Refund Order</h6>
    </a>
    <div class="collapse show" id="order">
        <div class="card-body">
            <div class="row row-cols-2 row-cols-md-4">
                <?php foreach ($orders as $o) : ?>
                    <div class="col mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/produk/main/' . $o['img']); ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $o['nama']; ?></h5>
                                        <table class="table table-borderless">
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

<!-- Detail Pesanan Produk -->
<div class="card border-0 mb-4 shadow-sm">
    <a href="#detail" class="d-block card-header bg-white border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detail">
        <h6 class="m-0 font-weight-bold text-danger">Detail Pesanan Produk</h6>
    </a>
    <div class="collapse show" id="detail">
        <div class="card-body">
            <div class="row row-cols-1">
                <div class="col-md-6">
                    <p>Kirim :</p>
                    <?= $order['kirim']; ?>
                    <p>
                        Detail :
                    </p>
                    <table class="table border-1">
                        <tbody>
                            <tr>
                                <td>Penerima</td>
                                <td>:</td>
                                <td><?= $destination['penerima']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $destination['alamat_1']; ?> (<?= $destination['alamat_2']; ?>)</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $destination['alamat_3']; ?></td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>:</td>
                                <td><?= $destination['telp']; ?> / <?= $destination['telp2']; ?></td>
                            </tr>
                            <tr>
                                <td>Service</td>
                                <td>:</td>
                                <td><?= $order['kurir']; ?> (<?= $order['service']; ?>)</td>
                            </tr>
                            <tr>
                                <td>Maps</td>
                                <td>:</td>
                                <td><a href="https://www.google.com/maps/search/<?= $destination['latitude']; ?>+<?= $destination['longitude']; ?>" target="_blank"><?= $destination['latitude']; ?>, <?= $destination['longitude']; ?></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <div class="card border-1" style="height: 100%;">
                        <div class="card-body">
                            <div class="card-header bg-white border-1 py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Refund Transaksi</h6>
                            </div>
                            <div class="row row-cols-1">
                                <div class="col my-3">
                                    <div class="card border-1 border-left-danger px-2 pt-2">
                                        <div class="col font-weight-bold">
                                            <p class="fw-bold fs-5">Transaksi <?= $status['transaction_status']; ?></p>
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
                                <?php if ($order['id_status_pesan'] != 1 && !isset($status['refunds'])) : ?>
                                    <form action="<?= base_url('dashboard/order/refund/' . $o['invoice']); ?>" onsubmit="return validasiUpdateResi()" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control <?= (validation_show_error('refund_note')) ? 'is-invalid' : ''; ?>" placeholder="Refund Note" name="refund_note" id="refundTextarea" style="height: 100px"></textarea>
                                            <label for="refundTextarea">Refund Note</label>
                                            <div class="invalid-feedback"><?= validation_show_error('refund_note'); ?></div>
                                        </div>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Code</span>
                                            <input type="text" value="<?= mt_rand(); ?>" name="code" readonly class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                        </div>
                                        <div class="my-3">
                                            <input type="text" placeholder="Type Code" class="form-control <?= (validation_show_error('code-confirm')) ? 'is-invalid' : ''; ?>" id="exampleFormControlInput1" name="code-confirm" autofocus>
                                            <div class="invalid-feedback"><?= validation_show_error('code-confirm'); ?></div>
                                        </div>
                                        <div class="alert alert-info" role="alert">
                                            <p class="ls-1">Refund transaction is supported only for <span class="badge text-bg-info">credit_card</span> , <span class="badge text-bg-info">gopay</span>, <span class="badge text-bg-info">shopeepay</span> and <span class="badge text-bg-info">QRIS</span> payment methods.</p>
                                        </div>
                                        <div class="pt-4" align="center">
                                            <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)">Refund</button>
                                        </div>
                                    </form>
                                <?php elseif ($order['id_status_pesan'] == 1) : ?>
                                    <div class="alert alert-warning border-0 shadow text-center" role="alert">
                                        <h4 class="alert-heading">Menunggu Pembayaran</h4>
                                        <hr class="fw-bold">
                                        <p>Pelanggan belum membayar tagihan transaksi.</p>
                                        <p class="mb-0">Silakan hubungi Super Admin.</p>
                                    </div>
                                <?php elseif (isset($status['refunds'])) : ?>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Status Transaksi</td>
                                                <td>:</td>
                                                <td><?= $status['transaction_status']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Refund Key</td>
                                                <td>:</td>
                                                <td><?= $status['refunds'][0]['refund_key']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Metode Refund</td>
                                                <td>:</td>
                                                <td><?= $status['refunds'][0]['refund_method']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>:</td>
                                                <td><?= $status['refunds'][0]['refund_amount']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alasan</td>
                                                <td>:</td>
                                                <td><?= (isset($status['refunds'][0]['reason'])) ? $status['refunds'][0]['reason'] : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Direfund</td>
                                                <td>:</td>
                                                <td><?= $status['refunds'][0]['created_at']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Komfirmasi Bank</td>
                                                <td>:</td>
                                                <td><?= $status['refunds'][0]['bank_confirmed_at']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection(); ?>