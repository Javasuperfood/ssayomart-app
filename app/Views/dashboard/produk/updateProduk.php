<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Edit Produk</h1>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex align-items-center justify-content-start border-1 py-3">
        <i class="bi bi-pencil-square"></i>
        <h6 class="m-0 fw-bold px-2">Edit Produk</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/update-produk/<?= $p['id_produk'] ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="page" value="<?= (isset($_GET['page']) ? $_GET['page'] : '1'); ?>">
            <input type="hidden" name="slug" value="<?= $p['slug'] ?>">
            <input type="text" class="form-control border-0 shadow-sm d-none" name="id_produk" value="<?= $p['id_produk'] ?>">
            <input type="hidden" name="id_variasi_item" value="<?= $variasiItem['id_variasi_item']; ?>">
            <div class="mb-4">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-1'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= (old('nama')) ? old('nama') : $p['nama'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-4">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                <input type="text" class="form-control <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-1'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= (old('sku')) ? old('sku') : $p['sku'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-4">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .."><?= (old('deskripsi')) ? old('deskripsi') : $p['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Kategori Induk</label>
                <select class="form-control <?= (validation_show_error('kategori')) ? 'is-invalid' : 'border-1'; ?>" id="kategori" name="parent_kategori_id">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('kategori'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Sub Kategori</label>
                <select class="form-control border-1" id="sub_kategori" name="sub_kategori">
                    <option value="">Pilih Kategori</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="selectVariant">Pilih Variant</label>
                <select class="form-control border-1" name="selectVariant" id="selectVariant">
                    <option value="" selected>Pilih</option>
                    <?php foreach ($variasi as $v) : ?>
                        <option value="<?= $v['id_variasi']; ?>" selected><?= $v['nama_varian']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Garm 1Kg)</span></label>
                <input type="text" id="valueItem" value="<?= $variasiItem['value_item'] ?>" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>">
                <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
            </div>
            <div class="mb-4">
                <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan Gram e.g : 1kg = 1000)</span></label>
                <input type="price" class="form-control <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-1' ?>" id="berat" name="berat" value="<?= $variasiItem['berat'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
            </div>
            <div class="mb-4">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="price" class="form-control <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-1'; ?>" id="harga" name="harga" value="<?= $variasiItem['harga_item'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
            </div>
            <div class="mb-4">
                <label for="img" class="form-label">Gambar Produk</label>
                <input type="file" accept="image/*" class="form-control border-1" id="img" name="img">
                <input type="hidden" name="imageLama" value="<?= $p['img']; ?>">
            </div>
            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    var subcategories = <?= json_encode($subKategori); ?>;
    var selectedCategory = <?= json_encode($p['id_kategori']); ?>; // Ambil id_kategori dari data produk
    var selectedSubCategory = <?= json_encode($p['id_sub_kategori']); ?>; // Ambil id_kategori dari data produk


    function updateSubcategories() {
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
    $(document).ready(function() {
        // Atur nilai awal dropdown kategori
        $("#kategori").val(selectedCategory);

        // Panggil updateSubcategories untuk mengisi dropdown subkategori
        updateSubcategories();

    });
</script>


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
                    selected: (subcategory.id_sub_kategori == selectedSubCategory),
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
</script>
<?= $this->endSection(); ?>