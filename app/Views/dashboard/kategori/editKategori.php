<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Edit Kategori</h1>

<div class="card border-1 shadow-sm position-relative">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-pencil-square"></i>
        <h6 class="m-0 fw-bold px-2">Form Edit Kategori</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form method="POST" name="formkategori" enctype="multipart/form-data" action="<?= base_url(); ?>dashboard/kategori/edit-kategori/update/<?= $kategori['id_kategori'] ?>" onsubmit="return validasiUpdateKategori()">
            <?= csrf_field(); ?>

            <div class="mb-4">
                <label for="kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control <?= (validation_show_error('nama_kategori')) ? 'is-invalid' : 'border-1'; ?>" id="kategori" placeholder="Masukan nama kategori" name="kategori" value="<?= $kategori['nama_kategori'] ?>" pattern="[0-9]{0}{3}">
                <div class="invalid-feedback"><?= validation_show_error('nama_kategori'); ?></div>
            </div>

            <div class="mb-4">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control border-1" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= $kategori['slug'] ?>">
                <span id="slugError" class="text-danger"></span>
            </div>

            <div class="mb-4">
                <label for="img" class="form-label">Masukan Gambar</label>
                <input type="file" class="form-control <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" value="<?= $kategori['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $kategori['img']; ?>">
                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi"><?= (old('deskripsi')) ? old('deskripsi') : $kategori['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>

            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-end">
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

    //Validasi Form
    function validasiUpdateKategori() {
        var isValid = true;

        var namaKategoriField = document.getElementById('kategori');
        var slugField = document.getElementById('slug');
        var imgField = document.getElementById('img');
        var deskripsiField = document.getElementById('deskripsi');

        var namaKategoriError = document.getElementById('kategoriError');
        var slugError = document.getElementById('slugError');
        var imgError = document.getElementById('imgError');
        var deskripsiError = document.getElementById('deskripsiError');

        namaKategoriError.textContent = '';
        slugError.textContent = '';
        imgError.textContent = '';
        deskripsiError.textContent = '';

        if (namaKategoriField.value.trim() === '') {
            namaKategoriField.classList.add('invalid-field');
            namaKategoriError.textContent = 'Nama Kategori harus diisi';
            isValid = false;
        } else {
            namaKategoriField.classList.remove('invalid-field');
        }

        if (slugField.value.trim() === '') {
            slugField.classList.add('invalid-field');
            slugError.textContent = 'Slug harus diisi';
            isValid = false;
        } else {
            slugField.classList.remove('invalid-field');
        }

        if (imgField.value.trim() === '') {
            imgField.classList.add('invalid-field');
            imgError.textContent = 'Gambar harus diisi';
            isValid = false;
        } else {
            imgField.classList.remove('invalid-field');
        }

        if (deskripsiField.value.trim() === '') {
            deskripsiField.classList.add('invalid-field');
            deskripsiError.textContent = 'Deskripsi harus diisi';
            isValid = false;
        } else {
            deskripsiField.classList.remove('invalid-field');
        }

        return isValid;
    }
</script>

<?= $this->endSection(); ?>