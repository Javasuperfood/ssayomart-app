<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Market</h1>
<hr>
<div class="row py-3">
    <div class="col-md-6">
        <a href="<?= base_url('dashboard/admin-market'); ?>" class="btn btn-danger">Tambahkan Admin Untuk Market</a>
        <a href="<?= base_url('dashboard/marketplace/create'); ?>" class="btn btn-danger">Tambahkan Market</a>
    </div>
    <div class="col-md-6"></div>
</div>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header border-0 py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Market</h6>
    </div>
    <div class="card-body">
        <div class="row mb-3 header">
            <div class="col text-end">
                <?php if (isset($pages) && $pages == 'in-progress') : ?>
                    <a href="<?= base_url('dashboard/order/in-proccess/print-all'); ?>" class="btn btn-outline-danger <?= (count($order) == 0) ? 'd-none' : ''; ?>"><i class="bi bi-printer"></i> Print All</a>
                <?php endif ?>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-border-bottom-0" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Market</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($toko as $t) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>Ssyaomart <?= $t['city']; ?> - <?= $t['zip_code']; ?></td>
                            <td>Ssyaomart <?= $t['alamat_1']; ?></td>
                            <td class="text-center">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" role="button" href="<?= base_url('dashboard/marketplace/show/' . $t['id_toko']); ?>">
                                            <i class=" bi bi-eye-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Detail Market
                                        </a>
                                        <a class="dropdown-item" role="button" href="<?= base_url('dashboard/marketplace/edit/' . $t['id_toko']); ?>">
                                            <i class=" bi bi-pen-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Update
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form method="post" action="<?= base_url('dashboard/marketplace/delete/' . $t['id_toko']); ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="method" value="DELETE">
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-trash-fill fa-sm fa-fw mr-2 text-danger"></i>
                                                <span class="text-danger">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
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