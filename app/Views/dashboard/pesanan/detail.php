<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail <?= $inv; ?></h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <a href="#produk" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="produk">
        <h6 class="m-0 font-weight-bold text-danger">Produk</h6>
    </a>
    <div class="collapse show" id="produk">
        <div class="card-body">
            <div class="row row-cols-2 row-cols-md-4">
                <?php foreach ($orders as $o) : ?>
                    <div class="col text-dark">
                        <div class="card mb-3" style="height: 100%;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/produk/main/' . $o['img']); ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $o['nama']; ?></h5>
                                        <table>
                                            <tr>
                                                <td>Jumlah</td>
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Detail</h6>
    </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="row row-cols-1 row-cols-md-2">
                    <?php $i = 1; ?>
                    <?php foreach ($orders as $o) : ?>
                        <div class="col font-weight-bold" style="color: #000;">
                            <?= $i++; ?>. <?= $o['nama']; ?>
                        </div>
                        <div class="col">
                            <table class="table table-borderless">
                                <tr>
                                    <td>harga</td>
                                    <td>:</td>
                                    <td><?= $o['harga']; ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>:</td>
                                    <td><?= $o['qty']; ?></td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <div class="col font-weight-bold">
                        <?= $i++; ?>. Total
                    </div>
                    <div class="col">
                        <table class="table table-borderless">
                            <tr>
                                <td>Diskon</td>
                                <td>:</td>
                                <td><?= ($order['discount'] * 100); ?>%</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>:</td>
                                <td><?= $order['total_2']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="height: 100%;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">Update Resi</h6>
                    </div>
                    <div class="card-body">
                        <?php if ($order['id_status_pesan'] != 1) : ?>
                            <form action="<?= base_url('dashboard/pesanan/update/' . $order['id_checkout']); ?>" method="post">
                                <textarea class="form-control" placeholder="Nomor Resi" name="deskripsi" id="floatingTextarea2" style="height: 100px"><?= old('deskripsi'); ?></textarea>
                                <div class="pt-4" align="center">
                                    <button type="submit" class="btn btn-outline-danger">Update</button>
                                </div>
                            </form>
                        <?php else : ?>
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">Pelanggan belum membayar</h4>
                                <p>Sepertinya pelanggan belum membayar.</p>
                                <hr>
                                <p class="mb-0">Atau hubungi superadmin.</p>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>