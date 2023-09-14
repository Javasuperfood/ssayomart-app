<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- mobile -->
<div class="container pt-5 d-md-none">
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
                        <p class="card-title">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></p>
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
<!-- end mobile -->
<!-- desktop -->
<div class="container d-none d-md-block">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-2 mb-">
                <ol class="breadcrumb mb-0" style="font-size: 14px;">
                    <li class="breadcrumb-item">
                        <h2 class="mb-0"><i class="bi bi-bag-heart-fill" style="font-size: 30px;"></i> Wishlist</h2>
                    </li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="row mt-4 ">
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card">
                <form action="<?= base_url(); ?>wishlist/delete/<?= $p['id_wishlist_produk']; ?>" method="post" class="position-relative">
                    <?= csrf_field(); ?>
                    <button class="position-absolute top-0 end-0 pe-1 btn border-0" type="submit"><i class="bi bi-x-circle fs-3"></i></button>
                </form>
                <a href="<?= base_url('produk/' . $p['slug']); ?>">
                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                </a>
                <div class=" card-body text-center">
                    <p class="card-title">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                    <p class="card-text text-secondary"><?= $p['nama']; ?></p>
                    <input type="hidden" name="id_produk" id="id_produk" value="<?= $p['id_produk']; ?>">
                    <input type="hidden" name="harga" id="harga" value="<?= $p['harga']; ?>">
                    <input type="hidden" id="qty" name="qty" value="1">
                    <a href="<?= base_url() ?>cart" class="btn btn-danger btn-md ">
                        <i class="bi bi-cart2"></i>
                    </a>
                    <a href="#" class="btn btn-light" style="background-color: #ec2614; color:#fff;">Beli</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end desktop -->
<!-- FOOTER -->
<div class="row-fluid">
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white d-none d-lg-block" style="background-color: #ce2614; position: absolute; bottom: 0; width: 100%;">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Links -->
            <!--Grid row-->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <img src="<?= base_url() ?>assets/img/logopanjang.png" alt="Logo Ssayomart" height="80" width="250">
                    <p>
                        Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Other</h6>
                    <p>
                        <a href="<?= base_url() ?>" class="text-white link-offset-2 link-underline link-underline-opacity-0">Home</a>
                    </p>
                    <p>
                        <a href="https://download.ssayomart.com" class="text-white link-offset-2 link-underline link-underline-opacity-0">Download APK</a>
                    </p>
                    <p>
                        <a href="<?= base_url() ?>cart" class="text-white link-offset-2 link-underline link-underline-opacity-0">Cart</a>
                    </p>
                    <p>
                        <a href="<?= base_url() ?>wishlist" class="text-white link-offset-2 link-underline link-underline-opacity-0">Wishlist</a>
                    </p>
                    <p>
                        <a href="<?= base_url() ?>kupon" class="text-white link-offset-2 link-underline link-underline-opacity-0">Kupon Promosi</a>
                    </p>
                </div>
                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Setting</h6>
                    <p>
                        <a href="<?= base_url() ?>" class="text-white link-offset-2 link-underline link-underline-opacity-0">Setting Akun</a>
                    </p>
                    <p>
                        <a href="<?= base_url() ?>setting/alamat-list" class="text-white link-offset-2 link-underline link-underline-opacity-0">Alamat Tersimpan</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>
                    <!-- Facebook -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#" role="button"><i class="bi bi-facebook"></i></a>
                    <!-- Twitter -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#" role="button"><i class="bi bi-twitter"></i></a>
                    <!-- Google -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #000000" href="#" role="button"><i class="bi bi-tiktok"></i></a>
                    <!-- Instagram -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#" role="button"><i class="bi bi-instagram"></i></a>
                    <!-- Github -->
                    <a class="btn btn-primary btn-floating m-1" style="background-color:  #008000" href="#" role="button"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            <!--Grid row-->

            <!-- Section: Links -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            Copyright © 2023 Java Super Food • SsayoMart Supermarket • All Rights Reserved
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</div>


<?= $this->include('user/component/scriptAddToCart'); ?>
<?= $this->endSection(); ?>