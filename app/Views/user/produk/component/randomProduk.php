<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h2 class="mb-4 text-merah"><?= lang('Text.produk_lainnya') ?></h2>
            <div class="d-flex justify-content-center align-items-center swiper mySwing">
                <div class="swiper-wrapper d-flex">
                    <?php foreach ($randomProducts as $p) : ?>
                        <div class="swiper-slide col-md-4 mx-md-1 mb-md-1 mb-5">
                            <div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%;">
                                <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 100px; height: 100px; object-fit: contain; object-position: 20% 10%;">
                                    </div>
                                </a>
                                <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                                    <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                                        <p class=" text-secondary fw-bold " style=" font-size: 10px; margin: 0;"><?= substr($p['nama'], 0, 30); ?></p>
                                    </div>
                                    <p class="text-secondary" style="font-size: 8px; margin: 0;">
                                        <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                                    </p>

                                    <h1 class="text-danger fw-bold mt-1 pb-3" style="font-size: 10px; margin: 0;">
                                        <?php if ($p['harga_min'] == $p['harga_max']) : ?>
                                            Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?>
                                        <?php else : ?>
                                            <?= substr('Rp. ' . number_format($p['harga_min'], 0, ',', '.') . '-' . number_format($p['harga_max'], 0, ',', '.'), 0, 13); ?>...
                                        <?php endif ?>
                                    </h1>

                                    <!-- button Animasi -->
                                    <div class="button-container" id="button-container-<?= $p['id_produk']; ?>">
                                        <div class="button" onClick="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOver="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOut="changeToCircle(<?= $p['id_produk']; ?>)">
                                            <i class="bi bi-plus text-danger fw-bold" style="font-size: 16px;"></i>
                                        </div>
                                        <div class="button-capsule" onMouseOver="changeToCapsule(<?= $p['id_produk']; ?>)" onMouseOut="changeToCircle(<?= $p['id_produk']; ?>)">
                                            <div class="icon" onClick="decreaseValue(<?= $p['id_produk']; ?>)">-</div>
                                            <input type="text" id="counter-<?= $p['id_produk']; ?>" class="input" value="1" disabled>
                                            <div class="icon" onClick="increaseValue(<?= $p['id_produk']; ?>)">+</div>
                                        </div>
                                    </div>
                                    <!-- akhir button animasi -->

                                    <!-- <div class="container mt-2">
                                        <div class="row justify-items-center">
                                            <div class="col">
                                                <div class="horizontal-counter">
                                                    <button class="btn btn-outline-danger rounded-circle" type="button" onClick='RdecreaseCount(this, <?= $p['id_produk']; ?>)'><i class="bi bi-dash"></i></button>
                                                    <input type="text" id="counterProduct" class="form-control form-control-sm border-0 text-center bg-white" disabled value="1">
                                                    <button class=" btn btn-outline-danger mr-4 rounded-circle" type="button" onClick='RincreaseCount(this, <?= $p['id_produk']; ?>)'><i class="bi bi-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
                                        <form action="<?= base_url('produk/' . $p['slug']); ?>" method="GET">
                                            <input type="hidden" name="add-to-cart" value="show">
                                            <input type="hidden" name="qty" id="Cqty<?= $p['id_produk']; ?>" value="1" value="show">
                                            <button type="submit" class="btn btn-danger mx-1 mt-2 fw-bold">
                                                <i class="bi bi-basket text-white fa-sm"></i>
                                            </button>
                                        </form>
                                        <form action="<?= base_url('produk/' . $p['slug']); ?>" method="GET">
                                            <input type="hidden" name="buy" value="show">
                                            <input type="hidden" name="qty" id="Bqty<?= $p['id_produk']; ?>" value="1" value="show">
                                            <button type="submit" class="btn btn-danger mx-1 mt-2">
                                                Beli
                                            </button>
                                            <span class="badge text-bg-success position-absolute start-0 top-0" style="font-size: 12px; padding: 2px 4px;">10%</span>
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- styling button counter animasi -->
<style>
    .button-container {
        position: absolute;
        top: 7px;
        /* Jarak dari atas */
        left: 7px;
        /* Jarak dari kiri */
        display: flex;
        gap: 5px;
        /* Jarak antar tombol */
    }

    .button {
        width: 25px;
        /* Ukuran tombol yang lebih kecil */
        height: 25px;
        /* Ukuran tombol yang lebih kecil */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        outline: 1px solid #e83b2e;
        background-color: #fff;
    }

    .button-capsule {
        width: 60px;
        /* Ukuran capsule yang lebih kecil */
        height: 25px;
        /* Ukuran capsule yang lebih kecil */
        border-radius: 15px;
        display: none;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 0 5px;
        /* Padding yang lebih kecil */
        transition: all 0.3s ease;
        outline: 1px solid #e83b2e;
        background-color: #fff;
    }

    .icon {
        font-size: 18px;
        color: #e83b2e;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .input {
        width: 20px;
        /* Ukuran input yang lebih kecil */
        height: 15px;
        /* Ukuran input yang lebih kecil */
        text-align: center;
        margin: 0 3px;
        /* Margin yang lebih kecil */
        color: #000;
        font-size: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
        border: none;
        outline: none;
    }
</style>
<!-- akhir styling button counter animasi -->
<!-- script button counter animasi -->
<script>
    function changeToCapsule(productId) {
        document.querySelector(`#button-container-${productId} .button`).style.display = 'none';
        document.querySelector(`#button-container-${productId} .button-capsule`).style.display = 'flex';
    }

    function decreaseValue(productId) {
        var counter = document.getElementById(`counter-${productId}`);
        if (parseInt(counter.value) > 0) {
            counter.value = parseInt(counter.value) - 1;
        }
        validateCounter(productId);
    }

    function increaseValue(productId) {
        var counter = document.getElementById(`counter-${productId}`);
        counter.value = parseInt(counter.value) + 1;
        validateCounter(productId);
    }

    function changeToCircle(productId) {
        document.querySelector(`#button-container-${productId} .button`).style.display = 'flex';
        document.querySelector(`#button-container-${productId} .button-capsule`).style.display = 'none';
    }

    function validateCounter(productId) {
        var counter = document.getElementById(`counter-${productId}`);
        if (parseInt(counter.value) <= 1) {
            counter.value = 1;
            changeToCircle(productId);
        }
    }
</script>
<!-- akhir script button counter animasi -->

<!-- <script type="text/javascript">
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
</script> -->