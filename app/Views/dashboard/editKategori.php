<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card position-relative">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Kategori</h6>
    </div>
    <div class="card-body">
        <!-- code -->
        <form method="POST" enctype="multipart/form-data" action="<?= base_url(); ?>dashboard/kategori/update/<?= $kategori['id_kategori'] ?>">
            <!-- Isi formulir edit kategori -->
            <?= csrf_field(); ?>
            <input type="hidden" class="form-control" id="id" placeholder="Masukan nama kategori" name="id" value="<?= $kategori['id_kategori'] ?>">
            <div class="mb-3">
                <label for="kategori" class="form-label">Nama</label>
                <input type="text" class="form-control" id="kategori" placeholder="Masukan nama kategori" name="kategori" value="<?= $kategori['nama_kategori'] ?>">
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= $kategori['slug'] ?>">
            </div>


            <div class="mb-3">
                <label for="kategori" class="form-label">Masukan Ganbar</label>
                <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori" value="<?= $kategori['img'] ?>">
                <input type="hidden" name="imageLama" value="<?= $kategori['img']; ?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi" value="<?= $kategori['deskripsi'] ?>"></textarea>
            </div>

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