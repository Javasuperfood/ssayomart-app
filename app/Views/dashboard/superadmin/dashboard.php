<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Report Penjualan</h1>
<p>Berikut ini adalah data penjualan Ssayomart. Anda bisa melihat report penjualan percabang, perkategori->subkategori->produk, dan perdaerah terlaris</p>

<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/category-report" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-10 text-center">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle fw-bold">
                                Penjualan Per-Kategori
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-diagram-3-fill fs-1 text-danger"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/region-report" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-10 text-center">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle fw-bold">
                                Penjualan Per-Daerah
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-compass-fill fs-1 text-danger"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between">
    <div class="card shadow-sm p-3 mb-3 rounded-3 col-sm-12">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
            <i class="bi bi-file-text-fill text-danger"></i>
            <h6 class="m-0 fw-bold px-2 text-secondary">Data Penjualan Setiap Cabang Ssayomart</h6>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-body mb-4">
                    <!-- Filter -->
                    <div class="mb-1 row">
                        <label for="branchFilter" class="form-label col-sm-2 d-flex align-items-center">Pilih Cabang :</label>
                        <select id="branchFilter" class="form-select mb-3 col-sm-10" aria-label="Select">
                            <?php foreach ($branches as $branch) : ?>
                                <option value="<?= $branch['id_toko']; ?>"><?= $branch['lable']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-1 row">
                        <label for="monthYearFilter" class="form-label col-sm-2 d-flex align-items-center">Pilih Tahun & Bulan :</label>
                        <select id="monthYearFilter" class="form-select mb-3 col-sm-10" aria-label="Select">
                        </select>
                    </div>

                    <div class="mb-1 row">
                        <h4 id="market-text" class="text-center fw-bold"></h4>
                    </div>
                    <!-- Tabel Penjualan -->
                    <div class="row">
                        <div class="col">
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
            </div>
        </div>
    </div>

    <!-- CHART -->
    <!-- <div class="card shadow-sm p-3 mb-5 rounded-3 col-sm-12">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
            <i class="bi bi-file-text-fill text-danger"></i>
            <h6 class="m-0 fw-bold px-2 text-secondary">Chart Report Penjualan Ssayomart</h6>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div> -->

    <script>
        var branches = <?= json_encode($market); ?>;

        function updateMarket() {
            var selectedMarket = $('#branchFilter').val();
            var filteredData = <?= json_encode($getSuperAdminReport); ?>;
            var filteredSalesData = filteredData.filter(function(data) {
                return data.id_toko == selectedMarket;
            });

            // Get the label from the first element (assuming it's the same for all)
            var marketLabel = filteredSalesData.length > 0 ? filteredSalesData[0].lable : '';

            // Update the market text
            $('#market-text').text('Report Penjualan Ssayomart - Cabang ' + marketLabel);

            // Populate month and year options based on the filtered data
            populateMonthYearOptions(filteredSalesData);

            // Update the table body with the filtered data
            updateTableBody(filteredSalesData);
        }

        function populateMonthYearOptions(data) {
            var uniqueMonthsYears = [...new Set(data.map(item => item.created_at.substring(0, 7)))];
            var monthYearFilter = $('#monthYearFilter');
            monthYearFilter.empty();
            monthYearFilter.append('<option value="">-- Pilih Tahun & Bulan --</option>');
            uniqueMonthsYears.forEach(function(monthYear) {
                monthYearFilter.append('<option value="' + monthYear + '">' + monthYear + '</option>');
            });
        }

        function formatNumber(number) {
            // Remove commas and convert to a number
            const numericValue = parseFloat(number.replace(/,/g, ''));

            // Format the number with "Rp" prefix and commas
            return 'Rp ' + numericValue.toLocaleString('id-ID');
        }

        function updateTableBody(data) {
            var tableBody = $('#salesDataBody');
            tableBody.empty();

            if (data.length > 0) {
                data.forEach(function(p, index) {
                    var namaProduk = '';
                    var skuProduk = '';
                    var jumlahProduk = '';

                    p['produk'].forEach(function(pr) {
                        namaProduk += pr['nama'] + ' (' + pr['value_item'] + ')<br>';
                        skuProduk += pr['sku'] + '<br>';
                        jumlahProduk += pr['qty'] + '<br>';
                    });

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
                });
            } else {
                var noDataMessage = '<tr><td colspan="9" class="text-center">Data penjualan untuk cabang ini belum tersedia.</td></tr>';
                tableBody.append(noDataMessage);
            }
        }

        updateMarket();

        $('#branchFilter').change(updateMarket);

        $('#monthYearFilter').change(function() {
            var selectedMonthYear = $(this).val();
            var selectedMarket = $('#branchFilter').val();
            var filteredData = <?= json_encode($getSuperAdminReport); ?>;
            var filteredSalesData = filteredData.filter(function(data) {
                return data.id_toko == selectedMarket && data.created_at.substring(0, 7) == selectedMonthYear;
            });

            updateTableBody(filteredSalesData);
        });
    </script>

    <?= $this->endSection(); ?>