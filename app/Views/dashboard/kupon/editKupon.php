<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Masukan Perubahan</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/kupon/update-kupon/<?= $kp['id_kupon'] ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id_kupon" name="id_kupon" required value="<?= $kp['id_kupon'] ?>">
            <div class="mb-3">
                <label for="nama_kupon" class="form-label">Nama Kupon</label>
                <input type="text" class="form-control" id="nama_kupon" name="nama_kupon" required value="<?= $kp['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="kode_kupon" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode_kupon" name="kode_kupon" required value="<?= $kp['kode'] ?>">
            </div>
            <div class="mb-3">
                <label for="Deskripsi">Deskripsi</label>
                <input type="text" style="height: 100px;" class="form-control" id="deskripsi_kupon" name="deskripsi_kupon" rows="3" value="<?= $kp['deskripsi'] ?>"></textarea>
            </div>
            <div class="mb-3">
                <label for="masa_berlaku" class="form-label mr-3">Masa Berlaku</label>
                <input type="date" id="masa_berlaku" name="masa_berlaku" required value="<?= $kp['is_active'] ?>">
            </div>
            <div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>