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
                <div class="mb-3">
                    <input type="hidden" id="qty" name="qty" value="1">
                    <input checked class="form-check-input d-none" type="radio" value="#" name="varian" id="#">
                    <button class="btn btn-white text-danger border-danger d-inline add-to-cart-btn position-relative" produk="#">
                        <i class="bi bi-cart-fill"></i>
                    </button>
                    <a id="#" href="#" class="btn btn-white text-danger border-danger fw-bold">Beli</a>
                </div>
                <h4 class="fw-bold mt-4">Nama Promo</h4>
                <div class="row">
                    <hr class="w-100">
                    <div class="col">
                        <p class="fs-2 text-danger fw-bold">Produk A + Produk B</p>
                    </div>
                    <hr class="w-100">
                    <div class="col">
                        <p class="fs-2 text-danger fw-bold">Rp. 100.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mx-0 mt-4 mb-5">
        <div class="col">
            <h2 class="fw-bold text-merah">Deskripsi</h2>
            <p class="text-potong">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex cumque velit, nemo dolor, maiores nulla, nihil facere necessitatibus iste asperiores debitis omnis. Quibusdam, minus in perferendis omnis ut nisi iure?</p>
        </div>
        <div class="d-flex">
            <div class="mx-1">
                <div class="badge-container mb-2">
                    <span class="text-secondary py-0 my-0">kategori</span>
                    <br>
                    <span class="badge text-bg-danger rounded-5 text-uppercase">Kategori</span>
                </div>
                <div class="badge-container mb-2">
                    <span class="text-secondary py-0 my-0">subkategori</span>
                    <br>
                    <span class="badge text-bg-warning rounded-5 text-uppercase">nama kategori</span>
                    <!-- Fungsi Multi Bahasa -->
                    <br>
                </div>
                <div class="badge-container mb-2">
                    <p class="text-secondary py-0 my-0">stok : </p>
                    <p class="badge text-bg-primary rounded-5 text-uppercase my-0">1</p>
                </div>
                <div class="badge-container mb-0">
                    <p class="text-secondary py-0 my-0">SKU : </p>
                    <span class="badge text-bg-success rounded-5 text-uppercase">12345</span>
                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection(); ?>