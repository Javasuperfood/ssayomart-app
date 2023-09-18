<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container pt-3">
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