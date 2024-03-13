<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Filter Sub Kategori</h1>

<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/category-report">
                    <div class="card-body d-flex">
                        <div class="col-2 text-start">
                            <i class="bi bi-arrow-left-circle-fill fs-1 text-danger"></i>
                        </div>
                        <div class="col-8">
                            <span class="text-secondary fs-6 position-absolute top-50 start-50 translate-middle">
                                List Kategori
                            </span>
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
                    <!-- LOOPING SUB KATEGORI -->
                    <div class="row">
                        <?php foreach ($subcategories as $subcategory) : ?>
                            <div class="col-4">
                                <div class="card border-0 shadow-sm border-left-warning mb-4">
                                    <div class="row">
                                        <a href="<?= base_url('dashboard/filter-report/' . $subcategory['id_sub_kategori']) ?>">
                                            <div class="card-body d-flex">
                                                <div class="col-2 text-center">
                                                    <img src="<?= base_url() ?>assets/img/logo.png" alt="<?= $subcategory['nama_kategori'] ?>" width="100">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">
                                                        <?= $subcategory['nama_kategori'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- END LOOPING SUB KATEGORI -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>