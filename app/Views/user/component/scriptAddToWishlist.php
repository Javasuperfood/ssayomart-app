<script>
    $(document).ready(function() {
        $(".add-to-wishlist-btn").click(function() {
            var produk = $(this).attr('produk');
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/add-to-wishlist'); ?>",
                dataType: "json",
                data: {
                    id_produk: produk,
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ditambahakan ke wishlist',
                            showConfirmButton: false,
                            timer: 1500,
                            text: response.message,
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahakan ke wishlist',
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