<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Edit Variasi Produk</h1>

<div class="card border-1 shadow-sm position-relative">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-pencil-square"></i>
        <h6 class="m-0 fw-bold px-2">Edit Variasi Produk</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-variasi/edit-variasi/<?= $v['id_variasi']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_variasi" name="id_variasi" value="<?= $v['id_variasi'] ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Variasi</label>
                <input type="text" class="form-control <?= (validation_show_error('nama_varian')) ? 'is-invalid' : 'border-1'; ?>" id="nama_varian" name="nama_varian" value="<?= $v['nama_varian'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama_varian'); ?></div>
            </div>
            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>