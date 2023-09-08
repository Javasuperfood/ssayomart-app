<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Masukan Kupon Baru</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form action="<?= base_url(); ?>dashboard/kupon/kupon/save" method="post">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="nama_kupon" class="form-label">Nama Kupon</label>
                <input type="text" class="form-control" id="nama_kupon" name="nama_kupon" required aria-required="true" placeholder="Nama Kupon Anda" required="" autofocus>
            </div>
            <div class="mb-3">
                <label for="kode_kupon" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode_kupon" name="kode_kupon" required placeholder="Kode Kupon">
            </div>
            <div class="mb-3">
                <label for="Deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi_kupon" name="deskripsi_kupon" rows="3" placeholder="Deskripsi Kupon ...."></textarea>
            </div>
            <div class="mb-3">
                <label for="masa_berlaku" class="form-label mr-3">Masa Berlaku</label>
                <input type="date" id="masa_berlaku" name="masa_berlaku" required placeholder="Masukan Masa Berlaku Kupon">
            </div>
            <div>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>