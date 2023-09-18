<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<!-- mobile -->
<div class="container pt-3 d-md-none">
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm-sm py-4 rounded-2">
            <form action="<?= base_url() ?>setting/detail-user/<?= user_id() ?>" method="post" enctype="multipart/form-data" onsubmit="return validasiDetailUser()">
                <div class="row g-3 px-3">
                    <div class="card border-0 shadow-sm py-4 mb-2 rounded-5 ">
                        <div class="row g-3 px-3">
                            <div class="text-center">
                                <p class="fs-5 text-secondary">Hai! Terlihat keren, <?= $du['username']; ?></p>
                                <img src="<?= base_url() ?>assets/img/fotouser/<?= $du['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 150px; height: 150px;" alt="...">
                            </div>
                        </div>
                    </div>
                    <?= csrf_field() ?>
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-white border-0 shadow-sm-sm bg-light">@</span>
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" id="username" name="username" placeholder="Username Anda" value="<?= $du['username']; ?>">
                            <span id="usernameError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control form-control-lg border-0 shadow-sm" id="fullname" name="fullname" placeholder="Nama Lengkap Anda" value="<?= $du['fullname']; ?>">
                        <span id="fullnameError" class="text-danger"></span>
                    </div>
                    <div class=" col-12">
                        <input type="text" class="form-control form-control-lg border-0 shadow-sm" id="telp" name="telp" placeholder="Nomor Telp Anda" value="<?= $du['telp']; ?>" onkeypress="return isNumber(event);">
                        <span id="telpError" class="text-danger"></span>
                    </div>

                    <div class="col-12">
                        <input type="email" class="form-control form-control-lg bg-white border-0 shadow-sm" id="email" name="email" placeholder="Email Anda" value="<?= $results[0]->secret; ?>" disabled>
                    </div>
                    <div class="col-12">
                        <input type="file" style="border: none;" class="form-control form-control-lg border-0 shadow-sm" id="img" name="img" value="<?= $du['img'] ?>">
                        <input type="hidden" disabled name="imageLama" value="<?= $du['img']; ?>">
                    </div>
                    <div class="py-3 px-3">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end Mobile -->

<!-- dekstop -->

<div class="container py-5 d-none d-md-block shadow-sm">
    <div class="row">
        <div class="col-lg-4">
            <form action="<?= base_url() ?>setting/detail-user/<?= user_id() ?>" method="post" enctype="multipart/form-data" onsubmit="return validasiDetailUser()">
                <div class="card">
                    <div class="card-body text-center">
                        <p class="fs-5 text-secondary">Hai! Terlihat keren, <?= $du['username']; ?></p>
                        <img src="<?= base_url() ?>assets/img/fotouser/<?= $du['img'] ?>" class="img-thumbnail rounded-circle border-0" style="width: 150px; height: 150px;" alt="...">
                    </div>
                </div>
        </div>
        <?= csrf_field() ?>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" id="username" name="username" placeholder="Username Anda" value="<?= $du['username']; ?>">
                            <span id="usernameError" class="text-danger"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" id="fullname" name="fullname" placeholder="Nama Lengkap Anda" value="<?= $du['fullname']; ?>">
                            <span id="fullnameError" class="text-danger"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" id="telp" name="telp" placeholder="Nomor Telp Anda" value="<?= $du['telp']; ?>" onkeypress="return isNumber(event);">
                            <span id="telpError" class="text-danger"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" class="form-control form-control-lg bg-white border-0 shadow-sm" id="email" name="email" placeholder="Email Anda" value="<?= $results[0]->secret; ?>" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Masukan Profile</p>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" style="border: none;" class="form-control form-control-lg border-0 shadow-sm" id="img" name="img" value="<?= $du['img'] ?>">
                            <input type="hidden" disabled name="imageLama" value="<?= $du['img']; ?>">
                        </div>
                    </div>
                    <div class="py-3 px-3">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- end Desktop -->

<script>
    // validasi form
    function validasiDetailUser() {
        var isValid = true;

        var usernameField = document.getElementById('username');
        var fullnameField = document.getElementById('fullname');
        var telpField = document.getElementById('telp');

        var usernameError = document.getElementById('usernameError');
        var fullnameError = document.getElementById('fullnameError');
        var telpError = document.getElementById('telpError');

        usernameError.textContent = '';
        fullnameError.textContent = '';
        telpError.textContent = '';

        if (usernameField.value.trim() === '') {
            usernameField.classList.add('invalid-field');
            usernameError.textContent = 'Username harus diisi';
            isValid = false;
        } else {
            usernameField.classList.remove('invalid-field');
        }

        if (fullnameField.value.trim() === '') {
            fullnameField.classList.add('invalid-field');
            fullnameError.textContent = 'Nama lengkap harus diisi';
            isValid = false;
        } else {
            fullnameField.classList.remove('invalid-field');
        }

        if (telpField.value.trim() === '') {
            telpField.classList.add('invalid-field');
            telpError.textContent = 'Nomor telpon harus diisi';
            isValid = false;
        } else {
            telpField
                .classList.remove('invalid-field');
        }
        return isValid;
    }
</script>

<?= $this->endSection(); ?>