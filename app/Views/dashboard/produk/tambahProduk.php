<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Manajemen Produk</h1>
<p class="mb-4">Anda dapat mengatur produk yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>MOHON TELITI KETIKA MENGISI PRODUK UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN!!</b>
    <h4>HARAP TELITI MASUKAN FOTO PRODUK DENGAN UKURAN <strong>500 X 500</strong> PIXEL ATAU DIMENSI, WAJIB!!</h4>
    <b>DILARANG KERAS MEMASUKAN FOTO PRODUK LEBIH DARI UKURAN TERSEBUT!!</b>
</div>

<div class="card border-0 shadow-sm position-relative mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-medium">Masukan Produk Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/save" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= old('nama') ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-3">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-0'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= old('sku') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-3">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .." value="<?= old('deskripsi') ?>"></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-3">
                <label for="parent_kategori_id">Kategori Induk</label>
                <select class="form-control border-0 shadow-sm" id="kategori" name="parent_kategori_id">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="kategoriError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="parent_kategori_id">Sub Kategori</label>
                <select class="form-control border-0 shadow-sm" id="sub_kategori" name="sub_kategori">
                    <option value="">Pilih Kategori</option>
                </select>
                <span id="kategoriError" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar/Foto Produk</label>
                <input type="file" accept="image/*" style="border: none;" class="form-control border-0 shadow-sm" id="img" name="img" placeholder="Masukan Gambar Produk">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="selectVariant">Pilih Variant</label>
                        <select class="form-control border-0 shadow-sm" name="selectVariant" id="selectVariant">
                            <option value="">Pilih</option>
                            <?php foreach ($variasi as $v) : ?>
                                <option value="<?= $v['id_variasi']; ?>" <?= (old('selectVariant') == $v['id_variasi']) ? 'selected' : ''; ?>><?= $v['nama_varian']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Garm 1Kg)</span></label>
                        <input type="text" id="valueItem" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" placeholder="Value Varian">
                        <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan Gram e.g : 1kg = 1000)</span></label>
                <input type="price" class="form-control <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="berat" name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="price" class="form-control <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
            </div>
            <button type="submit" class="btn btn-danger">Simpan</button>
        </form>
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
</script>

<?= $this->endSection(); ?>