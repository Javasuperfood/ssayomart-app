<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url() ?>assets/img/produk/main/<?= $produk['img']; ?>" class="img-fluid" alt="<?= $produk['nama']; ?>">
        </div>
        <!-- View Mobile -->
        <div class="col-md-6 mt-4 d-md-none">
            <h2><?= $produk['nama']; ?></h2>
            <div class="row">
                <div class="col">
                    <h1>Rp. <?= number_format($produk['harga'], 2, ',', '.'); ?></h1>
                </div>
                <div class="col text-end">
                    <a role="button" type="submit" class="add-to-wishlist-btn fw-bold link-underline link-underline-opacity-0 link-dark" produk="<?= $produk['id_produk']; ?>" harga="<?= $produk['harga']; ?>><i class=" fa-regular fa-heart"></i> Add to Wishlist</a>
                </div>
            </div>
            <div class="container pt-3">
                <div class="row px-5">
                    <div class="col px-5">
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                            <input type="number" class="form-control text-center bg-white border-0" disabled value="1">
                            <button class=" btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center">
                <input type="hidden" id="qty" name="qty" value="1">
                <button class="btn btn-white text-danger border-danger mt-4 add-to-cart-btn" produk="<?= $produk['id_produk']; ?>" harga="<?= $produk['harga']; ?>"><i class=" bi bi-basket2"></i></button>
                <a href="<?= base_url() ?>checkout" class="btn btn-white text-danger border-danger mt-4 ">Beli Sekarang</a>
            </div>
        </div>
        <!-- Akhir view mobile -->
        <!-- View Desktop -->
        <div class="col-md-6 mt-4 d-none d-md-block">
            <h2><?= $produk['nama']; ?></h2>
            <div class="row">
                <div class="col">
                    <h1>Rp. <?= number_format($produk['harga'], 2, ',', '.'); ?></h1>
                </div>
                <div class="text mt-2">
                    <a role="button" type="submit" class="add-to-wishlist-btn fw-bold link-underline link-underline-opacity-0 link-dark" produk="<?= $produk['id_produk']; ?>" harga="<?= $produk['harga']; ?>">
                        <i class="bi bi-heart"></i> Add to Wishlist
                    </a>
                </div>
            </div>

            <div class="row-5 mt-4">
                <div class="col-6">
                    <div class="input-group">
                        <button class="btn btn-outline-danger" type="button" onClick="decreaseCount(event, this)">
                            <i class="bi bi-dash"></i>
                        </button>
                        <input type="number" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger mr-4" type="button" onClick="increaseCount(event, this)">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <br>
            <div class="text">
                <input type="hidden" id="qty" name="qty" value="1">
                <button class="btn btn-white text-danger border-danger mt-4 add-to-cart-btn" produk="<?= $produk['id_produk']; ?>" harga="<?= $produk['harga']; ?>"><i class=" bi bi-basket2"></i></button>
                <a href="<?= base_url() ?>checkout" class="btn btn-white text-danger border-danger mt-4 ">Beli Sekarang</a>
            </div>
        </div>
        <!-- akhir view desktop -->
        <div class="row mt-4">
            <div class="col">
                <h2> Deskripsi</h2>
                <p class="text-potong"><?= $produk['deskripsi']; ?></p>
            </div>
        </div>
    </div>
    <!-- swipper card tampilan web -->
    <div class="container d-none d-lg-block">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-4">Produk Unggul</h2>
                <div class="swiper-container mySweety">
                    <div class="swiper-wrapper d-flex">
                        <!-- Card 1 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card">
                                <img src="img/p5.png" class="card-img-top img-fluid" alt="product">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h4>Rp. 25.000</h4>
                                    </div>
                                    <p>Jahe Bubuk</p>
                                    <p class="text-center">
                                        <a href="#" class="btn btn-danger "> <i class="bi bi-basket"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Lanjutkan dengan card-card lainnya sesuai kebutuhan -->
                    </div>

                    <!-- Tombol Navigasi -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- swipper card  tampilan web-->
</div>



<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

<script type="text/javascript">
    function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        document.getElementById('qty').value = value;
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            document.getElementById('qty').value = value;

        }
    }
</script>
<?= $this->include('user/component/scriptAddToCart'); ?>
<?= $this->include('user/component/scriptAddToWishlist'); ?>
<?= $this->endSection(); ?>