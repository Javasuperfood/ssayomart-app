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
                <div class="col-4">
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
            <div class="col-lg-6">
                <h2 class="text-merah"> Deskripsi </h2>
                <p class="text-potong"><?= $produk['deskripsi']; ?></p>
            </div>
        </div>
    </div>


    <!-- Deskripsi read more tampilan web  -->
    <div class="d-none d-lg-block">
        <p id="content" class="collapse col-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. In ducimus illum odio optio aliquam quos, debitis rem assumenda nisi deleniti ipsam suscipit ullam vero architecto vitae alias eaque et officiis.</p>
        <a href="#" id="read-more-btn" class="btn btn-link" style="text-decoration: none;">Read More</a>

    </div>
    <!-- Deskripsi read more tampilan web  -->




    <!-- swiper card tampilan web -->
    <div class="d-none d-lg-block">
        <div class="row mt-3">
            <h2 class="text-merah"> Product Terkait </h2>
            <div class="col">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper d-flex">
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 ">
                            <div class="card border-0 shadow-sm">
                                <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- swiper card tampilan web-->



    <!-- 6 card tampilan web -->
    <div class="d-none d-lg-block">
        <div class="row mt-3">
            <h2 class="text-merah"> Product Terbaru </h2>
            <div class="col-6 col-md-4 col-lg-2 mb-3">
                <div class="card">
                    <img src="<?= base_url(); ?>assets/img/produk/main/default.png">
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
        </div>

    </div>
    <!-- 6 card tampilan web-->






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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#read-more-btn").click(function() {
            $("#content").toggleClass("collapse");
            if ($("#content").hasClass("collapse")) {
                $("#read-more-btn").text("Read More");
            } else {
                $("#read-more-btn").text("Read Less");
            }
        });
    });
</script>
<?= $this->include('user/component/scriptAddToCart'); ?>
<?= $this->include('user/component/scriptAddToWishlist'); ?>
<?= $this->endSection(); ?>