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
        <div class="container">
            <div class="row">
                <div class="box-right p-3">
                    <div class="d-flex mb-2">
                        <p class="fw-bold">Pembayaran Virtual Account</p>
                        <p class="ms-auto text-muted"><span class="fas fa-times"></span></p>
                    </div>
                    <div class="d-flex">
                        <p class="h7">#SSAYOMARRT151392023</p>
                        <p class="ms-auto btn btn-danger p-1" style="font-size: 9px;">Copy Link</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">

            <style>
                .text-muted {
                    margin: 0;
                    /* Menghilangkan margin atas dan bawah */
                }
            </style>
            <p class="text-muted fw-bold h8">Invoice</p>
            <p class="text-muted h7">Anto walker</p>
            <p class="text-muted h8">Javasuperfood,Utah, Indonesia 84104</p>
            <p class="text-muted h8">awal@gmail.com</p>

            <div class="box-left p-3">
                <div class="h8">
                    <div class="row border mb-3">
                        <div class="col-6 pe-0 ps-2">
                            <p class="text-muted py-2">Items</p>
                            <span class="d-block py-2 border-bottom">Nori</span>
                            <span class="d-block py-2">Nori</span>
                        </div>
                        <div class="col-2 text-center p-0">
                            <p class="text-muted p-2">Qty</p>
                            <span class="d-block p-2 border-bottom">2</span>
                            <span class="d-block p-2">1</span>
                        </div>
                        <div class="col-2 p-0 text-center border-end">
                            <p class="text-muted p-2">Harga</p>
                            <span class="d-block border-bottom py-2"><span class="fas fa-dollar-sign"></span>500</span>
                            <span class="d-block py-2"><span class="fas fa-dollar-sign"></span>400</span>
                        </div>
                        <div class="col-2 p-0 text-center">
                            <p class="text-muted p-2">Total</p>
                            <span class="d-block py-2 border-bottom"><span class="fas fa-dollar-sign"></span>1000</span>
                            <span class="d-block py-2"><span class="fas fa-dollar-sign"></span>400</span>
                        </div>
                    </div>
                    <div class="d-flex h7 mb-2">
                        <p class="">Total Amount</p>
                        <p class="ms-auto"><span class="fas fa-dollar-sign"></span>1400</p>
                    </div>
                    <div class="h8 mb-5">
                        <p class="text-muted">Lorem ipsum dolor sit amet elit. Adipisci ea harum sed quaerat tenetur </p>
                    </div>
                </div>
                <div class="">

                    <div class="form">
                        <div class="row">
                            <p class="btn btn-danger d-block h8">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- tampilan Desktop -->
    <div id="desktopContent">
        <div class="container pt-5">
            <div class="row">
                <div class="box-right p-3">
                    <div class="d-flex mb-2">
                        <p class="fw-bold">Pembayaran Virtual Account</p>
                        <p class="ms-auto text-muted"><span class="fas fa-times"></span></p>
                    </div>
                    <div class="d-flex">
                        <p class="h7">#SSAYOMARRT151392023</p>
                        <p class="ms-auto btn btn-danger p-1" style="font-size: 9px;">Copy Link</p>
                    </div>
                </div>
            </div>

            <p class="text-muted fw-bold h8">Invoice</p>
            <p class="text-muted h7">Anto walker</p>
            <p class="text-muted h8">Javasuperfood,Utah, Indonesia 84104</p>
            <p class="text-muted h8">awal@gmail.com</p>

            <style>
                .text-muted {
                    margin: 0;
                    /* Menghilangkan margin atas dan bawah */
                }
            </style>

            <div class="box-left p-3">
                <div class="h8">
                    <div class="row border mb-3">
                        <div class="col-6 pe-0 ps-2">
                            <p class="text-muted py-2">Items</p>
                            <span class="d-block py-2 border-bottom">Nori</span>
                            <span class="d-block py-2">Nori</span>
                        </div>
                        <div class="col-2 text-center p-0">
                            <p class="text-muted p-2">Qty</p>
                            <span class="d-block p-2 border-bottom">2</span>
                            <span class="d-block p-2">1</span>
                        </div>
                        <div class="col-2 p-0 text-center border-end">
                            <p class="text-muted p-2">Harga</p>
                            <span class="d-block border-bottom py-2"><span class="fas fa-dollar-sign"></span>500</span>
                            <span class="d-block py-2"><span class="fas fa-dollar-sign"></span>400</span>
                        </div>
                        <div class="col-2 p-0 text-center">
                            <p class="text-muted p-2">Total</p>
                            <span class="d-block py-2 border-bottom"><span class="fas fa-dollar-sign"></span>1000</span>
                            <span class="d-block py-2"><span class="fas fa-dollar-sign"></span>400</span>
                        </div>
                    </div>
                    <div class="d-flex h7 mb-2">
                        <p class="">Total Amount</p>
                        <p class="ms-auto"><span class="fas fa-dollar-sign"></span>1400</p>
                    </div>
                    <div class="h8 mb-5">
                        <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis quibusdam delectus amet eaque repudiandae suscipit neque quas, ducimus reprehenderit cupiditate sunt velit totam, placeat ex asperiores, necessitatibus culpa iure numquam. </p>
                    </div>
                </div>
                <div class="button-selesai">
                    <button type="button" class="btn btn-danger">Selesai</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- tampilan Desktop -->


<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>


<?= $this->endSection(); ?>