<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-3 text-gray-800">Manajemen Kupon</h1>
<ul class="breadcrumb bg-light px-0">
    <li class="breadcrumb-item text-danger active text-decoration-underline">List Kupon</li>
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/kupon/tambah-kupon">Tambah Kupon</a></li>
</ul>

<a class="btn btn-danger mb-4" href="<?= base_url(); ?>dashboard/kupon/tambah-kupon"><i class="bi bi-plus-circle me-2"></i>Tambah kupon</a>

<!-- DataTales Example -->
<div class="card border-1 shadow-sm mb-5">
    <div class="card-header d-flex justify-content-start align-items-center border-1 py-3">
        <i class="bi bi-file-text-fill"></i>
        <h6 class="m-0 font-weight-bold px-2">List Kupon</h6>
    </div>
    <div class="card-body mt-2">
        <div class="table-responsive">
            <table class=" table text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Code</th>
                        <th>Deskripsi</th>
                        <th>Diskon</th>
                        <th>Total Pembelian</th>
                        <th>Masa Berlaku</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kupon_Model as $kp) : ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $kp['nama']; ?></td>
                            <td class="align-middle"><?= $kp['kode']; ?></td>
                            <td class="align-middle"><?= $kp['deskripsi']; ?></td>
                            <td class="align-middle"><?= $kp['discount']; ?></td>
                            <td class="align-middle"><?= 'Rp ' . number_format($kp['total_buy'], 0, ',', '.'); ?></td>
                            <td class="align-middle"><?= date("d-m-Y", strtotime($kp['is_active'])); ?></td>
                            <td class="align-middle"><?= $kp['username']; ?></td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="<?= base_url(); ?>dashboard/kupon/edit-kupon/<?= $kp['id_kupon']; ?>">
                                            <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#deleteKupon<?= $kp['id_kupon']; ?>">
                                            <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Hapus Kupon</span>
                                        </a>
                                    </div>
                                    <div class="modal fade" id="deleteKupon<?= $kp['id_kupon']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteKupon<?= $kp['id_kupon']; ?>" aria-hidden="true">
                                        <div class="modal-dialog text-start text-secondary" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteKupon<?= $kp['id_kupon']; ?>">Hapus Kupon <b class="text-uppercase text-danger"><?= $kp['nama']; ?></b>?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Pilih tombol "Hapus" untuk menghapus Kupon <b class="text-uppercase text-danger"><?= $kp['nama']; ?></b> secara <b class="text-danger">PERMANENT</b>.
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <form action="<?= base_url() ?>dashboard/kupon/delete-kupon/<?= $kp['id_kupon']; ?>" method="post">
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