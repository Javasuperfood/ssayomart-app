<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">User Management</h1>
<ul class="breadcrumb bg-light">
    <li class="breadcrumb-item text-danger active">List User Management</li>
    <li class="breadcrumb-item text-danger"><a class="text-secondary" href="<?= base_url(); ?>dashboard/produk/tambah-produk">Tambah User</a></li>
</ul>
<p class="mb-3">Halaman ini dapat menampilkan user management dari ssayomart market disini</p>

<div class="row">
    <div class="col">
        <a class="btn btn-danger mb-3" href="<?= base_url(); ?>dashboard/produk/tambah-produk"><i class="bi bi-plus-square"></i> Tambah User</a>
        <a class="btn btn-danger mb-3" href="#" data-toggle="modal" data-target="#deleteBatchModal" id="btnDelete" style="display: none;">
            <i class="bi bi-trash-fill"></i>
            Delete
        </a>
    </div>
    <div class="col text-end">
        <form action="<?= base_url('dashboard/produk'); ?>" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="search" aria-label="search" name="search" aria-describedby="search">
                <button class="btn btn-outline-danger" type="submit" id="search">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List User Management</h6>
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
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class=" form-check-label" for="checkProduk">
                                            No
                                        </label>
                                    </div>
                                </th>
                                <th>Username</th>
                                <th>No Tlp</th>
                                <th>Status</th>
                                <th>Grup</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['telp']; ?></td>
                                    <td><?= $user['active']; ?></td>
                                    <td>-</td>
                                    <td><?= $user['created_at']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>