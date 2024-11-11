<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<meta name="_token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>


<h1 class="h3 mb-2 text-gray-800">Tambah Produk Baru</h1>
<p class="mb-4">Anda dapat mengatur produk yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-1 shadow-sm my-4 border-1 shadow-sm roudned-3" role="alert">
    <b>MOHON TELITI KETIKA MENGISI PRODUK UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN</b>
    <h4>HARAP TELITI MASUKAN FOTO PRODUK DENGAN UKURAN <strong>500 X 500</strong> PIXEL ATAU DIMENSI</h4>
    <br>
    <img class="image-fluid px-0 mb-4" style="width: 500px;" src="<?= base_url() ?>assets/img/produk/main/contoh.png"
         alt="">
</div>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-plus-circle-fill text-danger"></i>
        <h6 class="m-0 fw-bold px-2"> Tambah Produk Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/save" method="post"
            enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-4">
                <label for="nama" class="form-label">Nama Produk</strong><span
                        class="text-danger"> *</span></label>
                <input type="text"
                    class="form-control shadow-sm <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-1'; ?>"
                    id="nama" name="nama" data-toggle="tooltip" data-placement="bottom"
                    title="Harap isi bidang ini dengan nama produk"
                    placeholder="Nama Produk Anda dalam bahasa Indonesia..." value="<?= old('nama') ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>

            <div class="mb-4">
                <label for="nama_kr" class="form-label">Nama Produk dalam <strong>Bahasa Korea</strong><span
                        class="text-danger"> *</span></label>
                <input type="text"
                    class="form-control shadow-sm <?= (validation_show_error('nama_kr')) ? 'is-invalid' : 'border-1'; ?>"
                    id="nama_kr" name="nama_kr" data-toggle="tooltip" data-placement="bottom"
                    title="Harap isi bidang ini dengan nama produk" placeholder="Nama Produk Anda dalam Bahasa korea..."
                    value="<?= old('nama_kr') ?>">
                <div class=" invalid-feedback"><?= validation_show_error('nama_kr'); ?>
                </div>
            </div>

            <div class="mb-4">
                <label for="nama_en" class="form-label">Nama Produk dalam <strong>Bahasa Inggris</strong><span
                        class="text-danger"> *</span></label>
                <input type="text"
                    class="form-control shadow-sm <?= (validation_show_error('nama_en')) ? 'is-invalid' : 'border-1'; ?>"
                    id="nama_en" name="nama_en" data-toggle="tooltip" data-placement="bottom"
                    title="Harap isi bidang ini dengan nama produk"
                    placeholder="Nama Produk Anda dalam bahasa inggris..." value="<?= old('nama_en') ?>">
                <div class=" invalid-feedback"><?= validation_show_error('nama_en'); ?>
                </div>
            </div>

            <div class="mb-4">
                <label for="brand" class="form-label">Brand Produk <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control shadow-sm <?= (validation_show_error('brand')) ? 'is-invalid' : 'border-1'; ?>"
                    id="brand" name="brand" data-toggle="tooltip" data-placement="bottom"
                    title="Harap isi bidang ini dengan brand produk" placeholder="Brand Produk Anda..."
                    value="<?= old('brand') ?>">
                <div class="invalid-feedback"><?= validation_show_error('brand'); ?></div>
            </div>


            <div class="mb-4">
                <label for="sku" class="form-label">Barcode/SKU <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-1'; ?>"
                    id="sku" name="sku" data-toggle="tooltip" data-placement="bottom"
                    title="Harap isi bidang ini dengan SKU Produk" placeholder="SKU Produk Anda..."
                    value="<?= old('sku') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi Produk <span style="color:red;">*</span></label>
                <textarea
                    class="form-control shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>"
                    id="deskripsi" data-toggle="tooltip" data-placement="bottom"
                    title="Harap isi bidang ini dengan Deskripsi Produk" name="deskripsi"
                    placeholder="Deskripsi Produk Anda .."><?= old('deskripsi') ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Kategori <span class="text-danger">*</span></label>
                <select
                    class="form-control shadow-sm <?= (validation_show_error('parent_kategori_id')) ? 'is-invalid' : 'border-1'; ?>"
                    id="kategori" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom"
                    title="Klik untuk memilih kategori produk yang anda inputkan">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('parent_kategori_id'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Sub Kategori <span class="text-danger">*</span></label>
                <select class="form-control shadow-sm" id="sub_kategori" name="sub_kategori"
                    name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom"
                    title="Klik untuk memilih sub-kategori produk yang anda inputkan">
                    <option value="">Pilih Sub Kategori</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="img" class="form-label">Gambar/Foto Produk</label>
                <input type="file" accept="image/*" class="form-control shadow-sm img" id="img" name="img"
                    placeholder="Masukan Gambar Produk" data-toggle="tooltip" data-placement="bottom"
                    title="Klik untuk menginputkan gambar produk">
            </div>

            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="selectVariant">Gramasi/Variant Produk <span class="text-danger">*</span></label>
                        <select class="form-control shadow-sm" name="selectVariant" data-toggle="tooltip"
                            data-placement="bottom" title="Klik untuk memilih varian produk yang anda inputkan"
                            id="selectVariant">
                            <option value="">Pilih</option>
                            <?php foreach ($variasi as $v) : ?>
                                <option value="<?= $v['id_variasi']; ?>"><?= $v['nama_varian']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="valueVariant">Qty Gramasi/Jenis Variant Produk <span class="text-secondary">(Cth : Rasa Ayam, Rasa Original atau 500gr, 1kg)</span></label>
                        <input type="text" id="valueItem" name="valueItem"
                            class="form-control shadow-sm <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-1'; ?>"
                            value="<?= old('valueItem') ?>" placeholder="Value Varian" name="parent_kategori_id"
                            data-toggle="tooltip" data-placement="bottom"
                            title="Harap isi bidang ini dengan value produk yang anda inputkan">
                        <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="berat" class="form-label">Berat Produk <span class="text-danger">*</span><span
                        class="text-secondary">( Harus Dalam Satuan Gram. Cth : 1kg = 1000)</span></label>
                <input type="price"
                    class="form-control shadow-sm <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-1'; ?>"
                    id="berat" name="berat" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom"
                    title="Harap masukan berat isi produk yang anda inputkan" placeholder="Berat Produk Anda..."
                    value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
            </div>
            <div class="mb-4">
                <label for="harga" class="form-label">Harga Produk <span class="text-danger">*</span></label>
                <input type="price"
                    class="form-control shadow-sm <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-1'; ?>"
                    id="harga" name="harga" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom"
                    title="Harap masukan harga produk yang akan di jual" placeholder="Harga Produk Anda..."
                    value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
            </div>
            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-center" name="parent_kategori_id" data-toggle="tooltip"
                data-placement="bottom" title="Klik untuk menyimpan perubahan">
                <button type="submit" onclick="clickSubmitEvent(this)" class="btn btn-outline-danger"><i
                        class="bi bi-plus-square-fill"></i><span class="fw-bold"> Tambah Produk Baru</span></button>
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

    function clickSubmitEvent(e) {
        $('#preloader').show();

        $(e).prop('disabled', true);
        $(e).html(
            '<div class="spinner-border spinner-border-sm mx-2" role="status"><span class="visually-hidden">Loading...</span></div>Loading...'
        );

        $(e).closest('form').submit();
    }
</script>

<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    $("body").on("change", ".img", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            preview: '#croppedResult', // Tambahkan preview di sini
            zoomable: true,
            zoomOnWheel: true,
        });

        $("#zoomIn").click(function() {
            cropper.zoom(0.1);
        });

        $("#zoomOut").click(function() {
            cropper.zoom(-0.1);
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        // Mengambil dimensi gambar yang di-crop
        var cropWidth = 500;
        var cropHeight = 500;

        canvas = cropper.getCroppedCanvas({
            width: cropWidth,
            height: cropHeight,
        });

        // Mengubah canvas ke data URL
        var croppedImageDataURL = canvas.toDataURL("image/png");

        // Simpan gambar atau lakukan tindakan lain sesuai kebutuhan
        saveCroppedImage(croppedImageDataURL);

        // Menutup modal setelah simpan
        $modal.modal('hide');
    });

    // Fungsi untuk menyimpan gambar (ganti sesuai kebutuhan)
    function saveCroppedImage(dataURL) {
        console.log("Simpan gambar:", dataURL);

        // Menampilkan hasil cropping di elemen gambar
        $("#hasil_crop").attr("src", dataURL);
    }
</script>

<?= $this->endSection(); ?>