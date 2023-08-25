<?= $this->extend('user/home/layout') ?>
<?= $this->section('page-content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="<?= base_url(); ?>setting#" class="link-secondary fw-bold pt-2 link-underline link-underline-opacity-0">Alamat <i class="bi bi-chevron-down"></i> </a>
            <div class="row pb-4">
                <div class="col-9">
                    <h3 class="fw-bold py-3">Selamat datang, <?= $name; ?></h3>
                </div>
                <div class="col-3">
                    <img src="<?= base_url() ?>assets/img/logo.png" class="img-thumbnail rounded-circle border-0" style="width: 80px; height: 80px;" alt="...">
                </div>
            </div>
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table>
                                <tr>
                                    <td rowspan="2"><i class="bi bi-cash-stack fs-4 fw-bold text-success"></i></td>
                                    <td>
                                        <span class="text-secondary ps-2">saldo anda</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fw-bold ps-2">Rp. <?= number_format($saldo, 2, ',', '.'); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-3">
        <div class="col">
            <div class="alert alert-danger rounded-0 border-0" role="alert">
                <div class="row">
                    <div class="col text-secondary"><i class="bi bi-heart-pulse-fill text-danger"></i> Area anda belum terjangkau. Kirim saran untuk update slanjutnya.</div>
                    <div class="col-3 text-end"><a href="#" class="link-primary fw-bold link-underline link-underline-opacity-0">Kirim saran</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-1">
        <div class="col">
            <div class="card text-bg-light mb-3 shadow border-0 rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3"><img src="<?= base_url(); ?>assets/img/logo.png" alt="" class="card-img"></div>
                        <div class="col">
                            <h5 class="card-title">DISKON 30%!!!</h5>
                            <p class="card-text">Untuk kamu pengguna baru</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1">
        <div class="col">
            <h3>Pengaturan</h3>
            <ul class="list-group list-group-flush">
                <a href="<?= base_url(); ?>setting/detail-user" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-person-circle pe-2 text-secondary"></i> Detail Akun <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
                <a href="<?= base_url(); ?>wishlist" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-heart pe-2 text-secondary"></i> Favorit <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
                <a href="<?= base_url(); ?>setting/pembayaran" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-credit-card-2-back pe-2 text-secondary"></i> Pembayaran <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
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
                <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-headset pe-2 text-secondary"></i> Ssayomart Care <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
                <a href="<?= base_url(); ?>setting#" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-lock pe-2 text-secondary"></i> Kebijikan Privasi <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
                <a href="<?= base_url(); ?>logout" class="list-group-item pb-3 fw-bold">
                    <i class="bi bi-box-arrow-right pe-2 text-secondary"></i> Logout <i class="bi bi-chevron-right fw-bolder position-absolute top-50 end-0 translate-middle-y"></i>
                </a>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>