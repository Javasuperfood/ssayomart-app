<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- view Mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent" style="margin-top: 30px;">
        <?php if (empty($alamat_user_model)) : ?>
            <!-- Tampilkan pesan jika pengguna tidak memiliki alamat -->
            <div class="container mt-4">
                <a id="createAddress" href="<?= base_url() ?>setting/create-alamat" style="text-decoration: none;">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger rounded border-0" role="alert">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="bi bi-house-add text-danger position-absolute top-50 start-0 translate-middle-y px-4" style="font-size: 35px;"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-secondary" style="font-size: 15px;">
                                            <span style="font-size:14px" class="text-secondary"><?= lang('Text.alert_alamat') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Tambahkan tombol "Tambah Alamat" di bawah pesan -->
        <?php else : ?>
            <div class="container">
                <?php foreach ($alamat_user_model as $au) : ?>
                    <div class="justify-content-center align-items-center">
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <div class="position-relative">
                                    <div class="card border-0 shadow-sm mb-3">
                                        <div class="card-header border-0 bg-white">
                                            <span class="fw-bold fs-5"><?= $au['label']; ?></span>
                                        </div>
                                        <div class="card-body detail-penerima">
                                            <p class="fw-bold"><?= $au['penerima']; ?> - <?= $au['telp']; ?></p>
                                            <p class="text-secondary"><?= $au['province'] ?> - <?= $au['city'] ?></p>
                                            <p class="text-secondary"><?= substr($au['alamat_1'], 0, 40); ?>...</p>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <div class="row row-cols-3">
                                                <div class="col">
                                                    <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="btn border-0"><?= lang('Text.btn_ubah') ?></a>
                                                </div>
                                                <div class="col">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $au['id_alamat_users']; ?>" class="btn border-0 text-danger m-0"><?= lang('Text.btn_hapus') ?></button>
                                                </div>
                                                <div class="col d-flex justify-content-end align-self-center" onclick="selectAddress(<?= $au['id_alamat_users'];; ?>)">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input fs-3" type="radio" role="switch" id="address<?= $au['id_alamat_users']; ?>" name="alamat" value="<?= $au['id_alamat_users']; ?>" <?= ($user['address_selected'] == $au['id_alamat_users']) ? 'checked' : ''; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="modal fade p-4 py-md-5" tabindex="-1" role="dialog" id="modalDelete<?= $au['id_alamat_users']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h6 class="mb-0">Anda yakin untuk menghapus <?= $au['label']; ?> ?</h6>
                                </div>
                                <form action="<?= base_url() ?>setting/delete-alamat/<?= $au['id_alamat_users']; ?>" method="post">
                                    <div class="modal-footer flex-nowrap p-0">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end text-danger"><strong><?= lang('Text.btn_hapus') ?></strong></button>
                                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 text-danger" data-bs-dismiss="modal">No thanks</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <form action="<?= base_url('setting/select-alamat'); ?>" method="post" onsubmit="playPreloaderEvent()">
                <?= csrf_field(); ?>
                <input type="hidden" name="alamat" id="alamatField">
                <button type="submit" id="selectAddress" class="btn btn-danger btn-lg addresCircle position-fixed"><i class="bi bi-check"></i></button>
            </form>
        <?php endif; ?>
        <a id="createAddress" href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg addresCircle position-fixed"><i class="bi bi-plus"></i></a>
    </div>
    <!-- style untuk samsung galaxy fold 280 -->
    <style>
        /* style for button create alamat */
        .addresCircle {
            width: 51px;
            height: 51px;
            border-radius: 50%;
            background-color: #dc3545;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 20px;
            right: 20px;
            margin-left: -100px;
        }

        /*style 280 pixel samsung galaxy fold*/

        @media screen and (max-width: 280px) {

            .card-body {
                font-size: 11px;
                flex: 1 1 auto;
                padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
                color: var(--bs-card-color);
            }

            .border-0 {
                font-size: 11px;
                border: 0 !important;
            }

            .alert-danger {
                font-size: 11px;
            }


        }
    </style>

    <style>
        .position-fixed {
            position: fixed;
            bottom: 70px;
            /* Atur jarak dari bawah sesuai kebutuhan */
            right: 10px;
            /* Atur jarak dari kanan sesuai kebutuhan */
        }
    </style>
<?php else : ?>
    <!-- End View Mobile -->

    <!-- View Desktop -->
    <div id="desktopContent" style="margin-top:150px;">
        <div class="container pt-3 d-none d-md-block">
            <?php if (empty($alamat_user_model)) : ?>
                <!-- Tampilkan pesan jika pengguna tidak memiliki alamat -->
                <div class="alert alert-danger" role="alert">
                    <span class="me-3">
                        <i class="bi bi-house-add" style="font-size: 25px;"></i>
                    </span>
                    <?= lang('Text.alert_alamat') ?>
                </div>

                <!-- Tambahkan tombol "Tambah Alamat" di bawah pesan -->
            <?php else : ?>
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="breadcrumb" class="rounded-3 p-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <h3 class="mb-0 fw-bold"><i class="fs-1 text-danger bi bi-house-door"></i> <?= lang('Text.title_alamat') ?></h3>
                                <hr class="border-danger" style="border-width: 3px;">
                            </li>
                        </ol>
                    </nav>
                </div>
                <?php foreach ($alamat_user_model as $au) : ?>
                    <div class="row row-cols-1">
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <div class="position-relative">
                                    <div class="card border-0 shadow-sm mb-3">
                                        <div class="card-header border-0 bg-white">
                                            <span class="fw-bold fs-5"><?= $au['label']; ?></span>
                                        </div>
                                        <div class="card-body">
                                            <p class="fw-bold"><?= $au['penerima']; ?> - <?= $au['telp']; ?></p>
                                            <p class="text-secondary"><?= $au['province'] ?> - <?= $au['city'] ?></p>
                                            <p class="text-secondary"><?= $au['alamat_1'] ?></p>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <div class="row row-cols-3">
                                                <div class="col-1">
                                                    <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="btn border-0"><?= lang('Text.btn_ubah') ?></a>
                                                </div>
                                                <div class="col-1">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $au['id_alamat_users']; ?>" class="btn border-0 text-danger m-0"><?= lang('Text.btn_hapus') ?></button>
                                                </div>
                                                <div class="col-10 d-flex justify-content-end align-self-center" onclick="selectAddress(<?= $au['id_alamat_users'];; ?>)">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input fs-4" type="radio" role="switch" id="address<?= $au['id_alamat_users']; ?>" name="alamat" value="<?= $au['id_alamat_users']; ?>" <?= ($user['address_selected'] == $au['id_alamat_users']) ? 'checked' : ''; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="modal fade p-4 py-md-5" tabindex="-1" role="dialog" id="modalDelete<?= $au['id_alamat_users']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h6 class="mb-0">Anda yakin untuk menghapus <?= $au['label']; ?> ?</h6>
                                </div>
                                <form action="<?= base_url() ?>setting/delete-alamat/<?= $au['id_alamat_users']; ?>" method="post">
                                    <div class="modal-footer flex-nowrap p-0">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end text-danger"><strong><?= lang('Text.btn_hapus') ?></strong></button>
                                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 text-danger" data-bs-dismiss="modal">No thanks</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="row p-4 px-4">
                <div class="col-12 d-flex justify-content-center">
                    <a id="createAddress" href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg">
                        <i class="bi bi-plus fw-bold"><?= lang('Text.btn_tambah') ?></i>
                    </a>
                    <form action="<?= base_url('setting/select-alamat'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="alamat" id="alamatField">
                        <button type="submit" id="selectAddress" class="btn btn-danger btn-lg">
                            <i class="bi bi-check fw-bold"> Update Alamat terpilih</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->

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

    $('#selectAddress').hide();

    function selectAddress(i) {
        $('#address' + i).prop('checked', true);
        $('#alamatField').val(i);
        $('#createAddress').hide();
        $('#selectAddress').show();
    }
</script>
<?= $this->endSection(); ?>