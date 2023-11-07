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
                        <i class="bi bi-person-fill fs-1 text-secondary"></i>
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
                <input value="<?= (isset($_GET['search']) ? $_GET['search'] : ''); ?>" type="text" class="form-control" placeholder="search" aria-label="search" name="search" aria-describedby="search">
                <button class="btn btn-outline-danger" type="submit" id="search" >Search</button>
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
                            foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $iterasi++; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['telp']; ?></td>
                                    <td><?= $user['active']; ?></td>
                                    <td><?= $user['group']; ?></td>
                                    <td><?= $user['created_at']; ?></td>
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


<?= $this->endSection(); ?>