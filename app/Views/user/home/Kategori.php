<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarTop') ?>
<?= $this->include('user/home/component/slider') ?>

<!-- ITEM -->
<div class="container py-3">
    <h2>Spesial di Ssayomart!</h2>
    <div class="row text-center row-cols-3">
        <?php foreach ($promo as $p) : ?>
            <div class="col">
                <div class="swiper-slide">
                    <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                        <div class="card-body">
                            <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                                <img src="<?= base_url() ?>assets/img/promo/<?= $p['img']; ?>" width="60px" alt="<?= $p['title']; ?>" class="card-img-top">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div class="container py-2">
    <h2>Semua Kategori</h2>
    <div class="row text-center row-cols-3">
        <?php foreach ($kategori as $k) : ?>
            <div class="col">
                <a href="<?= base_url('produk/kategori/' . $k['slug']) ?>">
                    <div class="card text-bg-light mb-3 bg-white border-0 shadow">
                        <div class="card-body">
                            <img src="<?= base_url('assets/img/kategori/' . $k['img']) ?>" width="60px" alt="" class="card-img-top">
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="row pb-5">
        <div class="col"></div>
    </div>
</div>

<?= $this->endSection(); ?>