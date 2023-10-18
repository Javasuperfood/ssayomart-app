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
    <div id="mobileContent">
        <div class="container pt-3">
            <?php
            foreach ($alamat_user_model as $au) :
            ?>
                <div class="row row-cols-1">
                    <div class="col">
                        <ul class="list-group list-group-flush">
                            <div class="position-relative">
                                <div class="card shadow-sm mb-3">
                                    <div class="card-header border-0 bg-white">
                                        <span class="fw-bold fs-5"><?= $au['label']; ?></span>
                                    </div>
                                    <div class="card-body">
                                        <p class="fw-bold"><?= $au['penerima']; ?> - <?= $au['telp']; ?></p>
                                        <p class="text-secondary"><?= $au['province'] ?> - <?= $au['city'] ?></p>
                                        <p class="text-secondary"><?= substr($au['alamat_1'], 0, 40); ?>...</p>
                                    </div>
                                    <div class="card-footer bg-white d-flex justify-content-between">
                                        <form action="<?= base_url() ?>setting/delete-alamat/<?= $au['id_alamat_users']; ?>" method="post">
                                            <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="btn border-0"><?= lang('Text.btn_ubah') ?></a>
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="btn border-0 text-danger m-0"><?= lang('Text.btn_hapus') ?></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
            <a href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg rounded-circle position-fixed"><i class="bi bi-plus"></i></a>
        </div>
        <style>
            .position-fixed {
                position: fixed;
                bottom: 70px;
                /* Atur jarak dari bawah sesuai kebutuhan */
                right: 10px;
                /* Atur jarak dari kanan sesuai kebutuhan */
            }
        </style>
    </div>
<?php else : ?>
    <!-- End View Mobile -->

    <!-- View Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container pt-3 d-none d-md-block">
            <?php if (empty($alamat_user_model)) : ?>
                <!-- Tampilkan pesan jika pengguna tidak memiliki alamat -->
                <div class="alert alert-warning" role="alert">
                    <?= lang('Text.alert_alamat') ?>
                </div>

                <!-- Tambahkan tombol "Tambah Alamat" di bawah pesan -->
            <?php else : ?>
                <div class="col-12 d-flex justify-content-center">
                    <nav aria-label="breadcrumb" class="rounded-3 p-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <h2 class="mb-0"><?= lang('Text.title_alamat') ?></h2>
                                <hr class="text-danger">
                            </li>
                        </ol>
                    </nav>
                </div>
                <?php foreach ($alamat_user_model as $au) : ?>
                    <div class="row row-cols-1">
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <div class="position-relative">
                                    <div class="card shadow-sm mb-3">
                                        <div class="card-header border-0 bg-white">
                                            <span class="fw-bold fs-5"><?= $au['label']; ?></span>
                                        </div>
                                        <div class="card-body">
                                            <p class="fw-bold"><?= $au['penerima']; ?> - <?= $au['telp']; ?></p>
                                            <p class="text-secondary"><?= $au['province'] ?> - <?= $au['city'] ?></p>
                                            <p class="text-secondary"><?= $au['alamat_1'] ?></p>
                                        </div>
                                        <div class="card-footer bg-white d-flex justify-content-between">
                                            <form action="<?= base_url() ?>setting/delete-alamat/<?= $au['id_alamat_users']; ?>" method="post">
                                                <a href="<?= base_url() ?>setting/update-alamat/<?= $au['id_alamat_users']; ?>" class="btn border-0"><?= lang('Text.btn_ubah') ?></a>
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn border-0 text-danger m-0"><?= lang('Text.btn_hapus') ?></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="row p-4 px-4">
                <div class="col-12 d-flex justify-content-center">
                    <a href="<?= base_url() ?>setting/create-alamat" class="btn btn-danger btn-lg">
                        <i class="bi bi-plus fw-bold"><?= lang('Text.btn_tambah') ?></i>
                    </a>
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
</script>
<?= $this->endSection(); ?>