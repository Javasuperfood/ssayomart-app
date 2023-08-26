<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- ITEM WISHLIST -->
<div class="container pt-1">
    <div class="row text-center">
        <div class="card shadow border-0">
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
                                    <span class="fw-bold ps-2">Rp. 1.000.000</span>
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

    <div class="row text-center">
        <div class="col-6">
            <div class="card my-2 border-0 shadow" style="width: auto;">
                <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                    <img src="<?= base_url() ?>assets/img/produk/p7.png" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-title">Rp. 25.000</p>
                    <p class="card-text text-secondary">Norigo Rasa Keju</p>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                    <a href="#" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></a>
                    <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card my-2 border-0 shadow" style="width: auto;">
                <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                    <img src="<?= base_url() ?>assets/img/produk/p7.png" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-title">Rp. 25.000</p>
                    <p class="card-text text-secondary">Norigo Rasa Keju</p>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                    <a href="#" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></a>
                    <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-6">
            <div class="card my-2 border-0 shadow" style="width: auto;">
                <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                    <img src="<?= base_url() ?>assets/img/produk/p7.png" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-title">Rp. 25.000</p>
                    <p class="card-text text-secondary">Norigo Rasa Keju</p>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                    <a href="#" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></a>
                    <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card my-2 border-0 shadow" style="width: auto;">
                <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                    <img src="<?= base_url() ?>assets/img/produk/p7.png" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-title">Rp. 25.000</p>
                    <p class="card-text text-secondary">Norigo Rasa Keju</p>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                    <a href="#" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></a>
                    <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-6">
            <div class="card my-2 border-0 shadow" style="width: auto;">
                <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                    <img src="<?= base_url() ?>assets/img/produk/p7.png" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-title">Rp. 25.000</p>
                    <p class="card-text text-secondary">Norigo Rasa Keju</p>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                    <a href="#" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></a>
                    <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card my-2 border-0 shadow style=" width: auto;">
                <a href="<?= base_url() ?>/produk/single" class="link-underline link-underline-opacity-0">
                    <img src="<?= base_url() ?>assets/img/produk/p7.png" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-title">Rp. 25.000</p>
                    <p class="card-text text-secondary">Norigo Rasa Keju</p>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="text" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                    <a href="#" class="btn" style="background-color: #ec2614; color: #fff;"><i class="bi bi-trash"></i></a>
                    <a href="#" class="btn" style="background-color: #fbdb14;">Beli</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3 px-4">
        <a href="<?= base_url() ?>checkout" type="button" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Checkout</a>
    </div>
    <div class="pb-5"></div>
</div>
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