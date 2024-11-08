<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand fixed-bottom shadow-sm navbar-bottom rounded-top-4" style="height: 70px; background-color:#fff; box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;">
                <div class="container justify-content-between">
                    <?php if ($varianItem > 1) : ?>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">

                            <button class="btn btn-danger rounded-4 me-2" style="height: 50px;" data-bs-toggle="modal" data-bs-target="#modalVarianBuy"><?= lang('Text.btn_beli') ?></button>

                            <a href="#">
                                <button type="button" class="text-white btn input-group-text border-0 rounded-circle bg-danger shadow-sm" style="width: 45px; height: 45px;" data-bs-toggle="modal" data-bs-target="#modalVarian">
                                    <i class="bi bi-bag" style="font-size: 18px;"></i>
                                </button>
                            </a>

                        </div>
                    <?php elseif ($varianItem == 1) : ?>
                        <?php if ($useStock) : ?>
                            <button type="button" class="btn btn-secondary text-white p-2 mx-auto" disabled>Stok Tidak Tersedia</button>
                        <?php else : ?>
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <input type="hidden" id="qty" name="qty" value="1">
                                <input checked class="form-check-input d-none" type="radio" value="<?= $varian[0]['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $varian[0]['id_variasi_item']; ?>">
                                <!-- <a id="buyButton_1" href="<?= base_url('checkout2?slug=' . $produk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty=' . ((isset($_GET['qty'])) ? $_GET['qty'] : 1)); ?>" class="btn btn-white text-danger border-danger fw-bold" style="width: 150px;"><?= lang('Text.btn_beli') ?></a> -->
                                <!-- <button class="ms-2 btn btn-white text-danger border-danger d-inline add-to-cart-btn position-relative" produk="<?= $produk['id_produk']; ?>">
                                    <i class="bi bi-cart-fill"></i>
                                </button> -->

                                <button
                                    class="ms-2 btn btn-white text-danger border-danger d-inline add-to-cart-btn"
                                    produk="<?= $produk['id_produk']; ?>"
                                    id="cart-btn-<?= $produk['id_produk']; ?>">
                                    <i class="bi bi-cart-fill"></i> Add to Cart
                                </button>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const cartButton = document.querySelector('.add-to-cart-btn');
                                        const productId = cartButton.getAttribute('produk');
                                        const storageKey = `added-to-cart-${productId}`;

                                        // Check if the product is already in the cart (from localStorage)
                                        if (localStorage.getItem(storageKey) === 'true') {
                                            updateButtonState(cartButton, true);
                                        }

                                        // Handle button click to add/remove from cart
                                        cartButton.addEventListener('click', function() {
                                            const isAdded = localStorage.getItem(storageKey) === 'true';

                                            if (isAdded) {
                                                // Remove from cart
                                                localStorage.removeItem(storageKey);
                                                updateButtonState(cartButton, false);
                                            } else {
                                                // Add to cart
                                                localStorage.setItem(storageKey, 'true');
                                                updateButtonState(cartButton, true);
                                            }
                                        });

                                        // Function to update button state
                                        function updateButtonState(button, added) {
                                            if (added) {
                                                button.classList.remove('text-danger', 'border-danger');
                                                button.classList.add('text-success', 'border-success');
                                                button.innerHTML = '<i class="bi bi-cart-check-fill"></i> Added';
                                                button.disabled = true; // Disable the button
                                            } else {
                                                button.classList.remove('text-success', 'border-success');
                                                button.classList.add('text-danger', 'border-danger');
                                                button.innerHTML = '<i class="bi bi-cart-fill"></i> Add to Cart';
                                                button.disabled = false; // Enable the button
                                            }
                                        }
                                    });
                                </script>

                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <?php if (!$useStock) : ?>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div class="input-group">
                                <button class="btn btn-outline-danger rounded-circle" type="button" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;" onClick='decreaseCount(event, this)'>
                                    <i class="bi bi-dash" style="font-size: 1rem;"></i>
                                </button>
                                <input type="number" id="counterProduct" class="form-control text-center bg-white border-0" disabled value="1" style="width: 50px;">
                                <button class="btn btn-outline-danger rounded-circle" type="button" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;" onClick='increaseCount(event, this)'>
                                    <i class="bi bi-plus" style="font-size: 1rem;"></i>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>


<?php else : ?>

    <div id="desktopContent">
        <div class="footer-search" id="navbarBottom" style="position: relative; bottom: 0; width: 100%;">
            <?= $this->include('user/home/component/navbarBottom') ?>
        </div>
    </div>
<?php endif; ?>

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

<style>
    @media screen and (max-width: 280px) {
        #buyButton_1 {
            width: 94px !important;
        }


        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 83%;
        }

    }

    /* @media screen and (max-width: 375px) {
        #buyButton_1 {
            width: 94px !important;
        }


        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 103%;
        }

    } */
</style>