<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<meta name="_token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>


<h1 class="h3 mb-2 text-gray-800">Manajemen Produk</h1>
<p class="mb-4">Anda dapat mengatur produk yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm my-4 border-1 shadow-sm roudned-3" role="alert">
    <b>MOHON TELITI KETIKA MENGISI PRODUK UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN</b>
    <h4>HARAP TELITI MASUKAN FOTO PRODUK DENGAN UKURAN <strong>500 X 500</strong> PIXEL ATAU DIMENSI</h4>
    <br>
    <img class="image-fluid px-0 mb-4" style="width: 500px;" src="<?= base_url() ?>assets/img/produk/main/contoh.png"  alt="">
</div>

<div class="card border-1 shadow-sm position-relative mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-plus-circle-fill text-danger"></i>
        <h6 class="m-0 fw-bold px-2"> Tambah Produk Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/produk/tambah-produk/save" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="mb-4">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('nama')) ? 'is-invalid' : 'border-0'; ?>" id="nama" name="nama" data-toggle="tooltip" data-placement="bottom" title="Harap isi bidang ini dengan nama produk" placeholder="Nama Produk Anda..." value="<?= old('nama') ?>">
                <div class="invalid-feedback"><?= validation_show_error('nama'); ?></div>
            </div>
            <div class="mb-4">
                <label for="sku" class="form-label">Stock Keeping Unit (SKU)</label>
                <input type="text" class="form-control shadow-sm <?= (validation_show_error('sku')) ? 'is-invalid' : 'border-0'; ?>" id="sku" name="sku" data-toggle="tooltip" data-placement="bottom" title="Harap isi bidang ini dengan SKU Produk" placeholder="SKU Produk Anda..." value="<?= old('sku') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('sku'); ?></div>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <textarea class="form-control shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?>" id="deskripsi" data-toggle="tooltip" data-placement="bottom" title="Harap isi bidang ini dengan Deskripsi Produk" name="deskripsi" placeholder="Deskripsi Produk Anda .."><?= old('deskripsi') ?></textarea>
                <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Kategori Induk</label>
                <select class="form-control shadow-sm border-0 <?= (validation_show_error('parent_kategori_id')) ? 'is-invalid' : 'border-0'; ?>" id="kategori" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom" title="Klik untuk memilih kategori produk yang anda inputkan">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $km) : ?>
                        <option value="<?= $km['id_kategori']; ?>"><?= $km['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= validation_show_error('parent_kategori_id'); ?></div>
            </div>
            <div class="mb-4">
                <label for="parent_kategori_id">Sub Kategori</label>
                <select class="form-control shadow-sm border-0" id="sub_kategori" name="sub_kategori" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom" title="Klik untuk memilih sub-kategori produk yang anda inputkan">
                    <option value="">Pilih Kategori</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="img" class="form-label">Gambar/Foto Produk</label>
                <input type="file" accept="image/*" class="form-control shadow-sm border-0 img" id="img" name="img" placeholder="Masukan Gambar Produk" data-toggle="tooltip" data-placement="bottom" title="Klik untuk menginputkan gambar produk">
            </div>

            <!-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Cropping Gambar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center align-items-center">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger rounded-3" id="crop"><i class="bi bi-crop me-2"></i> Potong</button>
                            <button type="button" class="btn btn-danger rounded-3" id="zoomIn"><i class="bi bi-zoom-in"></i></button>
                            <button type="button" class="btn btn-danger rounded-3" id="zoomOut"><i class="bi bi-zoom-out"></i></button>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="mb-4">
                <h6 for="img" class="form-label">Hasil Gambar</h6>
                <img id="hasil_crop" class="img-fluid rounded-3">
            </div> -->

            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="selectVariant">Pilih Variant</label>
                        <select class="form-control border-1" name="selectVariant" data-toggle="tooltip" data-placement="bottom" title="Klik untuk memilih varian produk yang anda inputkan" id="selectVariant">
                            <option value="">Pilih</option>
                            <?php foreach ($variasi as $v) : ?>
                                <option value="<?= $v['id_variasi']; ?>"><?= $v['nama_varian']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="valueVariant">Value Variant <span class="text-secondary">(e.g : ayam, sapi or 500 Garm 1Kg)</span></label>
                        <input type="text" id="valueItem" name="valueItem" class="form-control shadow-sm <?= (validation_show_error('value_item')) ? 'is-invalid' : 'border-0'; ?>" value="<?= old('valueItem') ?>" placeholder="Value Varian" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom" title="Harap isi bidang ini dengan value produk yang anda inputkan">
                        <div class="invalid-feedback"><?= validation_show_error('value_item'); ?></div>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="berat" class="form-label">Berat Produk <span class="text-secondary">(* Harus Dalam Satuan Gram e.g : 1kg = 1000)</span></label>
                <input type="price" class="form-control shadow-sm <?= (validation_show_error('berat')) ? 'is-invalid' : 'border-0'; ?>" id="berat" name="berat" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom" title="Harap masukan berat isi produk yang anda inputkan" placeholder="Berat Produk Anda..." value="<?= old('berat') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('berat'); ?></div>
            </div>
            <div class="mb-4">
                <label for="harga" class="form-label">Harga Produk</label>
                <input type="price" class="form-control shadow-sm <?= (validation_show_error('harga_item')) ? 'is-invalid' : 'border-0'; ?>" id="harga" name="harga" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom" title="Harap masukan harga produk yang akan di jual" placeholder="Harga Produk Anda..." value="<?= old('harga') ?>" onkeypress="return isNumber(event);">
                <div class="invalid-feedback"><?= validation_show_error('harga_item'); ?></div>
            </div>
            <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
            <div class="d-flex justify-content-center" name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom" title="Klik untuk menyimpan perubahan">
                <button type="submit" onclick="clickSubmitEvent(this)" class="btn btn-outline-danger"><i class="bi bi-plus-square-fill"></i><span class="fw-bold"> Tambah Produk Baru</span></button>
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
        $(e).html('<div class="spinner-border spinner-border-sm mx-2" role="status"><span class="visually-hidden">Loading...</span></div>Loading...');

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