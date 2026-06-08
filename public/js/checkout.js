function toggleAddress() {
    var type = document.getElementById('delivery_type').value;
    var addrContainer = document.getElementById('address_container');
    var addrInput = document.getElementById('address');
    
    if (type === 'Delivery') {
        addrContainer.style.display = 'block';
        addrInput.setAttribute('required', 'required');
    } else {
        addrContainer.style.display = 'none';
        addrInput.removeAttribute('required');
    }
}
