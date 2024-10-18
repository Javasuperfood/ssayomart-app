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
                <form onsubmit="playPreloaderEvent()" action="<?= base_url() ?>setting/create-alamat/save-alamat" method="post" class="pt-3">
                    <?= csrf_field(); ?>
                    <div class="container text-secondary" style="font-size: 12px;">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="input-group rounded-5 shadow-sm">
                                    <input type="text" id="searchAddress" class="form-control border-0   rounded-start-5" placeholder="Cari Alamat" />
                                    <button type="button" id="searchBtn" class="btn btn-white border-0  rounded-end-5">
                                        <i class="bi bi-search text-danger"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="map" class="rounded-3"></div>
                                <div class="button-container">
                                    <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger rounded-3"><i class="bi bi-crosshair"></i> Get Location</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <p class="text-danger" style="font-size: 11px;"><?= lang('Text.info_alamat') ?></p>
                                    <label for=" floatingInput">
                                        <?= lang('Text.detail_alamat_2') ?><span class="text-danger fs-5"> *</span>
                                    </label>
                                    <div class="input-group ">
                                        <input list="alamat_3_option" class="form-control <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;" aria-describedby="button_alamat_3" readonly>
                                        <!-- <button class="btn btn-danger" type="button" id="button_alamat_3" onclick="getLatLongOnEvent()">Search</button> -->
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('alamat_3') ?>
                                    </div>
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                    <datalist id="alamat_3_option">
                                        <!-- this option -->
                                    </datalist>
                                </div>
                            </div>
                        </div>
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
                                    <label for=" floatingInput"><?= lang('Text.provinsi') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('provinsi')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('provinsi')) ? 'is-invalid' : '' ?>" name="provinsi" id="provinsi" style="font-size: 14px;" value="<?= old('provinsi') ?>" readonly>
                                    <div class="invalid-feedback"><?= validation_show_error('provinsi') ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for=" floatingInput"><?= lang('Text.kab_kota') ?><span class="text-danger fs-5"> *</span></label>
                                    <input class="form-control <?= (validation_show_error('kabupaten')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput <?= (validation_show_error('kabupaten')) ? 'is-invalid' : '' ?>" name="kabupaten" id="kabupaten" style="font-size: 14px;" value="<?= old('kabupaten') ?>" readonly>
                                    <div class="invalid-feedback"><?= validation_show_error('kabupaten') ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- GET ALAMAT RAJAONGKIR DON'T DELETE! -->
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="provinsi"><?= lang('Text.provinsi') ?><span class="text-danger fs-5"> *</span></label>
                                    <select class="form-select <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="provinsi" name="id_provinsi" style="font-size: 14px;">
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
                                    <select class="form-select <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kabupaten" name="id_kabupaten" style="font-size: 14px;">
                                        <option selected></option>
                                    </select>
                                    <div class="invalid-feedback"><?= validation_show_error('id_city') ?></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control floatingInput" id="inputProvinsi" name="provinsi">
                        <input type="hidden" class="form-control floatingInput" id="inputKabupaten" name="kabupaten"> -->
                        <!-- END -->

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
                                    <label for=" floatingInput"><?= lang('Text.patokan_alamat') ?><span class="text-danger"> <?= lang('Text.optional') ?></span></label>
                                    <input class="form-control border-0 shadow-sm floatingInput <?= (validation_show_error('alamat_2')) ? 'is-invalid' : '' ?>" name="alamat_2" id="alamat_2" style="font-size: 14px;" value="<?= old('alamat_2') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row p-3 px-4">
                            <button type="submit" class="btn fw-bold btn-outline-danger d-flex align-items-center">
                                <i class="bi bi-save"></i>
                                <span class="text-center mx-auto" style="font-size: 16px;"><?= lang('Text.btn_simpan') ?></span>
                            </button>
                        </div>

                </form>
            </div>
        </div>
    </div>
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
            margin-left: 10px;
            z-index: 1000;
            top: -50px !important;

        }
    </style>
<?php else : ?>
    <!-- end mobile -->
    <!-- dekstop -->
    <div id=" desktopContent" style="margin-top:150px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card px-3 py-3 border-0 shadow-sm justify-alig">
                        <h3>Kebijakan Privasi Alamat</h3>
                        <p>Kami berkomitmen untuk melindungi privasi alamat pengiriman Anda. Informasi ini kami kumpulkan saat Anda melakukan pemesanan atau mendaftarkan akun di situs kami. Data yang kami kumpulkan mencakup nama, alamat lengkap, dan nomor telepon. Informasi ini digunakan semata-mata untuk memastikan pengiriman pesanan Anda secara akurat dan tepat waktu.</p>
                        <p>Kami hanya membagikan data alamat pengiriman dengan pihak ketiga yang berkaitan dengan proses pengiriman, seperti jasa kurir, dan tidak akan membagikan informasi ini kepada pihak lain kecuali diwajibkan oleh hukum.</p>
                        <p>Data alamat pengiriman Anda disimpan dengan aman dan hanya dapat diakses oleh staf yang berwenang. Anda berhak untuk mengakses, memperbarui, atau menghapus informasi ini kapan saja melalui pengaturan akun atau dengan menghubungi layanan pelanggan kami. Jika ada perubahan dalam kebijakan ini, kami akan memberitahukan melalui situs atau email. Untuk pertanyaan lebih lanjut, hubungi support@Ssayomart.com.</p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card px-3 py-3 border-0 shadow">
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p class="fw-bold"><?= lang('Text.title_alamat') ?></p>
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
                                    <select class="mt-2 form-select <?= (validation_show_error('id_province')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="provinsi" name="id_provinsi">
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
                                    <select class="mt-2 form-select <?= (validation_show_error('id_city')) ? 'is-invalid' : 'border-0'; ?> shadow-sm" id="kabupaten" name="id_kabupaten">
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
                                        <label for=" floatingInput"><?= lang('Text.detail_alamat_2') ?><span class="text-danger"> *</span></label>
                                        <div class="input-group">
                                            <input type="text" list="alamat_3_option" class="mt-2 form-control <?= (validation_show_error('alamat_3')) ? 'is-invalid' : 'border-0'; ?> shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;" value="<?= old('alamat_3') ?>" aria-describedby="button_alamat_3">
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
                                    <span style="font-size:14px" class="text-secondary"><?= lang('Text.alert_alamat') ?></span>
                                    <div id="map"></div>
                                    <div class="button-container">
                                        <button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger"><i class="bi bi-crosshair"></i></button>
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
            margin-left: 50px;
            z-index: 1000;
            border-radius: 50% !important;
            /* Mengatur elemen menjadi bentuk bulat */
            top: 1070px;
        }

        #getLocationBtn {
            border-radius: 50%;
            /* Mengatur tombol menjadi bentuk bulat */

        }
    </style>
<?php endif; ?>
<!-- end desktop -->

<script>
    let csrfTokenName = '<?= csrf_token() ?>';
    let csrfHash = '<?= csrf_hash() ?>';

    function updateCsrfToken(data) {
        if (data.csrf) {
            csrfTokenName = data.csrf.token;
            csrfHash = data.csrf.hash;

            // Cari input hidden CSRF di form dan perbarui nilainya
            const csrfInput = document.querySelector('input[name="' + data.csrf.token + '"]');
            if (csrfInput) {
                csrfInput.value = data.csrf.hash;
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

    const locationIQToken = "pk.bc006a911b504a62570595da46aaed0b";

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function getLatLongOnEvent() {
        var alamat = $('#alamat_3').val();
        console.log(alamat);
        if (alamat.length > 3) {
            fetch(`https://us1.locationiq.com/v1/search.php?key=${locationIQToken}&q=${alamat}&format=json`)
                .then(response => response.json())
                .then(data => {
                    $('#alamat_3_option').empty();
                    data.forEach(e => {
                        $('#alamat_3_option').append('<option value="' + e.display_name + '">' + e.display_name + '</option>');
                    });
                    $('#alamat_3').focus();
                    updateMap(data[0].lat, data[0].lon, 15, 'event');
                })
                .catch(error => console.error('Error fetching address:', error));
        }
    }

    var map = L.map('map', {
        center: [-6.175247, 106.8270488],
        zoom: 13,
        layers: [L.tileLayer('https://{s}-tiles.locationiq.com/v2/streets/r/{z}/{x}/{y}.png?key=pk.bc006a911b504a62570595da46aaed0b', {
            attribution: '&copy; <a href="https://www.locationiq.com">LocationIQ</a> contributors',
            subdomains: ['a', 'b', 'c']
        })]
    });

    function showPosition(position) {
        var lat = position.coords.latitude.toFixed(7);
        var lon = position.coords.longitude.toFixed(7);

        updateMap(lat, lon);
    }

    function onMapClick(e) {
        var lat = e.latlng.lat.toFixed(7);
        var lon = e.latlng.lng.toFixed(7);

        updateMap(lat, lon);
    }

    function updateMap(lat, lon, zoom = null, from = null) {
        // console.log('Updating map with lat:', lat, 'lon:', lon);

        // Clear all previous markers
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });

        // Add a new marker dengan popup "Loading address..."
        L.marker([lat, lon]).addTo(map)
            .bindPopup('Loading address...').openPopup();

        // Reverse geocoding menggunakan LocationIQ
        var apiKey = 'pk.bc006a911b504a62570595da46aaed0b'; // Ganti dengan API Key LocationIQ Anda
        fetch(`https://us1.locationiq.com/v1/reverse.php?key=${apiKey}&lat=${lat}&lon=${lon}&format=json&accept-language=id`)
            .then(response => response.json())
            .then(data => {
                // console.log('Reverse geocoding data:', data);
                var address = data.display_name;
                var addressComponents = data.address;
                var province = addressComponents.state || '';
                var idProvince = addressComponents.state || '';
                var city = addressComponents.city || addressComponents.county || '';
                var postalCode = addressComponents.postcode || '';
                var detailAddress = addressComponents.road || addressComponents.neighbourhood || addressComponents.suburb || addressComponents.city || '';

                // Mengisi otomatis kolom provinsi, kabupaten/kota, dan kode pos
                document.getElementById('provinsi').value = province;
                document.getElementById('kabupaten').value = city;
                document.getElementById('zip_code').value = postalCode;
                document.getElementById('alamat_1').value = detailAddress;

                // Update the popup dengan alamat lengkap
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        layer.getPopup().setContent('You are in : ' + address).openPopup();
                        if (from === 'search') {
                            document.getElementById('alamat_3').value = address;
                            document.getElementById('latitude').value = lat;
                            document.getElementById('longitude').value = lon;
                        } else {
                            document.getElementById('alamat_3').value = address;
                            document.getElementById('latitude').value = lat;
                            document.getElementById('longitude').value = lon;
                        }
                    }
                });
            })
            .catch(error => {
                // console.error('Error fetching address:', error);
                map.eachLayer(function(layer) {
                    if (layer instanceof L.Marker) {
                        layer.getPopup().setContent('Tidak dapat mengambil alamat.').openPopup();
                    }
                });
            });
        // Set view peta ke lokasi baru
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