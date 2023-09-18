<!-- tampilan mobile & ipad -->
<section class="mt-2">
    <div class="container d-md-none d-lg-none">
        <div class="row text-center">
            <div class="col">
                <div class="swiper btn-sub">
                    <div class="swiper-wrapper">
                        <?php foreach ($kategori as $k) : ?>
                            <div class="swiper-slide mx-5">
                                <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded " style="width: 200px;">
                                    <?= $k['nama_kategori']; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- tampilan mobile & ipad -->
<!-- tampilan Desktop -->
<section class="mt-3">
    <div class="container d-none d-md-block">
        <div class="row text-center">
            <div class="col">
                <div class="swiper btn-sub">
                    <div class="swiper-wrapper">
                        <?php foreach ($kategori as $k) : ?>
                            <div class="swiper-slide mx-5">
                                <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="btn btn-danger border-0 btn-custom-rounded " style="width: 200px;">
                                    <?= $k['nama_kategori']; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- tampilan Desktop -->