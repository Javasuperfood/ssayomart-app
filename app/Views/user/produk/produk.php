<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= base_url() ?>assets/img/produk/main/<?= $produk['gambar']; ?>" class="img-fluid" alt="<?= $produk['nama']; ?>">
        </div>
        <div class="col-md-6 mt-4">
            <h2><?= $produk['nama']; ?></h2>
            <p>
            <h1>Rp. <?= number_format($produk['harga'], 2, ',', '.'); ?></h1>
            <p><i class="fa-regular fa-heart"></i> Add to Wishlist</p>
            <div class="container">
                <div class="row">
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button class="btn btn-outline-danger rounded-circle" type="button" onClick='decreaseCount(event, this)'><i class="bi bi-dash"></i></button>
                        <input type="number" class="form-control text-center bg-white border-0" disabled value="1">
                        <button class=" btn btn-outline-danger rounded-circle" type="button" onClick='increaseCount(event, this)'><i class="bi bi-plus"></i></button>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center">
                <input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id_produk']; ?>">
                <input type="hidden" name="harga" id="harga" value="<?= $produk['harga']; ?>">
                <input type="hidden" id="qty" name="qty" value="1">
                <button class="btn btn-white text-danger border-danger mt-4 add-to-cart-btn"><i class="bi bi-basket2"></i></button>
                <a href="<?= base_url() ?>checkout" class="btn btn-white text-danger border-danger mt-4 ">Beli Sekarang</a>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <h2> Deskripsi</h2>
                <p class="text-potong"><?= $produk['deskripsi']; ?></p>
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
        document.getElementById('setQty').value = value;
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
            document.getElementById('setQty').value = value;

        }
    }
</script>
<?= $this->include('user/component/scriptAddToCart'); ?>
<?= $this->endSection(); ?>