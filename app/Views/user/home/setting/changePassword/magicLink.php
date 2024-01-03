<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container">
    <div class="row">
        <div class="col py-5">
        </div>
    </div>
    <form id="changePassword" action="<?= base_url('password-reset/storeMagicLink'); ?>" method="post">
        <div class="row">
            <div class="col-md-12">
                <?= csrf_field(); ?>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="password" name="newPass" class="form-control shadow-sm <?= (validation_show_error('newPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="password">
                    <label for="newPass">New Password</label>
                    <div class="invalid-feedback"><?= validation_show_error('newPass'); ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="password" name="reNewPass" class="form-control shadow-sm <?= (validation_show_error('reNewPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="password">
                    <label for="newPass">Re New Password</label>
                    <div class="invalid-feedback"><?= validation_show_error('reNewPass'); ?></div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12 d-flex justify-content-center">
                <button form="changePassword" type="submit" class="btn btn-danger" onclick="clickSubmitEvent(this)"><i class="bi bi-key"></i> Change Password</button>
            </div>
        </div>
    </form>
    <div class="row pt-3">
        <div class="col-12 d-flex justify-content-center">
            <form action="<?= base_url('password-reset/login-without-change-password'); ?>" method="post">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-secondary" onclick="clickSubmitEvent(this)"><i class="bi bi-box-arrow-in-right"></i> Login Tanpa ubah password</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>