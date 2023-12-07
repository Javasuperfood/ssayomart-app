<script>
    const cart = new Map([
        ['item', null],
    ]);

    if (cart.get('item') == null) {
        cart.set('item', <?= (session()->get('countCart') > 0) ? session()->get('countCart') : 'null' ?>);
    }
    if (cart.get('item') != null) {
        $('#cartItem_1').text(cart.get('item'));
    }
</script>