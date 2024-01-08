<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail Produk</h1>
<!-- DataTales Example -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            ID Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $produk['id_produk']; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box-seam-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            SKU</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $produk['sku']; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-upc-scan fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Status Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($produk['is_active'] == 1) ? 'Active' : 'Deactive'; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-square-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <a href="<?= base_url(); ?>dashboard/update-stok/<?= $produk['slug']; ?>" class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Stok Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if (count($stock) > 0) : ?>
                                <?php foreach ($stock as $key => $s) : ?>
                                    <?= $s['value_item'] . ' : ' . $s['stok']; ?><br>
                                <?php endforeach; ?>
                            <?php else : ?>
                                0
                            <?php endif ?>
                        </div>
                    </a>
                    <div class="col-auto">
                        <i class="bi bi-clipboard-data-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card border-1 shadow-sm mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header border-1 py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0"> Nama Produk : <span class="font-weight-bold"><?= $produk['nama']; ?></span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="<?= base_url(); ?>dashboard/produk/tambah-produk/update-produk/<?= $produk['id_produk']; ?>"><i class="bi bi-pencil-square"></i> Edit Produk</a>
                    </div>
                </div>
            </div>
            <!-- Card Content - Collapse -->
            <div class="card-body">
                <div class="card border-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/produk/main/' . $produk['img']); ?>" alt="..." class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title border-0 font-weight-bold"><?= $produk['nama']; ?></h5>
                                <p class="card-text"><?= $produk['deskripsi']; ?></p>
                                <p>
                                    <a href="<?= base_url() ?>produk/<?= $produk['slug']; ?>" class="btn btn-outline-danger">Lihat Halaman Produk</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-1 shadow-sm mb-5">
            <!-- Card Header - Accordion -->
            <a href="#Variasi" class="d-block card-header border-1 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="Variasi">
                <h6 class="m-0 fw-bold text-black">Variasi & Stock</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="Variasi">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="pb-3">
                                <button id="btnTambah" class="btn btn-outline-danger">Tambah varian</button>
                                <a href="<?= base_url() ?>dashboard/update-stok/<?= $produk['slug']; ?>" class="btn btn-outline-danger">Update stock Produk</a>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="rowVarian">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col">#</th>
                                        <th scope="col">Variasi</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Berat (gram)</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($varian as $v) : ?>
                                        <tr>
                                            <th class="align-middle" scope="row"><?= $i++; ?></th>
                                            <td class="align-middle"><?= $v['nama_varian']; ?></td>
                                            <td class="align-middle"><?= $v['value_item']; ?></td>
                                            <td class="align-middle"><?= $v['berat']; ?></td>
                                            <td class="align-middle"><?= $v['harga_item']; ?></td>
                                            <td class="align-middle">
                                                <div class="nav-item dropdown no-arrow">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <!-- Dropdown - User Information -->
                                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                        <button class="dropdown-item" onclick="btnUpdate(<?= $v['id_variasi_item']; ?>, '<?= $v['nama_varian']; ?>', '<?= $v['value_item']; ?>', <?= $v['berat']; ?>, <?= $v['harga_item']; ?>)">
                                                            <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Update
                                                        </button>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteProduk<?= $v['id_variasi_item']; ?>">
                                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                            <span class="text-danger">Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- ================= START MODAL DELETE SINGLE Variasi item ================== -->
                                                <div class="modal fade" id="deleteProduk<?= $v['id_variasi_item']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteProduk<?= $v['id_variasi_item']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog text-start text-secondary" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteProduk<?= $v['id_variasi_item']; ?>">Delete <?= $v['nama_varian']; ?> <?= $v['value_item']; ?>?</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">Pilih Delete untuk Menghapus Produk <?= $v['nama_varian']; ?> <?= $v['value_item']; ?></div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <form action="<?= base_url() ?>dashboard/produk/detail-varian/delete-varian/<?= $v['id_variasi_item']; ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                                                                    <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ================= END MODAL DELETE SINGLE Variasi item ================== -->
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="rowTambah" style="display: none;">
                        <div class="col">
                            <form action="<?= base_url('dashboard/produk/detail-varian/tambah-variasi-item'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                                <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                                <?php if ($varian) : ?>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="selectVariant">Nama Variant</label>
                                                <label for="selectVariant">Pilih Variant</label>
                                                <select class="form-control border-1" name="selectVariant" id="selectVariant">
                                                    <?php foreach ($variasi as $v) : ?>
                                                        <?php if (($varian[0]['id_variasi'] == $v['id_variasi'])) : ?>
                                                            <option value="<?= $v['id_variasi']; ?>" <?= ($varian[0]['id_variasi'] == $v['id_variasi']) ? 'selected' : '' ?>><?= $v['nama_varian']; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Garm 1Kg)</span></label>
                                                <input type="text" id="valueItem" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>" placeholder="Value Varian">
                                                <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="selectVariant">Pilih Variant</label>
                                                <select class="form-control border-1" name="selectVariant" id="selectVariant">
                                                    <option value="" selected>Pilih</option>
                                                    <?php foreach ($variasi as $v) : ?>
                                                        <option value="<?= $v['id_variasi']; ?>"><?= $v['nama_varian']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Gram 1Kg)</span></label>
                                                <input type="text" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>" placeholder="Value Varian">
                                                <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="mb-3">
                                    <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan Gram e.g : 1kg = 1000)</span></label>
                                    <input type="price" class="form-control <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-1' ?>" id="berat" name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                                    <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Produk</label>
                                    <input type="price" class="form-control <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-1'; ?>" id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                                    <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
                                </div>
                                <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)">Simpan</button><a role="button" id="btnBatal" class="btn btn-warning mx-2">Batal</a>
                            </form>
                        </div>
                    </div>
                    <div class="row" id="rowUpdate" style="display: none;">
                        <?php if ($varian) : ?>
                            <form action="<?= base_url('dashboard/produk/detail-varian/update-variasi-item'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                                <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                                <input type="hidden" name="id_vi" id="updateID">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="selectVariant">Pilih Variant</label>
                                            <select class="form-control border-1" name="selectVariant" id="selectVariant">
                                                <?php foreach ($variasi as $v) : ?>
                                                    <?php if (($varian[0]['id_variasi'] == $v['id_variasi'])) : ?>
                                                        <option value="<?= $v['id_variasi']; ?>" <?= ($varian[0]['id_variasi'] == $v['id_variasi']) ? 'selected' : '' ?>><?= $v['nama_varian']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Gram 1Kg)</span></label>
                                            <input type="text" id="updateVI" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>" placeholder="Value Varian" value="<?= old('valueItem') ?>">
                                            <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan Gram e.g : 1kg = 1000)</span></label>
                                    <input type="price" id="updateBerat" class="form-control <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-1' ?>" id="berat" <?= old('berat') ?> name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                                    <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Produk</label>
                                    <input type="price" id="updateHarga" class="form-control <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-1'; ?>" <?= old('harga') ?> id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                                    <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
                                </div>
                                <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)">Simpan</button><a role="button" id="btnBatalUpdate" class="btn btn-warning mx-2">Batal</a>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#btnTambah").click(function() {
            $("#btnTambah").hide();
            $("#rowVarian").hide();
            $("#rowTambah").show();
        });
        $("#btnBatal").click(function() {
            $("#btnTambah").show();
            $("#rowVarian").show();
            $("#rowTambah").hide();
        });

    });

    function btnUpdate(id, nama, vi, berat, harga) {
        $("#btnTambah").hide();
        $("#rowVarian").hide();
        $("#rowUpdate").show();
        $("#updateVI").val(vi);
        $("#updateBerat").val(berat);
        $("#updateHarga").val(harga);
        $("#updateID").val(id);
    };
    $("#btnBatalUpdate").click(function() {
        $("#btnTambah").show();
        $("#rowVarian").show();
        $("#rowUpdate").hide();
        $("#updateVI").empty();
        $("#updateBerat").empty();
        $("#updateHarga").empty();
        $("#updateID").empty();
    });


    $("#rowVarian").hide
    //get flash data
    <?php if (session()->getFlashdata('gagal')) : ?>
        $("#btnTambah").hide();
        $("#rowVarian").hide();
        $("#rowTambah").show();
    <?php endif ?>
    <?php if (session()->has('alert')) : ?>
        var alertData = <?= json_encode(session('alert')) ?>;
        Swal.fire({
            icon: alertData.type,
            title: alertData.title,
            text: alertData.message
        });
    <?php endif; ?>
</script>
<?= $this->endSection(); ?>