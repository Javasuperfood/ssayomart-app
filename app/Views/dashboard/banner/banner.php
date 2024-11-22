<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">List Banner</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item active text-danger">List Banner</li>
    <li class="breadcrumb-item"><a class="link-secondary" href="<?= base_url(); ?>dashboard/banner/tambah-banner">Tambah Banner</a></li>
</ul>
<p class="mb-3">Anda dapat mengatur banner yang akan di tampilkan kepada pengguna aplikasi/calon pembeli.
</p>
<a href="<?= base_url(); ?>dashboard/banner/tambah-banner" class="btn btn-danger mb-3">
    Tambah Banner
</a>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Banner</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Banner</th>
                        <th>Gambar Banner</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banner_list as $bl) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <?= $bl['title']; ?>
                            </td>
                            <td>
                                <img src="<?= base_url('assets/img/banner/' . $bl['img']); ?>" class="img-fluid" alt="" width="300" height="500">
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="<?= base_url(); ?>dashboard/banner/update-banner/<?= $bl['id_banner']; ?>">
                                                <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteBanner<?= $bl['id_banner']; ?>">
                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                <span class="text-danger">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================= START MODAL DELETE SINGLE PRODUK ================== -->
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
                                                Pilih Delete untuk Menghapus Produk <?= $bl['title']; ?>
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
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav> -->
        </div>
    </div>
</div>





<?= $this->endSection(); ?>