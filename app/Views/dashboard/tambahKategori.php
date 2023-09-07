<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Kategori Produk</h1>
<p class="mb-4">Kategori produk untuk toko Anda dapat diatur di sini. Untuk mengganti urutan kategori di ujung depan, Anda dapat seret-lepas untuk mengurutkannya. Untuk melihat kategori lainnya klik tautan "Opsi Layar" pada bagian atas halaman.</p>

<div class="row">

    <!-- Left Panel -->
    <div class="col">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form submit</h6>
            </div>
            <div class="card-body">
                <!-- code -->
                <form action="<?= base_url(); ?>dashboard/tambah-kategori/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kategori" placeholder="Masukan nama kategori" name="kategori">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="Masukan nama slug" name="slug">
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
                        <label for="gambar_kategori" class="form-label">Masukan Gambar</label>
                        <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori" placeholder="Masukan Gambar">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" id="ka">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>