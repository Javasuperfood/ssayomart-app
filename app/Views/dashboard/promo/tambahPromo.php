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

<?= $this->endSection(); ?>