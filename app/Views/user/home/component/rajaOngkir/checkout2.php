<script>
    var total = <?= $total; ?>;
    $('.btn-bayar').hide();
    const getD = new Map([
        ['origin', $("#mpOrigin").attr('origin')],
        ['destination', $("#mpDestination").attr('destination')],
        ['courier', null],
        ['label', null],
        ['originLatLong', $("#mpOrigin").attr('originLatLong')],
        ['destinationLatLong', $("#mpDestination").attr('destinationLatLong')]
    ]);

    function selectMarket(i, label, origin, originLatLong) {
        $('#market' + i).prop('checked', true);
        $('#mpOrigin').val(label);
        $('#modal-pilih-origin').modal('hide');
        $("#mpOrigin").attr('origin', origin);
        $("#mpOrigin").attr('originLatLong', originLatLong);
        if (getD.get('origin') != origin) {
            setOrigin(origin, originLatLong);
            getCost(getD.get('origin'), getD.get('destination'), getD.get('courier'), getD.get('originLatLong'), getD.get('destinationLatLong'));
        }
    }

    function selectAlamat(i, label, destination, destinationLatLong) {
        $('#alamatD' + i).prop('checked', true);
        $('#mpDestination').val(label);
        $('#modal-pilih-destination').modal('hide');
        $("#mpDestination").attr('destination', destination);
        $("#mpDestination").attr('destinationLatLong', destinationLatLong);
        if (getD.get('destination') != destination) {
            setDestination(destination, destinationLatLong);
            getCost(getD.get('origin'), getD.get('destination'), getD.get('courier'), getD.get('originLatLong'), getD.get('destinationLatLong'));
        }
    }

    function selectCourier(e) {
        var label = $(e).closest('.col').find('label');
        var brand = $(e).attr('brand');
        $('#mpkirim').val(brand);

        if ($(e).val() !== getD.get('courier')) {
            setCourier($(e).val());
            getCost(getD.get('origin'), getD.get('destination'), getD.get('courier'), getD.get('originLatLong'), getD.get('destinationLatLong'));
            label.text("Terpilih");
            oldLabel(getD.get('label'));
            getD.set('label', label);
        }
    }

    function oldLabel(e) {
        if (e != null) {
            e.text("Pilih");
        }
    }

    function setOrigin(o, ll) {
        getD.set('origin', null);
        getD.set('originLatLong', null);
        getD.set('origin', o);
        getD.set('originLatLong', ll);
    }

    function setDestination(d, ll) {
        getD.set('destination', null);
        getD.set('destinationLatLong', null);
        getD.set('destination', d);
        getD.set('destinationLatLong', ll);
    }

    function setCourier(c) {
        getD.set('courier', null);
        getD.set('courier', c);
    }

    function getCost(origin = null, destination = null, courier = null, originLatLong = null, destinationLatLong = null) {
        if (origin != null && destination != null && courier != null && courier != 'gosend') {
            $("#service, #ongkir, #ongkirText, #estimasi, #total, #totalText, #serviceText, #field_subtotal").empty().val('');
            $.ajax({
                url: "<?= base_url('api/getcost') ?>",
                type: 'GET',
                data: {
                    'origin': origin, // lokasi awal
                    'destination': destination, // lokasi user
                    'weight': <?= $beratTotal; ?>, // berat barang
                    'courier': courier // kurir yang dipilih
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var results = data["rajaongkir"]["results"][0]["costs"];
                    for (var i = 0; i < results.length; i++) {
                        var text = results[i]["description"] + "(" + results[i]["service"] + ")";
                        $("#service").append($('<option>', {
                            value: results[i]["cost"][0]["encodeCost"],
                            text: text,
                            etd: results[i]["cost"][0]["etd"],
                            std: results[i]["service"],
                            price: results[i]["cost"][0]["value"]
                        }));
                    }
                    $("#serviceText").val(results[0]["description"] + "(" + results[0]["service"] + ")");
                    var estimasi = results[0]["cost"][0]["etd"];
                    ongkir = parseInt(results[0]["cost"][0]["value"]);
                    $("#ongkir").val(ongkir);
                    $("#ongkirText").html(formatRupiah(ongkir));
                    $("#estimasi").html(estimasi + " Hari");
                    $("#total").val(total);
                    $("#totalText").html(formatRupiah(ongkir + total));
                    $("#field_subtotal").val(ongkir + total);
                    $('.btn-bayar').show();
                    updateDiscount();
                },
            });
        } else if (courier == 'gosend') {
            $("#service, #ongkir, #ongkirText, #estimasi, #total, #totalText, #serviceText, #field_subtotal").empty().val('');
            $.ajax({
                url: "<?= base_url('api/gosend/getcost') ?>",
                type: 'POST',
                data: {
                    'origin': originLatLong, // lokasi awal
                    'destination': destinationLatLong, // lokasi user
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    Object.keys(data).forEach(method => {
                        const shipment = data[method];
                        if (shipment.serviceable) {
                            var text = 'GoSend ' + shipment.shipment_method;
                            $("#service").append($('<option>', {
                                value: shipment.encodeCost, // Fix the typo here
                                text: text,
                                etd: shipment.shipment_method_description,
                                std: shipment.shipment_method,
                                price: shipment.price.total_price
                            }));
                            // Access properties
                            // for each shipment method
                            // console.log(`Shipment Method: ${shipment.shipment_method}`);
                            // console.log(`Description: ${shipment.shipment_method_description}`);
                            // console.log(`Serviceable: ${shipment.serviceable}`);
                            // console.log(`Active: ${shipment.active}`);
                            // console.log(`Distance: ${shipment.distance}`);
                            // console.log(`Route Polyline: ${shipment.route_polyline}`);
                            // console.log(`Decode Route Polyline:`);
                            // console.log(decodePolyline(shipment.route_polyline));

                            // // Access pricing details
                            // console.log("Pricing:");
                            // console.log(`  Total Price: ${shipment.price.total_price}`);
                            // console.log(`  Go Pay Total Price: ${shipment.price.go_pay_total_price}`);
                            // console.log(`  Go Pay Discount: ${shipment.price.go_pay_discount}`);
                            // console.log(`  Voucher Discount: ${shipment.price.voucher_discount}`);
                            // console.log(`  Total Price with Voucher: ${shipment.price.total_price_with_voucher}`);

                            // // Add additional properties as needed
                            // console.log("\n"); // Separate each shipment method for clarity
                        }
                    });
                    let methodS;
                    if (data['Instant'].serviceable) {
                        methodS = data['Instant'];
                    } else {
                        methodS = data['SameDay'];
                    }
                    $("#serviceText").val(methodS.shipment_method);
                    ongkir = parseInt(methodS.price.total_price);
                    $("#ongkir").val(ongkir);
                    $("#ongkirText").html(formatRupiah(ongkir));
                    $("#estimasi").html(methodS.shipment_method_description);
                    $("#total").val(total);
                    $("#totalText").html(formatRupiah(ongkir + total));
                    $("#field_subtotal").val(ongkir + total);
                    $('.btn-bayar').show();
                    updateDiscount();
                },
            });
        }
    }
    $("#service").on('change', function() {
        var estimasi = $('option:selected', this).attr('etd');
        ongkir = parseInt($(this).find(':selected').attr('price'));
        $("#ongkir").val(ongkir);
        $("#ongkirText").html(formatRupiah(ongkir));
        if ($("#mpkirim").val() == 'GoSend') {
            $("#estimasi").html(estimasi);
        } else {
            $("#estimasi").html(estimasi + " Hari");
        }
        $("#total").val(total);
        $("#field_subtotal").val(ongkir + total);
        $("#serviceText").val($("#service option:selected").text());
        $("#totalText").html(formatRupiah(ongkir + total));
        updateDiscount();
        if (getD.get('courier') != 'gosend') {
            $('.btn-bayar').show();
        }
    });

    function decodePolyline(encoded) {
        var poly = [];
        var index = 0;
        var len = encoded.length;
        var lat = 0;
        var lng = 0;

        while (index < len) {
            var b;
            var shift = 0;
            var result = 0;
            do {
                b = encoded.charAt(index++).charCodeAt(0) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);

            var dlat = ((result & 1) !== 0 ? ~(result >> 1) : (result >> 1));
            lat += dlat;

            shift = 0;
            result = 0;
            do {
                b = encoded.charAt(index++).charCodeAt(0) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);

            var dlng = ((result & 1) !== 0 ? ~(result >> 1) : (result >> 1));
            lng += dlng;

            var point = {
                lat: lat / 1e5,
                lng: lng / 1e5
            };
            poly.push(point);
        }
        return poly;
    }

    function formatRupiah(angka) {
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });
        return formatter.format(angka);
    }

    function updateDiscount() {
        var selectedCoupon = $("#kupon").val();
        var totalHarga = <?= $total; ?>;
        var diskon = 0;

        <?php foreach ($kupon as $k) : ?>
            if (selectedCoupon === "<?= $k['kode']; ?>") {
                diskon = totalHarga * <?= $k['discount']; ?>;
            }
        <?php endforeach; ?>

        $("#diskon").text("-" + formatRupiah(diskon));
        totalHarga -= diskon;
        $("#totalText").text(formatRupiah(ongkir + totalHarga));
        $("#field_subtotal").val(ongkir + total);
    }

    $(document).ready(function() {
        $("#kupon").on('change', function() {
            updateDiscount();
        });
    });
</script>