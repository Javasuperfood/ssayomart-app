<div class="container" id="product">
    <!-- <h2>Produk terlaris</h2> -->
    <div class="row mt-2 row-cols-3">
        <?php foreach ($produk as $p) : ?>
            <div class="col">
                <div class="card border-0 shadow" style="width: auto;">
                    <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="fs-6" style="padding: 10px 10px 10px 10px;">
                        <p class="text-secondary" style="font-size: 15px;">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                        <p class=" text-secondary" style="font-size: 14px;"><?= substr($p['nama'], 0, 15); ?>...</p>
                        <p class=" text-center">

                            <button class="btn btn-white mt-2 add-to-cart-btn" produk="<?= $p['id_produk']; ?>" harga="<?= $p['harga']; ?>"> <i class=" fas fa-shopping-cart text-danger"></i></button>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<input type="hidden" id="qty" name="qty" value="1">
<?= $this->include('user/component/scriptAddToCart'); ?>