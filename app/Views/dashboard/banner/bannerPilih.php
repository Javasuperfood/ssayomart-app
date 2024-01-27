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
            <a href="<?= base_url() ?>dashboard/banner/tambah-banner" target="_blank" class="text-decoration-none icon-house">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-house-fill fs-2 text-secondary icon-house"></i>
                        <h6 class="mt-2 text-secondary">Banner Homepage</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/ads-konten-banner" target="_blank" class="text-decoration-none icon-artikel">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-newspaper fs-2 text-secondary icon-artikel"></i>
                        <h6 class="mt-2 text-secondary">Banner Artikel / Blog Konten</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/pop-up-banner" target="_blank" class="text-decoration-none icon-collection">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-collection-fill fs-2 text-secondary icon-collection"></i>
                        <h6 class="mt-2 text-secondary">Pop Up Homepage</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card card-banner border-0 shadow-sm border-left-danger h-100">
            <a href="<?= base_url() ?>dashboard/banner/promotion-banner" target="_blank" class="text-decoration-none icon-promosi">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-percent fs-2 text-secondary icon-promosi"></i>
                        <h6 class="mt-2 text-secondary">Banner Promosi</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
.icon-house,
.icon-artikel,
.icon-collection,
.icon-promosi {
    animation: customAni 2s ease 0s 1 normal none;
    transform-origin: center bottom;
}
.icon-house:hover,
.icon-artikel:hover,
.icon-collection:hover,
.icon-promosi:hover {
    transform: scale(1.1); 
    transition: transform 0.3s ease; 
}
@keyframes customAni {
    0% {
        animation-timing-function: ease-in;
        opacity: 1;
        transform: translateY(-20px);
    }

    24% {
        opacity: 1;
    }

    40% {
        animation-timing-function: ease-in;
        transform: translateY(-10px);
    }

    65% {
        animation-timing-function: ease-in;
        transform: translateY(-5px);
    }

    82% {
        animation-timing-function: ease-in;
        transform: translateY(-3px);
    }

    93% {
        animation-timing-function: ease-in;
        transform: translateY(-2px);
    }

    25%,
    55%,
    75%,
    87% {
        animation-timing-function: ease-out;
        transform: translateY(0px);
    }

    100% {
        animation-timing-function: ease-out;
        opacity: 1;
        transform: translateY(0px);
    }
}
</style>

<?= $this->endSection(); ?>
