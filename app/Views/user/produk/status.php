<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent">

        <div class="container pt-3 pb-4 d-md-none">
            <div class="row row-cols-1 row-cols-sm-2">
                <div class="col">
                    <div class="container">
                        <div class="card border-0 shadow-sm">
                            <div class="col-md-12">
                                <div class="timeline text-center">
                                    <?php
                                    $count = 0;
                                    if ($status->pesan_status == 5) {
                                        $count = 4;
                                    }

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
                                    <?php if ($status->pesan_status == 5) : ?>
                                        <div class="timeline-item">
                                            <div class="timeline-content bg-white">
                                                <div class="timeline-icon bg-warning"></div>
                                                <p class="fw-bold badge text-bg-danger"><?= $getstatus[4]['status']; ?></p>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($produk as $p) : ?>
                    <div class="row pt-3">
                        <div class="col">
                            <a href="<?= base_url('produk/' . $p->slug); ?>">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p->img; ?>" alt="" class="card-img">
                                            </div>
                                            <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                                <h5 class="card-title fs-6"><?= substr($p->nama, 0, 10); ?>...</h5>
                                                <p class="card-text text-secondary fs-6"><?= $p->qty; ?> <?= $p->value_item; ?>
                                                </p>
                                            </div>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <h5 class="text-secondary fs-6">Total</h5>
                                                <p class="fw-bold fs-6">Rp. <?= number_format(($p->harga_item * $p->qty), 0, ',', '.'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="col mt-3">
                    <div class="card border-0">
                        <h2>Lokasi Tujuan</h2>
                        <div class="mb-0 mx-0 my-0">
                            <div class="card form-control form-control-md border-0 shadow-sm">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <ul class="list-group list-group-flush">
                                            <span class="list-group-item pb-3 border-0">
                                                <span class="fw-bold"><?= $status->kurir; ?>
                                                </span>
                                                <p class="text-secondary">
                                                    Rp. <?= number_format($status->harga_service, 2, ',', '.'); ?>
                                                </p>
                                                <p class="card-text text-secondary"><?= $status->kirim; ?></p>
                                            </span>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($status->id_status_pesan != 1 && $status->id_status_pesan < 5) : ?>
                    <div class="col mt-3">
                        <div class="card border-0">
                            <div class="card form-control form-control-md border-0 shadow-sm">
                                <h2>Pesanan kamu</h2>
                                <div class="row">
                                    <div class="col-10">
                                        <p><?= $status->invoice; ?></p>
                                    </div>
                                    <div class="col-2">
                                        <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= $status->invoice; ?>')"></i>
                                    </div>
                                </div>
                                <?php if (isset($paymentStatus->va_numbers[0])) : ?>
                                    <div class="row">
                                        <div class="col-10">
                                            <p><?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?></p>
                                        </div>
                                        <div class="col-2">
                                            <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?>')"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-sm ">
                                                <thead>
                                                    <tr>
                                                        <td scope="col">Metode Pembayaran</td>
                                                        <td scope="col"> <?= ucwords(str_replace("_", " ", $paymentStatus->payment_type)); ?> </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="row py-3 px-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ringkasan Belanja</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total Harga</td>
                                                <td>Rp. <?= number_format($status->total_1, 2, ',', '.'); ?></td>
                                            </tr>
                                            <?php if ($status->kupon) : ?>
                                                <tr>
                                                    <td>Diskon</td>
                                                    <td>-RP. <?= number_format(($status->discount * $status->total_1), 2, ',', '.'); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>Total Ongkos Kirim</td>
                                                <td>Rp. <?= number_format($status->harga_service, 2, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Jasa Aplikasi</td>
                                                <td>Rp. <?= number_format($jasa, 2, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Subtotal</td>
                                                <td>Rp. <?= number_format($status->total_2, 2, ',', '.'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="row">
            <div class="col"></div>
        </div>
        <?php   // =====================    PRNTING  =================================
        if ($status->id_status_pesan == 1) : ?>
            <script type="text/javascript" src="<?= $urlMidtrans; ?>" data-client-key="<?= $key; ?>"></script>
            <div class="row p-3 px-4 fixed-bottom">
                <button id="pay-button" class="btn btn-lg fw-bold d-md-none" style="background-color: #ec2614; color: #fff;">Buka Pembayaran</button>
            </div>
            <script type="text/javascript">
                function lpSanp() {
                    window.snap.pay('<?= $status->snap_token; ?>', {
                        onSuccess: function(result) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url('payment/token'); ?>",
                                dataType: "json",
                                data: {
                                    csrf_test_name: '<?= csrf_hash(); ?>',
                                    token: '<?= $status->snap_token; ?>',
                                    result: result,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Pembayaran berhasil',
                                            showConfirmButton: false,
                                            timer: 1500,
                                            text: response.message,
                                        })
                                    }
                                },
                                error: function(error) {
                                    console.error("Error:", error);
                                }
                            });
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    })
                }

                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    lpSanp();
                });
            </script>
        <?php endif ?>
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

<?php else : ?>
    <!-- TAMPILAN DESKTOP -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 justify-content-center d-none d-md-block">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h2 class="mb-0"><?= $title; ?></h2>
                            <hr class="text-danger">
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="track">
                                <?php
                                $count = 0;
                                if ($status->pesan_status == 5) {
                                    $count = 3;
                                }
                                foreach ($getstatus as $gs) :
                                    if ($count >= $status->pesan_status || $count == 4) {
                                        break;
                                    }
                                ?>
                                    <div class="step active">
                                        <span class="icon"><i class="bi bi-credit-card"></i></span>
                                        <span class="text"><?= $gs['status']; ?></span>
                                    </div>

                                <?php
                                    $count++;
                                endforeach;
                                ?>
                                <?php if ($status->pesan_status == 5) : ?>
                                    <div class="step active">
                                        <span class="icon"><i class="bi bi-credit-card"></i></span>
                                        <span class="text"><?= $getstatus[4]['status']; ?></span>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($status->pesan_status) : ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-0 mb-4 mb-md-0">
                                    <div class="d-block card-header bg-white border-0">
                                        <h4 class="text-danger fw-bold">Lokasi Tujuan</h4>
                                    </div>
                                    <div class="card-body border-0">
                                        <div class="card px-4 py-4 shadow-sm" style="border-left: 4px solid red; border-right: 0px; border-top: 0px; border-bottom: 0px;">
                                            <span class="text-secondary">Pilihan Kurir</span>
                                            <span class="fw-bold"><?= $status->kurir; ?></span>
                                            <span class="text-secondary">Harga</span>
                                            <p class="fw-bold">Rp. <?= number_format($status->harga_service, 0, ',', '.'); ?></p>
                                            <p class="card-text text-secondary"><?= $status->kirim; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 mb-4 mb-md-0">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col">
                                                <?php foreach ($produk as $p) : ?>
                                                    <a href="<?= base_url('produk/' . $p->slug); ?>">
                                                        <div class="card mb-4 shadow-sm" style="border-left: 4px solid red; border-right: 0px; border-top: 0px; border-bottom: 0px;">
                                                            <div class=" row">
                                                                <div class="col-3">
                                                                    <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p->img; ?>" alt="" class="card-img">
                                                                </div>
                                                                <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                                                    <h5 class="card-title fs-6"><?= substr($p->nama, 0, 10); ?>...</h5>
                                                                    <p class="card-text text-secondary fs-6"><?= $p->qty; ?></p>
                                                                </div>
                                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                                    <h5 class="text-secondary fs-6">Total</h5>
                                                                    <p class="fw-bold fs-6">Rp. <?= number_format(($p->harga * $p->qty), 0, ',', '.'); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php endforeach; ?>
                                                <?php if ($status->id_status_pesan == 1) : ?>
                                                    <div class="row p-3 px-4">
                                                        <button id="pay-button" class="btn btn-lg d-none d-md-block" style="background-color: #ec2614; color: #fff;">Metode Pembayaran</button>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                        </div>


                        <?php if ($status->id_status_pesan != 1 && $status->pesan_status < 5) : ?>
                            <div class="row">
                                <div class="col-md-12 mx-auto mt-5">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="text-center mb-3 mt-3">
                                                <img src="<?= base_url() ?>assets/img/logopanjang.png" alt="" class="card-img-top" style="width: 100px; height: 30px; margin: 0 auto;">
                                            </div>
                                            <h2 class="text-center mb-4">Pesanan kamu</h2>
                                            <div class="row mb-3">
                                                <div class="col-10">
                                                    <p>Invoice: <?= $status->invoice; ?></p>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= $status->invoice; ?>')"></i>
                                                </div>
                                            </div>
                                            <?php if (isset($paymentStatus->va_numbers[0])) : ?>
                                                <div class="row mb-3">
                                                    <div class="col-10">
                                                        <p><?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?></p>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?>')"></i>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Metode Pembayaran</th>
                                                                    <th scope="col"><?= ucwords(str_replace("_", " ", $paymentStatus->payment_type)); ?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <h5 class="mb-3">Ringkasan Belanja</h5>
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Total Harga :</td>
                                                                <td>Rp. <?= number_format($status->total_1, 2, ',', '.'); ?></td>
                                                            </tr>
                                                            <?php if ($status->kupon) : ?>
                                                                <tr>
                                                                    <td>Diskon :</td>
                                                                    <td>-Rp. <?= number_format(($status->discount * $status->total_1), 2, ',', '.'); ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                            <tr>
                                                                <td>Total Ongkos Kirim :</td>
                                                                <td>Rp. <?= number_format($status->harga_service, 2, ',', '.'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Biaya Pelayanan :</td>
                                                                <td>Rp. <?= number_format($jasa, 2, ',', '.'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Subtotal :</td>
                                                                <td>
                                                                    <span class="fw-bold">Rp. <?= number_format($status->total_2, 2, ',', '.'); ?></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
        </div>
        <?php   // =====================    PRNTING  =================================
        if ($status->id_status_pesan == 1) : ?>
            <script type="text/javascript" src="<?= $urlMidtrans; ?>" data-client-key="<?= $key; ?>"></script>
            <script type="text/javascript">
                function lpSanp() {
                    window.snap.pay('<?= $status->snap_token; ?>', {
                        onSuccess: function(result) {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url('payment/token'); ?>",
                                dataType: "json",
                                data: {
                                    csrf_test_name: '<?= csrf_hash(); ?>',
                                    token: '<?= $status->snap_token; ?>',
                                    result: result,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Pembayaran berhasil',
                                            showConfirmButton: false,
                                            timer: 1500,
                                            text: response.message,
                                        })
                                    }
                                },
                                error: function(error) {
                                    console.error("Error:", error);
                                }
                            });
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    })
                }

                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    lpSanp();
                });
            </script>
        <?php endif ?>
        <style>
            /* dekstop */
            .track {
                position: relative;
                background-color: #ddd;
                height: 7px;
                display: flex;
                margin-bottom: 60px;
                margin-top: 50px;
            }

            .track .step {
                flex-grow: 1;
                width: 25%;
                margin-top: -18px;
                text-align: center;
                position: relative;
            }

            .track .step.active:before {
                background: #FF5722;
            }

            .track .step::before {
                height: 7px;
                position: absolute;
                content: "";
                width: 100%;
                left: 0;
                top: 18px;
            }

            .track .step.active .icon {
                background: #ee5435;
                color: #fff;
            }

            .track .icon {
                display: inline-block;
                width: 40px;
                height: 40px;
                line-height: 40px;
                position: relative;
                border-radius: 100%;
                background: #ddd;
            }

            .track .step.active .text {
                font-weight: 400;
                color: #000;
            }

            .track .text {
                display: block;
                margin-top: 7px;
            }
        </style>
    <?php endif; ?>


    <?= $this->endSection(); ?>