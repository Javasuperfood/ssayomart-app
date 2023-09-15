<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- mobiler -->
<div class="container d-md-none">
    <div class="row">
        <form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3" onsubmit="return validasiTambahAlamat()">
            <?= csrf_field(); ?>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" name="label" id="label_alamat" value="<?= old('label') ?>">
                    <label for="floatingInput">Label*</label>
                    <span id="labelError" class="text-danger"></span>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('nama_penerima')) ? 'is-invalid' : '' ?>" name="nama_penerima" id="nama_penerima" value="<?= old('nama_penerima') ?>">
                    <label for="floatingInput">Nama Penerima*</label>
                    <span id="namaPenerimaError" class="text-danger"></span>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('no_telp1')) ? 'is-invalid' : '' ?>" name="no_telp1" id="no_telp1" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event);">
                    <label for=" floatingInput">Nomor Handphone Penerima*</label>
                    <span id="nomerPenerimaError" class="text-danger"></span>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('no_telp2')) ? 'is-invalid' : '' ?>" name="no_telp2" value="<?= old('no_telp2') ?>" onkeypress="return isNumber(event);">
                    <label for=" floatingInput">Nomor Handphone Penerima (optional)</label>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <select class="form-select" aria-label="Default select example" id="provinsi" name="id_provinsi">
                        <option selected></option>
                        <?php foreach ($provinsi as $p) : ?>
                            <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="provinsi">Provinsi</label>
                    <span id="provinsiError" class="text-danger"></span>
                </div>
            </div>

            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <select class="form-select" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                        <option selected></option>
                    </select>
                    <label for="kabupaten">Kabupaten/Kota</label>
                    <span id="kabupatenError" class="text-danger"></span>
                </div>
            </div>
            <input type="hidden" class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" id="inputProvinsi" name="provinsi">
            <input type="hidden" class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" id="inputKabupaten" name="kabupaten">

            <div class=" mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" id="zip_code" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event);">
                    <label for=" floatingInput">Kode Pos*</label>
                    <span id="kodePosError" class="text-danger"></span>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" id="alamat_1" value="<?= old('alamat_1') ?>">
                    <label for=" floatingInput">Detail Alamat*</label>
                    <span id="detailError" class="text-danger"></span>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" value="<?= old('alamat_2') ?>">
                    <label for=" floatingInput">Patokan Alamat (optional)</label>
                    <span id="patokanError" class="text-danger"></span>
                </div>
            </div>
            <div class="row p-3 px-4">
                <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Tambah</button>
            </div>
        </form>
    </div>
</div>
<!-- end mobile -->

<!-- dekstop -->
<div class="container d-none d-md-block">
    <figure class="text-center ">
        <blockquote class="blockquote">
            <p> Masukan Alamat Pengiriman</p>
        </blockquote>
        <figcaption class="blockquote-footer">
            Masukan Alamat Anda <cite title="Source Title">atau Tambah Alamat</cite>
        </figcaption>
    </figure>
    <!-- form -->
    <form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3 row g-3 mt-4" onsubmit="return validasiTambahAlamat()">
        <?= csrf_field(); ?>
        <div class="col-md-6">
            <label for="floatingInput">Label<span style="color: red">*</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" name="label" id="label_alamat" value="<?= old('label') ?>">
            <span id="labelError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            <label for="floatingInput">Nama Penerima<span style="color: red">*</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('nama_penerima')) ? 'is-invalid' : '' ?>" name="nama_penerima" id="nama_penerima" value="<?= old('nama_penerima') ?>">
            <span id="namaPenerimaError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            <label for=" floatingInput">Nomor Handphone Penerima<span style="color: red">*</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('no_telp1')) ? 'is-invalid' : '' ?>" name="no_telp1" id="no_telp1" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event);">
            <span id="nomerPenerimaError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            <label for=" floatingInput">Nomor Handphone Penerima<span style="color: red">(Opsional)</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('no_telp2')) ? 'is-invalid' : '' ?>" name="no_telp2" value="<?= old('no_telp2') ?>" onkeypress="return isNumber(event);">
        </div>
        <!-- dropdown -->
        <div class="col-12">
            <div class="form-floating">
                <select class="form-select" aria-label="Default select example" id="provinsi" name="id_provinsi">
                    <option selected></option>
                    <?php foreach ($provinsi as $p) : ?>
                        <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="provinsi">Provinsi<span style="color: red">*</span></label>
                <span id="provinsiError" class="text-danger"></span>
            </div>
        </div>

        <div class="col-12">
            <div class="form-floating">
                <select class="form-select" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                    <option selected></option>
                </select>
                <label for="kabupaten">Kabupaten/Kota<span style="color: red">*</span></label>
                <span id="kabupatenError" class="text-danger"></span>
            </div>
        </div>
        <input type="hidden" class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" id="inputProvinsi" name="provinsi">
        <input type="hidden" class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" id="inputKabupaten" name="kabupaten">
        <!-- end dropdown -->
        <div class="col-md-6">
            <label for=" floatingInput">Detail Alamat<span style="color: red">*</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" id="alamat_1" value="<?= old('alamat_1') ?>">
            <span id="detailError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            <label for=" floatingInput">Patokan Alamat<span style="color: red">*</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" value="<?= old('alamat_2') ?>">
            <span id="patokanError" class="text-danger"></span>
        </div>
        <div class="col-md-6">
            <label for=" floatingInput">Kode POS<span style="color: red">*</span></label>
            <input class="form-control floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" id="zip_code" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event);">
            <span id="kodePosError" class="text-danger"></span>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-lg" style="background-color: #ec2614; color: #fff;">Tambah</button>
        </div>
    </form>


</div>

<!-- end desktop -->


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

    // validasi form
    function validasiTambahAlamat() {
        var isValid = true;

        var labelField = document.getElementById('label_alamat');
        var namaPenerimaField = document.getElementById('nama_penerima');
        var nomerPenerimaField = document.getElementById('no_telp1');
        var provinsiField = document.getElementById('provinsi');
        var kabupatenField = document.getElementById('kabupaten');
        var kodePosField = document.getElementById('zip_code');
        var detailField = document.getElementById('alamat_1');
        var patokanField = document.getElementById('alamat_2');

        var labelError = document.getElementById('labelError');
        var namaPenerimaError = document.getElementById('namaPenerimaError');
        var nomerPenerimaError = document.getElementById('nomerPenerimaError');
        var provinsiError = document.getElementById('provinsiError');
        var kabupatenError = document.getElementById('kabupatenError');
        var kodePosError = document.getElementById('kodePosError');
        var detailError = document.getElementById('detailError');
        var patokanError = document.getElementById('patokanError');

        labelError.textContent = '';
        namaPenerimaError.textContent = '';
        nomerPenerimaError.textContent = '';
        provinsiError.textContent = '';
        kabupatenError.textContent = '';
        kodePosError.textContent = '';
        detailError.textContent = '';
        patokanError.textContent = '';

        if (labelField.value.trim() === '') {
            labelField.classList.add('invalid-field');
            labelError.textContent = 'label harus diisi';
            isValid = false;
        } else {
            labelField.classList.remove('invalid-field');
        }

        if (namaPenerimaField.value.trim() === '') {
            namaPenerimaField.classList.add('invalid-field');
            namaPenerimaError.textContent = 'Nama Penerima harus diisi';
            isValid = false;
        } else {
            namaPenerimaField.classList.remove('invalid-field');
        }

        if (nomerPenerimaField.value.trim() === '') {
            nomerPenerimaField.classList.add('invalid-field');
            nomerPenerimaError.textContent = 'Nomer Penerima harus diisi';
            isValid = false;
        } else {
            nomerPenerimaField
                .classList.remove('invalid-field');
        }

        if (provinsiField.value.trim() === '') {
            provinsiField.classList.add('invalid-field');
            provinsiError.textContent = 'Provinsi harus diisi';
            isValid = false;
        } else {
            provinsiField.classList.remove('invalid-field');
        }

        if (kabupatenField.value.trim() === '') {
            kabupatenField.classList.add('invalid-field');
            kabupatenError.textContent = 'Kabupaten harus diisi';
            isValid = false;
        } else {
            kabupatenField.classList.remove('invalid-field');
        }

        if (kodePosField.value.trim() === '') {
            kodePosField.classList.add('invalid-field');
            kodePosError.textContent = 'Kode POS harus diisi';
            isValid = false;
        } else {
            kodePosField.classList.remove('invalid-field');
        }

        if (detailField.value.trim() === '') {
            detailField.classList.add('invalid-field');
            detailError.textContent = 'Detail Alamat harus diisi';
            isValid = false;
        } else {
            detailField.classList.remove('invalid-field');
        }

        if (patokanField.value.trim() === '') {
            patokanField.classList.add('invalid-field');
            patokanError.textContent = 'Patokan harus diisi';
            isValid = false;
        } else {
            patokanField.classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>