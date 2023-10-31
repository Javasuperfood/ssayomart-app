<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h2 class="mb-4 text-merah"><?= lang('Text.produk_lainnya') ?></h2>
            <div class="d-flex justify-content-center align-items-center swiper mySwing">
                <div class="swiper-wrapper d-flex mb-3">
                    <?php foreach ($randomProducts as $p) : ?>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1">
                            <div class="card border-0 shadow-sm" style="width: auto; height: 100%;">
                                <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 200px; height: 200px;">
                                    </div>
                                </a>
                                <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                    <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                                        <p class=" text-secondary fw-bold " style=" font-size: 13px; margin: 0;"><?= substr($p['nama'], 0, 40); ?>...</p>
                                    </div>
                                    <p class="text-secondary text-center" style="font-size: 12px; margin: 0;">
                                        <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                    </p>

                                    <h1 class="text-danger fs-bold mt-1 text-center" style="font-size: 18px; margin: 0;">
                                        <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                            Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                        <?php else : ?>
                                            <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                        <?php endif ?>
                                    </h1>

                                    <div class="container mt-2">
                                        <div class="row justify-items-center">
                                            <div class="col">
                                                <div class="horizontal-counter">
                                                    <button class="btn btn-outline-danger rounded-circle" type="button" onClick='RdecreaseCount(this, <?= $p['id_produk']; ?>)'><i class="bi bi-dash"></i></button>
                                                    <input type="text" id="counterProduct" class="form-control text-center bg-white border-0" disabled value="1">
                                                    <button class=" btn btn-outline-danger rounded-circle" type="button" onClick='RincreaseCount(this, <?= $p['id_produk']; ?>)'><i class="bi bi-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
                                        <form action="<?= base_url('produk/' . $p['slug']); ?>" method="GET">
                                            <input type="hidden" name="add-to-cart" value="show">
                                            <input type="hidden" name="qty" id="Cqty<?= $p['id_produk']; ?>" value="1" value="show">
                                            <button type="submit" class="btn btn-danger mx-1 mt-2 fw-bold">
                                                <i class="bi bi-basket"></i>
                                            </button>
                                        </form>
                                        <form action="<?= base_url('produk/' . $p['slug']); ?>" method="GET">
                                            <input type="hidden" name="buy" value="show">
                                            <input type="hidden" name="qty" id="Bqty<?= $p['id_produk']; ?>" value="1" value="show">
                                            <button type="submit" class="btn btn-danger mx-1 mt-2 fw-bold">
                                                Beli
                                            </button>
                                            <span class="badge text-bg-success position-absolute start-0 top-0" style="font-size: 12px; padding: 2px 4px;">10%</span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function RincreaseCount(b, id) {
        var input = b.previousElementSibling;
        console.log(input);
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;
        $('#Cqty' + id).val(value);
        $('#Bqty' + id).val(value);
    }

    function RdecreaseCount(b, id) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            $('#Cqty' + id).val(value);
            $('#Bqty' + id).val(value);

        }
    }
</script>