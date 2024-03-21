<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Edit Kategori</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item"><a class="text-secondary" href="<?= base_url(); ?>dashboard/kategori">List Kategori</a></li>
    <li class="breadcrumb-item text-danger active text-decoration-underline">Edit Kategori</li>
</ul>

<div class="card border-1 shadow-sm position-relative">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-pencil-square text-danger fs-5"></i>
        <h6 class="m-0 fw-bold px-2 text-dark">Form Edit Kategori</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form method="POST" name="formkategori" enctype="multipart/form-data" action="<?= base_url(); ?>dashboard/kategori/edit-kategori/update/<?= $kategori['id_kategori'] ?>">
            <?= csrf_field(); ?>

            <div class="mb-4">
                <label for="nama_kategori" class="form-label">Nama Kategori dalam bahasa Indonesia</label>
                <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kategori')) ? 'is-invalid' : 'border-1'; ?>" id="kategori" placeholder="Masukan nama kategori" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" pattern="[0-9]{0}{3}">
                <div class="invalid-feedback"><?= validation_show_error('nama_kategori'); ?></div>
            </div>
            <div class="mb-4">
                <label for="nama_kategori_kr" class="form-label">Nama Kategori dalam bahasa Korea</label>
                <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kategori_en')) ? 'is-invalid' : 'border-1'; ?>" id="kategori" placeholder="Masukan nama kategori" name="nama_kategori_en" value="<?= $kategori['nama_kategori_en'] ?>" pattern="[0-9]{0}{3}">
                <div class="invalid-feedback"><?= validation_show_error('nama_kategori_en'); ?></div>
            </div>
            <div class="mb-4">
                <label for="nama_kategori_kr" class="form-label">Nama Kategori dalam bahasa Inggris</label>
                <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kategori_kr')) ? 'is-invalid' : 'border-1'; ?>" id="kategori" placeholder="Masukan nama kategori" name="nama_kategori_kr" value="<?= $kategori['nama_kategori_kr'] ?>" pattern="[0-9]{0}{3}">
                <div class="invalid-feedback"><?= validation_show_error('nama_kategori_kr'); ?></div>
            </div>

            <!-- <div class="mb-4">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control border-0 shadow-sm border-1" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= $kategori['slug'] ?>">
                <span id="slugError" class="text-danger"></span>
            </div> -->

            <div class="mb-4">
                <label for="img" class="form-label">Masukan Gambar</label>
                <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" value="<?= $kategori['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $kategori['img']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control border-0 shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi"><?= (old('deskripsi')) ? old('deskripsi') : $kategori['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-outline-danger" onclick="clickSubmitEvent(this)"><i class="bi bi-plus-circle text-danger"></i>&nbsp;Simpan Perubahan</button>
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