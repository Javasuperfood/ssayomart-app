<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>

<h1 class="h3 mb-2 text-gray-800">Pesanan Pelanggan</h1>
<hr>
<?php if (isset($toko)) : ?>
    <div class="row">
        <div class="col-md-12">
            Anda adalah Admin dari
            <?php foreach ($toko as $t) : ?>
                <span class="fw-bold">| <?= $t; ?> |</span>
            <?php endforeach; ?>
            anda dapat melihat, mengupdate, dan menghapus pesanan dari Market terdaftar
        </div>
    </div>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header border-0 py-3">
            <h6 class="m-0 font-weight-bold text-danger">List Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3 header">
                <div class="col text-end">
                    <?php if (isset($pages) && $pages == 'in-proccess') : ?>
                        <a href="<?= base_url('dashboard/order/in-proccess/print-all'); ?>" class="btn btn-outline-danger <?= (count($order) == 0) ? 'd-none' : ''; ?>"><i class="bi bi-printer"></i> Print All</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-border-bottom-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">INV</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Penerima</th>
                            <th class="text-center">Kurir</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">INV</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Penerima</th>
                            <th class="text-center">Kurir</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (count($order) == 0) : ?>
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="alert alert-danger rounded border-0" role="alert">
                                        <div class="row">
                                            <div class="col-1"><i class="bi bi-exclamation-triangle-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i></div>
                                            <div class="col-9 fs-4">Data pesanan tidak tersedia!</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ?>
                        <?php
                        $idCheckout = null;
                        foreach ($order as $o) : ?>
                            <?php if ($idCheckout != $o['id_checkout']) : ?>
                                <tr>
                                    <th><?= $iterasi++; ?></th>
                                    <td><a class="link-dark" href="<?= base_url('dashboard/order/' . $o['invoice']); ?>"><?= $o['invoice']; ?></a></td>
                                    <td class="my-0">
                                        <ul class="list-group">
                                            <?php foreach ($order as $p) : ?>
                                                <?php if ($o['id_checkout'] == $p['id_checkout']) : ?>
                                                    <li class="list-group-item border-0"><a class="link-dark" href="<?= base_url('produk/' . $p['slug']); ?>"><?= $p['nama']; ?></a><br> (<b>Qty</b>: <?= $p['qty']; ?>, <b>SKU</b>: <?= $p['sku']; ?>)</li>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
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
<?php else : ?>

    <div class="row">
        <div class="col">
            <p class="text-center fw-bold text-danger">
                Anda adalah admin namun belum terdaftar pada market/cabang mana pun hubungi super admin ID Admin anda adalah :
            </p>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger border-0 shadow-sm h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            ID Admin</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= user_id(); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-geo-alt-fill fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>
<?= $this->endSection(); ?>