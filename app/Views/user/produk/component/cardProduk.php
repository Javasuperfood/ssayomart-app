<?php if ($produk) : ?>
    <div class="container bg-white" id="product">
        <!-- <div class="card border-0 text-center font-family-poppins" style="color: #9c2525; background-color: #facaaf;">
            <div class="card-danger">
                <span class="card-title fw-bold fs-2"><?= lang('Text.nama_produk') ?></h2>
            </div>
        </div> -->

        <div class="row" id="product-container" style="margin-bottom: 55px;">
            <!-- All Produk -->
            <?php foreach ($produk as $p) : ?>
                <div class="col-4 col-md-4 col-lg-2  mb-3 mx-0">
                    <div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%;">
                        <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 120px; height: 120px; object-fit: contain;">
                            </div>
                        </a>
                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                            <div class="d-flex align-items-start justify-content-center" style="height: 80px;">
                                <p class=" text-secondary fw-bold " style=" font-size: 12px; margin: 0;"><?= substr($p['nama'], 0, 50); ?></p>
                            </div>
                            <!-- <p class="text-secondary" style="font-size: 10px; margin: 0;">
                                <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                            </p> -->

                            <h1 class="text-danger fs-bold mt-1 mb-3 fw-bold" style="font-size: 14px; margin: 0;">
                                <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                    Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                <?php else : ?>
                                    <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>
                                <?php endif ?>
                            </h1>
                            <!-- button Animasi -->
                            <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                <div class="button" onclick="changeToCapsule(<?= $p['id_produk']; ?>">
                                    <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                                </div>

                                <div class="button-capsule" style="display: none;">
                                    <i class="icon bi bi-dash" onclick="decreaseValue(<?= $p['id_produk']; ?>"></i>
                                    <input type="number" class="input border-0" value="1" id="counter-<?= $p['id_produk']; ?>">
                                    <i class="icon bi bi-plus" onclick="increaseValue(<?= $p['id_produk']; ?>"></i>
                                </div>
                            </div>
                            <!-- akhir button animasi -->
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
                <h5 class="card-title" style="font-size: 16px">Produk tidak ditemukan atau belum tersedia</h5>
                <a href="/" class="btn btn-danger border-0 rounded mt-2" style="font-size: 14px">Kembali</a>
            </div>
        </div>
    </div>
<?php endif ?>

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

    /* Media query for Samsung Galaxy Fold */
    @media (max-width: 280px) {
        .horizontal-counter .btn {
            padding: 0.15rem 0.3rem;

        }

        .horizontal-counter input {
            width: 30px;
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
    }
</style>