<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm border-left-danger mb-4">
    <div class="card-header border-0 py-3 bg-white">
        <h5 class=" mb-0">Pembuat Konten</h5>
    </div>
    <div class="row">
        <div class="card-body d-flex">
            <div class="col-2 text-center top-50 start-0 translate-middle-y">
                <img src="<?= base_url() ?>assets/img/about/bg1.png" class="rounded-circle" style="width: 120px; height: 120px; margin-right: 25px;">
            </div>
            <div class="col-6">
                <div class="mx-0 my-0 mb-0">
                    <div class="form-floating">
                        <input class="form-control border-0 floatingInput text-dark bg-white fw-bold" disabled>
                        <label for="fullname">Nama Lengkap Author</label>
                    </div>
                </div>
                <div class="mx-0 my-0 mb-0">
                    <div class="form-floating">
                        <input class="form-control border-0 floatingInput text-dark bg-white fw-bold" disabled>
                        <label for="username">Username Author</label>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center position-absolute top-50 end-0 translate-middle-y mt-4">
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"> </i> Hapus Konten</button>
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center my-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0">Isi Konten Artikel/Blog</h5>
            </div>
            <div class="card border-0 w-100">
                <textarea class="tinymce border-0 shadow-sm" id="isi_blog" rows="30" name="isi_blog" readonly>
            </textarea>
            </div>
        </div>
    </div>

    <div class=" col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0 text-center">Thumbnail</h5>
            </div>
            <div class="card border-0">
                <div class="card-body border-0 rounded-5 text-center">
                    <img src="" class="img-thumbnail rounded-5" alt="Thumbnail Image" style="width: 400px;">
                </div>
                <div class="card border-0">
                    <div class="card-body border-0">
                        <div class="row">
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="" disabled>
                                    <label for="judul_blog">Judul Artikel/Blog</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="" disabled>
                                    <label for="tanggal_dibuat">Dipublikasikan</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="" disabled>
                                    <label for="slug">Slug</label>
                                </div>
                            </div>
                            <a class="btn btn-warning" href=""><i class="bi bi-gear-fill"> </i> Edit Konten</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>