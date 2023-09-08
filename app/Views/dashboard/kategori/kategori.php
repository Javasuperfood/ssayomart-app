<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-1 text-gray-800">Kategori Produk</h1>
<p class="mb-4">Kategori produk untuk toko Anda dapat diatur di sini. Untuk mengganti urutan kategori di ujung depan, Anda dapat seret-lepas untuk mengurutkannya. Untuk melihat kategori lainnya klik tautan "Opsi Layar" pada bagian atas halaman.</p>

<div class="row">


    <!-- Right Panel -->
    <div class="col mb-3">
        <a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/kategori/tambah-kategori">Tambah Kategori


        </a>

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">List Produk Kategori</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="dataTable" cellspacing="0">
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
                                <td>
                                    <div class="position-relative top-50 start-50 translate-middle">
                                        <div class="nav-item dropdown no-arrow">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                <a class="dropdown-item" href="<?= base_url("dashboard/kategori/edit-kategori/{$km['id_kategori']}"); ?>">
                                                    <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Update
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="<?= base_url() ?>dashboard/kategori/delete-kategori/<?= $km['id_kategori']; ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                        <span class="text-danger">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
                </table>
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



<script>
    new DataTable('#example');
</script>


<?= $this->endSection(); ?>