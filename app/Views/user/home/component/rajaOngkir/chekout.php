<script>
    const jumlah = 1;
    const harga = 20000;
    $("#service").empty();
    $.ajax({
        url: "<?= base_url('api/getcost') ?>",
        type: 'GET',
        data: {
            'origin': '455', // lokasi awal
            'destination': '445', // lokasi user
            'weight': 1000, // berat barangt
            'courier': 'jne' //kurir
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

    $("#jumlah").on('change', function() {
        $("#total").empty();
        jumlah = $("#jumlah").val();
        var total = (jumlah * harga) + ongkir;
        $("#total").val(total);
    });
</script>