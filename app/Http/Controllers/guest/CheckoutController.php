<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('menu')->get();
        if ($carts->count() == 0) {
            return redirect()->route('guest.cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $total = $carts->sum(function($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        return view('guest.checkout.index', compact('carts', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'delivery_type' => 'required|in:Take Away,Delivery',
            'address' => 'required_if:delivery_type,Delivery',
            'whatsapp_number' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('menu')->get();

        if ($carts->count() == 0) {
            return redirect()->route('menu')->with('error', 'Keranjang kosong.');
        }

        $totalPrice = $carts->sum(function($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        // 1. Save Order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'name' => $user->name,
            'whatsapp_number' => $request->whatsapp_number,
            'delivery_type' => $request->delivery_type,
            'address' => $request->delivery_type === 'Delivery' ? $request->address : null,
            'total_price' => $totalPrice,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        // 2. Save Order Items & generate message detailed list
        $itemsText = "";
        foreach ($carts as $cart) {
            $subtotal = $cart->menu->price * $cart->quantity;
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $cart->menu_id,
                'quantity' => $cart->quantity,
                'price' => $cart->menu->price,
                'subtotal' => $subtotal
            ]);
            $itemsText .= "- {$cart->quantity}x {$cart->menu->name} (Rp " . number_format($cart->menu->price, 0, ',', '.') . ")\n";
        }

        // 3. Clear Cart
        Cart::where('user_id', $user->id)->delete();

        // 4. Generate WhatsApp Message
        $adminWa = "6283843802708"; // Admin WA Number (ganti dengan nomor asli)
        
        $message = "Halo Admin Janji Martahan Coffee, saya ingin memesan:\n\n";
        $message .= "*No Order:* {$order->order_number}\n";
        $message .= "*Nama:* {$order->name}\n";
        $message .= "*Tipe Pengambilan:* {$order->delivery_type}\n";
        
        if ($order->delivery_type === 'Delivery') {
            $message .= "*Alamat Pengiriman:* {$order->address}\n";
        }
        
        $message .= "\n*Daftar Pesanan:*\n{$itemsText}";
        $message .= "\n*Total Biaya:* Rp " . number_format($totalPrice, 0, ',', '.') . "\n";
        
        if ($order->notes) {
            $message .= "*Catatan:* {$order->notes}\n";
        }

        $waUrl = "https://api.whatsapp.com/send?phone={$adminWa}&text=" . urlencode($message);

        // Redirect to WA
        return redirect()->away($waUrl);
    }
}
