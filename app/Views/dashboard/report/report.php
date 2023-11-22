<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Dashboard</h1>
<div class="col px-0">
    <p>Berikut adalah data report penjualan aplikasi Ssayomart</p>
    <a href="<?= site_url('dashboard/report/printpdf') ?>" type="button" class="btn btn-danger mb-4">Download PDF</a>
</div>

<div class="card border-1 shadow-sm mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-text-fill"></i>
        <h6 class="m-0 fw-bold px-2">List Report Data</h6>
    </div>

    <div class="card-body mt-2">
        <div class="row">
            <div class="col col-sm-6">
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

            <!-- Chart -->
            <div class="card-body col-sm-6">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    const quantityData = <?= json_encode(array_column($getCheckoutWithProduct, 'total_2')); ?>;
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ag', 'Sep', 'Oct', 'Nov', 'Des'];

    const initialChartData = {
        labels: months,
        datasets: [{
            label: 'Penjualan',
            data: quantityData,
            borderWidth: 1
        }]
    };

    const myChart = new Chart(ctx, {
        type: 'line',
        data: initialChartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>