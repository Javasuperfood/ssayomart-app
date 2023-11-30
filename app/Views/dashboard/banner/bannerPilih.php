<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">List Banner Aplikasi</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item active text-danger">Management Banner</li>
    <li class="breadcrumb-item"></li>
</ul>
<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/banner/tambah-banner" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-9 text-center">
                            <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">Banner Homepage</span>
                        </div>
                        <div class="col-3 text-center">
                            <i class=" bi bi-house-fill fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/banner/ads-konten-banner" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-9 text-center">
                            <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">Banner Artikel/Blog Konten</span>
                        </div>
                        <div class="col-3 text-center">
                            <i class="bi bi-newspaper fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/banner/pop-up-banner" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-9 text-center">
                            <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">Pop Up Homepage</span>
                        </div>
                        <div class="col-3 text-center">
                            <i class="bi bi-collection-fill fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <a href="<?= base_url() ?>dashboard/banner/promotion-banner" target="__blank">
                    <div class="card-body d-flex">
                        <div class="col-9 text-center">
                            <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">Banner Promosi</span>
                        </div>
                        <div class="col-3 text-center">
                            <i class="bi bi-percent fs-1 text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>