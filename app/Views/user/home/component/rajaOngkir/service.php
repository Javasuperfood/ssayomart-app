<script>
    $('document').ready(function() {
        var jumlah = 1;
        $("#provinsi").on('change', function() {
            const provinsiDropdown = document.getElementById('provinsi');
            const kabupatenDropdown = document.getElementById('kabupaten');
            const inputProvinsi = document.getElementById('inputProvinsi');

            kabupatenDropdown.innerHTML = '<option selected></option>';
            inputProvinsi.value = provinsiDropdown.options[provinsiDropdown.selectedIndex].text;
            $("#kabupaten").empty();
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
                    const inputKabupaten = document.getElementById('inputKabupaten');
                    inputKabupaten.value = kabupatenDropdown.options[kabupatenDropdown.selectedIndex].text;

                    $("#kabupaten").on('change', function() {
                        inputKabupaten.value = kabupatenDropdown.options[kabupatenDropdown.selectedIndex].text;
                    });
                }
            });
        });
    });
</script>