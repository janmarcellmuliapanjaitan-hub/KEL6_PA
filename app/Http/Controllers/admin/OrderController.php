<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        $checkoutRequests = \App\Models\CheckoutRequest::latest()->get();
        return view('admin.orders.index', compact('orders', 'checkoutRequests'));
    }

    public function show($id)
    {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Pesanan berhasil disetujui/diselesaikan.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function confirmWaView(Request $request)
    {
        $id = $request->query('id');
        if (!$id) {
            return redirect()->route('admin.orders.index')->with('error', 'ID Pesanan tidak valid.');
        }

        $checkoutRequest = \App\Models\CheckoutRequest::find($id);
        if (!$checkoutRequest) {
            return redirect()->route('admin.orders.index')->with('error', 'Permintaan pesanan tidak ditemukan atau sudah dikonfirmasi.');
        }

        try {
            // Check if this order_number already exists to prevent duplicate entries
            $exists = Order::where('order_number', $checkoutRequest->order_number)->exists();
            if ($exists) {
                $checkoutRequest->delete(); // Clean up the duplicate request
                return redirect()->route('admin.orders.index')->with('error', 'Pesanan dengan Nomor Order tersebut sudah pernah dimasukkan.');
            }

            // Create Order
            $order = Order::create([
                'order_number' => $checkoutRequest->order_number,
                'user_id' => $checkoutRequest->user_id,
                'name' => $checkoutRequest->name,
                'whatsapp_number' => $checkoutRequest->whatsapp_number,
                'delivery_type' => $checkoutRequest->delivery_type,
                'address' => $checkoutRequest->address,
                'total_price' => $checkoutRequest->total_price,
                'notes' => $checkoutRequest->notes,
                'status' => 'pending'
            ]);

            // Create Order Items
            foreach ($checkoutRequest->items as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal']
                ]);
            }

            // Delete temporary checkout request
            $checkoutRequest->delete();

            return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dikonfirmasi dan dimasukkan ke database.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Gagal menyimpan pesanan ke database: ' . $e->getMessage());
        }
    }
}

