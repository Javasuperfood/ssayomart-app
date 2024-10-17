<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>


<?php if ($isMobile) : ?>
    <div id="mobileContent">
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
                        <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">
                            Masukkan Password yang lama
                            <span class="text-danger" style="font-size: 13px;"> *</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="oldPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('oldPass')) ? 'is-invalid' : 'border-0'; ?>" id="oldPass" placeholder="Password" style="font-size: 11px;">
                            <button class="btn shadow-sm" type="button" id="toggleOldPass">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('oldPass'); ?></div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">
                        Masukkan Password yang baru
                        <span class="text-danger" style="font-size: 13px;"> *</span>
                    </label>
                    <div class="input-group">
                        <input type="password" name="newPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('newPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="Password baru" style="font-size: 11px;">
                        <button class="btn shadow-sm" type="button" id="toggleNewPass">
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
                        <button class="btn shadow-sm" type="button" id="toggleReNewPass">
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
    </div>

    <script>
        document.getElementById('toggleOldPass').addEventListener('click', function() {
            togglePasswordVisibility('oldPass');
        });

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
                toggleButton.innerHTML = '<i class="bi bi-eye"></i>'; // Icon untuk show
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>'; // Icon untuk hide
            }
        }
    </script>

<?php else : ?>

    <div id="desktopContent" style="margin-top:150px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5 border-0 shadow-sm">
                        <div class="card-header bg-white border-0 p-3 d-flex align-items-center justify-content-center">
                            <h3 class="text-center text-dark fw-bold "><i class="bi bi-key-fill mx-2 text-danger"></i> Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form id="changePassword" action="<?= base_url('setting/detail-user/change-password/store'); ?>" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?= csrf_field(); ?>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">
                                            Masukkan Password yang lama
                                            <span class="text-danger" style="font-size: 13px;"> *</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="oldPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('oldPass')) ? 'is-invalid' : 'border-0'; ?>" id="oldPass" placeholder="Password" style="font-size: 11px;">
                                            <button class="btn shadow-sm" type="button" id="toggleOldPass">
                                                <i class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback"><?= validation_show_error('oldPass'); ?></div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <label for="label" class="form-label mb-0 mx-1" style="font-size: 12px;">
                                        Masukkan Password yang baru
                                        <span class="text-danger" style="font-size: 13px;"> *</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="newPass" class="form-control p-3 form-control-lg shadow-sm <?= (validation_show_error('newPass')) ? 'is-invalid' : 'border-0'; ?>" id="newPass" placeholder="Password baru" style="font-size: 11px;">
                                        <button class="btn shadow-sm" type="button" id="toggleNewPass">
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
                                        <button class="btn shadow-sm" type="button" id="toggleReNewPass">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback"><?= validation_show_error('reNewPass'); ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end mt-4">
                                        <button form="changePassword" type="submit" class="btn btn-danger p-2" style="font-size: 13px;" onclick="clickSubmitEvent(this)"><i class="bi bi-key mx-2"></i> Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('toggleOldPass').addEventListener('click', function() {
            togglePasswordVisibility('oldPass');
        });

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
                toggleButton.innerHTML = '<i class="bi bi-eye"></i>'; // Icon untuk show
            } else {
                passwordInput.type = 'password';
                toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>'; // Icon untuk hide
            }
        }
    </script>
<?php endif; ?>

<?php
if ($isMobile) {

    echo '<div id="mobileContent">';

    echo '</div>';
} else {

    echo '<div id="desktopContent">';

    echo '</div>';
}
?>


<?= $this->endSection(); ?>