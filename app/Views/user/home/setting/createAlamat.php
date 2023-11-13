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
            <div class="row">
                <form action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3">
                    <?= csrf_field(); ?>
                    <div class="container text-secondary" style="font-size: 12px;">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="label" class="form-label"><?= lang('Text.label_alamat') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('label')) ? 'is-invalid' : '' ?>" name="label" id="label_alamat" style="font-size: 14px;" value="<?= old('label') ?>">
                                    <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nama_penerima" class="form-label"><?= lang('Text.nama_penerima') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('nama_penerima')) ? 'is-invalid' : '' ?>" name="nama_penerima" id="nama_penerima" style="font-size: 14px;" value="<?= old('nama_penerima') ?>">
                                    <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="telp" class="form-label"><?= lang('Text.no_telp_alamat') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control shadow-sm floatingInput <?= (validation_show_error('telp')) ? 'is-invalid' : 'border-0' ?>" name="no_telp1" id="no_telp1" style="font-size: 14px;" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event)">
                                    <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="telp2" class="form-label"><?= lang('Text.no_telp_alamat2') ?><span class="text-danger"> <?= lang('Text.optional') ?></span></label>
                                    <input class="form-control <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="no_telp2" style="font-size: 14px;" value="<?= old('no_telp2') ?>" onkeypress="return isNumber(event)">
                                    <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="provinsi"><?= lang('Text.provinsi') ?><span class="text-danger fs-5"> *</span></label>
                                    <select class="form-select <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi" style="font-size: 14px;">
                                        <option selected></option>
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
                                    <select class="form-select <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten" style="font-size: 14px;">
                                        <option selected></option>
                                    </select>
                                    <div class="invalid-feedback"><?= validation_show_error('id_city') ?></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi">
                        <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for=" floatingInput"><?= lang('Text.zipcode') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('zip_code')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" id="zip_code" style="font-size: 14px;" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event)">
                                    <div class="invalid-feedback"><?= validation_show_error('zip_code') ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('alamat_1')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" id="alamat_1" style="font-size: 14px;" value="<?= old('alamat_1') ?>">
                                    <div class="invalid-feed"><?= validation_show_error('alamat_1') ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for=" floatingInput"><?= lang('Text.patokan_alamat') ?><span class="text-danger"> (optional)</span></label>
                                    <input class="form-control border-0 shadow-sm floatingInput <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" style="font-size: 14px;" value="<?= old('alamat_2') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= old('alamat_3') ?>" readonly>
                                    <div class="invalid-feedback"><?= validation_show_error('alamat_3') ?></div>
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="map"></div>
                                <div class="button-container">
                                    <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger"><i class="bi bi-geo-alt-fill"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3 px-4">
                            <button type="submit" class="btn btn-lg fw-bold" style="background-color: #ec2614; color: #fff; font-size: 16px"><?= lang('Text.btn_simpan') ?></button>
                        </div>
                </form>
            </div>
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
            position: relative;
            margin-left: 10px;
            z-index: 1000;
            border-radius: 50% !important;
            /* Mengatur elemen menjadi bentuk bulat */
            bottom: 50px !important;

        }

        #getLocationBtn {
            border-radius: 50%;
            /* Mengatur tombol menjadi bentuk bulat */

        }

        @media screen and (max-width: 280px) {
            #map {
                height: 400px;
                width: 100%;
            }

            .leaflet-control-attribution {
                display: none;
            }

            .button-container {
                position: relative;
                margin-left: 5px;
                z-index: 1000;
                border-radius: 50% !important;
                /* Mengatur elemen menjadi bentuk bulat */
                bottom: 0px;
                margin-right: 10px;
            }

            #getLocationBtn {
                border-radius: 50%;
                /* Mengatur tombol menjadi bentuk bulat */

            }
        }
    </style>
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
                    <div class="form-group col-md-6">
                        <label for="floatingInput"><?= lang('Text.label_alamat') ?><span style="color: red"> *</span></label>
                        <input class="mt-2 form-control <?= (validation_show_error('label')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="label" id="label_alamat" value="<?= old('label') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('label') ?></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_penerima"><?= lang('Text.nama_penerima') ?><span style="color: red"> *</span></label>
                        <input class="mt-2 form-control shadow-sm <?= (validation_show_error('penerima')) ? 'is-invalid' : 'border-0'; ?>" name="nama_penerima" id="nama_penerima" value="<?= old('nama_penerima') ?>">
                        <div class="invalid-feedback"><?= validation_show_error('penerima') ?></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for=" no_telp1"><?= lang('Text.no_telp_alamat') ?><span style="color: red"> *</span></label>
                        <input class="mt-2 form-control shadow-sm <?= validation_show_error('telp') ? 'is-invalid' : 'border-0'; ?>" name="no_telp1" id="no_telp1" value="<?= old('no_telp1') ?>" onkeypress="return isNumber(event);">
                        <div class="invalid-feedback"><?= validation_show_error('telp') ?></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="no_telp2"><?= lang('Text.no_telp_alamat') ?><span style="color: red"> <?= lang('Text.optional') ?></span></label>
                        <input class="mt-2 form-control shadow-sm <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?>" name="no_telp2" value="<?= old('no_telp2') ?>" onkeypress="return isNumber(event);">
                        <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                    </div>
                    <!-- dropdown -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="provinsi"><?= lang('Text.provinsi') ?><span style="color: red"> *</span></label>
                            <select class="mt-2 form-select <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="provinsi" name="id_provinsi">
                                <option selected></option>
                                <?php foreach ($provinsi as $p) : ?>
                                    <option value="<?= $p->province_id; ?>"><?= $p->province; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= validation_show_error('id_province') ?></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="kabupaten"><?= lang('Text.kab_kota') ?><span style="color: red"> *</span></label>
                            <select class="mt-2 form-select <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" aria-label="Default select example" id="kabupaten" name="id_kabupaten">
                                <option selected></option>
                            </select>
                            <div class="invalid-feedback"><?= validation_show_error('id_city') ?></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi">
                    <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten">
                    <!-- end dropdown -->
                    <div class="form-group col-md-6">
                        <label for=" alamat_1"><?= lang('Text.detail_alamat') ?><span style="color: red"> *</span></label>
                        <input class="mt-2 form-control border-0 shadow-sm <?= (validation_show_error('alamat_1')) ? 'is-invalid' : '' ?>" name="alamat_1" id="alamat_1" value="<?= old('alamat_1') ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for=" alamat_2"><?= lang('Text.patokan_alamat') ?><span style="color: red"> <?= lang('Text.optional') ?></span></label>
                        <input class="mt-2 form-control border-0 shadow-sm <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" value="<?= old('alamat_2') ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zip_code"><?= lang('Text.zipcode') ?><span style="color: red"> *</span></label>
                        <input class="mt-2 form-control border-0 shadow-sm <?= (validation_show_error('zip_code')) ? 'is-invalid' : '' ?>" name="zip_code" id="zip_code" value="<?= old('zip_code') ?>" onkeypress="return isNumber(event);">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3 mt-2">
                                <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger"> *</span></label>
                                <input class="mt-2 form-control <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= old('alamat_3') ?>" readonly>
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
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
            margin-left: 10px;
            z-index: 1000;
            border-radius: 50% !important;
            /* Mengatur elemen menjadi bentuk bulat */
            bottom: 110px;
        }

        #getLocationBtn {
            border-radius: 50%;
            /* Mengatur tombol menjadi bentuk bulat */

        }
    </style>
<?php endif; ?>
<!-- end desktop -->


<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    var map = L.map('map', {
        center: [-6.175247, 106.8270488],
        zoom: 13,
        layers: [L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]
    });

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;

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

        map.setView([lat, lon], 15);
    }

    var popup = L.popup();

    function onMapClick(e) {
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
<?= $this->section('custom_head') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/maps/leaflet.css" />
<script src="<?= base_url(); ?>assets/maps/leaflet.js"></script>

<?= $this->endSection(); ?>