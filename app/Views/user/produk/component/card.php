<div class="container" id="product">
    <!-- <h2>Produk terlaris</h2> -->
    <div class="row mt-2 row-cols-3">
        <?php foreach ($produk as $p) : ?>
            <div class=" col">
                <a href="<?= base_url() ?>produk/single" class="link-underline link-underline-opacity-0">
                    <div class="card border-0 shadow" style="width: auto;">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['gambar']; ?>" class="card-img-top" alt="...">
                        <div class="fs-6" style="padding: 10px 10px 10px 10px;">
                            <p class="text-secondary" style="font-size: 15px;">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                            <p class=" text-secondary" style="font-size: 14px;"><?= substr($p['nama'], 0, 15); ?>...</p>
                            <p class=" text-center"><a href="#" class="btn btn-white mt-2"> <i class="fas fa-shopping-cart text-danger"></i></a></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>


</div>