<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Produk Promosi Ssayomart</h1>
<p class="mb-3">Halaman ini menampilkan promosi produk-produk dari Ssayomart.
</p>

<div class="row">
    <div class="col">

        <a class="btn btn-danger mb-4" href="<?= base_url(); ?>dashboard/promo/tambah-promo-item-batch"><i class="bi bi-plus-square"></i> Tambah Promo Produk</a>
        <a class="btn btn-danger mb-4" href="#" data-toggle="modal" data-target="#deleteBatchModal" id="btnDelete" style="display: none;">
            <i class="bi bi-trash-fill"></i>
            Delete
        </a>
    </div>
</div>
<?php if ($ongoingPromoItems != null) : ?>
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header d-flex justify-content-start align-items-center border-0 py-3">
            <i class="bi bi-file-text-fill"></i>
            <h6 class="m-0 fw-bold px-2">List Produk Promosi</h6>
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
                                            <label class=" form-check-label" for="checkPromo">
                                                No
                                            </label>
                                        </div>
                                    </th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>SKU</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($ongoingPromoItems as $p) : ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="check_id[]" value="<?= $p['id_promo_item_batch']; ?>" id="checkPromo_<?= $p['id_promo_item_batch']; ?>" onchange="checkPromo(this.value)">
                                                <label class="form-check-label" for="checkPromo">
                                                    <?= $i++; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <img src="<?= base_url('assets/img/produk/main/' . $p['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                        </td>
                                        <td class="align-middle"><?= $p['nama']; ?></td>
                                        <td class="align-middle"><?= $p['sku']; ?></td>
                                        <td class="text-center align-middle">
                                            <div class="nav-item dropdown no-arrow">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <!-- Dropdown - User Information -->
                                                <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                    <a class="dropdown-item" href="<?= base_url(); ?>dashboard/promo/tambah-promo/show-promo/edit/<?= $p['id_promo_item_batch']; ?>">
                                                        <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Edit Produk
                                                    </a>
                                                    <form action="<?= base_url() ?>dashboard/promo/tambah-promo/show-promo/delete/<?= $p['id_promo_item_batch']; ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="dropdown-item" onclick="clickSubmitEvent(this)">
                                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                            <span class="text-danger">Delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= Start Modal delete checked ===================== -->
        <div class="modal fade" id="deleteBatchModal" tabindex="-1" role="dialog" aria-labelledby="deleteBatchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteBatchModal">Delete Checked Products?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih delete untuk menghapus produk yang dicentang.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="<?= base_url() ?>dashboard/promo/tambah-promo/show-promo/delete-promo-batch/<?= $ongoingPromoItems[0]['id_promo']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id_promo" value="<?= $ongoingPromoItems[0]['id_promo']; ?>">
                            <div id="fieldDelete">
                            </div>
                            <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)"> <i class="bi bi-trash-fill"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================= End Modal delete checked ===================== -->
<?php else : ?>
    <div class="alert alert-danger text-center" role="alert">
        Tidak ada promo yang sedang berlangsung. Tambahkan produk promo terlebih dahulu.
    </div>
<?php endif; ?>

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

    function checkPromo(id) {
        var checkbox = document.getElementById('checkPromo_' + id);
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
            var inputField = document.getElementById('promo_id_' + id);
            if (!inputField) {
                var inputElement = document.createElement('input');
                inputElement.setAttribute('type', 'hidden');
                inputElement.setAttribute('name', 'promo_id[]');
                inputElement.setAttribute('id', 'promo_id_' + id);
                inputElement.setAttribute('value', id);
                var fieldDelete = document.getElementById(appendLocId);
                fieldDelete.appendChild(inputElement);
            }
        } else {
            var inputField = document.getElementById('promo_id_' + id);
            if (inputField) {
                inputField.remove();
            }
        }
    }
</script>
<?= $this->endSection(); ?>