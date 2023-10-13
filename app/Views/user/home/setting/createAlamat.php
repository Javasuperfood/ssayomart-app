<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<?php
// Mendeteksi User-Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'];
// Menentukan apakah pengguna menggunakan perangkat seluler (misalnya, smartphone atau tablet)
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobiler -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container d-md-none">
            <div class="row">
                <form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3">
                    <?= csrf_field(); ?>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" name="label" id="label_alamat" value="<?= old('label') ?>">
                            <label for="floatingInput"><?= lang('Text.label_alamat') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('nama_penerima')) ? 'is-invalid' : '' ?>" name="nama_penerima" id="nama_penerima" value="<?= old('nama_penerima') ?>">
                            <label for="floatingInput"><?= lang('Text.nama_penerima') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control shadow-sm floatingInput <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0' ?>" name="no_telp1" id="no_telp1" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event)">
                            <label for=" floatingInput"><?= lang('Text.no_telp_alamat') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="no_telp2" value="<?= old('no_telp2') ?>" onkeypress="return isNumber(event)">
                            <label for=" floatingInput"><?= lang('Text.no_telp_alamat') ?><span class="text-danger"> <?= lang('Text.optional') ?></span></label>
                            <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <select class="form-select <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                <option selected></option>
                                <?php foreach ($provinsi as $p) : ?>
                                    <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="provinsi"><?= lang('Text.provinsi') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('id_province') ?></div>
                        </div>
                    </div>

                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <select class="form-select <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                <option selected></option>
                            </select>
                            <label for="kabupaten"><?= lang('Text.kab_kota') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('id_city') ?></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi">
                    <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten">

                    <div class=" mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" id="zip_code" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event)">
                            <label for=" floatingInput"><?= lang('Text.zipcode') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('zip_code') ?></div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" id="alamat_1" value="<?= old('alamat_1') ?>">
                            <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="invalid-feed"><?= validation_show_error('alamat_1') ?></div>
                        </div>
                    </div>
                    <div class="mb-3 mx-3 my-3">
                        <div class="form-floating">
                            <input class="form-control border-0 shadow-sm floatingInput <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" value="<?= old('alamat_2') ?>">
                            <label for=" floatingInput"><?= lang('Text.patokan_alamat') ?><span class="text-danger"> (optional)</span></label>
                            <span id="patokanError" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row p-3 px-4">
                        <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff;"><?= lang('Text.btn_simpan') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <!-- end mobile -->

    <!-- dekstop -->
    <div id="desktopContent" style="margin-top:100px;">
        <div class="container d-none d-md-block">
            <div class="card px-3 py-3 border-0 shadow">
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <p><?= lang('Text.title_alamat') ?></p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        <?= lang('Text.subtitle_alamat') ?>
                    </figcaption>
                </figure>
                <!-- form -->
                <form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3 row g-3 mt-4 mx-3 my-3" onsubmit="return validasiTambahAlamat()">
                    <?= csrf_field(); ?>
                    <div class="form-floating col-md-6">
                        <input class="form-control <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="label" id="label_alamat" value="<?= old('label') ?>">
                        <label for="floatingInput"><?= lang('Text.label_alamat') ?><span style="color: red"> *</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                    </div>
                    <div class="form-floating col-md-6">
                        <input class="form-control shadow-sm <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?>" name="nama_penerima" id="nama_penerima" value="<?= old('nama_penerima') ?>">
                        <label for="nama_penerima"><?= lang('Text.nama_penerima') ?><span style="color: red"> *</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                    </div>
                    <div class="form-floating col-md-6">
                        <input class="form-control shadow-sm <?= validation_show_error('telp') ? 'is-invalid' : 'border-0'; ?>" name="no_telp1" id="no_telp1" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event);">
                        <label for=" no_telp1"><?= lang('Text.no_telp_alamat') ?><span style="color: red"> *</span></label>
                        <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                    </div>
                    <div class="form-floating col-md-6">
                        <input class="form-control shadow-sm <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?>" name="no_telp2" value="<?= old('no_telp2') ?>" onkeypress="return isNumber(event);">
                        <label for="no_telp2"><?= lang('Text.no_telp_alamat') ?><span style="color: red"> <?= lang('Text.optional') ?></span></label>
                        <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                    </div>
                    <!-- dropdown -->
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                <option selected></option>
                                <?php foreach ($provinsi as $p) : ?>
                                    <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="provinsi"><?= lang('Text.provinsi') ?><span style="color: red"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('id_province') ?></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                <option selected></option>
                            </select>
                            <label for="kabupaten"><?= lang('Text.kab_kota') ?><span style="color: red"> *</span></label>
                            <div class="invalid-feedback"><?= validation_show_error('id_city') ?></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi">
                    <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten">
                    <!-- end dropdown -->
                    <div class="form-floating col-md-6">
                        <input class="form-control border-0 shadow-sm <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" id="alamat_1" value="<?= old('alamat_1') ?>">
                        <label for=" alamat_1"><?= lang('Text.detail_alamat') ?><span style="color: red"> *</span></label>
                        <span id="detailError" class="text-danger"></span>
                    </div>
                    <div class="form-floating col-md-6">
                        <input class="form-control border-0 shadow-sm <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" value="<?= old('alamat_2') ?>">
                        <label for=" alamat_2"><?= lang('Text.patokan_alamat') ?><span style="color: red"> *</span></label>
                        <span id="patokanError" class="text-danger"></span>
                    </div>
                    <div class="form-floating col-md-6">
                        <input class="form-control border-0 shadow-sm <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" id="zip_code" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event);">
                        <label for="zip_code"><?= lang('Text.zipcode') ?><span style="color: red"> *</span></label>
                        <span id="kodePosError" class="text-danger"></span>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg" style="background-color: #ec2614; color: #fff;"><?= lang('Text.btn_simpan') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- end desktop -->


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