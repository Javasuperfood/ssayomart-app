<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container mt-4 justify-content-center">
    <div class="col text-center">
        <div class="container">
            <div class="gallery">
                <img src="<?= base_url() ?>assets/img/promo/bundle/<?= $promoProduk['img']; ?>" class="img-fluid" alt="Promotion Image">
            </div>
        </div>
    </div>
</div>
<div class="container overflow-hidden p-1 mt-3 rounded-top-5" style="background-color:#fff; box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;">
    <div class="row mt-4 text-center">
        <div class="col-12 justify-content-center">
            <div class=" text-center">
                <div class="row">
                    <div class="col-6">
                        <h4 class="fw-bold mt-4" style="color:#81271f;"><?= $promoProduk['title']; ?></h4>
                        <p class="fs-4 text-dark fw-bold">
                            Rp. <?= number_format($promoProduk['harga_item'], 0, ',', '.'); ?>
                        </p>
                    </div>
                    <div class="col-6 mt-5">
                        <a id="buyButton_1" href="<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty=' . ((isset($_GET['qty'])) ? $_GET['qty'] : 1)); ?>" class="btn btn-lg btn-outline-danger fw-bold"><?= lang('Text.btn_beli') ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-4">
                        <h3 class="text-start fw-bold" style="color:#81271f;">Produk Bundle</h3>
                        <?php
                        $concatenatedNames = '';
                        $concatenatedNames .= $promoProduk['nama'];
                        foreach ($promoProduk['produk'] as $pa) {
                            $concatenatedNames .= ' + ' . $pa['nama'];
                        }
                        echo "<p class='text-start text-dark'>" . $concatenatedNames . "</p>";
                        ?>
                        <h3 class="text-start fw-bold" style="color:#81271f;">Deskripsi Promo</h3>
                        <span>
                            <?= $promoProduk['deskripsi']; ?>
                        </span>
                    </div>

                    <div class="col">

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
            var link =
                `<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty='); ?>` +
                value;
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
                var link =
                    `<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty='); ?>` +
                    value;
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