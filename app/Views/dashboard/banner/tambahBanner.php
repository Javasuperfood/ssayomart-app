<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Management Banner Homepage</h1>
<ul class="breadcrumb bg-light ps-0">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard/banner/list-banner" class="text-dark">Management Banner</a></li>
    <li class="breadcrumb-item active text-danger text-decoration-underline">Banner Homepage</li>
</ul>
<p>Anda dapat mengatur banner homepage yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.</p>
<div class="alert alert-danger text-center border-1 my-4 shadow-sm" role="alert">
    <b>Note : Perhatikan ukuran dan resolusi banner sebelum upload ke Aplikasi Ssayomart Supermarket. Disarankan agar menghubungi tim Design untuk penambahan Banner.</b>
</div>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-earmark-plus-fill"></i>
                <h6 class="m-0 font-weight-bold px-2">Masukan Foto Banner Baru</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/banner/tambah-banner/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="banner">Judul Banner</label>
                        <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('title')) ? 'is-invalid' : 'border-1'; ?>" id="title" name="title" rows="3" placeholder="Judul untuk banner Anda..." value="<?= old('title') ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Banner (Home Page)</label>
                        <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img" name="img" value="<?= old('img') ?>" accept="image/jpeg, image/png, image/jpg">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Banner Content (Content Page)</label>
                        <input type="file" class="form-control border-0 shadow-sm <?= (validation_show_error('img')) ? 'is-invalid' : 'border-1'; ?>" id="img_konten" name="img_konten" value="<?= old('img_konten') ?>" accept="image/jpeg, image/png, image/jpg">
                        <div class="invalid-feedback"><?= validation_show_error('img_konten'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="banner">Deskripsi (Optional)</label>
                        <input type="text" class="form-control border-0 shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-1'; ?>" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi untuk banner Anda..." value="<?= old('deskripsi') ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>
                    <hr class="my-4" style="border-width: 1px; border-color: #d1d3e2; border-style: solid;">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-5">
        <div class="card position-relative border-1 shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Banner</h6>
            </div>
            <div class="card-body mt-2">
                <table class="table text-center" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <tr>
                            <th>Gambar Banner (Home Page)</th>
                            <th>Gambar Content (Content Page)</th>
                            <th>Aksi</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner_list as $bl) : ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('assets/img/banner/' . $bl['img']); ?>" class="img-fluid" alt="" width="500" height="500">
                                </td>
                                <td>
                                    <img src="<?= base_url('assets/img/banner/content/' . $bl['img_konten']); ?>" class="img-fluid" alt="" width="120" height="10">
                                </td>
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url() ?>">
                                                <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Lihat Banner
                                            </a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/banner/detail-banner/<?= $bl['id_banner']; ?>">
                                                <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Detail Banner
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteBanner<?= $bl['id_banner']; ?>">
                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                <span class="text-danger">Delete</span>
                                            </a>
                                        </div>
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
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#example');
    </script>
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