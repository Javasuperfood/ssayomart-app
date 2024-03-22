<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Report Penjualan</h1>
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
            <h6 class="m-0 fw-bold px-2 text-secondary">Data Penjualan Per-Kategori Ssayomart</h6>
        </div>
        <div class="card-body mb-4">
            <!-- Tabel Penjualan -->
            <div class="row">
                <div class="col">
                    <div class="table-responsive table-sm">
                        <?php if (!empty($products)) : ?>
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th class="text-center" colspan="2" scope="colgroup">Data Produk</th>
                                        <th rowspan="2">Terjual</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th scope="colgroup">Nama Produk</th>
                                        <th scope="colgroup">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $key => $product) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td scope="colgroup"><?= $product['nama'] ?></td>
                                            <td><?= 'Rp ' . number_format($product['harga'], 0, ',', '.'); ?></td>
                                            <td><?= $product['terjual'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-danger text-center mt-2" role="alert">
                                Data penjualan belum tersedia.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="d-flex justify-content-between">
    <div class="card shadow-sm p-3 mb-5 rounded mb-5 col-sm-12">
        <div class="card-header d-flex justify-content-start align-items-center border-1 py-3 bg-white">
            <i class="bi bi-file-text-fill text-danger"></i>
            <h6 class="m-0 fw-bold px-2 text-secondary">Produk Terlaris</h6>
        </div>
        <form id="dateFilterForm" action="<?= base_url('dashboard/filter-report/' . $productId) ?>" method="get">
            <div class="justify-content-start align-items-center my-4">
                <input type="hidden" name="productId" value="<?= $productId ?>">
                <input type="hidden" name="startDate" id="start_date" value="<?= $startDate ?>" />
                <input type="hidden" name="endDate" id="end_date" value="<?= $endDate ?>" />
                <label for="daterange"> Pilih Range Tanggal :</label>
                <input type="text" class="form-control" name="daterange" value="<?= $startDate ? date('m/d/Y', strtotime($startDate)) . ' - ' . date('m/d/Y', strtotime($endDate)) : '' ?>" placeholder="Select a date range" />
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card-body mt-2 mb-3">
                    <div class="row">
                        <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $product) : ?>
                                <div class="col-12 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3"><?= $product['nama'] ?></div>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?= ($product['total_terjual'] * 10) ?>%;" aria-valuenow="<?= $product['total_terjual'] ?>" aria-valuemin="0" aria-valuemax="10000"><?= $product['total_terjual'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-12">
                                Data produk tidak tersedia.
                            </div>
                        <?php endif; ?>
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