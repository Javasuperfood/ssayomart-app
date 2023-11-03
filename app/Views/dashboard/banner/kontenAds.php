<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Management Management Advertisements Artikel</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard/banner/list-banner" class="text-dark">Management Banner</a></li>
    <li class="breadcrumb-item active text-danger">Management Advertisements Artikel</li>
</ul>
<p class="mb-4">Anda dapat mengatur ads pada halaman artikel yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<div class="alert alert-danger text-center border-0 shadow-sm" role="alert">
    <b>Note : perhatikan ukuran dan resolusi gambar atau foto ads serta format gambar harus png agar background transparant sebelum upload ke Aplikasi Ssayomart Supermarket</b>
</div>

<div class="row">
    <!-- Left Panel -->
    <div class="col-lg-6">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">Masukan Foto Adsvertisements Baru</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url(); ?>dashboard/banner/ads-konten-banner/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="banner">Judul Advertisements</label>
                        <input type="text" class="form-control <?= (validation_show_error('title')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="title" name="title" rows="3" placeholder="Judul untuk adsvertisements Anda..." value="<?= old('title') ?>"></input>
                        <div class="invalid-feedback"><?= validation_show_error('title'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Gambar Advertisements</label>
                        <input type="file" class="form-control <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" placeholder="Masukan Gambar" value="<?= old('img') ?>" accept="image/*">
                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="col-lg-6 mb-3">
        <div class="card position-relative border-0 shadow-sm">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-medium">List Banner</h6>
            </div>
            <div class="card-body">
                <table class="table text-center" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <tr>
                            <th>Judul Banner</th>
                            <th>Gambar Banner</th>
                            <th>Aksi</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner_list as $bl) : ?>
                            <tr>
                                <td>
                                    <?= $bl['title']; ?>
                                </td>
                                <td>
                                    <img src="<?= base_url('assets/img/banner/ads/' . $bl['img']); ?>" class="img-fluid" alt="" width="300" height="500">
                                </td>
                                <td class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/banner/update-ads-konten/<?= $bl['id_ads_konten']; ?>">
                                                <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteBanner<?= $bl['id_ads_konten']; ?>">
                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                <span class="text-danger">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- ================= START MODAL DELETE SINGLE PRODUK ================== -->
                                    <div class="modal fade" id="deleteBanner<?= $bl['id_ads_konten']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBanner<?= $bl['id_ads_konten']; ?>" aria-hidden="true">
                                        <div class="modal-dialog text-start text-secondary" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteBanner<?= $bl['id_ads_konten']; ?>">Delete <?= $bl['title']; ?> ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="<?= base_url('assets/img/banner/ads/' . $bl['img']); ?>" class="img-fluid" alt="" width="300" height="500">
                                                    <br><br>
                                                    Pilih Delete untuk Menghapus Gambar <?= $bl['title']; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <form action="<?= base_url() ?>dashboard/banner/ads-konten-banner/delete/<?= $bl['id_ads_konten']; ?>" method="post">
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