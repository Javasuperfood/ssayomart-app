<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>
<!-- Button Kategori -->
<section class="mt-2">
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <div class="swiper button-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($kategori_promo as $k) : ?>
                            <div class="swiper-slide">
                                <a href="<?= base_url('promo/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded">
                                    <?= $k['title']; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Card -->
<?= $this->include('user/produk/component/card') ?>




<!-- END -->
<?= $this->endSection(); ?>