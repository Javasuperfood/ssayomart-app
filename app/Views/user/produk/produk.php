<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- View Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
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
                            <p class="text-secondary fs-4">
                                <?php if ($produk['harga_min'] == $produk['harga_max']) : ?>
                                    Rp. <?= number_format($produk['harga_min'], 0, ',', '.'); ?>
                                <?php else : ?>
                                    <?= substr('Rp. ' . number_format($produk['harga_min'], 0, ',', '.') . '-' . number_format($produk['harga_max'], 0, ',', '.'), 0, 15); ?>...
                                <?php endif ?>
                            </p>
                        </div>
                        <div class="col text-end">
                            <a role="button" type="submit" class="add-to-wishlist-btn fw-bold link-underline link-underline-opacity-0 link-dark" produk="<?= $produk['id_produk']; ?>" harga="<?= $produk['harga']; ?>">
                                <i class="bi bi-heart-fill text-danger">
                                    <span class="text-secondary">Add to Wishlist</span>
                                </i>
                            </a>
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
                    <div class="text-center">
                        <button class="btn btn-white text-danger border-danger mt-4 d-inline" data-bs-toggle="modal" data-bs-target="#modalVarian"><i class=" bi bi-cart-fill"></i></button>
                        <button type="submit" class="btn btn-white text-danger border-danger mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalVarianBuy">Beli Sekarang</button>
                    </div>
                </div>
                <div class="row mt-4 mb-5">
                    <div class="col-lg-6">
                        <h2 class="text-merah"> Deskripsi </h2>
                        <p class="text-potong"><?= $produk['deskripsi']; ?></p>
                        <!-- <button class="btn btn-danger mb-5" onclick="myFunction()" id="myBtn">Read more</button> -->
                    </div>
                </div>
            </div>
            <div class=" row pt-5">
                <div class="col"></div>
            </div>

            <!-- Modal Varian Buy -->
            <div class="modal fade" id="modalVarianBuy" tabindex="-1" aria-labelledby="modalVarianBuyLabel" aria-hidden="true">
                <div class="modal-dialog" style="top: calc(100% - 300px);">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalVarianBuyLabel">Beli Langsung</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('buy/' . $produk['slug']); ?>" method="get" class="d-inline">
                            <div class="modal-body">
                                <div class="row row-cols-3">
                                    <?php foreach ($varian as $key => $v) : ?>
                                        <div class="col" key="<?= $key; ?>">
                                            <div class="card border-0 shadow" onclick="selectVarian(<?= $v['id_variasi_item']; ?>)">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $v['value_item']; ?></h5>
                                                    <p class="text-secondary fs-6"><?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
                                                    <div class="form-check">
                                                        <input <?= $key === 0 ? 'checked' : '' ?> class="form-check-input" type="radio" value="<?= $v['id_variasi_item']; ?>" name="varian" id="radioVarianBuy<?= $v['id_variasi_item']; ?>">
                                                        <label class="form-check-label" for="radioVarianBuy<?= $v['id_variasi_item']; ?>">
                                                            Pilih
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="qty" name="qty" value="1">
                                <button type="submit" class="btn btn-danger mt-4">Beli Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Varian Cart Mobile  -->
            <div class="modal fade" id="modalVarian" tabindex="-1" aria-labelledby="modalVarianLabel" aria-hidden="true">
                <div class="modal-dialog" style="top: calc(100% - 300px);">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalVarianLabel">Varian Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cols-3">
                                <?php foreach ($varian as $key => $v) : ?>
                                    <div class="col" key="<?= $key; ?>">
                                        <div class="card border-0 shadow" onclick="selectVarian(<?= $v['id_variasi_item']; ?>)">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $v['value_item']; ?></h5>
                                                <p class="text-secondary fs-6"><?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
                                                <div class="form-check">
                                                    <input <?= $key === 0 ? 'checked' : '' ?> class="form-check-input" type="radio" value="<?= $v['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $v['id_variasi_item']; ?>">
                                                    <label class="form-check-label" for="radioVarian<?= $v['id_variasi_item']; ?>">
                                                        Pilih
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger add-to-cart-btn" produk="<?= $produk['id_produk']; ?>">Tambah Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- Akhir view mobile -->

    <!-- View Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container d-none d-md-block">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $produk['img']; ?>" class="img-fluid" alt="<?= $produk['nama']; ?>">
                </div>
                <div class="col-md-6">
                    <p class="fw-bold fs-3"><?= $produk['nama']; ?></p>
                    <div class="row">
                        <div class="col">
                            <p class="text-secondary fs-4">
                                <?php if ($produk['harga_min'] == $produk['harga_max']) : ?>
                                    Rp. <?= number_format($produk['harga_min'], 0, ',', '.'); ?>
                                <?php else : ?>
                                    <?= 'Rp. ' . number_format($produk['harga_min'], 0, ',', '.') . '-' . number_format($produk['harga_max'], 0, ',', '.'); ?>
                                <?php endif ?>
                            </p>
                        </div>
                        <div class="text mt-2">
                            <a role="button" type="submit" class="add-to-wishlist-btn fw-bold link-underline link-underline-opacity-0 link-dark" produk="<?= $produk['id_produk']; ?>" harga="<?= $produk['harga']; ?>">
                                <i class="bi bi-heart-fill text-danger">
                                    <span class="text-secondary">Add to Wishlist</span>
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="row-5 mt-4">
                        <div class="col-4">
                            <div class="input-group">
                                <button class="btn btn-outline-danger rounded-circle" type="button" onClick="decreaseCount(event, this)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" class="form-control text-center bg-white border-0" disabled value="1">
                                <button class="btn btn-outline-danger mr-4 rounded-circle" type="button" onClick="increaseCount(event, this)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-white text-danger border-danger mt-4 d-inline" data-bs-toggle="modal" data-bs-target="#modalVarian"><i class=" bi bi-cart-fill"></i></button>
                        <button type="submit" class="btn btn-white text-danger border-danger mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalVarianBuy">Beli Sekarang</button>
                    </div>
                    <div class="row my-4">
                        <div class="col-lg-6">
                            <h4 class="text-merah"> Deskripsi </h4>
                            <p class="text-potong"><?= $produk['deskripsi']; ?></p>
                            <!-- <button class="btn btn-danger mb-5" onclick="myFunction()" id="myBtn">Read more</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-none d-lg-block">
                <div class="d-none d-lg-block">
                    <div class="row mt-3">
                        <div class="col">
                            <h2 class="mb-4">Produk Lainnya</h2>
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper d-flex">
                                    <?php foreach ($randomProducts as $p) : ?>
                                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                                            <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                                                <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3" alt="...">
                                                </a>
                                                <div class="fs-3 mt-3" style="padding: 0 10px 0 10px;">
                                                    <h1 class="text-secondary" style="font-size: 15px;">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></h1>
                                                    <p class=" text-secondary" style="font-size: 14px;"><?= substr($p['nama'], 0, 15); ?>...</p>

                                                    <div class="container pt-3">
                                                        <div class="row justify-items-center">
                                                            <div class="col">
                                                                <div class="horizontal-counter">
                                                                    <button class="btn btn-sm btn-outline-danger" type="button" onclick="decreaseCount()"><i class="bi bi-dash"></i></button>
                                                                    <input type="text" id="counter" class="form-control form-control-sm border-0" value="0" readonly>
                                                                    <button class="btn btn-sm btn-outline-danger" type="button" onclick="increaseCount()"><i class="bi bi-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="text-center custom-button " style="display: flex; justify-content: center;">
                                                        <a href="<?= base_url('produk/' . $p['slug']); ?>?add-to-cart=show" class="btn btn-danger mt-4">
                                                            <i class="bi bi-cart-check"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger   mx-1 mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalVarianBuy">
                                                            Beli
                                                        </button>
                                                    </p>







                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <input type="hidden" id="qty" name="qty" value="1">
                                    <?= $this->include('user/component/scriptAddToCart'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col"></div>
        </div>

        <!-- Modal Varian cart desktop  -->
        <div class="modal fade" id="modalVarian" tabindex="-1" aria-labelledby="modalVarianLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalVarianLabel">Varian Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-cols-3">
                            <?php foreach ($varian as $key => $v) : ?>
                                <div class="col" key="<?= $key; ?>">
                                    <div class="card border-0 shadow" onclick="selectVarian(<?= $v['id_variasi_item']; ?>)">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $v['value_item']; ?></h5>
                                            <p class="text-secondary fs-6"><?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
                                            <div class="form-check">
                                                <input <?= $key === 0 ? 'checked' : '' ?> class="form-check-input" type="radio" value="<?= $v['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $v['id_variasi_item']; ?>">
                                                <label class="form-check-label" for="radioVarian<?= $v['id_variasi_item']; ?>">
                                                    Pilih
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger add-to-cart-btn" produk="<?= $produk['id_produk']; ?>">Tambah Keranjang</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal varian buy desktop  -->
        <div class="modal fade" id="modalVarianBuy" tabindex="-1" aria-labelledby="modalVarianBuyLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalVarianBuyLabel">Beli Langsung</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('buy/' . $produk['slug']); ?>" method="get" class="d-inline">
                        <div class="modal-body">
                            <div class="row row-cols-3">
                                <?php foreach ($varian as $key => $v) : ?>
                                    <div class="col" key="<?= $key; ?>">
                                        <div class="card border-0 shadow" onclick="selectVarian(<?= $v['id_variasi_item']; ?>)">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $v['value_item']; ?></h5>
                                                <p class="text-secondary fs-6"><?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
                                                <div class="form-check">
                                                    <input <?= $key === 0 ? 'checked' : '' ?> class="form-check-input" type="radio" value="<?= $v['id_variasi_item']; ?>" name="varian" id="radioVarianBuy<?= $v['id_variasi_item']; ?>">
                                                    <label class="form-check-label" for="radioVarianBuy<?= $v['id_variasi_item']; ?>">
                                                        Pilih
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="qty" name="qty" value="1">
                            <button type="submit" class="btn btn-danger mt-4">Beli Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- end Desktop -->

    <!-- akhir view desktop -->

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
    <!-- <script>
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }
</script> -->

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
    </style>

    <?= $this->include('user/component/scriptAddToCart'); ?>
    <?= $this->include('user/component/scriptAddToWishlist'); ?>
    <?= $this->include('user/home/component/navbarBottom') ?>
    <?= $this->endSection(); ?>