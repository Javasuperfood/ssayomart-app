<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<!-- ITEM WISHLIST -->
<div class="container pt-1  d-md-none">
    <div class="row text-center">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table>
                            <tr>
                                <td rowspan="2"><i class="bi bi-cash-stack fs-4 fw-bold text-success"></i></td>
                                <td>
                                    <span class="text-secondary ps-2">Total Belanja</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold ps-2">Rp. <?= number_format($total, 0, ',', '.'); ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center row-cols-2">
        <?php foreach ($produk as $p) : ?>
            <div class="col">
                <div class="card my-2 border-0 shadow-sm" style="width: auto;">
                    <a href="<?= base_url('produk/' . $p['slug']) ?>" class="link-underline link-underline-opacity-0">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-title">Rp. <?= number_format($p['harga_item'], 0, ',', '.'); ?></p>
                        <p class="card-text text-secondary"><?= $p['nama']; ?>(<?= $p['value_item']; ?>)</p>
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                            <input type="text" class="form-control text-center bg-white border-0" disabled value="<?= $p['qty']; ?>">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
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
                <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; width: 100%;">Checkout</button>
            </form>
        </div>
    </div>
    <div class="pb-5"></div>
</div>
<!-- END OF WISHLIST -->

<!-- Desktop -->
<div class="container-fluid mb-5 d-none d-md-block">
    <div class="row">
        <div class="col-md-10 col-11 mx-auto">
            <div class="row mt-5 gx-3">
                <!-- left side div -->
                <div class="col-md-12 col-lg-8 col-11 mx-auto main_cart mb-lg-0 mb-5">
                    <?php foreach ($produk as $p) : ?>
                        <div class="card border-0 shadow-sm bg-white p-5 mb-5">
                            <div class="row">
                                <!-- cart images div -->
                                <div class="col-md-5 col-11 mx-auto d-flex justify-content-center align-items-center product_img rounded-circle" style="background-color: #fff7c4;">
                                    <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                                </div>
                                <!-- cart product details -->
                                <div class="col-md-7 col-11 mx-auto px-4 mt-2">
                                    <div class="row">
                                        <!-- product name  -->
                                        <div class="col-8 card-title">
                                            <h4 class="mb-4 product_name"><?= substr($p['nama'], 0, 40); ?> ...</h4>
                                            <p class="mb-2"><?= substr($p['deskripsi'], 0, 80); ?>...</p>
                                        </div>
                                        <!-- quantity inc dec -->
                                        <div class="col-4">
                                            <div class="input-group mb-3 d-flex justify-content-center">
                                                <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                                                <input type="text" class="form-control text-center bg-white border-0" disabled value="<?= $p['qty']; ?>">
                                                <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- //remover move and price -->
                                    <div class="row">
                                        <div class="col-8 d-flex justify-content-between">
                                            <div class="col-8 d-flex justify-content-end">
                                                <h5>Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <div class="d-flex position-absolute bottom-0 end-0 py-4 px-4">
                                            <button type=" submit" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- right side div -->
                <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                    <div class="right_side p-3 shadow-sm bg-white">
                        <h4 class="mb-5">Total Pembayaran Produk</h4>
                        <?php foreach ($produk as $p) : ?>
                            <div class="d-flex justify-content-between">
                                <p><?= $p['nama']; ?></p>
                                <p>Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></span></p>
                            </div>
                        <?php endforeach; ?>
                        <hr />
                        <div class="total-amt d-flex justify-content-between font-weight-bold">
                            <p>Total Harga</p>
                            <p>Rp. <?= number_format($total, 0, ',', '.'); ?></span></p>
                        </div>
                        <form action="<?= base_url('checkout'); ?>" method="post" class="<?= (!$produk); ?>">
                            <?= csrf_field(); ?>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-danger text-uppercase">Checkout</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->
<script type="text/javascript">
    function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
        }
    }
</script>

<?= $this->endSection(); ?>