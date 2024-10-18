<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>

<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Tablet') !== false);
?>

<!-- mobile -->
<?php if ($isMobile) : ?>
    <div id="mobileContent">
        <div class="container">
            <form onsubmit="playPreloaderEvent()" action="<?= base_url() ?>setting/update-alamat/edit-alamat/<?= $au['id_alamat_users']; ?>" method="post" class="pt-3">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_user" value="<?= $au['id_user']; ?>">
                <div class="container text-secondary" style="font-size: 12px;">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="input-group rounded-5 shadow-sm ">
                                <input type="text" id="searchAddress" class="form-control  border-0 rounded-start-5" placeholder="Cari Alamat" />
                                <button type="button" id="searchBtn" class="btn btn-white  border-0 rounded-end-5"><i class="bi bi-search text-danger"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div id="map" class="rounded-3"></div>
                            <div class="button-container">
                                <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger rounded-3"><i class="bi bi-crosshair"></i> Get Location</button>
                            </div>
                        </div>

                        <div class="col-12" style="font-size: 12px;">
                            <p class="text-danger" style="font-size: 11px;"><?= lang('Text.info_alamat') ?></p>
                            <label for=" floatingInput"><?= lang('Text.detail_alamat') ?><span class="text-danger fs-5"> *</span></label>
                            <div class="input-group">
                                <input list="alamat_3_option" class="form-control floatingInput <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= $au['alamat_3']; ?>" readonly>
                                <!-- <button class="btn btn-danger" type="button" id="button_alamat_3" onclick="getLatLongOnEvent()">Search</button> -->
                            </div>
                            <div class="invalid-feedback"><?= validation_show_error('alamat_3') ?></div>
                            <input type="hidden" id="latitude" name="latitude" value="<?= $au['latitude']; ?>">
                            <input type="hidden" id="longitude" name="longitude" value="<?= $au['longitude']; ?>">
                            <datalist id="alamat_3_option">
                                <!-- this option -->
                            </datalist>
                        </div>
                    </div>

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
                                <input class="form-control floatingInput <?= (validation_show_error('telp2')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="telp2" name="no_telp2" style="font-size: 14px;" value="<?= $au['telp2']; ?>" onkeypress="return isNumber(event);">
                                <div class="invalid-feedback"><?= validation_show_error('telp2') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="provinsi" class="form-label"><?= lang('Text.provinsi') ?><span class="text-danger"> <?= lang('Text.optional') ?></span></label>
                                <input class="form-control floatingInput <?= (validation_show_error('provinsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="provinsi" name="provinsi" style="font-size: 14px;" value="<?= $au['province']; ?>" readonly>
                                <div class="invalid-feedback"><?= validation_show_error('provinsi') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="kabupaten" class="form-label"><?= lang('Text.kab_kota') ?><span class="text-danger"> <?= lang('Text.optional') ?></span></label>
                                <input class="form-control floatingInput <?= (validation_show_error('kabupaten')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kabupaten" name="kabupaten" style="font-size: 14px;" value="<?= $au['city']; ?>" readonly>
                                <div class="invalid-feedback"><?= validation_show_error('kabupaten') ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- GET ALAMAT RAJAONGKIR DON'T DELETE! -->
                    <!-- <div class="row">
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
                    <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten" value="<?= $au['city']; ?>"> -->

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
                <div class="row">
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
            height: 250px;
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
                            <div class="input-group">
                                <input list="alamat_3_option" class="form-control <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= old('alamat_3') ?>" aria-describedby="button_alamat_3">
                                <button class="btn btn-danger" type="button" id="button_alamat_3" onclick="getLatLongOnEvent()">Search</button>
                            </div>
                            <input type="hidden" id="latitude" pattern="-?\d+(\.\d{1,6})?" name="latitude">
                            <input type="hidden" id="longitude" pattern="-?\d+(\.\d{1,6})?" name="longitude">
                            <datalist id="alamat_3_option">
                                <!-- this option -->
                            </datalist>
                        </div>
                        <div class="invalid-feedback"><?= validation_show_error('alamat_3') ?></div>
                    </div>
                    <div class="col-12">
                        <p class="text-center text-danger">*Pastikan titik lokasi sesuai dengan titik yang ditunjukkan. (diperlukan untuk pengiriman melalui GoSend)</p>
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
            top: 1080px;
        }

        #getLocationBtn {
            border-radius: 50%;

        }
    </style>
<?php endif; ?>
<!-- end Desktop -->

<script>
    function isNumber(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode < 48 || charCode > 57)
            return false;
        return true;
    }

    let csrfTokenName = '<?= csrf_token() ?>';
    let csrfHash = '<?= csrf_hash() ?>';

    function updateCsrfToken(data) {
        if (data.csrf) {
            csrfTokenName = data.csrf.token;
            csrfHash = data.csrf.hash;

            // Cari input hidden CSRF di form dan perbarui nilainya
            const csrfInput = document.querySelector('input[name="' + csrfTokenName + '"]');
            if (csrfInput) {
                csrfInput.value = csrfHash;
            } else {
                // Jika input CSRF tidak ditemukan, tambahkan ke form
                const form = document.querySelector('form');
                const newCsrfInput = document.createElement('input');
                newCsrfInput.type = 'hidden';
                newCsrfInput.name = csrfTokenName;
                newCsrfInput.value = csrfHash;
                form.prepend(newCsrfInput);
            }
        }
    }

    // Event Listener untuk Tombol Cari Alamat
    document.getElementById('searchBtn').addEventListener('click', function() {
        var address = document.getElementById('searchAddress').value;
        if (address.trim() === "") {
            alert("Silakan masukkan alamat yang ingin dicari.");
            return;
        }
        searchAddress(address);
    });

    // Fungsi untuk mencari alamat melalui AJAX
    function searchAddress(address) {
        fetch(`<?= base_url('setting/searchAddress') ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfHash
                },
                body: JSON.stringify({
                    address: address
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    var lat = data.data.lat;
                    var lon = data.data.lon;
                    var displayName = data.data.display_name;
                    updateMap(lat, lon, 18, 'search');

                    // Perbarui CSRF token setelah berhasil mencari alamat
                    updateCsrfToken(data);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error searching address:', error);
                alert('Terjadi kesalahan saat mencari alamat.');
            });
    }

    // Fungsi untuk mendapatkan lokasi pengguna
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Fungsi untuk menangani error geolocation
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }

    // Fungsi untuk menampilkan posisi pengguna
    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        updateMap(lat, lon);
    }

    var popup = L.popup();

    // Fungsi untuk menangani klik di peta
    function onMapClick(e) {
        var lat = e.latlng.lat.toFixed(7);
        var lon = e.latlng.lng.toFixed(7);
        updateMap(lat, lon);
    }

    // Fungsi untuk mengupdate peta berdasarkan koordinat
    function updateMap(lat, lon, zoom = null, from = null) {
        console.log('Updating map with lat:', lat, 'lon:', lon);

        // Clear semua marker sebelumnya
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });

        // Tambahkan marker baru dengan popup "Loading address..."
        L.marker([lat, lon]).addTo(map)
            .bindPopup('Loading address...').openPopup();

        // Reverse geocoding menggunakan LocationIQ
        var apiKey = 'pk.bc006a911b504a62570595da46aaed0b'; // Ganti dengan API Key LocationIQ Anda
        fetch(`https://us1.locationiq.com/v1/reverse.php?key=${apiKey}&lat=${lat}&lon=${lon}&format=json&accept-language=id`)
            .then(response => response.json())
            .then(data => {
                var address = data.display_name;
                var addressComponents = data.address;
                var province = addressComponents.state;
                var idProvince = addressComponents.state;
                var city = addressComponents.city || addressComponents.county;
                var postalCode = addressComponents.postcode;
                var detailAddress = addressComponents.road || addressComponents.neighbourhood || '';

                document.getElementById('provinsi').value = province;;
                document.getElementById('kabupaten').value = city;
                document.getElementById('zip_code').value = postalCode;
                document.getElementById('alamat_1').value = detailAddress;

                // Update popup dengan alamat lengkap
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        layer.getPopup().setContent('You are in : ' + address).openPopup();
                        if (from === 'search') {
                            document.getElementById('alamat_3').value = address;
                            document.getElementById('latitude').value = lat;
                            document.getElementById('longitude').value = lon;
                        }
                    }
                });

                // Set view peta ke lokasi baru
                if (zoom != null) {
                    map.setView([lat, lon], zoom);
                } else {
                    map.setView([lat, lon], 18);
                }
            })
            .catch(error => {
                console.error('Error fetching address:', error);
                // Update popup dengan pesan error
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        layer.getPopup().setContent('Tidak dapat mengambil alamat.').openPopup();
                    }
                });
            });
    }
    var map;
    <?php if ($au['latitude'] && $au['longitude']) : ?>
        map = L.map('map', {
            center: [<?= $au['latitude']; ?>, <?= $au['longitude']; ?>],
            zoom: 13,
            layers: [L.tileLayer('https://{s}-tiles.locationiq.com/v2/streets/r/{z}/{x}/{y}.png?key=pk.bc006a911b504a62570595da46aaed0b')],
        });
        L.marker([<?= $au['latitude']; ?>, <?= $au['longitude']; ?>]).addTo(map)
            .bindPopup('<?= $au['alamat_3']; ?>').openPopup();
    <?php else : ?>
        map = L.map('map', {
            center: [-6.175247, 106.8270488], // Default Jakarta
            zoom: 13,
            layers: [L.tileLayer('https://{s}-tiles.locationiq.com/v2/streets/r/{z}/{x}/{y}.png?key=pk.bc006a911b504a62570595da46aaed0b')]
        });
    <?php endif; ?>
    document.getElementById('getLocationBtn').addEventListener('click', getLocation);
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

    function playPreloaderEvent(event) {}
</script>


<?= $this->endSection(); ?>
<?= $this->section('custom_head') ?>
<link rel="stylesheet" href="<?= base_url(); ?>assets/maps/leaflet.css" />
<script src="<?= base_url(); ?>assets/maps/leaflet.js"></script>
<?= $this->endSection(); ?>