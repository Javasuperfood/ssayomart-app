<?php if ($produk) : ?>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </head>
    <?php if ($featuredProducts != null && !empty($featuredProducts)) : ?>
        <div class="container bg-white" id="product">
            <p class="d-block my-2 text-center fw-bold" style="font-size:medium; font-family:sans-serif;"><?= lang('Text.produk_unggulan') ?></p>
            <hr class="border-darker mt-0 mb-3">

            <div class="row row-cols-3 me-0" id="product-unggulan-container">
                <!-- Featured Products -->
                <?php foreach ($featuredProducts as $fp) : ?>
                    <div class="col-4 col-md-2 col-lg-2 mb-3 mx-0">

                        <div class="card card-produk border-0 shadow-sm text-center" style="width: 100px; height: 100%;padding: 5px;">

                            <a href="<?= base_url() ?>produk/<?= $fp['slug']; ?>" class="link-underline link-underline-opacity-0">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $fp['img']; ?>" class="card-img-top mt-1 text-center py-0 px-0 mx-0 my-0 im_produk_<?= $fp['id_produk']; ?>_" alt="..." style=" width: 100px; height: 100px; object-fit: contain; object-position: 20% 10%;">
                                </div>
                            </a>
                            <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                <div class="d-flex align-items-start justify-content-center" style=" height: 65px;">
                                    <p class=" text-secondary fw-bold " style=" font-size: 10px; margin: 0;"><?= substr($fp['nama'], 0, 30); ?></p>
                                </div>
                                <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                    <del>Rp. <?= number_format($fp['harga_min'], 0, ',', '.'); ?></del>
                                </p>

                                <h1 class="text-danger fs-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                                    <?php if ($fp['harga_min'] == $fp['harga_max']) : ?>
                                        Rp. <?= number_format($fp['harga_min'], 0, ',', '.'); ?>
                                    <?php else : ?>
                                        <?= substr('Rp. ' . number_format($fp['harga_min'], 0, ',', '.') . '-' . number_format($fp['harga_max'], 0, ',', '.'), 0, 13); ?>
                                    <?php endif ?>
                                </h1>
                                <!-- <div class="container mt-1 mb-2">
                                    <div class="row justify-items-center">
                                        <div class="col">
                                            <div class="horizontal-counter">
                                                <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="decreaseCount(this, <?= $fp['id_produk']; ?>)"><i class="bi bi-dash"></i></button>
                                                <input type="text" id="counter" class="form-control form-control-sm border-0 text-center bg-white" value="1" disabled>
                                                <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="increaseCount(this, <?= $fp['id_produk']; ?>)"><i class="bi bi-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
                                    <form action="<?= base_url('produk/' . $fp['slug']); ?>">
                                        <input type="hidden" name="add-to-cart" value="show">
                                        <input type="hidden" name="qty" id="Cqty<?= $fp['id_produk']; ?>" value="1" value="show">
                                        <button type="submit" class="btn btn-danger mx-1 mt-2 fw-bold">
                                            <i class="fas fa-shopping-cart text-white fa-sm"></i>
                                        </button>
                                    </form>
                                    <form action="<?= base_url('produk/' . $fp['slug']); ?>">
                                        <input type="hidden" name="buy" value="show">
                                        <input type="hidden" name="qty" id="Bqty<?= $fp['id_produk']; ?>" value="1" value="show">
                                        <button type="submit" class="btn btn-danger mx-1 mt-2">
                                            Buy
                                        </button>
                                        <span class="badge text-bg-success position-absolute start-0 top-0" style="font-size: 12px; padding: 2px 4px;">10%</span>
                                    </form>
                                </div> -->

                                <!-- button Animasi -->
                                <div class="button-container" id="button-container-<?= $fp['id_produk']; ?>">
                                    <div class="button" onclick="changeToCapsule(<?= $fp['id_produk']; ?>, <?= $fp['id_variasi_item']; ?>)">
                                        <i class="icon fas fa-plus d-flex justify-content-center align-items-center"></i>
                                    </div>

                                    <div class="button-capsule" style="display: none;">
                                        <i class="icon fas fa-minus" onclick="decreaseValue(<?= $fp['id_produk']; ?>, <?= $fp['id_variasi_item']; ?>)"></i>
                                        <input type="number" class="input border-0" value="1" id="counter-<?= $fp['id_produk']; ?>">
                                        <i class="icon fas fa-plus" onclick="increaseValue(<?= $fp['id_produk']; ?>, <?= $fp['id_variasi_item']; ?>)"></i>
                                    </div>
                                </div>
                                <!-- akhir button animasi -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container bg-white" id="product">
        <p class="d-block my-2 text-center fw-bold" style="font-size:medium; font-family:sans-serif;"><?= lang('Text.nama_produk') ?></p>
        <hr class="border-darker mt-0 mb-3">

        <div class="row row-cols-3 me-0" id="product-container">
            <!-- All Produk -->
            <?php foreach ($produk as $p) : ?>
                <div class="col-4 col-md-2 col-lg-2 mb-3 mx-0">
                    <div class="card card-produk border-0 shadow-sm text-center" style="width: 100px; height: 100%; padding: 5px;">
                        <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top text-center py-0 px-0 mx-0 my-0 im_produk_<?= $p['id_produk']; ?>_" alt="..." style=" width: 100px; height: 100px; object-fit: contain; object-position: 20% 10%;">
                            </div>
                        </a>
                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                            <div class="d-flex align-items-start justify-content-center" style=" height: 65px;">
                                <p class=" text-center text-secondary fw-bold " style=" font-size: 10px; margin: 0;"><?= substr($p['nama'], 0, 25); ?></p>
                            </div>
                            <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                            </p>

                            <h1 class="text-danger fs-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                                <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                    Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                <?php else : ?>
                                    <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>
                                <?php endif ?>
                            </h1>

                            <!-- button Animasi -->
                            <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                <div class="button" onclick="changeToCapsule(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)">
                                    <i class="icon fas fa-plus d-flex justify-content-center align-items-center"></i>
                                </div>

                                <div class="button-capsule" style="display: none;">
                                    <i class="icon fas fa-minus" onclick="decreaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                    <input type="number" class="input border-0" value="1" id="counter-<?= $p['id_produk']; ?>">
                                    <i class="icon fas fa-plus" onclick="increaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                </div>
                            </div>
                            <!-- akhir button animasi -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- styling button counter animasi -->
            <style>
                .button-container {
                    position: absolute;
                    top: 5px;
                    /* Jarak dari atas */
                    left: 5px;
                    /* Jarak dari kiri */
                    display: flex;
                    gap: 5px;
                    /* Jarak antar tombol */
                }

                .button {
                    width: 25px;
                    /* Ukuran tombol yang lebih kecil */
                    height: 25px;
                    /* Ukuran tombol yang lebih kecil */
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    font-weight: bold;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    outline: 1px solid #e83b2e;
                    background-color: #fff;
                }

                .button-capsule {
                    width: 60px;
                    /* Ukuran capsule yang lebih kecil */
                    height: 25px;
                    /* Ukuran capsule yang lebih kecil */
                    border-radius: 15px;
                    display: none;
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0 5px;
                    /* Padding yang lebih kecil */
                    transition: all 0.3s ease;
                    outline: 1px solid #e83b2e;
                    background-color: #fff;
                }

                .icon {
                    font-size: 12px;
                    color: #e83b2e;
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .input {
                    width: 20px;
                    /* Ukuran input yang lebih kecil */
                    height: 15px;
                    /* Ukuran input yang lebih kecil */
                    text-align: center;
                    margin: 0 3px;
                    /* Margin yang lebih kecil */
                    color: #000;
                    font-size: 8px;
                    font-weight: bold;
                    transition: all 0.3s ease;
                    border: none;
                    outline: none;
                }
            </style>
        </div>
    </div>

    <!-- Button counter lama -->
    <!-- <div class="container mt-1 mb-1">
                            <div class="row justify-items-center">
                                <div class="col">
                                    <div class="horizontal-counter">
                                        <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="decreaseCount(this, <?= $p['id_produk']; ?>)"><i class="bi bi-dash"></i></button>
                                        <input type="text" id="counter" class="form-control form-control-sm border-0 text-center bg-white" value="1" disabled>
                                        <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="increaseCount(this, <?= $p['id_produk']; ?>)"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
    <!-- akhir button counter lama -->

    <!-- <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
    <form action="<?= base_url('produk/' . $p['slug']); ?>">
        <input type="hidden" name="add-to-cart" value="show">
        <input type="hidden" name="qty" id="Cqty<?= $p['id_produk']; ?>" value="1" value="show">
        <button type="submit" class="btn btn-danger mx-1 mt-2 fw-bold">
            <i class="fas fa-shopping-cart text-white fa-sm"></i>
        </button>
    </form>
    <form action="<?= base_url('produk/' . $p['slug']); ?>">
        <input type="hidden" name="buy" value="show">
        <input type="hidden" name="qty" id="Bqty<?= $p['id_produk']; ?>" value="1" value="show">
        <button type="submit" class="btn btn-danger mx-1 mt-2">
            Buy
        </button>
        <span class="badge text-bg-success position-absolute start-0 top-0" style="font-size: 12px; padding: 2px 4px;">10%</span>
    </form>
</div> -->

    <script>
        function changeToCapsule(c, v) {
            $(`#button-container-${c} .button`).css('display', 'none');
            $(`#button-container-${c} .button-capsule`).css('display', 'flex');
            addToCartProductList(c, v, 1)
            cartItemShow('plus'); // cart script
            let im_produk = document.querySelector('.im_produk_' + c + '_');
            im_produk.classList.add('animate__animated', 'animate__tada');
            im_produk.addEventListener('animationend', () => {
                im_produk.classList.remove('animate__animated', 'animate__tada');
            });
            let cartcart = document.querySelector('.a_cart_link_0');
            cartcart.classList.add('animate__animated', 'animate__shakeY');
            cartcart.addEventListener('animationend', () => {
                cartcart.classList.remove('animate__animated', 'animate__shakeY');
            });
        }

        function decreaseValue(c, v) {
            var counter = document.querySelectorAll(`#counter-${c}`);;
            let q = 1;
            let ss = true
            counter.forEach(function(e) {
                if (parseInt(e.value) > 0) {
                    e.value = (parseInt(e.value) - 1);
                    if (parseInt(e.value) < 1) {
                        e.value = 1;
                        if (ss) {
                            ss = changeToCircle(c);
                        }
                    }
                }
            });
            if (ss) {
                addToCartProductList(c, v, q)
            }
        }

        function increaseValue(c, v) {
            var counter = document.querySelectorAll(`#counter-${c}`);
            let q = 1
            counter.forEach(function(e) {
                e.value = (parseInt(e.value) + 1);
                q = e.value;
            });
            addToCartProductList(c, v, q)
            let cartcart = document.querySelector('.a_cart_link_0');
            cartcart.classList.add('animate__animated', 'animate__shakeY');
            cartcart.addEventListener('animationend', () => {
                cartcart.classList.remove('animate__animated', 'animate__shakeY');
            });
        }

        function changeToCircle(c) {
            $(`#button-container-${c} .button`).css('display', 'flex');
            $(`#button-container-${c} .button-capsule`).css('display', 'none');
            cartDeleteProdukList(c)
        }


        function addToCartProductList(c, v, q) {
            var produk = c;
            var varian = v;
            var qty = q;
            // console.log(produk, varian, qty)
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/add-to-cart'); ?>",
                dataType: "json",
                data: {
                    id_produk: produk,
                    id_varian: varian,
                    qty: qty
                },
                success: function(response) {
                    if (response.success) {
                        // console.log(response.message)
                        return true
                    } else {
                        // console.log(response.message)
                        return false
                    }
                },
                error: function(error) {
                    console.error("Error:", error);
                    <?php if (!auth()->loggedIn()) : ?>
                        location.href = '<?= base_url(); ?>login'
                    <?php endif ?>
                    return false
                }
            });
        }

        function cartDeleteProdukList(produk) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/delete-cart-product'); ?>",
                dataType: "json",
                data: {
                    produk: produk,
                },
                success: function(response) {
                    cartItemShow('minus'); // cart script
                },
                error: function(error) {
                    console.error("Error:", error);
                    <?php if (!auth()->loggedIn()) : ?>
                        location.href = '<?= base_url(); ?>login'
                    <?php endif ?>
                }
            });
        }
    </script>
    <script type="text/javascript">
        // function increaseCount(b, id) {
        //     var input = b.previousElementSibling;
        //     console.log(input);
        //     var value = parseInt(input.value, 10);
        //     value = isNaN(value) ? 0 : value;
        //     value++;
        //     input.value = value;
        //     $('#Cqty' + id).val(value);
        //     $('#Bqty' + id).val(value);
        // }

        // function decreaseCount(b, id) {
        //     var input = b.nextElementSibling;
        //     var value = parseInt(input.value, 10);
        //     if (value > 1) {
        //         value = isNaN(value) ? 0 : value;
        //         value--;
        //         input.value = value;
        //         $('#Cqty' + id).val(value);
        //         $('#Bqty' + id).val(value);

        //     }
        // }
    </script>
<?php else : ?>
    <div class="container px-5 my-5 align-middle">
        <div class="card border-0 text-center rounded shadow-sm">
            <div class="card-body mx-3 my-3">
                <h5 class="card-title" style="font-size: 16px">Produk tidak ditemukan atau belum tersedia</h5>
                <a href="/" class="btn btn-danger border-0 rounded mt-2" style="font-size: 14px">Kembali</a>
            </div>
        </div>
    </div>
<?php endif ?>

<style>
    .border-darker {
        border-color: red;
        border-width: 2px;
        font-weight: bold;
    }

    .horizontal-counter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .horizontal-counter .btn {
        padding: 0.10rem 0.2rem;
        font-size: 10px;
    }

    .horizontal-counter input {
        font-size: 10px;
        width: 33px;
        text-align: center;
    }
</style>

<!-- <style>
    /* Media query for Samsung Galaxy Fold */
    @media (max-width: 280px) {
        .horizontal-counter .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.7rem;
        }

        .horizontal-counter input {
            width: 39px;
            text-align: center;
        }

        .custom-button .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.9rem;

        }

        img.card-img-top {
            width: 100px !important;
            height: 100px !important;
        }

        p.text-secondary {
            font-size: 9px !important;
        }

        h1.text-danger {
            font-size: 12px !important;
        }

        .border-darker {
            border-color: red;
            /* Ubah warna garis menjadi merah */
            border-width: 2px;
            /* Sesuaikan ketebalan garis sesuai kebutuhan Anda */
            font-weight: bold;
            /* Tambahkan ketebalan teks sesuai kebutuhan Anda */
        }
    }
</style> -->

<!-- samsung galaxy fold tonggle dual screen mode gak sreg hapus aja gak usah cacicu -->
<style>
    @media screen and (min-width: 400px) and (max-width: 450px) {
        .card-produk {
            width: 120px !important;
            /* Mengisi lebar parent container */
        }
    }

    @media screen and (min-width: 717px) and (max-width: 717px) {

        .col-lg-2,
        .col-md-2,
        .col-4 {
            flex: 0 0 100% !important;
            max-width: 30%;
        }

        .card-produk {
            width: 130px !important;
            /* Mengisi lebar parent container */
        }

        .horizontal-counter {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .horizontal-counter button,
        .horizontal-counter input {
            width: 40px;
            /* Adjust as needed */
            height: 20px;
            /* Adjust as needed */
            font-size: 13px;
            /* Adjust as needed */
        }

        .custom-button {
            display: flex;
            justify-content: center;
        }

        #product-container.row.row-cols-3 {
            width: 100%;
            height: auto;
            margin-left: 4.5%;

        }

        #product-unggulan-container.row.row-cols-3 {
            width: 100%;
            height: auto;
            margin-left: 4.5%;

        }
    }

    @media (max-width: 280px) {

        .col-lg-2,
        .col-md-2,
        .col-6 {
            flex: 0 0 100% !important;
            max-width: 50%;
        }

        .card-produk {
            width: 110px !important;
            /* Mengisi lebar parent container */
        }

    }
</style>
<!-- end samsung galaxy fold tonggle dual screen mode 717 -->