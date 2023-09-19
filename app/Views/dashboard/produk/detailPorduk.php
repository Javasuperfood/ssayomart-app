<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Detail</h1>
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
                        <i class="bi bi-shop fa-2x text-gray-300"></i>
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
                        <i class="bi bi-shop fa-2x text-gray-300"></i>
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
                            Is Active</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($produk['is_active'] == 1) ? 'Active' : 'Deactive'; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-shop fa-2x text-gray-300"></i>
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
                            Total Stok</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{stok}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-shop fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-danger"><?= $produk['nama']; ?></h6>
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
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/produk/main/' . $produk['img']); ?>" alt="..." class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?= $produk['nama']; ?></h5>
                                <p class="card-text"><?= $produk['deskripsi']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
            <!-- Card Header - Accordion -->
            <a href="#Variasi" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="Variasi">
                <h6 class="m-0 font-weight-bold text-danger">Variasi & Stock</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="Variasi">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="pb-3">
                                <button id="btnTambah" class="btn btn-outline-info">Tambah varian</button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="rowVarian">
                        <div class="col">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Variasi</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Berat (gram)</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col"><i class="bi bi-three-dots-vertical"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($varian as $v) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <th>{{Stok}}</th>
                                            <td><?= $v['nama_varian']; ?></td>
                                            <td><?= $v['value_item']; ?></td>
                                            <td><?= $v['berat']; ?></td>
                                            <td><?= $v['harga_item']; ?></td>
                                            <td>
                                                <div class="nav-item dropdown no-arrow">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <!-- Dropdown - User Information -->
                                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                        <a class="dropdown-item" href="https://ssayomart-app.test/dashboard/produk/tambah-produk/update-produk/1">
                                                            <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Update
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="<?= base_url('dashboard/produk/detail-varian/delete-varian/' . $v['id_variasi_item']); ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                                <span class="text-danger">Delete</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="rowTambah" style="display: none;">
                        <div class="col">
                            <form action="<?= base_url('dashboard/produk/detail-varian/tambah-variasi-item'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                                <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Stok</label>
                                    <input type="price" class="form-control" id="harga" name="harga" placeholder="Stok" value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                                    <span id="hargaError" class="text-danger"></span>
                                </div>
                                <?php if ($varian) : ?>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="selectVariant">Nama Variant</label>
                                                <input type="text" disabled id="selectVariant" name="variant" class="form-control" value="<?= $varian[0]['nama_varian']; ?>">
                                                <input type="hidden" id="selectVariant" name="id_variant" class="form-control" value="<?= $varian[0]['id_variasi']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="valueVariant">Value Variant</label>
                                                <input type="text" id="valueItem" name="valueItem" class="form-control" placeholder="Value Varian">
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="selectVariant">Pilih Variant</label>
                                                <select class="form-control" name="selectVariant" id="selectVariant">
                                                    <option selected>Pilih</option>
                                                    <?php foreach ($variasi as $v) : ?>
                                                        <option value="<?= $v['id_variasi']; ?>"><?= $v['nama_varian']; ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="valueVariant">Value Variant</label>
                                                <input type="text" id="valueItem" name="valueItem" class="form-control" placeholder="Value Varian">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="mb-3">
                                    <label for="berat" class="form-label">Berat Produk (*Satuan Gram)</label>
                                    <input type="price" class="form-control" id="berat" name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                                    <span id="beratError" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Produk</label>
                                    <input type="price" class="form-control" id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                                    <span id="hargaError" class="text-danger"></span>
                                </div>
                                <button type="submit" class="btn btn-danger">Simpan</button><a role="button" id="btnBatal" class="btn btn-outline-info">Batal</a>
                            </form>
                        </div>
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
    $("#rowVarian").hide
</script>
<?= $this->endSection(); ?>