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
                    <div class="col mr-2">
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
                    </div>
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
        <div class="card border-0 shadow-sm mb-4">
            <!-- Card Header - Accordion -->
            <div class="card-header border-0 py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 text-danger"> Nama Produk : <span class="font-weight-bold"><?= $produk['nama']; ?></span></h6>
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
            <a href="#stock" class="d-block card-header border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="stock">
                <h6 class="m-0 font-weight-bold text-danger">Stock</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="stock">
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        Saat ini anda sedang update stok produk <span id="produkText" class="fw-bold">Produk varian Tidak ditemukan tambahkan varian terlebih dahulu <a href="<?= base_url('dashboard/produk/detail-varian/' . $produk['slug']); ?>">disini</a></span> pada market <span id="marketText" class="fw-bold">{{market}}</span>
                    </div>
                    <form action="<?= base_url('dashboard/update-stok/update'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="produk" value="<?= $produk['id_produk']; ?>">
                        <input type="hidden" name="slug" value="<?= $produk['slug']; ?>">
                        <input type="hidden" name="page" value="<?= (isset($_GET['page']) ? $_GET['page'] : '1'); ?>">
                        <?php foreach ($stock as $s) : ?>
                            <input type="hidden" name="id_stok[]" value="<?= $s['id_stock']; ?>">
                        <?php endforeach; ?>
                        <div class="row row-cols-1" id="rowStock">
                            <div class="col">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="Market" name="market">
                                        <?php foreach ($market as $m) : ?>
                                            <option value="<?= $m['id_toko']; ?>"><?= $m['city'] . ' - ' . $m['zip_code']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="Market">Market</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating my-3">
                                    <select class="form-select" id="Produk" name="variasi_item">
                                        <?php foreach ($variasi as $key => $v) : ?>
                                            <option value="<?= $v['id_variasi_item']; ?>"><?= $produk['nama'] . ' - ' . $v['value_item'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="Produk">Produk</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating my-3">
                                    <input type="number" class="form-control" id="floatingStock" placeholder="Stok" name="stok">
                                    <label for="floatingStock">Stok</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="my-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-danger" id="btnUpdateStock" onclick="clickSubmitEvent(this)">Update Stok</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', function() {
        var marketText = document.getElementById('marketText');
        var market = document.getElementById('Market');
        marketText.textContent = market.options[market.selectedIndex].text;
        market.addEventListener('change', function() {
            marketText.textContent = market.options[market.selectedIndex].text;
        });
        var produkText = document.getElementById('produkText');
        var produk = document.getElementById('Produk');
        produkText.textContent = produk.options[produk.selectedIndex].text;
        produk.addEventListener('change', function() {
            produkText.textContent = produk.options[produk.selectedIndex].text;
        })
    })
</script>
<?= $this->endSection(); ?>