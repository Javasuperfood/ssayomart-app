<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Data Penjualan Ssayomart</h1>
<div class="col px-0">
    <p>Berikut adalah data penjualan Ssayomart.</p>
    <?php if ($getCheckoutWithProduct != null && !empty($getCheckoutWithProduct)) : ?>
        <a href="<?= site_url('dashboard/report/printpdf/' . $getCheckoutWithProduct[0]['id_checkout']) ?>" type="button" class="btn btn-danger mb-4">Download PDF</a>
        <input type="hidden" name="id_checkout" id="id_checkout">
    <?php endif ?>
</div>

<div class="card border-1 shadow-sm mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-text-fill"></i>
        <h6 class="m-0 fw-bold px-2">List Report Data</h6>
    </div>


    <div class="card-body mt-2">
        <div class="row">
            <form id="dateFilterForm" action="<?= base_url('dashboard/report') ?>" method="get">
                <div class="col-md-3 mb-3">
                    <input type="hidden" name="startDate" id="start_date" value="<?= $startDate ?>" />
                    <input type="hidden" name="endDate" id="end_date" value="<?= $endDate ?>" />
                    <!-- <?php echo $startDate ?>
                    <?php echo $endDate ?> -->
                    <i class="fa fa-calendar"></i>&nbsp;
                    <input type="text" name="daterange" value="<?= $startDate ? date('m/d/Y', strtotime($startDate)) . ' - ' . date('m/d/Y', strtotime($endDate)) : '' ?>" placeholder="Select a date range" />
                </div>
            </form>
            <div class="col col-sm-12">
                <?php if ($getCheckoutWithProduct != null && !empty($getCheckoutWithProduct)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
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
                                                $namaProduk .= $pr['nama'] . ' (' . $pr['value_item'] . ')<br>';
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

                        <!-- Chart -->
                        <div class="card-body col-sm-12 mt-4">
                            <p class="fw-bold">Data Penjualan Ssayomart</p>
                            <canvas id="myChart" style="width: 100%; height: 400px;"></canvas>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger text-center mt-4" role="alert">
                        Data penjualan belum tersedia.
                    </div>
                <?php endif; ?>
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

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            autoUpdateInput: false
        }, function(start, end, label) {
            // When the user selects a date range, update the hidden input values
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));

            // Trigger the form submission to update the data
            $('#dateFilterForm').submit();
        });
    });
</script>

<?= $this->endSection(); ?>