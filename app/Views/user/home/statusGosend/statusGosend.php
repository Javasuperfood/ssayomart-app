<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Mobile View  -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <!-- Konten kartu -->
                    <div class="card p-4 rounded-top-4 rounded-bottom-0 border-0 shadow-sm">
                        <div class="card-body">
                            <p class="mb-2 text-center"><span class="fs-5 fw-bold text-dark font-italic me-1">Data Status Pengiriman</p>
                            <hr class="border-darker mt-0 mb-3">
                            </p>
                            <?php if ($gosendStatus) : ?>
                                <p class="mt-4 mb-1" style="font-size: 16px;">Nama Driver</p>
                                <span class="fw-bold"><?= $gosendStatus['driverName']; ?></span>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <p class="driver-phone" style="font-size: 16px;">Driver Phone</p>
                                        <span class="fw-bold mt-3"><?= $gosendStatus['driverPhone']; ?></span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <button type="button" class="ms-auto mt-3 mt-md-0 btn-sm btn btn-success"><i class="bi bi-whatsapp"></i></button>
                                    </div>
                                </div>

                                <hr>
                                <p class="mt-4 mb-1" style="font-size: 16px;">Booking ID</p>
                                <span class="fw-bold"><?= $gosendStatus['orderNo']; ?></span>
                                <hr>
                                <p class="mt-4 mb-1" style="font-size: 16px;">status</p>
                                <span class="fw-bold"><?= $gosendStatus['status']; ?></span>
                                <hr>
                                <?php if ($gosendStatus['cancelDescription']) : ?>
                                    <p class="mt-4 mb-1" style="font-size: 16px;">cancelDescription</p>
                                    <span class="fw-bold"><?= $gosendStatus['cancelDescription']; ?></span>
                                    <hr>
                                <?php endif; ?>
                                <p class="mt-4 mb-1" style="font-size: 16px;">Nama Penerima</p>
                                <span class="fw-bold"><?= $gosendStatus['receiverName']; ?></span>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <p class="mb-2 text-center"><span class="fs-5 fw-bold text-dark font-italic me-1">Status Pengiriman</p>
                    <hr class="border-darker mt-0 mb-2">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="bi bi-check2-circle"></i> </span> <span class="text" style="font-size: smaller;">Order confirmed</span> </div>
                        <?php if ($gosendStatus) : ?>
                            <?php foreach ($status as $s) :  ?>
                                <div class="step active"> <span class="icon"> <i class="bi <?= ($s == 'Completed') ? 'bi-check2-circle' : 'bi-truck'; ?>"></i> </span> <span class="text" style="font-size: smaller;"> <?= $s; ?> </span> </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-5 card mb-4 mb-md-0 border-0 shadow-sm">
                        <div class="card-body">
                            <p class="mb-2 text-center"><span class="fs-5 fw-bold text-dark font-italic me-1">Rincian</p>
                            <hr class="border-darker mt-0 mb-2">
                            <div class="col">
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
                                                                <h5 class="card-title fs-6"><?= substr($p->nama, 0, 10); ?></h5>
                                                                <p class="card-text text-secondary fs-6"><?= $p->qty; ?> <?= $p->value_item; ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-5 position-absolute top-50 end-0 mt-2 translate-middle-y ps-4">
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
                                <hr>
                            </div>
                            <?php if ($gosendStatus) : ?>
                                <div class="col">
                                    <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-send fw-bold"></i> Pengirim</p>
                                    <span class="fw-bold ms-4"><?= $gosendStatus['sellerAddressName']; ?></span>
                                    <p class="ms-4 text-secondary"><?= $gosendStatus['sellerAddressDetail']; ?></p>
                                    <hr>
                                </div>
                                <div class="col">
                                    <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-house"></i> Penerima</p>
                                    <span class="fw-bold ms-4"><?= $gosendStatus['buyerAddressName']; ?></span>
                                    <p class="ms-4 text-secondary"><?= $gosendStatus['buyerAddressDetail']; ?></p>
                                    <hr>
                                </div>
                            <?php endif ?>
                            <div class="col">
                                <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-credit-card-2-front"></i> Pembayaran</p>
                                <table class="table table-borderless" style="font-size: small;">
                                    <tbody>
                                        <tr>
                                            <td>Metode</td>
                                            <td>:</td>
                                            <td><?= $payment['payment_type']; ?> (<?= $payment['issuer']; ?>)</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>:</td>
                                            <td> Rp. <?= number_format($payment['gross_amount'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td><?= $payment['transaction_status'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <!-- Button trigger modal -->
                    <?php if ($order['id_status_pesan'] == 3 && $status_transaction == 0) : ?>
                        <div class="fixed-bottom bg-white" style="padding-bottom: 20%; padding-top: 2%;">
                            <div class="row">
                                <div class="col-1 pt-2 pe-5">
                                    <button class="btn border-0" style="display: flex; justify-content: center; align-items:center" type="button" data-bs-toggle="modal" data-bs-target="#updateStatus">
                                        <i class="bi bi-three-dots-vertical fs-1 fw-bold text-secondary"></i>
                                    </button>
                                </div>
                                <div class="col pt-2 d-grid">
                                    <button type="button" class="btn btn-danger fw-bold" style="padding: 3%; margin-right: 35px;" data-bs-toggle="modal" data-bs-target="#liveTarcking">
                                        Live Tracking
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true" style="overflow: hidden;">
                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header border-bottom-0 text-center">
                                    <h1 class="modal-title fs-5 fw-bold">Selesaikan Pesanan</h1>
                                </div>
                                <div class="modal-body py-0">
                                    <p>Pastikan pesanan anda telah diterima.</p>
                                </div>
                                <form action="<?= base_url('status-gosend/update/' . $inv) ?>" method="post">
                                    <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn btn-lg btn-success">Selesai</button>
                                        <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="liveTarcking" tabindex="-1" aria-labelledby="liveTarckingLabel" aria-hidden="true" style="overflow: hidden;">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="liveTarckingLabel">Live Tracking</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?php if ($gosendStatus) : ?>
                                    <iframe src="<?= $gosendStatus['liveTrackingUrl']; ?>" loading="lazy" frameborder="0" style="width: 100%; height: 100%; overflow: hidden;"></iframe>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- samsung galaxy fold -->
    <style>
        .card-body p,
        .card-body span {
            font-size: 12px;

        }

        .track .step span.text {
            font-size: 10px;

        }

        .track .step span.icon {
            width: 40px;
            height: 40px;
            line-height: 40px;

        }
    </style>

    <style>
        .card {
            border-radius: 20px;
            /* Sudut bulat pada seluruh kartu */
            overflow: hidden;
        }

        .card img {
            width: 100%;
            /* Agar gambar mengisi seluruh lebar kartu */
            height: auto;
            /* Mengatur ketinggian gambar sesuai aspek ratio */
        }

        .border-darker {
            border-color: red;
            /* Ubah warna garis menjadi merah */
            border-width: 2px;
            /* Sesuaikan ketebalan garis sesuai kebutuhan Anda */
            font-weight: bold;
            /* Tambahkan ketebalan teks sesuai kebutuhan Anda */
        }

        /* Style Tracking  */
        .track {
            position: relative;
            background-color: #ddd;
            height: 5px;
            /* Mengurangi tinggi tracking */
            display: flex;
            margin-bottom: 40px;
            /* Mengurangi margin bottom */
            margin-top: 30px;
            /* Mengurangi margin top */
        }

        .track .step {
            flex-grow: 1;
            width: 20%;
            /* Mengurangi lebar setiap langkah */
            margin-top: -14px;
            /* Mengurangi margin top */
            text-align: center;
            position: relative;
        }

        .track .step.active:before {
            background: #cf240a;
        }

        .track .step::before {
            height: 5px;
            /* Mengurangi tinggi garis tracking */
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 14px;
            /* Mengurangi top position */
        }

        .track .step.active .icon {
            background: #cf240a;
            color: #fff;
        }

        .track .icon {
            display: inline-block;
            width: 30px;
            /* Mengurangi lebar ikon */
            height: 30px;
            /* Mengurangi tinggi ikon */
            line-height: 30px;
            /* Mengurangi line-height ikon */
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
            margin-top: 5px;
            /* Mengurangi margin top */
            font-size: smaller;
            /* Mengubah ukuran font ke smaller */
        }
    </style>

<?php else : ?>
    <!-- Desktop View -->
    <div id="desktopContent" style="margin-top:100px;">
        <section>
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <h2>Status Pengiriman</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="track">
                            <div class="step active"> <span class="icon"> <i class="bi bi-check2-circle"></i> </span> <span class="text">Order confirmed</span> </div>
                            <?php if ($gosendStatus) : ?>
                                <?php foreach ($status as $s) :  ?>
                                    <div class="step active"> <span class="icon"> <i class="bi <?= ($s == 'Completed') ? 'bi-check2-circle' : 'bi-truck'; ?>"></i> </span> <span class="text" style="font-size: smaller;"> <?= $s; ?> </span> </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="mb-4"><span class="text-dark font-italic me-1">Data Status Pesanan</h3>
                                <hr class="border-darker mt-0 mb-3">
                                <?php if ($gosendStatus) : ?>
                                    <p class="mt-4 mb-1" style="font-size: 16px;">Nama Driver</p>
                                    <span class="fw-bold"><?= $gosendStatus['driverName']; ?></span>
                                    <hr>
                                    <div class="row">
                                        <div class="col-8">
                                            <p class="driver-phone" style="font-size: 16px;">Driver Phone</p>
                                            <span class="fw-bold mt-3"><?= $gosendStatus['driverPhone']; ?></span>
                                        </div>
                                        <div class="col-4 text-end">
                                            <button type="button" class="ms-auto mt-3 mt-md-0 btn-sm btn btn-success"><i class="bi bi-whatsapp"></i></button>
                                        </div>
                                    </div>

                                    <hr>
                                    <p class="mt-4 mb-1" style="font-size: 16px;">Booking ID</p>
                                    <span class="fw-bold"><?= $gosendStatus['orderNo']; ?></span>
                                    <hr>
                                    <p class="mt-4 mb-1" style="font-size: 16px;">status</p>
                                    <span class="fw-bold"><?= $gosendStatus['status']; ?></span>
                                    <hr>
                                    <?php if ($gosendStatus['cancelDescription']) : ?>
                                        <p class="mt-4 mb-1" style="font-size: 16px;">cancelDescription</p>
                                        <span class="fw-bold"><?= $gosendStatus['cancelDescription']; ?></span>
                                        <hr>
                                    <?php endif; ?>
                                    <p class="mt-4 mb-1" style="font-size: 16px;">Nama Penerima</p>
                                    <span class="fw-bold"><?= $gosendStatus['receiverName']; ?></span>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php if ($order['id_status_pesan'] == 3 && $status_transaction == 0) : ?>
                            <div class="card mb-4 mb-md-0 border-0 shadow-sm mt-3">
                                <div class="card-body">
                                    <h3 class="mb-4"><span class="text-dark font-italic me-1">Tracking Order</h3>
                                    <hr class="border-darker mt-0 mb-3">
                                    <?php if ($gosendStatus) : ?>
                                        <div class="row">
                                            <div class="col-2 d-grid">
                                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updateStatus"><i class="bi bi-three-dots-vertical fs-1 fw-bold text-white"></i></button>
                                            </div>
                                            <div class="col d-grid">
                                                <button class="btn btn-danger fw-bold fs-4" data-bs-toggle="modal" data-bs-target="#liveTarcking">Live Tracking</button>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="liveTarcking" tabindex="-1" aria-labelledby="liveTarckingLabel" aria-hidden="true" style="overflow: hidden;">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="liveTarckingLabel">Live Tracking</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <iframe src="<?= $gosendStatus['liveTrackingUrl']; ?>" loading="lazy" frameborder="0" style="width: 100%; height: 100%; overflow: hidden;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true" style="overflow: hidden;">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content rounded-4 shadow">
                                                <div class="modal-header border-bottom-0 text-center">
                                                    <h1 class="modal-title fs-5 fw-bold">Selesaikan Pesanan</h1>
                                                </div>
                                                <div class="modal-body py-0">
                                                    <p>Pastikan pesanan anda telah diterima.</p>
                                                </div>
                                                <form action="<?= base_url('status-gosend/update/' . $inv) ?>" method="post">
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
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0 border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="mb-4"><span class="text-dark font-italic me-1">Rincian</h3>
                                <hr class="border-darker mt-0 mb-3">
                                <div class="col">
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
                                                                    <h5 class="card-title fs-6"><?= substr($p->nama, 0, 10); ?></h5>
                                                                    <p class="card-text text-secondary fs-6"><?= $p->qty; ?> <?= $p->value_item; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-5 position-absolute top-50 end-0 mt-2 translate-middle-y ps-4">
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
                                    <hr>
                                </div>
                                <?php if ($gosendStatus) : ?>
                                    <div class="col">
                                        <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-send fw-bold"></i> Pengirim</p>
                                        <span class="fw-bold ms-4"><?= $gosendStatus['sellerAddressName']; ?></span>
                                        <p class="ms-4 text-secondary"><?= $gosendStatus['sellerAddressDetail']; ?></p>
                                        <hr>
                                    </div>
                                    <div class="col">
                                        <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-house"></i> Penerima</p>
                                        <span class="fw-bold ms-4"><?= $gosendStatus['buyerAddressName']; ?></span>
                                        <p class="ms-4 text-secondary"><?= $gosendStatus['buyerAddressDetail']; ?></p>
                                        <hr>
                                    </div>
                                <?php endif ?>
                                <div class="col">
                                    <p class="mt-4 mb-2 fw-bold" style="font-size: 16px;"><i class="bi bi-credit-card-2-front"></i> Pembayaran</p>
                                    <table class="table table-borderless" style="font-size: small;">
                                        <tbody>
                                            <tr>
                                                <td>Metode</td>
                                                <td>:</td>
                                                <td><?= $payment['payment_type']; ?> (<?= $payment['issuer']; ?>)</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>:</td>
                                                <td> Rp. <?= number_format($payment['gross_amount'], 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>:</td>
                                                <td><?= $payment['transaction_status'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* Style Tracking  */
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
            background: #cf240a;
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
            background: #cf240a;
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

        .border-darker {
            border-color: red;
            /* Ubah warna garis menjadi merah */
            border-width: 2px;
            /* Sesuaikan ketebalan garis sesuai kebutuhan Anda */
            font-weight: bold;
            /* Tambahkan ketebalan teks sesuai kebutuhan Anda */
        }
    </style>
<?php endif; ?>
<!-- End Desktop View -->
<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>

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