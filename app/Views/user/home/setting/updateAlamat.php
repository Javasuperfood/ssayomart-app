<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<form class="pt-3">
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" id="label" value="<?= $au['label']; ?>">
            <label for="floatingInput">Label*</label>
        </div>
    </div>

    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" id="penerima" value="<?= $au['penerima']; ?>">
            <label for="floatingInput">Nama Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" id="telp" value="<?= $au['telp']; ?>">
            <label for="floatingInput">Nomor Handphone Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <select class="form-select" aria-label="Default select example" id="provinsi">
                <option selected value="<?= $au['id_province']; ?>"><?= $au['province']; ?></option>
                <?php foreach ($provinsi as $p) : ?>
                    <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="provinsi">Provinsi</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <select class="form-select" aria-label="Default select example" id="kabupaten">
                <option selected value="<?= $au['id_city']; ?>"><?= $au['city']; ?></option>
            </select>
            <label for="kabupaten">Kota</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" id="zip_code" value="<?= $au['zip_code']; ?>">
            <label for=" floatingInput">Kode Pos*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" id="alamat_1" value="<?= $au['alamat_1']; ?>">
            <label for=" floatingInput">Detail Alamat*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control floatingInput" id="alamat_2" value="<?= $au['alamat_2']; ?>">
            <label for=" floatingInput">Detail Alamat (optional)</label>
        </div>
    </div>
    <div class="row fixed-bottom p-3 px-4">
        <a href="<?= base_url() ?>" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</a>
    </div>
</form>

<?= $this->endSection(); ?>