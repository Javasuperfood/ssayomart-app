<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Edit Produk</h1>
<p class="mb-4">Anda dapat mengatur produk yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm my-4 border-1 shadow-sm roudned-3" role="alert">
    <b>MOHON TELITI KETIKA MENGISI PRODUK UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN</b>
    <h4>HARAP TELITI MASUKAN FOTO PRODUK DENGAN UKURAN <strong>500 X 500</strong> PIXEL ATAU DIMENSI</h4>
    <br>
    <img class="image-fluid px-0 mb-4" style="width: 500px;" src="<?= base_url() ?>assets/img/produk/main/contoh.png"  alt="">
</div>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex align-items-center justify-content-start border-1 py-3">
        <i class="bi bi-pencil-square text-danger"></i>
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
                <label for="nama" class="form-label">Nama Produk Bahasa <strong>Indonesia</strong><span class="text-danger"> *</span></label>
                <input type="text" class="form-control shadow-sm border-0 <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-1'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda dalam bahasa Indonesia..." value="<?= (old('nama')) ? old('nama') : $p['nama'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-4">
                <label for="nama_kr" class="form-label">Nama Produk Bahasa <strong>Korea</strong><span class="text-danger"> *</span></label>
                <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kr')) ? 'is-invalid' : 'border-1'; ?>" id="nama_kr" name="nama_kr" placeholder="Nama Produk Anda dalam bahasa Korea..." value="<?= (old('nama_kr')) ? old('nama_kr') : $p['nama_kr'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama_kr'); ?></div>
            </div>
            <div class="mb-4">
                <label for="nama_en" class="form-label">Nama Produk Bahasa <strong>Inggris</strong><span class="text-danger"> *</span></label>
                <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('nama_en')) ? 'is-invalid' : 'border-1'; ?>" id="nama_en" name="nama_en" placeholder="Nama Produk Anda dalam bahasa Inggris..." value="<?= (old('nama_en')) ? old('nama_en') : $p['nama_en'] ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama_en'); ?></div>
            </div>
            <div class="mb-4">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)<span class="text-danger"> *</span></label>
                <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-1'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= (old('sku')) ? old('sku') : $p['sku'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-4">
                <label for="deskripsi">Deskripsi Produk<span class="text-secondary"> (optional)</span></label>
                <textarea class="form-control shadow-sm border-0 <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .."><?= (old('deskripsi')) ? old('deskripsi') : $p['deskripsi'] ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Kategori Induk<span class="text-danger"> *</span></label>
                <select class="form-control shadow-sm border-0 <?= (validation_show_error('kategori')) ? 'is-invalid' : 'border-1'; ?>" id="kategori" name="parent_kategori_id">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('kategori'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Sub Kategori<span class="text-danger"> *</span></label>
                <select class="form-control border-0 shadow-sm" id="sub_kategori" name="sub_kategori">
                    <option value="">Pilih Kategori</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="selectVariant">Pilih Variant<span class="text-danger"> *</span></label>
                <select class="form-control border-0 shadow-sm" name="selectVariant" id="selectVariant">
                    <option value="">Pilih</option>
                    <?php foreach ($variasi as $v) : ?>
                        <option value="<?= $v['id_variasi']; ?>" <?= ($variasiItem['id_variasi'] == $v['id_variasi']) ? 'selected' : ''; ?>><?= $v['nama_varian']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 gram 1Kg)</span><span class="text-danger"> *</span></label>
                <input type="text" id="valueItem" value="<?= $variasiItem['value_item'] ?>" name="valueItem" class="form-control border-0 shadow-sm <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>">
                <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
            </div>
            <div class="mb-4">
                <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan gram e.g : 1kg = 1000)</span><span class="text-danger"> *</span></label>
                <input type="price" class="form-control border-0 shadow-sm <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-1' ?>" id="berat" name="berat" value="<?= $variasiItem['berat'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
            </div>
            <div class="mb-4">
                <label for="harga" class="form-label">Harga Produk<span class="text-danger"> *</span></label>
                <input type="price" class="form-control shadow-sm border-0 <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-1'; ?>" id="harga" name="harga" value="<?= $variasiItem['harga_item'] ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
            </div>
            <div class="mb-4">
                <label for="img" class="form-label">Gambar Produk<span class="text-danger"> *</span></label>
                <input type="file" accept="image/*" class="form-control border-0 shadow-sm" id="img" name="img">
                <input type="hidden" name="imageLama" value="<?= $p['img']; ?>">
            </div>
            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)">Simpan Perubahan</button>
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