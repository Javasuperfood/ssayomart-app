<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Marketplace</h1>
<!-- DataTales Example -->


<form action="<?= base_url('dashboard/marketplace/store'); ?>" method="post">
    <?= csrf_field(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#deskripsi" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="deskripsi">
                    <h6 class="m-0 font-weight-bold text-danger">Deskripsi</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="deskripsi">
                    <div class="card-body">
                        <div class="text-danger pb-1">
                            <small><?= validation_show_error('deskripsi') ?></small>
                        </div>
                        <textarea class="form-control <?= (validation_show_error('deskripsi')) ? 'is-invalid' : ''; ?>" placeholder="Deskripsi Market" name="deskripsi" id="floatingTextarea2" style="height: 100px"><?= old('deskripsi'); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#Geo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="Geo">
                    <h6 class="m-0 font-weight-bold text-danger">Get localtion</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="Geo">
                    <div class="card-body">
                        <div class=" mb-3 mx-3 my-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <a role="button" id="getLocationButton" class="btn btn-outline-danger">Get localtion</a>
                                </div>
                                <input type="text" placeholder="Latitude" id="latitude" class="form-control" disabled>
                                <input type="text" placeholder="Longitude" id="longitude" class="form-control" disabled>
                                <input type="hidden" placeholder="Latitude" id="latitudeH" name="latitude" class="form-control">
                                <input type="hidden" placeholder="Longitude" id="longitudeH" name="longitude" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#alamat" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="alamat">
                    <h6 class="m-0 font-weight-bold text-danger">Alamat</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="alamat">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mx-3 my-3">
                                    <div class="text-danger pb-1">
                                        <small><?= validation_show_error('telp') ?></small>
                                    </div>
                                    <input class="form-control <?= (validation_show_error('telp')) ? 'is-invalid' : ''; ?>" placeholder="Telepon" name="telp" value="<?= old('telp') ?>" onkeypress="return isNumber(event);">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control" placeholder="Telepon 2" name="telp2" value="<?= old('telp2') ?>" onkeypress="return isNumber(event);">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 mx-3 my-3">
                                    <div class="text-danger pb-1">
                                        <small><?= validation_show_error('zip_code') ?></small>
                                    </div>
                                    <input class="form-control <?= (validation_show_error('zip_code')) ? 'is-invalid' : ''; ?>" placeholder="Kode Pos" name="zip_code" value="<?= old('telp') ?>" onkeypress="return isNumber(event);">
                                </div>
                                <div class="mb-3 mx-3 my-3">
                                    <div class="text-danger pb-1">
                                        <small><?= validation_show_error('provisi') ?></small>
                                    </div>
                                    <select class="form-control <?= (validation_show_error('provinsi')) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                        <option selected>Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $p) : ?>
                                            <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3 mx-3 my-3">
                                    <div class="text-danger pb-1">
                                        <small><?= validation_show_error('kabupaten') ?></small>
                                    </div>
                                    <select class="form-control <?= (validation_show_error('kabupaten')) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                        <option selected>Pilih Kota</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" id="inputProvinsi" name="provinsi">
                                <input type="hidden" class="form-control" id="inputKabupaten" name="kabupaten">

                                <div class=" mb-3 mx-3 my-3">
                                    <div class="text-danger pb-1">
                                        <small><?= validation_show_error('alamat_1') ?></small>
                                    </div>
                                    <textarea class="form-control <?= (validation_show_error('alamat_1')) ? 'is-invalid' : ''; ?>" name="alamat_1" placeholder="Alamat Market" id="floatingTextarea2" style="height: 100px"><?= old('alamat_1') ?></textarea>
                                </div>
                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control" name="detail-alamat" placeholder="Detail Alamat" id="floatingTextarea2" style="height: 100px"><?= old('detail-alamat') ?></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class=" mb-3 mx-3 my-3">
                                    <button type="submit" class="btn btn-danger form-control">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>


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