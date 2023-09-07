<script>
    const jumlah = 1;
    const jasaApp = 1000;
    var destination = <?= $alamat_list[0]['id_city']; ?>;
    var kurir = 'jne';
    $('#serviceApp').html(formatRupiah(jasaApp));

    const total = <?= $total; ?>;

    // Fungsi untuk mengisi layanan berdasarkan kurir yang dipilih
    function populateServices(kurir) {
        $("#service, #ongkir, #ongkirText, #estimasi, #total, #totalText, #serviceText, #field_subtotal").empty().val('');
        $.ajax({
            url: "<?= base_url('api/getcost') ?>",
            type: 'GET',
            data: {
                'origin': '455', // lokasi awal
                'destination': destination, // lokasi user
                'weight': 1000, // berat barangt
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
                $("#totalText").html(formatRupiah(ongkir + total + jasaApp));
                $("#field_subtotal").val(ongkir + total + jasaApp);
            },
        });
    }

    $("#alamat_list").on('change', function() {
        $("#kurir").prop('selectedIndex', 0)
        selectedOption = $('option:selected', this).attr('penerima');
        $('#perubahan').text(selectedOption);
        destination = $('option:selected', this).attr('city');
        populateServices(destination);

    });
    // Memanggil fungsi populateServices saat memilih kurir
    $("#kurir").on('change', function() {
        kurir = $("#kurir").val();
        populateServices(kurir);
    });

    // Menghitung estimasi dan total saat memilih layanan
    $("#service").on('change', function() {
        var estimasi = $('option:selected', this).attr('etd');
        ongkir = parseInt($(this).val());
        $("#ongkir").val(ongkir);
        $("#ongkirText").html(formatRupiah(ongkir));
        $("#estimasi").html(estimasi + " Hari");
        $("#total").val(total);
        $("#serviceText").val($("#service option:selected").text());
        $("#totalText").html(formatRupiah(ongkir + total + jasaApp));
    });

    // Menghitung total saat mengubah jumlah
    $("#jumlah").on('change', function() {
        $("#total").empty();
        jumlah = $("#jumlah").val();
        var total = (jumlah * harga) + ongkir;
        $("#total").val(total);
    });

    // Memanggil populateServices saat halaman dimuat pertama kali (jika kurir sudah dipilih sebelumnya)
    var kurirTerpilih = $("#kurir").val();
    if (kurirTerpilih) {
        populateServices(kurirTerpilih);
    }

    function formatRupiah(angka) {
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 2
        });
        return formatter.format(angka);
    }
</script>