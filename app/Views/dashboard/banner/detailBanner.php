<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card border-0 shadow-sm border-left-danger mb-4">
    <div class="card-header border-0 py-3 bg-white">
        <h5 class=" mb-0">Banner Homepage</h5>
    </div>
    <div class="row">
        <div class="card-body d-flex">
            <div class="col text-center">
                <img src="<?= base_url() ?>assets/img/banner/<?= $bl['img'] ?>" class="mx-auto d-block rounded-3" width="800" height="300">
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center my-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0">Edit Banner Homepage dan Content</h5>
            </div>
            <div class="card-body border-0 w-100">
                <form action="<?= base_url(); ?>dashboard/banner/detail-banner/update/<?= $bl['id_banner'] ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control border-0 shadow-sm" id="id_banner" name="id_banner" value="<?= $bl['id_banner'] ?>">
                    <div class="mb-3">
                        <label for="banner">Judul Banner</label>
                        <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" rows="3" placeholder="Judul untuk banner Anda..." value="<?= $bl['title'] ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Banner (Home Page)</label>
                        <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" value="<?= $bl['img'] ?>" accept="image/*">
                        <input type="hidden" name="imageLama" value="<?= $bl['img']; ?>">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Banner Content (Content Page)</label>
                        <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img_konten" name="img_konten" value="<?= $bl['img_konten'] ?>" accept="image/*">
                        <input type="hidden" name="imageContentLama" value="<?= $bl['img_konten']; ?>">
                        <div class="invalid-feedback"><?= validation_show_error('img_konten'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="banner">Deskripsi (Optional)</label>
                        <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi untuk banner Anda..." value="<?= $bl['deskripsi'] ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger fw-bold">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class=" col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header border-0 py-3">
                <h5 class="mb-0 text-center">Content</h5>
            </div>
            <div class="card border-0">
                <div class="card-body border-0 rounded-5 text-center">
                    <img src="<?= base_url() ?>assets/img/banner/content/<?= $bl['img_konten'] ?>" class="img-thumbnail rounded-5" alt="Thumbnail Image" style="width: 400px;">
                </div>
                <div class="card border-0">
                    <div class="card-body border-0">
                        <div class="row">
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $bl['title'] ?>" disabled>
                                    <label for="judul_blog">Judul</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $bl['created_at'] ?>" disabled>
                                    <label for="tanggal_dibuat">Dipublikasikan</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 mb-3">
                                <div class="form-floating">
                                    <input class="form-control border-0 shadow-sm floatingInput text-dark bg-white border-left-danger" value="<?= $bl['deskripsi'] ?>" disabled>
                                    <label for="slug">Deskripsi</label>
                                </div>
                            </div>
                            <div class="mx-0 my-0 my-3 text-center">
                                <a href="#" class="btn btn-danger fw-bold" data-toggle="modal" data-target="#deleteBanner<?= $bl['id_banner']; ?>">
                                    <i class="bi bi-trash-fill"> Hapus Banner & Konten </i>
                                </a>
                            </div>
                            <!-- ================= START MODAL DELETE SINGLE GAMBAR ================== -->
                            <div class="modal fade" id="deleteBanner<?= $bl['id_banner']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBanner<?= $bl['id_banner']; ?>" aria-hidden="true">
                                <div class="modal-dialog text-start text-secondary" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBanner<?= $bl['id_banner']; ?>">Delete <?= $bl['title']; ?> ?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="<?= base_url('assets/img/banner/' . $bl['img']); ?>" class="img-fluid" alt="" width="300" height="500">
                                            <br><br>
                                            Pilih Delete untuk Menghapus Gambar <?= $bl['title']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <form action="<?= base_url() ?>dashboard/banner/tambah-banner/delete/<?= $bl['id_banner']; ?>" method="post">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="pager" value="<?= (isset($_GET['page_produk']) ? $_GET['page_produk'] : '1'); ?>">
                                                <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ================= END MODAL DELETE SINGLE PRODUK ================== -->
                        </div>
                    </div>
                </div>
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