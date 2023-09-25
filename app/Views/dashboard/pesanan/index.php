<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">List Pesanan</h6>
    </div>
    <div class="card-body">
        <div class="row mb-3 header">
            <div class="col text-end">
                <?php if (isset($pages) && $pages == 'in-progress') : ?>
                    <a href="<?= base_url('dashboard/order/in-proccess/print-all'); ?>" class="btn btn-outline-danger"><i class="bi bi-printer"></i> Print All</a>
                <?php endif ?>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>INV</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>SKU</th>
                        <th>Penerima</th>
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
                        <th>Penerima</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th class="text-right"><i class="bi bi-three-dots-vertical"></i></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $idCheckout = null;
                    foreach ($order as $o) : ?>
                        <?php if ($idCheckout != $o['id_checkout']) : ?>
                            <tr>
                                <th><?= $iterasi++; ?></th>
                                <td><a class="link-dark" href="<?= base_url('dashboard/order/' . $o['invoice']); ?>"><?= $o['invoice']; ?></a></td>
                                <td colspan="3">
                                    <?php foreach ($order as $p) : ?>
                                        <?php if ($o['id_checkout'] == $p['id_checkout']) : ?>
                                            <ul class="list-group list-group-horizontal">
                                                <li class="list-group-item"><a href="<?= base_url('produk/' . $p['slug']); ?>"><?= $p['nama']; ?></a></li>
                                                <li class="list-group-item"><?= $p['qty']; ?></li>
                                                <li class="list-group-item"><?= $p['sku']; ?></li>
                                            </ul>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </td>
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
                                            <?php if ((int)$o['id_status_pesan'] > 1) : ?>
                                                <a class="dropdown-item" href="<?= base_url('dashboard/order/print-order/' . $o['id_checkout']); ?>">
                                                    <i class="bi bi-printer fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Print
                                                </a>
                                                <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modalUpdateStatus<?= $o['id_checkout']; ?>">
                                                    <i class="bi bi-pencil-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Update Status
                                                </a>
                                            <?php endif ?>
                                            <a class="dropdown-item" href="<?= base_url('dashboard/order/' . $o['invoice']); ?>">
                                                <i class="bi bi-box-seam-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Detail
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-pencil-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Update
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php if ((int)$o['id_status_pesan'] > 1) : ?>
                                <div class="modal fade" id="modalUpdateStatus<?= $o['id_checkout']; ?>" tabindex="-1" aria-labelledby="modalUpdateStatus<?= $o['id_checkout']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalUpdateStatus<?= $o['id_checkout']; ?>Label">Updatde Status Pesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('dashboard/order/in-proccess/update-status/' . $o['id_checkout']); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="page" value="<?= (isset($_GET['page_order']) != null) ? $_GET['page_order'] : '1'; ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" id="status" name="status">
                                                            <?php foreach ($statusPesan as $s) : ?>
                                                                <option value="<?= $s['id_status_pesan']; ?>" <?= ($s['id_status_pesan'] == $o['id_status_pesan']) ? 'selected' : ''; ?>><?= $s['status']; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                        <?php $idCheckout = $o['id_checkout']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?= $pager->links('order', 'pagerS'); ?>
    </div>
</div>
<?= $this->endSection(); ?>