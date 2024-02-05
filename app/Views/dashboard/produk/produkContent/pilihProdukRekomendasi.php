<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<style>
    #sortable-list {
        list-style-type: none;
        padding: 0;
    }

    #sortable-list li {
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
        cursor: pointer;
    }
</style>

<h1 class="h3 mb-2 text-gray-800">Pilih Produk Rekomendasi</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard/produk/management-fetching-content" class="text-dark">Management Fetching Produk</a></li>
    <li class="breadcrumb-item active text-danger text-decoration-underline">Pilih Produk Rekomendasi</li>
</ul>

<!-- Tambah Produk Rekomendasi -->
<div class="row">
    <div class="col mb-5">
        <div class="card border-0 shadow-sm shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-0 shadow-sm py-3">
                <i class="bi bi-pencil-square"></i>
                <h6 class="m-0 fw-bold px-2">Tambah Produk Rekomendasi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php $s = 1; ?>
                        <form action="<?= base_url('dashboard/produk/pilih-produk-rekomendasi/save'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="fw-bold fs-3 text-secondary mb-3">
                                <div class="row">
                                    <div class="col-md-8">Tambah Produk Rekomendasi</div>
                                    <div class="col-md-4 text-end"><button type="submit" class="btn btn-danger text rounded-3" onclick="clickSubmitEvent(this)">Tambahkan Produk Rekomendasi</button></div>
                                </div>
                            </div>

                            <!-- Button Pilih Produk -->
                            <div class="mb-4">
                                <label for="produk" class="form-label text-secondary">Pilih Produk Rekomendasi</label>
                                <button type="button" class="btn form-control text-left border-0 shadow-sm view-product border-left-danger text-danger fw-bold <?= (validation_show_error('short')) ? 'is-invalid' : 'border-1'; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" style="border: 1px solid #d1d3e2">
                                    Tekan Untuk Memilih Produk Rekomendasi
                                </button>
                            </div>

                            <!-- Modal Box Produk -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">List Produk</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Input pencarian -->
                                            <div class="input-group mt-2 mb-4">
                                                <input type="text" id="searchProduk" class="form-control border-0 shadow-sm" placeholder="Cari Produk...">
                                                <span class="input-group-text border-0 bg-danger" id="basic-addon1"><i class="bi bi-search text-white"></i></span>
                                            </div>
                                            <div class="row" id="produkList">
                                                <?php foreach ($produkTerbaru as $p) : ?>
                                                    <div class="col-6 py-1 px-4">
                                                        <div class="card border-0">
                                                            <div class="row g-0">
                                                                <div class="card-body border-0 shadow-sm py-2 px-2 mb-3">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-2 text-center d-flex justify-content-center">
                                                                            <input onchange="selectCheck(this)" class="form-check-input border-danger rounded-circle" type="checkbox" id="produkCheckbox<?= $p['id_produk']; ?>" name="produk_id[]" value="<?= $p['id_produk']; ?>" data-nama="<?= $p['nama']; ?>" class="border-0 rounded-circle" data-parent-kategori="<?= $p['id_produk']; ?>">
                                                                        </div>
                                                                        <div class="col-10 py-3">
                                                                            <p class="m-0 d-flex align-items-center" style="font-size: 13px;">
                                                                                <img src="<?= base_url('assets/img/produk/main/' . $p['img']); ?>" class="img-fluid rounded-2 me-2" width="80" height="80" alt="<?= $p['nama']; ?>">
                                                                                <?= $p['nama']; ?>
                                                                            </p>
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

                            <!-- Span Badge Kategori Terpilih -->
                            <div class="mb-4">
                                <label for="produk" class="form-label text-secondary">Produk Rekomendasi Terpilih</label>
                                <br>
                                <div id="produkTerpilih"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ubah Urutan Produk Rekomendasi -->
<div class="row">
    <div class="col mb-5">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-pencil-square"></i>
                <h6 class="m-0 fw-bold px-2">Edit Urutan Produk Rekomendasi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="<?= base_url('dashboard/produk/urutan-produk-rekomendasi/save-urutan'); ?>" method="post">
                            <div class="fw-bold fs-3 text-secondary mb-3">
                                <div class="row">
                                    <div class="col-md-8">Shorting Produk Rekomendasi</div>
                                    <div class="col-md-4 text-end"><button type="submit" class="btn btn-danger text rounded-3" onclick="clickSubmitEvent(this)">Update</button></div>
                                </div>
                            </div>
                            <?= csrf_field(); ?>
                            <ul id="sortable-list">
                                <?php foreach ($produkRekomendasi as $produk) : ?>
                                    <li draggable="true" ondragstart="dragStart(event, <?= $produk['id_produk']; ?>)" ondrop="dragDrop(event, <?= $produk['id_produk']; ?>)" class="border-0 shadow-sm mb-3 d-flex align-items-center">
                                        <?php
                                        $produkDetail = $produkModel->getProdukById($produk['id_produk']);
                                        ?>
                                        <img src="<?= base_url('assets/img/produk/main/' . $produkDetail['img']); ?>" class="img-fluid rounded-2" style="width:80px; height:80px; object-fit: contain; object-position: 20% 10%;">
                                        <span class="fw-bold mr-2" style="font-size: 12px;"><?= $produkDetail['nama']; ?></span>
                                        <div class="ml-auto">
                                            <form action="<?= base_url() ?>dashboard/produk/urutan-produk-rekomendasi/delete/<?= $produk['id_rekomendasi']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id_rekomendasi[]" value="<?= $produk['id_rekomendasi']; ?>">
                                                <!-- Tambahkan pengecekan agar tidak terjadi akses offset pada null -->
                                                <?php if (isset($newOrders[$produk['id_rekomendasi']])) : ?>
                                                    <input type="hidden" name="new_order[]" value="<?= $newOrders[$produk['id_rekomendasi']]; ?>">
                                                <?php else : ?>
                                                    <input type="hidden" name="new_order[]" value="">
                                                <?php endif; ?>
                                                <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)"> <i class="bi bi-trash-fill"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </form>

                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold fs-3 text-secondary text-center">Preview</p>
                        <div class="row text-center mt-3 border">
                            <?php foreach (array_slice($produkRekomendasi, 0, 6) as $produk) : ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="mb-3 border d-flex flex-column align-items-center">
                                        <!-- Frame smartphone -->
                                        <div class="phone-frame">
                                            <div class="text-bg-light bg-white border-0">
                                                <div class="px-0 py-0 mx-0 my-0">
                                                    <?php
                                                    $produkDetail = $produkModel->getProdukById($produk['id_produk']);
                                                    ?>
                                                    <img src="<?= base_url('assets/img/produk/main/' . $produkDetail['img']); ?>" alt="<?= $produkDetail['nama']; ?>" class="card-img-top" style="width:200px; height:200px; object-fit: contain; object-position: 20% 10%;">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Informasi produk -->
                                        <div class="fs-2 mt-2" style="padding: 0 10px;">
                                            <div class="d-flex align-items-center justify-content-center" style="height: 65px;">
                                                <p class="text-center text-secondary fw-bold" style="font-size: 12px; margin: 0;"><?= substr($produkDetail['nama'], 0, 25); ?></p>
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
    const list = document.getElementById("sortable-list");
    let dragItem = null;

    function dragStart(e, id) {
        dragItem = e.target;
        console.log('startID : ' + id)
        e.dataTransfer.setData("text/plain", e.target.innerHTML);
    };

    list.addEventListener("dragover", function(e) {
        e.preventDefault();
    });

    function dragDrop(e, id) {
        if (e.target.tagName === "LI") {
            e.preventDefault();
            const text = e.dataTransfer.getData("text/plain");
            console.log('dropedID : ' + id)

            dragItem.innerHTML = e.target.innerHTML;
            e.target.innerHTML = text;
        }
    };

    list.addEventListener("dragend", function() {
        dragItem = null;
    });

    // Produk Rekomendasi Script
    document.addEventListener('DOMContentLoaded', function() {
        var produkCheckboxes = document.querySelectorAll('input[type="checkbox"][name^="produk_id"]');
        var selectedCategories = []; // Menggunakan variabel yang sama

        // Menangkap elemen produkTerpilih
        var produkContainer = document.getElementById('produkTerpilih');

        // Menambahkan event listener untuk perubahan pada checkbox kategori
        produkCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var selectedProduk = this.dataset.nama;

                if (this.checked) {
                    // Tambahkan kategori yang dipilih ke dalam daftar
                    selectedCategories.push({
                        id_produk: this.value,
                        nama: selectedProduk
                    });

                    // Buat elemen <span> baru untuk setiap kategori yang dipilih
                    var produkSpan = document.createElement('span');
                    produkSpan.className = 'badge rounded-pill text-bg-danger px-2 py-2 mx-1';
                    produkSpan.textContent = selectedProduk;

                    // Tambahkan elemen <span> ke dalam container
                    produkContainer.appendChild(produkSpan);
                } else {
                    // Hapus kategori yang tidak dipilih dari daftar
                    var productId = this.value;
                    selectedCategories = selectedCategories.filter(function(produk) {
                        return produk.id_produk !== productId;
                    });

                    // Hapus elemen <span> yang sesuai dari container
                    var spans = produkContainer.getElementsByTagName('span');
                    for (var i = 0; i < spans.length; i++) {
                        if (spans[i].textContent === selectedProduk) {
                            produkContainer.removeChild(spans[i]);
                            break;
                        }
                    }
                }
            });
        });
    });

    // SEARCH PRODUCT
    document.addEventListener("DOMContentLoaded", function() {
        var produkList = document.getElementById("produkList");
        var noProductAlert = document.getElementById("noProductAlert");
        var searchInput = document.getElementById("searchProduk");
        var originalProducts = Array.from(produkList.children);

        searchInput.addEventListener("input", function() {
            var searchValue = searchInput.value.toLowerCase();
            var filteredProducts = originalProducts.filter(function(product) {
                var productName = product.querySelector(".fs-5").innerText.toLowerCase();
                return productName.includes(searchValue);
            });

            if (filteredProducts.length > 0) {
                noProductAlert.style.display = "none";
                produkList.innerHTML = "";
                filteredProducts.forEach(function(product) {
                    produkList.appendChild(product.cloneNode(true));
                });
            } else {
                noProductAlert.style.display = "block";
                produkList.innerHTML = "";
            }

            updateProdukBadge();
        });
    });
</script>

<?= $this->endSection(); ?>