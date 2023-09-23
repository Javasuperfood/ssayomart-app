<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 text-danger"><b>Edit Variasi</b></h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-variasi/edit-variasi/<?= $v['id_variasi']; ?>" onsubmit="return validasiVariasi()" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_variasi" name="id_variasi" value="<?= $v['id_variasi'] ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Variasi</label>
                <input type="text" class="form-control border-0 shadow-sm" id="nama_varian" name="nama_varian" value="<?= $v['nama_varian'] ?>">
                <span id="variasiError" class="text-danger"></span>
            </div>
            <div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Validasi
    function validasiVariasi() {
        var isValid = true;

        var variasiField = document.getElementById('nama_varian');

        var variasiError = document.getElementById('variasiError');

        variasiError.textContent = '';

        if (variasiField.value.trim() === '') {
            variasiField.classList.add('invalid-field');
            variasiError.textContent = 'Nama variasi harus diisi';
            isValid = false;
        } else {
            variasiField.classList.remove('invalid-field');
        }

        return isValid;
    }
</script>

<?= $this->endSection(); ?>