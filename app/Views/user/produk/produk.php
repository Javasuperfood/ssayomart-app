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

            <div class="col-md-6">
                <div class="zoom-image">
                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $produk['img']; ?>" class="img-fluid" alt="<?= $produk['nama']; ?>">
                </div>
            </div>
            <!-- View Mobile -->
            <div class="col-md-6 mt-4">
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

                </div>
                <div class="container pt-3">
                    <div class="row px-5">
                        <div class="col px-3">
                            <div class="input-group mb-3 d-flex justify-content-center">
                                <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                                <input type="number" id="counterProduct" class="form-control text-center bg-white border-0" disabled value="1">
                                <button class=" btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <?php if ($varianItem > 1) : ?>
                        <button class="btn btn-white text-danger border-danger mt-4 d-inline" data-bs-toggle="modal" data-bs-target="#modalVarian"><i class="bi bi-cart-fill"></i></button>

                        <button class="btn btn-white text-danger border-danger mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalVarianBuy">Beli Sekarang</button>
                    <?php elseif ($varianItem == 1) : ?>
                        <input type="hidden" id="qty" name="qty" value="1">
                        <input checked class="form-check-input d-none" type="radio" value="<?= $varian[0]['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $varian[0]['id_variasi_item']; ?>">
                        <button class="btn btn-white text-danger border-danger mt-4 d-inline add-to-cart-btn" produk="<?= $produk['id_produk']; ?>"><i class="bi bi-cart-fill"></i></button>

                        <a id="buyButton_1" href="<?= base_url('buy/' . $produk['slug'] . '?varian=' . $varian[0]['id_variasi_item'] . '&qty=1'); ?>" class="btn btn-white text-danger border-danger mt-4 fw-bold">Beli Sekarang</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-lg-6">
                    <h2 class="text-merah"> Deskripsi </h2>
                    <p class="text-potong"><?= $produk['deskripsi']; ?></p>
                    <!-- <button class="btn btn-danger mb-5" onclick="myFunction()" id="myBtn">Read more</button> -->
                </div>

                <div class="badge-container d-flex">
                    <span class="badge text-bg-danger rounded-5">Kategori</span>
                    <span class="badge text-bg-danger mx-2 rounded-5">Sub Kategori</span>
                    <span class="badge text-bg-danger rounded-5">Varian</span>
                </div>
            </div>

            <?= $this->include('user/produk/component/randomProduk'); ?>

            <?php if ($varianItem > 1) : ?>
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
            <?php endif ?>
        </div>
    </div>
<?php else : ?>
    <!-- Akhir view mobile -->

    <!-- View Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container d-none d-md-block">
            <div class="row">
                <div class="col-md-6">
                    <div class="zoom-image">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $produk['img']; ?>" class="img-fluid" alt="<?= $produk['nama']; ?>">
                    </div>
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
                        <!-- <div class="text mt-2">
                            <a role="button" type="submit" class="add-to-wishlist-btn fw-bold link-underline link-underline-opacity-0 link-dark" produk="<?= $produk['id_produk']; ?>">
                                <i class="bi bi-heart-fill text-danger">
                                    <span class="text-secondary">Add to Wishlist</span>
                                </i>
                            </a>
                        </div> -->
                    </div>
                    <div class="row-5 mt-4">
                        <div class="col-4">
                            <div class="input-group">
                                <button class="btn btn-outline-danger rounded-circle" type="button" onClick="decreaseCount(event, this)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" id="counterProduct" class="form-control text-center bg-white border-0" disabled value="1">
                                <button class="btn btn-outline-danger mr-4 rounded-circle" type="button" onClick="increaseCount(event, this)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php if ($varianItem > 1) : ?>
                            <button class="btn btn-white text-danger border-danger mt-4 d-inline" data-bs-toggle="modal" data-bs-target="#modalVarian"><i class=" bi bi-cart-fill"></i></button>
                            <button type="submit" class="btn btn-white text-danger border-danger mt-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalVarianBuy">Beli Sekarang</button>
                        <?php elseif ($varianItem == 1) : ?>
                            <input type="hidden" id="qty" name="qty" value="1">
                            <input checked class="form-check-input d-none" type="radio" value="<?= $varian[0]['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $varian[0]['id_variasi_item']; ?>">
                            <button class="btn btn-white text-danger border-danger mt-4 d-inline add-to-cart-btn" produk="<?= $produk['id_produk']; ?>"><i class=" bi bi-cart-fill"></i></button>
                            <a id="buyButton_1" href="<?= base_url('buy/' . $produk['slug'] . '?varian=' . $varian[0]['id_variasi_item'] . '&qty=1'); ?>" class="btn btn-white text-danger border-danger mt-4 fw-bold">Beli Sekarang</a>
                        <?php endif ?>
                    </div>
                    <div class="row my-4">
                        <div class="col-lg-6">
                            <h4 class="text-merah"> Deskripsi </h4>
                            <p class="text-potong"><?= $produk['deskripsi']; ?></p>
                            <!-- <button class="btn btn-danger mb-5" onclick="myFunction()" id="myBtn">Read more</button> -->
                        </div>

                        <div class="badge-container d-flex ">
                            <span class="badge text-bg-danger rounded-5">Kategori</span>
                            <span class="badge text-bg-danger mx-2 rounded-5">Sub Kategori</span>
                            <span class="badge text-bg-danger rounded-5">Varian</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-none d-lg-block">
                <?= $this->include('user/produk/component/randomProduk'); ?>
            </div>
        </div>
    </div>

    <?php if ($varianItem > 1) : ?>
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
    <?php endif ?>
<?php endif; ?>
<!-- end Desktop -->

<!-- akhir view desktop -->

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

    /* Efek zoom saat dihover */
    .zoom-image {
        overflow: hidden;
        position: relative;
    }

    .zoom-image img {
        transition: transform 0.3s;
        border-radius: 25px;
    }

    .zoom-image:hover img {
        transform: scale(1.1);
        /* Anda dapat menyesuaikan faktor scaling sesuai kebutuhan Anda */
    }

    /* Media query for Samsung Galaxy Fold */
    @media (max-width: 280px) {
        .horizontal-counter.btn {
            padding: 0.25rem 0.5rem;
            font-size: 12px;
            margin: 0 5px;
        }

        .horizontal-counter input {
            width: 40px;
            text-align: center;
        }

        .custom-button .btn {
            padding: 0.25rem 0.5rem;
            font-size: 12px;
        }

        .input-group .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.9rem;
        }

        .input-group .btn {
            width: 30px;
            /* Lebar tombol */
            height: 30px;
            /* Tinggi tombol */
            padding: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1rem;
            /* Sesuaikan ukuran ikon jika diperlukan */
            border: 1px solid #ce2614;
            /* Tambahkan garis pemisah antara tombol */
            background-color: #fff;
            /* Warna latar belakang tombol */

        }

        /* Style untuk input number */
        .input-group input {

            width: 50px;
            text-align: center;
            display: flex;
            border: 1px solid #ce2614;
            /* Tambahkan garis pemisah untuk input number */
            height: 30px;
            padding: 0;
            font-size: 1.2rem;
            /* Sesuaikan ukuran teks jika diperlukan */
        }
    }
</style>

<script type="text/javascript">
    function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        $("#qty").val(value);
        <?php if ($varianItem == 1) : ?>
            var link = `<?= base_url('buy/' . $produk['slug'] . '?varian=' . $varian[0]['id_variasi_item'] . '&qty='); ?>` + value;
            $("#buyButton_1").attr("href", link);
        <?php endif ?>
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            $("#qty").val(value);
            <?php if ($varianItem == 1) : ?>
                var link = `<?= base_url('buy/' . $produk['slug'] . '?varian=' . $varian[0]['id_variasi_item'] . '&qty='); ?>` + value;
                $("#buyButton_1").attr("href", link);
            <?php endif ?>
        }
    }
</script>

<?= $this->include('user/component/scriptAddToCart'); ?>
<?= $this->include('user/component/scriptAddToWishlist'); ?>

<?= $this->endSection(); ?>