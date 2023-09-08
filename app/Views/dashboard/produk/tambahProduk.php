<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1">Management Produk</h1>
<p class="mb-4">Anda dapat mengatur produk yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>MOHON TELITI KETIKA MENGISI PRODUK UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN!!</b>
</div>

<div class="row">
    <!-- Left Panel -->
    <?= validation_list_errors() ?>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Masukan Produk Baru</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/save" method="post" enctype="multipart/form-data" onsubmit="return validasiTambahProduk()">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?= old('nama_produk') ?>" autofocus>
                        <span id="produkError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                        <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU Produk" value="<?= old('sku') ?>" autofocus>
                        <span id="skuError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga_produk" class="form-label">Harga Produk</label>
                        <input type="price" class="form-control" id="harga_produk" name="harga_produk" value="<?= old('harga_produk') ?>" placeholder="Harga">
                        <span id="hargaError" class="text-danger"></span>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="stock_produk" class="form-label">Stock Produk</label>
                        <input type="number" class="form-control" id="stock_produk" name="stock_produk" placeholder="Stock">
                    </div> -->
                    <div class="mb-3">
                        <label for="deskripsi_produk">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" placeholder="Deskripsi Produk Anda ..." value="<?= old('deskripsi_produk') ?>"></textarea>
                        <span id="deskripsiError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="img" name="img" placeholder="Masukan Gambar">
                        <span id="imgError" class="text-danger"></span>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-3">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">List Produk</h6>
            </div>
            <div class="card-body">
                <table class="table text-center table-responsive" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Produk</th>
                            <!-- <th scope="col">Tanggal EXP</th> -->
                            <!-- <th scope="col">Ketegori</th> -->
                            <th scope="col">Harga Produk</th>
                            <th scope="col">Stock Produk</th>
                            <!-- <th scope="col">Deskripsi</th> -->
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <?= $no = 1; ?>
                    <tbody>
                        <?php foreach ($produk_Model as $km) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/produk/main/' . $km['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                                </td>
                                <td><?= $km['nama']; ?></td>
                                <!-- <td>25/26/27</td> -->
                                <td><?= $km['harga']; ?></td>
                                <td>1</td>
                                <!-- <td><?= $km['deskripsi']; ?></td> -->
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url() ?>produk/<?= $km['slug']; ?>">
                                                <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Lihat Produk
                                            </a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/produk/tambah-produk/update-produk/<?= $km['id_produk']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Edit Produk
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/produk/tambah-produk/delete-produk/<?= $km['id_produk']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Hapus Produk</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#example');
    </script>
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
    function validasiTambahProduk() {
        var isValid = true;

        var namaProdukField = document.getElementById('nama_produk');
        var skuField = document.getElementById('sku');
        var hargaField = document.getElementById('harga_produk');
        var imgField = document.getElementById('img');
        var deskripsiField = document.getElementById('deskripsi_produk');

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