<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-none">
            <form action="<?= base_url() ?>setting/update-alamat/edit-alamat/<?= $au['id_alamat_users']; ?>" method="post" class="pt-3">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_user" value="<?= $au['id_user']; ?>">

                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="label" name="label" style="font-size: 14px;" value="<?= $au['label']; ?>">
                        <label for="floatingInput">Label*</label>
                        <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                    </div>
                </div>

                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="penerima" name="penerima" style="font-size: 14px;" value="<?= $au['penerima']; ?>">
                        <label for="floatingInput">Nama Penerima*</label>
                        <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                    </div>
                </div>
                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="no_telp1" style="font-size: 14px;" value="<?= $au['telp']; ?>" onkeypress="return isNumber(event);">
                        <label for="floatingInput">Nomor Handphone Penerima*</label>
                        <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                    </div>
                </div>
                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="no_telp2" style="font-size: 14px;" value="<?= $au['telp']; ?>" onkeypress="return isNumber(event);">
                        <label for="floatingInput">Nomor Handphone Penerima (Optional)</label>
                        <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                    </div>
                </div>
                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <select class="form-select border-0 shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi" style="font-size: 14px;">
                            <option selected value="<?= $au['id_province']; ?>"><?= $au['province']; ?></option>
                            <?php foreach ($provinsi as $p) : ?>
                                <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="provinsi">Provinsi</label>
                    </div>
                </div>
                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <select class="form-select border-0 shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten" style="font-size: 14px;">
                            <option selected value="<?= $au['id_city']; ?>"><?= $au['city']; ?></option>
                        </select>
                        <label for="kabupaten">Kota</label>
                    </div>
                </div>
                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="zip_code" name="zip_code" style="font-size: 14px;" value="<?= $au['zip_code']; ?>" onkeypress="return isNumber(event);">
                        <label for=" floatingInput">Kode Pos*</label>
                        <div class="invalid-feedback"><?= validation_show_error('zip_code') ?></div>
                    </div>
                </div>

                <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi" value="<?= $au['province']; ?>">
                <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten" value="<?= $au['city']; ?>">

                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-0';; ?> shadow-sm" id="alamat_1" name="alamat_1" style="font-size: 14px;" value="<?= $au['alamat_1']; ?>">
                        <label for=" floatingInput">Detail Alamat*</label>
                        <div class="invalid-feedback"><?= validation_show_error('alamat_1') ?></div>
                    </div>
                </div>
                <div class="mb-3 mx-3 my-3">
                    <div class="form-floating">
                        <input class="form-control floatingInput border-0 shadow-sm" id="alamat_2" name="alamat_2" style="font-size: 14px;" value="<?= $au['alamat_2']; ?>">
                        <label for=" floatingInput">Detail Alamat (optional)</label>
                    </div>
                </div>
                <div class="row p-3 px-4">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; font-size: 16px">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php else : ?>
    <!-- end mobile -->

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container py-3 d-none d-md-block">
            <figure class="text-center ">
                <blockquote class="blockquote">
                    <p> Update Alamat Pengiriman</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Edit alamat anda <cite title="Source Title">sebagai tujuan pengiriman</cite>
                </figcaption>
            </figure>

            <form action="<?= base_url() ?>setting/update-alamat/edit-alamat/<?= $au['id_alamat_users']; ?>" method="post" class="pt-3 row g-3 mt-4">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_user" value="<?= $au['id_user']; ?>">

                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="label" name="label" value="<?= $au['label']; ?>">
                        <label for="floatingInput">Label<span style="color: red">*</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="penerima" name="penerima" value="<?= $au['penerima']; ?>">
                        <label for="floatingInput">Nama Penerima<span style="color: red">*</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="no_telp1" value="<?= $au['telp']; ?>" onkeypress="return isNumber(event);">
                        <label for="floatingInput">Nomor Handphone Penerima<span style="color: red">*</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="no_telp2" value="<?= $au['telp']; ?>" onkeypress="return isNumber(event);">
                        <label for="floatingInput">Nomor Handphone Penerima (Optional)</label>
                        <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select border-0 shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi">
                            <option selected value="<?= $au['id_province']; ?>"><?= $au['province']; ?></option>
                            <?php foreach ($provinsi as $p) : ?>
                                <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="provinsi">Provinsi<span style="color: red">*</span></label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select border-0 shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                            <option selected value="<?= $au['id_city']; ?>"><?= $au['city']; ?></option>
                        </select>
                        <label for="kabupaten">Kota<span style="color: red">*</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="zip_code" name="zip_code" value="<?= $au['zip_code']; ?>" onkeypress="return isNumber(event);">
                        <label for=" floatingInput">Kode Pos<span style="color: red">*</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('zip_code') ?></div>
                    </div>
                </div>

                <input type="hidden" class="form-control floatingInput <?= (validation_show_error('provinsi')) ? 'is-invalid' : '' ?>" id="inputProvinsi" name="provinsi" value="<?= $au['province']; ?>">
                <input type="hidden" class="form-control floatingInput <?= (validation_show_error('kabupaten')) ? 'is-invalid' : '' ?>" id="inputKabupaten" name="kabupaten" value="<?= $au['city']; ?>">

                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="alamat_1" name="alamat_1" value="<?= $au['alamat_1']; ?>">
                        <label for=" floatingInput">Detail Alamat<span style="color: red">*</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('alamat_1') ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control floatingInput border-0 shadow-sm" id="alamat_2" name="alamat_2" value="<?= $au['alamat_2']; ?>">
                        <label for=" floatingInput">Detail Alamat (optional)</label>
                    </div>
                </div>
                <div class="row p-4 px-4">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg" style="background-color: #ec2614; color: #fff;">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<!-- end Desktop -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                html: alertData.message
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>