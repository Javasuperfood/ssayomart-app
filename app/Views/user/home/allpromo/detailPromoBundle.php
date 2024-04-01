<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container mt-4 justify-content-center">
    <div class="col text-center">
        <div class="container">
            <div class="gallery">
                <img src="<?= base_url() ?>assets/img/promo/bundle/<?= $promoProduk['promo_img']; ?>" class="img-fluid rounded-2" alt="Promotion Image">
            </div>
        </div>
    </div>
</div>
<div class="container overflow-hidden p-1 mt-3 rounded-top-5" style="background-color:#fff; box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;">
    <section class="container d-flex">
        <div class="col-6 mt-5">
            <h4 class="fw-bold" style="color:#81271f;"><?= $promoProduk['title']; ?></h4>
            <p class="text-dark fw-bold" style="font-size: 13px;">
                Rp. <?= number_format($promoProduk['harga_item'], 0, ',', '.'); ?> / Pcs
            </p>
        </div>
        <div class="col-6 mt-5 text-end">
            <form action="<?= base_url('checkout2') ?>" method="get">
                <a id="buyButton_1" href="<?= base_url('checkout2?id_promo_produk=' . $promoProduk['id_promo_produk'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty=' . ((isset($_GET['qty'])) ? $_GET['qty'] : 1)); ?>" class="btn btn-lg btn-outline-danger"><i class="bi bi-cart-fill me-2"></i><?= lang('Text.btn_beli') ?></a>
                <input type="hidden" name="id_promo_produk" value="<?= $promoProduk['id_promo_produk'] ?>">
            </form>
        </div>
    </section>
    <div class="row">
        <div class="col-12 p-4">
            <h3 class="text-start fw-bold" style="color:#81271f;">Produk Bundle</h3>
            <?php
            $concatenatedNames = '';
            $concatenatedNames .= $promoProduk['nama'];
            foreach ($promoProduk['produk'] as $pa) {
                $concatenatedNames .= ' + ' . $pa['nama'];
            }
            echo "<p class='text-start text-dark fs-8 fst-italic'>" . $concatenatedNames . "</p>";
            ?>
            <h3 class="text-start fw-bold" style="color:#81271f;">Deskripsi Promo</h3>
            <p class="text-start fs-8 fst-italic">
                <?= $promoProduk['promo_deskripsi']; ?>
            </p>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>