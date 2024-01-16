<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Kategori Produk</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item text-danger active text-decoration-underline"><a class="text-danger" href="<?= base_url(); ?>dashboard/kategori">Kategori</a></li>
</ul>
<div class="row">
    <div class="col mb-4">
        <a class="btn btn-danger mb-4" data-toggle="tooltip" data-placement="bottom" title="Klik untuk menambah kategori" href="<?= base_url(); ?>dashboard/kategori/tambah-kategori">Tambah Kategori & Sub Kategori
        </a>
        <a class="btn btn-danger mb-4 ms-2" data-toggle="tooltip" data-placement="bottom" title="Klik untuk mengubah urutan Kategori" href="<?= base_url(); ?>dashboard/kategori/shorting">Ubah urutan kategori
        </a>
        <div class="card border-1 shadow-sm position-relative">
            <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
                <i class="bi bi-file-text-fill"></i>
                <h6 class="m-0 fw-bold px-2">List Kategori dan Sub Kategori Produk</h6>
            </div>
            <div class="card-body mt-2">
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
                                <td class="align-middle">
                                    <img src="<?= base_url('assets/img/kategori/' . $km['img_kategori']); ?>" class="img-fluid" alt="" width="50" height="50">
                                </td>

                                <td class="align-middle"><strong><?= $km['nama_kategori'] ?></strong></td>
                                <td class="align-middle"><?= $km['slug_kategori'] ?></td>

                                <td class="align-middle">
                                    <div class="text-center">
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
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteKategori<?= $km['id_kategori']; ?>">
                                                    <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                    <span class="text-danger">Delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================= START MODAL DELETE SINGLE Perent Kategori ================== -->
                                    <div class="modal fade" id="deleteKategori<?= $km['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteKategori<?= $km['id_kategori']; ?>" aria-hidden="true">
                                        <div class="modal-dialog text-start text-secondary" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteKategori<?= $km['id_kategori']; ?>">Hapus Kategori <b class="text-uppercase text-danger"><?= $km['nama_kategori']; ?></b> ?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Pilih tombol "Hapus" untuk menghapus kategori <b class="text-uppercase text-danger"><?= $km['nama_kategori']; ?></b> secara <b class="text-danger">PERMANENT</b>.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <form action="<?= base_url() ?>dashboard/kategori/delete-kategori/<?= $km['id_kategori']; ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================= END MODAL DELETE SINGLE Perent Kategori ================== -->
                                </td>
                            </tr>
                            <?php foreach ($km['sub_kategori'] as $ks) : ?>
                                <?php if ($ks['id_sub_kategori']) : ?>
                                    <tr>
                                        <td>
                                            <p></p>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-secondary">
                                                <li><?= $ks['nama_sub_kategori'] ?></li>
                                            </div>
                                        </td>
                                        <td class="align-middle"><?= $ks['slug_sub_kategori']; ?></td>
                                        <td>
                                            <div class="text-center">
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
                                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteSubKategori<?= $ks['id_sub_kategori']; ?>">
                                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                            <span class="text-danger">Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ================= START MODAL DELETE SINGLE Sub Kategori ================== -->
                                            <div class="modal fade" id="deleteSubKategori<?= $ks['id_sub_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSubKategori<?= $ks['id_sub_kategori']; ?>" aria-hidden="true">
                                                <div class="modal-dialog text-start text-secondary" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteSubKategori<?= $ks['id_sub_kategori']; ?>">Delete <?= $ks['nama_sub_kategori']; ?> ?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Pilih Delete untuk menghapus Sub kategori <?= $ks['nama_sub_kategori']; ?></div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                            <form action="<?= base_url() ?>dashboard/kategori/delete-sub-kategori/<?= $ks['id_sub_kategori']; ?>" method="post">
                                                                <?= csrf_field() ?>
                                                                <button type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)"> <i class="bi bi-trash-fill"></i> Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ================= END MODAL DELETE SINGLE Sub Kategori ================== -->
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