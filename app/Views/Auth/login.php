<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="box">
    <div class="inner-box">
        <div class="forms-wrap">
            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="logo">
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
                    <div class="input-wrap">
                        <input type="email" class="input-field" name="email" inputmode="email" autocomplete="email" placeholder="email" value="<?= old('email') ?>" required />
                    </div>

                    <div class="input-wrap">
                        <input type="password" class="input-field" name="password" inputmode="text" placeholder="kata sandi" autocomplete="current-password" required />
                        <i class="bi bi-eye" id="togglePassword"></i>
                    </div>
                    <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                        <div class="input-wrap">
                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked<?php endif ?>>
                            <?= lang('Auth.rememberMe') ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" value="Masuk" class="sign-btn" id="btn-login"><?= lang('Auth.login') ?></button>

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
<?= $this->endSection() ?>