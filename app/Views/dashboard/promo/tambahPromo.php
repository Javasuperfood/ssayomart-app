<?php

use CodeIgniter\Filters\CSRF;
?>
<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="d-flex">
    <!-- Left Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 fw-bold px-2">Buat Promo</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/promo/tambah-promo/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-4">
                        <label for="title" class="form-label">Judul Promosi <span class=" text-secondary">(Cth : Promo Lebaran, Promo Natal Promo Nyepi, dll)</span></label>
                        <input type="text" class="form-control border-0 shadow-sm  <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" placeholder="Judul Promosi Anda..." value="<?= old('title') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
                    </div>

                    <div class="mb-4">
                        <label for="slug" class="form-label">Slug</label>
                        <div class="alert alert-danger text-center border-1 shadow-sm mb-4" role="alert">
                            <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Judul Promo.</b>
                        </div>
                        <input type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukkan Slug... (Boleh Kosong)" name="slug" value="<?= old('slug') ?>">
                    </div>

                    <div class="mb-4">
                        <label for="started" class="form-label">Waktu Mulai Promo</label>
                        <input type="datetime-local" class="form-control border-0 shadow-sm  <?= (validation_show_error('started')) ? 'is-invalid' : 'border-1'; ?>" name="started" id="started" value="<?= old('started') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('started'); ?></div>
                    </div>

                    <div class="mb-4">
                        <label for="ended" class="form-label">Waktu Berakhir Promo</label>
                        <input type="datetime-local" class="form-control border-0 shadow-sm  <?= (validation_show_error('ended')) ? 'is-invalid' : 'border-1'; ?>" name="ended" id="ended" value="<?= old('ended') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('ended'); ?></div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi Promo (Optional)</label>
                        <textarea class="form-control border-0 shadow-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi Promo Anda .." value="<?= old('deskripsi') ?>"></textarea>
                    </div>

                    <div class="mb-4">
                        <div class="alert alert-danger text-center border-1 shadow-sm" role="alert">
                            <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                        </div>
                        <label for="img" class="form-label">Masukan Gambar/Foto/Icon Promo</label>
                        <input type="file" class="form-control border-0 shadow-sm  <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" placeholder="Masukan Gambar Promosi">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>
                    <div class="mb-4">
                        <label for="img" class="form-label">Masukan Gambar/Foto/Icon Promo (Opsional)</label>
                        <input type="file" class="form-control border-0 shadow-sm  <?= (validation_show_error('img_2')) ? 'is-invalid' : 'border-1'; ?>" id="img_2" name="img_2">
                        <div class="invalid-feedback"><?= validation_show_error('img_2'); ?></div>
                    </div>
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Promo Produk Ssayomart</h6>
            </div>

            <div class="card-body">
                <form action="<?= base_url('dashboard/promo/tambah-promo/save-promo') ?>" method="post" id="mainForm">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_produk" id="selectedProductId" value="">
                    <input type="hidden" name="id_promo" id="selectedPromoId" value="">
                    <div class="mb-4">
                        <label for="id_promo" class="form-label">Pilih Promo Tersedia</label>
                        <select name="id_promo" id="promo" class="form-control border-1" data-toggle="tooltip" data-placement="bottom" title="Klik untuk memilih promo produk yang anda inputkan">
                            <?php foreach ($promo as $item) : ?>
                                <option value="<?= $item['id_promo']; ?>"><?= $item['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span id="promoError" class="text-danger"></span>
                    </div>
                    <div class="mb-4">
                        <label>Pilih Promo Produk</label>
                        <button type="button" class="btn btn-outline-dark d-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Select a product
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">List Promo Produk Ssayomart</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- Search Form -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Cari... (Nama Produk atau SKU)" aria-label="search" name="search_product" id="search_product" onkeyup="liveSearch()">
                                    </div>
                                    <!-- Search Results -->
                                    <table class="table" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Nama</th>
                                                <th>SKU</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; ?>
                                            <?php foreach ($produkSearch as $p) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <input type="radio" value="<?= $p['id_produk']; ?>" name="selected_product" onclick="selectProduct(this)">
                                                            <div class="ms-2"><?= $counter++; ?></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <img src="<?= base_url('assets/img/produk/main/' . ($p['img'])); ?>" class="img-fluid" alt="" width="50" height="50">
                                                    </td>
                                                    <td><?= $p['nama']; ?></td>
                                                    <td><?= $p['sku']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



                <?php foreach ($promoProduk as $pp) : ?>
                    <form action="<?= base_url('dashboard/promo/tambah-promo/save-produk-bundle') ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_promo_produk" value="<?= $pp['id']; ?>">
                        <input type="hidden" name="id_produk" value="<?= $pp['id_produk']; ?>">
                        <input type="hidden" name="produk_id" value="">
                        <div class="mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">SKU</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <?php $counter = 1; ?>
                                <tbody>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/img/produk/main/' . ($pp['img'])); ?>" class="img-fluid" alt="" width="50" height="50">
                                        </td>
                                        <td class="text-center"><?= $pp['nama']; ?></td>
                                        <td class="text-center"><?= $pp['sku']; ?></td>
                                        <td>
                                            <div class="d-flex flex-column align-items-end">

                                                <button type="button" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $pp['id_produk']; ?>" id="btnChooseProducts">Create Bundle</button>
                                                <!-- Modal Box Produk -->
                                                <div class="modal fade" id="exampleModal<?= $pp['id_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <div id="selectedProds2" style="font-size: 13px;"></div>
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
                                                                                                <input onchange="selectCheck(this, '<?= $item['nama']; ?>')" type="checkbox" id="produkCheckbox<?= $item['id_produk']; ?>" value="<?= $item['id_produk']; ?>" data-nama="<?= $item['nama']; ?>" class="border-0" style="width: 30px;">
                                                                                            </div>
                                                                                            <div class="col-3">
                                                                                                <img src="<?= base_url('assets/img/produk/main/' . $item['img']); ?>" alt="<?= $item['nama']; ?>" class="img-fluid" style="width:100px; height:100px; object-fit: contain; object-position: 20% 10%;">
                                                                                            </div>
                                                                                            <div class="col-8">
                                                                                                <p class="nama-produk" style="font-size: 12px;"><?= $item['nama']; ?></p>
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
                                                                <button type="submit" class="btn btn-danger text-center" data-bs-dismiss="modal">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="fw-bold text-uppercase text-center">Bundling Promo
                                            <!-- Span Badge Produk Terpilih -->
                                            <div class="mb-4">
                                                <!-- <label for="produk" class="form-label">Produk-Produk Terpilih</label> -->
                                                <div id="selectedProds1<?= $pp['id_produk']; ?>" style="font-size: 13px;"></div>
                                                <span id="produkError" data-toggle="tooltip" data-placement="bottom" title="produk yang di pilih" class="text-danger"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table class="table mb-0 table-light">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Image</th>
                                                        <th>Nama</th>
                                                        <th>SKU</th>
                                                    </tr>
                                                </thead>
                                                <?php $i = 1; ?>
                                                <?php foreach ($produkBundle as $pb) : ?>
                                                    <?php if ($pb['id_main_produk'] == $pp['id_produk']) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td>
                                                                <img src="<?= base_url('assets/img/produk/main/' . ($p['img'])); ?>" class="img-fluid" alt="" width="50" height="50">
                                                            </td>
                                                            <td><?= $pb['nama_produk']; ?></td>
                                                            <td><?= $pb['sku']; ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <form action="<?= base_url() ?>dashboard/promo/tambah-promo/delete-promo-produk/<?= $pp['id']; ?>" method="post" class="d-block my-3">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                <?php endforeach; ?>
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
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if the search_product parameter is present in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const searchProduct = urlParams.get('search_product');

        if (searchProduct) {
            // If search_product is present, manually open the modal
            const myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            myModal.show();
        }
    });

    function selectProduct(radio) {
        document.getElementById('selectedProductId').value = radio.value;
    }
</script>

<script>
    function liveSearch() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search_product");
        filter = input.value.toUpperCase();
        table = document.getElementById("productTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; // Index 2 corresponds to the column containing product name
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


<script>
    var arrayProduk = [];

    function selectCheck(e, nameProduk) {
        const produkChecked = e.value;
        // console.log(produkChecked)
        // console.log(arrayProduk)
        const isAlreadyChecked = arrayProduk.some(ap => ap[0] === produkChecked);
        if (!e.checked || isAlreadyChecked) {
            arrayProduk = arrayProduk.filter(ap => ap[0] !== produkChecked);
        } else {
            addValue(produkChecked, nameProduk);
        }

        const $inputProduk = $('#inputproduk');
        const $selectedProds1 = $('#selectedProds1');
        const $selectedProds2 = $('#selectedProds2');
        $inputProduk.empty();
        $selectedProds1.empty();
        $selectedProds2.empty();
        arrayProduk.forEach(function([value, nama]) {
            $inputProduk.append(`<input type="hidden" name="produk_id[]" value="${value}">`);
            $selectedProds1.append(`<span class="badge rounded-pill text-bg-danger mb-2 px-2 py-2 mx-1">${nama}</span>`);
            $selectedProds2.append(`<span class="badge rounded-pill text-bg-danger mb-2 px-2 py-2 mx-1">${nama}</span>`);
        });

    }

    function addValue(value, nama) {
        arrayProduk.push([value, nama]);
    }

    function removeValue(value, nama) {
        const index = arrayProduk.findIndex(ap => ap[0] === value && ap[1] === nama);
        if (index !== -1) {
            arrayProduk.splice(index, 1);
        }
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
                $(`#productList`).empty();
                responseData.response.forEach(function(p) {
                    let checked = arrayProduk.find(ap => p.id_produk === ap[0]) !== undefined;
                    $('#productList').append(`
                         <div class="col-6 mb-3 px-3 p${p.id_produk}">
                            <div class="card border-0">
                                <div class="row g-0">
                                    <div class="card-body border-0 shadow-sm">
                                        <div class="row">
                                            <div class="col-1 d-flex justify-content-center">
                                                <input ${(checked) ? 'checked' : ''} onchange="selectCheck(this, '${p.nama}')" type="checkbox" id="produkCheckbox${p.id_produk}" value="${p.id_produk}" data-nama="${p.nama}" class="border-0" style="width: 30px;">
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