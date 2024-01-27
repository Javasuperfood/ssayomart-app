<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Tambah Promo Item Produk-Batch</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 fw-bold px-2">Tambah Promo Produk</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/promo/tambah-promo-item-batch/save" onsubmit="return validasiPromoItem()" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="produk_id" id="produk_id">
                    <div class="mb-4">
                        <label for="promo" class="form-label">Pilih Promo Tersedia</label>
                        <select name="promo" id="promo" class="form-control border-1" data-toggle="tooltip" data-placement="bottom" title="Klik untuk memilih promo produk yang anda inputkan">
                            <?php foreach ($promo as $item) : ?>
                                <option value="<?= $item['id_promo']; ?>"><?= $item['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span id="promoError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="produk" class="form-label">Pilih Produk Yang Akan Diberikan Promo</label>
                        <button type="button" class="btn form-control border-left-danger text-left view-product shadow-sm fw-bold text-danger" data-toggle="tooltip" data-placement="bottom" title="Klik untuk memilih produk yang akan di berikan promo" data-bs-toggle="modal" data-bs-target="#exampleModal" id="btnChooseProducts" style="border-width: 0px; border-color: #d1d3e2; border-style: solid;">
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
                                        <input type="text" id="searchProduct" oninput="searchProduk(this)" class="form-control" placeholder="Cari produk berdasarkan nama...">
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div id="inputproduk"></div>
                                        </div>
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
                                                                    <input onchange="selectCheck(this)" type="checkbox" id="produkCheckbox<?= $item['id_produk']; ?>" name="produk_id[]" value="<?= $item['id_produk']; ?>" data-nama="<?= $item['nama']; ?>" class="border-0" style="width: 30px;">
                                                                </div>
                                                                <div class="col-3">
                                                                    <img src="<?= base_url('assets/img/produk/main/' . $item['img']); ?>" alt="<?= $item['nama']; ?>" class="img-fluid" style="width:100px; height:100px; object-fit: contain; object-position: 20% 10%;">
                                                                </div>
                                                                <div class="col-8">
                                                                    <p class="fs-4 nama-produk" style="font-size: 18px;"><?= $item['nama']; ?></p>
                                                                    <?php foreach ($variasi as $v) : ?>
                                                                        <?php if ($v['id_variasi_item'] == $item['id_produk']) : ?>
                                                                            <p class="harga" style="font-size: 14px;">Harga: Rp. <?= number_format($v['harga_item'], 0, ',', '.'); ?></p>
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
                    <div class="mb-4">
                        <label for="produk" class="form-label">Produk-Produk Terpilih</label>
                        <div id="selectedProds"></div>
                        <span id="produkError" data-toggle="tooltip" data-placement="bottom" title="produk yang di pilih" class="text-danger"></span>
                    </div>


                    <div class="mb-4">
                        <label for="min" class="form-label">Minimal Pembelian Produk</label>
                        <input type="text" class="form-control border-1" id="min" name="min" data-toggle="tooltip" data-placement="bottom" title="Harap isi persyaratan pembelian" onkeypress="return isNumber(event);" placeholder="Masukkan Minimal Pembelian Produk...">
                        <span id="minError" class="text-danger"></span>
                    </div>

                    <div class="mb-4">
                        <label for="discount" class="form-label">Diskon (%)</label>
                        <select class="form-select border-1" name="discount" id="discount">
                            <option value="" selected>Pilih diskon</option>
                            <?php for ($i = 5; $i <= 100; $i += 5) : ?>
                                <option value="<?= $i / 100; ?>" <?= (old('discount') == $i / 100) ? 'selected' : ''; ?>><?= $i; ?>%</option>
                            <?php endfor; ?>
                        </select>
                        <span id="discountError" class="text-danger"></span>
                    </div>

                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Klik untuk melihat perubahan" onclick="clickSubmitEvent(this)">Simpan</button>
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
        var produkField = document.getElementById('selectedProds'); // Ganti ID menjadi "produkTerpilih"
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

        // if (produkField.textContent.trim() === '') {
        //     produkField.classList.add('invalid-field');
        //     produkError.textContent = 'Produk yang akan diberikan promo harus diisi';
        //     isValid = false;
        // } else {
        //     produkField.classList.remove('invalid-field');
        // }

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
    // var produkRadios = document.querySelectorAll('input[type=radio][name=produk_id]');
    // produkRadios.forEach(function(radio) {
    //     radio.addEventListener('change', function() {
    //         var selectedProduk = this.dataset.nama;
    //         var produkField = document.getElementById('produkTerpilih');
    //         produkField.value = selectedProduk;
    //     });
    // });

    // Inisialisasi array untuk produk terpilih
    var selectedProducts = [];
    var productContainer = document.getElementById('selectedProds');

    // Mendapatkan semua checkbox kategori dan subkategori
    var productCheckboxes = document.querySelectorAll('input[type="checkbox"][name="produk_id[]"]');

    // Menambahkan event listener untuk perubahan pada checkbox produk
    productCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedProduk = this.dataset.nama;

            if (this.checked) {
                // Tambahkan produk yang dipilih ke dalam daftar
                selectedProducts.push({
                    id_produk: this.value,
                    nama: selectedProduk
                });

                // Buat elemen <span> baru untuk setiap produk yang dipilih
                var produkSpan = document.createElement('span');
                produkSpan.className = 'badge rounded-pill text-bg-danger px-2 py-2 mx-1';
                produkSpan.textContent = selectedProduk;

                // Tambahkan elemen <span> ke dalam container
                productContainer.appendChild(produkSpan);
            } else {
                // Hapus produk yang tidak dipilih dari daftar
                var produkId = this.value;
                selectedProducts = selectedProducts.filter(function(product) {
                    return product.id_produk !== produkId;
                });

                // Hapus elemen <span> yang sesuai dari container
                var spans = productContainer.getElementsByTagName('span');
                for (var i = 0; i < spans.length; i++) {
                    if (spans[i].textContent === selectedProduk) {
                        productContainer.removeChild(spans[i]);
                        break;
                    }
                }
            }

            // Perbarui pilihan produk terpilih
            updatedProducts(selectedProducts);
        });
    });

    var selectedProductsGlobal = [];

    function updatedProducts(selectedProducts) {
        var selectedProductsId = selectedProducts.map(function(product) {
            return product.id_produk;
        });

        var produkIdInput = document.getElementById('produk_id');
        produkIdInput.value = selectedProductsId.join(',');
    }
</script>

<script>
    var arrayProduk = [];

    // Function to add a value to the array
    function addValue(value) {
        arrayProduk.push(value);
        console.log("Array after adding:", arrayProduk);
    }

    // Function to remove a value from the array
    function removeValue(value) {
        var index = arrayProduk.indexOf(value);
        if (index !== -1) {
            arrayProduk.splice(index, 1);
            console.log("Array after removing:", arrayProduk);
        } else {
            console.log("Value not found in the array");
        }
    }

    function selectCheck(e) {
        const produkChecked = e.value;
        console.log(arrayProduk);

        if (arrayProduk.length > 0) {
            addValue(produkChecked);
            arrayProduk.forEach(function(val) {
                if (val == produkChecked) {
                    removeValue(val);
                    return false;
                }
            });
        } else {
            addValue(produkChecked);
        }

        // Clear the input field before appending
        $('#inputproduk').empty();

        // arrayProduk.forEach(function(p) {
        //     $('#inputproduk').append(`
        //     <input type="text" name="produk_id[]" value="${p}">
        // `);
        // });
    }

    function searchProduk(e) {
        // console.log(this.value);
        const keyword = e.value;

        if (keyword.length > 2) {
            request(keyword);
        } else if (keyword.length == 0) {
            request()
        }
    }

    function request(keyword = null) {
        $.ajax({
            type: "GET",
            url: "<?= base_url(); ?>api/getproduct",
            contentType: "application/json",
            data: {
                search: keyword
            },
            success: function(responseData) {
                console.log("Success:", responseData);
                $(`#productList`).empty();
                responseData.response.forEach(function(p) {
                    console.log(p.nama);
                    $('#productList').append(`
                         <div class="col-6 mb-3 px-3 p${p.id_produk}">
                            <div class="card border-0">
                                <div class="row g-0">
                                    <div class="card-body border-0 shadow-sm">
                                        <div class="row">
                                            <div class="col-1 d-flex justify-content-center">
                                                <input onchange="selectCheck(this)" type="checkbox" id="produkCheckbox${p.id_produk}" name="produk_id[]" value="${p.id_produk}" data-nama="${p.nama}" class="border-0" style="width: 30px;">
                                            </div>
                                            <div class="col-3">
                                                <img src="<?= base_url('assets/img/produk/main/'); ?>${p.img}" alt="${p.nama}" class="img-fluid" style="width:100px; height:100px; object-fit: contain; object-position: 20% 10%;">
                                            </div>
                                            <div class="col-8">
                                                <p class="fs-4 nama-produk" style="font-size: 18px;">${p.nama}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                        `)
                })
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }
</script>

<?= $this->endSection(); ?>