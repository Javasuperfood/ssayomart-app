<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container pt-3">
    <form action="<?= base_url() ?>setting/detail-user/<?= user_id() ?>" method="post">
        <div class="row g-3 px-3">
            <?= csrf_field() ?>
            <div class="col-12">
                <div class="input-group has-validation">
                    <span class="input-group-text bg-white">@</span>
                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username Anda" value="<?= $du['username']; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-lg" id="fullname" name="fullname" placeholder="Nama Lengkap Anda" value="<?= $du['fullname']; ?>">
            </div>
            <div class=" col-sm-6">
                <input type="text" class="form-control form-control-lg" id="telp" name="telp" placeholder="Nomor Telp Anda" value="<?= $du['telp']; ?>">
            </div>

            <div class="col-12">
                <input type="email" class="form-control form-control-lg bg-white" id="email" name="email" placeholder="Email Anda" value="<?= $results[0]->secret; ?>" disabled>
            </div>

            <div class="row fixed-bottom p-3 px-4">
                <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>