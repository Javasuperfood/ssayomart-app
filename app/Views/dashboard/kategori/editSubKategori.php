<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">Form Edit Sub Kategori</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form method="POST" name="formkategori" enctype="multipart/form-data" action="<?= base_url(); ?>dashboard/kategori/edit-sub-kategori/update/<?= $subkategori['id_sub_kategori'] ?>" onsubmit="return validasiUpdateKategori()">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label for="kategori" class="form-label">Nama Kategori atau Sub Kategori</label>
                <input type="text" class="form-control border-0 shadow-sm" id="kategori" placeholder="Masukan nama kategori" name="kategori" value="<?= $subkategori['nama_kategori'] ?>" pattern="[0-9]{0}{3}">
                <span id="kategoriError" class="text-danger"></span>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= $subkategori['slug'] ?>">
                <span id="slugError" class="text-danger"></span>
            </div>

            <label for="parent_kategori_id">Kategori Induk</label>
            <select class="form-control border-0 shadow-sm" id="parent_kategori_id" name="parent_kategori_id">
                <option value="">Pilih Kategori Induk (biarkan jika tidak diubah)</option>
                <?php foreach ($kategori_model as $km) : ?>
                    <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>

            <div class="mb-3">
                <label for="img" class="form-label">Masukan Gambar</label>
                <input type="file" class="form-control border-0 shadow-sm" id="img" name="img" value="<?= $subkategori['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $subkategori['img']; ?>">
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control border-0 shadow-sm" id="deskripsi" name="deskripsi"><?= $subkategori['deskripsi'] ?></textarea>
                <span id="deskripsiError" class="text-danger"></span>
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