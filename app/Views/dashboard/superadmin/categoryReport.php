<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Filter Report Penjualan Berdasarkan Kategori</h1>
<p>Berikut ini adalah data penjualan Ssayomart. Anda bisa melihat report penjualan percabang, perkategori->subkategori->produk, dan perdaerah terlaris</p>

<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/dashboard-super-admin" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-10 text-center">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle fw-bold">
                                Penjualan Per-Invoice
                            </span>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-clipboard-data-fill fs-1 text-danger"></i>
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
    <div class="card shadow-sm p-3 mb-5 rounded mb-5 col-sm-12">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
            <i class="bi bi-file-text-fill text-danger"></i>
            <h6 class="m-0 fw-bold px-2 text-secondary">Filter Penjualan Berdasarkan Kategori Terlaris</h6>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-body my-3">
                    <!-- LOOPING KATEGORI -->
                    <div class="row">
                        <?php foreach ($categories as $category) : ?>
                            <div class="col-4">
                                <div class="card border-0 shadow-sm border-left-danger mb-4">
                                    <div class="row">
                                        <a href="<?= base_url('dashboard/sub-category-report/' . $category['id_kategori']) ?>">
                                            <div class="card-body d-flex">
                                                <div class="col-2 text-center">
                                                    <img src="<?= base_url() ?>assets/img/kategori/<?= $category['img'] ?>" alt="<?= $category['nama_kategori'] ?>" width="100">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle">
                                                        <?= $category['nama_kategori'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- END LOOPING KATEGORI -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between">
    <div class="card shadow-sm p-3 mb-5 rounded mb-5 col-sm-12">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
            <i class="bi bi-file-text-fill text-danger"></i>
            <h6 class="m-0 fw-bold px-2 text-secondary">Kategori Terlaris</h6>
        </div>
        <form id="dateFilterForm" action="<?= base_url('dashboard/category-report') ?>" method="get">
            <div class="row">
                <div class="col d-flex justify-content-start align-items-center my-4">
                    <input type="hidden" name="startDate" id="start_date" value="<?= $startDate ?>" />
                    <input type="hidden" name="endDate" id="end_date" value="<?= $endDate ?>" />
                    <i class="bi bi-calendar-fill me-3"></i>
                    <input type="text" class="form-control col-sm-2" name="daterange" value="<?= $startDate ? date('m/d/Y', strtotime($startDate)) . ' - ' . date('m/d/Y', strtotime($endDate)) : '' ?>" placeholder="Select a date range" />
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card-body mb-3">
                    <div class="row">
                        <?php
                        $salesData = [];
                        foreach ($categories as $category) {
                            $totalSales = 0;
                            foreach ($category['products'] as $product) {
                                $totalSales += $product['qty'];
                            }
                            $salesData[$category['nama_kategori']] = $totalSales;
                        }

                        arsort($salesData);

                        foreach ($salesData as $categoryName => $totalSales) {
                            echo '<div class="col-12 mb-3">';
                            echo '<div class="d-flex align-items-center">';
                            echo '<div class="me-3">' . $categoryName . '</div>';
                            echo '<div class="progress flex-grow-1">';
                            echo '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . ($totalSales * 10) . '%;" aria-valuenow="' . $totalSales . '" aria-valuemin="0" aria-valuemax="10000">' . $totalSales . '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'center',
            autoUpdateInput: false,
            // autoApply: true
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