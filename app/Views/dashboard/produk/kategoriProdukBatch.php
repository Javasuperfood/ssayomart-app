<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Tambah Produk - Kategori Batch</h1>

<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-bold text-danger">Tambah Produk - Kategori Batch</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/produk/produk-batch/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control shadow-sm <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= old('nama') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                        <input type="text" class="form-control shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-0'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= old('sku') ?>" onkeypress="return isNumber(event);">
                        <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .." value="<?= old('deskripsi') ?>"></textarea>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>

                    <!-- Buttom Pilih Kategori -->
                    <div class="mb-3">
                        <label for="produk" class="form-label text-secondary">Pilih Kategori</label>
                        <button type="button" class="btn form-control shadow-sm text-left border-0 view-product border-left-danger text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tekan Untuk Memilih Kategori
                        </button>
                    </div>

                    <!-- Modal Box Kategori -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">List Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input pencarian -->
                                    <div class="input-group mb-3">
                                        <span class="input-group-text shadow-sm border-0 bg-danger" id="basic-addon1"><i class="bi bi-search text-white"></i></span>
                                        <input type="text" id="searchKategori" class="form-control border-0 shadow-sm" placeholder="Cari Kategori...">
                                    </div>
                                    <div class="row" id="kategoriList">
                                        <div class="col-6 mb-3 px-3">
                                            <div class="card border-0">
                                                <div class="row g-0">
                                                    <?php foreach ($kategori as $k) : ?>
                                                        <div class="card-body border-0 shadow-sm mb-3">
                                                            <div class="row">
                                                                <div class="col-2 text-center">
                                                                    <input type="checkbox" id="kategoriCheckbox<?= $k['id_kategori']; ?>" name="kategori_id[]" value="<?= $k['id_kategori']; ?>" data-nama="<?= $k['nama_kategori']; ?>" class="border-0 rounded-circle" data-parent-kategori="<?= $k['id_kategori']; ?>">
                                                                </div>
                                                                <div class="col-10">
                                                                    <p class="fs-6">
                                                                        <?= $k['nama_kategori']; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pesan "Produk tidak tersedia" -->
                                    <div id="noProductAlert" class="alert alert-danger rounded border-0" style="display: none;">
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="bi bi-exclamation-triangle-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i>
                                            </div>
                                            <div class="col-10 text-center">
                                                <span class="fs-6">Kategori tidak tersedia!</span>
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

                    <!-- Span Badge Kategori Terpilih -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label text-secondary">Kategori Terpilih</label>
                        <br>
                        <div id="kategoriTerpilih"></div>
                    </div>

                    <!-- Button Pilih Sub Kategori -->
                    <div class="mb-3">
                        <label for="produk" class="form-label text-secondary">Pilih Sub Kategori</label>
                        <button type="button" class="btn form-control shadow-sm border-0 border-left-danger text-left view-product text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal_sub">
                            Tekan Untuk Memilih Sub Kategori
                        </button>
                    </div>

                    <!-- Modal Box Sub Kategori -->
                    <div class="modal fade" id="exampleModal_sub" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">List Sub Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input pencarian -->
                                    <div class="input-group mb-3">
                                        <span class="input-group-text shadow-sm border-0 bg-danger" id="basic-addon1"><i class="bi bi-search text-white"></i></span>
                                        <input type="text" id="searchSubKategori" class="form-control border-0 shadow-sm" placeholder="Cari Sub Kategori...">
                                    </div>

                                    <div class="row" id="subKategoriList">
                                        <div class="col-6 mb-3 px-3">
                                            <div class="card border-0">
                                                <div class="row g-0">
                                                    <?php foreach ($subKategori as $sk) : ?>
                                                        <div class="card-body border-0 shadow-sm">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <input type="checkbox" id="subKategoriCheckbox<?= $sk['id_sub_kategori']; ?>" name="sub_kategori_id[]" value="<?= $sk['id_sub_kategori']; ?>" data-nama="<?= $sk['nama_kategori']; ?>" data-parent="<?= $sk['id_kategori']; ?>" class="border-0">
                                                                </div>
                                                                <div class="col-9">
                                                                    <p class="fs-4">
                                                                        <?= $sk['nama_kategori']; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Pesan "Produk tidak tersedia" -->
                                    <div id="noProductAlert" class="alert alert-danger rounded border-0" style="display: none;">
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="bi bi-exclamation-triangle-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i>
                                            </div>
                                            <div class="col-10 text-center">
                                                <span class="fs-6">Sub Kategori tidak tersedia!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end pilih sub kategori -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Span Badge Sub Kategori Terpilih -->
                    <div class="mb-3">
                        <label for="subKategori" class="form-label text-secondary">Sub Kategori Terpilih</label>
                        <br>
                        <div id="subKategoriTerpilih"></div>
                    </div>

                    <div class="mb-3">
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                        </div>
                        <label for="img" class="form-label">Masukan Gambar</label>
                        <input type="file" class="form-control <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" placeholder="Masukan Gambar">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="selectVariant">Pilih Variant</label>
                                <select class="form-control border-0 shadow-sm" name="selectVariant" id="selectVariant">
                                    <option value="">Pilih</option>
                                    <?php foreach ($variasi as $v) : ?>
                                        <option value="<?= $v['id_variasi']; ?>" <?= (old('selectVariant') == $v['id_variasi']) ? 'selected' : ''; ?>><?= $v['nama_varian']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="valueVariant">Value Variant <span class="text-danger">(e.g : Ayam, Sapi atau 500 Gram, 1 Kg)</span></label>
                                <input type="text" id="valueItem" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" placeholder="Value Varian">
                                <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat Produk <span class="text-danger">(* Harus Dalam Satuan Gram. Contoh : 1kg = 1000)</span></label>
                        <input type="price" class="form-control <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="berat" name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                        <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Produk</label>
                        <input type="price" class="form-control <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                        <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger mt-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // SWAL
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

    // Inisialisasi array untuk kategori dan subkategori terpilih
    var selectedCategories = [];
    var kategoriContainer = document.getElementById('kategoriTerpilih');

    var selectedSubCategories = [];
    var subKategoriContainer = document.getElementById('subKategoriTerpilih');

    // Mendapatkan semua checkbox kategori dan subkategori
    var kategoriCheckboxes = document.querySelectorAll('input[type="checkbox"][name^="kategori_id"]');
    var subKategoriCheckboxes = document.querySelectorAll('input[type="checkbox"][name^="sub_kategori_id"]');


    // Menambahkan event listener untuk perubahan pada checkbox kategori
    kategoriCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedKategori = this.dataset.nama;

            if (this.checked) {
                // Tambahkan kategori yang dipilih ke dalam daftar
                selectedCategories.push({
                    id_kategori: this.value,
                    nama_kategori: selectedKategori
                });

                // Buat elemen <span> baru untuk setiap kategori yang dipilih
                var kategoriSpan = document.createElement('span');
                kategoriSpan.className = 'badge rounded-pill text-bg-danger px-2 py-2 mx-1';
                kategoriSpan.textContent = selectedKategori;

                // Tambahkan elemen <span> ke dalam container
                kategoriContainer.appendChild(kategoriSpan);
            } else {
                // Hapus kategori yang tidak dipilih dari daftar
                var categoryId = this.value;
                selectedCategories = selectedCategories.filter(function(category) {
                    return category.id_kategori !== categoryId;
                });

                // Hapus elemen <span> yang sesuai dari container
                var spans = kategoriContainer.getElementsByTagName('span');
                for (var i = 0; i < spans.length; i++) {
                    if (spans[i].textContent === selectedKategori) {
                        kategoriContainer.removeChild(spans[i]);
                        break;
                    }
                }
            }

            // Perbarui pilihan subkategori sesuai dengan kategori yang dipilih
            updateSubcategories(selectedCategories);
        });
    });

    // Menambahkan event listener untuk perubahan pada checkbox subkategori
    subKategoriCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedSubKategori = this.dataset.nama;

            if (this.checked) {
                // Tambahkan subkategori yang dipilih ke dalam daftar
                selectedSubCategories.push(selectedSubKategori);

                // Buat elemen <span> baru untuk setiap subkategori yang dipilih
                var subKategoriSpan = document.createElement('span');
                subKategoriSpan.className = 'badge rounded-pill text-bg-warning px-2 py-2 mx-1';
                subKategoriSpan.textContent = selectedSubKategori;

                // Tambahkan elemen <span> ke dalam container
                subKategoriContainer.appendChild(subKategoriSpan);
            } else {
                // Hapus subkategori yang tidak dipilih dari daftar
                var index = selectedSubCategories.indexOf(selectedSubKategori);
                if (index !== -1) {
                    selectedSubCategories.splice(index, 1);
                }

                // Hapus elemen <span> yang sesuai dari container
                var spans = subKategoriContainer.getElementsByTagName('span');
                for (var i = 0; i < spans.length; i++) {
                    if (spans[i].textContent === selectedSubKategori) {
                        subKategoriContainer.removeChild(spans[i]);
                        break;
                    }
                }
            }
        });
    });

    function updateSubcategories(selectedCategories) {
        var selectedCategoryIds = selectedCategories.map(function(category) {
            return category.id_kategori;
        });

        // Hanya menampilkan subkategori yang sesuai dengan kategori yang dipilih
        subKategoriCheckboxes.forEach(function(checkbox) {
            var subKategoriParent = checkbox.dataset.parent;
            if (selectedCategoryIds.includes(subKategoriParent)) {
                checkbox.style.display = 'block';
            } else {
                checkbox.style.display = 'none';
            }
        });
    }

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