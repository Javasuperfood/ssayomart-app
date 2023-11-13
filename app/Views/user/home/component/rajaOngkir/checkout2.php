<script>
    var total = <?= $total; ?>;
    $('.btn-bayar').hide();
    const getD = new Map([
        ['origin', $("#mpOrigin").attr('origin')],
        ['destination', $("#mpDestination").attr('destination')],
        ['courier', null],
    ]);

    function selectMarket(i, label, origin) {
        $('#market' + i).prop('checked', true);
        $('#mpOrigin').val(label);
        $('#modal-pilih-origin').modal('hide');
        $("#mpOrigin").attr('origin', origin);
        if (getD.get('origin') != origin) {
            setOrigin(origin);
            getCost(getD.get('origin'), getD.get('destination'), getD.get('courier'));
        }
    }

    function selectAlamat(i, label, destination) {
        $('#alamatD' + i).prop('checked', true);
        $('#mpDestination').val(label);
        $('#modal-pilih-destination').modal('hide');
        $("#mpDestination").attr('destination', destination);
        if (getD.get('destination') != destination) {
            setDestination(destination);
            getCost(getD.get('origin'), getD.get('destination'), getD.get('courier'));
        }
    }

    function selectCourier(e) {
        var brand = $(e).attr('brand');
        $('#mpkirim').val(brand);
        if ($(e).val() != getD.get('courier')) {
            setCourier($(e).val());
            getCost(getD.get('origin'), getD.get('destination'), getD.get('courier'));
        }
    }

    function setOrigin(o) {
        getD.set('origin', null);
        getD.set('origin', o);
    }

    function setDestination(d) {
        getD.set('destination', null);
        getD.set('destination', d);
    }

    function setCourier(c) {
        getD.set('courier', null);
        getD.set('courier', c);
    }

    function getCost(origin = null, destination = null, courier = null) {
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
                    // console.log(data);
                    var results = data["rajaongkir"]["results"][0]["costs"];
                    for (var i = 0; i < results.length; i++) {
                        var text = results[i]["description"] + "(" + results[i]["service"] + ")";
                        $("#service").append($('<option>', {
                            value: results[i]["cost"][0]["value"],
                            text: text,
                            etd: results[i]["cost"][0]["etd"],
                            std: results[i]["service"]
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
            $('.btn-bayar').hide();
            $("#service").empty();
            $("#service").append($('<option>', {
                value: '25000',
                text: 'Same Day Delivery',
                etd: '100000',
                std: 'Same Day Delivery'
            }));
            $("#service").append($('<option>', {
                value: '50000',
                text: 'Instant Delivery',
                etd: '100000',
                std: 'Instant Delivery'
            }));
            var estimasi = $('option:selected', $("#service")).attr('etd');
            ongkir = parseInt($("#service").val());
            $("#ongkir").val(ongkir);
            $("#ongkirText").html(formatRupiah(ongkir));
            $("#estimasi").html(estimasi + " Hari");
            $("#total").val(total);
            $("#totalText").html(formatRupiah(ongkir + total));
            $("#field_subtotal").val(ongkir + total);
            updateDiscount();
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Courier not available",
            });
        }
    }
    $("#service").on('change', function() {
        var estimasi = $('option:selected', this).attr('etd');
        ongkir = parseInt($(this).val());
        $("#ongkir").val(ongkir);
        $("#ongkirText").html(formatRupiah(ongkir));
        $("#estimasi").html(estimasi + " Hari");
        $("#total").val(total);
        $("#field_subtotal").val(ongkir + total);
        $("#serviceText").val($("#service option:selected").text());
        $("#totalText").html(formatRupiah(ongkir + total));
        updateDiscount();
        if (getD.get('courier') != 'gosend') {
            $('.btn-bayar').show();
        }
    });

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