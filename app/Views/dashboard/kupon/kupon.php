<?= $this->extend('dashboard/dashboard') ?>
<?= $no = 1; ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Manajemen Kupon</h1>
<p class="mb-4">Anda dapat memberikan atau manambahkan kupon yang akan di tampilkan nantinya pada halaman user sebagai bentuk potongan harga atau diskon
</p>

<a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/kupon/tambah-kupon">Buat Kupon</a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Kupon List</h6>
    </div>
    <div class="card-body text-center table-responsive">
        <table class=" table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Code</th>
                    <th>Deskripsi</th>
                    <th>Masa Berlaku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kupon_Model as $kp) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $kp['nama']; ?></td>
                        <td><?= $kp['kode']; ?></td>
                        <td><?= $kp['deskripsi']; ?></td>
                        <td><?= $kp['is_active']; ?></td>
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
                                    <form action="<?= base_url() ?>dashboard/kupon/delete-kupon/<?= $kp['id_kupon']; ?>">
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
            </tbody>
        <?php endforeach; ?>
        </table>

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