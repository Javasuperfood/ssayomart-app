<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-medium">Edit Banner</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/banner/tambah-banner/edit/<?= $bl['id_banner']; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_produk" name="id_produk" value="<?= $bl['id_banner'] ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $bl['title'] ?>">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar Banner</label>
                <input type="file" class="form-control" id="img" name="img" value="<?= $bl['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $bl['img']; ?>">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>