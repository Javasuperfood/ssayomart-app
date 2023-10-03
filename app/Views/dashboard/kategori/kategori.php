<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Kategori Produk</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item text-danger active">List Kategori</li>
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/kategori/tambah-kategori">Tambah Kategori</a></li>
</ul>
<div class="row">
    <div class="col mb-3">
        <a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/kategori/tambah-kategori">Tambah Kategori & Sub Kategori
        </a>
        <div class="card border-0 shadow-sm position-relative">
            <div class="card-header border-0 py-3">
                <h6 class="m-0 font-weight-bold text-danger">List Kategori dan Sub Kategori Produk</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Kategori & Sub Kategori</th>
                            <th>Slug</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($kategori_list as $km) : ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('assets/img/kategori/' . $km['img_kategori']); ?>" class="img-fluid" alt="" width="50" height="50">
                                </td>

                                <td><strong><?= $km['nama_kategori'] ?></strong></td>
                                <td><?= $km['slug_kategori'] ?></td>

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
                            <?php foreach ($km['sub_kategori'] as $ks) : ?>
                                <?php if ($ks['id_sub_kategori']) : ?>
                                    <tr>
                                        <td>
                                            <p></p>
                                        </td>
                                        <td>
                                            <div class="text-secondary">
                                                <li><?= $ks['nama_sub_kategori'] ?></li>
                                            </div>
                                        </td>
                                        <td><?= $ks['slug_sub_kategori']; ?></td>
                                        <td>
                                            <div class="position-relative top-50 start-50 translate-middle">
                                                <div class="nav-item dropdown no-arrow">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                        <a class="dropdown-item" href="<?= base_url("dashboard/kategori/edit-sub-kategori/{$ks['id_sub_kategori']}"); ?>">
                                                            <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                            Update
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="<?= base_url() ?>dashboard/kategori/delete-sub-kategori/<?= $ks['id_sub_kategori']; ?>" method="post">
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
                                <?php endif ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
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