<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Kategori</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form method="POST" action="<?= base_url(); ?>dashboard/kategori/update/<?= $kategori['id_kategori'] ?>">
            <!-- Isi formulir edit kategori -->
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id" placeholder="Masukan nama kategori" name="id" value="<?= $kategori['id_kategori'] ?>">
            <div class="mb-3">
                <label for="kategori" class="form-label">Nama</label>
                <input type="text" class="form-control" id="kategori" placeholder="Masukan nama kategori" name="kategori" value="<?= $kategori['nama_kategori'] ?>">
            </div>

            <!-- <div class="mb-1">
                <label for="kategori" class="form-label">Induk Kategori</label>
            </div>
            <div>
                <select class="form-select mb-2" aria-label="Default select example" name="induk">
                    <option selected>Pilihan</option>
                    <option value="1">bahan Makanan</option>
                    <option value="2">Biji Wijen</option>
                    <option value="3">Gula dan Garam</option>
                </select>
            </div> -->

            <div class="mb-3">
                <label for="kategori" class="form-label">Masukan Ganbar</label>
                <input type="file" class="form-control" id="kategori" placeholder="Masukan nama kategori" name="gambar_kategori">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                <input style="height: 100px;" type="text" class="form-control" id="deskripsi" placeholder="Masukan keterangan" cols="30" rows="10" name="deskripsi" value="<?= $kategori['deskripsi'] ?>">

            </div>
            <div class="small mb-1">Navbar Dropdown Example:</div>
            <p class="mb-0 small">Note: Umumnya deskripsi tidak tampil. Namun, beberapa tema dapat menampilkannya.</p>
            <div>
                <button type="submit" class="btn btn-primary mt-3" id="ka">Simpan</button>
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