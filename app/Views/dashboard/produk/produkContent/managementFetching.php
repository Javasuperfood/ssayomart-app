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
            <a href="<?= base_url() ?>dashboard/produk/pilih-produk-rekomendasi" target="__blank" class="text-decoration-none icon-bookmark">
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
            <a href="<?= base_url() ?>dashboard/produk/pilih-produk-terbaru" target="__blank" class="text-decoration-none icon-grid">
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
<style>
.icon-bookmark,
.icon-grid {
    animation: customAni 2s ease 0s 1 normal none;
    transform-origin: center bottom;
}
.icon-bookmark:hover,
.icon-grid:hover {
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