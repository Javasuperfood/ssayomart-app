<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Kategori Produk</h1>

<div class="row">
    <!-- Left Panel -->
    <div class="col">
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-bold text-danger">Tambah Kategori & Sub Kategori</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/kategori/tambah-kategori/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <!-- pilih produk yang akan diberikan promo -->
                    <div class="mb-3">
                        <label for="produk" class="form-label text-secondary">Pilih Produk Yang Akan Diberikan Promo</label>
                        <button type="button" class="btn form-control shadow-sm border-0 text-left view-product" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tekan Untuk Memilih Produk
                        </button>
                    </div>

                    <!-- Modal Box Produk -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">List Produk Tersedia</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input pencarian -->
                                    <div class="mb-3">
                                        <input type="text" id="searchProduct" class="form-control" placeholder="Cari produk berdasarkan nama...">
                                    </div>
                                    <div class="row" id="productList">

                                        <div class="col-6 mb-3 px-3">
                                            <div class="card border-0">
                                                <div class="row g-0">
                                                    <div class="card-body border-0 shadow-sm">
                                                        <div class="row">


                                                            <div class="col-1">
                                                                <input type="radio" id="produkRadio" class="border-0">
                                                            </div>

                                                            <div class="col-3">
                                                                <img src="#" class="img-fluid">
                                                            </div>
                                                            <div class="col-8">
                                                                <p class="nama item" </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pesan "Produk tidak tersedia" -->
                                    <div id="noProductAlert" class="alert alert-danger rounded border-0" style="display: none;">
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="bi bi-exclamation-triangle-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i>
                                            </div>
                                            <div class="col-10 text-center">
                                                <span class="fs-6">Produk tidak tersedia!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pilih produk -->
                    <div class="mb-3">
                        <label for="produk" class="form-label text-secondary">Produk Terpilih</label>
                        <input type="text" class="form-control border-0 shadow-sm bg-white" id="produkTerpilih" name="produk" placeholder="Pilih Produk Terlebih Dahulu..." disabled>
                        <span id="produkError" class="text-danger"></span>
                    </div>
                    <div class=" mb-3">
                        <label for="kategori" class="form-label">Nama Kategori atau Sub Kategori</label>
                        <input type="text" class="form-control <?= (validation_show_error('nama_kategori')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kategori" placeholder="Masukan nama kategori atau sub kategori" name="kategori" value="<?= old('kategori') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama_kategori'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Nama Kategori atau Sub Kategori.</b>
                        </div>
                        <input type="text" class="form-control border-0 shadow-sm" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= old('slug') ?>">
                    </div>
                    <label for="parent_kategori_id">Kategori Induk</label>
                    <select class="form-control border-0 shadow-sm" id="parent_kategori_id" name="parent_kategori_id">
                        <option value="">Pilih Kategori Induk (kosongkan jika untuk kategori utama)</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mb-3">
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                        </div>
                        <label for="img" class="form-label">Masukan Gambar</label>
                        <input type="file" class="form-control <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" placeholder="Masukan Gambar">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="deskripsi" rows="3" name="deskripsi" value="<?= old('deskripsi') ?>"></textarea>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>
                    <button type="submit" class="btn btn-danger mt-3">Simpan</button>
            </div>
            </form>
        </div>
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

    //Validasi Form
    function validasiTambahKategori() {
        var isValid = true;

        var namaKategoriField = document.getElementById('kategori');
        var imgField = document.getElementById('img');
        var deskripsiField = document.getElementById('deskripsi');

        var namaKategoriError = document.getElementById('kategoriError');
        var deskripsiError = document.getElementById('deskripsiError');

        namaKategoriError.textContent = '';
        imgError.textContent = '';
        deskripsiError.textContent = '';

        if (namaKategoriField.value.trim() === '') {
            namaKategoriField.classList.add('invalid-field');
            namaKategoriError.textContent = 'Nama Kategori harus diisi';
            isValid = false;
        } else {
            namaKategoriField.classList.remove('invalid-field');
        }

        if (deskripsiField.value.trim() === '') {
            deskripsiField.classList.add('invalid-field');
            deskripsiError.textContent = 'Deskripsi harus diisi';
            isValid = false;
        } else {
            deskripsiField.classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>