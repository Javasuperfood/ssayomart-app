<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">Form Edit Sub Kategori</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form method="POST" enctype="multipart/form-data" action="<?= base_url(); ?>dashboard/kategori/edit-sub-kategori/update">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_sub_kategori" value="<?= $subkategori['id_sub_kategori']; ?>">
            <div class="mb-3">
                <label for="kategori" class="form-label">Nama Kategori atau Sub Kategori</label>
                <input type="text" class="form-control <?= (validation_show_error('nama_kategori')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kategori" placeholder="Masukan nama kategori" name="kategori" value="<?= $subkategori['nama_kategori'] ?>" pattern="[0-9]{0}{3}">
                <div class="invalid-feedback"><?= validation_show_error('nama_kategori'); ?></div>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input required type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= $subkategori['slug'] ?>">
                <span id="slugError" class="text-danger"></span>
            </div>

            <label for="parent_kategori_id">Kategori Induk</label>
            <select class="form-control border-0 shadow-sm" id="parent_kategori_id" name="parent_kategori_id">
                <?php foreach ($kategori_model as $km) : ?>
                    <option value="<?= $km['id_kategori']; ?>" <?= ($subkategori['id_sub_kategori'] == $km['id_kategori']) ? 'selected' : ''; ?>><?= $km['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>

            <div class="mb-3">
                <label for="img" class="form-label">Masukan Gambar</label>
                <input type="file" class="form-control <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" value="<?= $subkategori['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $subkategori['img']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi" name="deskripsi"><?= $subkategori['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>

            <div>
                <button type="submit" class="btn btn-danger mt-3">Simpan</button>
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