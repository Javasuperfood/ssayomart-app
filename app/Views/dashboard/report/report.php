<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Data Penjualan</h1>
<div class="col px-0">
    <p>Berikut adalah data report penjualan aplikasi Ssayomart</p>
    <?= csrf_field(); ?>
    <a href="<?= site_url('dashboard/report/printpdf/' . $getCheckoutWithProduct[0]['id_checkout']) ?>" type="button" class="btn btn-danger mb-4">Download PDF</a>
    <input type="hidden" name="id_checkout" id="id_checkout">
</div>

<div class="card border-1 shadow-sm mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-text-fill"></i>
        <h6 class="m-0 fw-bold px-2">List Report Data</h6>
    </div>

    <div class="card-body mt-2">
        <div class="row">
            <div class="col col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Toko</th>
                                <th rowspan="2">INV</th>
                                <th class="text-center" colspan="3" scope="colgroup">Produk</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">Total 1</th>
                                <th rowspan="2">Total 2</th>
                                <th rowspan="2">Tanggal</th>
                            </tr>
                            <tr class="text-center">
                                <th scope="colgroup">Nama Produk</th>
                                <th scope="colgroup">SKU</th>
                                <th scope="colgroup">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getCheckoutWithProduct as $p) : ?>
                                <tr>
                                    <td><?= $iterasi++; ?></td>
                                    <td><?= $p['lable']; ?></td>
                                    <td><?= $p['invoice']; ?></td>
                                    <td scope="colgroup">
                                        <?php
                                        $namaProduk = '';
                                        $varianProduk = '';
                                        foreach ($p['produk'] as $pr) {
                                            $namaProduk .= $pr['nama'] . ' - ' . $pr['value_item'] . '<br>';
                                        }
                                        echo $namaProduk;
                                        ?>
                                    </td>
                                    <td scope="colgroup">
                                        <?php
                                        $skuProduk = '';
                                        foreach ($p['produk'] as $pr) {
                                            $skuProduk .= $pr['sku'] . '<br>';
                                        }
                                        echo $skuProduk;
                                        ?>
                                    </td>
                                    <td scope="colgroup">
                                        <?php
                                        $jumlahProduk = '';
                                        foreach ($p['produk'] as $pr) {
                                            $jumlahProduk .= $pr['qty'] . '<br>';
                                        }
                                        echo $jumlahProduk;
                                        ?>
                                    </td>
                                    <td><?= $p['fullname']; ?></td>
                                    <td><?= number_format($p['total_1'], 0, ',', '.'); ?></td>
                                    <td><?= number_format($p['total_2'], 0, ',', '.'); ?></td>
                                    <td><?= date("d-m-Y", strtotime($p['created_at'])); ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?= $pager->links('checkout', 'pagerS') ?>
                </div>
            </div>

            <!-- Chart -->
            <div class="card-body col-sm-12">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    const quantityData = <?= json_encode(array_column($getCheckoutWithProduct, 'total_1')); ?>;
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