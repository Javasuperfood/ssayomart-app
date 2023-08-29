<section class="mt-2">
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <div class="swiper button-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($kategori as $k) : ?>
                            <div class="swiper-slide">
                                <a href="<?= base_url('produk/kategori/' . $k['slug']); ?>" class="btn border-0 btn-custom-rounded">
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