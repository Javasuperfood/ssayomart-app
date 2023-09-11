<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container">
    <div class="row">
        <form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3">
            <?= csrf_field(); ?>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" name="label" value="<?= old('label') ?>">
                    <label for="floatingInput">Label*</label>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('nama_penerima')) ? 'is-invalid' : '' ?>" name="nama_penerima" value="<?= old('nama_penerima') ?>">
                    <label for="floatingInput">Nama Penerima*</label>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('no_telp1')) ? 'is-invalid' : '' ?>" name="no_telp1" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event);">
                    <label for=" floatingInput">Nomor Handphone Penerima*</label>
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
                </div>
            </div>

            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <select class="form-select" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                        <option selected></option>
                    </select>
                    <label for="kabupaten">Kabupaten/Kota</label>
                </div>
            </div>
            <input type="hidden" class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" id="inputProvinsi" name="provinsi">
            <input type="hidden" class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" id="inputKabupaten" name="kabupaten">

            <div class=" mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event);">
                    <label for=" floatingInput">Kode Pos*</label>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" value="<?= old('alamat_1') ?>">
                    <label for=" floatingInput">Detail Alamat*</label>
                </div>
            </div>
            <div class="mb-3 mx-3 my-3">
                <div class="form-floating">
                    <input class="form-control floatingInput <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" value="<?= old('alamat_2') ?>">
                    <label for=" floatingInput">Patokan Alamat (optional)</label>
                </div>
            </div>
            <div class="row p-3 px-4">
                <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Tambah</button>
            </div>
        </form>
    </div>
</div>
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