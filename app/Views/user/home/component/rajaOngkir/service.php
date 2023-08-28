<script>
    $('document').ready(function() {
        var jumlah = 1;
        $("#provinsi").on('change', function() {
            $("#kabupaten").empty();
            console.log("asdasd")
            var id_province = $(this).val();
            $.ajax({
                url: "<?= base_url('api/getcity') ?>",
                type: 'GET',
                data: {
                    'id_province': id_province,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#kabupaten").append($('<option>', {
                            value: results[i]["city_id"],
                            text: results[i]["city_name"]
                        }));
                    }
                }
            });
        });
    });
</script>