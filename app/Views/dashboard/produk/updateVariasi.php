<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 text-danger"><b>Edit Variasi</b></h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-variasi/edit-variasi/<?= $v['id_variasi']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_variasi" name="id_variasi" value="<?= $v['id_variasi'] ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Variasi</label>
                <input type="text" class="form-control <?= (validation_show_error('nama_varian')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="nama_varian" name="nama_varian" value="<?= $v['nama_varian'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama_varian'); ?></div>
            </div>
            <div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>