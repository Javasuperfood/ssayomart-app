<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<script>
    $(document).ready(function() {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Sorry, we're under maintenance.",
            showConfirmButton: true
        });
    });
</script>
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
            <form action="<?= base_url('checkout-cart/bayar'); ?>" method="post">
                <?= csrf_field(); ?>
                <?php foreach ($cart_id as $c) : ?>
                    <input type="hidden" value="<?= $c; ?>" name="produkCart[]">
                <?php endforeach; ?>
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
                                        <input type="text" class="form-control masukan-kata" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                    <?php elseif (!$marketSelected) : ?>
                                        <?php if ($key == 0) : ?>
                                            <input type="text" class="form-control masukan-kata" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <label for="mpOrigin">Market</label>
                            </div>
                            <button class="btn input-group-text masukan-tim btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-origin">Pilih</button>
                        </div>
                        <div class="modal fade" id="modal-pilih-origin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-originLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content pilih-cara">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6 pemilihan" id="modal-pilih-originLabel">Pilih Market Terdekat</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="row row-cols-1">
                                                    <?php foreach ($market_list as $key => $m) : ?>
                                                        <div class="col py-2" onclick="selectMarket(<?= $m['id_toko']; ?>, '<?= $m['lable']; ?>', '<?= $m['id_city']; ?>','<?= $m['latitude']; ?>,<?= $m['longitude']; ?>')">
                                                            <div class="card border-0 shadow-sm">
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

                    <div class="container">
                        <div class="alert alert-danger d-flex align-items-center border-0" role="alert">
                            <i class="bi bi-exclamation-octagon-fill mr-2" style="font-size: 20px; color:#a6251c;"></i>
                            <div style="margin-left: 18px;">
                                <h6 class="alert-heading fw-bold" style="font-size: 10px;">Pada Alamat Pengiriman</h6>
                                <p class="mb-0 fw-bold" style="font-size: 10px;">Mohon lebih teliti dalam pengisian alamat, agar tidak terjadi hal yang tidak diinginkan</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-house fw-bold"></i>
                            </span>
                            <div class="form-floating">
                                <?php foreach ($alamat_list as $key => $al) : ?>
                                    <?php if ($al['id_alamat_users'] == $addressSelected) : ?>
                                        <input type="text" class="form-control masukan-kata" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                    <?php elseif (!$addressSelected) : ?>
                                        <?php if ($key == 0) : ?>
                                            <input type="text" class="form-control masukan-kata" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <label for="mpDestination">Alamat</label>
                            </div>
                            <button class="btn input-group-text masukan-tim btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-destination">Pilih</button>
                        </div>
                        <div class="modal fade" id="modal-pilih-destination" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-destinationLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content pilih-cara">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6 pemilihan" id="modal-pilih-destinationLabel">Pilih Alamat</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="row row-cols-1">
                                                    <?php foreach ($alamat_list as $key => $a) : ?>
                                                        <div class="col py-2" onclick="selectAlamat(<?= $a['id_alamat_users']; ?>, '<?= $a['label']; ?> - <?= $a['alamat_1']; ?>', <?= $a['id_city']; ?>, '<?= $a['latitude']; ?>,<?= $a['longitude']; ?>')">
                                                            <div class="card border-0 shadow-sm">
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
                                <i class="bi bi-truck fw-bold"></i>
                            </span>
                            <div class="form-floating">
                                <input type="text" class="form-control masukan-kata fs-6 pemilihan" id="mpkirim" name="kurir" placeholder="Metode Pengiriman" readonly>
                                <label for="mpkirim" style="font-size: 16px">Metode Pengiriman</label>
                            </div>
                            <button class="btn input-group-text masukan-tim btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-kurir">Pilih</button>
                        </div>
                        <div class="modal fade" id="modal-pilih-kurir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-kurirLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content pilih-cara">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-6 pemilihan" id="modal-pilih-kurirLabel">Pilih Metode Pengiriman</h1>
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
                            <select class="form-control masukan-kata border-0 shadow-sm" id="service" name="service">
                                <option value="" class="card-text text-secondary"></option>
                            </select>
                            <label for="service" id="serviceLabel">Pilih Layanan</label>
                            <span class="badge rounded-pill text-bg-danger"><strong class="time">Estimasi : <span id="estimasi"></span></strong></span>
                        </div>
                    </div>
                    <input type="hidden" name="serviceText" id="serviceText">
                    <?php if ($kupon) : ?>
                        <div class="col">
                            <div class="form-floating mb-2">
                                <select class="form-control masukan-kata border-0 shadow-sm" id="kupon" name="kupon">
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
                    <?php foreach ($produk as $p) : ?>
                        <div class="col pt-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p['img']; ?>" alt="" class="card-img" style="object-fit: contain; object-position: 20% 10%;">
                                        </div>
                                        <div class="col-4 keterangan position-absolute top-50 start-50 translate-middle">
                                            <p class="card-title pemilihan" style="font-size: 12px;"><?= substr($p['nama'], 0, 15); ?></p>
                                            <p class="card-text text-secondary fs-6 pemilihan"><?= $p['qty']; ?> pcs
                                            </p>
                                        </div>
                                        <div class="col-4 keterangan position-absolute top-50 end-0 translate-middle-y mt-2 ps-4">
                                            <p class="text-secondary pemilihan" style="font-size: 12px;">Total</p>
                                            <?php if (isset(($p['promo']['total']))) : ?>
                                                <p class="fw-bold text-decoration-line-through">Rp. <?= number_format(($p['harga_item'] * $p['qty']), 0, ',', '.'); ?></p>
                                            <?php else : ?>
                                                <p class="fw-bold">Rp. <?= number_format(($p['harga_item'] * $p['qty']), 0, ',', '.'); ?></p>
                                            <?php endif; ?>
                                            <?php if (isset($p['promo']['total'])) : ?>
                                                <?php
                                                $discountedTotal = ($p['harga_item'] * $p['qty']) - ($p['promo']['total']);
                                                ?>
                                                <p>Rp. <?= number_format($discountedTotal, 0, ',', '.'); ?></p>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="col py-3 px-3">
                        <table class="table fs-6 pemilihan lh-1">
                            <thead>
                                <tr>
                                    <th scope="col">Ringkasan Belanja</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Diskon (Promo)</td>
                                    <td><span id="diskonTotal"><?= (isset($totalDiscount) ? '-Rp. ' . number_format($totalDiscount, 0, ',', '.') : '') ?></span></td>
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
                                    <td class="fw-bold">Grand Total</td>
                                    <td class="fw-bold"><span id="totalText"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="background-color:#fff" class="fixed-bottom mb-5 col p-3 px-4">
                        <button type="submit" class="btn btn-lg fw-bold rounded btn-bayar" onclick="clickSubmitEvent(this)" style="background-color: #ec2614; color: #fff; width: 100%; font-size: 14px">Bayar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="pb-5">
    </div>
<?php else : ?>
    <!-- end mobile -->

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:150px;">
        <div class="container">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h2 class="fw-bold text-center mb-0"><i class="text-danger bi bi-credit-card"></i> <?= $title; ?></h2>
                            <hr class="mb-3 border-danger" style="border-width: 3px;">
                        </li>
                    </ol>
                </nav>
            </div>
            <form action="<?= base_url('checkout-cart/bayar'); ?>" method="post">
                <?php foreach ($cart_id as $c) : ?>
                    <input type="hidden" value="<?= $c; ?>" name="produkCart[]">
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Right Panel -->
                            <span class="badge badge-secondary badge-pill">3</span>
                        </h4>
                        <table class="table fs-6 pemilihan lh-1 shadow-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Ringkasan Belanja</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <td>Diskon (Promo)</td>
                                    <td><span id="diskonTotal"><?= (isset($totalDiscount) ? '-Rp. ' . number_format($totalDiscount, 0, ',', '.') : '') ?></span></td>
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
                                    <td>Grand Total</td>
                                    <td class="fw-bold"><span id="totalText"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <strong>Estimasi : <span id="estimasi"></span></strong>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg fw-bold rounded mt-3 btn-bayar" style="background-color: #ec2614; color: #fff; width: 100%;">Bayar</button>
                        </div>
                    </div>
                    <!-- Left Panel -->
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Pemesanan</h4>

                        <?= csrf_field(); ?>

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
                                                    <input type="text" class="form-control masukan-kata" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                                <?php elseif (!$marketSelected) : ?>
                                                    <?php if ($key == 0) : ?>
                                                        <input type="text" class="form-control masukan-kata" id="mpOrigin" placeholder="Market" value="<?= $m['lable']; ?>" origin="<?= $m['id_city']; ?>" originLatLong="<?= $m['latitude']; ?>,<?= $m['longitude']; ?>" readonly>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <label for="mpOrigin">Market</label>
                                        </div>
                                        <button class="btn input-group-text masukan-tim btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-origin">Pilih</button>
                                    </div>
                                    <div class="modal fade" id="modal-pilih-origin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-originLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content pilih-cara">
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
                                                                        <div class="card border-0 shadow-sm">
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
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="bi bi-house"></i>
                                        </span>
                                        <div class="form-floating">
                                            <?php foreach ($alamat_list as $key => $al) : ?>
                                                <?php if ($al['id_alamat_users'] == $addressSelected) : ?>
                                                    <input type="text" class="form-control masukan-kata" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                                <?php elseif (!$addressSelected) : ?>
                                                    <?php if ($key == 0) : ?>
                                                        <input type="text" class="form-control masukan-kata" id="mpDestination" placeholder="Market" value="<?= $al['label'] . ' - ' . $al['alamat_1']; ?>" destination="<?= $al['id_city']; ?>" destinationLatLong="<?= $al['latitude']; ?>,<?= $al['longitude']; ?>" readonly>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            <label for="mpDestination">Alamat</label>
                                        </div>
                                        <button class="btn btn input-group-text masukan-tim btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-destination">Pilih</button>
                                    </div>
                                    <div style="color:#ec2614;">
                                        <h6 class="alert-heading fw-bold" style="font-size: 10px;">Pada Alamat Pengiriman *</h6>
                                        <h6 class="fw-bold" style="font-size: 10px;">Mohon lebih teliti dalam pengisian alamat, agar tidak terjadi hal yang tidak diinginkan</h6>
                                    </div>
                                    <div class="modal fade" id="modal-pilih-destination" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-destinationLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content pilih-cara">
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
                                                                        <div class="card border-0 shadow-sm">
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
                                            <input type="text" class="form-control masukan-kata" id="mpkirim" name="kurir" placeholder="Metode Pengiriman" readonly>
                                            <label for="mpkirim">Metode Pengiriman</label>
                                        </div>
                                        <button class="btn input-group-text masukan-tim btn-danger text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal-pilih-kurir">Pilih</button>
                                    </div>
                                    <div class="modal fade" id="modal-pilih-kurir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pilih-kurirLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content pilih-cara">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modal-pilih-kurirLabel">Pilih Metode Pengiriman</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body gambar-pengiriman">
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

                            <?php foreach ($produk as $p) : ?>
                                <div class="col-md-12 mt-3">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="<?= base_url(); ?>assets/img/produk/main/<?= $p['img']; ?>" alt="" class="card-img">
                                                </div>
                                                <div class="col-5 keterangan position-absolute top-50 start-50 translate-middle">
                                                    <h5><?= substr($p['nama'], 0, 10); ?>...</h5>
                                                    <p class="card-text text-secondary"><?= $p['qty']; ?> pcs</p>
                                                </div>
                                                <div class="col-4 position-absolute top-50 end-0 translate-middle-y">
                                                    <h5>Total Harga</h5>
                                                    <?php if (isset(($p['promo']['total']))) : ?>
                                                        <p class="fw-bold text-decoration-line-through">Rp. <?= number_format(($p['harga_item'] * $p['qty']), 0, ',', '.'); ?></p>
                                                    <?php else : ?>
                                                        <p class="fw-bold">Rp. <?= number_format(($p['harga_item'] * $p['qty']), 0, ',', '.'); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (isset($p['promo']['total'])) : ?>
                                                        <?php
                                                        $discountedTotal = ($p['harga_item'] * $p['qty']) - ($p['promo']['total']);
                                                        ?>
                                                        <p>Rp. <?= number_format($discountedTotal, 0, ',', '.'); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<style>
    .form-control[readonly] {
        border: 1px solid #DEE2E6;
    }
</style>


<!-- end desktop -->

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