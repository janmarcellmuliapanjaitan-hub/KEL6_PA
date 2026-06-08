function showOrderDetails(orderId) {
    const order = window.userOrders ? window.userOrders[orderId] : null;
    if(!order) return;
    
    let statusBadge = '';
    if(order.status === 'pending') {
        statusBadge = '<span class="badge" style="background-color: rgba(255,193,7,0.15); color: #ffc107; border: 1px solid rgba(255,193,7,0.3); padding: 6px 12px; font-weight: 500; border-radius: 6px;">Sedang diproses</span>';
    } else if(order.status === 'completed') {
        statusBadge = '<span class="badge" style="background-color: rgba(40,167,69,0.15); color: #28a745; border: 1px solid rgba(40,167,69,0.3); padding: 6px 12px; font-weight: 500; border-radius: 6px;">Selesai diproses</span>';
    } else {
        statusBadge = '<span class="badge" style="background-color: rgba(220,53,69,0.15); color: #dc3545; border: 1px solid rgba(220,53,69,0.3); padding: 6px 12px; font-weight: 500; border-radius: 6px;">Dibatalkan</span>';
    }

    let itemsHtml = '<ul class="list-group list-group-flush mb-3">';
    order.items.forEach(item => {
        itemsHtml += `
            <li class="list-group-item bg-transparent text-white px-0" style="border-bottom: 1px dashed rgba(232,201,138,0.2);">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h6 class="mb-0" style="color: #f5e6d3; font-size: 0.95rem; font-weight: 500;">${item.name}</h6>
                    <span style="color: #e8c98a; font-weight: 600;">${item.subtotal}</span>
                </div>
                <small style="color: #c4a27a; font-size: 0.85rem;">${item.quantity} x ${item.price}</small>
            </li>
        `;
    });
    itemsHtml += '</ul>';

    const bodyHtml = `
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-0 text-uppercase" style="font-size: 0.75rem; color: #c4a27a; letter-spacing: 1px;">Nomor Pesanan</p>
                <h4 style="color: #e8c98a; margin-bottom: 0; font-family: 'Playfair Display', serif; font-weight: 700;">#${order.order_number}</h4>
            </div>
            <div>
                ${statusBadge}
            </div>
        </div>
        
        <div class="mb-4 p-3 rounded" style="background-color: #2b1a10; border: 1px solid rgba(232,201,138,0.15); border-radius: 8px;">
            <div class="d-flex align-items-center mb-2" style="color: #c4a27a; font-size: 0.9rem;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(232,201,138,0.1); display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                    <i class="bi bi-clock" style="color: #e8c98a; font-size: 0.8rem;"></i>
                </div>
                ${order.created_at}
            </div>
            <div class="d-flex align-items-center ${order.address ? 'mb-2' : ''}" style="color: #c4a27a; font-size: 0.9rem;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(232,201,138,0.1); display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                    <i class="bi bi-truck" style="color: #e8c98a; font-size: 0.8rem;"></i>
                </div>
                ${order.delivery_type}
            </div>
            ${order.address ? `<div class="d-flex align-items-start mt-2" style="color: #c4a27a; font-size: 0.9rem;">
                <div style="width: 24px; height: 24px; border-radius: 50%; background: rgba(232,201,138,0.1); display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                    <i class="bi bi-geo-alt" style="color: #e8c98a; font-size: 0.8rem;"></i>
                </div>
                <div style="padding-top: 2px; line-height: 1.4;">${order.address}</div>
            </div>` : ''}
        </div>
        
        <h6 class="text-uppercase mb-3" style="color: #c4a27a; font-size: 0.8rem; letter-spacing: 1px; font-weight: 600;">Ringkasan Pesanan</h6>
        ${itemsHtml}
        
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid rgba(232,201,138,0.2);">
            <h6 style="color: #f5e6d3; margin-bottom: 0; font-size: 0.9rem;">Total Pembayaran</h6>
            <h4 style="color: #e8c98a; margin-bottom: 0; font-weight: 700; font-family: 'Playfair Display', serif;">${order.total_price}</h4>
        </div>
    `;
    
    document.getElementById('orderDetailModalBody').innerHTML = bodyHtml;
    const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
    modal.show();
}

document.addEventListener('DOMContentLoaded', function () {
    const currentNotificationState = window.notificationConfig ? window.notificationConfig.currentState : '';
    const badge = document.getElementById('notification-badge');
    const dropdown = document.getElementById('notificationDropdown');
    
    if (currentNotificationState) {
        const lastSeenState = localStorage.getItem('last_seen_notification_state');
        if (lastSeenState !== currentNotificationState) {
            if (badge) badge.classList.remove('d-none');
        }
        
        if (dropdown) {
            dropdown.addEventListener('show.bs.dropdown', function () {
                localStorage.setItem('last_seen_notification_state', currentNotificationState);
                if (badge) badge.classList.add('d-none');
            });
        }
    }
});
