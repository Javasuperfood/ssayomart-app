<?php if ($produk) : ?>
    <div class="container bg-white" id="product">

        <div class="row row-cols-3" id="product-container">
            <!-- All Produk -->
            <?php foreach ($produk as $p) : ?>
                <div class="col-4 col-md-2 col-lg-2 mb-3 susunan-card">
                    <div>
                        <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%; padding: 5px;">
                            <a href="<?= base_url() ?>detail-promo-bundle/<?= $produk[0]['id_promo_produk']; ?>" class="link-underline link-underline-opacity-0">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="<?= base_url() ?>assets/img/promo/bundle/<?= $p['promo_img']; ?>" class="card-img-top text-center py-0 px-0 mx-0 my-0" alt="..." style=" width: 100px; height: 100px; object-fit: contain;">
                                </div>
                            </a>
                            <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                <div class="d-flex align-items-start panjang-card justify-content-center" style=" height: 90px;">
                                    <!-- <p class=" text-center text-secondary fw-bold  " style=" font-size: 9px; margin: 0;"><?= substr($p[$kolomNama], 0, 70); ?></p> -->
                                    <p class=" text-center text-secondary fw-bold  " style=" font-size: 9px; margin: 0;">
                                        <?= substr($p['nama'], 0, 70); ?></p>
                                </div>
                                <h1 class="text-dark fs-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                                    <?php if (isset($p['harga_min']) && isset($p['harga_max'])) : ?>
                                        <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                            Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                        <?php else : ?>
                                            <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                </h1>
                                <!-- button Animasi -->
                                <!-- akhir button animasi -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>


<?php else : ?>
    <div class="container px-5 my-5 align-middle">
        <div class="card border-0 text-center rounded shadow-sm">
            <div class="card-body mx-3 my-3">
                <h5 class="card-title" style="font-size: 16px">Produk tidak ditemukan atau belum tersedia</h5>
                <a href="/" class="btn btn-danger border-0 rounded mt-2" style="font-size: 14px">Kembali</a>
            </div>
        </div>
    </div>
<?php endif ?>

<style>
    .horizontal-counter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .horizontal-counter .btn {
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    .horizontal-counter input {
        width: 40px;
        text-align: center;
    }

    /* Media query for Samsung Galaxy Fold */
    @media only screen and (max-width: 280px) {
        .col-4 {
            width: 50%;
        }
    }
</style>