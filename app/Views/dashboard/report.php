<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
<div class="col">
    <p>Berikut adalah data report penjualan aplikasi Ssayomart</p>
    <a href="<?= site_url('dashboard/report/printpdf') ?>" type="button" class="btn btn-danger mb-3">Download PDF</a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Data Report</h6>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered text-center fs-6" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Total (Rp)</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getCheckoutWithProduct as $p) : ?>
                                <tr>
                                    <td><?= $p->fullname; ?></td>
                                    <td><?= $p->nama; ?></td>
                                    <td><?= $p->qty; ?></td>
                                    <td><?= number_format($p->total_2, 0, ',', '.'); ?></td>
                                    <td><?= date("d-m-Y", strtotime($p->created_at));  ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>