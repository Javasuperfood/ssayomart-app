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
<div class="container overflow-hidden p-1 mt-3 rounded-top-5" style="background-color:#fff; box-shadow: 0px -1px 3px rgba(143, 140, 140, 0.2) !important;">
    <div class="row mt-4 text-center">
        <div class="col-12 justify-content-center">
            <div class=" text-center">
                <!-- <div class=" mt-4">
                    
                        <div class="input-group d-flex justify-content-center gap-2">
                            <button class="btn btn-outline-danger py-2 px-2 rounded-circle" type="button" onClick="decreaseCount(event, this)">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" id="counterProduct" class="w-25  text-center bg-white border-0" disabled value="1">
                            <button class="btn btn-outline-danger py-2 px-2 rounded-circle" type="button" onClick="increaseCount(event, this)">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div> 
                </div> -->
                
                <h4 class="fw-bold mt-4"><?= $promoProduk['title']; ?></h4>
                 <p class="fs-2 text-danger fw-bold">
                            Rp. <?= number_format($promoProduk['harga_item'], 0, ',', '.'); ?>
                        </p>
                <div class="mb-3">
                    <input type="hidden" id="qty" name="qty" value="1">
                    <input checked class="form-check-input d-none" type="radio" value="<?= $varian[0]['id_variasi_item']; ?>" name="varian" id="radioVarian<?= $varian[0]['id_variasi_item']; ?>">
                    <button class="btn btn-white text-danger border-danger  d-inline add-to-cart-btn position-relative" produk="<?= $promoProduk['id_produk']; ?>">
                        <i class="bi bi-cart-fill"></i>
                    </button>
                    <a id="buyButton_1" href="<?= base_url('checkout2?slug=' . $promoProduk['slug'] . '&varian=' . $varian[0]['id_variasi_item'] . '&qty=' . ((isset($_GET['qty'])) ? $_GET['qty'] : 1)); ?>" class="btn btn-white text-danger border-danger fw-bold"><?= lang('Text.btn_beli') ?></a>
                </div>

                <div class="row">
                    <div class="col-12 p-4">
                        <h3 class="text-start fw-bold" style="color:#81271f;">Produk Bundle:</h3>
                        <?php
                        $concatenatedNames = '';
                        $concatenatedNames .= $promoProduk['nama'];
                        foreach ($promoProduk['produk'] as $pa) {
                            $concatenatedNames .= ' + ' . $pa['nama'];
                        }
                        echo "<p class='text-start text-dark'>" . $concatenatedNames . "</p>";
                        ?>
                         <h3 class="text-start fw-bold" style="color:#81271f;">Description:</h3>
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