<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Marketplace</h1>
<!-- DataTales Example -->


<form action="<?= base_url(); ?>dashboard/marketplace/update" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_toko" value="<?= $t['id_toko']; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mb-4">
                <!-- Card Header - Accordion -->
                <a href="#deskripsi" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="deskripsi">
                    <h6 class="m-0 font-weight-bold text-danger">Deskripsi</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="deskripsi">
                    <div class="card-body">
                        <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" placeholder="Deskripsi Market..." name="deskripsi" id="deskripsivalid" style="height: 100px"><?= (old('deskripsi')) ? old('deskripsi') : $t['deskripsi']; ?></textarea>
                        <div class="invalid-feedback"><?= validation_show_error('deskripsi'); ?></div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <!-- Card Header - Accordion -->
                <a href="#Geo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="Geo">
                    <h6 class="m-0 font-weight-bold text-danger">Dapatkan Lokasi</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="Geo">
                    <div class="card-body">
                        <div class=" mb-3 mx-3 my-3">
                            <div class="input-group" id="lokasi">
                                <div class="input-group-prepend">
                                    <a role="button" id="getLocationButton" class="btn btn-outline-danger border-0 shadow-sm">Klik Lokasi Terkini</a>
                                </div>
                                <input type="text" placeholder="Latitude" id="latitude" value="<?= (old('latitude')) ? old('latitude') : $t['latitude']; ?>" class="form-control border-0 shadow-sm" disabled>
                                <input type="text" placeholder="Longitude" id="longitude" value="<?= (old('longitude')) ? old('longitude') : $t['longitude']; ?>" class="form-control border-0 shadow-sm" disabled>
                                <input type="hidden" placeholder="Latitude" id="latitudeH" name="latitude" value="<?= (old('latitude')) ? old('latitude') : $t['latitude']; ?>" class="form-control border-0 shadow-sm">
                                <input type="hidden" placeholder="Longitude" id="longitudeH" value="<?= (old('longitude')) ? old('longitude') : $t['longitude']; ?>" name="longitude" class="form-control border-0 shadow-sm">
                            </div>
                            <span class="text-danger"><?= (validation_show_error('latitude') || validation_show_error('longitude')) ? 'Lokasi Harus diisi.' : ''; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm mb-4">
                <!-- Card Header - Accordion -->
                <a href="#alamat" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="alamat">
                    <h6 class="m-0 font-weight-bold text-danger">Data Marketplace</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="alamat">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" placeholder="Nomor Telepon Utama..." name="telp" id="telp" value="<?= (old('telp')) ? old('telp') : $t['telp'];  ?>" onkeypress="return isNumber(event, 'telpError');">
                                    <div class="invalid-feedback"><?= validation_show_error('telp'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" placeholder="Nomor Telepon Alternatif (Optional)" name="telp2" value="<?= (old('telp2')) ? old('telp2') : $t['telp2']; ?>" onkeypress="return isNumber(event);">
                                    <div class="invalid-feedback"><?= validation_show_error('telp2'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" placeholder="Kode Pos" name="zip_code" id="zip_code" value="<?= (old('zip_code')) ? old('zip_code') : $t['zip_code']; ?>" onkeypress="return isNumber(event, 'zipcodeError');">
                                    <div class="invalid-feedback"><?= validation_show_error('zip_code'); ?></div>
                                </div>
                                <div class="mb-3 mx-3 my-3">
                                    <select class="form-control <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                        <option value="<?= $t['id_province']; ?>"><?= $t['province']; ?></option>
                                        <?php foreach ($provinsi as $p) : ?>
                                            <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= validation_show_error('id_province'); ?></div>
                                </div>

                                <div class="mb-3 mx-3 my-3">
                                    <select class="form-control <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                        <option value="<?= $t['id_city']; ?>"><?= $t['city']; ?></option>
                                    </select>
                                    <div class="invalid-feedback"><?= validation_show_error('id_city'); ?></div>
                                </div>
                                <input type="hidden" class="form-control border-0 shadow-sm" id="inputProvinsi" value="<?= (old('provinsi')) ? old('provinsi') : $t['province']; ?>" name="provinsi">
                                <input type="hidden" class="form-control border-0 shadow-sm" id="inputKabupaten" value="<?= (old('kabupaten')) ? old('kabupaten') : $t['city']; ?>" name="kabupaten">

                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="alamat_1" id="alamat_1" placeholder="Alamat Lengkap Market (Cth : Nama Jalan, Nomor, atau Blok)" id="floatingTextarea2" style="height: 100px"><?= (old('alamat_1')) ? old('alamat_1') : $t['alamat_1']; ?></textarea>
                                    <div class="invalid-feedback"><?= validation_show_error('alamat_1'); ?></div>
                                </div>
                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control border-0 shadow-sm" name="detail-alamat" placeholder="Patokan Alamat Market (Optional)" id="patokan" style="height: 100px"><?= (old('detail-alamat')) ? old('detail-alamat') : $t['alamat_2']; ?></textarea>
                                    <span id="patokanError" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class=" mb-3 mx-3 my-3">
                                    <button type="submit" class="btn btn-danger form-control border-0 shadow-sm">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->has('alert')) : ?>
            var alertData = <?= json_encode(session('alert')) ?>;
            Swal.fire({
                icon: alertData.type,
                title: alertData.title,
                text: alertData.message
            });
        <?php endif; ?>
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?= $this->include('user/home/component/rajaOngkir/service') ?>
<script>
    $(document).ready(function() {
        $("#getLocationButton").click(function() {
            if ("geolocation" in navigator) {
                // Browser mendukung geolocation
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Mendapatkan data lokasi pengguna
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);
                    $('#latitudeH').val(latitude);
                    $('#longitudeH').val(longitude);
                }, function(error) {
                    // Penanganan kesalahan jika permintaan geolocation ditolak atau gagal
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            console.log("Akses geolocation ditolak oleh pengguna.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            console.log("Informasi lokasi tidak tersedia.");
                            break;
                        case error.TIMEOUT:
                            console.log("Permintaan lokasi pengguna time out.");
                            break;
                        case error.UNKNOWN_ERROR:
                            console.log("Terjadi kesalahan yang tidak diketahui.");
                            break;
                    }
                });
            } else {
                // Browser tidak mendukung geolocation
                console.log("Browser Anda tidak mendukung geolocation.");
            }
        })
    });
</script>

<?= $this->endSection(); ?>