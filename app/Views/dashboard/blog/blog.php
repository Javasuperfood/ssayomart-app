<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Manajemen Konten Artikel/Blog Ssayomart</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item text-danger active">List Artikel/Blog</li>
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/blog/tambah-konten">Buat Artikel/Blog</a></li>
</ul>
<p class="mb-4">Anda dapat mengatur konten artikel/blog informasi, produk, resep, dan media yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.</p>
<a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/blog/tambah-konten"><i class="bi bi-plus-circle-fill"></i> Tambah Konten</a>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">Konten Blog Site</h6>
    </div>
    <div class="card-body ">
        <div class="table-responsive">
            <table class="table table-borderless text-center" id="dataTable" width="100%" cellspacing="0">
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
                            <td><?= $no++; ?></td>
                            <td><?= $bm['judul_blog']; ?></td>
                            <td><?= strftime('%d %B %Y %H:%M', strtotime($bm['tanggal_dibuat'])); ?></td>
                            <td><?= $bm['username']; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/blog/' . $bm['img_thumbnail']); ?>" class="img-fluid rounded-3" alt="" width="100px" height="100px">
                            </td>
                            <td><?= $bm['slug']; ?></td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="">
                                            <i class="bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Lihat Konten
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('dashboard/blog/detail-konten/' . $bm['id_blog']); ?>">
                                            <i class="bi bi-box-seam-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Detail Konten
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url() ?>dashboard/blog/update-konten/<?= $bm['id_blog'] ?>">
                                            <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Edit Konten
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="<?= base_url() ?>dashboard/blog/delete-konten/<?= $bm['id_blog'] ?>" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="pager" value="<?= (isset($_GET['page_konten']) ? $_GET['page_konten'] : '1'); ?>">
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                <span class="text-danger">Delete</span>
                                            </button>
                                        </form>
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