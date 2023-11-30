<script>
    $('#cartItem_1').text(cart.get('item'));
    document.addEventListener('DOMContentLoaded', function() {
        cartItemShow();
    })

    function cartItemShow(con = null) {
        if (con == 'plus') {
            console.log('plus');
            cart.set('item', cart.get('item') + 1);
        }
        if (con == 'minus') {
            cart.set('item', cart.get('item') - 1);
        }
        if (cart.get('item') != null) {
            $('#cartItem_0').show();
        }
        if (cart.get('item') == null || cart.get('item') == 0) {
            $('#cartItem_0').hide();
        }
        $('#cartItem_1').text(cart.get('item'));
    }

    $('.add-to-cart-btn').click(function() {

    })
</script>