<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<?= $this->include('user/home/component/navbarMain') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- Tampilan mobile & ipad -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-blok d-lg-none d-xl-none">
            <div class="row">
                <div class="col">
                    <a href="<?= base_url(); ?>setting/alamat-list" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= (!$alamat) ? 'Tambahkan Alamat' : $alamat['label']; ?> <i class="bi bi-chevron-down"></i> </a>
                    <div class="row pb-4">
                        <div class="col-9">
                            <h3 class="fw-bold py-3 fs-5">Selamat datang, <?= $user['username']; ?></h3>
                        </div>
                        <div class="col-3">
                            <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>">
                                <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 80px; height: 80px;" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col">
                    <div class="alert alert-danger rounded border-0" role="alert">
                        <div class="row">
                            <div class="col-1"><i class="bi bi-heart-pulse-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i></div>
                            <div class="col-9 text-secondary fs-6">Mohon maaf area anda belum terjangkau oleh pelayanan kami.</div>
                            <div class="col-2 text-end"><a href="#" class="link-primary link-underline link-underline-opacity-0 text-dark">Kirim saran</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-1">
                <div class="col">
                    <div class="card text-bg-light mb-3 shadow border-0 rounded">
                        <div class="card-body">
                            <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                <div class="row">
                                    <div class="col-3"><img src="<?= base_url(); ?>assets/img/coupon.png" alt="" class="card-img"></div>
                                    <div class="col">
                                        <h5 class="card-title text-dark">TERSEDIA KUPON DISKON!!</h5>
                                        <p class="card-text text-secondary">Untuk kamu pengguna baru</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1">
                <div class="col">
                    <h3>Pengaturan</h3>
                    <ul class="list-group list-group-flush">
                        <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-person-circle pe-2 text-secondary"></i> Detail Akun <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-heart pe-2 text-secondary"></i> Favorit <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting/alamat-list" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-cursor pe-2 text-secondary"></i> Alamat tersimpan <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                    </ul>

                </div>
            </div>
            <div class="row row-cols-1 pb-5">
                <div class="col">
                    <h3>Bantuan</h3>
                    <ul class="list-group list-group-flush">
                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-question-circle pe-2 text-secondary"></i> Tentang Ssayomart <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting/about" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-headset pe-2 text-secondary"></i> Ssayomart Care <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-lock pe-2 text-secondary"></i> Kebijakan Privasi <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                        <a href="<?= base_url(); ?>logout" class="list-group-item pb-3 fw-bold">
                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i> Logout <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- end mobile&ipad -->

    <!-- Tampilan Desktop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 d-none d-lg-block">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center" style="height: 325px;">
                            <img src="<?= base_url() ?>assets/img/pic/<?= $user['img'] ?>" alt="profile" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;">
                            <h3 class="fw-bold  fs-5">Selamat datang, <?= $user['username']; ?></h3>
                            <a href="<?= base_url(); ?>setting/alamat-list" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0"><?= (!$alamat) ? 'Tambahkan Alamat' : $alamat['label']; ?> <i class="bi bi-chevron-down"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger rounded border-0" role="alert">
                                        <div class="row">
                                            <div class="col-1"><i class="bi bi-heart-pulse-fill text-danger fs-2 position-absolute top-50 start-0 translate-middle-y px-2"></i></div>
                                            <div class="col-9 text-secondary fs-6">Mohon maaf area anda belum terjangkau oleh pelayanan kami.</div>
                                            <div class="col-2 text-end"><a href="#" class="link-primary link-underline link-underline-opacity-0 text-dark">Kirim saran</a></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card text-bg-light mb-3 shadow-sm border-0 rounded">
                                            <div class="card-body">
                                                <a href="<?= base_url() ?>kupon" class="link-offset-2 link-underline link-underline-opacity-0">
                                                    <div class="row">
                                                        <div class="col-3"><img src="<?= base_url(); ?>assets/img/coupon.png" alt="" class="card-img"></div>
                                                        <div class="col">
                                                            <h5 class="card-title text-dark">TERSEDIA KUPON DISKON!!</h5>
                                                            <p class="card-text text-secondary">Untuk kamu pengguna baru</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3>Pengaturan
                                    </h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>setting/detail-user/<?= $user['id']; ?>" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-person-circle pe-2 text-secondary"></i> Detail Akun <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-heart pe-2 text-secondary"></i> Favorit <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting/alamat-list" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-cursor pe-2 text-secondary"></i> Alamat tersimpan <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>logout" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-box-arrow-right pe-2 text-secondary"></i> Logout <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4 mb-md-0">
                                <div class="card-body">
                                    <h3>Bantuan</h3>
                                    <ul class="list-group list-group-flush">
                                        <a href="<?= base_url(); ?>history" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-clock-history pe-2 text-secondary"></i> Riwayat Pembelian <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-question-circle pe-2 text-secondary"></i> Tentang Ssayomart <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-headset pe-2 text-secondary"></i> Ssayomart Care <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                        <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                                            <i class="bi bi-lock pe-2 text-secondary"></i> Kebijakan Privasi <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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

<?php if (session()->getFlashdata('success')) : ?>
    <script type="module">
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: ' <?= session()->getFlashdata('success') ?>',
        })
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('failed')) : ?>
    <script type="module">
        Swal.fire({
            icon: 'failed',
            title: 'Error',
            text: ' <?= session()->getFlashdata('failed') ?>',
        })
    </script>
<?php endif; ?>
<?= $this->endSection(); ?>