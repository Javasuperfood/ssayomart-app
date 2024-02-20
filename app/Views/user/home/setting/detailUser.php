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
        <div class="container pb-3">
            <div class="row justify-content-center">
                <div class="py-4 mt-3">
                    <form action="<?= base_url() ?>setting/detail-user/store" method="post" enctype="multipart/form-data">
                        <div class="row g-3 px-3">
                            <?= csrf_field() ?>
                            <!-- <div class="col-12 mt-3">
                                <label for="label" class="form-label mb-0 mx-1" style="font-size: 14px;">Username<span class="text-danger" style="font-size: 13px;"> *</span></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text bg-white border-0 shadow-sm bg-light">@</span>
                                    <input type="text" class="form-control input-teks form-control-lg <?= (validation_show_error('username')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="username" name="username" placeholder="<?= lang('Text.username') ?>" value="<?= $du['username']; ?>" style="font-size: 14px;">
                                    <div class="invalid-feedback"><?= validation_show_error('username'); ?></div>
                                </div>
                            </div> -->
                            <div class="col-12 mt-3">
                                <label for="label" class="form-label mb-0 mx-1" style="font-size: 14px;">Nama Lengkap<span class="text-danger" style="font-size: 13px;"> *</span></label>
                                <input type="text" class="form-control input-teks form-control-lg <?= (validation_show_error('fullname')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="fullname" name="fullname" placeholder="<?= lang('Text.nama_lengkap') ?>" value="<?= $du['fullname']; ?>" style="font-size: 14px;">
                                <div class="invalid-feedback"><?= validation_show_error('fullname'); ?></div>
                            </div>
                            <div class=" col-12 mt-3">
                                <label for="label" class="form-label mb-0 mx-1" style="font-size: 14px;">No. Telp<span class="text-danger" style="font-size: 13px;"> *</span></label>
                                <input type="text" class="form-control input-teks form-control-lg <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="telp" placeholder="<?= lang('Text.telp') ?>" value="<?= $du['telp']; ?>" onkeypress="return isNumber(event)" oninput="validateInput(this);" style="font-size: 14px;">
                                <div class="invalid-feedback"><?= validation_show_error('telp'); ?></div>
                            </div>

                            <div class="col-12 mt-3">
                                <label for="label" class="form-label mb-0 mx-1" style="font-size: 14px;">Email<span class="text-danger" style="font-size: 13px;"> *</span></label>
                                <input type="email" class="form-control input-teks form-control-lg border-0 shadow-sm bg-light" id="email" name="email" placeholder="<?= lang('Text.email') ?>" value="<?= $results[0]->secret; ?>" style="font-size: 14px;" disabled>
                            </div>
                            <!-- <div class="col-12 mt-3">
                                <label for="label" class="form-label mb-0 mx-1" style="font-size: 14px;">Foto Profil<span class="text-danger" style="font-size: 13px;"> *</span></label>
                                <input type="file" style="border: none; font-size: 14px;" class="form-control input-teks form-control-lg <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" accept="image/*" value="<?= $du['img'] ?>">
                                <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                            </div> -->
                            <div class="col-12 mt-3">
                                <input type="hidden" name="imageLama" value="<?= $du['img']; ?>">
                            </div>
                            <div class="py-3 px-3">
                                <div class="text-end mt-0 mb-3">
                                    <p class="fs-6">
                                        <a class="text-secondary link-offset-2 link-underline link-underline-opacity-0" href="<?= base_url('setting/detail-user/change-password'); ?>"><i class="bi bi-key"></i> Change Password</a>
                                    </p>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" class="mt-1 btn btn-md btn-danger rounded-2" onclick="clickSubmitEvent(this)" style="color: #fff;"><?= lang('Text.btn_simpan') ?></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan Akun</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url() ?>setting/detail-user/delete-account/<?= user_id() ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="alert alert-danger">
                                            <div class="col-auto text-center mb-2" style="font-size:50px;">
                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                            </div>
                                            <div class="col text-center">
                                                <p><strong>Akun anda akan dihapus oleh Admin.</strong></p>
                                                <p>Apakah anda yakin untuk mengajukan penghapusan akun?</p>
                                                <div class="col-12">
                                                    <input type="text" style="font-size: 14px;" class="form-control form-control-lg <?= (validation_show_error('alasan')) ? 'is-invalid' : 'border-0'; ?>" id="alasan" name="alasan" placeholder="Alasan penghapusan akun" value="<?= old('alasan'); ?>">
                                                    <div class="invalid-feedback"><?= validation_show_error('alasan'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Ya</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 280px) {
            .input-teks {
                font-size: 10px !important;
            }

            .selamat-datang {
                font-size: 14px !important;
            }
        }
    </style>
<?php else : ?>
    <!-- end Mobile -->

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:130px;">
        <div class="container py-5 px-5 d-none d-md-block">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="breadcrumb" class="rounded-3 p-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <h3 class="fw-bold mb-0 "><i class="text-danger fs-1 bi bi-person-circle me-1"></i> <?= lang('Text.title') ?></h3>
                            <hr class="border-danger" style="border-width: 3px;">
                        </li>
                    </ol>
                </nav>
            </div>
            <form action="<?= base_url() ?>setting/detail-user/store" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body text-center">
                                <img src="<?= base_url() ?>assets/img/pic/<?= $du['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 150px; height: 150px;" alt="...">
                                <p class="text-secondary mt-2" style="font-size: 14px;"><?= lang('Text.welcome_detail') ?><?= $du['username']; ?></p>
                                <!-- Button trigger modal -->
                                <div class="gap-2 text-center mt-2">
                                    <?php if (!$deleteRequestExists) : ?>
                                        <button type="button" class="btn btn-sm btn-danger p-2 fw-bold rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi bi-trash mx-2"></i> Hapus akun
                                        </button>
                                    <?php endif; ?>
                                    <a href="<?= base_url('setting/detail-user/change-password'); ?>" class=" btn btn-sm btn-danger p-2 fw-bold rounded-3">
                                        <i class="bi bi-key mx-2"></i> Change Password
                                    </a>
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
                                        <input type="text" class="form-control form-control-lg <?= (validation_show_error('username')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="username" name="username" placeholder="<?= lang('Text.username') ?>" value="<?= $du['username']; ?>" style="font-size: 16px;">
                                        <div class="invalid-feedback"><?= validation_show_error('username'); ?></div>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.nama_lengkap') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg <?= (validation_show_error('fullname')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="fullname" name="fullname" placeholder="<?= lang('Text.nama_lengkap') ?>" value="<?= $du['fullname']; ?>" style="font-size: 16px;">
                                        <div class="invalid-feedback"><?= validation_show_error('fullname'); ?></div>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.telp') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="telp" placeholder="<?= lang('Text.telp') ?>" value="<?= $du['telp']; ?>" onkeypress="return isNumber(event);" style="font-size: 16px;">
                                        <div class="invalid-feedback"><?= validation_show_error('telp'); ?></div>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.email') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control form-control-lg bg-white border-0 shadow-sm" id="email" name="email" placeholder="<?= lang('Text.email') ?>" value="<?= $results[0]->secret; ?>" style="font-size: 16px;" disabled>
                                    </div>
                                </div>
                                <hr class="border-0">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"><?= lang('Text.profil') ?></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-lg <?= (validation_show_error('img')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="img" name="img" accept="image/*" value="<?= $du['img'] ?>" style="font-size: 14px;">
                                        <input type="hidden" name="imageLama" value="<?= $du['img']; ?>">
                                        <div class="invalid-feedback"><?= validation_show_error('img'); ?></div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="col text-end">
                                        <button type="submit" class="mt-3 btn btn-sm btn-danger p-2 fw-bold rounded-3" style="color: #fff; font-size: 13px;"><?= lang('Text.btn_simpan') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan Akun</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url() ?>setting/detail-user/delete-account/<?= user_id() ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="alert alert-danger">
                                    <div class="col-auto text-center mb-2" style="font-size:50px;">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </div>
                                    <div class="col text-center">
                                        <p><strong>Akun anda akan dihapus oleh Admin.</strong></p>
                                        <p>Apakah anda yakin untuk mengajukan penghapusan akun?</p>
                                        <div class="col-12">
                                            <input type="text" class="form-control form-control-lg <?= (validation_show_error('alasan')) ? 'is-invalid' : 'border-0'; ?>" id="alasan" name="alasan" placeholder="Alasan penghapusan akun" value="<?= old('alasan'); ?>">
                                            <div class="invalid-feedback"><?= validation_show_error('alasan'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
<!-- end Desktop -->
<?= $this->endSection(); ?>