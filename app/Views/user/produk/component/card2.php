<?php if ($produk) : ?>

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </head>
    <?php if (isset($featuredProducts)) : ?>
        <?php if ($featuredProducts != null && !empty($featuredProducts)) : ?>
            <div class="container bg-white" id="product">
                <p class="d-block my-2 text-center fw-bold rounded-top-2 p-1" style="color:#7e0204; background-color: #facaaf; font-size:medium; font-family:sans-serif;"><?= lang('Text.produk_unggulan') ?></p>
                <hr class="border-darker mt-0 mb-3" style="border-color: #e36120;border-width:3px;">
                <div class="row row-cols-3" id="product-unggulan-container">

                    <!-- Featured Products -->
                    <?php foreach ($featuredProducts as $fp) : ?>
                        <div class="col-4 col-md-2 col-lg-2 mb-3 susunan-card">
                            <div class="">
                                <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%;padding: 5px;">
                                    <a href="<?= base_url() ?>produk/<?= $fp['slug']; ?>" class="link-underline link-underline-opacity-0">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="<?= base_url() ?>assets/img/produk/main/<?= $fp['img']; ?>" class="card-img-top mt-1 text-center py-0 px-0 mx-0 my-0 im_produk_<?= $fp['id_produk']; ?>_" alt="..." style=" width: 100px; height: 100px; object-fit: contain;">
                                        </div>
                                    </a>
                                    <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                        <div class="d-flex align-items-start panjang-card justify-content-center" style=" height: 85px;">
                                            <p class=" text-secondary  fw-bold " style=" font-size: 9px; margin: 0;"><?= substr($fp['nama'], 0, 80); ?></p>
                                        </div>
                                        <!-- <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                            <del>Rp. <?= number_format($fp['harga_min'], 0, ',', '.'); ?></del>
                                        </p> -->

                                        <h1 class="text-danger fs-bold mt-1 mb-1 fw-bold" style="font-size: 10px; margin: 0;">
                                            <?php if ($fp['harga_min'] == $fp['harga_max']) : ?>
                                                Rp. <?= number_format($fp['harga_min'], 0, ',', '.'); ?>
                                            <?php else : ?>
                                                <?= substr('Rp. ' . number_format($fp['harga_min'], 0, ',', '.') . '-' . number_format($fp['harga_max'], 0, ',', '.'), 0, 13); ?>
                                            <?php endif ?>
                                        </h1>

                                        <!-- button Animasi -->
                                        <div class="button-container" id="button-container-<?= $fp['id_produk']; ?>">
                                            <div class="button" onclick="changeToCapsule(<?= $fp['id_produk']; ?>, <?= $fp['id_variasi_item']; ?>)">
                                                <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                                            </div>

                                            <div class="button-capsule" style="display: none;">
                                                <i class="icon bi bi-dash" onclick="decreaseValue(<?= $fp['id_produk']; ?>, <?= $fp['id_variasi_item']; ?>)"></i>
                                                <input type="number" class="input border-0" value="1" id="counter-<?= $fp['id_produk']; ?>">
                                                <i class="icon bi bi-plus" onclick="increaseValue(<?= $fp['id_produk']; ?>, <?= $fp['id_variasi_item']; ?>)"></i>
                                            </div>
                                        </div>
                                        <!-- akhir button animasi -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        <?php endif; ?>
    <?php endif ?>

    <div class="container bg-white" id="product">
        <?php
        // Cek apakah variabel global IS_HOMEPAGE telah didefinisikan
        if (!defined('IS_HOMEPAGE') || !IS_HOMEPAGE) {
            // Kodingan di card2.php hanya akan dijalankan jika bukan homepage
        ?>
            <p class="d-block my-2 text-center fw-bold rounded-top-2 p-1" style="color:#7e0204; background-color: #facaaf; font-size: medium; font-family: sans-serif;"><?= lang('Text.nama_produk') ?></p>
            <hr class="border-darker mt-0 mb-3" style="border-color: #e36120;border-width:3px;">
        <?php
        }
        ?>
        <div class="row row-cols-3" id="product-container">

            <!-- All Produk -->
            <?php foreach ($produk as $p) : ?>
                <div class="col-4 col-md-2 col-lg-2 mb-3 susunan-card">
                    <div class="">
                        <div class="card card-produk border-0 shadow-sm text-center" style="width: 105px; height: 100%; padding: 5px;">
                            <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top text-center py-0 px-0 mx-0 my-0 im_produk_<?= $p['id_produk']; ?>_" alt="..." style=" width: 100px; height: 100px; object-fit: contain;">
                                </div>
                            </a>
                            <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                <div class="d-flex align-items-start panjang-card justify-content-center" style=" height: 85px;">
                                    <p class=" text-center text-secondary fw-bold  " style=" font-size: 9px; margin: 0;"><?= substr($p['nama'], 0, 80); ?></p>
                                </div>
                                <!-- <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                    <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                </p> -->

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
                                        <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                                    </div>

                                    <div class="button-capsule" style="display: none;">
                                        <i class="icon bi bi-dash" onclick="decreaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                        <input type="number" class="input border-0" value="1" id="counter-<?= $p['id_produk']; ?>">
                                        <i class="icon bi bi-plus" onclick="increaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                    </div>
                                </div>
                                <!-- akhir button animasi -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script>
        function changeToCapsule(c, v) {
            $(`#button-container-${c} .button`).css('display', 'none');
            $(`#button-container-${c} .button-capsule`).css('display', 'flex');
            addToCartProductList(c, v, 1)
            cartItemShow('plus'); // cart script
            let im_produk = document.querySelectorAll('.im_produk_' + c + '_');
            im_produk.forEach(function(e) {
                e.classList.add('animate__animated', 'animate__tada');
                e.addEventListener('animationend', () => {
                    e.classList.remove('animate__animated', 'animate__tada');
                });
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

<?php else : ?>
    <div class="container px-5 my-5 align-middle">
        <div class="card border-0 text-center rounded shadow-sm">
            <div class="card-body mx-3 my-3">
                <h5 class="fw-bold card-title" style="font-size: 16px">Produk tidak ditemukan atau belum tersedia</h5>
                <a href="/" class="btn btn-danger border-0 rounded mt-2" style="font-size: 14px">Kembali</a>
            </div>
        </div>
    </div>
<?php endif ?>

<style>
    /* animasi zoom card  */
    .card-produk {
        transition: transform 0.3s ease-in-out;
    }

    .card-produk:hover {
        transform: scale(1.1);
    }

    /* end animasi zoom card  */

    /* styling button counter animasi */
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
        font-size: 14px;
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

    /* iphone 14 promax */
    @media screen and (min-width: 400px) and (max-width: 450px) {
        .card-produk {
            width: 120px !important;
            /* Mengisi lebar parent container */
        }
    }

    /* samsung galfold dual mode screen 717 */
    @media screen and (min-width: 717px) and (max-width: 717px) {

        .susunan-card {
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


    }

    /* samsung galfold dual mode screen 512 */
    @media screen and (min-width: 512px) and (max-width: 512px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 30%;
            margin-left: 5%;
            margin-right: -6%;
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

    }

    /* samsung galfold dual mode screen 280 dan SE 320 */
    @media (max-width: 280px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 50%;
        }

        .card-produk {
            width: 110px !important;
            /* Mengisi lebar parent container */
        }

    }

    @media (min-width: 360px) and (max-width: 360px) {

        .card-produk {
            width: 100px !important;
            /* Mengisi lebar parent container */
        }

        .panjang-card {
            height: 75px !important;
        }

    }

    @media (min-width: 320px) and (max-width: 320px) {

        .susunan-card {
            flex: 0 0 100% !important;
            max-width: 50%;
        }

        .card-produk {
            width: 130px !important;
            /* Mengisi lebar parent container */
        }

    }

    /* ipad pro width (1024px) */
    @media (min-width: 1024px) and (max-width: 1024px) {

        .susunan-card {
            flex: 0 0 !important;
            max-width: 100%;
        }

        .card-produk {
            width: 145px !important;
            /* Mengisi lebar parent container */
        }

    }

    /* ipad pro width (1024px) */
    /* ipad pro width (1024px) */
    @media (min-width: 540px) and (max-width: 540px) {

        .susunan-card {
            flex: 0 0 !important;
            max-width: 100%;
        }

        .card-produk {
            width: 145px !important;
            /* Mengisi lebar parent container */
        }

    }

    /* microsoft surface duo lebar screen 1114px */
    @media (min-width: 1114px) and (max-width: 1114px) {

        .susunan-card {
            flex: 0 0 !important;
            max-width: 100%;
        }

        .card-produk {
            width: 145px !important;
            /* Mengisi lebar parent container */
        }

    }

    /* microsoft surface duo lebar screen 720px */
    @media (min-width: 720px) and (max-width: 720px) {

        .susunan-card {
            flex: 0 0 !important;
            max-width: 100%;
        }

        .card-produk {
            width: 145px !important;
            /* Mengisi lebar parent container */
        }

    }
</style>