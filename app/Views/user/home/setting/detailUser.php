<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>


<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container pt-3">
            <div class="row justify-content-center">
                <div class="card border-0 shadow-sm py-4 rounded-2">
                    <form action="<?= base_url() ?>setting/detail-user/<?= user_id() ?>" method="post" enctype="multipart/form-data" onsubmit="return validasiDetailUser()">
                        <div class="row g-3 px-3">
                            <div class="card border-0 shadow-sm py-4 mb-2 rounded-5 ">
                                <div class="row g-3 px-3">
                                    <div class="text-center">
                                        <p class="fs-5 text-secondary"><?= lang('Text.welcome_detail') ?><?= $du['username']; ?></p>
                                        <img src="<?= base_url() ?>assets/img/pic/<?= $du['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 150px; height: 150px;" alt="...">
                                    </div>
                                </div>
                                <!-- Button trigger modal -->
                                <div class="text-end mt-2">
                                    <button type="button" class="rounded-2 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="bi bi-trash"></i> Hapus Akun
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan Akun</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Akun anda akan dihapus oleh Admin.
                                                Apakah anda yakin untuk mengajukan penghapusan akun?
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="button" class="btn btn-danger">Ya</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?= csrf_field() ?>
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-white border-0 shadow-sm-sm bg-light">@</span>
                                    <input type="text" class="form-control form-control-lg <?= (validation_show_error('username')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="username" name="username" placeholder="<?= lang('Text.username') ?>" value="<?= $du['username']; ?>">
                                    <div class="invalid-feedback"><?= validation_show_error('username'); ?></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-lg <?= (validation_show_error('fullname')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="fullname" name="fullname" placeholder="<?= lang('Text.nama_lengkap') ?>" value="<?= $du['fullname']; ?>">
                                <div class="invalid-feedback"><?= validation_show_error('fullname'); ?></div>
                            </div>
                            <div class=" col-12">
                                <input type="text" class="form-control form-control-lg <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="telp" placeholder="<?= lang('Text.telp') ?>" value="<?= $du['telp']; ?>" onkeypress="return isNumber(event)" oninput="validateInput(this);">
                                <div class="invalid-feedback"><?= validation_show_error('telp'); ?></div>
                            </div>

                            <div class="col-12">
                                <input type="email" class="form-control form-control-lg border-0 shadow-sm" id="email" name="email" placeholder="<?= lang('Text.email') ?>" value="<?= $results[0]->secret; ?>" disabled>
                            </div>
                            <div class="col-12">
                                <input type="file" style="border: none;" class="form-control form-control-lg <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" accept="image/*" value="<?= $du['img'] ?>">
                                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="imageLama" value="<?= $du['img']; ?>">
                            </div>
                            <div class="py-3 px-3">
                                <div class="col text-center">
                                    <button type="submit" class="rounded-2 btn-danger btn btn-sm" style="font-size:medium;"><?= lang('Text.btn_simpan') ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 280px) {

            .btn.btn-lg.fw-bold {
                font-size: 12px !important;
            }

            .btn.btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
                margin-top: 5px !important;
                margin-right: 60px !important;
            }

            p.fs-5 {
                font-size: 13px !important;
            }

            .container {
                padding-top: 1rem;
            }

            .card {
                width: 100%;
                margin-bottom: 1rem;
            }

            .modal-dialog {
                max-width: 100%;
            }

            .modal-content {
                width: 100%;
            }

            .input-group-text {
                font-size: 0.8rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }
        }
    </style>

<?php else : ?>

    <!-- end Mobile -->

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-5 px-5 d-none d-md-block">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h2 class="mb-0"><?= lang('Text.title') ?></h2>
                            <hr class="text-danger">
                        </li>
                    </ol>
                </nav>
            </div>
            <form action="<?= base_url() ?>setting/detail-user/<?= user_id() ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body text-center">
                                <img src="<?= base_url() ?>assets/img/pic/<?= $du['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 150px; height: 150px;" alt="...">
                                <p class="mt-2 fs-5 text-secondary"><?= lang('Text.welcome_detail') ?><?= $du['username']; ?></p>
                                <!-- Button trigger modal -->
                                <div class="text-end mt-2">
                                    <button type="button" class="rounded-2 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="bi bi-trash"></i> Hapus Akun
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">احذف حسابك هل أنت متأكد؟</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Antum yakin mau hapus akun banyak promosi gocujang disini loh
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-sm btn-danger">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.username') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg <?= (validation_show_error('username')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="username" name="username" placeholder="<?= lang('Text.username') ?>" value="<?= $du['username']; ?>">
                                        <div class="invalid-feedback"><?= validation_show_error('username'); ?></div>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.nama_lengkap') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg <?= (validation_show_error('fullname')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="fullname" name="fullname" placeholder="<?= lang('Text.nama_lengkap') ?>" value="<?= $du['fullname']; ?>">
                                        <div class="invalid-feedback"><?= validation_show_error('fullname'); ?></div>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.telp') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="telp" placeholder="<?= lang('Text.telp') ?>" value="<?= $du['telp']; ?>" onkeypress="return isNumber(event);">
                                        <div class="invalid-feedback"><?= validation_show_error('telp'); ?></div>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.email') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control form-control-lg bg-white border-0 shadow-sm" id="email" name="email" placeholder="<?= lang('Text.email') ?>" value="<?= $results[0]->secret; ?>" disabled>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.profil') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-lg <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" accept="image/*" value="<?= $du['img'] ?>">
                                        <input type="hidden" name="imageLama" value="<?= $du['img']; ?>">
                                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                                    </div>
                                </div>
                                <div class="py-3 px-3">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-sm rounded-2 btn-danger" style="color: #fff;"><?= lang('Text.btn_simpan') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php endif; ?>

<!-- end Desktop -->

<?= $this->endSection(); ?>