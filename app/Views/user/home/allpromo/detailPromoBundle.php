<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container mt-4 justify-content-center">
    <div class="col text-center">
        <div class="container">
            <div class="gallery">
                <img src="<?= base_url() ?>assets/img/produk\main/default.png" class="img-fluid toss-add-to-cart" alt="#" onclick="">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-1 mt-3 rounded-top-5" style="background-color:#fff; box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;">
    <div class="col-12 mt-4 text-center">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="row-5 mt-4">
                    <div class="col-12 col-md-4 d-md-flex justify-content-md-center">
                        <div class="input-group" style="flex-wrap: nowrap;">
                            <button class="btn btn-outline-danger rounded-circle" type="button" onClick="decreaseCount(event, this)">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" id="counterProduct" class="form-control form-control-sm ms-3 text-center bg-white border-0" disabled value="1">
                            <button class="btn btn-outline-danger mr-4 rounded-circle me-1" type="button" onClick="increaseCount(event, this)">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="hidden" id="qty" name="qty" value="1">
                    <input checked class="form-check-input d-none" type="radio" value="<?= $varian[0]['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $varian[0]['id_variasi_item']; ?>">
                    <button class="btn btn-white text-danger border-danger mt-4 d-inline add-to-cart-btn position-relative" produk="<?= $promoProduk['id_produk']; ?>">
                        <i class="bi bi-cart-fill"></i>
                    </button>
                    <a id="buyButton_1" href="<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty=' . ((isset($_GET['qty'])) ? $_GET['qty'] : 1)); ?>" class="btn btn-white text-danger border-danger mt-4 fw-bold"><?= lang('Text.btn_beli') ?></a>
                </div>

                <h4 class="fw-bold mt-4"><?= $promoProduk['title']; ?></h4>
                <div class="row">
                    <hr class="w-100">
                    <div class="col">
                        <?php
                        $concatenatedNames = '';
                        $concatenatedNames .= $promoProduk['nama'];
                        foreach ($promoProduk['produk'] as $pa) {
                            $concatenatedNames .= ' + ' . $pa['nama'];
                        }
                        echo "<p class='fs-2 text-danger fw-bold'>" . $concatenatedNames . "</p>";
                        ?>
                    </div>
                    <hr class="w-100">
                    <div class="col">
                        <p class="fs-2 text-danger fw-bold">
                            Rp. <?= number_format($promoProduk['harga_item'], 0, ',', '.'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        $("#qty").val(value);
        <?php if ($varianItem == 1) : ?>
            var link = `<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty='); ?>` + value;
            $("#buyButton_1").attr("href", link);
        <?php endif ?>
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            $("#qty").val(value);
            <?php if ($varianItem == 1) : ?>
                var link = `<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty='); ?>` + value;
                $("#buyButton_1").attr("href", link);
            <?php endif ?>
        }
    }

    function alertNoStcok() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Stok tidak tersedia!'
        })
    }
</script>

<?= $this->endSection(); ?>