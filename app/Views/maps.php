<?= $this->extend('user/home/layout2') ?>
<?= $this->section('page-content') ?>
<div class="row">
    <div class="col py-3"></div>
</div>
<div class="row">
    <div class="col py-3"></div>
</div>
<div class="row">
    <div class="col py-3"></div>
</div>
<div class="row">
    <div class="col py-3"></div>
</div>
<input type="text" class="form-control shadow-sm floatingInput" name="alamat_3" id="alamat_3" style="font-size: 14px;">
<div class="invalid-feedback"><?= validation_show_error('alamat_3') ?></div>
<input type="text" id="latitude" name="latitude">
<input type="text" id="longitude" name="longitude">
<br>
<form action="<?= base_url('maps'); ?>" method="get">
    <input type="text" name="originL1" value="-6.215841">
    <input type="text" name="originL2" value="106.617353">
    <input type="text" name="destinationL1" value="-6.216905">
    <input type="text" name="destinationL2" value="106.607358">
    <button type="submit">Get Distance</button>
</form>
<?= isset($_GET['origin']) ? $_GET['origin'] : ''; ?> <?= isset($_GET['destination']) ? $_GET['destination'] : ''; ?>
<div id="map"></div>

<button type="button" id="getLocationBtn" onclick="getLocation()" class="btn btn-danger"><i class="bi bi-geo-alt-fill"></i></button>
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    var originL1 = '<?= isset($_GET['originL1']) ? $_GET['originL1'] : ''; ?>';
    var originL2 = '<?= isset($_GET['originL2']) ? $_GET['originL2'] : ''; ?>';
    var destinationL1 = '<?= isset($_GET['destinationL1']) ? $_GET['destinationL1'] : ''; ?>';
    var destinationL2 = '<?= isset($_GET['destinationL2']) ? $_GET['destinationL2'] : ''; ?>';
    var apiKey = '5b3ce3597851110001cf6248e9189ece87df42a5ab11f74475795ce3';

    var map = L.map('map', {
        center: [<?= isset($_GET['originL1']) ? $_GET['originL1'] . ', ' . $_GET['originL2'] : '-6.175247, 106.8270488'; ?>],
        zoom: 15,
        layers: [L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')]
    });

    var control = L.Routing.control({
        waypoints: [
            L.latLng(originL1, originL2),
            L.latLng(destinationL1, destinationL2)
        ],
        routeWhileDragging: true,
        serviceUrl: 'https://api.openrouteservice.org/v2/directions',
        router: L.Routing.osrmv1({
            apiKey: apiKey
        })
    }).addTo(map);

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;

        // Clear all previous markers
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {

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

        map.setView([lat, lon], 50);
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
<link rel="stylesheet" href="<?= base_url(); ?>assets/maps/routing/leaflet-routing-machine.css" />


<script src="<?= base_url(); ?>assets/maps/leaflet.js"></script>
<script src="<?= base_url(); ?>assets/maps/routing/leaflet-routing-machine.js"></script>
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
<?= $this->endSection(); ?>