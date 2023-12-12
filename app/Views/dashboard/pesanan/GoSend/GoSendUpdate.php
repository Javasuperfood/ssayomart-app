<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
<div class="card border-0 text-center bg-light mb-4 px-2 py-2">
    <h1 class="h3 mb-2 text-danger fw-bold">Pesanan <br> <?= $inv; ?></h1>
</div>

<!-- Pesanan Produk -->
<div class="card border-0 mb-4 shadow-sm">
    <a href="#order" class="d-block card-header bg-white border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="order">
        <h6 class="m-0 font-weight-bold text-danger">Produk</h6>
    </a>
    <div class="collapse show" id="order">
        <div class="card-body">
            <div class="row row-cols-2 row-cols-md-4">
                <?php foreach ($orders as $o) : ?>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/produk/main/' . $o['img']); ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $o['nama']; ?></h5>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Qty</td>
                                                <td>:</td>
                                                <td class="font-weight-bold"><?= $o['qty']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<!-- Detail Pesanan Produk -->
<div class="card border-0 mb-4 shadow-sm">
    <a href="#detail" class="d-block card-header bg-white border-0 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="detail">
        <h6 class="m-0 font-weight-bold text-danger">Detail Pemesanan Produk</h6>
    </a>
    <div class="collapse show" id="detail">
        <div class="card-body">
            <div class="row row-cols-1">
                <div class="col-md-6">
                    <div class="my-3">
                        <div class="row">
                            <div class="col">
                                <form id="updateStatus" action="<?= base_url('dashboard/order/update-booking/update-status/') . $inv ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="inv" value="<?= $inv; ?>">
                                    <input type="hidden" name="id_checkout" value="<?= $order['id_checkout']; ?>">
                                    <div class="form-floating">
                                        <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example">
                                            <?php foreach ($statusPesanan as $s) : ?>
                                                <option value="<?= $s['id_status_pesan']; ?>" <?= $s['id_status_pesan'] == $order['id_status_pesan'] ? 'selected' : ''; ?>><?= $s['status']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="floatingSelect">Status Pesanan</label>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <button type="submit" form="updateStatus" class="btn btn-outline-danger py-3">Update</button>
                                <?php if ($order['id_status_pesan'] == 3 && $status_transaction == 0) : ?>

                                    <button type="submit" class="btn btn-outline-success py-3" data-bs-toggle="modal" data-bs-target="#selesaitringer">Selesai</button>

                                    <div class="modal fade" id="selesaitringer" tabindex="-1" aria-labelledby="selesaitringerLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="selesaitringerLabel">Selesaikan Pesanan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Selesaikan pesanan ini ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form method="post" action="<?= base_url('dashboard/order/update-booking/update-status/save/') . $inv ?>" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <button type="submit" class="btn btn-danger">Selesai</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    Detail :
                    </p>
                    <table class="table border-1">
                        <tbody>
                            <tr>
                                <td>Penerima</td>
                                <td>:</td>
                                <td><?= $destination['penerima']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $destination['alamat_1']; ?> (<?= $destination['alamat_2']; ?>)</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $destination['alamat_3']; ?></td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>:</td>
                                <td><?= $destination['telp']; ?> / <?= $destination['telp2']; ?></td>
                            </tr>
                            <tr>
                                <td>Service</td>
                                <td>:</td>
                                <td><?= $order['kurir']; ?> (<?= $order['service']; ?>)</td>
                            </tr>
                            <tr>
                                <td>Maps</td>
                                <td>:</td>
                                <td><a href="https://www.google.com/maps/search/<?= $destination['latitude']; ?>+<?= $destination['longitude']; ?>" target="_blank"><?= $destination['latitude']; ?>, <?= $destination['longitude']; ?></a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row row-cols-1">
                        <div class="col my-3">
                            <div class="card border-1 border-left-danger px-2 pt-2">
                                <div class="col font-weight-bold">
                                    <p class="fw-bold fs-5">Transaksi </p>
                                </div>
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Potongan Harga (Diskon)</td>
                                            <td>:</td>
                                            <td><?= ($order['discount'] != '') ? ($order['discount'] * 100) . '%' : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Belanja</td>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($order['total_1'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Layanan</td>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($order['harga_service'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>:</td>
                                            <td class="fw-bold">Rp. <?= number_format($order['total_2'], 0, ',', '.'); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-1" style="height: 100%;">
                        <div class="card-body">
                            <div class="card-header bg-white border-1 py-3">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="m-0 font-weight-bold text-danger">GoSend Update</h6>
                                    </div>
                                    <div class="col text-end">
                                        <?php if ($gosendStatus) :  ?>
                                            <?php if (in_array($gosendStatus['status'], ['Finding Driver', 'Driver not found', 'Enroute Drop', 'Enroute Pickup', 'Driver Allocated', 'Item Picked', 'On Hold'])) : ?>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($gosendStatus) : ?>
                                <div class="col-12 my-3">
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>ID</td>
                                                        <td>:</td>
                                                        <td><?= $gosendStatus['driverId']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Driver</td>
                                                        <td>:</td>
                                                        <td><?= $gosendStatus['driverName']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Driver Phone </td>
                                                        <td>:</td>
                                                        <td><?= $gosendStatus['driverPhone']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nomor Kendaraan </td>
                                                        <td>:</td>
                                                        <td><?= $gosendStatus['vehicleNumber']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-auto d-none d-lg-block">
                                            <img class="img-fluid" src="<?= $gosendStatus['driverPhoto']; ?>" alt="Driver IMG" srcset="">
                                            <!-- <img class="img-fluid" src="https://source.unsplash.com/200x250" alt="Driver IMG" srcset=""> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="col-12 my-3">
                                <?php if (!$gosendStatus) : ?>
                                    <form action="<?= base_url('dashboard/order/update-booking/' . $inv . '/pickup'); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="inv" value="<?= $inv; ?>">
                                        <input type="hidden" name="req" value="pickup">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Note For driver GoSend" id="floatingTextarea2" name="note" style="height: 100px">Di tunggu di Lobi</textarea>
                                            <label for="floatingTextarea2">Note For driver GoSend</label>
                                        </div>
                                        <div class="my-3 text-center">
                                            <button type="submit" class="btn btn-danger btn-lg">Pickup</button>
                                        </div>
                                    </form>
                                <?php else : ?>
                                    <?php if ($gosendStatus['status'] == 'Finding Driver') : ?>
                                        <div class="alert alert-info my-3" role="alert">
                                            <h4 class="alert-heading">Mencari Driver!</h4>
                                            <p>Status saat ini sedang mencari driver untuk pickup produk.</p>
                                            <hr>
                                            <p class="mb-0">Nomor Order : <?= $gosendStatus['orderNo']; ?></p>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($gosendStatus['status'] == 'Driver not found') : ?>
                                        <div class="alert alert-danger my-3" role="alert">
                                            <h4 class="alert-heading">Driver tidak ditemukan!</h4>
                                            <p>Status saat ini driver tidak ditemukan.</p>
                                            <hr>
                                            <p class="mb-0">Mohon klik retry untuk mencoba kembali.</p>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($gosendStatus['status'] == 'Cancelled') : ?>
                                        <div class="alert alert-danger my-3" role="alert">
                                            <h4 class="alert-heading">Pengiriman dibatalkan!</h4>
                                            <p>Status saat ini pengiriman dibatalkan.</p>
                                            <hr>
                                            <p class="mb-0">Mohon klik retry jika ingin mencoba kembali.</p>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($gosendStatus['status'] == 'Rejected') : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Pengiriman ditolak!</h4>
                                            <p>Status saat ini pengiriman ditolak.</p>
                                            <hr>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($gosendStatus['status'] == 'Completed') : ?>
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Pengiriman selesai!</h4>
                                            <p>Status saat ini pengiriman selesai.</p>
                                            <hr>
                                            <p class="mb-0">Produk telah sampai tujuan.</p>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($gosendStatus) : ?>
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Nomor Order</td>
                                                    <td>:</td>
                                                    <td><?= $gosendStatus['orderNo']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Booking Status</td>
                                                    <td>:</td>
                                                    <td><?= $gosendStatus['bookingStatus']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Driver Distance</td>
                                                    <td>:</td>
                                                    <td><?= $gosendStatus['totalDriverDistanceInKms']; ?> KM</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php if ($gosendStatus['status'] == 'Cancelled' || $gosendStatus['status'] == 'Driver not found') : ?>
                                            <form action="<?= base_url('dashboard/order/update-booking/' . $inv . '/pickup'); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="inv" value="<?= $inv; ?>">
                                                <input type="hidden" name="req" value="pickup">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Note For driver GoSend" id="floatingTextarea2" name="note" style="height: 100px">Ditunggu di lobi</textarea>
                                                    <label for="floatingTextarea2">Note For driver GoSend</label>
                                                </div>
                                                <div class="my-3 text-center">
                                                    <button type="submit" class="btn btn-danger btn-lg">Retry Pick-up</button>
                                                </div>
                                            </form>
                                        <?php elseif ($gosendStatus['status'] == 'Completed') : ?>
                                            <div class="row">
                                                <div class="col text-center">
                                                    <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#liveTarcking">Completed</a></td>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="row">
                                                <div class="col text-center">
                                                    <a class="btn btn-primary" href="#" role="button" data-bs-toggle="modal" data-bs-target="#liveTarcking">Live Tracking</a></td>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="liveTarcking" tabindex="-1" aria-labelledby="liveTarckingLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="liveTarckingLabel">Live Tracking <?= $gosendStatus['orderNo']; ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe src="<?= $gosendStatus['liveTrackingUrl']; ?>" style="border: none; width: 100%; height: 100%;"></iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="cancelModalLabel">Cancel Booking <?= $gosendStatus['orderNo']; ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php if (in_array($gosendStatus['status'], ['Finding Driver'])) : ?>
                                                        <p>Apakah anda yakin ingin membatalkan pesanan ini?</p>
                                                    <?php else : ?>
                                                        <p>Maaf pesanan ini tidak dapat dibatalkan karena status saat ini <?= $gosendStatus['status']; ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <?php if (in_array($gosendStatus['status'], ['Finding Driver'])) : ?>
                                                        <form action="<?= base_url('dashboard/order/update-booking/' . $gosendStatus['orderNo'] . '/cancel'); ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="orderNo" value="<?= $gosendStatus['orderNo']; ?>">
                                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                                        </form>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
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