<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-3">
            <form action="<?= base_url('store/' . $produk['slug']); ?>" method="post">
                <?= csrf_field(); ?>
                <?php if (!$alamat_list) : ?>
                    <div class="alert alert-danger">
                        Tidak ada alamat yang tersedia. Silakan tambahkan alamat terlebih dahulu. <a href="<?= base_url('setting/alamat-list'); ?>" class="link-dark fw-bold">Disini</a>
                    </div>
                <?php endif ?>

                <div class="row row-cols-1 <?= (!$alamat_list) ? 'd-none' : ''; ?>">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-shop-window"></i>
                            </span>
                            <div class="form-floating">
                                <?php foreach ($market_list as $key => $m) : ?>
                                    <?php if ($m['id_toko'] == $marketSelected) : ?>
                                        <input type="text" class="form-control" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                    <?php elseif (!$marketSelected) : ?>
                                        <?php if ($key == 0) : ?>
                                            <input type="text" class="form-control" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <label for="mpOrigin">Market</label>
                            </div>
                            <button class="btn input-group-text btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-origin">Pilih</button>
                        </div>
                        <div class="modal fade" id="modal-pilih-origin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-originLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6" id="modal-pilih-originLabel">Pilih Market</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="row row-cols-1">
                                                    <?php foreach ($market_list as $key => $m) : ?>
                                                        <div class="col py-2" onclick="selectMarket(<?= $m['id_toko']; ?>, '<?= $m['lable']; ?>', '<?= $m['id_city']; ?>', '<?= $m['latitude']; ?>,<?= $m['longitude']; ?>')">
                                                            <div class="card shadow-sm border-0">
                                                                <div class="card-body form-check form-switch">
                                                                    <input class="form-check-input d-none" type="radio" role="switch" id="market<?= $m['id_toko']; ?>" name="market" value="<?= $m['id_toko']; ?>" <?= ($marketSelected == $m['id_toko']) ? 'checked' : ''; ?><?= (!$marketSelected && $key == 0) ? 'checked' : ''; ?>>
                                                                    <p class="fw-bold">Ssayomart <?= $m['lable']; ?></p>
                                                                    <p><?= $m['alamat_1']; ?></p>
                                                                    <p><?= $m['telp']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-house"></i>
                            </span>
                            <div class="form-floating">
                                <?php foreach ($alamat_list as $key => $al) : ?>
                                    <?php if ($al['id_alamat_users'] == $addressSelected) : ?>
                                        <input type="text" class="form-control" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                    <?php elseif (!$addressSelected) : ?>
                                        <?php if ($key == 0) : ?>
                                            <input type="text" class="form-control" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <label for="mpDestination">Alamat</label>
                            </div>
                            <button class="btn input-group-text btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-destination">Pilih</button>
                        </div>
                        <div class="modal fade" id="modal-pilih-destination" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-destinationLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6" id="modal-pilih-destinationLabel">Pilih Alamat</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="row row-cols-1">
                                                    <?php foreach ($alamat_list as $key => $a) : ?>
                                                        <div class="col py-2" onclick="selectAlamat(<?= $a['id_alamat_users']; ?>, '<?= $a['label']; ?> - <?= $a['alamat_1']; ?>', <?= $a['id_city']; ?>, '<?= $a['latitude']; ?>,<?= $a['longitude']; ?>')">
                                                            <div class="card shadow-sm border-0">
                                                                <div class="card-body form-check form-switch">
                                                                    <input class="form-check-input d-none" type="radio" role="switch" id="alamatD<?= $a['id_alamat_users']; ?>" name="alamatD" value="<?= $a['id_alamat_users']; ?>" <?= ($addressSelected == $a['id_alamat_users']) ? 'checked' : ''; ?><?= (!$addressSelected && $key == 0) ? 'checked' : ''; ?>>
                                                                    <p class="fw-bold"> <?= $a['label']; ?></p>
                                                                    <p><?= $m['alamat_1']; ?></p>
                                                                    <p><?= $m['telp']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-truck"></i>
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="mpkirim" name="kurir" placeholder="Metode Pengiriman" readonly>
                                <label for="mpkirim">Metode Pengiriman</label>
                            </div>
                            <button class="btn input-group-text btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-kurir">Pilih</button>
                        </div>
                        <div class="modal fade" id="modal-pilih-kurir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-kurirLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6" id="modal-pilih-kurirLabel">Pilih Metode Pengiriman</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <img src="<?= base_url(); ?>assets/img/checkout/gosend.png" alt="GoSend" srcset="" style="width: 100px;">
                                                    </div>
                                                    <div class="col d-flex justify-content-end">
                                                        <input class="fs-3 btn-check" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-bs-dismiss="modal" aria-label="Close" value="gosend" brand="GoSend" onclick="selectCourier(this)">
                                                        <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault1">Pilih</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <img src="<?= base_url(); ?>assets/img/checkout/jne.png" alt="Jne" srcset="" style="width: 100px;">
                                                    </div>
                                                    <div class="col d-flex justify-content-end">
                                                        <input class="btn-check fs-3" type="radio" name="flexRadioDefault" id="flexRadioDefault2" data-bs-dismiss="modal" aria-label="Close" value="jne" brand="JNE" onclick="selectCourier(this)">
                                                        <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault2">Pilih</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <img src="<?= base_url(); ?>assets/img/checkout/tiki.svg" alt="Tiki" srcset="" style="width: 100px;">
                                                    </div>
                                                    <div class="col d-flex justify-content-end">
                                                        <input class="btn-check fs-3" type="radio" name="flexRadioDefault" id="flexRadioDefault3" data-bs-dismiss="modal" aria-label="Close" value="tiki" brand="Tiki" onclick="selectCourier(this)">
                                                        <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault3">Pilih</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <img src="<?= base_url(); ?>assets/img/checkout/pos.png" alt="Pos" srcset="" style="width: 100px;">
                                                    </div>
                                                    <div class="col d-flex justify-content-end align-items-center">
                                                        <input class="btn-check fs-3" type="radio" name="flexRadioDefault" id="flexRadioDefault4" data-bs-dismiss="modal" aria-label="Close" value="pos" brand="POS" onclick="selectCourier(this)">
                                                        <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault4">Pilih</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-2">
                            <select class="form-control border-0 shadow-sm" id="service" name="service">
                                <option value="" class="card-text text-secondary"></option>
                            </select>
                            <label for="service" id="serviceLabel">Pilih Layanan</label>
                            <strong class="ps-2">Estimasi : <span id="estimasi"></span></strong>
                        </div>
                        <input type="hidden" name="serviceText" id="serviceText">
                    </div>
                    <?php if ($kupon) : ?>
                        <div class="col">
                            <div class="form-floating mb-2">
                                <select class="form-control border-0 shadow-sm" id="kupon" name="kupon">
                                    <option selected value="" class="card-text text-secondary">
                                        Pilih Kupon
                                    </option>
                                    <?php foreach ($kupon as $k) : ?>
                                        <?php if ($total >= $k['total_buy']) : ?>
                                            <option value="<?= $k['kode']; ?>">Diskon <?= ($k['discount'] * 100) . '%'; ?> : Minimal Beli Rp. <?= number_format($k['total_buy'], 0, ',', '.'); ?> </option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                                <label for="kupon" id="floatingLabel">Makin Hemat Pakai Kupon</span></label>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="col pt-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= base_url(); ?>assets/img/produk/main/<?= $produk['img']; ?>" alt="" class="card-img">
                                    </div>
                                    <div class="col-5 position-absolute top-50 start-50 translate-middle mt-2">
                                        <h5 class="card-title fs-6"><?= substr($produk['nama'], 0, 10); ?></h5>
                                        <p class="card-text text-secondary fs-6"><?= $qty; ?> pcs
                                        </p>
                                        <input type="hidden" name="qty" value="<?= $qty; ?>">
                                        <input type="hidden" name="varian" value="<?= $varian; ?>">
                                    </div>
                                    <div class="col-5 position-absolute top-50 end-0 translate-middle-y mt-2 ps-4">
                                        <h5 class="text-secondary fs-6">Total</h5>
                                        <p class="fw-bold fs-6">Rp. <?= number_format(($produk['harga_item'] * $qty), 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col py-3 px-3">
                        <table class="table fs-6 lh-1">
                            <thead>
                                <tr>
                                    <th scope="col">Ringkasan Belanja</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Potongan Harga (Kupon)</td>
                                    <td><span id="diskon"></span></td>
                                </tr>
                                <tr>
                                    <td>Total Ongkos Kirim</td>
                                    <td><span id="ongkirText"></span></td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="fw-bold"><span id="totalText"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col p-3 px-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded btn-bayar" style="background-color: #ec2614; color: #fff; width: 100%;">Bayar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="pb-5"></div>

    <!-- <style>
        @media (max-width: 280px) {
            .col-5.position-absolute.top-50.start-50.translate-middle-y {
                font-size: 12px !important;
            }

            .table.fs-6 {
                font-size: 12px !important;
                /* Atur ukuran font sesuai kebutuhan */
            }

            .tbody.td {
                font-size: 12px !important;
            }

            h5.card-title.fs-6.p.card-text.text-secondary {
                font-size: 12px;
            }

            .form-control {
                font-size: 12px;
                /* Ukuran font input sesuai kebutuhan */
            }

            .card-title {
                font-size: 12px;
                /* Ukuran font judul kartu sesuai kebutuhan */
            }

            .card-text {
                font-size: 12px;
                /* Ukuran font teks kartu sesuai kebutuhan */
            }

            .ps-2 {
                font-size: 12px;
                padding-left: 0.5rem !important;
            }

            .btn-bayar {
                font-size: 12px;
                padding: 0.5rem !important;
            }

            .col-5 h5 {
                font-size: 14px !important
            }

            .col-5 p {
                font-size: 12px !important;
            }

        }
    </style> -->

    <style>
        /* Media query for screens with a maximum width of 280px (Samsung Galaxy Fold) */
        @media screen and (max-width: 280px) {

            .modal-body img {
                width: 80px !important;
            }

            .modal-body button {
                font-size: 10px !important;
            }

            .modal-content {
                font-size: 13px;
            }

            .input-group .btn {
                font-size: 9px;
            }

            .form-control {
                font-size: 12px;
                /* Ukuran font input sesuai kebutuhan */
            }

            .ps-2 {
                font-size: 12px;
                padding-left: 0.5rem !important;
            }

            .col-5 h5 {
                font-size: 14px !important
            }

            .col-5 p {
                font-size: 12px !important;
            }

            .btn-bayar {
                font-size: 12px !important;
            }

            tr {
                font-size: 12px;
            }

            .fs-6 {
                font-size: 0.7rem !important;
            }

        }
    </style>
    <!-- end mobile -->
<?php else : ?>

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container">
            <div class="text-center">
                <h2>Checkout</h2>
            </div>
            <hr>
            <form action="<?= base_url('store/' . $produk['slug']); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <table class="table fs-6 lh-1 shadow-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Ringkasan Belanja</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Potongan Harga (Kupon)</td>
                                    <td><span id="diskon"></span></td>
                                </tr>
                                <tr>
                                    <td>Total Ongkos Kirim</td>
                                    <td><span id="ongkirText"></span></td>
                                </tr>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="fw-bold"><span id="totalText"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <strong>Estimasi : <span id="estimasi"></span></strong>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg fw-bold rounded btn-bayar mt-3" style="background-color: #ec2614; color: #fff; width: 100%;">Bayar</button>
                        </div>
                    </div>
                    <!-- Left Panel -->
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Pemesanan</h4>
                        <?php if (!$alamat_list) : ?>
                            <div class="alert alert-danger">
                                Tidak ada alamat yang tersedia. Silakan tambahkan alamat terlebih dahulu. <a href="<?= base_url('setting/create-alamat'); ?>" class="link-dark fw-bold">Disini</a>
                            </div>
                        <?php endif ?>

                        <div class="row <?= (!$alamat_list) ? 'd-none' : ''; ?>">
                            <div class="col-md-6 mb-3">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-shop-window"></i>
                                        </span>
                                        <div class="form-floating">
                                            <?php foreach ($market_list as $key => $m) : ?>
                                                <?php if ($m['id_toko'] == $marketSelected) : ?>
                                                    <input type="text" class="form-control" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                                <?php elseif (!$marketSelected) : ?>
                                                    <?php if ($key == 0) : ?>
                                                        <input type="text" class="form-control" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <label for="mpOrigin">Market</label>
                                        </div>
                                        <button class="btn input-group-text btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-origin">Pilih</button>
                                    </div>
                                    <div class="modal fade" id="modal-pilih-origin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-originLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-pilih-originLabel">Pilih Market</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row row-cols-1">
                                                        <div class="col">
                                                            <div class="row row-cols-1">
                                                                <?php foreach ($market_list as $key => $m) : ?>
                                                                    <div class="col py-2" onclick="selectMarket(<?= $m['id_toko']; ?>, '<?= $m['lable']; ?>', '<?= $m['id_city']; ?>','<?= $m['latitude']; ?>,<?= $m['longitude']; ?>')">
                                                                        <div class="card shadow-sm border-0">
                                                                            <div class="card-body form-check form-switch">
                                                                                <input class="form-check-input d-none" type="radio" role="switch" id="market<?= $m['id_toko']; ?>" name="market" value="<?= $m['id_toko']; ?>" <?= ($marketSelected == $m['id_toko']) ? 'checked' : ''; ?><?= (!$marketSelected && $key == 0) ? 'checked' : ''; ?>>
                                                                                <p class="fw-bold">Ssayomart <?= $m['lable']; ?></p>
                                                                                <p><?= $m['alamat_1']; ?></p>
                                                                                <p><?= $m['telp']; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-house"></i>
                                        </span>
                                        <div class="form-floating">
                                            <?php foreach ($alamat_list as $key => $al) : ?>
                                                <?php if ($al['id_alamat_users'] == $addressSelected) : ?>
                                                    <input type="text" class="form-control" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                                <?php elseif (!$addressSelected) : ?>
                                                    <?php if ($key == 0) : ?>
                                                        <input type="text" class="form-control" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <label for="mpDestination">Alamat</label>
                                        </div>
                                        <button class="btn input-group-text btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-destination">Pilih</button>
                                    </div>
                                    <div class="modal fade" id="modal-pilih-destination" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-destinationLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-pilih-destinationLabel">Pilih Alamat</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row row-cols-1">
                                                        <div class="col">
                                                            <div class="row row-cols-1">
                                                                <?php foreach ($alamat_list as $key => $a) : ?>
                                                                    <div class="col py-2" onclick="selectAlamat(<?= $a['id_alamat_users']; ?>, '<?= $a['label']; ?> - <?= $a['alamat_1']; ?>', <?= $a['id_city']; ?>, '<?= $a['latitude']; ?>,<?= $a['longitude']; ?>')">
                                                                        <div class="card shadow-sm border-0">
                                                                            <div class="card-body form-check form-switch">
                                                                                <input class="form-check-input d-none" type="radio" role="switch" id="alamatD<?= $a['id_alamat_users']; ?>" name="alamatD" value="<?= $a['id_alamat_users']; ?>" <?= ($addressSelected == $a['id_alamat_users']) ? 'checked' : ''; ?><?= (!$addressSelected && $key == 0) ? 'checked' : ''; ?>>
                                                                                <p class="fw-bold"> <?= $a['label']; ?></p>
                                                                                <p><?= $m['alamat_1']; ?></p>
                                                                                <p><?= $m['telp']; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="bi bi-truck"></i>
                                        </span>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="mpkirim" name="kurir" placeholder="Metode Pengiriman" readonly>
                                            <label for="mpkirim">Metode Pengiriman</label>
                                        </div>
                                        <button class="btn input-group-text btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-kurir">Pilih</button>
                                    </div>
                                    <div class="modal fade" id="modal-pilih-kurir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-kurirLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-pilih-kurirLabel">Pilih Metode Pengiriman</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row row-cols-1">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col d-flex align-items-center">
                                                                    <img src="<?= base_url(); ?>assets/img/checkout/gosend.png" alt="GoSend" srcset="" style="width: 100px;">
                                                                </div>
                                                                <div class="col d-flex justify-content-end">
                                                                    <input class="fs-3 btn-check" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-bs-dismiss="modal" aria-label="Close" value="gosend" brand="GoSend" onclick="selectCourier(this)">
                                                                    <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault1">Pilih</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col d-flex align-items-center">
                                                                    <img src="<?= base_url(); ?>assets/img/checkout/jne.png" alt="Jne" srcset="" style="width: 100px;">
                                                                </div>
                                                                <div class="col d-flex justify-content-end">
                                                                    <input class="btn-check fs-3" type="radio" name="flexRadioDefault" id="flexRadioDefault2" data-bs-dismiss="modal" aria-label="Close" value="jne" brand="JNE" onclick="selectCourier(this)">
                                                                    <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault2">Pilih</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col d-flex align-items-center">
                                                                    <img src="<?= base_url(); ?>assets/img/checkout/tiki.svg" alt="Tiki" srcset="" style="width: 100px;">
                                                                </div>
                                                                <div class="col d-flex justify-content-end">
                                                                    <input class="btn-check fs-3" type="radio" name="flexRadioDefault" id="flexRadioDefault3" data-bs-dismiss="modal" aria-label="Close" value="tiki" brand="Tiki" onclick="selectCourier(this)">
                                                                    <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault3">Pilih</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col d-flex align-items-center">
                                                                    <img src="<?= base_url(); ?>assets/img/checkout/pos.png" alt="Pos" srcset="" style="width: 100px;">
                                                                </div>
                                                                <div class="col d-flex justify-content-end align-items-center">
                                                                    <input class="btn-check fs-3" type="radio" name="flexRadioDefault" id="flexRadioDefault4" data-bs-dismiss="modal" aria-label="Close" value="pos" brand="POS" onclick="selectCourier(this)">
                                                                    <label class="btn btn-outline-danger btn-lg" for="flexRadioDefault4">Pilih</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="service" class="form-label">Pilih Layanan</label>
                                <select class="form-select border-0 shadow-sm" id="service" name="service">
                                    <option value="" class="card-text text-secondary"></option>
                                </select>
                                <input type="hidden" name="serviceText" id="serviceText">
                            </div>

                            <?php if ($kupon) : ?>
                                <div class="col-md-12 mb-3">
                                    <label for="kupon" class="form-label">Pilih Kupon</label>
                                    <select class="form-select border-0 shadow-sm" id="kupon" name="kupon">
                                        <option selected value="" class="card-text text-secondary">Pilih Kupon</option>
                                        <?php foreach ($kupon as $k) : ?>
                                            <?php if ($total >= $k['total_buy']) : ?>
                                                <option value="<?= $k['kode']; ?>">Diskon <?= ($k['discount'] * 100) . '%'; ?> : Minimal Beli Rp. <?= number_format($k['total_buy'], 0, ',', '.'); ?> </option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            <?php endif ?>

                            <div class="col-md-12 mt-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="<?= base_url(); ?>assets/img/produk/main/<?= $produk['img']; ?>" alt="Foto Produk" class="card-img">
                                            </div>
                                            <div class="col-5 position-absolute top-50 start-50 translate-middle">
                                                <h5 class="card-title fs-6"><?= substr($produk['nama'], 0, 10); ?>...</h5>
                                                <p class="card-text text-secondary fs-6"><?= $qty; ?> pcs
                                                </p>
                                                <input type="hidden" name="qty" value="<?= $qty; ?>">
                                                <input type="hidden" name="varian" value="<?= $varian; ?>">
                                            </div>
                                            <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                <h5 class="text-secondary fs-6">Total</h5>
                                                <p class="fw-bold fs-6">Rp. <?= number_format(($produk['harga_item'] * $qty), 0, ',', '.'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<!-- end desktop -->

<style>
    .form-control[readonly] {
        border: 1px solid #DEE2E6;
    }
</style>

<script>
    $('document').ready(function() {
        var selectedOption = $(this).find("option:selected");
        var label = selectedOption.attr('penerima');
        $('#perubahan').text(label);
        $("#alamat_list").on('change', function() {
            selectedOption = $(this).find("option:selected");
            label = selectedOption.attr('penerima');
            $('#perubahan').text(label);
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Cek jika alamat kosong
        <?php if (isset($error) && !empty($error)) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Alamat Kosong',
                text: 'Anda harus mengisi alamat terlebih dahulu.',
                showConfirmButton: true
            });
        <?php endif; ?>
    });
</script>
<?= $this->include('user/home/component/rajaOngkir/checkout2'); ?>
<?= $this->endSection(); ?>