<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<div class="container pt-3 pb-4">
    <div class="row row-cols-1 row-cols-sm-2">
        <div class="col">
            <div class="container">
                <div class="card border-0 shadow-sm">
                    <div class="col-md-12">
                        <div class="timeline text-center">
                            <?php
                            $count = 0;

                            foreach ($getstatus as $gs) :
                                if ($count >= $status->pesan_status) {
                                    break;
                                }
                            ?>
                                <div class="timeline-item">
                                    <div class="timeline-content bg-white">
                                        <div class="timeline-icon bg-warning"></div>
                                        <p class="fw-bold badge text-bg-danger"><?= $gs['status']; ?></p>
                                    </div>
                                </div>
                            <?php
                                $count++;
                            endforeach;
                            ?>
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

                        <div class="row row-cols-1">
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    <span class="list-group-item pb-3 border-0">
                                        <span class="fw-bold"></span>
                                        <p class="card-text text-secondary"><?= $status->kirim; ?></p>
                                    </span>
                                </ul>
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
                            <p><?= substr($status->invoice, 0, 20); ?>...</p>
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