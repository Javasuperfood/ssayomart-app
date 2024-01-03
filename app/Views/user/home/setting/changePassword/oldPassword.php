<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container">
    <div class="row">
        <div class="col py-5"></div>
    </div>
    <form id="changePassword" action="<?= base_url('setting/detail-user/change-password/store'); ?>" method="post">
        <div class="row">
            <div class="col-md-12">
                <?= csrf_field(); ?>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="password" name="oldPass" class="form-control shadow-sm <?= (validation_show_error('oldPass')) ? 'is-invalid' : 'border-0'; ?>" id="oldPass" placeholder="password">
                    <label for="oldPass">Old Password</label>
                    <div class="invalid-feedback"><?= validation_show_error('oldPass'); ?></div>
                </div>
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
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button form="changePassword" type="submit" class="btn btn-primary" onclick="clickSubmitEvent(this)">Change Password</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection(); ?>