<?php if ($produk) : ?>
    <div class="container" id="product">
        <!-- <h2>Produk terlaris</h2> -->
        <div class="row mt-3 row-cols-3" id="product-container">

            <?php foreach ($produk as $p) : ?>
                <div class="col-6 col-md-4 col-lg-2 pt-3">
                    <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                        <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                            <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3" alt="...">
                        </a>
                        <div class="fs-3 mt-3" style="padding: 0 10px 0 10px;">
                            <h1 class="text-secondary" style="font-size: 15px;">
                                <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                    Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                <?php else : ?>
                                    <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                <?php endif ?>
                            </h1>
                            <p class=" text-secondary" style="font-size: 14px;"><?= substr($p['nama'], 0, 15); ?>...</p>
                            <p class=" text-center">
                                <a href="<?= base_url('produk/' . $p['slug']); ?>?add-to-cart=show" class="btn btn-white"> <i class=" fas fa-shopping-cart text-danger fa-lg"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
<?php else : ?>
    <div class="container px-5 my-5 align-middle">
        <div class="card border-0 text-center rounded shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Produk belum tersedia</h5>
                <a href="/" class="btn btn-danger border-0 rounded ">Kembali</a>
            </div>
        </div>
    </div>
<?php endif ?>