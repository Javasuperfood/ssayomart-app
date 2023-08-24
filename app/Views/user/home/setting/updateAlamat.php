<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<form class="pt-3">
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
        <div class="card form-control form-control-md">
            <div class="row">
                <div class="col-1">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="col-11">
                    <a href="#" class="card-text text-secondary link-underline link-underline-opacity-0"><?= substr($alamat, 0, 35); ?>...</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input type="disable" class="form-control" id="floatingInput" value="<?= $alamat; ?>">
            <label for="floatingInput">Detail Alamat*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input type="disable" class="form-control" id="floatingInput" value="<?= $catatan; ?>">
            <label for="floatingInput">Catatan Pengiriman*</label>
        </div>
    </div>
    <div class="row fixed-bottom p-3 px-4">
        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</button>
    </div>
</form>

<?= $this->endSection(); ?>