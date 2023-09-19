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
    <div class="col-md-6">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Masukan Produk Baru</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/save" onsubmit="return validasiTambahProduk()" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= old('nama') ?>">
                        <span id="produkError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                        <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= old('sku') ?>" onkeypress="return isNumber(event);">
                        <span id="skuError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .." value="<?= old('deskripsi') ?>"></textarea>
                        <span id="deskripsiError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="parent_kategori_id">Kategori Induk</label>
                        <select class="form-control" id="kategori" name="parent_kategori_id">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $km) : ?>
                                <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span id="kategoriError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="parent_kategori_id">Sub Kategori</label>
                        <select class="form-control" id="sub_kategori" name="sub_kategori">
                            <option value="">Pilih Kategori</option>
                        </select>
                        <span id="kategoriError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar/Foto Produk</label>
                        <input type="file" class="form-control" id="img" name="img" placeholder="Masukan Gambar Produk">
                        <span id="imgError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="selectVariant">Pilih Variant</label>
                                <select class="form-control" name="selectVariant" id="selectVariant">
                                    <option selected>Pilih</option>
                                    <?php foreach ($variasi as $v) : ?>
                                        <option value="<?= $v['id_variasi']; ?>"><?= $v['nama_varian']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="valueVariant">Value Variant</label>
                                <input type="text" id="valueItem" name="valueItem" class="form-control" placeholder="Value Varian">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat Produk (*Satuan Gram)</label>
                        <input type="price" class="form-control" id="berat" name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                        <span id="beratError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Produk</label>
                        <input type="price" class="form-control" id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>">
                        <span id="hargaError" class="text-danger"></span>
                    </div>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-md-6 mb-3">
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
                            <th scope="col">Kategori Produk</th>
                            <th scope="col">Variant</th>
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
                                <td><?= $km['harga']; ?></td>
                                <td style="display: none;">1</td>
                                <td>
                                    <?php
                                    $kategoriNama = '';
                                    $subKategoriNama = '';
                                    foreach ($kategori as $k) {
                                        if ($k['id_kategori'] == $km['id_kategori']) {
                                            $kategoriNama = $k['nama_kategori'];
                                            if ($km['id_sub_kategori'] != null) {
                                                foreach ($subKategori as $s) {
                                                    if ($s['id_sub_kategori'] == $km['id_sub_kategori']) {
                                                        $subKategoriNama = $s['nama_kategori'];
                                                        break;
                                                    }
                                                }
                                            }
                                            break;
                                        }
                                    }
                                    echo ($kategoriNama !== '') ? $kategoriNama . '<br>(' . $subKategoriNama . ')' : 'Kategori Tidak Ditemukan';
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    $previousVarian = null;
                                    foreach ($variasiItem as $vi) : ?>
                                        <?php
                                        $i = 0;
                                        if ($km['id_produk'] == $vi['id_produk']) {
                                            if ($previousVarian !== $vi['nama_varian']) {
                                                echo $vi['nama_varian'] . ' : ';
                                                $previousVarian = $vi['nama_varian'];
                                            }
                                            echo '|' . $vi['value_item'] . '|';
                                        }
                                        ?>
                                    <?php endforeach ?>
                                </td>
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
                                            <a class="dropdown-item" href="<?= base_url() ?>dashboard/produk/detail-varian/<?= $km['slug']; ?>">
                                                <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Detail Varian
                                            </a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/produk/tambah-produk/update-produk/<?= $km['id_produk']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/produk/tambah-produk/delete-produk/<?= $km['id_produk']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Delete</span>
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
</div>

<script>
    var subcategories = <?= json_encode($subKategori); ?>;

    function updateSubcategories() {
        var selectedCategory = $("#kategori").val();
        var subcategorySelect = $("#sub_kategori");
        subcategorySelect.empty();
        subcategories.forEach(function(subcategory) {
            if (subcategory.id_kategori == selectedCategory) {
                subcategorySelect.append($('<option>', {
                    value: subcategory.id_sub_kategori,
                    text: subcategory.nama_kategori
                }));
            }
        });
    }

    // Panggil fungsi updateSubcategories saat perubahan terjadi pada pilihan kategori
    $("#kategori").change(updateSubcategories);

    // Panggil updateSubcategories() saat halaman dimuat untuk menampilkan subkategori awal
    $(document).ready(updateSubcategories);
</script>

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

        var namaProdukField = document.getElementById('nama');
        var skuField = document.getElementById('sku');
        var hargaField = document.getElementById('harga');
        var imgField = document.getElementById('img');
        var deskripsiField = document.getElementById('deskripsi');
        var kategoriField = document.getElementById('parent_kategori_id');

        var namaProdukError = document.getElementById('produkError');
        var skuError = document.getElementById('skuError');
        var hargaError = document.getElementById('hargaError');
        var imgError = document.getElementById('imgError');
        var deskripsiError = document.getElementById('deskripsiError');
        var kategoriError = document.getElementById('kategoriError');

        namaProdukError.textContent = '';
        skuError.textContent = '';
        hargaError.textContent = '';
        imgError.textContent = '';
        deskripsiError.textContent = '';
        kategoriError.textContent = '';

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

        if (kategoriField.value.trim() === '') {
            kategoriField.classList.add('invalid-field');
            kategoriError.textContent = 'Kategori Produk harus diisi';
            isValid = false;
        } else {
            kategoriField.classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>