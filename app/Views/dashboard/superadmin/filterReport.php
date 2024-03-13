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
                <a href="#" target="__blank">
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
            <i class="bi bi-file-text-fill"></i>
            <h6 class="m-0 fw-bold px-2">Data Penjualan Per-Kategori Ssayomart</h6>
        </div>
        <div class="card-body mb-4">
            <!-- Filter Tahun -->
            <div class="mb-1 row">
                <label for="yearFilter" class="form-label col-sm-2 d-flex align-items-center">Pilih Tahun :</label>
                <input type="date" id="yearFilter" class="form-control col-sm-10 mb-3" name="year">
            </div>
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
                                    <!-- LOOPING PRODUK -->
                                    <?php foreach ($products as $key => $product) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td scope="colgroup"><?= $product['nama'] ?></td>
                                            <td><?= $product['harga']; ?></td>
                                            <td><?= $product['terjual'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- END LOOPING PRODUK -->
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

<?= $this->endSection(); ?>