<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Report Penjualan Cabang Ssayomart</h1>
<p>Berikut ini adalah data penjual di setiap cabang Ssayomart</p>

<div class="d-flex justify-content-between">
    <div class="card shadow-sm p-3 mb-5 rounded mb-5 col-sm-8">
        <div class="card-header bg-white d-flex justify-content-start align-items-center border-1 py-3">
            <i class="bi bi-file-text-fill"></i>
            <h6 class="m-0 fw-bold px-2">Data Penjualan Setiap Cabang Ssayomart</h6>
        </div>

        <div class="card-body">
            <!-- Filter -->
            <div class="mb-4 row">
                <label for="branchFilter" class="form-label col-sm-2 d-flex align-items-center">Pilih Cabang :</label>
                <select id="branchFilter" class="form-select mb-3 col-sm-10" aria-label="Select">
                    <?php foreach ($branches as $branch) : ?>
                        <option value="<?= $branch['id_toko']; ?>"><?= $branch['lable']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4 row">
                <label for="filter" class="form-label col-sm-2 d-flex align-items-center">Urutkan berdasarkan :</label>
                <select id="filter" class="form-select mb-3 col-sm-10" aria-label="Select">
                    <option selected value="monthly">Bulan</option>
                    <option value="yearly">Tahun</option>
                </select>
            </div>
            <!-- Tabel Penjualan -->
            <div class="row">
                <div class="col ">
                    <div class="table-responsive table-sm">
                        <table class="table table-bordered text-center fs-6" width="100%" cellspacing="0">
                            <tbody>
                                <?php if ($getSuperAdminReport != null && !empty($getSuperAdminReport)) : ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Invoice</th>
                                                    <th class="text-center" colspan="3" scope="colgroup">Produk</th>
                                                    <th rowspan="2">Nama</th>
                                                    <th rowspan="2">Total</th>
                                                    <th rowspan="2">Grand Total</th>
                                                    <th rowspan="2">Tanggal</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th scope="colgroup">Nama Produk</th>
                                                    <th scope="colgroup">SKU</th>
                                                    <th scope="colgroup">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody id="salesDataBody">
                                                <?php foreach ($getSuperAdminReport as $p) : ?>
                                                    <tr>
                                                        <td><?= $iterasi++; ?></td>
                                                        <td>
                                                            <?= $p['invoice']; ?>
                                                        </td>
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
                                        <div class="d-flex justify-content-center align-items-center">
                                            <?= $pager->links('checkout', 'pagerS') ?>
                                        </div>

                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-danger text-center mt-2" role="alert">
                                        Data penjualan belum tersedia.
                                    </div>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="border-0 col-sm-4 ms-3">
            <div class="card mb-3 shadow-sm p-3 bg-body rounded">
                <div class="card-body">
                    <p class="fw-bold">Data Penjualan Ssayomart</p>
                    <canvas id="myChart" style="background-color: #f7f7f7;"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const branchFilter = document.getElementById('branchFilter');
        const filterSelect = document.getElementById('filter');

        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ag', 'Sep', 'Oct'];

        // Data yang diterima dari controller
        const penjualanData = <?= json_encode($penjualan) ?>;
        // Sesuaikan dengan kebutuhan grafik
        const monthlyData = penjualanData.monthlyData;
        const yearlyData = penjualanData.yearlyData;

        const initialChartData = {
            labels: months,
            datasets: [{
                label: 'Penjualan Ssayomart',
                data: monthlyData,
                borderWidth: 1,
                borderColor: '#ec261f',
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

        const initialSelectedFilter = filterSelect.value;
        filterSelect.value = '';
        filterSelect.value = initialSelectedFilter;

        // filter
        branchFilter.addEventListener('change', function() {
            const selectedBranch = branchFilter.value;
            const filteredData = penjualanData.find(item => item.id_toko == selectedBranch);

            if (filterSelect.value === 'monthly') {
                myChart.data.labels = months;
                myChart.data.datasets[0].data = filteredData.monthlyData;
            } else if (filterSelect.value === 'yearly') {
                myChart.data.labels = ['2021', '2022', '2023', '2024'];
                myChart.data.datasets[0].data = filteredData.yearlyData;
            }

            myChart.update();
        });
    </script>

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

    <script>
        var branches = <?= json_encode($market); ?>;

        function updateMarket() {
            var selectedMarket = $('#branchFilter').val();
            var filteredData = <?= json_encode($getSuperAdminReport); ?>; // Assuming $getSuperAdminReport is available in your script

            // Filter data based on the selected branch
            var filteredSalesData = filteredData.filter(function(data) {
                return data.id_toko == selectedMarket;
            });

            // Update the table body with the filtered data
            updateTableBody(filteredSalesData);
        }

        function updateTableBody(data) {
            var tableBody = $('#salesDataBody');
            tableBody.empty();

            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(number);
            }

            if (data.length > 0) {
                data.forEach(function(p, index) {
                    var namaProduk = '';
                    var skuProduk = '';
                    var jumlahProduk = '';

                    // Loop through products in the sales data
                    p['produk'].forEach(function(pr) {
                        namaProduk += pr['nama'] + ' (' + pr['value_item'] + ')<br>';
                        skuProduk += pr['sku'] + '<br>';
                        jumlahProduk += pr['qty'] + '<br>';
                    });
                    // + p['invoice']
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' +
                        '<a href="<?= base_url(); ?>dashboard/dashboard-detail-inv/' + p['user_id'] + '">' +
                        p['invoice'] +
                        '</a>' +
                        '</td>' +
                        '<td>' + p['produk'][0]['nama'] + '</td>' +
                        '<td>' + p['produk'][0]['sku'] + '</td>' +
                        '<td>' + p['qty'] + '</td>' +
                        '<td>' + p['fullname'] + '</td>' +
                        '<td>' + formatNumber(p['total_1']) + '</td>' +
                        '<td>' + formatNumber(p['total_2']) + '</td>' +
                        '<td>' + p['created_at'] + '</td>' +
                        '</tr>';
                    tableBody.append(row);
                    console.log(p['user_id'])
                });
            } else {
                // Display a message if no data is available
                var noDataMessage = '<tr><td colspan="9" class="text-center">Data penjualan untuk cabang ini belum tersedia.</td></tr>';
                tableBody.append(noDataMessage);
            }
        }

        // Initial update when the page loads
        updateMarket();

        // Bind the change event to the branch filter
        $('#branchFilter').change(updateMarket);
    </script>


    <?= $this->endSection(); ?>