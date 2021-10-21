<?php

namespace App\Http\Controllers;

use App\Order;
use App\Helper\Cart\Cart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        $price = Cart::all()->sum('price');
        $order = Order::create([
            'status' => 'unpaid',
            'price' => $price,
            'user_id' => auth()->user()->id,
        ]);

        // $carts = "";
        foreach (Cart::all() as  $cart) {
            $carts = $cart['Course']->id;
            $order->courses()->attach($carts);
        }
       
    }
}
