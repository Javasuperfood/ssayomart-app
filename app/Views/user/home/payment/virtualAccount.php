<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<style>
    .text-muted {
        margin: 0;
        /* Menghilangkan margin atas dan bawah */
    }

    @media only screen and (min-width: 768px) {
        .custom-margin {
            margin-left: 20%;
            margin-right: 20%;
        }
    }
</style>
<div class="custom-margin">
    <div class="container pt-5 mb-4">
        <?php
        //  Q : Kenapa comment pake php ?
        //  A : Biar gak keliatan userside
        // 'elemet di bawah untuk bank BCA, BRI, BNI';
        ?>
        <?php if ($bank_transfer['company_code'] == null) : ?>
            <div class="row">
                <div class="col-12 text-center">
                    <img src="<?= base_url('assets/img/checkout/bank/' . $bank_transfer['bank'] . '.png'); ?>" width="170px" alt="" srcset="">
                </div>
                <div class="col-12 text-center fs-4"><span class="badge bg-danger" id="expire_time"></span></div>
                <div class="col-12 text-center fw-bold fs-4">Pembayaran Virtual Account</div>
                <div class="col-12 text-end d-flex justify-content-center align-items-center">
                    <input id="va_number" type="text" class="form-control form-control-lg text-center fw-bold border-0" value="<?= $pay['response']['va_numbers'][0]['va_number']; ?>" readonly>
                    <button class="btn btn-danger" id="copyButton" onclick="copyButton()">Copy</button>
                </div>
            </div>
        <?php endif; ?>
        <?php
        // 'elemet di bawah untuk bank MANDIRI';
        ?>
        <?php if ($bank_transfer['company_code'] != null && $bank_transfer['bank'] == 'Mandiri') : ?>
            <div class="row">
                <div class="col-12 text-center">
                    <img src="<?= base_url('assets/img/checkout/bank/' . $bank_transfer['bank'] . '.png'); ?>" width="170px" alt="" srcset="">
                </div>
                <div class="col-12 text-center fs-4"><span class="badge bg-danger" id="expire_time"></span></div>
                <div class="col-12 text-center fw-bold fs-4">Pembayaran Virtual Account</div>
                <div class="col-12">
                    <table class="table text-center">
                        <tbody>
                            <tr>
                                <td>Company Code</td>
                                <td><input id="company_code" type="text" class="form-control form-control-lg text-center fw-bold border-0" value="<?= $bank_transfer['company_code']; ?>" readonly id="company_code"></td>
                                <td><button class="btn btn-danger" id="copyButton" onclick="copyButton2()">Copy</button></td>
                            </tr>
                            <tr>
                                <td>Virtual Number</td>
                                <td><input id="va_number" type="text" class="form-control form-control-lg text-center fw-bold border-0" value="<?= $bank_transfer['account_number']; ?>" readonly></td>
                                <td>
                                    <button class="btn btn-danger" id="copyButton" onclick="copyButton()">Copy</button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>
    </div>
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted fw-bold h8"><?= $pay['response']['order_id']; ?></p>
                <p class="text-muted h7"><?= $penerima['nama']; ?></p>
                <p class="text-muted h8"><?= $penerima['alamat']; ?></p>
                <p class="text-muted h8"><?= $penerima['telp']; ?></p>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <table class="table border table-responsive">
                    <thead class="text-center">
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
                                <td>1</td>
                                <td><?= $i['name']; ?></td>
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
                <p class="text-muted h7">Refresh untuk melihat pembharuan pembayaran anda.</p>
            </div>
            <div class="col-12 text-center pt-4">
                <button class="btn btn-danger btn-lg" onclick="location.reload()"><i class="bi bi-arrow-clockwise fs-1"></i></button>
            </div>
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