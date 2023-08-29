<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container pt-3">
    <div class="row g-3 px-3">
        <div class="col-12">
            <div class="input-group has-validation">
                <span class="input-group-text bg-white">@</span>
                <input type="text" class="form-control form-control-lg" id="username" placeholder="Username Anda" value="<?= $du['username']; ?>">
            </div>
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-lg" id="fullname" placeholder="Nama Lengkap Anda" value="<?= $du['fullname']; ?>">
        </div>
        <div class=" col-sm-6">
            <input type="text" class="form-control form-control-lg" id="telp" placeholder="Nomor Telp Anda" value="<?= $du['telp']; ?>">
        </div>

        <div class="col-12">
            <input type="email" class="form-control form-control-lg" id="email" placeholder="Email Anda" value="<?= $results[0]->secret; ?>">

        </div>
    </div>
    <div class="row fixed-bottom p-3 px-4">
        <a href="#" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</a>
    </div>
</div>
<?= $this->endSection(); ?>