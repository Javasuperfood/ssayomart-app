<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1">Variasi Produk</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Tambah Variasi Produk</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/produk/tambah-variasi/save-variasi" onsubmit="return validasiVariasi()" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="value" class="form-label">Variasi Produk</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="value" name="value" placeholder="Nama Variasi Produk Anda..." value="<?= old('value') ?>">
                        <span id="produkError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Variasi Produk</label>
                        <input type="price" class="form-control border-0 shadow-sm" id="harga" name="harga" placeholder="Harga Variasi Produk Anda..." value="<?= old('harga') ?>">
                        <span id="hargaError" class="text-danger"></span>
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
                <h6 class="m-0 font-weight-medium">List Variasi Produk</h6>
            </div>
            <div class="card-body">
                <table class="table text-center table-responsive" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Variasi Produk</th>
                            <th scope="col">Harga</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <?= $no = 1; ?>
                    <tbody>
                        <?php foreach ($variasi_model as $vm) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $vm['value']; ?></td>
                                <td><?= $vm['harga']; ?></td>
                                <td style="display: none;">1</td>
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/produk/tambah-variasi/update-variasi/<?= $vm['id_variasi_produk']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="<?= base_url() ?>dashboard/produk/tambah-variasi/delete-variasi/<?= $vm['id_variasi_produk']; ?>" method="post">
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

    <!-- <script>
        new DataTable('#example');
    </script> -->
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
    function validasiVariasi() {
        var isValid = true;

        var namaProdukField = document.getElementById('nama');
        var hargaField = document.getElementById('harga');

        var namaProdukError = document.getElementById('produkError');
        var hargaError = document.getElementById('hargaError');

        namaProdukError.textContent = '';
        hargaError.textContent = '';

        if (namaProdukField.value.trim() === '') {
            namaProdukField.classList.add('invalid-field');
            namaProdukError.textContent = 'Nama variasi harus diisi';
            isValid = false;
        } else {
            namaProdukField.classList.remove('invalid-field');
        }

        if (hargaField.value.trim() === '') {
            hargaField.classList.add('invalid-field');
            hargaError.textContent = 'Harga Variasi Produk harus diisi';
            isValid = false;
        } else {
            hargaField.classList.remove('invalid-field');
        }

        return isValid;
    }
</script>

<?= $this->endSection(); ?>