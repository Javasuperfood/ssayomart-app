<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Kategori Produk</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item"><a class="text-secondary" href="<?= base_url(); ?>dashboard/kategori">List Kategori</a>
    </li>
    <li class="breadcrumb-item text-danger active text-decoration-underline">Tambah Kategori</li>
</ul>

<div class="row mb-5">
    <!-- Left Panel -->
    <div class="col">
        <div class="card border-1 shadow-sm shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-plus-circle-fill fs-5 text-danger"></i>
                <h6 class="m-0 font-weight-bold px-2 text-dark">Tambah Kategori & Sub Kategori</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/kategori/tambah-kategori/save" method="post"
                    enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class=" mb-4">
                        <label for="nama_kategori" class="form-label">Nama Kategori atau Sub Kategori Bahasa
                            Indonesia<span class="text-danger"> *</span></label>
                        <input type="text"
                            class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kategori')) ? 'is-invalid' : 'border-1'; ?>"
                            id="kategori" data-toggle="tooltip" data-placement="bottom"
                            title="Harap isi bidang ini dengan Nama Kategori atau Sub-Kategori dalam bahasa Indonesia"
                            placeholder="Masukan nama kategori atau sub kategori" name="nama_kategori"
                            value="<?= old('nama_kategori') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama_kategori'); ?></div>
                    </div>
                    <div class=" mb-4">
                        <label for="nama_kategori_en" class="form-label">Nama Kategori atau Sub Kategori Bahasa
                            Inggris<span class="text-danger"> *</span></label>
                        <input type="text"
                            class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kategori_en')) ? 'is-invalid' : 'border-1'; ?>"
                            id="kategori" data-toggle="tooltip" data-placement="bottom"
                            title="Harap isi bidang ini dengan Nama Kategori atau Sub-Kategori dalam bahasa Inggris"
                            placeholder="Masukan nama kategori atau sub kategori" name="nama_kategori_en"
                            value="<?= old('nama_kategori_en') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama_kategori_en'); ?></div>
                    </div>
                    <div class=" mb-4">
                        <label for="nama_kategori_kr" class="form-label">Nama Kategori atau Sub Kategori Bahasa
                            Korea<span class="text-danger"> *</span></label>
                        <input type="text"
                            class="form-control border-0 shadow-sm <?= (validation_show_error('nama_kategori_kr')) ? 'is-invalid' : 'border-1'; ?>"
                            id="kategori" data-toggle="tooltip" data-placement="bottom"
                            title="Harap isi bidang ini dengan Nama Kategori atau Sub-Kategori dalam bahasa Korea"
                            placeholder="Masukan nama kategori atau sub kategori" name="nama_kategori_kr"
                            value="<?= old('nama_kategori_kr') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('nama_kategori_kr'); ?></div>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
                            <b>Untuk pengisian Slug bisa dikosongkan karena Slug akan otomatis menyesuaikan dengan Nama Kategori atau Sub Kategori.</b>
                        </div>
                        <input type="text" class="form-control border-0 shadow-sm border-0 shadow-sm" id="slug" placeholder="Masukan nama slug" name="slug" value="<?= old('slug') ?>">
                    </div> -->
                    <div class="alert alert-danger text-center border-1 shadow-sm my-4" role="alert">
                        <b>Isi Kategori Induk jika anda ingin menambahkan item sebagai SUB KATEGORI. Kosongkan jika anda
                            ingin menambahkan item sebagai KATEGORI</b>
                    </div>
                    <label for="parent_kategori_id">Kategori Induk</label>
                    <select class="form-control border-0 shadow-sm border-1" id="parent_kategori_id"
                        name="parent_kategori_id" data-toggle="tooltip" data-placement="bottom"
                        title="Harap Kosongkan apabila kategori utama">
                        <option value="">Pilih Kategori Induk (KOSONGKAN INI JIKA ANDA INGIN MENAMBAHKAN KATEGORI INDUK)
                        </option>
                        <?php foreach ($kategori as $k) : ?>
                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mb-4">
                        <div class="alert alert-danger text-center border-1 shadow-sm my-4" role="alert">
                            <b>Dimensi foto harus berbentuk persegi! (Cth: 256px x 256px atau 512px x 512px)</b>
                            <b>Jika anda menambahkan SUB KATEGORI, tidak memerlukan mengisi gambar</b>
                        </div>
                        <label for="img" class="form-label" data-toggle="tooltip" data-placement="bottom"
                            title="Harap isi bidang ini dengan gambar kategori">Masukan Gambar<span class="text-danger">
                                *</span></label>
                        <input type="file"
                            class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>"
                            id="img" name="img" accept="image/*">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>

                    <div class="mb-4">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi<span class="text-danger">
                                *</span></label>
                        <textarea type="text"
                            class="form-control border-0 shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>"
                            id="deskripsi" data-toggle="tooltip" data-placement="bottom"
                            title="Harap isi bidang ini dengan Deskripsi" rows="3"
                            placeholder="Masukan deskripsi kategori atau sub kategori"
                            name="deskripsi"><?= old('deskripsi') ?></textarea>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-danger" onclick="clickSubmitEvent(this)"><i
                                class="bi bi-plus-circle text-danger"></i>&nbsp;Tambah Kategori</button>
                    </div>
                </form>
            </div>
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
</script>

<?= $this->endSection(); ?>