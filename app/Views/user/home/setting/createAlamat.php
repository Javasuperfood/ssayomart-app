<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3">
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" name="label" value="<?= old('label') ?>">
            <label for="floatingInput">Label*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" name="nama_penerima">
            <label for="floatingInput">Nama Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" name="no_telp1">
            <label for="floatingInput">Nomor Handphone Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" name="no_telp2">
            <label for="floatingInput">Nomor Handphone Penerima (optional)</label>
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
    <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi">
    <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten">

    <div class=" mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" name="zip_code">
            <label for=" floatingInput">Kode Pos*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" name="alamat_1">
            <label for=" floatingInput">Detail Alamat*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" name="alamat_2">
            <label for=" floatingInput">Patokan Alamat (optional)</label>
        </div>
    </div>
    <?= csrf_field() ?>
    <div class="row fixed-bottom p-3 px-4">
        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Tambah</button>
    </div>
</form>

<div class="row py-5">
    <div class="col"></div>
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