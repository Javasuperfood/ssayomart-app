<!-- tampilan mobile & ipad -->
<section class="mt-2">
    <div class="container d-md-none d-lg-none">
        <div class="row text-center">
            <div class="col">
                <div class="swiper buttonSwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($subKategori as $s) : ?>
                            <div class="swiper-slide mx-3">
                                <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn border-0 btn-custom-rounded text-danger " style="width: 200px;">
                                    <?= $s['nama_kategori']; ?>
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

<!-- tampilan Destop -->
<section class="mt-4">
    <div class="container d-none d-md-block">
        <div class="row text-center">
            <div class="col">
                <div class="swiper buttonSwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($subKategori as $s) : ?>
                            <div class="swiper-slide mx-3">
                                <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn btn-outline-danger border-1 btn-custom-rounded " style="width: 200px;">
                                    <?= $s['nama_kategori']; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- tampilan Destop -->