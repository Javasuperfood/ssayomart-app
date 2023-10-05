<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="box shadow-sm border-0">
    <div class="inner-box">
        <div class="forms-wrap">
            <form action="<?= url_to('register') ?>" method="post">
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
                <div class="heading mb-3">
                    <h2>Daftar</h2>
                    <h6>Sudah punya akun?</h6>
                    <a href="<?= base_url(); ?>login" class="toggle">Masuk</a>
                </div>

                <div class="text-center mb-4">
                    <p class="small">Daftar atau masuk menggunakan:</p>
                    <button type="button" class="btn btn-warning btn-floating btn-sm mx-1">
                        <i class="bi bi-facebook fa-xs text-white"></i>
                    </button>

                    <button type="button" class="btn btn-warning btn-floating btn-sm mx-1">
                        <i class="bi bi-google fa-xs text-white"></i>
                    </button>

                    <button type="button" class="btn btn-warning btn-floating btn-sm mx-1">
                        <i class="bi bi-twitter fa-xs text-white"></i>
                    </button>

                </div>


                <div class="actual-form">
                    <div class="input-wrap">
                        <input type="username" class="input-field shadow-sm border-0" name="username" inputmode="text" autocomplete="username" placeholder="username" value="<?= old('username') ?>" required />
                    </div>

                    <div class="input-wrap">
                        <input type="email" class="input-field shadow-sm border-0" name="email" inputmode="email" autocomplete="email" placeholder="email" value="<?= old('email') ?>" required />
                    </div>

                    <div class="input-wrap position-relative">
                        <input type="password" class="input-field shadow-sm border-0" name="password" inputmode="text" placeholder="kata sandi" autocomplete="new-password" required />
                        <i class="bi bi-eye-slash position-absolute top-50 start-100 translate-middle pe-3" id="togglePassword"></i>
                    </div>
                    <div class="input-wrap position-relative">
                        <input type="password" class="input-field shadow-sm border-0" name="password_confirm" inputmode="text" placeholder="komfirmasi kata sandi" autocomplete="new-password" required />
                        <i class="bi bi-eye-slash position-absolute top-50 start-100 translate-middle pe-3" id="togglePassword2"></i>
                    </div>

                    <button type="submit" value="Daftar" class="sign-btn" id="btn-register">Daftar</button>

                    <p class="text mb-4">
                        Dengan mendaftarkan diri, berarti anda menyetujui
                        <a href="#">Peraturan Pelayanan</a> dan
                        <a href="#">Kebijakan</a>
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




<?= $this->endSection() ?>