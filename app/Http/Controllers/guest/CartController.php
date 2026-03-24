<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('menu')->get();
        return view('guest.cart.index', compact('carts'));
    }

    public function add(Request $request, Menu $menu)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Cart::where('user_id', Auth::id())->where('menu_id', $menu->id)->first();

        if ($cart) {
            $cart->update(['quantity' => $cart->quantity + $request->quantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $menu->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cart = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove($id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $cart->delete();

        return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }
}
