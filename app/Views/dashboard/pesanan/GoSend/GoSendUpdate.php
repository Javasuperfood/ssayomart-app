<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<div class="card border-0 text-center bg-light mb-4 px-2 py-2">
    <h1 class="h3 mb-2 text-danger fw-bold">Pesanan <br> <?= $inv; ?></h1>
</div>

<!-- Pesanan Produk -->
<div class="card border-0 mb-4 shadow-sm">
    <a href="#order" class="d-block card-header bg-white border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="order">
        <h6 class="m-0 font-weight-bold text-danger">Produk</h6>
    </a>
    <div class="collapse show" id="order">
        <div class="card-body">
            <div class="row row-cols-2 row-cols-md-4">
                <?php foreach ($orders as $o) : ?>
                    <div class="col mb-3">
                        <div class="card">
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
        <h6 class="m-0 font-weight-bold text-danger">Detail Pemesanan Produk</h6>
    </a>
    <div class="collapse show" id="detail">
        <div class="card-body">
            <div class="row row-cols-1">
                <div class="col-md-6">
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
                                <h6 class="m-0 font-weight-bold text-danger">GoSend Update</h6>
                            </div>
                            <div class="row row-cols-1">
                                <div class="col my-3">
                                    <div class="card border-1 border-left-danger px-2 pt-2">
                                        <div class="col font-weight-bold">
                                            <p class="fw-bold fs-5">Transaksi </p>
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
                                //
                                <form action="<?= base_url('dashboard/order/gosend-update/' . $inv . '/pickup'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="inv" value="<?= $inv; ?>">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Note For driver GoSend" id="floatingTextarea2" name="note" style="height: 100px">Di tunggu di Lobi</textarea>
                                        <label for="floatingTextarea2">Note For driver GoSend</label>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-lg">Pickup</button>
                                </form>
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