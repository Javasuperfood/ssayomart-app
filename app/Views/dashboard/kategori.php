<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h2>Kategori</h2>
<hr />
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">List Kategori</li>
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard/tambah-kategori">Tambah Kategori</a></li>
</ul>
<p class="mb-3">Kategori produk untuk toko Anda dapat diatur di sini. Untuk mengganti urutan kategori di ujung depan, Anda dapat seret-lepas untuk mengurutkannya. Untuk melihat kategori lainnya klik tautan "Opsi Layar" pada bagian atas halaman.</p>
<a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/tambah-kategori">Tambah Kategori</a>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold">List Produk Kategori</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kategori_model as $km) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/kategori/' . $km['img']); ?>" class="img-fluid" alt="" width="50" height="50">
                            </td>
                            <td><?= $km['nama_kategori']; ?></td>
                            <td><?= $km['slug']; ?></td>

                            <td><?= $km['deskripsi']; ?></td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="<?= base_url("dashboard/kategori/edit-kategori/{$km['id_kategori']}"); ?>">
                                            <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form action="<?= base_url() ?>dashboard/kategori/delete-kategori/<?= $km['id_kategori']; ?>">
                                            <?= csrf_field() ?>
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