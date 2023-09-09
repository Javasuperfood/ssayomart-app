<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Masukan Perubahan</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/kupon/update-kupon/<?= $kp['id_kupon'] ?>" method="post" class="was-validated">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_kupon" name="id_kupon" required value="<?= $kp['id_kupon'] ?>">
            <div class="mb-3">
                <label for="validationCustom07" class="form-label">Nama Kupon</label>
                <input type="text" class="form-control" id="validationCustom07" name="nama_kupon" required value="<?= $kp['nama'] ?>" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom08" class="form-label">Kode</label>
                <input type="text" class="form-control" id="validationCustom08" name="kode_kupon" required value="<?= $kp['kode'] ?>" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom09">Deskripsi</label>
                <input type="text" style="height: 100px;" class="form-control" id="validationCustom09" name="deskripsi_kupon" rows="3" value="<?= $kp['deskripsi'] ?>" required></textarea>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom10" class="form-label">Diskon</label>
                <input type="text" class="form-control" id="validationCustom010" name="discount" required value="<?= $kp['discount'] ?>" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom11" class="form-label">Total Pembelian</label>
                <input type="text" class="form-control" id="validationCustom11" name="total_buy" required value="<?= $kp['total_buy'] ?>" required>
                <div class="invalid-feedback">Isi semua form input!</div>
            </div>
            <div class="mb-3">
                <label for="validationCustom12" class="form-label mr-3">Masa Berlaku</label>
                <input type="date" id="validationCustom12" name="masa_berlaku" value="<?= $kp['is_active'] ?>" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>