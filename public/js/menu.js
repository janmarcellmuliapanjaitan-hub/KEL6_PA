document.addEventListener('DOMContentLoaded', function () {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const menuItems = document.querySelectorAll('.menu-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            menuItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.classList.add('show');
                } else {
                    item.classList.remove('show');
                }
            });
        });
    });

    // Close detail btn click listener
    const closeBtn = document.getElementById('close-detail-btn');
    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('active-card'));
            document.querySelector('.menu-container').classList.remove('has-active-detail');
        });
    }

    // Hide browser defaults for number input scrolling
    document.querySelectorAll('.qty-input').forEach(function(input) {
        input.addEventListener('wheel', function(e) {
            e.preventDefault();
        });
    });
});

let currentSidebarMenuId = null;
let currentSidebarMenuPrice = 0;

function showMenuDetail(cardElement) {
    // Extract data
    const id = cardElement.getAttribute('data-id');
    const name = cardElement.getAttribute('data-name');
    const category = cardElement.getAttribute('data-category');
    const description = cardElement.getAttribute('data-description');
    const price = cardElement.getAttribute('data-price');
    const rawPrice = parseFloat(cardElement.getAttribute('data-raw-price'));
    const image = cardElement.getAttribute('data-image');
    
    currentSidebarMenuId = id;
    currentSidebarMenuPrice = rawPrice;
    
    // Populate sidebar details
    const detailImg = document.getElementById('detail-img');
    const detailImgEmpty = document.getElementById('detail-img-empty');
    
    if (image) {
        detailImg.src = image;
        detailImg.alt = name;
        detailImg.style.display = 'block';
        detailImgEmpty.style.display = 'none';
    } else {
        detailImg.style.display = 'none';
        detailImgEmpty.style.display = 'flex';
    }
    
    document.getElementById('detail-category').textContent = category;
    document.getElementById('detail-title').textContent = name;
    document.getElementById('detail-desc').textContent = description;
    document.getElementById('detail-price').textContent = price;
    
    // Set quantity back to 1
    const qtyInput = document.getElementById('detail-qty');
    if (qtyInput) qtyInput.value = 1;
    
    // Update detail total price
    updateSidebarTotal();
    
    // Expand sidebar layout by adding class
    document.querySelector('.menu-container').classList.add('has-active-detail');
    
    // Highlight active card
    document.querySelectorAll('.menu-card').forEach(c => c.classList.remove('active-card'));
    cardElement.classList.add('active-card');
    
    // Scroll to details on mobile/tablet view
    if (window.innerWidth <= 1024) {
        const contentCard = document.getElementById('menu-detail-content');
        contentCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function numberFormat(val) {
    return new Intl.NumberFormat('id-ID').format(val);
}

function updateSidebarTotal() {
    const qtyInput = document.getElementById('detail-qty');
    if (!qtyInput) return;
    const qty = parseInt(qtyInput.value);
    const totalVal = document.getElementById('detail-qty-total-val');
    if (totalVal) {
        totalVal.textContent = 'Rp ' + numberFormat(qty * currentSidebarMenuPrice);
    }
}

function decreaseDetailQty() {
    let input = document.getElementById('detail-qty');
    if (!input) return;
    let val = parseInt(input.value);
    if (val > 1) {
        input.value = val - 1;
        updateSidebarTotal();
    }
}

function increaseDetailQty() {
    let input = document.getElementById('detail-qty');
    if (!input) return;
    let val = parseInt(input.value);
    input.value = val + 1;
    updateSidebarTotal();
}

function changeCardQty(button, change) {
    const selector = button.closest('.card-qty-selector');
    const input = selector.querySelector('.card-qty-input');
    let qty = parseInt(input.value) + change;
    if (qty < 1) qty = 1;
    input.value = qty;
    
    // Recalculate total price
    const section = selector.closest('.menu-order-section');
    const totalDisplay = section.querySelector('.card-qty-total');
    const basePrice = parseFloat(totalDisplay.getAttribute('data-base-price'));
    const totalVal = section.querySelector('.card-qty-total-val');
    totalVal.textContent = 'Rp ' + numberFormat(qty * basePrice);
}

function guestAlert() {
    alert('Silakan daftar menjadi pelanggan terlebih dahulu untuk melakukan pemesanan.');
    window.location.href = window.menuConfig ? window.menuConfig.registerUrl : '/guest/register';
}

function addToCartAjax(menuId, button) {
    const section = button.closest('.menu-order-section');
    const qtyInput = section.querySelector('.card-qty-input');
    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
    
    // Disable button during loading
    button.disabled = true;
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        (window.menuConfig ? window.menuConfig.csrfToken : '');

    fetch(`/cart/add/${menuId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        button.disabled = false;
        button.innerHTML = originalHtml;
        
        if (data.success) {
            showToast(data.message);
            updateCartBadge(data.cart_count);
        } else {
            alert(data.message || 'Gagal menambahkan ke keranjang.');
        }
    })
    .catch(error => {
        button.disabled = false;
        button.innerHTML = originalHtml;
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}

function orderDirect(menuId, button) {
    const section = button.closest('.menu-order-section');
    const qtyInput = section.querySelector('.card-qty-input');
    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
    
    button.disabled = true;
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        (window.menuConfig ? window.menuConfig.csrfToken : '');

    fetch(`/cart/add/${menuId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = window.menuConfig ? window.menuConfig.cartUrl : '/cart';
        } else {
            button.disabled = false;
            button.innerHTML = originalHtml;
            alert(data.message || 'Gagal memproses pesanan.');
        }
    })
    .catch(error => {
        button.disabled = false;
        button.innerHTML = originalHtml;
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}

function addSidebarToCartAjax() {
    if (!currentSidebarMenuId) return;
    const qtyInput = document.getElementById('detail-qty');
    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
    
    const btn = document.querySelector('.detail-action-box .btn-add-ajax-card');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        (window.menuConfig ? window.menuConfig.csrfToken : '');

    fetch(`/cart/add/${currentSidebarMenuId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i>';
        }
        
        if (data.success) {
            showToast(data.message);
            updateCartBadge(data.cart_count);
        } else {
            alert(data.message || 'Gagal menambahkan ke keranjang.');
        }
    })
    .catch(error => {
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i>';
        }
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}

function orderSidebarDirect() {
    if (!currentSidebarMenuId) return;
    const qtyInput = document.getElementById('detail-qty');
    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
    
    const btn = document.querySelector('.detail-action-box .btn-order-direct-card');
    if (btn) {
        btn.disabled = true;
        btn.textContent = 'Memproses...';
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? 
        document.querySelector('meta[name="csrf-token"]').getAttribute('content') : 
        (window.menuConfig ? window.menuConfig.csrfToken : '');

    fetch(`/cart/add/${currentSidebarMenuId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = window.menuConfig ? window.menuConfig.cartUrl : '/cart';
        } else {
            if (btn) {
                btn.disabled = false;
                btn.textContent = 'Pesan';
            }
            alert(data.message || 'Gagal memproses pesanan.');
        }
    })
    .catch(error => {
        if (btn) {
            btn.disabled = false;
            btn.textContent = 'Pesan';
        }
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
}

function updateCartBadge(count) {
    // Update badge in the floating button
    let badge = document.querySelector('.cart-float-btn .cart-badge');
    if (!badge) {
        let link = document.querySelector('.cart-float-btn a');
        if (link) {
            badge = document.createElement('span');
            badge.className = 'cart-badge';
            link.appendChild(badge);
        }
    }
    if (badge) {
        badge.textContent = count;
        badge.style.display = 'inline-block';
    }
}

function showToast(message) {
    let toast = document.getElementById('ajax-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'ajax-toast';
        toast.style.cssText = `
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #2b1a10;
            color: #e8c98a;
            border: 1px solid rgba(232, 201, 138, 0.4);
            padding: 12px 24px;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            z-index: 9999;
            font-weight: 600;
            font-size: 0.95rem;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s;
            opacity: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        `;
        document.body.appendChild(toast);
    }
    toast.innerHTML = `<i class="fas fa-check-circle" style="color: #28a745; margin-right: 5px;"></i> ${message}`;
    toast.style.transform = 'translateX(-50%) translateY(0)';
    toast.style.opacity = '1';
    
    // Clear previous timeout if any
    if (toast.timeoutId) {
        clearTimeout(toast.timeoutId);
    }
    
    toast.timeoutId = setTimeout(() => {
        toast.style.transform = 'translateX(-50%) translateY(100px)';
        toast.style.opacity = '0';
    }, 3000);
}
