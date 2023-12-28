<?= $this->extend('dashboard/dashboard') ?>
<?= $this->section('page-content') ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Marketplace</h1>
<!-- DataTales Example -->

<?= $this->section('custom_head') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/maps/leaflet.css" />
<script src="<?= base_url(); ?>assets/maps/leaflet.js"></script>
<style>
    #map {
        height: 400px;
        width: 100%;
    }

    .leaflet-control-attribution {
        display: none;
    }

    .button-container {
        position: absolute;
        margin-left: 320px;
        z-index: 1000;
        border-radius: 50% !important;
        /* Mengatur elemen menjadi bentuk bulat */
        top: 1080px;
    }

    #getLocationBtn {
        border-radius: 50%;
        /* Mengatur tombol menjadi bentuk bulat */

    }
</style>
<?= $this->endSection(); ?>
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
                                    <a role="button" id="getLocationButton" class="btn btn-outline-danger border-0 shadow-sm" onclick="getLocation()">Klik Lokasi Terkini</a>
                                </div>
                                <input type="text" placeholder="Latitude" name="latitude" id="latitude" value="<?= (old('latitude')) ? old('latitude') : $t['latitude']; ?>" class="form-control border-0 shadow-sm" readonly>
                                <input type="text" placeholder="Longitude" name="longitude" id="longitude" value="<?= (old('longitude')) ? old('longitude') : $t['longitude']; ?>" class="form-control border-0 shadow-sm" readonly>
                            </div>
                            <span class="text-danger"><?= (validation_show_error('latitude') || validation_show_error('longitude')) ? 'Lokasi Harus diisi.' : ''; ?></span>
                        </div>
                        <div class="col-12">
                            <div id="map"></div>
                            <div class="button-container">
                                <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger"><i class="bi bi-geo-alt-fill"></i></button>
                            </div>
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
                                    <input class="form-control <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-1'; ?> " placeholder="Nomor Telepon Utama..." name="telp" id="telp" value="<?= (old('telp')) ? old('telp') : $t['telp'];  ?>" onkeypress="return isNumber(event, 'telpError');">
                                    <div class="invalid-feedback"><?= validation_show_error('telp'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control border-1" placeholder="Nomor Telepon Alternatif (Optional)" name="telp2" value="<?= (old('telp2')) ? old('telp2') : $t['telp2']; ?>" onkeypress="return isNumber(event);">
                                    <div class="invalid-feedback"><?= validation_show_error('telp2'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 mx-3 my-3">
                                    <input class="form-control <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-1'; ?>" placeholder="Kode Pos" name="zip_code" id="zip_code" value="<?= (old('zip_code')) ? old('zip_code') : $t['zip_code']; ?>" onkeypress="return isNumber(event, 'zipcodeError');">
                                    <div class="invalid-feedback"><?= validation_show_error('zip_code'); ?></div>
                                </div>
                                <div class="mb-3 mx-3 my-3">
                                    <select class="form-control <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-1'; ?>" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                        <option value="<?= $t['id_province']; ?>"><?= $t['province']; ?></option>
                                        <?php foreach ($provinsi as $p) : ?>
                                            <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= validation_show_error('id_province'); ?></div>
                                </div>

                                <div class="mb-3 mx-3 my-3">
                                    <select class="form-control <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-1'; ?>" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                        <option value="<?= $t['id_city']; ?>"><?= $t['city']; ?></option>
                                    </select>
                                    <div class="invalid-feedback"><?= validation_show_error('id_city'); ?></div>
                                </div>
                                <input type="hidden" class="form-control border-0 shadow-sm" id="inputProvinsi" value="<?= (old('provinsi')) ? old('provinsi') : $t['province']; ?>" name="provinsi">
                                <input type="hidden" class="form-control border-0 shadow-sm" id="inputKabupaten" value="<?= (old('kabupaten')) ? old('kabupaten') : $t['city']; ?>" name="kabupaten">

                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-1'; ?>" name="alamat_1" id="alamat_1" placeholder="Alamat Lengkap Market (Cth : Nama Jalan, Nomor, atau Blok)" id="floatingTextarea2" style="height: 100px"><?= (old('alamat_1')) ? old('alamat_1') : $t['alamat_1']; ?></textarea>
                                    <div class="invalid-feedback"><?= validation_show_error('alamat_1'); ?></div>
                                </div>
                                <div class=" mb-3 mx-3 my-3">
                                    <textarea class="form-control border-1" name="detail-alamat" placeholder="Patokan Alamat Market (Optional)" id="patokan" style="height: 100px"><?= (old('detail-alamat')) ? old('detail-alamat') : $t['alamat_2']; ?></textarea>
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
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    var latOld = '';
    var lonOld = '';
    <?php if ($t['latitude'] && $t['longitude']) : ?>
        var map = L.map('map', {
            center: [<?= $t['latitude']; ?>, <?= $t['longitude']; ?>],
            zoom: 30,
            layers: [L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')],
        });
        latOld = '<?= $t['latitude']; ?>';
        lonOld = '<?= $t['longitude']; ?>';
        L.marker([latOld, lonOld]).addTo(map)
            .bindPopup('<?= $t['alamat_1']; ?>').openPopup();
    <?php else : ?>
        var map = L.map('map', {
            center: [-6.175247, 106.8270488],
            zoom: 13,
            layers: [L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]
        });

    <?php endif; ?>

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        console.log('Latitude:', lat);
        console.log('Longitude:', lon);

        // Clear all previous markers
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });

        // Add a new marker with a popup showing the full address
        L.marker([lat, lon]).addTo(map)
            .bindPopup('Loading address...').openPopup();

        // Perform reverse geocoding to get the full address
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
            .then(response => response.json())
            .then(data => {
                var address = data.display_name;
                // Update the popup with the full address
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        layer.getPopup().setContent('You are here: ' + address).openPopup();
                        $("#alamat_3").val(address);
                        $("#latitude").val(lat);
                        $("#longitude").val(lon);
                    }
                });
            })
            .catch(error => console.error('Error fetching address:', error));

        map.setView([lat, lon], 20);
    }

    var popup = L.popup();

    function onMapClick(e) {
        var lat = e.latlng.lat.toFixed(7);
        var lon = e.latlng.lng.toFixed(7);
        console.log('Latitude:', lat);
        console.log('Longitude:', lon);
        // Clear all previous markers
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });

        // Add a new marker with a popup showing the full address
        L.marker(e.latlng).addTo(map)
            .bindPopup('Loading address...').openPopup();

        // Perform reverse geocoding to get the full address
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
            .then(response => response.json())
            .then(data => {
                var address = data.display_name;
                // Update the popup with the full address
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        layer.getPopup().setContent('You clicked here: ' + address).openPopup();
                        $("#alamat_3").val(address);
                        $("#latitude").val(e.latlng.lat);
                        $("#longitude").val(e.latlng.lng);
                    }
                });
            })
            .catch(error => console.error('Error fetching address:', error));
    }

    map.on('click', onMapClick);

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