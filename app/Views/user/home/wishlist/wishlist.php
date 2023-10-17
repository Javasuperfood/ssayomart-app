<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-5 d-md-none">
            <div class="row text-center">
                <?php foreach ($produk as $p) : ?>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm my-2">
                            <form action="<?= base_url(); ?>wishlist/delete/<?= $p['id_wishlist_produk']; ?>" method="post" class="position-relative">
                                <?= csrf_field(); ?>
                                <button class="position-absolute top-0 end-0 pe-1 btn border-0" type="submit"><i class="bi bi-x-circle-fill fs-3 text-danger"></i></button>
                            </form>
                            <a href="<?= base_url('produk/' . $p['slug']); ?>">
                                <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <p class="card-title">Rp. {harga}
                                <div>
                                    <a href="<?= base_url('produk/' . $p['slug'] . '?add-to-cart=show'); ?>" class="btn btn-white text-danger border-danger mt-4"><i class=" bi bi-cart-fill"></i></a>
                                    <a href="<?= base_url('produk/' . $p['slug'] . '?buy=show'); ?>" class="btn btn-white text-danger border-danger mt-4 fw-bold">Beli</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <a href="<?= base_url() ?>cart" class="btn btn-danger btn-lg rounded-circle bottom-90 end-0 mx-2 my-3 float-right position-fixed"><i class="bi bi-cart2"></i></a>
        </div>
    </div>
<?php else : ?>
    <!-- end mobile -->

    <!-- desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container d-none d-md-block">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-2 mb-">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <h2 class="mb-0 text-danger"><i class="bi bi-heart-fill"></i> Wishlist</h2>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row mt-4">
                <?php foreach ($produk as $p) : ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card border-0 shadow-sm mb-5">
                            <form action="<?= base_url(); ?>wishlist/delete/<?= $p['id_wishlist_produk']; ?>" method="post" class="position-relative">
                                <?= csrf_field(); ?>
                                <button class="position-absolute top-0 end-0 pe-1 btn border-0" type="submit"><i class="bi bi-x-circle-fill text-danger fs-3"></i></button>
                            </form>
                            <a href="<?= base_url('produk/' . $p['slug']); ?>">
                                <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                            </a>
                            <div class=" card-body text-center">
                                <p class="card-title">Rp. {harga}
                                <div>
                                    <a href="<?= base_url('produk/' . $p['slug'] . '?add-to-cart=show'); ?>" class="btn btn-white text-danger border-danger mt-4"><i class=" bi bi-cart-fill"></i></a>
                                    <a href="<?= base_url('produk/' . $p['slug'] . '?buy=show'); ?>" class="btn btn-white text-danger border-danger mt-4 fw-bold">Beli</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->

<!-- end desktop -->
<?= $this->include('user/component/scriptAddToCart'); ?>
<?= $this->endSection(); ?>