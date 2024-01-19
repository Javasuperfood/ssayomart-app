<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">List Banner Aplikasi</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item active text-danger">Management Banner</li>
    <li class="breadcrumb-item"></li>
</ul>
<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/tambah-banner" target="__blank" class="text-decoration-none">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-house-fill fs-2 text-secondary"></i>
                        <h6 class="mt-2 text-secondary">Banner Homepage</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/ads-konten-banner" target="__blank" class="text-decoration-none">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-newspaper fs-2 text-secondary"></i>
                        <h6 class="mt-2 text-secondary">Banner Artikel / Blog Konten</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/pop-up-banner" target="__blank" class="text-decoration-none">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-collection-fill fs-2 text-secondary"></i>
                        <h6 class="mt-2 text-secondary">Pop Up Homepage</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/promotion-banner" target="__blank" class="text-decoration-none">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-percent fs-2 text-secondary"></i>
                        <h6 class="mt-2 text-secondary">Banner Promosi</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>