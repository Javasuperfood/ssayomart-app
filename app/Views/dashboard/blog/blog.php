<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Manajemen Konten Artikel/Blog Ssayomart</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item text-danger text-decoration-underline active">List Artikel/Blog</li>
    <li class="breadcrumb-item text-secondary"></li>
</ul>
<p class="mb-4">Anda dapat mengatur konten artikel/blog informasi, produk, resep, dan media yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.</p>
<a class="btn btn-danger mb-4" href="<?= base_url(); ?>dashboard/blog/tambah-konten"><i class="bi bi-plus-circle"></i> Tambah Konten</a>

<div class="card border-1 shadow-sm mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-text-fill"></i>
        <h6 class="m-0 fw-bold px-2">Konten Blog Site</h6>
    </div>
    <div class="card-body mt-2">
        <div class="table-responsive">
            <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Konten</th>
                        <th>Tanggal Publish</th>
                        <th>Dipublish Oleh</th>
                        <th>Gambar Thumbnail</th>
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($blog_model as $bm) : ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $bm['judul_blog']; ?></td>
                            <td class="align-middle"><?= strftime('%d %B %Y %H:%M', strtotime($bm['tanggal_dibuat'])); ?></td>
                            <td class="align-middle"><?= $bm['username']; ?></td>
                            <td class="align-middle">
                                <img src="<?= base_url('assets/img/blog/' . $bm['img_thumbnail']); ?>" class="img-fluid rounded-3" alt="" width="100px" height="100px">
                            </td>
                            <td class="align-middle"><?= $bm['slug']; ?></td>
                            <td class="text-center align-middle">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="<?= base_url() ?>blog/<?= $bm['id_blog']; ?>" target="__blank">
                                            <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Lihat Konten
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('dashboard/blog/detail-konten/' . $bm['id_blog']); ?>">
                                            <i class="bi bi-search fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Detail Konten
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url() ?>dashboard/blog/update-konten/<?= $bm['id_blog'] ?>">
                                            <i class="bi bi-gear-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Edit Konten
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteArtikel<?= $bm['id_blog'] ?>">
                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Hapus Artikel</span>
                                        </a>
                                    </div>
                                    <div class="modal fade" id="deleteArtikel<?= $bm['id_blog'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteArtikel<?= $bm['id_blog'] ?>" aria-hidden="true">
                                        <div class="modal-dialog text-start text-secondary" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteArtikel<?= $bm['id_blog'] ?>">Hapus Artikel <b class="text-uppercase text-danger"><?= $bm['judul_blog']; ?></b>?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="<?= base_url('assets/img/blog/' . $bm['img_thumbnail']); ?>" class="img-fluid" alt="" width="300" height="500">
                                                    <br><br>
                                                    Pilih tombol "Hapus" untuk menghapus Artikel <b class="text-uppercase text-danger"><?= $bm['judul_blog']; ?></b> secara <b class="text-danger">PERMANENT</b>.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <form action="<?= base_url() ?>dashboard/blog/delete-konten/<?= $bm['id_blog'] ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // SWAL
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