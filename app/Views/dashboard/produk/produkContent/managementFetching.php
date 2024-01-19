<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Management Fetching Produk</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item active text-danger">Management Fetching Produk</li>
    <li class="breadcrumb-item"></li>
</ul>
<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/produk/pilih-produk-rekomendasi" target="__blank" class="text-decoration-none">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-bookmark-star fs-2 text-secondary"></i>
                        <h6 class="text-secondary mt-2">Pilih Produk Rekomendasi</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/produk/pilih-produk-terbaru" target="__blank" class="text-decoration-none">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-grid-3x3-gap fs-2 text-secondary"></i>
                        <h6 class="text-secondary mt-2">Ubah Urutan Produk Terbaru</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>