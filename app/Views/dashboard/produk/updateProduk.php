<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 text-danger"><b>Edit Produk</b></h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/update-produk/save" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="slug" value="<?= $p['slug'] ?>">
            <input type="text" class="form-control border-0 shadow-sm d-none" name="id_produk" value="<?= $p['id_produk'] ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= (old('nama')) ? old('nama') : $p['nama'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-3">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-0'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= (old('sku')) ? old('sku') : $p['sku'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-3">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .."><?= (old('deskripsi')) ? old('deskripsi') : $p['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar</label>
                <input type="file" accept="image/*" style="border: none;" class="form-control border-0 shadow-sm" id="img" name="img">
                <span id="imgError" class="text-danger"></span>
                <input type="hidden" name="imageLama" value="<?= $p['img']; ?>">
            </div>

            <div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>
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
</script>
<?= $this->endSection(); ?>