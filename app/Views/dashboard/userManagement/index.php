<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">User Management</h1>

<div class="row">
    <div class="col-4">
        <div class="card border-0 shadow-sm border-left-danger mb-4">
            <div class="row">
                <div class="card-body d-flex">
                    <div class="col-9 text-center">
                        <span class="text-secondary fs-5 position-absolute top-50 start-50 translate-middle">
                            Total Users: <?= $totalUsers; ?>
                        </span>
                    </div>
                    <div class="col-3 text-center">
                        <i class="bi bi-people-fill fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <a class="btn btn-danger mb-3" href="#" data-toggle="modal" data-target="#deleteBatchModal" id="btnDelete" style="display: none;">
            <i class="bi bi-trash-fill"></i>
            Delete
        </a>
    </div>
    <div class="col text-end">
        <form action="<?= base_url('dashboard/user-management'); ?>" method="get">
            <div class="input-group mb-3">
                <input value="<?= (isset($_GET['search']) ? $_GET['search'] : ''); ?>" type="text" class="form-control border-0 shadow-sm" placeholder="Cari Pengguna Disini..." aria-label="search" name="search" aria-describedby="search">
                <button class="btn btn-danger border-0 shadow-sm" type="submit" id="search"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-danger">List User Management</h6>
        <div class="ml-auto">
            <button type="button" class="btn btn-outline-danger position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Permintaan Hapus Akun
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border-0">
                    <?= $delRequestCount > 99 ? '99+' : $delRequestCount; ?>
                    <span class="visually-hidden"></span>
                </span>
            </button>
        </div>

    </div>

    <div class="card-body ">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class=" form-check-label" for="checkProduk">
                                            No
                                        </label>
                                    </div>
                                </th>
                                <th>Username</th>
                                <th>No Tlp</th>
                                <th>Status</th>
                                <th>Grup</th>
                                <th>Market(Cabang)</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $iterasi++; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['telp']; ?></td>
                                    <td><?= $user['active']; ?></td>
                                    <td><?= $user['group']; ?></td>
                                    <td>
                                        <?php foreach ($marketAdmin as $m) : ?>
                                            <?php if ($m['id_user'] == $user['id']) : ?>
                                                <?= $m['city'] . ' - ' . $m['zip_code']; ?><br>
                                            <?php endif; ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td><?= $user['created_at']; ?></td>
                                    <td class="text-center">
                                        <div class="nav-item dropdown no-arrow">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <?php if (auth()->user()->inGroup('superadmin')) : ?>
                                                <!-- Dropdown - User Information -->
                                                <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#userModal<?= $user['id'] ?>">
                                                        <i class="bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Update
                                                    </button>
                                                </div>
                                                <!-- Modal -->
                                                <form method="post" action="<?= base_url('dashboard/user-management/update/' . $user['id']); ?>">
                                                    <?= csrf_field() ?>
                                                    <div class="modal fade" id="userModal<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel<?= $user['id'] ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="userModalLabel<?= $user['id'] ?>">Are you sure you want to change the role, <?= $user['username'] ?>?</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro optio recusandae aperiam sunt saepe ab fuga ipsam reiciendis</p>
                                                                    <select class="form-select" name="newRole" aria-label="Default select example">
                                                                        <option value="admin" selected>Admin</option>
                                                                        <option value="user">User</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger">Update Role</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- Modal Notification -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Tambahkan class modal-lg di sini -->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Notifikasi Penghapusan Akun User</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nama Lengkap</th>
                                                                            <th>Username</th>
                                                                            <th>Alasan Penghapusan</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($delRequest as $del) : ?>
                                                                            <tr>
                                                                                <td><?= $user['fullname']; ?></td>
                                                                                <td><?= $user['username']; ?></td>
                                                                                <td><?= $del['alasan']; ?></td>
                                                                                <td class="text-center">
                                                                                    <a href="<?= base_url() ?>dashboard/user-management/delete-account" type="button" class="btn position-relative">
                                                                                        <span class="text-danger fs-6 text-danger"><i class="bi bi-trash-fill"></i> Hapus</span>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('user', 'pagerS'); ?>
                </div>
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

<?= $this->endSection(); ?>