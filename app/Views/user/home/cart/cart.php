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
                                <p class="mt-0 mb-0 fw-bold" id="textTotal">Rp. <?= number_format($total, 0, ',', '.'); ?></p>
                                <input type="hidden" name="total" id="totalField" value="<?= $total; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center row-cols-2">
                <?php foreach ($produk as $p) : ?>
                    <div class="col">
                        <div class="card my-2 border-0 shadow-sm" style="width: auto;">
                            <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
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
                                <form action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row p-3 px-4">
                <div class="col">
                    <form action="<?= base_url('checkout'); ?>" method="post" class="<?= (!$produk) ? 'd-none' : ''; ?>">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; width: 100%;"><?= lang('Text.btn_checkout') ?></button>
                    </form>
                </div>
            </div>
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
                        <div class="row">
                            <div class="col-lg-7">
                                <h4 class="mb-3 text-center"><?= lang('Text.title_cart') ?></h4>
                                <hr class="text-danger">
                                <?php foreach ($produk as $p) : ?>
                                    <div class="card border-0 shadow-sm rounded-3 mb-3">
                                        <div class="card-body">
                                            <div class="d-flex flex-row align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div>
                                                                <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" alt="Shopping item" class="img-fluid rounded-3" style="width: 100px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="ms-3">
                                                                <h4 class="product_name">
                                                                    <?= substr($p['nama'] . '(' . $p['value_item'] . ')', 0, 15); ?>
                                                                    <?= (strlen($p['nama'] . '(' . $p['value_item'] . ')') > 15) ? '...' : ''; ?>
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
                                                            <button class="btn btn-outline-danger btn-sm rounded-circle" type="button" onClick='decreaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>, <?= $p['id_produk']; ?>)'><i class="bi bi-dash"></i></button>
                                                            <input type="text" class="form-control text-small text-center bg-white border-0" disabled value="<?= $p['qty']; ?>" style="width: 55px;">
                                                            <button class="btn btn-outline-danger btn-sm rounded-circle" type="button" onClick='increaseCount(<?= $p['id_cart_produk']; ?>, event, this, <?= $p['harga_item']; ?>, <?= $p['id_produk']; ?>)'><i class="bi bi-plus"></i></button>
                                                        </div>
                                                    </div>
                                                    <form action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline mx-0 my-0" style="position: absolute; right: 0; bottom:0;">
                                                        <?= csrf_field(); ?>
                                                        <button type="submit" class="btn rounded-circle"><i class="bi bi-trash text-danger"></i></button>
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
                                    <?php foreach ($produk as $p) : ?>
                                        <div class="d-flex justify-content-between">
                                            <table class="table table-borderless text-center">
                                                <tr>
                                                    <td>
                                                        <p><?= $p['nama']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p id="textQty<?= $p['id_produk']; ?>"><?= $p['qty']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p id="textHargaItem<?= $p['id_produk']; ?>">Rp. <?= number_format($p['harga_item'], 0, ',', '.'); ?></p>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                    <?php endforeach; ?>
                                    <hr />
                                    <div class="total-amt d-flex justify-content-between fw-bold">
                                        <p><?= lang('Text.total_cart') ?></p>
                                        <p id="textTotal">Rp. <?= number_format($total, 0, ',', '.'); ?></p>
                                        <input type="hidden" name="total" id="totalField" value="<?= $total; ?>">
                                    </div>
                                    <form action="<?= base_url('checkout'); ?>" method="post" class="<?= (!$produk); ?>">
                                        <?= csrf_field(); ?>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-danger text-uppercase"><?= lang('Text.btn_checkout') ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- end Desktop -->
    <script type="text/javascript">
        function increaseCount(cp, a, b, harga, p) {
            var total_awal = parseInt($("#totalField").val(), 10);
            var input = b.previousElementSibling;
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
            var total = total_awal + harga;
            $("#totalField").val(total);
            $("#textTotal").text(formatRupiah(total));

            <?php if (!$isMobile) : ?>
                $("#textQty" + p).text(value)
                $("#textHargaItem" + p).text(formatRupiah((harga * value)))
            <?php endif ?>

            changeQty(cp, value);
        }

        function decreaseCount(cp, a, b, harga, p) {
            var total_awal = parseInt($("#totalField").val(), 10);
            var input = b.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
                var total = total_awal - harga;
                $("#totalField").val(total);
                $("#textTotal").text(formatRupiah(total));
                <?php if (!$isMobile) : ?>
                    $("#textQty" + p).text(value)
                    $("#textHargaItem" + p).text(formatRupiah((harga * value)))
                <?php endif ?>

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