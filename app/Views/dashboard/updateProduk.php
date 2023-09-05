<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-medium">Form Edit Produkt</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/tambah-produk/edit-produk/<?= $km['id_produk']; ?>" method="post">
            <input type="hidden" class="form-control" id="id_produk" name="id_produk" value="<?= $km['id_produk'] ?>">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $km['nama'] ?>">
            </div>
            <!-- <div class="mb-3">
                            <label for="tanggal_exp" class="form-label">Tanggal EXP</label>
                            <input type="date" class="form-control" id="tanggal_exp" name="tanggal_exp" placeholder="EXP">
                        </div> -->
            <div class="mb-3">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="price" class="form-control" id="harga_produk" name="harga_produk" value="<?= $km['harga'] ?>">
            </div>
            <!-- <div class="mb-3">
                            <label for="kategori_produk" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" placeholder="Kategori">
                        </div> -->
            <div class="mb-3">
                <label for="stock_produk" class="form-label">Stock Produk</label>
                <input type="price" class="form-control" id="stock_produk" name="stock_produk" value="<?= $km['stok'] ?>">
            </div>
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" value="<?= $km['deskripsi'] ?>" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="gambar_produk" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar_produk" name="gambar" value="<?= $km['img'] ?>">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>