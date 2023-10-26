<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm position-relative">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 text-danger"><b>Edit Produk</b></h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/update-produk/save" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="page" value="<?= (isset($_GET['page']) ? $_GET['page'] : '1'); ?>">
            <input type="hidden" name="slug" value="<?= $p['slug'] ?>">
            <input type="text" class="form-control border-0 shadow-sm d-none" name="id_produk" value="<?= $p['id_produk'] ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= (old('nama')) ? old('nama') : $p['nama'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-3">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-0'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= (old('sku')) ? old('sku') : $p['sku'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-3">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .."><?= (old('deskripsi')) ? old('deskripsi') : $p['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-3">
                <label for="parent_kategori_id">Kategori Induk</label>
                <select class="form-control border-0 shadow-sm <?= (validation_show_error('kategori')) ? 'is-invalid' : 'border-0'; ?>" id="kategori" name="parent_kategori_id">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('kategori'); ?></div>
            </div>
            <div class="mb-3">
                <label for="parent_kategori_id">Sub Kategori</label>
                <select class="form-control border-0 shadow-sm" id="sub_kategori" name="sub_kategori">
                    <option value="">Pilih Kategori</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar</label>
                <input type="file" accept="image/*" style="border: none;" class="form-control border-0 shadow-sm" id="img" name="img">
                <input type="hidden" name="imageLama" value="<?= $p['img']; ?>">
            </div>
            <div class="text-center">
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