<script>
    const jumlah = 1;
    var origin = $('option:selected', $("#market")).attr('city');
    var destination = $('option:selected', $("#alamat_list")).attr('city');
    var kurir = $('option:selected', $("#kurir")).val();
    $('.btn-bayar').hide();
    $(window).on('load', function() {
        populateServices(kurir, origin, destination)
    })
    selectedOption = $('option:selected', $('#alamat_list')).attr('penerima');
    $('#perubahan').text(selectedOption);

    var total = <?= $total; ?>; // Inisialisasi total dengan harga total awal
    // Fungsi untuk mengisi layanan berdasarkan kurir yang dipilih
    function populateServicesA(kurir = null, origin = null, destination = null) {
        $("#service, #ongkir, #ongkirText, #estimasi, #total, #totalText, #serviceText, #field_subtotal").empty().val('');
        $.ajax({
            url: "<?= base_url('api/getcost') ?>",
            type: 'GET',
            data: {
                'origin': origin, // lokasi awal
                'destination': destination, // lokasi user
                'weight': <?= $beratTotal; ?>, // berat barang
                'courier': kurir // kurir yang dipilih
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
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
                $("#diskon").val(diskon);
                $("#totalText").html(formatRupiah(ongkir + total));
                $("#field_subtotal").val(ongkir + total);
                $('.btn-bayar').show();
                updateDiscount();
            },
        });
    }

    $("#alamat_list").on('change', function() {
        $('.btn-bayar').hide();
        selectedOption = $('option:selected', this).attr('penerima');
        $('#perubahan').text(selectedOption);
        origin = $('option:selected', $('#market')).attr('city');
        kurir = $('option:selected', $("#kurir")).val();
        destination = $('option:selected', this).attr('city');
        populateServices(kurir, origin, destination);

    });

    $('#market').on('change', function() {
        $('.btn-bayar').hide();
        origin = $('option:selected', this).attr('city');
        kurir = $('option:selected', $("#kurir")).val();
        destination = $('option:selected', $("#alamat_list")).attr('city');
        populateServices(kurir, origin, destination);
    });

    // Memanggil fungsi populateServices saat memilih kurir
    $("#kurir").on('change', function() {
        $('.btn-bayar').hide();
        kurir = $("#kurir").val();
        origin = $('option:selected', $("#market")).attr('city');
        destination = $('option:selected', $("#alamat_list")).attr('city');
        populateServices(kurir, origin, destination);
    });

    // Menghitung estimasi dan total saat memilih layanan
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
        $('.btn-bayar').show();
        updateDiscount();
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