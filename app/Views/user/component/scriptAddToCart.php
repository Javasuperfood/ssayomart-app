<script>
    function selectVarian(id) {
        $(`#readioVarian${id}`).prop('checked', true);
    }
    $(document).ready(function() {
        <?php if (isset($_GET['varian'])) : ?>
            $("#modalVarian").modal("show");
        <?php endif ?>
        $(".add-to-cart-btn").click(function() {
            var produk = $(this).attr('produk');
            var qty = $("#qty").val();
            var varian = $('input[name="varian"]:checked').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('api/add-to-cart'); ?>",
                dataType: "json",
                data: {
                    id_produk: produk,
                    id_varian: varian,
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