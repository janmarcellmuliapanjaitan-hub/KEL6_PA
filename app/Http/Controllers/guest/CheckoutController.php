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

        $hasUnavailableItems = $carts->contains(function($cart) {
            return !$cart->menu->is_available;
        });

        if ($hasUnavailableItems) {
            return redirect()->route('guest.cart.index')->with('error', 'Ada menu di keranjang Anda yang sedang tidak tersedia. Silakan hapus menu tersebut terlebih dahulu.');
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
            'whatsapp_number' => 'required|regex:/^[0-9]{8,15}$/',
            'notes' => 'nullable|string'
        ], [
            'whatsapp_number.regex' => 'Nomor WhatsApp hanya boleh berisi angka dengan panjang 8 hingga 15 digit.'
        ]);

        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('menu')->get();

        if ($carts->count() == 0) {
            return redirect()->route('menu')->with('error', 'Keranjang kosong.');
        }

        $hasUnavailableItems = $carts->contains(function($cart) {
            return !$cart->menu->is_available;
        });

        if ($hasUnavailableItems) {
            return redirect()->route('guest.cart.index')->with('error', 'Ada menu di keranjang Anda yang sedang tidak tersedia. Silakan hapus menu tersebut terlebih dahulu.');
        }

        $totalPrice = $carts->sum(function($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        $orderNumber = 'ORD-' . strtoupper(uniqid());

        // 2. Map items for WhatsApp and encoding
        $itemsText = "";
        $itemsData = [];
        foreach ($carts as $cart) {
            $subtotal = $cart->menu->price * $cart->quantity;
            $itemsData[] = [
                'menu_id' => $cart->menu_id,
                'quantity' => $cart->quantity,
                'price' => $cart->menu->price,
                'subtotal' => $subtotal
            ];
            $itemsText .= "- {$cart->quantity}x {$cart->menu->name} (Rp " . number_format($cart->menu->price, 0, ',', '.') . ")\n";
        }   

        // 3. Clear Cart
        Cart::where('user_id', $user->id)->delete();

        // 4. Create CheckoutRequest in DB
        $checkoutRequest = \App\Models\CheckoutRequest::create([
            'order_number' => $orderNumber,
            'user_id' => $user->id,
            'name' => $user->name,
            'whatsapp_number' => $request->whatsapp_number,
            'delivery_type' => $request->delivery_type,
            'address' => $request->delivery_type === 'Delivery' ? $request->address : null,
            'total_price' => $totalPrice,
            'notes' => $request->notes,
            'items' => $itemsData
        ]);

        $confirmUrl = route('admin.orders.confirm-wa-view', ['id' => $checkoutRequest->id]);

        // 5. Generate WhatsApp Message
        $adminWa = \App\Models\Setting::get('admin_whatsapp', env('ADMIN_WA'));
        
        $message = "Halo Admin Janji Martahan Coffee, saya ingin memesan:\n\n";
        $message .= "*No Order:* {$orderNumber}\n";
        $message .= "*Nama:* {$user->name}\n";
        $message .= "*Tipe Pengambilan:* {$request->delivery_type}\n";
        
        if ($request->delivery_type === 'Delivery') {
            $message .= "*Alamat Pengiriman:* {$request->address}\n";
        }
        
        $message .= "\n*Daftar Pesanan:*\n{$itemsText}";
        $message .= "\n*Total Biaya:* Rp " . number_format($totalPrice, 0, ',', '.') . "\n";
        
        if ($request->notes) {
            $message .= "*Catatan:* {$request->notes}\n";
        }

        $message .= "\n*Link Konfirmasi Admin:* {$confirmUrl}\n";

        $waUrl = "https://api.whatsapp.com/send?phone={$adminWa}&text=" . urlencode($message);

        // Redirect directly to home, passing the waUrl in session flash
        return redirect()->route('home')->with('waUrl', $waUrl);
    }
}
