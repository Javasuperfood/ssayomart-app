<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="box">
    <div class="inner-box">
        <div class="forms-wrap">
            <form action="<?= url_to('register') ?>" method="post">
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
                <div class="heading">
                    <h2>Daftar</h2>
                    <h6>Sudah punya akun?</h6>
                    <a href="<?= base_url(); ?>login" class="toggle">Masuk</a>
                </div>

                <div class="actual-form">
                    <div class="input-wrap">
                        <input type="username" class="input-field" name="username" inputmode="text" autocomplete="username" placeholder="username" value="<?= old('username') ?>" required />
                    </div>

                    <div class="input-wrap">
                        <input type="email" class="input-field" name="email" inputmode="email" autocomplete="email" placeholder="email" value="<?= old('email') ?>" required />
                    </div>

                    <div class="input-wrap">
                        <input type="password" class="input-field" name="password" inputmode="text" placeholder="kata sandi" autocomplete="new-password" required />
                    </div>
                    <div class="input-wrap">
                        <input type="password" class="input-field" name="password_confirm" inputmode="text" placeholder="komfirmasi kata sandi" autocomplete="new-password" required />
                    </div>

                    <button type="submit" value="Daftar" class="sign-btn" id="btn-register">Daftar</button>

                    <p class="text">
                        Dengan mendaftarkan diri, berarti anda menyetujui
                        <a href="#">Peraturan Pelayanan</a> and
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