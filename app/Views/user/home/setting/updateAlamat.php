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
        <div class="container">
            <form action="<?= base_url() ?>setting/update-alamat/edit-alamat/<?= $au['id_alamat_users']; ?>" method="post" class="pt-3">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_user" value="<?= $au['id_user']; ?>">

                <div class="container text-secondary" style="font-size: 12px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="label" class="form-label"><?= lang('Text.label_alamat') ?><span class="text-danger fs-5"> *</span></label>
                                <input class="form-control floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="label" name="label" style="font-size: 14px;" value="<?= $au['label']; ?>">
                                <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nama_penerima" class="form-label"><?= lang('Text.nama_penerima') ?><span class="text-danger fs-5"> *</span></label>
                                <input class="form-control floatingInput <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="penerima" name="penerima" style="font-size: 14px;" value="<?= $au['penerima']; ?>">
                                <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="telp" class="form-label"><?= lang('Text.no_telp_alamat') ?><span class="text-danger fs-5"> *</span></label>
                                <input class="form-control floatingInput <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="no_telp1" style="font-size: 14px;" value="<?= $au['telp']; ?>" onkeypress="return isNumber(event);">
                                <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="telp2" class="form-label"><?= lang('Text.no_telp_alamat2') ?><span class="text-danger"> <?= lang('Text.optional') ?></span></label>
                                <input class="form-control floatingInput <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp" name="no_telp2" style="font-size: 14px;" value="<?= $au['telp']; ?>" onkeypress="return isNumber(event);">
                                <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="provinsi"><?= lang('Text.provinsi') ?><span class="text-danger fs-5"> *</span></label>
                                <select class="form-select border-0 shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi" style="font-size: 14px;">
                                    <option selected value="<?= $au['id_province']; ?>"><?= $au['province']; ?></option>
                                    <?php foreach ($provinsi as $p) : ?>
                                        <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"><?= validation_show_error('id_province') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="kabupaten"><?= lang('Text.kab_kota') ?><span class="text-danger fs-5"> *</span></label>
                                <select class="form-select border-0 shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten" style="font-size: 14px;">
                                    <option selected value="<?= $au['id_city']; ?>"><?= $au['city']; ?></option>
                                </select>
                                <div class="invalid-feedback"><?= validation_show_error('id_city') ?></div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi" value="<?= $au['province']; ?>">
                    <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten" value="<?= $au['city']; ?>">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for=" floatingInput"><?= lang('Text.zipcode') ?><span class="text-danger fs-5"> *</span></label> 
                                <input class="form-control floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="zip_code" name="zip_code" style="font-size: 14px;" value="<?= $au['zip_code']; ?>" onkeypress="return isNumber(event);">
                                <div class="invalid-feedback"><?= validation_show_error('zip_code') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger fs-5"> *</span></label> 
                                <input class="form-control floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-0';; ?> shadow-sm" id="alamat_1" name="alamat_1" style="font-size: 14px;" value="<?= $au['alamat_1']; ?>">
                                <div class="invalid-feedback"><?= validation_show_error('alamat_1') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- detail alamat maps -->
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-12" style="font-size: 12px;">
                            <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger" style="font-size: 9px;"> (Lokasi maps *)</span></label>
                            <input list="alamat_3_option" class="form-control floatingInput <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= $au['alamat_3']; ?>" oninput="getLatLongOnEvent()">
                            <div class="invalid-feedback"><?= validation_show_error('alamat_3') ?></div>
                            <input type="hidden" id="latitude" name="latitude" value="<?= $au['latitude']; ?>">
                            <input type="hidden" id="longitude" name="longitude" value="<?= $au['longitude']; ?>">
                            <datalist id="alamat_3_option">
                                <!-- this option -->
                            </datalist>
                        </div>
                    </div>
                </div>
                <!-- maps -->
                <div class="mb-3 mx-3 my-3">
                    <div id="map"></div>
                    <div class="button-container">
                        <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger"><i class="bi bi-geo-alt-fill"></i></button>
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
    <!-- style maps -->
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        .leaflet-control-attribution {
            display: none;
        }

        .button-container {
            position: relative;
            margin-right: 10px;
            margin-left: 10px;
            z-index: 1000;
            top: -50px;
        }

        #getLocationBtn {
            border-radius: 50% !important;
        }
    </style>
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

                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3 mt-2">
                            <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger"> *</span></label>
                            <input list="alamat_3_option" class="form-control <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= old('alamat_3') ?>" oninput="getLatLongOnEvent()">
                            <input type="hidden" id="latitude" pattern="-?\d+(\.\d{1,6})?" name="latitude">
                            <input type="hidden" id="longitude" pattern="-?\d+(\.\d{1,6})?" name="longitude">
                            <datalist id="alamat_3_option">
                                <!-- this option -->
                            </datalist>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('alamat_3') ?></div>
                    </div>
                    <div class="col-12">
                        <div id="map"></div>
                        <div class="button-container">
                            <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger"><i class="bi bi-geo-alt-fill"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg" style="background-color: #ec2614; color: #fff;"><?= lang('Text.btn_simpan') ?></button>
                </div>
            </form>
        </div>
    </div>
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
<?php endif; ?>
<!-- end Desktop -->

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
    <?php if ($au['latitude'] && $au['longitude']) : ?>
        var map = L.map('map', {
            center: [<?= $au['latitude']; ?>, <?= $au['longitude']; ?>],
            zoom: 13,
            layers: [L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')],
        });
        latOld = '<?= $au['latitude']; ?>';
        lonOld = '<?= $au['longitude']; ?>';
        L.marker([latOld, lonOld]).addTo(map)
            .bindPopup('<?= $au['alamat_3']; ?>').openPopup();
    <?php else : ?>
        var map = L.map('map', {
            center: [-6.175247, 106.8270488],
            zoom: 13,
            layers: [L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]
        });

    <?php endif; ?>

    function getLatLongOnEvent() {
        var alamat = $('#alamat_3').val();
        if (alamat.length > 3) {
            fetch(`https://nominatim.openstreetmap.org/search?q=${alamat}&format=jsonv2`)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    console.log('Data from Nominatim API:', data);
                    $('#alamat_3_option').empty();
                    data.forEach(e => {
                        $('#alamat_3_option').append('<option value="' + e.display_name + '">' + e.display_name + '</option>');
                    });
                    updateMap(data[0].lat, data[0].lon, 15, 'event');
                })
                .catch(error => console.error('Error fetching address:', error));
        }
    }

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
                        if (from == 'event') {

                        } else {
                            $("#alamat_3").val(address);
                            $("#latitude").val(lat);
                            $("#longitude").val(lon);
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching address:', error));
        if (zoom != null) {
            map.setView([lat, lon], zoom);
        } else {
            map.setView([lat, lon], 18);
        }
    }

    var popup = L.popup();

    function onMapClick(e) {
        var lat = e.latlng.lat.toFixed(7);
        var lon = e.latlng.lng.toFixed(7);
        updateMap(lat, lon);
    }

    function updateMap(lat, lon, zoom = null, from = null) {
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
                        if (from == 'event') {

                        } else {
                            $("#alamat_3").val(address);
                            $("#latitude").val(lat);
                            $("#longitude").val(lon);
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching address:', error));
        if (zoom != null) {
            map.setView([lat, lon], zoom);
        } else {
            map.setView([lat, lon], 18);
        }
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
<?= $this->section('custom_head') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/maps/leaflet.css" />
<script src="<?= base_url(); ?>assets/maps/leaflet.js"></script>
<?= $this->endSection(); ?>