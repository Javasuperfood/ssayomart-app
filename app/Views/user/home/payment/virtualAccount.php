<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<style>
    /* CDN Font Montserrat */
    @import url(https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,400italic,500italic,600italic,700italic,800italic&subset=latin,latin-ext);
    @import url(https://fonts.googleapis.com/css?family=Darker+Grotesque:600,700,800,900&subset=latin,latin-ext);

    .fs-montserrat {
        font-family: 'Montserrat', sans-serif !important;
    }

    .fs-darker {
        font-family: 'Darker Grotesque', sans-serif !important;
    }

    .invoice-content {
        font-family: 'Darker Grotesque', sans-serif !important;
        font-weight: 700;
    }

    .logoleft {
        width: 25%;
    }

    .logoright {
        width: 25%;
    }


    /* @media only screen and (min-width: 768px) {

        .logoleft {
            width: 50%;
        }

        .logoright {
            width: 40%;
        }
    } */
    /* galaxy fold 280px */
    @media (width: 280px) {
        .card {
            margin-top: -5px;
        }

        .font-custom {
            font-size: 12px;

        }

        .no-padding {
            padding: 0px 0px !important;
        }

        .card-title {
            font-size: 14px;
        }

        .button-fold {
            padding: 2px 10px !important;
        }
    }

    /* akhir galaxy fold 280 px */

    @media (min-width: 350px) and (max-width: 575.98px) {

        /* Add your styles for XS here */
        .font-custom {
            font-size: 18px;

        }

        .no-padding {
            padding: 0px 0px !important;
        }
    }

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) and (max-width: 767.98px) {

        /* Add your styles for SM here */
        .font-custom {
            font-size: 18px;

        }

        .no-padding {
            padding: 0px 0px !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {

        /* Add your styles for MD here */
        .no-padding {
            padding: 0px 0px !important;
        }
    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) and (max-width: 1199.98px) {

        /* Add your styles for LG here */
        .no-padding {
            padding: 0px 0px !important;
        }
    }

    @media (min-width: 1400px) {

        /* Add your styles for XXL here */
        .card {
            margin-top: 30px;
        }

        .no-padding {
            padding: 0px 0px !important;
        }
    }
</style>
<div class="container invoice-content">
    <div class="row d-none d-md-block">
        <div class="col-12 py-5"></div>
        <div class="col-12 py-5"></div>
    </div>
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card bg-light border-0 shadow-sm border-dark-subtle rounded-2">
                <div class="d-flex justify-content-between p-2">
                    <img class="logoleft ms-1" src="<?= base_url('assets/img/logopanjang.png'); ?>" alt="" srcset="">
                    <img class="logoright me-1" src="<?= base_url('assets/img/checkout/bank/' . $bank_transfer['bank'] . '.png'); ?>" alt="" srcset="">
                </div>
                <?php if ($bank_transfer['company_code'] == null) : ?>
                    <?php
                    //  Q : Kenapa comment pake php ?
                    //  A : Biar gak keliatan userside
                    // 'elemet di bawah untuk bank BCA, BRI, BNI';
                    ?>
                    <div class="card-body card-content">
                        <h5 class="card-title">Invoice</h5>
                        <p class="fw-bold font-custom fw-bold text-secondary mt-2 w-full">#<?= $pay['response']['order_id']; ?></p>

                        <h5 class="card-title">Code Virtual Account</h5>
                        <div class="d-flex justify-content-evenly align-items-center">
                            <input id="va_number" type="text" class="fs-montserrat form-control no-padding form-control-lg bg-light font-custom fw-bold border-0" value="<?= $pay['response']['va_numbers'][0]['va_number']; ?>" readonly>
                            <button class="btn button-fold " id="copyButton" onclick="copyButton()"><i class="bi bi-copy text-danger fw-bold fs-5"></i></button>
                        </div>
                    </div>

                <?php endif; ?>
                <?php if ($bank_transfer['company_code'] != null && $bank_transfer['bank'] == 'Mandiri') : ?>
                    <?php
                    // 'elemet di bawah untuk bank MANDIRI';
                    ?>
                    <div class="card-body card-content">
                        <h5 class="card-title">Invoice</h5>
                        <p class="fw-bold font-custom fw-bold text-secondary mt-2 w-full">#<?= $pay['response']['order_id']; ?></p>

                        <h5 class="card-title">Company Code</h5>
                        <div class="d-flex justify-content-evenly align-items-center">
                            <input id="company_code" type="text" class="fs-montserrat form-control no-padding form-control-lg bg-light text-secondary font-custom fw-bold border-0" value="<?= $bank_transfer['company_code']; ?>" readonly>
                            <button class="btn button-fold " onclick="copyButton2()"><i class="bi bi-copy text-danger fw-bold fs-5"></i></button>
                        </div>
                        <h5 class="card-title">Code Virtual Account</h5>
                        <div class="d-flex justify-content-evenly align-items-center">
                            <input id="va_number" type="text" class="fs-montserrat form-control no-padding form-control-lg bg-light text-secondary font-custom fw-bold border-0" value="<?= $bank_transfer['account_number']; ?>" readonly>
                            <button class="btn button-fold " onclick="copyButton()"><i class="bi bi-copy text-danger fw-bold fs-5"></i></button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <h4 class="ms-2 mt-2 fs-5 fw-bold text-center mt-3">Waktu Pembayaran: <span class="badge bg-danger" id="expire_time"></span></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-2 mt-5">
                <p class=" text-muted fw-bold h8">Invoice To</p>
                <p class="text-muted h7"><?= $penerima['nama']; ?></p>
                <p class="text-muted h8"><?= $penerima['alamat']; ?></p>
                <p class="text-muted h8"><?= $penerima['telp']; ?></p>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card border-0 shadow-sm p-2 mt-5">
                <p class="text-muted fw-bold h8">Pay To</p>
                <p class="text-muted h7"><?= $origin['lable']; ?></p>
                <p class="text-muted h8"><?= $origin['alamat_1']; ?></p>
                <p class="text-muted h8"><?= $origin['telp']; ?></p>
            </div>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-12">
            <table class="table table-borderless" style="font-size: smaller;">
                <thead class="text-center table-danger">
                    <tr>
                        <th>No.</th>
                        <td>Item</td>
                        <td>Qty</td>
                        <td>Harga</td>
                        <td class="text-end">Total</td>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($pay['request']['item_details'] as $key => $i) : ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td class="text-start"><?= $i['name']; ?></td>
                            <td><?= number_format($i['quantity'], 0, ',', '.'); ?></td>
                            <td><?= number_format($i['price'], 0, ',', '.'); ?></td>
                            <td class="text-end"><?= number_format(((int) ($i['price'] * $i['quantity'])), 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td colspan="5"> </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td class="text-end"><?= number_format($pay['response']['gross_amount'], 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 ">
            <i class="bi bi-info-circle"></i> Info
            <p class="text-muted h7">Refresh untuk melihat pembharuan pembayaran anda. <button class="btn btn-danger " onclick="location.reload()"><i class="bi bi-arrow-clockwise "></i></button>
        </div>
        <div class="col-12 text-center pt-4">
            <!-- <button class="btn btn-danger btn-lg" onclick="location.reload()"><i class="bi bi-arrow-clockwise fs-1"></i></button> -->
        </div>
    </div>
</div>
<script>
    var expiryTime = new Date('<?= $pay['response']['expiry_time']; ?>').getTime();

    function countdown() {
        var now = new Date().getTime();
        var distance = expiryTime - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("expire_time").innerHTML = hours + ":" + minutes + ":" + seconds;

        setTimeout(countdown, 1000);
    }

    countdown();
</script>

<script>
    function copyButton() {
        var copyText = document.getElementById("va_number");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);

        swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: `Nomor Virtual Account ${copyText.value} telah disalin!`,
        })
    }
</script>
<script>
    function copyButton2() {
        var copyText = document.getElementById("company_code");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value);

        swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: `Company Code ${copyText.value} telah disalin!`,
        })
    }
</script>
<?= $this->endSection(); ?>