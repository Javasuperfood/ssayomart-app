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
        <div class="container pt-1">
            <div class="row">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="bi bi-cash-stack fs-1 fw-bold text-success"></i>
                            </div>
                            <div class="col-9">
                                <p class="mt-0 mb-0"><?= lang('Text.total_cart') ?></p>
                                <p class="mt-0 mb-0 fw-bold" id="textTotal"></p>
                                <input type="hidden" name="total" id="totalField" value="<?= $total; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="formCheckout" action="<?= base_url('checkout-cart'); ?>" method="GET">
                <?= csrf_field(); ?>
                <div class="row text-center row-cols-2">
                    <?php foreach ($produk as $p) : ?>
                        <div class="col">
                            <div class="card my-2 border-0 shadow-sm" style="width: auto;">
                                <a href=" <?= base_url() ?>/produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                    <p class="card-title">Rp. <?= number_format($p['harga_item'], 0, ',', '.'); ?></p>
                                    <p class="card-text text-secondary"><?= substr($p['nama'] . '(' . $p['value_item'] . ')', 0, 15); ?>...</p>
                                    <div class="input-group mb-3 d-flex justify-content-center">
                                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>)'><i class="bi bi-dash"></i></button>
                                        <input type="text" class="form-control text-center bg-white border-0" disabled value="<?= $p['qty']; ?>">
                                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>)'><i class="bi bi-plus"></i></button>
                                    </div>

                                    <form id="formDelete" action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <button form="formDelete" type="submit" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></button>
                                    </form>
                                    <div class="form-check form-check-lg position-absolute top-50 end-0 translate-middle-y" style="font-size: 25px;">
                                        <input onchange="selectCheck(this)" class="form-check-input border-danger rounded-circle" type="checkbox" name="check[]" value="<?= $p['id_cart_produk']; ?>" produk="<?= $p['nama']; ?>" qty="<?= $p['qty']; ?>" harga="<?= ($p['harga_item'] * $p['qty']); ?>" id="cproduct<?= $p['id_cart_produk']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row p-3 px-4 <?= (!$produk) ? 'd-none' : ''; ?>">
                    <div class="col">
                        <button id="btnCheckout" type="submit" form="formCheckout" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; width: 100%;"><?= lang('Text.btn_checkout') ?></button>
                    </div>
                </div>
            </form>
            <div class="pb-5"></div>
        </div>
    </div>
<?php else : ?>
    <!-- End Mobile View -->

    <!-- Desktop View -->
    <div class="container h-100" style="padding-top : 120px;">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <form id="formCheckout" action="<?= base_url('checkout-cart'); ?>" method="GET">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-7">
                                    <h4 class="mb-3 text-center"><?= lang('Text.title_cart') ?></h4>
                                    <hr class="text-danger">
                                    <?php foreach ($produk as $p) : ?>
                                        <div class="card border-0 shadow-sm rounded-3 mb-3">
                                            <div class="card-body">
                                                <div class="d-flex flex-row align-items-center justify-content-between">
                                                    <div class="form-check" style="font-size: 20px;">
                                                        <input onchange="selectCheck(this)" class="form-check-input border-danger rounded-circle" type="checkbox" name="check[]" value="<?= $p['id_cart_produk']; ?>" produk="<?= $p['nama']; ?>" qty="<?= $p['qty']; ?>" harga="<?= ($p['harga_item'] * $p['qty']); ?>" id="cproduct<?= $p['id_cart_produk']; ?>">
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div>
                                                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" alt="Shopping item" class="img-fluid rounded-3" style="width: 100px;">
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="ms-3">
                                                                    <h4 class="product_name">
                                                                        <a href="<?= base_url('produk/' . $p['slug']); ?>" class="link-underline link-underline-opacity-0 link-dark">
                                                                            <?= substr($p['nama'] . '(' . $p['value_item'] . ')', 0, 15); ?>
                                                                            <?= (strlen($p['nama'] . '(' . $p['value_item'] . ')') > 15) ? '...' : ''; ?>
                                                                        </a>
                                                                    </h4>
                                                                    <p class="mb-0"><?= substr($p['deskripsi'], 0, 80); ?>...</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between" style="padding-left: 15px;">
                                                        <div class="d-flex flex-column">
                                                            <div class="text-center me-5 pb-2" style="margin-top: 10px;">
                                                                <h5 class="mb-0" style="font-size: 20px;">Rp. <?= number_format($p['harga_item'], 0, ',', '.'); ?></h5>
                                                            </div>
                                                            <div class="d-flex align-items-center me-5">
                                                                <button class="btn btn-outline-danger btn-sm rounded-circle" type="button" onClick='decreaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>)'><i class="bi bi-dash"></i></button>
                                                                <input type="text" class="form-control text-small text-center bg-white border-0" readonly value="<?= $p['qty']; ?>" style="width: 55px;">
                                                                <button class="btn btn-outline-danger btn-sm rounded-circle" type="button" onClick='increaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>)'><i class="bi bi-plus"></i></button>
                                                            </div>
                                                        </div>
                                                        <form id="formDelete" action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline mx-0 my-0" style="position: absolute; right: 0; bottom:0;">
                                                            <?= csrf_field(); ?>
                                                            <button form="formDelete" type="submit" class="btn rounded-circle"><i class="bi bi-trash text-danger"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- right side div -->
                                <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                                    <div class="right_side p-3 borde-0 shadow-sm rounded-3 bg-white">
                                        <h5 class="mb-5 text-center"><?= lang('Text.title_cart') ?></h5>
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
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->

<style>
    .form-check-input:focus {
        border-color: #ec2614;
    }

    .form-check-input:checked {
        background-color: #ec2614;
        border-color: #ec2614
    }

    .form-check-input[type=checkbox]:indeterminate {
        background-color: #ec2614;
        border-color: #ec2614;

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
    var produkSelected = {};

    $(document).ready(function() {
        // Ketika halaman dimuat, cek apakah ada input yang dicek
        checkInputs();

        // Saat ada perubahan pada input yang dicek, panggil fungsi checkInputs kembali
        $('input[name="check[]"]').change(function() {
            checkInputs();
        });
    });

    function setElemetCheck(cp, qty, harga) {
        $("#cproduct" + cp).attr('qty', qty);
        $("#cproduct" + cp).attr('harga', harga);
        totalA(produkSelected)
    }

    function increaseCount(cp, a, b, harga) {
        var total_awal = parseInt($("#totalField").val(), 10);
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        var total = total_awal + harga;

        <?php if (!$isMobile) : ?>
            $("#textQty" + cp).text(value)
            $("#textHargaItem" + cp).text(formatRupiah((harga * value)))
        <?php endif ?>
        produkSelected[cp] = (harga * value);
        setElemetCheck(cp, value, (harga * value));
        changeQty(cp, value);
    }

    function decreaseCount(cp, a, b, harga) {
        var total_awal = parseInt($("#totalField").val(), 10);
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            var total = total_awal - harga;
            <?php if (!$isMobile) : ?>
                $("#textQty" + cp).text(value)
                $("#textHargaItem" + cp).text(formatRupiah((harga * value)))
            <?php endif ?>

            produkSelected[cp] = (harga * value);
            setElemetCheck(cp, value, (harga * value));
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


    function checkInputs() {
        var checked = $('input[name="check[]"]:checked').length;
        if (checked == 0) {
            // Jika tidak ada input yang dicek, sembunyikan elemen dengan ID 'divCheckout'
            $('#btnCheckout').hide();
            $('#textTotal').hide();
        } else {
            // Jika ada input yang dicek, tampilkan elemen dengan ID 'divCheckout'
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