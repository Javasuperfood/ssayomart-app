<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/assets/img/logo.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar pt-3">
        <div class="container-fluid">
            <div class="col text-center position-relative">
                <a href="#" class="
                position-absolute top-50 start-0 translate-middle-y"><i class=" bi bi-chevron-left navbar-brand"></i></a>
                <span class="navbar-brand"><?= $title; ?></span>
            </div>
        </div>
    </nav>
    <!-- END OF NAVBAR -->

    <!-- ITEM WISHLIST -->
    <div class="container pt-5">
        <div class="row text-center">
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Ottogi</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Norigo</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Ottogi</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Norigo</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Ottogi</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Norigo</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk1.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Ottogi</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card my-2" style="width: auto;">
                    <img src="<?= base_url() ?>assets/img/exampleproduk2.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title">Rp. 100.000</p>
                        <p class="card-text text-secondary">Norigo</p>
                        <a href="#" class="btn btn-light"><i class="bi bi-cart2"></i></a>
                        <a href="#" class="btn btn-light">Beli</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END OF WISHLIST -->

    <!-- BUTTON FIX BOTTOM -->
    <button type="button" class="btn btn-danger btn-lg rounded-circle bottom-0 end-0 mx-2 my-3 float-right position-fixed"><i class="bi bi-cart2"></i></button>
    <!-- END -->


    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>