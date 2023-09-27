<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Marketplace</h1>
<!-- DataTales Example -->


<form action="<?= base_url('dashboard/marketplace/store'); ?>" onsubmit="return validasiMarketplace()" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
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
                        <textarea class="form-control border-0 shadow-sm <?= (validation_show_error('deskripsi')) ? 'is-invalid' : ''; ?>" placeholder="Deskripsi Market..." name="deskripsi" id="deskripsivalid" style="height: 100px"><?= old('deskripsi'); ?></textarea>
                        <span id="deskripsiError" class="text-danger"></span>
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
                                <input type="text" placeholder="Latitude" id="latitude" class="form-control border-0 shadow-sm" disabled>
                                <input type="text" placeholder="Longitude" id="longitude" class="form-control border-0 shadow-sm" disabled>
                                <input type="hidden" placeholder="Latitude" id="latitudeH" name="latitude" class="form-control border-0 shadow-sm">
                                <input type="hidden" placeholder="Longitude" id="longitudeH" name="longitude" class="form-control border-0 shadow-sm">
                            </div>
                            <span id="latitudeError" class="text-danger"></span>
                            <span id="longitudeError" class="text-danger"></span>
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
                                    <input class="form-control border-0 shadow-sm" placeholder="Nomor Telepon Utama..." name="telp" id="telp" value="<?= old('telp') ?>" onkeypress="return isNumber(event, 'telpError');">
                                    <span id="telpError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control border-0 shadow-sm" placeholder="Nomor Telepon Alternatif (Optional)" name="telp2" value="<?= old('telp2') ?>" onkeypress="return isNumber(event);">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control border-0 shadow-sm" placeholder="Kode Pos" name="zip_code" id="zip_code" value="<?= old('zip_kode') ?>" onkeypress="return isNumber(event, 'zipcodeError');">
                                    <span id="zipcodeError" class="text-danger"></span>
                                </div>
                                <div class="mb-3 mx-3 my-3">
                                    <select class="form-control border-0 shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                        <option selected>Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $p) : ?>
                                            <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span id="provinsiError" class="text-danger"></span>
                                </div>

                                <div class="mb-3 mx-3 my-3">
                                    <select class="form-control border-0 shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                        <option selected>Pilih Kota</option>
                                    </select>
                                    <span id="kabupatenError" class="text-danger"></span>
                                </div>
                                <input type="hidden" class="form-control border-0 shadow-sm" id="inputProvinsi" name="provinsi">
                                <input type="hidden" class="form-control border-0 shadow-sm" id="inputKabupaten" name="kabupaten">

                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control border-0 shadow-sm" name="alamat_1" id="alamat_1" placeholder="Alamat Lengkap Market (Cth : Nama Jalan, Nomor, atau Blok)" id="floatingTextarea2" style="height: 100px"><?= old('alamat_1') ?></textarea>
                                    <span id="alamatError" class="text-danger"></span>
                                </div>
                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control border-0 shadow-sm" name="detail-alamat" placeholder="Patokan Alamat Market (Optional)" id="patokan" style="height: 100px"><?= old('detail-alamat') ?></textarea>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?= $this->include('user/home/component/rajaOngkir/service') ?>
<script>
    //Validasi Form
    function validasiMarketplace() {
        var isValid = true;

        var deskripsiField = document.getElementById('deskripsivalid');
        var telpField = document.getElementById('telp');
        var zipcodeField = document.getElementById('zip_code');
        var provinsiField = document.getElementById('inputProvinsi');
        var kabupatenField = document.getElementById('inputKabupaten');
        var alamatField = document.getElementById('alamat_1');
        var patokanField = document.getElementById('patokan');
        var latitudeField = document.getElementById('latitude');
        var longitudeField = document.getElementById('longitude');

        var deskripsiError = document.getElementById('deskripsiError');
        var telpError = document.getElementById('telpError');
        var zipcodeError = document.getElementById('zipcodeError');
        var provinsiError = document.getElementById('provinsiError');
        var kabupatenError = document.getElementById('kabupatenError');
        var alamatError = document.getElementById('alamatError');
        var patokanError = document.getElementById('patokanError');
        var latitudeError = document.getElementById('latitudeError');
        var longitudeError = document.getElementById('longitudeError');

        deskripsiError.textContent = '';
        telpError.textContent = '';
        zipcodeError.textContent = '';
        provinsiError.textContent = '';
        kabupatenError.textContent = '';
        alamatError.textContent = '';
        patokanError.textContent = '';
        latitudeError.textContent = '';
        longitudeError.textContent = '';

        if (deskripsiField.value.trim() === '') {
            deskripsiField.classList.add('invalid-field');
            deskripsiError.textContent = 'Deskripsi Cabang atau Market harus diisi';
            isValid = false;
        } else {
            deskripsiField.classList.remove('invalid-field');
        }

        if (telpField.value.trim() === '') {
            telpField.classList.add('invalid-field');
            telpError.textContent = 'Nomor Telpon Cabang atau Market harus diisi';
            isValid = false;
        } else {
            telpField.classList.remove('invalid-field');
            telpError.textContent = ''; // Menghapus pesan kesalahan jika sudah valid
        }

        if (zipcodeField.value.trim() === '') {
            zipcodeField.classList.add('invalid-field');
            zipcodeError.textContent = 'Kode Pos Cabang atau Market harus diisi';
            isValid = false;
        } else {
            zipcodeField.classList.remove('invalid-field');
            zipcodeError.textContent = ''; // Menghapus pesan kesalahan jika sudah valid
        }

        if (provinsiField.value.trim() === '') {
            provinsiField.classList.add('invalid-field');
            provinsiError.textContent = 'Provinsi Cabang atau Market harus diisi';
            isValid = false;
        } else {
            provinsiField.classList.remove('invalid-field');
        }

        if (kabupatenField.value.trim() === '') {
            kabupatenField.classList.add('invalid-field');
            kabupatenError.textContent = 'Kabupaten Cabang atau Market harus diisi';
            isValid = false;
        } else {
            kabupatenField.classList.remove('invalid-field');
        }

        if (alamatField.value.trim() === '') {
            alamatField.classList.add('invalid-field');
            alamatError.textContent = 'Alamat Lengkap Cabang atau Market harus diisi';
            isValid = false;
        } else {
            alamatField.classList.remove('invalid-field');
        }

        if (patokanField.value.trim() === '') {
            patokanField.classList.add('invalid-field');
            patokanError.textContent = 'Patokan Alamat Cabang atau Market harus diisi';
            isValid = false;
        } else {
            patokanField.classList.remove('invalid-field');
        }

        if (latitudeField.value.trim() === '' || longitudeField.value.trim() === '') {
            latitudeField.classList.add('invalid-field');
            longitudeField.classList.add('invalid-field');
            latitudeError.textContent = 'Lokasi harus diisi.';
            isValid = false;
        } else {
            latitudeField.classList.remove('invalid-field');
            longitudeField.classList.remove('invalid-field');
        }

        return isValid;
    }


    // Event click untuk tombol "Klik Lokasi Terkini"
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
                        $('#latitudeError').text('Akses geolocation ditolak oleh pengguna.');
                        $('#longitudeError').text('Akses geolocation ditolak oleh pengguna.');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        console.log("Informasi lokasi tidak tersedia.");
                        $('#latitudeError').text('Informasi lokasi tidak tersedia.');
                        $('#longitudeError').text('Informasi lokasi tidak tersedia.');
                        break;
                    case error.TIMEOUT:
                        console.log("Permintaan lokasi pengguna time out.");
                        $('#latitudeError').text('Permintaan lokasi pengguna time out.');
                        $('#longitudeError').text('Permintaan lokasi pengguna time out.');
                        break;
                    case error.UNKNOWN_ERROR:
                        console.log("Terjadi kesalahan yang tidak diketahui.");
                        $('#latitudeError').text('Terjadi kesalahan yang tidak diketahui.');
                        $('#longitudeError').text('Terjadi kesalahan yang tidak diketahui.');
                        break;
                }
            });
        } else {
            // Browser tidak mendukung geolocation
            console.log("Browser Anda tidak mendukung geolocation.");
        }
    });
</script>

<?= $this->endSection(); ?>