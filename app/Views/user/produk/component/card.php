<?php if ($produk) : ?>
    <div class="container" id="product">
        <!-- <h2>Produk terlaris</h2> -->
        <div class="row row-cols-3" id="product-container">
            <?php foreach ($produk as $p) : ?>
                <div class="col-6 col-md-4 col-lg-3 pt-3">
                    <div class="card border-0 shadow-sm text-center" style="width: auto; height: 100%;">
                        <a href="<?= base_url() ?>produk/<?= $p['slug']; ?>" class="link-underline link-underline-opacity-0">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="<?= base_url() ?>assets/img/produk/main/<?= $p['img']; ?>" class="card-img-top mt-3 text-center py-0 px-0 mx-0 my-0" alt="..." style="width: 150px; height: 150px;">
                            </div>
                        </a>
                        <div class="fs-2 mt-2" style="padding: 0 10px 0 10px;">
                            <div class="d-flex align-items-start justify-content-center" style="height: 65px;">
                                <p class=" text-secondary fw-bold " style=" font-size: 14px; margin: 0;"><?= substr($p['nama'], 0, 40); ?></p>
                            </div>
                            <p class="text-secondary" style="font-size: 12px; margin: 0;">
                                <del>Rp. <?= number_format($p['harga_min'], 0, ',', '.'); ?></del>
                            </p>

                            <h1 class="text-danger fs-bold mt-1" style="font-size: 18px; margin: 0;">
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
                                            <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="decreaseCount(this, <?= $p['id_produk']; ?>)"><i class="bi bi-dash"></i></button>
                                            <input type="text" id="counter" class="form-control form-control-sm border-0 text-center bg-white" value="1" disabled>
                                            <button class="btn btn-sm btn-outline-danger rounded-circle" type="button" onclick="increaseCount(this, <?= $p['id_produk']; ?>)"><i class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center custom-button pb-3" style="display: flex; justify-content: center;">
                                <form action="<?= base_url('produk/' . $p['slug']); ?>">
                                    <input type="hidden" name="add-to-cart" value="show">
                                    <input type="hidden" name="qty" id="Cqty<?= $p['id_produk']; ?>" value="1" value="show">
                                    <button type="submit" class="btn btn-danger mx-1 mt-2 fw-bold">
                                        <i class="fas fa-shopping-cart text-white fa-lg"></i>
                                    </button>
                                </form>
                                <form action="<?= base_url('produk/' . $p['slug']); ?>">
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
    <script type="text/javascript">
        function increaseCount(b, id) {
            var input = b.previousElementSibling;
            console.log(input);
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
            $('#Cqty' + id).val(value);
            $('#Bqty' + id).val(value);
        }

        function decreaseCount(b, id) {
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
<?php else : ?>
    <div class="container px-5 my-5 align-middle">
        <div class="card border-0 text-center rounded shadow-sm">
            <div class="card-body mx-3 my-3">
                <h5 class="card-title">Produk tidak ditemukan atau belum tersedia</h5>
                <a href="/" class="btn btn-danger border-0 rounded ">Kembali</a>
            </div>
        </div>
    </div>
<?php endif ?>

<style>
    .horizontal-counter {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .horizontal-counter .btn {
        padding: 0.25rem 0.5rem;
        font-size: 12px;
    }

    .horizontal-counter input {
        width: 40px;
        text-align: center;
    }





    /* Media query for Samsung Galaxy Fold */
    @media (max-width: 280px) {
        .horizontal-counter .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.9rem;
        }

        .horizontal-counter input {
            width: 30px;
            text-align: center;
        }

        .custom-button .btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.9rem;

        }

        img.card-img-top {
            width: 100px !important;
            height: 100px !important;
        }
    }
</style>