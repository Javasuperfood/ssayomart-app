<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Manajemen Produk</h1>
<p class="mb-4">Anda dapat mengatur produk yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-1 shadow-sm my-4" role="alert">
    <b>MOHON TELITI KETIKA MENGISI PRODUK UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN!!</b>
    <h4>HARAP TELITI MASUKAN FOTO PRODUK DENGAN UKURAN <strong>500 X 500</strong> PIXEL ATAU DIMENSI, WAJIB!!</h4>
    <b>DILARANG KERAS MEMASUKAN FOTO PRODUK LEBIH DARI UKURAN TERSEBUT!!</b>
    <br><br>
    <img class="image-fluid px-0 mb-4" style="width: 500px;" src="<?= base_url() ?>assets/img/produk\main/contoh.png"  alt="">
</div>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-earmark-plus-fill"></i>
        <h6 class="m-0 fw-bold px-2">Masukan Produk Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/save" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-4">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-1'; ?>" id="nama" name="nama" placeholder="Nama Produk Anda..." value="<?= old('nama') ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-4">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                <input type="text" class="form-control <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-1'; ?>" id="sku" name="sku" placeholder="SKU Produk Anda..." value="<?= old('sku') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk Anda .."><?= old('deskripsi') ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Kategori Induk</label>
                <select class="form-control border-1" id="kategori" name="parent_kategori_id">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Sub Kategori</label>
                <select class="form-control border-1" id="sub_kategori" name="sub_kategori">
                    <option value="">Pilih Kategori</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="img" class="form-label">Gambar/Foto Produk</label>
                <input type="file" accept="image/*" class="form-control border-1" id="img" name="img" placeholder="Masukan Gambar Produk">
            </div>
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="selectVariant">Pilih Variant</label>
                        <select class="form-control border-1" name="selectVariant" id="selectVariant">
                            <option value="">Pilih</option>
                            <?php foreach ($variasi as $v) : ?>
                                <option value="<?= $v['id_variasi']; ?>" <?= (old('selectVariant') == $v['id_variasi']) ? 'selected' : ''; ?>><?= $v['nama_varian']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Garm 1Kg)</span></label>
                        <input type="text" id="valueItem" name="valueItem" class="form-control <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>" value="<?= old('valueItem') ?>" placeholder="Value Varian">
                        <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan Gram e.g : 1kg = 1000)</span></label>
                <input type="price" class="form-control <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-1'; ?>" id="berat" name="berat" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
            </div>
            <div class="mb-4">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="price" class="form-control <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-1'; ?>" id="harga" name="harga" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
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
</script>

<?= $this->endSection(); ?>