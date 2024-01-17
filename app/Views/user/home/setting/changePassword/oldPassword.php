<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container">
    <div class="row">
        <div class="col"></div>
    </div>
    <form id="changePassword" action="<?= base_url('setting/detail-user/change-password/store'); ?>" method="post">
        <div class="row">
            <div class="col-md-12">
                <?= csrf_field(); ?>
            </div>
            <div class="col-12 mt-2">
                <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">Masukan Password yang lama <span class="text-danger" style="font-size: 13px;"> *</span></label>
                <input type="password" name="oldPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('oldPass')) ? 'is-invalid' : 'border-0'; ?>" id="oldPass" placeholder="Password" style="font-size: 11px;">
                <div class="invalid-feedback"><?= validation_show_error('oldPass'); ?></div>
            </div>
        </div>
        <!-- <div class="col-12 mt-2">
            <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">Masukan Password yang baru <span class="text-danger" style="font-size: 13px;"> *</span></label>
            <input type="password" name="newPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('newPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="Password baru" style="font-size: 11px;">
            <div class="invalid-feedback"><?= validation_show_error('newPass'); ?></div>
        </div>
        <div class="col-12 mt-2">
            <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">Verifikasi Password yang baru <span class="text-danger" style="font-size: 13px;"> *</span></label>
            <input type="password" name="reNewPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('reNewPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="Verifikasi Password" style="font-size: 11px;">
            <div class="invalid-feedback"><?= validation_show_error('reNewPass'); ?></div>
        </div> -->

        <div class="col-12 mt-2">
            <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">
                Masukkan Password yang baru
                <span class="text-danger" style="font-size: 13px;"> *</span>
            </label>
            <div class="input-group">
                <input type="password" name="newPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('newPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="Password baru" style="font-size: 11px;">
                <button class="btn btn-outline-secondary" type="button" id="toggleNewPass">
                    <i class="bi bi-eye-slash"></i>
                </button>
            </div>
            <div class="invalid-feedback"><?= validation_show_error('newPass'); ?></div>
        </div>

        <div class="col-12 mt-2">
            <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">
                Verifikasi Password yang baru
                <span class="text-danger" style="font-size: 13px;"> *</span>
            </label>
            <div class="input-group">
                <input type="password" name="reNewPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('reNewPass')) ? 'is-invalid' : 'border-0'; ?>" id="reNewPass" placeholder="Verifikasi Password" style="font-size: 11px;">
                <button class="btn btn-outline-secondary" type="button" id="toggleReNewPass">
                    <i class="bi bi-eye-slash"></i>
                </button>
            </div>
            <div class="invalid-feedback"><?= validation_show_error('reNewPass'); ?></div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-5">
                <button form="changePassword" type="submit" class="btn btn-danger p-2" style="font-size: 13px;" onclick="clickSubmitEvent(this)"><i class="bi bi-key"></i> Change Password</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('toggleNewPass').addEventListener('click', function() {
        togglePasswordVisibility('newPass');
    });

    document.getElementById('toggleReNewPass').addEventListener('click', function() {
        togglePasswordVisibility('reNewPass');
    });

    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var toggleButton = document.getElementById('toggle' + inputId.charAt(0).toUpperCase() + inputId.slice(1));

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.innerHTML = '<i class="bi bi-eye"></i>'; // Icon untuk Hide
        } else {
            passwordInput.type = 'password';
            toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>'; // Icon untuk Show
        }
    }
</script>


<?= $this->endSection(); ?>