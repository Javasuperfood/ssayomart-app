<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<form class="pt-3">
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for="floatingInput">Lable*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input type="disable" class="form-control" id="floatingInput" value="<?= $nama; ?>">
            <label for="floatingInput">Nama Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input type="disable" class="form-control" id="floatingInput" value="<?= $telp; ?>">
            <label for="floatingInput">Nomor Handphone Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for="floatingInput">Nomor Telephone Penerima (optional)</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <select class="form-select" aria-label="Default select example" id="provinsi">
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
            <select class="form-select" aria-label="Default select example" id="kabupaten">
                <option selected></option>
            </select>
            <label for="kabupaten">Kota</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Kode Pos*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Detail Alamat*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Detail Alamat (optional)</label>
        </div>
    </div>
    <div class="row fixed-bottom p-3 px-4">
        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</button>
    </div>
</form>

<?= $this->endSection(); ?>