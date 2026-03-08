
@extends('layouts.app')

@section('title', 'Menu')

@push('styles')

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f5f5f5; color: #222; }

        /* HEADER */
        .header {
            background: #3d2b1f;
            color: #fff;
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .header h1 { font-size: 18px; }
        .btn-cart {
            background: #c87941;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        /* TABS */
        .tabs {
            background: #fff;
            display: flex;
            border-bottom: 2px solid #e0e0e0;
            padding: 0 16px;
            gap: 4px;
            position: sticky;
            top: 50px;
            z-index: 40;
            overflow-x: auto;
        }
        .tabs::-webkit-scrollbar { display: none; }
        .tab-btn {
            padding: 12px 18px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            color: #888;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            white-space: nowrap;
        }
        .tab-btn.active { color: #3d2b1f; font-weight: 600; border-bottom-color: #c87941; }

        /* MENU */
        .menu-section { padding: 20px 16px; }
        .menu-section h2 { font-size: 15px; color: #666; margin-bottom: 14px; }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(155px, 1fr));
            gap: 12px;
        }
        .menu-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
            cursor: pointer;
        }
        .menu-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,.1); }
        .menu-card img { width: 100%; height: 110px; object-fit: cover; }
        .menu-card .info { padding: 10px; }
        .menu-card .nama { font-size: 13px; font-weight: 600; margin-bottom: 4px; }
        .menu-card .harga { font-size: 13px; color: #c87941; font-weight: 700; }
        .menu-card .btn-pesan {
            display: block; width: 100%; margin-top: 8px;
            padding: 7px; background: #3d2b1f; color: #fff;
            border: none; border-radius: 6px; font-size: 12px; cursor: pointer;
        }
        .menu-card .btn-pesan:hover { background: #c87941; }

        /* MODAL */
        .overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,.5); z-index: 100;
            align-items: flex-end; justify-content: center;
        }
        .overlay.show { display: flex; }
        .modal {
            background: #fff; width: 100%; max-width: 480px;
            border-radius: 16px 16px 0 0; padding: 20px;
            max-height: 90vh; overflow-y: auto;
        }
        .modal-close {
            float: right; background: #eee; border: none;
            border-radius: 50%; width: 28px; height: 28px;
            cursor: pointer; font-size: 14px;
        }
        .modal img { width: 100%; height: 180px; object-fit: cover; border-radius: 10px; margin: 10px 0; }
        .modal-kategori { font-size: 11px; font-weight: 600; color: #c87941; text-transform: uppercase; letter-spacing: .05em; }
        .modal-id { font-size: 11px; color: #aaa; margin-top: 2px; }
        .modal-nama { font-size: 20px; font-weight: 700; margin: 6px 0 4px; }
        .modal-harga { font-size: 17px; color: #c87941; font-weight: 700; margin-bottom: 10px; }
        .modal-desc { font-size: 13px; color: #666; line-height: 1.6; padding-bottom: 16px; border-bottom: 1px solid #eee; }

        label { display: block; font-size: 12px; font-weight: 600; color: #555; margin: 14px 0 6px; }

        textarea, input[type=text], input[type=tel], input[type=email] {
            width: 100%; padding: 10px 12px;
            border: 1px solid #ddd; border-radius: 8px;
            font-size: 13px; font-family: sans-serif; outline: none;
        }
        textarea:focus, input:focus { border-color: #c87941; }

        .qty-row { display: flex; align-items: center; gap: 12px; margin: 14px 0; }
        .qty-row button {
            width: 36px; height: 36px; border: 1px solid #ddd;
            border-radius: 8px; background: #f5f5f5; font-size: 18px; cursor: pointer;
        }
        .qty-row span { font-size: 16px; font-weight: 700; min-width: 24px; text-align: center; }

        .status-row { display: flex; gap: 8px; margin: 10px 0 16px; }
        .status-opt {
            flex: 1; border: 1.5px solid #ddd; border-radius: 8px;
            padding: 10px 6px; text-align: center; cursor: pointer;
            font-size: 12px; font-weight: 600;
        }
        .status-opt.selected { border-color: #c87941; background: #fff5ec; color: #c87941; }

        .subtotal {
            display: flex; justify-content: space-between;
            padding: 12px; background: #f9f9f9; border-radius: 8px;
            font-weight: 600; margin-bottom: 14px;
        }
        .btn-tambah {
            width: 100%; padding: 14px; background: #3d2b1f;
            color: #fff; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 600; cursor: pointer;
        }
        .btn-tambah:hover { background: #c87941; }

        /* CHECKOUT */
        .checkout-panel {
            display: none; position: fixed; inset: 0;
            background: #f5f5f5; z-index: 200; flex-direction: column;
        }
        .checkout-panel.show { display: flex; }
        .panel-header {
            background: #3d2b1f; color: #fff;
            padding: 14px 20px; display: flex; align-items: center; gap: 12px;
        }
        .btn-back {
            background: rgba(255,255,255,.2); border: none;
            color: #fff; padding: 6px 12px; border-radius: 6px; cursor: pointer;
        }
        .panel-header h2 { font-size: 16px; }
        .panel-body { flex: 1; overflow-y: auto; padding: 20px; }

        .cart-item {
            display: flex; gap: 12px; background: #fff;
            border-radius: 10px; padding: 12px; margin-bottom: 10px;
        }
        .cart-item img { width: 60px; height: 60px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }
        .cart-item .ci-nama { font-weight: 600; font-size: 14px; margin-bottom: 3px; }
        .cart-item .ci-meta { font-size: 12px; color: #888; }
        .cart-item .ci-harga { font-weight: 700; color: #c87941; font-size: 13px; margin-top: 4px; }
        .btn-hapus { background: none; border: none; color: #ccc; cursor: pointer; font-size: 18px; align-self: flex-start; }
        .btn-hapus:hover { color: #e53e3e; }

        .form-checkout { background: #fff; border-radius: 12px; padding: 16px; margin-top: 10px; }
        .form-checkout h3 { font-size: 15px; margin-bottom: 14px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .form-group { margin-bottom: 14px; }

        .total-box {
            background: #3d2b1f; color: #fff;
            border-radius: 10px; padding: 16px; margin: 14px 0;
        }
        .total-row { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 6px; opacity: .8; }
        .total-row.big { font-size: 16px; font-weight: 700; opacity: 1; padding-top: 8px; border-top: 1px solid rgba(255,255,255,.2); margin-top: 4px; }

        .btn-wa {
            width: 100%; padding: 14px; background: #25d366;
            color: #fff; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700; cursor: pointer; margin-bottom: 30px;
        }
        .btn-wa:hover { background: #1ebe5d; }

        .empty { text-align: center; padding: 50px 20px; color: #aaa; }
        .kosong { text-align: center; padding: 40px; color: #aaa; }
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <h1>☕ Menu Kafe</h1>
    <button class="btn-cart" onclick="bukaCheckout()">
        🛒 Keranjang (<span id="cartCount">0</span>)
    </button>
</div>

{{-- TABS --}}
<div class="tabs">
    @forelse($kategori as $kat)
    <button class="tab-btn {{ $loop->first ? 'active' : '' }}"
            onclick="gantiKategori('pane-{{ $kat->id }}', this)">
        {{ $kat->icon }} {{ $kat->name }}
    </button>
    @empty
    @endforelse
</div>

{{-- MENU PER KATEGORI --}}
@forelse($kategori as $kat)
<div class="menu-section" id="pane-{{ $kat->id }}" style="{{ !$loop->first ? 'display:none' : '' }}">
    <h2>{{ $kat->icon }} {{ $kat->name }} &nbsp;·&nbsp; {{ $kat->menus->count() }} menu</h2>

    @if($kat->menus->isEmpty())
        <div class="kosong">Belum ada menu tersedia.</div>
    @else
    <div class="menu-grid">
        @foreach($kat->menus as $menu)
        <div class="menu-card" onclick="bukaModal({{ json_encode([
            'id'        => $menu->id,
            'kode'      => $menu->kode,
            'nama'      => $menu->nama,
            'deskripsi' => $menu->deskripsi,
            'harga'     => $menu->harga,
            'gambar'    => $menu->gambar_url,
            'badge'     => $menu->badge,
            'kategori'  => $kat->name,
            'icon'      => $kat->icon,
        ]) }})">
            <img src="{{ $menu->gambar_url }}" alt="{{ $menu->nama }}">
            <div class="info">
                @if($menu->badge)
                <span style="font-size:10px;background:#c87941;color:#fff;padding:2px 8px;border-radius:50px;">{{ $menu->badge }}</span>
                @endif
                <div class="nama">{{ $menu->nama }}</div>
                <div class="harga">{{ $menu->harga_format }}</div>
                <button class="btn-pesan" onclick="event.stopPropagation(); bukaModal({{ json_encode([
                    'id'        => $menu->id,
                    'kode'      => $menu->kode,
                    'nama'      => $menu->nama,
                    'deskripsi' => $menu->deskripsi,
                    'harga'     => $menu->harga,
                    'gambar'    => $menu->gambar_url,
                    'badge'     => $menu->badge,
                    'kategori'  => $kat->name,
                    'icon'      => $kat->icon,
                ]) }})">+ Pesan</button>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@empty
<div class="kosong" style="padding:60px 20px;">Belum ada kategori tersedia.</div>
@endforelse

{{-- MODAL DETAIL MENU --}}
<div class="overlay" id="overlay" onclick="tutupModalOverlay(event)">
    <div class="modal">
        <button class="modal-close" onclick="tutupModal()">✕</button>
        <div class="modal-kategori" id="mKategori"></div>
        <div class="modal-id" id="mKode"></div>
        <div class="modal-nama" id="mNama"></div>
        <img id="mGambar" src="" alt="">
        <div class="modal-harga" id="mHarga"></div>
        <div class="modal-desc" id="mDesc"></div>

        <label>📝 Catatan (opsional)</label>
        <textarea id="itemNote" rows="2" placeholder="Contoh: kurangi gula, extra shot, tanpa es..."></textarea>

        <label>Jumlah</label>
        <div class="qty-row">
            <button onclick="ubahQty(-1)">−</button>
            <span id="qtyNum">1</span>
            <button onclick="ubahQty(1)">+</button>
        </div>

        <div class="subtotal">
            <span>Subtotal</span>
            <span id="subtotal">Rp 0</span>
        </div>

        <label>Status Pesanan</label>
        <div class="status-row">
            <div class="status-opt selected" onclick="pilihStatus(this,'dine_in')">🏠<br>Dine In</div>
            <div class="status-opt" onclick="pilihStatus(this,'take_away')">🛍️<br>Take Away</div>
            <div class="status-opt" onclick="pilihStatus(this,'delivery')">🛵<br>Delivery</div>
        </div>

        <button class="btn-tambah" onclick="tambahKeKeranjang()">Tambah ke Keranjang</button>
    </div>
</div>

{{-- CHECKOUT PANEL --}}
<div class="checkout-panel" id="checkoutPanel">
    <div class="panel-header">
        <button class="btn-back" onclick="tutupCheckout()">← Kembali</button>
        <h2>Keranjang & Checkout</h2>
    </div>
    <div class="panel-body">
        <div id="cartList"></div>
        <div class="form-checkout" id="formCheckout" style="display:none">
            <h3>👤 Data Diri</h3>
            <div class="form-group">
                <label>Nama *</label>
                <input type="text" id="cNama" placeholder="Nama lengkap">
            </div>
            <div class="form-group">
                <label>No. Telepon *</label>
                <input type="tel" id="cTelp" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="cEmail" placeholder="nama@email.com">
            </div>
            <div class="total-box" id="totalBox"></div>
            <button class="btn-wa" onclick="kirimWA()">📲 Kirim Pesanan via WhatsApp</button>
        </div>
    </div>
</div>

<script>
const WA_NUMBER = '{{ $whatsappNumber }}';
let cart = [];
let itemAktif = null;
let qty = 1;
let status = 'dine_in';

function gantiKategori(paneId, el) {
    document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    document.querySelectorAll('.menu-section').forEach(s => s.style.display = 'none');
    document.getElementById(paneId).style.display = '';
}

function bukaModal(item) {
    itemAktif = item;
    qty = 1;
    status = 'dine_in';

    document.getElementById('mKategori').textContent = item.icon + ' ' + item.kategori;
    document.getElementById('mKode').textContent     = 'Kode: ' + item.kode;
    document.getElementById('mNama').textContent     = item.nama;
    document.getElementById('mGambar').src           = item.gambar;
    document.getElementById('mHarga').textContent    = 'Rp ' + fmt(item.harga);
    document.getElementById('mDesc').textContent     = item.deskripsi ?? '-';
    document.getElementById('itemNote').value        = '';
    document.getElementById('qtyNum').textContent    = 1;
    document.getElementById('subtotal').textContent  = 'Rp ' + fmt(item.harga);

    document.querySelectorAll('.status-opt').forEach(s => s.classList.remove('selected'));
    document.querySelectorAll('.status-opt')[0].classList.add('selected');

    document.getElementById('overlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function tutupModal() {
    document.getElementById('overlay').classList.remove('show');
    document.body.style.overflow = '';
}

function tutupModalOverlay(e) {
    if (e.target === document.getElementById('overlay')) tutupModal();
}

function ubahQty(d) {
    qty = Math.max(1, qty + d);
    document.getElementById('qtyNum').textContent   = qty;
    document.getElementById('subtotal').textContent = 'Rp ' + fmt(itemAktif.harga * qty);
}

function pilihStatus(el, s) {
    document.querySelectorAll('.status-opt').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    status = s;
}

function tambahKeKeranjang() {
    if (!itemAktif) return;
    const note = document.getElementById('itemNote').value.trim();
    cart.push({ ...itemAktif, qty, status, note });
    updateCount();
    tutupModal();
    alert('✓ ' + itemAktif.nama + ' ditambahkan!');
}

function updateCount() {
    document.getElementById('cartCount').textContent = cart.reduce((s, c) => s + c.qty, 0);
}

function bukaCheckout() {
    document.getElementById('checkoutPanel').classList.add('show');
    document.body.style.overflow = 'hidden';
    renderCart();
}

function tutupCheckout() {
    document.getElementById('checkoutPanel').classList.remove('show');
    document.body.style.overflow = '';
}

function renderCart() {
    const list = document.getElementById('cartList');
    const form = document.getElementById('formCheckout');

    if (cart.length === 0) {
        list.innerHTML = '<div class="empty">🛒<br><br>Keranjang masih kosong</div>';
        form.style.display = 'none';
        return;
    }

    const labels = { dine_in: 'Dine In', take_away: 'Take Away', delivery: 'Delivery' };
    list.innerHTML = cart.map((c, i) => `
        <div class="cart-item">
            <img src="${c.gambar}" alt="${c.nama}">
            <div style="flex:1">
                <div class="ci-nama">${c.nama}</div>
                <div class="ci-meta">${c.icon} ${c.kategori} · ${labels[c.status]} · x${c.qty}${c.note ? '<br>📝 ' + c.note : ''}</div>
                <div class="ci-harga">Rp ${fmt(c.harga * c.qty)}</div>
            </div>
            <button class="btn-hapus" onclick="hapusItem(${i})">✕</button>
        </div>
    `).join('');

    const total = cart.reduce((s, c) => s + c.harga * c.qty, 0);
    document.getElementById('totalBox').innerHTML =
        cart.map(c => `<div class="total-row"><span>${c.nama} x${c.qty}</span><span>Rp ${fmt(c.harga * c.qty)}</span></div>`).join('') +
        `<div class="total-row big"><span>Total</span><span>Rp ${fmt(total)}</span></div>`;

    form.style.display = '';
}

function hapusItem(i) {
    cart.splice(i, 1);
    updateCount();
    renderCart();
}

function kirimWA() {
    const nama  = document.getElementById('cNama').value.trim();
    const telp  = document.getElementById('cTelp').value.trim();
    const email = document.getElementById('cEmail').value.trim();

    if (!nama) { alert('Masukkan nama dulu!'); return; }
    if (!telp) { alert('Masukkan nomor telepon dulu!'); return; }

    const labels = { dine_in: 'Dine In', take_away: 'Take Away', delivery: 'Delivery' };
    let msg = `*PESANAN BARU*\n\n`;
    msg += `Nama: ${nama}\nTelepon: ${telp}\n`;
    if (email) msg += `Email: ${email}\n`;
    msg += `\n*PESANAN:*\n`;

    let total = 0;
    cart.forEach((c, i) => {
        total += c.harga * c.qty;
        msg += `\n${i+1}. ${c.nama} (${c.kode})\n`;
        msg += `   Kategori : ${c.kategori}\n`;
        msg += `   Jumlah   : ${c.qty}x · ${labels[c.status]}\n`;
        msg += `   Harga    : Rp ${fmt(c.harga * c.qty)}\n`;
        if (c.note) msg += `   Catatan  : ${c.note}\n`;
    });

    msg += `\n*Total: Rp ${fmt(total)}*`;
    window.open(`https://wa.me/${WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
}

function fmt(n) { return n.toLocaleString('id-ID'); }
</script>
</body>
</html>