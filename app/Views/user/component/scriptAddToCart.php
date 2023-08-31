<script>
    $(document).ready(function() {
        $(".add-to-cart-btn").click(function() {
            // Mengambil nilai input dari formulir
            var id_produk = $("#id_produk").val();
            var harga = $("#harga").val();
            var qty = $("#qty").val();

            console.log('---')
            // Kirim data menggunakan AJAX
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/add-to-cart'); ?>", // Ganti dengan URL controller/method Anda
                dataType: "json",
                data: {
                    id_produk: id_produk,
                    harga: harga,
                    qty: qty
                    // tambahkan data lain yang Anda butuhkan
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ditambahakan ke cart',
                            showConfirmButton: false,
                            timer: 1500,
                            text: response.message,
                        })
                    } else {
                        alert("Failed to add product to cart.");
                    }
                },
                error: function(error) {
                    // Kesalahan jika permintaan tidak berhasil
                    console.error("Error:", error);
                }
            });
        });
    });
</script>