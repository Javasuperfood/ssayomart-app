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
        <div class="row">
            <div class="col-12 text-center fs-4"><span class="badge bg-danger" id="expire_time"></span></div>
            <div class="col-12 text-center fw-bold fs-4">Pembayaran Virtual Account</div>
            <div class="col-12 text-center fw-bold fs-4"><?= $pay['response']['va_numbers'][0]['bank']; ?></div>
            <div class="col-8 text-end fw-bold fs-2">
                <u><?= $pay['response']['va_numbers'][0]['va_number']; ?></u>
            </div>
            <div class="col-4">
                <button class="btn btn-danger p-1" id="copyButton">Copy</button>
            </div>
        </div>
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

    const copyButton = document.getElementById('copyButton');
    copyButton.addEventListener('click', () => {
        const vaNumber = '<?= $pay['response']['va_numbers'][0]['va_number']; ?>';
        navigator.clipboard.writeText(vaNumber)
            .then(() => {
                swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Nomor Virtual Account telah disalin!',
                })
            })
            .catch((error) => {
                swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nomor Virtual Account gagal disalin!',
                })
            });
    });
</script>

<?= $this->endSection(); ?>