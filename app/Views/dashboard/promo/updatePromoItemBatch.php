<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">EditPromo Item Produk</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 fw-bold px-2">Edit Promo Item Produk</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/promo/tambah-promo/show-promo/edit/update/<?= $op['id_promo_item_batch'] ?>" onsubmit="return validasiPromoItem()" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_promo_item_batch" value="<?= $op['id_promo_item_batch'] ?>">
                    <input type="hidden" name="produk_id" id="produk_id" value="<?= $op['id_produk'] ?>">
                    <div class="mb-4">
                        <label for="promo" class="form-label">Pilih Promo Tersedia</label>
                        <select name="promo" id="promo" class="form-control border-1">
                            <?php foreach ($promo as $p) : ?>
                                <option value="<?= $p['id_promo']; ?>" <?= ($p['id_promo'] == $op['id_promo']) ? 'selected' : ''; ?>><?= $p['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span id="promoError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="produk" class="form-label">Pilih Produk Yang Akan Diberikan Promo</label>
                        <button type="button" class="btn form-control border-left-danger text-left view-product" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnChooseProducts" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                            Tekan Untuk Memilih Produk
                        </button>
                    </div>

                    <!-- Modal Box Produk -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">List Produk Tersedia</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input pencarian -->
                                    <div class="mb-3">
                                        <input type="text" id="searchProduct" class="form-control" placeholder="Cari produk berdasarkan nama...">
                                    </div>
                                    <div class="row" id="productList">
                                        <!-- Daftar produk akan ditampilkan di sini -->
                                        <?php foreach ($produk as $item) : ?>
                                            <div class="col-6 mb-3 px-3">
                                                <div class="card border-0">
                                                    <div class="row g-0">
                                                        <div class="card-body border-0 shadow-sm">
                                                            <div class="row">
                                                                <div class="col-1 d-flex justify-content-center">
                                                                    <input onchange="selectCheck(this)" type="radio" id="produkCheckbox<?= $item['id_produk']; ?>" name="produk_id" value="<?= $item['id_produk']; ?>" data-nama="<?= $item['nama']; ?>" class="border-0">
                                                                </div>
                                                                <div class="col-3">
                                                                    <img src="<?= base_url('assets/img/produk/main/' . $item['img']); ?>" alt="<?= $item['nama']; ?>" class="img-fluid">
                                                                </div>
                                                                <div class="col-8">
                                                                    <p class="fs-4"><?= $item['nama']; ?></p>
                                                                    <?php foreach ($variasi as $v) : ?>
                                                                        <?php if ($v['id_variasi_item'] == $item['id_produk']) : ?>
                                                                            <p class="fs-5">Harga: Rp. <?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Pesan "Produk tidak tersedia" -->
                                    <div id="noProductAlert" class="alert alert-danger rounded border-0" style="display: none;">
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="bi bi-exclamation-triangle-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i>
                                            </div>
                                            <div class="col-10 text-center">
                                                <span class="fs-6">Produk tidak tersedia!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Span Badge Produk Terpilih -->
                    <!-- <div class="mb-4">
                        <label for="produk" class="form-label">Produk-Produk Terpilih</label>
                        <br>
                        <div id="selectedProds"></div>
                    </div> -->

                    <div class="mb-4">
                        <label for="produk" class="form-label">Produk Terpilih</label>
                        <input type="text" class="form-control border-1 bg-white" id="produkTerpilih" value="<?= $op['produk_nama']; ?>" name="produk" placeholder="Pilih Produk Terlebih Dahulu..." disabled>
                        <span id="produkError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="min" class="form-label">Minimal Pembelian Produk</label>
                        <input type="text" class="form-control border-1" id="min" name="min" placeholder="Masukkan Minimal Pembelian Produk..." onkeypress="return isNumber(event);" value="<?= $op['min']; ?>">
                        <span id="minError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="discount" class="form-label">Diskon (%)</label>
                        <input type="text" class="form-control border-1" id="discount" name="discount" onkeypress="return isNumber(event);" placeholder="Masukkan Jumlah Diskon..." value="<?= $op['discount']; ?>">
                        <span id="discountError" class="text-danger"></span>
                    </div>

                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });

    //Validasi Form
    function validasiPromoItem() {
        var isValid = true;

        var promoField = document.getElementById('promo');
        var produkField = document.getElementById('produkTerpilih'); // Ganti ID menjadi "produkTerpilih"
        var minField = document.getElementById('min');
        var discountField = document.getElementById('discount');

        var promoError = document.getElementById('promoError');
        var produkError = document.getElementById('produkError');
        var minError = document.getElementById('minError');
        var discountError = document.getElementById('discountError');

        promoError.textContent = '';
        produkError.textContent = '';
        minError.textContent = '';
        discountError.textContent = '';

        if (promoField.value.trim() === '') {
            promoField.classList.add('invalid-field');
            promoError.textContent = 'Pilihan Promo harus diisi';
            isValid = false;
        } else {
            promoField.classList.remove('invalid-field');
        }

        if (produkField.value.trim() === '') {
            produkField.classList.add('invalid-field');
            produkError.textContent = 'Produk yang akan diberikan promo harus diisi';
            isValid = false;
        } else {
            produkField.classList.remove('invalid-field');
        }

        if (minField.value.trim() === '') {
            minField.classList.add('invalid-field');
            minError.textContent = 'Minimal pembelian harus diisi';
            isValid = false;
        } else if (isNaN(minField.value)) {
            minField.classList.add('invalid-add');
            minError.textContent = 'Minimal pembelian harus berupa angka';
            isValid = false;
        } else {
            minField.classList.remove('invalid-field');
        }

        if (discountField.value.trim() === '') {
            discountField.classList.add('invalid-field');
            discountError.textContent = 'Diskon promo harus diisi';
            isValid = false;
        } else if (isNaN(discountField.value)) {
            discountField.classList.add('invalid-field');
            discountError.textContent = 'Diskon promo harus berupa angka';
        } else {
            discountField.classList.remove('invalid-field');
        }

        return isValid;
    }

    // Get Nama Produk ke Input Text Disabled
    var produkRadios = document.querySelectorAll('input[type=radio][name=produk_id]');
    produkRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            var selectedProduk = this.dataset.nama;
            var produkField = document.getElementById('produkTerpilih');
            produkField.value = selectedProduk;
        });
    });

    // Fungsi untuk menangani pencarian produk
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchProduct');
        const productList = document.getElementById('productList').children;
        const noProductAlert = document.getElementById('noProductAlert');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            let productsFound = false;

            for (let i = 0; i < productList.length; i++) {
                const productName = productList[i].querySelector('.fs-4').textContent.toLowerCase();

                if (productName.includes(searchTerm)) {
                    productList[i].style.display = 'block';
                    productsFound = true;
                } else {
                    productList[i].style.display = 'none';
                }
            }

            // Tampilkan atau sembunyikan alert "Produk tidak tersedia"
            if (!productsFound) {
                noProductAlert.style.display = 'block';
            } else {
                noProductAlert.style.display = 'none';
            }
        });
    });
</script>

<?= $this->endSection(); ?>