<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h2 class="fw-bold mb-4 text-merah"><?= lang('Text.produk_lainnya') ?></h2>
            <div class="d-flex justify-content-center align-items-center swiper mySwing">
                <div class="swiper-wrapper d-flex">
                    <?php foreach ($randomProducts as $p) : ?>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 mb-5">
                            <div class="zoom-slider card border-0 shadow-sm text-center" style="width: auto; height: 100%;">
                                <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 100px; height: 100px; object-fit: contain; object-position: 20% 10%;">
                                    </div>
                                </a>
                                <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                    <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                                        <p class=" text-secondary fw-bold " style=" font-size: 8px; margin: 0;"><?= substr($p['nama'], 0, 40); ?></p>
                                    </div>
                                    <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                        <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                    </p>

                                    <h1 class="text-danger fw-bold mt-1 pb-3" style="font-size: 10px; margin: 0;">
                                        <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                            Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                        <?php else : ?>
                                            <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                        <?php endif ?>
                                    </h1>

                                    <!-- button Animasi -->
                                    <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                        <div class="button" onclick="changeToCapsule(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)">
                                            <i class="icon bi bi-plus d-flex justify-content-center align-items-center"></i>
                                        </div>

                                        <div class="button-capsule" style="display: none;">
                                            <i class="icon bi bi-dash" onclick="decreaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                            <input type="text" class="input border-0" value="1" id="counter-<?= $p['id_produk']; ?>">
                                            <i class="icon bi bi-plus" onclick="increaseValue(<?= $p['id_produk']; ?>, <?= $p['id_variasi_item']; ?>)"></i>
                                        </div>
                                    </div>
                                    <!-- akhir button animasi -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .zoom-slider {
        transition: transform 0.3s ease-in-out;
    }

    .zoom-slider:hover {
        transform: scale(1.1);
    }
</style>
<!-- script button counter animasi -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
<!-- akhir script button counter animasi -->