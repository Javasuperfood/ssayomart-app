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
                <div class="col-md-3">
                    <form action="<?= base_url('dashboard/order/' . $pages) ?>" method="get">
                        <div class="input-group">
                            <span class="input-group-text">Filter by</span>
                            <select class="form-select" name="shipment" id="inputGroupSelect04" aria-label="Example select with button addon">
                                <option value="all" <?= ($shipment == 'all') ? 'selected' : ''; ?>>Semua</option>
                                <option value="GoSend" <?= ($shipment == 'GoSend') ? 'selected' : ''; ?>>GoSend</option>
                                <option value="non-GoSend" <?= ($shipment == 'non-GoSend') ? 'selected' : ''; ?>>non-GoSend</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="submit">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <?php if (isset($pages) && $pages == 'in-proccess') : ?>
                        <a href="<?= base_url('dashboard/order/in-proccess/print-all'); ?>" class="btn btn-outline-danger <?= (count($checkout) == 0) ? 'd-none' : ''; ?>"><i class="bi bi-printer"></i> Print All</a>
                    <?php endif ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-border-bottom-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>INV</th>
                            <th>Produk</th>
                            <th>Penerima</th>
                            <th>Kurir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>INV</th>
                            <th>Produk</th>
                            <th>Penerima</th>
                            <th>Kurir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (!$checkout) : ?>
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
                        foreach ($checkout as $c) : ?>
                            <tr>
                                <td><?= $iterasi++; ?></td>
                                <td><?= $c['invoice']; ?></td>
                                <td>
                                    <?php foreach ($c['produk'] as $p) : ?>
                                        <!-- <p><?= $p['nama']; ?> (<?= $p['value_item']; ?>) SKU : <?= $p['sku']; ?></p> -->
                                        <table class="table table-bordered">
                                            <tr>
                                                <td><?= $p['nama']; ?> (<?= $p['value_item']; ?>)</td>
                                                <td rowspan="2">Qty : <?= $p['qty']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>SKU : <?= $p['sku']; ?></td>
                                            </tr>
                                        </table>
                                    <?php endforeach ?>
                                </td>
                                <td><?= $c['kirim']; ?></td>
                                <td><?= $c['kurir'] . ' (' . $c['service'] . ')'; ?></td>
                                <td><?= $c['status']; ?></td>
                                <td class="text-right">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu shadow" aria-labelledby="userDropdown">
                                            <?php if ($c['gosend'] == 1) : ?>
                                                <a class="dropdown-item fw-bold text-danger" href="#" role="button" onclick="pickUp(this)">
                                                    <i class="bi bi-box-seam fa-sm fa-fw mr-2"></i>
                                                    Pick-Up
                                                </a>
                                                <a class="dropdown-item fw-bold text-danger" href="#" role="button" onclick="repickUp(this)">
                                                    <i class="bi bi-box-seam fa-sm fa-fw mr-2"></i>
                                                    Retry Pick-Up
                                                </a>
                                                <a class="dropdown-item fw-bold text-danger" href="#" role="button" onclick="cancelPickUp(this)">
                                                    <i class="bi bi-box-seam fa-sm fa-fw mr-2"></i>
                                                    Cancel
                                                </a>
                                                <hr>
                                            <?php endif ?>
                                            <?php if ((int)$c['id_status_pesan'] > 1) : ?>
                                                <a class="dropdown-item" href="<?= base_url('dashboard/order/print-order/' . $c['id_checkout']); ?>">
                                                    <i class="bi bi-printer fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Print
                                                </a>
                                                <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modalUpdateStatus<?= $c['id_checkout']; ?>">
                                                    <i class="bi bi-pencil-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Update Status
                                                </a>
                                            <?php endif ?>
                                            <a class="dropdown-item" href="<?= base_url('dashboard/order/' . $c['invoice']); ?>">
                                                <i class="bi bi-box-seam-fill fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php if ((int)$c['id_status_pesan'] > 1) : ?>
                                <div class="modal fade" id="modalUpdateStatus<?= $c['id_checkout']; ?>" tabindex="-1" aria-labelledby="modalUpdateStatus<?= $c['id_checkout']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalUpdateStatus<?= $c['id_checkout']; ?>Label">Updatde Status Pesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('dashboard/order/in-proccess/update-status/' . $c['id_checkout']); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="page" value="<?= (isset($_GET['page_order']) != null) ? $_GET['page_order'] : '1'; ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" id="status" name="status">
                                                            <?php foreach ($statusPesan as $s) : ?>
                                                                <option value="<?= $s['id_status_pesan']; ?>" <?= ($s['id_status_pesan'] == $c['id_status_pesan']) ? 'selected' : ''; ?>><?= $s['status']; ?></option>
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
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <?= $pager->links('order', 'pagerS'); ?>
        </div>
    </div>
    <script>
        function pickUp(e) {
            console.log(e);
            Swal.fire({
                title: "Are you sure?",
                text: "Apa barang sudah siap di ambil?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, pick it up!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Memanggil driver",
                        text: "Menunggu driver",
                        icon: "success"
                    });
                }
            });
        }
    </script>
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