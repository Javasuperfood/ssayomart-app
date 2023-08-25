<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<form class="pt-3">
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for="floatingInput">Nama Penerima*</label>
        </div>
    </div>
    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for="floatingInput">Nomor Handphone Penerima*</label>
        </div>
    </div>

    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Provinsi*</label>
        </div>
    </div>

    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Kabupaten/Kota*</label>
        </div>
    </div>

    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Kecamatan*</label>
        </div>
    </div>

    <div class="mb-3 mx-3 my-3">
        <div class="form-floating">
            <input class="form-control" id="floatingInput">
            <label for=" floatingInput">Desa*</label>
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
            <label for="floatingInput">Catatan Pengiriman (optional)</label>
        </div>
    </div>
    <div class="row fixed-bottom p-3 px-4">
        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Tambah</button>
    </div>
</form>

<?= $this->endSection(); ?>