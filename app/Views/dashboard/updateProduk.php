<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-medium">Edit Produk</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/tambah-produk/edit-produk/<?= $km['id_produk']; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_produk" name="id_produk" required value="<?= $km['id_produk'] ?>">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required value="<?= $km['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="harga_produk" class="form-label">Harga Produk</label>
                <input type="price" class="form-control" id="harga_produk" name="harga_produk" required value="<?= $km['harga'] ?>">
            </div>
            <div class="mb-3">
                <label for="stock_produk" class="form-label">Stock Produk</label>
                <input type="number" class="form-control" id="stock_produk" name="stock_produk" required value="1">
            </div>
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                <input type="text" style="height: 100px;" class="form-control" id="deskripsi_produk" name="deskripsi_produk" required value="<?= $km['deskripsi'] ?>" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="gambar_produk" class="form-label">Gambar</label>
                <input type="file" accept="image/*" class="form-control" id="gambar_produk" name="gambar_produk" required value="<?= $km['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $km['img']; ?>">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>