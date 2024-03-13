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

<?= $this->endSection(); ?>