<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>


<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>MOHON TELITI KETIKA MENGISI KONTEN UNTUK MENGHINDARI KESALAHAN YANG TIDAK DIINGINKAN!!</b>
</div>

<div class="row mb-4">

    <!-- Left Panel -->
    <div class="col">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Masukan Konten</h6>
            </div>
            <div class="card-body">
                <!-- code -->

                <div class="mb-3">
                    <label for="judul_blog" class="form-label">Juduk Blog</label>
                    <input type="text" class="form-control" id="judul" placeholder="Masukan Judul Blog" name="judul">
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal dibuat</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Masukan tanggal pembuatan" name="tanggal">
                </div>

                <div class="mb-3">
                    <label for="tumbhnail" class="form-label">Gambar Thumbnail</label>
                    <input type="file" class="form-control" id="tumbhnail" placeholder="Masukan gambar thumbnail" name="tumbhnail">
                </div>

                <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                    <b>Untuk pengisian gambar dan deskripsi perhatikan lagi kata dan kalimat agar tidak terjadi typo</b>
                </div>

                <div class="mb-3">
                    <label for="blog1" class="form-label">Gambar Blog 1</label>
                    <input type="file" class="form-control" id="blog1" placeholder="Masukan gambar thumbnail" name="blog1">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Blog 1</label>
                    <textarea type="text" class="form-control" id="deskripsi1" rows="3" placeholder="Masukan Deskripsi" name="deskripsi1"></textarea>
                </div>

                <div class="mb-3">
                    <label for="blog2" class="form-label">Gambar Blog 2</label>
                    <input type="file" class="form-control" id="blog2" placeholder="Masukan gambar thumbnail" name="blog2">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea2" class="form-label">Deskripsi Blog 2</label>
                    <textarea type="text" class="form-control" id="deskripsi2" rows="3" placeholder="Masukan Deskripsi" name="deskripsi2"></textarea>
                </div>

                <div class="mb-3">
                    <label for="blog3" class="form-label">Gambar Blog 3</label>
                    <input type="file" class="form-control" id="blog3" placeholder="Masukan gambar thumbnail" name="blog3">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Blog 3</label>
                    <textarea type="text" class="form-control" id="deskripsi1" rows="3" placeholder="Masukan Deskripsi" name="deskripsi1"></textarea>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                        <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Nama Kategori atau Sub Kategori.</b>
                    </div>
                    <input type="text" class="form-control" id="slug" placeholder="Masukan nama slug" name="slug">
                </div>

                <button type="submit" class="btn btn-danger mt-3" id="ka">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>