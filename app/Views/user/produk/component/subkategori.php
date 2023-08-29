<section class="mt-2 ">
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <div class="swiper button-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($subKategori as $s) : ?>
                            <div class="swiper-slide">
                                <a href="<?= base_url(); ?>produk/kategori/<?= $s['slugK']; ?>/<?= $s['slugS']; ?>" class="btn btn-outline-danger btn-custom-rounded">
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