<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="container pt-3">
    <div class="row g-3 px-3">
        <div class="col-12">
            <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control form-control-lg" id="username" placeholder="Username" required="">
            </div>
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-lg" placeholder="Name" value="" required="">
        </div>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-lg" placeholder="telp" value="" required="">
        </div>

        <div class="col-12">
            <input type="email" class="form-control form-control-lg" id="email" placeholder="email@example.com">
        </div>
    </div>
    <div class="row fixed-bottom p-3 px-4">
        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;">Simpan</button>
    </div>
</div>
<?= $this->endSection(); ?>