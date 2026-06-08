// Menyembunyikan spinner/panah pada input type number
document.querySelectorAll('input[type=number]').forEach(function(input) {
    input.addEventListener('wheel', function(e) {
        e.preventDefault();
    });
});

function decreaseQty(cartId) {
    let input = document.getElementById('qty-' + cartId);
    let val = parseInt(input.value);
    if (val > 1) {
        input.value = val - 1;
        document.getElementById('form-qty-' + cartId).submit();
    } else {
        if(confirm('Hapus item ini dari keranjang?')) {
            document.getElementById('form-delete-' + cartId).submit();
        }
    }
}

function increaseQty(cartId) {
    let input = document.getElementById('qty-' + cartId);
    let val = parseInt(input.value);
    input.value = val + 1;
    document.getElementById('form-qty-' + cartId).submit();
}
