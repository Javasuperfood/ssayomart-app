<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container">
    <div class="card mb-3 shadow-sm border-0">
        <?php
        $iteration = 0; // Inisialisasi variabel iterasi
        foreach ($promo as $p) :
            if ($iteration < 1) : // Batasan 4 iterasi
        ?>
                <a href="<?= base_url() ?>promo/<?= $p['slug']; ?>">
                    <img src="<?= base_url() ?>assets/img/promo/1701760476_754480444146dd2fdb1f.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title fw-bold m-0 text-decoration-none text-dark">Promo asik-asik</h5>
                        <p class="card-text text-dark">ini adalah promo murah yang ada di ssayomart</p>
                    </div>
                </a>
        <?php
                $iteration++; // Tingkatkan variabel iterasi
            endif;
        endforeach
        ?>
    </div>
    <div class="card mb-3 shadow-sm border-0">
        <img src="<?= base_url() ?>assets/img/promo/1701760532_f63f4d88028cfe9482fa.jpg" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title fw-bold m-0">Promo asik-asik</h5>
            <p class="card-text">ini adalah promo murah yang ada di ssayomart</p>

        </div>
    </div>
    <div class="card mb-3 shadow-sm border-0">
        <img src="<?= base_url() ?>assets/img/promo/1701760532_f63f4d88028cfe9482fa.jpg" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title fw-bold m-0">Promo asik-asik</h5>
            <p class="card-text">ini adalah promo murah yang ada di ssayomart</p>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>