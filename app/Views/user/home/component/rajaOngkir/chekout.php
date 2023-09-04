<script>
    const jumlah = 1;
    const harga = 20000;

    // Fungsi untuk mengisi layanan berdasarkan kurir yang dipilih
    function populateServices(kurir) {
        $("#service").empty();
        $.ajax({
            url: "<?= base_url('api/getcost') ?>",
            type: 'GET',
            data: {
                'origin': '455', // lokasi awal
                'destination': '445', // lokasi user
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
                        etd: results[i]["cost"][0]["etd"]
                    }));
                }
            },
        });
    }

    // Memanggil fungsi populateServices saat memilih kurir
    $("#kurir").on('change', function() {
        var kurir = $(this).val();
        populateServices(kurir);
    });

    // Menghitung estimasi dan total saat memilih layanan
    $("#service").on('change', function() {
        var estimasi = $('option:selected', this).attr('etd');
        ongkir = parseInt($(this).val());
        $("#ongkir").val(ongkir);
        $("#ongkirText").html(ongkir);
        $("#estimasi").html(estimasi + " Hari");
        var total = (jumlah * harga) + ongkir;
        $("#total").val(total);
        $("#totalText").html(total);
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
</script>