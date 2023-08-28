<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container pt-3 pb-4">
    <div class="row row-cols-1 row-cols-sm-2 ">
        <div class="col ">
            <div class="card text-center border-0 shadow-sm">
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h3>Status Pengiriman</h3>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-danger"></div>
                                    <div class="timeline-content bg-white">
                                        <p><?= $keterangan['diterima']['pesan']; ?></p>
                                        <span class="badge text-bg-warning"><?= $keterangan['diterima']['tanggal']; ?></span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-danger"></div>
                                    <div class="timeline-content bg-white">
                                        <p><?= $keterangan['diproses']['pesan']; ?></p>
                                        <span class="badge text-bg-warning"><?= $keterangan['diproses']['tanggal']; ?></span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-danger"></div>
                                    <div class="timeline-content bg-white">
                                        <p><?= $keterangan['dikirim']['pesan']; ?></p>
                                        <span class="badge text-bg-primary"><?= $keterangan['dikirim']['tanggal']; ?></span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-danger"></div>
                                    <div class="timeline-content bg-white">
                                        <p><?= $keterangan['terkirim']['pesan']; ?></p>
                                        <span class="badge text-bg-success"><?= $keterangan['terkirim']['tanggal']; ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-3">
            <div class="card border-0">
                <h2>Lokasi Tujuan</h2>
                <div class="mb-0 mx-0 my-0">
                    <div class="card form-control form-control-md border-0 shadow-sm">
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="col-11">
                                <p href="#" class="card-text fw-bold">
                                    <?= $label; ?>
                                </p>
                                <a href="#" class="card-text text-secondary link-underline link-underline-opacity-0"><?= substr($alamat, 0, 25); ?>...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-3">
            <div class="card border-0">
                <div class="card form-control form-control-md border-0 shadow-sm">
                    <h2>Pesanan kamu</h2>
                    <div class="row">
                        <div class="col-10">
                            <p><?= substr("INV15165465465416546541", 0, 20); ?>...</p>
                        </div>
                        <div class="col-2">
                            <i class="bi bi-clipboard text-danger"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p><?= substr("VA607088211328525", 0, 20); ?>...</p>
                        </div>
                        <div class="col-2">
                            <i class="bi bi-files text-danger"></i>
                        </div>
                    </div>
                    <table class="table table-sm ">
                        <thead>
                            <tr>
                                <td scope="col">Metode Pembayaran</td>
                                <td scope="col"> BCA Virtual Acount </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<style>
    /* Gaya tambahan kustom bisa ditambahkan di sini */
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline:before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        width: 3px;
        background-color: #fbdb14;
        left: 50%;
        transform: translateX(-50%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 50px;
    }

    .timeline-icon {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #3498db;
        color: #fff;
        text-align: center;
        line-height: 30px;
        font-size: 18px;
    }

    .timeline-content {

        padding: 15px;
        background-color: #f4f4f4;
        border-radius: 5px;

    }
</style>


<?= $this->endSection(); ?>