<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>
<?php
$error = false;
if (session('errors')) {
    $error = session('errors');
} ?>
<?= $this->section('main') ?>
<div class="box shadow-sm border-0" style="height: 800px; overflow-y: scroll">
    <div class="inner-box">
        <div class="forms-wrap ">
            <form onsubmit="playPreloaderEvent()" action="<?= url_to('register') ?>" method="post">
                <?= csrf_field() ?>
                <div class="logo d-md-none d-lg-none">
                    <img src="<?= base_url(); ?>assets/img/auth/logo.png" alt="easyclass" />
                </div>
                <div class="heading mb-3">
                    <h2><?= lang('Text.btn_daftar') ?></h2>
                    <h6><?= lang('Text.sudah_punya_akun') ?></h6>
                    <a href="<?= base_url(); ?>login" class="toggle"><?= lang('Text.btn_login') ?></a>
                </div>

                <a onclick="buttonGoogle()" href="<?= base_url('oauth/glogin'); ?>" class="button justify-content-center align-items-center mb-3" style="border: 1px solid #000000;">
                    <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                        <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.690 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                        <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                        <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                        <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                    </svg>
                    <?= lang('Text.login_google') ?>
                </a>

                <a id="btn-login-apple" class="button justify-content-center align-items-center my-3" style="border: 1px solid #000000;">
                    <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 300 320">
                        <path d="M213.803 167.03c.442 47.58 41.74 63.413 42.197 63.615c-.35 1.116-6.599 22.563-21.757 44.716c-13.104 19.153-26.705 38.235-48.13 38.63c-21.05.388-27.82-12.483-51.888-12.483c-24.061 0-31.582 12.088-51.51 12.871c-20.68.783-36.428-20.71-49.64-39.793c-27-39.033-47.633-110.3-19.928-158.406c13.763-23.89 38.36-39.017 65.056-39.405c20.307-.387 39.475 13.662 51.889 13.662c12.406 0 35.699-16.895 60.186-14.414c10.25.427 39.026 4.14 57.503 31.186c-1.49.923-34.335 20.044-33.978 59.822M174.24 50.199c10.98-13.29 18.369-31.79 16.353-50.199c-15.826.636-34.962 10.546-46.314 23.828c-10.173 11.763-19.082 30.589-16.678 48.633c17.64 1.365 35.66-8.964 46.64-22.262" />
                    </svg>
                    <?= lang('Text.login_apple') ?>
                </a>

                <div class="divider align-items-center mb-3">
                    <p class="text-center fw-medium mb-0 small" style="font-size: 12px;"><?= lang('Text.atau') ?></p>
                </div>


                <div class="actual-form">
                    <span class="small text-danger"><?= (isset($error['username'])) ? $error['username'] : ''; ?></span>
                    <div class="input-wrap">
                        <input type="username" class="input-field shadow-sm border-0 px-2" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Text.username') ?>" value="<?= old('username') ?>" required />
                    </div>

                    <span class="small text-danger"><?= (isset($error['email'])) ? $error['email'] : ''; ?></span>
                    <div class="input-wrap">
                        <input type="email" class="input-field shadow-sm border-0 px-2" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Text.email') ?>" value="<?= old('email') ?>" required />
                    </div>

                    <span class="small text-danger"><?= (isset($error['password'])) ? $error['password'] : ''; ?></span>
                    <div class="input-wrap position-relative">
                        <input type="password" class="input-field shadow-sm border-0 px-2" name="password" inputmode="text" placeholder="<?= lang('Text.password') ?>" autocomplete="new-password" required />
                        <i class="bi bi-eye-slash position-absolute top-50 start-100 translate-middle pe-4" id="togglePassword"></i>
                    </div>
                    <span class="small text-danger"><?= (isset($error['password_confirm'])) ? $error['password_confirm'] : ''; ?>
                    </span>
                    <div class="input-wrap position-relative">
                        <input type="password" class="input-field shadow-sm border-0 px-2" name="password_confirm" inputmode="text" placeholder="<?= lang('Text.konfirm_password') ?>" autocomplete="new-password" required />
                        <i class="bi bi-eye-slash position-absolute top-50 start-100 translate-middle pe-4" id="togglePassword2"></i>
                    </div>

                    <button type="submit" value="Daftar" class="sign-btn" id="btn-register"><?= lang('Text.btn_daftar') ?></button>

                    <p class="text mb-5 text-center">
                        Dengan mendaftarkan diri, berarti anda menyetujui
                        <!-- <a href="#">Peraturan Pelayanan</a> dan -->
                        <a href="<?= base_url(); ?>kebijakan-privasi">Kebijakan Kami</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="carousel">
            <div class="images-wrapper">
                <img src="<?= base_url(); ?>assets/img/auth/banner.jpg" class="image img-1 show" alt="" />
                <img src="<?= base_url(); ?>assets/img/auth/image2.png" class="image img-2" alt="" />
                <img src="<?= base_url(); ?>assets/img/auth/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
                <h2>Belanja Sat-set</h2>
                <div class="text-wrap">
                    <div class="text-group">
                        <h2>Harga Hemat</h2>
                    </div>
                </div>

                <div class="bullets">
                    <span class="active" data-value="1"></span>
                    <!-- <span data-value="2"></span>
                <span data-value="3"></span> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>

<script>
    AppleID.auth.init({
        clientId: 'com.javasuperfood.ssayomartappready',
        scope: 'email',
        redirectURI: 'https://apps.ssayomart.com',
    });

    // Listen for authorization success.
    document.addEventListener('AppleIDSignInOnSuccess', (event) => {
        // Handle successful response.
        console.log('Apple Sign In Success:', event.detail.data);
    });

    // Listen for authorization failures.
    document.addEventListener('AppleIDSignInOnFailure', (event) => {
        // Handle error.
        console.log('Apple Sign In Failure:', event.detail.error);
    });

    function loginWithApple() {
        AppleID.auth.signIn();
    }

    // Kemudian terapkan event listener pada tombol Anda
    document.getElementById('btn-login-apple').addEventListener('click', loginWithApple);
</script>

<style>
    .button {
        max-width: 450px;
        display: flex;
        padding: 0.5rem 1.4rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 700;
        text-align: center;
        text-transform: capitalize;
        vertical-align: middle;
        align-items: center;
        border-radius: 0.5rem;
        gap: 0.75rem;
        color: rgb(65, 63, 63);
        background-color: #fff;
        cursor: pointer;
        transition: all .6s ease;
        text-decoration: none;
        /* Menghapus tampilan underline */
    }

    .button svg {
        height: 24px;
        fill: #000000;
        /* Warna untuk icon SVG */
    }

    .button:hover {
        transform: scale(1.02);
    }


    @media (min-width: 768px) and (max-width: 1024px) {
        .button {
            width: 450px !important;
        }

        @media (min-width: 280px) {
            .button {
                text-align: center;
                display: block;
                margin: 0 auto;
            }
        }
    }
</style>

<?= $this->endSection() ?>