<section class="mt-2 ">
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <div class="swiper buttonSwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($subKategori as $s) : ?>
                            <div class="swiper-slide mx-md-1 mx-5">
                                <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn btn-outline-danger btn-custom-rounded" style="width: 150px;">
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