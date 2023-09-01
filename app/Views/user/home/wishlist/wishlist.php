<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container pt-5">
    <div class="row text-center">

        <?php foreach ($produk as $p) : ?>
            <div class="col-6">
                <div class="card my-2">
                    <form action="<?= base_url(); ?>wishlist/delete/<?= $p['id_wishlist_produk']; ?>" method="post" class="position-relative">
                        <?= csrf_field(); ?>
                        <button class="position-absolute top-0 end-0 pe-1 btn border-0" type="submit"><i class="bi bi-x-circle fs-3"></i></button>
                    </form>
                    <a href="<?= base_url('produk/' . $p['slug']); ?>">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-title">Rp. <?= number_format($p['harga'], 2, ',', '.'); ?></p>
                        <p class="card-text text-secondary"><?= $p['nama']; ?></p>
                        <input type="hidden" name="id_produk" id="id_produk" value="<?= $p['id_produk']; ?>">
                        <input type="hidden" name="harga" id="harga" value="<?= $p['harga']; ?>">
                        <input type="hidden" id="qty" name="qty" value="1">
                        <button class="btn btn-light add-to-cart-btn" style="background-color: #ec2614; color:#fff;"><i class=" bi bi-cart2"></i></button>
                        <a href="#" class="btn btn-light" style="background-color: #ec2614; color:#fff;">Beli</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <a href="<?= base_url() ?>cart" class="btn btn-danger btn-lg rounded-circle bottom-0 end-0 mx-2 my-3 float-right position-fixed"><i class="bi bi-cart2"></i></a>
</div>
<?= $this->include('user/component/scriptAddToCart'); ?>

<?= $this->endSection(); ?>