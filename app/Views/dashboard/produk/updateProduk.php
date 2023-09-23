<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 text-danger"><b>Edit Produk</b></h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/edit-produk/<?= $km['id_produk']; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validasiUpdateProduk()">
            <?= csrf_field(); ?>
            <input type="text" class="form-control border-0 shadow-sm" id="id_produk" name="id_produk" value="<?= $km['id_produk'] ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control border-0 shadow-sm" id="nama" name="nama" value="<?= $km['nama'] ?>">
                <span id="produkError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="sku" class="form-label">SKU Produk</label>
                <input type="number" class="form-control border-0 shadow-sm" id="sku" name="sku" value="<?= $km['sku'] ?>">
                <span id="skuError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="price" class="form-control border-0 shadow-sm" id="harga" name="harga" value="<?= $km['harga'] ?>">
                <span id="hargaError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <input type="text" style="height: 100px;" class="form-control border-0 shadow-sm" id="deskripsi" name="deskripsi" value="<?= $km['deskripsi'] ?>">
                <span id="deskripsiError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar</label>
                <input type="file" style="border: none;" class="form-control border-0 shadow-sm" id="img" name="img" value="<?= $km['img'] ?>">
                <span id="imgError" class="text-danger"></span>
                <input type="hidden" name="imageLama" value="<?= $km['img']; ?>">
            </div>

            <div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    //Validasi Form
    function validasiUpdateProduk() {
        var isValid = true;

        var namaProdukField = document.getElementById('nama');
        var skuField = document.getElementById('sku');
        var hargaField = document.getElementById('harga');
        var imgField = document.getElementById('img');
        var deskripsiField = document.getElementById('deskripsi');

        var namaProdukError = document.getElementById('produkError');
        var skuError = document.getElementById('skuError');
        var hargaError = document.getElementById('hargaError');
        var imgError = document.getElementById('imgError');
        var deskripsiError = document.getElementById('deskripsiError');

        namaProdukError.textContent = '';
        skuError.textContent = '';
        hargaError.textContent = '';
        imgError.textContent = '';
        deskripsiError.textContent = '';

        if (namaProdukField.value.trim() === '') {
            namaProdukField.classList.add('invalid-field');
            namaProdukError.textContent = 'Nama Produk harus diisi';
            isValid = false;
        } else {
            namaProdukField.classList.remove('invalid-field');
        }

        if (skuField.value.trim() === '') {
            skuField.classList.add('invalid-field');
            skuError.textContent = 'SKU harus diisi';
            isValid = false;
        } else {
            skuField.classList.remove('invalid-field');
        }

        if (hargaField.value.trim() === '') {
            hargaField.classList.add('invalid-field');
            hargaError.textContent = 'Harga Produk harus diisi';
            isValid = false;
        } else {
            hargaField.classList.remove('invalid-field');
        }

        if (imgField.value.trim() === '') {
            imgField.classList.add('invalid-field');
            imgError.textContent = 'Gambar Produk harus diisi';
            isValid = false;
        } else {
            imgField.classList.remove('invalid-field');
        }

        if (deskripsiField.value.trim() === '') {
            deskripsiField.classList.add('invalid-field');
            deskripsiError.textContent = 'Deskripsi Produk harus diisi';
            isValid = false;
        } else {
            deskripsiField.classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>