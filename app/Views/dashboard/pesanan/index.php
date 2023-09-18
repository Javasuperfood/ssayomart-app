<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Pesanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>INV</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>SKU</th>
                        <th>Alamat</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th class="text-right"><i class="bi bi-three-dots-vertical"></i></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>INV</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>SKU</th>
                        <th>Alamat</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th class="text-right"><i class="bi bi-three-dots-vertical"></i></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($order as $o) : ?>
                        <tr>
                            <th><?= $iterasi++; ?></th>
                            <td><?= $o['invoice']; ?></td>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['qty']; ?></td>
                            <td><?= $o['sku']; ?></td>
                            <td><?= $o['kirim']; ?></td>
                            <td><?= $o['service']; ?></td>
                            <td><?= $o['pesan_status_text']; ?></td>
                            <td class="text-right">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="<?= base_url('dashboard/pesanan/' . $o['invoice']); ?>">
                                            <i class="bi bi-box-seam-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Detail
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-pencil-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Update
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Batalkan
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?= $pager->links('order', 'pagerS'); ?>
    </div>
</div>
<?= $this->endSection(); ?>