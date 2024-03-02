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
        <div class="container pb-4">
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm mb-2">
                            <div class="card-body">
                                <span class="text-secondary" style="font-size: 13px;"><?= lang('Text.pilihan_kurir') ?></span>
                                <br>
                                <span class="fw-bold" style="font-size: 14px;"><?= $status->kurir; ?> (Rp. <?= number_format($status->harga_service, 0, ',', '.'); ?>)</span>
                                <br>
                                <span class="text-secondary" style="font-size: 14px;"><?= lang('Text.total_status') ?></span>
                                <br>
                                <span class="fw-bold" style="font-size: 14px;">Rp. <?= number_format($status->total_2, 0, ',', '.'); ?></span>
                                <p class="card-text text-secondary"><?= $status->kirim; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($produk as $p) : ?>
                <div class="product-card card border-0 shadow-sm mb-2">
                    <a class="text-decoration-none" href="<?= base_url('produk/' . $p->slug); ?>">
                        <div class="card-body d-flex align-items-center">
                            <div class="col-3 p-0 img-container">
                                <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p->img; ?>" alt="" class="card-img">
                            </div>
                            <div class="col-9 pl-3">
                                <label class="card-title mb-1 text-dark" style="font-size: 12px;"><?= substr($p->$kolomNama, 0, 50); ?>...</label>
                                <p class="card-text text-secondary " style="font-size: 12px;"><?= $p->qty; ?> <?= $p->value_item; ?></p>
                                <div class="price-info d-flex gap-2">
                                    <label for="total" class="text-secondary m-0 text-dark" style="font-size: 13px;">Total:</label>
                                    <?php $total = $p->harga_item * $p->qty ?>
                                    <?php if (isset(($p->promo))) : ?>
                                        <p class="fw-bold m-0 text-dark text-decoration-line-through" style="font-size: 13px;">Rp. <?= number_format(($total), 0, ',', '.'); ?></p>
                                        <p class="fw-bold m-0 text-dark" style="font-size: 12px;">Rp. <?= number_format(($total - ($total * $p->promo['discount'])), 0, ',', '.'); ?></p>
                                    <?php else : ?>
                                        <p class="fw-bold m-0 text-dark" style="font-size: 12px;">Rp. <?= number_format(($total), 0, ',', '.'); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
            <div class="col mb-2">
                <div class="card form-control form-control-md border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="fs-5 fw-bold mb-3"><?= lang('Text.informasi_pembayaran') ?></h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 p-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="text-secondary"><?= lang('Text.inv_status') ?></span>
                                        <p class="fw-bold"><?= $status->invoice; ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-light btn-sm" onclick="copyBtn('<?= $status->invoice; ?>')">
                                            <i class="bi bi-clipboard-fill text-danger"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <?php if (isset($paymentStatus->va_numbers[0])) : ?>
                                <li class="list-group-item border-0 p-0">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <span class="text-secondary"><?= lang('Text.no_va') ?></span>
                                            <p class="fw-bold"><?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?></p>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-light btn-sm" onclick="copyBtn('<?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?>')">
                                                <i class="bi bi-clipboard-fill text-danger"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 p-0">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <span class="text-secondary"><?= lang('Text.resi') ?></span>
                                            <p class="fw-bold"><?= $status->resi; ?></p>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-light btn-sm" onclick="copyBtn('<?= $status->resi; ?>')">
                                                <i class="bi bi-clipboard-fill text-danger"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 p-0">
                                    <div class="row">
                                        <div class="col">
                                            <span class="text-secondary"><?= lang('Text.metode_pembayaran') ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <p class="fw-bold"><?= ucwords(str_replace("_", " ", $paymentStatus->payment_type)); ?></p>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="tracking-list">
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
                                <div class="tracking-item">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date" class="img-responsive" alt="order-placed" /><i class="bi bi-rocket-takeoff fs-1"></i>
                                </div>
                                <div class="tracking-content"><?= $gs[$kolomStatus]; ?><span></div>
                        </div>

                    <?php
                                $count++;
                            endforeach;
                    ?>
                    <?php if ($status->pesan_status == 5) : ?>
                        <div class="tracking-item-pending">
                            <div class="tracking-icon status-intransit">
                                <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                </svg>
                            </div>
                            <div class="tracking-date" class="img-responsive" alt="order-placed" /><i class="bi bi-heartbreak fs-1"></i>
                        </div>
                        <div class="tracking-content"><?= $getstatus[4][$kolomStatus]; ?><span></div>
                    </div>
                <?php endif ?>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

    <?php   // =====================    PRNTING  =================================
    if ($status->id_status_pesan == 1) : ?>
        <script type="text/javascript" src="<?= $urlMidtrans; ?>" data-client-key="<?= $key; ?>"></script>
        <div class="d-flex align-items-center justify-content-center w-100 h-100" style="left: 0; right: 0;">
            <button id="pay-button" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; font-size: 14px; width: 90%"><?= lang('Text.btn_pembayaran') ?></button>
        </div>
        <div class="py-3"></div>
        <div class="d-flex align-items-center justify-content-center w-100 h-100" style="left: 0; right: 0;">
            <button id="cahnge-pay-button" data-bs-toggle="modal" data-bs-target="#changePaymentMethod" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; display: none; font-size: 14px; width: 90%"><?= lang('Text.btn_ubah_metode_pembayaran') ?></button>
        </div>

        <!-- Modal Change Payment -->
        <div class="modal fade" id="changePaymentMethod" tabindex="-1" aria-labelledby="changePaymentMethodLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changePaymentMethodLabel"><?= lang('Text.btn_ubah_metode_pembayaran') ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?= lang('Text.alert_pembayaran') ?></p>
                        <form id="changePayment" action="<?= base_url('new-payment'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="invoice" value="<?= $status->invoice; ?>">
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center">
                        <button type="submit" form="changePayment" class="btn btn-danger"><?= lang('Text.btn_ubah_metode_pembayaran') ?></button>
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
                                        // text: response.message,
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
        #tracking {
            background: #fff
        }

        .tracking-detail {
            padding: 3rem 0;
        }

        #tracking {
            margin-bottom: 1rem;
        }

        [class*="tracking-status-"] p {
            margin: 0;
            font-size: 1.1rem;
            color: #fff;
            text-transform: uppercase;
            text-align: center;
        }

        [class*="tracking-status-"] {
            padding: 1.6rem 0;
        }

        .tracking-list {
            border: 1px solid #e5e5e5;
        }

        .tracking-item {
            border-left: 4px solid #fcc603;
            position: relative;
            padding: 2rem 1.5rem 0.5rem 2.5rem;
            font-size: 0.9rem;
            margin-left: 3rem;
            min-height: 5rem;
        }

        .tracking-item:last-child {
            padding-bottom: 4rem;
        }

        .tracking-item .tracking-date {
            margin-bottom: 0.5rem;
        }

        .tracking-item .tracking-date span {
            color: #888;
            font-size: 85%;
            padding-left: 0.4rem;
        }

        .tracking-item .tracking-content {
            padding: 0.5rem 0.8rem;
            background-color: #f4f4f4;
            border-radius: 0.5rem;
        }

        .tracking-item .tracking-content span {
            display: block;
            color: #767676;
            font-size: 13px;
        }

        .tracking-item .tracking-icon {
            position: absolute;
            left: -0.7rem;
            width: 1.1rem;
            height: 1.1rem;
            text-align: center;
            border-radius: 50%;
            font-size: 1.1rem;
            background-color: #fff;
            color: #fff;
        }

        .tracking-item-pending {
            border-left: 4px solid #d6d6d6;
            position: relative;
            padding: 2rem 1.5rem 0.5rem 2.5rem;
            font-size: 0.9rem;
            margin-left: 3rem;
            min-height: 5rem;
        }

        .tracking-item-pending:last-child {
            padding-bottom: 4rem;
        }

        .tracking-item-pending .tracking-date {
            margin-bottom: 0.5rem;
        }

        .tracking-item-pending .tracking-date span {
            color: #888;
            font-size: 85%;
            padding-left: 0.4rem;
        }

        .tracking-item-pending .tracking-content {
            padding: 0.5rem 0.8rem;
            background-color: #f4f4f4;
            border-radius: 0.5rem;
        }

        .tracking-item-pending .tracking-content span {
            display: block;
            color: #767676;
            font-size: 13px;
        }

        .tracking-item-pending .tracking-icon {
            line-height: 2.6rem;
            position: absolute;
            left: -0.7rem;
            width: 1.1rem;
            height: 1.1rem;
            text-align: center;
            border-radius: 50%;
            font-size: 1.1rem;
            color: #d6d6d6;
        }

        .tracking-item-pending .tracking-content {
            font-weight: 500;
            font-size: 13px;
        }

        .tracking-item .tracking-icon.status-current {
            width: 1.9rem;
            height: 1.9rem;
            left: -1.1rem;
        }

        .tracking-item .tracking-icon.status-intransit {
            color: #fcc603;
            font-size: 0.6rem;
        }

        .tracking-item .tracking-icon.status-current {
            color: #fcc603;
            font-size: 0.6rem;
        }

        @media (min-width: 992px) {
            .tracking-item {
                margin-left: 10rem;
            }

            .tracking-item .tracking-date {
                position: absolute;
                left: -10rem;
                width: 7.5rem;
                text-align: right;
            }

            .tracking-item .tracking-date span {
                display: block;
            }

            .tracking-item .tracking-content {
                padding: 0;
                background-color: transparent;
            }

            .tracking-item-pending {
                margin-left: 10rem;
            }

            .tracking-item-pending .tracking-date {
                position: absolute;
                left: -10rem;
                width: 7.5rem;
                text-align: right;
            }

            .tracking-item-pending .tracking-date span {
                display: block;
            }

            .tracking-item-pending .tracking-content {
                padding: 0;
                background-color: transparent;
            }
        }

        .tracking-item .tracking-content {
            font-weight: 500;
            font-size: 13px;
        }

        .blinker {
            border: 7px solid #e9f8ea;
            animation: blink 1s;
            animation-iteration-count: infinite;
        }

        @keyframes blink {
            50% {
                border-color: #fff;
            }
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
                            <h3 class="fw-bold mb-0"><i class="fs-1 text-danger bi bi-receipt-cutoff"></i> <?= $title; ?></h3>
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
                                        <h4 class="text-danger fw-bold">Detail Pesanan</h4>
                                    </div>
                                    <div class="card-body border-0">
                                        <div class="card px-4 py-4 shadow-sm" style="border-left: 4px solid red; border-right: 0px; border-top: 0px; border-bottom: 0px;">
                                            <span class="text-secondary">Invoice</span>
                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold"><?= $status->invoice; ?></p>
                                                <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= $status->invoice; ?>')"></i>
                                            </div>
                                            <?php if (isset($paymentStatus->va_numbers[0])) : ?>
                                                <div class="row mb-3">
                                                    <span class="text-secondary">Nomor VA</span>

                                                    <div class="col-10">
                                                        <p class="fw-bold"><?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?></p>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <i class="bi bi-clipboard-fill fs-5 text-danger" onclick="copyBtn('<?= strtoupper($paymentStatus->va_numbers[0]->bank) . ' ' . $paymentStatus->va_numbers[0]->va_number; ?>')"></i>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <span class="text-secondary">Resi</span>
                                                    <div class="col-10">
                                                        <p class="fw-bold">Resi <?= $status->resi; ?></p>
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
                                            <span class="text-secondary">Pilihan Kurir</span>
                                            <span class="fw-bold"><?= $status->kurir; ?> (Rp. <?= number_format($status->harga_service, 0, ',', '.'); ?>)</span>
                                            <span class="text-secondary">Total</span>
                                            <span class="fw-bold">Rp. <?= number_format($status->total_2, 0, ',', '.'); ?></span>
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