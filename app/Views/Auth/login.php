<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="box shadow-sm">
    <div class="inner-box">
        <div class="forms-wrap">
            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="logo d-md-none d-lg-none">
                    <img src="<?= base_url(); ?>assets/img/auth/logo.png" alt="easyclass" />
                </div>
                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <?= $error ?>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= session('errors') ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>

                <?php if (session('message') !== null) : ?>
                    <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                <?php endif ?>
                <div class="heading">
                    <h2>Masuk</h2>

                    <?php if (setting('Auth.allowRegistration')) : ?>
                        <h6>Belum punya akun? <a class="toggle" href="<?= base_url() ?>register">Daftar</a></h6>
                    <?php endif ?>
                </div>

                <div class="actual-form">
                    <span class="small text-danger">Masukin aja disini</span>
                    <div class="input-wrap">
                        <input type="email" class="input-field shadow-sm border-0" name="email" inputmode="email" autocomplete="email" placeholder="   email" value="<?= old('email') ?>" required />
                    </div>
                    <span class="small text-danger">Masukin aja disini</span>


                    <div class="input-wrap position-relative">
                        <input type="password" class="input-field shadow-sm border-0" name="password" inputmode="text" placeholder="   kata sandi" autocomplete="current-password" required />
                        <i class="bi bi-eye-slash position-absolute top-50 start-100 translate-middle pe-3" id="togglePassword"></i>
                    </div>
                    <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                        <div class="input-wrap d-none">
                            <input type="checkbox" name="remember" class="form-check-input" <?= (old('remember')) ? 'checked' : 'checked' ?>>
                            <?= lang('Auth.rememberMe') ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" value="Masuk" class="sign-btn" id="btn-login"><?= lang('Auth.login') ?></button>

                    <div class="divider align-items-center mb-3">
                        <p class="text-center fw-medium mb-0">atau</p>
                    </div>

                    <a href="<?= base_url('oauth/glogin'); ?>" class="button justify-content-center align-items-center my-3" style="border: 1px solid #000000;">
                        <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                            <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.690 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                            <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                            <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                            <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
                        </svg>
                        Masuk dengan Google
                    </a>


                    <p class="text-center text-secondary">
                        <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                            Lupa kata sandi ? <a class="toggle" href="<?= url_to('magic-link') ?>">Klik disini</a>
                        <?php endif ?>
                    </p>
                    <p class="text-center"><a class="toggle" href="<?= base_url(); ?>">Lihat barang tanpa login</a></p>
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

<style>
    .button {
        max-width: 320px;
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
        fill: #4285F4;
        /* Warna untuk icon SVG */
    }

    .button:hover {
        transform: scale(1.02);
    }
</style>

<?= $this->endSection() ?>