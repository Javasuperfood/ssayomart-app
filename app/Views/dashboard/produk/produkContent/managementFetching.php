<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Management Fetching Produk</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item active text-danger">Management Fetching Produk</li>
    <li class="breadcrumb-item"></li>
</ul>
<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/produk/pilih-produk-rekomendasi" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-9 text-center">
                            <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">Pilih Produk Rekomendasi</span>
                        </div>
                        <div class="col-3 text-center">
                            <i class=" bi bi-hand-thumbs-up fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/produk/pilih-produk-terbaru" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-9 text-center">
                            <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">Ubah Urutan Produk Terbaru</span>
                        </div>
                        <div class="col-3 text-center">
                            <i class="bi bi-view-list fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>