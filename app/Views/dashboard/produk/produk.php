<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Produk</h1>
<p class="mb-3">Halaman ini dapat menampilkan produk dari ssayomart market disini anda sebagai admin dapat mengatur dan menglola produk yang akan tampil pada halaman user berikan produk terbaikmu
</p>

<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <div class="card-body d-flex">
                    <div class="col-9 text-center">
                        <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">
                            Total Produk: <?= $totalProduk; ?>
                        </span>
                    </div>
                    <div class="col-3 text-center">
                        <i class="bi bi-box-seam fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <a class="btn btn-outline-danger mb-4" href="<?= base_url(); ?>dashboard/produk/tambah-produk"><i class="bi bi-plus-square"></i> Tambah Produk</a>
        <a class="btn btn-outline-danger mb-4" href="#" data-toggle="modal" data-target="#deleteBatchModal" id="btnDelete" style="display: none;">
            <i class="bi bi-trash-fill"></i>
            Delete
        </a>
    </div>
    <div class="col text-end">
        <form action="<?= base_url('dashboard/produk'); ?>" method="get">
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Cari... (Nama Produk atau SKU)" aria-label="search" name="search" aria-describedby="search">
                <!-- Add category search input -->
                <input type="text" class="form-control" placeholder="Cari berdasarkan Kategori" aria-label="category_search" name="category_search" aria-describedby="category_search">
                <button class="btn btn-outline-danger" type="submit" id="search"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="card border-1 shadow-sm mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-text-fill"></i>
        <h6 class="m-0 fw-bold px-2">List Produk</h6>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class=" form-check-label" for="checkProduk">
                                            No
                                        </label>
                                    </div>
                                </th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori Produk</th>
                                <th>Sub Kategori</th>
                                <th>Varian & Stok Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $key => $km) : ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="check_id[]" value="<?= $km['id_produk']; ?>" id="checkProduk_<?= $km['id_produk']; ?>" onchange="checkProduk(this.value)">
                                            <label class="form-check-label" for="checkProduk">
                                                <?= $iterasi++; ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <img src="<?= base_url('assets/img/produk/main/' . $km['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                    </td>
                                    <td class="align-middle"><?= $km['nama']; ?></td>
                                    <td class="align-middle">
                                        <?php
                                        $kategoriNama = '';
                                        foreach ($kategori as $k) {
                                            if ($k['id_kategori'] == $km['id_kategori']) {
                                                $kategoriNama = $k['nama_kategori'];
                                            }
                                        }
                                        echo ($kategoriNama !== '' ? $kategoriNama : 'Kategori Tidak Ditemukan');
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php
                                        $subKategoriNama = '';

                                        foreach ($pa['sub_kategori'] as $sub_kategori_item) {
                                            if ($sub_kategori_item['id_sub_kategori'] == $km['id_sub_kategori']) {
                                                $subKategoriNama = $sub_kategori_item['nama_kategori'];
                                            }
                                        }

                                        echo ($subKategoriNama !== '' ? $subKategoriNama : 'Sub Kategori Tidak Ditemukan');
                                        ?>
                                    </td>


                                    <td class="align-middle">
                                        <?php foreach ($variasiItem as $keyv => $v) : ?>
                                            <?php if ($key == $keyv) : ?>
                                                <?php foreach ($v as $keyvv => $vv) : ?>
                                                    <?= $vv['value_item']; ?> <?= (isset($stok[$keyv][$keyvv]['stok'])) ? ' ( Stok : <b>' . $stok[$keyv][$keyvv]['stok'] . '</b> )' : '( Stok belum di-update )'; ?><br>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="nav-item dropdown no-arrow">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <!-- Dropdown - User Information -->
                                            <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                <a class="dropdown-item" href="<?= base_url() ?>produk/<?= $km['slug']; ?>">
                                                    <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Lihat Produk
                                                </a>
                                                <a class="dropdown-item" href="<?= base_url() ?>dashboard/produk/detail-varian/<?= $km['slug']; ?>">
                                                    <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Detail Varian
                                                </a>
                                                <a class="dropdown-item" href="<?= base_url(); ?>dashboard/produk/update-produk/<?= $km['id_produk']; ?>/?page=<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                                                    <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Update
                                                </a>
                                                <a class="dropdown-item" href="<?= base_url(); ?>dashboard/update-stok/<?= $km['slug']; ?>?page=<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                                                    <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Stok
                                                </a>
                                                <div class="dropdown-divider"></div>

                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteProduk<?= $km['id_produk']; ?>">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Delete</span>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- ================= START MODAL DELETE SINGLE PRODUK ================== -->
                                        <div class="modal fade" id="deleteProduk<?= $km['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProduk<?= $km['id_produk']; ?>" aria-hidden="true">
                                            <div class="modal-dialog text-start text-secondary" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteProduk<?= $km['id_produk']; ?>">Delete <?= $km['nama']; ?> ?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Pilih Delete untuk Menghapus Produk <?= $km['nama']; ?></div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <form action="<?= base_url() ?>dashboard/produk/delete-produk/<?= $km['id_produk']; ?>" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="pager" value="<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                                                            <button type="submit" onclick="clickSubmitEvent(this)" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (!$produk) :  ?>
                                <tr>
                                    <td colspan="6" class="text-center">Produk tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('produk', 'pagerS'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= Start Modal deleted chacked ===================== -->
<div class="modal fade" id="deleteBatchModal" tabindex="-1" role="dialog" aria-labelledby="deleteBatchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBatchModal">Delete Checked Produk ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih Delete untuk Menghapus Produk yang dicheck</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="<?= base_url('dashboard/produk/delete-batch'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="pager" value="<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                    <div id="fieldDelete">
                    </div>
                    <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ================= End Modal deleted chacked ===================== -->

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


    var checkAll = document.getElementById('checkAll');
    var checkboxes = document.getElementsByName('check_id[]');
    checkAll.addEventListener('change', function() {
        var isChecked = checkAll.checked;
        if (isChecked) {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = isChecked;
                createInputField(true, 'fieldDelete', checkboxes[i].value)
            }
            btnDelete(true);
        } else {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = isChecked;
                createInputField(false, 'fieldDelete', checkboxes[i].value)
            }
            btnDelete(false);
        }
    });

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var atLeastOneChecked = false;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    atLeastOneChecked = true;
                }
            });
            if (atLeastOneChecked) {
                btnDelete(true);
            } else {
                btnDelete(false);
            }
        });
    });

    function checkProduk(id) {
        var checkbox = document.getElementById('checkProduk_' + id);
        if (checkbox.checked) {
            createInputField(true, 'fieldDelete', id)
        } else {
            createInputField(false, 'fieldDelete', id)
        }
    }


    function btnDelete(a) {
        if (a) {
            $("#btnDelete").show()
        } else {
            $("#btnDelete").hide()
        }
    }

    function createInputField(create, appendLocId, id) {
        if (create) {
            var inputField = document.getElementById('produk_id_' + id);
            if (!inputField) {
                var inputElement = document.createElement('input');
                inputElement.setAttribute('type', 'hidden');
                inputElement.setAttribute('name', 'produk_id[]');
                inputElement.setAttribute('id', 'produk_id_' + id);
                inputElement.setAttribute('value', id);
                var fieldDelete = document.getElementById(appendLocId);
                fieldDelete.appendChild(inputElement);
            }
        } else {
            var inputField = document.getElementById('produk_id_' + id);
            if (inputField) {
                inputField.remove();
            }
        }
    }
</script>




<?= $this->endSection(); ?>