<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $key; ?>"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<div class="row p-3 px-4 fixed-bottom">
    <button id="pay-button" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Buka Pembayaran</button>
</div>
<script type="text/javascript">
    function lpSanp() {
        window.snap.pay('<?= $item['snap_token']; ?>', {
            onSuccess: function(result) {
                /* You may add your own implementation here */
                alert("payment success!");
                console.log(result);
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

    window.addEventListener('load', function() {
        lpSanp();
    });
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        lpSanp();
    });
</script>
<?= $this->endSection(); ?>