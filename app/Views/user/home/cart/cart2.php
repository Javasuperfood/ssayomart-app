<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>


<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Mobile View -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card border border-success p-2 border-opacity-10 py-2">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <i class="bi bi-cash-stack fs-1 fw-bold text-success"></i>
                                </div>
                                <div class="col-9 totalbarang d-flex justify-content-start align-items-center">
                                    <p class="mt-0 mb-0"><?= lang('Text.total_cart') ?></p>
                                    <p class="mt-0 mb-0 fw-bold mx-2" id="textTotal"></p>
                                    <input type="hidden" name="total" id="totalField" value="<?= $total; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-12 d-flex gap-2">
                        <?php if ($produk) : ?>
                            <button id="selectAll" class="btn btn-outline-danger btn-sm btn-icon">
                                <i class="bi bi-check-circle"></i> Select
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteProducts()"><i class="bi bi-trash"></i> <?= lang('Text.btn_hapus') ?></button>
                        <?php endif; ?>
                    </div>
                </div>


                <?php if ($produk == null) : ?>
                    <div class="row text-center d-flex align-items-center" style="height:65vh">
                        <div class="col">
                            <p class="fs-5 my-3"><?= lang('Text.notif_cart') ?></p>
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="assets/img/cart2/cart-2.png" class="img-fluid" style="width:230px ;" alt="...">
                            </div>
                            <div class="mx-auto text-center">
                                <a href="<?= base_url() ?>" class="btn btn-outline-danger"><?= lang('Text.btn_belanja') ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form id="formCheckout" action="<?= base_url('checkout2'); ?>" method="GET">
                    <!-- Tambahan input untuk menyimpan nilai check[] -->
                    <?php foreach ($produk as $p) : ?>
                        <input type="hidden" name="check[]" value="<?= $p['id_cart_produk']; ?>">
                    <?php endforeach; ?>
                    <div class="row row-cols-2 py-3">
                        <?php foreach ($produk as $p) : ?>
                            <div class="col-12 mb-3">
                                <div class="coupon bg-white rounded d-flex justify-content-between border border-success p-2 border-opacity-10 shadow-sm">
                                    <div class="kiri p-1">
                                        <?php if ($p['required_quantity']) : ?>
                                            <div class="form-check form-check-sm position-relative" style="z-index:999;left:10;">
                                                <input <?= ($p['stok'] > 0 && $p['is_active'] == 1) ? '' : 'disabled'; ?> onchange="selectCheck(this)" class="form-check-input border-danger rounded-circle " type="checkbox" name="check[]" value="<?= $p['id_cart_produk']; ?>" produk="<?= $p['nama']; ?>" required_quantity="<?= $p['required_quantity']; ?>" qty="<?= $p['qty']; ?>" harga="<?= ($p['harga_item'] * $p['required_quantity']) * $p['qty']; ?>" id="cproduct<?= $p['id_cart_produk']; ?>">
                                            </div>
                                        <?php else : ?>
                                            <div class="form-check form-check-sm position-relative" style="z-index:999;left:10;">
                                                <input <?= ($p['stok'] > 0 && $p['is_active'] == 1) ? '' : 'disabled'; ?> onchange="selectCheck(this)" class="form-check-input border-danger rounded-circle " type="checkbox" name="check[]" value="<?= $p['id_cart_produk']; ?>" produk="<?= $p['nama']; ?>" qty="<?= $p['qty']; ?>" harga="<?= ($p['harga_item'] * $p['qty']); ?>" id="cproduct<?= $p['id_cart_produk']; ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="icon-container position-absolute" style=" margin-top:-25px;">
                                            <?php if ($p['required_quantity']) : ?>
                                                <a href="<?= base_url() ?>detail-promo-bundle/<?= $p['id']; ?>" class="link-underline link-underline-opacity-0 position-relative ">
                                                    <img src="<?= base_url() ?>assets/img/promo/bundle/<?= $p['promo_img']; ?>" class="p-1 img-small gambar-kecil" alt="Product" style=" width: 65px; height: 65px; object-fit: contain;">
                                                </a>
                                            <?php else : ?>
                                                <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0 position-relative ">
                                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="p-1 img-small gambar-kecil" alt="Product" style=" width: 65px; height: 65px; object-fit: contain;">
                                                    <?php if (!$p['stok'] > 0 && $p['is_active'] == 1) : ?>
                                                        <div class="sold-out-overlay item-item d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle" style="width:40px; height:40px; border-radius:50%;">
                                                            <span class="sold-out-text "><?= lang('Text.stock_kosong') ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="tengah py-2 ">
                                        <!-- Fungsi Multi Language -->
                                        <!-- <p class="fw-bold card-text text-secondary float-start nama-pesanan" style="font-size: 12px; margin: 0;"><?= substr($p[$kolomNama] . '(' . $p['value_item'] . ')', 0, 30); ?></p> -->
                                        <?php if ($p['required_quantity']) : ?>
                                            <p class="text-secondary text-pixel mb-2" style="font-size: 12px; margin: 0;"><?= substr($p['title'] . '(' . $p['value_item'] . ')', 0, 30); ?></p>
                                        <?php else : ?>
                                            <p class="text-secondary text-pixel mb-2" style="font-size: 12px; margin: 0;"><?= substr($p['nama'] . '(' . $p['value_item'] . ')', 0, 30); ?></p>
                                        <?php endif; ?>
                                        <div class="input-group grup-masukan button-group" style="margin-top:5px; right: 45%;">
                                            <button class="btn-sm btn btn-outline-danger btn-dash rounded-circle" style="width: 20px; height:22px;" type="button" onClick='decreaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>, <?= isset($p['required_quantity']) ? $p['required_quantity'] : 'null'; ?>)'><i class="bi bi-dash"></i></button>
                                            <input type="text" class="form-control form-masuk form-control-sm text-center bg-white border-0" disabled value="<?= $p['qty']; ?>" style="font-size: 12px; width: 10px; padding: 0;">
                                            <button class="btn-sm btn btn-outline-danger btn-plus rounded-circle" style="width: 20px; height:22px;" type="button" onClick='increaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>, <?= isset($p['required_quantity']) ? $p['required_quantity'] : 'null'; ?>)'><i class="bi bi-plus"></i></button>
                                        </div>
                                        <button form="formdelete<?= $p['id_cart_produk']; ?>" type="submit" class="end-0 border-0 btn btn-sm button-sampah position-absolute mx-2"><i class="bi bi-trash text-danger"></i></button>
                                    </div>
                                    <div class="kanan">
                                        <div class="my-3">
                                            <?php if ($p['required_quantity']) : ?>
                                                <p class="fw-bold text-danger mt-3 p-2" style="font-size: 13px; margin: 0;">Rp.<?= number_format($p['harga_item'] * $p['required_quantity'], 0, ',', '.'); ?></p>
                                            <?php else : ?>
                                                <p class="fw-bold text-danger mt-3 p-2" style="font-size: 13px; margin: 0;">Rp.<?= number_format($p['harga_item'], 0, ',', '.'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
                <div style="background-color: #ffff; z-index:100" class="fixed-bottom mb-5 row p-3 px-4 <?= (!$produk) ? 'd-none' : ''; ?>">
                    <div class="col d-flex justify-content-center">
                        <button id="btnCheckout" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; width: 60%; font-size: 13px"><?= lang('Text.btn_checkout') ?></button>
                    </div>
                </div>

                <?php foreach ($produk as $p) : ?>
                    <form id="formdelete<?= $p['id_cart_produk']; ?>" action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                    </form>
                <?php endforeach; ?>
                <div class="pb-5"></div>
            </div>
        </div>

        <!-- button scroll up -->
        <button class="btn btn-danger button-atas" id="buttonAtas" title="Scroll to top"><i class="bi bi-chevron-up d-flex justify-content-center align-items-center fs-6"></i></button>
        <script>
            var buttonAtas = document.getElementById("buttonAtas");
            window.addEventListener("scroll", function() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    buttonAtas.style.display = "block";
                } else {
                    buttonAtas.style.display = "none";
                }
            });
            buttonAtas.addEventListener("click", function() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            });
        </script>
        <!-- end button scroll -->

    <?php else : ?>
        <!-- End Mobile View -->

        <!-- Desktop View -->
        <div class="container h-100" style="padding-top : 175px;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <form id="formCheckout" action="<?= base_url('checkout-cart'); ?>" method="GET">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <h3 class="fw-bold mb-3 text-center"><i class="fs-1 bi bi-bag-heart text-danger"></i> <?= lang('Text.title_cart') ?></h3>
                                        <hr class="mb-3 border-danger" style="border-width: 3px;">
                                        <?php foreach ($produk as $p) : ?>
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                                        <div class="form-check" style="font-size: 20px; margin: 0;">
                                                            <input <?= ($p['stok'] > 0 && $p['is_active'] == 1) ? '' : 'disabled'; ?> onchange="selectCheck(this)" class="ceklis-tombol form-check-input button-klik border-danger rounded-circle" type="checkbox" name="check[]" value="<?= $p['id_cart_produk']; ?>" produk="<?= $p['nama']; ?>" qty="<?= $p['qty']; ?>" harga="<?= ($p['harga_item'] * $p['qty']); ?>" id="cproduct<?= $p['id_cart_produk']; ?>">
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <div>
                                                                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" alt="Shopping item" class="img-fluid rounded-3" style="width: 100px;">
                                                                        <?php if (!$p['stok'] > 0 && $p['is_active'] == 1) : ?>
                                                                            <div class="sold-out-overlay item-kosong d-flex justify-content-center align-items-center">
                                                                                <span class="sold-out-text">Kosong</span>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="ms-3">
                                                                        <h4 class=" product_name">
                                                                            <a href="<?= base_url('produk/' . $p['slug']); ?>" class="link-underline link-underline-opacity-0 link-dark" style="font-size: 18px;">
                                                                                <?= substr($p['nama'] . '(' . $p['value_item'] . ')', 0, 40); ?>
                                                                                <?= (strlen($p['nama'] . '(' . $p['value_item'] . ')') > 40) ? '' : ''; ?>
                                                                            </a>
                                                                        </h4>
                                                                        <p class="mb-0 text-secondary" style="font-size: 12px;"><?= substr($p['deskripsi'], 0, 100); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between" style="padding-left: 15px;">
                                                            <div class="d-flex flex-column">
                                                                <div class="pb-1" style="margin-top: 10px;">
                                                                    <h5 class="mx-4 mb-4" style="font-size: 14px; ">Rp. <?= number_format($p['harga_item'], 0, ',', '.'); ?></h5>
                                                                </div>
                                                                <div class="d-flex align-items-center me-5">
                                                                    <button class="btn btn-outline-danger btn-sm rounded-circle" type="button" onClick='decreaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>)'><i class="bi bi-dash"></i></button>
                                                                    <input type="text" class="form-control text-small text-center bg-white border-0" readonly value="<?= $p['qty']; ?>" style="width: 55px;">
                                                                    <button class="btn btn-outline-danger btn-sm rounded-circle" type="button" onClick='increaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>)'><i class="bi bi-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <?= csrf_field(); ?>
                                                            <button form="formdelete<?= $p['id_cart_produk']; ?>" type="submit" class="btn-lg btn tombol-hapus__dekstop rounded-circle float-start" style="margin-top: 55px;"><i class="bi bi-trash text-danger"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- right side div -->
                                    <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                                        <div class="right-side p-3 border-0 shadow-sm rounded-3 bg-white">
                                            <h5 class="fw-bold mb-5 text-center"><?= lang('Text.title_cart') ?></h5>

                                            <div class="d-flex justify-content-between">
                                                <table class="table table-borderless" id="tablePoint">
                                                    <!-- Table content here -->
                                                </table>
                                            </div>

                                            <hr />

                                            <div class="total-amt d-flex justify-content-between fw-bold me-2">
                                                <p><?= lang('Text.total_cart') ?></p>
                                                <p id="textTotal">Rp. 0</p>
                                            </div>

                                            <div class="d-flex justify-content-center <?= (!$produk) ? 'd-none' : ''; ?>">
                                                <button id="btnCheckout" class="btn btn-danger text-uppercase" type="submit" form="formCheckout"><?= lang('Text.btn_checkout') ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                                    <div class="right_side p-3 borde-0 shadow-sm rounded-3 bg-white">
                                        <h5 class="fw-bold mb-5 text-center"><?= lang('Text.title_cart') ?></h5>
                                        <div class="d-flex justify-content-between">
                                            <table class="table table-borderless text-center" id="tablePoint">
                                            </table>
                                        </div>
                                        <hr />
                                        <div class="total-amt d-flex justify-content-between fw-bold">
                                            <p><?= lang('Text.total_cart') ?></p>
                                            <p id="textTotal">Rp. 0</p>
                                        </div>
                                        <div class="d-flex justify-content-center <?= (!$produk) ? 'd-none' : ''; ?>">
                                            <button id="btnCheckout" class="btn btn-danger text-uppercase" type="submit" form="formCheckout"><?= lang('Text.btn_checkout') ?></button>
                                        </div>
                                    </div>
                                </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($produk as $p) : ?>
            <form id="formdelete<?= $p['id_cart_produk']; ?>" action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                <?= csrf_field(); ?>
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- end Desktop -->

    <script type="text/javascript">
        var produkSelected = {};

        $(document).ready(function() {
            checkInputs();
            $('input[name="check[]"]').change(function() {
                checkInputs();
            });

            $('#selectAll').click(function() {
                if ($(this).text().trim() === 'Select') {
                    $('input[name="check[]"]').each(function() {
                        if (!$(this).is(':disabled')) {
                            $(this).prop('checked', true);
                            $(this).trigger('change');
                        }
                    });
                    $(this).text('Cancel Select');
                } else {
                    $('input[name="check[]"]').prop('checked', false);
                    produkSelected = {};
                    totalA(produkSelected);
                    checkInputs();
                    $(this).text('Select');
                }
            });
        });

        // Generate URL for checkout
        $(document).ready(function() {
            $('#btnCheckout').click(function() {
                var selectedProducts = $('input[type="checkbox"]:checked');
                var checkoutUrl = '<?= base_url('checkout2?cart=true'); ?>';
                selectedProducts.each(function() {
                    checkoutUrl += '&check%5B%5D=' + encodeURIComponent($(this).val());
                });
                window.location.href = checkoutUrl;
            });
        });

        function setElemetCheck(cp, qty, harga) {
            var inputCheck = $("#cproduct" + cp);
            inputCheck.attr('qty', qty);
            inputCheck.attr('harga', harga);
            if (inputCheck.is(':checked')) {
                produkSelected[cp] = harga;
                totalA(produkSelected)
            }
        }

        function increaseCount(cp, a, b, harga, requiredQuantity) {
            var total_awal = parseInt($("#totalField").val(), 10);
            var input = b.previousElementSibling;
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
            var total = total_awal + (requiredQuantity !== null ? harga * requiredQuantity : harga);

            <?php if (!$isMobile) : ?>
                $("#textQty" + cp).text(value)
                $("#textHargaItem" + cp).text(formatRupiah(requiredQuantity !== null ? harga * requiredQuantity * value : harga * value));
            <?php endif; ?>

            setElemetCheck(cp, value, (requiredQuantity !== null ? harga * requiredQuantity * value : harga * value));
            changeQty(cp, value);
        }

        function decreaseCount(cp, a, b, harga, requiredQuantity) {
            var total_awal = parseInt($("#totalField").val(), 10);
            var input = b.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
                var total = total_awal - (requiredQuantity !== null ? harga * requiredQuantity : harga);
                <?php if (!$isMobile) : ?>
                    $("#textQty" + cp).text(value)
                    $("#textHargaItem" + cp).text(formatRupiah(requiredQuantity !== null ? harga * requiredQuantity * value : harga * value));
                <?php endif ?>

                setElemetCheck(cp, value, (requiredQuantity !== null ? harga * requiredQuantity * value : harga * value));
                changeQty(cp, value);
            }
        }

        function formatRupiah(angka) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            return formatter.format(angka);
        }

        function selectCheck(checkbox) {
            var produk = checkbox.getAttribute('produk');
            var qty = checkbox.getAttribute('qty');
            var required_quantity = checkbox.getAttribute('required_quantity');
            var harga = parseFloat(checkbox.getAttribute('harga'));
            if (checkbox.checked) {
                produkSelected[checkbox.value] = harga;
                $("#tablePoint").append(`
    <tr id="tr${checkbox.value}">
        <td>
            <p>${produk}</p>
        </td>
        <td>
            <p id="textQty${checkbox.value}">${qty}</p>
        </td>
        <td>
            <p id="textHargaItem${checkbox.value}">${formatRupiah(harga)}</p>
        </td>
    </tr>
    `)
            } else {
                $("#tr" + checkbox.value).remove();
                delete produkSelected[checkbox.value];
            }
            totalA(produkSelected);
        }

        function totalA(selectedProducts) {
            var total = 0;
            for (var productValue in selectedProducts) {
                total += selectedProducts[productValue];
            }
            $("#textTotal").text(formatRupiah(total));
        }

        function deleteProducts() {
            var selectedProducts = $('input[name="check[]"]:checked');
            var deletedProductIds = [];

            if (selectedProducts.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    showConfirmButton: false,
                    timer: 1500,
                    text: 'Produk harus dipilih terlebih dahulu.',
                })
                return;
            }

            selectedProducts.each(function() {
                var productId = $(this).val();
                // console.log("Deleted product ID:", productId);
                deletedProductIds.push(productId);
                $("#tr" + productId).remove();
                delete produkSelected[productId];
            });

            $.ajax({
                type: 'POST',
                url: '<?= base_url('api/delete-cart-products'); ?>',
                data: {
                    produk: deletedProductIds
                },
                success: function(response) {
                    if (response.success) {
                        selectedProducts.closest('.row-cols-2').remove();
                        totalA(produkSelected);
                    } else {
                        console.error("Error deleting product:", response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting product:", error);
                }
            });
        }

        function checkInputs() {
            var checked = $('input[name="check[]"]:checked').length;
            if (checked == 0) {
                $('#btnCheckout').hide();
                $('#textTotal').hide();
            } else {
                $('#btnCheckout').show();
                $('#textTotal').show();
            }
        }

        function changeQty(id, qty) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/change-cart-qty'); ?>",
                dataType: "json",
                data: {
                    idCartProduk: id,
                    qty: qty
                },
                success: function(response) {
                    if (response.success) {
                        // console.log(response.message)
                    } else {
                        // console.log(response.message)
                    }
                },
                error: function(error) {
                    // console.error("Error:", error);
                    <?php if (!auth()->loggedIn()) : ?>
                        location.href = '<?= base_url(); ?>login'
                    <?php endif ?>
                }
            });
        }
    </script>

    <?= $this->endSection(); ?>