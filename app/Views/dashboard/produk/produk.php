<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Produk</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item text-danger active">List Produk</li>
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/produk/tambah-produk">Tambah Produk</a></li>
</ul>
<p class="mb-3">Halaman ini dapat menampilkan produk dari ssayomart market disini anda sebagai admin dapat mengatur dan menglola produk yang akan tampil pada halaman user berikan produk terbaikmu
</p>

<div class="row">
    <div class="col">
        <a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/produk/tambah-produk"><i class="bi bi-plus-square"></i> Tambah Produk</a>
        <a class="btn btn-danger mb-3" href="#" data-toggle="modal" data-target="#deleteBatchModal" id="btnDelete" style="display: none;">
            <i class="bi bi-trash-fill"></i>
            Delete
        </a>
    </div>
    <div class="col text-end">
        <form action="<?= base_url('dashboard/produk'); ?>" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="search (nama produk)" aria-label="search" name="search" aria-describedby="search">
                <button class="btn btn-outline-danger" type="submit" id="search">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Produk</h6>
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
                                <th>Kategori/Subkategori</th>
                                <th>Varian & Stok Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $key => $km) : ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="check_id[]" value="<?= $km['id_produk']; ?>" id="checkProduk_<?= $km['id_produk']; ?>" onchange="checkProduk(this.value)">
                                            <label class="form-check-label" for="checkProduk">
                                                <?= $iterasi++; ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="<?= base_url('assets/img/produk/main/' . $km['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                    </td>
                                    <td><?= $km['nama']; ?></td>
                                    <td>
                                        <?php
                                        $kategoriNama = '';
                                        $subKategoriNama = '';
                                        foreach ($kategori as $k) {
                                            if ($k['id_kategori'] == $km['id_kategori']) {
                                                $kategoriNama = $k['nama_kategori'];
                                                if ($km['id_sub_kategori'] != null) {
                                                    foreach ($subKategori as $s) {
                                                        if ($s['id_sub_kategori'] == $km['id_sub_kategori']) {
                                                            $subKategoriNama = $s['nama_kategori'];
                                                            break;
                                                        }
                                                    }
                                                }
                                                break;
                                            }
                                        }
                                        echo ($kategoriNama !== '' ? $kategoriNama . ($subKategoriNama !== '' ? '<br>(' . $subKategoriNama . ')' : '') : 'Kategori Tidak Ditemukan');
                                        // echo ($kategoriNama !== '') ? $kategoriNama . '<br>(' . $subKategoriNama . ')' : 'Kategori Tidak Ditemukan';
                                        ?>
                                    </td>
                                    <td>
                                        <?php foreach ($variasiItem as $keyv => $v) : ?>
                                            <?php if ($key == $keyv) : ?>
                                                <?php foreach ($v as $keyvv => $vv) : ?>
                                                    <?= $vv['value_item']; ?> <?= (isset($stok[$keyv][$keyvv]['stok'])) ? ' ( Stok :' . $stok[$keyv][$keyvv]['stok'] . ' )' : ''; ?><br>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td class="text-center">
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
                                                            <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->

                                    </td>
                                </tr>
                        </tbody>
                    <?php endforeach; ?>
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