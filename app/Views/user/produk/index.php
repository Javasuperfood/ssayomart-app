<?= $this->extend('user/produk/layout') ?>
<?= $this->section('page-content') ?>

<!-- Navbar -->
<?= $this->include('user/home/component/navbarMain') ?>

<!-- tampilan Desktop -->
<div class="container-fluid d-none d-lg-block">
    <div class=" mt-5">
        <div class="row ">
            <div class="col-2">
                <div class="card-side border-0 shadow-sm " style=" top: 50px; position: fixed;">
                    <div class=" card-body">
                        <h3 class="mt-5">Kategori</h3>
                        <hr style="border-color: red; border-width: 3px;">
                        <ul class="list-group">
                            <li class="list-group-item " aria-current="true">An active item</li>
                            <li class="list-group-item " aria-current="true">An active item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                            <li class="list-group-item">A fourth item</li>
                            <li class="list-group-item">And a fifth one</li>
                        </ul>
                        <div class="dropdown mt-3">
                            <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                kategori
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Nori</a>
                                <a class="dropdown-item" href="#">Snack </a>
                                <a class="dropdown-item" href="#">Sayur </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Pilihan Lainnya</a>
                            </div>
                        </div>
                    </div>

                    <div class=" card-body">
                        <h3 class="mt-2">Promo spesial</h3>
                        <hr style="border-color: red; border-width: 3px;">
                        <img src="#" alt="Banner Promo ">
                    </div>
                </div>
            </div>
            <div class="col-10">
                <!-- search inputan Desktop -->
                <div class="container col-12 d-none d-md-block">
                    <input type="search" class="form-control" id="search-input" placeholder="Cari produk disini">
                    <div id="search-results"></div>
                </div>
                <script>
                    // Simulasi data produk (contoh)
                    const products = [
                        "produk 1",
                        "produk 2",
                        "produk 3",
                        "produk 4",
                        "produk 5",

                    ];

                    const searchInput = document.getElementById("search-input");
                    const searchResults = document.getElementById("search-results");

                    // Fungsi untuk melakukan pencarian
                    function performSearch(query) {
                        // Bersihkan hasil pencarian sebelumnya
                        searchResults.innerHTML = "";

                        // Loop melalui daftar produk dan tambahkan hasil yang cocok
                        products.forEach((product) => {
                            if (product.toLowerCase().includes(query.toLowerCase())) {
                                const resultItem = document.createElement("div");
                                resultItem.textContent = product;
                                searchResults.appendChild(resultItem);
                            }
                        });

                        // Tampilkan pesan jika tidak ada hasil
                        if (searchResults.children.length === 0) {
                            const noResults = document.createElement("div");
                            noResults.textContent = "Tidak ada hasil yang ditemukan.";
                            searchResults.appendChild(noResults);
                        }
                    }

                    // Event listener untuk pembaruan input pencarian
                    searchInput.addEventListener("input", () => {
                        const query = searchInput.value;
                        performSearch(query);
                    });
                </script>
                <!-- Button Kategori -->
                <?= $this->include('user/produk/component/kategori') ?>
                <!-- Button Sub Kategori -->
                <?= $this->include('user/produk/component/subkategori') ?>
                <!-- Card -->
                <?= $this->include('user/produk/component/card') ?>
            </div>
        </div>
    </div>
</div>

<!-- tampilan Mobile dan Ipad -->
<div class="container  d-lg-none mb-4">
    <!-- Button Kategori -->
    <?= $this->include('user/produk/component/kategori') ?>
    <!-- Button Sub Kategori -->
    <?= $this->include('user/produk/component/subkategori') ?>
    <!-- Card -->
    <?= $this->include('user/produk/component/card') ?>
</div>




<!-- button Scroll Up -->
<button class="btn btn-danger" id="scrollUpButton" title="Scroll to top"><i class="fas fa-arrow-up"></i></button>





<!-- END -->
<?= $this->endSection(); ?>