<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- ITEM WISHLIST -->
<div class="container pt-1">
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
                <div class="card my-2 border-0 shadow" style="width: auto;">
                    <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <p class="card-title">Rp. <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                        <p class="card-text text-secondary"><?= $p['nama']; ?></p>
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                            <input type="text" class="form-control text-center bg-white border-0" disabled value="<?= $p['qty']; ?>">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                        </div>
                        <form action="<?= base_url(); ?>cart/delete/<?= $p['id_cart_produk']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></button>
                        </form>
                        <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
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

    <!-- END OF WISHLIST -->
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