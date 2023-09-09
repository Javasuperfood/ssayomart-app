<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Kategori Produk</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-bold text-danger">Tambah Kategori</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/kategori/tambah-kategori/save" method="post" enctype="multipart/form-data" onsubmit="return validasiTambahKategori()">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori" placeholder="Masukan nama kategori" name="kategori" value="<?= old('kategori') ?>">
                        <span id="kategoriError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Nama Kategori.</b>
                        </div>
                        <input type="text" class="form-control" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= old('slug') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Masukan Gambar</label>
                        <input type="file" class="form-control" id="img" name="img" placeholder="Masukan Gambar">
                        <span id="imgError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" id="deskripsi" rows="3" name="deskripsi" value="<?= old('deskripsi') ?>"></textarea>
                        <span id="deskripsiError" class="text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-danger mt-3">Simpan</button>
            </div>
            </form>
        </div>
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
    function validasiTambahKategori() {
        var isValid = true;

        var namaKategoriField = document.getElementById('kategori');
        var imgField = document.getElementById('img');
        var deskripsiField = document.getElementById('deskripsi');

        var namaKategoriError = document.getElementById('kategoriError');
        var imgError = document.getElementById('imgError');
        var deskripsiError = document.getElementById('deskripsiError');

        namaKategoriError.textContent = '';
        imgError.textContent = '';
        deskripsiError.textContent = '';

        if (namaKategoriField.value.trim() === '') {
            namaKategoriField.classList.add('invalid-field');
            namaKategoriError.textContent = 'Nama Kategori harus diisi';
            isValid = false;
        } else {
            namaKategoriField.classList.remove('invalid-field');
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