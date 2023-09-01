<script>
    $(document).ready(function() {
        $(".add-to-cart-btn").click(function() {
            var id_produk = $("#id_produk").val();
            var harga = $("#harga").val();
            var qty = $("#qty").val();

            console.log('---')
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/add-to-cart'); ?>",
                dataType: "json",
                data: {
                    id_produk: id_produk,
                    harga: harga,
                    qty: qty
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahakan ke cart',
                            showConfirmButton: false,
                            timer: 1500,
                            text: response.message,
                        })
                    }
                },
                error: function(error) {
                    console.error("Error:", error);
                    <?php if (!auth()->loggedIn()) : ?>
                        location.href = '<?= base_url(); ?>login'
                    <?php endif ?>
                }
            });
        });
    });
</script>