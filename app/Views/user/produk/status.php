<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<?php if ($isMobile) : ?>
    <div id="mobileContent" style="width: 100%;">
        <div class="container pt-3 pb-4">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm mb-2">
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
                                            <h5 class="card-title " style="font-size: 12px;"><?= substr($p->nama, 0, 10); ?></h5>
                                            <p class="card-text text-secondary " style="font-size: 12px;"><?= $p->qty; ?> <?= $p->value_item; ?>
                                            </p>
                                        </div>
                                        <div class="col-5 position-absolute top-50 end-0 mt-2 translate-middle-y ps-4">
                                            <h5 class="text-secondary" style="font-size: 13px;">Total</h5>
                                            <?php $total = $p->harga_item * $p->qty ?>
                                            <?php if (isset(($p->promo))) : ?>
                                                <p class="fw-bold text-decoration-line-through" style="font-size: 11px;">Rp. <?= number_format(($total), 0, ',', '.'); ?></p>
                                            <?php else : ?>
                                                <p class="fw-bold" style="font-size: 13px;">Rp. <?= number_format(($total), 0, ',', '.'); ?></p>
                                            <?php endif; ?>
                                            <?php if (isset(($p->promo))) : ?>
                                                <p class="fw-bold" style="font-size: 13px;">Rp. <?= number_format(($total - ($total * $p->promo['discount'])), 0, ',', '.'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="col mt-3">
                <div class="card form-control form-control-md border-0 shadow-sm">
                    <div class="card border-0">
                        <h2 class="fs-5 fw-bold">Lokasi Tujuan</h2>
                        <div class="mb-0 mx-0 my-0">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <ul class="list-group list-group-flush">
                                        <span class="list-group-item pb-3 border-0">
                                            <span class="fw-bold"><?= $status->kurir; ?>
                                            </span>
                                            <p class="text-secondary">
                                                Rp. <?= number_format($status->harga_service, 0, ',', '.'); ?>
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

            <div class="col mt-3">
                <div class="card border-0">
                    <div class="card form-control form-control-md border-0 shadow-sm">
                        <h2 class="fs-5 fw-bold">Pesanan Kamu</h2>
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
                                <div class="col-10">
                                    <p>Resi <?= $status->resi; ?></p>
                                </div>
                                <div class="col-2">
                                    <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= $status->resi; ?>')"></i>
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
                                        <td>Subtotal</td>
                                        <td>Rp. <?= number_format($status->total_1, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php if ($status->kupon) : ?>
                                        <tr>
                                            <td>Diskon</td>
                                            <td>-RP. <?= number_format(($status->discount * $status->total_1), 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td>Total Ongkos Kirim</td>
                                        <td>Rp. <?= number_format($status->harga_service, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td>Rp. <?= number_format($status->total_2, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($status->id_status_pesan == 3 && $status_transaction == 0) : ?>
                            <div class="card mb-4 mb-md-0 border-0 shadow-sm mt-3">
                                <div class="card-body">
                                    <h3 class="mb-4"><span class="text-dark font-italic me-1">Tracking Order</h3>
                                    <hr class="border-darker mt-0 mb-3">
                                    <div class="row">
                                        <div class="col d-grid">
                                            <button class="btn btn-danger fw-bold fs-4" data-bs-toggle="modal" data-bs-target="#updateStatus">Pesanan Selesai</button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true" style="overflow: hidden;">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-4 shadow">
                                                <div class="modal-header border-bottom-0 text-center">
                                                    <h1 class="modal-title fs-5 fw-bold">Selesaikan Pesanan</h1>
                                                </div>
                                                <div class="modal-body py-0">
                                                    <p>Pastikan pesanan anda telah diterima.</p>
                                                </div>
                                                <form action="<?= base_url('status/update/' . $inv) ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                                        <button type="submit" onclick="clickSubmitEvent(this)" class="btn btn-lg btn-success">Selesai</button>
                                                        <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                    </div>
                                                </form>
                                            </div>
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

    <?php   // =====================    PRNTING  =================================
    if ($status->id_status_pesan == 1) : ?>
        <script type="text/javascript" src="<?= $urlMidtrans; ?>" data-client-key="<?= $key; ?>"></script>
        <div class="d-flex align-items-center justify-content-center w-100 h-100" style="left: 0; right: 0;">
            <button id="pay-button" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; font-size: 14px; width: 90%">Buka Pembayaran</button>
        </div>
        <div class="py-3"></div>
        <div class="d-flex align-items-center justify-content-center w-100 h-100" style="left: 0; right: 0;">
            <button id="cahnge-pay-button" data-bs-toggle="modal" data-bs-target="#changePaymentMethod" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; display: none; font-size: 14px; width: 90%">Ubah Metode Pembayaran</button>
        </div>

        <!-- Modal Change Payment -->
        <div class="modal fade" id="changePaymentMethod" tabindex="-1" aria-labelledby="changePaymentMethodLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changePaymentMethodLabel">Ubah Metode Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>결제 방법을 변경하면 이 거래가 취소되고 새 거래가 생성됩니다.</p>
                        <p>Dengan mengubah metode pembayaran anda akan membatakan transaksi ini dan membuat transaksi baru.</p>
                        <form id="changePayment" action="<?= base_url('new-payment'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="invoice" value="<?= $status->invoice; ?>">
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button type="submit" form="changePayment" class="btn btn-danger">Ubah Metode Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function lpSanp() {
                window.snap.pay('<?= $status->snap_token; ?>', {
                    onSuccess: function(result) {
                        paymentSuccess('<?= $order_id; ?>')
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
                                location.reload();
                            },
                            error: function(error) {
                                console.error("Error:", error);
                            }
                        });
                    },
                    onPending: function(result) {
                        let timerInterval
                        Swal.fire({
                            title: '<?= lang('Text.onpending_title') ?>',
                            html: '<?= lang('Text.onpending_deskripsi') ?> <b></b> milliseconds.',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            //
                        })
                    },
                    onError: function(result) {
                        Swal.fire({
                            icon: 'error',
                            title: '<?= lang('Text.onerror_title') ?>'
                        })
                    },
                    onClose: function() {
                        Swal.fire({
                            text: '<?= lang('Text.onclose_title') ?>',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<?= lang('Text.onclose_cnfrm_btn') ?>',
                            cancelButtonText: '<?= lang('Text.onclose_cancel_btn') ?>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#cahnge-pay-button").show();
                            } else {

                                lpSanp();
                            }
                        });
                        return false; // Mencegah pop-up Midtrans untuk menutup secara otomatis
                    }
                })
            }


            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function() {
                lpSanp();
            });
        </script>
    <?php endif ?>
    <script>
        function paymentSuccess(inv) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/payment-success'); ?>",
                dataType: "json",
                data: {
                    csrf_test_name: '<?= csrf_hash(); ?>',
                    inv: inv
                },
                success: function(response) {
                    //
                },
                error: function(error) {
                    //
                }
            })
        }
    </script>

    <style>
        /* timeline  style di semua tampilan*/
        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: flex;
            margin-bottom: 50px;
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
            font-weight: 500;
            color: #000;
            font-size: 10px;
        }

        .track .text {
            display: block;
            margin-top: 7px;
        }
    </style>

    <style>
        /* Tampilan track khusus Samsung Galaxy Fold */
        @media (max-width: 280px) {

            .btn-group-lg>.btn,
            .btn-lg {
                font-size: 12px;
                padding: 0.5rem !important;
            }

            i.bi-clipboard-fill {
                font-size: 16px !important;
                /* Sesuaikan ukuran ikon sesuai kebutuhan */
            }

            span.fw-bold {
                font-size: 12px !important;
            }

            p.fw-bold.fs-6 {
                font-size: 12px !important;
            }

            p.card-text.text-secondary.fs-6 {
                font-size: 12px !important;
            }

            .col {
                width: 100%;
            }

            .list-group-item {
                padding: 0px;
            }

            h2.fs-5 {
                margin-top: 8px !important;
                font-size: 14px !important;
            }

            p {
                font-size: 12px;
            }

            .table {
                font-size: 0.8rem;
            }

            .track .step {
                width: 30%;
                top: 7px;
            }

            .track .step::before {
                height: 7px;
                position: absolute;
                content: "";
                width: 100%;
                left: 0;
                top: 11px;
            }

            .track .icon {
                width: 30px;
                height: 30px;
                line-height: 30px;
            }

            .track .step.active .text {
                font-size: 11px;
            }

            h5.card-title.fs-6 {
                font-size: 14px !important;
            }

            h5.text-secondary.fs-6 {
                font-size: 14px !important;
            }
        }
    </style>

<?php else : ?>
    <!-- TAMPILAN DESKTOP -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 justify-content-center d-none d-sm-block">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h2 class="fw-bold mb-0"><?= $title; ?></h2>
                            <hr class="mb-3 border-danger" style="border-width: 3px;">
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
                                <!-- pesanan kamu -->
                                <div class="card border-0 mb-4 mb-md-0">
                                    <div class="card-body">
                                        <div class="text-center mb-3 mt-3">
                                            <img src="<?= base_url() ?>assets/img/logopanjang.png" alt="" class="card-img-top" style="width: 100px; height: 30px; margin: 0 auto;">
                                        </div>
                                        <h2 class="text-center mb-4">Pesanan Kamu</h2>
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
                                                <div class="col-10">
                                                    <p>Resi <?= $status->resi; ?></p>
                                                </div>
                                                <div class="col-2 text-end">
                                                    <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= $status->resi; ?>')"></i>
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
                                                            <td>Subtotal :</td>
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
                                                            <td>Total Harga :</td>
                                                            <td>
                                                                <span class="fw-bold">Rp. <?= number_format($status->total_2, 2, ',', '.'); ?></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php if ($status->id_status_pesan == 3 && $status_transaction == 0) : ?>
                                            <div class="card mb-4 mb-md-0 border-0 shadow-sm mt-3">
                                                <div class="card-body">
                                                    <h3 class="mb-4"><span class="text-dark font-italic me-1">Tracking Order</h3>
                                                    <hr class="border-darker mt-0 mb-3">
                                                    <div class="row">
                                                        <div class="col d-grid">
                                                            <button class="btn btn-danger fw-bold fs-4" data-bs-toggle="modal" data-bs-target="#updateStatus">Pesanan Selesai</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true" style="overflow: hidden;">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content rounded-4 shadow">
                                                                <div class="modal-header border-bottom-0 text-center">
                                                                    <h1 class="modal-title fs-5 fw-bold">Selesaikan Pesanan</h1>
                                                                </div>
                                                                <div class="modal-body py-0">
                                                                    <p>Pastikan pesanan anda telah diterima.</p>
                                                                </div>
                                                                <form action="<?= base_url('status/update/' . $inv) ?>" method="post">
                                                                    <?= csrf_field(); ?>
                                                                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                                                        <button type="submit" class="btn btn-lg btn-success">Selesai</button>
                                                                        <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- end -->
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
                                                                    <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p->img; ?>" alt="" class="card-img" style="width: 150px; height: 100%; padding: 8px; object-fit: contain; object-position: 20% 10%;">
                                                                </div>
                                                                <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                                                    <h5 class="card-title fs-6"><?= substr($p->nama, 0, 40); ?>...</h5>
                                                                    <p class="card-text text-secondary fs-6"><?= $p->qty; ?> Produk</p>
                                                                </div>
                                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                                    <h5 class="text-secondary fs-6">Total</h5>
                                                                    <?php $total = $p->harga_item * $p->qty ?>
                                                                    <?php if (isset(($p->promo))) : ?>
                                                                        <p class="fw-bold text-decoration-line-through" style="font-size: 12px;">Rp. <?= number_format(($total), 0, ',', '.'); ?></p>
                                                                    <?php else : ?>
                                                                        <p class="fw-bold">Rp. <?= number_format(($total), 0, ',', '.'); ?></p>
                                                                    <?php endif; ?>
                                                                    <?php if (isset(($p->promo))) : ?>
                                                                        <p class="fw-bold">Rp. <?= number_format(($total - ($total * $p->promo['discount'])), 0, ',', '.'); ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php endforeach; ?>
                                                <?php if ($status->id_status_pesan == 1) : ?>
                                                    <div class="row p-3 px-4">
                                                        <button id="pay-button" class="btn btn-lg d-none d-md-block" style="background-color: #ec2614; color: #fff;">Metode Pembayaran</button>
                                                    </div>
                                                    <div class="row p-3 px-4">
                                                        <button id="cahnge-pay-button" data-bs-toggle="modal" data-bs-target="#changePaymentMethod" class="btn btn-lg" style="background-color: #ec2614; color: #fff; display: none;">Ubah Metode Pembayaran</button>
                                                    </div>

                                                    <!-- Modal Change Payment -->
                                                    <div class="modal fade" id="changePaymentMethod" tabindex="-1" aria-labelledby="changePaymentMethodLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="changePaymentMethodLabel">Ubah Metode Pembayaran</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>결제 방법을 변경하면 이 거래가 취소되고 새 거래가 생성됩니다.</p>
                                                                    <p>Dengan mengubah metode pembayaran anda akan membatakan transaksi ini dan membuat transaksi baru.</p>
                                                                    <form id="changePayment" action="<?= base_url('new-payment'); ?>" method="post">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="invoice" value="<?= $status->invoice; ?>">
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center align-items-center">
                                                                    <button type="submit" form="changePayment" class="btn btn-danger">Ubah Metode Pembayaran</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
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
                                    location.reload();
                                },
                                error: function(error) {
                                    console.error("Error:", error);
                                }
                            });
                        },
                        onPending: function(result) {
                            let timerInterval
                            Swal.fire({
                                title: '<?= lang('Text.onpending_title') ?>',
                                html: '<?= lang('Text.onpending_deskripsi') ?> <b></b> milliseconds.',
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('I was closed by the timer')
                                }
                            })

                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: '<?= lang('Text.onerror_title') ?>'
                            })
                        },
                        onClose: function() {
                            Swal.fire({
                                text: '<?= lang('Text.onclose_title') ?>',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: '<?= lang('Text.onclose_cnfrm_btn') ?>',
                                cancelButtonText: '<?= lang('Text.onclose_cancel_btn') ?>'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#cahnge-pay-button").show();
                                } else {

                                    lpSanp();
                                }
                            });
                            return false; // Mencegah pop-up Midtrans untuk menutup secara otomatis
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
    </div>
<?php endif; ?>
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